<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengaturan_sistem', function (Blueprint $table) {
            $table->string('semester_aktif', 10)
                ->default('ganjil')
                ->after('tahun_ajaran_aktif');
        });
    }

    public function down(): void
    {
        Schema::table('pengaturan_sistem', function (Blueprint $table) {
            $table->dropColumn('semester_aktif');
        });
    }
};