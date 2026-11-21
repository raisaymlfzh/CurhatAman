<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Siswa - Guru BK - CurhatAman</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        :root {
            --ca-primary: #0f8a83;
            --ca-primary-dark: #0b6f69;
            --ca-primary-soft: #eaf6f4;
            --ca-text: #172033;
            --ca-muted: #667085;
            --ca-bg: #f6f8f9;
            --ca-border: #e2e8e8;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            color: var(--ca-text);
            background: var(--ca-bg);
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, Arial, sans-serif;
        }

        a {
            text-decoration: none;
        }

        .page {
            max-width: 1080px;
            margin: 0 auto;
            padding: 30px 22px 48px;
        }

        .back-link {
            margin-bottom: 18px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: var(--ca-muted);
            font-size: .76rem;
            font-weight: 650;
        }

        .page-kicker {
            margin-bottom: 5px;
            color: var(--ca-primary);
            font-size: .69rem;
            font-weight: 760;
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        .page-title {
            margin: 0;
            font-size: 1.6rem;
            font-weight: 780;
        }

        .page-copy {
            margin: 7px 0 0;
            color: var(--ca-muted);
            font-size: .8rem;
        }

        .profile-card,
        .activity-card,
        .privacy-note {
            margin-top: 18px;
            border: 1px solid var(--ca-border);
            border-radius: 12px;
            background: #fff;
        }

        .profile-card {
            padding: 20px;
        }

        .profile-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
        }

        .profile-identity {
            display: flex;
            align-items: center;
            gap: 13px;
        }

        .avatar {
            width: 48px;
            height: 48px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            color: #fff;
            background: var(--ca-primary);
            font-size: .95rem;
            font-weight: 780;
        }

        .profile-name {
            font-size: 1.02rem;
            font-weight: 740;
        }

        .profile-meta {
            margin-top: 4px;
            color: var(--ca-muted);
            font-size: .73rem;
        }

        .status-badge {
            min-height: 29px;
            padding: 5px 9px;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: .65rem;
            font-weight: 700;
        }

        .status-active {
            color: #087443;
            background: #ecfdf3;
        }

        .status-inactive {
            color: #b42318;
            background: #fef3f2;
        }

        .info-grid {
            margin-top: 18px;
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
        }

        .info-item {
            padding: 13px 14px;
            border: 1px solid #edf1f1;
            border-radius: 10px;
            background: #fbfcfc;
        }

        .info-label {
            color: var(--ca-muted);
            font-size: .65rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .045em;
        }

        .info-value {
            margin-top: 5px;
            color: var(--ca-text);
            font-size: .79rem;
            font-weight: 650;
            line-height: 1.45;
        }

        .contact-row {
            margin-top: 18px;
            padding: 14px;
            border: 1px solid #cfe4e1;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            background: #f7fbfa;
        }

        .contact-title {
            font-size: .78rem;
            font-weight: 720;
        }

        .contact-copy {
            margin-top: 3px;
            color: var(--ca-muted);
            font-size: .69rem;
            line-height: 1.5;
        }

        .whatsapp-button {
            min-height: 36px;
            padding: 7px 11px;
            border: 1px solid #b9dfcb;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            color: #0f6541;
            background: #f4fbf7;
            font-size: .7rem;
            font-weight: 700;
            white-space: nowrap;
        }

        .whatsapp-button:hover {
            color: #0b5b3a;
            border-color: #86c8a5;
            background: #eaf7ef;
        }

        .activity-card {
            padding: 18px;
        }

        .section-title {
            font-size: .9rem;
            font-weight: 730;
        }

        .section-copy {
            margin-top: 3px;
            color: var(--ca-muted);
            font-size: .7rem;
        }

        .activity-grid {
            margin-top: 14px;
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 10px;
        }

        .activity-item {
            padding: 14px;
            border: 1px solid var(--ca-border);
            border-radius: 10px;
            background: #fbfcfc;
        }

        .activity-icon {
            width: 32px;
            height: 32px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 9px;
            color: var(--ca-primary-dark);
            background: var(--ca-primary-soft);
        }

        .activity-value {
            margin-top: 11px;
            font-size: 1.25rem;
            font-weight: 780;
        }

        .activity-label {
            margin-top: 2px;
            color: var(--ca-muted);
            font-size: .68rem;
        }

        .module-actions {
            margin-top: 14px;
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .module-link {
            min-height: 36px;
            padding: 7px 11px;
            border: 1px solid var(--ca-border);
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: #475467;
            background: #fff;
            font-size: .7rem;
            font-weight: 680;
        }

        .module-link:hover {
            color: var(--ca-primary-dark);
            border-color: #b8d9d6;
            background: var(--ca-primary-soft);
        }

        .privacy-note {
            padding: 14px 15px;
            display: flex;
            align-items: flex-start;
            gap: 9px;
            color: #55706d;
            background: #f3f9f8;
            font-size: .72rem;
            line-height: 1.55;
        }

        @media (max-width: 800px) {
            .activity-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 620px) {
            .profile-head,
            .contact-row {
                align-items: flex-start;
                flex-direction: column;
            }

            .info-grid,
            .activity-grid {
                grid-template-columns: 1fr;
            }

            .whatsapp-button {
                width: 100%;
            }
        }
    </style>
    @include('guru-bk.partials.styles')
</head>

<body>
@php
    $inisialSiswa = strtoupper(substr($dataSiswa->name, 0, 1));

    $nomorWhatsappDisplay = $dataSiswa->whatsapp_number
        ? (
            str_starts_with($dataSiswa->whatsapp_number, '62')
                ? '0' . substr($dataSiswa->whatsapp_number, 2)
                : $dataSiswa->whatsapp_number
        )
        : null;

    $pesanWhatsapp = rawurlencode(
        "Halo {$dataSiswa->name}, ada pemberitahuan dari layanan Bimbingan & Konseling CurhatAman. Silakan cek akun CurhatAman kamu melalui tautan berikut:\n" . url('/') . "\n\natau hubungi Guru BK sekolah untuk informasi selengkapnya."
    );

    $whatsappUrl = $dataSiswa->whatsapp_number
        ? 'https://wa.me/' . $dataSiswa->whatsapp_number . '?text=' . $pesanWhatsapp
        : null;
@endphp

<div class="app-shell">
    @include('guru-bk.partials.sidebar')

    @include('guru-bk.partials.topbar', [
        'topbarTitle' => 'Profil Siswa',
        'topbarSubtitle' => 'Rekam jejak dan ringkasan aktivitas siswa'
    ])

    <main class="main-content">
        <div class="page-body" style="padding: 28px;">
            <div class="content-shell" style="max-width: 1040px; margin: 0 auto;">
    <a href="{{ route('guru-bk.data-siswa.index') }}" class="back-link">
        <i class="bi bi-arrow-left"></i>
        Kembali ke Data Siswa
    </a>

    <div class="page-kicker">Direktori Operasional</div>
    <h1 class="page-title">Detail Siswa</h1>
    <p class="page-copy">
        Informasi detail siswa.
    </p>

    <section class="profile-card">
        <div class="profile-head">
            <div class="profile-identity">
                <span class="avatar">{{ $inisialSiswa }}</span>

                <div>
                    <div class="profile-name">{{ $dataSiswa->name }}</div>

                    <div class="profile-meta">
                        NIS {{ $dataSiswa->nis ?: '-' }}
                        · {{ $dataSiswa->nama_kelas ?: 'Belum ada kelas' }}
                    </div>
                </div>
            </div>

            @if ($dataSiswa->is_active)
                <span class="status-badge status-active">
                    <i class="bi bi-check-circle"></i>
                    Akun Aktif
                </span>
            @else
                <span class="status-badge status-inactive">
                    <i class="bi bi-x-circle"></i>
                    Akun Nonaktif
                </span>
            @endif
        </div>

        <div class="info-grid">
            <div class="info-item">
                <div class="info-label">Nama Lengkap</div>
                <div class="info-value">{{ $dataSiswa->name }}</div>
            </div>

            <div class="info-item">
                <div class="info-label">Email</div>
                <div class="info-value">
                    @if ($dataSiswa->email && ! str_ends_with($dataSiswa->email, '@siswa.curhataman.local'))
                        {{ $dataSiswa->email }}
                    @else
                        <span class="fst-italic text-muted">Email belum dilengkapi</span>
                    @endif
                </div>
            </div>

            <div class="info-item">
                <div class="info-label">NIS</div>
                <div class="info-value">{{ $dataSiswa->nis ?: '-' }}</div>
            </div>

            <div class="info-item">
                <div class="info-label">Kelas Saat Ini</div>
                <div class="info-value">
                    {{ $dataSiswa->nama_kelas ?: 'Belum ada kelas' }}

                    @if ($dataSiswa->tahun_ajaran)
                        · {{ $dataSiswa->tahun_ajaran }}
                    @endif
                </div>
            </div>

            <div class="info-item">
                <div class="info-label">Tahun Masuk</div>
                <div class="info-value">{{ $dataSiswa->tahun_masuk ?: '-' }}</div>
            </div>

            <div class="info-item">
                <div class="info-label">Akun Dibuat</div>
                <div class="info-value">
                    {{ $dataSiswa->account_created_at
                        ? \Carbon\Carbon::parse($dataSiswa->account_created_at)->locale('id')->translatedFormat('d F Y')
                        : '-' }}
                </div>
            </div>

            <div class="info-item">
                <div class="info-label">Nomor WhatsApp</div>
                <div class="info-value">{{ $nomorWhatsappDisplay ?: 'Belum tersedia' }}</div>
            </div>

            <div class="info-item">
                <div class="info-label">Izin Notifikasi WhatsApp</div>
                <div class="info-value">
                    {{ $dataSiswa->whatsapp_consent ? 'Diizinkan' : 'Belum diizinkan' }}
                </div>
            </div>
        </div>

        <div class="contact-row">
            <div class="w-100">
                <div class="contact-title mb-2">Riwayat Kelas per Tahun Ajaran</div>
                @if (! empty($riwayatKelas) && count($riwayatKelas) > 0)
                    <div class="d-flex flex-wrap gap-2">
                        @foreach ($riwayatKelas as $rk)
                            <span class="badge rounded-pill px-3 py-2" style="background: {{ $rk->tahun_ajaran === $dataSiswa->tahun_ajaran && $rk->nama_kelas === $dataSiswa->nama_kelas ? 'var(--ca-primary-soft)' : '#f4f7f6' }}; color: {{ $rk->tahun_ajaran === $dataSiswa->tahun_ajaran && $rk->nama_kelas === $dataSiswa->nama_kelas ? 'var(--ca-primary-dark)' : '#526560' }}; border: 1px solid #dce6e3; font-weight: 600; font-size: 0.85rem;">
                                <i class="bi bi-door-open me-1"></i>
                                {{ $rk->nama_kelas }} · {{ $rk->tahun_ajaran }}
                                @if ($rk->tahun_ajaran === $dataSiswa->tahun_ajaran && $rk->nama_kelas === $dataSiswa->nama_kelas)
                                    <span class="ms-1">(Saat Ini)</span>
                                @else
                                    <span class="ms-1 text-muted">(Arsip)</span>
                                @endif
                            </span>
                        @endforeach
                    </div>
                @else
                    <div class="contact-copy">Belum ada catatan riwayat kelas.</div>
                @endif
            </div>
        </div>

        <div class="contact-row">
            <div>
                <div class="contact-title">Kontak WhatsApp Siswa</div>

                <div class="contact-copy">
                    WhatsApp hanya digunakan untuk pemberitahuan atau ajakan komunikasi. Informasi sensitif tetap disampaikan melalui CurhatAman atau layanan BK yang sesuai.
                </div>
            </div>

            @if ($dataSiswa->whatsapp_number)
                <a
                    href="{{ $whatsappUrl }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="whatsapp-button"
                >
                    <i class="bi bi-whatsapp"></i>
                    Hubungi via WhatsApp
                </a>
            @else
                <span class="contact-copy">
                    Nomor WhatsApp belum tersedia.
                </span>
            @endif
        </div>
    </section>

    <section class="activity-card">
        <div class="section-title">Ringkasan Aktivitas Siswa</div>
        <div class="section-copy">Ringkasan jumlah aktivitas tanpa membuka isi sensitif secara langsung.</div>

        <div class="activity-grid">
            <div class="activity-item">
                <span class="activity-icon">
                    <i class="bi bi-clipboard2-check"></i>
                </span>

                <div class="activity-value">{{ $aktivitas['skrining_total'] }}</div>
                <div class="activity-label">Skrining selesai</div>
            </div>

            <div class="activity-item">
                <span class="activity-icon">
                    <i class="bi bi-file-earmark-text"></i>
                </span>

                <div class="activity-value">{{ $aktivitas['laporan_total'] }}</div>
                <div class="activity-label">Laporan terkirim</div>
            </div>

            <div class="activity-item">
                <span class="activity-icon">
                    <i class="bi bi-chat-square-text"></i>
                </span>

                <div class="activity-value">{{ $aktivitas['bantuan_total'] }}</div>
                <div class="activity-label">Permintaan bantuan</div>
            </div>

            <div class="activity-item">
                <span class="activity-icon">
                    <i class="bi bi-life-preserver"></i>
                </span>

                <div class="activity-value">{{ $aktivitas['rujukan_total'] }}</div>
                <div class="activity-label">
                    Rujukan · {{ $aktivitas['rujukan_aktif'] }} aktif
                </div>
            </div>

            <div class="activity-item">
                <span class="activity-icon">
                    <i class="bi bi-journal-bookmark"></i>
                </span>

                <div class="activity-value">{{ $aktivitas['catatan_konseling_total'] ?? 0 }}</div>
                <div class="activity-label">
                    Catatan konseling
                </div>
            </div>
        </div>

        @if ($aktivitas['skrining_terakhir'])
            <div class="section-copy mt-3">
                Skrining terakhir selesai
                {{ \Carbon\Carbon::parse($aktivitas['skrining_terakhir'])->locale('id')->translatedFormat('d F Y, H:i') }} WIB.
            </div>
        @endif

        <div class="module-actions">
            <a
                href="{{ route('guru-bk.catatan-konseling.create', ['siswa_id' => $dataSiswa->id]) }}"
                class="module-link text-white"
                style="background: var(--ca-primary);"
            >
                <i class="bi bi-plus-circle"></i>
                Catat Sesi Konseling
            </a>

            <a
                href="{{ route('guru-bk.catatan-konseling.index', ['siswa_id' => $dataSiswa->id]) }}"
                class="module-link"
            >
                <i class="bi bi-journal-bookmark"></i>
                Jurnal Konseling
            </a>

            <a
                href="{{ route('guru-bk.skrining.index', ['q' => $dataSiswa->nis ?: $dataSiswa->name]) }}"
                class="module-link"
            >
                <i class="bi bi-clipboard2-pulse"></i>
                Riwayat Skrining
            </a>

            <a
                href="{{ route('guru-bk.laporan.index', ['q' => $dataSiswa->nis ?: $dataSiswa->name]) }}"
                class="module-link"
            >
                <i class="bi bi-file-earmark-text"></i>
                Laporan
            </a>

            <a
                href="{{ route('guru-bk.bantuan.index', ['q' => $dataSiswa->nis ?: $dataSiswa->name]) }}"
                class="module-link"
            >
                <i class="bi bi-chat-square-text"></i>
                Permintaan Bantuan
            </a>

            <a
                href="{{ route('guru-bk.rujukan.index', ['q' => $dataSiswa->nis ?: $dataSiswa->name]) }}"
                class="module-link"
            >
                <i class="bi bi-life-preserver"></i>
                Rujukan
            </a>
        </div>
    </section>

    <div class="privacy-note">
        <i class="bi bi-shield-lock"></i>

        <div>
            Data Siswa pada Portal Guru BK bersifat read-only. Jawaban skrining, kronologi laporan, bukti, alasan rujukan, dan catatan penanganan tidak ditampilkan pada halaman profil ini.
        </div>
        </div>
            </div>
        </div>
    </main>
</div>

</body>
</html>

