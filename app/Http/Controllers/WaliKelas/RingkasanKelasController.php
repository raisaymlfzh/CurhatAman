<?php

namespace App\Http\Controllers\WaliKelas;

use App\Http\Controllers\Controller;
use App\Models\PengaturanSistem;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class RingkasanKelasController extends Controller
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
        | Kelas yang menjadi tanggung jawab Wali Kelas
        |--------------------------------------------------------------------------
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
        | Kelas Terpilih
        |--------------------------------------------------------------------------
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
        | Total siswa masih mengikuti siswa yang saat ini terhubung ke record
        | kelas tersebut. Histori keanggotaan siswa lintas tahun yang sepenuhnya
        | presisi membutuhkan tabel riwayat kelas siswa tersendiri.
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
        | Ringkasan Kasus
        |--------------------------------------------------------------------------
        |
        | Wali Kelas hanya menerima JUMLAH agregat.
        | Tidak mengambil nama siswa, identitas pelapor, kronologi, bukti,
        | maupun catatan tindak lanjut.
        */

        $queryKasus = DB::table('laporan_kasus')
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
            )
            ->where(
                'status_kasus',
                '!=',
                'draft'
            );

        $totalKasus = (clone $queryKasus)
            ->count();

        $kasusBaru = (clone $queryKasus)
            ->where(
                'status_kasus',
                'baru'
            )
            ->count();

        $kasusDiproses = (clone $queryKasus)
            ->where(
                'status_kasus',
                'diproses'
            )
            ->count();

        $kasusDieskalasi = (clone $queryKasus)
            ->where(
                'status_kasus',
                'dieskalasi'
            )
            ->count();

        $kasusSelesai = (clone $queryKasus)
            ->where(
                'status_kasus',
                'selesai'
            )
            ->count();

        /*
        |--------------------------------------------------------------------------
        | Statistik Kategori Kasus
        |--------------------------------------------------------------------------
        |
        | Hanya nama kategori + jumlah agregat.
        */

        $kategoriKasus = DB::table('laporan_kasus')
            ->join(
                'kategori_kasus',
                'laporan_kasus.kategori_id',
                '=',
                'kategori_kasus.id'
            )
            ->where(
                'laporan_kasus.kelas_id_saat_laporan',
                $kelasId
            )
            ->where(
                'laporan_kasus.tahun_ajaran',
                $tahunAjaran
            )
            ->where(
                'laporan_kasus.semester',
                $semester
            )
            ->where(
                'laporan_kasus.status_kasus',
                '!=',
                'draft'
            )
            ->select(
                'kategori_kasus.nama_kategori',
                DB::raw(
                    'COUNT(laporan_kasus.id) as jumlah'
                )
            )
            ->groupBy(
                'kategori_kasus.id',
                'kategori_kasus.nama_kategori'
            )
            ->orderByDesc('jumlah')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Partisipasi Skrining pada Periode Terpilih
        |--------------------------------------------------------------------------
        |
        | Hanya jumlah partisipasi agregat.
        | Tidak mengambil jawaban, skor, atau kategori individual.
        |
        | Karena skrining_siswa belum menyimpan snapshot kelas/periode akademik,
        | bagian ini masih memakai kelas siswa saat ini + timestamp completed_at.
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

        /*
        |--------------------------------------------------------------------------
        | Tren Kasus dalam Semester Terpilih
        |--------------------------------------------------------------------------
        |
        | Ganjil dan Genap sama-sama menghasilkan enam titik bulanan.
        */

        $dataTren = DB::table('laporan_kasus')
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
            )
            ->where(
                'status_kasus',
                '!=',
                'draft'
            )
            ->whereBetween(
                DB::raw(
                    'COALESCE(submitted_at, created_at)'
                ),
                [
                    $startDate,
                    $endDate,
                ]
            )
            ->selectRaw("
                DATE_FORMAT(
                    COALESCE(
                        submitted_at,
                        created_at
                    ),
                    '%Y-%m'
                ) as bulan,
                COUNT(id) as jumlah
            ")
            ->groupBy('bulan')
            ->pluck(
                'jumlah',
                'bulan'
            );

        $trenLabels = [];
        $trenValues = [];

        $bulan = $startDate
            ->copy()
            ->startOfMonth();

        $bulanAkhir = $endDate
            ->copy()
            ->startOfMonth();

        while ($bulan->lte($bulanAkhir)) {
            $key = $bulan->format('Y-m');

            $trenLabels[] = $bulan
                ->copy()
                ->locale('id')
                ->translatedFormat('M Y');

            $trenValues[] =
                (int) ($dataTren[$key] ?? 0);

            $bulan->addMonth();
        }

        /*
        |--------------------------------------------------------------------------
        | Catatan Pendampingan & Koordinasi Terkoordinasi untuk Wali Kelas
        |--------------------------------------------------------------------------
        |
        | Opsi A (Fresh Start): Data difilter sesuai periode Tahun Ajaran & Semester
        | yang sedang dipilih, sehingga ketika siswa naik kelas ke tahun ajaran baru,
        | Wali Kelas baru mendapatkan lembaran baru tanpa tercampur catatan tahun lalu.
        | Arsip tahun lalu tetap dapat diakses saat memfilter periode tahun bersangkutan.
        |
        */

        $hasRiwayatTable = Schema::hasTable('riwayat_kelas_siswa');

        $koordinasiSiswa = DB::table('catatan_konseling')
            ->join('siswa', 'catatan_konseling.siswa_id', '=', 'siswa.id')
            ->join('users as user_siswa', 'siswa.user_id', '=', 'user_siswa.id')
            ->join('users as guru_bk', 'catatan_konseling.guru_bk_id', '=', 'guru_bk.id')
            ->leftJoin('kelas', 'siswa.kelas_id', '=', 'kelas.id')
            ->where(function ($q) use ($kelasId, $tahunAjaran, $hasRiwayatTable) {
                $q->where('siswa.kelas_id', $kelasId);
                if ($hasRiwayatTable) {
                    $q->orWhereExists(function ($sub) use ($kelasId, $tahunAjaran) {
                        $sub->select(DB::raw(1))
                            ->from('riwayat_kelas_siswa')
                            ->whereColumn('riwayat_kelas_siswa.siswa_id', 'siswa.id')
                            ->where('riwayat_kelas_siswa.kelas_id', $kelasId)
                            ->where('riwayat_kelas_siswa.tahun_ajaran', $tahunAjaran);
                    });
                }
            })
            ->whereBetween(
                DB::raw('COALESCE(catatan_konseling.tanggal_pertemuan, DATE(catatan_konseling.created_at))'),
                [
                    $startDate->toDateString(),
                    $endDate->toDateString(),
                ]
            )
            ->where('catatan_konseling.is_rahasia', false)
            ->select(
                'catatan_konseling.id',
                'catatan_konseling.siswa_id',
                'catatan_konseling.tanggal_pertemuan',
                'catatan_konseling.jenis_layanan',
                'catatan_konseling.topik',
                'catatan_konseling.hasil_kesepakatan',
                'catatan_konseling.tindak_lanjut',
                'catatan_konseling.arahan_wali_kelas',
                'catatan_konseling.umpan_balik_wali_kelas',
                'catatan_konseling.created_at',
                'user_siswa.name as nama_siswa',
                'siswa.nis',
                'kelas.nama_kelas',
                'guru_bk.name as nama_guru_bk'
            )
            ->orderByDesc('catatan_konseling.created_at')
            ->get();

        $koordinasiPerSiswa = $koordinasiSiswa->groupBy('siswa_id')->map(function ($items) {
            $first = $items->first();
            $totalCatatan = $items->count();
            $adaCatatanBaru = $items->contains(fn ($item) => \Carbon\Carbon::parse($item->created_at)->diffInDays(now()) <= 3);

            return (object) [
                'siswa_id' => $first->siswa_id,
                'nama_siswa' => $first->nama_siswa,
                'nis' => $first->nis,
                'nama_kelas' => $first->nama_kelas,
                'total_catatan' => $totalCatatan,
                'catatan_terbaru' => $first,
                'daftar_catatan' => $items,
                'ada_catatan_baru' => $adaCatatanBaru,
            ];
        })->values();

        return view(
            'wali-kelas.ringkasan.index',
            compact(
                'user',
                'kelasMilikWali',
                'tahunAjaranOptions',
                'tahunAjaran',
                'semester',
                'kelasList',
                'kelasId',
                'kelas',
                'periodeLabel',
                'startDate',
                'endDate',
                'totalSiswa',
                'totalKasus',
                'kasusBaru',
                'kasusDiproses',
                'kasusDieskalasi',
                'kasusSelesai',
                'kategoriKasus',
                'sudahSkrining',
                'belumSkrining',
                'persentaseSkrining',
                'trenLabels',
                'trenValues',
                'koordinasiSiswa',
                'koordinasiPerSiswa',
                'daftarSiswa'
            )
        );
    }

    public function updateFeedbackWaliKelas(Request $request, int $id)
    {
        $user = $request->user();
        abort_unless($user && $user->role === 'homeroom_teacher', 403, 'Akses khusus Wali Kelas.');

        $catatan = DB::table('catatan_konseling')
            ->join('siswa', 'catatan_konseling.siswa_id', '=', 'siswa.id')
            ->where('catatan_konseling.id', $id)
            ->where('catatan_konseling.is_rahasia', false)
            ->where('catatan_konseling.is_shared_wali_kelas', true)
            ->whereExists(function ($query) use ($user) {
                $query->select(DB::raw(1))
                    ->from('kelas')
                    ->whereColumn('kelas.id', 'siswa.kelas_id')
                    ->where('kelas.wali_kelas_user_id', $user->id);
            })
            ->select('catatan_konseling.id')
            ->first();

        abort_unless($catatan, 404, 'Catatan koordinasi tidak ditemukan atau tidak memiliki otorisasi.');

        $validated = $request->validate([
            'umpan_balik_wali_kelas' => ['required', 'string', 'max:1000'],
        ]);

        DB::table('catatan_konseling')
            ->where('id', $id)
            ->update([
                'umpan_balik_wali_kelas' => trim($validated['umpan_balik_wali_kelas']),
                'updated_at' => now(),
            ]);

        return back()->with('success', 'Umpan balik / konfirmasi koordinasi berhasil dikirim ke Guru BK.');
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
