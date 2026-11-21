<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Siswa Kelas | CurhatAman</title>

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
            --ca-success: #238653;
            --ca-success-soft: #edf8f2;
            --ca-warning: #a66b12;
            --ca-warning-soft: #fff7e8;
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

        .sidebar-link.active {
            color: var(--ca-primary-dark);
            background: var(--ca-primary-soft);
            font-weight: 660;
        }

        .sidebar-link.active i {
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
            color: #b42318;
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
            max-width: 1320px;
            margin: 0 auto;
        }

        .page-header {
            margin-bottom: 18px;
            padding: 20px 22px;
            border-radius: 12px;
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 20px;
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
            font-size: clamp(1.5rem, 2.8vw, 1.9rem);
            font-weight: 720;
            letter-spacing: -.4px;
        }

        .page-copy {
            max-width: 760px;
            margin: 7px 0 0;
            color: rgba(255, 255, 255, .84);
            font-size: .81rem;
            line-height: 1.55;
        }

        .class-meta {
            min-width: 185px;
            padding: 10px 12px;
            border: 1px solid rgba(255, 255, 255, .38);
            border-radius: 9px;
            background: rgba(255, 255, 255, .10);
        }

        .class-meta-label {
            color: rgba(255, 255, 255, .68);
            font-size: .62rem;
            font-weight: 700;
            letter-spacing: .065em;
            text-transform: uppercase;
        }

        .class-meta-value {
            margin-top: 3px;
            color: #ffffff;
            font-size: .75rem;
            font-weight: 680;
        }

        .period-bar {
            margin-bottom: 18px;
            padding: 14px 16px;
            border: 1px solid var(--ca-border);
            border-radius: 11px;
            background: var(--ca-surface);
        }

        .period-bar .form-label {
            margin-bottom: 5px;
            color: #596579;
            font-size: .67rem;
            font-weight: 690;
            letter-spacing: .05em;
            text-transform: uppercase;
        }

        .period-bar .form-select,
        .period-bar .form-control {
            min-height: 38px;
            border-color: #d7e1e1;
            border-radius: 9px;
            color: var(--ca-text);
            font-size: .78rem;
            font-weight: 560;
        }

        .period-bar .form-select:focus,
        .period-bar .form-control:focus {
            border-color: var(--ca-primary);
            box-shadow: 0 0 0 3px rgba(15, 138, 131, .12);
        }

        .btn-period {
            min-height: 38px;
            padding: 0 14px;
            border: 1px solid var(--ca-primary);
            border-radius: 9px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            color: #ffffff;
            background: var(--ca-primary);
            font-size: .76rem;
            font-weight: 660;
            white-space: nowrap;
        }

        .btn-period:hover {
            background: var(--ca-primary-dark);
            border-color: var(--ca-primary-dark);
            color: #ffffff;
        }

        .btn-period-reset {
            width: 38px;
            height: 38px;
            border: 1px solid #d7e1e1;
            border-radius: 9px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #596579;
            background: #ffffff;
            flex-shrink: 0;
        }

        .btn-period-reset:hover {
            color: var(--ca-primary-dark);
            background: var(--ca-primary-soft);
            border-color: #b7dbd6;
        }

        .metric-card {
            position: relative;
            height: 100%;
            min-height: 120px;
            padding: 16px;
            border: 1px solid var(--ca-border);
            border-top: 3px solid #cfd8d8;
            border-radius: 11px;
            background: var(--ca-surface);
        }

        .metric-card.students {
            border-top-color: var(--ca-primary);
        }

        .metric-card.completed-cases {
            border-top-color: #35a36f;
        }

        .metric-card.active-cases {
            border-top-color: #e6a33b;
        }

        .metric-card.screening {
            border-top-color: #4f8fbf;
        }

        .metric-top {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 12px;
        }

        .metric-label {
            color: #596579;
            font-size: .73rem;
            font-weight: 610;
        }

        .metric-value {
            margin-top: 10px;
            color: var(--ca-text);
            font-size: 1.5rem;
            font-weight: 730;
            line-height: 1;
        }

        .metric-icon {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            font-size: .82rem;
        }

        .metric-card.students .metric-icon {
            color: #ffffff;
            background: var(--ca-primary);
        }

        .metric-card.completed-cases .metric-icon {
            color: #027a48;
            background: #ecfdf3;
        }

        .metric-card.active-cases .metric-icon {
            color: #a85f00;
            background: #fff5e7;
        }

        .metric-card.screening .metric-icon {
            color: #2d6f9f;
            background: #eef6fb;
        }

        .metric-note {
            margin-top: 11px;
            color: var(--ca-muted);
            font-size: .68rem;
            line-height: 1.45;
        }

        .panel {
            border: 1px solid var(--ca-border);
            border-top: 3px solid var(--ca-primary);
            border-radius: 11px;
            background: var(--ca-surface);
            overflow: hidden;
        }

        .panel-header {
            min-height: 64px;
            padding: 15px 18px;
            border-bottom: 1px solid var(--ca-line);
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 16px;
        }

        .panel-title {
            margin: 0;
            color: var(--ca-text);
            font-size: .86rem;
            font-weight: 690;
        }

        .panel-copy {
            margin: 3px 0 0;
            color: var(--ca-muted);
            font-size: .71rem;
            line-height: 1.48;
        }

        .privacy-inline {
            min-height: 28px;
            padding: 0 10px;
            border: 1px solid #d5e6e4;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: var(--ca-primary-dark);
            background: #f4faf9;
            font-size: .68rem;
            font-weight: 640;
            white-space: nowrap;
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

        .page-footer {
            margin-top: 24px;
            padding-top: 14px;
            border-top: 1px solid var(--ca-border);
            color: var(--ca-muted-light);
            font-size: .68rem;
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

            .page-body {
                padding: 20px 16px 28px;
            }

            .page-header {
                flex-direction: column;
                align-items: flex-start;
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
                    Daftar Siswa
                </div>

                <div class="topbar-subtitle">
                    Data siswa perwalian di {{ $kelas->nama_kelas }}
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
                aria-label="Buka profil Wali Kelas"
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
                            Perwalian · {{ $kelas->nama_kelas }}
                        </div>

                        <h1 class="page-title">
                            Daftar Siswa {{ $kelas->nama_kelas }}
                        </h1>

                        <p class="page-copy">
                            Data siswa aktif. Riwayat dan detail kasus siswa dirahasiakan demi privasi.
                        </p>
                    </div>

                    <div class="class-meta">
                        <div class="class-meta-label">
                            Periode Akademik
                        </div>

                        <div class="class-meta-value">
                            {{ $periodeLabel }}
                        </div>
                    </div>
                </section>

                <section class="row g-3 mb-4">
                    <div class="col-sm-6 col-xl-3">
                        <div class="metric-card students">
                            <div class="metric-top">
                                <div>
                                    <div class="metric-label">
                                        Total Siswa
                                    </div>
                                    <div class="metric-value">
                                        {{ $totalSiswa }}
                                    </div>
                                </div>
                                <span class="metric-icon">
                                    <i class="bi bi-people"></i>
                                </span>
                            </div>
                            <div class="metric-note">
                                Siswa terdaftar
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xl-3">
                        <div class="metric-card completed-cases">
                            <div class="metric-top">
                                <div>
                                    <div class="metric-label">
                                        Kontak Lengkap
                                    </div>
                                    <div class="metric-value">
                                        {{ $kontakLengkap }}
                                    </div>
                                </div>
                                <span class="metric-icon">
                                    <i class="bi bi-check2-circle"></i>
                                </span>
                            </div>
                            <div class="metric-note">
                                Email & WhatsApp aktif
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xl-3">
                        <div class="metric-card active-cases">
                            <div class="metric-top">
                                <div>
                                    <div class="metric-label">
                                        Kontak Belum Lengkap
                                    </div>
                                    <div class="metric-value">
                                        {{ $kontakBelumLengkap }}
                                    </div>
                                </div>
                                <span class="metric-icon">
                                    <i class="bi bi-exclamation-circle"></i>
                                </span>
                            </div>
                            <div class="metric-note">
                                Perlu dilengkapi
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xl-3">
                        <div class="metric-card screening">
                            <div class="metric-top">
                                <div>
                                    <div class="metric-label">
                                        Akun Aktif
                                    </div>
                                    <div class="metric-value">
                                        {{ $akunAktif }}
                                    </div>
                                </div>
                                <span class="metric-icon">
                                    <i class="bi bi-person-check"></i>
                                </span>
                            </div>
                            <div class="metric-note">
                                Akun aktif di sistem
                            </div>
                        </div>
                    </div>
                </section>

                <form
                    method="GET"
                    action="{{ route('wali-kelas.siswa.index') }}"
                    class="period-bar"
                >
                    <div class="row g-3 align-items-end">
                        <div class="col-sm-6 col-lg-2">
                            <label for="tahun_ajaran" class="form-label">Tahun Ajaran</label>
                            <select name="tahun_ajaran" id="tahun_ajaran" class="form-select">
                                @foreach ($tahunAjaranOptions as $option)
                                    <option value="{{ $option }}" @selected($tahunAjaran === $option)>
                                        {{ $option }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-sm-6 col-lg-2">
                            <label for="kelas_id" class="form-label">Kelas</label>
                            <select name="kelas_id" id="kelas_id" class="form-select">
                                @foreach ($kelasList as $itemKelas)
                                    <option value="{{ $itemKelas->id }}" @selected((int) $kelasId === (int) $itemKelas->id)>
                                        {{ $itemKelas->nama_kelas }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-sm-6 col-lg-3">
                            <label for="status_kontak" class="form-label">Status Kontak</label>
                            <select name="status_kontak" id="status_kontak" class="form-select">
                                <option value="semua" @selected($statusKontak === 'semua')>Semua Siswa</option>
                                <option value="lengkap" @selected($statusKontak === 'lengkap')>Kontak Lengkap</option>
                                <option value="belum_lengkap" @selected($statusKontak === 'belum_lengkap')>Kontak Belum Lengkap</option>
                            </select>
                        </div>

                        <div class="col-sm-6 col-lg-3">
                            <label for="q" class="form-label">Cari Siswa</label>
                            <input
                                type="text"
                                name="q"
                                id="q"
                                value="{{ $search }}"
                                class="form-control"
                                placeholder="Nama, NISN, atau email..."
                            >
                        </div>

                        <div class="col-12 col-lg-2">
                            <div class="d-flex justify-content-end gap-2">
                                <button type="submit" class="btn-period w-100">
                                    <i class="bi bi-search"></i>
                                    Filter
                                </button>

                                <a
                                    href="{{ route('wali-kelas.siswa.index') }}"
                                    class="btn-period-reset"
                                    title="Reset filter"
                                >
                                    <i class="bi bi-arrow-counterclockwise"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </form>

                <section class="panel">
                    <div class="panel-header">
                        <div>
                            <h2 class="panel-title">
                                <i class="bi bi-people-fill text-success me-1"></i>
                                Data Siswa
                            </h2>
                            <p class="panel-copy">
                                Menampilkan {{ $daftarSiswa->count() }} siswa.
                            </p>
                        </div>

                        <span class="privacy-inline">
                            <i class="bi bi-people"></i>
                            {{ $totalSiswa }} Siswa
                        </span>
                    </div>

                    @if($daftarSiswa->isEmpty())
                        <div class="p-5 text-center text-muted">
                            <i class="bi bi-mortarboard fs-2 text-muted d-block mb-2"></i>
                            <div class="fw-bold" style="font-size: 13.5px; color: var(--ca-text);">
                                Tidak Ada Data Siswa
                            </div>
                            <div style="font-size: 12px;">
                                Belum ada siswa yang sesuai dengan filter pencarian.
                            </div>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table align-middle mb-0" style="font-size: 12.5px;">
                                <thead style="background: #f8fafb; border-bottom: 1px solid var(--ca-border);">
                                    <tr>
                                        <th class="py-3 px-3 text-muted fw-semibold text-uppercase" style="width: 55px; font-size: 11px; letter-spacing: .04em;">No</th>
                                        <th class="py-3 px-3 text-muted fw-semibold text-uppercase" style="font-size: 11px; letter-spacing: .04em;">Nama Siswa</th>
                                        <th class="py-3 px-3 text-muted fw-semibold text-uppercase" style="font-size: 11px; letter-spacing: .04em;">NISN</th>
                                        <th class="py-3 px-3 text-muted fw-semibold text-uppercase" style="font-size: 11px; letter-spacing: .04em;">Tahun Masuk</th>
                                        <th class="py-3 px-3 text-muted fw-semibold text-uppercase" style="font-size: 11px; letter-spacing: .04em;">Email & Kontak</th>
                                        <th class="py-3 px-3 text-muted fw-semibold text-uppercase text-end" style="font-size: 11px; letter-spacing: .04em;">Status Akun</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($daftarSiswa as $idx => $s)
                                        @php
                                            $emailBelumDiisi = empty($s->email) || str_ends_with(strtolower((string) $s->email), '@siswa.curhataman.local');
                                            $waFormatted = $s->whatsapp_number
                                                ? (str_starts_with($s->whatsapp_number, '62') ? '0' . substr($s->whatsapp_number, 2) : $s->whatsapp_number)
                                                : null;
                                            $waDigits = $s->whatsapp_number ? preg_replace('/\D+/', '', (string) $s->whatsapp_number) : '';
                                            if (str_starts_with($waDigits, '0')) {
                                                $waDigits = '62' . substr($waDigits, 1);
                                            }
                                        @endphp
                                        <tr style="border-bottom: 1px solid #f0f3f5;">
                                            <td class="py-3 px-3 text-muted">{{ $idx + 1 }}</td>
                                            <td class="py-3 px-3">
                                                <div class="fw-bold text-dark">{{ $s->name }}</div>
                                            </td>
                                            <td class="py-3 px-3">
                                                <span class="badge bg-light text-dark border" style="font-weight: 600;">{{ $s->nis ?: '-' }}</span>
                                            </td>
                                            <td class="py-3 px-3 text-secondary">{{ $s->tahun_masuk ?: '-' }}</td>
                                            <td class="py-3 px-3">
                                                @if($emailBelumDiisi)
                                                    <div class="text-muted fst-italic" style="font-size: 11.5px;">Email belum dilengkapi</div>
                                                @else
                                                    <div class="text-dark" style="font-size: 11.5px;">{{ $s->email }}</div>
                                                @endif

                                                @if($waFormatted && $waDigits !== '')
                                                    <a
                                                        href="https://wa.me/{{ $waDigits }}"
                                                        target="_blank"
                                                        rel="noopener noreferrer"
                                                        class="text-success fw-semibold d-inline-flex align-items-center mt-1"
                                                        style="font-size: 11.5px;"
                                                    >
                                                        <i class="bi bi-whatsapp me-1"></i>{{ $waFormatted }}
                                                    </a>
                                                @else
                                                    <div class="text-muted" style="font-size: 11px;">No. WA belum dilengkapi</div>
                                                @endif
                                            </td>
                                            <td class="py-3 px-3 text-end">
                                                @if($s->is_active)
                                                    <span class="badge" style="background: #ecf8f2; color: #027a48; font-weight: 600;">Aktif</span>
                                                @else
                                                    <span class="badge" style="background: #fef3f2; color: #b42318; font-weight: 600;">Nonaktif</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </section>

                <footer class="page-footer">
                    <div class="d-flex flex-column flex-md-row justify-content-between gap-2">
                        <span>
                            © {{ date('Y') }} CurhatAman
                        </span>

                        <span>
                            Portal Wali Kelas · Data ditampilkan sesuai kewenangan
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
</body>
</html>

