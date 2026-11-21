@php
    $errors = $errors ?? new \Illuminate\Support\ViewErrorBag();
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Audit Log | CurhatAman</title>

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
            --ca-warning: #9a650f;
            --ca-warning-soft: #fff7e8;
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

        .scope-badge {
            min-height: 36px;
            padding: 0 12px;
            border: 1px solid rgba(255, 255, 255, .42);
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #ffffff;
            background: rgba(255, 255, 255, .12);
            font-size: 10.5px;
            font-weight: 680;
            white-space: nowrap;
        }

        .metric-card {
            position: relative;
            height: 100%;
            min-height: 126px;
            padding: 18px;
            border: 1px solid var(--ca-border);
            border-top: 3px solid #d6dddd;
            border-radius: 12px;
            background: #ffffff;
        }

        .metric-card.today {
            border-top-color: var(--ca-primary);
        }

        .metric-card.counselor {
            border-top-color: #35a36f;
        }

        .metric-card.status-change {
            border-top-color: #d99a2b;
        }

        .metric-card.reassign {
            border-top-color: var(--ca-danger);
        }

        .metric-top {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 12px;
        }

        .metric-label {
            color: var(--ca-muted);
            font-size: 11px;
            font-weight: 600;
        }

        .metric-value {
            margin-top: 6px;
            color: var(--ca-text);
            font-size: 27px;
            line-height: 1.05;
            font-weight: 760;
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
            color: var(--ca-primary-dark);
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

        .metric-icon.danger {
            color: var(--ca-danger);
            background: var(--ca-danger-soft);
        }

        .metric-note {
            margin-top: 13px;
            color: var(--ca-muted-light);
            font-size: 10.5px;
            line-height: 1.45;
        }

        .panel {
            border: 1px solid var(--ca-border);
            border-top: 3px solid var(--ca-primary);
            border-radius: 12px;
            background: #ffffff;
            overflow: hidden;
        }

        .filter-wrap {
            padding: 18px 20px;
            border-bottom: 1px solid var(--ca-line);
            background: #ffffff;
        }

        .filter-label {
            margin-bottom: 6px;
            color: #475467;
            font-size: 10.5px;
            font-weight: 700;
        }

        .form-control,
        .form-select {
            min-height: 42px;
            border: 1px solid var(--ca-border);
            border-radius: 9px;
            color: var(--ca-text);
            background-color: #ffffff;
            font-size: 12px;
            box-shadow: none;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: rgba(15, 138, 131, .55);
            box-shadow: 0 0 0 .2rem rgba(15, 138, 131, .08);
        }

        .btn-filter,
        .btn-reset {
            min-height: 42px;
            padding: 0 16px;
            border-radius: 9px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 650;
        }

        .btn-filter {
            border: 1px solid var(--ca-primary);
            color: #ffffff;
            background: var(--ca-primary);
        }

        .btn-filter:hover {
            color: #ffffff;
            background: var(--ca-primary-dark);
            border-color: var(--ca-primary-dark);
        }

        .btn-reset {
            border: 1px solid var(--ca-border);
            color: #475467;
            background: #ffffff;
        }

        .btn-reset:hover {
            color: var(--ca-primary-dark);
            background: var(--ca-primary-soft);
            border-color: #cfe4e1;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .audit-table {
            min-width: 1050px;
            margin: 0;
        }

        .audit-table thead th {
            padding: 13px 16px;
            border-bottom: 1px solid #dfeceb;
            color: #546665;
            background: #f4faf9;
            font-size: 9.5px;
            font-weight: 760;
            letter-spacing: .03em;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .audit-table tbody td {
            padding: 15px 16px;
            border-bottom: 1px solid var(--ca-line);
            color: #344054;
            background: #ffffff;
            vertical-align: middle;
            font-size: 11.5px;
        }

        .audit-table tbody tr:hover td {
            background: #fbfdfd;
        }

        .audit-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .actor-name {
            color: var(--ca-text);
            font-weight: 680;
        }

        .role-badge,
        .action-badge {
            padding: 5px 8px;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 9.5px;
            font-weight: 700;
            white-space: nowrap;
        }

        .role-badge {
            color: #475467;
            background: #f2f4f7;
        }

        .action-badge {
            color: var(--ca-primary-dark);
            background: var(--ca-primary-soft);
        }

        .action-badge.danger {
            color: var(--ca-danger);
            background: var(--ca-danger-soft);
        }

        .action-badge.warning {
            color: var(--ca-warning);
            background: var(--ca-warning-soft);
        }

        .reference-code {
            color: var(--ca-primary-dark);
            font-weight: 680;
        }

        .log-detail {
            margin-top: 4px;
            color: var(--ca-muted-light);
            font-size: 10px;
        }

        .empty-state {
            padding: 46px 18px;
            color: var(--ca-muted);
            text-align: center;
            font-size: 12px;
        }

        .empty-icon {
            width: 44px;
            height: 44px;
            margin: 0 auto 10px;
            border-radius: 11px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: var(--ca-primary-dark);
            background: var(--ca-primary-soft);
            font-size: 18px;
        }

        .table-footer {
            padding: 14px 18px;
            border-top: 1px solid var(--ca-line);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            background: #ffffff;
        }

        .pagination-copy {
            color: var(--ca-muted);
            font-size: 10.5px;
        }

        .pagination-actions {
            display: flex;
            gap: 8px;
        }

        .pagination-button {
            min-height: 34px;
            padding: 0 12px;
            border: 1px solid var(--ca-border);
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            color: #475467;
            background: #ffffff;
            font-size: 10.5px;
            font-weight: 650;
        }

        .pagination-button:hover {
            color: var(--ca-primary-dark);
            background: var(--ca-primary-soft);
            border-color: #cfe4e1;
        }

        .pagination-button.disabled {
            color: #b2bac5;
            background: #fafafa;
            pointer-events: none;
        }

        .privacy-note {
            margin-top: 16px;
            padding: 14px 16px;
            border: 1px solid #d7e9e6;
            border-radius: 10px;
            display: flex;
            align-items: flex-start;
            gap: 10px;
            color: var(--ca-muted);
            background: #f6fbfa;
            font-size: 10.5px;
            line-height: 1.6;
        }

        .privacy-note i {
            margin-top: 1px;
            color: var(--ca-primary-dark);
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

            .scope-badge {
                white-space: normal;
            }

            .table-footer {
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

    $roleLabels = [
        'counselor' => 'Guru BK',
        'admin' => 'Admin',
        'homeroom_teacher' => 'Wali Kelas',
        'student' => 'Siswa',
    ];
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
            Audit Log
        </div>

        <div class="topbar-subtitle">
            Jejak aktivitas penting pada penanganan kasus
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
                        Transparansi Sistem
                    </div>

                    <h1 class="page-title">
                        Audit Log
                    </h1>

                    <p class="page-copy">
                        Riwayat aktivitas penting Guru BK dan Admin.
                        Halaman ini mencatat waktu, pelaku, jenis aktivitas,
                        dan referensi kasus tanpa membuka kronologi,
                        bukti, jawaban skrining, atau isi catatan tindak lanjut.
                    </p>
                </div>

                <div class="scope-badge">
                    <i class="bi bi-shield-check"></i>
                    Metadata aktivitas saja
                </div>

            </section>

            <section class="row g-3 mb-4">

                <div class="col-sm-6 col-xl-3">
                    <div class="metric-card today">
                        <div class="metric-top">
                            <div>
                                <div class="metric-label">
                                    Aktivitas Hari Ini
                                </div>

                                <div class="metric-value">
                                    {{ $ringkasan['total_hari_ini'] }}
                                </div>
                            </div>

                            <span class="metric-icon primary">
                                <i class="bi bi-clock-history"></i>
                            </span>
                        </div>

                        <div class="metric-note">
                            Seluruh event audit hari ini
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-xl-3">
                    <div class="metric-card counselor">
                        <div class="metric-top">
                            <div>
                                <div class="metric-label">
                                    Aktivitas Guru BK
                                </div>

                                <div class="metric-value">
                                    {{ $ringkasan['guru_bk_hari_ini'] }}
                                </div>
                            </div>

                            <span class="metric-icon success">
                                <i class="bi bi-person-check"></i>
                            </span>
                        </div>

                        <div class="metric-note">
                            Aktivitas Guru BK hari ini
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-xl-3">
                    <div class="metric-card status-change">
                        <div class="metric-top">
                            <div>
                                <div class="metric-label">
                                    Perubahan Status
                                </div>

                                <div class="metric-value">
                                    {{ $ringkasan['perubahan_status_hari_ini'] }}
                                </div>
                            </div>

                            <span class="metric-icon warning">
                                <i class="bi bi-arrow-left-right"></i>
                            </span>
                        </div>

                        <div class="metric-note">
                            Perubahan status kasus hari ini
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-xl-3">
                    <div class="metric-card reassign">
                        <div class="metric-top">
                            <div>
                                <div class="metric-label">
                                    Pengalihan Kasus
                                </div>

                                <div class="metric-value">
                                    {{ $ringkasan['pengalihan_hari_ini'] }}
                                </div>
                            </div>

                            <span class="metric-icon danger">
                                <i class="bi bi-person-gear"></i>
                            </span>
                        </div>

                        <div class="metric-note">
                            Alih penanganan oleh Admin hari ini
                        </div>
                    </div>
                </div>

            </section>

            <section class="panel">

                <form
                    method="GET"
                    action="{{ route('admin.audit-log.index') }}"
                    class="filter-wrap"
                >
                    <div class="row g-3">

                        <div class="col-lg-4">
                            <label class="filter-label">
                                Pencarian
                            </label>

                            <input
                                type="text"
                                name="q"
                                value="{{ $q }}"
                                class="form-control"
                                placeholder="Nama pengguna atau kode laporan"
                            >
                        </div>

                        <div class="col-md-6 col-lg-2">
                            <label class="filter-label">
                                Aktivitas
                            </label>

                            <select
                                name="action"
                                class="form-select"
                            >
                                <option value="">
                                    Semua Aktivitas
                                </option>

                                @foreach($actionLabels as $key => $label)
                                    <option
                                        value="{{ $key }}"
                                        @selected($action === $key)
                                    >
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 col-lg-2">
                            <label class="filter-label">
                                Peran
                            </label>

                            <select
                                name="role"
                                class="form-select"
                            >
                                <option value="">
                                    Semua Peran
                                </option>

                                <option
                                    value="counselor"
                                    @selected($role === 'counselor')
                                >
                                    Guru BK
                                </option>

                                <option
                                    value="admin"
                                    @selected($role === 'admin')
                                >
                                    Admin
                                </option>
                            </select>
                        </div>

                        <div class="col-md-6 col-lg-2">
                            <label class="filter-label">
                                Dari Tanggal
                            </label>

                            <input
                                type="date"
                                name="date_from"
                                value="{{ $dateFrom }}"
                                class="form-control"
                            >
                        </div>

                        <div class="col-md-6 col-lg-2">
                            <label class="filter-label">
                                Sampai Tanggal
                            </label>

                            <input
                                type="date"
                                name="date_to"
                                value="{{ $dateTo }}"
                                class="form-control"
                            >
                        </div>

                        <div class="col-12 d-flex gap-2 justify-content-end">
                            <a
                                href="{{ route('admin.audit-log.index') }}"
                                class="btn-reset"
                            >
                                Reset
                            </a>

                            <button
                                type="submit"
                                class="btn-filter"
                            >
                                Terapkan
                            </button>
                        </div>

                    </div>
                </form>

                @if($logs->count())

                    <div class="table-responsive">

                        <table class="table audit-table">

                            <thead>
                                <tr>
                                    <th>Waktu</th>
                                    <th>Pengguna</th>
                                    <th>Peran</th>
                                    <th>Aktivitas</th>
                                    <th>Referensi</th>
                                    <th>Keterangan</th>
                                    <th>IP</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach($logs as $log)

                                    @php
                                        $actionClass = '';

                                        if (in_array(
                                            $log->action,
                                            [
                                                'conflict_declared',
                                                'case_escalated',
                                            ],
                                            true
                                        )) {
                                            $actionClass = 'danger';
                                        } elseif (
                                            $log->action === 'case_reassigned'
                                        ) {
                                            $actionClass = 'warning';
                                        }

                                        $meta = $log->metadata_array ?? [];
                                    @endphp

                                    <tr>

                                        <td>
                                            <div class="fw-semibold">
                                                {{ \Carbon\Carbon::parse($log->created_at)
                                                    ->locale('id')
                                                    ->translatedFormat('d M Y') }}
                                            </div>

                                            <div class="log-detail">
                                                {{ \Carbon\Carbon::parse($log->created_at)
                                                    ->format('H:i:s') }}
                                            </div>
                                        </td>

                                        <td>
                                            <div class="actor-name">
                                                {{ $log->actor_name }}
                                            </div>
                                        </td>

                                        <td>
                                            <span class="role-badge">
                                                {{ $roleLabels[$log->actor_role]
                                                    ?? $log->actor_role }}
                                            </span>
                                        </td>

                                        <td>
                                            <span
                                                class="action-badge {{ $actionClass }}"
                                            >
                                                {{ $log->action_label }}
                                            </span>

                                            @if(
                                                isset($meta['old_status'])
                                                && isset($meta['new_status'])
                                            )
                                                <div class="log-detail">
                                                    {{ ucfirst($meta['old_status']) }}
                                                    →
                                                    {{ ucfirst($meta['new_status']) }}
                                                </div>
                                            @endif
                                        </td>

                                        <td>
                                            @if($log->reference_code)
                                                <span class="reference-code">
                                                    {{ $log->reference_code }}
                                                </span>
                                            @else
                                                <span class="text-muted">
                                                    —
                                                </span>
                                            @endif
                                        </td>

                                        <td>
                                            {{ $log->description }}
                                        </td>

                                        <td>
                                            {{ $log->ip_address ?: '—' }}
                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                    <div class="table-footer">

                        <div class="pagination-copy">
                            Menampilkan
                            {{ $logs->firstItem() }}
                            –
                            {{ $logs->lastItem() }}
                            dari
                            {{ $logs->total() }}
                            aktivitas
                        </div>

                        <div class="pagination-actions">

                            <a
                                href="{{ $logs->previousPageUrl() ?: '#' }}"
                                class="pagination-button
                                    {{ $logs->onFirstPage() ? 'disabled' : '' }}"
                            >
                                <i class="bi bi-chevron-left me-1"></i>
                                Sebelumnya
                            </a>

                            <a
                                href="{{ $logs->nextPageUrl() ?: '#' }}"
                                class="pagination-button
                                    {{ $logs->hasMorePages() ? '' : 'disabled' }}"
                            >
                                Berikutnya
                                <i class="bi bi-chevron-right ms-1"></i>
                            </a>

                        </div>

                    </div>

                @else

                    <div class="empty-state">
                        <div class="empty-icon">
                            <i class="bi bi-journal-check"></i>
                        </div>

                        <div class="fw-semibold mb-1">
                            Belum ada aktivitas yang cocok
                        </div>

                        <div>
                            Audit log akan terisi ketika aktivitas
                            yang dipantau dilakukan pada sistem.
                        </div>
                    </div>

                @endif

            </section>

            <div class="privacy-note">
                <i class="bi bi-info-circle"></i>

                <div>
                    Audit Log hanya menyimpan metadata aktivitas.
                    Isi kronologi laporan, bukti, jawaban skrining,
                    dan isi catatan tindak lanjut tidak disalin
                    ke dalam audit log.
                </div>
            </div>

            <footer class="page-footer">
                <div class="d-flex flex-column flex-md-row justify-content-between gap-2 w-100">
                    <span>© {{ date('Y') }} CurhatAman</span>
                    <span>Portal Admin Sekolah · Jejak aktivitas sistem</span>
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
