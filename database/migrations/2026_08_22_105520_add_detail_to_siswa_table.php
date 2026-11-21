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
        $table->foreignId('user_id')
            ->unique()
            ->constrained('users')
            ->cascadeOnDelete();

        $table->foreignId('kelas_id')
            ->nullable()
            ->constrained('kelas')
            ->nullOnDelete();

        $table->string('nis')->nullable()->unique();
        $table->year('tahun_masuk')->nullable();
    });
}

public function down(): void
{
    Schema::table('siswa', function (Blueprint $table) {
        $table->dropForeign(['user_id']);
        $table->dropForeign(['kelas_id']);

        $table->dropColumn([
            'user_id',
            'kelas_id',
            'nis',
            'tahun_masuk',
        ]);
    });
}
};
