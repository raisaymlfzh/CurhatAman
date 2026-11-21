<!DOCTYPE html>

<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Laporan Saya - CurhatAman</title>



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



        .btn-ca-primary {

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



        .btn-ca-primary:hover,

        .btn-ca-primary:focus {

            color: #ffffff;

            background: var(--ca-primary-dark);

            border-color: var(--ca-primary-dark);

        }




        .history-context {
            margin-bottom: 12px;
            padding: 10px 12px;
            border: 1px solid #d8e8e6;
            border-radius: 9px;
            display: flex;
            align-items: center;
            gap: 8px;
            color: #526765;
            background: #f7fbfa;
            font-size: .72rem;
        }

        .history-context i {
            color: var(--ca-primary);
        }

        .month-divider {
            padding: 10px 20px;
            border-top: 1px solid var(--ca-line);
            border-bottom: 1px solid var(--ca-line);
            display: flex;
            align-items: center;
            gap: 8px;
            color: #475467;
            background: #f8fbfa;
            font-size: .72rem;
            font-weight: 700;
        }

        .month-divider:first-child {
            border-top: 0;
        }

        .month-divider i {
            color: var(--ca-primary);
        }

        .report-academic {
            margin-top: 4px;
            color: var(--ca-muted-light);
            font-size: .67rem;
        }

        .report-panel {

            overflow: hidden;

            border: 1px solid var(--ca-border);

            border-radius: var(--ca-radius);

            background: var(--ca-surface);

        }



        .report-panel-header {

            min-height: 62px;

            padding: 16px 20px;

            border-bottom: 1px solid var(--ca-line);

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 16px;

        }



        .report-panel-title {

            margin: 0;

            font-size: 1rem;

            font-weight: 690;

        }



        .report-count {

            display: inline-flex;

            align-items: center;

            gap: 6px;

            color: var(--ca-muted);

            font-size: .75rem;

        }



        .report-row {

            padding: 18px 20px;

            border-bottom: 1px solid var(--ca-line);

            transition: *background* .15s ease;

        }



        .report-row:last-child {

            border-bottom: 0;

        }



        .report-row:hover {

            background: #fbfcfc;

        }



        .report-code {

            margin-bottom: 4px;

            color: var(--ca-text);

            font-size: .87rem;

            font-weight: 680;

        }



        .report-date {

            color: var(--ca-muted);

            font-size: .73rem;

        }



        .report-label {

            margin-bottom: 4px;

            color: var(--ca-muted-light);

            font-size: .67rem;

            font-weight: 720;

            letter-spacing: .045em;

            text-transform: uppercase;

        }



        .report-value {

            color: var(--ca-text);

            font-size: .82rem;

            font-weight: 600;

        }



        .report-value-muted {

            color: var(--ca-muted);

            font-size: .79rem;

        }



        .status-badge {

            display: inline-flex;

            align-items: center;

            gap: 5px;

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



        .privacy-badge {

            display: inline-flex;

            align-items: center;

            gap: 5px;

            margin-top: 7px;

            color: var(--ca-muted);

            font-size: .68rem;

        }



        .detail-link {

            display: inline-flex;

            align-items: center;

            gap: 5px;

            color: var(--ca-primary-dark);

            font-size: .78rem;

            font-weight: 650;

        }



        .detail-link:hover {

            color: var(--ca-primary);

        }



        .empty-state {

            min-height: 280px;

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

            margin: 0 0 14px;

            color: var(--ca-muted);

            font-size: .78rem;

            line-height: 1.5;

        }



        .pagination {

            margin-bottom: 0;

            gap: 4px;

        }



        .page-link {

            min-width: 36px;

            min-height: 36px;

            border: 1px solid var(--ca-border);

            border-radius: 8px !important;

            display: inline-flex;

            align-items: center;

            justify-content: center;

            color: #475467;

            background: #ffffff;

            font-size: .75rem;

        }



        .page-link:hover {

            color: var(--ca-primary-dark);

            background: var(--ca-primary-soft);

            border-color: #cfe3e0;

        }



        .page-item.active .page-link {

            color: #ffffff;

            background: var(--ca-primary);

            border-color: var(--ca-primary);

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



            .page-main {

                padding-top: 28px;

            }

        }



        @media (max-width: 767.98px) {
            .report-row {

                padding: 16px 18px;

            }



            .report-panel-header {

                padding: 15px 18px;

            }



            .page-actions {

                width: 100%;

            }



            .page-actions .btn-ca-primary {

                width: 100%;

            }



            .report-action {

                padding-top: 5px;

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

    $daftarLaporan = $laporan ?? $laporans ?? collect();

    $totalRiwayat = method_exists($daftarLaporan, 'total')
        ? $daftarLaporan->total()
        : $daftarLaporan->count();



    $fotoProfil = $user->profile_photo_path

        ? asset('storage/' . $user->profile_photo_path)

        : null;



    $jumlahNotifikasiBelum = \App\Models\Notifikasi::where('user_id', $user->id)

        ->whereNull('read_at')

        ->count();



    $statusClass = [

        'draft' => 'status-draft',

        'baru' => 'status-baru',

        'diproses' => 'status-diproses',

        'selesai' => 'status-selesai',

        'dieskalasi' => 'status-dieskalasi',

    ];



    $statusIcon = [

        'draft' => 'bi-file-earmark',

        'baru' => 'bi-clock',

        'diproses' => 'bi-arrow-repeat',

        'selesai' => 'bi-check-circle',

        'dieskalasi' => 'bi-exclamation-triangle',

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

                        class="nav-link"

                    >

                        Dashboard

                    </a>

                </li>



                <li class="nav-item">

                    <a

                        href="{{ route('siswa.laporan.index') }}"

                        class="nav-link active"

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

                    Pelaporan

                </div>



                <h1 class="page-title">

                    Laporan Saya

                </h1>



                <p class="page-subtitle">

                    Pantau laporan yang pernah kamu buat dan perkembangan penanganannya.

                </p>

            </div>



            <div class="page-actions">

                <a

                    href="{{ route('siswa.laporan.create') }}"

                    class="btn-ca-primary"

                >

                    <i class="bi bi-plus-lg"></i>

                    Buat Laporan Baru

                </a>

            </div>

        </section>



        <div class="history-context">
            <i class="bi bi-archive"></i>
            <span>
                Semua laporan yang pernah kamu buat tetap tersimpan sebagai riwayat dan dikelompokkan berdasarkan bulan.
            </span>
        </div>

        <section class="report-panel">

            <div class="report-panel-header">

                <h2 class="report-panel-title">

                    Riwayat Laporan

                </h2>



                <div class="report-count">

                    <i class="bi bi-file-earmark-text"></i>

                    {{ $totalRiwayat }} laporan

                </div>

            </div>



            @if ($daftarLaporan->count())

                @php
                    $bulanRiwayatAktif = null;
                @endphp

                @foreach ($daftarLaporan as $item)

                    @php
                        $tanggalRiwayat = $item->submitted_at
                            ? \Carbon\Carbon::parse($item->submitted_at)
                            : ($item->created_at
                                ? \Carbon\Carbon::parse($item->created_at)
                                : null);

                        $bulanRiwayatKey = $tanggalRiwayat
                            ? $tanggalRiwayat->format('Y-m')
                            : 'tanpa-tanggal';

                        $bulanRiwayatLabel = $tanggalRiwayat
                            ? $tanggalRiwayat->locale('id')->translatedFormat('F Y')
                            : 'Tanpa Tanggal';
                    @endphp

                    @if ($bulanRiwayatAktif !== $bulanRiwayatKey)
                        <div class="month-divider">
                            <i class="bi bi-calendar3"></i>
                            {{ $bulanRiwayatLabel }}
                        </div>

                        @php
                            $bulanRiwayatAktif = $bulanRiwayatKey;
                        @endphp
                    @endif

                    <article class="report-row">

                        <div class="row g-3 align-items-center">

                            <div class="col-md-3">

                                <div class="report-code">

                                    {{ $item->kode_laporan }}

                                </div>



                                <div class="report-date">
                                    <i class="bi bi-calendar3 me-1"></i>
                                    {{
                                        $tanggalRiwayat
                                            ? $tanggalRiwayat->locale('id')->translatedFormat('d M Y')
                                            : '-'
                                    }}
                                </div>

                                <div class="report-academic">
                                    @if ($item->status_kasus === 'draft')
                                        Draft · periode akademik ditetapkan saat laporan dikirim
                                    @else
                                        {{ $item->tahun_ajaran ?: '-' }}
                                        ·
                                        {{ $item->semester ? ucfirst($item->semester) : '-' }}
                                        @if ($item->nama_kelas_saat_laporan)
                                            · {{ $item->nama_kelas_saat_laporan }}
                                        @endif
                                    @endif
                                </div>

                            </div>



                            <div class="col-6 col-md-2">

                                <div class="report-label">

                                    Kategori

                                </div>



                                <div class="report-value">

                                    {{ optional($item->kategori)->nama_kategori ?? '-' }}

                                </div>

                            </div>



                            <div class="col-6 col-md-2">

                                <div class="report-label">

                                    Lokasi

                                </div>



                                <div class="report-value-muted text-truncate">

                                    {{ $item->lokasi_kejadian ?: 'Tidak dicantumkan' }}

                                </div>

                            </div>



                            <div class="col-6 col-md-2">

                                <div class="report-label">

                                    Status

                                </div>



                                <span class="status-badge {{ $statusClass[$item->status_kasus] ?? 'status-draft' }}">

                                    <i class="bi {{ $statusIcon[$item->status_kasus] ?? 'bi-circle' }}"></i>

                                    {{ ucfirst($item->status_kasus) }}

                                </span>



                                @if ($item->status_rahasia)

                                    <div class="privacy-badge">

                                        <i class="bi bi-lock"></i>

                                        Rahasia

                                    </div>

                                @endif

                            </div>



                            <div class="col-6 col-md-3 text-md-end report-action">

                                <a

                                    href="{{ route('siswa.laporan.show', $item->id) }}"

                                    class="detail-link"

                                >

                                    Lihat Detail

                                    <i class="bi bi-arrow-right"></i>

                                </a>

                            </div>

                        </div>

                    </article>

                @endforeach

            @else

                <div class="empty-state">

                    <div class="empty-icon">

                        <i class="bi bi-file-earmark-plus"></i>

                    </div>



                    <h3 class="empty-title">

                        Belum ada laporan

                    </h3>



                    <p class="empty-copy">

                        Setelah kamu membuat laporan, kode laporan, kategori, status, dan perkembangan penanganannya akan tampil di halaman ini.

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

        </section>



        @if (

            method_exists($daftarLaporan, 'links')

            && $daftarLaporan->hasPages()

        )

            <div class="mt-4">

                {{ $daftarLaporan->links() }}

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

</body>

</html>
