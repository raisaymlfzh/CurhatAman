<?php

namespace App\Http\Controllers\GuruBK;

use App\Http\Controllers\Controller;
use App\Models\CatatanKonseling;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class CatatanKonselingController extends Controller
{
    public const JENIS_LAYANAN = [
        'Konseling Individu',
        'Bimbingan Karir',
        'Bimbingan Belajar',
        'Mediasi Kasus',
        'Kunjungan Rumah',
        'Konsultasi Orang Tua',
        'Lainnya',
    ];

    private function authorizeCounselor(Request $request): void
    {
        abort_unless(
            $request->user() && $request->user()->role === 'counselor',
            403,
            'Kamu tidak memiliki akses ke halaman Guru BK.'
        );
    }

    public function index(Request $request)
    {
        $this->authorizeCounselor($request);

        $user = $request->user();
        $search = trim((string) $request->query('q', ''));
        $jenisLayanan = trim((string) $request->query('jenis_layanan', ''));
        $kelasId = trim((string) $request->query('kelas_id', ''));
        $siswaId = trim((string) $request->query('siswa_id', ''));
        $tanggalDari = trim((string) $request->query('tanggal_dari', ''));
        $tanggalSampai = trim((string) $request->query('tanggal_sampai', ''));

        $query = $this->buildRekapQuery($request);

        $catatanList = $query
            ->orderByDesc('catatan_konseling.tanggal_pertemuan')
            ->orderByDesc('catatan_konseling.id')
            ->paginate(10)
            ->withQueryString();

        // Ringkasan metrik statistik
        $totalSesi = DB::table('catatan_konseling')->count();
        $sesiBulanIni = DB::table('catatan_konseling')
            ->whereBetween('tanggal_pertemuan', [
                Carbon::now()->startOfMonth()->toDateString(),
                Carbon::now()->endOfMonth()->toDateString(),
            ])
            ->count();
        $siswaDidampingi = DB::table('catatan_konseling')->distinct('siswa_id')->count('siswa_id');
        $layananPopuler = DB::table('catatan_konseling')
            ->select('jenis_layanan', DB::raw('count(*) as total'))
            ->groupBy('jenis_layanan')
            ->orderByDesc('total')
            ->first();

        $kelasList = DB::table('kelas')
            ->orderBy('tingkat')
            ->orderBy('nama_kelas')
            ->select('id', 'nama_kelas', 'tingkat')
            ->get();

        $filterSiswa = null;
        if ($siswaId !== '' && ctype_digit($siswaId)) {
            $filterSiswa = DB::table('siswa')
                ->join('users', 'siswa.user_id', '=', 'users.id')
                ->where('siswa.id', (int) $siswaId)
                ->select('siswa.id', 'users.name as nama_siswa', 'siswa.nis')
                ->first();
        }

        $viewMode = $request->query('view', 'sesi') === 'siswa' ? 'siswa' : 'sesi';

        $siswaGrouped = null;
        if ($viewMode === 'siswa') {
            $siswaQuery = DB::table('siswa')
                ->join('users', 'siswa.user_id', '=', 'users.id')
                ->leftJoin('kelas', 'siswa.kelas_id', '=', 'kelas.id')
                ->join('catatan_konseling', 'siswa.id', '=', 'catatan_konseling.siswa_id')
                ->select([
                    'siswa.id',
                    'users.name as nama_siswa',
                    'siswa.nis',
                    'kelas.nama_kelas',
                    DB::raw('count(catatan_konseling.id) as total_sesi'),
                    DB::raw('max(catatan_konseling.tanggal_pertemuan) as sesi_terakhir'),
                ])
                ->groupBy('siswa.id', 'users.name', 'siswa.nis', 'kelas.nama_kelas');

            if ($search !== '') {
                $siswaQuery->where(function ($sub) use ($search) {
                    $sub->where('users.name', 'like', "%{$search}%")
                        ->orWhere('siswa.nis', 'like', "%{$search}%");
                });
            }

            if ($kelasId !== '' && ctype_digit($kelasId)) {
                $siswaQuery->where('siswa.kelas_id', (int) $kelasId);
            }

            $siswaGrouped = $siswaQuery
                ->orderByDesc('sesi_terakhir')
                ->paginate(10)
                ->withQueryString();
        }

        return view('guru-bk.catatan-konseling.index', [
            'user' => $user,
            'catatanList' => $catatanList,
            'siswaGrouped' => $siswaGrouped,
            'viewMode' => $viewMode,
            'totalSesi' => $totalSesi,
            'sesiBulanIni' => $sesiBulanIni,
            'siswaDidampingi' => $siswaDidampingi,
            'layananPopuler' => $layananPopuler ? $layananPopuler->jenis_layanan : 'Belum Ada',
            'kelasList' => $kelasList,
            'jenisLayananList' => self::JENIS_LAYANAN,
            'filterSiswa' => $filterSiswa,
            'filters' => [
                'q' => $search,
                'view' => $viewMode,
                'jenis_layanan' => $jenisLayanan,
                'kelas_id' => $kelasId,
                'siswa_id' => $siswaId,
                'tanggal_dari' => $tanggalDari,
                'tanggal_sampai' => $tanggalSampai,
            ],
        ]);
    }

    public function create(Request $request)
    {
        $this->authorizeCounselor($request);

        $user = $request->user();
        $siswaId = $request->query('siswa_id');
        $laporanId = $request->query('laporan_id');
        $bantuanId = $request->query('bantuan_id');

        $linkedLaporan = null;
        if ($laporanId && ctype_digit((string) $laporanId)) {
            $linkedLaporan = DB::table('laporan_kasus')
                ->leftJoin('users as assigned_bk', 'laporan_kasus.assigned_bk_id', '=', 'assigned_bk.id')
                ->where('laporan_kasus.id', (int) $laporanId)
                ->first([
                    'laporan_kasus.id',
                    'laporan_kasus.kode_laporan',
                    'laporan_kasus.siswa_id',
                    'laporan_kasus.deskripsi',
                    'laporan_kasus.assigned_bk_id',
                    'assigned_bk.name as nama_bk_penanggung_jawab',
                ]);

            if ($linkedLaporan) {
                // Aturan 1: Laporan harus sudah memiliki penanggung jawab
                if (is_null($linkedLaporan->assigned_bk_id)) {
                    return redirect()->route('guru-bk.laporan.show', $linkedLaporan->id)
                        ->withErrors(['assignment' => 'Ambil penanganan laporan terlebih dahulu pada panel kanan sebelum membuat catatan konseling.']);
                }

                // Aturan 2: Hanya Guru BK penanggung jawab yang berwenang
                if ((int) $linkedLaporan->assigned_bk_id !== (int) $user->id) {
                    return redirect()->route('guru-bk.laporan.show', $linkedLaporan->id)
                        ->withErrors(['assignment' => 'Laporan ini ditangani oleh ' . ($linkedLaporan->nama_bk_penanggung_jawab ?? 'Guru BK lain') . '. Catatan konseling untuk kasus ini hanya dapat dibuat oleh penanggung jawab.']);
                }

                // Aturan 3: Harus memenuhi deklarasi bebas konflik kepentingan
                $konflik = DB::table('konflik_kepentingan')
                    ->where('laporan_id', $linkedLaporan->id)
                    ->where('user_id', $user->id)
                    ->first();

                if (! $konflik || (bool) $konflik->ada_konflik) {
                    return redirect()->route('guru-bk.laporan.show', $linkedLaporan->id)
                        ->withErrors(['assignment' => 'Deklarasi konflik kepentingan belum terpenuhi. Selesaikan deklarasi bebas konflik pada panel kanan terlebih dahulu.']);
                }

                if (! $siswaId) {
                    $siswaId = $linkedLaporan->siswa_id;
                }
            }
        }

        $linkedBantuan = null;
        if ($bantuanId && ctype_digit((string) $bantuanId)) {
            $linkedBantuan = DB::table('permintaan_bantuan')
                ->leftJoin('users as assigned_bk', 'permintaan_bantuan.assigned_bk_id', '=', 'assigned_bk.id')
                ->where('permintaan_bantuan.id', (int) $bantuanId)
                ->first([
                    'permintaan_bantuan.id',
                    'permintaan_bantuan.siswa_id',
                    'permintaan_bantuan.jenis_bantuan',
                    'permintaan_bantuan.pesan',
                    'permintaan_bantuan.assigned_bk_id',
                    'assigned_bk.name as nama_bk_penanggung_jawab',
                ]);

            if ($linkedBantuan) {
                // Aturan: Jika sudah ada penanggung jawab, hanya penanggung jawab yang boleh menindaklanjuti
                if (! is_null($linkedBantuan->assigned_bk_id) && (int) $linkedBantuan->assigned_bk_id !== (int) $user->id) {
                    return redirect()->route('guru-bk.bantuan.show', $linkedBantuan->id)
                        ->withErrors(['status' => 'Permintaan bantuan ini sedang ditangani oleh ' . ($linkedBantuan->nama_bk_penanggung_jawab ?? 'Guru BK lain') . '.']);
                }

                if (! $siswaId) {
                    $siswaId = $linkedBantuan->siswa_id;
                }
            }
        }

        $kelasList = DB::table('kelas')
            ->orderBy('tingkat')
            ->orderBy('nama_kelas')
            ->select('id', 'nama_kelas', 'tingkat')
            ->get();

        $siswaList = DB::table('siswa')
            ->join('users', 'siswa.user_id', '=', 'users.id')
            ->leftJoin('kelas', 'siswa.kelas_id', '=', 'kelas.id')
            ->select([
                'siswa.id',
                'users.name as nama_siswa',
                'siswa.nis',
                'siswa.kelas_id',
                'kelas.nama_kelas',
            ])
            ->orderBy('users.name')
            ->get();

        return view('guru-bk.catatan-konseling.create', [
            'user' => $user,
            'kelasList' => $kelasList,
            'siswaList' => $siswaList,
            'selectedSiswaId' => $siswaId,
            'linkedLaporan' => $linkedLaporan,
            'linkedBantuan' => $linkedBantuan,
            'jenisLayananList' => self::JENIS_LAYANAN,
        ]);
    }

    public function store(Request $request)
    {
        $this->authorizeCounselor($request);

        $validated = $request->validate([
            'siswa_id' => ['required', 'integer', 'exists:siswa,id'],
            'tanggal_pertemuan' => ['required', 'date', 'before_or_equal:today'],
            'jenis_layanan' => ['required', Rule::in(self::JENIS_LAYANAN)],
            'topik' => ['required', 'string', 'max:255'],
            'isi_catatan' => ['required', 'string'],
            'hasil_kesepakatan' => ['nullable', 'string'],
            'tindak_lanjut' => ['nullable', 'string'],
            'is_rahasia' => ['nullable', 'boolean'],
            'is_shared_wali_kelas' => ['nullable', 'boolean'],
            'arahan_wali_kelas' => ['nullable', 'string'],
            'laporan_id' => ['nullable', 'integer', 'exists:laporan_kasus,id'],
            'bantuan_id' => ['nullable', 'integer', 'exists:permintaan_bantuan,id'],
        ], [
            'siswa_id.required' => 'Pilih siswa yang mengikuti sesi konseling.',
            'siswa_id.exists' => 'Data siswa tidak valid.',
            'tanggal_pertemuan.required' => 'Tanggal pertemuan wajib diisi.',
            'tanggal_pertemuan.before_or_equal' => 'Tanggal pertemuan tidak boleh di masa depan.',
            'jenis_layanan.required' => 'Pilih jenis layanan bimbingan konseling.',
            'topik.required' => 'Topik bimbingan / konseling wajib diisi.',
            'isi_catatan.required' => 'Isi catatan proses konseling wajib diisi.',
        ]);

        $isRahasia = $request->has('is_rahasia');
        $isSharedWali = ! $isRahasia;
        $arahanWali = ! $isRahasia && isset($validated['arahan_wali_kelas']) && trim($validated['arahan_wali_kelas']) !== ''
            ? trim($validated['arahan_wali_kelas'])
            : null;

        // Validasi Otorisasi & Logika Wewenang Laporan Kasus
        if (! empty($validated['laporan_id'])) {
            $laporan = DB::table('laporan_kasus')
                ->where('id', (int) $validated['laporan_id'])
                ->first();

            abort_unless($laporan, 404, 'Laporan kasus tidak ditemukan.');

            if (is_null($laporan->assigned_bk_id)) {
                return back()
                    ->withInput()
                    ->withErrors(['topik' => 'Laporan kasus #' . $laporan->kode_laporan . ' belum memiliki penanggung jawab. Ambil penanganan terlebih dahulu.']);
            }

            if ((int) $laporan->assigned_bk_id !== (int) $request->user()->id) {
                abort(403, 'Anda bukan Guru BK penanggung jawab untuk laporan kasus ini.');
            }

            $konflik = DB::table('konflik_kepentingan')
                ->where('laporan_id', $laporan->id)
                ->where('user_id', $request->user()->id)
                ->first();

            if (! $konflik || (bool) $konflik->ada_konflik) {
                return back()
                    ->withInput()
                    ->withErrors(['topik' => 'Deklarasi konflik kepentingan belum terpenuhi untuk laporan kasus ini.']);
            }
        }

        // Validasi Otorisasi & Logika Wewenang Permintaan Bantuan
        if (! empty($validated['bantuan_id'])) {
            $bantuan = DB::table('permintaan_bantuan')
                ->where('id', (int) $validated['bantuan_id'])
                ->first();

            abort_unless($bantuan, 404, 'Permintaan bantuan tidak ditemukan.');

            if (! is_null($bantuan->assigned_bk_id) && (int) $bantuan->assigned_bk_id !== (int) $request->user()->id) {
                abort(403, 'Permintaan bantuan ini sedang ditangani oleh Guru BK lain.');
            }
        }

        // Cegah duplikasi jika form terkirim ganda (double-submit) dalam rentang waktu singkat
        $existingDuplicate = CatatanKonseling::where('siswa_id', $validated['siswa_id'])
            ->where('guru_bk_id', $request->user()->id)
            ->where('tanggal_pertemuan', $validated['tanggal_pertemuan'])
            ->where('jenis_layanan', $validated['jenis_layanan'])
            ->where('topik', trim($validated['topik']))
            ->where('created_at', '>=', now()->subSeconds(10))
            ->first();

        if ($existingDuplicate) {
            return redirect()
                ->route('guru-bk.catatan-konseling.show', $existingDuplicate->id)
                ->with('success', 'Catatan konseling berhasil didokumentasikan ke dalam jurnal.');
        }

        $catatan = CatatanKonseling::create([
            'siswa_id' => $validated['siswa_id'],
            'guru_bk_id' => $request->user()->id,
            'laporan_id' => $validated['laporan_id'] ?? null,
            'bantuan_id' => $validated['bantuan_id'] ?? null,
            'tanggal_pertemuan' => $validated['tanggal_pertemuan'],
            'jenis_layanan' => $validated['jenis_layanan'],
            'topik' => trim($validated['topik']),
            'isi_catatan' => trim($validated['isi_catatan']),
            'hasil_kesepakatan' => isset($validated['hasil_kesepakatan']) && trim($validated['hasil_kesepakatan']) !== ''
                ? trim($validated['hasil_kesepakatan'])
                : null,
            'tindak_lanjut' => isset($validated['tindak_lanjut']) && trim($validated['tindak_lanjut']) !== ''
                ? trim($validated['tindak_lanjut'])
                : null,
            'is_rahasia' => $isRahasia,
            'is_shared_wali_kelas' => $isSharedWali,
            'arahan_wali_kelas' => $arahanWali,
        ]);

        $feedbackMsg = 'Catatan konseling berhasil didokumentasikan ke dalam jurnal.';

        // Otomasi 1: Sinkronisasi Permintaan Bantuan
        if (! empty($validated['bantuan_id'])) {
            $bantuan = DB::table('permintaan_bantuan')
                ->where('id', (int) $validated['bantuan_id'])
                ->first();

            if ($bantuan) {
                $updateData = ['updated_at' => now()];
                if ($bantuan->status === 'baru') {
                    $updateData['status'] = 'diproses';
                }
                if (is_null($bantuan->assigned_bk_id)) {
                    $updateData['assigned_bk_id'] = $request->user()->id;
                }
                DB::table('permintaan_bantuan')
                    ->where('id', (int) $validated['bantuan_id'])
                    ->update($updateData);

                // Buat notifikasi untuk siswa
                $siswaUserId = DB::table('siswa')
                    ->where('id', $bantuan->siswa_id)
                    ->value('user_id');

                if ($siswaUserId) {
                    DB::table('notifikasi')->insert([
                        'user_id' => $siswaUserId,
                        'tipe' => 'bantuan_diproses',
                        'judul' => 'Permintaan Bantuan Sedang Ditindaklanjuti',
                        'pesan' => 'Guru BK telah mencatat sesi konseling tindak lanjut untuk permintaan bantuanmu.',
                        'referensi_tipe' => 'permintaan_bantuan',
                        'referensi_id' => $bantuan->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }

                $feedbackMsg .= ' Status permintaan bantuan otomatis diperbarui menjadi Diproses.';
            }
        }

        // Otomasi 2: Sinkronisasi Laporan Kasus & Riwayat Tindak Lanjut
        if (! empty($validated['laporan_id'])) {
            $laporan = DB::table('laporan_kasus')
                ->where('id', (int) $validated['laporan_id'])
                ->first();

            if ($laporan) {
                // Update status laporan kasus jika masih 'baru'
                $updateLaporan = ['updated_at' => now()];
                if ($laporan->status_kasus === 'baru') {
                    $updateLaporan['status_kasus'] = 'diproses';
                }
                if (is_null($laporan->assigned_bk_id)) {
                    $updateLaporan['assigned_bk_id'] = $request->user()->id;
                }
                DB::table('laporan_kasus')
                    ->where('id', (int) $validated['laporan_id'])
                    ->update($updateLaporan);

                // Otomatis masukkan log ke tabel tindak_lanjut laporan
                $logText = 'Melaksanakan sesi ' . strtolower($validated['jenis_layanan']) . ' topik: ' . trim($validated['topik']) . '.';
                if (isset($validated['hasil_kesepakatan']) && trim($validated['hasil_kesepakatan']) !== '') {
                    $logText .= ' Hasil kesepakatan: ' . trim($validated['hasil_kesepakatan']);
                }

                DB::table('tindak_lanjut')->insert([
                    'laporan_id' => (int) $validated['laporan_id'],
                    'user_id' => $request->user()->id,
                    'status' => 'Sesi ' . $validated['jenis_layanan'],
                    'catatan' => $logText,
                    'tanggal' => Carbon::parse($validated['tanggal_pertemuan'])->setTimeFrom(now()),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                // Buat notifikasi untuk siswa pelapor
                $pelaporUserId = DB::table('siswa')
                    ->where('id', $laporan->siswa_id)
                    ->value('user_id');

                if ($pelaporUserId) {
                    DB::table('notifikasi')->insert([
                        'user_id' => $pelaporUserId,
                        'tipe' => 'laporan_diproses',
                        'judul' => 'Tindak Lanjut Kasus #' . $laporan->kode_laporan,
                        'pesan' => 'Guru BK telah melaksanakan sesi konseling dalam proses penanganan laporan kasumu.',
                        'referensi_tipe' => 'laporan_kasus',
                        'referensi_id' => $laporan->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }

                $feedbackMsg .= ' Status laporan dan log tindak lanjut kasus otomatis diperbarui.';
            }
        }

        return redirect()
            ->route('guru-bk.catatan-konseling.show', $catatan->id)
            ->with('success', $feedbackMsg);
    }

    public function show(Request $request, int $id)
    {
        $this->authorizeCounselor($request);

        $catatan = DB::table('catatan_konseling')
            ->join('siswa', 'catatan_konseling.siswa_id', '=', 'siswa.id')
            ->join('users as user_siswa', 'siswa.user_id', '=', 'user_siswa.id')
            ->leftJoin('kelas', 'siswa.kelas_id', '=', 'kelas.id')
            ->join('users as guru_bk', 'catatan_konseling.guru_bk_id', '=', 'guru_bk.id')
            ->leftJoin('laporan_kasus', 'catatan_konseling.laporan_id', '=', 'laporan_kasus.id')
            ->leftJoin('permintaan_bantuan', 'catatan_konseling.bantuan_id', '=', 'permintaan_bantuan.id')
            ->where('catatan_konseling.id', $id)
            ->select([
                'catatan_konseling.*',
                'user_siswa.name as nama_siswa',
                'user_siswa.email as email_siswa',
                'siswa.nis',
                'siswa.whatsapp_number',
                'kelas.nama_kelas',
                'guru_bk.name as nama_guru_bk',
                'guru_bk.email as email_guru_bk',
                'laporan_kasus.kode_laporan',
                'permintaan_bantuan.jenis_bantuan as jenis_bantuan_asal',
            ])
            ->first();

        abort_unless($catatan, 404, 'Catatan konseling tidak ditemukan.');

        // Catatan sebelumnya untuk siswa yang sama
        $riwayatLain = DB::table('catatan_konseling')
            ->join('users as gb', 'catatan_konseling.guru_bk_id', '=', 'gb.id')
            ->where('catatan_konseling.siswa_id', $catatan->siswa_id)
            ->where('catatan_konseling.id', '!=', $catatan->id)
            ->select([
                'catatan_konseling.id',
                'catatan_konseling.tanggal_pertemuan',
                'catatan_konseling.jenis_layanan',
                'catatan_konseling.topik',
                'gb.name as nama_guru_bk',
            ])
            ->orderByDesc('tanggal_pertemuan')
            ->limit(5)
            ->get();

        return view('guru-bk.catatan-konseling.show', [
            'user' => $request->user(),
            'catatan' => $catatan,
            'riwayatLain' => $riwayatLain,
        ]);
    }

    public function edit(Request $request, int $id)
    {
        $this->authorizeCounselor($request);

        $catatan = CatatanKonseling::with(['siswa.user', 'siswa.kelas', 'laporan', 'bantuan'])->findOrFail($id);

        abort_unless(
            (int) $catatan->guru_bk_id === (int) $request->user()->id,
            403,
            'Hanya Guru BK yang mencatat sesi ini yang berwenang mengubah catatan konseling.'
        );

        $kelasList = DB::table('kelas')
            ->orderBy('tingkat')
            ->orderBy('nama_kelas')
            ->select('id', 'nama_kelas', 'tingkat')
            ->get();

        $siswaList = DB::table('siswa')
            ->join('users', 'siswa.user_id', '=', 'users.id')
            ->leftJoin('kelas', 'siswa.kelas_id', '=', 'kelas.id')
            ->select([
                'siswa.id',
                'users.name as nama_siswa',
                'siswa.nis',
                'siswa.kelas_id',
                'kelas.nama_kelas',
            ])
            ->orderBy('users.name')
            ->get();

        return view('guru-bk.catatan-konseling.edit', [
            'user' => $request->user(),
            'catatan' => $catatan,
            'kelasList' => $kelasList,
            'siswaList' => $siswaList,
            'jenisLayananList' => self::JENIS_LAYANAN,
        ]);
    }

    public function update(Request $request, int $id)
    {
        $this->authorizeCounselor($request);

        $catatan = CatatanKonseling::findOrFail($id);

        abort_unless(
            (int) $catatan->guru_bk_id === (int) $request->user()->id,
            403,
            'Hanya Guru BK yang mencatat sesi ini yang berwenang mengubah catatan konseling.'
        );

        $validated = $request->validate([
            'siswa_id' => ['required', 'integer', 'exists:siswa,id'],
            'tanggal_pertemuan' => ['required', 'date', 'before_or_equal:today'],
            'jenis_layanan' => ['required', Rule::in(self::JENIS_LAYANAN)],
            'topik' => ['required', 'string', 'max:255'],
            'isi_catatan' => ['required', 'string'],
            'hasil_kesepakatan' => ['nullable', 'string'],
            'tindak_lanjut' => ['nullable', 'string'],
            'is_rahasia' => ['nullable', 'boolean'],
            'is_shared_wali_kelas' => ['nullable', 'boolean'],
            'arahan_wali_kelas' => ['nullable', 'string'],
        ]);

        $isRahasia = $request->has('is_rahasia');
        $isSharedWali = ! $isRahasia;
        $arahanWali = ! $isRahasia && isset($validated['arahan_wali_kelas']) && trim($validated['arahan_wali_kelas']) !== ''
            ? trim($validated['arahan_wali_kelas'])
            : null;

        $catatan->update([
            'siswa_id' => $validated['siswa_id'],
            'tanggal_pertemuan' => $validated['tanggal_pertemuan'],
            'jenis_layanan' => $validated['jenis_layanan'],
            'topik' => trim($validated['topik']),
            'isi_catatan' => trim($validated['isi_catatan']),
            'hasil_kesepakatan' => isset($validated['hasil_kesepakatan']) && trim($validated['hasil_kesepakatan']) !== ''
                ? trim($validated['hasil_kesepakatan'])
                : null,
            'tindak_lanjut' => isset($validated['tindak_lanjut']) && trim($validated['tindak_lanjut']) !== ''
                ? trim($validated['tindak_lanjut'])
                : null,
            'is_rahasia' => $isRahasia,
            'is_shared_wali_kelas' => $isSharedWali,
            'arahan_wali_kelas' => $arahanWali,
        ]);

        return redirect()
            ->route('guru-bk.catatan-konseling.show', $catatan->id)
            ->with('success', 'Catatan konseling berhasil diperbarui.');
    }

    public function destroy(Request $request, int $id)
    {
        $this->authorizeCounselor($request);

        $catatan = CatatanKonseling::findOrFail($id);

        abort_unless(
            (int) $catatan->guru_bk_id === (int) $request->user()->id,
            403,
            'Hanya Guru BK yang mencatat sesi ini yang berwenang menghapus catatan konseling.'
        );

        $catatan->delete();

        return redirect()
            ->route('guru-bk.catatan-konseling.index')
            ->with('success', 'Catatan konseling telah berhasil dihapus dari jurnal.');
    }

    public function exportPdf(Request $request, int $id)
    {
        $this->authorizeCounselor($request);

        $catatan = DB::table('catatan_konseling')
            ->join('siswa', 'catatan_konseling.siswa_id', '=', 'siswa.id')
            ->join('users as user_siswa', 'siswa.user_id', '=', 'user_siswa.id')
            ->leftJoin('kelas', 'siswa.kelas_id', '=', 'kelas.id')
            ->join('users as guru_bk', 'catatan_konseling.guru_bk_id', '=', 'guru_bk.id')
            ->leftJoin('laporan_kasus', 'catatan_konseling.laporan_id', '=', 'laporan_kasus.id')
            ->where('catatan_konseling.id', $id)
            ->select([
                'catatan_konseling.*',
                'user_siswa.name as nama_siswa',
                'siswa.nis',
                'kelas.nama_kelas',
                'guru_bk.name as nama_guru_bk',
                'laporan_kasus.kode_laporan',
            ])
            ->first();

        abort_unless($catatan, 404, 'Catatan konseling tidak ditemukan.');

        $pengaturan = \App\Models\PengaturanSistem::current();

        $html = '<!DOCTYPE html><html><head><meta charset="UTF-8"><title>Catatan Konseling - ' . htmlspecialchars($catatan->nama_siswa) . '</title>';
        $html .= '<style>
            @page { margin: 28px 32px; }
            body { font-family: DejaVu Sans, Arial, Helvetica, sans-serif; font-size: 11px; color: #172033; line-height: 1.5; margin: 0; }
            table.meta-table { width: 100%; border-collapse: collapse; margin-bottom: 16px; font-size: 11px; }
            table.meta-table td { padding: 4px 6px; }
            .section-box { margin-bottom: 14px; }
            .section-title { font-size: 11px; font-weight: bold; color: #0b6f69; margin: 0 0 6px 0; border-bottom: 1px solid #dfe6e6; padding-bottom: 4px; text-transform: uppercase; }
            .content-box { font-size: 11px; text-align: justify; background: #f8fafc; padding: 10px 12px; border-radius: 4px; border: 1px solid #e2e8f0; line-height: 1.6; }
        </style></head><body>';

        // Kop Surat Resmi
        $html .= $pengaturan->getKopSuratHtml();

        $html .= '<div style="text-align: center; margin-bottom: 18px;">';
        $html .= '<h2 style="margin: 0; color: #0b6f69; font-size: 15px; text-transform: uppercase; letter-spacing: .5px;">Lembar Catatan Bimbingan & Konseling</h2>';
        $html .= '<p style="margin: 3px 0 0 0; color: #64748b; font-size: 9.5px;">Dokumen Rahasia Layanan Bimbingan Konseling Peserta Didik</p>';
        $html .= '</div>';

        $html .= '<table style="width: 100%; border-collapse: collapse; margin-bottom: 16px; font-size: 11px; border: 1px solid #dfe6e6;">';
        $html .= '<tr style="background: #f8fafc;"><td style="width: 25%; padding: 6px 10px; font-weight: bold; color: #475467; border-bottom: 1px solid #dfe6e6;">Nama Peserta Didik</td><td style="font-weight: bold; border-bottom: 1px solid #dfe6e6;">: ' . htmlspecialchars($catatan->nama_siswa) . '</td></tr>';
        $html .= '<tr><td style="padding: 6px 10px; font-weight: bold; color: #475467; border-bottom: 1px solid #dfe6e6;">NIS / Rombel Kelas</td><td style="border-bottom: 1px solid #dfe6e6;">: ' . htmlspecialchars($catatan->nis ?? '-') . ' / ' . htmlspecialchars($catatan->nama_kelas ?? '-') . '</td></tr>';
        $html .= '<tr style="background: #f8fafc;"><td style="padding: 6px 10px; font-weight: bold; color: #475467; border-bottom: 1px solid #dfe6e6;">Waktu Pertemuan</td><td style="border-bottom: 1px solid #dfe6e6;">: ' . Carbon::parse($catatan->tanggal_pertemuan)->locale('id')->translatedFormat('d F Y') . '</td></tr>';
        $html .= '<tr><td style="padding: 6px 10px; font-weight: bold; color: #475467; border-bottom: 1px solid #dfe6e6;">Jenis Layanan BK</td><td style="border-bottom: 1px solid #dfe6e6;">: <strong>' . htmlspecialchars($catatan->jenis_layanan) . '</strong></td></tr>';
        $html .= '<tr style="background: #f8fafc;"><td style="padding: 6px 10px; font-weight: bold; color: #475467; border-bottom: 1px solid #dfe6e6;">Topik Pembahasan</td><td style="font-weight: bold; border-bottom: 1px solid #dfe6e6;">: ' . htmlspecialchars($catatan->topik) . '</td></tr>';
        if ($catatan->kode_laporan) {
            $html .= '<tr><td style="padding: 6px 10px; font-weight: bold; color: #475467; border-bottom: 1px solid #dfe6e6;">Terkait Kasus</td><td style="border-bottom: 1px solid #dfe6e6;">: ' . htmlspecialchars($catatan->kode_laporan) . '</td></tr>';
        }
        $html .= '<tr><td style="padding: 6px 10px; font-weight: bold; color: #475467;">Klasifikasi Informasi</td><td>: ' . ($catatan->is_rahasia ? '<strong style="color: #b42318;">Terkunci Rahasia (Hanya Konselor Berwenang)</strong>' : '<span style="color: #0b6f69;">Terbuka / Koordinatif</span>') . '</td></tr>';
        $html .= '</table>';

        $html .= '<div class="section-box">';
        $html .= '<div class="section-title">A. Uraian Proses & Eksplorasi Masalah</div>';
        $html .= '<div class="content-box">' . nl2br(htmlspecialchars($catatan->isi_catatan)) . '</div>';
        $html .= '</div>';

        if (! empty($catatan->hasil_kesepakatan)) {
            $html .= '<div class="section-box">';
            $html .= '<div class="section-title">B. Kesepakatan, Solusi, & Komitmen Siswa</div>';
            $html .= '<div class="content-box">' . nl2br(htmlspecialchars($catatan->hasil_kesepakatan)) . '</div>';
            $html .= '</div>';
        }

        if (! empty($catatan->tindak_lanjut)) {
            $html .= '<div class="section-box">';
            $html .= '<div class="section-title">C. Rencana Tindak Lanjut & Monitoring</div>';
            $html .= '<div class="content-box">' . nl2br(htmlspecialchars($catatan->tindak_lanjut)) . '</div>';
            $html .= '</div>';
        }

        // Lembar Pengesahan (Kepala Sekolah & Guru BK)
        $html .= $pengaturan->getPengesahanHtml($catatan->nama_guru_bk, 'Guru Bimbingan Konseling');

        $html .= '</body></html>';

        $fileName = 'Catatan_Konseling_' . preg_replace('/[^a-zA-Z0-9_-]/', '_', $catatan->nama_siswa) . '_' . Carbon::parse($catatan->tanggal_pertemuan)->format('Ymd') . '.pdf';

        return Pdf::loadHTML($html)
            ->setPaper('a4', 'portrait')
            ->download($fileName);
    }

    private function buildRekapQuery(Request $request)
    {
        $search = trim((string) $request->query('q', ''));
        $jenisLayanan = trim((string) $request->query('jenis_layanan', ''));
        $kelasId = trim((string) $request->query('kelas_id', ''));
        $siswaId = trim((string) $request->query('siswa_id', ''));
        $tanggalDari = trim((string) $request->query('tanggal_dari', ''));
        $tanggalSampai = trim((string) $request->query('tanggal_sampai', ''));

        $query = DB::table('catatan_konseling')
            ->join('siswa', 'catatan_konseling.siswa_id', '=', 'siswa.id')
            ->join('users as user_siswa', 'siswa.user_id', '=', 'user_siswa.id')
            ->leftJoin('kelas', 'siswa.kelas_id', '=', 'kelas.id')
            ->join('users as guru_bk', 'catatan_konseling.guru_bk_id', '=', 'guru_bk.id')
            ->leftJoin('laporan_kasus', 'catatan_konseling.laporan_id', '=', 'laporan_kasus.id')
            ->leftJoin('permintaan_bantuan', 'catatan_konseling.bantuan_id', '=', 'permintaan_bantuan.id')
            ->select([
                'catatan_konseling.*',
                'user_siswa.name as nama_siswa',
                'siswa.nis',
                'kelas.nama_kelas',
                'guru_bk.name as nama_guru_bk',
                'laporan_kasus.kode_laporan',
            ]);

        if ($search !== '') {
            $query->where(function ($sub) use ($search) {
                $sub->where('user_siswa.name', 'like', "%{$search}%")
                    ->orWhere('siswa.nis', 'like', "%{$search}%")
                    ->orWhere('catatan_konseling.topik', 'like', "%{$search}%")
                    ->orWhere('catatan_konseling.isi_catatan', 'like', "%{$search}%")
                    ->orWhere('catatan_konseling.hasil_kesepakatan', 'like', "%{$search}%");
            });
        }

        if ($jenisLayanan !== '' && in_array($jenisLayanan, self::JENIS_LAYANAN, true)) {
            $query->where('catatan_konseling.jenis_layanan', $jenisLayanan);
        }

        if ($kelasId !== '' && ctype_digit($kelasId)) {
            $query->where('siswa.kelas_id', (int) $kelasId);
        }

        if ($siswaId !== '' && ctype_digit($siswaId)) {
            $query->where('catatan_konseling.siswa_id', (int) $siswaId);
        }

        if ($tanggalDari !== '' && preg_match('/^\d{4}-\d{2}-\d{2}$/', $tanggalDari)) {
            $query->whereDate('catatan_konseling.tanggal_pertemuan', '>=', $tanggalDari);
        }

        if ($tanggalSampai !== '' && preg_match('/^\d{4}-\d{2}-\d{2}$/', $tanggalSampai)) {
            $query->whereDate('catatan_konseling.tanggal_pertemuan', '<=', $tanggalSampai);
        }

        return $query;
    }

    public function exportRekapPdf(Request $request)
    {
        $this->authorizeCounselor($request);

        $catatanList = $this->buildRekapQuery($request)
            ->orderByDesc('catatan_konseling.tanggal_pertemuan')
            ->orderByDesc('catatan_konseling.id')
            ->get();

        $filters = [
            'q' => trim((string) $request->query('q', '')),
            'jenis_layanan' => trim((string) $request->query('jenis_layanan', '')),
            'kelas' => $request->query('kelas_id') ? DB::table('kelas')->where('id', (int) $request->query('kelas_id'))->value('nama_kelas') : null,
            'siswa' => $request->query('siswa_id') ? DB::table('siswa')->join('users', 'siswa.user_id', '=', 'users.id')->where('siswa.id', (int) $request->query('siswa_id'))->value('users.name') : null,
            'tanggal_dari' => trim((string) $request->query('tanggal_dari', '')),
            'tanggal_sampai' => trim((string) $request->query('tanggal_sampai', '')),
        ];

        $html = $this->buildRekapHtml($catatanList, $filters, $request->user()->name, 'pdf');

        $fileName = 'Rekap_Jurnal_Konseling_' . date('Ymd_His') . '.pdf';

        return Pdf::loadHTML($html)
            ->setPaper('a4', 'landscape')
            ->download($fileName);
    }

    public function exportRekapExcel(Request $request)
    {
        $this->authorizeCounselor($request);

        $catatanList = $this->buildRekapQuery($request)
            ->orderByDesc('catatan_konseling.tanggal_pertemuan')
            ->orderByDesc('catatan_konseling.id')
            ->get();

        $filters = [
            'q' => trim((string) $request->query('q', '')),
            'jenis_layanan' => trim((string) $request->query('jenis_layanan', '')),
            'kelas' => $request->query('kelas_id') ? DB::table('kelas')->where('id', (int) $request->query('kelas_id'))->value('nama_kelas') : null,
            'siswa' => $request->query('siswa_id') ? DB::table('siswa')->join('users', 'siswa.user_id', '=', 'users.id')->where('siswa.id', (int) $request->query('siswa_id'))->value('users.name') : null,
            'tanggal_dari' => trim((string) $request->query('tanggal_dari', '')),
            'tanggal_sampai' => trim((string) $request->query('tanggal_sampai', '')),
        ];

        $html = $this->buildRekapHtml($catatanList, $filters, $request->user()->name, 'excel');

        $fileName = 'Rekap_Jurnal_Konseling_' . date('Ymd_His') . '.xls';

        return response()->streamDownload(
            function () use ($html) {
                echo "\xEF\xBB\xBF";
                echo $html;
            },
            $fileName,
            [
                'Content-Type' => 'application/vnd.ms-excel; charset=UTF-8',
                'Cache-Control' => 'no-store, no-cache, must-revalidate',
            ]
        );
    }

    private function buildRekapHtml($catatanList, array $filters, string $counselorName, string $format = 'pdf'): string
    {
        $totalSesi = $catatanList->count();
        $totalSiswa = $catatanList->pluck('siswa_id')->unique()->count();
        $waktuCetak = Carbon::now()->locale('id')->translatedFormat('d F Y, H:i');

        $periodeText = 'Semua Periode';
        if (! empty($filters['tanggal_dari']) && ! empty($filters['tanggal_sampai'])) {
            $periodeText = Carbon::parse($filters['tanggal_dari'])->translatedFormat('d M Y') . ' s/d ' . Carbon::parse($filters['tanggal_sampai'])->translatedFormat('d M Y');
        } elseif (! empty($filters['tanggal_dari'])) {
            $periodeText = 'Sejak ' . Carbon::parse($filters['tanggal_dari'])->translatedFormat('d M Y');
        } elseif (! empty($filters['tanggal_sampai'])) {
            $periodeText = 'Sampai ' . Carbon::parse($filters['tanggal_sampai'])->translatedFormat('d M Y');
        }

        $filterNotes = [];
        if (! empty($filters['kelas'])) {
            $filterNotes[] = 'Kelas: ' . htmlspecialchars($filters['kelas']);
        }
        if (! empty($filters['jenis_layanan'])) {
            $filterNotes[] = 'Layanan: ' . htmlspecialchars($filters['jenis_layanan']);
        }
        if (! empty($filters['siswa'])) {
            $filterNotes[] = 'Siswa: ' . htmlspecialchars($filters['siswa']);
        }
        if (! empty($filters['q'])) {
            $filterNotes[] = 'Kata Kunci: "' . htmlspecialchars($filters['q']) . '"';
        }

        $html = '<!DOCTYPE html><html><head><meta charset="UTF-8"><title>Rekapitulasi Bimbingan & Konseling</title>';
        $html .= '<style>
            body { font-family: DejaVu Sans, Arial, Helvetica, sans-serif; font-size: 11px; color: #1e293b; margin: 0; padding: 15px; }
            .header-kop { text-align: center; border-bottom: 2.5px solid #0f8a83; padding-bottom: 12px; margin-bottom: 18px; }
            .header-kop h2 { margin: 0; font-size: 17px; color: #0b6f69; text-transform: uppercase; letter-spacing: .5px; }
            .header-kop h3 { margin: 4px 0 0 0; font-size: 13px; font-weight: normal; color: #475467; }
            .header-kop p { margin: 3px 0 0 0; font-size: 10px; color: #94a3b8; }
            
            .meta-box { margin-bottom: 16px; border: 1px solid #e2e8f0; border-radius: 6px; padding: 10px 14px; background: #f8fafc; }
            .meta-table { width: 100%; border-collapse: collapse; font-size: 11px; }
            .meta-table td { padding: 3px 0; }
            
            .rekap-table { width: 100%; border-collapse: collapse; margin-top: 10px; font-size: 10.5px; }
            .rekap-table th { background-color: #0f8a83; color: #ffffff; padding: 8px 6px; border: 1px solid #0b6f69; text-align: left; font-weight: bold; }
            .rekap-table td { padding: 7px 6px; border: 1px solid #cbd5e1; vertical-align: top; }
            .rekap-table tr:nth-child(even) td { background-color: #f8fafc; }
            
            .badge-layanan { display: inline-block; padding: 2px 6px; background: #eaf6f4; color: #0f8a83; border-radius: 4px; font-weight: bold; font-size: 9.5px; }
            .badge-rahasia { display: inline-block; padding: 1px 4px; background: #fff1f0; color: #b42318; border-radius: 3px; font-size: 9px; font-weight: bold; }
            
            .signature-wrapper { margin-top: 35px; width: 100%; page-break-inside: avoid; }
            .signature-table { width: 100%; border-collapse: collapse; font-size: 11.5px; }
            .signature-table td { width: 50%; text-align: center; vertical-align: top; }
        </style></head><body>';

        $pengaturan = \App\Models\PengaturanSistem::current();

        // Header KOP Dokumen Resmi
        $html .= $pengaturan->getKopSuratHtml();
        $html .= '<div style="text-align: center; margin-bottom: 16px;">';
        $html .= '<h2 style="margin: 0; font-size: 15px; color: #0b6f69; text-transform: uppercase;">Laporan Rekapitulasi Jurnal Bimbingan & Konseling</h2>';
        $html .= '<p style="margin: 3px 0 0 0; font-size: 9.5px; color: #64748b;">Dokumen Rekapitulasi Resmi Layanan Bimbingan Konseling Peserta Didik</p>';
        $html .= '</div>';

        // Ringkasan Periode & Filter
        $html .= '<div class="meta-box">';
        $html .= '<table class="meta-table">';
        $html .= '<tr>';
        $html .= '<td style="width: 15%; font-weight: bold;">Periode Waktu</td><td style="width: 45%;">: ' . $periodeText . '</td>';
        $html .= '<td style="width: 20%; font-weight: bold;">Total Sesi Konseling</td><td style="width: 20%;">: <strong>' . $totalSesi . ' Sesi</strong></td>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td style="font-weight: bold;">Penyaring / Filter</td><td>: ' . (! empty($filterNotes) ? implode(' · ', $filterNotes) : 'Semua Data') . '</td>';
        $html .= '<td style="font-weight: bold;">Siswa Didampingi</td><td>: <strong>' . $totalSiswa . ' Siswa</strong></td>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td style="font-weight: bold;">Waktu Ekspor</td><td>: ' . $waktuCetak . ' WIB</td>';
        $html .= '<td style="font-weight: bold;">Guru BK Pengunduh</td><td>: ' . htmlspecialchars($counselorName) . '</td>';
        $html .= '</tr>';
        $html .= '</table>';
        $html .= '</div>';

        // Tabel Data Rekap
        $html .= '<table class="rekap-table">';
        $html .= '<thead><tr>';
        $html .= '<th style="width: 4%; text-align: center;">No.</th>';
        $html .= '<th style="width: 10%;">Tanggal</th>';
        $html .= '<th style="width: 16%;">Nama Siswa (NIS)</th>';
        $html .= '<th style="width: 9%;">Kelas</th>';
        $html .= '<th style="width: 13%;">Jenis Layanan</th>';
        $html .= '<th style="width: 18%;">Topik Bimbingan</th>';
        $html .= '<th style="width: 18%;">Hasil & Tindak Lanjut</th>';
        $html .= '<th style="width: 12%;">Guru BK</th>';
        $html .= '</tr></thead><tbody>';

        if ($catatanList->isEmpty()) {
            $html .= '<tr><td colspan="8" style="text-align: center; padding: 25px; color: #64748b;">Tidak ada catatan konseling yang sesuai dengan kriteria filter yang dipilih.</td></tr>';
        } else {
            foreach ($catatanList as $index => $row) {
                $tgl = Carbon::parse($row->tanggal_pertemuan)->translatedFormat('d/m/Y');
                $hasilTindak = '';
                if (! empty($row->hasil_kesepakatan)) {
                    $hasilTindak .= '<strong>Kesepakatan:</strong> ' . htmlspecialchars($row->hasil_kesepakatan);
                }
                if (! empty($row->tindak_lanjut)) {
                    if ($hasilTindak !== '') $hasilTindak .= '<br>';
                    $hasilTindak .= '<strong>Tindak Lanjut:</strong> ' . htmlspecialchars($row->tindak_lanjut);
                }
                if ($hasilTindak === '') {
                    $hasilTindak = '<span style="color: #94a3b8;">-</span>';
                }

                $html .= '<tr>';
                $html .= '<td style="text-align: center;">' . ($index + 1) . '</td>';
                $html .= '<td style="white-space: nowrap;">' . $tgl . '</td>';
                $html .= '<td><strong>' . htmlspecialchars($row->nama_siswa) . '</strong><br><span style="font-size: 9.5px; color: #64748b;">NIS: ' . htmlspecialchars($row->nis ?? '-') . '</span></td>';
                $html .= '<td>' . htmlspecialchars($row->nama_kelas ?? '-') . '</td>';
                $html .= '<td><span class="badge-layanan">' . htmlspecialchars($row->jenis_layanan) . '</span>' . ($row->is_rahasia ? '<br><span class="badge-rahasia">Rahasia</span>' : '') . '</td>';
                $html .= '<td>' . htmlspecialchars($row->topik) . '</td>';
                $html .= '<td>' . $hasilTindak . '</td>';
                $html .= '<td>' . htmlspecialchars($row->nama_guru_bk) . '</td>';
                $html .= '</tr>';
            }
        }

        $html .= '</tbody></table>';

        // Tanda Tangan Pengesahan (hanya untuk format cetak / PDF)
        if ($format === 'pdf') {
            $html .= $pengaturan->getPengesahanHtml($counselorName, 'Guru Bimbingan Konseling');
        }

        $html .= '</body></html>';

        return $html;
    }
}
