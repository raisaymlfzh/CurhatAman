<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'nama_kelas',
    'tingkat',
    'tahun_ajaran',
    'wali_kelas_user_id',
    'is_active',
])]
class Kelas extends Model
{
    protected $table = 'kelas';

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function waliKelas(): BelongsTo
    {
        return $this->belongsTo(User::class, 'wali_kelas_user_id');
    }

    public function siswa(): HasMany
    {
        return $this->hasMany(Siswa::class, 'kelas_id');
    }
}