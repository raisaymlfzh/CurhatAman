<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengaturan_sistem', function (Blueprint $table) {
            $table->string('logo_sekolah', 255)->nullable()->after('nama_sekolah');
            $table->string('npsn', 20)->nullable()->after('logo_sekolah');
            $table->string('akreditasi', 20)->nullable()->after('npsn');
            $table->text('alamat_sekolah')->nullable()->after('akreditasi');
            $table->string('telepon_sekolah', 50)->nullable()->after('alamat_sekolah');
            $table->string('email_sekolah', 100)->nullable()->after('telepon_sekolah');
            $table->string('website_sekolah', 150)->nullable()->after('email_sekolah');
            $table->string('kepala_sekolah_nama', 150)->nullable()->after('website_sekolah');
            $table->string('kepala_sekolah_nip', 50)->nullable()->after('kepala_sekolah_nama');
        });
    }

    public function down(): void
    {
        Schema::table('pengaturan_sistem', function (Blueprint $table) {
            $table->dropColumn([
                'logo_sekolah',
                'npsn',
                'akreditasi',
                'alamat_sekolah',
                'telepon_sekolah',
                'email_sekolah',
                'website_sekolah',
                'kepala_sekolah_nama',
                'kepala_sekolah_nip',
            ]);
        });
    }
};
