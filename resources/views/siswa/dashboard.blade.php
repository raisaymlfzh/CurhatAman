<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Siswa - CurhatAman</title>

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
            --ca-warning: #a35d10;
            --ca-warning-soft: #fff8ee;
            --ca-success: #087a5a;
            --ca-danger: #b42318;
            --ca-radius: 12px;
        }

        * {
            box-sizing: border-box;
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

        .text-ca-primary {
            color: var(--ca-primary) !important;
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

        .dashboard-main {
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

        .welcome-title {
            margin: 0;
            font-size: clamp(1.7rem, 3vw, 2.15rem);
            font-weight: 720;
            letter-spacing: -.55px;
        }

        .welcome-copy {
            margin: 8px 0 0;
            color: var(--ca-muted);
            font-size: .9rem;
        }

        .header-actions {
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
            border: 1px solid var(--ca-primary);
            color: #ffffff;
            background: var(--ca-primary);
        }

        .btn-ca-primary:hover,
        .btn-ca-primary:focus {
            color: #ffffff;
            background: var(--ca-primary-dark);
            border-color: var(--ca-primary-dark);
        }

        .btn-ca-outline {
            border: 1px solid #a7b5b4;
            color: #475467;
            background: #ffffff;
        }

        .btn-ca-outline:hover,
        .btn-ca-outline:focus {
            color: var(--ca-primary-dark);
            border-color: #8ec9c4;
            background: #f8fbfa;
        }

        .summary-card {
            height: 100%;
            min-height: 166px;
            padding: 18px;
            border: 1px solid var(--ca-border);
            border-radius: var(--ca-radius);
            background: var(--ca-surface);
        }

        .summary-card-accent {
            border-color: #cfe3e0;
        }

        .summary-head {
            min-height: 38px;
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 12px;
        }

        .summary-icon {
            width: 38px;
            height: 38px;
            border-radius: 9px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            color: var(--ca-primary);
            background: var(--ca-primary-soft);
            font-size: .95rem;
        }

        .summary-label {
            padding-top: 2px;
            color: var(--ca-muted-light);
            font-size: .68rem;
            font-weight: 720;
            letter-spacing: .045em;
            text-transform: uppercase;
            text-align: right;
        }

        .summary-body {
            margin-top: 22px;
        }

        .summary-title {
            margin: 0 0 5px;
            font-size: .9rem;
            font-weight: 680;
        }

        .summary-copy {
            margin: 0;
            color: var(--ca-muted);
            font-size: .79rem;
            line-height: 1.5;
        }

        .summary-number {
            margin-right: 6px;
            font-size: 1.75rem;
            line-height: 1;
            font-weight: 720;
            letter-spacing: -.45px;
        }

        .summary-inline-text {
            color: var(--ca-muted);
            font-size: .78rem;
        }

        .summary-status {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: var(--ca-success);
            font-size: .86rem;
            font-weight: 650;
        }

        .summary-link {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            margin-top: 13px;
            color: var(--ca-primary-dark);
            font-size: .78rem;
            font-weight: 650;
        }

        .summary-link:hover {
            color: var(--ca-primary);
        }

        .section-card {
            height: 100%;
            padding: 20px;
            border: 1px solid var(--ca-border);
            border-radius: var(--ca-radius);
            background: #ffffff;
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

        .section-action {
            min-height: 34px;
            padding: 0 11px;
            border: 1px solid var(--ca-border);
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #475467;
            background: #ffffff;
            font-size: .73rem;
            font-weight: 620;
        }

        .section-action:hover {
            color: var(--ca-primary-dark);
            border-color: #b8d7d3;
            background: #f8fbfa;
        }

        .report-list {
            margin-top: 10px;
        }

        .report-item {
            padding: 14px 0;
            border-bottom: 1px solid var(--ca-line);
        }

        .report-item:last-child {
            border-bottom: 0;
            padding-bottom: 0;
        }

        .report-category {
            margin-bottom: 4px;
            font-size: .86rem;
            font-weight: 650;
        }

        .report-description {
            max-width: 560px;
            margin: 0 0 5px;
            color: var(--ca-muted);
            font-size: .74rem;
            line-height: 1.5;
        }

        .report-meta {
            color: var(--ca-muted);
            font-size: .73rem;
            line-height: 1.5;
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

        .status-draft {
            color: #475467;
            background: #eef2f4;
        }

        .status-dieskalasi {
            color: #9f3542;
            background: #fdebed;
        }

        .empty-state {
            min-height: 220px;
            margin-top: 16px;
            padding: 28px 22px;
            border: 1px solid var(--ca-border);
            border-radius: 10px;
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

        .education-list {
            margin-top: 10px;
        }

        .education-item {
            display: flex;
            gap: 11px;
            padding: 14px 0;
            border-bottom: 1px solid var(--ca-line);
        }

        .education-item:last-child {
            border-bottom: 0;
        }

        .education-icon {
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

        .education-title {
            margin: 0 0 3px;
            font-size: .82rem;
            font-weight: 650;
        }

        .education-copy {
            margin: 0;
            color: var(--ca-muted);
            font-size: .74rem;
            line-height: 1.48;
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

            .dashboard-main {
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

            .dashboard-main {
                padding-top: 24px;
            }

            .header-actions {
                width: 100%;
            }

            .header-actions .btn-ca-primary,
            .header-actions .btn-ca-outline {
                flex: 1;
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

    $statusBadgeMap = [
        'draft' => 'status-draft',
        'baru' => 'status-baru',
        'diproses' => 'status-diproses',
        'selesai' => 'status-selesai',
        'dieskalasi' => 'status-dieskalasi',
    ];
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
                    <a
                        href="{{ route('siswa.dashboard') }}"
                        class="nav-link active"
                    >
                        Dashboard
                    </a>
                </li>

                <li class="nav-item">
                    <a
                        href="{{ route('siswa.laporan.index') }}"
                        class="nav-link"
                    >
                        Laporan Saya
                    </a>
                </li>

                <li class="nav-item">
                    <a
                        href="{{ route('siswa.skrining.riwayat') }}"
                        class="nav-link"
                    >
                        Skrining
                    </a>
                </li>

                <li class="nav-item">
                    <a
                        href="{{ route('siswa.bantuan.index') }}"
                        class="nav-link"
                    >
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

<main class="dashboard-main">
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

        @if (session('error'))
            <div
                class="alert alert-warning border-0 shadow-sm d-flex align-items-start gap-2 mb-4"
                style="background: #fff8eb; border-left: 4px solid #f79009 !important; color: #7a2e0e; border-radius: 10px;"
                role="alert"
            >
                <i class="bi bi-exclamation-triangle-fill mt-1" style="color: #f79009;"></i>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        <section class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-4 mb-4">
            <div>
                <div class="page-kicker">
                    Dashboard Siswa
                </div>

                <h1 class="welcome-title">
                    Halo, {{ $namaUser }}
                </h1>

                <p class="welcome-copy">
                    Kelola laporan, skrining, dan akses bantuan dari satu tempat.
                </p>
            </div>

            <div class="header-actions">
                <a
                    href="{{ route('siswa.laporan.create') }}"
                    class="btn-ca-primary"
                >
                    <i class="bi bi-plus-lg"></i>
                    Buat Laporan
                </a>

                @if ($sudahSkriningBulanIni)
                    <span class="btn-ca-outline disabled" aria-disabled="true">
                        <i class="bi bi-check-circle"></i>
                        Skrining Selesai
                    </span>
                @else
                    <a
                        href="{{ route('siswa.skrining.index') }}"
                        class="btn-ca-outline"
                    >
                        <i class="bi bi-clipboard2-pulse"></i>
                        Isi Skrining
                    </a>
                @endif
            </div>
        </section>

        <section class="row g-3 mb-4">
            <div class="col-md-6 col-xl-3">
                <div class="summary-card">
                    <div class="summary-head">
                        <span class="summary-icon">
                            <i class="bi bi-file-earmark-text"></i>
                        </span>

                        <span class="summary-label">
                            Laporan Terakhir
                        </span>
                    </div>

                    <div class="summary-body">
                        @if ($laporanTerakhir)
                            <div class="d-flex align-items-start justify-content-between gap-2 mb-2">
                                <h2 class="summary-title mb-0">
                                    {{ optional($laporanTerakhir->kategori)->nama_kategori ?? 'Tanpa kategori' }}
                                </h2>

                                <span class="status-badge {{ $statusBadgeMap[$laporanTerakhir->status_kasus] ?? 'status-draft' }}">
                                    {{ ucfirst($laporanTerakhir->status_kasus) }}
                                </span>
                            </div>

                            <p class="summary-copy">
                                {{ $laporanTerakhir->kode_laporan }}
                                <span class="mx-1">•</span>
                                {{ $laporanTerakhir->created_at->format('d M Y') }}
                            </p>
                        @else
                            <h2 class="summary-title">
                                Belum ada laporan
                            </h2>

                            <p class="summary-copy">
                                Laporan terbaru yang kamu kirim akan tampil di sini.
                            </p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="summary-card">
                    <div class="summary-head">
                        <span class="summary-icon">
                            <i class="bi bi-heart-pulse"></i>
                        </span>

                        <span class="summary-label">
                            Status Skrining
                        </span>
                    </div>

                    <div class="summary-body">
                        @if ($sudahSkriningBulanIni)
                            <div class="summary-status">
                                <i class="bi bi-check-circle"></i>
                                Sudah diisi bulan ini
                            </div>

                            @if ($skriningBulanIni)
                                <p class="summary-copy mt-1">
                                    Diselesaikan {{ $skriningBulanIni->completed_at->format('d/m/Y') }}
                                </p>
                            @endif

                            <a
                                href="{{ route('siswa.skrining.riwayat') }}"
                                class="summary-link"
                            >
                                Lihat Riwayat Skrining
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        @else
                            <h2 class="summary-title">
                                Belum diisi bulan ini
                            </h2>

                            <p class="summary-copy">
                                Luangkan beberapa menit untuk melakukan skrining berkala.
                            </p>

                            <a
                                href="{{ route('siswa.skrining.index') }}"
                                class="summary-link"
                            >
                                Mulai Skrining
                                <i class="bi bi-arrow-right"></i>
                            </a>

                            <a
                                href="{{ route('siswa.skrining.riwayat') }}"
                                class="summary-link ms-3"
                            >
                                Riwayat
                                <i class="bi bi-clock-history"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="summary-card">
                    <div class="summary-head">
                        <span class="summary-icon">
                            <i class="bi bi-folder2-open"></i>
                        </span>

                        <span class="summary-label">
                            Laporan Saya
                        </span>
                    </div>

                    <div class="summary-body">
                        <div class="d-flex align-items-end">
                            <span class="summary-number">
                                {{ $totalLaporan }}
                            </span>

                            <span class="summary-inline-text mb-1">
                                kasus dilaporkan
                            </span>
                        </div>

                        <p class="summary-copy mt-2">
                            Jumlah laporan yang pernah kamu buat.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="summary-card summary-card-accent">
                    <div class="summary-head">
                        <span class="summary-icon">
                            <i class="bi bi-chat-heart"></i>
                        </span>

                        <span class="summary-label">
                            Bantuan
                        </span>
                    </div>

                    <div class="summary-body">
                        <h2 class="summary-title">
                            Butuh bantuan?
                        </h2>

                        <p class="summary-copy">
                            Akses informasi bantuan atau ajukan pendampingan kepada Guru BK.
                        </p>

                        <a
                            href="{{ route('siswa.bantuan.index') }}"
                            class="summary-link"
                        >
                            Rujukan & Bantuan
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <section class="row g-3">
            <div class="col-lg-8">
                <div class="section-card">
                    <div class="d-flex justify-content-between align-items-start gap-3">
                        <div>
                            <h2 class="section-title">
                                Riwayat Laporan Terbaru
                            </h2>

                            <p class="section-subtitle">
                                Pantau perkembangan laporan yang sudah kamu kirim.
                            </p>
                        </div>

                        @if ($riwayatLaporan->count())
                            <a
                                href="{{ route('siswa.laporan.index') }}"
                                class="section-action"
                            >
                                Lihat Semua
                            </a>
                        @endif
                    </div>

                    @if ($riwayatLaporan->count())
                        <div class="report-list">
                            @foreach ($riwayatLaporan as $item)
                                <div class="report-item">
                                    <div class="d-flex justify-content-between align-items-start gap-3">
                                        <div>
                                            <div class="report-category">
                                                {{ optional($item->kategori)->nama_kategori ?? 'Tanpa kategori' }}
                                            </div>

                                            @if (optional($item->kategori)->deskripsi)
                                                <p class="report-description">
                                                    {{ $item->kategori->deskripsi }}
                                                </p>
                                            @endif

                                            <div class="report-meta">
                                                {{ $item->kode_laporan }}
                                                <span class="mx-1">•</span>
                                                {{ $item->lokasi_kejadian ?? 'Lokasi tidak dicantumkan' }}
                                                <span class="mx-1">•</span>
                                                {{ $item->tanggal_kejadian->format('d M Y') }}
                                            </div>
                                        </div>

                                        <span class="status-badge {{ $statusBadgeMap[$item->status_kasus] ?? 'status-draft' }}">
                                            {{ ucfirst($item->status_kasus) }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="empty-state">
                            <span class="empty-icon">
                                <i class="bi bi-file-earmark-plus"></i>
                            </span>

                            <div class="empty-title">
                                Belum ada laporan
                            </div>

                            <p class="empty-copy">
                                Setelah mengirim laporan, status penanganannya akan tampil di sini.
                            </p>

                            <a
                                href="{{ route('siswa.laporan.create') }}"
                                class="btn-ca-primary"
                            >
                                <i class="bi bi-plus-lg"></i>
                                Buat Laporan
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-lg-4">
                <aside class="section-card">
                    <h2 class="section-title">
                        Edukasi untuk Kamu
                    </h2>

                    <p class="section-subtitle">
                        Informasi singkat untuk membantu menjaga diri.
                    </p>

                    <div class="education-list">
                        <div class="education-item">
                            <span class="education-icon">
                                <i class="bi bi-phone"></i>
                            </span>

                            <div>
                                <h3 class="education-title">
                                    Menghadapi Cyberbullying
                                </h3>

                                <p class="education-copy">
                                    Kenali langkah sederhana saat menerima komentar atau pesan negatif di media sosial.
                                </p>
                            </div>
                        </div>

                        <div class="education-item">
                            <span class="education-icon">
                                <i class="bi bi-wind"></i>
                            </span>

                            <div>
                                <h3 class="education-title">
                                    Latihan Pernapasan 4-7-8
                                </h3>

                                <p class="education-copy">
                                    Latihan pernapasan sederhana yang dapat membantu menenangkan diri.
                                </p>
                            </div>
                        </div>

                        <div class="education-item">
                            <span class="education-icon">
                                <i class="bi bi-people"></i>
                            </span>

                            <div>
                                <h3 class="education-title">
                                    Jangan Hadapi Sendiri
                                </h3>

                                <p class="education-copy">
                                    Berbicara dengan orang dewasa yang dipercaya dapat menjadi langkah awal mencari bantuan.
                                </p>
                            </div>
                        </div>
                    </div>

                    <a
                        href="{{ route('siswa.bantuan.index') }}"
                        class="summary-link"
                    >
                        Lihat informasi bantuan
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </aside>
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
