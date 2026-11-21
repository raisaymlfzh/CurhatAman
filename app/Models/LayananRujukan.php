<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'nama_layanan',
    'jenis_layanan',
    'kontak',
    'alamat_url',
    'is_active',
])]
class LayananRujukan extends Model
{
    protected $table = 'layanan_rujukan';

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    /**
     * Label representatif untuk jenis layanan.
     */
    public static function jenisLabels(): array
    {
        return [
            'psikolog' => 'Psikolog / Konselor',
            'puskesmas' => 'Puskesmas / Faskes Primer',
            'rumah_sakit' => 'Rumah Sakit / Psikiater',
            'perlindungan_anak' => 'UPTD PPA / Perlindungan Anak',
            'kepolisian' => 'Kepolisian / Penegak Hukum',
            'hotline' => 'Hotline / Layanan Darurat',
            'lainnya' => 'Instansi Rekanan Lainnya',
        ];
    }
}
