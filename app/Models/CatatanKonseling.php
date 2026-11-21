<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CatatanKonseling extends Model
{
    use HasFactory;

    protected $table = 'catatan_konseling';

    protected $fillable = [
        'siswa_id',
        'guru_bk_id',
        'laporan_id',
        'bantuan_id',
        'tanggal_pertemuan',
        'jenis_layanan',
        'topik',
        'isi_catatan',
        'hasil_kesepakatan',
        'tindak_lanjut',
        'is_rahasia',
        'is_shared_wali_kelas',
        'arahan_wali_kelas',
        'umpan_balik_wali_kelas',
    ];

    protected $casts = [
        'tanggal_pertemuan' => 'date',
        'is_rahasia' => 'boolean',
        'is_shared_wali_kelas' => 'boolean',
    ];

    public function siswa(): BelongsTo
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }

    public function guruBk(): BelongsTo
    {
        return $this->belongsTo(User::class, 'guru_bk_id');
    }

    public function laporan(): BelongsTo
    {
        return $this->belongsTo(LaporanKasus::class, 'laporan_id');
    }

    public function bantuan(): BelongsTo
    {
        return $this->belongsTo(PermintaanBantuan::class, 'bantuan_id');
    }
}
