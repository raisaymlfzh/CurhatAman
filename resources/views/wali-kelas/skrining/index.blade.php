<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Partisipasi Skrining | CurhatAman</title>

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
            margin-bottom: 22px;
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

        .metric-card {
            position: relative;
            height: 100%;
            min-height: 130px;
            padding: 17px;
            border: 1px solid var(--ca-border);
            border-top: 3px solid #cfd8d8;
            border-radius: 11px;
            background: var(--ca-surface);
        }

        .metric-card.students {
            border-top-color: var(--ca-primary);
        }

        .metric-card.completed {
            border-top-color: #35a36f;
        }

        .metric-card.pending {
            border-top-color: #e6a33b;
        }

        .metric-card.participation {
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
            margin-top: 12px;
            color: var(--ca-text);
            font-size: 1.55rem;
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

        .metric-card.completed .metric-icon {
            color: #027a48;
            background: #ecfdf3;
        }

        .metric-card.pending .metric-icon {
            color: #a85f00;
            background: #fff5e7;
        }

        .metric-card.participation .metric-icon {
            color: #2d6f9f;
            background: #eef6fb;
        }

        .metric-note {
            margin-top: 13px;
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
            padding: 14px 16px;
            border-bottom: 1px solid var(--ca-line);
        }

        .panel-title {
            margin: 0;
            color: var(--ca-text);
            font-size: .82rem;
            font-weight: 680;
        }

        .panel-copy {
            margin: 3px 0 0;
            color: var(--ca-muted);
            font-size: .69rem;
            line-height: 1.45;
        }

        .screening-wrap {
            padding: 18px 16px 17px;
        }

        .screening-summary {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 16px;
        }

        .screening-value {
            color: var(--ca-text);
            font-size: 1.85rem;
            font-weight: 730;
            line-height: 1;
        }

        .screening-caption {
            margin-top: 4px;
            color: var(--ca-muted);
            font-size: .66rem;
        }

        .screening-meta {
            color: #596579;
            font-size: .7rem;
            font-weight: 620;
            text-align: right;
        }

        .progress {
            height: 8px;
            margin-top: 14px;
            border-radius: 999px;
            overflow: hidden;
            background: #edf1f3;
        }

        .progress-bar {
            background: var(--ca-primary);
        }

        .summary-grid {
            margin-top: 16px;
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 10px;
        }

        .summary-box {
            padding: 12px;
            border: 1px solid var(--ca-line);
            border-radius: 9px;
            background: #fbfcfc;
        }

        .summary-box-label {
            color: var(--ca-muted);
            font-size: .65rem;
        }

        .summary-box-value {
            margin-top: 3px;
            color: var(--ca-text);
            font-size: 1.02rem;
            font-weight: 690;
        }

        .privacy-strip {
            margin: 0 16px 16px;
            padding: 11px 12px;
            border: 1px solid #d6e7e4;
            border-radius: 9px;
            display: flex;
            align-items: flex-start;
            gap: 8px;
            color: #59716e;
            background: #f7fbfa;
            font-size: .63rem;
            line-height: 1.5;
        }

        .privacy-strip i {
            color: var(--ca-primary-dark);
            font-size: .78rem;
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

            .date-chip {
                display: none;
            }
        }

        @media (max-width: 767.98px) {
            .page-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .class-meta {
                width: 100%;
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

            .summary-grid {
                grid-template-columns: 1fr;
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
                    Partisipasi Skrining
                </div>

                <div class="topbar-subtitle">
                    Ringkasan agregat partisipasi skrining kelas
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
                            Monitoring Skrining
                        </div>

                        <h1 class="page-title">
                            Partisipasi Skrining {{ $kelas->nama_kelas }}
                        </h1>

                        <p class="page-copy">
                            Pantau tingkat partisipasi skrining kelas dalam bentuk agregat. Identitas peserta, jawaban, skor, dan hasil skrining individual tidak ditampilkan.
                        </p>
                    </div>

                    <div class="class-meta">
                        <div class="class-meta-label">
                            Periode Data
                        </div>

                        <div class="class-meta-value">
                            {{ $tahunAjaran }} · {{ ucfirst($semester) }}
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
                                Siswa aktif di {{ $kelas->nama_kelas }}
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xl-3">
                        <div class="metric-card completed">
                            <div class="metric-top">
                                <div>
                                    <div class="metric-label">
                                        Sudah Mengisi
                                    </div>

                                    <div class="metric-value">
                                        {{ $sudahMengisi }}
                                    </div>
                                </div>

                                <span class="metric-icon">
                                    <i class="bi bi-check2-circle"></i>
                                </span>
                            </div>

                            <div class="metric-note">
                                Selesai pada periode terpilih
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xl-3">
                        <div class="metric-card pending">
                            <div class="metric-top">
                                <div>
                                    <div class="metric-label">
                                        Belum Mengisi
                                    </div>

                                    <div class="metric-value">
                                        {{ $belumMengisi }}
                                    </div>
                                </div>

                                <span class="metric-icon">
                                    <i class="bi bi-clock"></i>
                                </span>
                            </div>

                            <div class="metric-note">
                                Belum menyelesaikan pada periode terpilih
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xl-3">
                        <div class="metric-card participation">
                            <div class="metric-top">
                                <div>
                                    <div class="metric-label">
                                        Tingkat Partisipasi
                                    </div>

                                    <div class="metric-value">
                                        {{ $persentase }}%
                                    </div>
                                </div>

                                <span class="metric-icon">
                                    <i class="bi bi-clipboard2-check"></i>
                                </span>
                            </div>

                            <div class="metric-note">
                                {{ $sudahMengisi }} dari {{ $totalSiswa }} siswa
                            </div>
                        </div>
                    </div>
                </section>

                <section class="panel">
                    <div class="panel-header">
                        <h2 class="panel-title">
                            Ringkasan Partisipasi
                        </h2>

                        <p class="panel-copy">
                            Tingkat penyelesaian skrining pada {{ $periodeLabel }}.
                        </p>
                    </div>

                    <div class="screening-wrap">
                        <div class="screening-summary">
                            <div>
                                <div class="screening-value">
                                    {{ $persentase }}%
                                </div>

                                <div class="screening-caption">
                                    tingkat partisipasi kelas
                                </div>
                            </div>

                            <div class="screening-meta">
                                {{ $sudahMengisi }} / {{ $totalSiswa }} siswa
                            </div>
                        </div>

                        <div
                            class="progress"
                            role="progressbar"
                            aria-valuenow="{{ $persentase }}"
                            aria-valuemin="0"
                            aria-valuemax="100"
                        >
                            <div
                                class="progress-bar"
                                style="width: {{ min($persentase, 100) }}%"
                            ></div>
                        </div>

                        <div class="summary-grid">
                            <div class="summary-box">
                                <div class="summary-box-label">
                                    Sudah Mengisi
                                </div>

                                <div class="summary-box-value">
                                    {{ $sudahMengisi }}
                                </div>
                            </div>

                            <div class="summary-box">
                                <div class="summary-box-label">
                                    Belum Mengisi
                                </div>

                                <div class="summary-box-value">
                                    {{ $belumMengisi }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="privacy-strip">
                        <i class="bi bi-shield-lock"></i>

                        <span>
                            Wali Kelas hanya melihat jumlah partisipasi secara agregat. Identitas peserta, status individual, waktu penyelesaian, jawaban, skor, dan kategori hasil skrining tidak tersedia pada halaman ini.
                        </span>
                    </div>
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
