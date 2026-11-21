<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\BuktiLaporan;
use App\Models\KategoriKasus;
use App\Models\LaporanKasus;
use App\Models\PengaturanSistem;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LaporanController extends Controller
{
    public function show(LaporanKasus $laporan)
    {
        $siswa = auth()->user()->siswa;

        if (! $siswa || $laporan->siswa_id !== $siswa->id) {
            abort(403);
        }

        $laporan->load([
            'kategori',
            'bukti',
        ]);

        return view(
            'siswa.laporan.show',
            compact('laporan')
        );
    }

    public function submit(LaporanKasus $laporan)
    {
        $siswa = auth()->user()->siswa;

        if (! $siswa || $laporan->siswa_id !== $siswa->id) {
            abort(403);
        }

        if ($laporan->status_kasus !== 'draft') {
            return back()->with(
                'error',
                'Laporan ini sudah pernah dikirim.'
            );
        }

        if ($this->hasReachedUnprocessedLimit($siswa)) {
            return back()->with(
                'error',
                'Kamu sudah memiliki 2 laporan masuk yang belum diproses oleh Guru BK. Kamu baru dapat mengirim laporan lagi setelah salah satu laporan sebelumnya mulai diproses.'
            );
        }

        $snapshotAkademik = $this->getSnapshotAkademik($siswa);

        $laporan->update([
            'status_kasus' => 'baru',
            'submitted_at' => now(),

            'kelas_id_saat_laporan' =>
                $snapshotAkademik['kelas_id_saat_laporan'],

            'nama_kelas_saat_laporan' =>
                $snapshotAkademik['nama_kelas_saat_laporan'],

            'tingkat_saat_laporan' =>
                $snapshotAkademik['tingkat_saat_laporan'],

            'tahun_ajaran' =>
                $snapshotAkademik['tahun_ajaran'],

            'semester' =>
                $snapshotAkademik['semester'],
        ]);

        return redirect()
            ->route(
                'siswa.laporan.show',
                $laporan
            )
            ->with(
                'success',
                'Laporan berhasil dikirim kepada Guru BK.'
            );
    }

    public function index()
    {
        $siswa = auth()->user()->siswa;

        if (! $siswa) {
            abort(
                403,
                'Data siswa tidak ditemukan.'
            );
        }

        $laporan = LaporanKasus::with('kategori')
            ->where(
                'siswa_id',
                $siswa->id
            )
            ->orderByRaw(
                'COALESCE(submitted_at, created_at) DESC'
            )
            ->paginate(10);

        return view(
            'siswa.laporan.index',
            compact('laporan')
        );
    }

    public function create()
    {
        $siswa = auth()->user()?->siswa;

        if ($siswa && $this->hasReachedUnprocessedLimit($siswa)) {
            return redirect()
                ->route('siswa.laporan.index')
                ->with(
                    'error',
                    'Kamu sudah memiliki 2 laporan masuk yang sedang menunggu diproses oleh Guru BK. Kamu baru dapat membuat/mengirim laporan baru setelah laporan sebelumnya mulai ditindaklanjuti.'
                );
        }

        $kategori = KategoriKasus::where(
            'is_active',
            true
        )
            ->orderBy('id')
            ->get();

        return view(
            'siswa.laporan.create',
            compact('kategori')
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategori_id' => [
                'required',
                'exists:kategori_kasus,id',
            ],

            'tanggal_kejadian' => [
                'required',
                'date',
            ],

            'lokasi_kejadian' => [
                'nullable',
                'string',
                'max:255',
            ],

            'deskripsi' => [
                'required',
                'string',
            ],

            'status_rahasia' => [
                'required',
                'boolean',
            ],

            'action' => [
                'required',
                'in:draft,submit',
            ],

            'bukti' => [
                'nullable',
                'array',
            ],

            'bukti.*' => [
                'file',
                'mimes:jpg,jpeg,png,pdf',
                'max:5120',
            ],
        ]);

        $siswa = $request->user()->siswa;

        if (! $siswa) {
            abort(
                403,
                'Data siswa tidak ditemukan.'
            );
        }

        if ($this->hasReachedUnprocessedLimit($siswa)) {
            return redirect()
                ->route('siswa.laporan.index')
                ->with(
                    'error',
                    'Kamu sudah memiliki 2 laporan masuk yang sedang menunggu diproses oleh Guru BK. Kamu baru dapat mengirim laporan baru setelah salah satu laporan sebelumnya mulai diproses.'
                );
        }

        $status = $validated['action'] === 'submit'
            ? 'baru'
            : 'draft';

        $snapshotAkademik = $status === 'baru'
            ? $this->getSnapshotAkademik($siswa)
            : [
                'kelas_id_saat_laporan' => null,
                'nama_kelas_saat_laporan' => null,
                'tingkat_saat_laporan' => null,
                'tahun_ajaran' => null,
                'semester' => null,
            ];

        $laporan = LaporanKasus::create([
            'kode_laporan' =>
                'CRH-' . strtoupper(
                    substr(
                        uniqid(),
                        -6
                    )
                ),

            'siswa_id' =>
                $siswa->id,

            'kelas_id_saat_laporan' =>
                $snapshotAkademik['kelas_id_saat_laporan'],

            'nama_kelas_saat_laporan' =>
                $snapshotAkademik['nama_kelas_saat_laporan'],

            'tingkat_saat_laporan' =>
                $snapshotAkademik['tingkat_saat_laporan'],

            'tahun_ajaran' =>
                $snapshotAkademik['tahun_ajaran'],

            'semester' =>
                $snapshotAkademik['semester'],

            'kategori_id' =>
                $validated['kategori_id'],

            'tanggal_kejadian' =>
                $validated['tanggal_kejadian'],

            'lokasi_kejadian' =>
                $validated['lokasi_kejadian'] ?? null,

            'deskripsi' =>
                $validated['deskripsi'],

            'status_rahasia' =>
                $validated['status_rahasia'],

            'status_kasus' =>
                $status,

            'submitted_at' =>
                $status === 'baru'
                    ? now()
                    : null,
        ]);

        if ($request->hasFile('bukti')) {
            foreach (
                $request->file('bukti')
                as $file
            ) {
                $path = $file->store(
                    'bukti-laporan',
                    'public'
                );

                BuktiLaporan::create([
                    'laporan_id' =>
                        $laporan->id,

                    'file_path' =>
                        $path,

                    'original_name' =>
                        $file->getClientOriginalName(),

                    'mime_type' =>
                        $file->getMimeType(),

                    'file_size' =>
                        $file->getSize(),

                    'jenis_bukti' =>
                        str_starts_with(
                            $file->getMimeType(),
                            'image/'
                        )
                            ? 'gambar'
                            : 'dokumen',
                ]);
            }
        }

        return redirect()
            ->route('siswa.dashboard')
            ->with(
                'success',
                $status === 'draft'
                    ? 'Laporan berhasil disimpan sebagai draft.'
                    : 'Laporan berhasil dikirim.'
            );
    }

    public function edit(LaporanKasus $laporan)
    {
        $siswa = auth()->user()->siswa;

        if (! $siswa || $laporan->siswa_id !== $siswa->id) {
            abort(403);
        }

        if ($laporan->status_kasus !== 'draft') {
            return redirect()->route('siswa.laporan.show', $laporan)
                ->with('error', 'Hanya laporan draft yang dapat diedit.');
        }

        $laporan->load('bukti');
        $kategori = KategoriKasus::where('is_active', true)->orderBy('id')->get();

        return view('siswa.laporan.edit', compact('laporan', 'kategori'));
    }

    public function update(Request $request, LaporanKasus $laporan)
    {
        $siswa = $request->user()->siswa;

        if (! $siswa || $laporan->siswa_id !== $siswa->id) {
            abort(403);
        }

        if ($laporan->status_kasus !== 'draft') {
            return redirect()->route('siswa.laporan.show', $laporan)
                ->with('error', 'Hanya laporan draft yang dapat diedit.');
        }

        $validated = $request->validate([
            'kategori_id' => [
                'required',
                'exists:kategori_kasus,id',
            ],
            'tanggal_kejadian' => [
                'required',
                'date',
            ],
            'lokasi_kejadian' => [
                'nullable',
                'string',
                'max:255',
            ],
            'deskripsi' => [
                'required',
                'string',
            ],
            'status_rahasia' => [
                'required',
                'boolean',
            ],
            'action' => [
                'required',
                'in:draft,submit',
            ],
            'bukti' => [
                'nullable',
                'array',
            ],
            'bukti.*' => [
                'file',
                'mimes:jpg,jpeg,png,pdf',
                'max:5120',
            ],
        ]);

        $status = $validated['action'] === 'submit' ? 'baru' : 'draft';

        if ($status === 'baru' && $this->hasReachedUnprocessedLimit($siswa)) {
            return back()
                ->withInput()
                ->with(
                    'error',
                    'Kamu sudah memiliki 2 laporan masuk yang belum diproses oleh Guru BK. Tunggu hingga salah satu laporanmu diproses sebelum mengirim laporan lagi.'
                );
        }

        $snapshotAkademik = $status === 'baru'
            ? $this->getSnapshotAkademik($siswa)
            : [
                'kelas_id_saat_laporan' => $laporan->kelas_id_saat_laporan,
                'nama_kelas_saat_laporan' => $laporan->nama_kelas_saat_laporan,
                'tingkat_saat_laporan' => $laporan->tingkat_saat_laporan,
                'tahun_ajaran' => $laporan->tahun_ajaran,
                'semester' => $laporan->semester,
            ];

        $laporan->update([
            'kategori_id' => $validated['kategori_id'],
            'tanggal_kejadian' => $validated['tanggal_kejadian'],
            'lokasi_kejadian' => $validated['lokasi_kejadian'] ?? null,
            'deskripsi' => $validated['deskripsi'],
            'status_rahasia' => $validated['status_rahasia'],
            'status_kasus' => $status,
            'submitted_at' => $status === 'baru' ? now() : null,
            'kelas_id_saat_laporan' => $snapshotAkademik['kelas_id_saat_laporan'],
            'nama_kelas_saat_laporan' => $snapshotAkademik['nama_kelas_saat_laporan'],
            'tingkat_saat_laporan' => $snapshotAkademik['tingkat_saat_laporan'],
            'tahun_ajaran' => $snapshotAkademik['tahun_ajaran'],
            'semester' => $snapshotAkademik['semester'],
        ]);

        if ($request->hasFile('bukti')) {
            foreach ($request->file('bukti') as $file) {
                $path = $file->store('bukti-laporan', 'public');

                BuktiLaporan::create([
                    'laporan_id' => $laporan->id,
                    'file_path' => $path,
                    'original_name' => $file->getClientOriginalName(),
                    'mime_type' => $file->getMimeType(),
                    'file_size' => $file->getSize(),
                    'jenis_bukti' => str_starts_with($file->getMimeType(), 'image/') ? 'gambar' : 'dokumen',
                ]);
            }
        }

        return redirect()
            ->route($status === 'baru' ? 'siswa.dashboard' : 'siswa.laporan.show', $status === 'baru' ? [] : $laporan)
            ->with(
                'success',
                $status === 'draft' ? 'Draft laporan berhasil diperbarui.' : 'Laporan berhasil dikirim.'
            );
    }

    public function destroyBukti(BuktiLaporan $bukti)
    {
        $laporan = $bukti->laporan;
        $siswa = auth()->user()->siswa;

        if (! $siswa || $laporan->siswa_id !== $siswa->id || $laporan->status_kasus !== 'draft') {
            abort(403);
        }

        if (Storage::disk('public')->exists($bukti->file_path)) {
            Storage::disk('public')->delete($bukti->file_path);
        }

        $bukti->delete();

        return back()->with('success', 'File bukti berhasil dihapus.');
    }

    private function hasReachedUnprocessedLimit(Siswa $siswa): bool
    {
        return LaporanKasus::where('siswa_id', $siswa->id)
            ->where('status_kasus', 'baru')
            ->count() >= 2;
    }

    private function getSnapshotAkademik(Siswa $siswa): array
    {
        $siswa->loadMissing('kelas');

        $pengaturan = PengaturanSistem::current();

        return [
            'kelas_id_saat_laporan' =>
                $siswa->kelas_id,

            'nama_kelas_saat_laporan' =>
                $siswa->kelas?->nama_kelas,

            'tingkat_saat_laporan' =>
                $siswa->kelas?->tingkat,

            'tahun_ajaran' =>
                $pengaturan->tahun_ajaran_aktif,

            'semester' =>
                $pengaturan->semester_aktif,
        ];
    }
}
