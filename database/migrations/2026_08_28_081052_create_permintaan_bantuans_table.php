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
        Schema::create('permintaan_bantuan', function (Blueprint $table) {
            $table->id();

            // Siswa yang mengajukan bantuan
            $table->foreignId('siswa_id')
                ->constrained('siswa')
                ->cascadeOnDelete();

            // Guru BK yang menangani
            // Untuk sementara boleh kosong sampai permintaan ditangani
            $table->foreignId('assigned_bk_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->string('jenis_bantuan');

            $table->text('pesan');

            $table->string('status')
                ->default('baru');

            $table->timestamp('submitted_at')
                ->nullable();

            $table->timestamp('resolved_at')
                ->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permintaan_bantuans');
    }
};
