<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'laporan_id',
    'file_path',
    'original_name',
    'mime_type',
    'file_size',
    'jenis_bukti',
])]
class BuktiLaporan extends Model
{
    protected $table = 'bukti_laporan';

    public function laporan(): BelongsTo
    {
        return $this->belongsTo(LaporanKasus::class, 'laporan_id');
    }
}