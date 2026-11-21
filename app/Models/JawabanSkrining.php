<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'skrining_id',
    'pertanyaan_id',
    'jawaban',
])]
class JawabanSkrining extends Model
{
    protected $table = 'jawaban_skrining';

    public function skrining(): BelongsTo
    {
        return $this->belongsTo(SkriningSiswa::class, 'skrining_id');
    }

    public function pertanyaan(): BelongsTo
    {
        return $this->belongsTo(
            PertanyaanSkrining::class,
            'pertanyaan_id'
        );
    }
}
