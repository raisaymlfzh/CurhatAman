<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RujukanController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        abort_unless(
            $user && $user->role === 'student',
            403,
            'Kamu tidak memiliki akses ke halaman siswa.'
        );

        $siswa = DB::table('siswa')
            ->where('user_id', $user->id)
            ->first();

        abort_unless(
            $siswa,
            403,
            'Data siswa tidak ditemukan.'
        );

        $rujukan = DB::table('rujukan')
            ->join(
                'layanan_rujukan',
                'rujukan.layanan_id',
                '=',
                'layanan_rujukan.id'
            )
            ->where(
                'rujukan.siswa_id',
                $siswa->id
            )
            ->select([
                'rujukan.id',
                'rujukan.status',
                'rujukan.referred_at',
                'rujukan.updated_at',
                'rujukan.laporan_id',
                'rujukan.skrining_id',
                'layanan_rujukan.nama_layanan',
                'layanan_rujukan.jenis_layanan',
                'layanan_rujukan.kontak',
                'layanan_rujukan.alamat_url',
            ])
            ->orderByDesc('rujukan.referred_at')
            ->get();

        $summary = [
            'total' => $rujukan->count(),
            'baru' => $rujukan
                ->where('status', 'baru')
                ->count(),
            'diproses' => $rujukan
                ->where('status', 'diproses')
                ->count(),
            'selesai' => $rujukan
                ->where('status', 'selesai')
                ->count(),
        ];

        return view(
            'siswa.rujukan',
            compact(
                'user',
                'siswa',
                'rujukan',
                'summary'
            )
        );
    }
}
