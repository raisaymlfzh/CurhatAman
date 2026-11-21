<?php

namespace App\Http\Controllers\GuruBK;

use App\Http\Controllers\Controller;
use App\Services\RiwayatKelasService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataSiswaController extends Controller
{
    private function authorizeCounselor(Request $request): void
    {
        abort_unless(
            $request->user()
                && $request->user()->role === 'counselor',
            403,
            'Kamu tidak memiliki akses ke halaman Guru BK.'
        );
    }

    public function index(Request $request)
    {
        $this->authorizeCounselor($request);
        RiwayatKelasService::ensureReady();

        $user = $request->user();

        $search = trim((string) $request->query('q', ''));
        $tahunAjaran = trim((string) $request->query('tahun_ajaran', ''));
        $kelasId = trim((string) $request->query('kelas_id', ''));
        $tahunMasuk = trim((string) $request->query('tahun_masuk', ''));
        $statusAkun = trim((string) $request->query('status_akun', ''));
        $statusWhatsapp = trim((string) $request->query('whatsapp', ''));

        if ($tahunAjaran !== '' && ! preg_match('/^\d{4}\/\d{4}$/', $tahunAjaran)) {
            $tahunAjaran = '';
        }

        if ($kelasId !== '' && ! ctype_digit($kelasId)) {
            $kelasId = '';
        }

        if ($tahunMasuk !== '' && ! ctype_digit($tahunMasuk)) {
            $tahunMasuk = '';
        }

        if (! in_array($statusAkun, ['', 'aktif', 'nonaktif'], true)) {
            $statusAkun = '';
        }

        if (! in_array(
            $statusWhatsapp,
            [
                '',
                'ada',
                'belum',
                'izin',
                'tanpa_izin',
            ],
            true
        )) {
            $statusWhatsapp = '';
        }

        $base = DB::table('siswa')
            ->join(
                'users',
                'siswa.user_id',
                '=',
                'users.id'
            )
            ->where(
                'users.role',
                'student'
            );

        $summary = [
            'total' => (clone $base)->count(),
            'aktif' => (clone $base)
                ->where(
                    'users.is_active',
                    true
                )
                ->count(),
            'nonaktif' => (clone $base)
                ->where(
                    'users.is_active',
                    false
                )
                ->count(),
            'whatsapp' => (clone $base)
                ->whereNotNull(
                    'siswa.whatsapp_number'
                )
                ->where(
                    'siswa.whatsapp_number',
                    '!=',
                    ''
                )
                ->count(),
            'izin_whatsapp' => (clone $base)
                ->where(
                    'siswa.whatsapp_consent',
                    true
                )
                ->count(),
        ];

        $taFromKelas = DB::table('kelas')
            ->whereNotNull('tahun_ajaran')
            ->where('tahun_ajaran', '!=', '')
            ->pluck('tahun_ajaran');

        $taFromRiwayat = DB::table('riwayat_kelas_siswa')
            ->whereNotNull('tahun_ajaran')
            ->where('tahun_ajaran', '!=', '')
            ->pluck('tahun_ajaran');

        $tahunAjaranOptions = $taFromKelas
            ->merge($taFromRiwayat)
            ->unique()
            ->sortDesc()
            ->values();

        $kelasOptions = DB::table('kelas')
            ->select([
                'id',
                'nama_kelas',
                'tingkat',
                'tahun_ajaran',
                'is_active',
            ])
            ->orderByDesc('tahun_ajaran')
            ->orderBy('tingkat')
            ->orderBy('nama_kelas')
            ->get();

        $tahunMasukOptions = DB::table('siswa')
            ->whereNotNull('tahun_masuk')
            ->select('tahun_masuk')
            ->distinct()
            ->orderByDesc('tahun_masuk')
            ->pluck('tahun_masuk');

        $query = DB::table('siswa')
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
            ->where(
                'users.role',
                'student'
            )
            ->select([
                'siswa.id',
                'siswa.user_id',
                'siswa.nis',
                'siswa.tahun_masuk',
                'siswa.whatsapp_number',
                'siswa.whatsapp_consent',
                'siswa.whatsapp_consent_at',
                'users.name',
                'users.email',
                'users.is_active',
                'users.created_at as account_created_at',
                'kelas.id as kelas_id',
                'kelas.nama_kelas',
                'kelas.tingkat',
                'kelas.tahun_ajaran',
            ]);

        if ($search !== '') {
            $query->where(function ($subQuery) use ($search) {
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
                        'users.email',
                        'like',
                        '%' . $search . '%'
                    )
                    ->orWhere(
                        'siswa.whatsapp_number',
                        'like',
                        '%' . $search . '%'
                    );
            });
        }

        if ($tahunAjaran !== '') {
            $query->where(function ($sub) use ($tahunAjaran) {
                $sub->where('kelas.tahun_ajaran', $tahunAjaran)
                    ->orWhereExists(function ($hist) use ($tahunAjaran) {
                        $hist->select(DB::raw(1))
                            ->from('riwayat_kelas_siswa as rks')
                            ->whereColumn('rks.siswa_id', 'siswa.id')
                            ->where('rks.tahun_ajaran', $tahunAjaran);
                    });
            });
        }

        if ($kelasId !== '') {
            $targetKelasId = (int) $kelasId;
            $query->where(function ($sub) use ($targetKelasId) {
                $sub->where('siswa.kelas_id', $targetKelasId)
                    ->orWhereExists(function ($hist) use ($targetKelasId) {
                        $hist->select(DB::raw(1))
                            ->from('riwayat_kelas_siswa as rks')
                            ->whereColumn('rks.siswa_id', 'siswa.id')
                            ->where('rks.kelas_id', $targetKelasId);
                    });
            });
        }

        if ($tahunMasuk !== '') {
            $query->where(
                'siswa.tahun_masuk',
                (int) $tahunMasuk
            );
        }

        if ($statusAkun === 'aktif') {
            $query->where(
                'users.is_active',
                true
            );
        }

        if ($statusAkun === 'nonaktif') {
            $query->where(
                'users.is_active',
                false
            );
        }

        if ($statusWhatsapp === 'ada') {
            $query
                ->whereNotNull(
                    'siswa.whatsapp_number'
                )
                ->where(
                    'siswa.whatsapp_number',
                    '!=',
                    ''
                );
        }

        if ($statusWhatsapp === 'belum') {
            $query->where(function ($subQuery) {
                $subQuery
                    ->whereNull(
                        'siswa.whatsapp_number'
                    )
                    ->orWhere(
                        'siswa.whatsapp_number',
                        ''
                    );
            });
        }

        if ($statusWhatsapp === 'izin') {
            $query->where(
                'siswa.whatsapp_consent',
                true
            );
        }

        if ($statusWhatsapp === 'tanpa_izin') {
            $query
                ->whereNotNull(
                    'siswa.whatsapp_number'
                )
                ->where(
                    'siswa.whatsapp_number',
                    '!=',
                    ''
                )
                ->where(
                    'siswa.whatsapp_consent',
                    false
                );
        }

        $siswa = $query
            ->orderBy('users.name')
            ->paginate(12)
            ->withQueryString();

        if ($tahunAjaran !== '' || $kelasId !== '') {
            $siswaIds = $siswa->getCollection()->pluck('id')->all();
            if (! empty($siswaIds)) {
                $riwayatQuery = DB::table('riwayat_kelas_siswa')
                    ->whereIn('siswa_id', $siswaIds);

                if ($tahunAjaran !== '') {
                    $riwayatQuery->where('tahun_ajaran', $tahunAjaran);
                }
                if ($kelasId !== '') {
                    $riwayatQuery->where('kelas_id', (int) $kelasId);
                }

                $riwayatMap = $riwayatQuery
                    ->orderByDesc('id')
                    ->get()
                    ->keyBy('siswa_id');

                $siswa->getCollection()->transform(function ($item) use ($riwayatMap) {
                    $hist = $riwayatMap->get($item->id);
                    if ($hist && ($hist->nama_kelas !== $item->nama_kelas || $hist->tahun_ajaran !== $item->tahun_ajaran)) {
                        $item->arsip_nama_kelas = $hist->nama_kelas;
                        $item->arsip_tahun_ajaran = $hist->tahun_ajaran;
                    }
                    return $item;
                });
            }
        }

        return view(
            'guru-bk.data-siswa.index',
            compact(
                'user',
                'siswa',
                'summary',
                'tahunAjaranOptions',
                'kelasOptions',
                'tahunMasukOptions',
                'search',
                'tahunAjaran',
                'kelasId',
                'tahunMasuk',
                'statusAkun',
                'statusWhatsapp'
            )
        );
    }

    public function show(
        Request $request,
        int $siswa
    ) {
        $this->authorizeCounselor($request);
        RiwayatKelasService::ensureReady();

        $user = $request->user();

        $dataSiswa = DB::table('siswa')
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
            ->where(
                'siswa.id',
                $siswa
            )
            ->where(
                'users.role',
                'student'
            )
            ->first([
                'siswa.id',
                'siswa.user_id',
                'siswa.nis',
                'siswa.tahun_masuk',
                'siswa.whatsapp_number',
                'siswa.whatsapp_consent',
                'siswa.whatsapp_consent_at',
                'users.name',
                'users.email',
                'users.is_active',
                'users.created_at as account_created_at',
                'kelas.id as kelas_id',
                'kelas.nama_kelas',
                'kelas.tingkat',
                'kelas.tahun_ajaran',
            ]);

        abort_unless(
            $dataSiswa,
            404,
            'Data siswa tidak ditemukan.'
        );

        $skriningTotal = DB::table('skrining_siswa')
            ->where(
                'siswa_id',
                $dataSiswa->id
            )
            ->where(
                'status',
                'selesai'
            )
            ->count();

        $skriningTerakhir = DB::table('skrining_siswa')
            ->where(
                'siswa_id',
                $dataSiswa->id
            )
            ->where(
                'status',
                'selesai'
            )
            ->orderByDesc('completed_at')
            ->value('completed_at');

        $laporanTotal = DB::table('laporan_kasus')
            ->where(
                'siswa_id',
                $dataSiswa->id
            )
            ->where(
                'status_kasus',
                '!=',
                'draft'
            )
            ->count();

        $bantuanTotal = DB::table('permintaan_bantuan')
            ->where(
                'siswa_id',
                $dataSiswa->id
            )
            ->count();

        $rujukanTotal = DB::table('rujukan')
            ->where(
                'siswa_id',
                $dataSiswa->id
            )
            ->count();

        $rujukanAktif = DB::table('rujukan')
            ->where(
                'siswa_id',
                $dataSiswa->id
            )
            ->whereIn(
                'status',
                [
                    'baru',
                    'diproses',
                ]
            )
            ->count();

        $catatanKonselingTotal = DB::table('catatan_konseling')
            ->where(
                'siswa_id',
                $dataSiswa->id
            )
            ->count();

        $aktivitas = [
            'skrining_total' => $skriningTotal,
            'skrining_terakhir' => $skriningTerakhir,
            'laporan_total' => $laporanTotal,
            'bantuan_total' => $bantuanTotal,
            'rujukan_total' => $rujukanTotal,
            'rujukan_aktif' => $rujukanAktif,
            'catatan_konseling_total' => $catatanKonselingTotal,
        ];

        $riwayatKelas = DB::table('riwayat_kelas_siswa')
            ->where('siswa_id', $dataSiswa->id)
            ->orderByDesc('tahun_ajaran')
            ->orderByDesc('id')
            ->get();

        return view(
            'guru-bk.data-siswa.show',
            compact(
                'user',
                'dataSiswa',
                'aktivitas',
                'riwayatKelas'
            )
        );
    }
}
