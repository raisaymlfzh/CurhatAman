<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriKasus;
use App\Support\AuditLogger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class KategoriKasusController extends Controller
{
    /**
     * Menampilkan daftar master data kategori kasus perundungan / masalah siswa.
     */
    public function index(Request $request)
    {
        $q = trim((string) $request->get('q', ''));
        $status = trim((string) $request->get('status', ''));

        $query = DB::table('kategori_kasus as kk')
            ->select([
                'kk.id',
                'kk.nama_kategori',
                'kk.slug',
                'kk.deskripsi',
                'kk.is_active',
                'kk.created_at',
                'kk.updated_at',
                DB::raw('(SELECT COUNT(*) FROM laporan_kasus lk WHERE lk.kategori_id = kk.id) as total_laporan'),
            ]);

        if ($q !== '') {
            $query->where(function ($sub) use ($q) {
                $sub->where('kk.nama_kategori', 'like', "%{$q}%")
                    ->orWhere('kk.slug', 'like', "%{$q}%")
                    ->orWhere('kk.deskripsi', 'like', "%{$q}%");
            });
        }

        if ($status === 'aktif') {
            $query->where('kk.is_active', true);
        } elseif ($status === 'nonaktif') {
            $query->where('kk.is_active', false);
        }

        $kategoriList = $query
            ->orderByDesc('kk.is_active')
            ->orderBy('kk.nama_kategori')
            ->paginate(10)
            ->withQueryString();

        $ringkasan = [
            'total' => DB::table('kategori_kasus')->count(),
            'aktif' => DB::table('kategori_kasus')->where('is_active', true)->count(),
            'nonaktif' => DB::table('kategori_kasus')->where('is_active', false)->count(),
            'total_laporan' => DB::table('laporan_kasus')->count(),
        ];

        return view('admin.kategori-kasus.index', [
            'user' => $request->user(),
            'kategoriList' => $kategoriList,
            'ringkasan' => $ringkasan,
            'search' => $q,
            'selectedStatus' => $status,
        ]);
    }

    /**
     * Menyimpan kategori kasus baru.
     */
    public function store(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'nama_kategori' => ['required', 'string', 'max:100', 'unique:kategori_kasus,nama_kategori'],
            'slug' => ['nullable', 'string', 'max:100', 'unique:kategori_kasus,slug'],
            'deskripsi' => ['nullable', 'string', 'max:1000'],
            'is_active' => ['nullable', 'boolean'],
        ], [
            'nama_kategori.required' => 'Nama kategori kasus wajib diisi.',
            'nama_kategori.unique' => 'Nama kategori kasus ini sudah ada.',
            'slug.unique' => 'Slug pengenal kategori ini sudah digunakan.',
        ]);

        $slug = ! empty($validated['slug'])
            ? Str::slug($validated['slug'])
            : Str::slug($validated['nama_kategori']);

        // Pastikan slug unik jika auto-generate
        $originalSlug = $slug;
        $counter = 1;
        while (KategoriKasus::where('slug', $slug)->exists()) {
            $slug = "{$originalSlug}-{$counter}";
            $counter++;
        }

        $kategori = KategoriKasus::create([
            'nama_kategori' => trim($validated['nama_kategori']),
            'slug' => $slug,
            'deskripsi' => isset($validated['deskripsi']) ? trim($validated['deskripsi']) : null,
            'is_active' => $request->boolean('is_active', true),
        ]);

        AuditLogger::record(
            $request,
            $user,
            'create_kategori_kasus',
            "Menambahkan kategori kasus baru: {$kategori->nama_kategori}",
            'kategori_kasus',
            $kategori->id
        );

        return redirect()
            ->route('admin.kategori-kasus.index')
            ->with('success', "Kategori kasus \"{$kategori->nama_kategori}\" berhasil ditambahkan.");
    }

    /**
     * Memperbarui kategori kasus.
     */
    public function update(Request $request, int $id)
    {
        $user = $request->user();
        $kategori = KategoriKasus::findOrFail($id);

        $validated = $request->validate([
            'nama_kategori' => [
                'required',
                'string',
                'max:100',
                Rule::unique('kategori_kasus', 'nama_kategori')->ignore($kategori->id),
            ],
            'slug' => [
                'nullable',
                'string',
                'max:100',
                Rule::unique('kategori_kasus', 'slug')->ignore($kategori->id),
            ],
            'deskripsi' => ['nullable', 'string', 'max:1000'],
            'is_active' => ['nullable', 'boolean'],
        ], [
            'nama_kategori.required' => 'Nama kategori kasus wajib diisi.',
            'nama_kategori.unique' => 'Nama kategori kasus ini sudah digunakan.',
            'slug.unique' => 'Slug pengenal kategori ini sudah digunakan.',
        ]);

        $slug = ! empty($validated['slug'])
            ? Str::slug($validated['slug'])
            : Str::slug($validated['nama_kategori']);

        $originalSlug = $slug;
        $counter = 1;
        while (KategoriKasus::where('slug', $slug)->where('id', '!=', $kategori->id)->exists()) {
            $slug = "{$originalSlug}-{$counter}";
            $counter++;
        }

        $kategori->update([
            'nama_kategori' => trim($validated['nama_kategori']),
            'slug' => $slug,
            'deskripsi' => isset($validated['deskripsi']) ? trim($validated['deskripsi']) : null,
            'is_active' => $request->boolean('is_active', true),
        ]);

        AuditLogger::record(
            $request,
            $user,
            'update_kategori_kasus',
            "Memperbarui data kategori kasus: {$kategori->nama_kategori}",
            'kategori_kasus',
            $kategori->id
        );

        return redirect()
            ->route('admin.kategori-kasus.index')
            ->with('success', "Kategori kasus \"{$kategori->nama_kategori}\" berhasil diperbarui.");
    }

    /**
     * Mengubah status aktif / nonaktif kategori kasus.
     */
    public function toggleStatus(Request $request, int $id)
    {
        $user = $request->user();
        $kategori = KategoriKasus::findOrFail($id);

        $kategori->is_active = ! $kategori->is_active;
        $kategori->save();

        $statusText = $kategori->is_active ? 'diaktifkan' : 'dinonaktifkan';

        AuditLogger::record(
            $request,
            $user,
            'toggle_status_kategori_kasus',
            "Mengubah status kategori kasus {$kategori->nama_kategori} menjadi {$statusText}",
            'kategori_kasus',
            $kategori->id
        );

        return redirect()
            ->route('admin.kategori-kasus.index')
            ->with('success', "Kategori kasus \"{$kategori->nama_kategori}\" berhasil {$statusText}.");
    }

    /**
     * Menghapus kategori kasus jika belum pernah digunakan pada laporan kasus.
     */
    public function destroy(Request $request, int $id)
    {
        $user = $request->user();
        $kategori = KategoriKasus::findOrFail($id);

        $terpakai = DB::table('laporan_kasus')->where('kategori_id', $id)->count();

        if ($terpakai > 0) {
            return redirect()
                ->route('admin.kategori-kasus.index')
                ->with('error', "Kategori \"{$kategori->nama_kategori}\" tidak dapat dihapus karena sudah tercatat dalam {$terpakai} laporan kasus siswa. Anda dapat menonaktifkan statusnya agar tidak dipilih lagi pada formulir pelaporan baru.");
        }

        $nama = $kategori->nama_kategori;
        $kategori->delete();

        AuditLogger::record(
            $request,
            $user,
            'delete_kategori_kasus',
            "Menghapus master data kategori kasus: {$nama}",
            'kategori_kasus',
            $id
        );

        return redirect()
            ->route('admin.kategori-kasus.index')
            ->with('success', "Kategori kasus \"{$nama}\" berhasil dihapus.");
    }
}
