<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('skrining_siswa', function (Blueprint $table) {
            $table->foreignId('paket_skrining_id')
                ->nullable()
                ->after('siswa_id')
                ->constrained('paket_skrining')
                ->nullOnDelete();

            $table->index(['siswa_id', 'paket_skrining_id']);
        });
    }

    public function down(): void
    {
        Schema::table('skrining_siswa', function (Blueprint $table) {
            $table->dropForeign(['paket_skrining_id']);
            $table->dropIndex(['siswa_id', 'paket_skrining_id']);
            $table->dropColumn('paket_skrining_id');
        });
    }
};
