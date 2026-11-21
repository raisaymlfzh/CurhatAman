<?php

namespace App\Http\Controllers\WaliKelas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $kelas = DB::table('kelas')
            ->where('wali_kelas_user_id', $user->id)
            ->where('is_active', true)
            ->first();

        return view('wali-kelas.profil.index', compact(
            'user',
            'kelas'
        ));
    }


    public function updatePassword(Request $request)
    {
        abort(403, 'Penggantian password untuk akun Wali Kelas dikelola secara terpusat oleh Administrator Sekolah.');
    }

}
