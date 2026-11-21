<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rujukan & Bantuan - CurhatAman</title>

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

        .student-navbar .nav-link.active {
            color: var(--ca-primary-dark);
            font-weight: 680;
        }

        .student-navbar .nav-link.active::after {
            content: "";
            position: absolute;
            left: .9rem;
            right: .9rem;
            bottom: 10px;
            height: 2px;
            border-radius: 999px;
            background: var(--ca-primary);
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
            border: 1px solid transparent;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            gap: 9px;
            color: var(--ca-text);
            background: transparent;
            text-align: left;
        }

        .account-trigger:hover,
        .account-trigger:focus,
        .account-trigger[aria-expanded="true"] {
            background: #f7fbfa;
            border-color: var(--ca-border);
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

        .help-page-main {
            flex: 1;
            padding: 34px 0 38px;
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
            max-width: 720px;
            margin: 8px 0 0;
            color: var(--ca-muted);
            font-size: .9rem;
            line-height: 1.55;
        }

        .page-header-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .btn-ca-primary,
        .btn-ca-outline {
            min-height: 42px;
            padding: 0 15px;
            border-radius: 9px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            font-size: .82rem;
            font-weight: 650;
        }

        .btn-ca-primary {
            color: #ffffff;
            background: var(--ca-primary);
            border: 1px solid var(--ca-primary);
        }

        .btn-ca-primary:hover,
        .btn-ca-primary:focus {
            color: #ffffff;
            background: var(--ca-primary-dark);
            border-color: var(--ca-primary-dark);
        }

        .btn-ca-outline {
            color: #475467;
            background: #ffffff;
            border: 1px solid #a7b5b4;
        }

        .btn-ca-outline:hover,
        .btn-ca-outline:focus {
            color: var(--ca-primary-dark);
            background: #f8fbfa;
            border-color: #8ec9c4;
        }

        .history-card,
        .info-card,
        .help-section,
        .request-box,
        .note-card {
            border: 1px solid var(--ca-border);
            border-radius: var(--ca-radius);
            background: #ffffff;
        }

        .history-card {
            overflow: hidden;
        }

        .history-header {
            padding: 18px 20px;
            border-bottom: 1px solid var(--ca-line);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
        }

        .section-title {
            margin: 0;
            font-size: 1rem;
            font-weight: 690;
        }

        .section-subtitle {
            margin: 5px 0 0;
            color: var(--ca-muted);
            font-size: .79rem;
        }

        .empty-state {
            min-height: 250px;
            padding: 30px 22px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            background: #fbfcfc;
        }

        .empty-icon,
        .info-icon,
        .contact-icon,
        .request-icon,
        .note-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            color: var(--ca-primary);
            background: var(--ca-primary-soft);
        }

        .empty-icon {
            width: 42px;
            height: 42px;
            margin-bottom: 12px;
            border-radius: 9px;
            font-size: 1rem;
        }

        .empty-title {
            margin-bottom: 5px;
            font-size: .9rem;
            font-weight: 670;
        }

        .empty-copy {
            max-width: 420px;
            margin: 0 0 14px;
            color: var(--ca-muted);
            font-size: .78rem;
            line-height: 1.5;
        }

        .history-table {
            margin: 0;
            font-size: .78rem;
        }

        .history-table thead th {
            padding: 12px 16px;
            border-bottom: 1px solid var(--ca-line);
            color: var(--ca-muted-light);
            background: #fbfcfc;
            font-size: .66rem;
            font-weight: 720;
            letter-spacing: .045em;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .history-table tbody td {
            padding: 14px 16px;
            border-bottom: 1px solid var(--ca-line);
            color: #475467;
            vertical-align: middle;
        }

        .history-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .history-table .history-type {
            color: var(--ca-text);
            font-weight: 620;
        }

        .history-message {
            max-width: 360px;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 5px 8px;
            border-radius: 999px;
            font-size: .66rem;
            font-weight: 700;
            white-space: nowrap;
        }

        .status-baru {
            color: #0b6073;
            background: #e4f6f8;
        }

        .status-diproses {
            color: #8d5700;
            background: #fff2df;
        }

        .status-selesai {
            color: #0d664b;
            background: #e3f5ed;
        }

        .status-default {
            color: #475467;
            background: #eef2f4;
        }

        .info-card {
            height: 100%;
            padding: 18px;
        }

        .info-icon {
            width: 38px;
            height: 38px;
            margin-bottom: 13px;
            border-radius: 9px;
            font-size: .95rem;
        }

        .info-card h3 {
            margin: 0 0 5px;
            font-size: .88rem;
            font-weight: 670;
        }

        .info-card p {
            margin: 0;
            color: var(--ca-muted);
            font-size: .76rem;
            line-height: 1.5;
        }

        .help-section {
            padding: 20px;
        }

        .contact-item {
            padding: 14px 0;
            border-bottom: 1px solid var(--ca-line);
        }

        .contact-item:last-child {
            border-bottom: 0;
            padding-bottom: 0;
        }

        .contact-icon {
            width: 36px;
            height: 36px;
            border-radius: 9px;
            font-size: .88rem;
        }

        .contact-item h3 {
            margin: 0 0 3px;
            font-size: .82rem;
            font-weight: 650;
        }

        .contact-item p {
            margin: 0;
            color: var(--ca-muted);
            font-size: .74rem;
            line-height: 1.5;
        }

        .request-box {
            padding: 20px;
            border-color: #cfe3e0;
            background: #f3faf9;
        }

        .request-icon {
            width: 38px;
            height: 38px;
            margin-bottom: 13px;
            border-radius: 9px;
            font-size: .95rem;
            background: #ffffff;
        }

        .request-box h3 {
            margin: 0 0 7px;
            font-size: 1rem;
            font-weight: 690;
        }

        .request-box > p {
            margin: 0 0 14px;
            color: var(--ca-muted);
            font-size: .77rem;
            line-height: 1.55;
        }

        .request-note {
            display: flex;
            align-items: flex-start;
            gap: 8px;
            padding: 11px 12px;
            border: 1px solid #d8e8e6;
            border-radius: 9px;
            color: var(--ca-muted);
            background: #ffffff;
            font-size: .71rem;
            line-height: 1.5;
        }

        .request-note i {
            margin-top: 1px;
            color: var(--ca-primary);
        }

        .note-card {
            padding: 18px;
        }

        .note-card-inner {
            display: flex;
            gap: 10px;
            align-items: flex-start;
        }

        .note-icon {
            width: 34px;
            height: 34px;
            border-radius: 9px;
            font-size: .88rem;
        }

        .note-card h3 {
            margin: 0 0 4px;
            font-size: .82rem;
            font-weight: 650;
        }

        .note-card p {
            margin: 0;
            color: var(--ca-muted);
            font-size: .72rem;
            line-height: 1.5;
        }

        .accordion {
            --bs-accordion-border-color: var(--ca-line);
        }

        .accordion-button {
            padding: 14px 0;
            color: var(--ca-text);
            background: transparent;
            font-size: .79rem;
            font-weight: 620;
        }

        .accordion-button:not(.collapsed) {
            color: var(--ca-primary-dark);
            background: transparent;
            box-shadow: none;
        }

        .accordion-button:focus {
            box-shadow: none;
        }

        .accordion-body {
            padding-top: 0;
            color: var(--ca-muted);
            font-size: .74rem;
            line-height: 1.55;
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

            .student-navbar .nav-link.active::after {
                display: none;
            }

            .navbar-brand {
                margin-right: 0;
            }

            .help-page-main {
                padding-top: 28px;
            }
        }

        @media (max-width: 767.98px) {
            .history-header {
                align-items: stretch;
                flex-direction: column;
            }

            .history-header-action,
            .history-header-action .btn-ca-outline {
                width: 100%;
            }

            .page-header-actions {
                width: 100%;
            }

            .page-header-actions .btn-ca-primary,
            .page-header-actions .btn-ca-outline {
                flex: 1;
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

            .help-section,
            .request-box,
            .note-card {
                padding: 18px;
            }

            .simple-footer .container {
                padding-top: 16px;
                padding-bottom: 16px;
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
</head>

<body>
@php
    $user = auth()->user();
    $namaUser = ucwords($user->name);
    $inisial = strtoupper(substr($user->name, 0, 1));

    $fotoProfil = $user->profile_photo_path
        ? asset('storage/' . $user->profile_photo_path)
        : null;

    $jumlahNotifikasiBelum = \App\Models\Notifikasi::where('user_id', $user->id)
        ->whereNull('read_at')
        ->count();
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
                    <a href="{{ route('siswa.bantuan.index') }}" class="nav-link active">
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
                                {{ $user->email }}
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

<main class="help-page-main">
    <div class="container">
        @if(session('success'))
            <div
                class="alert alert-success border-0 shadow-sm mt-4 mb-0"
                role="alert"
            >
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-check-circle-fill"></i>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div
                class="alert alert-warning border-0 shadow-sm d-flex align-items-start gap-2 mt-4 mb-0"
                style="background: #fff8eb; border-left: 4px solid #f79009 !important; color: #7a2e0e; border-radius: 10px;"
                role="alert"
            >
                <i class="bi bi-exclamation-triangle-fill mt-1" style="color: #f79009;"></i>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        <section class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-4 mb-4 mt-4">
            <div>
                <div class="page-kicker">
                    Dukungan Siswa
                </div>

                <h1 class="page-title">
                    Rujukan & Bantuan
                </h1>

                <p class="page-subtitle">
                    Temukan informasi bantuan, pantau permintaan pendampingan, dan lihat rujukan yang diberikan kepada kamu.
                </p>
            </div>

            <div class="page-header-actions">
                <a
                    href="{{ route('siswa.rujukan') }}"
                    class="btn-ca-outline"
                >
                    <i class="bi bi-life-preserver"></i>
                    Lihat Rujukan Saya
                </a>

                <a
                    href="{{ route('siswa.bantuan.create') }}"
                    class="btn-ca-primary"
                >
                    <i class="bi bi-chat-heart"></i>
                    Ajukan Bantuan
                </a>
            </div>
        </section>

        <section class="history-card mb-3">
            <div class="history-header">
                <div>
                    <h2 class="section-title">
                        Riwayat Permintaan Bantuan
                    </h2>

                    <p class="section-subtitle">
                        Pantau status permintaan bantuan yang pernah kamu kirim.
                    </p>
                </div>

                @if($permintaanBantuan->isNotEmpty())
                    <div class="history-header-action">
                        <a
                            href="{{ route('siswa.bantuan.create') }}"
                            class="btn-ca-outline"
                        >
                            <i class="bi bi-plus-lg"></i>
                            Ajukan Bantuan
                        </a>
                    </div>
                @endif
            </div>

            @if($permintaanBantuan->isEmpty())
                <div class="empty-state">
                    <span class="empty-icon">
                        <i class="bi bi-chat-square-text"></i>
                    </span>

                    <div class="empty-title">
                        Belum Ada Permintaan Bantuan
                    </div>

                    <p class="empty-copy">
                        Permintaan bantuan yang kamu kirim akan muncul di sini.
                    </p>

                    <a
                        href="{{ route('siswa.bantuan.create') }}"
                        class="btn-ca-primary"
                    >
                        <i class="bi bi-chat-heart"></i>
                        Ajukan Bantuan
                    </a>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table history-table align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Jenis Bantuan</th>
                                <th>Pesan</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($permintaanBantuan as $item)
                                <tr>
                                    <td class="history-type">
                                        @switch($item->jenis_bantuan)
                                            @case('pendampingan')
                                                Pendampingan Guru BK
                                                @break
                                            @case('perundungan')
                                                Masalah Perundungan
                                                @break
                                            @case('pribadi')
                                                Masalah Pribadi / Emosional
                                                @break
                                            @case('akademik')
                                                Masalah Akademik
                                                @break
                                            @default
                                                Lainnya
                                        @endswitch
                                    </td>

                                    <td class="history-message">
                                        {{ Str::limit($item->pesan, 80) }}
                                    </td>

                                    <td>
                                        {{ $item->submitted_at
                                            ? $item->submitted_at->format('d M Y')
                                            : '-' }}
                                    </td>

                                    <td>
                                        @if($item->status === 'baru')
                                            <span class="status-badge status-baru">
                                                Baru
                                            </span>
                                        @elseif($item->status === 'diproses')
                                            <span class="status-badge status-diproses">
                                                Diproses
                                            </span>
                                        @elseif($item->status === 'selesai')
                                            <span class="status-badge status-selesai">
                                                Selesai
                                            </span>
                                        @else
                                            <span class="status-badge status-default">
                                                {{ ucfirst($item->status) }}
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </section>

        <section class="row g-3 mb-3">
            <div class="col-md-4">
                <div class="info-card">
                    <span class="info-icon">
                        <i class="bi bi-person-heart"></i>
                    </span>

                    <h3>
                        Guru BK
                    </h3>

                    <p>
                        Minta pendampingan Guru BK apabila membutuhkan ruang untuk bercerita atau bantuan terkait masalah yang sedang dialami.
                    </p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="info-card">
                    <span class="info-icon">
                        <i class="bi bi-telephone"></i>
                    </span>

                    <h3>
                        Layanan Bantuan
                    </h3>

                    <p>
                        Informasi layanan pendukung dapat digunakan apabila membutuhkan bantuan lanjutan di luar lingkungan sekolah.
                    </p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="info-card">
                    <span class="info-icon">
                        <i class="bi bi-shield-lock"></i>
                    </span>

                    <h3>
                        Privasi
                    </h3>

                    <p>
                        Informasi yang disampaikan hanya dapat diakses oleh pihak yang memiliki kewenangan sesuai kebutuhan penanganan.
                    </p>
                </div>
            </div>
        </section>

        <section class="row g-3">
            <div class="col-lg-7">
                <div class="help-section mb-3">
                    <h2 class="section-title">
                        Informasi Bantuan
                    </h2>

                    <p class="section-subtitle mb-2">
                        Beberapa pilihan bantuan yang tersedia untuk siswa.
                    </p>

                    <div class="contact-item">
                        <div class="d-flex gap-3 align-items-start">
                            <span class="contact-icon">
                                <i class="bi bi-person-badge"></i>
                            </span>

                            <div>
                                <h3>
                                    Guru BK Sekolah
                                </h3>

                                <p>
                                    Hubungi Guru BK apabila membutuhkan pendampingan atau ingin membicarakan masalah secara langsung.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="contact-item">
                        <div class="d-flex gap-3 align-items-start">
                            <span class="contact-icon">
                                <i class="bi bi-hospital"></i>
                            </span>

                            <div>
                                <h3>
                                    Layanan Profesional
                                </h3>

                                <p>
                                    Apabila dibutuhkan, Guru BK dapat membantu proses rujukan ke layanan profesional yang sesuai.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="contact-item">
                        <div class="d-flex gap-3 align-items-start">
                            <span class="contact-icon">
                                <i class="bi bi-exclamation-circle"></i>
                            </span>

                            <div>
                                <h3>
                                    Kondisi Mendesak
                                </h3>

                                <p>
                                    Jika merasa berada dalam keadaan berbahaya, segera hubungi orang dewasa yang dipercaya atau pihak sekolah.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="help-section">
                    <h2 class="section-title mb-2">
                        Pertanyaan Umum
                    </h2>

                    <div class="accordion accordion-flush" id="faqBantuan">
                        <div class="accordion-item">
                            <h3 class="accordion-header">
                                <button
                                    class="accordion-button collapsed"
                                    type="button"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#faq1"
                                >
                                    Apakah Guru BK dapat melihat identitas saya?
                                </button>
                            </h3>

                            <div
                                id="faq1"
                                class="accordion-collapse collapse"
                                data-bs-parent="#faqBantuan"
                            >
                                <div class="accordion-body px-0">
                                    Guru BK yang memiliki kewenangan menangani laporan dapat melihat identitas pelapor untuk kebutuhan penanganan kasus. Informasi tersebut tidak ditampilkan kepada pengguna yang tidak memiliki kewenangan.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h3 class="accordion-header">
                                <button
                                    class="accordion-button collapsed"
                                    type="button"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#faq2"
                                >
                                    Apakah saya harus membuat laporan untuk meminta bantuan?
                                </button>
                            </h3>

                            <div
                                id="faq2"
                                class="accordion-collapse collapse"
                                data-bs-parent="#faqBantuan"
                            >
                                <div class="accordion-body px-0">
                                    Tidak. Permintaan bantuan dapat digunakan secara terpisah apabila kamu ingin meminta pendampingan Guru BK tanpa membuat laporan kasus.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h3 class="accordion-header">
                                <button
                                    class="accordion-button collapsed"
                                    type="button"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#faq3"
                                >
                                    Apakah CurhatAman menyediakan konsultasi dengan psikolog?
                                </button>
                            </h3>

                            <div
                                id="faq3"
                                class="accordion-collapse collapse"
                                data-bs-parent="#faqBantuan"
                            >
                                <div class="accordion-body px-0">
                                    CurhatAman tidak menyediakan layanan chat atau konsultasi psikolog secara langsung di dalam aplikasi. Jika diperlukan, Guru BK dapat membantu memberikan informasi atau rujukan ke layanan yang sesuai.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="request-box">
                    <span class="request-icon">
                        <i class="bi bi-chat-square-heart"></i>
                    </span>

                    <h3>
                        Butuh bantuan Guru BK?
                    </h3>

                    <p>
                        Guru BK dapat membantu ketika kamu ingin menceritakan masalah, meminta pendampingan, atau membutuhkan arahan lebih lanjut.
                    </p>

                    <div class="request-note">
                        <i class="bi bi-shield-check"></i>

                        <span>
                            Permintaan bantuan yang kamu kirim akan diteruskan kepada Guru BK untuk ditindaklanjuti sesuai kebutuhan.
                        </span>
                    </div>
                </div>

                <div class="note-card mt-3">
                    <div class="note-card-inner">
                        <span class="note-icon">
                            <i class="bi bi-info-circle"></i>
                        </span>

                        <div>
                            <h3>
                                Catatan
                            </h3>

                            <p>
                                Fitur bantuan tidak menggantikan layanan profesional. Pendampingan lanjutan dapat diberikan sesuai kebutuhan siswa.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
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
</body>
</html>
