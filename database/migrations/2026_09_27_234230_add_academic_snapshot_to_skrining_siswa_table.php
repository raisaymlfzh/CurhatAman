<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table(
            'skrining_siswa',
            function (Blueprint $table) {
                $table
                    ->unsignedBigInteger(
                        'kelas_id_saat_skrining'
                    )
                    ->nullable()
                    ->after('siswa_id');

                $table
                    ->string(
                        'nama_kelas_saat_skrining',
                        100
                    )
                    ->nullable()
                    ->after(
                        'kelas_id_saat_skrining'
                    );

                $table
                    ->string(
                        'tingkat_saat_skrining',
                        30
                    )
                    ->nullable()
                    ->after(
                        'nama_kelas_saat_skrining'
                    );

                $table
                    ->string(
                        'tahun_ajaran',
                        20
                    )
                    ->nullable()
                    ->after(
                        'tingkat_saat_skrining'
                    );

                $table
                    ->string(
                        'semester',
                        10
                    )
                    ->nullable()
                    ->after('tahun_ajaran');

                $table->index(
                    [
                        'tahun_ajaran',
                        'semester',
                    ],
                    'skrining_periode_index'
                );

                $table->index(
                    [
                        'kelas_id_saat_skrining',
                        'completed_at',
                    ],
                    'skrining_kelas_completed_index'
                );
            }
        );
    }

    public function down(): void
    {
        Schema::table(
            'skrining_siswa',
            function (Blueprint $table) {
                $table->dropIndex(
                    'skrining_periode_index'
                );

                $table->dropIndex(
                    'skrining_kelas_completed_index'
                );

                $table->dropColumn([
                    'kelas_id_saat_skrining',
                    'nama_kelas_saat_skrining',
                    'tingkat_saat_skriyyyning',
                    'tahun_ajaran',
                    'semester',
                ]);
            }
        );
    }
};
