@php
    $errors = $errors ?? new \Illuminate\Support\ViewErrorBag();
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Aktivitas Guru BK | CurhatAman</title>

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
            --ca-success: #027a48;
            --ca-success-soft: #ecf8f2;
            --ca-warning: #b54708;
            --ca-warning-soft: #fff7ed;
            --ca-danger: #b42318;
            --ca-danger-soft: #fff1f0;
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
            align-items: flex-end;
            justify-content: space-between;
            gap: 20px;
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
            max-width: 760px;
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
            border-top-color: var(--ca-primary);
        }

        .metric-card.active {
            border-top-color: #35a36f;
        }

        .metric-card.cases {
            border-top-color: #d99a2b;
        }

        .metric-card.followup {
            border-top-color: #4f8fb8;
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
            line-height: 1.5;
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

        .metric-icon.primary {
            color: var(--ca-primary);
            background: var(--ca-primary-soft);
        }

        .metric-icon.success {
            color: var(--ca-success);
            background: var(--ca-success-soft);
        }

        .metric-icon.warning {
            color: var(--ca-warning);
            background: var(--ca-warning-soft);
        }

        .content-card {
            border: 1px solid var(--ca-border);
            border-top: 3px solid var(--ca-primary);
            border-radius: 12px;
            overflow: hidden;
            background: #ffffff;
        }

        .card-header-main {
            padding: 18px 20px;
            border-bottom: 1px solid var(--ca-line);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
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

        .filters {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
            justify-content: flex-end;
        }

        .search-wrap {
            position: relative;
            width: 280px;
        }

        .search-icon {
            position: absolute;
            top: 50%;
            left: 12px;
            transform: translateY(-50%);
            color: #98a2b3;
            font-size: 12px;
        }

        .filter-input,
        .filter-select {
            min-height: 39px;
            border: 1px solid var(--ca-border);
            border-radius: 9px;
            color: var(--ca-text);
            background-color: #ffffff;
            font-size: 11px;
            box-shadow: none;
        }

        .filter-input {
            padding-left: 34px;
        }

        .filter-input:focus,
        .filter-select:focus {
            border-color: rgba(15, 138, 131, .55);
            box-shadow: 0 0 0 .2rem rgba(15, 138, 131, .08);
        }

        .filter-select {
            width: 132px;
        }

        .btn-filter {
            min-height: 39px;
            padding: 0 13px;
            border: 1px solid var(--ca-primary);
            border-radius: 9px;
            color: #ffffff;
            background: var(--ca-primary);
            font-size: 10.5px;
            font-weight: 650;
        }

        .btn-filter:hover {
            background: var(--ca-primary-dark);
            border-color: var(--ca-primary-dark);
        }

        .activity-table {
            margin: 0;
            font-size: 11px;
        }

        .activity-table thead th {
            padding: 11px 11px;
            border-bottom: 1px solid #dfeceb;
            color: #546665;
            background: #f4faf9;
            font-size: 9px;
            font-weight: 760;
            letter-spacing: .035em;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .activity-table tbody td {
            padding: 12px 11px;
            border-color: var(--ca-line);
            color: #344054;
            background: #ffffff;
            vertical-align: middle;
        }

        .completion-wrap {
            min-width: 115px;
        }

        .completion-top {
            display: flex;
            align-items: baseline;
            justify-content: space-between;
            gap: 6px;
        }

        .completion-bar {
            height: 6px;
            margin-top: 5px;
            border-radius: 999px;
            overflow: hidden;
            background: #e9f0ef;
        }

        .completion-bar-fill {
            height: 100%;
            border-radius: 999px;
            background: var(--ca-primary);
            transition: width .25s ease;
        }

        .activity-table tbody tr:hover td {
            background: #fbfdfd;
        }

        .bk-cell {
            display: flex;
            align-items: center;
            gap: 10px;
            min-width: 185px;
        }

        .bk-avatar {
            width: 34px;
            height: 34px;
            flex: 0 0 34px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: var(--ca-primary-dark);
            background: var(--ca-primary-soft);
            font-size: 9.5px;
            font-weight: 760;
        }

        .bk-name {
            color: var(--ca-text);
            font-size: 11.5px;
            font-weight: 680;
        }

        .bk-email {
            margin-top: 2px;
            color: var(--ca-muted);
            font-size: 9.5px;
        }

        .status-badge {
            padding: 5px 8px;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 9.5px;
            font-weight: 680;
            white-space: nowrap;
        }

        .status-badge.active {
            color: var(--ca-success);
            background: var(--ca-success-soft);
        }

        .status-badge.inactive {
            color: #667085;
            background: #f2f4f7;
        }

        .number-main {
            color: var(--ca-text);
            font-size: 12px;
            font-weight: 700;
        }

        .number-meta {
            margin-top: 2px;
            color: var(--ca-muted);
            font-size: 9.5px;
        }

        .last-activity {
            min-width: 130px;
            color: var(--ca-text);
            font-size: 10.5px;
            font-weight: 600;
        }

        .last-activity-meta {
            margin-top: 2px;
            color: var(--ca-muted);
            font-size: 9.5px;
            font-weight: 400;
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

        .info-note {
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

        .info-note i {
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

            .filters {
                width: 100%;
                justify-content: flex-start;
            }

            .search-wrap {
                width: min(100%, 360px);
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

            .search-wrap,
            .filter-select {
                width: 100%;
            }

            .btn-filter {
                width: 100%;
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
        ->map(
            fn ($bagian) =>
                mb_strtoupper(
                    mb_substr($bagian, 0, 1)
                )
        )
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
            Aktivitas Guru BK
        </div>

        <div class="topbar-subtitle">
            Ringkasan aktivitas penanganan oleh Guru BK
        </div>

    </div>

    </div>

    <div class="topbar-actions">

            @include('admin.partials.notification-bell')

        <div class="date-chip">
            <i class="bi bi-calendar3"></i>

            {{ now()
                ->locale('id')
                ->translatedFormat('d F Y') }}
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

            <i
                class="bi bi-chevron-right account-chevron"
            ></i>
        </a>

    </div>

</header>

<main class="main-content">

    <div class="page-body">
        <div class="content-shell">

            <section class="page-header">

                <div>

                    <div class="page-kicker">
                        Pemantauan Operasional
                    </div>

                    <h1 class="page-title">
                        Aktivitas Guru BK
                    </h1>

                    <p class="page-copy">
                        Ringkasan ini membantu Admin melihat beban penanganan
                        dan aktivitas tindak lanjut masing-masing Guru BK
                        tanpa membuka isi kasus reguler.
                    </p>

                </div>

                <div class="scope-badge">
                    <i class="bi bi-eye"></i>
                    Ringkasan aktivitas
                </div>

            </section>

            <section class="row row-cols-1 row-cols-sm-2 row-cols-xl-5 g-3 mb-4">

                <div class="col">

                    <div class="metric-card total">

                        <div class="metric-top">

                            <div>

                                <div class="metric-label">
                                    Total Guru BK
                                </div>

                                <div class="metric-value">
                                    {{ $ringkasan['total_bk'] }}
                                </div>

                            </div>

                            <span class="metric-icon primary">
                                <i class="bi bi-people"></i>
                            </span>

                        </div>

                        <div class="metric-note">
                            Seluruh akun dengan role Guru BK
                        </div>

                    </div>

                </div>

                <div class="col">

                    <div class="metric-card active">

                        <div class="metric-top">

                            <div>

                                <div class="metric-label">
                                    Guru BK Aktif
                                </div>

                                <div class="metric-value">
                                    {{ $ringkasan['bk_aktif'] }}
                                </div>

                            </div>

                            <span class="metric-icon success">
                                <i class="bi bi-person-check"></i>
                            </span>

                        </div>

                        <div class="metric-note">
                            Akun Guru BK yang masih aktif
                        </div>

                    </div>

                </div>

                <div class="col">

                    <div class="metric-card cases">

                        <div class="metric-top">

                            <div>

                                <div class="metric-label">
                                    Kasus Aktif Ditangani
                                </div>

                                <div class="metric-value">
                                    {{ $ringkasan['kasus_aktif'] }}
                                </div>

                            </div>

                            <span class="metric-icon warning">
                                <i class="bi bi-folder2-open"></i>
                            </span>

                        </div>

                        <div class="metric-note">
                            Baru atau sedang diproses
                        </div>

                    </div>

                </div>

                <div class="col">

                    <div class="metric-card followup">

                        <div class="metric-top">

                            <div>

                                <div class="metric-label">
                                    Tindak Lanjut Bulan Ini
                                </div>

                                <div class="metric-value">
                                    {{ $ringkasan['tindak_lanjut_bulan_ini'] }}
                                </div>

                            </div>

                            <span class="metric-icon primary">
                                <i class="bi bi-journal-check"></i>
                            </span>

                        </div>

                        <div class="metric-note">
                            Catatan tindak lanjut pada bulan berjalan
                        </div>

                    </div>

                </div>

                <div class="col">

                    <div class="metric-card active">

                        <div class="metric-top">

                            <div>

                                <div class="metric-label">
                                    Penyelesaian Kasus
                                </div>

                                <div class="metric-value">
                                    {{ $ringkasan['persentase_penyelesaian'] }}%
                                </div>

                            </div>

                            <span class="metric-icon success">
                                <i class="bi bi-check2-circle"></i>
                            </span>

                        </div>

                        <div class="metric-note">
                            {{ $ringkasan['total_selesai_bk'] }} dari {{ $ringkasan['total_kasus_bk'] }} kasus ditangani selesai
                        </div>

                    </div>

                </div>

            </section>

            <section class="content-card">

                <div class="card-header-main">

                    <div>

                        <h2 class="card-title">
                            Ringkasan per Guru BK
                        </h2>

                        <div class="card-subtitle">
                            Tidak digunakan sebagai peringkat kinerja
                        </div>

                    </div>

                    <form
                        method="GET"
                        action="{{ route(
                            'admin.aktivitas-guru-bk.index'
                        ) }}"
                        class="filters"
                    >

                        <div class="search-wrap">

                            <i
                                class="bi bi-search search-icon"
                            ></i>

                            <input
                                type="text"
                                name="q"
                                value="{{ $q }}"
                                class="form-control filter-input"
                                placeholder="Cari nama atau email Guru BK"
                            >

                        </div>

                        <select
                            name="status"
                            class="form-select filter-select"
                        >

                            <option value="">
                                Semua Status
                            </option>

                            <option
                                value="aktif"
                                @selected($status === 'aktif')
                            >
                                Aktif
                            </option>

                            <option
                                value="nonaktif"
                                @selected($status === 'nonaktif')
                            >
                                Nonaktif
                            </option>

                        </select>

                        <button
                            type="submit"
                            class="btn-filter"
                        >
                            Terapkan
                        </button>

                    </form>

                </div>

                @if($guruBk->isEmpty())

                    <div class="empty-state">

                        <div class="empty-icon">
                            <i class="bi bi-person-x"></i>
                        </div>

                        <div class="fw-semibold mb-1">
                            Data Guru BK Tidak Ditemukan
                        </div>

                        <div class="small">
                            Coba ubah kata kunci atau filter status akun.
                        </div>

                    </div>

                @else

                    <div class="table-responsive">

                        <table class="table activity-table">

                            <thead>
                                <tr>
                                    <th>Guru BK</th>
                                    <th>Status Akun</th>
                                    <th>Total Kasus</th>
                                    <th>Kasus Aktif</th>
                                    <th>Dieskalasi</th>
                                    <th>Selesai Bulan Ini</th>
                                    <th>Penyelesaian Kasus</th>
                                    <th>Tindak Lanjut Bulan Ini</th>
                                    <th>Tindak Lanjut Terakhir</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach($guruBk as $item)

                                    @php
                                        $inisialBk = collect(
                                            explode(
                                                ' ',
                                                trim($item->name)
                                            )
                                        )
                                            ->filter()
                                            ->take(2)
                                            ->map(
                                                fn ($bagian) =>
                                                    mb_strtoupper(
                                                        mb_substr(
                                                            $bagian,
                                                            0,
                                                            1
                                                        )
                                                    )
                                            )
                                            ->implode('');

                                        $tlTerakhir =
                                            $item->tindak_lanjut_terakhir
                                                ? \Carbon\Carbon::parse(
                                                    $item->tindak_lanjut_terakhir
                                                )
                                                : null;
                                    @endphp

                                    <tr>

                                        <td>

                                            <div class="bk-cell">

                                                <span class="bk-avatar">
                                                    {{ $inisialBk }}
                                                </span>

                                                <div>

                                                    <div class="bk-name">
                                                        {{ $item->name }}
                                                    </div>

                                                    <div class="bk-email">
                                                        {{ $item->email }}
                                                    </div>

                                                </div>

                                            </div>

                                        </td>

                                        <td>

                                            @if($item->is_active)

                                                <span
                                                    class="status-badge active"
                                                >
                                                    <i class="bi bi-check-circle"></i>
                                                    Aktif
                                                </span>

                                            @else

                                                <span
                                                    class="status-badge inactive"
                                                >
                                                    <i class="bi bi-pause-circle"></i>
                                                    Nonaktif
                                                </span>

                                            @endif

                                        </td>

                                        <td>
                                            <div class="number-main">
                                                {{ $item->total_kasus }}
                                            </div>

                                            <div class="number-meta">
                                                pernah ditangani
                                            </div>
                                        </td>

                                        <td>
                                            <div class="number-main">
                                                {{ $item->kasus_aktif }}
                                            </div>

                                            <div class="number-meta">
                                                masih berjalan
                                            </div>
                                        </td>

                                        <td>
                                            <div class="number-main">
                                                {{ $item->kasus_dieskalasi }}
                                            </div>

                                            <div class="number-meta">
                                                status dieskalasi
                                            </div>
                                        </td>

                                        <td>
                                            <div class="number-main">
                                                {{ $item->selesai_bulan_ini }}
                                            </div>

                                            <div class="number-meta">
                                                bulan berjalan
                                            </div>
                                        </td>

                                        <td>
                                            @php
                                                $totalKasusItem = (int) ($item->total_kasus ?? 0);
                                                $kasusSelesaiItem = (int) ($item->kasus_selesai ?? 0);
                                                $persenSelesaiItem = $totalKasusItem > 0
                                                    ? (int) round(($kasusSelesaiItem / $totalKasusItem) * 100)
                                                    : 0;
                                            @endphp
                                            <div class="completion-wrap">
                                                <div class="completion-top">
                                                    <span class="number-main">{{ $persenSelesaiItem }}%</span>
                                                    <span class="number-meta">{{ $kasusSelesaiItem }}/{{ $totalKasusItem }} selesai</span>
                                                </div>
                                                <div class="completion-bar">
                                                    <div class="completion-bar-fill" style="width: {{ $persenSelesaiItem }}%;"></div>
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="number-main">
                                                {{ $item->tindak_lanjut_bulan_ini }}
                                            </div>

                                            <div class="number-meta">
                                                catatan dibuat
                                            </div>
                                        </td>

                                        <td>

                                            @if($tlTerakhir)

                                                <div class="last-activity">
                                                    {{ $tlTerakhir
                                                        ->locale('id')
                                                        ->translatedFormat(
                                                            'd M Y, H:i'
                                                        ) }}
                                                </div>

                                                <div class="last-activity-meta">
                                                    Catatan tindak lanjut
                                                </div>

                                            @else

                                                <div class="last-activity">
                                                    Belum ada
                                                </div>

                                                <div class="last-activity-meta">
                                                    tindak lanjut tercatat
                                                </div>

                                            @endif

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                    @if($guruBk->hasPages())

                        <div class="pagination-wrap">
                            {{ $guruBk->links() }}
                        </div>

                    @endif

                @endif

            </section>

            <div class="info-note">

                <i class="bi bi-info-circle"></i>

                <div>
                    Halaman ini hanya menampilkan ringkasan kuantitatif
                    aktivitas Guru BK. Admin tidak membuka kronologi,
                    bukti, maupun isi catatan kasus reguler dari halaman ini.
                    Detail kasus tetap dibatasi pada kasus yang dieskalasi.
                </div>

            </div>

            <footer class="page-footer">
                <div class="d-flex flex-column flex-md-row justify-content-between gap-2 w-100">
                    <span>© {{ date('Y') }} CurhatAman</span>
                    <span>Portal Admin Sekolah · Monitoring aktivitas Guru BK</span>
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
