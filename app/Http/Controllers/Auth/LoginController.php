<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Menampilkan halaman login.
     *
     * Method ini disediakan dengan beberapa nama agar tetap kompatibel
     * apabila route GET login milik project memakai create/show/showLoginForm.
     */
    public function create()
    {
        return view('auth.login');
    }

    public function show()
    {
        return view('auth.login');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Proses login (Mendukung NISN untuk Siswa & Email untuk seluruh pengguna).
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => [
                'required',
                'string',
            ],

            'password' => [
                'required',
            ],
        ], [
            'email.required' => 'NISN atau alamat email wajib diisi.',
            'password.required' => 'Kata sandi wajib diisi.',
        ]);

        $loginIdentifier = trim($validated['email']);
        $password = $validated['password'];
        $remember = $request->boolean('remember');

        // Cek apakah input berupa NISN siswa (atau tidak mengandung '@')
        $targetEmail = $loginIdentifier;

        $siswaUser = \Illuminate\Support\Facades\DB::table('siswa')
            ->join('users', 'siswa.user_id', '=', 'users.id')
            ->where('siswa.nis', $loginIdentifier)
            ->select('users.email')
            ->first();

        if ($siswaUser && ! empty($siswaUser->email)) {
            $targetEmail = $siswaUser->email;
        }

        if (! Auth::attempt(
            [
                'email' => $targetEmail,
                'password' => $password,
            ],
            $remember
        )) {
            throw ValidationException::withMessages([
                'email' => 'NISN/Email atau kata sandi yang kamu masukkan tidak sesuai.',
            ]);
        }

        $request->session()->regenerate();

        $user = Auth::user();

        /*
        |--------------------------------------------------------------------------
        | Akun Nonaktif
        |--------------------------------------------------------------------------
        |
        | User yang status akunnya nonaktif tidak boleh masuk ke sistem.
        |
        */
        if (! $user->is_active) {

            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            throw ValidationException::withMessages([
                'email' => 'Akun ini sedang tidak aktif. Silakan hubungi administrator sekolah.',
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Redirect Berdasarkan Role
        |--------------------------------------------------------------------------
        |
        | Database CurhatAman menggunakan role:
        | - student
        | - counselor
        | - homeroom_teacher
        | - admin
        |
        | Untuk role selain siswa kita memakai URL terlebih dahulu.
        | Route dan dashboard masing-masing role akan dibuat pada tahap berikutnya.
        |
        */
        return match ($user->role) {

            'student' => redirect()
                ->route('siswa.dashboard'),

            'counselor' => redirect(
                '/guru-bk/dashboard'
            ),

            'homeroom_teacher' => redirect(
                '/wali-kelas/dashboard'
            ),

            'admin' => redirect(
                '/admin/dashboard'
            ),

            default => $this->logoutUnknownRole($request),
        };
    }

    /**
     * Logout.
     */
    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('login');
    }

    /**
     * Pengaman jika ditemukan role yang tidak dikenal.
     */
    private function logoutUnknownRole(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->withErrors([
                'email' => 'Role akun tidak dikenali oleh sistem.',
            ]);
    }
}
