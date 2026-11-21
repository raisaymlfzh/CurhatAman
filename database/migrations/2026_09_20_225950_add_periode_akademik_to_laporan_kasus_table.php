<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Menambahkan snapshot periode akademik
     * pada setiap laporan kasus.
     */
    public function up(): void
    {
        Schema::table('laporan_kasus', function (Blueprint $table) {

            /*
             * Kelas siswa saat laporan dibuat.
             *
             * Ini merupakan snapshot relasi historis.
             * Nilainya tidak mengikuti perpindahan kelas siswa
             * pada tahun ajaran berikutnya.
             */
            $table->foreignId('kelas_id_saat_laporan')
                ->nullable()
                ->after('siswa_id')
                ->constrained('kelas')
                ->restrictOnDelete();

            /*
             * Snapshot nama dan tingkat kelas.
             *
             * Disimpan agar histori tetap terbaca walaupun
             * informasi kelas kemudian diperbarui.
             */
            $table->string('nama_kelas_saat_laporan', 100)
                ->nullable()
                ->after('kelas_id_saat_laporan');

            $table->string('tingkat_saat_laporan', 10)
                ->nullable()
                ->after('nama_kelas_saat_laporan');

            /*
             * Periode akademik saat laporan dibuat.
             */
            $table->string('tahun_ajaran', 9)
                ->nullable()
                ->after('tingkat_saat_laporan');

            $table->string('semester', 10)
                ->nullable()
                ->after('tahun_ajaran');

            /*
             * Mempercepat filter laporan historis
             * berdasarkan tahun ajaran dan semester.
             */
            $table->index(
                [
                    'tahun_ajaran',
                    'semester',
                ],
                'laporan_kasus_periode_index'
            );
        });
    }

    /**
     * Membatalkan migration jika diperlukan.
     */
    public function down(): void
    {
        Schema::table('laporan_kasus', function (Blueprint $table) {

            $table->dropIndex(
                'laporan_kasus_periode_index'
            );

            $table->dropForeign([
                'kelas_id_saat_laporan',
            ]);

            $table->dropColumn([
                'kelas_id_saat_laporan',
                'nama_kelas_saat_laporan',
                'tingkat_saat_laporan',
                'tahun_ajaran',
                'semester',
            ]);
        });
    }
};