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
        Schema::create('pertanyaan_skrining', function (Blueprint $table) {
            $table->id();

            $table->unsignedTinyInteger('nomor')->unique();

            $table->string('aspek');

            $table->text('pertanyaan');

            $table->boolean('reverse_score')->default(false);

            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pertanyaan_skrining');
    }
};
