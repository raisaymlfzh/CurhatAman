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
    Schema::create('laporan_kasus', function (Blueprint $table) {
        $table->id();

        // Nomor laporan yang tampil ke user, contoh: CRH-9921
        $table->string('kode_laporan')->unique();

        // Siswa yang membuat laporan
        $table->foreignId('siswa_id')
            ->constrained('siswa')
            ->cascadeOnDelete();

        // Fisik, Verbal, Sosial, Cyberbullying, dll.
        $table->foreignId('kategori_id')
            ->constrained('kategori_kasus')
            ->restrictOnDelete();

        // Guru BK yang menangani laporan
        $table->foreignId('assigned_bk_id')
            ->nullable()
            ->constrained('users')
            ->nullOnDelete();

        // Sesuai form Figma
        $table->date('tanggal_kejadian');
        $table->string('lokasi_kejadian')->nullable();
        $table->text('deskripsi');

        // true = identitas dirahasiakan dari pihak yang tidak berwenang
        // Guru BK tetap dapat melihat identitas pelapor
        $table->boolean('status_rahasia')->default(true);

        // draft, baru, diproses, selesai, dieskalasi
        $table->string('status_kasus')->default('draft');

        // Waktu laporan benar-benar dikirim
        $table->timestamp('submitted_at')->nullable();

        // Waktu kasus dinyatakan selesai
        $table->timestamp('resolved_at')->nullable();

        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('laporan_kasus');
}
};
