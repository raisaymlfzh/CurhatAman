<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Siswa extends Model
{
    use HasFactory;

    /**
     * Nama tabel.
     */
    protected $table = 'siswa';


    /**
     * Field yang boleh diisi melalui create() / update().
     */
    protected $fillable = [
        'user_id',
        'kelas_id',
        'nis',
        'tahun_masuk',
        'foto_profil',
        'status_kondisi',
        'status_kondisi_updated_at',
    ];


    /**
     * Relasi siswa dengan akun pengguna.
     *
     * siswa.user_id -> users.id
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    /**
     * Relasi siswa dengan kelas.
     *
     * siswa.kelas_id -> kelas.id
     */
    public function kelas(): BelongsTo
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }


    /**
     * Casting tipe data.
     */
    protected function casts(): array
    {
        return [
            'status_kondisi_updated_at' => 'datetime',
        ];
    }
}