<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('paket_skrining', function (Blueprint $table) {
            $table->id();
            $table->string('nama_paket', 150);
            $table->string('jenis_instrumen', 100)->default('SDQ');
            $table->text('deskripsi')->nullable();

            $table->foreignId('created_by_user_id')
                ->constrained('users')
                ->restrictOnDelete();

            $table->boolean('is_active')->default(false);
            $table->timestamps();

            $table->index('is_active');
            $table->index('jenis_instrumen');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('paket_skrining');
    }
};
