<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('skrining_siswa', function (Blueprint $table) {
            $table->foreignId('assigned_bk_id')
                ->nullable()
                ->after('status')
                ->constrained('users')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('skrining_siswa', function (Blueprint $table) {
            $table->dropForeign(['assigned_bk_id']);
            $table->dropColumn('assigned_bk_id');
        });
    }
};
