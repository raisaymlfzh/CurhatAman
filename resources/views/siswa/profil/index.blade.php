<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Siswa - CurhatAman</title>

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
            --ca-bg: #f7f9f9;
            --ca-surface: #ffffff;
            --ca-border: #e3e9e9;
            --ca-line: #edf1f1;
            --ca-danger: #b42318;
            --ca-radius: 12px;
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
            display: flex;
            flex-direction: column;
            color: var(--ca-text);
            background: var(--ca-bg);
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Arial, sans-serif;
            font-size: 14px;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        .student-navbar {
            min-height: 72px;
            background: rgba(255, 255, 255, .98);
            border-bottom: 1px solid var(--ca-border);
        }

        .student-navbar .container {
            min-height: 72px;
        }

        .navbar-brand {
            margin-right: 2rem;
        }

        .brand-symbol {
            width: 42px;
            height: 42px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            border-radius: 10px;
            color: #ffffff;
            background: var(--ca-primary);
            font-size: 1.15rem;
        }

        .brand-text {
            color: var(--ca-primary);
            font-size: 1.18rem;
            font-weight: 720;
            letter-spacing: -.3px;
        }

        .student-navbar .nav-link {
            position: relative;
            padding: 1.48rem .9rem 1.28rem !important;
            color: #475467;
            font-size: .88rem;
            font-weight: 520;
        }

        .student-navbar .nav-link:hover {
            color: var(--ca-primary-dark);
        }

        .notification-link {
            position: relative;
            width: 40px;
            height: 40px;
            margin-right: 10px;
            border: 1px solid var(--ca-border);
            border-radius: 9px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #667085;
            background: #ffffff;
            font-size: .98rem;
        }

        .notification-link:hover,
        .notification-link:focus {
            color: var(--ca-primary-dark);
            background: #f7fbfa;
            border-color: #cfe3e0;
        }

        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            min-width: 18px;
            height: 18px;
            padding: 0 5px;
            border: 2px solid #ffffff;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            background: #c64747;
            font-size: .61rem;
            font-weight: 700;
        }

        .account-dropdown .dropdown-toggle::after {
            display: none;
        }

        .account-trigger {
            min-width: 180px;
            padding: 5px 7px;
            border: 1px solid #cfe3e0;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            gap: 9px;
            color: var(--ca-text);
            background: #f7fbfa;
            text-align: left;
        }

        .account-trigger:hover,
        .account-trigger:focus,
        .account-trigger[aria-expanded="true"] {
            background: var(--ca-primary-soft);
            border-color: #b7d8d4;
        }

        .student-avatar,
        .student-avatar-image {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .student-avatar {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: var(--ca-primary-dark);
            background: #dcefeb;
            font-size: .86rem;
            font-weight: 700;
        }

        .student-avatar-image {
            display: block;
            object-fit: cover;
            border: 1px solid var(--ca-border);
        }

        .account-copy {
            min-width: 0;
            flex: 1;
        }

        .user-name {
            max-width: 132px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            color: var(--ca-text);
            font-size: .82rem;
            font-weight: 650;
        }

        .account-label {
            margin-top: 1px;
            color: var(--ca-muted);
            font-size: .68rem;
        }

        .account-chevron {
            color: var(--ca-muted-light);
            font-size: .7rem;
            transition: transform .18s ease;
        }

        .account-trigger[aria-expanded="true"] .account-chevron {
            transform: rotate(180deg);
        }

        .account-menu {
            width: 220px;
            margin-top: 8px !important;
            padding: 8px;
            border: 1px solid var(--ca-border);
            border-radius: 11px;
            background: #ffffff;
            box-shadow: 0 12px 30px rgba(15, 23, 42, .10);
        }

        .account-menu-header {
            padding: 8px 10px 10px;
            margin-bottom: 6px;
            border-bottom: 1px solid var(--ca-line);
        }

        .account-menu-name {
            margin-bottom: 2px;
            font-size: .8rem;
            font-weight: 650;
        }

        .account-menu-email {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            color: var(--ca-muted);
            font-size: .69rem;
        }

        .account-menu .dropdown-item {
            display: flex;
            align-items: center;
            gap: 9px;
            padding: 9px 10px;
            border-radius: 8px;
            color: #344054;
            font-size: .77rem;
            font-weight: 500;
        }

        .account-menu .dropdown-item:hover,
        .account-menu .dropdown-item:focus {
            color: var(--ca-primary-dark);
            background: var(--ca-primary-soft);
        }

        .account-menu .dropdown-item i {
            width: 18px;
            color: var(--ca-primary);
            font-size: .88rem;
        }

        .account-menu .dropdown-divider {
            margin: 6px 0;
            border-color: var(--ca-line);
        }

        .account-logout {
            width: 100%;
            border: 0;
            background: transparent;
            text-align: left;
        }

        .account-logout i {
            color: var(--ca-danger) !important;
        }

        .account-logout:hover,
        .account-logout:focus {
            color: var(--ca-danger) !important;
            background: #fff3f2 !important;
        }

        .profile-main {
            flex: 1;
            padding: 34px 0 38px;
        }

        .breadcrumb {
            --bs-breadcrumb-divider-color: #b0b8c1;
            --bs-breadcrumb-item-active-color: var(--ca-muted);
            margin-bottom: 18px;
            font-size: .76rem;
        }

        .breadcrumb a {
            color: var(--ca-primary-dark);
            font-weight: 600;
        }

        .page-kicker {
            margin-bottom: 6px;
            color: var(--ca-primary);
            font-size: .69rem;
            font-weight: 740;
            letter-spacing: .065em;
            text-transform: uppercase;
        }

        .page-title {
            margin: 0;
            font-size: clamp(1.7rem, 3vw, 2.15rem);
            font-weight: 720;
            letter-spacing: -.55px;
        }

        .page-subtitle {
            max-width: 700px;
            margin: 8px 0 0;
            color: var(--ca-muted);
            font-size: .9rem;
            line-height: 1.55;
        }

        .profile-summary,
        .profile-card,
        .security-card {
            border: 1px solid var(--ca-border);
            border-radius: var(--ca-radius);
            background: #ffffff;
        }

        .profile-summary {
            padding: 20px;
        }

        .photo-area {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding-bottom: 18px;
            border-bottom: 1px solid var(--ca-line);
            text-align: center;
        }

        .profile-photo-wrap {
            position: relative;
            width: 96px;
            height: 96px;
            margin-bottom: 13px;
        }

        .profile-avatar-large,
        .profile-photo-large {
            width: 96px;
            height: 96px;
            border-radius: 50%;
        }

        .profile-avatar-large {
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            background: var(--ca-primary);
            font-size: 1.8rem;
            font-weight: 700;
        }

        .profile-photo-large {
            display: block;
            object-fit: cover;
            border: 2px solid #ffffff;
            box-shadow: 0 0 0 1px var(--ca-border);
        }

        .photo-edit-trigger {
            position: absolute;
            right: -2px;
            bottom: 2px;
            width: 32px;
            height: 32px;
            border: 2px solid #ffffff;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            background: var(--ca-primary);
            cursor: pointer;
            font-size: .78rem;
        }

        .photo-edit-trigger:hover {
            background: var(--ca-primary-dark);
        }

        .profile-name {
            margin: 0;
            color: var(--ca-text);
            font-size: 1rem;
            font-weight: 690;
        }

        .profile-email {
            margin: 4px 0 0;
            color: var(--ca-muted);
            font-size: .76rem;
        }

        .student-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            margin-top: 8px;
            padding: 5px 8px;
            border-radius: 999px;
            color: var(--ca-primary-dark);
            background: var(--ca-primary-soft);
            font-size: .67rem;
            font-weight: 650;
        }

        .photo-form {
            width: 100%;
            margin-top: 16px;
        }

        .photo-help {
            margin: 7px 0 0;
            color: var(--ca-muted);
            font-size: .68rem;
            line-height: 1.45;
        }

        .photo-file-name {
            min-height: 18px;
            margin-top: 8px;
            color: var(--ca-primary-dark);
            font-size: .69rem;
            font-weight: 600;
        }

        .photo-save-button {
            width: 100%;
            min-height: 42px;
            margin-top: 9px;
            border: 1px solid var(--ca-primary);
            border-radius: 9px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            color: #ffffff;
            background: var(--ca-primary);
            font-size: .8rem;
            font-weight: 650;
        }

        .photo-save-button:hover,
        .photo-save-button:focus {
            color: #ffffff;
            background: var(--ca-primary-dark);
            border-color: var(--ca-primary-dark);
        }

        .photo-save-button:disabled {
            opacity: .55;
            cursor: not-allowed;
        }

        .photo-error {
            margin-top: 8px;
            color: var(--ca-danger);
            font-size: .7rem;
        }

        .summary-list {
            display: grid;
            gap: 13px;
            padding-top: 18px;
        }

        .summary-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
        }

        .summary-label {
            color: var(--ca-muted);
            font-size: .72rem;
        }

        .summary-value {
            color: var(--ca-text);
            font-size: .78rem;
            font-weight: 620;
            text-align: right;
        }

        .profile-card,
        .security-card {
            padding: 20px;
        }

        .security-card {
            margin-top: 16px;
        }

        .section-title {
            margin: 0;
            color: var(--ca-text);
            font-size: 1rem;
            font-weight: 690;
        }

        .section-copy {
            margin: 5px 0 0;
            color: var(--ca-muted);
            font-size: .78rem;
            line-height: 1.5;
        }

        .data-item {
            height: 100%;
            padding: 14px;
            border: 1px solid var(--ca-border);
            border-radius: 10px;
            background: #fbfcfc;
        }

        .data-icon {
            width: 34px;
            height: 34px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            color: var(--ca-primary);
            background: var(--ca-primary-soft);
            font-size: .86rem;
        }

        .data-label {
            margin-bottom: 3px;
            color: var(--ca-muted);
            font-size: .68rem;
        }

        .data-value {
            margin: 0;
            color: var(--ca-text);
            font-size: .8rem;
            font-weight: 610;
            word-break: break-word;
        }

        .privacy-card {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            padding: 14px;
            margin-top: 16px;
            border: 1px solid #cfe3e0;
            border-radius: 10px;
            color: #315d59;
            background: #f3faf9;
        }

        .privacy-icon {
            width: 34px;
            height: 34px;
            border-radius: 9px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            color: var(--ca-primary);
            background: #ffffff;
        }

        .privacy-title {
            margin-bottom: 3px;
            font-size: .78rem;
            font-weight: 650;
        }

        .privacy-copy {
            margin: 0;
            color: #55706d;
            font-size: .71rem;
            line-height: 1.5;
        }

        .security-heading {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            padding-bottom: 15px;
            margin-bottom: 16px;
            border-bottom: 1px solid var(--ca-line);
        }

        .security-heading-icon {
            width: 36px;
            height: 36px;
            border-radius: 9px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            color: var(--ca-primary);
            background: var(--ca-primary-soft);
            font-size: .9rem;
        }

        .password-label {
            margin-bottom: 6px;
            color: #475467;
            font-size: .73rem;
            font-weight: 620;
        }

        .password-wrap {
            position: relative;
        }

        .password-input {
            min-height: 42px;
            padding-right: 42px;
            border: 1px solid var(--ca-border);
            border-radius: 9px;
            color: var(--ca-text);
            background: #ffffff;
            font-size: .8rem;
        }

        .password-input:focus {
            border-color: rgba(15, 138, 131, .55);
            box-shadow: 0 0 0 .2rem rgba(15, 138, 131, .08);
        }

        .password-toggle {
            position: absolute;
            top: 50%;
            right: 7px;
            width: 32px;
            height: 32px;
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
            font-size: .68rem;
            line-height: 1.45;
        }

        .field-error {
            margin-top: 6px;
            color: var(--ca-danger);
            font-size: .7rem;
        }

        .security-actions {
            margin-top: 18px;
            display: flex;
            justify-content: flex-end;
        }

        .btn-save-password {
            min-height: 42px;
            padding: 0 15px;
            border: 1px solid var(--ca-primary);
            border-radius: 9px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            color: #ffffff;
            background: var(--ca-primary);
            font-size: .8rem;
            font-weight: 650;
        }

        .btn-save-password:hover {
            color: #ffffff;
            background: var(--ca-primary-dark);
            border-color: var(--ca-primary-dark);
        }

        .success-alert {
            padding: 12px 14px;
            margin-bottom: 16px;
            border: 1px solid #bfe3d5;
            border-radius: 10px;
            display: flex;
            align-items: center;
            gap: 8px;
            color: #087443;
            background: #edf9f4;
            font-size: .76rem;
            font-weight: 550;
        }

        .simple-footer {
            margin-top: 24px;
            border-top: 1px solid var(--ca-primary-dark);
            background: var(--ca-primary);
        }

        .simple-footer .container {
            min-height: 64px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            color: rgba(255, 255, 255, .78);
            font-size: .72rem;
        }

        .simple-footer strong {
            color: #ffffff;
            font-weight: 650;
        }

        .footer-links {
            display: flex;
            align-items: center;
            gap: 14px;
            flex-wrap: wrap;
        }

        .footer-link {
            color: rgba(255, 255, 255, .9);
            font-weight: 560;
        }

        .footer-link:hover {
            color: #ffffff;
        }

        .footer-separator {
            color: rgba(255, 255, 255, .42);
        }

        @media (max-width: 991.98px) {
            .student-navbar .nav-link {
                padding: .55rem 0 !important;
            }

            .navbar-brand {
                margin-right: 0;
            }

            .profile-main {
                padding-top: 28px;
            }
        }

        @media (max-width: 575.98px) {
            .account-trigger {
                min-width: auto;
                padding: 5px;
            }

            .account-menu {
                width: min(220px, calc(100vw - 32px));
            }

            .profile-summary,
            .profile-card,
            .security-card {
                padding: 18px;
            }

            .security-actions {
                justify-content: stretch;
            }

            .btn-save-password {
                width: 100%;
            }

            .simple-footer .container {
                padding-top: 16px;
                padding-bottom: 16px;
                flex-direction: column;
                align-items: flex-start;
            }
        }

        .contact-card {
            margin-top: 16px;
        }

        .contact-input-wrap {
            position: relative;
        }

        .contact-input-wrap > i {
            position: absolute;
            top: 50%;
            left: 13px;
            z-index: 2;
            transform: translateY(-50%);
            color: var(--ca-primary);
            font-size: .9rem;
            pointer-events: none;
        }

        .contact-input {
            padding-left: 38px;
        }

        .whatsapp-consent-box {
            padding: 13px 14px;
            margin-bottom: 16px;
            border: 1px solid #cfe3e0;
            border-radius: 10px;
            background: #f7fbfa;
        }

        .whatsapp-consent-box .form-check-label {
            color: var(--ca-text);
            font-size: .76rem;
            line-height: 1.5;
        }

        .whatsapp-consent-box .form-check-input:checked {
            border-color: var(--ca-primary);
            background-color: var(--ca-primary);
        }

        .consent-note {
            margin: 7px 0 0 25px;
            color: var(--ca-muted);
            font-size: .7rem;
            line-height: 1.5;
        }

    </style>
