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
    Schema::create('bukti_laporan', function (Blueprint $table) {
        $table->id();

        $table->foreignId('laporan_id')
            ->constrained('laporan_kasus')
            ->cascadeOnDelete();

        $table->string('file_path');

        $table->string('original_name');

        $table->string('mime_type')->nullable();

        $table->unsignedBigInteger('file_size')->nullable();

        $table->string('jenis_bukti')->nullable();

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bukti_laporan');
    }
};
