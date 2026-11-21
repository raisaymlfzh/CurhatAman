<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LayananRujukanSeeder extends Seeder
{
    /**
     * Seed data awal layanan rujukan.
     *
     * Data di bawah merupakan data pengembangan/demo.
     * Nama, kontak, dan alamat dapat diganti sesuai layanan
     * yang benar-benar bekerja sama dengan sekolah.
     */
    public function run(): void
    {
        $now = now();

        $layanan = [
            [
                'nama_layanan' => 'Psikolog Mitra Sekolah',
                'jenis_layanan' => 'psikolog',
                'kontak' => null,
                'alamat_url' => 'Data layanan perlu disesuaikan dengan mitra resmi sekolah.',
                'is_active' => true,
            ],
            [
                'nama_layanan' => 'Puskesmas Wilayah Sekolah',
                'jenis_layanan' => 'puskesmas',
                'kontak' => null,
                'alamat_url' => 'Data puskesmas perlu disesuaikan dengan wilayah sekolah.',
                'is_active' => true,
            ],
            [
                'nama_layanan' => 'UPTD Perlindungan Perempuan dan Anak',
                'jenis_layanan' => 'uptd_ppa',
                'kontak' => null,
                'alamat_url' => 'Data UPTD PPA perlu disesuaikan dengan wilayah sekolah.',
                'is_active' => true,
            ],
            [
                'nama_layanan' => 'Layanan Hotline Pendampingan',
                'jenis_layanan' => 'hotline',
                'kontak' => null,
                'alamat_url' => 'Kontak hotline perlu diisi berdasarkan layanan resmi yang digunakan sekolah.',
                'is_active' => true,
            ],
            [
                'nama_layanan' => 'Layanan Rujukan Lainnya',
                'jenis_layanan' => 'lainnya',
                'kontak' => null,
                'alamat_url' => null,
                'is_active' => true,
            ],
        ];

        foreach ($layanan as $item) {
            DB::table('layanan_rujukan')->updateOrInsert(
                [
                    'nama_layanan' => $item['nama_layanan'],
                ],
                [
                    'jenis_layanan' => $item['jenis_layanan'],
                    'kontak' => $item['kontak'],
                    'alamat_url' => $item['alamat_url'],
                    'is_active' => $item['is_active'],
                    'created_at' => $now,
                    'updated_at' => $now,
                ]
            );
        }
    }
}
