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
        Schema::create('rujukan', function (Blueprint $table) {
            $table->id();

            /*
             * Siswa yang menerima rujukan.
             */
            $table->foreignId('siswa_id')
                ->constrained('siswa')
                ->cascadeOnDelete();

            /*
             * Layanan tujuan rujukan.
             */
            $table->foreignId('layanan_id')
                ->constrained('layanan_rujukan')
                ->restrictOnDelete();

            /*
             * Guru BK yang membuat rujukan.
             * Mengarah ke users karena role Guru BK disimpan
             * pada users.role = counselor.
             */
            $table->foreignId('created_by_user_id')
                ->constrained('users')
                ->restrictOnDelete();

            /*
             * Sumber rujukan bersifat opsional.
             * Rujukan bisa dibuat dari laporan kasus,
             * dari sesi skrining, atau tanpa keduanya.
             */
            $table->foreignId('laporan_id')
                ->nullable()
                ->constrained('laporan_kasus')
                ->nullOnDelete();

            $table->foreignId('skrining_id')
                ->nullable()
                ->constrained('skrining_siswa')
                ->nullOnDelete();

            $table->text('alasan_rujukan');

            /*
             * ERD hanya menetapkan adanya field "status"
             * tanpa mengunci daftar nilainya.
             * Karena itu digunakan string, bukan enum,
             * supaya status dapat ditetapkan pada tahap fitur/UI.
             */
            $table->string('status', 50);

            $table->timestamp('referred_at');

            $table->timestamps();

            $table->index('status');
            $table->index('referred_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rujukan');
    }
};
