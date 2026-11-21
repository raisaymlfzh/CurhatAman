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
    Schema::table('kelas', function (Blueprint $table) {
        $table->string('nama_kelas');
        $table->unsignedTinyInteger('tingkat');
        $table->string('tahun_ajaran', 9);

        $table->foreignId('wali_kelas_user_id')
            ->nullable()
            ->constrained('users')
            ->nullOnDelete();

        $table->boolean('is_active')->default(true);
    });
}

public function down(): void
{
    Schema::table('kelas', function (Blueprint $table) {
        $table->dropForeign(['wali_kelas_user_id']);

        $table->dropColumn([
            'nama_kelas',
            'tingkat',
            'tahun_ajaran',
            'wali_kelas_user_id',
            'is_active',
        ]);
    });
}
};
