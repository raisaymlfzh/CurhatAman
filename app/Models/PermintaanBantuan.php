<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermintaanBantuan extends Model
{
    use HasFactory;

    protected $table = 'permintaan_bantuan';

    protected $fillable = [
        'siswa_id',
        'assigned_bk_id',
        'jenis_bantuan',
        'pesan',
        'status',
        'submitted_at',
        'resolved_at',
    ];

    protected $casts = [
        'submitted_at' => 'datetime',
        'resolved_at' => 'datetime',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }

    public function assignedBk()
    {
        return $this->belongsTo(User::class, 'assigned_bk_id');
    }
}