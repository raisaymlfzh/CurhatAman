<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'kode_laporan',
    'siswa_id',

    // Snapshot kelas dan periode akademik saat laporan dikirim
    'kelas_id_saat_laporan',
    'nama_kelas_saat_laporan',
    'tingkat_saat_laporan',
    'tahun_ajaran',
    'semester',

    'kategori_id',
    'assigned_bk_id',
    'tanggal_kejadian',
    'lokasi_kejadian',
    'deskripsi',
    'status_rahasia',
    'status_kasus',
    'submitted_at',
    'resolved_at',
])]
class LaporanKasus extends Model
{
    protected $table = 'laporan_kasus';

    protected function casts(): array
    {
        return [
            'tanggal_kejadian' => 'date',
            'status_rahasia' => 'boolean',
            'submitted_at' => 'datetime',
            'resolved_at' => 'datetime',
        ];
    }

    /**
     * Siswa pemilik laporan.
     */
    public function siswa(): BelongsTo
    {
        return $this->belongsTo(Siswa::class);
    }

    /**
     * Kategori kasus.
     */
    public function kategori(): BelongsTo
    {
        return $this->belongsTo(
            KategoriKasus::class,
            'kategori_id'
        );
    }

    /**
     * Bukti yang dilampirkan pada laporan.
     */
    public function bukti(): HasMany
    {
        return $this->hasMany(
            BuktiLaporan::class,
            'laporan_id'
        );
    }

    /**
     * Kelas siswa pada saat laporan benar-benar dikirim.
     *
     * Relasi ini merupakan histori.
     * Jadi tidak bergantung pada kelas siswa saat ini.
     */
    public function kelasSaatLaporan(): BelongsTo
    {
        return $this->belongsTo(
            Kelas::class,
            'kelas_id_saat_laporan'
        );
    }

    /**
     * Guru BK yang ditugaskan menangani laporan.
     */
    public function assignedBk(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'assigned_bk_id'
        );
    }
}