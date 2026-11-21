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
    Schema::table('siswa', function (Blueprint $table) {
        $table->string('foto_profil')->nullable();

        $table->string('status_kondisi')
            ->default('belum_dinilai');

        $table->timestamp('status_kondisi_updated_at')
            ->nullable();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    Schema::table('siswa', function (Blueprint $table) {
        $table->dropColumn([
            'foto_profil',
            'status_kondisi',
            'status_kondisi_updated_at',
        ]);
    });
}
};
