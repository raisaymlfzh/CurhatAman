<?php

namespace App\Http\Middleware;

use App\Models\PengaturanSistem;
use App\Support\AdminNotifier;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SyncAdminNotifications
{
    public function handle(
        Request $request,
        Closure $next
    ): Response {
        /*
         * Middleware ini dipasang setelah auth + RoleMiddleware:admin.
         * Sinkronisasi notifikasi mangkrak hanya dijalankan
         * jika toggle pada Pengaturan Sistem aktif.
         */

        $pengaturan = PengaturanSistem::current();

        if ($pengaturan->notifikasi_kasus_mangkrak) {
            AdminNotifier::syncMangkrakNotifications();
        }

        return $next($request);
    }
}