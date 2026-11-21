<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LayananRujukan;
use App\Support\AuditLogger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class MitraRujukanController extends Controller
{
    /**
     * Menampilkan daftar master data mitra rujukan eksternal.
     */
    public function index(Request $request)
    {
        $q = trim((string) $request->get('q', ''));
        $jenis = trim((string) $request->get('jenis', ''));
        $status = trim((string) $request->get('status', ''));

        $query = DB::table('layanan_rujukan as lr')
            ->select([
                'lr.id',
                'lr.nama_layanan',
                'lr.jenis_layanan',
                'lr.kontak',
                'lr.alamat_url',
                'lr.is_active',
                'lr.created_at',
                'lr.updated_at',
                DB::raw('(SELECT COUNT(*) FROM rujukan r WHERE r.layanan_id = lr.id) as total_rujukan'),
            ]);

        if ($q !== '') {
            $query->where(function ($sub) use ($q) {
                $sub->where('lr.nama_layanan', 'like', "%{$q}%")
                    ->orWhere('lr.kontak', 'like', "%{$q}%")
                    ->orWhere('lr.alamat_url', 'like', "%{$q}%");
            });
        }

        $jenisValid = array_keys(LayananRujukan::jenisLabels());
        if ($jenis !== '' && in_array($jenis, $jenisValid, true)) {
            $query->where('lr.jenis_layanan', $jenis);
        }

        if ($status === 'aktif') {
            $query->where('lr.is_active', true);
        } elseif ($status === 'nonaktif') {
            $query->where('lr.is_active', false);
        }

        $mitraList = $query
            ->orderByDesc('lr.is_active')
            ->orderBy('lr.nama_layanan')
            ->paginate(10)
            ->withQueryString();

        $ringkasan = [
            'total' => DB::table('layanan_rujukan')->count(),
            'aktif' => DB::table('layanan_rujukan')->where('is_active', true)->count(),
            'nonaktif' => DB::table('layanan_rujukan')->where('is_active', false)->count(),
            'total_rujukan' => DB::table('rujukan')->count(),
        ];

        return view('admin.mitra-rujukan.index', [
            'user' => $request->user(),
            'mitraList' => $mitraList,
            'ringkasan' => $ringkasan,
            'jenisLabels' => LayananRujukan::jenisLabels(),
            'search' => $q,
            'selectedJenis' => $jenis,
            'selectedStatus' => $status,
        ]);
    }

    /**
     * Menyimpan mitra rujukan baru.
     */
    public function store(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'nama_layanan' => ['required', 'string', 'max:255'],
            'jenis_layanan' => [
                'required',
                'string',
                Rule::in(array_keys(LayananRujukan::jenisLabels())),
            ],
            'kontak' => ['nullable', 'string', 'max:150'],
            'alamat_url' => ['nullable', 'string', 'max:1000'],
            'is_active' => ['nullable', 'boolean'],
        ], [
            'nama_layanan.required' => 'Nama instansi / mitra rujukan wajib diisi.',
            'jenis_layanan.required' => 'Pilih jenis layanan rujukan.',
            'jenis_layanan.in' => 'Jenis layanan rujukan tidak valid.',
        ]);

        $mitra = LayananRujukan::create([
            'nama_layanan' => trim($validated['nama_layanan']),
            'jenis_layanan' => $validated['jenis_layanan'],
            'kontak' => isset($validated['kontak']) ? trim($validated['kontak']) : null,
            'alamat_url' => isset($validated['alamat_url']) ? trim($validated['alamat_url']) : null,
            'is_active' => $request->boolean('is_active', true),
        ]);

        AuditLogger::record(
            $request,
            $user,
            'create_mitra_rujukan',
            "Menambahkan mitra rujukan baru: {$mitra->nama_layanan}",
            'layanan_rujukan',
            $mitra->id
        );

        return redirect()
            ->route('admin.mitra-rujukan.index')
            ->with('success', "Mitra rujukan \"{$mitra->nama_layanan}\" berhasil ditambahkan.");
    }

    /**
     * Memperbarui data mitra rujukan.
     */
    public function update(Request $request, int $id)
    {
        $user = $request->user();
        $mitra = LayananRujukan::findOrFail($id);

        $validated = $request->validate([
            'nama_layanan' => ['required', 'string', 'max:255'],
            'jenis_layanan' => [
                'required',
                'string',
                Rule::in(array_keys(LayananRujukan::jenisLabels())),
            ],
            'kontak' => ['nullable', 'string', 'max:150'],
            'alamat_url' => ['nullable', 'string', 'max:1000'],
            'is_active' => ['nullable', 'boolean'],
        ], [
            'nama_layanan.required' => 'Nama instansi / mitra rujukan wajib diisi.',
            'jenis_layanan.required' => 'Pilih jenis layanan rujukan.',
            'jenis_layanan.in' => 'Jenis layanan rujukan tidak valid.',
        ]);

        $mitra->update([
            'nama_layanan' => trim($validated['nama_layanan']),
            'jenis_layanan' => $validated['jenis_layanan'],
            'kontak' => isset($validated['kontak']) ? trim($validated['kontak']) : null,
            'alamat_url' => isset($validated['alamat_url']) ? trim($validated['alamat_url']) : null,
            'is_active' => $request->boolean('is_active', true),
        ]);

        AuditLogger::record(
            $request,
            $user,
            'update_mitra_rujukan',
            "Memperbarui data mitra rujukan: {$mitra->nama_layanan}",
            'layanan_rujukan',
            $mitra->id
        );

        return redirect()
            ->route('admin.mitra-rujukan.index')
            ->with('success', "Data mitra rujukan \"{$mitra->nama_layanan}\" berhasil diperbarui.");
    }

    /**
     * Mengubah status aktif / nonaktif mitra rujukan.
     */
    public function toggleStatus(Request $request, int $id)
    {
        $user = $request->user();
        $mitra = LayananRujukan::findOrFail($id);

        $mitra->is_active = ! $mitra->is_active;
        $mitra->save();

        $statusText = $mitra->is_active ? 'diaktifkan' : 'dinonaktifkan';

        AuditLogger::record(
            $request,
            $user,
            'toggle_status_mitra_rujukan',
            "Mengubah status mitra rujukan {$mitra->nama_layanan} menjadi {$statusText}",
            'layanan_rujukan',
            $mitra->id
        );

        return redirect()
            ->route('admin.mitra-rujukan.index')
            ->with('success', "Mitra rujukan \"{$mitra->nama_layanan}\" berhasil {$statusText}.");
    }

    /**
     * Menghapus mitra rujukan jika belum pernah dipakai pada data rujukan siswa.
     */
    public function destroy(Request $request, int $id)
    {
        $user = $request->user();
        $mitra = LayananRujukan::findOrFail($id);

        $terpakai = DB::table('rujukan')->where('layanan_id', $id)->count();

        if ($terpakai > 0) {
            return redirect()
                ->route('admin.mitra-rujukan.index')
                ->with('error', "Mitra \"{$mitra->nama_layanan}\" tidak dapat dihapus karena sudah memiliki {$terpakai} riwayat rujukan siswa. Anda dapat menonaktifkan statusnya agar tidak dipilih lagi oleh Guru BK.");
        }

        $nama = $mitra->nama_layanan;
        $mitra->delete();

        AuditLogger::record(
            $request,
            $user,
            'delete_mitra_rujukan',
            "Menghapus master data mitra rujukan: {$nama}",
            'layanan_rujukan',
            $id
        );

        return redirect()
            ->route('admin.mitra-rujukan.index')
            ->with('success', "Mitra rujukan \"{$nama}\" berhasil dihapus.");
    }
}
