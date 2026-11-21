<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Laporan - CurhatAman</title>

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

        .detail-main {
            flex: 1;
            padding: 34px 0 38px;
        }

        .detail-container {
            max-width: 1080px;
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
            margin: 8px 0 0;
            color: var(--ca-muted);
            font-size: .9rem;
        }

        .detail-card {
            overflow: hidden;
            border: 1px solid var(--ca-border);
            border-radius: var(--ca-radius);
            background: var(--ca-surface);
        }

        .detail-card-body {
            padding: 24px;
        }

        .report-summary {
            padding: 18px 20px;
            margin-bottom: 22px;
            border: 1px solid var(--ca-border);
            border-radius: 10px;
            background: #fbfcfc;
        }

        .report-code {
            color: var(--ca-muted);
            font-size: .75rem;
            font-weight: 520;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            flex-shrink: 0;
            padding: 5px 8px;
            border-radius: 999px;
            font-size: .66rem;
            font-weight: 700;
            white-space: nowrap;
        }

        .status-badge-dot {
            font-size: .38rem;
        }

        .status-draft {
            color: #475467;
            background: #eef2f4;
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

        .status-dieskalasi {
            color: #9f3542;
            background: #fdebed;
        }

        .status-default {
            color: #475467;
            background: #eef2f4;
        }

        .info-box {
            height: 100%;
            padding: 15px 16px;
            border: 1px solid var(--ca-border);
            border-radius: 10px;
            background: #ffffff;
        }

        .info-label {
            display: block;
            margin-bottom: 5px;
            color: var(--ca-muted-light);
            font-size: .66rem;
            font-weight: 720;
            letter-spacing: .045em;
            text-transform: uppercase;
        }

        .info-value {
            color: var(--ca-text);
            font-size: .81rem;
            font-weight: 620;
            line-height: 1.45;
        }

        .detail-section {
            padding-top: 22px;
        }

        .detail-section + .detail-section {
            margin-top: 22px;
            border-top: 1px solid var(--ca-line);
        }

        .section-title {
            margin-bottom: 11px;
            color: var(--ca-text);
            font-size: .92rem;
            font-weight: 680;
        }

        .content-box {
            padding: 16px;
            border: 1px solid var(--ca-border);
            border-radius: 10px;
            color: #475467;
            background: #ffffff;
            font-size: .8rem;
            line-height: 1.65;
            white-space: pre-line;
        }

        .privacy-box {
            display: flex;
            align-items: flex-start;
            gap: 11px;
            padding: 15px 16px;
            border: 1px solid #cfe3e0;
            border-radius: 10px;
            color: #315d59;
            background: #f3faf9;
            font-size: .77rem;
            line-height: 1.55;
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

        .evidence-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            padding: 12px 14px;
            border: 1px solid var(--ca-border);
            border-radius: 9px;
            background: #ffffff;
        }

        .evidence-item + .evidence-item {
            margin-top: 8px;
        }

        .evidence-file {
            min-width: 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .evidence-icon {
            width: 34px;
            height: 34px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            color: var(--ca-primary-dark);
            background: var(--ca-primary-soft);
        }

        .evidence-name {
            max-width: 620px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            color: var(--ca-text);
            font-size: .77rem;
            font-weight: 600;
        }

        .evidence-link {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            flex-shrink: 0;
            color: var(--ca-primary-dark);
            font-size: .74rem;
            font-weight: 650;
        }

        .evidence-link:hover {
            color: var(--ca-primary);
        }

        .empty-note,
        .status-note {
            padding: 14px 15px;
            border: 1px solid var(--ca-border);
            border-radius: 9px;
            color: var(--ca-muted);
            background: #fbfcfc;
            font-size: .77rem;
            line-height: 1.55;
        }

        .status-note {
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }

        .status-note i {
            margin-top: 1px;
            color: var(--ca-primary);
            font-size: .9rem;
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

        .detail-alert {
            border: 0;
            border-radius: 10px;
            font-size: .8rem;
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

            .detail-main {
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

            .detail-card-body {
                padding: 18px;
            }

            .report-summary {
                padding: 16px;
            }

            .evidence-item {
                align-items: flex-start;
                flex-direction: column;
            }

            .evidence-name {
                max-width: calc(100vw - 135px);
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

    $statusClass = match($laporan->status_kasus) {
        'draft' => 'status-draft',
        'baru' => 'status-baru',
        'diproses' => 'status-diproses',
        'selesai' => 'status-selesai',
        'dieskalasi' => 'status-dieskalasi',
        default => 'status-default',
    };

    $statusLabel = match($laporan->status_kasus) {
        'draft' => 'Draft',
        'baru' => 'Baru',
        'diproses' => 'Diproses',
        'selesai' => 'Selesai',
        'dieskalasi' => 'Dieskalasi',
        default => ucfirst($laporan->status_kasus),
    };
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
                    <a href="{{ route('siswa.laporan.index') }}" class="nav-link active">
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

<main class="detail-main">
    <div class="container detail-container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('siswa.laporan.index') }}">
                        Laporan Saya
                    </a>
                </li>

                <li class="breadcrumb-item active" aria-current="page">
                    Detail Laporan
                </li>
            </ol>
        </nav>

        @if (session('success'))
            <div
                class="alert alert-success detail-alert shadow-sm mb-4"
                role="alert"
            >
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-check-circle-fill"></i>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div
                class="alert alert-danger detail-alert shadow-sm mb-4"
                role="alert"
            >
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-exclamation-circle-fill"></i>
                    <span>{{ session('error') }}</span>
                </div>
            </div>
        @endif

        <section class="mb-4">
            <div class="page-kicker">
                Pelaporan
            </div>

            <h1 class="page-title">
                Detail Laporan
            </h1>

            <p class="page-subtitle">
                Lihat informasi laporan dan perkembangan penanganannya.
            </p>
        </section>

        <section class="detail-card">
            <div class="detail-card-body">
                <div class="report-summary">
                    <div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-3">
                        <div>
                            <div class="report-code mb-1">
                                Kode Laporan
                            </div>

                            <div class="fw-semibold">
                                {{ $laporan->kode_laporan }}
                            </div>
                        </div>

                        <span class="status-badge {{ $statusClass }}">
                            <i class="bi bi-circle-fill status-badge-dot"></i>
                            {{ $statusLabel }}
                        </span>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="info-box">
                            <span class="info-label">
                                Kategori
                            </span>

                            <div class="info-value">
                                {{ $laporan->kategori->nama_kategori }}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="info-box">
                            <span class="info-label">
                                Tanggal Kejadian
                            </span>

                            <div class="info-value">
                                {{ $laporan->tanggal_kejadian->format('d M Y') }}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="info-box">
                            <span class="info-label">
                                Lokasi
                            </span>

                            <div class="info-value">
                                {{ $laporan->lokasi_kejadian ?? '-' }}
                            </div>
                        </div>
                    </div>
                </div>

                <section class="detail-section">
                    <h2 class="section-title">
                        Kronologi Kejadian
                    </h2>

                    <div class="content-box">{{ $laporan->deskripsi }}</div>
                </section>

                <section class="detail-section">
                    <h2 class="section-title">
                        Bukti Pendukung
                    </h2>

                    @forelse ($laporan->bukti as $bukti)
                        <div class="evidence-item">
                            <div class="evidence-file">
                                <span class="evidence-icon">
                                    <i class="bi bi-paperclip"></i>
                                </span>

                                <span
                                    class="evidence-name"
                                    title="{{ $bukti->original_name }}"
                                >
                                    {{ $bukti->original_name }}
                                </span>
                            </div>

                            <a
                                href="{{ asset('storage/' . $bukti->file_path) }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="evidence-link"
                            >
                                Lihat Bukti
                                <i class="bi bi-box-arrow-up-right"></i>
                            </a>
                        </div>
                    @empty
                        <div class="empty-note">
                            Tidak ada bukti pendukung yang dilampirkan.
                        </div>
                    @endforelse
                </section>

                <section class="detail-section">
                    <h2 class="section-title">
                        Kerahasiaan Identitas
                    </h2>

                    <div class="privacy-box">
                        <span class="privacy-icon">
                            <i class="bi bi-shield-lock"></i>
                        </span>

                        <div>
                            @if ($laporan->status_rahasia)
                                Laporan ini menggunakan mode rahasia. Identitas pelapor hanya dapat diakses oleh Guru BK yang berwenang untuk kebutuhan penanganan dan pendampingan.
                            @else
                                Laporan ini menggunakan identitas asli. Guru BK dapat menggunakan identitas pelapor untuk proses penanganan dan pendampingan.
                            @endif
                        </div>
                    </div>
                </section>

                <section class="detail-section">
                    <h2 class="section-title">
                        Perkembangan Penanganan
                    </h2>

                    @if ($laporan->status_kasus === 'draft')
                        <div class="d-flex flex-wrap gap-2 mb-3">
                            <form
                                method="POST"
                                action="{{ route('siswa.laporan.submit', $laporan) }}"
                                class="m-0"
                            >
                                @csrf
                                @method('PATCH')

                                <button
                                    type="submit"
                                    class="btn-ca-primary"
                                >
                                    <i class="bi bi-send"></i>
                                    Kirim Laporan Sekarang
                                </button>
                            </form>

                            <a href="{{ route('siswa.laporan.edit', $laporan) }}" class="btn-ca-outline">
                                <i class="bi bi-pencil"></i>
                                Edit Draft
                            </a>
                        </div>
                    @endif

                    <div class="status-note">
                        <i class="bi bi-info-circle"></i>

                        <div>
                            @if ($laporan->status_kasus === 'draft')
                                Laporan masih berupa draft dan belum dikirim kepada Guru BK.
                            @elseif ($laporan->status_kasus === 'baru')
                                Laporan telah dikirim dan menunggu ditinjau oleh Guru BK.
                            @elseif ($laporan->status_kasus === 'diproses')
                                Laporan sedang dalam proses penanganan oleh Guru BK.
                            @elseif ($laporan->status_kasus === 'selesai')
                                Penanganan laporan telah selesai.
                            @elseif ($laporan->status_kasus === 'dieskalasi')
                                Laporan telah dieskalasi untuk mendapatkan penanganan lebih lanjut.
                            @else
                                Status laporan saat ini: {{ ucfirst($laporan->status_kasus) }}.
                            @endif
                        </div>
                    </div>
                </section>
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
