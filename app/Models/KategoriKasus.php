<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'nama_kategori',
    'slug',
    'deskripsi',
    'is_active',
])]
class KategoriKasus extends Model
{
    protected $table = 'kategori_kasus';

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }
}
