<?php

namespace App\Http\Controllers\GuruBK;

use App\Http\Controllers\Controller;
use App\Models\PengaturanSistem;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatistikGuruBKController extends Controller
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

        [$startDate, $endDate] = $this->resolveAcademicPeriod(
            $tahunAjaran,
            $semester
        );

        $periode = 'semester';

        $periodeLabel = sprintf(
            '%s · Semester %s',
            $tahunAjaran,
            ucfirst($semester)
        );

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

        $kelasId = $request->filled('kelas_id')
            ? (int) $request->query('kelas_id')
            : null;

        $kelasList = DB::table('kelas')
            ->where('is_active', true)
            ->where('tahun_ajaran', $tahunAjaran)
            ->orderBy('tingkat')
            ->orderBy('nama_kelas')
            ->get([
                'id',
                'nama_kelas',
                'tahun_ajaran',
            ]);

        if (
            $kelasId
            && ! $kelasList->contains(
                fn ($kelas) => (int) $kelas->id === $kelasId
            )
        ) {
            $kelasId = null;
        }

        $applyDatePeriod = function (
            $query,
            string $column
        ) use (
            $startDate,
            $endDate
        ) {
            return $query->whereBetween(
                $column,
                [
                    $startDate,
                    $endDate,
                ]
            );
        };

        $laporanQuery = DB::table('laporan_kasus')
            ->where('laporan_kasus.status_kasus', '!=', 'draft')
            ->where('laporan_kasus.tahun_ajaran', $tahunAjaran)
            ->where('laporan_kasus.semester', $semester);

        if ($kelasId) {
            $laporanQuery->where(
                'laporan_kasus.kelas_id_saat_laporan',
                $kelasId
            );
        }

        $skriningQuery = DB::table(
                'skrining_siswa'
            )
            ->where(
                'skrining_siswa.status',
                'selesai'
            );

        $this->applySkriningAcademicScope(
            $skriningQuery,
            $tahunAjaran,
            $semester,
            $kelasId,
            $startDate,
            $endDate,
            'skrining_siswa.completed_at'
        );

        $bantuanQuery = DB::table('permintaan_bantuan')
            ->join(
                'siswa',
                'permintaan_bantuan.siswa_id',
                '=',
                'siswa.id'
            );

        if ($kelasId) {
            $bantuanQuery->where('siswa.kelas_id', $kelasId);
        }

        $applyDatePeriod(
            $bantuanQuery,
            'permintaan_bantuan.submitted_at'
        );

        $rujukanQuery = DB::table('rujukan')
            ->join(
                'siswa',
                'rujukan.siswa_id',
                '=',
                'siswa.id'
            );

        if ($kelasId) {
            $rujukanQuery->where('siswa.kelas_id', $kelasId);
        }

        $applyDatePeriod(
            $rujukanQuery,
            'rujukan.referred_at'
        );

        $summary = [
            'laporan' => (clone $laporanQuery)->count(),
            'skrining_selesai' => (clone $skriningQuery)->count(),
            'bantuan' => (clone $bantuanQuery)->count(),
            'rujukan' => (clone $rujukanQuery)->count(),
        ];

        $statusLaporanQuery = DB::table('laporan_kasus')
            ->where('laporan_kasus.status_kasus', '!=', 'draft')
            ->where('laporan_kasus.tahun_ajaran', $tahunAjaran)
            ->where('laporan_kasus.semester', $semester);

        if ($kelasId) {
            $statusLaporanQuery->where(
                'laporan_kasus.kelas_id_saat_laporan',
                $kelasId
            );
        }

        $statusLaporanRaw = $statusLaporanQuery
            ->select(
                'laporan_kasus.status_kasus',
                DB::raw('COUNT(*) as total')
            )
            ->groupBy('laporan_kasus.status_kasus')
            ->pluck(
                'total',
                'laporan_kasus.status_kasus'
            );

        $statusLaporan = [
            'baru' => (int) ($statusLaporanRaw['baru'] ?? 0),
            'diproses' => (int) ($statusLaporanRaw['diproses'] ?? 0),
            'selesai' => (int) ($statusLaporanRaw['selesai'] ?? 0),
            'dieskalasi' => (int) ($statusLaporanRaw['dieskalasi'] ?? 0),
        ];

        $kategoriQuery = DB::table('laporan_kasus')
            ->join(
                'kategori_kasus',
                'laporan_kasus.kategori_id',
                '=',
                'kategori_kasus.id'
            )
            ->where('laporan_kasus.status_kasus', '!=', 'draft')
            ->where('laporan_kasus.tahun_ajaran', $tahunAjaran)
            ->where('laporan_kasus.semester', $semester);

        if ($kelasId) {
            $kategoriQuery->where(
                'laporan_kasus.kelas_id_saat_laporan',
                $kelasId
            );
        }

        $kategoriKasus = $kategoriQuery
            ->select(
                'kategori_kasus.nama_kategori',
                DB::raw('COUNT(*) as total')
            )
            ->groupBy(
                'kategori_kasus.id',
                'kategori_kasus.nama_kategori'
            )
            ->orderByDesc('total')
            ->get();

        $totalKategori = max(
            (int) $kategoriKasus->sum('total'),
            1
        );

        $kategoriKasus = $kategoriKasus->map(
            function ($item) use ($totalKategori) {
                $item->total = (int) $item->total;

                $item->persentase = round(
                    ($item->total / $totalKategori) * 100,
                    1
                );

                return $item;
            }
        );

        $totalSiswaQuery = DB::table('siswa')
            ->join(
                'users',
                'siswa.user_id',
                '=',
                'users.id'
            )
            ->where('users.role', 'student')
            ->where('users.is_active', true);

        if ($kelasId) {
            $totalSiswaQuery->where(
                'siswa.kelas_id',
                $kelasId
            );
        }

        $totalSiswaAktif = $totalSiswaQuery->count();

        $partisipasiQuery = DB::table(
                'skrining_siswa'
            )
            ->where(
                'skrining_siswa.status',
                'selesai'
            );

        $this->applySkriningAcademicScope(
            $partisipasiQuery,
            $tahunAjaran,
            $semester,
            $kelasId,
            $startDate,
            $endDate,
            'skrining_siswa.completed_at'
        );

        $skriningSelesaiPeriode = $partisipasiQuery
            ->distinct('skrining_siswa.siswa_id')
            ->count('skrining_siswa.siswa_id');

        $skriningBerlangsungQuery = DB::table(
                'skrining_siswa'
            )
            ->where(
                'skrining_siswa.status',
                'berlangsung'
            );

        $this->applySkriningAcademicScope(
            $skriningBerlangsungQuery,
            $tahunAjaran,
            $semester,
            $kelasId,
            $startDate,
            $endDate,
            'COALESCE(skrining_siswa.started_at, skrining_siswa.created_at)'
        );

        $skriningBerlangsung =
            $skriningBerlangsungQuery->count();

        $persentasePartisipasi = $totalSiswaAktif > 0
            ? round(
                min(
                    100,
                    ($skriningSelesaiPeriode / $totalSiswaAktif) * 100
                ),
                1
            )
            : 0;

        $skrining = [
            'total_siswa' => $totalSiswaAktif,
            'selesai_periode' => $skriningSelesaiPeriode,
            'berlangsung' => $skriningBerlangsung,
            'persentase' => $persentasePartisipasi,
        ];

        $hasilSkriningRows = (clone $skriningQuery)
            ->select([
                'skrining_siswa.id',
                'skrining_siswa.siswa_id',
                'skrining_siswa.completed_at',
                'skrining_siswa.assigned_bk_id',
            ])
            ->orderByDesc('skrining_siswa.completed_at')
            ->get();

        $skriningTerbaruPerSiswa = $hasilSkriningRows
            ->unique('siswa_id')
            ->values();

        $skriningTerbaruIds = $skriningTerbaruPerSiswa
            ->pluck('id')
            ->all();

        $jawabanHasilSkrining = collect();

        if (! empty($skriningTerbaruIds)) {
            $jawabanHasilSkrining = DB::table('jawaban_skrining')
                ->join(
                    'pertanyaan_skrining',
                    'jawaban_skrining.pertanyaan_id',
                    '=',
                    'pertanyaan_skrining.id'
                )
                ->whereIn(
                    'jawaban_skrining.skrining_id',
                    $skriningTerbaruIds
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

        $statusSkriningAmbang = [
            'baru' => 0,
            'diproses' => 0,
            'selesai' => 0,
        ];

        $statusSkriningAbnormal = [
            'baru' => 0,
            'diproses' => 0,
            'selesai' => 0,
        ];

        $siswaIds = $skriningTerbaruPerSiswa->pluck('siswa_id')->filter()->all();

        $siswaDenganKonseling = ! empty($siswaIds)
            ? DB::table('catatan_konseling')
                ->whereIn('siswa_id', $siswaIds)
                ->pluck('siswa_id')
                ->unique()
                ->all()
            : [];

        $siswaDenganRujukan = ! empty($siswaIds)
            ? DB::table('rujukan')
                ->whereIn('siswa_id', $siswaIds)
                ->pluck('siswa_id')
                ->unique()
                ->all()
            : [];

        $siswaSelesaiTindakLanjut = array_flip(array_unique(array_merge($siswaDenganKonseling, $siswaDenganRujukan)));

        foreach ($skriningTerbaruPerSiswa as $sesiSkrining) {
            $jawabanSesi = $jawabanHasilSkrining->get(
                $sesiSkrining->id,
                collect()
            );

            if ($jawabanSesi->count() < 25) {
                continue;
            }

            $hasilSesi = $this->hitungSkorSkrining($jawabanSesi);
            $interpretasiKey = strtolower($hasilSesi['interpretasi']);

            if (array_key_exists(
                $interpretasiKey,
                $jumlahInterpretasi
            )) {
                $jumlahInterpretasi[$interpretasiKey]++;
            }

            if (in_array($interpretasiKey, ['ambang', 'abnormal'], true)) {
                if (isset($siswaSelesaiTindakLanjut[$sesiSkrining->siswa_id])) {
                    $stKey = 'selesai';
                } elseif (! empty($sesiSkrining->assigned_bk_id)) {
                    $stKey = 'diproses';
                } else {
                    $stKey = 'baru';
                }

                if ($interpretasiKey === 'ambang') {
                    $statusSkriningAmbang[$stKey]++;
                } elseif ($interpretasiKey === 'abnormal') {
                    $statusSkriningAbnormal[$stKey]++;
                }
            }
        }

        $totalInterpretasi = array_sum($jumlahInterpretasi);

        $distribusiSkrining = [
            'total_siswa' => $totalInterpretasi,
            'normal' => [
                'total' => $jumlahInterpretasi['normal'],
                'persentase' => $totalInterpretasi > 0
                    ? round(
                        ($jumlahInterpretasi['normal'] / $totalInterpretasi) * 100,
                        1
                    )
                    : 0,
            ],
            'ambang' => [
                'total' => $jumlahInterpretasi['ambang'],
                'persentase' => $totalInterpretasi > 0
                    ? round(
                        ($jumlahInterpretasi['ambang'] / $totalInterpretasi) * 100,
                        1
                    )
                    : 0,
            ],
            'abnormal' => [
                'total' => $jumlahInterpretasi['abnormal'],
                'persentase' => $totalInterpretasi > 0
                    ? round(
                        ($jumlahInterpretasi['abnormal'] / $totalInterpretasi) * 100,
                        1
                    )
                    : 0,
            ],
        ];

        $statusBantuanQuery = DB::table('permintaan_bantuan')
            ->join(
                'siswa',
                'permintaan_bantuan.siswa_id',
                '=',
                'siswa.id'
            );

        if ($kelasId) {
            $statusBantuanQuery->where(
                'siswa.kelas_id',
                $kelasId
            );
        }

        $applyDatePeriod(
            $statusBantuanQuery,
            'permintaan_bantuan.submitted_at'
        );

        $statusBantuanRaw = $statusBantuanQuery
            ->select(
                'permintaan_bantuan.status',
                DB::raw('COUNT(*) as total')
            )
            ->groupBy('permintaan_bantuan.status')
            ->pluck(
                'total',
                'permintaan_bantuan.status'
            );

        $statusBantuan = [
            'baru' => (int) ($statusBantuanRaw['baru'] ?? 0),
            'diproses' => (int) ($statusBantuanRaw['diproses'] ?? 0),
            'selesai' => (int) ($statusBantuanRaw['selesai'] ?? 0),
        ];

        $statusRujukanQuery = DB::table('rujukan')
            ->join(
                'siswa',
                'rujukan.siswa_id',
                '=',
                'siswa.id'
            );

        if ($kelasId) {
            $statusRujukanQuery->where(
                'siswa.kelas_id',
                $kelasId
            );
        }

        $applyDatePeriod(
            $statusRujukanQuery,
            'rujukan.referred_at'
        );

        $statusRujukanRaw = $statusRujukanQuery
            ->select(
                'rujukan.status',
                DB::raw('COUNT(*) as total')
            )
            ->groupBy('rujukan.status')
            ->pluck(
                'total',
                'rujukan.status'
            );

        $statusRujukan = [
            'baru' => (int) ($statusRujukanRaw['baru'] ?? 0),
            'diproses' => (int) ($statusRujukanRaw['diproses'] ?? 0),
            'selesai' => (int) ($statusRujukanRaw['selesai'] ?? 0),
        ];

        $attention = [
            'laporan' =>
                $statusLaporan['baru']
                + $statusLaporan['diproses']
                + $statusLaporan['dieskalasi'],

            'bantuan' =>
                $statusBantuan['baru']
                + $statusBantuan['diproses'],

            'rujukan' =>
                $statusRujukan['baru']
                + $statusRujukan['diproses'],

            'skrining' =>
                $skriningBerlangsung,
        ];

        $trenBulanan = collect();

        $bulan = $startDate
            ->copy()
            ->startOfMonth();

        $trendEnd = $endDate
            ->copy()
            ->startOfMonth();

        while ($bulan->lte($trendEnd)) {
            $start = $bulan
                ->copy()
                ->startOfMonth();

            $end = $bulan
                ->copy()
                ->endOfMonth();

            $laporanTrend = DB::table('laporan_kasus')
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
                    DB::raw(
                        'COALESCE('
                        . 'laporan_kasus.submitted_at, '
                        . 'laporan_kasus.created_at'
                        . ')'
                    ),
                    [
                        $start,
                        $end,
                    ]
                );

            if ($kelasId) {
                $laporanTrend->where(
                    'laporan_kasus.kelas_id_saat_laporan',
                    $kelasId
                );
            }

            $skriningTrend = DB::table('skrining_siswa')
                ->where(
                    'skrining_siswa.status',
                    'selesai'
                )
                ->whereBetween(
                    'skrining_siswa.completed_at',
                    [
                        $start,
                        $end,
                    ]
                );

            if ($kelasId) {
                $skriningTrend
                    ->where(
                        'skrining_siswa.tahun_ajaran',
                        $tahunAjaran
                    )
                    ->where(
                        'skrining_siswa.semester',
                        $semester
                    )
                    ->where(
                        'skrining_siswa.kelas_id_saat_skrining',
                        $kelasId
                    );
            }

            $bantuanTrend = DB::table('permintaan_bantuan')
                ->join(
                    'siswa',
                    'permintaan_bantuan.siswa_id',
                    '=',
                    'siswa.id'
                )
                ->whereBetween(
                    'permintaan_bantuan.submitted_at',
                    [
                        $start,
                        $end,
                    ]
                );

            $rujukanTrend = DB::table('rujukan')
                ->join(
                    'siswa',
                    'rujukan.siswa_id',
                    '=',
                    'siswa.id'
                )
                ->whereBetween(
                    'rujukan.referred_at',
                    [
                        $start,
                        $end,
                    ]
                );

            if ($kelasId) {
                $bantuanTrend->where(
                    'siswa.kelas_id',
                    $kelasId
                );

                $rujukanTrend->where(
                    'siswa.kelas_id',
                    $kelasId
                );
            }

            $trenBulanan->push(
                (object) [
                    'label' =>
                        $bulan
                            ->copy()
                            ->locale('id')
                            ->translatedFormat('M Y'),

                    'laporan' =>
                        $laporanTrend->count(),

                    'skrining' =>
                        $skriningTrend->count(),

                    'bantuan' =>
                        $bantuanTrend->count(),

                    'rujukan' =>
                        $rujukanTrend->count(),
                ]
            );

            $bulan->addMonth();
        }

        $laporanKelasQuery = DB::table('laporan_kasus')
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
            );

        if ($kelasId) {
            $laporanKelasQuery->where(
                'laporan_kasus.kelas_id_saat_laporan',
                $kelasId
            );
        }

        $laporanPerKelas = $laporanKelasQuery
            ->selectRaw(
                "
                COALESCE(
                    laporan_kasus.nama_kelas_saat_laporan,
                    'Belum memiliki kelas'
                ) as nama_kelas,
                COUNT(*) as total
                "
            )
            ->groupBy(
                'laporan_kasus.nama_kelas_saat_laporan'
            )
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        $maksKelas = max(
            1,
            (int) (
                $laporanPerKelas->max('total')
                ?? 0
            )
        );

        return view(
            'guru-bk.statistik.index',
            compact(
                'user',
                'periode',
                'periodeLabel',
                'tahunAjaran',
                'semester',
                'tahunAjaranOptions',
                'startDate',
                'endDate',
                'kelasId',
                'kelasList',
                'summary',
                'statusLaporan',
                'kategoriKasus',
                'skrining',
                'distribusiSkrining',
                'statusBantuan',
                'statusRujukan',
                'statusSkriningAmbang',
                'statusSkriningAbnormal',
                'attention',
                'trenBulanan',
                'laporanPerKelas',
                'maksKelas'
            )
        );
    }

    private function applySkriningAcademicScope(
        $query,
        string $tahunAjaran,
        string $semester,
        ?int $kelasId,
        Carbon $startDate,
        Carbon $endDate,
        string $dateExpression
    ): void {
        if ($kelasId) {
            $query
                ->where(
                    'skrining_siswa.tahun_ajaran',
                    $tahunAjaran
                )
                ->where(
                    'skrining_siswa.semester',
                    $semester
                )
                ->where(
                    'skrining_siswa.kelas_id_saat_skrining',
                    $kelasId
                );

            return;
        }

        $query->where(
            function ($scope) use (
                $tahunAjaran,
                $semester,
                $startDate,
                $endDate,
                $dateExpression
            ) {
                $scope->where(
                    function ($snapshot) use (
                        $tahunAjaran,
                        $semester
                    ) {
                        $snapshot
                            ->where(
                                'skrining_siswa.tahun_ajaran',
                                $tahunAjaran
                            )
                            ->where(
                                'skrining_siswa.semester',
                                $semester
                            );
                    }
                )
                ->orWhere(
                    function ($legacy) use (
                        $startDate,
                        $endDate,
                        $dateExpression
                    ) {
                        $legacy
                            ->where(
                                function ($missing) {
                                    $missing
                                        ->whereNull(
                                            'skrining_siswa.tahun_ajaran'
                                        )
                                        ->orWhereNull(
                                            'skrining_siswa.semester'
                                        );
                                }
                            )
                            ->whereBetween(
                                DB::raw(
                                    $dateExpression
                                ),
                                [
                                    $startDate,
                                    $endDate,
                                ]
                            );
                    }
                );
            }
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

            if (array_key_exists($aspek, $skor)) {
                $skor[$aspek] += $nilai;
            }
        }

        $totalKesulitan =
            $skor['E']
            + $skor['C']
            + $skor['H']
            + $skor['P'];

        return [
            'total_kesulitan' => $totalKesulitan,
            'interpretasi' => $this->interpretasiTotalSkrining(
                $totalKesulitan
            ),
        ];
    }

    private function normalizeAspekSkrining(string $aspek): string
    {
        return match ($aspek) {
            'E', 'gejala_emosional' => 'E',
            'C', 'masalah_perilaku' => 'C',
            'H', 'hiperaktivitas' => 'H',
            'P', 'teman_sebaya', 'masalah_teman_sebaya' => 'P',
            'Pro', 'prososial', 'perilaku_prososial' => 'Pro',
            default => $aspek,
        };
    }

    private function interpretasiTotalSkrining(int $total): string
    {
        if ($total <= 15) {
            return 'Normal';
        }

        if ($total <= 19) {
            return 'Ambang';
        }

        return 'Abnormal';
    }

    private function resolveAcademicPeriod(
        string $tahunAjaran,
        string $semester
    ): array {
        [$tahunAwal, $tahunAkhir] = array_map(
            'intval',
            explode('/', $tahunAjaran)
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
}
