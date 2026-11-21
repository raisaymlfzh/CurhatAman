<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PengaturanSistem;
use App\Services\RiwayatKelasService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class KelasController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $q = trim((string) $request->get('q', ''));
        $tingkat = trim((string) $request->get('tingkat', ''));
        $status = trim((string) $request->get('status', ''));

        $query = DB::table('kelas as k')
            ->leftJoin(
                'users as w',
                'w.id',
                '=',
                'k.wali_kelas_user_id'
            )
            ->select([
                'k.id',
                'k.nama_kelas',
                'k.tingkat',
                'k.tahun_ajaran',
                'k.wali_kelas_user_id',
                'k.is_active',
                'k.created_at',
                'w.name as nama_wali_kelas',
                DB::raw(
                    '(SELECT COUNT(*) FROM siswa s WHERE s.kelas_id = k.id) as jumlah_siswa'
                ),
            ]);

        if ($q !== '') {
            $query->where(function ($sub) use ($q) {
                $sub
                    ->where(
                        'k.nama_kelas',
                        'like',
                        '%' . $q . '%'
                    )
                    ->orWhere(
                        'k.tahun_ajaran',
                        'like',
                        '%' . $q . '%'
                    )
                    ->orWhere(
                        'w.name',
                        'like',
                        '%' . $q . '%'
                    );
            });
        }

        if (in_array($tingkat, ['10', '11', '12'], true)) {
            $query->where(
                'k.tingkat',
                $tingkat
            );
        }

        if ($status === 'aktif') {
            $query->where(
                'k.is_active',
                true
            );
        } elseif ($status === 'nonaktif') {
            $query->where(
                'k.is_active',
                false
            );
        }

        $kelas = $query
            ->orderByRaw(
                "FIELD(k.tingkat, '10', '11', '12')"
            )
            ->orderBy('k.nama_kelas')
            ->paginate(12)
            ->withQueryString();

        $ringkasan = [
            'total' => DB::table('kelas')->count(),

            'aktif' => DB::table('kelas')
                ->where('is_active', true)
                ->count(),

            'tanpa_wali' => DB::table('kelas')
                ->where('is_active', true)
                ->whereNull('wali_kelas_user_id')
                ->count(),

            'total_siswa' => DB::table('siswa')
                ->whereNotNull('kelas_id')
                ->count(),
        ];

        $semuaKelas = DB::table('kelas as k')
            ->select([
                'k.id',
                'k.nama_kelas',
                'k.tingkat',
                'k.tahun_ajaran',
                'k.is_active',
                DB::raw('(SELECT COUNT(*) FROM siswa s WHERE s.kelas_id = k.id) as jumlah_siswa'),
            ])
            ->orderByDesc('k.tahun_ajaran')
            ->orderByRaw("FIELD(k.tingkat, '10', '11', '12')")
            ->orderBy('k.nama_kelas')
            ->get();

        $siswaPerKelas = DB::table('siswa as s')
            ->join('users as u', 'u.id', '=', 's.user_id')
            ->whereNotNull('s.kelas_id')
            ->orderBy('u.name')
            ->get([
                's.id',
                's.kelas_id',
                's.nis',
                'u.name',
            ])
            ->groupBy('kelas_id');

        return view(
            'admin.kelas.index',
            compact(
                'user',
                'kelas',
                'semuaKelas',
                'siswaPerKelas',
                'ringkasan',
                'q',
                'tingkat',
                'status'
            )
        );
    }

    public function create(Request $request)
    {
        $user = $request->user();

        /*
         * Mengambil konfigurasi akademik aktif
         * dari Pengaturan Sistem.
         */
        $pengaturan = PengaturanSistem::current();

        $tahunAjaranAktif =
            $pengaturan->tahun_ajaran_aktif;

        $semesterAktif =
            $pengaturan->semester_aktif;

        $waliKelasOptions = DB::table('users')
            ->whereIn('role', ['homeroom_teacher', 'wali_kelas'])
            ->where('is_active', true)
            ->orderBy('name')
            ->get(['id', 'name', 'email']);

        return view(
            'admin.kelas.create',
            compact(
                'user',
                'tahunAjaranAktif',
                'semesterAktif',
                'waliKelasOptions'
            )
        );
    }

    public function store(Request $request)
    {
        /*
         * Jika tahun ajaran tidak dikirim dari form,
         * gunakan Tahun Ajaran Aktif dari
         * Pengaturan Sistem sebagai fallback.
         */
        $tahunAjaran = trim(
            (string) $request->input(
                'tahun_ajaran',
                ''
            )
        );

        if ($tahunAjaran === '') {
            $tahunAjaran =
                PengaturanSistem::current()
                    ->tahun_ajaran_aktif;

            $request->merge([
                'tahun_ajaran' =>
                    $tahunAjaran,
            ]);
        }

        $validated = $request->validate(
            [
                'nama_kelas' => [
                    'required',
                    'string',
                    'max:100',
                    Rule::unique(
                        'kelas',
                        'nama_kelas'
                    )->where(
                        fn ($query) =>
                            $query->where(
                                'tahun_ajaran',
                                $request->input(
                                    'tahun_ajaran'
                                )
                            )
                    ),
                ],

                'tingkat' => [
                    'required',
                    Rule::in([
                        '10',
                        '11',
                        '12',
                    ]),
                ],

                'tahun_ajaran' => [
                    'required',
                    'regex:/^\d{4}\/\d{4}$/',
                    'max:9',
                ],

                'wali_kelas_user_id' => [
                    'nullable',
                    Rule::exists('users', 'id')->where(
                        fn ($query) => $query->whereIn('role', ['homeroom_teacher', 'wali_kelas'])
                    ),
                ],
            ],
            [
                'nama_kelas.required' =>
                    'Nama kelas wajib diisi.',

                'nama_kelas.unique' =>
                    'Nama kelas tersebut sudah terdaftar pada tahun ajaran yang sama.',

                'tingkat.required' =>
                    'Tingkat kelas wajib dipilih.',

                'tingkat.in' =>
                    'Tingkat kelas tidak valid.',

                'tahun_ajaran.required' =>
                    'Tahun ajaran wajib diisi.',

                'tahun_ajaran.regex' =>
                    'Format tahun ajaran harus seperti 2026/2027.',

                'wali_kelas_user_id.exists' =>
                    'Wali Kelas yang dipilih tidak valid.',
            ]
        );

        DB::table('kelas')->insert([
            'nama_kelas' =>
                strtoupper(
                    trim(
                        $validated['nama_kelas']
                    )
                ),

            'tingkat' =>
                $validated['tingkat'],

            'tahun_ajaran' =>
                trim(
                    $validated['tahun_ajaran']
                ),

            'wali_kelas_user_id' =>
                $validated['wali_kelas_user_id'] ?? null,

            'is_active' =>
                true,

            'created_at' =>
                now(),

            'updated_at' =>
                now(),
        ]);

        return redirect()
            ->route(
                'admin.kelas.index'
            )
            ->with(
                'success',
                'Kelas baru berhasil ditambahkan.'
            );
    }

    public function edit(
        Request $request,
        int $kelas
    ) {
        $user = $request->user();

        $dataKelas = DB::table('kelas as k')
            ->leftJoin(
                'users as w',
                'w.id',
                '=',
                'k.wali_kelas_user_id'
            )
            ->where(
                'k.id',
                $kelas
            )
            ->select([
                'k.id',
                'k.nama_kelas',
                'k.tingkat',
                'k.tahun_ajaran',
                'k.wali_kelas_user_id',
                'k.is_active',
                'w.name as nama_wali_kelas',
            ])
            ->first();

        abort_unless(
            $dataKelas,
            404,
            'Data kelas tidak ditemukan.'
        );

        $waliKelasOptions = DB::table('users')
            ->whereIn('role', ['homeroom_teacher', 'wali_kelas'])
            ->where('is_active', true)
            ->orderBy('name')
            ->get(['id', 'name', 'email']);

        return view(
            'admin.kelas.edit',
            compact(
                'user',
                'dataKelas',
                'waliKelasOptions'
            )
        );
    }

    public function update(
        Request $request,
        int $kelas
    ) {
        $dataKelas = DB::table('kelas')
            ->where(
                'id',
                $kelas
            )
            ->first();

        abort_unless(
            $dataKelas,
            404,
            'Data kelas tidak ditemukan.'
        );

        $validated = $request->validate(
            [
                'nama_kelas' => [
                    'required',
                    'string',
                    'max:100',
                    Rule::unique(
                        'kelas',
                        'nama_kelas'
                    )
                        ->ignore($kelas)
                        ->where(
                            fn ($query) =>
                                $query->where(
                                    'tahun_ajaran',
                                    $request->input(
                                        'tahun_ajaran'
                                    )
                                )
                        ),
                ],

                'tingkat' => [
                    'required',
                    Rule::in([
                        '10',
                        '11',
                        '12',
                    ]),
                ],

                'tahun_ajaran' => [
                    'required',
                    'regex:/^\d{4}\/\d{4}$/',
                    'max:9',
                ],

                'wali_kelas_user_id' => [
                    'nullable',
                    Rule::exists('users', 'id')->where(
                        fn ($query) => $query->whereIn('role', ['homeroom_teacher', 'wali_kelas'])
                    ),
                ],
            ],
            [
                'nama_kelas.required' =>
                    'Nama kelas wajib diisi.',

                'nama_kelas.unique' =>
                    'Nama kelas tersebut sudah terdaftar pada tahun ajaran yang sama.',

                'tingkat.required' =>
                    'Tingkat kelas wajib dipilih.',

                'tingkat.in' =>
                    'Tingkat kelas tidak valid.',

                'tahun_ajaran.required' =>
                    'Tahun ajaran wajib diisi.',

                'tahun_ajaran.regex' =>
                    'Format tahun ajaran harus seperti 2026/2027.',

                'wali_kelas_user_id.exists' =>
                    'Wali Kelas yang dipilih tidak valid.',
            ]
        );

        DB::table('kelas')
            ->where(
                'id',
                $kelas
            )
            ->update([
                'nama_kelas' =>
                    strtoupper(
                        trim(
                            $validated['nama_kelas']
                        )
                    ),

                'tingkat' =>
                    $validated['tingkat'],

                'tahun_ajaran' =>
                    trim(
                        $validated['tahun_ajaran']
                    ),

                'wali_kelas_user_id' =>
                    $validated['wali_kelas_user_id'] ?? null,

                'updated_at' =>
                    now(),
            ]);

        return redirect()
            ->route(
                'admin.kelas.index'
            )
            ->with(
                'success',
                'Data kelas berhasil diperbarui.'
            );
    }

    public function toggleStatus(
        Request $request,
        int $kelas
    ) {
        $dataKelas = DB::table('kelas')
            ->where(
                'id',
                $kelas
            )
            ->first();

        abort_unless(
            $dataKelas,
            404,
            'Data kelas tidak ditemukan.'
        );

        $statusBaru =
            ! (bool) $dataKelas->is_active;

        DB::table('kelas')
            ->where(
                'id',
                $kelas
            )
            ->update([
                'is_active' =>
                    $statusBaru,

                'updated_at' =>
                    now(),
            ]);

        return redirect()
            ->route(
                'admin.kelas.index'
            )
            ->with(
                'success',
                $statusBaru
                    ? 'Kelas berhasil diaktifkan kembali.'
                    : 'Kelas berhasil dinonaktifkan. Data historis tetap tersimpan.'
            );
    }

    public function promosiMassal(Request $request)
    {
        RiwayatKelasService::ensureReady();

        $validated = $request->validate([
            'aksi' => ['required', Rule::in(['naik_kelas', 'tamat'])],
            'kelas_asal_id' => ['required', 'integer', 'exists:kelas,id'],
            'kelas_tujuan_id' => ['nullable', 'required_if:aksi,naik_kelas', 'integer', 'exists:kelas,id', 'different:kelas_asal_id'],
            'siswa_ids' => ['nullable', 'array'],
            'siswa_ids.*' => ['integer'],
        ], [
            'aksi.required' => 'Pilih jenis aksi (Naik Kelas Massal atau Kelulusan Massal).',
            'kelas_asal_id.required' => 'Pilih kelas asal terlebih dahulu.',
            'kelas_tujuan_id.required_if' => 'Pilih kelas tujuan untuk kenaikan kelas.',
            'kelas_tujuan_id.different' => 'Kelas tujuan tidak boleh sama dengan kelas asal.',
        ]);

        $kelasAsal = DB::table('kelas')
            ->where('id', (int) $validated['kelas_asal_id'])
            ->first();

        $siswaQuery = DB::table('siswa')
            ->where('kelas_id', $kelasAsal->id);

        if ($request->has('siswa_ids')) {
            $selectedIds = array_map('intval', (array) $request->input('siswa_ids', []));
            if (empty($selectedIds)) {
                return redirect()
                    ->route('admin.kelas.index')
                    ->with('error', 'Pilih minimal 1 siswa yang akan diproses.');
            }
            $siswaQuery->whereIn('id', $selectedIds);
        }

        $siswaList = $siswaQuery->get(['id', 'user_id', 'kelas_id']);

        if ($siswaList->isEmpty()) {
            return redirect()
                ->route('admin.kelas.index')
                ->with('error', 'Tidak ada siswa aktif di kelas ' . $kelasAsal->nama_kelas . ' (' . $kelasAsal->tahun_ajaran . ').');
        }

        $jumlahSiswa = $siswaList->count();

        if ($validated['aksi'] === 'naik_kelas') {
            $kelasTujuan = DB::table('kelas')
                ->where('id', (int) $validated['kelas_tujuan_id'])
                ->first();

            DB::transaction(function () use ($siswaList, $kelasAsal, $kelasTujuan) {
                foreach ($siswaList as $siswa) {
                    RiwayatKelasService::recordClassAssignment(
                        (int) $siswa->id,
                        (int) $kelasTujuan->id,
                        'aktif'
                    );

                    DB::table('siswa')
                        ->where('id', $siswa->id)
                        ->update([
                            'kelas_id' => $kelasTujuan->id,
                            'updated_at' => now(),
                        ]);
                }

                // Jika tahun ajaran kelas asal berbeda dan sudah tidak ada siswa tersisa di kelas asal, arsipkan kelas asal
                $sisaSiswa = DB::table('siswa')->where('kelas_id', $kelasAsal->id)->count();
                if ($kelasAsal->tahun_ajaran !== $kelasTujuan->tahun_ajaran && $sisaSiswa === 0) {
                    DB::table('kelas')
                        ->where('id', $kelasAsal->id)
                        ->update([
                            'is_active' => false,
                            'updated_at' => now(),
                        ]);
                }
            });

            return redirect()
                ->route('admin.kelas.index')
                ->with(
                    'success',
                    "Berhasil menaikkan {$jumlahSiswa} siswa dari kelas {$kelasAsal->nama_kelas} ({$kelasAsal->tahun_ajaran}) ke kelas {$kelasTujuan->nama_kelas} ({$kelasTujuan->tahun_ajaran}). Riwayat kelas lama telah diarsipkan secara otomatis."
                );
        }

        // Aksi: Tamat / Lulus Massal (Kelas XII)
        DB::transaction(function () use ($siswaList, $kelasAsal) {
            foreach ($siswaList as $siswa) {
                RiwayatKelasService::recordClassAssignment(
                    (int) $siswa->id,
                    (int) $kelasAsal->id,
                    'tamat'
                );

                DB::table('users')
                    ->where('id', $siswa->user_id)
                    ->update([
                        'is_active' => false,
                        'updated_at' => now(),
                    ]);
            }

            $sisaSiswa = DB::table('siswa')
                ->join('users', 'users.id', '=', 'siswa.user_id')
                ->where('siswa.kelas_id', $kelasAsal->id)
                ->where('users.is_active', true)
                ->count();

            if ($sisaSiswa === 0) {
                DB::table('kelas')
                    ->where('id', $kelasAsal->id)
                    ->update([
                        'is_active' => false,
                        'updated_at' => now(),
                    ]);
            }
        });

        return redirect()
            ->route('admin.kelas.index')
            ->with(
                'success',
                "Berhasil meluluskan (menamatkan) {$jumlahSiswa} siswa dari kelas {$kelasAsal->nama_kelas} ({$kelasAsal->tahun_ajaran}). Seluruh data siswa tetap tersimpan di arsip Tahun Ajaran {$kelasAsal->tahun_ajaran}."
            );
    }
}