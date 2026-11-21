<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >
    <title>Dashboard Guru BK - CurhatAman</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
        rel="stylesheet"
    >
    <style>
        :root {
            --ca-primary: #0f8a83;
            --ca-primary-dark: #0b6f69;
            --ca-primary-soft: #eaf6f4;
            --ca-text: #172033;
            --ca-muted: #667085;
            --ca-bg: #f6f8f9;
            --ca-surface: #ffffff;
            --ca-border: #e3e9e9;
            --sidebar-width: 252px;
            --topbar-height: 72px;
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
            font-family:
                system-ui,
                -apple-system,
                "Segoe UI",
                Roboto,
                "Helvetica Neue",
                Arial,
                sans-serif;
            font-size: .9rem;
        }

        a {
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
            display: flex;
            flex-direction: column;
            padding: 20px 16px;
            background: #ffffff;
            border-right: 1px solid var(--ca-border);
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            min-height: 48px;
            margin-bottom: 30px;
            padding: 0 8px;
        }

        .brand-symbol {
            width: 40px;
            height: 40px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            border-radius: 10px;
            color: #ffffff;
            background: var(--ca-primary);
            box-shadow: 0 4px 12px rgba(15, 138, 131, .12);
            font-size: 1.08rem;
        }

        .brand-copy {
            min-width: 0;
        }

        .brand-name {
            display: block;
            color: var(--ca-primary);
            font-size: 1.08rem;
            font-weight: 750;
            letter-spacing: -.25px;
        }

        .brand-role {
            display: block;
            margin-top: 1px;
            color: var(--ca-muted);
            font-size: 11px;
            font-weight: 600;
        }

        .sidebar-section-label {
            margin: 0 10px 9px;
            color: #98a2b3;
            font-size: 11px;
            font-weight: 750;
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        .sidebar-nav {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 11px;
            min-height: 42px;
            padding: 10px 11px;
            border-radius: 9px;
            color: #475467;
            font-size: 13px;
            font-weight: 560;
            transition: background .16s ease, color .16s ease;
        }

        .sidebar-link i {
            width: 19px;
            color: #7b8795;
            font-size: .93rem;
            text-align: center;
        }

        .sidebar-link:hover {
            color: var(--ca-primary-dark);
            background: #f4f9f8;
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
            color: var(--ca-primary);
        }

        .sidebar-link.disabled {
            cursor: default;
            color: #667085;
        }

        .sidebar-link.disabled:hover {
            color: #667085;
            background: transparent;
        }

        .sidebar-link.disabled:hover i {
            color: #7b8795;
        }

        .sidebar-spacer {
            flex: 1;
        }

        .sidebar-account {
            margin-top: 24px;
            padding-top: 18px;
            border-top: 1px solid #edf1f1;
        }

        .sidebar-user {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 0 8px 12px;
        }

        .sidebar-avatar {
            width: 36px;
            height: 36px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            border-radius: 50%;
            color: var(--ca-primary-dark);
            background: #dcefeb;
            font-size: 14px;
            font-weight: 750;
        }

        .sidebar-user-copy {
            min-width: 0;
        }

        .sidebar-user-name {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            color: var(--ca-text);
            font-size: .86rem;
            font-weight: 680;
        }

        .sidebar-user-role {
            margin-top: 1px;
            color: var(--ca-muted);
            font-size: 12px;
        }

        .logout-button {
            width: 100%;
            display: flex;
            align-items: center;
            gap: 10px;
            min-height: 40px;
            padding: 9px 11px;
            border: 0;
            border-radius: 9px;
            color: #b42318;
            background: transparent;
            font-size: .86rem;
            font-weight: 560;
            text-align: left;
        }

        .logout-button:hover {
            background: #fff3f2;
        }

        .topbar {
            grid-column: 2;
            min-width: 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            padding: 0 28px;
            background: rgba(255, 255, 255, .98);
            border-bottom: 1px solid var(--ca-border);
        }

        .topbar-title {
            margin-bottom: 1px;
            color: var(--ca-text);
            font-size: .92rem;
            font-weight: 680;
        }

        .topbar-subtitle {
            color: var(--ca-muted);
            font-size: 11.5px;
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
            color: #596579;
            background: #ffffff;
            font-size: 12px;
            font-weight: 550;
            white-space: nowrap;
        }

        .date-chip i {
            color: var(--ca-primary-dark);
            font-size: 13px;
        }

        .account-trigger {
            height: 38px;
            padding: 0 4px;
            border: 0;
            border-radius: 9px;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            color: var(--ca-text);
            background: transparent;
            text-align: left;
            text-decoration: none;
            transition: background .15s ease;
        }

        .account-trigger:hover {
            background: rgba(0, 0, 0, 0.03);
            border-color: transparent;
        }

        .topbar-avatar {
            width: 30px;
            height: 30px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            border-radius: 50%;
            color: var(--ca-primary-dark);
            background: #dcefeb;
            font-size: 12px;
            font-weight: 750;
        }

        .account-copy {
            min-width: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .account-name {
            max-width: 120px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            color: var(--ca-text);
            font-size: 12px;
            font-weight: 700;
            line-height: 1.2;
        }

        .account-role {
            margin-top: 1px;
            color: var(--ca-muted);
            font-size: 10.5px;
            line-height: 1;
        }

        .account-chevron {
            color: #98a2b3;
            font-size: 10px;
            margin-left: 2px;
        }

        .main-content {
            grid-column: 2;
            min-width: 0;
            display: flex;
            flex-direction: column;
        }

        .page-body {
            flex: 1;
            padding: 28px;
        }

        .content-shell {
            max-width: 1280px;
            margin: 0 auto;
        }

        .welcome-banner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
            padding: 24px 26px;
            margin-bottom: 22px;
            border: 1px solid var(--ca-primary);
            border-radius: 14px;
            background: var(--ca-primary);
        }

        .banner-kicker {
            margin-bottom: 6px;
            color: rgba(255, 255, 255, .82);
            font-size: 11px;
            font-weight: 750;
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        .banner-title {
            margin-bottom: 7px;
            color: #ffffff;
            font-size: 22px;
            font-weight: 760;
            letter-spacing: -.35px;
        }

        .banner-copy {
            max-width: 690px;
            margin-bottom: 0;
            color: rgba(255, 255, 255, .92);
            font-size: 13px;
            line-height: 1.55;
        }

        .banner-symbol {
            width: 58px;
            height: 58px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            border: 1px solid rgba(255, 255, 255, .38);
            border-radius: 14px;
            color: #ffffff;
            background: rgba(255, 255, 255, .12);
            box-shadow: none;
            font-size: 1.2rem;
        }

        .metric-card {
            height: 100%;
            padding: 18px;
            border: 1px solid var(--ca-border);
            border-radius: 12px;
            background: var(--ca-surface);
            box-shadow: 0 3px 10px rgba(15, 23, 42, .018);
        }

        .metric-card.priority {
            border-color: #b7dcd7;
            background: #f0f8f7;
        }

        .metric-top {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 12px;
        }

        .metric-label {
            color: var(--ca-muted);
            font-size: 12px;
            font-weight: 620;
        }

        .metric-icon {
            width: 35px;
            height: 35px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            border-radius: 9px;
            color: var(--ca-primary-dark);
            background: var(--ca-primary-soft);
            font-size: .86rem;
        }

        .metric-card.priority .metric-icon {
            color: #ffffff;
            background: var(--ca-primary);
        }

        .metric-value {
            margin: 12px 0 5px;
            color: var(--ca-text);
            font-size: 26px;
            font-weight: 760;
            line-height: 1;
        }

        .metric-note {
            color: #8a94a3;
            font-size: 11.5px;
        }

        .content-card {
            overflow: hidden;
            border: 1px solid var(--ca-border);
            border-radius: 12px;
            background: var(--ca-surface);
            box-shadow: 0 3px 10px rgba(15, 23, 42, .018);
        }

        .content-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            padding: 17px 18px;
            border-bottom: 1px solid #edf1f1;
        }

        .content-title {
            margin-bottom: 2px;
            color: var(--ca-text);
            font-size: 14px;
            font-weight: 700;
        }

        .content-subtitle {
            color: var(--ca-muted);
            font-size: 11.5px;
        }

        .report-table {
            margin-bottom: 0;
        }

        .report-table thead th {
            padding: 11px 16px;
            border-bottom: 1px solid #edf1f1;
            color: #7b8795;
            background: #fbfcfc;
            font-size: 11px;
            font-weight: 750;
            letter-spacing: .045em;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .report-table tbody td {
            padding: 13px 16px;
            border-color: #edf1f1;
            color: #475467;
            font-size: 12.5px;
            vertical-align: middle;
        }

        .report-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .report-code {
            color: var(--ca-text);
            font-size: 12px;
            font-weight: 700;
        }

        .student-name {
            color: var(--ca-text);
            font-size: 12px;
            font-weight: 650;
        }

        .student-class {
            margin-top: 2px;
            color: var(--ca-muted);
            font-size: 11px;
        }

        .privacy-mark {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            margin-top: 3px;
            color: var(--ca-muted);
            font-size: 11px;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 5px 8px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 680;
            white-space: nowrap;
        }

        .status-baru {
            color: #175cd3;
            background: #eff8ff;
        }

        .status-diproses {
            color: #b54708;
            background: #fffaeb;
        }

        .status-selesai {
            color: #027a48;
            background: #ecfdf3;
        }

        .status-dieskalasi {
            color: #b42318;
            background: #fef3f2;
        }

        .status-default {
            color: #475467;
            background: #f2f4f7;
        }

        .summary-panel {
            height: fit-content;
            padding: 18px;
            border: 1px solid var(--ca-border);
            border-radius: 12px;
            background: #ffffff;
            box-shadow: 0 3px 10px rgba(15, 23, 42, .018);
        }

        .summary-title {
            margin-bottom: 14px;
            color: var(--ca-text);
            font-size: 13px;
            font-weight: 700;
        }

        .summary-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding: 11px 0;
            border-bottom: 1px solid #edf1f1;
        }

        .summary-item:first-of-type {
            padding-top: 0;
        }

        .summary-item:last-of-type {
            padding-bottom: 0;
            border-bottom: 0;
        }

        .summary-item-label {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #475467;
            font-size: 12.5px;
            font-weight: 550;
        }

        .summary-mini-icon {
            width: 29px;
            height: 29px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            color: var(--ca-primary-dark);
            background: var(--ca-primary-soft);
            font-size: 12.5px;
        }

        .summary-item-value {
            color: var(--ca-text);
            font-size: 13px;
            font-weight: 720;
        }

        .privacy-note {
            margin-top: 16px;
            padding: 13px;
            border-radius: 9px;
            color: #46625f;
            background: #f0f8f7;
            font-size: 12.5px;
            line-height: 1.55;
        }

        .privacy-note strong {
            display: block;
            margin-bottom: 4px;
            color: var(--ca-primary-dark);
            font-size: .86rem;
        }

        .btn-dashboard-action {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            height: 30px;
            padding: 0 12px;
            border-radius: 999px;
            font-size: 11.5px;
            font-weight: 650;
            letter-spacing: .01em;
            text-decoration: none;
            white-space: nowrap;
            transition: all .15s ease;
        }

        .btn-dashboard-primary {
            color: #ffffff !important;
            background: var(--ca-primary);
            border: 1px solid var(--ca-primary);
            box-shadow: 0 1px 2px rgba(15, 138, 131, .2);
        }

        .btn-dashboard-primary:hover {
            color: #ffffff !important;
            background: var(--ca-primary-dark);
            border-color: var(--ca-primary-dark);
            transform: translateY(-1px);
        }

        .btn-dashboard-outline {
            color: var(--ca-primary-dark) !important;
            background: var(--ca-primary-soft);
            border: 1px solid #cce8e5;
        }

        .btn-dashboard-outline:hover {
            color: var(--ca-primary-dark) !important;
            background: #ddf1ee;
            border-color: #b7ded9;
            transform: translateY(-1px);
        }

        .btn-table-action {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 600;
            color: var(--ca-primary-dark);
            background: var(--ca-primary-soft);
            border: 1px solid #d4ece9;
            text-decoration: none;
            transition: all .15s ease;
        }

        .btn-table-action:hover {
            color: #ffffff;
            background: var(--ca-primary);
            border-color: var(--ca-primary);
        }

        .badge-layanan {
            display: inline-flex;
            align-items: center;
            padding: 4px 8px;
            border-radius: 6px;
            font-size: .70rem;
            font-weight: 650;
            background: var(--ca-primary-soft);
            color: var(--ca-primary-dark);
        }

        .empty-state {
            padding: 42px 18px;
            text-align: center;
            color: var(--ca-muted);
        }

        .empty-icon {
            width: 40px;
            height: 40px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
            border-radius: 10px;
            color: var(--ca-primary);
            background: var(--ca-primary-soft);
        }

        .page-footer {
            margin-top: 28px;
            padding: 20px 22px;
            border: none;
            border-radius: 12px;
            color: #ffffff;
            background: var(--ca-primary);
            font-size: 11px;
        }

        .page-footer span {
            color: rgba(255, 255, 255, .92);
        }

        .mobile-sidebar-button {
            display: none;
            width: 38px;
            height: 38px;
            align-items: center;
            justify-content: center;
            border: 1px solid var(--ca-border);
            border-radius: 9px;
            color: var(--ca-text);
            background: #ffffff;
        }

        @media (max-width: 991.98px) {

            .app-shell {
                display: block;
            }

            .sidebar {
                position: fixed;
                top: 0;
                bottom: 0;
                left: 0;
                z-index: 1050;
                width: var(--sidebar-width);
                transform: translateX(-100%);
                box-shadow: 14px 0 30px rgba(15, 23, 42, .10);
                transition: transform .2s ease;
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .topbar {
                min-height: var(--topbar-height);
                padding: 0 18px;
            }

            .mobile-sidebar-button {
                display: inline-flex;
            }

            .topbar-left {
                display: flex;
                align-items: center;
                gap: 10px;
            }

            .main-content {
                min-height: calc(100vh - var(--topbar-height));
            }

            .page-body {
                padding: 22px 18px 30px;
            }

        }

        @media (max-width: 575.98px) {

            .date-chip {
                display: none;
            }

            .account-trigger {
                min-width: auto;
                padding: 5px;
            }

            .account-copy,

            .welcome-banner {
                align-items: flex-start;
                padding: 20px;
                flex-direction: column;
            }

            .banner-title {
                font-size: 1.35rem;
            }

            .banner-symbol {
                width: 50px;
                height: 50px;
                font-size: 1.08rem;
            }

        }

        .sidebar-overlay {
            position: fixed;
            inset: 0;
            z-index: 1040;
            display: none;
            background: rgba(15, 23, 42, .28);
        }

        .sidebar-overlay.show {
            display: block;
        }

    </style>
    @include('guru-bk.partials.styles')
</head>

<body>

@php
    $errors = $errors ?? new \Illuminate\Support\ViewErrorBag();
    $namaUser = ucwords($user->name);
    $inisial = strtoupper(substr($user->name, 0, 1));
@endphp
<div class="app-shell">

    @include('guru-bk.partials.sidebar')

    <header class="topbar">
        <div class="topbar-left">
            <button
                type="button"
                class="mobile-sidebar-button"
                id="openSidebarButton"
                aria-label="Buka menu"
            >
                <i class="bi bi-list"></i>
            </button>
            <div>
                <div class="topbar-title">
                    Dashboard
                </div>
                <div class="topbar-subtitle">
                    Ringkasan layanan BK.
                </div>
            </div>
        </div>
        <div class="topbar-actions">
            @include('guru-bk.partials.notification-bell')
            <div class="date-chip">
                <i class="bi bi-calendar3"></i>
                {{ now()->translatedFormat('d F Y') }}
            </div>
            <a
                href="{{ route('guru-bk.profil.index') }}"
                class="account-trigger"
                aria-label="Buka profil Guru BK"
            >
                <span class="topbar-avatar">
                    {{ $inisial }}

                </span>
                <span class="account-copy">
                    <span class="account-name d-block">
                        {{ $namaUser }}

                    </span>
                    <span class="account-role d-block">
                        Guru BK
                    </span>
                </span>
                <i class="bi bi-chevron-right account-chevron"></i>
            </a>
        </div>
    </header>

    <main class="main-content">
        <div class="page-body">
            <div class="content-shell">

                <section class="welcome-banner">
                    <div>
                        <div class="banner-kicker">
                            Portal Guru BK
                        </div>
                        <h1 class="banner-title">
                            Selamat datang, {{ $namaUser }}

                        </h1>
                        <p class="banner-copy">
                            Ringkasan laporan, skrining, dan layanan pendampingan siswa.
                        </p>
                    </div>
                    <span class="banner-symbol">
                        <i class="bi bi-person-heart"></i>
                    </span>
                </section>

                <section class="row g-3 mb-4">
                    <div class="col-6 col-md-4 col-xl">
                        <div class="metric-card priority">
                            <div class="metric-top">
                                <span class="metric-label">
                                    Laporan Baru
                                </span>
                                <span class="metric-icon">
                                    <i class="bi bi-inbox"></i>
                                </span>
                            </div>
                            <div class="metric-value">
                                {{ $laporanBaru }}
                            </div>
                            <div class="metric-note">
                                Menunggu ditinjau
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-4 col-xl">
                        <div class="metric-card">
                            <div class="metric-top">
                                <span class="metric-label">
                                    Sedang Diproses
                                </span>
                                <span class="metric-icon">
                                    <i class="bi bi-arrow-repeat"></i>
                                </span>
                            </div>
                            <div class="metric-value">
                                {{ $laporanDiproses }}
                            </div>
                            <div class="metric-note">
                                Dalam penanganan
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-4 col-xl">
                        <div class="metric-card">
                            <div class="metric-top">
                                <span class="metric-label">
                                    Dieskalasi
                                </span>
                                <span class="metric-icon">
                                    <i class="bi bi-exclamation-triangle"></i>
                                </span>
                            </div>
                            <div class="metric-value">
                                {{ $laporanDieskalasi }}
                            </div>
                            <div class="metric-note">
                                Perhatian lanjutan
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-6 col-xl">
                        <div class="metric-card">
                            <div class="metric-top">
                                <span class="metric-label">
                                    Skrining Bulan Ini
                                </span>
                                <span class="metric-icon">
                                    <i class="bi bi-clipboard2-pulse"></i>
                                </span>
                            </div>
                            <div class="metric-value">
                                {{ $skriningSelesaiBulanIni }}
                            </div>
                            <div class="metric-note">
                                Sesi selesai
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-6 col-xl">
                        <div class="metric-card">
                            <div class="metric-top">
                                <span class="metric-label">
                                    Konseling Bulan Ini
                                </span>
                                <span class="metric-icon" style="color: #0284c7; background: #e0f2fe;">
                                    <i class="bi bi-journal-plus"></i>
                                </span>
                            </div>
                            <div class="metric-value">
                                {{ $konselingBulanIni }}
                            </div>
                            <div class="metric-note">
                                Sesi konseling
                            </div>
                        </div>
                    </div>
                </section>

                <section class="row g-4 align-items-stretch">
                    <div class="col-xl-9">
                        <div class="content-card">
                            <div class="content-card-header d-flex align-items-center justify-content-between flex-wrap gap-2">
                                <div>
                                    <div class="content-title">
                                        Laporan Terbaru
                                    </div>
                                    <div class="content-subtitle">
                                        Laporan kasus terbaru dari siswa.
                                    </div>
                                </div>
                                <div>
                                    <a href="{{ route('guru-bk.laporan.index') }}" class="btn-dashboard-action btn-dashboard-outline">
                                        <i class="bi bi-file-earmark-text"></i>
                                        <span>Semua Laporan</span>
                                    </a>
                                </div>
                            </div>

                            @if ($laporanTerbaru->isEmpty())
                                <div class="empty-state">
                                    <div class="empty-icon">
                                        <i class="bi bi-inbox"></i>
                                    </div>
                                    <div class="fw-semibold mb-1">
                                        Belum Ada Laporan
                                    </div>
                                    <div class="small">
                                        Laporan yang dikirim siswa akan muncul di sini.
                                    </div>
                                </div>

                            @else
                                <div class="table-responsive">
                                    <table class="table report-table">
                                        <thead>
                                            <tr>
                                                <th>Laporan</th>
                                                <th>Pelapor</th>
                                                <th>Kategori</th>
                                                <th>Status</th>
                                                <th>Tanggal</th>
                                                <th class="text-end">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($laporanTerbaru as $laporan)

                                                @php
                                                    $statusClass = match($laporan->status_kasus) {
                                                        'baru' => 'status-baru',
                                                        'diproses' => 'status-diproses',
                                                        'selesai' => 'status-selesai',
                                                        'dieskalasi' => 'status-dieskalasi',
                                                        default => 'status-default',
                                                    };
                                                    $statusLabel = match($laporan->status_kasus) {
                                                        'baru' => 'Baru',
                                                        'diproses' => 'Diproses',
                                                        'selesai' => 'Selesai',
                                                        'dieskalasi' => 'Dieskalasi',
                                                        default => ucfirst($laporan->status_kasus),
                                                    };
                                                @endphp
                                                <tr>
                                                    <td>
                                                        <span class="report-code">
                                                            {{ $laporan->kode_laporan }}

                                                        </span>
                                                    </td>
                                                    <td>
                                                        <div class="student-name">
                                                            {{ $laporan->nama_siswa }}

                                                        </div>

                                                        @if ($laporan->nama_kelas)
                                                            <div class="student-class">
                                                                {{ $laporan->nama_kelas }}

                                                            </div>

                                                        @endif
                                                        <div class="privacy-mark">

                                                            @if ($laporan->status_rahasia)
                                                                <i class="bi bi-shield-lock"></i>
                                                                Laporan rahasia

                                                            @else
                                                                <i class="bi bi-person"></i>
                                                                Identitas asli

                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td>
                                                        {{ $laporan->nama_kategori }}

                                                    </td>
                                                    <td>
                                                        <span class="status-badge {{ $statusClass }}">
                                                            {{ $statusLabel }}

                                                        </span>
                                                    </td>
                                                    <td>
                                                        {{ \Carbon\Carbon::parse($laporan->created_at)->format('d M Y') }}
                                                    </td>
                                                    <td class="text-end">
                                                        <a href="{{ route('guru-bk.laporan.show', $laporan->id) }}" class="btn-table-action">
                                                            <i class="bi bi-eye"></i> Detail
                                                        </a>
                                                    </td>
                                                </tr>

                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            @endif
                        </div>

                        <div class="content-card mt-4">
                            <div class="content-card-header d-flex align-items-center justify-content-between flex-wrap gap-2">
                                <div>
                                    <div class="content-title">
                                        Sesi Konseling Terkini
                                    </div>
                                    <div class="content-subtitle">
                                        Sesi konseling terbaru yang dicatat.
                                    </div>
                                </div>

                                <div class="d-flex align-items-center gap-2">
                                    <a href="{{ route('guru-bk.catatan-konseling.index') }}" class="btn-dashboard-action btn-dashboard-outline">
                                        <i class="bi bi-journal-bookmark"></i>
                                        <span>Buka Jurnal</span>
                                    </a>
                                    <a href="{{ route('guru-bk.catatan-konseling.create') }}" class="btn-dashboard-action btn-dashboard-primary">
                                        <i class="bi bi-plus-lg"></i>
                                        <span>Catat Sesi</span>
                                    </a>
                                </div>
                            </div>

                            @if ($konselingTerbaru->isEmpty())
                                <div class="empty-state">
                                    <div class="empty-icon" style="color: #0284c7; background: #e0f2fe;">
                                        <i class="bi bi-journal-text"></i>
                                    </div>
                                    <div class="fw-semibold mb-1">
                                        Belum Ada Catatan Konseling
                                    </div>
                                    <div class="text-muted small">
                                        Sesi bimbingan dan konseling siswa yang telah dicatat akan tampil di sini.
                                    </div>
                                </div>
                            @else
                                <div class="table-responsive">
                                    <table class="table report-table align-middle">
                                        <thead>
                                            <tr>
                                                <th>Tanggal</th>
                                                <th>Siswa</th>
                                                <th>Layanan</th>
                                                <th>Topik</th>
                                                <th>Guru BK</th>
                                                <th class="text-end">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($konselingTerbaru as $sesi)
                                                <tr>
                                                    <td>
                                                        <span class="report-code">
                                                            {{ \Carbon\Carbon::parse($sesi->tanggal_pertemuan)->format('d M Y') }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <div class="student-name">
                                                            {{ $sesi->nama_siswa }}
                                                        </div>
                                                        @if ($sesi->nama_kelas)
                                                            <div class="student-class">
                                                                {{ $sesi->nama_kelas }}
                                                            </div>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <span class="badge-layanan">
                                                            {{ $sesi->jenis_layanan }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <div class="text-truncate" style="max-width: 220px;" title="{{ $sesi->topik }}">
                                                            {{ $sesi->topik }}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span class="text-muted small">
                                                            {{ $sesi->nama_guru_bk }}
                                                        </span>
                                                    </td>
                                                    <td class="text-end">
                                                        <a href="{{ route('guru-bk.catatan-konseling.show', $sesi->id) }}" class="btn-table-action">
                                                            <i class="bi bi-eye"></i> Detail
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-xl-3">

                        <aside class="summary-panel">
                            <div class="summary-title">
                                Ringkasan
                            </div>
                            <div class="summary-item">
                                <div class="summary-item-label">
                                    <span class="summary-mini-icon">
                                        <i class="bi bi-file-earmark-text"></i>
                                    </span>
                                    Total laporan
                                </div>
                                <span class="summary-item-value">
                                    {{ $totalLaporan }}

                                </span>
                            </div>
                            <div class="summary-item">
                                <div class="summary-item-label">
                                    <span class="summary-mini-icon">
                                        <i class="bi bi-inbox"></i>
                                    </span>
                                    Belum ditinjau
                                </div>
                                <span class="summary-item-value">
                                    {{ $laporanBaru }}

                                </span>
                            </div>
                            <div class="summary-item">
                                <div class="summary-item-label">
                                    <span class="summary-mini-icon">
                                        <i class="bi bi-clipboard2-pulse"></i>
                                    </span>
                                    Skrining selesai
                                </div>
                                <span class="summary-item-value">
                                    {{ $skriningSelesaiBulanIni }}
                                </span>
                            </div>
                            <div class="summary-item">
                                <div class="summary-item-label">
                                    <span class="summary-mini-icon">
                                        <i class="bi bi-journal-bookmark"></i>
                                    </span>
                                    Total konseling
                                </div>
                                <span class="summary-item-value">
                                    {{ $totalKonseling }}
                                </span>
                            </div>
                            <div class="privacy-note">
                                <strong>
                                    <i class="bi bi-shield-check me-1"></i>
                                    Akses Terbatas
                                </strong>
                                Data dikelola secara rahasia sesuai kewenangan Guru BK.
                            </div>
                        </aside>

                    </div>
                </section>

                <footer class="page-footer">
                    <div
                        class="d-flex flex-column flex-md-row
                               justify-content-between gap-2"
                    >
                        <span>
                            © {{ date('Y') }} CurhatAman
                        </span>
                        <span>
                            Portal Guru BK · Akses sesuai kewenangan
                        </span>
                    </div>
                </footer>

            </div>
        </div>
    </main>
</div>
<div
    class="sidebar-overlay"
    id="sidebarOverlay"
></div>

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
></script>

<script>
    const sidebar = document.getElementById('bkSidebar');
    const openSidebarButton = document.getElementById('openSidebarButton');
    const sidebarOverlay = document.getElementById('sidebarOverlay');
    function openSidebar() {
        sidebar.classList.add('show');
        sidebarOverlay.classList.add('show');
    }

    function closeSidebar() {
        sidebar.classList.remove('show');
        sidebarOverlay.classList.remove('show');
    }

    if (openSidebarButton) {
        openSidebarButton.addEventListener('click', openSidebar);
    }

    sidebarOverlay.addEventListener('click', closeSidebar);
    window.addEventListener('resize', function () {
        if (window.innerWidth >= 992) {
            closeSidebar();
        }

    });
</script>
</body>
</html>

