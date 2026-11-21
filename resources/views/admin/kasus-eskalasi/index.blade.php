@php
    $errors = $errors ?? new \Illuminate\Support\ViewErrorBag();
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Kasus Eskalasi | CurhatAman</title>

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
            --ca-danger: #b42318;
            --ca-danger-soft: #fff1f0;
            --ca-warning: #b54708;
            --ca-warning-soft: #fff7ed;
            --ca-success: #027a48;
            --ca-success-soft: #ecf8f2;
            --ca-info: #2d6f9f;
            --ca-info-soft: #eef6fb;
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

        .sidebar-link.disabled {
            color: #a4acb8;
            pointer-events: none;
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
            max-width: 1180px;
            margin: 0 auto;
        }

        .page-header {
            margin-bottom: 22px;
            padding: 21px 22px;
            border-radius: 12px;
            display: flex;
            justify-content: space-between;
            gap: 20px;
            align-items: flex-end;
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
            font-weight: 760;
            letter-spacing: -.02em;
        }

        .page-copy {
            max-width: 750px;
            margin: 7px 0 0;
            color: rgba(255, 255, 255, .82);
            font-size: 12.5px;
            line-height: 1.65;
        }

        .scope-badge {
            min-height: 36px;
            padding: 0 12px;
            border: 1px solid rgba(255, 255, 255, .42);
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            gap: 7px;
            color: #ffffff;
            background: rgba(255, 255, 255, .12);
            font-size: 10.5px;
            font-weight: 650;
            white-space: nowrap;
        }

        .metric-card {
            position: relative;
            height: 100%;
            min-height: 126px;
            padding: 18px 19px;
            border: 1px solid var(--ca-border);
            border-top: 3px solid #d6dddd;
            border-radius: 12px;
            background: #ffffff;
        }

        .metric-card.total {
            border-top-color: var(--ca-danger);
        }

        .metric-card.assigned {
            border-top-color: var(--ca-primary);
        }

        .metric-card.unassigned {
            border-top-color: #e6a33b;
        }

        .metric-card.stale {
            border-top-color: #c77a2a;
        }

        .metric-top {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 14px;
        }

        .metric-label {
            color: var(--ca-muted);
            font-size: 10.5px;
            font-weight: 600;
        }

        .metric-value {
            margin-top: 7px;
            color: var(--ca-text);
            font-size: 25px;
            font-weight: 760;
            line-height: 1;
        }

        .metric-note {
            margin-top: 10px;
            color: var(--ca-muted);
            font-size: 10.5px;
        }

        .metric-icon {
            width: 36px;
            height: 36px;
            border-radius: 9px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
        }

        .metric-icon.danger {
            color: var(--ca-danger);
            background: var(--ca-danger-soft);
        }

        .metric-icon.primary {
            color: var(--ca-primary);
            background: var(--ca-primary-soft);
        }

        .metric-icon.warning {
            color: var(--ca-warning);
            background: var(--ca-warning-soft);
        }

        .content-card {
            border: 1px solid var(--ca-border);
            border-top: 3px solid var(--ca-danger);
            border-radius: 12px;
            background: #ffffff;
            overflow: hidden;
        }

        .card-header-main {
            padding: 18px 20px;
            border-bottom: 1px solid var(--ca-line);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            background: #ffffff;
        }

        .card-title {
            margin: 0;
            color: var(--ca-text);
            font-size: 13.5px;
            font-weight: 700;
        }

        .card-subtitle {
            margin-top: 4px;
            color: var(--ca-muted);
            font-size: 10.5px;
        }

        .search-form {
            width: min(380px, 100%);
        }

        .search-wrap {
            position: relative;
        }

        .search-icon {
            position: absolute;
            top: 50%;
            left: 13px;
            transform: translateY(-50%);
            color: #98a2b3;
            font-size: 13px;
        }

        .search-input {
            min-height: 40px;
            padding-left: 36px;
            padding-right: 84px;
            border: 1px solid var(--ca-border);
            border-radius: 9px;
            color: var(--ca-text);
            background: #ffffff;
            font-size: 11.5px;
            box-shadow: none;
        }

        .search-input:focus {
            border-color: rgba(15, 138, 131, .55);
            box-shadow: 0 0 0 .2rem rgba(15, 138, 131, .08);
        }

        .btn-search {
            position: absolute;
            top: 5px;
            right: 5px;
            height: 30px;
            padding: 0 12px;
            border: 0;
            border-radius: 7px;
            color: #ffffff;
            background: var(--ca-primary);
            font-size: 10.5px;
            font-weight: 650;
        }

        .btn-search:hover {
            background: var(--ca-primary-dark);
        }

        .report-table {
            margin: 0;
            font-size: 11.5px;
        }

        .report-table thead th {
            padding: 12px 16px;
            border-bottom: 1px solid #dfeceb;
            color: #546665;
            background: #f4faf9;
            font-size: 9.5px;
            font-weight: 760;
            letter-spacing: .05em;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .report-table tbody td {
            padding: 14px 16px;
            border-color: var(--ca-line);
            color: #344054;
            background: #ffffff;
            vertical-align: middle;
        }

        .report-table tbody tr:hover td {
            background: #fbfdfd;
        }

        .report-code {
            color: var(--ca-primary-dark);
            font-weight: 720;
        }

        .category-name {
            color: var(--ca-text);
            font-weight: 620;
        }

        .meta {
            margin-top: 3px;
            color: var(--ca-muted);
            font-size: 10px;
        }

        .badge-escalated,
        .badge-stale {
            padding: 5px 8px;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 9.5px;
            font-weight: 680;
            white-space: nowrap;
        }

        .badge-escalated {
            color: var(--ca-danger);
            background: var(--ca-danger-soft);
        }

        .badge-stale {
            color: var(--ca-warning);
            background: var(--ca-warning-soft);
        }

        .badge-private {
            margin-top: 5px;
            color: #6941c6;
            font-size: 9.5px;
            font-weight: 650;
        }

        .btn-detail {
            min-height: 32px;
            padding: 0 10px;
            border: 1px solid #cfe3e1;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            color: var(--ca-primary-dark);
            background: #f6fbfa;
            font-size: 10.5px;
            font-weight: 650;
            white-space: nowrap;
        }

        .btn-detail:hover {
            color: var(--ca-primary-dark);
            background: var(--ca-primary-soft);
        }

        .btn-detail.disabled {
            color: #98a2b3;
            border-color: var(--ca-border);
            background: #fafafa;
            pointer-events: none;
        }

        .empty-state {
            padding: 48px 20px;
            color: var(--ca-muted);
            text-align: center;
        }

        .empty-icon {
            width: 44px;
            height: 44px;
            margin: 0 auto 12px;
            border-radius: 11px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--ca-primary);
            background: var(--ca-primary-soft);
            font-size: 18px;
        }

        .pagination-wrap {
            padding: 14px 18px;
            border-top: 1px solid var(--ca-line);
        }

        .pagination {
            margin-bottom: 0;
        }

        .page-link {
            color: var(--ca-primary-dark);
            border-color: var(--ca-border);
            font-size: 11px;
        }

        .page-link:hover {
            color: var(--ca-primary-dark);
            background: var(--ca-primary-soft);
            border-color: #cfe4e1;
        }

        .active > .page-link,
        .page-link.active {
            color: #ffffff;
            background: var(--ca-primary);
            border-color: var(--ca-primary);
        }

        .privacy-note {
            margin-top: 16px;
            padding: 13px 15px;
            border: 1px solid #d9e8e6;
            border-radius: 10px;
            display: flex;
            align-items: flex-start;
            gap: 9px;
            color: var(--ca-muted);
            background: #f8fbfa;
            font-size: 10.5px;
            line-height: 1.55;
        }

        .privacy-note i {
            margin-top: 1px;
            color: var(--ca-primary);
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

            .page-header,
            .card-header-main {
                align-items: flex-start;
                flex-direction: column;
            }

            .search-form {
                width: 100%;
            }
        }

        @media (max-width: 767.98px) {
            :root {
                --topbar-height: 74px;
            }

            .date-chip,
            .account-copy,
            .account-chevron {
                display: none !important;
            }

            .account-trigger {
                min-width: 0;
                width: 42px;
                height: 42px;
                padding: 3px;
            }

            .scope-badge {
                white-space: normal;
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
            Kasus Eskalasi
        </div>

        <div class="topbar-subtitle">
            Pengawasan kasus yang telah dinaikkan ke tingkat sekolah
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
            <span class="topbar-avatar">
                {{ $inisial }}
            </span>

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

            <section class="page-header">

                <div>
                    <div class="page-kicker">
                        Pengawasan Penanganan
                    </div>

                    <h1 class="page-title">
                        Kasus yang Dieskalasi
                    </h1>

                    <p class="page-copy">
                        Halaman ini hanya menampilkan laporan dengan status
                        dieskalasi. Admin memantau penanganan pada tingkat
                        sekolah tanpa mengambil alih pencatatan tindak lanjut
                        rutin milik Guru BK.
                    </p>
                </div>

                <div class="scope-badge">
                    <i class="bi bi-shield-check"></i>
                    Akses khusus kasus dieskalasi
                </div>

            </section>

            <section class="row g-3 mb-4">

                <div class="col-sm-6 col-xl-3">
                    <div class="metric-card total">
                        <div class="metric-top">
                            <div>
                                <div class="metric-label">
                                    Total Dieskalasi
                                </div>

                                <div class="metric-value">
                                    {{ $ringkasan['total'] }}
                                </div>
                            </div>

                            <span class="metric-icon danger">
                                <i class="bi bi-exclamation-diamond"></i>
                            </span>
                        </div>

                        <div class="metric-note">
                            Seluruh kasus berstatus dieskalasi
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-xl-3">
                    <div class="metric-card assigned">
                        <div class="metric-top">
                            <div>
                                <div class="metric-label">
                                    Dengan Guru BK
                                </div>

                                <div class="metric-value">
                                    {{ $ringkasan['dengan_bk'] }}
                                </div>
                            </div>

                            <span class="metric-icon primary">
                                <i class="bi bi-person-check"></i>
                            </span>
                        </div>

                        <div class="metric-note">
                            Memiliki penanggung jawab aktif
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-xl-3">
                    <div class="metric-card unassigned">
                        <div class="metric-top">
                            <div>
                                <div class="metric-label">
                                    Tanpa Guru BK
                                </div>

                                <div class="metric-value">
                                    {{ $ringkasan['tanpa_bk'] }}
                                </div>
                            </div>

                            <span class="metric-icon warning">
                                <i class="bi bi-person-exclamation"></i>
                            </span>
                        </div>

                        <div class="metric-note">
                            Belum memiliki penanggung jawab
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-xl-3">
                    <div class="metric-card stale">
                        <div class="metric-top">
                            <div>
                                <div class="metric-label">
                                    Tidak Diperbarui 7+ Hari
                                </div>

                                <div class="metric-value">
                                    {{ $ringkasan['lama_tidak_diperbarui'] }}
                                </div>
                            </div>

                            <span class="metric-icon warning">
                                <i class="bi bi-clock-history"></i>
                            </span>
                        </div>

                        <div class="metric-note">
                            Perlu perhatian terhadap progres
                        </div>
                    </div>
                </div>

            </section>

            <section class="content-card">

                <div class="card-header-main">

                    <div>
                        <h2 class="card-title">
                            Daftar Kasus Eskalasi
                        </h2>

                        <div class="card-subtitle">
                            Urutan berdasarkan pembaruan terakhir
                        </div>
                    </div>

                    <form
                        method="GET"
                        action="{{ route('admin.kasus-eskalasi.index') }}"
                        class="search-form"
                    >
                        <div class="search-wrap">
                            <i class="bi bi-search search-icon"></i>

                            <input
                                type="text"
                                name="q"
                                value="{{ $q }}"
                                class="form-control search-input"
                                placeholder="Cari kode, kategori, kelas, atau Guru BK"
                            >

                            <button
                                type="submit"
                                class="btn-search"
                            >
                                Cari
                            </button>
                        </div>
                    </form>

                </div>

                @if($kasus->isEmpty())

                    <div class="empty-state">

                        <div class="empty-icon">
                            <i class="bi bi-shield-check"></i>
                        </div>

                        <div class="fw-semibold mb-1">
                            Belum Ada Kasus Eskalasi
                        </div>

                        <div class="small">
                            Kasus yang dinaikkan oleh Guru BK akan muncul di halaman ini.
                        </div>

                    </div>

                @else

                    <div class="table-responsive">
                        <table class="table report-table">

                            <thead>
                                <tr>
                                    <th>Laporan</th>
                                    <th>Kategori & Kelas</th>
                                    <th>Guru BK</th>
                                    <th>Status</th>
                                    <th>Pembaruan Terakhir</th>
                                    <th class="text-end">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach($kasus as $item)

                                    @php
                                        $updatedAt = \Carbon\Carbon::parse(
                                            $item->updated_at
                                        );

                                        $stale = $updatedAt->lte(
                                            now()->subDays(7)
                                        );
                                    @endphp

                                    <tr>

                                        <td>
                                            <div class="report-code">
                                                {{ $item->kode_laporan }}
                                            </div>

                                            <div class="meta">
                                                Dikirim:
                                                {{ $item->submitted_at
                                                    ? \Carbon\Carbon::parse($item->submitted_at)
                                                        ->locale('id')
                                                        ->translatedFormat('d M Y')
                                                    : '-' }}
                                            </div>

                                            @if($item->status_rahasia)
                                                <div class="badge-private">
                                                    <i class="bi bi-shield-lock"></i>
                                                    Laporan rahasia
                                                </div>
                                            @endif
                                        </td>

                                        <td>
                                            <div class="category-name">
                                                {{ $item->nama_kategori }}
                                            </div>

                                            <div class="meta">
                                                {{ $item->nama_kelas ?? 'Kelas belum ditentukan' }}
                                            </div>
                                        </td>

                                        <td>
                                            @if($item->nama_bk)
                                                <div class="category-name">
                                                    {{ $item->nama_bk }}
                                                </div>

                                                <div class="meta">
                                                    Penanggung jawab
                                                </div>
                                            @else
                                                <span class="text-secondary">
                                                    Belum ditugaskan
                                                </span>
                                            @endif
                                        </td>

                                        <td>
                                            <span class="badge-escalated">
                                                <i class="bi bi-exclamation-circle"></i>
                                                Dieskalasi
                                            </span>
                                        </td>

                                        <td>
                                            <div>
                                                {{ $updatedAt
                                                    ->locale('id')
                                                    ->translatedFormat('d M Y, H:i') }}
                                            </div>

                                            @if($stale)
                                                <div class="mt-2">
                                                    <span class="badge-stale">
                                                        <i class="bi bi-clock-history"></i>
                                                        7+ hari
                                                    </span>
                                                </div>
                                            @endif
                                        </td>

                                        <td class="text-end">
                                            <a
                                                href="{{ route(
                                                    'admin.kasus-eskalasi.show',
                                                    $item->id
                                                ) }}"
                                                class="btn-detail"
                                            >
                                                <i class="bi bi-eye"></i>
                                                Lihat Detail
                                            </a>
                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>
                    </div>

                    @if($kasus->hasPages())
                        <div class="pagination-wrap">
                            {{ $kasus->links() }}
                        </div>
                    @endif

                @endif

            </section>

            <div class="privacy-note">
                <i class="bi bi-info-circle"></i>

                <div>
                    Pada daftar ini identitas siswa tidak ditampilkan.
                    Identitas dan detail sensitif hanya akan dibuka ketika
                    Admin masuk ke detail kasus dieskalasi yang memang
                    memerlukan pengawasan tingkat sekolah.
                </div>
            </div>

            <footer class="page-footer">
                <div class="d-flex flex-column flex-md-row justify-content-between gap-2 w-100">
                    <span>© {{ date('Y') }} CurhatAman</span>
                    <span>Portal Admin Sekolah · Pengawasan kasus eskalasi</span>
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
