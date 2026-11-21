<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PengaturanSistem extends Model
{
    protected $table = 'pengaturan_sistem';

    protected $fillable = [
        'nama_sekolah',
        'logo_sekolah',
        'npsn',
        'akreditasi',
        'alamat_sekolah',
        'telepon_sekolah',
        'email_sekolah',
        'website_sekolah',
        'kepala_sekolah_nama',
        'kepala_sekolah_nip',
        'tahun_ajaran_aktif',
        'semester_aktif',
        'batas_kasus_mangkrak',
        'notifikasi_kasus_dieskalasi',
        'notifikasi_kasus_mangkrak',
        'updated_by',
    ];

    public function getLogoUrlAttribute(): ?string
    {
        if ($this->logo_sekolah && \Illuminate\Support\Facades\Storage::disk('public')->exists($this->logo_sekolah)) {
            return asset('storage/' . $this->logo_sekolah);
        }
        return null;
    }

    protected $casts = [
        'batas_kasus_mangkrak' => 'integer',
        'notifikasi_kasus_dieskalasi' => 'boolean',
        'notifikasi_kasus_mangkrak' => 'boolean',
    ];

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'updated_by'
        );
    }

    /**
     * Mengambil pengaturan utama sistem.
     * CurhatAman hanya menggunakan satu baris pengaturan global.
     */
    public static function current(): self
    {
        return static::firstOrCreate(
            ['id' => 1],
            [
                'nama_sekolah' => null,
                'tahun_ajaran_aktif' => '2026/2027',
                'semester_aktif' => 'ganjil',
                'batas_kasus_mangkrak' => 7,
                'notifikasi_kasus_dieskalasi' => true,
                'notifikasi_kasus_mangkrak' => true,
            ]
        );
    }

    /**
     * Menghasilkan HTML Kop Surat Resmi Sekolah untuk ekspor dokumen PDF.
     */
    public function getKopSuratHtml(): string
    {
        $logoPath = null;
        if (!empty($this->logo_sekolah) && file_exists(public_path('storage/' . $this->logo_sekolah))) {
            $logoPath = public_path('storage/' . $this->logo_sekolah);
        }

        $logoTd = $logoPath ? '<td style="width: 75px; text-align: left; vertical-align: middle;"><img src="' . $logoPath . '" style="max-height: 65px; max-width: 65px; object-fit: contain;"></td>' : '';
        $spacerTd = $logoPath ? '<td style="width: 75px;"></td>' : '';

        $namaSekolah = htmlspecialchars($this->nama_sekolah ?: 'SMA / SMK NEGERI CURHATAMAN');
        $metaSekolah = '';
        if ($this->npsn) {
            $metaSekolah .= '<strong>NPSN:</strong> ' . htmlspecialchars($this->npsn);
        }
        if ($this->akreditasi) {
            $metaSekolah .= ($metaSekolah ? ' &middot; ' : '') . '<strong>Akreditasi:</strong> ' . htmlspecialchars($this->akreditasi);
        }

        $alamat = htmlspecialchars($this->alamat_sekolah ?: 'Jl. Pendidikan No. 1, Lingkungan Sekolah');

        $kontakParts = [];
        if ($this->telepon_sekolah) {
            $kontakParts[] = 'Telp: ' . htmlspecialchars($this->telepon_sekolah);
        }
        if ($this->email_sekolah) {
            $kontakParts[] = 'Email: ' . htmlspecialchars($this->email_sekolah);
        }
        if ($this->website_sekolah) {
            $kontakParts[] = 'Web: ' . htmlspecialchars($this->website_sekolah);
        }
        $kontakHtml = implode(' &middot; ', $kontakParts);

        return '
        <table style="width: 100%; border-bottom: 2.5px double #1e293b; padding-bottom: 8px; margin-bottom: 16px; font-family: DejaVu Sans, sans-serif;">
            <tr>
                ' . $logoTd . '
                <td style="text-align: center; vertical-align: middle;">
                    <div style="font-size: 9.5px; font-weight: bold; text-transform: uppercase; letter-spacing: .5px; color: #475467;">
                        PEMERINTAH DAERAH / DINAS PENDIDIKAN
                    </div>
                    <div style="font-size: 15px; font-weight: bold; text-transform: uppercase; color: #0b6f69; margin: 2px 0;">
                        ' . $namaSekolah . '
                    </div>
                    ' . ($metaSekolah ? '<div style="font-size: 8.5px; color: #344054;">' . $metaSekolah . '</div>' : '') . '
                    <div style="font-size: 8px; color: #475467; margin-top: 2px;">' . $alamat . '</div>
                    ' . ($kontakHtml ? '<div style="font-size: 8px; color: #667085; margin-top: 1px;">' . $kontakHtml . '</div>' : '') . '
                </td>
                ' . $spacerTd . '
            </tr>
        </table>';
    }

    /**
     * Menghasilkan HTML blok Tanda Tangan & Pengesahan Dokumen Resmi.
     */
    public function getPengesahanHtml(string $penandaTanganTambahan = '', string $jabatanTambahan = ''): string
    {
        $kota = $this->alamat_sekolah ? \Illuminate\Support\Str::before($this->alamat_sekolah, ',') : 'Ditetapkan';
        $tanggal = now()->locale('id')->translatedFormat('d F Y');
        $kepsek = htmlspecialchars($this->kepala_sekolah_nama ?: '____________________________');
        $nip = htmlspecialchars($this->kepala_sekolah_nip ?: '—');

        if ($penandaTanganTambahan) {
            return '
            <table style="width: 100%; margin-top: 35px; border-collapse: collapse; page-break-inside: avoid; font-family: DejaVu Sans, sans-serif;">
                <tr>
                    <td style="width: 50%; text-align: center; vertical-align: top;">
                        <div style="font-size: 9px; color: #475467;">Mengetahui,</div>
                        <div style="font-size: 9.5px; font-weight: bold; margin-top: 3px; color: #1e293b;">Kepala Sekolah</div>
                        <div style="height: 55px;"></div>
                        <div style="font-size: 10px; font-weight: bold; text-decoration: underline; color: #0b6f69;">' . $kepsek . '</div>
                        <div style="font-size: 8.5px; color: #475467; margin-top: 2px;">NIP. ' . $nip . '</div>
                    </td>
                    <td style="width: 50%; text-align: center; vertical-align: top;">
                        <div style="font-size: 9px; color: #475467;">' . htmlspecialchars($kota) . ', ' . $tanggal . '</div>
                        <div style="font-size: 9.5px; font-weight: bold; margin-top: 3px; color: #1e293b;">' . htmlspecialchars($jabatanTambahan ?: 'Guru Bimbingan Konseling') . '</div>
                        <div style="height: 55px;"></div>
                        <div style="font-size: 10px; font-weight: bold; text-decoration: underline; color: #0b6f69;">' . htmlspecialchars($penandaTanganTambahan) . '</div>
                        <div style="font-size: 8.5px; color: #475467; margin-top: 2px;">Guru BK / Konselor</div>
                    </td>
                </tr>
            </table>';
        }

        return '
        <table style="width: 100%; margin-top: 35px; border-collapse: collapse; page-break-inside: avoid; font-family: DejaVu Sans, sans-serif;">
            <tr>
                <td style="width: 55%;"></td>
                <td style="width: 45%; text-align: center; vertical-align: top;">
                    <div style="font-size: 9px; color: #475467;">' . htmlspecialchars($kota) . ', ' . $tanggal . '</div>
                    <div style="font-size: 9.5px; font-weight: bold; margin-top: 3px; color: #1e293b;">Kepala Sekolah</div>
                    <div style="height: 55px;"></div>
                    <div style="font-size: 10px; font-weight: bold; text-decoration: underline; color: #0b6f69;">' . $kepsek . '</div>
                    <div style="font-size: 8.5px; color: #475467; margin-top: 2px;">NIP. ' . $nip . '</div>
                </td>
            </tr>
        </table>';
    }
}