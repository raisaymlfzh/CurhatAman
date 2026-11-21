<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Catatan Konseling - Guru BK - CurhatAman</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        :root {
            --ca-primary: #0f8a83;
            --ca-primary-dark: #0b6f69;
            --ca-primary-soft: #eaf6f4;
            --ca-text: #172033;
            --ca-muted: #667085;
            --ca-muted-light: #98a2b3;
            --ca-bg: #f6f8f9;
            --ca-surface: #ffffff;
            --ca-border: #e3e9e9;
            --ca-line: #edf1f1;
            --sidebar-width: 252px;
            --topbar-height: 72px;
        }

        * {
            box-sizing: border-box;
        }

        html, body {
            min-height: 100%;
        }

        body {
            min-height: 100vh;
            margin: 0;
            color: var(--ca-text);
            background: var(--ca-bg);
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            font-size: 14px;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        .app-shell {
            min-height: 100vh;
            display: grid;
            grid-template-columns: var(--sidebar-width) minmax(0, 1fr);
            grid-template-rows: var(--topbar-height) minmax(0, 1fr);
        }

        .sidebar {
            grid-row: 1 / 3;
            min-height: 100vh;
            padding: 18px 14px;
            display: flex;
            flex-direction: column;
            background: #ffffff;
            border-right: 1px solid var(--ca-border);
        }

        .main-content {
            grid-column: 2;
            padding: 24px 28px 40px;
        }

        .content-shell {
            width: 100%;
            max-width: 1120px;
            margin: 0 auto;
        }

        /* Breadcrumb */
        .breadcrumb-ca {
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 7px;
            color: var(--ca-muted);
            font-size: 12px;
        }

        .breadcrumb-ca a {
            color: var(--ca-primary-dark);
            font-weight: 650;
            display: inline-flex;
            align-items: center;
            transition: color .15s ease;
        }

        .breadcrumb-ca a:hover {
            color: var(--ca-primary);
            text-decoration: underline;
        }

        /* Page Header */
        .page-header {
            margin-bottom: 22px;
            padding: 22px 26px;
            border-radius: 14px;
            background: linear-gradient(135deg, var(--ca-primary) 0%, #0d7973 100%) !important;
            box-shadow: 0 4px 14px rgba(15, 138, 131, 0.16);
            display: flex !important;
            align-items: center !important;
            justify-content: space-between !important;
            flex-wrap: wrap !important;
            gap: 16px !important;
        }

        .header-left-content {
            flex: 1 1 450px !important;
            min-width: 280px !important;
        }

        .header-actions-group {
            margin-left: auto !important;
            display: flex !important;
            align-items: center !important;
            justify-content: flex-end !important;
            gap: 8px !important;
            flex-wrap: wrap !important;
            flex-shrink: 0 !important;
        }

        .page-kicker {
            margin-bottom: 6px;
            color: rgba(255, 255, 255, .82);
            font-size: 11px;
            font-weight: 760;
            letter-spacing: .08em;
            text-transform: uppercase;
            display: flex;
            align-items: center;
        }

        .page-title {
            margin: 0 0 6px;
            color: #ffffff;
            font-size: 24px;
            line-height: 1.25;
            font-weight: 760;
            letter-spacing: -.02em;
        }

        .page-copy {
            max-width: 600px;
            margin: 0;
            color: rgba(255, 255, 255, .88);
            font-size: 12.5px;
            line-height: 1.55;
        }

        .header-action-btn {
            height: 36px;
            padding: 0 15px;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 11.5px;
            font-weight: 650;
            letter-spacing: .01em;
            text-decoration: none;
            white-space: nowrap;
            transition: all .15s ease;
        }

        .header-action-white {
            color: var(--ca-primary-dark) !important;
            background: #ffffff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.08);
        }

        .header-action-white:hover {
            background: #f0fdfa;
            transform: translateY(-1px);
        }

        .header-action-glass {
            color: #ffffff !important;
            background: rgba(255, 255, 255, 0.16);
            border: 1px solid rgba(255, 255, 255, 0.38);
        }

        .header-action-glass:hover {
            background: rgba(255, 255, 255, 0.26);
            transform: translateY(-1px);
        }

        .header-status-badge {
            height: 36px;
            padding: 0 14px;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            font-size: 11.5px;
            font-weight: 700;
            white-space: nowrap;
        }

        .badge-rahasia {
            background: rgba(239, 68, 68, 0.22);
            color: #ffffff;
            border: 1px solid rgba(255, 255, 255, 0.38);
        }

        .badge-terbuka {
            background: rgba(255, 255, 255, 0.18);
            color: #ffffff;
            border: 1px solid rgba(255, 255, 255, 0.38);
        }

        /* Layout Grid */
        .layout-grid {
            display: grid;
            grid-template-columns: minmax(0, 2fr) minmax(310px, 1fr);
            gap: 22px;
            align-items: start;
        }

        .card-custom {
            background: #ffffff;
            border: 1px solid var(--ca-border);
            border-radius: 12px;
            padding: 22px;
            margin-bottom: 20px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02);
        }

        .card-title-custom {
            font-size: 13.5px;
            font-weight: 750;
            color: var(--ca-text);
            margin-bottom: 14px;
            padding-bottom: 9px;
            border-bottom: 1px solid var(--ca-line);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .meta-pill {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 11.5px;
            font-weight: 600;
            background: #f1f5f9;
            color: #475467;
        }

        .meta-pill-primary {
            background: var(--ca-primary-soft);
            color: var(--ca-primary-dark);
            border: 1px solid rgba(15, 138, 131, 0.2);
        }

        .meta-pill-shared {
            background: #ecfdf5;
            color: #047857;
            border: 1px solid #a7f3d0;
        }

        .meta-pill-secret {
            background: #fef2f2;
            color: #b91c1c;
            border: 1px solid #fecaca;
        }

        /* Clean Minimal Layout */
        .clean-quote-box {
            background: #f8fafc;
            border-left: 3px solid var(--ca-primary);
            border-radius: 0 8px 8px 0;
            padding: 11px 15px;
        }

        .clean-quote-label {
            font-size: 11px;
            font-weight: 700;
            color: var(--ca-primary-dark);
            text-transform: uppercase;
            letter-spacing: .04em;
            margin-bottom: 3px;
        }

        .clean-quote-body {
            font-size: 13px;
            color: #334155;
            font-style: italic;
            line-height: 1.5;
        }

        .section-clean-title {
            font-size: 11.5px;
            font-weight: 750;
            color: #475467;
            text-transform: uppercase;
            letter-spacing: .04em;
            margin-bottom: 6px;
            display: flex;
            align-items: center;
        }

        .section-clean-body {
            font-size: 13px;
            line-height: 1.6;
            color: #1e293b;
        }

        .clean-result-card {
            border-radius: 8px;
            padding: 12px 15px;
            border: 1px solid transparent;
        }

        .clean-result-card.success {
            background: #f0fdf4;
            border-color: #bbf7d0;
        }

        .clean-result-card.primary {
            background: #eff6ff;
            border-color: #bfdbfe;
        }

        .clean-result-card.teal {
            background: #f0fdfa;
            border-color: #99f6e4;
        }

        .clean-result-title {
            font-size: 11px;
            font-weight: 750;
            text-transform: uppercase;
            letter-spacing: .04em;
            margin-bottom: 4px;
            display: flex;
            align-items: center;
        }

        .clean-result-card.success .clean-result-title { color: #15803d; }
        .clean-result-card.primary .clean-result-title { color: #1d4ed8; }
        .clean-result-card.teal .clean-result-title { color: #0f766e; }

        .clean-result-body {
            font-size: 13px;
            line-height: 1.55;
        }

        .clean-result-card.success .clean-result-body { color: #166534; }
        .clean-result-card.primary .clean-result-body { color: #1e40af; }
        .clean-result-card.teal .clean-result-body { color: #0f766e; }

        /* Info Row in Sidebar */
        .info-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 9px 0;
            border-bottom: 1px solid #f1f5f9;
            font-size: 12.5px;
            gap: 12px;
        }

        .info-row:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .info-label {
            color: var(--ca-muted);
            font-weight: 500;
            white-space: nowrap;
        }

        .info-val {
            color: var(--ca-text);
            font-weight: 650;
            text-align: right;
            min-width: 0;
        }

        .avatar-student {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            background: var(--ca-primary-soft);
            color: var(--ca-primary-dark);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            font-weight: 750;
            flex-shrink: 0;
        }

        .wa-chip-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 5px 12px;
            border-radius: 999px;
            background: #25D366;
            color: #ffffff !important;
            font-weight: 700;
            font-size: 11.5px;
            transition: all .15s ease;
            box-shadow: 0 1px 3px rgba(37, 211, 102, 0.25);
        }

        .wa-chip-btn:hover {
            background: #1eb857;
            transform: translateY(-1px);
            box-shadow: 0 2px 6px rgba(37, 211, 102, 0.35);
        }

        @media (max-width: 991px) {
            .app-shell {
                grid-template-columns: 1fr;
            }

            .layout-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
    @include('guru-bk.partials.styles')
</head>

<body>
    @php
        $namaUser = ucwords($user->name);
        $inisial = strtoupper(substr($user->name, 0, 1));
        $namaSiswaDisplay = ucwords(strtolower($catatan->nama_siswa ?? 'Siswa'));
        $inisialSiswa = strtoupper(substr($catatan->nama_siswa ?? 'S', 0, 1));
        $tanggalFormat = \Carbon\Carbon::parse($catatan->tanggal_pertemuan)->locale('id')->translatedFormat('l, d F Y');

        // Parse isi_catatan jika menggunakan template otomatis
        $rawCatatan = trim($catatan->isi_catatan ?? '');
        $pesanSiswa = null;
        $observasiSesi = null;
        $pengantar = null;

        if (preg_match('/(?:Pesan\/Keluhan Siswa|Deskripsi Awal Kejadian):\s*[\r\n]*["\']?(.*?)["\']?(?:\s*[\r\n]+Catatan & Observasi Pertemuan Konseling:|$)/s', $rawCatatan, $matches)) {
            $pesanSiswa = trim($matches[1] ?? '');
            
            $parts = preg_split('/(?:Pesan\/Keluhan Siswa|Deskripsi Awal Kejadian):/s', $rawCatatan);
            if (!empty($parts[0])) {
                $pengantar = trim($parts[0]);
            }
            
            if (str_contains($rawCatatan, 'Catatan & Observasi Pertemuan Konseling:')) {
                $obsParts = explode('Catatan & Observasi Pertemuan Konseling:', $rawCatatan);
                if (isset($obsParts[1]) && trim($obsParts[1]) !== '') {
                    $observasiSesi = trim($obsParts[1]);
                }
            }
        } else {
            $observasiSesi = $rawCatatan;
        }
    @endphp

    <div class="app-shell">
        @include('guru-bk.partials.sidebar')

        @include('guru-bk.partials.topbar', [
            'topbarTitle' => 'Detail Catatan Konseling',
            'topbarSubtitle' => 'Dokumentasi sesi pendampingan siswa'
        ])

        <main class="main-content">
            <div class="content-shell">
                <!-- Navigasi Breadcrumb -->
                <div class="breadcrumb-ca">
                    <a href="{{ route('guru-bk.catatan-konseling.index') }}">
                        <i class="bi bi-arrow-left me-1"></i> Kembali ke Jurnal Konseling
                    </a>
                    <i class="bi bi-chevron-right" style="font-size: 10px;"></i>
                    <span>Sesi #{{ $catatan->id }} ({{ $namaSiswaDisplay }})</span>
                </div>

                <!-- Header Halaman Gradasi Hijau CurhatAman -->
                <header class="page-header">
                    <div class="header-left-content">
                        <div class="page-kicker">
                            <i class="bi bi-journal-medical me-1"></i> Bimbingan & Konseling
                        </div>
                        <h1 class="page-title">Detail Catatan Konseling</h1>
                        <p class="page-copy">
                            Dokumentasi resmi rekam jejak sesi bimbingan dan konseling siswa.
                        </p>
                    </div>

                    <div class="header-actions-group">
                        @if($catatan->is_rahasia)
                            <span class="header-status-badge badge-rahasia" title="Dokumen ini hanya dapat diakses oleh Guru BK">
                                <i class="bi bi-shield-lock-fill me-1"></i> Dokumen Rahasia
                            </span>
                        @else
                            <span class="header-status-badge badge-terbuka" title="Dokumen ini dapat dikoordinasikan bersama Wali Kelas">
                                <i class="bi bi-people-fill me-1"></i> Terbuka / Koordinatif
                            </span>
                        @endif

                        <a href="{{ route('guru-bk.catatan-konseling.pdf', $catatan->id) }}" class="header-action-btn header-action-glass" target="_blank" title="Cetak catatan konseling ke file PDF">
                            <i class="bi bi-printer"></i>
                            <span>Cetak Dokumen PDF</span>
                        </a>

                        @if ((int) $catatan->guru_bk_id === (int) auth()->id())
                            <a href="{{ route('guru-bk.catatan-konseling.edit', $catatan->id) }}" class="header-action-btn header-action-white" title="Ubah data catatan konseling ini">
                                <i class="bi bi-pencil-square"></i>
                                <span>Ubah Catatan</span>
                            </a>
                        @else
                            <span class="badge bg-light text-muted border px-3 py-2" style="font-size: 11.5px; font-weight: 500; border-radius: 999px;">
                                Konselor: {{ ucwords($catatan->nama_guru_bk) }}
                            </span>
                        @endif
                    </div>
                </header>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2 mb-4" role="alert" style="border-radius: 10px;">
                        <i class="bi bi-check-circle-fill text-success fs-5"></i>
                        <div>{{ session('success') }}</div>
                        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="layout-grid">
                    <!-- Konten Utama Catatan (Kiri) -->
                    <div>
                        <div class="card-custom">
                            <!-- Meta Pelaksanaan Sesi -->
                            <div class="d-flex align-items-center flex-wrap gap-2 mb-3">
                                <span class="meta-pill meta-pill-primary">
                                    <i class="bi bi-tag-fill"></i> {{ $catatan->jenis_layanan }}
                                </span>
                                <span class="meta-pill">
                                    <i class="bi bi-calendar-event"></i> {{ $tanggalFormat }}
                                </span>
                                <span class="meta-pill">
                                    <i class="bi bi-person-badge"></i> Konselor: {{ ucwords($catatan->nama_guru_bk) }}
                                </span>
                                @if($catatan->is_shared_wali_kelas)
                                    <span class="meta-pill meta-pill-shared" title="Catatan ini dapat dipantau oleh Wali Kelas">
                                        <i class="bi bi-people-fill"></i> Dibagikan ke Wali Kelas
                                    </span>
                                @else
                                    <span class="meta-pill meta-pill-secret" title="Catatan ini hanya disimpan internal Guru BK">
                                        <i class="bi bi-lock-fill"></i> Khusus Internal BK
                                    </span>
                                @endif
                            </div>

                            <!-- Judul / Topik Sesi -->
                            <h2 style="font-size: 20px; font-weight: 760; color: #0f172a; margin-bottom: 18px; line-height: 1.35; letter-spacing: -.01em;">
                                {{ $catatan->topik }}
                            </h2>

                            <!-- Box Quote Pesan / Keluhan Awal Siswa jika ada -->
                            @if($pesanSiswa)
                                <div class="clean-quote-box mb-3">
                                    <div class="clean-quote-label">
                                        <i class="bi bi-chat-quote-fill me-1"></i> Keluhan Awal Siswa:
                                    </div>
                                    <div class="clean-quote-body">
                                        &ldquo;{{ $pesanSiswa }}&rdquo;
                                    </div>
                                </div>
                            @endif

                            <!-- Catatan & Observasi Proses Sesi (Hanya tampil jika ada isinya) -->
                            @if($observasiSesi)
                                <div class="mb-3">
                                    <div class="section-clean-title">
                                        <i class="bi bi-journal-text me-1"></i> Catatan Proses Sesi:
                                    </div>
                                    <div class="section-clean-body">
                                        {!! nl2br(e($observasiSesi)) !!}
                                    </div>
                                </div>
                            @endif

                            <!-- Hasil Kesepakatan / Solusi Siswa (Hanya tampil jika ada isinya) -->
                            @if($catatan->hasil_kesepakatan)
                                <div class="clean-result-card success mb-3">
                                    <div class="clean-result-title">
                                        <i class="bi bi-check2-circle me-1"></i> Hasil Kesepakatan / Solusi:
                                    </div>
                                    <div class="clean-result-body">
                                        {!! nl2br(e($catatan->hasil_kesepakatan)) !!}
                                    </div>
                                </div>
                            @endif

                            <!-- Rencana Tindak Lanjut Guru BK (Hanya tampil jika ada isinya) -->
                            @if($catatan->tindak_lanjut)
                                <div class="clean-result-card primary mb-3">
                                    <div class="clean-result-title">
                                        <i class="bi bi-arrow-right-circle me-1"></i> Tindak Lanjut Guru BK:
                                    </div>
                                    <div class="clean-result-body">
                                        {!! nl2br(e($catatan->tindak_lanjut)) !!}
                                    </div>
                                </div>
                            @endif

                            <!-- Arahan & Koordinasi Wali Kelas (Hanya tampil jika tidak rahasia dan ada catatan) -->
                            @if(!$catatan->is_rahasia && $catatan->arahan_wali_kelas)
                                <div class="clean-result-card teal mb-0">
                                    <div class="clean-result-title">
                                        <i class="bi bi-people me-1"></i> Arahan untuk Wali Kelas:
                                    </div>
                                    <div class="clean-result-body">
                                        {!! nl2br(e($catatan->arahan_wali_kelas)) !!}
                                    </div>
                                </div>
                            @endif

                            <!-- Fallback jika belum ada rincian apa pun -->
                            @if(!$pesanSiswa && !$observasiSesi && !$catatan->hasil_kesepakatan && !$catatan->tindak_lanjut)
                                <div class="text-muted fst-italic py-2" style="font-size: 13px;">
                                    Belum ada rincian catatan observasi atau kesepakatan tertulis pada sesi ini.
                                    @if((int) $catatan->guru_bk_id === (int) auth()->id())
                                        <a href="{{ route('guru-bk.catatan-konseling.edit', $catatan->id) }}" class="ms-1 fw-semibold text-primary text-decoration-none">
                                            Lengkapi Sekarang &rarr;
                                        </a>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Kolom Samping (Kanan) -->
                    <div>
                        <!-- Identitas Siswa -->
                        <div class="card-custom">
                            <div class="card-title-custom">
                                <i class="bi bi-person-vcard text-primary"></i> Identitas Siswa
                            </div>

                            <div class="d-flex align-items-center gap-3 mb-3 pb-3 border-bottom">
                                <span class="avatar-student">{{ $inisialSiswa }}</span>
                                <div class="min-w-0">
                                    <div style="font-weight: 750; font-size: 14.5px; color: #0f172a;" class="text-truncate">
                                        {{ $namaSiswaDisplay }}
                                    </div>
                                    <div style="font-size: 12px; color: var(--ca-muted);">
                                        NIS: {{ $catatan->nis ?? '-' }}
                                    </div>
                                </div>
                            </div>

                            <div class="info-row">
                                <span class="info-label">Kelas Aktif</span>
                                <span class="info-val">
                                    <span class="badge" style="background: var(--ca-primary-soft); color: var(--ca-primary-dark); font-weight: 650; font-size: 11.5px;">
                                        {{ $catatan->nama_kelas ?? 'Tanpa Kelas' }}
                                    </span>
                                </span>
                            </div>

                            <div class="info-row">
                                <span class="info-label">WhatsApp</span>
                                <span class="info-val">
                                    @if($catatan->whatsapp_number)
                                        @php
                                            $rawWa = preg_replace('/[^0-9]/', '', $catatan->whatsapp_number);
                                            if (str_starts_with($rawWa, '0')) {
                                                $waNum = '62' . substr($rawWa, 1);
                                                $waDisplay = '0' . substr($rawWa, 1);
                                            } elseif (str_starts_with($rawWa, '62')) {
                                                $waNum = $rawWa;
                                                $waDisplay = '0' . substr($rawWa, 2);
                                            } else {
                                                $waNum = '62' . $rawWa;
                                                $waDisplay = $rawWa;
                                            }
                                            $namaSiswaWa = $catatan->nama_siswa ?? 'Siswa';
                                            $pesanWhatsapp = rawurlencode(
                                                "Halo {$namaSiswaWa}, ada pemberitahuan dari layanan Bimbingan & Konseling CurhatAman. Silakan cek akun CurhatAman kamu melalui tautan berikut:\n" . url('/') . "\n\natau hubungi Guru BK sekolah untuk informasi selengkapnya."
                                            );
                                        @endphp
                                        <a href="https://wa.me/{{ $waNum }}?text={{ $pesanWhatsapp }}" target="_blank" rel="noopener noreferrer" class="wa-chip-btn" title="Hubungi siswa via WhatsApp">
                                            <i class="bi bi-whatsapp"></i> {{ $waDisplay }}
                                        </a>
                                    @else
                                        <span class="text-muted fst-italic" style="font-size: 11.5px;">Nomor belum tercatat</span>
                                    @endif
                                </span>
                            </div>

                            <div class="mt-3 pt-2">
                                <a href="{{ route('guru-bk.data-siswa.show', $catatan->siswa_id) }}" class="btn btn-sm btn-outline-secondary w-100 d-inline-flex align-items-center justify-content-center gap-1" style="font-size: 12px; font-weight: 600; border-color: var(--ca-border); padding: 8px 12px; border-radius: 8px;">
                                    <i class="bi bi-arrow-up-right-square"></i> Lihat Profil Lengkap Siswa
                                </a>
                            </div>
                        </div>

                        <!-- Keterkaitan Layanan -->
                        <div class="card-custom">
                            <div class="card-title-custom">
                                <i class="bi bi-link-45deg text-primary"></i> Keterkaitan Layanan
                            </div>

                            <div class="info-row">
                                <span class="info-label">Konselor BK</span>
                                <span class="info-val">{{ ucwords($catatan->nama_guru_bk) }}</span>
                            </div>

                            @if($catatan->kode_laporan)
                                <div class="info-row">
                                    <span class="info-label">Laporan Kasus</span>
                                    <span class="info-val">
                                        <a href="{{ route('guru-bk.laporan.show', $catatan->laporan_id) }}" class="badge bg-light text-primary border text-decoration-none fw-bold" style="font-size: 11.5px; padding: 5px 8px;">
                                            <i class="bi bi-file-earmark-text me-1"></i> #{{ $catatan->kode_laporan }}
                                        </a>
                                    </span>
                                </div>
                            @endif

                            @if($catatan->jenis_bantuan_asal)
                                <div class="info-row">
                                    <span class="info-label">Bantuan Terkait</span>
                                    <span class="info-val text-truncate" style="max-width: 170px;">
                                        <a href="{{ route('guru-bk.bantuan.show', $catatan->bantuan_id) }}" class="badge bg-light text-primary border text-decoration-none fw-bold text-truncate d-inline-block" style="font-size: 11px; padding: 5px 8px; max-width: 160px;" title="{{ $catatan->jenis_bantuan_asal }}">
                                            <i class="bi bi-chat-heart me-1"></i> {{ $catatan->jenis_bantuan_asal }}
                                        </a>
                                    </span>
                                </div>
                            @endif

                            <div class="info-row">
                                <span class="info-label">Dicatat Pada</span>
                                <span class="info-val" style="font-size: 11.5px;">
                                    {{ \Carbon\Carbon::parse($catatan->created_at)->locale('id')->translatedFormat('d M Y, H:i') }} WIB
                                </span>
                            </div>
                        </div>

                        <!-- Riwayat Konseling Siswa -->
                        @if($riwayatLain->count() > 0)
                            <div class="card-custom">
                                <div class="card-title-custom">
                                    <i class="bi bi-clock-history text-primary"></i> Riwayat Konseling Siswa
                                </div>

                                <div class="d-flex flex-column gap-2">
                                    @foreach($riwayatLain as $r)
                                        <a href="{{ route('guru-bk.catatan-konseling.show', $r->id) }}" class="p-2 rounded border d-block text-decoration-none" style="background: #fafbfb; font-size: 12px; border-color: var(--ca-border) !important; transition: all .15s ease;">
                                            <div class="d-flex justify-content-between text-muted mb-1" style="font-size: 11px;">
                                                <span>{{ \Carbon\Carbon::parse($r->tanggal_pertemuan)->locale('id')->translatedFormat('d M Y') }}</span>
                                                <span class="badge bg-light text-dark border" style="font-size: 10px;">{{ $r->jenis_layanan }}</span>
                                            </div>
                                            <div class="fw-bold text-dark text-truncate">{{ $r->topik }}</div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