</head>

<body>
@php
    $namaUser = ucwords($user->name);
    $inisial = strtoupper(substr($user->name, 0, 1));

    $namaKelas = optional($siswa->kelas)->nama_kelas
        ?? 'Belum ditentukan';

    $tahunAjaran = optional($siswa->kelas)->tahun_ajaran;
    $nis = $siswa->nis ?: 'Belum tersedia';
    $tahunMasuk = $siswa->tahun_masuk ?: '-';

    $nomorWhatsappTersimpan = $siswa->whatsapp_number;

    $nomorWhatsappDisplay = $nomorWhatsappTersimpan
        ? (
            str_starts_with($nomorWhatsappTersimpan, '62')
                ? '0' . substr($nomorWhatsappTersimpan, 2)
                : $nomorWhatsappTersimpan
        )
        : '';

    $jumlahNotifikasiBelum = \App\Models\Notifikasi::where('user_id', $user->id)
        ->whereNull('read_at')
        ->count();

    $fotoProfil = $user->profile_photo_path
        ? asset('storage/' . $user->profile_photo_path)
        : null;
@endphp

<nav class="navbar navbar-expand-lg student-navbar sticky-top">
    <div class="container">
        <a
            href="{{ route('siswa.dashboard') }}"
            class="navbar-brand d-flex align-items-center gap-2"
            aria-label="CurhatAman"
        >
            <span class="brand-symbol">
                <i class="bi bi-people-fill"></i>
            </span>

            <span class="brand-text">
                CurhatAman
            </span>
        </a>

        <button
            class="navbar-toggler border-0 shadow-none"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#studentNavbar"
            aria-controls="studentNavbar"
            aria-expanded="false"
            aria-label="Buka navigasi"
        >
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="studentNavbar">
            <ul class="navbar-nav mx-auto mb-3 mb-lg-0">
                <li class="nav-item">
                    <a href="{{ route('siswa.dashboard') }}" class="nav-link">
                        Dashboard
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('siswa.laporan.index') }}" class="nav-link">
                        Laporan Saya
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('siswa.skrining.riwayat') }}" class="nav-link">
                        Skrining
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('siswa.bantuan.index') }}" class="nav-link">
                        Rujukan & Bantuan
                    </a>
                </li>
            </ul>

            <div class="d-flex align-items-center ms-lg-3">
                <a
                    href="{{ route('siswa.notifikasi.index') }}"
                    class="notification-link"
                    aria-label="Buka notifikasi"
                    title="Notifikasi"
                >
                    <i class="bi bi-bell"></i>

                    @if ($jumlahNotifikasiBelum > 0)
                        <span class="notification-badge">
                            {{ $jumlahNotifikasiBelum > 99 ? '99+' : $jumlahNotifikasiBelum }}
                        </span>
                    @endif
                </a>

                <div class="dropdown account-dropdown">
                    <button
                        class="account-trigger dropdown-toggle"
                        type="button"
                        data-bs-toggle="dropdown"
                        aria-expanded="false"
                        aria-label="Buka menu akun siswa"
                    >
                        @if ($fotoProfil)
                            <img
                                src="{{ $fotoProfil }}"
                                alt="Foto profil {{ $namaUser }}"
                                class="student-avatar-image"
                            >
                        @else
                            <span class="student-avatar">
                                {{ $inisial }}
                            </span>
                        @endif

                        <span class="account-copy d-none d-sm-block">
                            <span class="user-name d-block">
                                {{ $namaUser }}
                            </span>

                            <span class="account-label d-block">
                                Akun siswa
                            </span>
                        </span>

                        <i class="bi bi-chevron-down account-chevron d-none d-sm-inline"></i>
                    </button>

                    <div class="dropdown-menu dropdown-menu-end account-menu">
                        <div class="account-menu-header">
                            <div class="account-menu-name">
                                {{ $namaUser }}
                            </div>

                            <div class="account-menu-email">
                                {{ str_ends_with($user->email, '@siswa.curhataman.local') ? 'Email belum dilengkapi' : $user->email }}
                            </div>
                        </div>

                        <a
                            href="{{ route('siswa.profil.index') }}"
                            class="dropdown-item"
                        >
                            <i class="bi bi-person"></i>
                            Profil Saya
                        </a>

                        <div class="dropdown-divider"></div>

                        <form method="POST" action="{{ route('logout') }}" class="m-0">
                            @csrf

                            <button
                                type="submit"
                                class="dropdown-item account-logout"
                            >
                                <i class="bi bi-box-arrow-right"></i>
                                Keluar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

