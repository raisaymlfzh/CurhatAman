<?php

namespace Database\Seeders;

use App\Models\PertanyaanSkrining;
use Illuminate\Database\Seeder;

class PertanyaanSkriningSeeder extends Seeder
{
    public function run(): void
    {
        $pertanyaan = [
            // GEJALA EMOSIONAL
            ['nomor' => 1, 'aspek' => 'gejala_emosional', 'pertanyaan' => '[DUMMY] Pertanyaan gejala emosional 1'],
            ['nomor' => 2, 'aspek' => 'gejala_emosional', 'pertanyaan' => '[DUMMY] Pertanyaan gejala emosional 2'],
            ['nomor' => 3, 'aspek' => 'gejala_emosional', 'pertanyaan' => '[DUMMY] Pertanyaan gejala emosional 3'],
            ['nomor' => 4, 'aspek' => 'gejala_emosional', 'pertanyaan' => '[DUMMY] Pertanyaan gejala emosional 4'],
            ['nomor' => 5, 'aspek' => 'gejala_emosional', 'pertanyaan' => '[DUMMY] Pertanyaan gejala emosional 5'],

            // MASALAH PERILAKU
            ['nomor' => 6, 'aspek' => 'masalah_perilaku', 'pertanyaan' => '[DUMMY] Pertanyaan masalah perilaku 1'],
            ['nomor' => 7, 'aspek' => 'masalah_perilaku', 'pertanyaan' => '[DUMMY] Pertanyaan masalah perilaku 2'],
            ['nomor' => 8, 'aspek' => 'masalah_perilaku', 'pertanyaan' => '[DUMMY] Pertanyaan masalah perilaku 3'],
            ['nomor' => 9, 'aspek' => 'masalah_perilaku', 'pertanyaan' => '[DUMMY] Pertanyaan masalah perilaku 4'],
            ['nomor' => 10, 'aspek' => 'masalah_perilaku', 'pertanyaan' => '[DUMMY] Pertanyaan masalah perilaku 5'],

            // HIPERAKTIVITAS
            ['nomor' => 11, 'aspek' => 'hiperaktivitas', 'pertanyaan' => '[DUMMY] Pertanyaan hiperaktivitas 1'],
            ['nomor' => 12, 'aspek' => 'hiperaktivitas', 'pertanyaan' => '[DUMMY] Pertanyaan hiperaktivitas 2'],
            ['nomor' => 13, 'aspek' => 'hiperaktivitas', 'pertanyaan' => '[DUMMY] Pertanyaan hiperaktivitas 3'],
            ['nomor' => 14, 'aspek' => 'hiperaktivitas', 'pertanyaan' => '[DUMMY] Pertanyaan hiperaktivitas 4'],
            ['nomor' => 15, 'aspek' => 'hiperaktivitas', 'pertanyaan' => '[DUMMY] Pertanyaan hiperaktivitas 5'],

            // TEMAN SEBAYA
            ['nomor' => 16, 'aspek' => 'teman_sebaya', 'pertanyaan' => '[DUMMY] Pertanyaan teman sebaya 1'],
            ['nomor' => 17, 'aspek' => 'teman_sebaya', 'pertanyaan' => '[DUMMY] Pertanyaan teman sebaya 2'],
            ['nomor' => 18, 'aspek' => 'teman_sebaya', 'pertanyaan' => '[DUMMY] Pertanyaan teman sebaya 3'],
            ['nomor' => 19, 'aspek' => 'teman_sebaya', 'pertanyaan' => '[DUMMY] Pertanyaan teman sebaya 4'],
            ['nomor' => 20, 'aspek' => 'teman_sebaya', 'pertanyaan' => '[DUMMY] Pertanyaan teman sebaya 5'],

            // PROSOSIAL
            ['nomor' => 21, 'aspek' => 'prososial', 'pertanyaan' => '[DUMMY] Pertanyaan prososial 1'],
            ['nomor' => 22, 'aspek' => 'prososial', 'pertanyaan' => '[DUMMY] Pertanyaan prososial 2'],
            ['nomor' => 23, 'aspek' => 'prososial', 'pertanyaan' => '[DUMMY] Pertanyaan prososial 3'],
            ['nomor' => 24, 'aspek' => 'prososial', 'pertanyaan' => '[DUMMY] Pertanyaan prososial 4'],
            ['nomor' => 25, 'aspek' => 'prososial', 'pertanyaan' => '[DUMMY] Pertanyaan prososial 5'],
        ];

        foreach ($pertanyaan as $item) {
            PertanyaanSkrining::updateOrCreate(
                ['nomor' => $item['nomor']],
                [
                    'aspek' => $item['aspek'],
                    'pertanyaan' => $item['pertanyaan'],
                    'reverse_score' => false,
                    'is_active' => true,
                ]
            );
        }
    }
}
