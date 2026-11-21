<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Guru BK - CurhatAman</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

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
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
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
            min-height: 50px;
            margin-bottom: 28px;
            padding: 0 8px;
            display: flex;
            align-items: center;
            gap: 11px;
        }

        .brand-symbol {
            width: 40px;
            height: 40px;
            flex: 0 0 40px;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            background: var(--ca-primary);
            font-size: 17px;
        }

        .brand-name {
            display: block;
            color: var(--ca-primary);
            font-size: 17px;
            line-height: 1.15;
            font-weight: 760;
            letter-spacing: -.02em;
        }

        .brand-role {
            display: block;
            margin-top: 3px;
            color: var(--ca-muted);
            font-size: 11px;
            font-weight: 600;
        }

        .sidebar-section-label {
            margin: 0 10px 9px;
            color: var(--ca-muted-light);
            font-size: 10px;
            font-weight: 750;
            letter-spacing: .09em;
            text-transform: uppercase;
        }

        .sidebar-nav {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .sidebar-link {
            min-height: 42px;
            padding: 9px 11px;
            border-radius: 9px;
            display: flex;
            align-items: center;
            gap: 11px;
            color: #475467;
            font-size: 13px;
            font-weight: 560;
            transition: background .15s ease, color .15s ease;
        }

        .sidebar-link i {
            width: 19px;
            color: #7b8795;
            font-size: 15px;
            text-align: center;
        }

        .sidebar-link:hover {
            color: var(--ca-primary-dark);
            background: #f4f9f8;
        }

        .sidebar-link:hover i {
            color: var(--ca-primary);
        }

        .sidebar-spacer {
            flex: 1;
        }

        .sidebar-account {
            margin-top: 24px;
            padding-top: 16px;
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
            color: var(--ca-danger);
            background: transparent;
            font-size: 12.5px;
            font-weight: 560;
            text-align: left;
        }

        .logout-button:hover {
            background: var(--ca-danger-soft);
        }

        .topbar {
            grid-column: 2;
            min-width: 0;
            padding: 0 28px;
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
            color: var(--ca-text);
            font-size: 14px;
            font-weight: 700;
        }

        .topbar-subtitle {
            margin-top: 2px;
            color: var(--ca-muted);
            font-size: 11px;
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

        .account-trigger:hover .account-chevron,
        .account-trigger:focus-visible .account-chevron {
            color: var(--ca-primary);
            transform: translateX(2px);
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
            width: 100%;
            max-width: 1100px;
            margin: 0 auto;
        }

        .page-header {
            margin-bottom: 20px;
            padding: 20px 21px;
            border-radius: 12px;
            background: var(--ca-primary);
        }

        .page-kicker {
            margin-bottom: 5px;
            color: rgba(255, 255, 255, .72);
            font-size: 10px;
            font-weight: 760;
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        .page-title {
            margin: 0 0 6px;
            color: #ffffff;
            font-size: 25px;
            line-height: 1.2;
            font-weight: 760;
            letter-spacing: -.02em;
        }

        .page-copy {
            max-width: 720px;
            margin: 0;
            color: rgba(255, 255, 255, .82);
            font-size: 12px;
            line-height: 1.6;
        }

        .profile-layout {
            display: grid;
            grid-template-columns: 300px minmax(0, 1fr);
            gap: 18px;
            align-items: start;
        }

        .panel {
            border: 1px solid var(--ca-border);
            border-top: 3px solid var(--ca-primary);
            border-radius: 12px;
            background: #ffffff;
            overflow: hidden;
        }

        .profile-card {
            padding: 22px 20px;
            text-align: center;
        }

        .profile-avatar {
            width: 74px;
            height: 74px;
            margin-bottom: 14px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            background: var(--ca-primary);
            font-size: 22px;
            font-weight: 760;
        }

        .profile-name {
            margin-bottom: 4px;
            color: var(--ca-text);
            font-size: 15px;
            font-weight: 720;
        }

        .profile-email {
            overflow-wrap: anywhere;
            color: var(--ca-muted);
            font-size: 10.5px;
        }

        .role-badge {
            margin-top: 14px;
            padding: 6px 10px;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: var(--ca-primary-dark);
            background: var(--ca-primary-soft);
            font-size: 10px;
            font-weight: 680;
        }

        .profile-note {
            margin-top: 17px;
            padding-top: 15px;
            border-top: 1px solid var(--ca-line);
            color: var(--ca-muted);
            font-size: 10px;
            line-height: 1.55;
            text-align: left;
        }

        .profile-note i {
            margin-right: 5px;
            color: var(--ca-primary);
        }

        .panel-header {
            padding: 16px 18px;
            border-bottom: 1px solid var(--ca-line);
            background: #ffffff;
        }

        .panel-title {
            margin-bottom: 2px;
            color: var(--ca-text);
            font-size: 13px;
            font-weight: 710;
        }

        .panel-subtitle {
            color: var(--ca-muted);
            font-size: 10.5px;
        }

        .detail-list {
            padding: 3px 18px;
        }

        .detail-row {
            padding: 15px 0;
            border-bottom: 1px solid var(--ca-line);
            display: grid;
            grid-template-columns: 170px minmax(0, 1fr);
            gap: 18px;
        }

        .detail-row:last-child {
            border-bottom: 0;
        }

        .detail-label {
            color: var(--ca-muted);
            font-size: 10.5px;
            font-weight: 590;
        }

        .detail-value {
            color: #344054;
            font-size: 11.5px;
            font-weight: 630;
            overflow-wrap: anywhere;
        }

        .status-active,
        .status-inactive {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 10.5px;
            font-weight: 680;
        }

        .status-active {
            color: var(--ca-success);
        }

        .status-inactive {
            color: var(--ca-danger);
        }

        .status-active::before,
        .status-inactive::before {
            content: "";
            width: 7px;
            height: 7px;
            border-radius: 50%;
        }

        .status-active::before {
            background: #12b76a;
        }

        .status-inactive::before {
            background: #f04438;
        }

        .access-panel {
            margin-top: 16px;
            padding: 13px 14px;
            border: 1px solid #d4e8e5;
            border-radius: 10px;
            background: #f5faf9;
        }

        .access-title {
            margin-bottom: 5px;
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--ca-primary-dark);
            font-size: 11px;
            font-weight: 700;
        }

        .access-copy {
            color: #55706d;
            font-size: 10.5px;
            line-height: 1.6;
        }

        .security-panel {
            margin-top: 16px;
        }

        .security-panel .panel-header {
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }

        .security-icon {
            width: 34px;
            height: 34px;
            flex: 0 0 34px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: var(--ca-primary-dark);
            background: var(--ca-primary-soft);
            font-size: 14px;
        }

        .password-form {
            padding: 18px;
        }

        .password-label {
            margin-bottom: 6px;
            color: #475467;
            font-size: 10.5px;
            font-weight: 650;
        }

        .password-wrap {
            position: relative;
        }

        .password-input {
            min-height: 42px;
            padding-right: 42px;
            border: 1px solid #d8e1e1;
            border-radius: 9px;
            color: var(--ca-text);
            background: #ffffff;
            font-size: 11.5px;
            box-shadow: none;
        }

        .password-input:focus {
            border-color: rgba(15, 138, 131, .58);
            box-shadow: 0 0 0 .2rem rgba(15, 138, 131, .08);
        }

        .password-toggle {
            position: absolute;
            top: 50%;
            right: 7px;
            width: 31px;
            height: 31px;
            padding: 0;
            border: 0;
            border-radius: 7px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transform: translateY(-50%);
            color: var(--ca-muted);
            background: transparent;
        }

        .password-toggle:hover {
            color: var(--ca-primary-dark);
            background: var(--ca-primary-soft);
        }

        .password-help {
            margin-top: 6px;
            color: var(--ca-muted);
            font-size: 9.8px;
            line-height: 1.45;
        }

        .password-error {
            margin-top: 5px;
            color: var(--ca-danger);
            font-size: 10px;
        }

        .password-success {
            margin-bottom: 18px;
            padding: 11px 13px;
            border: 1px solid #cbe6dc;
            border-radius: 9px;
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--ca-success);
            background: #edf9f4;
            font-size: 10.5px;
            font-weight: 600;
        }

        .security-actions {
            margin-top: 18px;
            display: flex;
            justify-content: flex-end;
        }

        .btn-save-password {
            min-height: 40px;
            padding: 0 14px;
            border: 1px solid var(--ca-primary);
            border-radius: 9px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            color: #ffffff;
            background: var(--ca-primary);
            font-size: 11px;
            font-weight: 680;
        }

        .btn-save-password:hover {
            color: #ffffff;
            background: var(--ca-primary-dark);
            border-color: var(--ca-primary-dark);
        }

        .page-footer {
            min-height: 62px;
            margin-top: 28px;
            padding: 0 18px;
            border-radius: 11px;
            display: flex;
            align-items: center;
            color: rgba(255, 255, 255, .78);
            background: var(--ca-primary-dark);
            font-size: 10.5px;
        }

        .page-footer > div {
            width: 100%;
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

            .page-body {
                padding: 22px 18px 30px;
            }

            .profile-layout {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 575.98px) {
            .date-chip,
            .account-copy,
            .account-chevron {
                display: none !important;
            }

            .account-trigger {
                min-width: 0;
                width: 42px;
                min-height: 42px;
                padding: 3px;
            }

            .page-title {
                font-size: 22px;
            }

            .detail-row {
                grid-template-columns: 1fr;
                gap: 5px;
            }

            .security-actions {
                justify-content: stretch;
            }

            .btn-save-password {
                width: 100%;
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
                    Profil Guru BK
                </div>

                <div class="topbar-subtitle">
                    Informasi akun Guru BK.
                </div>
            </div>
        </div>

        <div class="topbar-actions">

            @include('guru-bk.partials.notification-bell')
            <div class="date-chip">
                <i class="bi bi-calendar3"></i>
                {{ now()->locale('id')->translatedFormat('d F Y') }}
            </div>

            <a
                href="{{ route('guru-bk.profil.index') }}"
                class="account-trigger"
                aria-current="page"
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

                <section class="page-header">
                    <div>
                        <div class="page-kicker">
                            Akun Pengguna
                        </div>

                        <h1 class="page-title">
                            Profil Saya
                        </h1>

                        <p class="page-copy">
                            Informasi akun Guru BK.
                        </p>
                    </div>
                </section>

                @if(session('password_success'))
                    <div class="password-success">
                        <i class="bi bi-check-circle-fill"></i>
                        <span>{{ session('password_success') }}</span>
                    </div>
                @endif

                <section class="profile-layout">

                    <div>
                        <div class="panel profile-card">

                            <div class="profile-avatar">
                                {{ $inisial }}
                            </div>

                            <div class="profile-name">
                                {{ $namaUser }}
                            </div>

                            <div class="profile-email">
                                {{ $user->email }}
                            </div>

                            <div class="role-badge">
                                <i class="bi bi-person-badge"></i>
                                Guru BK
                            </div>

                            <div class="profile-note">
                                <i class="bi bi-info-circle"></i>
                                Informasi identitas akun Guru BK
                                dikelola oleh administrator sekolah.
                            </div>

                        </div>
                    </div>

                    <div>

                        <div class="panel">
                            <div class="panel-header">
                                <div class="panel-title">
                                    Informasi Akun
                                </div>

                                <div class="panel-subtitle">
                                    Data utama yang terdaftar pada sistem
                                </div>
                            </div>

                            <div class="detail-list">

                                <div class="detail-row">
                                    <div class="detail-label">
                                        Nama Lengkap
                                    </div>

                                    <div class="detail-value">
                                        {{ $namaUser }}
                                    </div>
                                </div>

                                <div class="detail-row">
                                    <div class="detail-label">
                                        Email
                                    </div>

                                    <div class="detail-value">
                                        {{ $user->email }}
                                    </div>
                                </div>

                                <div class="detail-row">
                                    <div class="detail-label">
                                        Peran
                                    </div>

                                    <div class="detail-value">
                                        Guru BK
                                    </div>
                                </div>

                                <div class="detail-row">
                                    <div class="detail-label">
                                        Status Akun
                                    </div>

                                    <div class="detail-value">
                                        @if ($user->is_active)
                                            <span class="status-active">
                                                Aktif
                                            </span>
                                        @else
                                            <span class="status-inactive">
                                                Tidak Aktif
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="detail-row">
                                    <div class="detail-label">
                                        Terdaftar Sejak
                                    </div>

                                    <div class="detail-value">
                                        {{ $user->created_at
                                            ? $user->created_at->locale('id')->translatedFormat('d F Y')
                                            : '-' }}
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="access-panel">
                            <div class="access-title">
                                <i class="bi bi-shield-check"></i>
                                Hak Akses Guru BK
                            </div>

                            <div class="access-copy">
                                Akses akun mencakup penanganan laporan,
                                pemantauan skrining, permintaan bantuan,
                                rujukan, dan statistik pendampingan siswa.
                            </div>
                        </div>

                        <div class="panel security-panel">

                            <div class="panel-header">

                                <span class="security-icon">
                                    <i class="bi bi-shield-lock"></i>
                                </span>

                                <div>
                                    <div class="panel-title">
                                        Keamanan Akun
                                    </div>

                                    <div class="panel-subtitle">
                                        Kebijakan pengelolaan kata sandi akun Guru BK
                                    </div>
                                </div>

                            </div>

                            <div class="p-3">
                                <div class="d-flex align-items-start gap-3 p-3 rounded-3" style="background: #f0f8f7; border: 1px solid #cce8e5; color: #0b6f69; font-size: 13px; line-height: 1.55;">
                                    <i class="bi bi-info-circle-fill fs-5 mt-1 flex-shrink-0" style="color: var(--ca-primary, #0f8a83);"></i>
                                    <div>
                                        <strong>Pengelolaan Password Terpusat:</strong><br>
                                        Sesuai kebijakan wewenang sistem, pengaturan ulang (reset) dan penggantian password untuk akun <strong>Guru BK</strong> dikelola secara terpusat oleh <strong>Administrator Sekolah</strong> melalui menu <em>Kelola Pengguna</em>. Jika Anda memerlukan perubahan atau lupa kata sandi, silakan hubungi Admin Sekolah.
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                </section>

                <footer class="page-footer">
                    <div class="d-flex flex-column flex-md-row justify-content-between gap-2">
                        <span>© {{ date('Y') }} CurhatAman</span>
                        <span>Portal Guru BK · Profil pengguna</span>
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

    document
        .querySelectorAll('[data-password-target]')
        .forEach(function (button) {

            button.addEventListener('click', function () {

                const targetId = button.getAttribute(
                    'data-password-target'
                );

                const input = document.getElementById(targetId);
                const icon = button.querySelector('i');

                if (!input) {
                    return;
                }

                const isHidden = input.type === 'password';

                input.type = isHidden ? 'text' : 'password';

                icon.classList.toggle('bi-eye', !isHidden);
                icon.classList.toggle('bi-eye-slash', isHidden);
            });

        });
</script>

</body>
</html>


