<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\RiwayatKelasService;
use App\Services\UserBatchImportService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class PenggunaController extends Controller
{
    public function __construct(
        protected UserBatchImportService $importService
    ) {}
    public function index(Request $request)
    {
        $user = $request->user();

        $q = trim((string) $request->get('q', ''));
        $role = trim((string) $request->get('role', ''));
        $status = trim((string) $request->get('status', ''));

        $allowedRoles = [
            'student',
            'counselor',
            'homeroom_teacher',
            'admin',
        ];

        if (! in_array($role, $allowedRoles, true)) {
            $role = '';
        }

        $query = DB::table('users as u')
            ->leftJoin('siswa as s', 's.user_id', '=', 'u.id')
            ->leftJoin('kelas as ks', 'ks.id', '=', 's.kelas_id')
            ->leftJoin('users as uwk', 'uwk.id', '=', 'ks.wali_kelas_user_id')
            ->leftJoin('kelas as kw', function ($join) {
                $join->on('kw.wali_kelas_user_id', '=', 'u.id')
                    ->where('kw.is_active', true);
            })
            ->select([
                'u.id',
                'u.name',
                'u.email',
                'u.role',
                'u.is_active',
                'u.created_at',
                's.id as siswa_id',
                's.kelas_id as kelas_siswa_id',
                's.nis',
                's.tahun_masuk',
                's.whatsapp_number',
                's.status_kondisi',
                'ks.nama_kelas as kelas_siswa',
                'ks.tingkat as tingkat_siswa',
                'ks.tahun_ajaran as tahun_ajaran_siswa',
                'uwk.name as nama_wali_kelas_siswa',
                'kw.nama_kelas as kelas_wali',
                'kw.tingkat as tingkat_wali',
                'kw.tahun_ajaran as tahun_ajaran_wali',
                DB::raw('(SELECT COUNT(*) FROM siswa WHERE kelas_id = kw.id) as total_siswa_wali'),
                DB::raw('(SELECT COUNT(*) FROM laporan_kasus WHERE assigned_bk_id = u.id) as total_kasus_bk'),
                DB::raw("(SELECT COUNT(*) FROM laporan_kasus WHERE assigned_bk_id = u.id AND status_kasus IN ('baru', 'diproses', 'dieskalasi')) as total_kasus_aktif_bk"),
            ]);

        if ($q !== '') {
            $query->where(function ($sub) use ($q) {
                $sub->where('u.name', 'like', '%' . $q . '%')
                    ->orWhere('u.email', 'like', '%' . $q . '%')
                    ->orWhere('s.nis', 'like', '%' . $q . '%')
                    ->orWhere('s.whatsapp_number', 'like', '%' . $q . '%')
                    ->orWhere('ks.nama_kelas', 'like', '%' . $q . '%')
                    ->orWhere('kw.nama_kelas', 'like', '%' . $q . '%');
            });
        }

        if ($role !== '') {
            $query->where('u.role', $role);
        }

        if ($status === 'aktif') {
            $query->where('u.is_active', true);
        } elseif ($status === 'nonaktif') {
            $query->where('u.is_active', false);
        }

        $pengguna = $query
            ->orderBy('u.name')
            ->paginate(10)
            ->withQueryString();

        $ringkasan = [
            'total' => DB::table('users')->count(),
            'student' => DB::table('users')
                ->where('role', 'student')
                ->count(),
            'counselor' => DB::table('users')
                ->where('role', 'counselor')
                ->count(),
            'homeroom_teacher' => DB::table('users')
                ->where('role', 'homeroom_teacher')
                ->count(),
            'admin' => DB::table('users')
                ->where('role', 'admin')
                ->count(),
        ];

        $daftarKelasAktif = DB::table('kelas')
            ->where('is_active', true)
            ->orderByDesc('tahun_ajaran')
            ->orderByRaw("FIELD(tingkat, '10', '11', '12')")
            ->orderBy('nama_kelas')
            ->get(['id', 'nama_kelas', 'tingkat', 'tahun_ajaran']);

        return view('admin.pengguna.index', compact(
            'user',
            'pengguna',
            'ringkasan',
            'daftarKelasAktif',
            'q',
            'role',
            'status'
        ));
    }

    public function create(Request $request)
    {
        $user = $request->user();

        $kelasTersedia = DB::table('kelas')
            ->where('is_active', true)
            ->whereNull('wali_kelas_user_id')
            ->orderByRaw("FIELD(tingkat, '10', '11', '12')")
            ->orderBy('nama_kelas')
            ->get([
                'id',
                'nama_kelas',
                'tingkat',
                'tahun_ajaran',
            ]);

        $semuaKelasAktif = DB::table('kelas')
            ->where('is_active', true)
            ->orderByRaw("FIELD(tingkat, '10', '11', '12')")
            ->orderBy('nama_kelas')
            ->get([
                'id',
                'nama_kelas',
                'tingkat',
                'tahun_ajaran',
            ]);

        return view('admin.pengguna.create', compact(
            'user',
            'kelasTersedia',
            'semuaKelasAktif'
        ));
    }

    public function store(Request $request)
    {
        $role = (string) $request->input('role', '');

        if ($role !== 'student') {
            $rawEmail = trim((string) $request->input('email', ''));
            if ($rawEmail !== '') {
                $localPart = explode('@', $rawEmail)[0];
                $request->merge([
                    'email' => strtolower(trim($localPart)) . '@curhataman.com',
                ]);
            }
        } else {
            $cleanNis = trim((string) $request->input('nis', ''));
            $request->merge([
                'nis' => $cleanNis,
            ]);
        }

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'role' => [
                'required',
                Rule::in([
                    'student',
                    'counselor',
                    'homeroom_teacher',
                ]),
            ],
            'email' => [
                'nullable',
                'required_unless:role,student',
                'email',
                'max:255',
                Rule::unique('users', 'email'),
            ],
            'nis' => [
                'nullable',
                'required_if:role,student',
                'string',
                'max:50',
                Rule::unique('siswa', 'nis'),
            ],
            'kelas_siswa_id' => [
                'nullable',
                'required_if:role,student',
                'integer',
                Rule::exists('kelas', 'id')->where(
                    fn ($query) => $query->where('is_active', true)
                ),
            ],
            'tahun_masuk' => [
                'nullable',
                'required_if:role,student',
                'integer',
                'digits:4',
                'min:2000',
                'max:' . (date('Y') + 1),
            ],
            'kelas_id' => [
                'nullable',
                'required_if:role,homeroom_teacher',
                'integer',
                Rule::exists('kelas', 'id')->where(
                    fn ($query) =>
                        $query
                            ->where('is_active', true)
                            ->whereNull('wali_kelas_user_id')
                ),
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],
        ], [
            'name.required' =>
                'Nama lengkap wajib diisi.',
            'role.required' =>
                'Pilih role pengguna.',
            'role.in' =>
                'Role hanya dapat berupa Siswa, Guru BK, atau Wali Kelas.',
            'email.required_unless' =>
                'Email wajib diisi untuk akun Guru BK atau Wali Kelas.',
            'email.email' =>
                'Format email tidak valid.',
            'email.unique' =>
                'Email tersebut sudah digunakan.',
            'nis.required_if' =>
                'NISN wajib diisi untuk akun Siswa.',
            'nis.unique' =>
                'NISN tersebut sudah terdaftar pada siswa lain.',
            'kelas_siswa_id.required_if' =>
                'Pilih kelas untuk siswa tersebut.',
            'kelas_siswa_id.exists' =>
                'Kelas siswa yang dipilih tidak valid.',
            'tahun_masuk.required_if' =>
                'Tahun masuk siswa wajib diisi.',
            'tahun_masuk.digits' =>
                'Tahun masuk harus terdiri dari 4 digit angka.',
            'kelas_id.required_if' =>
                'Pilih kelas yang akan diampu oleh Wali Kelas.',
            'kelas_id.exists' =>
                'Kelas tidak tersedia atau sudah memiliki Wali Kelas.',
            'password.required' =>
                'Password awal wajib diisi.',
            'password.min' =>
                'Password minimal 8 karakter.',
            'password.confirmed' =>
                'Konfirmasi password tidak sesuai.',
        ]);

        DB::transaction(function () use ($validated) {
            if ($validated['role'] === 'student') {
                $nisClean = preg_replace('/[^a-zA-Z0-9]/', '', $validated['nis']);
                $placeholderEmail = strtolower($nisClean ?: uniqid('siswa')) . '@siswa.curhataman.local';
                if (User::where('email', $placeholderEmail)->exists()) {
                    $placeholderEmail = strtolower($nisClean) . '.' . rand(100, 999) . '@siswa.curhataman.local';
                }

                $newUser = User::create([
                    'name' => trim($validated['name']),
                    'email' => $placeholderEmail,
                    'password' => Hash::make($validated['password']),
                    'role' => 'student',
                    'is_active' => true,
                ]);

                $siswaId = DB::table('siswa')->insertGetId([
                    'user_id' => $newUser->id,
                    'kelas_id' => (int) $validated['kelas_siswa_id'],
                    'nis' => trim($validated['nis']),
                    'tahun_masuk' => (int) $validated['tahun_masuk'],
                    'whatsapp_number' => null,
                    'whatsapp_consent' => false,
                    'status_kondisi' => 'aman',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                RiwayatKelasService::recordClassAssignment(
                    (int) $siswaId,
                    (int) $validated['kelas_siswa_id'],
                    'aktif'
                );

                $kelasRow = DB::table('kelas')
                    ->where('id', (int) $validated['kelas_siswa_id'])
                    ->first(['id', 'nama_kelas', 'wali_kelas_user_id']);

                if ($kelasRow && ! empty($kelasRow->wali_kelas_user_id)) {
                    DB::table('notifikasi')->insert([
                        'user_id' => $kelasRow->wali_kelas_user_id,
                        'tipe' => 'info_kelas',
                        'judul' => 'Siswa Baru di Kelas ' . $kelasRow->nama_kelas,
                        'pesan' => 'Admin telah menambahkan siswa baru: ' . trim($validated['name']) . ' (NISN: ' . trim($validated['nis']) . ') ke kelas ' . $kelasRow->nama_kelas . '.',
                        'referensi_tipe' => 'kelas',
                        'referensi_id' => $kelasRow->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }

                return;
            }

            $newUser = User::create([
                'name' => trim($validated['name']),
                'email' => strtolower(trim($validated['email'])),
                'password' => Hash::make($validated['password']),
                'role' => $validated['role'],
                'is_active' => true,
            ]);

            if ($validated['role'] === 'homeroom_teacher') {

                $updated = DB::table('kelas')
                    ->where('id', $validated['kelas_id'])
                    ->where('is_active', true)
                    ->whereNull('wali_kelas_user_id')
                    ->update([
                        'wali_kelas_user_id' => $newUser->id,
                        'updated_at' => now(),
                    ]);

                if ($updated !== 1) {
                    throw new \RuntimeException(
                        'Kelas tidak dapat ditetapkan karena sudah digunakan.'
                    );
                }
            }
        });

        $pesanSukses = match ($validated['role']) {
            'student' => 'Akun Siswa berhasil dibuat. Siswa dapat login menggunakan NISN dan password awal.',
            'counselor' => 'Akun Guru BK berhasil dibuat.',
            default => 'Akun Wali Kelas berhasil dibuat dan kelas berhasil ditetapkan.',
        };

        return redirect()
            ->route(
                'admin.pengguna.index',
                ['role' => $validated['role']]
            )
            ->with('success', $pesanSukses);
    }

    public function toggleStatus(Request $request, int $pengguna)
    {
        $targetUser = User::query()->findOrFail($pengguna);

        if ($targetUser->id === $request->user()->id) {
            return redirect()
                ->route(
                    'admin.pengguna.index',
                    ['role' => $request->get('current_role', '')]
                )
                ->with(
                    'error',
                    'Akun yang sedang digunakan tidak dapat dinonaktifkan.'
                );
        }

        $statusBaru = ! (bool) $targetUser->is_active;

        $targetUser->update([
            'is_active' => $statusBaru,
        ]);

        return redirect()
            ->route(
                'admin.pengguna.index',
                ['role' => $request->get('current_role', '')]
            )
            ->with(
                'success',
                $statusBaru
                    ? 'Akun ' . $targetUser->name . ' berhasil diaktifkan kembali.'
                    : 'Akun ' . $targetUser->name . ' berhasil dinonaktifkan.'
            );
    }

    public function updateKelasSiswa(Request $request, int $pengguna)
    {
        $targetUser = User::query()->findOrFail($pengguna);

        if ($targetUser->role !== 'student') {
            return redirect()
                ->route('admin.pengguna.index')
                ->with('error', 'Perubahan kelas hanya berlaku untuk akun Siswa.');
        }

        $validated = $request->validate([
            'kelas_baru_id' => [
                'required',
                'integer',
                Rule::exists('kelas', 'id')->where(
                    fn ($query) => $query->where('is_active', true)
                ),
            ],
        ], [
            'kelas_baru_id.required' => 'Pilih kelas baru untuk siswa.',
            'kelas_baru_id.exists' => 'Kelas yang dipilih tidak valid atau tidak aktif.',
        ]);

        $siswaRow = DB::table('siswa')
            ->where('user_id', $targetUser->id)
            ->first(['id', 'kelas_id']);

        if (! $siswaRow) {
            return redirect()
                ->route('admin.pengguna.index', ['role' => 'student'])
                ->with('error', 'Data profil siswa tidak ditemukan.');
        }

        $kelasBaruId = (int) $validated['kelas_baru_id'];

        $kelasBaru = DB::table('kelas')
            ->where('id', $kelasBaruId)
            ->first(['id', 'nama_kelas', 'tahun_ajaran']);

        DB::transaction(function () use ($siswaRow, $kelasBaruId) {
            RiwayatKelasService::recordClassAssignment(
                (int) $siswaRow->id,
                $kelasBaruId,
                'aktif'
            );

            DB::table('siswa')
                ->where('id', $siswaRow->id)
                ->update([
                    'kelas_id' => $kelasBaruId,
                    'updated_at' => now(),
                ]);
        });

        return redirect()
            ->route('admin.pengguna.index', ['role' => $request->get('current_role', 'student')])
            ->with(
                'success',
                'Kelas siswa ' . $targetUser->name . ' berhasil diperbarui ke ' . ($kelasBaru->nama_kelas ?? '') . ' (' . ($kelasBaru->tahun_ajaran ?? '') . '). Kelas sebelumnya otomatis tersimpan sebagai arsip riwayat kelas.'
            );
    }

    public function resetPasswordForm(
        Request $request,
        int $pengguna
    ) {
        $user = $request->user();

        $targetUser = User::query()
            ->select([
                'id',
                'name',
                'email',
                'role',
                'is_active',
            ])
            ->findOrFail($pengguna);

        if ($targetUser->role === 'student') {
            return redirect()
                ->route('admin.pengguna.index', ['role' => 'student'])
                ->with(
                    'error',
                    'Fitur reset password oleh Admin tidak tersedia untuk akun Siswa. Siswa dapat menggunakan fitur Lupa Kata Sandi via Email.'
                );
        }

        return view(
            'admin.pengguna.reset-password',
            compact('user', 'targetUser')
        );
    }

    public function resetPassword(
        Request $request,
        int $pengguna
    ) {
        $targetUser = User::query()->findOrFail($pengguna);

        if ($targetUser->role === 'student') {
            return redirect()
                ->route('admin.pengguna.index', ['role' => 'student'])
                ->with(
                    'error',
                    'Fitur reset password oleh Admin tidak tersedia untuk akun Siswa. Siswa dapat menggunakan fitur Lupa Kata Sandi via Email.'
                );
        }

        $validated = $request->validate([
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],
        ], [
            'password.required' =>
                'Password baru wajib diisi.',
            'password.min' =>
                'Password minimal 8 karakter.',
            'password.confirmed' =>
                'Konfirmasi password tidak sesuai.',
        ]);

        $targetUser->update([
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()
            ->route(
                'admin.pengguna.index',
                ['role' => $targetUser->role]
            )
            ->with(
                'success',
                'Password akun ' . $targetUser->name . ' berhasil direset.'
            );
    }

    public function importView(Request $request)
    {
        $user = $request->user();
        $kelasTersedia = DB::table('kelas')
            ->where('is_active', true)
            ->orderBy('nama_kelas')
            ->get();

        return view('admin.pengguna.import', compact('user', 'kelasTersedia'));
    }

    public function importSiswa(Request $request)
    {
        $request->validate([
            'file_siswa' => ['required', 'file', 'mimes:csv,txt,xlsx', 'max:5120'],
            'default_password' => ['nullable', 'string', 'min:6'],
        ], [
            'file_siswa.required' => 'Pilih file spreadsheet (.csv atau .xlsx) untuk diimpor.',
            'file_siswa.mimes' => 'Format file harus berupa CSV (.csv) atau Excel (.xlsx).',
            'file_siswa.max' => 'Ukuran file maksimal adalah 5MB.',
        ]);

        try {
            $rows = $this->importService->readFile($request->file('file_siswa'));
            $result = $this->importService->importSiswa(
                $rows,
                $request->user(),
                ['default_password' => $request->input('default_password')]
            );

            if ($result['success'] > 0) {
                $msg = "Berhasil mengimpor {$result['success']} data siswa baru!";
                if ($result['failed'] > 0) {
                    $msg .= " Namun terdapat {$result['failed']} baris yang dilewati / gagal.";
                }
                return redirect()
                    ->route('admin.pengguna.import')
                    ->with('import_result', $result)
                    ->with('success', $msg);
            }

            return redirect()
                ->route('admin.pengguna.import')
                ->with('import_result', $result)
                ->with('error', 'Tidak ada data siswa yang berhasil diimpor. Silakan periksa catatan rincian di bawah.');

        } catch (\Throwable $e) {
            return redirect()
                ->route('admin.pengguna.import')
                ->with('error', 'Gagal memproses file spreadsheet: ' . $e->getMessage());
        }
    }

    public function importGuru(Request $request)
    {
        $request->validate([
            'file_guru' => ['required', 'file', 'mimes:csv,txt,xlsx', 'max:5120'],
            'default_password' => ['nullable', 'string', 'min:6'],
        ], [
            'file_guru.required' => 'Pilih file spreadsheet (.csv atau .xlsx) untuk diimpor.',
            'file_guru.mimes' => 'Format file harus berupa CSV (.csv) atau Excel (.xlsx).',
            'file_guru.max' => 'Ukuran file maksimal adalah 5MB.',
        ]);

        try {
            $rows = $this->importService->readFile($request->file('file_guru'));
            $result = $this->importService->importGuru(
                $rows,
                $request->user(),
                ['default_password' => $request->input('default_password')]
            );

            if ($result['success'] > 0) {
                $msg = "Berhasil mengimpor {$result['success']} akun Guru BK / Wali Kelas baru!";
                if ($result['failed'] > 0) {
                    $msg .= " Namun terdapat {$result['failed']} baris yang dilewati / gagal.";
                }
                return redirect()
                    ->route('admin.pengguna.import')
                    ->with('import_result', $result)
                    ->with('success', $msg);
            }

            return redirect()
                ->route('admin.pengguna.import')
                ->with('import_result', $result)
                ->with('error', 'Tidak ada data guru yang berhasil diimpor. Silakan periksa catatan rincian di bawah.');

        } catch (\Throwable $e) {
            return redirect()
                ->route('admin.pengguna.import')
                ->with('error', 'Gagal memproses file spreadsheet: ' . $e->getMessage());
        }
    }

    public function downloadTemplate(Request $request, string $type, string $format)
    {
        $format = strtolower($format);
        $type = strtolower($type);

        if (!in_array($format, ['csv', 'xlsx'], true)) {
            $format = 'csv';
        }

        if ($type === 'siswa') {
            $filename = 'template_import_siswa.' . $format;
            $content = $format === 'xlsx'
                ? $this->importService->generateTemplateSiswaXlsx()
                : $this->importService->generateTemplateSiswaCsv();
        } else {
            $filename = 'template_import_guru.' . $format;
            $content = $format === 'xlsx'
                ? $this->importService->generateTemplateGuruXlsx()
                : $this->importService->generateTemplateGuruCsv();
        }

        $contentType = $format === 'xlsx'
            ? 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
            : 'text/csv; charset=UTF-8';

        return response($content, 200, [
            'Content-Type' => $contentType,
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }
}