<main class="profile-main">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('siswa.dashboard') }}">
                        Dashboard
                    </a>
                </li>

                <li class="breadcrumb-item active" aria-current="page">
                    Profil Siswa
                </li>
            </ol>
        </nav>

        <section class="mb-4">
            <div class="page-kicker">
                Akun Siswa
            </div>

            <h1 class="page-title">
                Profil Saya
            </h1>

            <p class="page-subtitle">
                Lihat informasi akun, ubah foto profil, dan kelola keamanan akun siswa.
            </p>
        </section>

        @if(session('photo_success'))
            <div class="success-alert">
                <i class="bi bi-check-circle-fill"></i>
                <span>{{ session('photo_success') }}</span>
            </div>
        @endif

        @if(session('password_success'))
            <div class="success-alert">
                <i class="bi bi-check-circle-fill"></i>
                <span>{{ session('password_success') }}</span>
            </div>
        @endif

        @if(session('whatsapp_success'))
            <div class="success-alert">
                <i class="bi bi-check-circle-fill"></i>
                <span>{{ session('whatsapp_success') }}</span>
            </div>
        @endif

        @php
            $emailBelumLengkap = empty($user->email) || str_ends_with(strtolower((string) $user->email), '@siswa.curhataman.local');
            $waBelumLengkap = empty($siswa->whatsapp_number);
        @endphp

        @if(session('profile_incomplete_warning') || $emailBelumLengkap || $waBelumLengkap)
            <div class="alert d-flex align-items-start gap-3 mb-4 p-3 border-0 shadow-sm" style="border-radius: 12px; background: #fff8eb; border-left: 4px solid #f79009 !important; color: #7a2e0e;">
                <i class="bi bi-exclamation-triangle-fill fs-5 mt-1" style="color: #f79009;"></i>
                <div>
                    <strong class="d-block mb-1" style="font-size: 13.5px;">Wajib Lengkapi Kontak Akun (Email & Nomor WhatsApp)</strong>
                    <span style="font-size: 12.5px; line-height: 1.55;">
                        {{ session('profile_incomplete_warning') ?? 'Agar kamu dapat menggunakan seluruh menu CurhatAman (Dashboard, Laporan, Skrining, & Lupa Kata Sandi), silakan isi Alamat Email Aktif dan Nomor WhatsApp pada bagian "Lengkapi Email & Kontak WhatsApp" di bawah ini.' }}
                    </span>
                </div>
            </div>
        @endif

        <div class="row g-3 align-items-start">
            <div class="col-lg-4">
                <aside class="profile-summary">
                    <div class="photo-area">
                        <form
                            method="POST"
                            action="{{ route('siswa.profil.photo.update') }}"
                            enctype="multipart/form-data"
                            class="photo-form"
                            id="photoForm"
                        >
                            @csrf
                            @method('PATCH')

                            <div class="profile-photo-wrap mx-auto">
                                @if ($fotoProfil)
                                    <img
                                        src="{{ $fotoProfil }}"
                                        alt="Foto profil {{ $namaUser }}"
                                        class="profile-photo-large"
                                        id="profilePhotoPreview"
                                    >
                                    <span
                                        class="profile-avatar-large d-none"
                                        id="profileInitialPreview"
                                    >
                                        {{ $inisial }}
                                    </span>
                                @else
                                    <img
                                        src=""
                                        alt="Preview foto profil"
                                        class="profile-photo-large d-none"
                                        id="profilePhotoPreview"
                                    >
                                    <span
                                        class="profile-avatar-large"
                                        id="profileInitialPreview"
                                    >
                                        {{ $inisial }}
                                    </span>
                                @endif

                                <label
                                    for="profile_photo"
                                    class="photo-edit-trigger"
                                    aria-label="Pilih foto profil"
                                    title="Ganti foto profil"
                                >
                                    <i class="bi bi-camera"></i>
                                </label>
                            </div>

                            <h2 class="profile-name">
                                {{ $namaUser }}
                            </h2>

                            <p class="profile-email">
                                {{ str_ends_with($user->email, '@siswa.curhataman.local') ? 'Email belum dilengkapi' : $user->email }}
                            </p>

                            <span class="student-badge">
                                <i class="bi bi-mortarboard"></i>
                                Siswa
                            </span>

                            <input
                                type="file"
                                id="profile_photo"
                                name="profile_photo"
                                class="d-none"
                                accept=".jpg,.jpeg,.png,image/jpeg,image/png"
                            >

                            <div class="photo-file-name" id="photoFileName"></div>

                            <p class="photo-help">
                                Format JPG, JPEG, atau PNG. Ukuran maksimal 2 MB.
                            </p>

                            @error('profile_photo')
                                <div class="photo-error">
                                    {{ $message }}
                                </div>
                            @enderror

                            <button
                                type="submit"
                                class="photo-save-button"
                                id="savePhotoButton"
                                disabled
                            >
                                <i class="bi bi-upload"></i>
                                Simpan Foto
                            </button>
                        </form>
                    </div>

                    <div class="summary-list">
                        <div class="summary-row">
                            <span class="summary-label">
                                Kelas
                            </span>

                            <span class="summary-value">
                                {{ $namaKelas }}
                            </span>
                        </div>

                        <div class="summary-row">
                            <span class="summary-label">
                                Tahun Masuk
                            </span>

                            <span class="summary-value">
                                {{ $tahunMasuk }}
                            </span>
                        </div>

                        <div class="summary-row">
                            <span class="summary-label">
                                Status Akun
                            </span>

                            <span class="summary-value">
                                @if($user->is_active)
                                    <span class="text-success">
                                        <i class="bi bi-check-circle me-1"></i>
                                        Aktif
                                    </span>
                                @else
                                    <span class="text-danger">
                                        <i class="bi bi-x-circle me-1"></i>
                                        Tidak aktif
                                    </span>
                                @endif
                            </span>
                        </div>
                    </div>
                </aside>
            </div>

            <div class="col-lg-8">
                <section class="profile-card">
                    <div class="mb-3">
                        <h2 class="section-title">
                            Data Siswa
                        </h2>

                        <p class="section-copy">
                            Data ini terhubung dengan akun siswa dan digunakan sesuai kebutuhan layanan sekolah.
                        </p>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="data-item">
                                <div class="d-flex align-items-start gap-3">
                                    <span class="data-icon">
                                        <i class="bi bi-person"></i>
                                    </span>

                                    <div>
                                        <div class="data-label">
                                            Nama Lengkap
                                        </div>

                                        <p class="data-value">
                                            {{ $namaUser }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="data-item">
                                <div class="d-flex align-items-start gap-3">
                                    <span class="data-icon">
                                        <i class="bi bi-envelope"></i>
                                    </span>

                                    <div>
                                        <div class="data-label">
                                            Email
                                        </div>

                                        <p class="data-value">
                                            {{ str_ends_with($user->email, '@siswa.curhataman.local') ? 'Belum dilengkapi' : $user->email }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="data-item">
                                <div class="d-flex align-items-start gap-3">
                                    <span class="data-icon">
                                        <i class="bi bi-building"></i>
                                    </span>

                                    <div>
                                        <div class="data-label">
                                            Kelas
                                        </div>

                                        <p class="data-value">
                                            {{ $namaKelas }}

                                            @if($tahunAjaran)
                                                <span class="text-secondary fw-normal">
                                                    · {{ $tahunAjaran }}
                                                </span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="data-item">
                                <div class="d-flex align-items-start gap-3">
                                    <span class="data-icon">
                                        <i class="bi bi-calendar3"></i>
                                    </span>

                                    <div>
                                        <div class="data-label">
                                            Tahun Masuk
                                        </div>

                                        <p class="data-value">
                                            {{ $tahunMasuk }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="data-item">
                                <div class="d-flex align-items-start gap-3">
                                    <span class="data-icon">
                                        <i class="bi bi-person-vcard"></i>
                                    </span>

                                    <div>
                                        <div class="data-label">
                                            NISN
                                        </div>

                                        <p class="data-value">
                                            {{ $nis }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="data-item">
                                <div class="d-flex align-items-start gap-3">
                                    <span class="data-icon">
                                        <i class="bi bi-clock-history"></i>
                                    </span>

                                    <div>
                                        <div class="data-label">
                                            Akun Dibuat
                                        </div>

                                        <p class="data-value">
                                            {{ optional($user->created_at)->format('d M Y') ?? '-' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="data-item">
                                <div class="d-flex align-items-start gap-3">
                                    <span class="data-icon">
                                        <i class="bi bi-whatsapp"></i>
                                    </span>

                                    <div>
                                        <div class="data-label">
                                            Nomor WhatsApp
                                        </div>

                                        <p class="data-value">
                                            {{ $nomorWhatsappDisplay ?: 'Belum tersedia' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="data-item">
                                <div class="d-flex align-items-start gap-3">
                                    <span class="data-icon">
                                        <i class="bi bi-bell"></i>
                                    </span>

                                    <div>
                                        <div class="data-label">
                                            Notifikasi WhatsApp
                                        </div>

                                        <p class="data-value">
                                            @if ($siswa->whatsapp_consent)
                                                Diizinkan
                                            @else
                                                Tidak diizinkan
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="privacy-card">
                        <span class="privacy-icon">
                            <i class="bi bi-shield-lock"></i>
                        </span>

                        <div>
                            <div class="privacy-title">
                                Akses data siswa
                            </div>

                            <p class="privacy-copy">
                                Data profil tidak ditampilkan kepada pengguna umum. Guru BK yang memiliki kewenangan dapat mengakses data identitas siswa untuk kebutuhan penanganan, pendampingan, dan layanan bantuan.
                            </p>
                        </div>
                    </div>
                </section>

                <section class="security-card contact-card">
                    <div class="security-heading">
                        <span class="security-heading-icon">
                            <i class="bi bi-telephone"></i>
                        </span>

                        <div>
                            <h2 class="section-title">
                                Kontak Siswa
                            </h2>

                            <p class="section-copy">
                                Perbarui alamat email aktif dan nomor WhatsApp untuk layanan pemberitahuan serta pemulihan akun.
                            </p>
                        </div>
                    </div>

                    <form
                        method="POST"
                        action="{{ route('siswa.profil.whatsapp.update') }}"
                        autocomplete="off"
                    >
                        @csrf
                        @method('PUT')

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="email" class="password-label">
                                    Alamat Email Aktif
                                </label>

                                <div class="contact-input-wrap">
                                    <i class="bi bi-envelope"></i>

                                    <input
                                        type="email"
                                        id="email"
                                        name="email"
                                        class="form-control password-input contact-input @error('email') is-invalid @enderror"
                                        value="{{ old('email', str_ends_with($user->email, '@siswa.curhataman.local') ? '' : $user->email) }}"
                                        placeholder="Contoh: nama@gmail.com"
                                        required
                                    >
                                </div>

                                @error('email')
                                    <div class="field-error">
                                        {{ $message }}
                                    </div>
                                @enderror

                                <div class="password-help">
                                    Digunakan untuk login alternatif dan pemulihan Lupa Kata Sandi.
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label
                                    for="whatsapp_number"
                                    class="password-label"
                                >
                                    Nomor WhatsApp Aktif
                                </label>

                                <div class="contact-input-wrap">
                                    <i class="bi bi-whatsapp"></i>

                                    <input
                                        type="tel"
                                        id="whatsapp_number"
                                        name="whatsapp_number"
                                        class="form-control password-input contact-input @error('whatsapp_number') is-invalid @enderror"
                                        value="{{ old('whatsapp_number', $nomorWhatsappDisplay) }}"
                                        placeholder="Contoh: 081234567890"
                                        inputmode="tel"
                                        autocomplete="tel"
                                        required
                                    >
                                </div>

                                @error('whatsapp_number')
                                    <div class="field-error">
                                        {{ $message }}
                                    </div>
                                @enderror

                                <div class="password-help">
                                    Nomor aktif untuk komunikasi tindak lanjut bersama Guru BK.
                                </div>
                            </div>
                        </div>

                        <div class="whatsapp-consent-box">
                            <div class="form-check">
                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    id="whatsapp_consent"
                                    name="whatsapp_consent"
                                    value="1"
                                    @checked(old('whatsapp_consent', $siswa->whatsapp_consent))
                                >

                                <label
                                    class="form-check-label"
                                    for="whatsapp_consent"
                                >
                                    Saya bersedia menerima pemberitahuan layanan CurhatAman melalui WhatsApp.
                                </label>
                            </div>

                            <p class="consent-note">
                                WhatsApp hanya digunakan untuk pemberitahuan atau ajakan komunikasi. Skor skrining, isi laporan, alasan rujukan, dan informasi sensitif tetap dilihat melalui CurhatAman.
                            </p>
                        </div>

                        <div class="security-actions">
                            <button
                                type="submit"
                                class="btn-save-password"
                            >
                                <i class="bi bi-check2-circle"></i>
                                Simpan Kontak
                            </button>
                        </div>
                    </form>
                </section>

                <section class="security-card">
                    <div class="security-heading">
                        <span class="security-heading-icon">
                            <i class="bi bi-key"></i>
                        </span>

                        <div>
                            <h2 class="section-title">
                                Keamanan Akun
                            </h2>

                            <p class="section-copy">
                                Ganti password akun secara mandiri dengan memasukkan password saat ini terlebih dahulu.
                            </p>
                        </div>
                    </div>

                    <form
                        method="POST"
                        action="{{ route('siswa.profil.password.update') }}"
                        autocomplete="off"
                    >
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label
                                for="current_password"
                                class="password-label"
                            >
                                Password Saat Ini
                            </label>

                            <div class="password-wrap">
                                <input
                                    type="password"
                                    id="current_password"
                                    name="current_password"
                                    class="form-control password-input @error('current_password') is-invalid @enderror"
                                    placeholder="Masukkan password saat ini"
                                    autocomplete="current-password"
                                    required
                                >

                                <button
                                    type="button"
                                    class="password-toggle"
                                    data-password-target="current_password"
                                    aria-label="Tampilkan password saat ini"
                                >
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>

                            @error('current_password')
                                <div class="field-error">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label
                                    for="password"
                                    class="password-label"
                                >
                                    Password Baru
                                </label>

                                <div class="password-wrap">
                                    <input
                                        type="password"
                                        id="password"
                                        name="password"
                                        class="form-control password-input @error('password') is-invalid @enderror"
                                        placeholder="Minimal 8 karakter"
                                        autocomplete="new-password"
                                        required
                                    >

                                    <button
                                        type="button"
                                        class="password-toggle"
                                        data-password-target="password"
                                        aria-label="Tampilkan password baru"
                                    >
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>

                                @error('password')
                                    <div class="field-error">
                                        {{ $message }}
                                    </div>
                                @enderror

                                <div class="password-help">
                                    Gunakan minimal 8 karakter dan pilih password yang berbeda dari password saat ini.
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label
                                    for="password_confirmation"
                                    class="password-label"
                                >
                                    Konfirmasi Password Baru
                                </label>

                                <div class="password-wrap">
                                    <input
                                        type="password"
                                        id="password_confirmation"
                                        name="password_confirmation"
                                        class="form-control password-input"
                                        placeholder="Ulangi password baru"
                                        autocomplete="new-password"
                                        required
                                    >

                                    <button
                                        type="button"
                                        class="password-toggle"
                                        data-password-target="password_confirmation"
                                        aria-label="Tampilkan konfirmasi password"
                                    >
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="security-actions">
                            <button
                                type="submit"
                                class="btn-save-password"
                            >
                                <i class="bi bi-shield-check"></i>
                                Ganti Password
                            </button>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</main>

<footer class="simple-footer">
    <div class="container">
        <span>
            © {{ date('Y') }} <strong>CurhatAman</strong>
        </span>

        <div class="footer-links">
            <a
                href="{{ route('siswa.bantuan.index') }}"
                class="footer-link"
            >
                Bantuan
            </a>

            <span class="footer-separator">
                •
            </span>

            <span>
                Privasi data dijaga sesuai hak akses.
            </span>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    const photoInput = document.getElementById('profile_photo');
    const photoPreview = document.getElementById('profilePhotoPreview');
    const initialPreview = document.getElementById('profileInitialPreview');
    const photoFileName = document.getElementById('photoFileName');
    const savePhotoButton = document.getElementById('savePhotoButton');

    photoInput.addEventListener('change', function () {
        const file = photoInput.files[0];

        if (!file) {
            photoFileName.textContent = '';
            savePhotoButton.disabled = true;
            return;
        }

        photoFileName.textContent = file.name;
        savePhotoButton.disabled = false;

        const reader = new FileReader();

        reader.addEventListener('load', function (event) {
            photoPreview.src = event.target.result;
            photoPreview.classList.remove('d-none');
            initialPreview.classList.add('d-none');
        });

        reader.readAsDataURL(file);
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
