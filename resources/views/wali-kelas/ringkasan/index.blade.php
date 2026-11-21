<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ringkasan Kelas | CurhatAman</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

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
            --ca-success: #238653;
            --ca-success-soft: #edf8f2;
            --ca-warning: #a66b12;
            --ca-warning-soft: #fff7e8;
            --ca-danger: #c64747;
            --ca-danger-soft: #fff1f1;
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

        .sidebar-brand {
            min-height: 48px;
            margin-bottom: 24px;
            padding: 0 8px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .brand-symbol {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            color: #ffffff;
            background: var(--ca-primary);
            font-size: 1.05rem;
        }

        .brand-copy {
            min-width: 0;
        }

        .brand-name {
            display: block;
            color: var(--ca-primary);
            font-size: 1.06rem;
            font-weight: 740;
            letter-spacing: -.25px;
        }

        .brand-role {
            display: block;
            margin-top: 1px;
            color: var(--ca-muted);
            font-size: .72rem;
            font-weight: 550;
        }

        .sidebar-section-label {
            margin: 0 10px 8px;
            color: var(--ca-muted-light);
            font-size: .65rem;
            font-weight: 720;
            letter-spacing: .075em;
            text-transform: uppercase;
        }

        .sidebar-nav {
            display: flex;
            flex-direction: column;
            gap: 3px;
        }

        .sidebar-link {
            min-height: 41px;
            padding: 9px 11px;
            border-radius: 9px;
            display: flex;
            align-items: center;
            gap: 10px;
            color: #475467;
            font-size: .81rem;
            font-weight: 560;
            transition: background .16s ease, color .16s ease;
        }

        .sidebar-link i {
            width: 19px;
            color: #7c8795;
            font-size: .91rem;
            text-align: center;
        }

        .sidebar-link:hover {
            color: var(--ca-primary-dark);
            background: #f6faf9;
        }

        .sidebar-link:hover i {
            color: var(--ca-primary);
        }

        .sidebar-link.active {
            color: var(--ca-primary-dark);
            background: var(--ca-primary-soft);
            font-weight: 660;
        }

        .sidebar-link.active i {
            color: var(--ca-primary);
        }

        .sidebar-spacer {
            flex: 1;
        }

        .sidebar-account {
            margin-top: 22px;
            padding-top: 14px;
            border-top: 1px solid var(--ca-line);
        }

        .logout-button {
            width: 100%;
            min-height: 40px;
            padding: 9px 11px;
            border: 0;
            border-radius: 9px;
            display: flex;
            align-items: center;
            gap: 10px;
            color: #b42318;
            background: transparent;
            font-size: .8rem;
            font-weight: 560;
            text-align: left;
        }

        .logout-button:hover {
            background: #fff4f3;
        }

        .topbar {
            grid-column: 2;
            min-width: 0;
            padding: 0 26px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            background: rgba(255, 255, 255, .98);
            border-bottom: 1px solid var(--ca-border);
        }

        .topbar-left {
            min-width: 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .topbar-title {
            margin-bottom: 1px;
            color: var(--ca-text);
            font-size: .86rem;
            font-weight: 660;
        }

        .topbar-subtitle {
            color: var(--ca-muted);
            font-size: .72rem;
        }

        .topbar-actions {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .date-chip {
            min-height: 38px;
            padding: 0 10px;
            border: 1px solid var(--ca-border);
            border-radius: 9px;
            display: inline-flex;
            align-items: center;
            gap: 7px;
            color: #596579;
            background: #ffffff;
            font-size: .72rem;
            font-weight: 540;
        }

        .account-trigger {
            min-width: 158px;
            padding: 5px 7px;
            border: 1px solid transparent;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            gap: 9px;
            color: var(--ca-text);
            background: transparent;
            text-align: left;
            transition: background .16s ease, border-color .16s ease;
        }

        .account-trigger:hover,
        .account-trigger:focus {
            color: var(--ca-primary-dark);
            background: #f7fbfa;
            border-color: var(--ca-border);
        }

        .topbar-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            color: var(--ca-primary-dark);
            background: #dcefeb;
            font-size: .82rem;
            font-weight: 720;
        }

        .account-copy {
            min-width: 0;
            flex: 1;
        }

        .account-name {
            max-width: 112px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            color: var(--ca-text);
            font-size: .78rem;
            font-weight: 650;
        }

        .account-role {
            margin-top: 1px;
            color: var(--ca-muted);
            font-size: .67rem;
        }

        .account-chevron {
            color: var(--ca-muted-light);
            font-size: .68rem;
        }

        .main-content {
            grid-column: 2;
            min-width: 0;
            display: flex;
            flex-direction: column;
        }

        .page-body {
            flex: 1;
            padding: 26px;
        }

        .content-shell {
            max-width: 1320px;
            margin: 0 auto;
        }

        .page-header {
            margin-bottom: 22px;
            padding: 20px 22px;
            border-radius: 12px;
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 20px;
            background: var(--ca-primary);
        }

        .page-kicker {
            margin-bottom: 5px;
            color: rgba(255, 255, 255, .74);
            font-size: .65rem;
            font-weight: 730;
            letter-spacing: .075em;
            text-transform: uppercase;
        }

        .page-title {
            margin: 0;
            color: #ffffff;
            font-size: clamp(1.65rem, 3vw, 2rem);
            font-weight: 720;
            letter-spacing: -.5px;
        }

        .page-copy {
            max-width: 760px;
            margin: 7px 0 0;
            color: rgba(255, 255, 255, .82);
            font-size: .82rem;
            line-height: 1.55;
        }

        .class-meta {
            min-width: 185px;
            padding: 10px 12px;
            border: 1px solid rgba(255, 255, 255, .38);
            border-radius: 9px;
            background: rgba(255, 255, 255, .10);
        }

        .class-meta-label {
            color: rgba(255, 255, 255, .68);
            font-size: .62rem;
            font-weight: 700;
            letter-spacing: .065em;
            text-transform: uppercase;
        }

        .class-meta-value {
            margin-top: 3px;
            color: #ffffff;
            font-size: .75rem;
            font-weight: 680;
        }

        .period-filter {
            margin-bottom: 16px;
            padding: 17px;
            border: 1px solid var(--ca-border);
            border-radius: 11px;
            background: var(--ca-surface);
        }

        .form-label {
            margin-bottom: 6px;
            color: #475467;
            font-size: .69rem;
            font-weight: 610;
        }

        .form-select {
            min-height: 42px;
            border: 1px solid var(--ca-border);
            border-radius: 9px;
            color: var(--ca-text);
            background-color: #ffffff;
            font-size: .76rem;
            box-shadow: none;
        }

        .form-select:focus {
            border-color: rgba(15, 138, 131, .55);
            box-shadow: 0 0 0 .2rem rgba(15, 138, 131, .08);
        }

        .period-context {
            min-height: 42px;
            padding: 9px 11px;
            border: 1px solid #cfe3e0;
            border-radius: 9px;
            display: flex;
            align-items: center;
            gap: 9px;
            color: #526c69;
            background: #f7fbfa;
            font-size: .69rem;
            line-height: 1.45;
        }

        .period-context i,
        .period-context strong {
            color: var(--ca-primary-dark);
        }

        .btn-period,
        .btn-period-reset {
            min-height: 42px;
            padding: 0 13px;
            border-radius: 9px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            font-size: .74rem;
            font-weight: 620;
        }

        .btn-period {
            border: 1px solid var(--ca-primary);
            color: #ffffff;
            background: var(--ca-primary);
        }

        .btn-period:hover,
        .btn-period:focus {
            color: #ffffff;
            background: var(--ca-primary-dark);
            border-color: var(--ca-primary-dark);
        }

        .btn-period-reset {
            border: 1px solid var(--ca-border);
            color: #475467;
            background: #ffffff;
        }

        .btn-period-reset:hover,
        .btn-period-reset:focus {
            color: var(--ca-primary-dark);
            background: var(--ca-primary-soft);
            border-color: #cfe3e0;
        }

        .metric-card {
            position: relative;
            height: 100%;
            min-height: 130px;
            padding: 17px;
            border: 1px solid var(--ca-border);
            border-top: 3px solid #cfd8d8;
            border-radius: 11px;
            background: var(--ca-surface);
        }

        .metric-card.students {
            border-top-color: var(--ca-primary);
        }

        .metric-card.total-cases {
            border-top-color: #4f8fbf;
        }

        .metric-card.active-cases {
            border-top-color: #e6a33b;
        }

        .metric-card.completed-cases {
            border-top-color: #35a36f;
        }

        .metric-top {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 12px;
        }

        .metric-label {
            color: #596579;
            font-size: .73rem;
            font-weight: 610;
        }

        .metric-value {
            margin-top: 12px;
            color: var(--ca-text);
            font-size: 1.55rem;
            font-weight: 730;
            line-height: 1;
        }

        .metric-icon {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            font-size: .82rem;
        }

        .metric-card.students .metric-icon {
            color: #ffffff;
            background: var(--ca-primary);
        }

        .metric-card.total-cases .metric-icon {
            color: #2d6f9f;
            background: #eef6fb;
        }

        .metric-card.active-cases .metric-icon {
            color: #a85f00;
            background: #fff5e7;
        }

        .metric-card.completed-cases .metric-icon {
            color: #027a48;
            background: #ecfdf3;
        }

        .metric-note {
            margin-top: 13px;
            color: var(--ca-muted);
            font-size: .68rem;
            line-height: 1.45;
        }

        .panel {
            border: 1px solid var(--ca-border);
            border-radius: 11px;
            background: var(--ca-surface);
            overflow: hidden;
        }

        .panel.teal-accent {
            border-top: 3px solid var(--ca-primary);
        }

        .panel-header {
            min-height: 64px;
            padding: 14px 16px;
            border-bottom: 1px solid var(--ca-line);
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 16px;
        }

        .panel-title {
            margin: 0;
            color: var(--ca-text);
            font-size: .82rem;
            font-weight: 680;
        }

        .panel-copy {
            margin: 3px 0 0;
            color: var(--ca-muted);
            font-size: .69rem;
            line-height: 1.45;
        }

        .privacy-inline {
            min-height: 30px;
            padding: 0 9px;
            border: 1px solid #d6e7e4;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: #59716e;
            background: #f7fbfa;
            font-size: .65rem;
            white-space: nowrap;
        }

        .privacy-inline i {
            color: var(--ca-primary-dark);
        }

        .chart-wrap {
            height: 290px;
            padding: 18px 18px 20px;
        }

        .status-list {
            padding: 7px 16px 10px;
        }

        .status-row {
            min-height: 50px;
            border-bottom: 1px solid var(--ca-line);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        .status-row:last-child {
            border-bottom: 0;
        }

        .status-left {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .status-dot {
            width: 8px;
            height: 8px;
            flex: 0 0 8px;
            border-radius: 50%;
        }

        .status-dot.new {
            background: #d79a31;
        }

        .status-dot.process {
            background: var(--ca-primary);
        }

        .status-dot.escalated {
            background: #c94c4c;
        }

        .status-dot.done {
            background: #32a36b;
        }

        .status-name {
            color: #344054;
            font-size: .7rem;
            font-weight: 620;
        }

        .status-count {
            min-width: 30px;
            height: 26px;
            padding: 0 8px;
            border-radius: 7px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: var(--ca-text);
            background: #f5f7f8;
            font-size: .66rem;
            font-weight: 700;
        }

        .category-list {
            padding: 15px 16px 14px;
        }

        .category-row {
            margin-bottom: 15px;
        }

        .category-row:last-child {
            margin-bottom: 0;
        }

        .category-info {
            margin-bottom: 7px;
            display: flex;
            justify-content: space-between;
            gap: 12px;
        }

        .category-name {
            color: #344054;
            font-size: .7rem;
            font-weight: 620;
        }

        .category-count {
            color: var(--ca-muted);
            font-size: .65rem;
        }

        .category-track {
            height: 6px;
            border-radius: 999px;
            overflow: hidden;
            background: #edf1f3;
        }

        .category-fill {
            height: 100%;
            border-radius: 999px;
            background: var(--ca-primary);
        }

        .screening-wrap {
            padding: 17px 16px 15px;
        }

        .screening-summary {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 14px;
        }

        .screening-value {
            color: var(--ca-text);
            font-size: 1.7rem;
            font-weight: 730;
            line-height: 1;
        }

        .screening-caption {
            margin-top: 4px;
            color: var(--ca-muted);
            font-size: .66rem;
        }

        .screening-meta {
            color: #596579;
            font-size: .7rem;
            font-weight: 620;
            text-align: right;
        }

        .progress {
            height: 7px;
            margin-top: 13px;
            border-radius: 999px;
            overflow: hidden;
            background: #edf1f3;
        }

        .progress-bar {
            background: var(--ca-primary);
        }

        .screening-grid {
            margin-top: 15px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }

        .screening-box {
            padding: 11px 12px;
            border: 1px solid var(--ca-line);
            border-radius: 9px;
            background: #fbfcfc;
        }

        .screening-box-label {
            color: var(--ca-muted);
            font-size: .65rem;
        }

        .screening-box-value {
            margin-top: 3px;
            color: var(--ca-text);
            font-size: 1.02rem;
            font-weight: 690;
        }

        .privacy-strip {
            margin: 0 16px 16px;
            padding: 11px 12px;
            border: 1px solid #d6e7e4;
            border-radius: 9px;
            display: flex;
            align-items: flex-start;
            gap: 8px;
            color: #59716e;
            background: #f7fbfa;
            font-size: .63rem;
            line-height: 1.5;
        }

        .privacy-strip i {
            color: var(--ca-primary-dark);
            font-size: .78rem;
        }

        .empty-state {
            padding: 36px 18px;
            color: var(--ca-muted);
            text-align: center;
            font-size: .7rem;
        }

        .page-footer {
            min-height: 64px;
            margin-top: 26px;
            padding: 0 18px;
            border-radius: 11px;
            display: flex;
            align-items: center;
            color: rgba(255, 255, 255, .78);
            background: var(--ca-primary-dark);
            font-size: .68rem;
        }

        .page-footer > div {
            width: 100%;
        }

        .page-footer span:first-child {
            color: #ffffff;
            font-weight: 620;
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

            .main-content {
                min-height: calc(100vh - var(--topbar-height));
            }

            .page-body {
                padding: 22px 18px 30px;
            }

            .date-chip {
                display: none;
            }
        }

        @media (max-width: 767.98px) {
            .page-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .class-meta {
                width: 100%;
            }

            .panel-header {
                flex-direction: column;
            }

            .privacy-inline {
                align-self: flex-start;
            }
        }

        @media (max-width: 575.98px) {
            .account-trigger {
                min-width: auto;
                padding: 5px;
            }

            .account-copy,
            .account-chevron {
                display: none;
            }

            .topbar-subtitle {
                display: none;
            }
        }
    </style>
    @include('wali-kelas.partials.styles')
    <style>
        .modal {
            z-index: 2050 !important;
        }

        .modal-backdrop {
            z-index: 2040 !important;
        }

        @media (min-width: 992px) {
            .modal {
                padding-left: var(--sidebar-width) !important;
            }

            .modal-dialog {
                max-width: min(840px, calc(100% - 48px)) !important;
                margin-left: auto !important;
                margin-right: auto !important;
            }
        }

        @media (max-width: 991.98px) {
            .modal {
                padding-left: 0 !important;
            }

            .modal-dialog {
                max-width: calc(100% - 24px) !important;
                margin: 16px auto !important;
            }
        }
    </style>
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

<div class="app-shell">
    @include('wali-kelas.partials.sidebar')

    <div
        class="sidebar-overlay"
        id="sidebarOverlay"
    ></div>

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
                    Ringkasan Kelas
                </div>

                <div class="topbar-subtitle">
                    Statistik umum kelas tanpa menampilkan data sensitif siswa
                </div>
            </div>
        </div>

        <div class="topbar-actions">
            @include('wali-kelas.partials.notification-bell')

            <div class="date-chip">
                <i class="bi bi-calendar3"></i>
                {{ now()->locale('id')->translatedFormat('d F Y') }}
            </div>

            <a
                href="{{ route('wali-kelas.profil.index') }}"
                class="account-trigger"
                aria-label="Buka profil Wali Kelas"
            >
                <span class="topbar-avatar">
                    {{ $inisial }}
                </span>

                <span class="account-copy">
                    <span class="account-name d-block">
                        {{ $namaUser }}
                    </span>

                    <span class="account-role d-block">
                        Wali Kelas
                    </span>
                </span>

                <i class="bi bi-chevron-right account-chevron"></i>
            </a>
        </div>
    </header>

    <main class="main-content">
        <div class="page-body">
            <div class="content-shell">
                <section class="page-header">
                    <div>
                        <div class="page-kicker">
                            Ringkasan Wali Kelas
                        </div>

                        <h1 class="page-title">
                            Ringkasan {{ $kelas->nama_kelas }}
                        </h1>

                        <p class="page-copy">
                            Lihat perkembangan umum kelas melalui jumlah kasus, status penanganan, kategori kasus, tren laporan, dan partisipasi skrining dalam bentuk agregat.
                        </p>
                    </div>

                    <div class="class-meta">
                        <div class="class-meta-label">
                            Periode Terpilih
                        </div>

                        <div class="class-meta-value">
                            {{ $tahunAjaran }} · {{ ucfirst($semester) }}
                        </div>
                    </div>
                </section>

                <form
                    method="GET"
                    action="{{ route('wali-kelas.ringkasan.index') }}"
                    class="period-filter"
                >
                    <div class="row g-3 align-items-end">
                        <div class="col-sm-6 col-lg-3">
                            <label
                                for="tahun_ajaran"
                                class="form-label"
                            >
                                Tahun Ajaran
                            </label>

                            <select
                                name="tahun_ajaran"
                                id="tahun_ajaran"
                                class="form-select"
                            >
                                @foreach ($tahunAjaranOptions as $option)
                                    <option
                                        value="{{ $option }}"
                                        @selected($tahunAjaran === $option)
                                    >
                                        {{ $option }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-sm-6 col-lg-2">
                            <label
                                for="semester"
                                class="form-label"
                            >
                                Semester
                            </label>

                            <select
                                name="semester"
                                id="semester"
                                class="form-select"
                            >
                                <option
                                    value="ganjil"
                                    @selected($semester === 'ganjil')
                                >
                                    Ganjil
                                </option>

                                <option
                                    value="genap"
                                    @selected($semester === 'genap')
                                >
                                    Genap
                                </option>
                            </select>
                        </div>

                        <div class="col-sm-6 col-lg-3">
                            <label
                                for="kelas_id"
                                class="form-label"
                            >
                                Kelas
                            </label>

                            <select
                                name="kelas_id"
                                id="kelas_id"
                                class="form-select"
                            >
                                @foreach ($kelasList as $itemKelas)
                                    <option
                                        value="{{ $itemKelas->id }}"
                                        @selected((int) $kelasId === (int) $itemKelas->id)
                                    >
                                        {{ $itemKelas->nama_kelas }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-sm-6 col-lg-4">
                            <label class="form-label">
                                Arsip Periode
                            </label>

                            <div class="period-context">
                                <i class="bi bi-archive"></i>

                                <span>
                                    <strong>{{ $periodeLabel }}</strong>
                                    · {{ $startDate->locale('id')->translatedFormat('d M Y') }}
                                    s.d.
                                    {{ $endDate->locale('id')->translatedFormat('d M Y') }}
                                </span>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="d-flex justify-content-end gap-2">
                                <button
                                    type="submit"
                                    class="btn-period"
                                >
                                    <i class="bi bi-funnel"></i>
                                    Terapkan
                                </button>

                                <a
                                    href="{{ route('wali-kelas.ringkasan.index') }}"
                                    class="btn-period-reset"
                                    title="Kembali ke periode aktif"
                                >
                                    <i class="bi bi-arrow-counterclockwise"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </form>

                <section class="row g-3 mb-4">
                    <div class="col-sm-6 col-xl-3">
                        <div class="metric-card students">
                            <div class="metric-top">
                                <div>
                                    <div class="metric-label">
                                        Total Siswa
                                    </div>

                                    <div class="metric-value">
                                        {{ $totalSiswa }}
                                    </div>
                                </div>

                                <span class="metric-icon">
                                    <i class="bi bi-people"></i>
                                </span>
                            </div>

                            <div class="metric-note">
                                Siswa pada {{ $kelas->nama_kelas }}
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xl-3">
                        <div class="metric-card total-cases">
                            <div class="metric-top">
                                <div>
                                    <div class="metric-label">
                                        Total Kasus
                                    </div>

                                    <div class="metric-value">
                                        {{ $totalKasus }}
                                    </div>
                                </div>

                                <span class="metric-icon">
                                    <i class="bi bi-file-earmark-text"></i>
                                </span>
                            </div>

                            <div class="metric-note">
                                Laporan non-draft pada periode terpilih
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xl-3">
                        <div class="metric-card active-cases">
                            <div class="metric-top">
                                <div>
                                    <div class="metric-label">
                                        Kasus Aktif
                                    </div>

                                    <div class="metric-value">
                                        {{ $kasusBaru + $kasusDiproses + $kasusDieskalasi }}
                                    </div>
                                </div>

                                <span class="metric-icon">
                                    <i class="bi bi-activity"></i>
                                </span>
                            </div>

                            <div class="metric-note">
                                Masih ditangani pada periode terpilih
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xl-3">
                        <div class="metric-card completed-cases">
                            <div class="metric-top">
                                <div>
                                    <div class="metric-label">
                                        Kasus Selesai
                                    </div>

                                    <div class="metric-value">
                                        {{ $kasusSelesai }}
                                    </div>
                                </div>

                                <span class="metric-icon">
                                    <i class="bi bi-check2-circle"></i>
                                </span>
                            </div>

                            <div class="metric-note">
                                Selesai pada periode terpilih
                            </div>
                        </div>
                    </div>
                </section>

                <section class="panel teal-accent mb-3">
                    <div class="panel-header">
                        <div>
                            <h2 class="panel-title">
                                Tren Kasus · {{ $periodeLabel }}
                            </h2>

                            <p class="panel-copy">
                                Perubahan jumlah laporan bulanan pada {{ $kelas->nama_kelas }} selama semester terpilih.
                            </p>
                        </div>

                        <span class="privacy-inline">
                            <i class="bi bi-shield-lock"></i>
                            Data agregat
                        </span>
                    </div>

                    <div class="chart-wrap">
                        <canvas id="trendKasusChart"></canvas>
                    </div>
                </section>

                <section class="row g-3">
                    <div class="col-lg-4">
                        <div class="panel h-100">
                            <div class="panel-header">
                                <div>
                                    <h2 class="panel-title">
                                        Status Kasus
                                    </h2>

                                    <p class="panel-copy">
                                        Jumlah kasus berdasarkan status pada periode terpilih.
                                    </p>
                                </div>
                            </div>

                            <div class="status-list">
                                <div class="status-row">
                                    <div class="status-left">
                                        <span class="status-dot new"></span>
                                        <span class="status-name">
                                            Baru
                                        </span>
                                    </div>

                                    <span class="status-count">
                                        {{ $kasusBaru }}
                                    </span>
                                </div>

                                <div class="status-row">
                                    <div class="status-left">
                                        <span class="status-dot process"></span>
                                        <span class="status-name">
                                            Diproses
                                        </span>
                                    </div>

                                    <span class="status-count">
                                        {{ $kasusDiproses }}
                                    </span>
                                </div>

                                <div class="status-row">
                                    <div class="status-left">
                                        <span class="status-dot escalated"></span>
                                        <span class="status-name">
                                            Dieskalasi
                                        </span>
                                    </div>

                                    <span class="status-count">
                                        {{ $kasusDieskalasi }}
                                    </span>
                                </div>

                                <div class="status-row">
                                    <div class="status-left">
                                        <span class="status-dot done"></span>
                                        <span class="status-name">
                                            Selesai
                                        </span>
                                    </div>

                                    <span class="status-count">
                                        {{ $kasusSelesai }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="panel h-100">
                            <div class="panel-header">
                                <div>
                                    <h2 class="panel-title">
                                        Kategori Kasus
                                    </h2>

                                    <p class="panel-copy">
                                        Distribusi kategori kasus secara agregat pada periode terpilih.
                                    </p>
                                </div>
                            </div>

                            @if($kategoriKasus->count())
                                <div class="category-list">
                                    @foreach($kategoriKasus as $kategori)
                                        @php
                                            $persenKategori = $totalKasus > 0
                                                ? round(($kategori->jumlah / $totalKasus) * 100)
                                                : 0;
                                        @endphp

                                        <div class="category-row">
                                            <div class="category-info">
                                                <span class="category-name">
                                                    {{ $kategori->nama_kategori }}
                                                </span>

                                                <span class="category-count">
                                                    {{ $kategori->jumlah }}
                                                </span>
                                            </div>

                                            <div class="category-track">
                                                <div
                                                    class="category-fill"
                                                    style="width: {{ $persenKategori }}%"
                                                ></div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="empty-state">
                                    Belum terdapat data kasus pada kelas dan periode terpilih.
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="panel h-100">
                            <div class="panel-header">
                                <div>
                                    <h2 class="panel-title">
                                        Partisipasi Skrining
                                    </h2>

                                    <p class="panel-copy">
                                        Partisipasi siswa pada periode terpilih secara agregat.
                                    </p>
                                </div>
                            </div>

                            <div class="screening-wrap">
                                <div class="screening-summary">
                                    <div>
                                        <div class="screening-value">
                                            {{ $persentaseSkrining }}%
                                        </div>

                                        <div class="screening-caption">
                                            tingkat partisipasi
                                        </div>
                                    </div>

                                    <div class="screening-meta">
                                        {{ $sudahSkrining }} / {{ $totalSiswa }} siswa
                                    </div>
                                </div>

                                <div class="progress">
                                    <div
                                        class="progress-bar"
                                        style="width: {{ $persentaseSkrining }}%"
                                    ></div>
                                </div>

                                <div class="screening-grid">
                                    <div class="screening-box">
                                        <div class="screening-box-label">
                                            Sudah Mengisi
                                        </div>

                                        <div class="screening-box-value">
                                            {{ $sudahSkrining }}
                                        </div>
                                    </div>

                                    <div class="screening-box">
                                        <div class="screening-box-label">
                                            Belum Mengisi
                                        </div>

                                        <div class="screening-box-value">
                                            {{ $belumSkrining }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="privacy-strip">
                                <i class="bi bi-shield-lock"></i>

                                <span>
                                    Identitas peserta, jawaban, dan skor skrining individual tidak ditampilkan kepada Wali Kelas.
                                </span>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Section Koordinasi & Arahan Guru BK untuk Wali Kelas (Group by Siswa) -->
                <section class="mt-4">
                    <div class="panel">
                        <div class="panel-header d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
                            <div>
                                <h2 class="panel-title">
                                    <i class="bi bi-person-workspace text-primary me-2"></i> Pendampingan & Koordinasi Siswa Kelas
                                </h2>
                                <p class="panel-copy">
                                    Daftar siswa yang mendapatkan arahan & rekomendasi tindakan resmi dari Guru BK untuk pendampingan siswa kelas {{ $kelas->nama_kelas }}.
                                </p>
                            </div>
                            @if(isset($koordinasiPerSiswa) && !$koordinasiPerSiswa->isEmpty())
                                <div class="d-flex align-items-center gap-2 mt-2 mt-md-0 w-100 w-md-auto justify-content-md-end">
                                    <span class="badge bg-light text-dark border px-2.5 py-2 d-none d-sm-inline-flex align-items-center" style="font-size: 11.5px; font-weight: 600;">
                                        <i class="bi bi-people text-primary me-1"></i> {{ $koordinasiPerSiswa->count() }} Siswa ({{ $koordinasiSiswa->count() }} Catatan)
                                    </span>
                                    <div style="min-width: 220px; max-width: 280px; width: 100%;">
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-search"></i></span>
                                            <input type="text" id="searchKoordinasi" class="form-control border-start-0" placeholder="Cari nama siswa atau topik..." style="font-size: 12px;">
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>

                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show mb-3" role="alert" style="border-radius: 8px;">
                                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if(!isset($koordinasiPerSiswa) || $koordinasiPerSiswa->isEmpty())
                            <div class="p-4 text-center text-muted rounded-3" style="background: #fafbfb; border: 1px dashed var(--ca-border);">
                                <i class="bi bi-journal-check fs-2 text-muted d-block mb-2"></i>
                                <div class="fw-bold" style="font-size: 13.5px; color: var(--ca-text);">Belum Ada Catatan Koordinasi Berjalan</div>
                                <div style="font-size: 12px;">Saat ini belum ada catatan pendampingan dari Guru BK yang dibagikan untuk siswa kelas {{ $kelas->nama_kelas }} pada periode {{ $periodeLabel }}.</div>
                            </div>
                        @else
                            <div class="table-responsive rounded-3 border" style="border-color: var(--ca-border) !important; background: #ffffff;">
                                <table class="table table-hover align-middle mb-0" id="tableKoordinasi" style="font-size: 12.5px;">
                                    <thead style="background: #f8fafb; border-bottom: 1px solid var(--ca-border);">
                                        <tr>
                                            <th class="py-3 px-3 text-muted fw-semibold text-uppercase text-center" style="width: 48px; font-size: 11px; letter-spacing: .04em;">No</th>
                                            <th class="py-3 px-3 text-muted fw-semibold text-uppercase" style="width: 220px; font-size: 11px; letter-spacing: .04em;">Siswa</th>
                                            <th class="py-3 px-3 text-muted fw-semibold text-uppercase text-center" style="width: 130px; font-size: 11px; letter-spacing: .04em;">Total Catatan</th>
                                            <th class="py-3 px-3 text-muted fw-semibold text-uppercase" style="font-size: 11px; letter-spacing: .04em;">Sesi & Arahan Terkini</th>
                                            <th class="py-3 px-3 text-muted fw-semibold text-uppercase" style="width: 140px; font-size: 11px; letter-spacing: .04em;">Guru BK</th>
                                            <th class="py-3 px-3 text-muted fw-semibold text-uppercase text-end" style="width: 145px; font-size: 11px; letter-spacing: .04em;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($koordinasiPerSiswa as $idx => $item)
                                            @php
                                                $terbaru = $item->catatan_terbaru;
                                                $createdAt = \Carbon\Carbon::parse($terbaru->created_at);
                                                $allKeywords = strtolower($item->nama_siswa . ' ' . $item->nis . ' ' . $item->daftar_catatan->pluck('topik')->implode(' ') . ' ' . $item->daftar_catatan->pluck('jenis_layanan')->implode(' ') . ' ' . $item->daftar_catatan->pluck('nama_guru_bk')->implode(' '));
                                            @endphp
                                            <tr class="row-koordinasi" data-search-text="{{ $allKeywords }}" style="border-bottom: 1px solid #f0f3f5;">
                                                <td class="py-3 px-3 text-muted text-center">{{ $idx + 1 }}</td>
                                                <td class="py-3 px-3">
                                                    <div class="fw-bold text-dark" style="font-size: 13.5px;">{{ $item->nama_siswa }}</div>
                                                    <div class="text-muted" style="font-size: 11px;">NISN: {{ $item->nis ?: '-' }}</div>
                                                </td>
                                                <td class="py-3 px-3 text-center">
                                                    <span class="badge bg-light text-dark border px-2.5 py-1.5" style="font-size: 11px; font-weight: 600;">
                                                        <i class="bi bi-journal-text text-primary me-1"></i> {{ $item->total_catatan }} Catatan
                                                    </span>
                                                </td>
                                                <td class="py-3 px-3">
                                                    <div class="d-flex align-items-center gap-1.5 mb-1">
                                                        <span class="badge bg-light text-dark border" style="font-size: 10.5px; font-weight: 600;">{{ $terbaru->jenis_layanan }}</span>
                                                        <span class="text-muted" style="font-size: 11px;">
                                                            <i class="bi bi-calendar-check me-0.5 text-primary"></i> {{ \Carbon\Carbon::parse($terbaru->tanggal_pertemuan)->locale('id')->translatedFormat('d M Y') }}
                                                        </span>
                                                    </div>
                                                    <div class="text-dark fw-medium" style="max-width: 320px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" title="{{ $terbaru->topik }}">
                                                        {{ $terbaru->topik }}
                                                    </div>
                                                    <div class="text-muted d-flex align-items-center gap-1 mt-0.5" style="font-size: 11px;">
                                                        <i class="bi bi-clock-history"></i> Masuk: {{ $createdAt->locale('id')->translatedFormat('d M Y, H:i') }}
                                                        @if($item->ada_catatan_baru)
                                                            <span class="badge" style="background: #e6f7f2; color: #0f8a83; font-size: 9.5px; font-weight: 700; padding: 2px 5px;">Baru</span>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td class="py-3 px-3 text-dark fw-medium">
                                                    <i class="bi bi-person-badge text-muted me-1"></i> {{ $terbaru->nama_guru_bk }}
                                                </td>
                                                <td class="py-3 px-3 text-end">
                                                    <button type="button" class="btn btn-sm text-white d-inline-flex align-items-center gap-1.5 shadow-sm" data-bs-toggle="modal" data-bs-target="#modalSiswa{{ $item->siswa_id }}" style="background: var(--ca-primary); border-color: var(--ca-primary); font-size: 12px; font-weight: 600; padding: 5px 12px; border-radius: 7px;">
                                                        <i class="bi bi-journal-text"></i> Lihat Arahan ({{ $item->total_catatan }})
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <!-- Pesan Pencarian Kosong -->
                                <div id="searchEmptyMsg" class="p-4 text-center text-muted" style="display: none; background: #fafbfb;">
                                    <i class="bi bi-search fs-3 text-muted d-block mb-1"></i>
                                    <div class="fw-bold" style="font-size: 13px;">Tidak Ada Siswa yang Cocok</div>
                                    <div style="font-size: 11.5px;">Tidak ditemukan siswa atau topik bimbingan yang sesuai dengan kata kunci pencarian.</div>
                                </div>
                            </div>
                        @endif
                    </div>
                </section>

                <footer class="page-footer">
                    <div class="d-flex flex-column flex-md-row justify-content-between gap-2">
                        <span>
                            © {{ date('Y') }} CurhatAman
                        </span>

                        <span>
                            Portal Wali Kelas · Data ditampilkan sesuai kewenangan
                        </span>
                    </div>
                </footer>
            </div>
        </div>
    </main>
</div>

@if(isset($koordinasiPerSiswa) && !$koordinasiPerSiswa->isEmpty())
    <!-- Modals Riwayat Arahan Siswa -->
    @foreach($koordinasiPerSiswa as $item)
        <div class="modal fade" id="modalSiswa{{ $item->siswa_id }}" tabindex="-1" aria-labelledby="modalSiswaLabel{{ $item->siswa_id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable my-3">
                <div class="modal-content border-0 shadow-sm" style="border-radius: 12px; overflow: hidden;">
                    <!-- Modal Header -->
                    <div class="modal-header py-2.5 px-3.5 text-white" style="background: var(--ca-primary);">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-journal-bookmark-fill" style="font-size: 16px;"></i>
                            <div>
                                <h6 class="modal-title fw-bold mb-0 text-white" id="modalSiswaLabel{{ $item->siswa_id }}" style="font-size: 14px; line-height: 1.2;">
                                    Arahan Pendampingan Siswa
                                </h6>
                                <div style="font-size: 11px; opacity: .88;">
                                    Catatan resmi Guru BK untuk koordinasi Wali Kelas
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close" style="font-size: 10px;"></button>
                    </div>

                    <!-- Subheader: Identitas Siswa Ringkas -->
                    <div class="px-3.5 py-2 bg-white border-bottom d-flex justify-content-between align-items-center flex-wrap gap-2">
                        <div class="d-flex align-items-center gap-2">
                            <div class="rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 32px; height: 32px; background: #eaf6f4; color: var(--ca-primary-dark); font-size: 12.5px; flex-shrink: 0;">
                                {{ strtoupper(substr($item->nama_siswa, 0, 1)) }}
                            </div>
                            <div>
                                <div class="fw-bold text-dark" style="font-size: 13px; line-height: 1.2;">{{ $item->nama_siswa }}</div>
                                <div class="text-muted" style="font-size: 11px;">NISN: {{ $item->nis ?: '-' }} · Kelas {{ $item->nama_kelas }}</div>
                            </div>
                        </div>
                        <div>
                            <span class="badge" style="background: #f1f5f9; color: #475467; font-size: 11px; font-weight: 600; padding: 4px 8px; border-radius: 5px; border: 1px solid #e2e8f0;">
                                <i class="bi bi-journals text-muted me-1"></i> {{ $item->total_catatan }} Catatan Konseling
                            </span>
                        </div>
                    </div>

                    <!-- Modal Body: Daftar Sesi Catatan -->
                    <div class="modal-body p-3" style="background: #f8fafc;">
                        <div class="d-flex flex-column gap-2.5">
                            @foreach($item->daftar_catatan as $subIdx => $catatan)
                                @php
                                    $catatanCreated = \Carbon\Carbon::parse($catatan->created_at);
                                    $isCatatanBaru = $catatanCreated->diffInDays(now()) <= 3;
                                @endphp
                                <div class="card border rounded-2 bg-white" style="border-color: #e5e9eb !important; box-shadow: 0 1px 2px rgba(0,0,0,0.03);">
                                    <!-- Header Sesi: Kompak, Rapi, Sejajar -->
                                    <div class="card-header bg-white py-2 px-3 border-bottom d-flex align-items-center justify-content-between flex-wrap gap-2">
                                        <div class="d-flex align-items-center gap-1.5 flex-wrap">
                                            <span class="badge" style="background: #334155; color: #ffffff; font-size: 10px; font-weight: 600; padding: 2.5px 6px; border-radius: 4px;">
                                                Sesi #{{ $item->total_catatan - $subIdx }}
                                            </span>
                                            <span class="badge" style="background: #eaf6f4; color: #0b6f69; font-size: 10px; font-weight: 600; padding: 2.5px 6px; border-radius: 4px;">
                                                {{ $catatan->jenis_layanan }}
                                            </span>
                                            <span class="fw-semibold text-dark" style="font-size: 12.5px;">
                                                {{ $catatan->topik }}
                                            </span>
                                            @if($isCatatanBaru)
                                                <span class="badge" style="background: #ecfdf5; color: #059669; border: 1px solid #a7f3d0; font-size: 9px; font-weight: 700; padding: 1.5px 5px; border-radius: 3px;">
                                                    Baru
                                                </span>
                                            @endif
                                        </div>
                                        <div class="text-muted d-flex align-items-center gap-1.5 ms-auto" style="font-size: 11px;">
                                            <span><i class="bi bi-calendar3 me-1 text-muted"></i> {{ \Carbon\Carbon::parse($catatan->tanggal_pertemuan)->locale('id')->translatedFormat('d M Y') }}</span>
                                            <span class="opacity-50">·</span>
                                            <span><i class="bi bi-clock me-1 text-muted"></i> {{ $catatanCreated->format('H:i') }} WIB</span>
                                            <span class="opacity-50">·</span>
                                            <span><i class="bi bi-person me-0.5 text-muted"></i> {{ $catatan->nama_guru_bk }}</span>
                                        </div>
                                    </div>

                                    <!-- Body Sesi: Arahan Utama & Hasil Kesepakatan -->
                                    <div class="card-body p-2.5">
                                        <!-- Kotak Arahan Wali Kelas (Fokus Utama) -->
                                        <div style="background: #fbfdfc; border: 1px solid #d1fae5; border-left: 3px solid var(--ca-primary); border-radius: 5px; padding: 8px 11px;">
                                            <div class="d-flex align-items-center gap-1 mb-1" style="font-size: 11px; font-weight: 700; color: #0f766e;">
                                                <i class="bi bi-pin-angle-fill"></i> Arahan Guru BK untuk Wali Kelas:
                                            </div>
                                            <div style="font-size: 12px; color: #134e4a; line-height: 1.55; white-space: pre-line; word-break: break-word;">
                                                {{ $catatan->arahan_wali_kelas ?: 'Tidak ada arahan tertulis khusus untuk Wali Kelas pada sesi ini.' }}
                                            </div>
                                        </div>

                                        <!-- Hasil Kesepakatan (Jika Ada) -->
                                        @if($catatan->hasil_kesepakatan)
                                            <div class="mt-2" style="background: #fafafa; border: 1px solid #f1f5f9; border-radius: 5px; padding: 7px 11px;">
                                                <div class="text-muted d-flex align-items-center gap-1 mb-0.5" style="font-size: 10.5px; font-weight: 600;">
                                                    <i class="bi bi-check2-circle text-muted"></i> Hasil Kesepakatan Sesi Konseling:
                                                </div>
                                                <div class="text-secondary" style="font-size: 11.5px; line-height: 1.5; white-space: pre-line; word-break: break-word;">
                                                    {{ $catatan->hasil_kesepakatan }}
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Modal Footer -->
                    <div class="modal-footer bg-white py-2 px-3.5 border-top">
                        <button type="button" class="btn btn-sm btn-light border px-3" data-bs-dismiss="modal" style="font-size: 11.5px; font-weight: 500; border-radius: 6px; color: #475467;">
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endif

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const trendLabels = @json($trenLabels);
    const trendValues = @json($trenValues);
    const trendCanvas = document.getElementById('trendKasusChart');

    if (trendCanvas) {
        new Chart(trendCanvas, {
            type: 'line',
            data: {
                labels: trendLabels,
                datasets: [
                    {
                        label: 'Jumlah Laporan',
                        data: trendValues,
                        borderColor: '#0f8a83',
                        backgroundColor: 'rgba(15, 138, 131, 0.07)',
                        borderWidth: 2.5,
                        tension: 0.35,
                        fill: true,
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        pointBackgroundColor: '#0f8a83',
                        pointBorderColor: '#ffffff',
                        pointBorderWidth: 2
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.parsed.y + ' laporan';
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        },
                        border: {
                            display: false
                        },
                        ticks: {
                            color: '#7a8493',
                            font: {
                                size: 10
                            }
                        }
                    },
                    y: {
                        beginAtZero: true,
                        border: {
                            display: false
                        },
                        ticks: {
                            precision: 0,
                            stepSize: 1,
                            color: '#7a8493',
                            font: {
                                size: 10
                            }
                        },
                        grid: {
                            color: '#edf0f2'
                        }
                    }
                }
            }
        });
    }

    const sidebar = document.getElementById('waliSidebar');
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

    // Pencarian instan pada tabel koordinasi siswa
    const searchInput = document.getElementById('searchKoordinasi');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const query = this.value.toLowerCase().trim();
            const rows = document.querySelectorAll('.row-koordinasi');
            let visibleCount = 0;

            rows.forEach(row => {
                const text = row.getAttribute('data-search-text') || '';
                if (!query || text.includes(query)) {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            });

            const emptyMsg = document.getElementById('searchEmptyMsg');
            if (emptyMsg) {
                emptyMsg.style.display = (visibleCount === 0 && query !== '') ? '' : 'none';
            }
        });
    }
</script>
</body>
</html>
