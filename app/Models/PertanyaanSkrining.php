<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'nomor',
    'aspek',
    'pertanyaan',
    'reverse_score',
    'is_active',
])]
class PertanyaanSkrining extends Model
{
    protected $table = 'pertanyaan_skrining';

    protected function casts(): array
    {
        return [
            'reverse_score' => 'boolean',
            'is_active' => 'boolean',
        ];
    }
}
