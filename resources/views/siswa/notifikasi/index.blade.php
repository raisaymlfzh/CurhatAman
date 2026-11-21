<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifikasi - CurhatAman</title>

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
            border: 1px solid #cfe3e0;
            border-radius: 9px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: var(--ca-primary-dark);
            background: var(--ca-primary-soft);
            font-size: .98rem;
        }

        .notification-link:hover,
        .notification-link:focus {
            color: var(--ca-primary-dark);
            background: #def1ee;
            border-color: #b7d8d4;
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

        .page-main {
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

        .read-all-button {
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
            font-size: .82rem;
            font-weight: 650;
        }

        .read-all-button:hover,
        .read-all-button:focus {
            color: #ffffff;
            background: var(--ca-primary-dark);
            border-color: var(--ca-primary-dark);
        }

        .summary-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 12px;
            margin: 22px 0;
        }

        .summary-card {
            padding: 16px;
            border: 1px solid var(--ca-border);
            border-radius: var(--ca-radius);
            background: var(--ca-surface);
        }

        .summary-icon {
            width: 34px;
            height: 34px;
            margin-bottom: 12px;
            border-radius: 9px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: var(--ca-primary);
            background: var(--ca-primary-soft);
            font-size: .86rem;
        }

        .summary-label {
            color: var(--ca-muted);
            font-size: .72rem;
            font-weight: 620;
        }

        .summary-value {
            margin-top: 4px;
            color: var(--ca-text);
            font-size: 1.35rem;
            font-weight: 720;
        }

        .toolbar {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 12px;
        }

        .filter-group {
            display: flex;
            flex-wrap: wrap;
            gap: 7px;
        }

        .filter-link {
            min-height: 38px;
            padding: 0 12px;
            border: 1px solid var(--ca-border);
            border-radius: 9px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #667085;
            background: #ffffff;
            font-size: .76rem;
            font-weight: 620;
        }

        .filter-link:hover,
        .filter-link.active {
            color: var(--ca-primary-dark);
            background: var(--ca-primary-soft);
            border-color: #b7d9d5;
        }

        .notification-panel {
            overflow: hidden;
            border: 1px solid var(--ca-border);
            border-radius: var(--ca-radius);
            background: var(--ca-surface);
        }

        .notification-item {
            position: relative;
            padding: 16px 18px;
            border-bottom: 1px solid var(--ca-line);
            display: flex;
            align-items: flex-start;
            gap: 12px;
        }

        .notification-item:last-child {
            border-bottom: 0;
        }

        .notification-item.unread {
            background: #f8fcfb;
            cursor: pointer;
            transition: background .15s ease;
        }

        .notification-item.unread:hover {
            background: #f0f7f6;
        }

        .notification-item.unread::before {
            content: "";
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 3px;
            background: var(--ca-primary);
        }

        .notification-icon {
            width: 38px;
            height: 38px;
            flex: 0 0 38px;
            border-radius: 9px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: var(--ca-primary-dark);
            background: var(--ca-primary-soft);
            font-size: .9rem;
        }

        .notification-content {
            min-width: 0;
            flex: 1;
        }

        .notification-title {
            margin: 0;
            color: var(--ca-text);
            font-size: .84rem;
            font-weight: 670;
        }

        .notification-message {
            margin: 4px 0 0;
            color: var(--ca-muted);
            font-size: .76rem;
            line-height: 1.5;
        }

        .notification-time {
            margin-top: 6px;
            color: var(--ca-muted-light);
            font-size: .68rem;
        }

        .mark-read-button {
            flex-shrink: 0;
            padding: 5px 7px;
            border: 0;
            border-radius: 7px;
            color: var(--ca-primary-dark);
            background: transparent;
            font-size: .71rem;
            font-weight: 630;
        }

        .mark-read-button:hover {
            background: var(--ca-primary-soft);
        }

        .notification-actions {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-shrink: 0;
            flex-wrap: wrap;
        }

        .open-link-button {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 5px 12px;
            border-radius: 7px;
            color: #ffffff;
            background: var(--ca-primary);
            border: 1px solid var(--ca-primary);
            font-size: .72rem;
            font-weight: 630;
            text-decoration: none;
            transition: all .15s ease;
            white-space: nowrap;
        }

        .open-link-button:hover {
            color: #ffffff;
            background: var(--ca-primary-dark);
            transform: translateY(-1px);
        }

        .read-badge-siswa {
            color: var(--ca-muted-light);
            font-size: .72rem;
            padding: 4px 6px;
        }

        .empty-state {
            min-height: 270px;
            padding: 32px 22px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            background: #fbfcfc;
        }

        .empty-icon {
            width: 42px;
            height: 42px;
            margin-bottom: 12px;
            border-radius: 9px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: var(--ca-primary);
            background: var(--ca-primary-soft);
            font-size: 1rem;
        }

        .empty-title {
            margin-bottom: 5px;
            color: var(--ca-text);
            font-size: .9rem;
            font-weight: 670;
        }

        .empty-copy {
            max-width: 430px;
            margin: 0;
            color: var(--ca-muted);
            font-size: .78rem;
            line-height: 1.5;
        }

        .pagination {
            margin: 0;
            gap: 4px;
        }

        .page-link {
            min-width: 34px;
            height: 34px;
            border-radius: 8px !important;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: var(--ca-primary-dark);
            border-color: var(--ca-border);
            font-size: .76rem;
        }

        .page-link:hover {
            color: var(--ca-primary-dark);
            background: var(--ca-primary-soft);
            border-color: #b7d9d5;
        }

        .page-item.active .page-link {
            color: #ffffff;
            border-color: var(--ca-primary);
            background: var(--ca-primary);
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

            .page-main {
                padding-top: 28px;
            }
        }

        @media (max-width: 767.98px) {
            .summary-grid {
                grid-template-columns: 1fr;
            }

            .page-header {
                align-items: stretch !important;
            }

            .read-all-button {
                width: 100%;
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

            .notification-item {
                padding: 15px;
            }

            .notification-item {
                flex-wrap: wrap;
            }

            .notification-content {
                width: calc(100% - 50px);
            }

            .notification-item form {
                width: 100%;
                padding-left: 50px;
            }

            .mark-read-button {
                padding-left: 0;
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
    $namaUser = ucwords($user->name);
    $inisial = strtoupper(substr($user->name, 0, 1));

    $fotoProfil = $user->profile_photo_path
        ? asset('storage/' . $user->profile_photo_path)
        : null;

    $jumlahNotifikasiBelum = $summary['belum'];
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
                    <i class="bi bi-bell-fill"></i>

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

                        <form
                            method="POST"
                            action="{{ route('logout') }}"
                            class="m-0"
                        >
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

<main class="page-main">
    <div class="container">
        @if (session('success'))
            <div
                class="alert alert-success border-0 shadow-sm d-flex align-items-center gap-2 mb-4"
                role="alert"
            >
                <i class="bi bi-check-circle-fill"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <section class="page-header d-flex flex-column flex-lg-row justify-content-between align-items-lg-end gap-3 mb-4">
            <div>
                <div class="page-kicker">
                    Akun Siswa
                </div>

                <h1 class="page-title">
                    Notifikasi
                </h1>

                <p class="page-subtitle">
                    Lihat pembaruan penting terkait layanan dan laporan CurhatAman.
                </p>
            </div>

            @if ($summary['belum'] > 0)
                <form
                    method="POST"
                    action="{{ route('siswa.notifikasi.read-all') }}"
                >
                    @csrf
                    @method('PATCH')

                    <button
                        type="submit"
                        class="read-all-button"
                    >
                        <i class="bi bi-check2-all"></i>
                        Tandai Semua Dibaca
                    </button>
                </form>
            @endif
        </section>

        <section class="summary-grid">
            <div class="summary-card">
                <span class="summary-icon">
                    <i class="bi bi-bell"></i>
                </span>

                <div class="summary-label">
                    Semua
                </div>

                <div class="summary-value">
                    {{ $summary['total'] }}
                </div>
            </div>

            <div class="summary-card">
                <span class="summary-icon">
                    <i class="bi bi-envelope"></i>
                </span>

                <div class="summary-label">
                    Belum Dibaca
                </div>

                <div class="summary-value">
                    {{ $summary['belum'] }}
                </div>
            </div>

            <div class="summary-card">
                <span class="summary-icon">
                    <i class="bi bi-envelope-open"></i>
                </span>

                <div class="summary-label">
                    Dibaca
                </div>

                <div class="summary-value">
                    {{ $summary['dibaca'] }}
                </div>
            </div>
        </section>

        <div class="toolbar">
            <div class="filter-group">
                <a
                    href="{{ route('siswa.notifikasi.index', ['filter' => 'semua']) }}"
                    class="filter-link {{ $filter === 'semua' ? 'active' : '' }}"
                >
                    Semua
                </a>

                <a
                    href="{{ route('siswa.notifikasi.index', ['filter' => 'belum']) }}"
                    class="filter-link {{ $filter === 'belum' ? 'active' : '' }}"
                >
                    Belum Dibaca
                </a>

                <a
                    href="{{ route('siswa.notifikasi.index', ['filter' => 'dibaca']) }}"
                    class="filter-link {{ $filter === 'dibaca' ? 'active' : '' }}"
                >
                    Dibaca
                </a>
            </div>
        </div>

        <section class="notification-panel">
            @forelse ($notifikasi as $item)
                <article class="notification-item {{ is_null($item->read_at) ? 'unread' : '' }}" data-read-url="{{ route('siswa.notifikasi.read', $item) }}">
                    <span class="notification-icon">
                        @if ($item->tipe === 'laporan_selesai')
                            <i class="bi bi-check2-circle"></i>
                        @elseif ($item->tipe === 'laporan_ditangani')
                            <i class="bi bi-person-check"></i>
                        @elseif ($item->tipe === 'tindak_lanjut_laporan')
                            <i class="bi bi-chat-square-text"></i>
                        @else
                            <i class="bi bi-bell"></i>
                        @endif
                    </span>

                    <div class="notification-content">
                        <h2 class="notification-title">
                            {{ $item->judul }}
                        </h2>

                        <p class="notification-message">
                            {{ $item->pesan }}
                        </p>

                        <div class="notification-time">
                            {{ $item->created_at->locale('id')->translatedFormat('d F Y, H:i') }} WIB
                        </div>
                    </div>

                    <div class="notification-actions">
                        @php
                            $targetUrl = null;
                            $targetLabel = null;
                            if ($item->referensi_tipe === 'laporan_kasus' && $item->referensi_id) {
                                $targetUrl = route('siswa.laporan.show', $item->referensi_id);
                                $targetLabel = 'Buka Laporan';
                            } elseif ($item->referensi_tipe === 'permintaan_bantuan') {
                                $targetUrl = route('siswa.bantuan.index');
                                $targetLabel = 'Buka Bantuan';
                            } elseif ($item->referensi_tipe === 'skrining') {
                                $targetUrl = route('siswa.skrining.riwayat');
                                $targetLabel = 'Buka Skrining';
                            }
                        @endphp

                        @if ($targetUrl)
                            <a href="{{ $targetUrl }}" class="open-link-button">
                                <i class="bi bi-box-arrow-up-right"></i>
                                {{ $targetLabel }}
                            </a>
                        @endif

                        @if (is_null($item->read_at))
                            <form
                                method="POST"
                                action="{{ route('siswa.notifikasi.read', $item) }}"
                                class="m-0"
                            >
                                @csrf
                                @method('PATCH')

                                <button
                                    type="submit"
                                    class="mark-read-button"
                                >
                                    Tandai dibaca
                                </button>
                            </form>
                        @else
                            <span class="read-badge-siswa">
                                <i class="bi bi-check2"></i> Dibaca
                            </span>
                        @endif
                    </div>
                </article>
            @empty
                <div class="empty-state">
                    <span class="empty-icon">
                        <i class="bi bi-bell-slash"></i>
                    </span>

                    <div class="empty-title">
                        Belum ada notifikasi
                    </div>

                    <p class="empty-copy">
                        Pembaruan penting dari CurhatAman akan tampil di halaman ini.
                    </p>
                </div>
            @endforelse
        </section>

        @if ($notifikasi->hasPages())
            <div class="d-flex justify-content-center mt-4">
                {{ $notifikasi->links() }}
            </div>
        @endif
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
    document.addEventListener('DOMContentLoaded', function () {
        const csrfToken = @json(csrf_token());

        function updateBellBadge(unreadCount) {
            const badgeSpan = document.querySelector('.notification-badge');
            const linkElem = document.querySelector('.notification-link');

            if (unreadCount <= 0) {
                if (badgeSpan) {
                    badgeSpan.remove();
                }
            } else {
                const badgeText = unreadCount > 99 ? '99+' : String(unreadCount);
                if (badgeSpan) {
                    badgeSpan.textContent = badgeText;
                } else if (linkElem) {
                    const newBadge = document.createElement('span');
                    newBadge.className = 'notification-badge';
                    newBadge.textContent = badgeText;
                    linkElem.appendChild(newBadge);
                }
            }
        }

        function updateSummaryCards(unreadCount, readCount) {
            const summaryCards = document.querySelectorAll('.summary-card');
            summaryCards.forEach(card => {
                const label = card.querySelector('.summary-label');
                const value = card.querySelector('.summary-value');
                if (label && value) {
                    const text = label.textContent.trim().toLowerCase();
                    if (text === 'belum dibaca' && typeof unreadCount === 'number') {
                        value.textContent = unreadCount;
                    } else if (text === 'dibaca' && typeof readCount === 'number') {
                        value.textContent = readCount;
                    }
                }
            });

            if (typeof unreadCount === 'number' && unreadCount <= 0) {
                const readAllForm = document.querySelector('form[action="{{ route('siswa.notifikasi.read-all') }}"]');
                if (readAllForm) {
                    readAllForm.remove();
                }
            }
        }

        function markItemAsReadVisually(article, data) {
            if (!article) return;
            article.classList.remove('unread');

            const actionsDiv = article.querySelector('.notification-actions');
            if (actionsDiv) {
                const markReadForm = actionsDiv.querySelector('form');
                if (markReadForm) {
                    markReadForm.remove();
                }
                if (!actionsDiv.querySelector('.read-badge-siswa')) {
                    const readSpan = document.createElement('span');
                    readSpan.className = 'read-badge-siswa';
                    readSpan.innerHTML = '<i class="bi bi-check2"></i> Dibaca';
                    actionsDiv.appendChild(readSpan);
                }
            }

            if (data && typeof data.unread_count === 'number') {
                updateBellBadge(data.unread_count);
                updateSummaryCards(data.unread_count, data.read_count);
            }
        }

        async function markNotificationAsRead(readUrl) {
            try {
                const response = await fetch(readUrl, {
                    method: 'PATCH',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    credentials: 'same-origin'
                });
                if (response.ok) {
                    return await response.json();
                }
            } catch (e) {
                console.error('Gagal menandai notifikasi sebagai dibaca:', e);
            }
            return null;
        }

        document.addEventListener('click', async function (e) {
            const markReadBtn = e.target.closest('.mark-read-button');
            if (markReadBtn) {
                e.preventDefault();
                e.stopPropagation();
                const form = markReadBtn.closest('form');
                const article = markReadBtn.closest('.notification-item');
                const readUrl = form ? form.action : (article ? article.dataset.readUrl : null);

                if (readUrl) {
                    markReadBtn.disabled = true;
                    const result = await markNotificationAsRead(readUrl);
                    markItemAsReadVisually(article, result);
                }
                return;
            }

            const actionLink = e.target.closest('.open-link-button');
            const article = e.target.closest('.notification-item');

            if (actionLink) {
                const targetUrl = actionLink.href;
                if (article && article.classList.contains('unread')) {
                    e.preventDefault();
                    actionLink.style.pointerEvents = 'none';
                    const form = article.querySelector('form');
                    const readUrl = form ? form.action : article.dataset.readUrl;

                    if (readUrl) {
                        const result = await markNotificationAsRead(readUrl);
                        markItemAsReadVisually(article, result);
                    }
                    window.location.href = targetUrl;
                }
                return;
            }

            if (article && article.classList.contains('unread') && !e.target.closest('button') && !e.target.closest('a')) {
                const form = article.querySelector('form');
                const readUrl = form ? form.action : article.dataset.readUrl;
                const openLink = article.querySelector('.open-link-button');

                if (readUrl) {
                    const result = await markNotificationAsRead(readUrl);
                    markItemAsReadVisually(article, result);
                    if (openLink && openLink.href) {
                        window.location.href = openLink.href;
                    }
                }
            }
        });

        const readAllForm = document.querySelector('form[action="{{ route('siswa.notifikasi.read-all') }}"]');
        if (readAllForm) {
            readAllForm.addEventListener('submit', async function (e) {
                e.preventDefault();
                const submitBtn = readAllForm.querySelector('button');
                if (submitBtn) submitBtn.disabled = true;

                try {
                    const response = await fetch(readAllForm.action, {
                        method: 'PATCH',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json',
                        },
                        credentials: 'same-origin'
                    });

                    if (response.ok) {
                        const articles = document.querySelectorAll('.notification-item.unread');
                        articles.forEach(art => markItemAsReadVisually(art, null));
                        updateBellBadge(0);
                        const totalCount = document.querySelectorAll('.notification-item').length;
                        updateSummaryCards(0, totalCount);
                        readAllForm.remove();
                    } else {
                        readAllForm.submit();
                    }
                } catch (err) {
                    readAllForm.submit();
                }
            });
        }
    });
</script>
</body>
</html>
