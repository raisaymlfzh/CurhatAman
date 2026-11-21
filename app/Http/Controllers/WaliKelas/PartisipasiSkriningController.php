<?php

namespace App\Http\Controllers\WaliKelas;

use App\Http\Controllers\Controller;
use App\Models\PengaturanSistem;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PartisipasiSkriningController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        abort_unless(
            $user && $user->role === 'homeroom_teacher',
            403,
            'Kamu tidak memiliki akses ke halaman Wali Kelas.'
        );

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

        $totalSiswa = DB::table('siswa')
            ->join(
                'users',
                'siswa.user_id',
                '=',
                'users.id'
            )
            ->where(
                'siswa.kelas_id',
                $kelasId
            )
            ->where(
                'users.role',
                'student'
            )
            ->where(
                'users.is_active',
                true
            )
            ->count();

        $sudahMengisi = DB::table('skrining_siswa')
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
            ->where(
                'siswa.kelas_id',
                $kelasId
            )
            ->where(
                'users.role',
                'student'
            )
            ->where(
                'users.is_active',
                true
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

        $belumMengisi = max(
            $totalSiswa - $sudahMengisi,
            0
        );

        $persentase = $totalSiswa > 0
            ? round(
                ($sudahMengisi / $totalSiswa) * 100
            )
            : 0;

        return view(
            'wali-kelas.skrining.index',
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
                'sudahMengisi',
                'belumMengisi',
                'persentase'
            )
        );
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
