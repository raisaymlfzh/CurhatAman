@php
    $errors = $errors ?? new \Illuminate\Support\ViewErrorBag();
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kasus Mangkrak | CurhatAman</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
        rel="stylesheet"
    >

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
            --ca-warning: #9a650f;
            --ca-warning-soft: #fff7e8;
            --ca-danger: #b42318;
            --ca-danger-soft: #fff1f0;
            --ca-success: #027a48;
            --ca-success-soft: #ecf8f2;
            --sidebar-width: 272px;
            --topbar-height: 82px;
        }

        * {
            box-sizing: border-box;
        }

        html,
        body {
            min-height: 100%;
        }

        body {
            min-height: 100vh;
            margin: 0;
            color: var(--ca-text);
            background: var(--ca-bg);
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Arial, sans-serif;
            font-size: 14px;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        button,
        input,
        select,
        textarea {
            font: inherit;
        }

        .sidebar {
            position: fixed;
            inset: 0 auto 0 0;
            z-index: 1100;
            width: var(--sidebar-width);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background: #ffffff;
            border-right: 1px solid var(--ca-border);
        }

        .sidebar-brand {
            height: var(--topbar-height);
            padding: 0 24px;
            display: flex;
            align-items: center;
            gap: 12px;
            border-bottom: 1px solid var(--ca-border);
        }

        .brand-symbol {
            width: 42px;
            height: 42px;
            flex: 0 0 42px;
            border-radius: 11px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            background: var(--ca-primary);
            font-size: 18px;
        }

        .brand-name {
            display: block;
            color: var(--ca-primary);
            font-size: 18px;
            line-height: 1.1;
            font-weight: 760;
            letter-spacing: -.015em;
        }

        .brand-role {
            display: block;
            margin-top: 4px;
            color: var(--ca-muted);
            font-size: 12px;
        }

        .sidebar-section-label {
            padding: 25px 24px 10px;
            color: var(--ca-muted-light);
            font-size: 10px;
            font-weight: 750;
            letter-spacing: .10em;
            text-transform: uppercase;
        }

        .sidebar-nav {
            padding: 0 14px;
        }

        .sidebar-link {
            min-height: 46px;
            margin-bottom: 4px;
            padding: 0 14px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            gap: 12px;
            color: #475467;
            font-size: 13.5px;
            font-weight: 560;
            transition: background .15s ease, color .15s ease;
        }

        .sidebar-link i {
            width: 20px;
            color: #667085;
            font-size: 16px;
            text-align: center;
        }

        .sidebar-link:hover {
            color: var(--ca-primary-dark);
            background: #f5f8f8;
        }

        .sidebar-link:hover i {
            color: var(--ca-primary);
        }

        .sidebar-link.active {
            color: var(--ca-primary-dark);
            background: var(--ca-primary-soft);
            font-weight: 680;
        }

        .sidebar-link.active i {
            color: var(--ca-primary-dark);
        }

        .sidebar-spacer {
            flex: 1;
        }

        .sidebar-account {
            padding: 16px;
            border-top: 1px solid var(--ca-border);
        }

        .logout-button {
            width: 100%;
            min-height: 42px;
            padding: 0 13px;
            border: 0;
            border-radius: 9px;
            display: flex;
            align-items: center;
            gap: 11px;
            color: var(--ca-danger);
            background: transparent;
            font-size: 13px;
            font-weight: 560;
            text-align: left;
        }

        .logout-button:hover {
            background: var(--ca-danger-soft);
        }

        .topbar {
            position: fixed;
            top: 0;
            right: 0;
            left: var(--sidebar-width);
            z-index: 1000;
            height: var(--topbar-height);
            padding: 0 34px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
            background: rgba(255, 255, 255, .98);
            border-bottom: 1px solid var(--ca-border);
        }

        .topbar-left {
            min-width: 0;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .mobile-sidebar-button {
            display: none;
            width: 38px;
            height: 38px;
            border: 1px solid var(--ca-border);
            border-radius: 9px;
            align-items: center;
            justify-content: center;
            color: var(--ca-text);
            background: #ffffff;
        }

        .topbar-title {
            color: var(--ca-text);
            font-size: 17px;
            line-height: 1.2;
            font-weight: 720;
        }

        .topbar-subtitle {
            margin-top: 4px;
            color: var(--ca-muted);
            font-size: 12px;
        }

        .topbar-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .date-chip {
            height: 38px;
            padding: 0 13px;
            border: 1px solid var(--ca-border);
            border-radius: 9px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--ca-muted);
            background: #ffffff;
            font-size: 12px;
            white-space: nowrap;
        }

        .date-chip i {
            color: var(--ca-primary-dark);
        }

        .account-trigger {
            min-width: 205px;
            height: 50px;
            padding: 5px 10px 5px 6px;
            border: 1px solid transparent;
            border-radius: 11px;
            display: flex;
            align-items: center;
            gap: 10px;
            color: inherit;
            background: transparent;
            cursor: pointer;
            transition: background .15s ease, border-color .15s ease, box-shadow .15s ease, color .15s ease;
        }

        .account-trigger:hover,
        .account-trigger:focus-visible {
            color: var(--ca-primary-dark);
            background: #f2faf8;
            border-color: #cfe6e2;
            outline: none;
        }

        .account-trigger:focus-visible {
            box-shadow: 0 0 0 3px rgba(15, 138, 131, .10);
        }

        .account-copy {
            min-width: 0;
            flex: 1;
        }

        .account-name {
            max-width: 135px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            color: var(--ca-text);
            font-size: 12.5px;
            font-weight: 680;
        }

        .account-role {
            color: var(--ca-muted-light);
            font-size: 10.5px;
        }

        .account-chevron {
            margin-left: auto;
            color: var(--ca-muted-light);
            font-size: 11px;
            transition: color .15s ease, transform .15s ease;
        }

        .account-trigger:hover .account-chevron,
        .account-trigger:focus-visible .account-chevron {
            color: var(--ca-primary);
            transform: translateX(2px);
        }

        .topbar-avatar {
            width: 36px;
            height: 36px;
            flex: 0 0 36px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: var(--ca-primary-dark);
            background: #dcefeb;
            font-size: 11.5px;
            font-weight: 760;
        }

        .main-content {
            min-height: 100vh;
            margin-left: var(--sidebar-width);
            padding-top: var(--topbar-height);
        }

        .page-body {
            padding: 30px 34px 38px;
        }

        .content-shell {
            width: 100%;
            max-width: 1240px;
            margin: 0 auto;
        }

        .back-link {
            margin-bottom: 16px;
            display: inline-flex;
            align-items: center;
            gap: 7px;
            color: var(--ca-primary-dark);
            font-size: 11.5px;
            font-weight: 650;
        }

        .back-link:hover {
            color: var(--ca-primary);
        }

        .page-header {
            margin-bottom: 22px;
            padding: 21px 22px;
            border-radius: 12px;
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 24px;
            background: var(--ca-primary);
        }

        .page-kicker {
            margin-bottom: 6px;
            color: rgba(255, 255, 255, .72);
            font-size: 10.5px;
            font-weight: 760;
            letter-spacing: .09em;
            text-transform: uppercase;
        }

        .page-title {
            margin: 0;
            color: #ffffff;
            font-size: 27px;
            line-height: 1.25;
            font-weight: 760;
            letter-spacing: -.025em;
        }

        .page-copy {
            max-width: 820px;
            margin: 7px 0 0;
            color: rgba(255, 255, 255, .82);
            font-size: 12.5px;
            line-height: 1.65;
        }

        .stale-badge {
            min-height: 36px;
            padding: 0 12px;
            border: 1px solid rgba(255, 255, 255, .42);
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #ffffff;
            background: rgba(154, 101, 15, .30);
            font-size: 10.5px;
            font-weight: 700;
            white-space: nowrap;
        }

        .grid {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 330px;
            gap: 20px;
            align-items: start;
        }

        .grid > div:last-child {
            position: sticky;
            top: calc(var(--topbar-height) + 18px);
        }

        .panel {
            margin-bottom: 18px;
            border: 1px solid var(--ca-border);
            border-top: 3px solid var(--ca-primary);
            border-radius: 12px;
            background: #ffffff;
            overflow: hidden;
        }

        .panel.warning-accent {
            border-top-color: #d99a2b;
        }

        .panel-header {
            padding: 16px 18px;
            border-bottom: 1px solid var(--ca-line);
            background: #ffffff;
        }

        .panel-title {
            margin: 0;
            color: var(--ca-text);
            font-size: 13.5px;
            font-weight: 710;
        }

        .panel-subtitle {
            margin-top: 4px;
            color: var(--ca-muted);
            font-size: 10.5px;
        }

        .panel-body {
            padding: 18px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 10px;
        }

        .info-item {
            min-height: 72px;
            padding: 11px 12px;
            border: 1px solid var(--ca-line);
            border-radius: 9px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: #fbfcfc;
        }

        .info-label {
            color: var(--ca-muted-light);
            font-size: 9px;
            font-weight: 650;
            letter-spacing: .035em;
            text-transform: uppercase;
        }

        .info-value {
            margin-top: 5px;
            color: #344054;
            font-size: 11.5px;
            font-weight: 650;
            line-height: 1.5;
            overflow-wrap: anywhere;
        }

        .description {
            padding: 13px 14px;
            border: 1px solid var(--ca-line);
            border-radius: 9px;
            color: #475467;
            background: #fbfcfc;
            font-size: 11.5px;
            line-height: 1.7;
            white-space: pre-line;
            overflow-wrap: anywhere;
        }

        .evidence-item {
            padding: 10px 12px;
            border: 1px solid var(--ca-line);
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            background: #fbfcfc;
        }

        .evidence-item + .evidence-item {
            margin-top: 8px;
        }

        .evidence-link {
            flex: 0 0 auto;
            padding: 6px 9px;
            border: 1px solid #cfe4e1;
            border-radius: 7px;
            color: var(--ca-primary-dark);
            background: #f5faf9;
            font-size: 9.5px;
            font-weight: 680;
        }

        .evidence-link:hover {
            color: var(--ca-primary-dark);
            background: var(--ca-primary-soft);
        }

        .follow-item {
            padding: 12px 13px;
            border: 1px solid var(--ca-line);
            border-radius: 9px;
            background: #fbfcfc;
        }

        .follow-item + .follow-item {
            margin-top: 8px;
        }

        .follow-title {
            color: #344054;
            font-size: 11.5px;
            font-weight: 680;
        }

        .follow-meta {
            margin-top: 3px;
            color: var(--ca-muted-light);
            font-size: 9.5px;
        }

        .follow-copy {
            margin-top: 7px;
            padding-top: 7px;
            border-top: 1px solid var(--ca-line);
            color: #667085;
            font-size: 10.5px;
            line-height: 1.6;
            white-space: pre-line;
        }

        .panel-body > .text-muted.small {
            display: block;
            padding: 16px 14px;
            border: 1px dashed #d8e0e0;
            border-radius: 9px;
            color: #7b8794 !important;
            background: #fbfcfc;
            text-align: center;
            font-size: 10.5px !important;
        }

        .reassign-select {
            min-height: 44px;
            border: 1px solid var(--ca-border);
            border-radius: 9px;
            color: var(--ca-text);
            background-color: #ffffff;
            font-size: 12px;
            box-shadow: none;
        }

        .reassign-select:focus {
            border-color: rgba(15, 138, 131, .55);
            box-shadow: 0 0 0 .2rem rgba(15, 138, 131, .08);
        }

        .reassign-help {
            margin-top: 10px;
            padding: 10px 11px;
            border-radius: 8px;
            color: #667085;
            background: #f8fafb;
            font-size: 10px;
            line-height: 1.55;
        }

        .btn-reassign {
            width: 100%;
            min-height: 44px;
            margin-top: 12px;
            border: 1px solid var(--ca-primary);
            border-radius: 9px;
            color: #ffffff;
            background: var(--ca-primary);
            font-size: 12px;
            font-weight: 680;
            transition: background .15s ease, border-color .15s ease;
        }

        .btn-reassign:hover {
            color: #ffffff;
            background: var(--ca-primary-dark);
            border-color: var(--ca-primary-dark);
        }

        .access-note {
            margin: 0;
            padding: 13px 14px;
            border: 1px solid #d7e9e6;
            border-radius: 9px;
            display: flex;
            gap: 10px;
            color: var(--ca-muted);
            background: #f6fbfa;
            font-size: 10.5px;
            line-height: 1.6;
        }

        .access-note i {
            margin-top: 1px;
            color: var(--ca-primary);
        }

        .error-copy {
            margin-top: 6px;
            color: var(--ca-danger);
            font-size: 10px;
        }

        .page-footer {
            min-height: 64px;
            margin-top: 28px;
            padding: 0 18px;
            border-radius: 11px;
            display: flex;
            align-items: center;
            color: rgba(255, 255, 255, .78);
            background: var(--ca-primary-dark);
            font-size: 10.5px;
        }

        .sidebar-overlay {
            position: fixed;
            inset: 0;
            z-index: 1050;
            display: none;
            background: rgba(16, 24, 40, .32);
        }

        .sidebar-overlay.show {
            display: block;
        }

        @media (max-width: 991.98px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform .2s ease;
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .topbar {
                left: 0;
                padding: 0 20px;
            }

            .mobile-sidebar-button {
                display: inline-flex;
            }

            .main-content {
                margin-left: 0;
            }

            .page-body {
                padding: 24px 20px 32px;
            }

            .page-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .grid {
                grid-template-columns: 1fr;
            }

            .grid > div:last-child {
                position: static;
            }
        }

        @media (max-width: 767.98px) {
            :root {
                --topbar-height: 74px;
            }

            .date-chip,
            .account-copy,
            .account-chevron {
                display: none;
            }

            .account-trigger {
                min-width: 0;
                width: 42px;
                height: 42px;
                padding: 3px;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }

            .stale-badge {
                white-space: normal;
            }

            .evidence-item {
                align-items: flex-start;
                flex-direction: column;
            }
        }
    </style>
    @include('admin.partials.styles')
</head>

<body>

@php
    $namaUser = $user->name;

    $inisial = collect(explode(' ', trim($namaUser)))
        ->filter()
        ->take(2)
        ->map(fn ($bagian) => mb_strtoupper(mb_substr($bagian, 0, 1)))
        ->implode('');
@endphp

@include('admin.partials.sidebar')

<div class="sidebar-overlay" id="sidebarOverlay"></div>

<header class="topbar">
    <div class="topbar-left">
        <button type="button" class="mobile-sidebar-button" id="openSidebarButton" aria-label="Buka menu">
            <i class="bi bi-list"></i>
        </button>

        <div>
            <div class="topbar-title">
            Detail Kasus Mangkrak
        </div>
        <div class="topbar-subtitle">
            Akses pengawasan read-only
        </div>
    </div>

    </div>

    <div class="topbar-actions">

            @include('admin.partials.notification-bell')
        <div class="date-chip">
            <i class="bi bi-calendar3"></i>
            {{ now()->locale('id')->translatedFormat('d F Y') }}
        </div>

        <a
            href="{{ route('admin.profil.index') }}"
            class="account-trigger"
        >
            <span class="topbar-avatar">{{ $inisial }}</span>
            <span class="account-copy">
                <span class="account-name d-block">
                    {{ $namaUser }}
                </span>
                <span class="account-role d-block">
                    Wakil Kesiswaan / Admin
                </span>
            </span>

            <i class="bi bi-chevron-right account-chevron"></i>
        </a>
    </div>
</header>

<main class="main-content">
    <div class="page-body">
        <div class="content-shell">

            <a
                href="{{ route('admin.kasus-mangkrak.index') }}"
                class="back-link"
            >
                <i class="bi bi-arrow-left"></i>
                Kembali ke Kasus Mangkrak
            </a>

            <section class="page-header">
                <div>
                    <div class="page-kicker">
                        Memerlukan Perhatian
                    </div>

                    <h1 class="page-title">
                        {{ $detail->kode_laporan }}
                    </h1>

                    <p class="page-copy">
                        Kasus belum diperbarui selama
                        {{ $detail->hari_tidak_diperbarui }} hari.
                        Batas sistem saat ini adalah
                        {{ $staleDays }} hari.
                    </p>
                </div>

                <div class="stale-badge">
                    <i class="bi bi-hourglass-split"></i>
                    {{ $detail->hari_tidak_diperbarui }} hari
                </div>
            </section>

            <div class="grid">

                <div>

                    <section class="panel warning-accent">
                        <div class="panel-header">
                            <h2 class="panel-title">
                                Identitas & Informasi Kasus
                            </h2>
                            <div class="panel-subtitle">
                                Detail kasus mangkrak untuk pengawasan Admin
                            </div>
                        </div>

                        <div class="panel-body">
                            <div class="info-grid">

                                <div class="info-item">
                                    <div class="info-label">Pelapor</div>
                                    <div class="info-value">
                                        {{ $detail->nama_siswa }}
                                    </div>
                                </div>

                                <div class="info-item">
                                    <div class="info-label">NIS</div>
                                    <div class="info-value">
                                        {{ $detail->nis ?: '—' }}
                                    </div>
                                </div>

                                <div class="info-item">
                                    <div class="info-label">Kelas</div>
                                    <div class="info-value">
                                        {{ $detail->nama_kelas ?: '—' }}
                                        @if($detail->tahun_ajaran)
                                            · {{ $detail->tahun_ajaran }}
                                        @endif
                                    </div>
                                </div>

                                <div class="info-item">
                                    <div class="info-label">Kategori</div>
                                    <div class="info-value">
                                        {{ $detail->nama_kategori }}
                                    </div>
                                </div>

                                <div class="info-item">
                                    <div class="info-label">Status Kasus</div>
                                    <div class="info-value">
                                        {{ ucfirst($detail->status_kasus) }}
                                    </div>
                                </div>

                                <div class="info-item">
                                    <div class="info-label">Guru BK</div>
                                    <div class="info-value">
                                        {{ $detail->nama_bk_penanggung_jawab
                                            ?: 'Belum ditugaskan' }}
                                    </div>
                                </div>

                                <div class="info-item">
                                    <div class="info-label">
                                        Terakhir Diperbarui
                                    </div>
                                    <div class="info-value">
                                        {{ \Carbon\Carbon::parse($detail->updated_at)
                                            ->locale('id')
                                            ->translatedFormat('d F Y, H:i') }}
                                    </div>
                                </div>

                                <div class="info-item">
                                    <div class="info-label">
                                        Kerahasiaan
                                    </div>
                                    <div class="info-value">
                                        {{ $detail->status_rahasia
                                            ? 'Rahasia'
                                            : 'Biasa' }}
                                    </div>
                                </div>

                            </div>
                        </div>
                    </section>

                    <section class="panel">
                        <div class="panel-header">
                            <h2 class="panel-title">
                                Kronologi Laporan
                            </h2>
                            <div class="panel-subtitle">
                                Read-only
                            </div>
                        </div>

                        <div class="panel-body">
                            <div class="description">
                                {{ $detail->deskripsi }}
                            </div>
                        </div>
                    </section>

                    <section class="panel">
                        <div class="panel-header">
                            <h2 class="panel-title">
                                Bukti Pendukung
                            </h2>
                            <div class="panel-subtitle">
                                Lampiran laporan
                            </div>
                        </div>

                        <div class="panel-body">
                            @forelse($bukti as $item)
                                <div class="evidence-item">
                                    <div class="fw-semibold small">
                                        {{ $item->original_name }}
                                    </div>

                                    <a
                                        href="{{ asset(
                                            'storage/' . $item->file_path
                                        ) }}"
                                        target="_blank"
                                        rel="noopener"
                                        class="evidence-link"
                                    >
                                        Lihat bukti
                                        <i class="bi bi-box-arrow-up-right"></i>
                                    </a>
                                </div>
                            @empty
                                <div class="text-muted small">
                                    Tidak ada bukti pendukung.
                                </div>
                            @endforelse
                        </div>
                    </section>

                    <section class="panel">
                        <div class="panel-header">
                            <h2 class="panel-title">
                                Riwayat Tindak Lanjut
                            </h2>
                            <div class="panel-subtitle">
                                Tidak dapat diedit oleh Admin
                            </div>
                        </div>

                        <div class="panel-body">
                            @forelse($tindakLanjut as $item)
                                <div class="follow-item">
                                    <div class="follow-title">
                                        {{ $item->status }}
                                    </div>

                                    <div class="follow-meta">
                                        {{ $item->nama_petugas }}
                                        ·
                                        {{ \Carbon\Carbon::parse($item->tanggal)
                                            ->locale('id')
                                            ->translatedFormat('d M Y, H:i') }}
                                    </div>

                                    <div class="follow-copy">
                                        {{ $item->catatan }}
                                    </div>
                                </div>
                            @empty
                                <div class="text-muted small">
                                    Belum ada tindak lanjut.
                                </div>
                            @endforelse
                        </div>
                    </section>

                </div>

                <div>

                    <section class="panel">
                        <div class="panel-header">
                            <h2 class="panel-title">
                                Alih Penanganan
                            </h2>
                            <div class="panel-subtitle">
                                Intervensi kasus mangkrak
                            </div>
                        </div>

                        <div class="panel-body">

                            @if($guruBkTersedia->isEmpty())

                                <div class="text-muted small">
                                    Tidak ada Guru BK aktif lain
                                    yang tersedia saat ini.
                                </div>

                            @else

                                <form
                                    method="POST"
                                    action="{{ route(
                                        'admin.kasus-mangkrak.reassign',
                                        $detail->id
                                    ) }}"
                                    onsubmit="return confirm(
                                        'Alihkan kasus mangkrak ini ke Guru BK yang dipilih?'
                                    )"
                                >
                                    @csrf
                                    @method('PATCH')

                                    <label
                                        for="assigned_bk_id"
                                        class="form-label small fw-semibold"
                                    >
                                        Guru BK Baru
                                    </label>

                                    <select
                                        name="assigned_bk_id"
                                        id="assigned_bk_id"
                                        class="form-select reassign-select
                                            @error('assigned_bk_id')
                                                is-invalid
                                            @enderror"
                                        required
                                    >
                                        <option value="">
                                            Pilih Guru BK
                                        </option>

                                        @foreach($guruBkTersedia as $guruBk)
                                            <option
                                                value="{{ $guruBk->id }}"
                                                @selected(
                                                    old('assigned_bk_id')
                                                    == $guruBk->id
                                                )
                                            >
                                                {{ $guruBk->name }}
                                                — {{ $guruBk->email }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('assigned_bk_id')
                                        <div class="error-copy">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                    <div class="reassign-help">
                                        Guru BK yang telah menyatakan
                                        konflik kepentingan pada kasus ini
                                        tidak ditampilkan. Pengalihan akan
                                        memperbarui waktu kasus sehingga
                                        status mangkrak dihitung ulang.
                                    </div>

                                    <button
                                        type="submit"
                                        class="btn-reassign"
                                    >
                                        <i class="bi bi-person-gear me-1"></i>
                                        Alihkan Penanganan
                                    </button>
                                </form>

                            @endif

                        </div>
                    </section>

                    <section class="panel">
                        <div class="panel-header">
                            <h2 class="panel-title">
                                Batas Akses Admin
                            </h2>
                        </div>

                        <div class="panel-body">
                            <div class="access-note">
                                <i class="bi bi-info-circle"></i>
                                <div>
                                    Admin dapat membuka detail kasus
                                    yang terdeteksi mangkrak untuk
                                    pengawasan dan pengalihan penanganan.
                                    Isi laporan dan catatan tindak lanjut
                                    tetap read-only.
                                </div>
                            </div>
                        </div>
                    </section>

                </div>

            </div>

            <footer class="page-footer">
                <div class="d-flex flex-column flex-md-row justify-content-between gap-2 w-100">
                    <span>© {{ date('Y') }} CurhatAman</span>
                    <span>Portal Admin Sekolah · Detail kasus mangkrak</span>
                </div>
            </footer>

        </div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    const sidebar = document.getElementById('adminSidebar');
    const overlay = document.getElementById('sidebarOverlay');
    const openButton = document.getElementById('openSidebarButton');

    function closeSidebar() {
        sidebar?.classList.remove('show');
        overlay?.classList.remove('show');
    }

    openButton?.addEventListener('click', function () {
        sidebar?.classList.add('show');
        overlay?.classList.add('show');
    });

    overlay?.addEventListener('click', closeSidebar);

    window.addEventListener('resize', function () {
        if (window.innerWidth >= 992) {
            closeSidebar();
        }
    });
</script>

</body>
</html>
