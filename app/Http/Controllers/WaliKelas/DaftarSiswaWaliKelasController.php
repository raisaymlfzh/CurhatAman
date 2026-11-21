<?php

namespace App\Http\Controllers\WaliKelas;

use App\Http\Controllers\Controller;
use App\Models\PengaturanSistem;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DaftarSiswaWaliKelasController extends Controller
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

        $search = trim((string) $request->query('q', ''));
        $statusKontak = strtolower(trim((string) $request->query('status_kontak', 'semua')));
        if (! in_array($statusKontak, ['semua', 'lengkap', 'belum_lengkap'], true)) {
            $statusKontak = 'semua';
        }

        $semuaSiswa = DB::table('siswa')
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

        $totalSiswa = $semuaSiswa->count();
        $kontakLengkap = $semuaSiswa->filter(function ($s) {
            $emailValid = ! empty($s->email) && ! str_ends_with(strtolower((string) $s->email), '@siswa.curhataman.local');
            $waValid = ! empty($s->whatsapp_number);
            return $emailValid && $waValid;
        })->count();
        $kontakBelumLengkap = max(0, $totalSiswa - $kontakLengkap);
        $akunAktif = $semuaSiswa->where('is_active', 1)->count();

        $daftarSiswa = $semuaSiswa->filter(function ($s) use ($search, $statusKontak) {
            $emailValid = ! empty($s->email) && ! str_ends_with(strtolower((string) $s->email), '@siswa.curhataman.local');
            $waValid = ! empty($s->whatsapp_number);
            $isLengkap = $emailValid && $waValid;

            if ($statusKontak === 'lengkap' && ! $isLengkap) {
                return false;
            }
            if ($statusKontak === 'belum_lengkap' && $isLengkap) {
                return false;
            }

            if ($search !== '') {
                $needle = mb_strtolower($search);
                $haystack = mb_strtolower(
                    ($s->name ?? '') . ' ' . ($s->nis ?? '') . ' ' . ($emailValid ? ($s->email ?? '') : '') . ' ' . ($s->whatsapp_number ?? '')
                );
                if (! str_contains($haystack, $needle)) {
                    return false;
                }
            }

            return true;
        })->values();

        return view('wali-kelas.siswa.index', [
            'user' => $user,
            'kelas' => $kelas,
            'kelasList' => $kelasList,
            'kelasId' => $kelasId,
            'tahunAjaran' => $tahunAjaran,
            'tahunAjaranOptions' => $tahunAjaranOptions,
            'semester' => $semester,
            'periodeLabel' => $periodeLabel,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'search' => $search,
            'statusKontak' => $statusKontak,
            'totalSiswa' => $totalSiswa,
            'kontakLengkap' => $kontakLengkap,
            'kontakBelumLengkap' => $kontakBelumLengkap,
            'akunAktif' => $akunAktif,
            'daftarSiswa' => $daftarSiswa,
        ]);
    }

    private function resolveAcademicPeriod(
        string $tahunAjaran,
        string $semester
    ): array {
        [$startYear, $endYear] = array_map(
            'intval',
            explode('/', $tahunAjaran)
        );

        if ($semester === 'ganjil') {
            return [
                Carbon::create($startYear, 7, 1)->startOfDay(),
                Carbon::create($startYear, 12, 31)->endOfDay(),
            ];
        }

        return [
            Carbon::create($endYear, 1, 1)->startOfDay(),
            Carbon::create($endYear, 6, 30)->endOfDay(),
        ];
    }
}

