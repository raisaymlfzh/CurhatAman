<?php

namespace App\Http\Controllers\GuruBK;

use App\Http\Controllers\Controller;
use App\Models\PengaturanSistem;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SkriningSiswaController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        abort_unless(
            $user && $user->role === 'counselor',
            403,
            'Kamu tidak memiliki akses ke halaman Guru BK.'
        );

        $pengaturan = PengaturanSistem::current();

        $search = trim(
            (string) $request->query(
                'q',
                ''
            )
        );

        $status = trim(
            (string) $request->query(
                'status',
                ''
            )
        );

        if (
            ! in_array(
                $status,
                [
                    '',
                    'berlangsung',
                    'selesai',
                ],
                true
            )
        ) {
            $status = '';
        }

        $tahunSnapshot = DB::table(
                'skrining_siswa'
            )
            ->whereNotNull(
                'tahun_ajaran'
            )
            ->where(
                'tahun_ajaran',
                '!=',
                ''
            )
            ->distinct()
            ->pluck(
                'tahun_ajaran'
            );

        $tahunLegacy = DB::table(
                'skrining_siswa'
            )
            ->where(
                function ($query) {
                    $query
                        ->whereNull(
                            'tahun_ajaran'
                        )
                        ->orWhereNull(
                            'semester'
                        );
                }
            )
            ->selectRaw(
                'COALESCE(completed_at, started_at, created_at) as tanggal_referensi'
            )
            ->pluck(
                'tanggal_referensi'
            )
            ->filter()
            ->map(
                fn ($tanggal) =>
                    $this->academicYearFromDate(
                        Carbon::parse(
                            $tanggal
                        )
                    )
            );

        $tahunAjaranOptions = $tahunSnapshot
            ->merge(
                $tahunLegacy
            )
            ->prepend(
                $pengaturan->tahun_ajaran_aktif
            )
            ->filter()
            ->unique()
            ->sortDesc()
            ->values();

        $tahunAjaran = trim(
            (string) $request->query(
                'tahun_ajaran',
                $pengaturan->tahun_ajaran_aktif
            )
        );

        if ($tahunAjaran === '') {
            $tahunAjaran =
                $pengaturan->tahun_ajaran_aktif;
        }

        if (
            $tahunAjaran !== 'semua'
            && ! $tahunAjaranOptions->contains(
                $tahunAjaran
            )
        ) {
            $tahunAjaran =
                $pengaturan->tahun_ajaran_aktif;
        }

        $semester = strtolower(
            trim(
                (string) $request->query(
                    'semester',
                    $pengaturan->semester_aktif
                )
            )
        );

        if (
            ! in_array(
                $semester,
                [
                    'ganjil',
                    'genap',
                    'semua',
                ],
                true
            )
        ) {
            $semester =
                $pengaturan->semester_aktif;
        }

        $bulanOptions = $semester === 'ganjil'
            ? collect([
                7 => 'Juli',
                8 => 'Agustus',
                9 => 'September',
                10 => 'Oktober',
                11 => 'November',
                12 => 'Desember',
            ])
            : (
                $semester === 'genap'
                    ? collect([
                        1 => 'Januari',
                        2 => 'Februari',
                        3 => 'Maret',
                        4 => 'April',
                        5 => 'Mei',
                        6 => 'Juni',
                    ])
                    : collect()
            );

        $bulan = $request->filled(
            'bulan'
        )
            ? (int) $request->query(
                'bulan'
            )
            : null;

        if (
            $bulan !== null
            && ! $bulanOptions->has(
                $bulan
            )
        ) {
            $bulan = null;
        }

        $kelasOptionsQuery = DB::table(
                'skrining_siswa'
            )
            ->whereNotNull(
                'kelas_id_saat_skrining'
            )
            ->whereNotNull(
                'nama_kelas_saat_skrining'
            );

        if ($tahunAjaran !== 'semua') {
            $kelasOptionsQuery->where(
                'tahun_ajaran',
                $tahunAjaran
            );
        }

        if ($semester !== 'semua') {
            $kelasOptionsQuery->where(
                'semester',
                $semester
            );
        }

        $kelasOptions = $kelasOptionsQuery
            ->select([
                'kelas_id_saat_skrining as id',
                'nama_kelas_saat_skrining as nama_kelas',
                'tingkat_saat_skrining as tingkat',
            ])
            ->distinct()
            ->orderBy(
                'tingkat'
            )
            ->orderBy(
                'nama_kelas_saat_skrining'
            )
            ->get();

        $kelasId = $request->filled(
            'kelas_id'
        )
            ? (int) $request->query(
                'kelas_id'
            )
            : null;

        if (
            $kelasId !== null
            && ! $kelasOptions->contains(
                fn ($item) =>
                    (int) $item->id
                    === $kelasId
            )
        ) {
            $kelasId = null;
        }

        $query = DB::table(
                'skrining_siswa'
            )
            ->join(
                'siswa',
                'skrining_siswa.siswa_id',
                '=',
                'siswa.id'
            )
            ->join(
                'users',
                'siswa.user_id',
                '=',
                'users.id'
            )
            ->leftJoin('users as assigned_bk', 'skrining_siswa.assigned_bk_id', '=', 'assigned_bk.id')
            ->select([
                'skrining_siswa.id',
                'skrining_siswa.siswa_id',
                'skrining_siswa.status',
                'skrining_siswa.started_at',
                'skrining_siswa.completed_at',
                'skrining_siswa.created_at',
                'skrining_siswa.kelas_id_saat_skrining',
                'skrining_siswa.nama_kelas_saat_skrining as nama_kelas',
                'skrining_siswa.tingkat_saat_skrining as tingkat',
                'skrining_siswa.tahun_ajaran',
                  'skrining_siswa.assigned_bk_id',
                  'assigned_bk.name as nama_bk',
                'skrining_siswa.semester',
                'users.name as nama_siswa',
                'siswa.nis',
            ]);

        $this->applyAcademicFilters(
            $query,
            $tahunAjaran,
            $semester,
            $bulan,
            $kelasId
        );

        if ($search !== '') {
            $query->where(
                function ($subQuery) use (
                    $search
                ) {
                    $subQuery
                        ->where(
                            'users.name',
                            'like',
                            '%' . $search . '%'
                        )
                        ->orWhere(
                            'siswa.nis',
                            'like',
                            '%' . $search . '%'
                        )
                        ->orWhere(
                            'skrining_siswa.nama_kelas_saat_skrining',
                            'like',
                            '%' . $search . '%'
                        );
                }
            );
        }

        if ($status !== '') {
            $query->where(
                'skrining_siswa.status',
                $status
            );
        }

        $skrining = $query
            ->orderByDesc(
                DB::raw(
                    'COALESCE(
                        skrining_siswa.completed_at,
                        skrining_siswa.started_at,
                        skrining_siswa.created_at
                    )'
                )
            )
            ->paginate(15)
            ->withQueryString();

        $skriningIds = $skrining
            ->getCollection()
            ->pluck('id')
            ->all();

        $jawaban = collect();

        if (! empty($skriningIds)) {
            $jawaban = DB::table(
                    'jawaban_skrining'
                )
                ->join(
                    'pertanyaan_skrining',
                    'jawaban_skrining.pertanyaan_id',
                    '=',
                    'pertanyaan_skrining.id'
                )
                ->whereIn(
                    'jawaban_skrining.skrining_id',
                    $skriningIds
                )
                ->select([
                    'jawaban_skrining.skrining_id',
                    'jawaban_skrining.jawaban',
                    'pertanyaan_skrining.aspek',
                    'pertanyaan_skrining.reverse_score',
                ])
                ->get()
                ->groupBy(
                    'skrining_id'
                );
        }

        $skrining->setCollection(
            $skrining
                ->getCollection()
                ->map(
                    function ($item) use (
                        $jawaban
                    ) {
                        $item->skor_e = null;
                        $item->skor_c = null;
                        $item->skor_h = null;
                        $item->skor_p = null;
                        $item->skor_pro = null;
                        $item->total_kesulitan = null;
                        $item->interpretasi = null;

                        if (
                            $item->status
                            !== 'selesai'
                        ) {
                            return $item;
                        }

                        $hasil = $this->hitungSkor(
                            $jawaban->get(
                                $item->id,
                                collect()
                            )
                        );

                        $item->skor_e =
                            $hasil['E'];

                        $item->skor_c =
                            $hasil['C'];

                        $item->skor_h =
                            $hasil['H'];

                        $item->skor_p =
                            $hasil['P'];

                        $item->skor_pro =
                            $hasil['Pro'];

                        $item->total_kesulitan =
                            $hasil[
                                'total_kesulitan'
                            ];

                        $item->interpretasi =
                            $hasil[
                                'interpretasi'
                            ];

                        return $item;
                    }
                )
        );

        $summaryQuery = DB::table(
            'skrining_siswa'
        );

        $this->applyAcademicFilters(
            $summaryQuery,
            $tahunAjaran,
            $semester,
            $bulan,
            $kelasId
        );

        $totalSesiPeriode = (
            clone $summaryQuery
        )->count();

        $selesaiPeriode = (
            clone $summaryQuery
        )
            ->where(
                'status',
                'selesai'
            )
            ->count();

        $sedangBerlangsung = (
            clone $summaryQuery
        )
            ->where(
                'status',
                'berlangsung'
            )
            ->count();

        $dataLamaPeriodeQuery = DB::table(
                'skrining_siswa'
            )
            ->where(
                function ($query) {
                    $query
                        ->whereNull(
                            'tahun_ajaran'
                        )
                        ->orWhereNull(
                            'semester'
                        )
                        ->orWhereNull(
                            'kelas_id_saat_skrining'
                        );
                }
            );

        $this->applyLegacyPeriodFilters(
            $dataLamaPeriodeQuery,
            $tahunAjaran,
            $semester,
            $bulan
        );

        $dataLamaPeriode = (
            clone $dataLamaPeriodeQuery
        )->count();

        $dataLamaTanpaSnapshot =
            $kelasId === null
                ? $dataLamaPeriode
                : 0;

        $dataLamaDikecualikan =
            $kelasId !== null
                ? $dataLamaPeriode
                : 0;

        $periodeLabel = $this->buildPeriodLabel(
            $tahunAjaran,
            $semester,
            $bulan,
            $bulanOptions
        );

        return view(
            'guru-bk.skrining.index',
            compact(
                'user',
                'skrining',
                'search',
                'status',
                'tahunAjaran',
                'tahunAjaranOptions',
                'semester',
                'bulan',
                'bulanOptions',
                'kelasId',
                'kelasOptions',
                'totalSesiPeriode',
                'selesaiPeriode',
                'sedangBerlangsung',
                'dataLamaTanpaSnapshot',
                'dataLamaDikecualikan',
                'periodeLabel'
            )
        );
    }

    public function exportExcel(Request $request)
    {
        $data = $this->buildExportData(
            $request
        );

        return response()->streamDownload(
            function () use ($data) {
                echo "\xEF\xBB\xBF";
                echo $this->exportHtml(
                    $data
                );
            },
            $this->exportFileName(
                $data,
                'xls'
            ),
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
        $data = $this->buildExportData(
            $request
        );

        return Pdf::loadHTML(
            $this->exportHtml(
                $data
            )
        )
            ->setPaper(
                'a4',
                'landscape'
            )
            ->download(
                $this->exportFileName(
                    $data,
                    'pdf'
                )
            );
    }

    public function exportDetailPdf(Request $request, int $skrining)
    {
        $user = $request->user();

        abort_unless(
            $user && $user->role === 'counselor',
            403,
            'Kamu tidak memiliki akses ke halaman Guru BK.'
        );

        $sesi = DB::table('skrining_siswa')
            ->join('siswa', 'skrining_siswa.siswa_id', '=', 'siswa.id')
            ->join('users', 'siswa.user_id', '=', 'users.id')
            ->leftJoin('users as assigned_bk', 'skrining_siswa.assigned_bk_id', '=', 'assigned_bk.id')
            ->where('skrining_siswa.id', $skrining)
            ->select([
                'skrining_siswa.id',
                'skrining_siswa.siswa_id',
                'skrining_siswa.status',
                'skrining_siswa.started_at',
                'skrining_siswa.completed_at',
                'skrining_siswa.nama_kelas_saat_skrining as nama_kelas',
                'skrining_siswa.tahun_ajaran',
                'skrining_siswa.assigned_bk_id',
                'assigned_bk.name as nama_bk',
                'skrining_siswa.semester',
                'users.name as nama_siswa',
                'siswa.nis',
            ])
            ->first();

        abort_unless($sesi, 404, 'Sesi skrining tidak ditemukan.');
        abort_unless($sesi->status === 'selesai', 422, 'Hasil skrining tersedia setelah sesi selesai.');

        $jawaban = DB::table('jawaban_skrining')
            ->join('pertanyaan_skrining', 'jawaban_skrining.pertanyaan_id', '=', 'pertanyaan_skrining.id')
            ->where('jawaban_skrining.skrining_id', $skrining)
            ->select([
                'jawaban_skrining.jawaban',
                'pertanyaan_skrining.aspek',
                'pertanyaan_skrining.reverse_score',
            ])
            ->get();

        $hasil = $this->hitungSkor($jawaban);

        $pengaturan = \App\Models\PengaturanSistem::current();

        $html = '<!DOCTYPE html><html><head><meta charset="UTF-8"><title>Hasil Skrining SDQ - ' . htmlspecialchars($sesi->nama_siswa) . '</title>';
        $html .= '<style>
            @page { margin: 28px 32px; }
            body { font-family: DejaVu Sans, Arial, Helvetica, sans-serif; font-size: 11px; color: #172033; line-height: 1.5; margin: 0; }
            .section-title { font-size: 11px; font-weight: bold; color: #0b6f69; margin: 14px 0 6px; text-transform: uppercase; border-bottom: 1px solid #dfe6e6; padding-bottom: 3px; }
            table.info-table { width: 100%; border-collapse: collapse; margin-bottom: 14px; font-size: 10.5px; }
            table.info-table td { padding: 4px 6px; }
            table.score-table { width: 100%; border-collapse: collapse; margin-bottom: 16px; text-align: center; font-size: 10.5px; }
            table.score-table th, table.score-table td { border: 1px solid #dfe6e6; padding: 7px 5px; }
            table.score-table th { background: #eaf6f4; color: #172033; }
        </style></head><body>';

        // Official Kop Surat
        $html .= $pengaturan->getKopSuratHtml();

        $html .= '<div style="text-align: center; margin-bottom: 16px;">';
        $html .= '<h2 style="margin: 0; color: #0b6f69; font-size: 15px; text-transform: uppercase;">Laporan Hasil Skrining Psikososial Siswa (SDQ)</h2>';
        $html .= '<p style="margin: 3px 0 0 0; color: #64748b; font-size: 9.5px;">Strengths and Difficulties Questionnaire (Kuesioner Kekuatan & Kesulitan)</p>';
        $html .= '</div>';
        
        $html .= '<div class="section-title">A. IDENTITAS PESERTA DIDIK</div>';
        $html .= '<table class="info-table" style="border: 1px solid #dfe6e6;">';
        $html .= '<tr style="background: #f8fafc;"><td style="width: 25%; font-weight: bold; color: #475467; border-bottom: 1px solid #dfe6e6;">Nama Lengkap</td><td style="border-bottom: 1px solid #dfe6e6;">: <strong>' . htmlspecialchars($sesi->nama_siswa) . '</strong></td></tr>';
        $html .= '<tr><td style="font-weight: bold; color: #475467; border-bottom: 1px solid #dfe6e6;">NIS / Kelas</td><td style="border-bottom: 1px solid #dfe6e6;">: ' . htmlspecialchars($sesi->nama_kelas ?? '-') . ' / ' . htmlspecialchars($sesi->tahun_ajaran ?? '-') . '</td></tr>';
        $html .= '<tr style="background: #f8fafc;"><td style="font-weight: bold; color: #475467;">Tanggal Pengisian</td><td>: ' . \Carbon\Carbon::parse($sesi->completed_at)->locale('id')->translatedFormat('d F Y, H:i') . ' WIB</td></tr>';
        $html .= '</table>';

        $html .= '<div class="section-title">B. HASIL SKORING & INTERPRETASI SKRINING</div>';
        $html .= '<table class="score-table">';
        $html .= '<tr>';
        $html .= '<th>Skor E<br><small>(Gejala Emosional)</small></th>';
        $html .= '<th>Skor C<br><small>(Masalah Perilaku)</small></th>';
        $html .= '<th>Skor H<br><small>(Hiperaktivitas)</small></th>';
        $html .= '<th>Skor P<br><small>(Masalah Teman Sebaya)</small></th>';
        $html .= '<th>Skor Pro<br><small>(Perilaku Prososial)</small></th>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td style="padding: 10px; font-weight: bold; font-size: 13px;">' . ($hasil['E'] ?? $hasil['e'] ?? 0) . '</td>';
        $html .= '<td style="padding: 10px; font-weight: bold; font-size: 13px;">' . ($hasil['C'] ?? $hasil['c'] ?? 0) . '</td>';
        $html .= '<td style="padding: 10px; font-weight: bold; font-size: 13px;">' . ($hasil['H'] ?? $hasil['h'] ?? 0) . '</td>';
        $html .= '<td style="padding: 10px; font-weight: bold; font-size: 13px;">' . ($hasil['P'] ?? $hasil['p'] ?? 0) . '</td>';
        $html .= '<td style="padding: 10px; font-weight: bold; font-size: 13px;">' . ($hasil['Pro'] ?? $hasil['pro'] ?? 0) . '</td>';
        $html .= '</tr>';
        $html .= '</table>';

        $badgeColor = ($hasil['interpretasi'] === 'Abnormal' || str_contains($hasil['interpretasi'], 'Tinggi')) ? '#b42318' : (($hasil['interpretasi'] === 'Borderline') ? '#b54708' : '#027a48');
        $html .= '<div style="margin-bottom: 16px; padding: 12px 14px; background-color: #f8fafc; border-left: 4px solid ' . $badgeColor . '; border-radius: 4px; border: 1px solid #e2e8f0; border-left-width: 4px;">';
        $html .= '<div><strong>Total Skor Kesulitan:</strong> ' . $hasil['total_kesulitan'] . ' / 40</div>';
        $html .= '<div style="margin-top: 4px;"><strong>Kesimpulan Interpretasi:</strong> <span style="font-weight: bold; color: ' . $badgeColor . ';">' . $hasil['interpretasi'] . '</span></div>';
        if ($sesi->assigned_bk_id) {
            $html .= '<div style="margin-top: 4px; font-size: 10px; color: #475467;"><strong>Penanggung Jawab Penanganan:</strong> ' . htmlspecialchars($sesi->nama_bk) . '</div>';
        }
        $html .= '</div>';

        // Lembar Pengesahan (Kepala Sekolah & Guru BK)
        $html .= $pengaturan->getPengesahanHtml($user->name, 'Guru Bimbingan Konseling');

        $html .= '</body></html>';

        $fileName = 'Hasil_Skrining_' . str_replace(' ', '_', $sesi->nama_siswa) . '.pdf';

        return \Barryvdh\DomPDF\Facade\Pdf::loadHTML($html)
            ->setPaper('a4', 'portrait')
            ->download($fileName);
    }

    public function takeAssignment(Request $request, int $skrining)
    {
        $user = $request->user();
        
        abort_unless(
            $user && $user->role === 'counselor',
            403,
            'Kamu tidak memiliki akses.'
        );

        $sesi = DB::table('skrining_siswa')->where('id', $skrining)->first();
        abort_unless($sesi, 404, 'Data skrining tidak ditemukan.');

        if (! $sesi->assigned_bk_id) {
            DB::table('skrining_siswa')->where('id', $skrining)->update([
                'assigned_bk_id' => $user->id,
                'updated_at' => now(),
            ]);
        }

        return redirect()->back()->with('success', 'Kamu telah mengambil penanganan untuk skrining siswa ini.');
    }

    public function show(
        Request $request,
        int $skrining
    ) {
        $user = $request->user();

        abort_unless(
            $user && $user->role === 'counselor',
            403,
            'Kamu tidak memiliki akses ke halaman Guru BK.'
        );

        $sesi = DB::table(
                'skrining_siswa'
            )
            ->join(
                'siswa',
                'skrining_siswa.siswa_id',
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
                'users as assigned_bk',
                'skrining_siswa.assigned_bk_id',
                '=',
                'assigned_bk.id'
            )
            ->where(
                'skrining_siswa.id',
                $skrining
            )
            ->select([
                'skrining_siswa.id',
                'skrining_siswa.siswa_id',
                'skrining_siswa.status',
                'skrining_siswa.started_at',
                'skrining_siswa.completed_at',
                'skrining_siswa.nama_kelas_saat_skrining as nama_kelas',
                'skrining_siswa.tahun_ajaran',
                  'skrining_siswa.assigned_bk_id',
                  'assigned_bk.name as nama_bk',
                'skrining_siswa.semester',
                'users.name as nama_siswa',
                'siswa.nis',
                'siswa.whatsapp_number',
                'siswa.whatsapp_consent',
                'siswa.whatsapp_consent_at',
            ])
            ->first();

        abort_unless(
            $sesi,
            404,
            'Sesi skrining tidak ditemukan.'
        );

        abort_unless(
            $sesi->status === 'selesai',
            422,
            'Hasil skrining tersedia setelah sesi selesai.'
        );

        $jawaban = DB::table(
                'jawaban_skrining'
            )
            ->join(
                'pertanyaan_skrining',
                'jawaban_skrining.pertanyaan_id',
                '=',
                'pertanyaan_skrining.id'
            )
            ->where(
                'jawaban_skrining.skrining_id',
                $skrining
            )
            ->select([
                'jawaban_skrining.jawaban',
                'pertanyaan_skrining.aspek',
                'pertanyaan_skrining.reverse_score',
            ])
            ->get();

        $hasil = $this->hitungSkor(
            $jawaban
        );

        return view(
            'guru-bk.skrining.show',
            compact(
                'user',
                'sesi',
                'hasil'
            )
        );
    }

    private function buildExportData(
        Request $request
    ): array {
        $user = $request->user();

        abort_unless(
            $user && $user->role === 'counselor',
            403,
            'Kamu tidak memiliki akses ke halaman Guru BK.'
        );

        $pengaturan = PengaturanSistem::current();

        $tahunAjaran = trim(
            (string) $request->query(
                'tahun_ajaran',
                $pengaturan->tahun_ajaran_aktif
            )
        );

        if (
            $tahunAjaran !== 'semua'
            && ! preg_match(
                '/^\d{4}\/\d{4}$/',
                $tahunAjaran
            )
        ) {
            $tahunAjaran =
                $pengaturan->tahun_ajaran_aktif;
        }

        $semester = strtolower(
            trim(
                (string) $request->query(
                    'semester',
                    $pengaturan->semester_aktif
                )
            )
        );

        if (
            ! in_array(
                $semester,
                [
                    'ganjil',
                    'genap',
                    'semua',
                ],
                true
            )
        ) {
            $semester =
                $pengaturan->semester_aktif;
        }

        $bulan = $request->filled(
            'bulan'
        )
            ? (int) $request->query(
                'bulan'
            )
            : null;

        $bulanValid = $semester === 'ganjil'
            ? [
                7,
                8,
                9,
                10,
                11,
                12,
            ]
            : (
                $semester === 'genap'
                    ? [
                        1,
                        2,
                        3,
                        4,
                        5,
                        6,
                    ]
                    : []
            );

        if (
            $bulan !== null
            && ! in_array(
                $bulan,
                $bulanValid,
                true
            )
        ) {
            $bulan = null;
        }

        $kelasId = $request->filled(
            'kelas_id'
        )
            ? (int) $request->query(
                'kelas_id'
            )
            : null;

        $search = trim(
            (string) $request->query(
                'q',
                ''
            )
        );

        $status = trim(
            (string) $request->query(
                'status',
                ''
            )
        );

        if (
            ! in_array(
                $status,
                [
                    '',
                    'berlangsung',
                    'selesai',
                ],
                true
            )
        ) {
            $status = '';
        }

        $query = DB::table(
                'skrining_siswa'
            )
            ->join(
                'siswa',
                'skrining_siswa.siswa_id',
                '=',
                'siswa.id'
            )
            ->join(
                'users',
                'siswa.user_id',
                '=',
                'users.id'
            )
            ->leftJoin('users as assigned_bk', 'skrining_siswa.assigned_bk_id', '=', 'assigned_bk.id')
            ->select([
                'skrining_siswa.id',
                'skrining_siswa.siswa_id',
                'skrining_siswa.status',
                'skrining_siswa.started_at',
                'skrining_siswa.completed_at',
                'skrining_siswa.created_at',
                'skrining_siswa.kelas_id_saat_skrining',
                'skrining_siswa.nama_kelas_saat_skrining',
                'skrining_siswa.tingkat_saat_skrining',
                'skrining_siswa.tahun_ajaran',
                  'skrining_siswa.assigned_bk_id',
                  'assigned_bk.name as nama_bk',
                'skrining_siswa.semester',
                'users.name as nama_siswa',
                'siswa.nis',
            ]);

        $this->applyAcademicFilters(
            $query,
            $tahunAjaran,
            $semester,
            $bulan,
            $kelasId
        );

        if ($search !== '') {
            $query->where(
                function ($subQuery) use (
                    $search
                ) {
                    $subQuery
                        ->where(
                            'users.name',
                            'like',
                            '%' . $search . '%'
                        )
                        ->orWhere(
                            'siswa.nis',
                            'like',
                            '%' . $search . '%'
                        )
                        ->orWhere(
                            'skrining_siswa.nama_kelas_saat_skrining',
                            'like',
                            '%' . $search . '%'
                        );
                }
            );
        }

        if ($status !== '') {
            $query->where(
                'skrining_siswa.status',
                $status
            );
        }

        $rows = $query
            ->orderByDesc(
                DB::raw(
                    $this->referenceDateSql()
                )
            )
            ->get();

        $ids = $rows
            ->pluck('id')
            ->all();

        $jawaban = collect();

        if (! empty($ids)) {
            $jawaban = DB::table(
                    'jawaban_skrining'
                )
                ->join(
                    'pertanyaan_skrining',
                    'jawaban_skrining.pertanyaan_id',
                    '=',
                    'pertanyaan_skrining.id'
                )
                ->whereIn(
                    'jawaban_skrining.skrining_id',
                    $ids
                )
                ->select([
                    'jawaban_skrining.skrining_id',
                    'jawaban_skrining.jawaban',
                    'pertanyaan_skrining.aspek',
                    'pertanyaan_skrining.reverse_score',
                ])
                ->get()
                ->groupBy(
                    'skrining_id'
                );
        }

        $rows = $rows->map(
            function ($item) use (
                $jawaban
            ) {
                $tanggal = Carbon::parse(
                    $item->completed_at
                    ?? $item->started_at
                    ?? $item->created_at
                );

                $item->tahun_ajaran_arsip =
                    $item->tahun_ajaran
                    ?: $this->academicYearFromDate(
                        $tanggal
                    );

                $item->semester_arsip =
                    $item->semester
                    ?: (
                        $tanggal->month >= 7
                        && $tanggal->month <= 12
                            ? 'ganjil'
                            : 'genap'
                    );

                $item->nama_kelas_arsip =
                    $item->nama_kelas_saat_skrining
                    ?: 'Data lama tanpa snapshot kelas';

                $item->tanggal_referensi =
                    $tanggal;

                $item->skor_e = null;
                $item->skor_c = null;
                $item->skor_h = null;
                $item->skor_p = null;
                $item->skor_pro = null;
                $item->total_kesulitan = null;
                $item->interpretasi = null;

                if (
                    $item->status === 'selesai'
                ) {
                    $hasil = $this->hitungSkor(
                        $jawaban->get(
                            $item->id,
                            collect()
                        )
                    );

                    $item->skor_e =
                        $hasil['E'];

                    $item->skor_c =
                        $hasil['C'];

                    $item->skor_h =
                        $hasil['H'];

                    $item->skor_p =
                        $hasil['P'];

                    $item->skor_pro =
                        $hasil['Pro'];

                    $item->total_kesulitan =
                        $hasil[
                            'total_kesulitan'
                        ];

                    $item->interpretasi =
                        $hasil[
                            'interpretasi'
                        ];
                }

                return $item;
            }
        );

        $kelasLabel = 'Semua Kelas';

        if ($kelasId !== null) {
            $kelasLabel = DB::table(
                    'skrining_siswa'
                )
                ->where(
                    'kelas_id_saat_skrining',
                    $kelasId
                )
                ->whereNotNull(
                    'nama_kelas_saat_skrining'
                )
                ->value(
                    'nama_kelas_saat_skrining'
                )
                ?? 'Kelas Terpilih';
        }

        $bulanNama = [
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
        ];

        $bulanLabel =
            $bulan !== null
                ? (
                    $bulanNama[$bulan]
                    ?? 'Bulan Terpilih'
                )
                : 'Semua Bulan';

        return [
            'user' => $user,
            'rows' => $rows,
            'tahun_ajaran' => $tahunAjaran,
            'semester' => $semester,
            'bulan' => $bulan,
            'bulan_label' => $bulanLabel,
            'kelas_id' => $kelasId,
            'kelas_label' => $kelasLabel,
            'status' => $status,
            'search' => $search,
        ];
    }

    private function exportHtml(
        array $data
    ): string {
        $e = static fn ($value) =>
            htmlspecialchars(
                (string) $value,
                ENT_QUOTES,
                'UTF-8'
            );

        $bulanNama = [
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
        ];

        $kelompokBulan = $data['rows']
            ->groupBy(
                fn ($item) =>
                    $item->tanggal_referensi
                        ->format(
                            'Y-m'
                        )
            );

        $html =
            '<!DOCTYPE html>'
            . '<html lang="id">'
            . '<head>'
            . '<meta charset="UTF-8">'
            . '<style>'
            . 'body{font-family:DejaVu Sans,Arial,sans-serif;color:#172033;font-size:9pt;}'
            . 'h1{margin:0 0 5px;color:#0b6f69;font-size:16pt;}'
            . 'p{margin:3px 0 7px;line-height:1.4;}'
            . '.muted{color:#667085;}'
            . '.meta{margin:12px 0;padding:9px;border:1px solid #dfe7e7;background:#f7f9f9;}'
            . '.month{margin-top:15px;padding:7px 9px;color:#0b6f69;background:#eaf6f4;font-weight:bold;}'
            . '.class{padding:6px 9px;color:#344054;background:#f8fafb;font-weight:bold;border:1px solid #dfe7e7;border-top:0;}'
            . 'table{width:100%;border-collapse:collapse;margin:0 0 8px;}'
            . 'th,td{border:1px solid #dfe7e7;padding:5px 6px;vertical-align:top;}'
            . 'th{background:#f1f7f6;color:#0b6f69;font-size:8pt;}'
            . 'td{font-size:8pt;}'
            . '.center{text-align:center;}'
            . '.privacy{margin-top:12px;padding:8px;border:1px solid #dfe7e7;background:#f7f9f9;color:#667085;}'
            . '</style>'
            . '</head>'
            . '<body>';

        $html .=
            '<h1>Riwayat Skrining Siswa - Guru BK</h1>'
            . '<p class="muted">'
            . 'Dokumen operasional hasil skrining sesuai filter yang diterapkan.'
            . '</p>'
            . '<div class="meta">'
            . '<p><strong>Guru BK:</strong> '
            . $e(
                $data['user']->name
            )
            . '</p>'
            . '<p><strong>Tahun Ajaran:</strong> '
            . $e(
                $data['tahun_ajaran']
                === 'semua'
                    ? 'Semua Tahun Ajaran'
                    : $data['tahun_ajaran']
            )
            . '</p>'
            . '<p><strong>Semester:</strong> '
            . $e(
                $data['semester']
                === 'semua'
                    ? 'Semua Semester'
                    : ucfirst(
                        $data['semester']
                    )
            )
            . '</p>'
            . '<p><strong>Bulan:</strong> '
            . $e(
                $data['bulan_label']
            )
            . '</p>'
            . '<p><strong>Kelas:</strong> '
            . $e(
                $data['kelas_label']
            )
            . '</p>'
            . '<p><strong>Status:</strong> '
            . $e(
                $data['status'] === ''
                    ? 'Semua Status'
                    : ucfirst(
                        $data['status']
                    )
            )
            . '</p>'
            . '<p><strong>Total Sesi:</strong> '
            . $e(
                $data['rows']->count()
            )
            . '</p>'
            . '</div>';

        if ($data['rows']->isEmpty()) {
            $html .=
                '<p>Tidak ada data skrining sesuai filter.</p>';
        } else {
            foreach (
                $kelompokBulan
                as $bulanKey => $itemsBulan
            ) {
                $tanggalBulan =
                    Carbon::createFromFormat(
                        'Y-m',
                        $bulanKey
                    );

                $labelBulan =
                    (
                        $bulanNama[
                            $tanggalBulan->month
                        ]
                        ?? $tanggalBulan
                            ->format('m')
                    )
                    . ' '
                    . $tanggalBulan->year;

                $html .=
                    '<div class="month">'
                    . $e($labelBulan)
                    . ' · '
                    . $e(
                        $itemsBulan->count()
                    )
                    . ' sesi'
                    . '</div>';

                $kelompokKelas =
                    $itemsBulan->groupBy(
                        'nama_kelas_arsip'
                    );

                foreach (
                    $kelompokKelas
                    as $namaKelas => $itemsKelas
                ) {
                    $contoh =
                        $itemsKelas->first();

                    $html .=
                        '<div class="class">'
                        . $e($namaKelas)
                        . ' · '
                        . $e(
                            $contoh
                                ->tahun_ajaran_arsip
                        )
                        . ' · '
                        . $e(
                            ucfirst(
                                $contoh
                                    ->semester_arsip
                            )
                        )
                        . '</div>';

                    $html .=
                        '<table>'
                        . '<thead><tr>'
                        . '<th>Siswa</th>'
                        . '<th>NIS</th>'
                        . '<th>Mulai</th>'
                        . '<th>Selesai</th>'
                        . '<th>Status</th>'
                        . '<th>E</th>'
                        . '<th>C</th>'
                        . '<th>H</th>'
                        . '<th>P</th>'
                        . '<th>Pro</th>'
                        . '<th>Total</th>'
                        . '<th>Interpretasi</th>'
                        . '</tr></thead><tbody>';

                    foreach (
                        $itemsKelas
                        as $item
                    ) {
                        $html .=
                            '<tr>'
                            . '<td>'
                            . $e(
                                $item->nama_siswa
                            )
                            . '</td>'
                            . '<td>'
                            . $e(
                                $item->nis
                                ?: '-'
                            )
                            . '</td>'
                            . '<td>'
                            . $e(
                                $item->started_at
                                    ? Carbon::parse(
                                        $item->started_at
                                    )->format(
                                        'd-m-Y H:i'
                                    )
                                    : '-'
                            )
                            . '</td>'
                            . '<td>'
                            . $e(
                                $item->completed_at
                                    ? Carbon::parse(
                                        $item->completed_at
                                    )->format(
                                        'd-m-Y H:i'
                                    )
                                    : '-'
                            )
                            . '</td>'
                            . '<td>'
                            . $e(
                                ucfirst(
                                    $item->status
                                )
                            )
                            . '</td>'
                            . '<td class="center">'
                            . $e(
                                $item->skor_e
                                ?? '-'
                            )
                            . '</td>'
                            . '<td class="center">'
                            . $e(
                                $item->skor_c
                                ?? '-'
                            )
                            . '</td>'
                            . '<td class="center">'
                            . $e(
                                $item->skor_h
                                ?? '-'
                            )
                            . '</td>'
                            . '<td class="center">'
                            . $e(
                                $item->skor_p
                                ?? '-'
                            )
                            . '</td>'
                            . '<td class="center">'
                            . $e(
                                $item->skor_pro
                                ?? '-'
                            )
                            . '</td>'
                            . '<td class="center">'
                            . $e(
                                $item
                                    ->total_kesulitan
                                ?? '-'
                            )
                            . '</td>'
                            . '<td>'
                            . $e(
                                $item->interpretasi
                                ?? '-'
                            )
                            . '</td>'
                            . '</tr>';
                    }

                    $html .=
                        '</tbody></table>';
                }
            }
        }

        $html .=
            '<div class="privacy">'
            . 'Dokumen ini dapat memuat identitas siswa, skor SDQ, dan interpretasi hasil karena digunakan oleh Guru BK untuk pemantauan dan tindak lanjut. Data lama tanpa snapshot kelas tetap ditandai sebagai data lama dan tidak dipaksakan ke kelas siswa saat ini.'
            . '</div>'
            . '</body>'
            . '</html>';

        return $html;
    }

    private function exportFileName(
        array $data,
        string $extension
    ): string {
        $tahun = $data['tahun_ajaran']
            === 'semua'
                ? 'semua-tahun'
                : str_replace(
                    '/',
                    '-',
                    $data['tahun_ajaran']
                );

        $semester = $data['semester'];

        $kelas = preg_replace(
            '/[^A-Za-z0-9]+/',
            '-',
            strtolower(
                $data['kelas_label']
            )
        );

        $kelas = trim(
            (string) $kelas,
            '-'
        );

        return sprintf(
            'skrining-guru-bk-%s-%s-%s.%s',
            $tahun,
            $semester,
            $kelas ?: 'semua-kelas',
            $extension
        );
    }

    private function applyAcademicFilters(
        $query,
        string $tahunAjaran,
        string $semester,
        ?int $bulan,
        ?int $kelasId
    ): void {
        if ($kelasId !== null) {
            if ($tahunAjaran !== 'semua') {
                $query->where(
                      'skrining_siswa.tahun_ajaran',
                    $tahunAjaran
                );
            }

            if ($semester !== 'semua') {
                $query->where(
                    'skrining_siswa.semester',
                    $semester
                );
            }

            $query->where(
                'skrining_siswa.kelas_id_saat_skrining',
                $kelasId
            );
        } else {
            $this->applySnapshotAndLegacyPeriod(
                $query,
                $tahunAjaran,
                $semester
            );
        }

        if ($bulan !== null) {
            $query->whereMonth(
                DB::raw(
                    $this->referenceDateSql()
                ),
                $bulan
            );
        }
    }

    private function applySnapshotAndLegacyPeriod(
        $query,
        string $tahunAjaran,
        string $semester
    ): void {
        if (
            $tahunAjaran === 'semua'
            && $semester === 'semua'
        ) {
            return;
        }

        $query->where(
            function ($scope) use (
                $tahunAjaran,
                $semester
            ) {
                $scope->where(
                    function ($snapshot) use (
                        $tahunAjaran,
                        $semester
                    ) {
                        $snapshot
                            ->whereNotNull(
                                'skrining_siswa.tahun_ajaran'
                            )
                            ->whereNotNull(
                                'skrining_siswa.semester'
                            );

                        if ($tahunAjaran !== 'semua') {
                            $snapshot->where(
                      'skrining_siswa.tahun_ajaran',
                                $tahunAjaran
                            );
                        }

                        if ($semester !== 'semua') {
                            $snapshot->where(
                                'skrining_siswa.semester',
                                $semester
                            );
                        }
                    }
                )
                ->orWhere(
                    function ($legacy) use (
                        $tahunAjaran,
                        $semester
                    ) {
                        $legacy->where(
                            function ($missing) {
                                $missing
                                    ->whereNull(
                                        'skrining_siswa.tahun_ajaran'
                                    )
                                    ->orWhereNull(
                                        'skrining_siswa.semester'
                                    );
                            }
                        );

                        $this->applyDateBasedPeriod(
                            $legacy,
                            $tahunAjaran,
                            $semester
                        );
                    }
                );
            }
        );
    }

    private function applyLegacyPeriodFilters(
        $query,
        string $tahunAjaran,
        string $semester,
        ?int $bulan
    ): void {
        $this->applyDateBasedPeriod(
            $query,
            $tahunAjaran,
            $semester
        );

        if ($bulan !== null) {
            $query->whereMonth(
                DB::raw(
                    $this->referenceDateSql()
                ),
                $bulan
            );
        }
    }

    private function applyDateBasedPeriod(
        $query,
        string $tahunAjaran,
        string $semester
    ): void {
        if (
            $tahunAjaran !== 'semua'
            && $semester !== 'semua'
        ) {
            [$startDate, $endDate] =
                $this->resolveAcademicPeriod(
                    $tahunAjaran,
                    $semester
                );

            $query->whereBetween(
                DB::raw(
                    $this->referenceDateSql()
                ),
                [
                    $startDate,
                    $endDate,
                ]
            );

            return;
        }

        if (
            $tahunAjaran !== 'semua'
            && $semester === 'semua'
        ) {
            [$tahunAwal, $tahunAkhir] =
                array_map(
                    'intval',
                    explode(
                        '/',
                        $tahunAjaran
                    )
                );

            $query->whereBetween(
                DB::raw(
                    $this->referenceDateSql()
                ),
                [
                    Carbon::create(
                        $tahunAwal,
                        7,
                        1
                    )->startOfDay(),

                    Carbon::create(
                        $tahunAkhir,
                        6,
                        30
                    )->endOfDay(),
                ]
            );

            return;
        }

        if (
            $tahunAjaran === 'semua'
            && $semester !== 'semua'
        ) {
            $bulanSemester =
                $semester === 'ganjil'
                    ? [
                        7,
                        8,
                        9,
                        10,
                        11,
                        12,
                    ]
                    : [
                        1,
                        2,
                        3,
                        4,
                        5,
                        6,
                    ];

            $query->whereIn(
                DB::raw(
                    'MONTH('
                    . $this->referenceDateSql()
                    . ')'
                ),
                $bulanSemester
            );
        }
    }

    private function referenceDateSql(): string
    {
        return 'COALESCE('
            . 'skrining_siswa.completed_at, '
            . 'skrining_siswa.started_at, '
            . 'skrining_siswa.created_at'
            . ')';
    }

    private function resolveAcademicPeriod(
        string $tahunAjaran,
        string $semester
    ): array {
        [$tahunAwal, $tahunAkhir] =
            array_map(
                'intval',
                explode(
                    '/',
                    $tahunAjaran
                )
            );

        if ($semester === 'ganjil') {
            return [
                Carbon::create(
                    $tahunAwal,
                    7,
                    1
                )->startOfDay(),

                Carbon::create(
                    $tahunAwal,
                    12,
                    31
                )->endOfDay(),
            ];
        }

        return [
            Carbon::create(
                $tahunAkhir,
                1,
                1
            )->startOfDay(),

            Carbon::create(
                $tahunAkhir,
                6,
                30
            )->endOfDay(),
        ];
    }

    private function academicYearFromDate(
        Carbon $tanggal
    ): string {
        $tahunAwal =
            $tanggal->month >= 7
                ? $tanggal->year
                : $tanggal->year - 1;

        return $tahunAwal
            . '/'
            . ($tahunAwal + 1);
    }

    private function buildPeriodLabel(
        string $tahunAjaran,
        string $semester,
        ?int $bulan,
        $bulanOptions
    ): string {
        $parts = [];

        $parts[] = $tahunAjaran === 'semua'
            ? 'Semua Tahun Ajaran'
            : $tahunAjaran;

        $parts[] = $semester === 'semua'
            ? 'Semua Semester'
            : 'Semester '
                . ucfirst(
                    $semester
                );

        if (
            $bulan !== null
            && $bulanOptions->has(
                $bulan
            )
        ) {
            $parts[] =
                $bulanOptions->get(
                    $bulan
                );
        }

        return implode(
            ' · ',
            $parts
        );
    }

    private function hitungSkor($jawaban): array
    {
        $skor = [
            'E' => 0,
            'C' => 0,
            'H' => 0,
            'P' => 0,
            'Pro' => 0,
        ];

        foreach ($jawaban as $item) {
            $nilai = (int) $item->jawaban;

            if (
                (bool) $item->reverse_score
            ) {
                $nilai = 2 - $nilai;
            }

            $aspek = $this->normalizeAspek(
                (string) $item->aspek
            );

            if (
                array_key_exists(
                    $aspek,
                    $skor
                )
            ) {
                $skor[$aspek] += $nilai;
            }
        }

        $totalKesulitan =
            $skor['E']
            + $skor['C']
            + $skor['H']
            + $skor['P'];

        return [
            'E' => $skor['E'],
            'C' => $skor['C'],
            'H' => $skor['H'],
            'P' => $skor['P'],
            'Pro' => $skor['Pro'],
            'total_kesulitan' =>
                $totalKesulitan,
            'interpretasi' =>
                $this->interpretasiTotal(
                    $totalKesulitan
                ),
        ];
    }

    private function normalizeAspek(
        string $aspek
    ): string {
        return match ($aspek) {
            'E',
            'gejala_emosional' => 'E',

            'C',
            'masalah_perilaku' => 'C',

            'H',
            'hiperaktivitas' => 'H',

            'P',
            'teman_sebaya' => 'P',

            'Pro',
            'prososial' => 'Pro',

            default => $aspek,
        };
    }

    private function interpretasiTotal(
        int $total
    ): string {
        if ($total <= 15) {
            return 'Normal';
        }

        if ($total <= 19) {
            return 'Ambang';
        }

        return 'Abnormal';
    }
}



