<?php

namespace App\Http\Controllers\GuruBK;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfilGuruBKController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        abort_unless(
            $user && $user->role === 'counselor',
            403,
            'Kamu tidak memiliki akses ke halaman Guru BK.'
        );

        return view(
            'guru-bk.profil.index',
            compact('user')
        );
    }


    /**
     * Penggantian password Guru BK dialihkan ke Admin Sekolah.
     */
    public function updatePassword(Request $request)
    {
        abort(403, 'Penggantian password untuk akun Guru BK dikelola secara terpusat oleh Administrator Sekolah.');
    }

}
