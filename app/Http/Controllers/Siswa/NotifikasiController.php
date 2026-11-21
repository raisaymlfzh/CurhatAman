<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Notifikasi;
use Illuminate\Http\Request;

class NotifikasiController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        abort_unless(
            $user && $user->role === 'student',
            403,
            'Kamu tidak memiliki akses ke halaman Siswa.'
        );

        $filter = strtolower(trim((string) $request->query(
            'filter',
            'semua'
        )));

        if (! in_array($filter, ['semua', 'belum', 'dibaca'], true)) {
            $filter = 'semua';
        }

        $query = Notifikasi::query()
            ->where('user_id', $user->id)
            ->latest();

        if ($filter === 'belum') {
            $query->whereNull('read_at');
        }

        if ($filter === 'dibaca') {
            $query->whereNotNull('read_at');
        }

        $notifikasi = $query
            ->paginate(12)
            ->withQueryString();

        $summary = [
            'total' => Notifikasi::where(
                'user_id',
                $user->id
            )->count(),

            'belum' => Notifikasi::where(
                'user_id',
                $user->id
            )
                ->whereNull('read_at')
                ->count(),

            'dibaca' => Notifikasi::where(
                'user_id',
                $user->id
            )
                ->whereNotNull('read_at')
                ->count(),
        ];

        return view(
            'siswa.notifikasi.index',
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
            $user && $user->role === 'student',
            403
        );

        abort_unless(
            (int) $notifikasi->user_id === (int) $user->id,
            403
        );

        if (is_null($notifikasi->read_at)) {
            $notifikasi->update([
                'read_at' => now(),
            ]);
        }

        if ($request->expectsJson() || $request->ajax() || $request->header('X-Requested-With') === 'XMLHttpRequest') {
            $unreadCount = Notifikasi::where('user_id', $user->id)
                ->whereNull('read_at')
                ->count();

            $readCount = Notifikasi::where('user_id', $user->id)
                ->whereNotNull('read_at')
                ->count();

            return response()->json([
                'success' => true,
                'message' => 'Notifikasi berhasil ditandai sebagai dibaca.',
                'unread_count' => $unreadCount,
                'read_count' => $readCount,
            ]);
        }

        return back();
    }

    public function readAll(Request $request)
    {
        $user = $request->user();

        abort_unless(
            $user && $user->role === 'student',
            403
        );

        Notifikasi::where(
            'user_id',
            $user->id
        )
            ->whereNull('read_at')
            ->update([
                'read_at' => now(),
                'updated_at' => now(),
            ]);

        if ($request->expectsJson() || $request->ajax() || $request->header('X-Requested-With') === 'XMLHttpRequest') {
            return response()->json([
                'success' => true,
                'message' => 'Semua notifikasi telah ditandai sebagai dibaca.',
                'unread_count' => 0,
            ]);
        }

        return back()->with(
            'success',
            'Semua notifikasi telah ditandai sebagai dibaca.'
        );
    }
}
