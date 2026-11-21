<?php

namespace Database\Seeders;

use App\Models\KategoriKasus;
use Illuminate\Database\Seeder;

class KategoriKasusSeeder extends Seeder
{
    public function run(): void
    {
        $kategori = [
            [
                'nama_kategori' => 'Fisik',
                'slug' => 'fisik',
                'deskripsi' => 'Kekerasan fisik, pemukulan, atau perusakan barang.',
            ],
            [
                'nama_kategori' => 'Verbal',
                'slug' => 'verbal',
                'deskripsi' => 'Ejekan, hinaan, makian, atau julukan yang merendahkan.',
            ],
            [
                'nama_kategori' => 'Sosial',
                'slug' => 'sosial',
                'deskripsi' => 'Pengucilan, pengecualian, atau penyebaran rumor.',
            ],
            [
                'nama_kategori' => 'Cyberbullying',
                'slug' => 'cyberbullying',
                'deskripsi' => 'Perundungan melalui media sosial atau media digital.',
            ],
            [
                'nama_kategori' => 'Lainnya',
                'slug' => 'lainnya',
                'deskripsi' => 'Jenis perundungan lain yang tidak termasuk kategori utama.',
            ],
        ];

        foreach ($kategori as $item) {
            KategoriKasus::updateOrCreate(
                ['slug' => $item['slug']],
                $item
            );
        }
    }
}