<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('catatan_konseling', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('siswa')->cascadeOnDelete();
            $table->foreignId('guru_bk_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('laporan_id')->nullable()->constrained('laporan_kasus')->nullOnDelete();
            $table->foreignId('bantuan_id')->nullable()->constrained('permintaan_bantuan')->nullOnDelete();
            $table->date('tanggal_pertemuan');
            $table->enum('jenis_layanan', [
                'Konseling Individu',
                'Bimbingan Karir',
                'Bimbingan Belajar',
                'Mediasi Kasus',
                'Kunjungan Rumah',
                'Konsultasi Orang Tua',
                'Lainnya',
            ]);
            $table->string('topik');
            $table->text('isi_catatan');
            $table->text('hasil_kesepakatan')->nullable();
            $table->text('tindak_lanjut')->nullable();
            $table->boolean('is_rahasia')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catatan_konseling');
    }
};
