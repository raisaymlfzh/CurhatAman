<?php

namespace Database\Seeders;

use App\Models\Kelas;
use Illuminate\Database\Seeder;

class KelasSeeder extends Seeder
{
    public function run(): void
    {
        $kelas = [
            [
                'nama_kelas' => 'X IPA 1',
                'tingkat' => 10,
                'tahun_ajaran' => '2026/2027',
            ],
            [
                'nama_kelas' => 'X IPA 2',
                'tingkat' => 10,
                'tahun_ajaran' => '2026/2027',
            ],
            [
                'nama_kelas' => 'X IPS 1',
                'tingkat' => 10,
                'tahun_ajaran' => '2026/2027',
            ],
            [
                'nama_kelas' => 'X IPS 2',
                'tingkat' => 10,
                'tahun_ajaran' => '2026/2027',
            ],
            [
                'nama_kelas' => 'XI IPA 1',
                'tingkat' => 11,
                'tahun_ajaran' => '2026/2027',
            ],
            [
                'nama_kelas' => 'XI IPA 2',
                'tingkat' => 11,
                'tahun_ajaran' => '2026/2027',
            ],
            [
                'nama_kelas' => 'XI IPS 1',
                'tingkat' => 11,
                'tahun_ajaran' => '2026/2027',
            ],
            [
                'nama_kelas' => 'XI IPS 2',
                'tingkat' => 11,
                'tahun_ajaran' => '2026/2027',
            ],
            [
                'nama_kelas' => 'XII IPA 1',
                'tingkat' => 12,
                'tahun_ajaran' => '2026/2027',
            ],
            [
                'nama_kelas' => 'XII IPA 2',
                'tingkat' => 12,
                'tahun_ajaran' => '2026/2027',
            ],
            [
                'nama_kelas' => 'XII IPS 1',
                'tingkat' => 12,
                'tahun_ajaran' => '2026/2027',
            ],
            [
                'nama_kelas' => 'XII IPS 2',
                'tingkat' => 12,
                'tahun_ajaran' => '2026/2027',
            ],
        ];

        foreach ($kelas as $item) {
            Kelas::updateOrCreate(
                [
                    'nama_kelas' => $item['nama_kelas'],
                    'tahun_ajaran' => $item['tahun_ajaran'],
                ],
                [
                    'tingkat' => $item['tingkat'],
                    'is_active' => true,
                ]
            );
        }
    }
}
