<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        abort_unless(
            $user && $user->role === 'admin',
            403,
            'Kamu tidak memiliki akses ke halaman Admin.'
        );

        return view('admin.profil.index', compact('user'));
    }

    public function updatePassword(Request $request)
    {
        $user = $request->user();

        abort_unless(
            $user && $user->role === 'admin',
            403,
            'Kamu tidak memiliki akses ke halaman Admin.'
        );

        $validated = $request->validate([
            'current_password' => [
                'required',
                'current_password',
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
                'different:current_password',
            ],
        ], [
            'current_password.required' =>
                'Password saat ini wajib diisi.',
            'current_password.current_password' =>
                'Password saat ini tidak sesuai.',
            'password.required' =>
                'Password baru wajib diisi.',
            'password.min' =>
                'Password baru minimal 8 karakter.',
            'password.confirmed' =>
                'Konfirmasi password baru tidak sesuai.',
            'password.different' =>
                'Password baru harus berbeda dari password saat ini.',
        ]);

        $user->update([
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()
            ->route('admin.profil.index')
            ->with(
                'password_success',
                'Password Admin berhasil diperbarui.'
            );
    }
}
