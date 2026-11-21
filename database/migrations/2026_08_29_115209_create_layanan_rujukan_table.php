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
        Schema::create('layanan_rujukan', function (Blueprint $table) {
            $table->id();

            $table->string('nama_layanan');

            /*
             * Contoh nilai:
             * hotline, psikolog, puskesmas, uptd_ppa, lainnya.
             *
             * Dibuat string agar jenis layanan tidak terkunci
             * dan dapat disesuaikan dengan mitra sekolah.
             */
            $table->string('jenis_layanan', 50);

            $table->string('kontak')->nullable();

            /*
             * ERD mencantumkan alamat / URL sebagai informasi opsional.
             * Satu kolom digunakan agar dapat menyimpan alamat fisik,
             * tautan layanan, atau keduanya dalam bentuk teks.
             */
            $table->text('alamat_url')->nullable();

            $table->boolean('is_active')->default(true);

            $table->timestamps();

            $table->index('jenis_layanan');
            $table->index('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('layanan_rujukan');
    }
};
