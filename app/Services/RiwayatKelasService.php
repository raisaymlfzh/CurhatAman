<?php

namespace App\Services;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class RiwayatKelasService
{
    public static function ensureReady(): void
    {
        if (! Schema::hasTable('riwayat_kelas_siswa')) {
            Schema::create('riwayat_kelas_siswa', function (Blueprint $table) {
                $table->id();
                $table->foreignId('siswa_id')
                    ->constrained('siswa')
                    ->cascadeOnDelete();
                $table->foreignId('kelas_id')
                    ->nullable()
                    ->constrained('kelas')
                    ->nullOnDelete();
                $table->string('nama_kelas', 100);
                $table->string('tingkat', 20)->nullable();
                $table->string('tahun_ajaran', 20);
                $table->string('status_riwayat', 30)->default('aktif');
                $table->timestamps();

                $table->index(['siswa_id', 'tahun_ajaran'], 'riwayat_kelas_siswa_ta_idx');
                $table->index(['tahun_ajaran', 'kelas_id'], 'riwayat_kelas_ta_kelas_idx');
            });

            self::backfillInitialData();
        } else {
            self::syncCurrentClasses();
        }
    }

    public static function syncCurrentClasses(): void
    {
        $missing = DB::table('siswa')
            ->join('kelas', 'siswa.kelas_id', '=', 'kelas.id')
            ->whereNotNull('kelas.tahun_ajaran')
            ->whereNotExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('riwayat_kelas_siswa as rks')
                    ->whereColumn('rks.siswa_id', 'siswa.id')
                    ->whereColumn('rks.kelas_id', 'kelas.id')
                    ->whereColumn('rks.tahun_ajaran', 'kelas.tahun_ajaran');
            })
            ->select([
                'siswa.id as siswa_id',
                'kelas.id as kelas_id',
                'kelas.nama_kelas',
                'kelas.tingkat',
                'kelas.tahun_ajaran',
            ])
            ->get();

        foreach ($missing as $row) {
            DB::table('riwayat_kelas_siswa')->insert([
                'siswa_id' => $row->siswa_id,
                'kelas_id' => $row->kelas_id,
                'nama_kelas' => $row->nama_kelas,
                'tingkat' => $row->tingkat,
                'tahun_ajaran' => $row->tahun_ajaran,
                'status_riwayat' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    public static function backfillInitialData(): void
    {
        self::syncCurrentClasses();

        if (Schema::hasColumn('laporan_kasus', 'kelas_id_saat_laporan')) {
            $laporanSnapshots = DB::table('laporan_kasus')
                ->whereNotNull('siswa_id')
                ->whereNotNull('nama_kelas_saat_laporan')
                ->whereNotNull('tahun_ajaran')
                ->select([
                    'siswa_id',
                    'kelas_id_saat_laporan as kelas_id',
                    'nama_kelas_saat_laporan as nama_kelas',
                    'tingkat_saat_laporan as tingkat',
                    'tahun_ajaran',
                ])
                ->distinct()
                ->get();

            foreach ($laporanSnapshots as $snap) {
                $exists = DB::table('riwayat_kelas_siswa')
                    ->where('siswa_id', $snap->siswa_id)
                    ->where('tahun_ajaran', $snap->tahun_ajaran)
                    ->where('nama_kelas', $snap->nama_kelas)
                    ->exists();

                if (! $exists) {
                    DB::table('riwayat_kelas_siswa')->insert([
                        'siswa_id' => $snap->siswa_id,
                        'kelas_id' => $snap->kelas_id,
                        'nama_kelas' => $snap->nama_kelas,
                        'tingkat' => $snap->tingkat,
                        'tahun_ajaran' => $snap->tahun_ajaran,
                        'status_riwayat' => 'arsip',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }

        if (Schema::hasColumn('skrining_siswa', 'kelas_id_saat_skrining')) {
            $skriningSnapshots = DB::table('skrining_siswa')
                ->whereNotNull('siswa_id')
                ->whereNotNull('nama_kelas_saat_skrining')
                ->whereNotNull('tahun_ajaran')
                ->select([
                    'siswa_id',
                    'kelas_id_saat_skrining as kelas_id',
                    'nama_kelas_saat_skrining as nama_kelas',
                    'tingkat_saat_skrining as tingkat',
                    'tahun_ajaran',
                ])
                ->distinct()
                ->get();

            foreach ($skriningSnapshots as $snap) {
                $exists = DB::table('riwayat_kelas_siswa')
                    ->where('siswa_id', $snap->siswa_id)
                    ->where('tahun_ajaran', $snap->tahun_ajaran)
                    ->where('nama_kelas', $snap->nama_kelas)
                    ->exists();

                if (! $exists) {
                    DB::table('riwayat_kelas_siswa')->insert([
                        'siswa_id' => $snap->siswa_id,
                        'kelas_id' => $snap->kelas_id,
                        'nama_kelas' => $snap->nama_kelas,
                        'tingkat' => $snap->tingkat,
                        'tahun_ajaran' => $snap->tahun_ajaran,
                        'status_riwayat' => 'arsip',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }

    public static function recordClassAssignment(int $siswaId, int $kelasId, string $statusRiwayat = 'aktif'): void
    {
        self::ensureReady();

        $kelas = DB::table('kelas')
            ->where('id', $kelasId)
            ->first(['id', 'nama_kelas', 'tingkat', 'tahun_ajaran']);

        if (! $kelas || ! $kelas->tahun_ajaran) {
            return;
        }

        // Pastikan kelas lama siswa (jika ada dan berbeda) tetap tersimpan sebagai arsip
        $currentSiswa = DB::table('siswa')
            ->leftJoin('kelas', 'siswa.kelas_id', '=', 'kelas.id')
            ->where('siswa.id', $siswaId)
            ->first([
                'siswa.kelas_id',
                'kelas.nama_kelas',
                'kelas.tingkat',
                'kelas.tahun_ajaran',
            ]);

        if ($currentSiswa && $currentSiswa->kelas_id && $currentSiswa->tahun_ajaran) {
            $oldExists = DB::table('riwayat_kelas_siswa')
                ->where('siswa_id', $siswaId)
                ->where('tahun_ajaran', $currentSiswa->tahun_ajaran)
                ->exists();

            if (! $oldExists) {
                DB::table('riwayat_kelas_siswa')->insert([
                    'siswa_id' => $siswaId,
                    'kelas_id' => $currentSiswa->kelas_id,
                    'nama_kelas' => $currentSiswa->nama_kelas,
                    'tingkat' => $currentSiswa->tingkat,
                    'tahun_ajaran' => $currentSiswa->tahun_ajaran,
                    'status_riwayat' => 'arsip',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // Tandai riwayat tahun ajaran sebelumnya sebagai arsip/naik_kelas
        DB::table('riwayat_kelas_siswa')
            ->where('siswa_id', $siswaId)
            ->where('tahun_ajaran', '!=', $kelas->tahun_ajaran)
            ->where('status_riwayat', 'aktif')
            ->update([
                'status_riwayat' => 'naik_kelas',
                'updated_at' => now(),
            ]);

        // Simpan atau perbarui riwayat pada tahun ajaran kelas baru
        $existingSameYear = DB::table('riwayat_kelas_siswa')
            ->where('siswa_id', $siswaId)
            ->where('tahun_ajaran', $kelas->tahun_ajaran)
            ->first();

        if ($existingSameYear) {
            DB::table('riwayat_kelas_siswa')
                ->where('id', $existingSameYear->id)
                ->update([
                    'kelas_id' => $kelas->id,
                    'nama_kelas' => $kelas->nama_kelas,
                    'tingkat' => $kelas->tingkat,
                    'status_riwayat' => $statusRiwayat,
                    'updated_at' => now(),
                ]);
        } else {
            DB::table('riwayat_kelas_siswa')->insert([
                'siswa_id' => $siswaId,
                'kelas_id' => $kelas->id,
                'nama_kelas' => $kelas->nama_kelas,
                'tingkat' => $kelas->tingkat,
                'tahun_ajaran' => $kelas->tahun_ajaran,
                'status_riwayat' => $statusRiwayat,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

