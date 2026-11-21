<?php

namespace App\Http\Controllers\WaliKelas;

use App\Http\Controllers\Controller;
use App\Models\Notifikasi;

class NotifikasiController extends Controller
{
    public function read(Notifikasi $notifikasi)
    {
        abort_unless(
            $notifikasi->user_id === auth()->id(),
            403
        );

        if (is_null($notifikasi->read_at)) {
            $notifikasi->update([
                'read_at' => now(),
            ]);
        }

        return back();
    }

    public function readAll()
    {
        Notifikasi::query()
            ->where('user_id', auth()->id())
            ->whereNull('read_at')
            ->update([
                'read_at' => now(),
            ]);

        return back();
    }
}
