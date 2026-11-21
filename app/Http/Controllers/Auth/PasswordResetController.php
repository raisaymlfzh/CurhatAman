<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;

class PasswordResetController extends Controller
{
    /**
     * Tampilkan form minta tautan reset kata sandi.
     */
    public function showLinkRequestForm()
    {
        return view('auth.forgot-password');
    }

    /**
     * Kirim email tautan reset kata sandi khusus untuk akun siswa.
     */
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ], [
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
        ]);

        // Cari user dengan email, pastikan role = student dan is_active = true
        $user = User::where('email', $request->email)
            ->where('role', 'student')
            ->where('is_active', true)
            ->first();

        if ($user) {
            // Mengirimkan tautan reset ke siswa melalui Password Broker Laravel
            Password::sendResetLink(['email' => $user->email]);
        }

        // Selalu tampilkan pesan sukses generik untuk mencegah email enumeration
        return back()->with('status', 'Jika alamat email Anda terdaftar sebagai akun siswa yang aktif, tautan petunjuk reset kata sandi telah dikirimkan ke email Anda.');
    }

    /**
     * Tampilkan form reset kata sandi dengan token.
     */
    public function showResetForm(Request $request, string $token)
    {
        $rawEmail = $request->query('email') ?? $request->email ?? '';
        $cleanEmail = $rawEmail;

        if (is_string($rawEmail) && !empty($rawEmail)) {
            // Ekstrak dan bersihkan alamat email jika mengandung karakter Markdown/URL yang rusak
            if (preg_match('/^([a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,})/i', trim($rawEmail), $matches)) {
                $cleanEmail = $matches[1];
            } else {
                $cleanEmail = trim(explode(']', $rawEmail)[0]);
            }
        }

        return view('auth.reset-password', [
            'token' => $token,
            'email' => $cleanEmail,
        ]);
    }

    /**
     * Proses reset kata sandi pengguna.
     */
    public function reset(Request $request)
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'token.required' => 'Token reset kata sandi tidak valid.',
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Kata sandi baru wajib diisi.',
            'password.min' => 'Kata sandi baru minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi kata sandi baru tidak cocok.',
        ]);

        // Validasi tambahan: Memastikan akun bertipe student dan is_active = true
        $userCheck = User::where('email', $request->email)->first();

        if (!$userCheck || $userCheck->role !== 'student' || !$userCheck->is_active) {
            return back()->withErrors(['email' => 'Proses reset kata sandi ini hanya dapat dilakukan oleh akun siswa yang aktif.']);
        }

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                if ($user->role !== 'student' || !$user->is_active) {
                    return false;
                }

                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('success', 'Kata sandi berhasil diperbarui. Silakan masuk menggunakan kata sandi baru.');
        }

        $errorTranslations = [
            Password::INVALID_TOKEN => 'Tautan reset kata sandi tidak valid atau sudah kadaluarsa. Silakan minta tautan baru.',
            Password::INVALID_USER => 'Tidak dapat menemukan akun siswa dengan alamat email tersebut.',
            Password::RESET_THROTTLED => 'Terlalu banyak permintaan. Harap tunggu beberapa saat sebelum mencoba kembali.',
        ];

        $errorMessage = $errorTranslations[$status] ?? __($status);

        return back()->withErrors(['email' => $errorMessage]);
    }
}

