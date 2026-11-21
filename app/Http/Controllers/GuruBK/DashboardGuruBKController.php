<?php

namespace App\Http\Controllers\GuruBK;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardGuruBKController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        abort_unless(
            $user && $user->role === 'counselor',
            403,
            'Kamu tidak memiliki akses ke halaman Guru BK.'
        );

        /*
        |--------------------------------------------------------------------------
        | Ringkasan Laporan
        |--------------------------------------------------------------------------
        |
        | Draft tidak dihitung sebagai laporan masuk karena belum dikirim siswa.
        |
        */
        $totalLaporan = DB::table('laporan_kasus')
            ->where('status_kasus', '!=', 'draft')
            ->count();

        $laporanBaru = DB::table('laporan_kasus')
            ->where('status_kasus', 'baru')
            ->count();

        $laporanDiproses = DB::table('laporan_kasus')
            ->where('status_kasus', 'diproses')
            ->count();

        $laporanDieskalasi = DB::table('laporan_kasus')
            ->where('status_kasus', 'dieskalasi')
            ->count();

        /*
        |--------------------------------------------------------------------------
        | Skrining Bulan Ini
        |--------------------------------------------------------------------------
        |
        | Dashboard awal hanya menampilkan jumlah sesi yang selesai.
        | Penilaian/skor SDQ belum dihitung di sini.
        |
        */
        $awalBulan = Carbon::now()->startOfMonth();
        $akhirBulan = Carbon::now()->endOfMonth();

        $skriningSelesaiBulanIni = DB::table('skrining_siswa')
            ->where('status', 'selesai')
            ->whereBetween('completed_at', [
                $awalBulan,
                $akhirBulan,
            ])
            ->count();

        /*
        |--------------------------------------------------------------------------
        | Laporan Terbaru
        |--------------------------------------------------------------------------
        |
        | Guru BK berwenang melihat identitas asli pelapor untuk kebutuhan
        | penanganan. status_rahasia tetap ditampilkan sebagai informasi
        | bahwa laporan tersebut bersifat terlindungi dari pihak yang tidak
        | berwenang.
        |
        */
        $laporanTerbaru = DB::table('laporan_kasus')
            ->join(
                'siswa',
                'laporan_kasus.siswa_id',
                '=',
                'siswa.id'
            )
            ->join(
                'users',
                'siswa.user_id',
                '=',
                'users.id'
            )
            ->leftJoin(
                'kelas',
                'siswa.kelas_id',
                '=',
                'kelas.id'
            )
            ->join(
                'kategori_kasus',
                'laporan_kasus.kategori_id',
                '=',
                'kategori_kasus.id'
            )
            ->where(
                'laporan_kasus.status_kasus',
                '!=',
                'draft'
            )
            ->select([
                'laporan_kasus.id',
                'laporan_kasus.kode_laporan',
                'laporan_kasus.status_kasus',
                'laporan_kasus.status_rahasia',
                'laporan_kasus.created_at',
                'users.name as nama_siswa',
                'kelas.nama_kelas',
                'kategori_kasus.nama_kategori',
            ])
            ->orderByDesc('laporan_kasus.created_at')
            ->limit(5)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Catatan Konseling
        |--------------------------------------------------------------------------
        */
        $konselingBulanIni = DB::table('catatan_konseling')
            ->whereBetween('tanggal_pertemuan', [
                $awalBulan->toDateString(),
                $akhirBulan->toDateString(),
            ])
            ->count();

        $totalKonseling = DB::table('catatan_konseling')->count();

        $konselingTerbaru = DB::table('catatan_konseling')
            ->join('siswa', 'catatan_konseling.siswa_id', '=', 'siswa.id')
            ->join('users as user_siswa', 'siswa.user_id', '=', 'user_siswa.id')
            ->leftJoin('kelas', 'siswa.kelas_id', '=', 'kelas.id')
            ->join('users as guru_bk', 'catatan_konseling.guru_bk_id', '=', 'guru_bk.id')
            ->select([
                'catatan_konseling.id',
                'catatan_konseling.tanggal_pertemuan',
                'catatan_konseling.jenis_layanan',
                'catatan_konseling.topik',
                'catatan_konseling.is_rahasia',
                'catatan_konseling.created_at',
                'user_siswa.name as nama_siswa',
                'kelas.nama_kelas',
                'guru_bk.name as nama_guru_bk',
            ])
            ->orderByDesc('catatan_konseling.tanggal_pertemuan')
            ->orderByDesc('catatan_konseling.id')
            ->limit(5)
            ->get();

        return view(
            'guru-bk.dashboard',
            compact(
                'user',
                'totalLaporan',
                'laporanBaru',
                'laporanDiproses',
                'laporanDieskalasi',
                'skriningSelesaiBulanIni',
                'laporanTerbaru',
                'konselingBulanIni',
                'totalKonseling',
                'konselingTerbaru'
            )
        );
    }
}
