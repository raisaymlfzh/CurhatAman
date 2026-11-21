<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('siswa', function (Blueprint $table) {
            $table->string('whatsapp_number', 20)->nullable();
            $table->boolean('whatsapp_consent')->default(false);
            $table->timestamp('whatsapp_consent_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('siswa', function (Blueprint $table) {
            $table->dropColumn([
                'whatsapp_number',
                'whatsapp_consent',
                'whatsapp_consent_at',
            ]);
        });
    }
};
