<?php

namespace App\Support;

use App\Models\Notifikasi;
use App\Models\PengaturanSistem;
use Illuminate\Support\Facades\DB;

class AdminNotifier
{
    /**
     * Membuat notifikasi Admin ketika sebuah kasus
     * masuk status dieskalasi.
     *
     * Notifikasi tidak memuat nama siswa, kronologi,
     * bukti, atau catatan tindak lanjut.
     */
    public static function notifyEscalatedCase(int $laporanId): void
    {
        $pengaturan = PengaturanSistem::current();

        /*
         * Jika notifikasi eskalasi dimatikan melalui
         * Pengaturan Sistem, proses kasus tetap berjalan
         * tetapi notifikasi Admin tidak dibuat.
         */
        if (! $pengaturan->notifikasi_kasus_dieskalasi) {
            return;
        }

        $laporan = DB::table('laporan_kasus')
            ->where('id', $laporanId)
            ->first([
                'id',
                'kode_laporan',
                'status_kasus',
                'updated_at',
            ]);

        if (
            ! $laporan
            || $laporan->status_kasus !== 'dieskalasi'
        ) {
            return;
        }

        $adminIds = DB::table('users')
            ->where('role', 'admin')
            ->where('is_active', true)
            ->pluck('id');

        foreach ($adminIds as $adminId) {
            /*
             * Mencegah notifikasi yang sama dibuat
             * berulang kali untuk episode eskalasi
             * yang sama.
             */
            $sudahAdaUntukEpisodeIni = Notifikasi::query()
                ->where('user_id', $adminId)
                ->where('tipe', 'kasus_dieskalasi')
                ->where('referensi_tipe', 'laporan_kasus')
                ->where('referensi_id', $laporanId)
                ->where('created_at', '>=', $laporan->updated_at)
                ->exists();

            if ($sudahAdaUntukEpisodeIni) {
                continue;
            }

            Notifikasi::create([
                'user_id' => $adminId,
                'tipe' => 'kasus_dieskalasi',
                'judul' => 'Kasus Dieskalasi',
                'pesan' =>
                    'Laporan '
                    . $laporan->kode_laporan
                    . ' memerlukan pengawasan tingkat sekolah.',
                'referensi_tipe' => 'laporan_kasus',
                'referensi_id' => $laporanId,
                'read_at' => null,
            ]);
        }
    }

    /**
     * Sinkronisasi notifikasi kasus mangkrak.
     *
     * Dipanggil saat Admin mengakses area Admin sehingga
     * kasus yang telah melewati batas waktu dapat
     * menghasilkan notifikasi yang belum ada.
     */
    public static function syncMangkrakNotifications(): int
    {
        $pengaturan = PengaturanSistem::current();

        /*
         * Jika toggle notifikasi mangkrak dimatikan,
         * tidak membuat notifikasi baru.
         */
        if (! $pengaturan->notifikasi_kasus_mangkrak) {
            return 0;
        }

        /*
         * Batas mangkrak berasal dari Pengaturan Sistem,
         * bukan lagi config dengan angka tetap 7 hari.
         */
        $staleDays = max(
            1,
            (int) $pengaturan->batas_kasus_mangkrak
        );

        $cutoff = now()->subDays($staleDays);

        $laporanMangkrak = DB::table('laporan_kasus')
            ->whereIn(
                'status_kasus',
                [
                    'baru',
                    'diproses',
                    'dieskalasi',
                ]
            )
            ->where(
                'updated_at',
                '<=',
                $cutoff
            )
            ->get([
                'id',
                'kode_laporan',
                'updated_at',
            ]);

        if ($laporanMangkrak->isEmpty()) {
            return 0;
        }

        $adminIds = DB::table('users')
            ->where('role', 'admin')
            ->where('is_active', true)
            ->pluck('id');

        $dibuat = 0;

        foreach ($adminIds as $adminId) {
            foreach ($laporanMangkrak as $laporan) {
                /*
                 * Satu kasus boleh menghasilkan notifikasi
                 * mangkrak baru setelah pernah diperbarui,
                 * lalu kembali melewati batas waktu.
                 */
                $sudahAdaUntukEpisodeIni = Notifikasi::query()
                    ->where('user_id', $adminId)
                    ->where('tipe', 'kasus_mangkrak')
                    ->where(
                        'referensi_tipe',
                        'laporan_kasus'
                    )
                    ->where(
                        'referensi_id',
                        $laporan->id
                    )
                    ->where(
                        'created_at',
                        '>=',
                        $laporan->updated_at
                    )
                    ->exists();

                if ($sudahAdaUntukEpisodeIni) {
                    continue;
                }

                Notifikasi::create([
                    'user_id' => $adminId,
                    'tipe' => 'kasus_mangkrak',
                    'judul' => 'Kasus Mangkrak',
                    'pesan' =>
                        'Laporan '
                        . $laporan->kode_laporan
                        . ' belum diperbarui minimal '
                        . $staleDays
                        . ' hari.',
                    'referensi_tipe' => 'laporan_kasus',
                    'referensi_id' => $laporan->id,
                    'read_at' => null,
                ]);

                $dibuat++;
            }
        }

        return $dibuat;
    }

    /**
     * Membuat notifikasi Admin ketika siswa memperbarui data profil akunnya.
     */
    public static function notifyStudentProfileUpdated(
        object $user,
        object $siswa,
        string $detailPerubahan
    ): void {
        $adminIds = DB::table('users')
            ->where('role', 'admin')
            ->where('is_active', true)
            ->pluck('id');

        $nisn = $siswa->nis ?: '-';

        foreach ($adminIds as $adminId) {
            Notifikasi::create([
                'user_id' => $adminId,
                'tipe' => 'profil_siswa_diperbarui',
                'judul' => 'Pembaruan Data Profil Siswa',
                'pesan' => "Siswa {$user->name} (NISN: {$nisn}) telah memperbarui {$detailPerubahan}.",
                'referensi_tipe' => 'users',
                'referensi_id' => $user->id,
                'read_at' => null,
            ]);
        }
    }
}