@php
    $errors = $errors ?? new \Illuminate\Support\ViewErrorBag();
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Kelola Kelas | CurhatAman</title>

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
            --ca-success: #027a48;
            --ca-success-soft: #ecf8f2;
            --ca-danger: #b42318;
            --ca-danger-soft: #fff1f0;
            --ca-warning: #9a650f;
            --ca-warning-soft: #fff7e8;
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
            line-height: 1.3;
        }

        .account-role {
            margin-top: 2px;
            color: var(--ca-muted-light);
            font-size: 10.5px;
            line-height: 1.3;
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

        .main-content {
            min-height: 100vh;
            margin-left: var(--sidebar-width);
            padding-top: var(--topbar-height);
        }

        .page-body {
            padding: 30px 34px 38px;
        }

        .content-shell {
            max-width: 1240px;
            margin: 0 auto;
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

        .page-actions {
            flex: 0 0 auto;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 10px;
        }

        .btn-primary-ca {
            min-height: 42px;
            height: 42px;
            padding: 0 16px;
            border: 1px solid rgba(255, 255, 255, .76);
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            color: var(--ca-primary-dark);
            background: #ffffff;
            font-size: 12px;
            line-height: 1;
            font-weight: 680;
            white-space: nowrap;
            flex-shrink: 0;
            transition: background .15s ease, transform .15s ease;
        }

        .btn-primary-ca:hover,
        .btn-primary-ca:focus {
            color: var(--ca-primary-dark);
            background: #f2faf8;
            transform: translateY(-1px);
        }

        .btn-secondary-ca {
            min-height: 42px;
            height: 42px;
            padding: 0 16px;
            border: 1px solid rgba(255, 255, 255, .45);
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            color: #ffffff;
            background: rgba(255, 255, 255, .15);
            font-size: 12px;
            line-height: 1;
            font-weight: 680;
            white-space: nowrap;
            flex-shrink: 0;
            backdrop-filter: blur(4px);
            cursor: pointer;
            transition: background .15s ease, border-color .15s ease, transform .15s ease;
        }

        .btn-secondary-ca:hover,
        .btn-secondary-ca:focus {
            color: #ffffff;
            background: rgba(255, 255, 255, .25);
            border-color: rgba(255, 255, 255, .8);
            transform: translateY(-1px);
        }

        .summary-card {
            position: relative;
            height: 100%;
            min-height: 94px;
            padding: 15px 16px;
            border: 1px solid var(--ca-border);
            border-top: 3px solid #d5dddd;
            border-radius: 11px;
            background: #ffffff;
        }

        .summary-card.total {
            border-top-color: var(--ca-primary);
        }

        .summary-card.active {
            border-top-color: #35a36f;
        }

        .summary-card.unassigned {
            border-top-color: #e6a33b;
        }

        .summary-card.students {
            border-top-color: #4f8fb8;
        }

        .summary-label {
            color: var(--ca-muted);
            font-size: 10.5px;
        }

        .summary-value {
            margin-top: 5px;
            color: var(--ca-text);
            font-size: 22px;
            font-weight: 740;
        }

        .panel {
            border: 1px solid var(--ca-border);
            border-top: 3px solid var(--ca-primary);
            border-radius: 12px;
            background: #ffffff;
            overflow: hidden;
        }

        .filter-bar {
            padding: 16px 18px;
            border-bottom: 1px solid var(--ca-line);
            display: grid;
            grid-template-columns: minmax(230px, 1fr) 170px 170px auto;
            gap: 10px;
            align-items: end;
            background: #ffffff;
        }

        .form-label {
            margin-bottom: 6px;
            color: #475467;
            font-size: 10.5px;
            font-weight: 650;
        }

        .form-control,
        .form-select {
            min-height: 40px;
            border: 1px solid #d9e1e1;
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

        .filter-actions {
            display: flex;
            gap: 8px;
        }

        .btn-filter,
        .btn-reset {
            min-height: 40px;
            padding: 0 13px;
            border-radius: 9px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            font-size: 11.5px;
            font-weight: 650;
        }

        .btn-filter {
            border: 1px solid var(--ca-primary);
            color: #ffffff;
            background: var(--ca-primary);
        }

        .btn-filter:hover {
            background: var(--ca-primary-dark);
            border-color: var(--ca-primary-dark);
        }

        .btn-reset {
            border: 1px solid var(--ca-border);
            color: #667085;
            background: #ffffff;
        }

        .btn-reset:hover {
            color: var(--ca-primary-dark);
            background: var(--ca-primary-soft);
            border-color: #cfe4e1;
        }

        .table {
            margin-bottom: 0;
        }

        .table thead th {
            padding: 12px 16px;
            border-bottom: 1px solid #dfeceb;
            color: #546665;
            background: #f4faf9;
            font-size: 10px;
            font-weight: 720;
            text-transform: uppercase;
            letter-spacing: .04em;
            white-space: nowrap;
        }

        .table tbody td {
            padding: 14px 16px;
            border-color: var(--ca-line);
            color: #344054;
            background: #ffffff;
            font-size: 11.5px;
            vertical-align: middle;
        }

        .table tbody tr:hover td {
            background: #fbfdfd;
        }

        .class-name {
            color: var(--ca-text);
            font-weight: 680;
        }

        .class-meta {
            margin-top: 3px;
            color: var(--ca-muted-light);
            font-size: 10px;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 5px 8px;
            border-radius: 999px;
            font-size: 9.5px;
            font-weight: 690;
            white-space: nowrap;
        }

        .status-badge.active {
            color: var(--ca-success);
            background: var(--ca-success-soft);
        }

        .status-badge.inactive {
            color: var(--ca-danger);
            background: var(--ca-danger-soft);
        }

        .action-wrap {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            flex-wrap: nowrap;
            white-space: nowrap;
        }





        }

        .btn-action {
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            gap: 5px !important;
            padding: 4px 10px !important;
            min-height: 26px !important;
            height: 28px !important;
            width: auto !important;
            border-radius: 999px !important;
            font-size: 11px !important;
            font-weight: 650 !important;
            white-space: nowrap !important;
            text-decoration: none !important;
            cursor: pointer !important;
            transition: all .15s ease !important;
            box-shadow: none !important;
        }





            align-items: center;
            justify-content: center;
            gap: 6px;



        }

        .btn-edit {
            background: #f6fbfa !important;
            color: var(--ca-primary-dark, #0b6f69) !important;
            border: 1px solid #cfe4e1 !important;
        }

            border: 1px solid #cfe4e1;
            color: var(--ca-primary-dark);
            background: #f6fbfa;
        }

        .btn-edit:hover {
            color: #ffffff !important;
            background: #2563eb !important;
            border-color: #2563eb !important;
            box-shadow: 0 3px 8px rgba(37, 99, 235, 0.25);
            transform: translateY(-1px);
        }

        .btn-toggle.deactivate {
            background: #f3f4f6 !important;
            color: #6b7280 !important;
            border: 1px solid #e5e7eb !important;
        }

        .btn-toggle.deactivate:hover {
            color: #ffffff !important;
            background: #dc2626 !important;
            border-color: #dc2626 !important;
            box-shadow: 0 3px 8px rgba(220, 38, 38, 0.25);
            transform: translateY(-1px);
        }

        .btn-toggle.activate {
            background: var(--ca-success-soft, #ecf8f2) !important;
            color: var(--ca-success, #027a48) !important;
            border: 1px solid #c8edd8 !important;
        }

        .btn-toggle.activate:hover {
            color: #ffffff !important;
            background: #16a34a !important;
            border-color: #16a34a !important;
            box-shadow: 0 3px 8px rgba(22, 163, 74, 0.25);
            transform: translateY(-1px);
        }

            color: var(--ca-primary-dark);
            background: var(--ca-primary-soft);
        }


            border: 1px solid var(--ca-border);
            color: #667085;
            background: #ffffff;
        }

        .btn-toggle-deactivate-old-marker {
            color: var(--ca-danger);
            background: var(--ca-danger-soft);
            border-color: #f0c8c4;
        }

        .btn-toggle.activate:hover {
            color: var(--ca-success);
            background: var(--ca-success-soft);
            border-color: #cde8db;
        }

        .wali-empty {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: var(--ca-warning);
            font-size: 10.5px;
            font-weight: 650;
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

        @media (max-width: 1100px) {
            .filter-bar {
                grid-template-columns: 1fr 1fr;
            }

            .filter-actions {
                grid-column: 1 / -1;
            }
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

            .page-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .filter-bar {
                grid-template-columns: 1fr;
            }

            .filter-actions {
                grid-column: auto;
            }
        }

        @media (max-width: 575.98px) {
            .btn-primary-ca {
                width: 100%;
                justify-content: center;
            }

            .filter-actions {
                flex-direction: column;
            }

            .btn-filter,
            .btn-reset {
                width: 100%;
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

<div class="app-shell">

    @include('admin.partials.sidebar')

    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <header class="topbar">

        <div class="topbar-left">

            <button type="button" class="mobile-sidebar-button" id="openSidebarButton" aria-label="Buka menu">
                <i class="bi bi-list"></i>
            </button>

            <div>
                <div class="topbar-title">Kelola Kelas</div>
            <div class="topbar-subtitle">
                Kelola data kelas dan penugasan Wali Kelas
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
                title="Buka Profil Admin"
                aria-label="Buka Profil Admin"
            >
                <span class="topbar-avatar">{{ $inisial }}</span>

                <span class="account-copy">
                    <span class="account-name d-block">{{ $namaUser }}</span>
                    <span class="account-role d-block">Wakil Kesiswaan / Admin</span>
                </span>

                <i class="bi bi-chevron-right account-chevron"></i>
            </a>

        </div>

    </header>

    <main class="main-content">

        <div class="page-body">
            <div class="content-shell">

                @if (session('success'))
                    <div class="alert-success-ca">
                        <i class="bi bi-check-circle me-1"></i>
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger rounded-3 border-0 shadow-sm mb-3" style="font-size: 13px;">
                        <i class="bi bi-exclamation-triangle-fill me-1"></i>
                        {{ session('error') }}
                    </div>
                @endif

                <section class="page-header">

                    <div>
                        <div class="page-kicker">Administrasi Sekolah</div>

                        <h1 class="page-title">Daftar Kelas</h1>

                        <p class="page-copy">
                            Kelola kelas aktif pada CurhatAman. Kelas yang belum
                            memiliki Wali Kelas akan tersedia saat Admin membuat
                            akun Wali Kelas baru.
                        </p>
                    </div>

                    <div class="page-actions">
                        <button
                            type="button"
                            class="btn-secondary-ca"
                            data-bs-toggle="modal"
                            data-bs-target="#promosiMassalModal"
                        >
                            <i class="bi bi-arrow-up-right-circle"></i>
                            <span>Naik Kelas</span>
                        </button>

                        <a
                            href="{{ route('admin.kelas.create') }}"
                            class="btn-primary-ca"
                        >
                            <i class="bi bi-plus-lg"></i>
                            <span>Tambah Kelas</span>
                        </a>
                    </div>

                </section>

                <section class="row g-3 mb-3">

                    <div class="col-6 col-md-3">
                        <div class="summary-card total">
                            <div class="summary-label">Total Kelas</div>
                            <div class="summary-value">{{ $ringkasan['total'] }}</div>
                        </div>
                    </div>

                    <div class="col-6 col-md-3">
                        <div class="summary-card active">
                            <div class="summary-label">Kelas Aktif</div>
                            <div class="summary-value">{{ $ringkasan['aktif'] }}</div>
                        </div>
                    </div>

                    <div class="col-6 col-md-3">
                        <div class="summary-card unassigned">
                            <div class="summary-label">Belum Ada Wali Kelas</div>
                            <div class="summary-value">{{ $ringkasan['tanpa_wali'] }}</div>
                        </div>
                    </div>

                    <div class="col-6 col-md-3">
                        <div class="summary-card students">
                            <div class="summary-label">Siswa Terhubung Kelas</div>
                            <div class="summary-value">{{ $ringkasan['total_siswa'] }}</div>
                        </div>
                    </div>

                </section>

                <section class="panel">

                    <form
                        method="GET"
                        action="{{ route('admin.kelas.index') }}"
                        class="filter-bar"
                    >

                        <div>
                            <label class="form-label">Cari Kelas</label>

                            <input
                                type="text"
                                name="q"
                                value="{{ $q }}"
                                class="form-control"
                                placeholder="Nama kelas, wali kelas, tahun ajaran"
                            >
                        </div>

                        <div>
                            <label class="form-label">Tingkat</label>

                            <select name="tingkat" class="form-select">
                                <option value="">Semua Tingkat</option>
                                <option value="10" @selected($tingkat === '10')>10</option>
                                <option value="11" @selected($tingkat === '11')>11</option>
                                <option value="12" @selected($tingkat === '12')>12</option>
                            </select>
                        </div>

                        <div>
                            <label class="form-label">Status</label>

                            <select name="status" class="form-select">
                                <option value="">Semua Status</option>
                                <option value="aktif" @selected($status === 'aktif')>Aktif</option>
                                <option value="nonaktif" @selected($status === 'nonaktif')>Nonaktif</option>
                            </select>
                        </div>

                        <div class="filter-actions">

                            <button type="submit" class="btn-filter">
                                <i class="bi bi-funnel"></i>
                                Terapkan
                            </button>

                            <a
                                href="{{ route('admin.kelas.index') }}"
                                class="btn-reset"
                            >
                                Reset
                            </a>

                        </div>

                    </form>

                    <div class="table-responsive">

                        <table class="table align-middle">

                            <thead>
                                <tr>
                                    <th>Kelas</th>
                                    <th>Tingkat</th>
                                    <th>Tahun Ajaran</th>
                                    <th>Wali Kelas</th>
                                    <th>Jumlah Siswa</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>

                                @forelse ($kelas as $item)

                                    <tr>

                                        <td>
                                            <div class="class-name">
                                                {{ $item->nama_kelas }}
                                            </div>

                                            <div class="class-meta">
                                                ID Kelas #{{ $item->id }}
                                            </div>
                                        </td>

                                        <td>
                                            Tingkat {{ $item->tingkat }}
                                        </td>

                                        <td>
                                            {{ $item->tahun_ajaran }}
                                        </td>

                                        <td>
                                            @if ($item->nama_wali_kelas)
                                                {{ $item->nama_wali_kelas }}
                                            @else
                                                <span class="wali-empty">
                                                    <i class="bi bi-exclamation-circle"></i>
                                                    Belum ditugaskan
                                                </span>
                                            @endif
                                        </td>

                                        <td>
                                            {{ $item->jumlah_siswa }} siswa
                                        </td>

                                        <td>
                                            @if ($item->is_active)
                                                <span class="status-badge active">
                                                    <i class="bi bi-check-circle"></i>
                                                    Aktif
                                                </span>
                                            @else
                                                <span class="status-badge inactive">
                                                    <i class="bi bi-x-circle"></i>
                                                    Nonaktif
                                                </span>
                                            @endif
                                        </td>

                                        <td>
                                            <div class="action-wrap">

                                                <a
                                                    href="{{ route('admin.kelas.edit', $item->id) }}"
                                                    class="btn-action btn-edit"
                                                >
                                                    <i class="bi bi-pencil"></i>
                                                    Edit
                                                </a>

                                                <form
                                                    method="POST"
                                                    action="{{ route('admin.kelas.toggle-status', $item->id) }}"
                                                    class="m-0"
                                                    onsubmit="return confirm('{{ $item->is_active ? 'Nonaktifkan kelas ini? Data historis tetap tersimpan.' : 'Aktifkan kembali kelas ini?' }}')"
                                                >
                                                    @csrf
                                                    @method('PATCH')

                                                    <button
                                                        type="submit"
                                                        class="btn-action btn-toggle {{ $item->is_active ? 'deactivate' : 'activate' }}"
                                                    >
                                                        <i class="bi {{ $item->is_active ? 'bi-pause-circle' : 'bi-play-circle' }}"></i>
                                                        {{ $item->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                                                    </button>
                                                </form>

                                            </div>
                                        </td>

                                    </tr>

                                @empty

                                    <tr>
                                        <td colspan="7" class="text-center py-5 text-secondary">
                                            Belum ada data kelas.
                                        </td>
                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                    @if ($kelas->hasPages())
                        <div class="pagination-wrap">
                            {{ $kelas->links('pagination::bootstrap-5') }}
                        </div>
                    @endif

                </section>

                <footer class="page-footer">
                    <div class="d-flex flex-column flex-md-row justify-content-between gap-2 w-100">
                        <span>© {{ date('Y') }} CurhatAman</span>
                        <span>Portal Admin Sekolah · Manajemen kelas</span>
                    </div>
                </footer>

            </div>
        </div>

    </main>

</div>

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

{{-- =====================================================
     MODAL NAIK KELAS / KELULUSAN MASSAL PER KELAS
===================================================== --}}
<div class="modal fade" id="promosiMassalModal" tabindex="-1" aria-labelledby="promosiMassalModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form method="POST" action="{{ route('admin.kelas.promosi-massal') }}" class="modal-content" style="border-radius: 14px; border: 1px solid #d7e3e0;">
            @csrf
            <div class="modal-header" style="border-bottom: 1px solid #e7efed; padding: 16px 20px;">
                <h5 class="modal-title fw-bold" id="promosiMassalModalLabel" style="font-size: 16px; color: #102a29;">
                    <i class="bi bi-people-fill me-2" style="color: #0f8a83;"></i>
                    Naik Kelas / Kelulusan Massal per Kelas
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body" style="padding: 20px;">
                <div class="mb-3">
                    <label for="aksiPromosi" class="form-label fw-semibold" style="font-size: 13px;">Jenis Proses Massal</label>
                    <select name="aksi" id="aksiPromosi" class="form-select" style="font-size: 13px; border-radius: 9px;" required>
                        <option value="naik_kelas">Naik Kelas Massal (Pindahkan 1 Kelas Penuh ke Kelas Baru)</option>
                        <option value="tamat">Luluskan / Tamatkan Siswa Kelas XII (1 Kelas Penuh)</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="kelas_asal_id" class="form-label fw-semibold" style="font-size: 13px;">Pilih Kelas Asal (Saat Ini)</label>
                    <select name="kelas_asal_id" id="kelas_asal_id" class="form-select" style="font-size: 13px; border-radius: 9px;" required>
                        <option value="">-- Pilih Kelas Asal --</option>
                        @foreach ($semuaKelas ?? [] as $kls)
                            @if (($kls->jumlah_siswa ?? 0) > 0)
                                <option value="{{ $kls->id }}" data-tingkat="{{ $kls->tingkat }}">
                                    {{ $kls->nama_kelas }} · {{ $kls->tahun_ajaran }} ({{ $kls->jumlah_siswa }} siswa)
                                </option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="mb-3 d-none" id="wrapDaftarSiswaKelas">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <label class="form-label fw-semibold mb-0" style="font-size: 12.5px;">
                            Daftar Siswa (Hilangkan centang jika ada siswa yang <u>Tinggal Kelas</u>)
                        </label>
                        <button type="button" id="btnToggleSelectAllSiswa" class="btn btn-link p-0 text-decoration-none" style="font-size: 11.5px; color: #0f8a83; font-weight: 600;">
                            Pilih Semua
                        </button>
                    </div>
                    <div id="listSiswaChecklist" class="border rounded-3 p-2" style="max-height: 185px; overflow-y: auto; background: #f8fbfb; border-color: #d7e3e0 !important;">
                    </div>
                </div>

                <div class="mb-3" id="wrapKelasTujuan">
                    <label for="kelas_tujuan_id" class="form-label fw-semibold" style="font-size: 13px;">Pilih Kelas Tujuan (Tahun Ajaran Baru)</label>
                    <select name="kelas_tujuan_id" id="kelas_tujuan_id" class="form-select" style="font-size: 13px; border-radius: 9px;">
                        <option value="">-- Pilih Kelas Tujuan --</option>
                        @foreach ($semuaKelas ?? [] as $kls)
                            @if ($kls->is_active)
                                <option value="{{ $kls->id }}">
                                    {{ $kls->nama_kelas }} · {{ $kls->tahun_ajaran }} (Tingkat {{ $kls->tingkat }})
                                </option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="p-3 rounded-3" style="background: #eaf6f4; border: 1px solid #cce7e3; font-size: 12px; color: #194744;">
                    <div class="fw-bold mb-1">
                        <i class="bi bi-archive-fill me-1"></i> Cara Kerja Otomatis:
                    </div>
                    <ul class="mb-0 ps-3">
                        <li><strong>Naik Kelas Massal:</strong> Seluruh siswa di Kelas Asal langsung pindah ke Kelas Tujuan dalam sekali klik, dan kelas lamanya otomatis tersimpan di arsip <em>Riwayat Kelas</em>.</li>
                        <li><strong>Luluskan Kelas XII:</strong> Seluruh siswa di kelas tersebut otomatis tercatat Tamat/Lulus di arsip tahun ajarannya dan akunnya dinonaktifkan.</li>
                    </ul>
                </div>
            </div>

            <div class="modal-footer" style="border-top: 1px solid #e7efed; padding: 14px 20px;">
                <button type="button" class="btn btn-light border px-3" data-bs-dismiss="modal" style="font-size: 12.5px; font-weight: 600; border-radius: 8px;">
                    Batal
                </button>
                <button type="submit" class="btn text-white px-3" style="background: #0f8a83; font-size: 12.5px; font-weight: 600; border-radius: 8px;">
                    <i class="bi bi-check2-circle me-1"></i> Proses Seluruh Siswa di Kelas Ini
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    const siswaPerKelasData = @json($siswaPerKelas ?? []);
    const aksiPromosiSelect = document.getElementById('aksiPromosi');
    const kelasAsalSelect = document.getElementById('kelas_asal_id');
    const wrapKelasTujuan = document.getElementById('wrapKelasTujuan');
    const kelasTujuanSelect = document.getElementById('kelas_tujuan_id');
    const wrapDaftarSiswaKelas = document.getElementById('wrapDaftarSiswaKelas');
    const listSiswaChecklist = document.getElementById('listSiswaChecklist');
    const btnToggleSelectAllSiswa = document.getElementById('btnToggleSelectAllSiswa');

    function syncPromosiMode() {
        if (!aksiPromosiSelect || !wrapKelasTujuan || !kelasTujuanSelect) return;
        if (aksiPromosiSelect.value === 'tamat') {
            wrapKelasTujuan.classList.add('d-none');
            kelasTujuanSelect.removeAttribute('required');
            kelasTujuanSelect.value = '';
        } else {
            wrapKelasTujuan.classList.remove('d-none');
            kelasTujuanSelect.setAttribute('required', 'required');
        }
    }

    function renderChecklistSiswa() {
        if (!kelasAsalSelect || !wrapDaftarSiswaKelas || !listSiswaChecklist) return;
        const kelasId = kelasAsalSelect.value;
        const list = siswaPerKelasData[kelasId] || [];

        listSiswaChecklist.innerHTML = '';

        if (!kelasId || list.length === 0) {
            wrapDaftarSiswaKelas.classList.add('d-none');
            return;
        }

        wrapDaftarSiswaKelas.classList.remove('d-none');
        list.forEach(function (s) {
            const itemDiv = document.createElement('div');
            itemDiv.className = 'form-check py-1 px-3 border-bottom';
            itemDiv.style.fontSize = '12.5px';
            itemDiv.innerHTML = `
                <input class="form-check-input siswa-promosi-check" type="checkbox" name="siswa_ids[]" value="${s.id}" id="chk_siswa_${s.id}" checked>
                <label class="form-check-label d-flex justify-content-between w-100" for="chk_siswa_${s.id}" style="cursor:pointer;">
                    <span class="fw-semibold text-dark">${s.name}</span>
                    <span class="text-muted">NISN: ${s.nis || '-'}</span>
                </label>
            `;
            listSiswaChecklist.appendChild(itemDiv);
        });
    }

    btnToggleSelectAllSiswa?.addEventListener('click', function () {
        const checks = listSiswaChecklist?.querySelectorAll('.siswa-promosi-check') || [];
        const allChecked = Array.from(checks).every(c => c.checked);
        checks.forEach(c => { c.checked = !allChecked; });
    });

    function resetPromosiMassalModal() {
        if (aksiPromosiSelect) aksiPromosiSelect.value = 'naik_kelas';
        if (kelasAsalSelect) kelasAsalSelect.value = '';
        if (kelasTujuanSelect) kelasTujuanSelect.value = '';
        syncPromosiMode();
        renderChecklistSiswa();
    }

    const promosiMassalModalEl = document.getElementById('promosiMassalModal');
    promosiMassalModalEl?.addEventListener('hidden.bs.modal', resetPromosiMassalModal);
    promosiMassalModalEl?.addEventListener('show.bs.modal', resetPromosiMassalModal);

    aksiPromosiSelect?.addEventListener('change', syncPromosiMode);
    kelasAsalSelect?.addEventListener('change', renderChecklistSiswa);
    syncPromosiMode();
    renderChecklistSiswa();
</script>

</body>
</html>
