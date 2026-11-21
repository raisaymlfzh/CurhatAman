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
        Schema::create('konflik_kepentingan', function (Blueprint $table) {
            $table->id();

            $table->foreignId('laporan_id')
                ->constrained('laporan_kasus')
                ->cascadeOnDelete();

            /*
             * Guru BK yang membuat deklarasi.
             * Semua role pengguna tetap disimpan pada tabel users.
             */
            $table->foreignId('user_id')
                ->constrained('users')
                ->restrictOnDelete();

            /*
             * true  = ada konflik kepentingan
             * false = tidak ada konflik kepentingan
             */
            $table->boolean('ada_konflik');

            /*
             * Diisi jika Guru BK perlu menjelaskan konflik.
             * Misalnya memiliki hubungan keluarga/dekat dengan pihak terkait.
             */
            $table->text('keterangan')->nullable();

            $table->timestamp('declared_at');

            $table->timestamps();

            /*
             * Satu Guru BK cukup membuat satu deklarasi
             * untuk satu laporan.
             */
            $table->unique([
                'laporan_id',
                'user_id',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('konflik_kepentingan');
    }
};
