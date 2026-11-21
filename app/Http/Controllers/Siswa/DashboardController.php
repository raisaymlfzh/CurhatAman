<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\LaporanKasus;
use App\Models\SkriningSiswa;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $siswa = $user->siswa;

        if (! $siswa) {
            abort(403, 'Data siswa tidak ditemukan.');
        }

        /*
        |--------------------------------------------------------------------------
        | Data Laporan
        |--------------------------------------------------------------------------
        */

        $laporan = \App\Models\LaporanKasus::with('kategori')
            ->where('siswa_id', $siswa->id)
            ->latest()
            ->get();

        $laporanTerakhir = $laporan->first();

        $totalLaporan = $laporan->count();

        $riwayatLaporan = $laporan->take(3);


        /*
        |--------------------------------------------------------------------------
        | Status Skrining Bulan Ini
        |--------------------------------------------------------------------------
        */

        $skriningBulanIni = SkriningSiswa::where('siswa_id', $siswa->id)
            ->where('status', 'selesai')
            ->whereYear('completed_at', now()->year)
            ->whereMonth('completed_at', now()->month)
            ->latest('completed_at')
            ->first();

        $sudahSkriningBulanIni = $skriningBulanIni !== null;


        return view('siswa.dashboard', compact(
            'user',
            'siswa',
            'laporan',
            'laporanTerakhir',
            'totalLaporan',
            'riwayatLaporan',
            'skriningBulanIni',
            'sudahSkriningBulanIni'
        ));
    }
}
