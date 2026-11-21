<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rujukan Saya - CurhatAman</title>

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

        .page-main {
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
            max-width: 720px;
            margin: 8px 0 0;
            color: var(--ca-muted);
            font-size: .9rem;
            line-height: 1.55;
        }

        .summary-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 12px;
            margin: 22px 0;
        }

        .summary-card {
            padding: 16px;
            border: 1px solid var(--ca-border);
            border-radius: var(--ca-radius);
            background: #ffffff;
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

        .section-card {
            overflow: hidden;
            border: 1px solid var(--ca-border);
            border-radius: var(--ca-radius);
            background: #ffffff;
        }

        .section-header {
            padding: 18px 20px;
            border-bottom: 1px solid var(--ca-line);
        }

        .section-title {
            margin: 0;
            font-size: 1rem;
            font-weight: 690;
        }

        .section-copy {
            margin: 5px 0 0;
            color: var(--ca-muted);
            font-size: .78rem;
            line-height: 1.5;
        }

        .referral-item {
            display: grid;
            grid-template-columns: minmax(220px, 1.45fr) minmax(110px, .55fr) minmax(180px, .9fr) minmax(220px, 1.1fr);
            gap: 18px;
            align-items: center;
            padding: 18px 20px;
            border-bottom: 1px solid var(--ca-line);
        }

        .referral-item:last-child {
            border-bottom: 0;
        }

        .service-name {
            color: var(--ca-text);
            font-size: .86rem;
            font-weight: 680;
        }

        .meta {
            margin-top: 3px;
            color: var(--ca-muted);
            font-size: .72rem;
            line-height: 1.5;
        }

        .item-label {
            margin-bottom: 5px;
            color: var(--ca-muted-light);
            font-size: .64rem;
            font-weight: 720;
            letter-spacing: .045em;
            text-transform: uppercase;
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

        .source-chip {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 5px 8px;
            border-radius: 8px;
            color: #475467;
            background: #f2f4f7;
            font-size: .68rem;
            font-weight: 620;
        }

        .contact-box {
            color: var(--ca-muted);
            font-size: .73rem;
            line-height: 1.5;
        }

        .contact-line {
            display: flex;
            align-items: flex-start;
            gap: 6px;
        }

        .contact-line i {
            margin-top: 1px;
            color: var(--ca-primary);
        }

        .contact-link {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            margin-top: 5px;
            color: var(--ca-primary-dark);
            font-size: .72rem;
            font-weight: 650;
        }

        .contact-link:hover {
            color: var(--ca-primary);
        }

        .empty-state {
            min-height: 260px;
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

        .note-box {
            display: flex;
            align-items: flex-start;
            gap: 9px;
            margin-top: 14px;
            padding: 12px 14px;
            border: 1px solid #cfe3e0;
            border-radius: 9px;
            color: #55706d;
            background: #f3faf9;
            font-size: .72rem;
            line-height: 1.55;
        }

        .note-box i {
            margin-top: 1px;
            color: var(--ca-primary);
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

            .summary-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .referral-item {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                align-items: start;
            }

            .page-main {
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

            .summary-grid,
            .referral-item {
                grid-template-columns: 1fr;
            }

            .section-header,
            .referral-item {
                padding-left: 18px;
                padding-right: 18px;
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
    $namaUser = ucwords($user->name ?? 'Siswa');
    $inisial = strtoupper(mb_substr($namaUser, 0, 1));

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

<main class="page-main">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('siswa.bantuan.index') }}">
                        Rujukan & Bantuan
                    </a>
                </li>

                <li class="breadcrumb-item active" aria-current="page">
                    Rujukan Saya
                </li>
            </ol>
        </nav>

        <section>
            <div class="page-kicker">
                Dukungan Siswa
            </div>

            <h1 class="page-title">
                Rujukan Saya
            </h1>

            <p class="page-subtitle">
                Lihat layanan tujuan, status, tanggal, dan informasi kontak dari rujukan yang dibuat Guru BK.
            </p>
        </section>

        <section class="summary-grid">
            <div class="summary-card">
                <span class="summary-icon">
                    <i class="bi bi-life-preserver"></i>
                </span>

                <div class="summary-label">
                    Total Rujukan
                </div>

                <div class="summary-value">
                    {{ $summary['total'] }}
                </div>
            </div>

            <div class="summary-card">
                <span class="summary-icon">
                    <i class="bi bi-clock"></i>
                </span>

                <div class="summary-label">
                    Baru
                </div>

                <div class="summary-value">
                    {{ $summary['baru'] }}
                </div>
            </div>

            <div class="summary-card">
                <span class="summary-icon">
                    <i class="bi bi-arrow-repeat"></i>
                </span>

                <div class="summary-label">
                    Diproses
                </div>

                <div class="summary-value">
                    {{ $summary['diproses'] }}
                </div>
            </div>

            <div class="summary-card">
                <span class="summary-icon">
                    <i class="bi bi-check-circle"></i>
                </span>

                <div class="summary-label">
                    Selesai
                </div>

                <div class="summary-value">
                    {{ $summary['selesai'] }}
                </div>
            </div>
        </section>

        <section class="section-card">
            <div class="section-header">
                <h2 class="section-title">
                    Riwayat Rujukan
                </h2>

                <p class="section-copy">
                    Informasi rujukan yang telah dibuat oleh Guru BK untuk akunmu.
                </p>
            </div>

            @if ($rujukan->isEmpty())
                <div class="empty-state">
                    <span class="empty-icon">
                        <i class="bi bi-life-preserver"></i>
                    </span>

                    <div class="empty-title">
                        Belum Ada Rujukan
                    </div>

                    <p class="empty-copy">
                        Jika Guru BK membuat rujukan untukmu, informasinya akan muncul di halaman ini.
                    </p>
                </div>
            @else
                @foreach ($rujukan as $item)
                    @php
                        $statusClass = match ($item->status) {
                            'baru' => 'status-baru',
                            'diproses' => 'status-diproses',
                            'selesai' => 'status-selesai',
                            default => 'status-default',
                        };

                        $sumberLabel = $item->skrining_id
                            ? 'Tindak lanjut skrining'
                            : ($item->laporan_id
                                ? 'Tindak lanjut laporan'
                                : 'Pendampingan Guru BK');
                    @endphp

                    <article class="referral-item">
                        <div>
                            <div class="item-label">
                                Layanan Tujuan
                            </div>

                            <div class="service-name">
                                {{ $item->nama_layanan }}
                            </div>

                            <div class="meta">
                                {{ ucwords(str_replace('_', ' ', $item->jenis_layanan)) }}
                            </div>

                            <div class="meta">
                                Dirujuk
                                {{ $item->referred_at
                                    ? \Carbon\Carbon::parse($item->referred_at)->format('d M Y, H:i')
                                    : '-' }}
                            </div>
                        </div>

                        <div>
                            <div class="item-label">
                                Status
                            </div>

                            <span class="status-badge {{ $statusClass }}">
                                {{ ucfirst($item->status) }}
                            </span>
                        </div>

                        <div>
                            <div class="item-label">
                                Sumber
                            </div>

                            <span class="source-chip">
                                <i class="bi bi-clipboard2-pulse"></i>
                                {{ $sumberLabel }}
                            </span>
                        </div>

                        <div>
                            <div class="item-label">
                                Kontak Layanan
                            </div>

                            <div class="contact-box">
                                @if ($item->kontak)
                                    <div class="contact-line">
                                        <i class="bi bi-telephone"></i>
                                        <span>{{ $item->kontak }}</span>
                                    </div>
                                @else
                                    <div>
                                        Kontak layanan belum tersedia.
                                    </div>
                                @endif

                                @if ($item->alamat_url)
                                    <a
                                        href="{{ $item->alamat_url }}"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        class="contact-link"
                                    >
                                        <i class="bi bi-box-arrow-up-right"></i>
                                        Lihat informasi layanan
                                    </a>
                                @endif
                            </div>
                        </div>
                    </article>
                @endforeach
            @endif
        </section>

        <div class="note-box">
            <i class="bi bi-info-circle"></i>

            <span>
                Informasi rujukan berasal dari Guru BK. Jika ada informasi yang kurang jelas, hubungi Guru BK sekolah untuk penjelasan lebih lanjut.
            </span>
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
</body>
</html>
