<?php

namespace App\Http\Controllers\GuruBK;

use App\Http\Controllers\Controller;
use App\Models\LaporanKasus;
use App\Models\PengaturanSistem;
use App\Support\AuditLogger;
use App\Support\AdminNotifier;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class LaporanKasusController extends Controller
{
    
    public function index(Request $request)
    {
        $user = $request->user();

        abort_unless(
            $user && $user->role === 'counselor',
            403,
            'Kamu tidak memiliki akses ke halaman Guru BK.'
        );

        $this->cleanupLegacyConflictData();

        $cakupan = strtolower(trim((string) $request->query(
            'cakupan',
            'kasus_saya'
        )));

        if (! in_array($cakupan, ['kasus_saya', 'semua_kasus'], true)) {
            $cakupan = 'kasus_saya';
        }

        $search = trim((string) $request->query('q', ''));
        $status = (string) $request->query('status', '');
        $kategoriId = (string) $request->query('kategori', '');

        $kelasId = (string) $request->query(
            'kelas_id',
            ''
        );

        if (
            $kelasId !== ''
            && ! ctype_digit($kelasId)
        ) {
            $kelasId = '';
        }

        $bulan = (string) $request->query(
            'bulan',
            ''
        );

        if (
            $bulan !== ''
            && (
                ! ctype_digit($bulan)
                || (int) $bulan < 1
                || (int) $bulan > 12
            )
        ) {
            $bulan = '';
        }

        $pengaturan = PengaturanSistem::current();

        $tahunAjaran = trim((string) $request->query(
            'tahun_ajaran',
            $pengaturan->tahun_ajaran_aktif
        ));

        if (! preg_match('/^\d{4}\/\d{4}$/', $tahunAjaran)) {
            $tahunAjaran = $pengaturan->tahun_ajaran_aktif;
        }

        $semester = strtolower(trim((string) $request->query(
            'semester',
            $pengaturan->semester_aktif
        )));

        if (! in_array($semester, ['ganjil', 'genap'], true)) {
            $semester = $pengaturan->semester_aktif;
        }

        $tahunAjaranOptions = DB::table('laporan_kasus')
            ->whereNotNull('tahun_ajaran')
            ->where('tahun_ajaran', '!=', '')
            ->distinct()
            ->orderByDesc('tahun_ajaran')
            ->pluck('tahun_ajaran')
            ->prepend($pengaturan->tahun_ajaran_aktif)
            ->filter()
            ->unique()
            ->values();

        $kelasOptions = DB::table('laporan_kasus')
            ->where(
                'status_kasus',
                '!=',
                'draft'
            )
            ->where(
                'tahun_ajaran',
                $tahunAjaran
            )
            ->where(
                'semester',
                $semester
            )
            ->whereNotNull(
                'kelas_id_saat_laporan'
            )
            ->whereNotNull(
                'nama_kelas_saat_laporan'
            )
            ->select([
                'kelas_id_saat_laporan as id',
                'nama_kelas_saat_laporan as nama_kelas',
                'tingkat_saat_laporan as tingkat',
            ])
            ->distinct()
            ->orderBy('tingkat')
            ->orderBy('nama_kelas')
            ->get();

        if (
            $kelasId !== ''
            && ! $kelasOptions->contains(
                fn ($kelas) =>
                    (int) $kelas->id
                    === (int) $kelasId
            )
        ) {
            $kelasId = '';
        }

        $kelasTerpilih = $kelasId !== ''
            ? $kelasOptions->first(
                fn ($kelas) =>
                    (int) $kelas->id
                    === (int) $kelasId
            )
            : null;

        $bulanOptions = $semester === 'ganjil'
            ? collect([
                7 => 'Juli',
                8 => 'Agustus',
                9 => 'September',
                10 => 'Oktober',
                11 => 'November',
                12 => 'Desember',
            ])
            : collect([
                1 => 'Januari',
                2 => 'Februari',
                3 => 'Maret',
                4 => 'April',
                5 => 'Mei',
                6 => 'Juni',
            ]);

        if (
            $bulan !== ''
            && ! $bulanOptions->has(
                (int) $bulan
            )
        ) {
            $bulan = '';
        }

        $query = DB::table('laporan_kasus')
            ->join(
                'siswa',
                'laporan_kasus.siswa_id',
                '=',
                'siswa.id'
            )
            ->join(
                'users',
                'siswa.user_id',
                '=',
                'users.id'
            )
            ->leftJoin(
                'kelas',
                'siswa.kelas_id',
                '=',
                'kelas.id'
            )
            ->join(
                'kategori_kasus',
                'laporan_kasus.kategori_id',
                '=',
                'kategori_kasus.id'
            )
            ->leftJoin(
                'users as assigned_bk',
                'laporan_kasus.assigned_bk_id',
                '=',
                'assigned_bk.id'
            )
            ->where(
                'laporan_kasus.status_kasus',
                '!=',
                'draft'
            )
            ->where(
                'laporan_kasus.tahun_ajaran',
                $tahunAjaran
            )
            ->where(
                'laporan_kasus.semester',
                $semester
            )
            ->select([
                'laporan_kasus.id',
                'laporan_kasus.kode_laporan',
                'laporan_kasus.status_kasus',
                'laporan_kasus.status_rahasia',
                'laporan_kasus.created_at',
                'laporan_kasus.submitted_at',
                'laporan_kasus.tanggal_kejadian',
                'laporan_kasus.assigned_bk_id',
                'laporan_kasus.tahun_ajaran',
                'laporan_kasus.semester',
                'laporan_kasus.tingkat_saat_laporan',
                'users.name as nama_siswa',
                'siswa.nis',
                DB::raw(
                    'COALESCE('
                    . 'laporan_kasus.nama_kelas_saat_laporan, '
                    . 'kelas.nama_kelas'
                    . ') as nama_kelas'
                ),
                'kategori_kasus.id as kategori_id',
                'kategori_kasus.nama_kategori',
                'assigned_bk.name as nama_bk_penanggung_jawab',
            ]);

        if ($cakupan === 'kasus_saya') {
            $query->where(function ($sub) use ($user) {
                $sub->where('laporan_kasus.assigned_bk_id', $user->id)
                    ->orWhereExists(function ($k) use ($user) {
                        $k->select(DB::raw(1))
                            ->from('konflik_kepentingan')
                            ->whereColumn('konflik_kepentingan.laporan_id', 'laporan_kasus.id')
                            ->where('konflik_kepentingan.user_id', $user->id)
                            ->where('konflik_kepentingan.ada_konflik', true);
                    });
            });
        }

        if ($kelasId !== '') {
            $query->where(
                'laporan_kasus.kelas_id_saat_laporan',
                (int) $kelasId
            );
        }

        if ($bulan !== '') {
            $query->whereRaw(
                'MONTH(COALESCE('
                . 'laporan_kasus.submitted_at, '
                . 'laporan_kasus.created_at'
                . ')) = ?',
                [
                    (int) $bulan,
                ]
            );
        }

        if ($search !== '') {
            $query->where(function ($subQuery) use ($search) {
                $subQuery
                    ->where(
                        'laporan_kasus.kode_laporan',
                        'like',
                        '%' . $search . '%'
                    )
                    ->orWhere(
                        'users.name',
                        'like',
                        '%' . $search . '%'
                    )
                    ->orWhere(
                        'siswa.nis',
                        'like',
                        '%' . $search . '%'
                    );
            });
        }

        $statusDiperbolehkan = [
            'baru',
            'diproses',
            'selesai',
            'dieskalasi',
        ];

        if (in_array($status, $statusDiperbolehkan, true)) {
            $query->where(
                'laporan_kasus.status_kasus',
                $status
            );
        }

        if ($kategoriId !== '' && ctype_digit($kategoriId)) {
            $query->where(
                'laporan_kasus.kategori_id',
                (int) $kategoriId
            );
        }

        $laporan = $query
            ->orderByDesc(
                DB::raw(
                    'COALESCE('
                    . 'laporan_kasus.submitted_at, '
                    . 'laporan_kasus.created_at'
                    . ')'
                )
            )
            ->paginate(10)
            ->withQueryString();

        $kategori = DB::table('kategori_kasus')
            ->where('is_active', true)
            ->orderBy('nama_kategori')
            ->get([
                'id',
                'nama_kategori',
            ]);

        $ringkasanBase = DB::table('laporan_kasus')
            ->where('status_kasus', '!=', 'draft')
            ->where('tahun_ajaran', $tahunAjaran)
            ->where('semester', $semester);

        if ($cakupan === 'kasus_saya') {
            $ringkasanBase->where(function ($sub) use ($user) {
                $sub->where('laporan_kasus.assigned_bk_id', $user->id)
                    ->orWhereExists(function ($k) use ($user) {
                        $k->select(DB::raw(1))
                            ->from('konflik_kepentingan')
                            ->whereColumn('konflik_kepentingan.laporan_id', 'laporan_kasus.id')
                            ->where('konflik_kepentingan.user_id', $user->id)
                            ->where('konflik_kepentingan.ada_konflik', true);
                    });
            });
        }

        if ($kelasId !== '') {
            $ringkasanBase->where(
                'kelas_id_saat_laporan',
                (int) $kelasId
            );
        }

        if ($bulan !== '') {
            $ringkasanBase->whereRaw(
                'MONTH(COALESCE('
                . 'submitted_at, '
                . 'created_at'
                . ')) = ?',
                [
                    (int) $bulan,
                ]
            );
        }

        $ringkasan = [
            'total' => (clone $ringkasanBase)->count(),

            'baru' => (clone $ringkasanBase)
                ->where('status_kasus', 'baru')
                ->count(),

            'diproses' => (clone $ringkasanBase)
                ->where('status_kasus', 'diproses')
                ->count(),

            'dieskalasi' => (clone $ringkasanBase)
                ->where('status_kasus', 'dieskalasi')
                ->count(),
        ];

        return view(
            'guru-bk.laporan.index',
            compact(
                'user',
                'laporan',
                'kategori',
                'ringkasan',
                'search',
                'status',
                'kategoriId',
                'tahunAjaran',
                'semester',
                'tahunAjaranOptions',
                'cakupan',
                'kelasId',
                'kelasOptions',
                'kelasTerpilih',
                'bulan',
                'bulanOptions'
            )
        );
    }

    public function exportExcel(Request $request)
    {
        $user = $request->user();

        abort_unless(
            $user && $user->role === 'counselor',
            403,
            'Kamu tidak memiliki akses ke halaman Guru BK.'
        );

        $filters = $this->resolveExportFilters($request);

        $laporan = $this->buildExportQuery($filters, $user->id)
            ->orderByDesc(
                DB::raw(
                    'COALESCE('
                    . 'laporan_kasus.submitted_at, '
                    . 'laporan_kasus.created_at'
                    . ')'
                )
            )
            ->get();

        AuditLogger::record(
            $request,
            $user,
            'counselor_case_report_exported',
            'Mengunduh daftar laporan kasus Guru BK dalam format Excel.',
            'laporan_kasus',
            null,
            null,
            [
                'format' => 'excel',
                'tahun_ajaran' => $filters['tahunAjaran'],
                'semester' => $filters['semester'],
                'cakupan' => $filters['cakupan'],
                'status' => $filters['status'] ?: null,
                'kategori_id' => $filters['kategoriId'] ?: null,
                'kelas_id' => $filters['kelasId'] ?: null,
                'bulan' => $filters['bulan'] ?: null,
                'jumlah_data' => $laporan->count(),
            ]
        );

        $tahunFile = str_replace(
            '/',
            '-',
            $filters['tahunAjaran']
        );

        $cakupanFile = $filters['cakupan'] === 'kasus_saya'
            ? 'kasus-saya'
            : 'semua-kasus';

        $fileName = sprintf(
            'laporan-guru-bk-%s-%s-%s.xls',
            $tahunFile,
            $filters['semester'],
            $cakupanFile
        );

        return response()->streamDownload(
            function () use ($laporan, $filters, $user) {
                echo "\xEF\xBB\xBF";

                echo $this->exportHtml(
                    $laporan,
                    $filters,
                    $user->name
                );
            },
            $fileName,
            [
                'Content-Type' =>
                    'application/vnd.ms-excel; charset=UTF-8',

                'Cache-Control' =>
                    'no-store, no-cache, must-revalidate',
            ]
        );
    }

    public function exportPdf(Request $request)
    {
        $user = $request->user();

        abort_unless(
            $user && $user->role === 'counselor',
            403,
            'Kamu tidak memiliki akses ke halaman Guru BK.'
        );

        $filters = $this->resolveExportFilters($request);

        $laporan = $this->buildExportQuery($filters, $user->id)
            ->orderByDesc(
                DB::raw(
                    'COALESCE('
                    . 'laporan_kasus.submitted_at, '
                    . 'laporan_kasus.created_at'
                    . ')'
                )
            )
            ->get();

        AuditLogger::record(
            $request,
            $user,
            'counselor_case_report_exported',
            'Mengunduh daftar laporan kasus Guru BK dalam format PDF.',
            'laporan_kasus',
            null,
            null,
            [
                'format' => 'pdf',
                'tahun_ajaran' => $filters['tahunAjaran'],
                'semester' => $filters['semester'],
                'cakupan' => $filters['cakupan'],
                'status' => $filters['status'] ?: null,
                'kategori_id' => $filters['kategoriId'] ?: null,
                'kelas_id' => $filters['kelasId'] ?: null,
                'bulan' => $filters['bulan'] ?: null,
                'jumlah_data' => $laporan->count(),
            ]
        );

        $tahunFile = str_replace(
            '/',
            '-',
            $filters['tahunAjaran']
        );

        $cakupanFile = $filters['cakupan'] === 'kasus_saya'
            ? 'kasus-saya'
            : 'semua-kasus';

        $fileName = sprintf(
            'laporan-guru-bk-%s-%s-%s.pdf',
            $tahunFile,
            $filters['semester'],
            $cakupanFile
        );

        return Pdf::loadHTML(
            $this->exportHtml(
                $laporan,
                $filters,
                $user->name
            )
        )
            ->setPaper('a4', 'landscape')
            ->download($fileName);
    }

    public function show(Request $request, int $laporan)
    {
        $user = $request->user();

        abort_unless(
            $user && $user->role === 'counselor',
            403,
            'Kamu tidak memiliki akses ke halaman Guru BK.'
        );

        $this->cleanupLegacyConflictData();

        $detail = DB::table('laporan_kasus')
            ->join(
                'siswa',
                'laporan_kasus.siswa_id',
                '=',
                'siswa.id'
            )
            ->join(
                'users as pelapor',
                'siswa.user_id',
                '=',
                'pelapor.id'
            )
            ->leftJoin(
                'kelas',
                'siswa.kelas_id',
                '=',
                'kelas.id'
            )
            ->join(
                'kategori_kasus',
                'laporan_kasus.kategori_id',
                '=',
                'kategori_kasus.id'
            )
            ->leftJoin(
                'users as assigned_bk',
                'laporan_kasus.assigned_bk_id',
                '=',
                'assigned_bk.id'
            )
            ->where('laporan_kasus.id', $laporan)
            ->where('laporan_kasus.status_kasus', '!=', 'draft')
            ->select([
                'laporan_kasus.id',
                'laporan_kasus.kode_laporan',
                'laporan_kasus.siswa_id',
                'laporan_kasus.tanggal_kejadian',
                'laporan_kasus.lokasi_kejadian',
                'laporan_kasus.deskripsi',
                'laporan_kasus.status_rahasia',
                'laporan_kasus.status_kasus',
                'laporan_kasus.assigned_bk_id',
                'laporan_kasus.submitted_at',
                'laporan_kasus.resolved_at',
                'laporan_kasus.created_at',
                'pelapor.name as nama_siswa',
                'pelapor.email as email_siswa',
                'siswa.nis',
                'siswa.tahun_masuk',
                'siswa.whatsapp_number',
                DB::raw(
                    'COALESCE('
                    . 'laporan_kasus.nama_kelas_saat_laporan, '
                    . 'kelas.nama_kelas'
                    . ') as nama_kelas'
                ),
                DB::raw(
                    'COALESCE('
                    . 'laporan_kasus.tahun_ajaran, '
                    . 'kelas.tahun_ajaran'
                    . ') as tahun_ajaran'
                ),
                'laporan_kasus.semester',
                'laporan_kasus.tingkat_saat_laporan',
                'kategori_kasus.nama_kategori',
                'assigned_bk.name as nama_bk_penanggung_jawab',
            ])
            ->first();

        abort_unless(
            $detail,
            404,
            'Laporan tidak ditemukan.'
        );

        AuditLogger::record(
            $request,
            $user,
            'case_viewed',
            'Membuka detail laporan kasus.',
            'laporan_kasus',
            $laporan,
            $detail->kode_laporan
        );

        $bukti = DB::table('bukti_laporan')
            ->where('laporan_id', $laporan)
            ->orderBy('created_at')
            ->get();

        $tindakLanjut = DB::table('tindak_lanjut')
            ->join(
                'users',
                'tindak_lanjut.user_id',
                '=',
                'users.id'
            )
            ->where('tindak_lanjut.laporan_id', $laporan)
            ->select([
                'tindak_lanjut.id',
                'tindak_lanjut.status',
                'tindak_lanjut.catatan',
                'tindak_lanjut.tanggal',
                'tindak_lanjut.created_at',
                'users.name as nama_petugas',
            ])
            ->orderByDesc('tindak_lanjut.tanggal')
            ->orderByDesc('tindak_lanjut.id')
            ->get();

        $konflikDeklarasi = DB::table('konflik_kepentingan')
            ->where('laporan_id', $laporan)
            ->where('user_id', $user->id)
            ->first();

        $riwayatKonseling = DB::table('catatan_konseling')
            ->join('users', 'catatan_konseling.guru_bk_id', '=', 'users.id')
            ->where('catatan_konseling.laporan_id', $laporan)
            ->select([
                'catatan_konseling.*',
                'users.name as nama_guru_bk',
            ])
            ->orderByDesc('catatan_konseling.tanggal_pertemuan')
            ->orderByDesc('catatan_konseling.id')
            ->get();

        return view(
            'guru-bk.laporan.show',
            compact(
                'user',
                'detail',
                'bukti',
                'tindakLanjut',
                'konflikDeklarasi',
                'riwayatKonseling'
            )
        );
    }

    private function cleanupLegacyConflictData(): void
    {
        try {
            // 1. Cari deklarasi konflik lama/testing (sebelum November 2026 atau keterangan 'saya sibuk')
            $legacyLaporanIds = DB::table('konflik_kepentingan')
                ->where(function ($q) {
                    $q->where('declared_at', '<', '2026-11-01 00:00:00')
                      ->orWhereRaw('LOWER(TRIM(COALESCE(keterangan, ""))) = ?', ['saya sibuk']);
                })
                ->pluck('laporan_id')
                ->unique()
                ->all();

            if (! empty($legacyLaporanIds)) {
                DB::table('konflik_kepentingan')
                    ->where(function ($q) {
                        $q->where('declared_at', '<', '2026-11-01 00:00:00')
                          ->orWhereRaw('LOWER(TRIM(COALESCE(keterangan, ""))) = ?', ['saya sibuk']);
                    })
                    ->delete();

                // Kembalikan laporan yang belum punya assigned_bk_id dan terdampak data lama ke status 'baru'
                DB::table('laporan_kasus')
                    ->whereIn('id', $legacyLaporanIds)
                    ->whereNull('assigned_bk_id')
                    ->where('status_kasus', 'dieskalasi')
                    ->update(['status_kasus' => 'baru']);
            }

            // 2. Bersihkan deklarasi konflik tidak sinkron pada laporan yang masih berstatus 'baru'
            $baruLaporanIds = DB::table('laporan_kasus')
                ->where('status_kasus', 'baru')
                ->whereNull('assigned_bk_id')
                ->pluck('id')
                ->all();

            if (! empty($baruLaporanIds)) {
                DB::table('konflik_kepentingan')
                    ->whereIn('laporan_id', $baruLaporanIds)
                    ->delete();
            }
        } catch (\Throwable $e) {
            // Abaikan jika tabel belum siap
        }
    }

    public function exportDetailPdf(Request $request, int $laporan)
    {
        $user = $request->user();

        abort_unless(
            $user && $user->role === 'counselor',
            403,
            'Kamu tidak memiliki akses ke halaman Guru BK.'
        );

        $detail = DB::table('laporan_kasus')
            ->join('siswa', 'laporan_kasus.siswa_id', '=', 'siswa.id')
            ->join('users as pelapor', 'siswa.user_id', '=', 'pelapor.id')
            ->leftJoin('kelas', 'siswa.kelas_id', '=', 'kelas.id')
            ->join('kategori_kasus', 'laporan_kasus.kategori_id', '=', 'kategori_kasus.id')
            ->leftJoin('users as assigned_bk', 'laporan_kasus.assigned_bk_id', '=', 'assigned_bk.id')
            ->where('laporan_kasus.id', $laporan)
            ->where('laporan_kasus.status_kasus', '!=', 'draft')
            ->select([
                'laporan_kasus.*',
                'pelapor.name as nama_pelapor',
                'pelapor.email as email_pelapor',
                'siswa.nis',
                'kelas.nama_kelas',
                'kategori_kasus.nama_kategori',
                'assigned_bk.name as nama_bk',
            ])
            ->first();

        abort_unless($detail, 404, 'Laporan kasus tidak ditemukan atau masih berstatus draft.');

        $pengaturan = \App\Models\PengaturanSistem::current();

        $html = '<!DOCTYPE html><html><head><meta charset="UTF-8"><title>Laporan Kasus - ' . htmlspecialchars($detail->kode_laporan) . '</title>';
        $html .= '<style>
            @page { margin: 28px 32px; }
            body { font-family: DejaVu Sans, Arial, Helvetica, sans-serif; font-size: 11px; color: #172033; line-height: 1.5; margin: 0; }
            .section-title { font-size: 11px; font-weight: bold; color: #0b6f69; margin: 14px 0 6px; text-transform: uppercase; border-bottom: 1px solid #dfe6e6; padding-bottom: 3px; }
            table.data-table { width: 100%; border-collapse: collapse; margin-bottom: 14px; font-size: 10.5px; }
            table.data-table td { padding: 5px 8px; border: 1px solid #dfe6e6; }
            table.data-table td.label-col { width: 28%; background-color: #f8fafc; font-weight: bold; color: #475467; }
        </style></head><body>';

        // Official Kop Surat
        $html .= $pengaturan->getKopSuratHtml();

        $html .= '<div style="text-align: center; margin-bottom: 16px;">';
        $html .= '<h2 style="margin: 0; color: #0b6f69; font-size: 15px; text-transform: uppercase;">Lembar Laporan Kasus Siswa</h2>';
        $html .= '<p style="margin: 3px 0 0 0; color: #64748b; font-size: 9.5px;">Nomor Berkas Registrasi: ' . htmlspecialchars($detail->kode_laporan) . '</p>';
        $html .= '</div>';
        
        $html .= '<div class="section-title">A. IDENTITAS PELAPOR</div>';
        $html .= '<table class="data-table">';
        $html .= '<tr><td class="label-col">Nama Pelapor</td><td><strong>' . htmlspecialchars($detail->nama_pelapor) . '</strong></td></tr>';
        $html .= '<tr><td class="label-col">NIS / Kelas</td><td>' . htmlspecialchars($detail->nis ?? '-') . ' / ' . htmlspecialchars($detail->nama_kelas ?? '-') . '</td></tr>';
        $html .= '</table>';

        $html .= '<div class="section-title">B. RINCIAN PERISTIWA LAPORAN</div>';
        $html .= '<table class="data-table">';
        $html .= '<tr><td class="label-col">Kode Berkas</td><td><strong>' . htmlspecialchars($detail->kode_laporan) . '</strong></td></tr>';
        $html .= '<tr><td class="label-col">Kategori Masalah</td><td>' . htmlspecialchars($detail->nama_kategori) . '</td></tr>';
        $html .= '<tr><td class="label-col">Status Penanganan</td><td>' . ucfirst($detail->status_kasus) . '</td></tr>';
        if (!empty($detail->tanggal_kejadian)) {
            $html .= '<tr><td class="label-col">Tanggal Kejadian</td><td>' . \Carbon\Carbon::parse($detail->tanggal_kejadian)->locale('id')->translatedFormat('d F Y') . '</td></tr>';
        }
        if (!empty($detail->lokasi_kejadian)) {
            $html .= '<tr><td class="label-col">Lokasi Kejadian</td><td>' . htmlspecialchars($detail->lokasi_kejadian) . '</td></tr>';
        }
        $html .= '<tr><td class="label-col" style="vertical-align: top;">Uraian Kejadian</td><td style="text-align: justify; line-height: 1.6;">' . nl2br(htmlspecialchars($detail->deskripsi ?? '')) . '</td></tr>';
        $html .= '<tr><td class="label-col">Waktu Dilaporkan</td><td>' . \Carbon\Carbon::parse($detail->submitted_at)->locale('id')->translatedFormat('d F Y, H:i') . ' WIB</td></tr>';
        $html .= '</table>';

        // Lembar Pengesahan (Kepala Sekolah & Guru BK)
        $namaBk = $detail->nama_bk ?: 'Guru Bimbingan Konseling';
        $html .= $pengaturan->getPengesahanHtml($namaBk, 'Guru BK Penanggung Jawab');

        $html .= '</body></html>';

        $fileName = 'Laporan_Kasus_' . str_replace(' ', '_', $detail->kode_laporan) . '.pdf';

        return \Barryvdh\DomPDF\Facade\Pdf::loadHTML($html)
            ->setPaper('a4', 'portrait')
            ->download($fileName);
    }

    public function storeConflict(
        Request $request,
        int $laporan
    ) {
        $user = $request->user();

        abort_unless(
            $user && $user->role === 'counselor',
            403,
            'Kamu tidak memiliki akses ke halaman Guru BK.'
        );

        $validated = $request->validate([
            'ada_konflik' => [
                'required',
                'boolean',
            ],

            'keterangan' => [
                'nullable',
                'string',
                'max:1500',
                'required_if:ada_konflik,1',
            ],
        ], [
            'ada_konflik.required' =>
                'Pilih apakah terdapat konflik kepentingan.',
            'keterangan.required_if' =>
                'Jelaskan konflik kepentingan yang ditemukan.',
        ]);

        $data = DB::table('laporan_kasus')
            ->where('id', $laporan)
            ->where('status_kasus', '!=', 'draft')
            ->first([
                'id',
                'kode_laporan',
                'status_kasus',
                'assigned_bk_id',
            ]);

        abort_unless(
            $data,
            404,
            'Laporan tidak ditemukan.'
        );

        $adaKonflik = (bool) $validated['ada_konflik'];

        // Cek apakah Guru BK ini sudah pernah menyatakan ada konflik sebelumnya
        $existingKonflik = DB::table('konflik_kepentingan')
            ->where('laporan_id', $laporan)
            ->where('user_id', $user->id)
            ->first();

        if ($existingKonflik && (bool) $existingKonflik->ada_konflik) {
            return redirect()
                ->route('guru-bk.laporan.show', $laporan)
                ->withErrors([
                    'conflict' => 'Deklarasi konflik kepentingan telah tersimpan dan terkunci permanen demi kode etik konseling.',
                ]);
        }

        if (
            (int) $data->assigned_bk_id === (int) $user->id
            && $adaKonflik
        ) {
            return redirect()
                ->route('guru-bk.laporan.show', $laporan)
                ->withErrors([
                    'conflict' =>
                        'Konflik kepentingan tidak dapat ditetapkan '
                        . 'setelah penanganan laporan diambil.',
                ]);
        }

        DB::table('konflik_kepentingan')
            ->updateOrInsert(
                [
                    'laporan_id' => $laporan,
                    'user_id' => $user->id,
                ],
                [
                    'ada_konflik' => $adaKonflik,
                    'keterangan' => $adaKonflik
                        ? trim((string) ($validated['keterangan'] ?? ''))
                        : null,
                    'declared_at' => now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );

        if ($adaKonflik) {
            $statusSebelumnya = $data->status_kasus;

            $laporanModel = LaporanKasus::find($laporan);
            if ($laporanModel) {
                $laporanModel->update([
                    'status_kasus' => 'dieskalasi',
                    'resolved_at' => null,
                    'updated_at' => now(),
                ]);
            } else {
                DB::table('laporan_kasus')
                    ->where('id', $laporan)
                    ->update([
                        'status_kasus' => 'dieskalasi',
                        'resolved_at' => null,
                        'updated_at' => now(),
                    ]);
            }

            if ($statusSebelumnya !== 'dieskalasi') {
                AdminNotifier::notifyEscalatedCase($laporan);
            }
        } elseif (! $data->assigned_bk_id) {
            $updates = [
                'assigned_bk_id' => $user->id,
                'updated_at' => now(),
            ];

            if (in_array($data->status_kasus, ['baru', 'dieskalasi'], true)) {
                $updates['status_kasus'] = 'diproses';
            }

            $laporanModel = LaporanKasus::find($laporan);
            if ($laporanModel) {
                $laporanModel->update($updates);
            } else {
                DB::table('laporan_kasus')
                    ->where('id', $laporan)
                    ->update($updates);
            }
        }

        AuditLogger::record(
            $request,
            $user,
            $adaKonflik
                ? 'conflict_declared'
                : 'no_conflict_declared_and_claimed',
            $adaKonflik
                ? 'Menyatakan terdapat konflik kepentingan pada laporan.'
                : 'Menyatakan tidak terdapat konflik kepentingan dan otomatis menjadi penanggung jawab laporan.',
            'laporan_kasus',
            $laporan,
            $data->kode_laporan,
            [
                'ada_konflik' => $adaKonflik,
            ]
        );

        return redirect()
            ->route('guru-bk.laporan.show', $laporan)
            ->with(
                'success',
                $adaKonflik
                    ? 'Konflik kepentingan berhasil dicatat dan kasus dieskalasi. Akses penanganan Anda untuk laporan ini kini terkunci permanen demi menjaga kode etik konseling.'
                    : 'Deklarasi disimpan. Anda otomatis ditetapkan sebagai Guru BK Penanggung Jawab untuk menangani laporan ini.'
            );
    }

    public function claim(
        Request $request,
        int $laporan
    ) {
        $user = $request->user();

        abort_unless(
            $user && $user->role === 'counselor',
            403,
            'Kamu tidak memiliki akses ke halaman Guru BK.'
        );

        $result = DB::transaction(function () use (
            $laporan,
            $user
        ) {
            $data = DB::table('laporan_kasus')
                ->where('id', $laporan)
                ->where('status_kasus', '!=', 'draft')
                ->lockForUpdate()
                ->first([
                    'id',
                    'assigned_bk_id',
                    'status_kasus',
                ]);

            abort_unless(
                $data,
                404,
                'Laporan tidak ditemukan.'
            );

            if (
                $data->assigned_bk_id
                && (int) $data->assigned_bk_id !== (int) $user->id
            ) {
                return 'assigned_to_other';
            }

            if ((int) $data->assigned_bk_id === (int) $user->id) {
                return 'already_assigned';
            }

            $deklarasi = DB::table('konflik_kepentingan')
                ->where('laporan_id', $laporan)
                ->where('user_id', $user->id)
                ->first();

            if (! $deklarasi) {
                return 'need_declaration';
            }

            if ((bool) $deklarasi->ada_konflik) {
                return 'conflict_declared';
            }

            $updates = [
                'assigned_bk_id' => $user->id,
                'updated_at' => now(),
            ];

            if (in_array($data->status_kasus, ['baru', 'dieskalasi'], true)) {
                $updates['status_kasus'] = 'diproses';
            }

            $laporanModel = LaporanKasus::find($laporan);
            if ($laporanModel) {
                $laporanModel->update($updates);
            } else {
                DB::table('laporan_kasus')
                    ->where('id', $laporan)
                    ->update($updates);
            }

            return 'claimed';
        });

        if ($result === 'assigned_to_other') {
            return redirect()
                ->route('guru-bk.laporan.show', $laporan)
                ->withErrors([
                    'assignment' =>
                        'Laporan ini sudah ditangani oleh Guru BK lain.',
                ]);
        }

        if ($result === 'need_declaration') {
            return redirect()
                ->route('guru-bk.laporan.show', $laporan)
                ->withErrors([
                    'conflict' =>
                        'Isi deklarasi konflik kepentingan sebelum '
                        . 'mengambil penanganan laporan.',
                ]);
        }

        if ($result === 'conflict_declared') {
            return redirect()
                ->route('guru-bk.laporan.show', $laporan)
                ->withErrors([
                    'conflict' =>
                        'Kamu telah menyatakan ada konflik kepentingan '
                        . 'pada laporan ini.',
                ]);
        }

        if ($result === 'already_assigned') {
            return redirect()
                ->route('guru-bk.laporan.show', $laporan)
                ->with(
                    'success',
                    'Kamu sudah menjadi penanggung jawab laporan ini.'
                );
        }

        $kodeLaporan = DB::table('laporan_kasus')
            ->where('id', $laporan)
            ->value('kode_laporan');

        AuditLogger::record(
            $request,
            $user,
            'case_claimed',
            'Mengambil tanggung jawab penanganan laporan.',
            'laporan_kasus',
            $laporan,
            $kodeLaporan
        );

        return redirect()
            ->route('guru-bk.laporan.show', $laporan)
            ->with(
                'success',
                'Laporan berhasil diambil untuk ditangani.'
            );
    }

    public function updateStatus(
        Request $request,
        int $laporan
    ) {
        $user = $request->user();

        abort_unless(
            $user && $user->role === 'counselor',
            403,
            'Kamu tidak memiliki akses ke halaman Guru BK.'
        );

        $validated = $request->validate([
            'status_kasus' => [
                'required',
                Rule::in([
                    'baru',
                    'diproses',
                    'selesai',
                    'dieskalasi',
                ]),
            ],
        ]);

        $data = DB::table('laporan_kasus')
            ->where('id', $laporan)
            ->where('status_kasus', '!=', 'draft')
            ->first([
                'id',
                'kode_laporan',
                'status_kasus',
                'assigned_bk_id',
            ]);

        abort_unless(
            $data,
            404,
            'Laporan tidak ditemukan.'
        );

        abort_unless(
            (int) $data->assigned_bk_id === (int) $user->id,
            403,
            'Hanya Guru BK penanggung jawab yang dapat mengubah status laporan.'
        );

        $deklarasi = DB::table('konflik_kepentingan')
            ->where('laporan_id', $laporan)
            ->where('user_id', $user->id)
            ->first();

        abort_unless(
            $deklarasi && ! (bool) $deklarasi->ada_konflik,
            403,
            'Deklarasi tanpa konflik kepentingan diperlukan '
            . 'sebelum melanjutkan penanganan laporan.'
        );

        $updates = [
            'status_kasus' => $validated['status_kasus'],
            'updated_at' => now(),
        ];

        if ($validated['status_kasus'] === 'selesai') {
            $updates['resolved_at'] = now();
        } else {
            $updates['resolved_at'] = null;
        }

        $laporanModel = LaporanKasus::find($laporan);
        if ($laporanModel) {
            $laporanModel->update($updates);
        } else {
            DB::table('laporan_kasus')
                ->where('id', $laporan)
                ->update($updates);
        }

        $statusBaru = $validated['status_kasus'];

        AuditLogger::record(
            $request,
            $user,
            $statusBaru === 'dieskalasi'
                ? 'case_escalated'
                : 'case_status_updated',
            $statusBaru === 'dieskalasi'
                ? 'Mengescalasi laporan untuk pengawasan tingkat sekolah.'
                : 'Memperbarui status penanganan laporan.',
            'laporan_kasus',
            $laporan,
            $data->kode_laporan,
            [
                'old_status' => $data->status_kasus,
                'new_status' => $statusBaru,
            ]
        );

        if (
            $statusBaru === 'dieskalasi'
            && $data->status_kasus !== 'dieskalasi'
        ) {
            AdminNotifier::notifyEscalatedCase($laporan);
        }

        return redirect()
            ->route('guru-bk.laporan.show', $laporan)
            ->with(
                'success',
                'Status laporan berhasil diperbarui.'
            );
    }

    public function storeTindakLanjut(
        Request $request,
        int $laporan
    ) {
        $user = $request->user();

        abort_unless(
            $user && $user->role === 'counselor',
            403,
            'Kamu tidak memiliki akses ke halaman Guru BK.'
        );

        $validated = $request->validate([
            'status' => [
                'required',
                'string',
                'max:50',
            ],

            'catatan' => [
                'required',
                'string',
                'max:3000',
            ],
        ]);

        $data = DB::table('laporan_kasus')
            ->where('id', $laporan)
            ->where('status_kasus', '!=', 'draft')
            ->first([
                'id',
                'kode_laporan',
                'siswa_id',
                'assigned_bk_id',
            ]);

        abort_unless(
            $data,
            404,
            'Laporan tidak ditemukan.'
        );

        abort_unless(
            (int) $data->assigned_bk_id === (int) $user->id,
            403,
            'Hanya Guru BK penanggung jawab yang dapat mengubah status laporan.'
        );

        $deklarasi = DB::table('konflik_kepentingan')
            ->where('laporan_id', $laporan)
            ->where('user_id', $user->id)
            ->first();

        abort_unless(
            $deklarasi && ! (bool) $deklarasi->ada_konflik,
            403,
            'Deklarasi tanpa konflik kepentingan diperlukan '
            . 'sebelum melanjutkan penanganan laporan.'
        );

        $siswaInfo = DB::table('siswa')
            ->leftJoin('users', 'siswa.user_id', '=', 'users.id')
            ->where('siswa.id', $data->siswa_id)
            ->select([
                'siswa.user_id',
                'siswa.whatsapp_number',
                'users.name as nama_siswa',
            ])
            ->first();

        DB::transaction(function () use (
            $validated,
            $laporan,
            $user,
            $data,
            $siswaInfo
        ) {
            $now = now();

            DB::table('tindak_lanjut')->insert([
                'laporan_id' => $laporan,
                'user_id' => $user->id,
                'status' => $validated['status'],
                'catatan' => $validated['catatan'],
                'tanggal' => $now,
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            $laporanModel = LaporanKasus::find($laporan);
            if ($laporanModel && $laporanModel->status_kasus === 'baru') {
                $laporanModel->update([
                    'status_kasus' => 'diproses',
                    'updated_at' => $now,
                ]);
            } else {
                DB::table('laporan_kasus')
                    ->where('id', $laporan)
                    ->where('status_kasus', 'baru')
                    ->update([
                        'status_kasus' => 'diproses',
                        'updated_at' => $now,
                    ]);
            }

            $namaSiswa = $siswaInfo->nama_siswa ?? 'Siswa';

            if ($siswaInfo && $siswaInfo->user_id) {
                DB::table('notifikasi')->insert([
                    'user_id' => $siswaInfo->user_id,
                    'tipe' => 'tindak_lanjut_laporan',
                    'judul' => "Tindak Lanjut Laporan ({$data->kode_laporan}): {$validated['status']}",
                    'pesan' => "Guru BK ({$user->name}) mencatat tindak lanjut pada laporan {$data->kode_laporan}: [{$validated['status']}] {$validated['catatan']}",
                    'referensi_tipe' => 'laporan_kasus',
                    'referensi_id' => $laporan,
                    'read_at' => null,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }

            DB::table('notifikasi')->insert([
                'user_id' => $user->id,
                'tipe' => 'arsip_tindak_lanjut',
                'judul' => "Arsip Tindak Lanjut ({$data->kode_laporan}): {$validated['status']}",
                'pesan' => "Tindak lanjut untuk {$namaSiswa} ({$data->kode_laporan}) telah dicatat: [{$validated['status']}] {$validated['catatan']}",
                'referensi_tipe' => 'laporan_kasus',
                'referensi_id' => $laporan,
                'read_at' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        });

        AuditLogger::record(
            $request,
            $user,
            'follow_up_added',
            'Menambahkan tindak lanjut pada laporan.',
            'laporan_kasus',
            $laporan,
            $data->kode_laporan
        );

        $waFollowupUrl = null;
        if ($siswaInfo && ! empty($siswaInfo->whatsapp_number)) {
            $digits = preg_replace('/\D+/', '', (string) $siswaInfo->whatsapp_number);
            if (str_starts_with($digits, '0')) {
                $digits = '62' . substr($digits, 1);
            } elseif (str_starts_with($digits, '8')) {
                $digits = '62' . $digits;
            }
            if ($digits !== '') {
                $namaSiswa = $siswaInfo->nama_siswa ?? 'Siswa';
                $waMessage = "Halo {$namaSiswa}, terkait laporan kamu ({$data->kode_laporan}) di layanan CurhatAman:\n\n"
                    . "*Status Tindak Lanjut:* {$validated['status']}\n"
                    . "*Catatan / Informasi:* {$validated['catatan']}\n\n"
                    . "Terima kasih — Guru BK ({$user->name})";
                $waFollowupUrl = 'https://wa.me/' . $digits . '?text=' . rawurlencode($waMessage);
            }
        }

        return redirect()
            ->route('guru-bk.laporan.show', $laporan)
            ->with(
                'success',
                'Tindak lanjut berhasil dicatat dan tersimpan ke arsip Notifikasi.'
            )
            ->with('wa_followup_url', $waFollowupUrl);
    }

    private function resolveExportFilters(Request $request): array
    {
        $pengaturan = PengaturanSistem::current();

        $tahunAjaran = trim((string) $request->query(
            'tahun_ajaran',
            $pengaturan->tahun_ajaran_aktif
        ));

        if (! preg_match('/^\d{4}\/\d{4}$/', $tahunAjaran)) {
            $tahunAjaran = $pengaturan->tahun_ajaran_aktif;
        }

        $semester = strtolower(trim((string) $request->query(
            'semester',
            $pengaturan->semester_aktif
        )));

        if (! in_array($semester, ['ganjil', 'genap'], true)) {
            $semester = $pengaturan->semester_aktif;
        }

        $cakupan = strtolower(trim((string) $request->query(
            'cakupan',
            'kasus_saya'
        )));

        if (! in_array($cakupan, ['kasus_saya', 'semua_kasus'], true)) {
            $cakupan = 'kasus_saya';
        }

        $search = trim((string) $request->query('q', ''));
        $status = (string) $request->query('status', '');
        $kategoriId = (string) $request->query('kategori', '');

        $kelasId = (string) $request->query(
            'kelas_id',
            ''
        );

        if (
            $kelasId !== ''
            && ! ctype_digit($kelasId)
        ) {
            $kelasId = '';
        }

        $bulan = (string) $request->query(
            'bulan',
            ''
        );

        if (
            $bulan !== ''
            && (
                ! ctype_digit($bulan)
                || (int) $bulan < 1
                || (int) $bulan > 12
            )
        ) {
            $bulan = '';
        }

        $bulanValid = $semester === 'ganjil'
            ? [7, 8, 9, 10, 11, 12]
            : [1, 2, 3, 4, 5, 6];

        if (
            $bulan !== ''
            && ! in_array(
                (int) $bulan,
                $bulanValid,
                true
            )
        ) {
            $bulan = '';
        }

        $kelasNama = null;

        if ($kelasId !== '') {
            $kelasNama = DB::table(
                'laporan_kasus'
            )
                ->where(
                    'tahun_ajaran',
                    $tahunAjaran
                )
                ->where(
                    'semester',
                    $semester
                )
                ->where(
                    'kelas_id_saat_laporan',
                    (int) $kelasId
                )
                ->value(
                    'nama_kelas_saat_laporan'
                );
        }

        $statusDiperbolehkan = [
            'baru',
            'diproses',
            'selesai',
            'dieskalasi',
        ];

        if (! in_array($status, $statusDiperbolehkan, true)) {
            $status = '';
        }

        if ($kategoriId !== '' && ! ctype_digit($kategoriId)) {
            $kategoriId = '';
        }

        return [
            'tahunAjaran' => $tahunAjaran,
            'semester' => $semester,
            'cakupan' => $cakupan,
            'search' => $search,
            'status' => $status,
            'kategoriId' => $kategoriId,
            'kelasId' => $kelasId,
            'kelasNama' => $kelasNama,
            'bulan' => $bulan,
        ];
    }

    private function buildExportQuery(
        array $filters,
        int $guruBkId
    ) {
        $query = DB::table('laporan_kasus')
            ->join(
                'siswa',
                'laporan_kasus.siswa_id',
                '=',
                'siswa.id'
            )
            ->join(
                'users',
                'siswa.user_id',
                '=',
                'users.id'
            )
            ->leftJoin(
                'kelas',
                'siswa.kelas_id',
                '=',
                'kelas.id'
            )
            ->join(
                'kategori_kasus',
                'laporan_kasus.kategori_id',
                '=',
                'kategori_kasus.id'
            )
            ->leftJoin(
                'users as assigned_bk',
                'laporan_kasus.assigned_bk_id',
                '=',
                'assigned_bk.id'
            )
            ->where(
                'laporan_kasus.status_kasus',
                '!=',
                'draft'
            )
            ->where(
                'laporan_kasus.tahun_ajaran',
                $filters['tahunAjaran']
            )
            ->where(
                'laporan_kasus.semester',
                $filters['semester']
            )
            ->select([
                'laporan_kasus.kode_laporan',
                'laporan_kasus.status_kasus',
                'laporan_kasus.assigned_bk_id',
                'laporan_kasus.tanggal_kejadian',
                'laporan_kasus.submitted_at',
                'laporan_kasus.created_at',
                'laporan_kasus.tahun_ajaran',
                'laporan_kasus.semester',
                'users.name as nama_siswa',
                'siswa.nis',

                DB::raw(
                    'COALESCE('
                    . 'laporan_kasus.nama_kelas_saat_laporan, '
                    . 'kelas.nama_kelas'
                    . ') as nama_kelas'
                ),

                'kategori_kasus.nama_kategori',
                'assigned_bk.name as nama_bk_penanggung_jawab',
            ]);

        if ($filters['cakupan'] === 'kasus_saya') {
            $query->where(function ($sub) use ($guruBkId) {
                $sub->where('laporan_kasus.assigned_bk_id', $guruBkId)
                    ->orWhereExists(function ($k) use ($guruBkId) {
                        $k->select(DB::raw(1))
                            ->from('konflik_kepentingan')
                            ->whereColumn('konflik_kepentingan.laporan_id', 'laporan_kasus.id')
                            ->where('konflik_kepentingan.user_id', $guruBkId)
                            ->where('konflik_kepentingan.ada_konflik', true);
                    });
            });
        }

        if ($filters['kelasId'] !== '') {
            $query->where(
                'laporan_kasus.kelas_id_saat_laporan',
                (int) $filters['kelasId']
            );
        }

        if ($filters['bulan'] !== '') {
            $query->whereRaw(
                'MONTH(COALESCE('
                . 'laporan_kasus.submitted_at, '
                . 'laporan_kasus.created_at'
                . ')) = ?',
                [
                    (int) $filters['bulan'],
                ]
            );
        }

        if ($filters['search'] !== '') {
            $search = $filters['search'];

            $query->where(function ($subQuery) use ($search) {
                $subQuery
                    ->where(
                        'laporan_kasus.kode_laporan',
                        'like',
                        '%' . $search . '%'
                    )
                    ->orWhere(
                        'users.name',
                        'like',
                        '%' . $search . '%'
                    )
                    ->orWhere(
                        'siswa.nis',
                        'like',
                        '%' . $search . '%'
                    );
            });
        }

        if ($filters['status'] !== '') {
            $query->where(
                'laporan_kasus.status_kasus',
                $filters['status']
            );
        }

        if ($filters['kategoriId'] !== '') {
            $query->where(
                'laporan_kasus.kategori_id',
                (int) $filters['kategoriId']
            );
        }

        return $query;
    }

    private function exportHtml(
        $laporan,
        array $filters,
        string $namaGuruBk
    ): string {
        $e = static fn ($value) =>
            htmlspecialchars(
                (string) $value,
                ENT_QUOTES,
                'UTF-8'
            );

        $statusLabel = static function ($status): string {
            return match ($status) {
                'baru' => 'Baru',
                'diproses' => 'Diproses',
                'selesai' => 'Selesai',
                'dieskalasi' => 'Dieskalasi',
                default => ucfirst((string) $status),
            };
        };

        $kasusSaya =
            $filters['cakupan'] === 'kasus_saya';

        $cakupanLabel = $kasusSaya
            ? 'Kasus Saya'
            : 'Semua Data Laporan';

        $html =
            '<html><head><meta charset="UTF-8">'
            . '<style>'
            . 'body{font-family:Arial,sans-serif;font-size:10pt;color:#172033;}'
            . 'h1{font-size:17pt;margin:0 0 6px;}'
            . 'h2{font-size:12pt;margin:18px 0 7px;color:#0b6f69;}'
            . 'h3{font-size:11pt;margin:14px 0 6px;color:#344054;}'
            . 'h4{font-size:9.8pt;margin:10px 0 5px;color:#475467;}'
            . 'p{margin:3px 0 9px;line-height:1.45;}'
            . 'table{border-collapse:collapse;width:100%;margin-top:6px;margin-bottom:16px;}'
            . 'th,td{border:1px solid #cfd8d8;padding:6px 7px;text-align:left;vertical-align:top;}'
            . 'th{background:#eaf6f4;font-weight:bold;font-size:9pt;}'
            . 'td{font-size:9pt;}'
            . '.muted{color:#667085;}'
            . '</style></head><body>';

        $kelompokBulan = $laporan->groupBy(
            function ($item) {
                $tanggalMasuk =
                    $item->submitted_at
                    ?? $item->created_at;

                return \Carbon\Carbon::parse(
                    $tanggalMasuk
                )->format('Y-m');
            }
        );

        $html .=
            '<h1>Laporan Kasus Guru BK - CurhatAman</h1>';

        $html .=
            '<p><strong>Guru BK:</strong> '
            . $e($namaGuruBk)
            . '<br><strong>Tahun Ajaran:</strong> '
            . $e($filters['tahunAjaran'])
            . '<br><strong>Semester:</strong> '
            . $e(ucfirst($filters['semester']))
            . (
                $filters['bulan'] !== ''
                    ? '<br><strong>Bulan:</strong> '
                        . $e(
                            [
                                1 => 'Januari',
                                2 => 'Februari',
                                3 => 'Maret',
                                4 => 'April',
                                5 => 'Mei',
                                6 => 'Juni',
                                7 => 'Juli',
                                8 => 'Agustus',
                                9 => 'September',
                                10 => 'Oktober',
                                11 => 'November',
                                12 => 'Desember',
                            ][(int) $filters['bulan']]
                        )
                    : ''
            )
            . (
                $filters['kelasNama']
                    ? '<br><strong>Kelas:</strong> '
                        . $e($filters['kelasNama'])
                    : ''
            )
            . '<br><strong>Cakupan:</strong> '
            . $e($cakupanLabel)
            . '</p>';

        if ($kasusSaya) {
            $html .=
                '<p class="muted">'
                . 'Dokumen ini hanya berisi laporan yang menjadi tanggung jawab '
                . 'Guru BK yang sedang login sesuai filter. '
                . 'Kronologi, bukti, dan isi tindak lanjut tidak disertakan.'
                . '</p>';

            if ($laporan->isEmpty()) {
                $html .=
                    '<p>Tidak ada kasus yang ditangani pada filter terpilih.</p>';
            } else {
                foreach ($kelompokBulan as $bulanKey => $items) {
                    $bulanLabel = \Carbon\Carbon::createFromFormat(
                        'Y-m',
                        $bulanKey
                    )
                        ->locale('id')
                        ->translatedFormat('F Y');

                    $html .=
                        '<h2>'
                        . $e($bulanLabel)
                        . ' · '
                        . $e($items->count())
                        . ' laporan</h2>';

                    $html .=
                        '<table><thead><tr>'
                        . '<th>No.</th>'
                        . '<th>Kode</th>'
                        . '<th>Pelapor</th>'
                        . '<th>NIS</th>'
                        . '<th>Kelas</th>'
                        . '<th>Kategori</th>'
                        . '<th>Tanggal Kejadian</th>'
                        . '<th>Status</th>'
                        . '<th>Tanggal Masuk</th>'
                        . '<th>Penanggung Jawab</th>'
                        . '</tr></thead><tbody>';

                    foreach ($items->values() as $index => $item) {
                        $tanggalMasuk =
                            $item->submitted_at
                            ?? $item->created_at;

                        $html .=
                            '<tr>'
                            . '<td>' . $e($index + 1) . '</td>'
                            . '<td>' . $e($item->kode_laporan) . '</td>'
                            . '<td>' . $e($item->nama_siswa) . '</td>'
                            . '<td>' . $e($item->nis ?: '-') . '</td>'
                            . '<td>' . $e($item->nama_kelas ?: '-') . '</td>'
                            . '<td>' . $e($item->nama_kategori) . '</td>'
                            . '<td>'
                            . $e(
                                \Carbon\Carbon::parse(
                                    $item->tanggal_kejadian
                                )->format('d-m-Y')
                            )
                            . '</td>'
                            . '<td>'
                            . $e(
                                $statusLabel(
                                    $item->status_kasus
                                )
                            )
                            . '</td>'
                            . '<td>'
                            . $e(
                                \Carbon\Carbon::parse(
                                    $tanggalMasuk
                                )->format('d-m-Y')
                            )
                            . '</td>'
                            . '<td>'
                            . $e(
                                $item->nama_bk_penanggung_jawab
                                ?: $namaGuruBk
                            )
                            . '</td>'
                            . '</tr>';
                    }

                    $html .= '</tbody></table>';
                }
            }
        } else {
            $html .=
                '<p class="muted">'
                . 'Dokumen ini berisi seluruh laporan masuk pada periode terpilih, '
                . 'termasuk laporan yang belum ditangani, sedang ditangani oleh '
                . 'Guru BK mana pun, maupun sudah selesai. Arsip disusun berdasarkan '
                . 'bulan, kelas saat laporan dibuat, dan status penanganan. '
                . 'Identitas siswa, NIS, kronologi, bukti, dan isi tindak lanjut '
                . 'tidak disertakan.'
                . '</p>';

            if ($laporan->isEmpty()) {
                $html .=
                    '<p>Tidak ada laporan pada filter terpilih.</p>';
            } else {
                foreach ($kelompokBulan as $bulanKey => $itemsBulan) {
                    $bulanLabel = \Carbon\Carbon::createFromFormat(
                        'Y-m',
                        $bulanKey
                    )
                        ->locale('id')
                        ->translatedFormat('F Y');

                    $html .=
                        '<h2>'
                        . $e($bulanLabel)
                        . ' · '
                        . $e($itemsBulan->count())
                        . ' laporan</h2>';

                    $kelompokKelas = $itemsBulan
                        ->groupBy(
                            fn ($item) =>
                                $item->nama_kelas
                                ?: 'Kelas tidak tercatat'
                        )
                        ->sortKeys();

                    foreach (
                        $kelompokKelas
                        as $namaKelas => $itemsKelas
                    ) {
                        $html .=
                            '<h3>Kelas '
                            . $e($namaKelas)
                            . ' · '
                            . $e($itemsKelas->count())
                            . ' laporan</h3>';

                        $kelompokPenanganan = [
                            'Belum Ditangani' =>
                                $itemsKelas
                                    ->filter(
                                        fn ($item) =>
                                            is_null(
                                                $item->assigned_bk_id
                                                ?? null
                                            )
                                            && $item->status_kasus !== 'selesai'
                                    )
                                    ->values(),

                            'Sedang Ditangani' =>
                                $itemsKelas
                                    ->filter(
                                        fn ($item) =>
                                            ! is_null(
                                                $item->assigned_bk_id
                                                ?? null
                                            )
                                            && $item->status_kasus !== 'selesai'
                                    )
                                    ->values(),

                            'Selesai' =>
                                $itemsKelas
                                    ->filter(
                                        fn ($item) =>
                                            $item->status_kasus === 'selesai'
                                    )
                                    ->values(),
                        ];

                        foreach (
                            $kelompokPenanganan
                            as $kategoriPenanganan => $itemsKategori
                        ) {
                            if ($itemsKategori->isEmpty()) {
                                continue;
                            }

                            $html .=
                                '<h4>'
                                . $e($kategoriPenanganan)
                                . ' · '
                                . $e($itemsKategori->count())
                                . ' laporan</h4>';

                            $html .=
                                '<table><thead><tr>'
                                . '<th>No.</th>'
                                . '<th>Kode</th>'
                                . '<th>Kategori Kasus</th>'
                                . '<th>Status Kasus</th>'
                                . '<th>Tanggal Masuk</th>'
                                . '<th>Penanggung Jawab</th>'
                                . '</tr></thead><tbody>';

                            foreach (
                                $itemsKategori
                                as $index => $item
                            ) {
                                $tanggalMasuk =
                                    $item->submitted_at
                                    ?? $item->created_at;

                                $html .=
                                    '<tr>'
                                    . '<td>' . $e($index + 1) . '</td>'
                                    . '<td>' . $e($item->kode_laporan) . '</td>'
                                    . '<td>' . $e($item->nama_kategori) . '</td>'
                                    . '<td>'
                                    . $e(
                                        $statusLabel(
                                            $item->status_kasus
                                        )
                                    )
                                    . '</td>'
                                    . '<td>'
                                    . $e(
                                        \Carbon\Carbon::parse(
                                            $tanggalMasuk
                                        )->format('d-m-Y')
                                    )
                                    . '</td>'
                                    . '<td>'
                                    . $e(
                                        $item->nama_bk_penanggung_jawab
                                        ?: 'Belum ditangani'
                                    )
                                    . '</td>'
                                    . '</tr>';
                            }

                            $html .= '</tbody></table>';
                        }
                    }
                }
            }
        }

        $html .=
            '<p class="muted" style="margin-top:12px;">'
            . 'Dicetak pada '
            . $e(
                now()
                    ->locale('id')
                    ->translatedFormat('d F Y H:i')
            )
            . ' WIB.'
            . '</p>';

        $html .= '</body></html>';

        return $html;
    }

}

