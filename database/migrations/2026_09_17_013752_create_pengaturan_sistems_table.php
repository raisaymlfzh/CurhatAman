<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengaturan_sistem', function (Blueprint $table) {
            $table->id();

            // Identitas sekolah
            $table->string('nama_sekolah', 150)->nullable();

            // Akademik
            $table->string('tahun_ajaran_aktif', 9)
                ->default('2026/2027');

            // Pengawasan kasus
            $table->unsignedSmallInteger('batas_kasus_mangkrak')
                ->default(7);

            // Notifikasi Admin
            $table->boolean('notifikasi_kasus_dieskalasi')
                ->default(true);

            $table->boolean('notifikasi_kasus_mangkrak')
                ->default(true);

            // Mencatat Admin terakhir yang mengubah pengaturan
            $table->foreignId('updated_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengaturan_sistem');
    }
};