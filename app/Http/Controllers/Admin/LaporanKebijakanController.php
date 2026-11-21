<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PengaturanSistem;
use App\Support\AuditLogger;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanKebijakanController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        abort_unless(
            $user && $user->role === 'admin',
            403,
            'Kamu tidak memiliki akses ke halaman Admin.'
        );

        $periode = $this->resolvePeriod($request);

        $data = $this->buildReportData(
            $periode['dari'],
            $periode['sampai'],
            $periode['tahunAjaran'],
            $periode['semester']
        );

        $pengaturan = PengaturanSistem::current();

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

        return view(
            'admin.laporan-kebijakan.index',
            array_merge(
                $data,
                [
                    'user' => $user,

                    'dariInput' =>
                        $periode['dari']->toDateString(),

                    'sampaiInput' =>
                        $periode['sampai']->toDateString(),

                    'tahunAjaranInput' =>
                        $periode['tahunAjaran'],

                    'semesterInput' =>
                        $periode['semester'],

                    'tahunAjaranOptions' =>
                        $tahunAjaranOptions,
                ]
            )
        );
    }

    public function exportExcel(Request $request)
    {
        $user = $request->user();

        abort_unless(
            $user && $user->role === 'admin',
            403
        );

        $periode = $this->resolvePeriod($request);

        $data = $this->buildReportData(
            $periode['dari'],
            $periode['sampai'],
            $periode['tahunAjaran'],
            $periode['semester']
        );

        AuditLogger::record(
            $request,
            $user,
            'policy_report_exported',
            'Mengunduh laporan kebijakan dalam format Excel.',
            'laporan_kebijakan',
            null,
            null,
            [
                'format' => 'excel',

                'tahun_ajaran' =>
                    $periode['tahunAjaran'],

                'semester' =>
                    $periode['semester'],

                'dari' =>
                    $periode['dari']->toDateString(),

                'sampai' =>
                    $periode['sampai']->toDateString(),
            ]
        );

        $tahunFile = str_replace(
            '/',
            '-',
            $periode['tahunAjaran']
        );

        $fileName = sprintf(
            'laporan-kebijakan-%s-%s.xls',
            $tahunFile,
            $periode['semester']
        );

        return response()->streamDownload(
            function () use ($data, $periode) {
                echo "\xEF\xBB\xBF";

                echo $this->excelHtml(
                    $data,
                    $periode['dari'],
                    $periode['sampai'],
                    $periode['tahunAjaran'],
                    $periode['semester']
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
            $user && $user->role === 'admin',
            403
        );

        $periode = $this->resolvePeriod($request);

        $data = $this->buildReportData(
            $periode['dari'],
            $periode['sampai'],
            $periode['tahunAjaran'],
            $periode['semester']
        );

        AuditLogger::record(
            $request,
            $user,
            'policy_report_exported',
            'Mengunduh laporan kebijakan dalam format PDF.',
            'laporan_kebijakan',
            null,
            null,
            [
                'format' => 'pdf',

                'tahun_ajaran' =>
                    $periode['tahunAjaran'],

                'semester' =>
                    $periode['semester'],

                'dari' =>
                    $periode['dari']->toDateString(),

                'sampai' =>
                    $periode['sampai']->toDateString(),
            ]
        );

        $tahunFile = str_replace(
            '/',
            '-',
            $periode['tahunAjaran']
        );

        $fileName = sprintf(
            'laporan-kebijakan-%s-%s.pdf',
            $tahunFile,
            $periode['semester']
        );

        return Pdf::loadView(
            'admin.laporan-kebijakan.pdf',
            array_merge(
                $data,
                [
                    'dari' =>
                        $periode['dari'],

                    'sampai' =>
                        $periode['sampai'],

                    'tahunAjaran' =>
                        $periode['tahunAjaran'],

                    'semester' =>
                        $periode['semester'],

                    'generatedAt' =>
                        now(),

                    'pengaturan' =>
                        PengaturanSistem::current(),
                ]
            )
        )
            ->setPaper('a4', 'portrait')
            ->download($fileName);
    }

    
    private function resolvePeriod(Request $request): array
    {
        $validated = $request->validate([
            'tahun_ajaran' => [
                'nullable',
                'regex:/^\d{4}\/\d{4}$/',
            ],

            'semester' => [
                'nullable',
                'in:ganjil,genap',
            ],

            'dari' => [
                'nullable',
                'date',
            ],

            'sampai' => [
                'nullable',
                'date',
                'after_or_equal:dari',
            ],
        ], [
            'tahun_ajaran.regex' =>
                'Format tahun ajaran harus seperti 2026/2027.',

            'semester.in' =>
                'Semester harus Ganjil atau Genap.',

            'sampai.after_or_equal' =>
                'Tanggal akhir tidak boleh lebih awal dari tanggal awal.',
        ]);

        $pengaturan = PengaturanSistem::current();

        $tahunAjaran =
            $validated['tahun_ajaran']
            ?? $pengaturan->tahun_ajaran_aktif;

        $semester =
            $validated['semester']
            ?? $pengaturan->semester_aktif;

        [$tahunAwal, $tahunAkhir] =
            array_map(
                'intval',
                explode('/', $tahunAjaran)
            );

        if ($semester === 'ganjil') {
            $defaultDari = Carbon::create(
                $tahunAwal,
                7,
                1
            )->startOfDay();

            $defaultSampai = Carbon::create(
                $tahunAwal,
                12,
                31
            )->endOfDay();
        } else {
            $defaultDari = Carbon::create(
                $tahunAkhir,
                1,
                1
            )->startOfDay();

            $defaultSampai = Carbon::create(
                $tahunAkhir,
                6,
                30
            )->endOfDay();
        }

        $dari = ! empty($validated['dari'])
            ? Carbon::parse(
                $validated['dari']
            )->startOfDay()
            : $defaultDari;

        $sampai = ! empty($validated['sampai'])
            ? Carbon::parse(
                $validated['sampai']
            )->endOfDay()
            : $defaultSampai;

        return [
            'dari' => $dari,
            'sampai' => $sampai,
            'tahunAjaran' => $tahunAjaran,
            'semester' => $semester,
        ];
    }

    private function buildReportData(
        Carbon $dari,
        Carbon $sampai,
        string $tahunAjaran,
        string $semester
    ): array {
        $tanggalSql =
            'COALESCE(
                laporan_kasus.submitted_at,
                laporan_kasus.created_at
            )';

        $base = DB::table('laporan_kasus')
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
            ->whereBetween(
                DB::raw($tanggalSql),
                [
                    $dari,
                    $sampai,
                ]
            );

        $pengaturan = PengaturanSistem::current();

        $staleDays = max(
            1,
            (int) $pengaturan->batas_kasus_mangkrak
        );

        

        $ringkasan = [
            'total' =>
                (clone $base)->count(),

            'aktif' =>
                (clone $base)
                    ->whereIn(
                        'laporan_kasus.status_kasus',
                        [
                            'baru',
                            'diproses',
                            'dieskalasi',
                        ]
                    )
                    ->count(),

            'selesai' =>
                (clone $base)
                    ->where(
                        'laporan_kasus.status_kasus',
                        'selesai'
                    )
                    ->count(),

            'dieskalasi' =>
                (clone $base)
                    ->where(
                        'laporan_kasus.status_kasus',
                        'dieskalasi'
                    )
                    ->count(),

            'mangkrak' =>
                (clone $base)
                    ->whereIn(
                        'laporan_kasus.status_kasus',
                        [
                            'baru',
                            'diproses',
                            'dieskalasi',
                        ]
                    )
                    ->where(
                        'laporan_kasus.updated_at',
                        '<=',
                        now()->subDays($staleDays)
                    )
                    ->count(),

        ];

        $skriningSelesai = DB::table('skrining_siswa')
            ->where('skrining_siswa.status', 'selesai')
            ->whereBetween(
                'skrining_siswa.completed_at',
                [
                    $dari,
                    $sampai,
                ]
            )
            ->select([
                'skrining_siswa.id',
                'skrining_siswa.siswa_id',
                'skrining_siswa.completed_at',
            ])
            ->orderByDesc('skrining_siswa.completed_at')
            ->get()
            ->unique('siswa_id')
            ->values();

        $skriningIds = $skriningSelesai
            ->pluck('id')
            ->all();

        $jawabanSkrining = collect();

        if (! empty($skriningIds)) {
            $jawabanSkrining = DB::table('jawaban_skrining')
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
                ->groupBy('skrining_id');
        }

        $jumlahInterpretasi = [
            'normal' => 0,
            'ambang' => 0,
            'abnormal' => 0,
        ];

        foreach ($skriningSelesai as $sesi) {
            $jawabanSesi = $jawabanSkrining->get(
                $sesi->id,
                collect()
            );

            if ($jawabanSesi->count() < 25) {
                continue;
            }

            $hasilSkrining = $this->hitungSkorSkrining(
                $jawabanSesi
            );

            $interpretasiKey = strtolower(
                $hasilSkrining['interpretasi']
            );

            if (array_key_exists(
                $interpretasiKey,
                $jumlahInterpretasi
            )) {
                $jumlahInterpretasi[
                    $interpretasiKey
                ]++;
            }
        }

        $totalHasilSkrining = array_sum(
            $jumlahInterpretasi
        );

        $distribusiSkrining = [
            'total' =>
                $totalHasilSkrining,

            'normal' => [
                'total' =>
                    $jumlahInterpretasi['normal'],

                'persentase' =>
                    $totalHasilSkrining > 0
                        ? round(
                            (
                                $jumlahInterpretasi['normal']
                                / $totalHasilSkrining
                            ) * 100,
                            1
                        )
                        : 0,
            ],

            'ambang' => [
                'total' =>
                    $jumlahInterpretasi['ambang'],

                'persentase' =>
                    $totalHasilSkrining > 0
                        ? round(
                            (
                                $jumlahInterpretasi['ambang']
                                / $totalHasilSkrining
                            ) * 100,
                            1
                        )
                        : 0,
            ],

            'abnormal' => [
                'total' =>
                    $jumlahInterpretasi['abnormal'],

                'persentase' =>
                    $totalHasilSkrining > 0
                        ? round(
                            (
                                $jumlahInterpretasi['abnormal']
                                / $totalHasilSkrining
                            ) * 100,
                            1
                        )
                        : 0,
            ],
        ];

        

        $status = (clone $base)
            ->select(
                'laporan_kasus.status_kasus',
                DB::raw(
                    'COUNT(*) as total'
                )
            )
            ->groupBy(
                'laporan_kasus.status_kasus'
            )
            ->orderByDesc('total')
            ->get()
            ->map(function ($item) {
                $item->label = match (
                    $item->status_kasus
                ) {
                    'baru' =>
                        'Baru',

                    'diproses' =>
                        'Diproses',

                    'selesai' =>
                        'Selesai',

                    'dieskalasi' =>
                        'Dieskalasi',

                    default =>
                        ucfirst(
                            $item->status_kasus
                        ),
                };

                return $item;
            });

        

        $kategori = (clone $base)
            ->join(
                'kategori_kasus',
                'laporan_kasus.kategori_id',
                '=',
                'kategori_kasus.id'
            )
            ->select(
                'kategori_kasus.nama_kategori',
                DB::raw(
                    'COUNT(*) as total'
                )
            )
            ->groupBy(
                'kategori_kasus.id',
                'kategori_kasus.nama_kategori'
            )
            ->orderByDesc('total')
            ->get();

        

        $tingkat = (clone $base)
            ->selectRaw(
                "
                COALESCE(
                    CAST(
                        laporan_kasus.tingkat_saat_laporan
                        AS CHAR
                    ),
                    'Belum ditentukan'
                ) as tingkat,
                COUNT(*) as total
                "
            )
            ->groupBy(
                'laporan_kasus.tingkat_saat_laporan'
            )
            ->orderBy(
                'laporan_kasus.tingkat_saat_laporan'
            )
            ->get();

        

        $trenRaw = (clone $base)
            ->selectRaw(
                "
                DATE_FORMAT(
                    $tanggalSql,
                    '%Y-%m'
                ) as periode,
                COUNT(*) as total
                "
            )
            ->groupBy('periode')
            ->orderBy('periode')
            ->pluck(
                'total',
                'periode'
            );

        $tren = collect();

        foreach (
            CarbonPeriod::create(
                $dari
                    ->copy()
                    ->startOfMonth(),

                '1 month',

                $sampai
                    ->copy()
                    ->startOfMonth()
            ) as $bulan
        ) {
            $periode = $bulan->format(
                'Y-m'
            );

            $tren->push(
                (object) [
                    'periode' =>
                        $periode,

                    'label' =>
                        $bulan
                            ->copy()
                            ->locale('id')
                            ->translatedFormat(
                                'M Y'
                            ),

                    'total' =>
                        (int) (
                            $trenRaw[
                                $periode
                            ]
                            ?? 0
                        ),
                ]
            );
        }

        

        $aktivitasBk = DB::table(
            'users as bk'
        )
            ->where(
                'bk.role',
                'counselor'
            )
            ->where(
                'bk.is_active',
                true
            )
            ->select([
                'bk.id',
                'bk.name',
                'bk.email',
            ])
            ->orderBy(
                'bk.name'
            )
            ->get()
            ->map(
                function ($bk) use (
                    $dari,
                    $sampai,
                    $tahunAjaran,
                    $semester,
                    $tanggalSql
                ) {
                    
                    $bk->kasus_saat_ini =
                        DB::table(
                            'laporan_kasus'
                        )
                            ->where(
                                'assigned_bk_id',
                                $bk->id
                            )
                            ->where(
                                'tahun_ajaran',
                                $tahunAjaran
                            )
                            ->where(
                                'semester',
                                $semester
                            )
                            ->whereIn(
                                'status_kasus',
                                [
                                    'baru',
                                    'diproses',
                                    'dieskalasi',
                                ]
                            )
                            ->whereBetween(
                                DB::raw(
                                    $tanggalSql
                                ),
                                [
                                    $dari,
                                    $sampai,
                                ]
                            )
                            ->count();

                    $bk->selesai_periode =
                        DB::table(
                            'laporan_kasus'
                        )
                            ->where(
                                'assigned_bk_id',
                                $bk->id
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
                                'status_kasus',
                                'selesai'
                            )
                            ->whereBetween(
                                'resolved_at',
                                [
                                    $dari,
                                    $sampai,
                                ]
                            )
                            ->count();

                    
                    $bk->tindak_lanjut_periode =
                        DB::table(
                            'tindak_lanjut'
                        )
                            ->where(
                                'user_id',
                                $bk->id
                            )
                            ->whereBetween(
                                'created_at',
                                [
                                    $dari,
                                    $sampai,
                                ]
                            )
                            ->count();

                    return $bk;
                }
            );

        return compact(
            'ringkasan',
            'distribusiSkrining',
            'status',
            'kategori',
            'tingkat',
            'tren',
            'aktivitasBk',
            'staleDays',
            'tahunAjaran',
            'semester'
        );
    }

    private function hitungSkorSkrining($jawaban): array
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

            if ((bool) $item->reverse_score) {
                $nilai = 2 - $nilai;
            }

            $aspek = $this->normalizeAspekSkrining(
                (string) $item->aspek
            );

            if (array_key_exists(
                $aspek,
                $skor
            )) {
                $skor[$aspek] += $nilai;
            }
        }

        $totalKesulitan =
            $skor['E']
            + $skor['C']
            + $skor['H']
            + $skor['P'];

        return [
            'total_kesulitan' =>
                $totalKesulitan,

            'interpretasi' =>
                $this->interpretasiTotalSkrining(
                    $totalKesulitan
                ),
        ];
    }

    private function normalizeAspekSkrining(
        string $aspek
    ): string {
        return match ($aspek) {
            'E',
            'gejala_emosional' =>
                'E',

            'C',
            'masalah_perilaku' =>
                'C',

            'H',
            'hiperaktivitas' =>
                'H',

            'P',
            'teman_sebaya',
            'masalah_teman_sebaya' =>
                'P',

            'Pro',
            'prososial',
            'perilaku_prososial' =>
                'Pro',

            default =>
                $aspek,
        };
    }

    private function interpretasiTotalSkrining(
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

    private function excelHtml(
        array $data,
        Carbon $dari,
        Carbon $sampai,
        string $tahunAjaran,
        string $semester
    ): string {
        $e = static fn ($value) =>
            htmlspecialchars(
                (string) $value,
                ENT_QUOTES,
                'UTF-8'
            );

        $html =
            '<html><head><meta charset="UTF-8">'
            . '<style>'
            . 'body{font-family:Arial,sans-serif;font-size:11pt;}'
            . 'h1{font-size:18pt;}'
            . 'h2{font-size:13pt;margin-top:22px;}'
            . 'table{border-collapse:collapse;width:100%;margin-bottom:18px;}'
            . 'th,td{border:1px solid #cfd8d8;padding:6px 8px;text-align:left;}'
            . 'th{background:#eaf6f4;font-weight:bold;}'
            . '.number{text-align:right;}'
            . '</style></head><body>';

        $html .=
            '<h1>Laporan Kebijakan CurhatAman</h1>';

        $html .=
            '<p><strong>Tahun Ajaran:</strong> '
            . $e($tahunAjaran)
            . '<br><strong>Semester:</strong> '
            . $e(ucfirst($semester))
            . '</p>';

        $html .=
            '<p>Periode tanggal: '
            . $e(
                $dari
                    ->locale('id')
                    ->translatedFormat('d F Y')
            )
            . ' s.d. '
            . $e(
                $sampai
                    ->locale('id')
                    ->translatedFormat('d F Y')
            )
            . '</p>';

        $html .=
            '<p>'
            . 'Laporan ini berisi data agregat untuk evaluasi kebijakan sekolah. '
            . 'Tidak memuat identitas siswa, kronologi, bukti, '
            . 'atau isi catatan tindak lanjut.'
            . '</p>';

        

        $html .=
            '<h2>Ringkasan</h2>'
            . '<table><tr>'
            . '<th>Total Laporan</th>'
            . '<th>Kasus Aktif</th>'
            . '<th>Selesai</th>'
            . '<th>Dieskalasi</th>'
            . '<th>Mangkrak</th>'
            . '</tr><tr>'
            . '<td class="number">'
            . $e(
                $data['ringkasan']['total']
            )
            . '</td>'
            . '<td class="number">'
            . $e(
                $data['ringkasan']['aktif']
            )
            . '</td>'
            . '<td class="number">'
            . $e(
                $data['ringkasan']['selesai']
            )
            . '</td>'
            . '<td class="number">'
            . $e(
                $data['ringkasan']['dieskalasi']
            )
            . '</td>'
            . '<td class="number">'
            . $e(
                $data['ringkasan']['mangkrak']
            )
            . '</td>'
            . '</tr></table>';

        

        $html .=
            '<h2>Distribusi Hasil Skrining</h2>'
            . '<table>'
            . '<tr>'
            . '<th>Kategori</th>'
            . '<th>Jumlah Siswa</th>'
            . '<th>Persentase</th>'
            . '</tr>';

        foreach (
            [
                'normal' => 'Normal',
                'ambang' => 'Ambang',
                'abnormal' => 'Abnormal',
            ]
            as $key => $label
        ) {
            $html .=
                '<tr><td>'
                . $e($label)
                . '</td>'
                . '<td class="number">'
                . $e(
                    $data[
                        'distribusiSkrining'
                    ][$key]['total']
                )
                . '</td>'
                . '<td class="number">'
                . $e(
                    $data[
                        'distribusiSkrining'
                    ][$key]['persentase']
                )
                . '%</td></tr>';
        }

        $html .= '</table>';

        $html .=
            '<p>'
            . 'Distribusi menggunakan hasil skrining selesai terbaru '
            . 'dari setiap siswa pada rentang tanggal laporan. '
            . 'Kategori merupakan interpretasi skrining awal dan bukan diagnosis.'
            . '</p>';

        $html .=
            '<h2>Distribusi Status</h2>'
            . '<table>'
            . '<tr>'
            . '<th>Status</th>'
            . '<th>Total</th>'
            . '</tr>';

        foreach (
            $data['status']
            as $item
        ) {
            $html .=
                '<tr><td>'
                . $e($item->label)
                . '</td>'
                . '<td class="number">'
                . $e($item->total)
                . '</td></tr>';
        }

        $html .= '</table>';

        

        $html .=
            '<h2>Distribusi Kategori</h2>'
            . '<table>'
            . '<tr>'
            . '<th>Kategori</th>'
            . '<th>Total</th>'
            . '</tr>';

        foreach (
            $data['kategori']
            as $item
        ) {
            $html .=
                '<tr><td>'
                . $e(
                    $item->nama_kategori
                )
                . '</td>'
                . '<td class="number">'
                . $e($item->total)
                . '</td></tr>';
        }

        $html .= '</table>';

        

        $html .=
            '<h2>Distribusi Tingkat</h2>'
            . '<table>'
            . '<tr>'
            . '<th>Tingkat</th>'
            . '<th>Total</th>'
            . '</tr>';

        foreach (
            $data['tingkat']
            as $item
        ) {
            $html .=
                '<tr><td>'
                . $e($item->tingkat)
                . '</td>'
                . '<td class="number">'
                . $e($item->total)
                . '</td></tr>';
        }

        $html .= '</table>';

        

        $html .=
            '<h2>Tren Bulanan</h2>'
            . '<table>'
            . '<tr>'
            . '<th>Bulan</th>'
            . '<th>Total Laporan</th>'
            . '</tr>';

        foreach (
            $data['tren']
            as $item
        ) {
            $html .=
                '<tr><td>'
                . $e($item->label)
                . '</td>'
                . '<td class="number">'
                . $e($item->total)
                . '</td></tr>';
        }

        $html .= '</table>';

        

        $html .=
            '<h2>Aktivitas Guru BK</h2>'
            . '<table><tr>'
            . '<th>Guru BK</th>'
            . '<th>Kasus Aktif pada Periode</th>'
            . '<th>Selesai pada Periode</th>'
            . '<th>Tindak Lanjut pada Periode</th>'
            . '</tr>';

        foreach (
            $data['aktivitasBk']
            as $bk
        ) {
            $html .=
                '<tr><td>'
                . $e($bk->name)
                . '</td>'
                . '<td class="number">'
                . $e(
                    $bk->kasus_saat_ini
                )
                . '</td>'
                . '<td class="number">'
                . $e(
                    $bk->selesai_periode
                )
                . '</td>'
                . '<td class="number">'
                . $e(
                    $bk->tindak_lanjut_periode
                )
                . '</td></tr>';
        }

        $html .= '</table>';

        $html .= '</body></html>';

        return $html;
    }
}