<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'siswa_id',
    'kelas_id_saat_skrining',
    'nama_kelas_saat_skrining',
    'tingkat_saat_skrining',
    'tahun_ajaran',
    'semester',
    'status',
    'started_at',
    'completed_at',
])]
class SkriningSiswa extends Model
{
    protected $table = 'skrining_siswa';

    protected function casts(): array
    {
        return [
            'started_at' => 'datetime',
            'completed_at' => 'datetime',
        ];
    }

    public function siswa(): BelongsTo
    {
        return $this->belongsTo(
            Siswa::class
        );
    }

    public function jawaban(): HasMany
    {
        return $this->hasMany(
            JawabanSkrining::class,
            'skrining_id'
        );
    }
}
