<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Kebijakan CurhatAman</title>
    <style>
        @page{
            margin:28px 30px;
        }

        body{
            margin:0;
            color:#172033;
            font-family:DejaVu Sans, sans-serif;
            font-size:10px;
            line-height:1.45;
        }

        h1{
            margin:0 0 4px;
            font-size:20px;
        }

        h2{
            margin:20px 0 8px;
            font-size:12px;
        }

        .muted{color:#667085}

        .header{
            padding-bottom:14px;
            border-bottom:1px solid #dfe6e6;
        }

        .meta{
            margin-top:8px;
            font-size:9px;
        }

        .privacy{
            margin-top:10px;
            padding:8px 10px;
            border:1px solid #cfe4e1;
            background:#f3f9f8;
            color:#55706d;
        }

        .summary{
            width:100%;
            margin-top:16px;
            border-collapse:collapse;
        }

        .summary td{
            width:20%;
            padding:10px 8px;
            border:1px solid #dfe6e6;
            vertical-align:top;
        }

        .summary-label{
            color:#667085;
            font-size:8px;
        }

        .summary-value{
            margin-top:3px;
            font-size:18px;
            font-weight:bold;
        }

        table.data{
            width:100%;
            border-collapse:collapse;
        }

        table.data th,
        table.data td{
            padding:6px 7px;
            border:1px solid #dfe6e6;
        }

        table.data th{
            background:#eaf6f4;
            color:#344054;
            text-align:left;
            font-size:8.5px;
        }

        .number{text-align:right}

        .section-grid{
            width:100%;
            border-collapse:separate;
            border-spacing:8px 0;
        }

        .section-grid td{
            width:50%;
            vertical-align:top;
        }

        .footer{
            margin-top:22px;
            padding-top:8px;
            border-top:1px solid #dfe6e6;
            color:#98a2b3;
            font-size:8px;
        }
    </style>
</head>

<body>

    <!-- KOP SURAT RESMI SEKOLAH -->
    <table style="width: 100%; border-bottom: 2.5px double #1e293b; padding-bottom: 8px; margin-bottom: 14px;">
        <tr>
            @php
                $logoPath = null;
                if (!empty($pengaturan->logo_sekolah) && file_exists(public_path('storage/' . $pengaturan->logo_sekolah))) {
                    $logoPath = public_path('storage/' . $pengaturan->logo_sekolah);
                }
            @endphp
            @if($logoPath)
                <td style="width: 75px; text-align: left; vertical-align: middle;">
                    <img src="{{ $logoPath }}" style="max-height: 65px; max-width: 65px; object-fit: contain;">
                </td>
            @endif
            <td style="text-align: center; vertical-align: middle;">
                <div style="font-size: 9.5px; font-weight: bold; text-transform: uppercase; letter-spacing: .5px; color: #475467;">
                    PEMERINTAH DAERAH / DINAS PENDIDIKAN
                </div>
                <div style="font-size: 15px; font-weight: bold; text-transform: uppercase; color: #0b6f69; margin: 2px 0;">
                    {{ $pengaturan->nama_sekolah ?: 'SMA / SMK NEGERI CURHATAMAN' }}
                </div>
                <div style="font-size: 8.5px; color: #344054;">
                    @if($pengaturan->npsn) <strong>NPSN:</strong> {{ $pengaturan->npsn }} @endif
                    @if($pengaturan->akreditasi) &middot; <strong>Akreditasi:</strong> {{ $pengaturan->akreditasi }} @endif
                </div>
                <div style="font-size: 8px; color: #475467; margin-top: 2px;">
                    {{ $pengaturan->alamat_sekolah ?: 'Jl. Pendidikan No. 1, Kota Sekolah' }}
                </div>
                <div style="font-size: 8px; color: #667085; margin-top: 1px;">
                    @if($pengaturan->telepon_sekolah) Telp: {{ $pengaturan->telepon_sekolah }} @endif
                    @if($pengaturan->email_sekolah) &middot; Email: {{ $pengaturan->email_sekolah }} @endif
                    @if($pengaturan->website_sekolah) &middot; Web: {{ $pengaturan->website_sekolah }} @endif
                </div>
            </td>
            @if($logoPath)
                <td style="width: 75px;"></td>
            @endif
        </tr>
    </table>

    <div class="header">
        <h1>Laporan Kebijakan & Evaluasi Sekolah</h1>

        <div class="muted">
            Ringkasan data agregat bimbingan konseling dan perlindungan anak
        </div>

        <div class="meta">
            <strong>Tahun Ajaran:</strong> {{ $tahunAjaran }} &middot; <strong>Semester:</strong> {{ ucfirst($semester) }}<br>
            <strong>Periode Analisis:</strong> {{ $dari->locale('id')->translatedFormat('d F Y') }} s.d. {{ $sampai->locale('id')->translatedFormat('d F Y') }}<br>
            <strong>Waktu Dibuat:</strong> {{ $generatedAt->locale('id')->translatedFormat('d F Y, H:i') }} WIB
        </div>

        <div class="privacy">
            Dokumen ini memuat data agregat resmi institusi untuk bahan pertimbangan kebijakan sekolah. Identitas pribadi siswa, bukti berkas, dan catatan konseling privat terlindungi sesuai peraturan perundang-undangan.
        </div>
    </div>

    <table class="summary">
        <tr>
            <td>
                <div class="summary-label">TOTAL LAPORAN</div>
                <div class="summary-value">{{ $ringkasan['total'] }}</div>
            </td>
            <td>
                <div class="summary-label">KASUS AKTIF</div>
                <div class="summary-value">{{ $ringkasan['aktif'] }}</div>
            </td>
            <td>
                <div class="summary-label">SELESAI</div>
                <div class="summary-value">{{ $ringkasan['selesai'] }}</div>
            </td>
            <td>
                <div class="summary-label">DIESKALASI</div>
                <div class="summary-value">{{ $ringkasan['dieskalasi'] }}</div>
            </td>
            <td>
                <div class="summary-label">MANGKRAK</div>
                <div class="summary-value">{{ $ringkasan['mangkrak'] }}</div>
            </td>
        </tr>
    </table>

    <table class="section-grid">
        <tr>
            <td>
                <h2>Distribusi Status</h2>

                <table class="data">
                    <thead>
                        <tr>
                            <th>Status</th>
                            <th class="number">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($status as $item)
                            <tr>
                                <td>{{ $item->label }}</td>
                                <td class="number">{{ $item->total }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="2">Tidak ada data.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </td>

            <td>
                <h2>Distribusi Kategori</h2>

                <table class="data">
                    <thead>
                        <tr>
                            <th>Kategori</th>
                            <th class="number">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($kategori as $item)
                            <tr>
                                <td>{{ $item->nama_kategori }}</td>
                                <td class="number">{{ $item->total }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="2">Tidak ada data.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </td>
        </tr>
    </table>

    <h2>Distribusi Tingkat</h2>

    <table class="data">
        <thead>
            <tr>
                <th>Tingkat</th>
                <th class="number">Total</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tingkat as $item)
                <tr>
                    <td>{{ $item->tingkat }}</td>
                    <td class="number">{{ $item->total }}</td>
                </tr>
            @empty
                <tr><td colspan="2">Tidak ada data.</td></tr>
            @endforelse
        </tbody>
    </table>

    <h2>Tren Bulanan</h2>

    <table class="data">
        <thead>
            <tr>
                <th>Bulan</th>
                <th class="number">Total Laporan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tren as $item)
                <tr>
                    <td>{{ $item->label }}</td>
                    <td class="number">{{ $item->total }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Aktivitas Guru BK</h2>

    <table class="data">
        <thead>
            <tr>
                <th>Guru BK</th>
                <th class="number">Kasus Aktif Saat Ini</th>
                <th class="number">Selesai pada Periode</th>
                <th class="number">Tindak Lanjut pada Periode</th>
            </tr>
        </thead>
        <tbody>
            @forelse($aktivitasBk as $bk)
                <tr>
                    <td>{{ $bk->name }}</td>
                    <td class="number">{{ $bk->kasus_saat_ini }}</td>
                    <td class="number">{{ $bk->selesai_periode }}</td>
                    <td class="number">{{ $bk->tindak_lanjut_periode }}</td>
                </tr>
            @empty
                <tr><td colspan="4">Belum ada Guru BK aktif.</td></tr>
            @endforelse
        </tbody>
    </table>

    <!-- TANDA TANGAN / PENGESAHAN LAPORAN RESMI -->
    <table style="width: 100%; margin-top: 36px; border-collapse: collapse; page-break-inside: avoid;">
        <tr>
            <td style="width: 55%; vertical-align: top;">
                <div style="font-size: 8.5px; color: #667085; line-height: 1.5;">
                    <em>Catatan: Dokumen ini diterbitkan secara resmi melalui Sistem Informasi CurhatAman dan sah dipergunakan sebagai instrumen evaluasi kebijakan bimbingan konseling di lingkungan satuan pendidikan.</em>
                </div>
            </td>
            <td style="width: 45%; text-align: center; vertical-align: top;">
                <div style="font-size: 9px; color: #475467;">
                    {{ $pengaturan->alamat_sekolah ? \Illuminate\Support\Str::before($pengaturan->alamat_sekolah, ',') : 'Ditetapkan' }}, {{ now()->locale('id')->translatedFormat('d F Y') }}
                </div>
                <div style="font-size: 9.5px; font-weight: bold; margin-top: 4px; color: #1e293b;">
                    Kepala Sekolah
                </div>
                <div style="height: 55px;"></div>
                <div style="font-size: 10px; font-weight: bold; text-decoration: underline; color: #0b6f69;">
                    {{ $pengaturan->kepala_sekolah_nama ?: '____________________________' }}
                </div>
                <div style="font-size: 8.5px; color: #475467; margin-top: 2px;">
                    NIP. {{ $pengaturan->kepala_sekolah_nip ?: '—' }}
                </div>
            </td>
        </tr>
    </table>

    <div class="footer">
        CurhatAman · Portal Admin Sekolah · Kasus mangkrak menggunakan
        batas {{ $staleDays }} hari sesuai konfigurasi sistem.
    </div>

</body>
</html>
