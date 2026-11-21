<?php

namespace App\Observers;

use App\Models\LaporanKasus;
use App\Models\Notifikasi;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class LaporanKasusObserver
{
    public function created(LaporanKasus $laporan): void
    {
        if ($this->sudahDikirim($laporan)) {
            $this->kirimNotifikasiKeGuruBK($laporan);
            $this->kirimNotifikasiKeWaliKelas($laporan);
        }
    }

    public function updated(LaporanKasus $laporan): void
    {
        $baruDikirim =
            $laporan->wasChanged('status_kasus')
            && $laporan->status_kasus === 'baru';

        $submittedBaruTerisi =
            $laporan->wasChanged('submitted_at')
            && ! is_null($laporan->submitted_at);

        if (
            ($baruDikirim || $submittedBaruTerisi)
            && $this->sudahDikirim($laporan)
        ) {
            $this->kirimNotifikasiKeGuruBK($laporan);
            $this->kirimNotifikasiKeWaliKelas($laporan);
        }

        if (
            $laporan->wasChanged('status_kasus')
            && ! in_array($laporan->status_kasus, ['draft', 'baru'], true)
        ) {
            $this->kirimNotifikasiKeSiswa($laporan);
        }
    }

    private function kirimNotifikasiKeSiswa(LaporanKasus $laporan): void
    {
        $siswaUserId = DB::table('siswa')
            ->where('id', $laporan->siswa_id)
            ->value('user_id');

        if (! $siswaUserId) {
            return;
        }

        $laporan->loadMissing('assignedBk');
        $namaBk = $laporan->assignedBk?->name ?? 'Guru BK';

        $info = match ($laporan->status_kasus) {
            'diproses' => [
                'tipe' => 'laporan_ditangani',
                'judul' => 'Laporan kamu sedang diproses',
                'pesan' => "Laporan #{$laporan->kode_laporan} sedang ditangani dan ditindaklanjuti oleh {$namaBk}.",
            ],
            'selesai' => [
                'tipe' => 'laporan_selesai',
                'judul' => 'Laporan kamu telah selesai ditangani',
                'pesan' => "Penanganan untuk laporan #{$laporan->kode_laporan} telah diselesaikan oleh {$namaBk}.",
            ],
            'dieskalasi' => [
                'tipe' => 'laporan_dieskalasi',
                'judul' => 'Laporan kamu dialihkan untuk penanganan lanjutan',
                'pesan' => "Laporan #{$laporan->kode_laporan} telah dialihkan oleh {$namaBk} untuk koordinasi penanganan lebih lanjut.",
            ],
            default => null,
        };

        if ($info) {
            Notifikasi::create([
                'user_id' => $siswaUserId,
                'tipe' => $info['tipe'],
                'referensi_tipe' => 'laporan_kasus',
                'referensi_id' => $laporan->id,
                'judul' => $info['judul'],
                'pesan' => $info['pesan'],
            ]);
        }
    }

    private function sudahDikirim(LaporanKasus $laporan): bool
    {
        return $laporan->status_kasus !== 'draft'
            && (
                $laporan->status_kasus === 'baru'
                || ! is_null($laporan->submitted_at)
            );
    }

    private function kirimNotifikasiKeGuruBK(
        LaporanKasus $laporan
    ): void {
        $guruBkIds = User::query()
            ->where('role', 'counselor')
            ->where('is_active', true)
            ->pluck('id');

        foreach ($guruBkIds as $guruBkId) {
            Notifikasi::firstOrCreate(
                [
                    'user_id' => $guruBkId,
                    'tipe' => 'laporan_baru',
                    'referensi_tipe' => 'laporan_kasus',
                    'referensi_id' => $laporan->id,
                ],
                [
                    'judul' => 'Laporan kasus baru',
                    'pesan' => 'Terdapat laporan kasus baru dengan kode '
                        . $laporan->kode_laporan
                        . ' yang perlu ditinjau.',
                ]
            );
        }
    }

    private function kirimNotifikasiKeWaliKelas(
        LaporanKasus $laporan
    ): void {
        $kelas = DB::table('siswa')
            ->join('kelas', 'kelas.id', '=', 'siswa.kelas_id')
            ->where('siswa.id', $laporan->siswa_id)
            ->where('kelas.is_active', true)
            ->select([
                'kelas.id',
                'kelas.nama_kelas',
                'kelas.wali_kelas_user_id',
            ])
            ->first();

        if (
            ! $kelas
            || is_null($kelas->wali_kelas_user_id)
        ) {
            return;
        }

        $waliKelasAktif = User::query()
            ->where('id', $kelas->wali_kelas_user_id)
            ->where('role', 'homeroom_teacher')
            ->where('is_active', true)
            ->exists();

        if (! $waliKelasAktif) {
            return;
        }

        Notifikasi::firstOrCreate(
            [
                'user_id' => $kelas->wali_kelas_user_id,
                'tipe' => 'kasus_kelas_baru',
                'referensi_tipe' => 'laporan_kelas',
                'referensi_id' => $laporan->id,
            ],
            [
                'judul' => 'Kasus baru pada kelas Anda',
                'pesan' => 'Terdapat laporan kasus baru pada '
                    . $kelas->nama_kelas
                    . '. Detail laporan tetap dibatasi sesuai kewenangan Wali Kelas.',
            ]
        );
    }
}
