<?php

namespace App\Http\Controllers\GuruBK;

use App\Http\Controllers\Controller;
use App\Models\Notifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NotifikasiController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        $filter = $request->query('filter', 'semua');

        $query = Notifikasi::query()
            ->where('user_id', $user->id)
            ->latest();

        if ($filter === 'belum') {
            $query->whereNull('read_at');
        } elseif ($filter === 'dibaca') {
            $query->whereNotNull('read_at');
        }

        $notifikasi = $query->paginate(12)->withQueryString();

        $laporanIds = $notifikasi->getCollection()
            ->where('referensi_tipe', 'laporan_kasus')
            ->pluck('referensi_id')
            ->filter()
            ->unique()
            ->values();

        $laporanSiswaMap = [];
        if ($laporanIds->isNotEmpty()) {
            $rows = DB::table('laporan_kasus')
                ->join('siswa', 'laporan_kasus.siswa_id', '=', 'siswa.id')
                ->join('users', 'siswa.user_id', '=', 'users.id')
                ->whereIn('laporan_kasus.id', $laporanIds)
                ->select([
                    'laporan_kasus.id as laporan_id',
                    'laporan_kasus.kode_laporan',
                    'siswa.whatsapp_number',
                    'users.name as nama_siswa',
                ])
                ->get();

            foreach ($rows as $row) {
                $digits = preg_replace('/\D+/', '', (string) ($row->whatsapp_number ?? ''));
                if (str_starts_with($digits, '0')) {
                    $digits = '62' . substr($digits, 1);
                } elseif (str_starts_with($digits, '8')) {
                    $digits = '62' . $digits;
                }
                if ($digits !== '') {
                    $laporanSiswaMap[$row->laporan_id] = [
                        'phone' => $digits,
                        'nama_siswa' => $row->nama_siswa,
                        'kode_laporan' => $row->kode_laporan,
                    ];
                }
            }
        }

        $summary = [
            'total' => Notifikasi::where('user_id', $user->id)->count(),
            'belum' => Notifikasi::where('user_id', $user->id)
                ->whereNull('read_at')
                ->count(),
            'dibaca' => Notifikasi::where('user_id', $user->id)
                ->whereNotNull('read_at')
                ->count(),
        ];

        return view('guru-bk.notifikasi.index', compact(
            'user',
            'notifikasi',
            'summary',
            'filter',
            'laporanSiswaMap'
        ));
    }

    public function read(Notifikasi $notifikasi)
    {
        $user = Auth::user();

        abort_unless($notifikasi->user_id === $user->id, 403);

        if (is_null($notifikasi->read_at)) {
            $notifikasi->update([
                'read_at' => now(),
            ]);
        }

        return back();
    }

    public function readAll()
    {
        $user = Auth::user();

        Notifikasi::where('user_id', $user->id)
            ->whereNull('read_at')
            ->update([
                'read_at' => now(),
                'updated_at' => now(),
            ]);

        return back()->with('success', 'Semua notifikasi telah ditandai sebagai dibaca.');
    }
}
