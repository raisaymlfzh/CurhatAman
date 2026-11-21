<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Wali Kelas | CurhatAman</title>

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
            --ca-danger: #b42318;
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
            color: var(--ca-danger);
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
            max-width: 1180px;
            margin: 0 auto;
        }

        .page-header {
            margin-bottom: 22px;
            padding: 20px 22px;
            border-radius: 12px;
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

        .password-success {
            margin-bottom: 18px;
            padding: 11px 13px;
            border: 1px solid #cbe6dc;
            border-radius: 9px;
            display: flex;
            align-items: center;
            gap: 8px;
            color: #087443;
            background: #edf9f4;
            font-size: .72rem;
            font-weight: 600;
        }

        .profile-layout {
            display: grid;
            grid-template-columns: 300px minmax(0, 1fr);
            gap: 18px;
        }

        .panel {
            border: 1px solid var(--ca-border);
            border-radius: 11px;
            background: var(--ca-surface);
            overflow: hidden;
        }

        .profile-card {
            padding: 22px 18px;
            border-top: 3px solid var(--ca-primary);
            text-align: center;
        }

        .profile-avatar {
            width: 72px;
            height: 72px;
            margin: 0 auto 14px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            background: var(--ca-primary);
            font-size: 1.18rem;
            font-weight: 740;
        }

        .profile-name {
            color: var(--ca-text);
            font-size: .95rem;
            font-weight: 700;
        }

        .profile-email {
            margin-top: 3px;
            color: var(--ca-muted);
            font-size: .7rem;
            overflow-wrap: anywhere;
        }

        .role-badge {
            margin-top: 13px;
            padding: 5px 9px;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: var(--ca-primary-dark);
            background: var(--ca-primary-soft);
            font-size: .68rem;
            font-weight: 660;
        }

        .profile-note {
            margin-top: 16px;
            padding-top: 14px;
            border-top: 1px solid var(--ca-line);
            color: var(--ca-muted);
            font-size: .67rem;
            line-height: 1.55;
            text-align: left;
        }

        .profile-note i {
            margin-right: 4px;
            color: var(--ca-primary);
        }

        .panel-header {
            min-height: 64px;
            padding: 14px 16px;
            border-bottom: 1px solid var(--ca-line);
        }

        .panel-title {
            color: var(--ca-text);
            font-size: .82rem;
            font-weight: 680;
        }

        .panel-subtitle {
            margin-top: 3px;
            color: var(--ca-muted);
            font-size: .69rem;
        }

        .detail-list {
            padding: 2px 16px;
        }

        .detail-row {
            display: grid;
            grid-template-columns: 180px minmax(0, 1fr);
            gap: 18px;
            padding: 14px 0;
            border-bottom: 1px solid var(--ca-line);
        }

        .detail-row:last-child {
            border-bottom: 0;
        }

        .detail-label {
            color: var(--ca-muted);
            font-size: .7rem;
            font-weight: 560;
        }

        .detail-value {
            color: #344054;
            font-size: .72rem;
            font-weight: 630;
            overflow-wrap: anywhere;
        }

        .status-active,
        .status-inactive {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: .7rem;
            font-weight: 670;
        }

        .status-active {
            color: #027a48;
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
            border: 1px solid #d6e7e4;
            border-radius: 10px;
            background: #f7fbfa;
        }

        .access-title {
            margin-bottom: 6px;
            display: flex;
            align-items: center;
            gap: 7px;
            color: var(--ca-primary-dark);
            font-size: .72rem;
            font-weight: 680;
        }

        .access-copy {
            color: #59716e;
            font-size: .67rem;
            line-height: 1.55;
        }

        .security-panel {
            margin-top: 16px;
            border-top: 3px solid var(--ca-primary);
        }

        .security-header {
            display: flex;
            align-items: flex-start;
            gap: 9px;
        }

        .security-icon {
            width: 31px;
            height: 31px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            color: var(--ca-primary-dark);
            background: var(--ca-primary-soft);
            font-size: .78rem;
        }

        .password-form {
            padding: 16px;
        }

        .password-label {
            margin-bottom: 6px;
            color: #475467;
            font-size: .69rem;
            font-weight: 610;
        }

        .password-wrap {
            position: relative;
        }

        .password-input {
            min-height: 42px;
            padding-right: 42px;
            border: 1px solid var(--ca-border);
            border-radius: 9px;
            font-size: .75rem;
            box-shadow: none;
        }

        .password-input:focus {
            border-color: rgba(15, 138, 131, .55);
            box-shadow: 0 0 0 .2rem rgba(15, 138, 131, .08);
        }

        .password-toggle {
            position: absolute;
            top: 50%;
            right: 6px;
            width: 30px;
            height: 30px;
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
            font-size: .64rem;
            line-height: 1.45;
        }

        .password-error {
            margin-top: 5px;
            color: var(--ca-danger);
            font-size: .64rem;
        }

        .security-actions {
            margin-top: 16px;
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
            gap: 6px;
            color: #ffffff;
            background: var(--ca-primary);
            font-size: .72rem;
            font-weight: 640;
        }

        .btn-save-password:hover,
        .btn-save-password:focus {
            color: #ffffff;
            background: var(--ca-primary-dark);
            border-color: var(--ca-primary-dark);
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

            .profile-layout {
                grid-template-columns: 1fr;
            }

            .date-chip {
                display: none;
            }
        }

        @media (max-width: 767.98px) {
            .detail-row {
                grid-template-columns: 1fr;
                gap: 5px;
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

            .security-actions {
                justify-content: stretch;
            }

            .btn-save-password {
                width: 100%;
            }
        }
    </style>
    @include('wali-kelas.partials.styles')
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
                    Profil Wali Kelas
                </div>

                <div class="topbar-subtitle">
                    Informasi akun dan kelas yang menjadi tanggung jawab Anda
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
                            Akun Pengguna
                        </div>

                        <h1 class="page-title">
                            Profil Saya
                        </h1>

                        <p class="page-copy">
                            Informasi akun Wali Kelas dan kelas yang telah ditetapkan oleh administrator sekolah pada CurhatAman.
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
                                Wali Kelas
                            </div>

                            <div class="profile-note">
                                <i class="bi bi-info-circle"></i>
                                Informasi identitas dan penugasan kelas dikelola oleh administrator sekolah.
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
                                    Data pengguna dan penugasan kelas
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
                                        Wali Kelas
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
                                        Kelas yang Diampu
                                    </div>

                                    <div class="detail-value">
                                        {{ $kelas->nama_kelas ?? 'Belum ditentukan' }}
                                    </div>
                                </div>

                                <div class="detail-row">
                                    <div class="detail-label">
                                        Tingkat
                                    </div>

                                    <div class="detail-value">
                                        {{ $kelas ? 'Tingkat ' . $kelas->tingkat : '-' }}
                                    </div>
                                </div>

                                <div class="detail-row">
                                    <div class="detail-label">
                                        Tahun Ajaran
                                    </div>

                                    <div class="detail-value">
                                        {{ $kelas->tahun_ajaran ?? '-' }}
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
                                Lingkup Akses Wali Kelas
                            </div>

                            <div class="access-copy">
                                Wali Kelas dapat memantau ringkasan kasus kelas secara agregat dan status partisipasi skrining. Identitas pelapor, kronologi laporan, bukti, jawaban skrining, skor individual, serta catatan pendampingan Guru BK tidak ditampilkan.
                            </div>
                        </div>

                        <div class="panel security-panel">
                            <div class="panel-header">
                                <div class="security-header">
                                    <span class="security-icon">
                                        <i class="bi bi-shield-lock"></i>
                                    </span>

                                    <div>
                                        <div class="panel-title">
                                            Keamanan Akun
                                        </div>

                                        <div class="panel-subtitle">
                                            Kebijakan pengelolaan kata sandi akun Wali Kelas
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="p-3">
                                <div class="d-flex align-items-start gap-3 p-3 rounded-3" style="background: #f0f8f7; border: 1px solid #cce8e5; color: #0b6f69; font-size: 13px; line-height: 1.55;">
                                    <i class="bi bi-info-circle-fill fs-5 mt-1 flex-shrink-0" style="color: var(--ca-primary, #0f8a83);"></i>
                                    <div>
                                        <strong>Pengelolaan Password Terpusat:</strong><br>
                                        Sesuai kebijakan wewenang sistem, pengaturan ulang (reset) dan penggantian password untuk akun <strong>Wali Kelas</strong> dikelola secara terpusat oleh <strong>Administrator Sekolah</strong> melalui menu <em>Kelola Pengguna</em>. Jika Anda memerlukan perubahan atau lupa kata sandi, silakan hubungi Admin Sekolah.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <footer class="page-footer">
                    <div class="d-flex flex-column flex-md-row justify-content-between gap-2">
                        <span>
                            © {{ date('Y') }} CurhatAman
                        </span>

                        <span>
                            Portal Wali Kelas · Profil pengguna
                        </span>
                    </div>
                </footer>
            </div>
        </div>
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    const sidebar = document.getElementById('waliSidebar');
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

    if (sidebarOverlay) {
        sidebarOverlay.addEventListener('click', closeSidebar);
    }

    window.addEventListener('resize', function () {
        if (window.innerWidth >= 992) {
            closeSidebar();
        }
    });

    document
        .querySelectorAll('[data-password-target]')
        .forEach(function (button) {
            button.addEventListener('click', function () {
                const targetId = button.getAttribute('data-password-target');
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
