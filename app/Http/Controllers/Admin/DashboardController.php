<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PengaturanSistem;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $staleDays = max(
            1,
            (int) (PengaturanSistem::current()->batas_kasus_mangkrak ?? 14)
        );
        $cutoffMangkrak = now()->subDays($staleDays);

        $totalSiswa = DB::table('users')
            ->where('role', 'student')
            ->where('is_active', true)
            ->count();

        $guruBkAktif = DB::table('users')
            ->where('role', 'counselor')
            ->where('is_active', true)
            ->count();

        $waliKelasAktif = DB::table('users')
            ->where('role', 'homeroom_teacher')
            ->where('is_active', true)
            ->count();

        $totalKelas = DB::table('kelas')
            ->where('is_active', true)
            ->count();

        $kasusAktif = DB::table('laporan_kasus')
            ->whereIn('status_kasus', [
                'baru',
                'diproses',
                'dieskalasi',
            ])
            ->count();

        $kasusDieskalasi = DB::table('laporan_kasus')
            ->where('status_kasus', 'dieskalasi')
            ->count();

        $kasusMangkrakCount = DB::table('laporan_kasus')
            ->whereIn('status_kasus', ['baru', 'diproses'])
            ->where('updated_at', '<=', $cutoffMangkrak)
            ->count();

        $totalKasusKritis = $kasusDieskalasi + $kasusMangkrakCount;

        $eskalasiHighlights = DB::table('laporan_kasus')
            ->join('kategori_kasus', 'laporan_kasus.kategori_id', '=', 'kategori_kasus.id')
            ->leftJoin('users as assigned_bk', 'laporan_kasus.assigned_bk_id', '=', 'assigned_bk.id')
            ->where('laporan_kasus.status_kasus', 'dieskalasi')
            ->select([
                'laporan_kasus.id',
                'laporan_kasus.kode_laporan',
                'laporan_kasus.status_kasus',
                'laporan_kasus.updated_at',
                'kategori_kasus.nama_kategori',
                'assigned_bk.name as nama_bk',
            ])
            ->orderBy('laporan_kasus.updated_at')
            ->limit(2)
            ->get();

        $mangkrakHighlights = DB::table('laporan_kasus')
            ->join('kategori_kasus', 'laporan_kasus.kategori_id', '=', 'kategori_kasus.id')
            ->leftJoin('users as assigned_bk', 'laporan_kasus.assigned_bk_id', '=', 'assigned_bk.id')
            ->whereIn('laporan_kasus.status_kasus', ['baru', 'diproses'])
            ->where('laporan_kasus.updated_at', '<=', $cutoffMangkrak)
            ->select([
                'laporan_kasus.id',
                'laporan_kasus.kode_laporan',
                'laporan_kasus.status_kasus',
                'laporan_kasus.updated_at',
                'kategori_kasus.nama_kategori',
                'assigned_bk.name as nama_bk',
            ])
            ->orderBy('laporan_kasus.updated_at')
            ->limit(2)
            ->get();

        $kasusKritisHighlights = $eskalasiHighlights->concat($mangkrakHighlights);

        $kasusSelesaiBulanIni = DB::table('laporan_kasus')
            ->where('status_kasus', 'selesai')
            ->whereYear('resolved_at', now()->year)
            ->whereMonth('resolved_at', now()->month)
            ->count();

        $statusKasus = DB::table('laporan_kasus')
            ->select('status_kasus', DB::raw('COUNT(*) as total'))
            ->where('status_kasus', '!=', 'draft')
            ->groupBy('status_kasus')
            ->pluck('total', 'status_kasus');

        $statusLabels = [
            'baru' => 'Baru',
            'diproses' => 'Diproses',
            'selesai' => 'Selesai',
            'dieskalasi' => 'Dieskalasi',
        ];

        $statusChartLabels = [];
        $statusChartValues = [];

        foreach ($statusLabels as $key => $label) {
            $statusChartLabels[] = $label;
            $statusChartValues[] = (int) ($statusKasus[$key] ?? 0);
        }

        $awalPeriode = now()
            ->copy()
            ->startOfMonth()
            ->subMonths(5);

        $trenRaw = DB::table('laporan_kasus')
            ->selectRaw(
                "DATE_FORMAT(COALESCE(submitted_at, created_at), '%Y-%m') as periode,
                 COUNT(*) as total"
            )
            ->where('status_kasus', '!=', 'draft')
            ->whereRaw(
                'COALESCE(submitted_at, created_at) >= ?',
                [$awalPeriode->copy()->startOfDay()]
            )
            ->groupBy('periode')
            ->orderBy('periode')
            ->pluck('total', 'periode');

        $trenLabels = [];
        $trenValues = [];

        for ($i = 0; $i < 6; $i++) {
            $bulan = $awalPeriode->copy()->addMonths($i);

            $trenLabels[] = $bulan
                ->locale('id')
                ->translatedFormat('M Y');

            $trenValues[] = (int) (
                $trenRaw[$bulan->format('Y-m')]
                ?? 0
            );
        }

        $kasusDieskalasiTerbaru = DB::table('laporan_kasus')
            ->where('status_kasus', 'dieskalasi')
            ->select([
                'id',
                'kode_laporan',
                'created_at',
                'updated_at',
            ])
            ->orderByDesc('updated_at')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact(
            'user',
            'totalSiswa',
            'guruBkAktif',
            'waliKelasAktif',
            'totalKelas',
            'kasusAktif',
            'kasusDieskalasi',
            'kasusMangkrakCount',
            'totalKasusKritis',
            'staleDays',
            'kasusKritisHighlights',
            'kasusSelesaiBulanIni',
            'statusChartLabels',
            'statusChartValues',
            'trenLabels',
            'trenValues',
            'kasusDieskalasiTerbaru'
        ));
    }
}
