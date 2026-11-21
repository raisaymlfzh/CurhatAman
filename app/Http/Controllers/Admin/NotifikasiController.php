<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notifikasi;
use App\Support\AdminNotifier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotifikasiController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        abort_unless(
            $user && $user->role === 'admin',
            403,
            'Kamu tidak memiliki akses ke halaman Admin.'
        );

        /*
         * Pengaman tambahan bila halaman notifikasi dibuka secara langsung.
         * Middleware Admin juga menjalankan sinkronisasi yang sama secara idempotent.
         */
        AdminNotifier::syncMangkrakNotifications();

        $filter = (string) $request->query('filter', 'semua');

        if (! in_array(
            $filter,
            ['semua', 'belum', 'dibaca'],
            true
        )) {
            $filter = 'semua';
        }

        $query = Notifikasi::query()
            ->where('user_id', $user->id)
            ->latest();

        if ($filter === 'belum') {
            $query->whereNull('read_at');
        } elseif ($filter === 'dibaca') {
            $query->whereNotNull('read_at');
        }

        $notifikasi = $query
            ->paginate(12)
            ->withQueryString();

        $summary = [
            'total' => Notifikasi::query()
                ->where('user_id', $user->id)
                ->count(),

            'belum' => Notifikasi::query()
                ->where('user_id', $user->id)
                ->whereNull('read_at')
                ->count(),

            'dibaca' => Notifikasi::query()
                ->where('user_id', $user->id)
                ->whereNotNull('read_at')
                ->count(),

            'dieskalasi' => Notifikasi::query()
                ->where('user_id', $user->id)
                ->where('tipe', 'kasus_dieskalasi')
                ->count(),

            'mangkrak' => Notifikasi::query()
                ->where('user_id', $user->id)
                ->where('tipe', 'kasus_mangkrak')
                ->count(),
        ];

        return view(
            'admin.notifikasi.index',
            compact(
                'user',
                'notifikasi',
                'summary',
                'filter'
            )
        );
    }

    public function read(
        Request $request,
        Notifikasi $notifikasi
    ) {
        $user = $request->user();

        abort_unless(
            $user
            && $user->role === 'admin'
            && (int) $notifikasi->user_id === (int) $user->id,
            403
        );

        if (is_null($notifikasi->read_at)) {
            $notifikasi->update([
                'read_at' => now(),
            ]);
        }

        if (
            $notifikasi->referensi_tipe === 'laporan_kasus'
            && $notifikasi->referensi_id
        ) {
            $laporanId = (int) $notifikasi->referensi_id;

            if ($notifikasi->tipe === 'kasus_dieskalasi') {
                $masihDieskalasi = DB::table('laporan_kasus')
                    ->where('id', $laporanId)
                    ->where('status_kasus', 'dieskalasi')
                    ->exists();

                if ($masihDieskalasi) {
                    return redirect()->route(
                        'admin.kasus-eskalasi.show',
                        $laporanId
                    );
                }

                return redirect()
                    ->route('admin.kasus-eskalasi.index')
                    ->with(
                        'success',
                        'Notifikasi ditandai dibaca. '
                        . 'Kasus tersebut sudah tidak berstatus dieskalasi.'
                    );
            }

            if ($notifikasi->tipe === 'kasus_mangkrak') {
                $staleDays = max(
                    1,
                    (int) config(
                        'curhataman.kasus_mangkrak_hari',
                        7
                    )
                );

                $masihMangkrak = DB::table('laporan_kasus')
                    ->where('id', $laporanId)
                    ->whereIn(
                        'status_kasus',
                        ['baru', 'diproses', 'dieskalasi']
                    )
                    ->where(
                        'updated_at',
                        '<=',
                        now()->subDays($staleDays)
                    )
                    ->exists();

                if ($masihMangkrak) {
                    return redirect()->route(
                        'admin.kasus-mangkrak.show',
                        $laporanId
                    );
                }

                return redirect()
                    ->route('admin.kasus-mangkrak.index')
                    ->with(
                        'success',
                        'Notifikasi ditandai dibaca. '
                        . 'Kasus tersebut sudah diperbarui dan tidak lagi mangkrak.'
                    );
            }
        }

        if (
            $notifikasi->tipe === 'profil_siswa_diperbarui'
            && $notifikasi->referensi_tipe === 'users'
            && $notifikasi->referensi_id
        ) {
            $siswaNisn = DB::table('siswa')
                ->where('user_id', (int) $notifikasi->referensi_id)
                ->value('nis');

            $targetQuery = $siswaNisn ?: DB::table('users')
                ->where('id', (int) $notifikasi->referensi_id)
                ->value('name');

            return redirect()
                ->route('admin.pengguna.index', $targetQuery ? ['q' => $targetQuery] : [])
                ->with('success', 'Menampilkan data profil siswa yang baru diperbarui.');
        }

        return back()->with(
            'success',
            'Notifikasi ditandai sebagai dibaca.'
        );
    }

    public function readAll(Request $request)
    {
        $user = $request->user();

        abort_unless(
            $user && $user->role === 'admin',
            403
        );

        Notifikasi::query()
            ->where('user_id', $user->id)
            ->whereNull('read_at')
            ->update([
                'read_at' => now(),
                'updated_at' => now(),
            ]);

        return back()->with(
            'success',
            'Semua notifikasi telah ditandai sebagai dibaca.'
        );
    }
}
