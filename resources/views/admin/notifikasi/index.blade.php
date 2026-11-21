@php
    $errors = $errors ?? new \Illuminate\Support\ViewErrorBag();
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifikasi Admin | CurhatAman</title>

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
            transition: background .15s ease, border-color .15s ease, box-shadow .15s ease;
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

        .btn-read-all {
            min-height: 38px;
            padding: 0 13px;
            border: 1px solid rgba(255, 255, 255, .42);
            border-radius: 9px;
            display: inline-flex;
            align-items: center;
            gap: 7px;
            color: #ffffff;
            background: rgba(255, 255, 255, .12);
            font-size: 10.5px;
            font-weight: 680;
            white-space: nowrap;
        }

        .btn-read-all:hover {
            color: #ffffff;
            background: rgba(255, 255, 255, .20);
        }

        .notification-overview {
            margin-bottom: 18px;
        }

        .overview-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 14px;
        }

        .overview-card {
            min-height: 128px;
            padding: 18px 19px;
            border: 1px solid var(--ca-border);
            border-radius: 12px;
            display: flex;
            align-items: flex-start;
            gap: 15px;
            background: #ffffff;
        }

        .overview-card.total {
            border-top: 3px solid var(--ca-primary);
        }

        .overview-card.unread {
            border-top: 3px solid #4f8fb8;
        }

        .overview-icon {
            width: 42px;
            height: 42px;
            flex: 0 0 42px;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 17px;
        }

        .overview-icon.total {
            color: var(--ca-primary-dark);
            background: var(--ca-primary-soft);
        }

        .overview-icon.unread {
            color: #2d6f9f;
            background: #eef6fb;
        }

        .overview-content {
            min-width: 0;
            flex: 1;
        }

        .overview-label {
            color: var(--ca-muted);
            font-size: 10.5px;
            font-weight: 650;
        }

        .overview-value-row {
            margin-top: 5px;
            display: flex;
            align-items: center;
            gap: 9px;
        }

        .overview-value {
            color: var(--ca-text);
            font-size: 28px;
            line-height: 1;
            font-weight: 760;
        }

        .overview-status {
            min-height: 24px;
            padding: 0 8px;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            color: #2d6f9f;
            background: #eef6fb;
            font-size: 9.5px;
            font-weight: 700;
        }

        .overview-status.clear {
            color: var(--ca-success);
            background: var(--ca-success-soft);
        }

        .overview-note {
            margin-top: 9px;
            color: var(--ca-muted-light);
            font-size: 10.5px;
            line-height: 1.5;
        }

        .notification-breakdown {
            margin-top: 12px;
            padding: 13px 15px;
            border: 1px solid var(--ca-border);
            border-radius: 11px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            background: #ffffff;
        }

        .breakdown-heading {
            min-width: 175px;
        }

        .breakdown-title {
            color: var(--ca-text);
            font-size: 10.8px;
            font-weight: 700;
        }

        .breakdown-copy {
            margin-top: 3px;
            color: var(--ca-muted-light);
            font-size: 9.7px;
        }

        .breakdown-items {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 22px;
            flex-wrap: wrap;
        }

        .breakdown-item {
            display: flex;
            align-items: center;
            gap: 9px;
        }

        .breakdown-icon {
            width: 32px;
            height: 32px;
            flex: 0 0 32px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
        }

        .breakdown-icon.escalated {
            color: var(--ca-danger);
            background: var(--ca-danger-soft);
        }

        .breakdown-icon.stale {
            color: var(--ca-warning);
            background: var(--ca-warning-soft);
        }

        .breakdown-number {
            color: var(--ca-text);
            font-size: 13px;
            line-height: 1.15;
            font-weight: 760;
        }

        .breakdown-label {
            margin-top: 2px;
            color: var(--ca-muted);
            font-size: 9.8px;
            white-space: nowrap;
        }

        .filter-tabs {
            margin: 18px 0 14px;
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .filter-tab {
            min-height: 34px;
            padding: 0 12px;
            border: 1px solid var(--ca-border);
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            color: #667085;
            background: #ffffff;
            font-size: 10.5px;
            font-weight: 650;
        }

        .filter-tab:hover {
            color: var(--ca-primary-dark);
            background: #f8fbfa;
            border-color: #cfe4e1;
        }

        .filter-tab.active {
            color: var(--ca-primary-dark);
            background: var(--ca-primary-soft);
            border-color: #c7e3df;
        }

        .notification-list {
            border: 1px solid var(--ca-border);
            border-top: 3px solid var(--ca-primary);
            border-radius: 12px;
            background: #ffffff;
            overflow: hidden;
        }

        .notification-row {
            padding: 16px 18px;
            border-bottom: 1px solid var(--ca-line);
            display: grid;
            grid-template-columns: 42px minmax(0, 1fr) auto;
            gap: 14px;
            align-items: start;
            background: #ffffff;
        }

        .notification-row:last-child {
            border-bottom: 0;
        }

        .notification-row.unread {
            background: #fbfefe;
        }

        .notification-row:hover {
            background: #fbfdfd;
        }

        .notification-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
        }

        .notification-icon.escalated {
            color: var(--ca-danger);
            background: var(--ca-danger-soft);
        }

        .notification-icon.stale {
            color: var(--ca-warning);
            background: var(--ca-warning-soft);
        }

        .notification-title {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
            color: var(--ca-text);
            font-size: 12.5px;
            font-weight: 720;
        }

        .unread-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: var(--ca-primary);
        }

        .notification-copy {
            margin-top: 5px;
            color: #667085;
            font-size: 11.5px;
            line-height: 1.55;
        }

        .notification-meta {
            margin-top: 7px;
            display: flex;
            align-items: center;
            gap: 9px;
            flex-wrap: wrap;
            color: var(--ca-muted-light);
            font-size: 9.5px;
        }

        .reference-code {
            color: var(--ca-primary-dark);
            font-weight: 650;
        }

        .btn-open {
            min-height: 34px;
            padding: 0 11px;
            border: 1px solid #cfe4e1;
            border-radius: 8px;
            color: var(--ca-primary-dark);
            background: #ffffff;
            font-size: 10.5px;
            font-weight: 680;
            white-space: nowrap;
        }

        .btn-open:hover {
            background: var(--ca-primary-soft);
        }

        .empty-state {
            padding: 56px 20px;
            color: var(--ca-muted);
            text-align: center;
        }

        .empty-icon {
            width: 46px;
            height: 46px;
            margin: 0 auto 12px;
            border-radius: 12px;
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
            background: #ffffff;
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

        .alert-success-ca {
            margin-bottom: 16px;
            padding: 12px 14px;
            border: 1px solid #cde8db;
            border-radius: 9px;
            color: var(--ca-success);
            background: var(--ca-success-soft);
            font-size: 11.5px;
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
                display: none !important;
            }

            .account-trigger {
                min-width: 0;
                width: 42px;
                height: 42px;
                padding: 3px;
            }

            .overview-grid {
                grid-template-columns: 1fr;
            }

            .notification-breakdown {
                align-items: flex-start;
                flex-direction: column;
            }

            .breakdown-items {
                width: 100%;
                justify-content: flex-start;
            }

            .notification-row {
                grid-template-columns: 40px minmax(0, 1fr);
            }

            .notification-action {
                grid-column: 2;
            }

            .btn-read-all {
                width: 100%;
                justify-content: center;
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
            Notifikasi Admin
        </div>

        <div class="topbar-subtitle">
            Pemberitahuan kasus yang memerlukan pengawasan tingkat sekolah
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

            @if(session('success'))
                <div class="alert-success-ca">
                    <i class="bi bi-check-circle me-1"></i>
                    {{ session('success') }}
                </div>
            @endif

            <section class="page-header">

                <div>
                    <div class="page-kicker">
                        Pusat Notifikasi
                    </div>

                    <h1 class="page-title">
                        Notifikasi Pengawasan
                    </h1>

                    <p class="page-copy">
                        Admin menerima pemberitahuan untuk kasus yang
                        dieskalasi dan kasus yang telah lama tidak diperbarui.
                        Notifikasi hanya menampilkan metadata yang diperlukan,
                        tanpa memuat kronologi atau catatan tindak lanjut.
                    </p>
                </div>

                @if($summary['belum'] > 0)
                    <form
                        method="POST"
                        action="{{ route('admin.notifikasi.read-all') }}"
                    >
                        @csrf
                        @method('PATCH')

                        <button
                            type="submit"
                            class="btn-read-all"
                        >
                            <i class="bi bi-check2-all"></i>
                            Tandai Semua Dibaca
                        </button>
                    </form>
                @endif

            </section>

            <section class="notification-overview">
                <div class="overview-grid">
                    <article class="overview-card total">
                        <span class="overview-icon total">
                            <i class="bi bi-bell"></i>
                        </span>

                        <div class="overview-content">
                            <div class="overview-label">
                                Total Notifikasi
                            </div>

                            <div class="overview-value-row">
                                <div class="overview-value">
                                    {{ $summary['total'] }}
                                </div>
                            </div>

                            <div class="overview-note">
                                Seluruh pemberitahuan pengawasan yang tercatat untuk Admin.
                            </div>
                        </div>
                    </article>

                    <article class="overview-card unread">
                        <span class="overview-icon unread">
                            <i class="bi bi-envelope-exclamation"></i>
                        </span>

                        <div class="overview-content">
                            <div class="overview-label">
                                Belum Dibaca
                            </div>

                            <div class="overview-value-row">
                                <div class="overview-value">
                                    {{ $summary['belum'] }}
                                </div>

                                <span class="overview-status {{ $summary['belum'] > 0 ? '' : 'clear' }}">
                                    {{ $summary['belum'] > 0 ? 'Perlu ditinjau' : 'Sudah ditinjau' }}
                                </span>
                            </div>

                            <div class="overview-note">
                                Notifikasi yang belum dibuka atau ditandai sebagai dibaca.
                            </div>
                        </div>
                    </article>
                </div>

                <div class="notification-breakdown">
                    <div class="breakdown-heading">
                        <div class="breakdown-title">
                            Komposisi Notifikasi
                        </div>

                        <div class="breakdown-copy">
                            Ringkasan berdasarkan jenis pengawasan kasus.
                        </div>
                    </div>

                    <div class="breakdown-items">
                        <div class="breakdown-item">
                            <span class="breakdown-icon escalated">
                                <i class="bi bi-exclamation-diamond"></i>
                            </span>

                            <div>
                                <div class="breakdown-number">
                                    {{ $summary['dieskalasi'] }}
                                </div>

                                <div class="breakdown-label">
                                    Kasus Dieskalasi
                                </div>
                            </div>
                        </div>

                        <div class="breakdown-item">
                            <span class="breakdown-icon stale">
                                <i class="bi bi-hourglass-split"></i>
                            </span>

                            <div>
                                <div class="breakdown-number">
                                    {{ $summary['mangkrak'] }}
                                </div>

                                <div class="breakdown-label">
                                    Kasus Mangkrak
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <nav class="filter-tabs">

                <a
                    href="{{ route(
                        'admin.notifikasi.index',
                        ['filter' => 'semua']
                    ) }}"
                    class="filter-tab {{ $filter === 'semua' ? 'active' : '' }}"
                >
                    Semua
                </a>

                <a
                    href="{{ route(
                        'admin.notifikasi.index',
                        ['filter' => 'belum']
                    ) }}"
                    class="filter-tab {{ $filter === 'belum' ? 'active' : '' }}"
                >
                    Belum Dibaca
                </a>

                <a
                    href="{{ route(
                        'admin.notifikasi.index',
                        ['filter' => 'dibaca']
                    ) }}"
                    class="filter-tab {{ $filter === 'dibaca' ? 'active' : '' }}"
                >
                    Sudah Dibaca
                </a>

            </nav>

            <section class="notification-list">

                @forelse($notifikasi as $item)

                    @php
                        $isMangkrak = $item->tipe === 'kasus_mangkrak';
                        $isProfilSiswa = $item->tipe === 'profil_siswa_diperbarui';

                        $kodeReferensi = null;

                        if (
                            $item->referensi_tipe === 'laporan_kasus'
                            && $item->referensi_id
                        ) {
                            $kodeReferensi =
                                \Illuminate\Support\Facades\DB::table(
                                    'laporan_kasus'
                                )
                                ->where('id', $item->referensi_id)
                                ->value('kode_laporan');
                        } elseif (
                            $item->referensi_tipe === 'users'
                            && $item->referensi_id
                        ) {
                            $nisRef = \Illuminate\Support\Facades\DB::table('siswa')
                                ->where('user_id', $item->referensi_id)
                                ->value('nis');
                            if ($nisRef) {
                                $kodeReferensi = 'NISN: ' . $nisRef;
                            }
                        }
                    @endphp

                    <article
                        class="notification-row
                            {{ is_null($item->read_at) ? 'unread' : '' }}"
                    >

                        <span
                            class="notification-icon
                                {{ $isMangkrak
                                    ? 'stale'
                                    : ($isProfilSiswa ? 'total' : 'escalated') }}"
                            @if($isProfilSiswa)
                                style="background: var(--ca-primary-soft); color: var(--ca-primary-dark);"
                            @endif
                        >
                            <i
                                class="bi
                                    {{ $isMangkrak
                                        ? 'bi-hourglass-split'
                                        : ($isProfilSiswa ? 'bi-person-vcard' : 'bi-exclamation-diamond') }}"
                            ></i>
                        </span>

                        <div>

                            <div class="notification-title">
                                {{ $item->judul }}

                                @if(is_null($item->read_at))
                                    <span
                                        class="unread-dot"
                                        title="Belum dibaca"
                                    ></span>
                                @endif
                            </div>

                            <div class="notification-copy">
                                {{ $item->pesan }}
                            </div>

                            <div class="notification-meta">

                                <span>
                                    <i class="bi bi-clock me-1"></i>
                                    {{ $item->created_at
                                        ->locale('id')
                                        ->diffForHumans() }}
                                </span>

                                @if($kodeReferensi)
                                    <span class="reference-code">
                                        {{ $kodeReferensi }}
                                    </span>
                                @endif

                                @if($item->read_at)
                                    <span>
                                        Dibaca
                                    </span>
                                @else
                                    <span>
                                        Belum dibaca
                                    </span>
                                @endif

                            </div>

                        </div>

                        <div class="notification-action">

                            <form
                                method="POST"
                                action="{{ route(
                                    'admin.notifikasi.read',
                                    $item->id
                                ) }}"
                            >
                                @csrf
                                @method('PATCH')

                                <button
                                    type="submit"
                                    class="btn-open"
                                >
                                    <i class="bi bi-arrow-right-circle me-1"></i>
                                    Buka
                                </button>
                            </form>

                        </div>

                    </article>

                @empty

                    <div class="empty-state">

                        <div class="empty-icon">
                            <i class="bi bi-bell-slash"></i>
                        </div>

                        <div class="fw-semibold mb-1">
                            Belum Ada Notifikasi
                        </div>

                        <div class="small">
                            Notifikasi pengawasan kasus akan muncul di sini.
                        </div>

                    </div>

                @endforelse

                @if($notifikasi->hasPages())
                    <div class="pagination-wrap">
                        {{ $notifikasi->links('pagination::bootstrap-5') }}
                    </div>
                @endif

            </section>

            <footer class="page-footer">
                <div class="d-flex flex-column flex-md-row justify-content-between gap-2 w-100">
                    <span>© {{ date('Y') }} CurhatAman</span>
                    <span>Portal Admin Sekolah · Pusat notifikasi pengawasan</span>
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
