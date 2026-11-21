<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AktivitasGuruBKController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        abort_unless(
            $user && $user->role === 'admin',
            403,
            'Kamu tidak memiliki akses ke halaman Admin.'
        );

        $q = trim((string) $request->query('q', ''));
        $status = (string) $request->query('status', '');

        $awalBulan = now()->copy()->startOfMonth();
        $akhirBulan = now()->copy()->endOfMonth();

        $query = DB::table('users')
            ->where('users.role', 'counselor')
            ->select([
                'users.id',
                'users.name',
                'users.email',
                'users.is_active',
                'users.created_at',
            ])

            ->selectSub(function ($subQuery) {
                $subQuery
                    ->from('laporan_kasus')
                    ->selectRaw('COUNT(*)')
                    ->where(function ($q) {
                        $q->whereColumn(
                            'laporan_kasus.assigned_bk_id',
                            'users.id'
                        )->orWhereExists(function ($sub) {
                            $sub->select(DB::raw(1))
                                ->from('konflik_kepentingan')
                                ->whereColumn('konflik_kepentingan.laporan_id', 'laporan_kasus.id')
                                ->whereColumn('konflik_kepentingan.user_id', 'users.id')
                                ->where('konflik_kepentingan.ada_konflik', true);
                        });
                    })
                    ->where(
                        'laporan_kasus.status_kasus',
                        '!=',
                        'draft'
                    );
            }, 'total_kasus')

            ->selectSub(function ($subQuery) {
                $subQuery
                    ->from('laporan_kasus')
                    ->selectRaw('COUNT(*)')
                    ->where(function ($q) {
                        $q->whereColumn(
                            'laporan_kasus.assigned_bk_id',
                            'users.id'
                        )->orWhereExists(function ($sub) {
                            $sub->select(DB::raw(1))
                                ->from('konflik_kepentingan')
                                ->whereColumn('konflik_kepentingan.laporan_id', 'laporan_kasus.id')
                                ->whereColumn('konflik_kepentingan.user_id', 'users.id')
                                ->where('konflik_kepentingan.ada_konflik', true);
                        });
                    })
                    ->whereIn(
                        'laporan_kasus.status_kasus',
                        [
                            'baru',
                            'diproses',
                        ]
                    );
            }, 'kasus_aktif')

            ->selectSub(function ($subQuery) {
                $subQuery
                    ->from('laporan_kasus')
                    ->selectRaw('COUNT(*)')
                    ->where(function ($q) {
                        $q->whereColumn(
                            'laporan_kasus.assigned_bk_id',
                            'users.id'
                        )->orWhereExists(function ($sub) {
                            $sub->select(DB::raw(1))
                                ->from('konflik_kepentingan')
                                ->whereColumn('konflik_kepentingan.laporan_id', 'laporan_kasus.id')
                                ->whereColumn('konflik_kepentingan.user_id', 'users.id')
                                ->where('konflik_kepentingan.ada_konflik', true);
                        });
                    })
                    ->where(
                        'laporan_kasus.status_kasus',
                        'dieskalasi'
                    );
            }, 'kasus_dieskalasi')

            ->selectSub(function ($subQuery) {
                $subQuery
                    ->from('laporan_kasus')
                    ->selectRaw('COUNT(*)')
                    ->whereColumn(
                        'laporan_kasus.assigned_bk_id',
                        'users.id'
                    )
                    ->where(
                        'laporan_kasus.status_kasus',
                        'selesai'
                    );
            }, 'kasus_selesai')

            ->selectSub(
                function ($subQuery) use (
                    $awalBulan,
                    $akhirBulan
                ) {
                    $subQuery
                        ->from('laporan_kasus')
                        ->selectRaw('COUNT(*)')
                        ->whereColumn(
                            'laporan_kasus.assigned_bk_id',
                            'users.id'
                        )
                        ->where(
                            'laporan_kasus.status_kasus',
                            'selesai'
                        )
                        ->whereBetween(
                            'laporan_kasus.resolved_at',
                            [
                                $awalBulan,
                                $akhirBulan,
                            ]
                        );
                },
                'selesai_bulan_ini'
            )

            ->selectSub(
                function ($subQuery) use (
                    $awalBulan,
                    $akhirBulan
                ) {
                    $subQuery
                        ->from('tindak_lanjut')
                        ->selectRaw('COUNT(*)')
                        ->whereColumn(
                            'tindak_lanjut.user_id',
                            'users.id'
                        )
                        ->whereBetween(
                            'tindak_lanjut.tanggal',
                            [
                                $awalBulan,
                                $akhirBulan,
                            ]
                        );
                },
                'tindak_lanjut_bulan_ini'
            )

            ->selectSub(function ($subQuery) {
                $subQuery
                    ->from('tindak_lanjut')
                    ->selectRaw('MAX(tindak_lanjut.tanggal)')
                    ->whereColumn(
                        'tindak_lanjut.user_id',
                        'users.id'
                    );
            }, 'tindak_lanjut_terakhir');

        if ($q !== '') {
            $query->where(function ($subQuery) use ($q) {
                $subQuery
                    ->where(
                        'users.name',
                        'like',
                        '%' . $q . '%'
                    )
                    ->orWhere(
                        'users.email',
                        'like',
                        '%' . $q . '%'
                    );
            });
        }

        if ($status === 'aktif') {
            $query->where('users.is_active', true);
        } elseif ($status === 'nonaktif') {
            $query->where('users.is_active', false);
        }

        $guruBk = $query
            ->orderByDesc('users.is_active')
            ->orderBy('users.name')
            ->paginate(10)
            ->withQueryString();

        $totalKasusBk = DB::table('laporan_kasus')
            ->whereNotNull('assigned_bk_id')
            ->where('status_kasus', '!=', 'draft')
            ->count();

        $totalSelesaiBk = DB::table('laporan_kasus')
            ->whereNotNull('assigned_bk_id')
            ->where('status_kasus', 'selesai')
            ->count();

        $persentasePenyelesaian = $totalKasusBk > 0
            ? (int) round(($totalSelesaiBk / $totalKasusBk) * 100)
            : 0;

        $ringkasan = [
            'total_bk' => DB::table('users')
                ->where('role', 'counselor')
                ->count(),

            'bk_aktif' => DB::table('users')
                ->where('role', 'counselor')
                ->where('is_active', true)
                ->count(),

            'kasus_aktif' => DB::table('laporan_kasus')
                ->whereNotNull('assigned_bk_id')
                ->whereIn(
                    'status_kasus',
                    [
                        'baru',
                        'diproses',
                    ]
                )
                ->count(),

            'tindak_lanjut_bulan_ini' =>
                DB::table('tindak_lanjut')
                    ->whereBetween(
                        'tanggal',
                        [
                            $awalBulan,
                            $akhirBulan,
                        ]
                    )
                    ->count(),

            'total_kasus_bk' => $totalKasusBk,
            'total_selesai_bk' => $totalSelesaiBk,
            'persentase_penyelesaian' => $persentasePenyelesaian,
        ];

        return view(
            'admin.aktivitas-guru-bk.index',
            compact(
                'user',
                'guruBk',
                'ringkasan',
                'q',
                'status'
            )
        );
    }
}
