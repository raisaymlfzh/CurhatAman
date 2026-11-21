<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(
        Request $request,
        Closure $next,
        string ...$roles
    ): Response {

        $user = $request->user();

        // Kalau belum login
        if (! $user) {
            return redirect()->route('login');
        }

        // Kalau akun sudah dinonaktifkan
        if (! $user->is_active) {

            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()
                ->route('login')
                ->withErrors([
                    'email' => 'Akun ini sedang tidak aktif.',
                ]);
        }

        // Cek apakah role user sesuai dengan role yang diizinkan
        abort_unless(
            in_array($user->role, $roles, true),
            403,
            'Kamu tidak memiliki akses ke halaman ini.'
        );

        // Wajibkan siswa melengkapi Email Aktif & Nomor WhatsApp saat pertama kali login
        if ($user->role === 'student' && ! $request->routeIs('siswa.profil.*')) {
            $siswa = $user->siswa;
            $emailBelumLengkap = empty($user->email)
                || str_ends_with(strtolower((string) $user->email), '@siswa.curhataman.local');
            $waBelumLengkap = empty(optional($siswa)->whatsapp_number);

            if ($emailBelumLengkap || $waBelumLengkap) {
                return redirect()
                    ->route('siswa.profil.index')
                    ->with(
                        'profile_incomplete_warning',
                        'Selamat datang di CurhatAman! Sebelum menggunakan layanan laporan atau skrining, silakan lengkapi Alamat Email Aktif dan Nomor WhatsApp kamu terlebih dahulu pada form di bawah ini.'
                    );
            }
        }

        return $next($request);
    }
}