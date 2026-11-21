<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
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
        }

        // Backfill dari data kelas aktif siswa saat ini
        $siswaList = DB::table('siswa')
            ->join('kelas', 'siswa.kelas_id', '=', 'kelas.id')
            ->select([
                'siswa.id as siswa_id',
                'kelas.id as kelas_id',
                'kelas.nama_kelas',
                'kelas.tingkat',
                'kelas.tahun_ajaran',
            ])
            ->get();

        foreach ($siswaList as $row) {
            if (! $row->tahun_ajaran) {
                continue;
            }

            $exists = DB::table('riwayat_kelas_siswa')
                ->where('siswa_id', $row->siswa_id)
                ->where('kelas_id', $row->kelas_id)
                ->where('tahun_ajaran', $row->tahun_ajaran)
                ->exists();

            if (! $exists) {
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

        // Backfill dari snapshot laporan_kasus (jika ada arsip kelas sebelumnya)
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

        // Backfill dari snapshot skrining_siswa (jika ada arsip kelas sebelumnya)
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

    public function down(): void
    {
        Schema::dropIfExists('riwayat_kelas_siswa');
    }
};

