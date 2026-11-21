<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa - Guru BK - CurhatAman</title>
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
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            font-size: 14px;
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
            min-height: 42px;
            padding: 10px 11px;
            display: flex;
            align-items: center;
            gap: 11px;
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

        .sidebar-spacer {
            flex: 1;
        }

        .sidebar-account {
            margin-top: 24px;
            padding-top: 18px;
            border-top: 1px solid #edf1f1;
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
            font-size: 13px;
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

        .topbar-left {
            display: flex;
            align-items: center;
            gap: 10px;
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
            display: flex !important;
            align-items: center !important;
            gap: 12px !important;
        }

        .date-chip {
            height: 38px !important;
            min-height: 38px !important;
            padding: 0 13px !important;
            border: 1px solid var(--ca-border) !important;
            border-radius: 9px !important;
            display: inline-flex !important;
            align-items: center !important;
            gap: 8px !important;
            color: #596579 !important;
            background: #ffffff !important;
            font-size: 12px !important;
            font-weight: 550 !important;
            white-space: nowrap !important;
        }

        .date-chip i {
            color: var(--ca-primary-dark) !important;
            font-size: 13px !important;
        }

        .account-trigger {
            height: 38px !important;
            min-height: 38px !important;
            padding: 0 4px !important;
            border: 0 !important;
            border-radius: 9px !important;
            display: inline-flex !important;
            align-items: center !important;
            gap: 10px !important;
            color: var(--ca-text) !important;
            background: transparent !important;
            text-align: left !important;
            text-decoration: none !important;
            transition: background .15s ease !important;
        }

        .account-trigger:hover {
            background: rgba(0, 0, 0, 0.03) !important;
            border-color: transparent !important;
        }

        .topbar-avatar {
            width: 30px !important;
            height: 30px !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            flex-shrink: 0 !important;
            border-radius: 50% !important;
            color: var(--ca-primary-dark) !important;
            background: #dcefeb !important;
            font-size: 12px !important;
            font-weight: 750 !important;
        }

        .account-copy {
            min-width: 0 !important;
            display: flex !important;
            flex-direction: column !important;
            justify-content: center !important;
        }

        .account-name {
            max-width: 120px !important;
            overflow: hidden !important;
            text-overflow: ellipsis !important;
            white-space: nowrap !important;
            color: var(--ca-text) !important;
            font-size: 12px !important;
            font-weight: 700 !important;
            line-height: 1.2 !important;
        }

        .account-role {
            margin-top: 1px !important;
            color: var(--ca-muted) !important;
            font-size: 10.5px !important;
            line-height: 1 !important;
        }

        .account-chevron {
            color: #98a2b3 !important;
            font-size: 10px !important;
            margin-left: 2px !important;
        }

        .mobile-sidebar-button {
            width: 38px;
            height: 38px;
            border: 1px solid var(--ca-border);
            border-radius: 9px;
            display: none;
            align-items: center;
            justify-content: center;
            color: var(--ca-text);
            background: #ffffff;
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

        .page-kicker {
            margin-bottom: 6px;
            color: rgba(255, 255, 255, .82);
            font-size: 11px;
            font-weight: 750;
            letter-spacing: .07em;
            text-transform: uppercase;
        }

        .page-title {
            margin: 0 0 7px;
            color: #ffffff;
            font-size: 25px;
            font-weight: 760;
            letter-spacing: -.35px;
        }

        .page-copy {
            max-width: 760px;
            margin: 0;
            color: rgba(255, 255, 255, .92);
            font-size: 13px;
            line-height: 1.55;
        }

        .page-hero {
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

        .summary-grid {
            margin-top: 22px;
            display: grid;
            grid-template-columns: repeat(5, minmax(0, 1fr));
            gap: 12px;
        }

        .summary-card {
            min-height: 132px;
            padding: 18px;
            border: 1px solid var(--ca-border);
            border-radius: 12px;
            background: #ffffff;
        }

        .summary-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
        }

        .summary-label {
            color: var(--ca-muted);
            font-size: 12px;
            font-weight: 620;
        }

        .summary-icon {
            width: 35px;
            height: 35px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            border-radius: 9px;
            color: var(--ca-primary-dark);
            background: var(--ca-primary-soft);
            font-size: .88rem;
        }

        .summary-value {
            margin-top: 18px;
            color: var(--ca-text);
            font-size: 1.4rem;
            font-weight: 760;
            line-height: 1;
        }

        .filter-card,

        .table-card {
            border: 1px solid var(--ca-border);
            border-radius: 12px;
            background: #ffffff;
        }

        .filter-card {
            margin-top: 18px;
            padding: 18px;
        }

        .table-card {
            margin-top: 18px;
            overflow: hidden;
        }

        .form-label {
            margin-bottom: 7px;
            color: #475467;
            font-size: .8rem;
            font-weight: 620;
        }

        .form-control,

        .form-select {
            min-height: 42px;
            border: 1px solid #d8e1e1;
            border-radius: 9px;
            color: var(--ca-text);
            background-color: #ffffff;
            font-size: .84rem;
        }

        .form-control:focus,

        .form-select:focus {
            border-color: var(--ca-primary);
            box-shadow: 0 0 0 .2rem rgba(15, 138, 131, .09);
        }

        .btn-filter,

        .btn-reset {
            min-height: 42px;
            border-radius: 9px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
        }

        .btn-filter {
            width: 42px;
            min-width: 42px;
            border: 1px solid var(--ca-primary);
            color: #ffffff;
            background: var(--ca-primary);
        }

        .btn-filter:hover {
            color: #ffffff;
            border-color: var(--ca-primary-dark);
            background: var(--ca-primary-dark);
        }

        .btn-reset {
            width: 42px;
            border: 1px solid var(--ca-border);
            color: #475467;
            background: #ffffff;
        }

        .btn-reset:hover {
            color: var(--ca-primary-dark);
            background: var(--ca-primary-soft);
        }

        .table-card-header {
            padding: 17px 18px;
            border-bottom: 1px solid #edf1f1;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
        }

        .table-title {
            margin-bottom: 2px;
            color: var(--ca-text);
            font-size: .88rem;
            font-weight: 700;
        }

        .table-copy,

        .result-count {
            color: var(--ca-muted);
            font-size: 11.5px;
        }

        .result-count {
            padding: 6px 9px;
            border-radius: 999px;
            color: var(--ca-primary-dark);
            background: var(--ca-primary-soft);
            font-weight: 700;
            white-space: nowrap;
        }

        .data-table {
            min-width: 1080px;
            margin-bottom: 0;
        }

        .data-table thead th {
            padding: 12px 16px;
            border-bottom: 1px solid #edf1f1;
            color: #7b8795;
            background: #fbfcfc;
            font-size: 11px;
            font-weight: 750;
            letter-spacing: .035em;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .data-table tbody td {
            padding: 14px 16px;
            border-color: #edf1f1;
            color: #475467;
            font-size: 12.5px;
            vertical-align: middle;
        }

        .student-name {
            color: var(--ca-text);
            font-size: 12px;
            font-weight: 650;
        }

        .student-meta {
            margin-top: 2px;
            color: var(--ca-muted);
            font-size: 11px;
        }

        .status-badge,

        .consent-badge {
            padding: 5px 9px;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 11px;
            font-weight: 680;
            white-space: nowrap;
        }

        .status-active,

        .consent-yes {
            color: #027a48;
            background: #ecfdf3;
        }

        .status-inactive {
            color: #b42318;
            background: #fef3f2;
        }

        .consent-no {
            color: #667085;
            background: #f2f4f7;
        }

        .detail-button {
            min-height: 36px;
            padding: 7px 11px;
            border: 1px solid #b8d9d6;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            color: var(--ca-primary-dark);
            background: #f7fbfa;
            font-size: 11px;
            font-weight: 680;
        }

        .detail-button:hover {
            color: #ffffff;
            border-color: var(--ca-primary);
            background: var(--ca-primary);
        }

        .empty-state {
            padding: 46px 20px;
            color: var(--ca-muted);
            text-align: center;
            font-size: .8rem;
        }

        .privacy-note {
            margin-top: 18px;
            padding: 13px 15px;
            border: 1px solid #cfe4e1;
            border-radius: 10px;
            display: flex;
            align-items: flex-start;
            gap: 9px;
            color: #55706d;
            background: #f3f9f8;
            font-size: 11.5px;
            line-height: 1.55;
        }

        .pagination-wrap {
            padding: 15px 18px;
            border-top: 1px solid #edf1f1;
        }

        .pagination-nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        .pagination-pages {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .pagination-button,

        .pagination-page {
            min-width: 34px;
            height: 34px;
            padding: 0 9px;
            border: 1px solid #dfe6e6;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #475467;
            background: #ffffff;
            font-size: .75rem;
            font-weight: 620;
        }

        .pagination-button:hover,

        .pagination-page:hover {
            color: var(--ca-primary-dark);
            border-color: #b8d9d6;
            background: var(--ca-primary-soft);
        }

        .pagination-page.active {
            color: #ffffff;
            border-color: var(--ca-primary);
            background: var(--ca-primary);
        }

        .pagination-button.disabled {
            pointer-events: none;
            opacity: .45;
        }

        .pagination-info {
            color: var(--ca-muted);
            font-size: 11px;
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

        @media (max-width: 1180px) {

            .summary-grid {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }

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

        }

        @media (max-width: 767.98px) {

            .summary-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .pagination-nav {
                align-items: stretch;
                flex-direction: column;
            }

            .pagination-pages {
                flex-wrap: wrap;
            }

        }

        @media (max-width: 575.98px) {

            .summary-grid {
                grid-template-columns: 1fr;
            }

            .date-chip {
                display: none;
            }

            .account-trigger {
                min-width: auto;
                padding: 5px;
            }

            .account-copy {
                display: none !important;
            }

            .page-title {
                font-size: 1.4rem;
            }

        }

    </style>
    @include('guru-bk.partials.styles')
</head>

<body>

@php
    $namaUser = ucwords($user->name);
    $inisial = strtoupper(substr($user->name, 0, 1));
@endphp
<div class="app-shell">

    @include('guru-bk.partials.sidebar')

    <header class="topbar">
        <div class="topbar-left">
            <button type="button" class="mobile-sidebar-button" id="openSidebarButton">
                <i class="bi bi-list"></i>
            </button>
            <div>
                <div class="topbar-title">Data Siswa</div>
                <div class="topbar-subtitle">Informasi siswa yang mendapat layanan BK.</div>
            </div>
        </div>
        <div class="topbar-actions">
            @include('guru-bk.partials.notification-bell')
            <div class="date-chip">
                <i class="bi bi-calendar3"></i>
                {{ now()->locale('id')->translatedFormat('d F Y') }}

            </div>
            <a href="{{ route('guru-bk.profil.index') }}" class="account-trigger">
                <span class="topbar-avatar">{{ $inisial }}</span>
                <span class="account-copy">
                    <span class="account-name d-block">{{ $namaUser }}</span>
                    <span class="account-role d-block">Guru BK</span>
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
                        <div class="page-kicker">Direktori Operasional</div>
                        <h1 class="page-title">Data Siswa</h1>
                        <p class="page-copy">
                            Informasi siswa yang mendapat layanan BK.
                        </p>
                    </div>
                </section>

                <section class="summary-grid">
                    <div class="summary-card total">
                        <div class="summary-head">
                            <span class="summary-label">Total Terdaftar</span>
                            <span class="summary-icon"><i class="bi bi-people"></i></span>
                        </div>
                        <div class="summary-value">{{ $summary['total'] }}</div>
                    </div>
                    <div class="summary-card active">
                        <div class="summary-head">
                            <span class="summary-label">Siswa Aktif</span>
                            <span class="summary-icon"><i class="bi bi-person-check"></i></span>
                        </div>
                        <div class="summary-value">{{ $summary['aktif'] }}</div>
                    </div>
                    <div class="summary-card unassigned">
                        <div class="summary-head">
                            <span class="summary-label">Siswa Nonaktif</span>
                            <span class="summary-icon"><i class="bi bi-person-dash"></i></span>
                        </div>
                        <div class="summary-value">{{ $summary['nonaktif'] }}</div>
                    </div>
                    <div class="summary-card">
                        <div class="summary-head">
                            <span class="summary-label">Nomor WA Tersedia</span>
                            <span class="summary-icon"><i class="bi bi-whatsapp"></i></span>
                        </div>
                        <div class="summary-value">{{ $summary['whatsapp'] }}</div>
                    </div>
                    <div class="summary-card">
                        <div class="summary-head">
                            <span class="summary-label">Izin WA Aktif</span>
                            <span class="summary-icon"><i class="bi bi-bell"></i></span>
                        </div>
                        <div class="summary-value">{{ $summary['izin_whatsapp'] }}</div>
                    </div>
                </section>

                <form method="GET" action="{{ route('guru-bk.data-siswa.index') }}" class="filter-card">
                    <div class="row g-3 align-items-end">
                        <div class="col-md-12 col-lg-5">
                            <label for="q" class="form-label">Cari Siswa</label>
                            <input
                                type="text"
                                class="form-control"
                                id="q"
                                name="q"
                                value="{{ $search }}"
                                placeholder="Nama, NIS, email, atau WhatsApp"
                            >
                        </div>
                        <div class="col-md-6 col-lg">
                            <label for="tahun_ajaran" class="form-label">Tahun Ajaran</label>
                            <select class="form-select" id="tahun_ajaran" name="tahun_ajaran">
                                <option value="">Semua Tahun Ajaran</option>

                                @foreach ($tahunAjaranOptions ?? [] as $ta)
                                    <option
                                        value="{{ $ta }}"
                                        @selected((string) ($tahunAjaran ?? '') === (string) $ta)
                                    >
                                        {{ $ta }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 col-lg">
                            <label for="kelas_id" class="form-label">Kelas</label>
                            <select class="form-select" id="kelas_id" name="kelas_id">
                                <option value="">Semua Kelas</option>

                                @foreach ($kelasOptions as $kelas)
                                    <option
                                        value="{{ $kelas->id }}"
                                        data-tahun-ajaran="{{ $kelas->tahun_ajaran }}"
                                        @selected((string) $kelasId === (string) $kelas->id)
                                    >
                                        {{ $kelas->nama_kelas }}

                                        @if ($kelas->tahun_ajaran)
                                            · {{ $kelas->tahun_ajaran }}

                                        @endif
                                    </option>

                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-auto ms-auto">
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn-filter" title="Cari / Terapkan">
                                    <i class="bi bi-search"></i>
                                </button>
                                <a href="{{ route('guru-bk.data-siswa.index') }}" class="btn-reset" title="Reset Filter">
                                    <i class="bi bi-arrow-counterclockwise"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </form>

                <section class="table-card">
                    <div class="table-card-header">
                        <div>
                            <div class="table-title">Daftar Siswa Terdaftar</div>
                            <div class="table-copy">Data identitas dasar bersifat read-only pada Portal Guru BK.</div>
                        </div>
                        <span class="result-count">
                            {{ $siswa->total() }} siswa
                        </span>
                    </div>

                    @if ($siswa->isEmpty())
                        <div class="empty-state">
                            Tidak ada siswa yang sesuai dengan filter.
                        </div>

                    @else
                        <div class="table-responsive">
                            <table class="table data-table align-middle">
                                <thead>
                                    <tr>
                                        <th>Siswa</th>
                                        <th>Kelas</th>
                                        <th>Tahun Masuk</th>
                                        <th>WhatsApp</th>
                                        <th>Izin WA</th>
                                        <th>Status Akun</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($siswa as $item)

                                        @php
                                            $nomorWhatsappDisplay = $item->whatsapp_number
                                                ? (
                                                    str_starts_with($item->whatsapp_number, '62')
                                                        ? '0' . substr($item->whatsapp_number, 2)
                                                        : $item->whatsapp_number
                                                )
                                                : null;
                                        @endphp
                                        <tr>
                                            <td>
                                                <div class="student-name">{{ $item->name }}</div>
                                                <div class="student-meta">
                                                    NIS {{ $item->nis ?: '-' }} ·
                                                    @if ($item->email && ! str_ends_with($item->email, '@siswa.curhataman.local'))
                                                        {{ $item->email }}
                                                    @else
                                                        <span class="fst-italic">Email belum dilengkapi</span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                @if (! empty($item->arsip_nama_kelas))
                                                    <div class="fw-semibold">{{ $item->arsip_nama_kelas }}</div>
                                                    <div class="student-meta">
                                                        Arsip {{ $item->arsip_tahun_ajaran }}
                                                        @if ($item->nama_kelas)
                                                            · Sekarang: {{ $item->nama_kelas }}
                                                        @endif
                                                    </div>
                                                @else
                                                    {{ $item->nama_kelas ?: 'Belum ada kelas' }}

                                                    @if ($item->tahun_ajaran)
                                                        <div class="student-meta">{{ $item->tahun_ajaran }}</div>

                                                    @endif
                                                @endif
                                            </td>
                                            <td>{{ $item->tahun_masuk ?: '-' }}</td>
                                            <td>{{ $nomorWhatsappDisplay ?: 'Belum tersedia' }}</td>
                                            <td>

                                                @if ($item->whatsapp_consent)
                                                    <span class="consent-badge consent-yes">
                                                        <i class="bi bi-check-circle"></i>
                                                        Diizinkan
                                                    </span>

                                                @else
                                                    <span class="consent-badge consent-no">
                                                        <i class="bi bi-dash-circle"></i>
                                                        Belum diizinkan
                                                    </span>

                                                @endif
                                            </td>
                                            <td>

                                                @if ($item->is_active)
                                                    <span class="status-badge status-active">
                                                        <i class="bi bi-check-circle"></i>
                                                        Aktif
                                                    </span>

                                                @else
                                                    <span class="status-badge status-inactive">
                                                        <i class="bi bi-x-circle"></i>
                                                        Nonaktif
                                                    </span>

                                                @endif
                                            </td>
                                            <td>
                                                <a
                                                    href="{{ route('guru-bk.data-siswa.show', $item->id) }}"
                                                    class="detail-button"
                                                >
                                                    Detail
                                                    <i class="bi bi-chevron-right"></i>
                                                </a>
                                            </td>
                                        </tr>

                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        @if ($siswa->hasPages())

                            @php
                                $currentPage = $siswa->currentPage();
                                $lastPage = $siswa->lastPage();
                                $startPage = max(1, $currentPage - 2);
                                $endPage = min($lastPage, $currentPage + 2);
                            @endphp
                            <div class="pagination-wrap">
                                <div class="pagination-nav">
                                    <div class="pagination-info">
                                        Halaman {{ $currentPage }} dari {{ $lastPage }}

                                    </div>
                                    <div class="pagination-pages">
                                        <a
                                            href="{{ $siswa->previousPageUrl() ?: '#' }}"
                                            class="pagination-button {{ $siswa->onFirstPage() ? 'disabled' : '' }}"
                                            aria-label="Halaman sebelumnya"

                                            @if ($siswa->onFirstPage()) aria-disabled="true" @endif
                                        >
                                            <i class="bi bi-chevron-left"></i>
                                        </a>
                                        @for ($page = $startPage; $page <= $endPage; $page++)
                                            <a
                                                href="{{ $siswa->url($page) }}"
                                                class="pagination-page {{ $page === $currentPage ? 'active' : '' }}"
                                            >
                                                {{ $page }}

                                            </a>
                                        @endfor
                                        <a
                                            href="{{ $siswa->nextPageUrl() ?: '#' }}"
                                            class="pagination-button {{ $siswa->hasMorePages() ? '' : 'disabled' }}"
                                            aria-label="Halaman berikutnya"

                                            @if (! $siswa->hasMorePages()) aria-disabled="true" @endif
                                        >
                                            <i class="bi bi-chevron-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>

                        @endif

                    @endif
                </section>

                <div class="privacy-note">
                    <i class="bi bi-shield-lock"></i>
                    <div>
                        Halaman Data Siswa tidak menampilkan jawaban skrining, kronologi laporan, bukti, alasan rujukan, atau catatan pendampingan. Detail sensitif tetap dibuka melalui modul yang sesuai dengan kebutuhan penanganan.
                    </div>
                </div>

                <footer class="page-footer">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2">
                        <span>© {{ date('Y') }} CurhatAman</span>
                        <span>Portal Guru BK · Direktori siswa bersifat read-only</span>
                    </div>
                </footer>

            </div>
        </div>
    </main>
</div>
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    const sidebar = document.getElementById('bkSidebar');
    const openSidebarButton = document.getElementById('openSidebarButton');
    const sidebarOverlay = document.getElementById('sidebarOverlay');
    function openSidebar() {
        sidebar?.classList.add('show');
        sidebarOverlay?.classList.add('show');
    }

    function closeSidebar() {
        sidebar?.classList.remove('show');
        sidebarOverlay?.classList.remove('show');
    }

    openSidebarButton?.addEventListener('click', openSidebar);
    sidebarOverlay?.addEventListener('click', closeSidebar);
    window.addEventListener('resize', function () {
        if (window.innerWidth >= 992) {
            closeSidebar();
        }

    });

    // Sinkronisasi opsi Kelas berdasarkan Tahun Ajaran yang dipilih
    const tahunAjaranSelect = document.getElementById('tahun_ajaran');
    const kelasSelect = document.getElementById('kelas_id');

    function filterKelasByTahunAjaran() {
        if (!tahunAjaranSelect || !kelasSelect) return;
        const selectedTA = tahunAjaranSelect.value;
        const options = kelasSelect.querySelectorAll('option[data-tahun-ajaran]');

        options.forEach(function (option) {
            const optionTA = option.getAttribute('data-tahun-ajaran') || '';
            const matches = !selectedTA || optionTA === selectedTA;
            option.hidden = !matches;
            option.disabled = !matches;
        });

        const currentSelectedOption = kelasSelect.options[kelasSelect.selectedIndex];
        if (currentSelectedOption && currentSelectedOption.disabled) {
            kelasSelect.value = '';
        }
    }

    tahunAjaranSelect?.addEventListener('change', filterKelasByTahunAjaran);
    filterKelasByTahunAjaran();
</script>
</body>
</html>


