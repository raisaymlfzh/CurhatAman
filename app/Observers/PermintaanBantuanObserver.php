<?php

namespace App\Observers;

use App\Models\Notifikasi;
use App\Models\PermintaanBantuan;
use App\Models\User;

class PermintaanBantuanObserver
{
    public function created(PermintaanBantuan $bantuan): void
    {
        $guruBkIds = User::query()
            ->where('role', 'counselor')
            ->where('is_active', true)
            ->pluck('id');

        $bantuan->loadMissing('siswa.user', 'siswa.kelas');
        $namaSiswa = $bantuan->siswa?->user?->name ?? 'Siswa';
        $namaKelas = $bantuan->siswa?->kelas?->nama_kelas ?? '';
        $kelasText = $namaKelas !== '' ? " ({$namaKelas})" : '';
        $jenisLabel = ucfirst($bantuan->jenis_bantuan ?? 'konseling');

        foreach ($guruBkIds as $guruBkId) {
            Notifikasi::firstOrCreate(
                [
                    'user_id' => $guruBkId,
                    'tipe' => 'permintaan_bantuan_baru',
                    'referensi_tipe' => 'permintaan_bantuan',
                    'referensi_id' => $bantuan->id,
                ],
                [
                    'judul' => 'Permintaan bantuan konseling baru',
                    'pesan' => "Terdapat pengajuan bantuan {$jenisLabel} baru dari {$namaSiswa}{$kelasText} yang perlu ditinjau.",
                ]
            );
        }
    }

    public function updated(PermintaanBantuan $bantuan): void
    {
        if ($bantuan->wasChanged('status')) {
            $bantuan->loadMissing('siswa.user', 'assignedBk');
            $siswaUserId = $bantuan->siswa?->user_id;

            if ($siswaUserId) {
                $namaBk = $bantuan->assignedBk?->name ?? 'Guru BK';
                $statusText = match ($bantuan->status) {
                    'diproses' => "sedang diproses oleh {$namaBk}",
                    'selesai' => "telah diselesaikan oleh {$namaBk}",
                    default => 'telah diperbarui',
                };

                $jenisLabel = ucfirst($bantuan->jenis_bantuan ?? 'konseling');

                Notifikasi::create([
                    'user_id' => $siswaUserId,
                    'tipe' => 'status_bantuan_diperbarui',
                    'referensi_tipe' => 'permintaan_bantuan',
                    'referensi_id' => $bantuan->id,
                    'judul' => 'Status Permintaan Bantuan',
                    'pesan' => "Permintaan bantuan {$jenisLabel} kamu {$statusText}.",
                ]);
            }
        }
    }
}
