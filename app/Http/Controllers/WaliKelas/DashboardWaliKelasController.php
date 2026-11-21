<?php

namespace App\Http\Controllers\WaliKelas;

use App\Http\Controllers\Controller;
use App\Models\PengaturanSistem;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardWaliKelasController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        abort_unless(
            $user && $user->role === 'homeroom_teacher',
            403,
            'Kamu tidak memiliki akses ke halaman Wali Kelas.'
        );

        /*
        |--------------------------------------------------------------------------
        | Kelas yang boleh diakses Wali Kelas
        |--------------------------------------------------------------------------
        |
        | Hanya kelas yang memang terhubung dengan akun Wali Kelas ini.
        | Data yang ditampilkan tetap berupa agregat, bukan detail kasus siswa.
        */

        $kelasMilikWali = DB::table('kelas')
            ->where('wali_kelas_user_id', $user->id)
            ->orderByDesc('tahun_ajaran')
            ->orderBy('tingkat')
            ->orderBy('nama_kelas')
            ->get([
                'id',
                'nama_kelas',
                'tingkat',
                'tahun_ajaran',
                'is_active',
            ]);

        if ($kelasMilikWali->isEmpty()) {
            abort(
                403,
                'Akun ini belum terhubung dengan kelas.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Periode Akademik
        |--------------------------------------------------------------------------
        */

        $pengaturan = PengaturanSistem::current();

        $tahunAjaranOptions = $kelasMilikWali
            ->pluck('tahun_ajaran')
            ->filter()
            ->unique()
            ->values();

        $tahunAjaran = trim((string) $request->query(
            'tahun_ajaran',
            $pengaturan->tahun_ajaran_aktif
        ));

        if (! $tahunAjaranOptions->contains($tahunAjaran)) {
            $tahunAjaran = $tahunAjaranOptions
                ->first(
                    fn ($item) =>
                        $item === $pengaturan->tahun_ajaran_aktif
                )
                ?? $tahunAjaranOptions->first();
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

        /*
        |--------------------------------------------------------------------------
        | Pilihan Kelas
        |--------------------------------------------------------------------------
        |
        | Jika Wali Kelas pernah memegang kelas berbeda pada tahun ajaran
        | berbeda, kelas lama tetap dapat digunakan untuk melihat agregat arsip.
        */

        $kelasList = $kelasMilikWali
            ->where('tahun_ajaran', $tahunAjaran)
            ->values();

        if ($kelasList->isEmpty()) {
            abort(
                403,
                'Tidak ada kelas yang terhubung dengan akun ini pada tahun ajaran tersebut.'
            );
        }

        $kelasId = $request->filled('kelas_id')
            ? (int) $request->query('kelas_id')
            : (int) $kelasList->first()->id;

        $kelas = $kelasList->first(
            fn ($item) =>
                (int) $item->id === $kelasId
        );

        if (! $kelas) {
            $kelas = $kelasList->first();
            $kelasId = (int) $kelas->id;
        }

        $periodeLabel = sprintf(
            '%s · Semester %s',
            $tahunAjaran,
            ucfirst($semester)
        );

        /*
        |--------------------------------------------------------------------------
        | Total Siswa
        |--------------------------------------------------------------------------
        |
        | Ini merupakan jumlah siswa yang saat ini terhubung dengan record kelas
        | terpilih. Untuk histori keanggotaan siswa lintas tahun yang sepenuhnya
        | presisi dibutuhkan tabel riwayat kelas siswa tersendiri.
        */

        $daftarSiswa = DB::table('siswa')
            ->join('users', 'siswa.user_id', '=', 'users.id')
            ->where('siswa.kelas_id', $kelasId)
            ->where('users.role', 'student')
            ->select([
                'siswa.id',
                'siswa.nis',
                'siswa.tahun_masuk',
                'siswa.whatsapp_number',
                'users.name',
                'users.email',
                'users.is_active',
                'users.created_at',
            ])
            ->orderBy('users.name')
            ->get();

        $totalSiswa = $daftarSiswa->count();

        /*
        |--------------------------------------------------------------------------
        | Agregat Kasus
        |--------------------------------------------------------------------------
        |
        | Laporan kasus menggunakan snapshot kelas + tahun ajaran + semester
        | saat laporan dikirim. Wali Kelas tidak menerima detail laporan,
        | kronologi, bukti, atau identitas pelapor dari query ini.
        */

        $laporanPeriode = DB::table('laporan_kasus')
            ->where('status_kasus', '!=', 'draft')
            ->where(
                'kelas_id_saat_laporan',
                $kelasId
            )
            ->where(
                'tahun_ajaran',
                $tahunAjaran
            )
            ->where(
                'semester',
                $semester
            );

        $kasusAktif = (clone $laporanPeriode)
            ->whereIn(
                'status_kasus',
                [
                    'baru',
                    'diproses',
                    'dieskalasi',
                ]
            )
            ->count();

        $kasusSelesaiPeriode = (clone $laporanPeriode)
            ->where(
                'status_kasus',
                'selesai'
            )
            ->count();

        /*
         * Alias sementara agar view lama tidak error sebelum
         * view dashboard Wali Kelas ikut diperbarui.
         */
        $kasusSelesaiBulanIni = $kasusSelesaiPeriode;

        /*
        |--------------------------------------------------------------------------
        | Partisipasi Skrining
        |--------------------------------------------------------------------------
        |
        | Hanya partisipasi agregat yang dihitung. Tidak ada skor, jawaban,
        | maupun kategori individual yang diberikan kepada Wali Kelas.
        |
        | Karena skrining_siswa belum memiliki snapshot kelas/periode akademik,
        | filter kelas di bagian ini masih mengikuti kelas siswa saat ini.
        */

        $sudahSkrining = DB::table('skrining_siswa')
            ->join(
                'siswa',
                'skrining_siswa.siswa_id',
                '=',
                'siswa.id'
            )
            ->where(
                'siswa.kelas_id',
                $kelasId
            )
            ->where(
                'skrining_siswa.status',
                'selesai'
            )
            ->whereBetween(
                'skrining_siswa.completed_at',
                [
                    $startDate,
                    $endDate,
                ]
            )
            ->distinct(
                'skrining_siswa.siswa_id'
            )
            ->count(
                'skrining_siswa.siswa_id'
            );

        $belumSkrining = max(
            $totalSiswa - $sudahSkrining,
            0
        );

        $persentaseSkrining = $totalSiswa > 0
            ? round(
                ($sudahSkrining / $totalSiswa) * 100
            )
            : 0;

        return view(
            'wali-kelas.dashboard',
            compact(
                'user',
                'kelas',
                'kelasId',
                'kelasList',
                'tahunAjaran',
                'semester',
                'tahunAjaranOptions',
                'periodeLabel',
                'startDate',
                'endDate',
                'totalSiswa',
                'kasusAktif',
                'kasusSelesaiPeriode',
                'kasusSelesaiBulanIni',
                'sudahSkrining',
                'belumSkrining',
                'persentaseSkrining',
                'daftarSiswa'
            )
        );
    }


    /**
     * Ganjil = Juli - Desember tahun pertama.
     * Genap  = Januari - Juni tahun kedua.
     */
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
