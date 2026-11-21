<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Notifikasi Guru BK | CurhatAman</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
        rel="stylesheet"
    >

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
            --ca-success: #027a48;
            --ca-success-soft: #ecf8f2;
            --ca-danger: #b42318;
            --ca-danger-soft: #fff1f0;
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
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
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
            min-height: 50px;
            margin-bottom: 28px;
            padding: 0 8px;
            display: flex;
            align-items: center;
            gap: 11px;
        }

        .brand-symbol {
            width: 40px;
            height: 40px;
            flex: 0 0 40px;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            background: var(--ca-primary);
            font-size: 17px;
        }

        .brand-name {
            display: block;
            color: var(--ca-primary);
            font-size: 17px;
            line-height: 1.15;
            font-weight: 760;
            letter-spacing: -.02em;
        }

        .brand-role {
            display: block;
            margin-top: 3px;
            color: var(--ca-muted);
            font-size: 11px;
            font-weight: 600;
        }

        .sidebar-section-label {
            margin: 0 10px 9px;
            color: var(--ca-muted-light);
            font-size: 10px;
            font-weight: 750;
            letter-spacing: .09em;
            text-transform: uppercase;
        }

        .sidebar-nav {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .sidebar-link {
            min-height: 42px;
            padding: 9px 11px;
            border-radius: 9px;
            display: flex;
            align-items: center;
            gap: 11px;
            color: #475467;
            font-size: 13px;
            font-weight: 560;
            transition: background .15s ease, color .15s ease;
        }

        .sidebar-link i {
            width: 19px;
            color: #7b8795;
            font-size: 15px;
            text-align: center;
        }

        .sidebar-link:hover {
            color: var(--ca-primary-dark);
            background: #f4f9f8;
        }

        .sidebar-link:hover i {
            color: var(--ca-primary);
        }

        .sidebar-spacer {
            flex: 1;
        }

        .sidebar-account {
            margin-top: 24px;
            padding-top: 16px;
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
            font-size: 12.5px;
            font-weight: 560;
            text-align: left;
        }

        .logout-button:hover {
            background: var(--ca-danger-soft);
        }

        .topbar {
            grid-column: 2;
            min-width: 0;
            padding: 0 28px;
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
            color: var(--ca-text);
            font-size: 14px;
            font-weight: 700;
        }

        .topbar-subtitle {
            margin-top: 2px;
            color: var(--ca-muted);
            font-size: 11px;
        }
        .topbar-actions {
            display: flex !important;
            align-items: center !important;
            gap: 12px !important;
        }

        .date-chip {
            height: 38px !important;
            min-height: 38px !important;
            padding: 0 13px !important;
            border: 1px solid var(--ca-border) !important;
            border-radius: 9px !important;
            display: inline-flex !important;
            align-items: center !important;
            gap: 8px !important;
            color: #596579 !important;
            background: #ffffff !important;
            font-size: 12px !important;
            font-weight: 550 !important;
            white-space: nowrap !important;
        }

        .date-chip i {
            color: var(--ca-primary-dark) !important;
            font-size: 13px !important;
        }

        .account-trigger {
            height: 38px !important;
            min-height: 38px !important;
            padding: 0 4px !important;
            border: 0 !important;
            border-radius: 9px !important;
            display: inline-flex !important;
            align-items: center !important;
            gap: 10px !important;
            color: var(--ca-text) !important;
            background: transparent !important;
            text-align: left !important;
            text-decoration: none !important;
            transition: background .15s ease !important;
        }

        .account-trigger:hover {
            background: rgba(0, 0, 0, 0.03) !important;
            border-color: transparent !important;
        }

        .topbar-avatar {
            width: 30px !important;
            height: 30px !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            flex-shrink: 0 !important;
            border-radius: 50% !important;
            color: var(--ca-primary-dark) !important;
            background: #dcefeb !important;
            font-size: 12px !important;
            font-weight: 750 !important;
        }

        .account-copy {
            min-width: 0 !important;
            display: flex !important;
            flex-direction: column !important;
            justify-content: center !important;
        }

        .account-name {
            max-width: 120px !important;
            overflow: hidden !important;
            text-overflow: ellipsis !important;
            white-space: nowrap !important;
            color: var(--ca-text) !important;
            font-size: 12px !important;
            font-weight: 700 !important;
            line-height: 1.2 !important;
        }

        .account-role {
            margin-top: 1px !important;
            color: var(--ca-muted) !important;
            font-size: 10.5px !important;
            line-height: 1 !important;
        }

        .account-chevron {
            color: #98a2b3 !important;
            font-size: 10px !important;
            margin-left: 2px !important;
        }

        .account-trigger:hover .account-chevron,
        .account-trigger:focus-visible .account-chevron {
            color: var(--ca-primary);
            transform: translateX(2px);
        }

        .main-content {
            grid-column: 2;
            min-width: 0;
            display: flex;
            flex-direction: column;
        }

        .page-body {
            flex: 1;
            padding: 28px;
        }

        .content-shell {
            width: 100%;
            max-width: 1100px;
            margin: 0 auto;
        }

        .page-header {
            margin-bottom: 18px;
            padding: 20px 21px;
            border-radius: 12px;
            background: var(--ca-primary);
        }

        .page-kicker {
            margin-bottom: 5px;
            color: rgba(255, 255, 255, .72);
            font-size: 10px;
            font-weight: 760;
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        .page-title {
            margin: 0 0 6px;
            color: #ffffff;
            font-size: 25px;
            line-height: 1.2;
            font-weight: 760;
            letter-spacing: -.02em;
        }

        .page-copy {
            max-width: 720px;
            margin: 0;
            color: rgba(255, 255, 255, .82);
            font-size: 12px;
            line-height: 1.6;
        }

        .toolbar {
            margin-bottom: 14px;
            padding: 12px 14px;
            border: 1px solid var(--ca-border);
            border-radius: 11px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            background: #ffffff;
        }

        .filter-tabs {
            display: flex;
            gap: 7px;
            flex-wrap: wrap;
        }

        .filter-tab {
            min-height: 34px;
            padding: 7px 11px;
            border: 1px solid var(--ca-border);
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            color: #667085;
            background: #ffffff;
            font-size: 10.5px;
            font-weight: 650;
        }

        .filter-tab:hover {
            color: var(--ca-primary-dark);
            background: #f6fbfa;
            border-color: #cfe4e1;
        }

        .filter-tab.active {
            color: var(--ca-primary-dark);
            border-color: #b7dcd7;
            background: var(--ca-primary-soft);
        }

        .btn-read-all {
            min-height: 34px;
            padding: 7px 11px;
            border: 1px solid #cfe4e1;
            border-radius: 8px;
            color: var(--ca-primary-dark);
            background: #ffffff;
            font-size: 10.5px;
            font-weight: 650;
        }

        .btn-read-all:hover {
            background: var(--ca-primary-soft);
            border-color: #b7dcd7;
        }

        .notification-list {
            overflow: hidden;
            border: 1px solid var(--ca-border);
            border-top: 3px solid var(--ca-primary);
            border-radius: 12px;
            background: #ffffff;
        }

        .notification-item {
            position: relative;
            padding: 16px 18px;
            border-bottom: 1px solid var(--ca-line);
            display: grid;
            grid-template-columns: 34px minmax(0, 1fr) auto;
            gap: 13px;
            align-items: flex-start;
            background: #ffffff;
        }

        .notification-item:last-child {
            border-bottom: 0;
        }

        .notification-item.unread {
            background: #f7fbfa;
        }

        .notification-dot {
            width: 34px;
            height: 34px;
            border-radius: 9px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #f2f4f7;
        }

        .notification-dot::before {
            content: "";
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #c4cbd4;
        }

        .notification-item.unread .notification-dot {
            background: var(--ca-primary-soft);
        }

        .notification-item.unread .notification-dot::before {
            background: var(--ca-primary);
        }

        .notification-title {
            color: var(--ca-text);
            font-size: 11.5px;
            font-weight: 710;
        }

        .notification-message {
            margin-top: 4px;
            color: #667085;
            font-size: 10.8px;
            line-height: 1.55;
        }

        .notification-time {
            margin-top: 7px;
            color: var(--ca-muted-light);
            font-size: 9.8px;
        }

        .notification-action {
            min-width: 94px;
            padding-top: 2px;
            text-align: right;
        }

        .btn-read {
            min-height: 31px;
            padding: 0 9px;
            border: 1px solid #cfe4e1;
            border-radius: 8px;
            color: var(--ca-primary-dark);
            background: #ffffff;
            font-size: 10px;
            font-weight: 650;
        }

        .btn-read:hover {
            background: var(--ca-primary-soft);
            border-color: #b7dcd7;
        }

        .btn-open {
            min-height: 31px;
            padding: 0 10px;
            border: 1px solid var(--ca-primary);
            border-radius: 8px;
            color: #ffffff;
            background: var(--ca-primary);
            font-size: 10px;
            font-weight: 650;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            text-decoration: none;
            transition: all .15s ease;
        }

        .btn-open:hover {
            color: #ffffff;
            background: var(--ca-primary-dark);
            transform: translateY(-1px);
        }

        .read-label {
            min-height: 31px;
            display: inline-flex;
            align-items: center;
            color: var(--ca-muted-light);
            font-size: 10px;
        }

        .empty-state {
            padding: 50px 18px;
            color: var(--ca-muted);
            text-align: center;
            font-size: 11px;
        }

        .empty-state i {
            width: 42px;
            height: 42px;
            margin: 0 auto 10px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--ca-primary);
            background: var(--ca-primary-soft);
            font-size: 16px;
        }

        .pagination-wrap {
            margin-top: 14px;
        }

        .pagination {
            margin-bottom: 0;
        }

        .page-link {
            color: var(--ca-primary-dark);
            border-color: var(--ca-border);
            font-size: 11px;
        }

        .page-link:hover {
            color: var(--ca-primary-dark);
            background: var(--ca-primary-soft);
            border-color: #cfe4e1;
        }

        .page-item.active .page-link {
            color: #ffffff;
            background: var(--ca-primary);
            border-color: var(--ca-primary);
        }

        .page-footer {
            min-height: 62px;
            margin-top: 28px;
            padding: 0 18px;
            border-radius: 11px;
            display: flex;
            align-items: center;
            color: rgba(255, 255, 255, .78);
            background: var(--ca-primary-dark);
            font-size: 10.5px;
        }

        .page-footer > div {
            width: 100%;
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
        }

        @media (max-width: 575.98px) {
            .date-chip,
            .account-copy,
            .account-chevron {
                display: none !important;
            }

            .account-trigger {
                min-width: 0;
                width: 42px;
                min-height: 42px;
                padding: 3px;
            }

            .toolbar {
                align-items: stretch;
                flex-direction: column;
            }

            .btn-read-all {
                width: 100%;
            }

            .notification-item {
                grid-template-columns: 34px minmax(0, 1fr);
            }

            .notification-action {
                grid-column: 2;
                min-width: 0;
                padding-top: 2px;
                text-align: left;
            }

            .page-title {
                font-size: 22px;
            }
        }
    </style>
    @include('guru-bk.partials.styles')
</head>

<body>

@php
    $namaUser = ucwords($user->name);
    $inisial = strtoupper(substr($user->name, 0, 1));
@endphp

<div class="app-shell">

    @include('guru-bk.partials.sidebar')

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
                    Notifikasi
                </div>

                <div class="topbar-subtitle">
                    Daftar notifikasi aktivitas sistem.
                </div>
            </div>
        </div>

        <div class="topbar-actions">

            @include('guru-bk.partials.notification-bell')
            <div class="date-chip">
                <i class="bi bi-calendar3"></i>
                {{ now()->locale('id')->translatedFormat('d F Y') }}
            </div>

            <a
                href="{{ route('guru-bk.profil.index') }}"
                class="account-trigger"
            >
                <span class="topbar-avatar">
                    {{ $inisial }}
                </span>

                <span class="account-copy">
                    <span class="account-name d-block">
                        {{ $namaUser }}
                    </span>

                    <span class="account-role d-block">
                        Guru BK
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
                            Pusat Pemberitahuan
                        </div>

                        <h1 class="page-title">
                            Semua Notifikasi
                        </h1>

                        <p class="page-copy">
                            Daftar notifikasi aktivitas sistem.
                        </p>
                    </div>
                </section>

                @if(session('success'))
                    <div class="alert alert-success py-2 small">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="toolbar">

                    <div class="filter-tabs">

                        <a
                            href="{{ route('guru-bk.notifikasi.index', ['filter' => 'semua']) }}"
                            class="filter-tab {{ $filter === 'semua' ? 'active' : '' }}"
                        >
                            Semua
                        </a>

                        <a
                            href="{{ route('guru-bk.notifikasi.index', ['filter' => 'belum']) }}"
                            class="filter-tab {{ $filter === 'belum' ? 'active' : '' }}"
                        >
                            Belum Dibaca
                            @if($summary['belum'] > 0)
                                <span class="ms-1">({{ $summary['belum'] }})</span>
                            @endif
                        </a>

                        <a
                            href="{{ route('guru-bk.notifikasi.index', ['filter' => 'dibaca']) }}"
                            class="filter-tab {{ $filter === 'dibaca' ? 'active' : '' }}"
                        >
                            Sudah Dibaca
                        </a>

                    </div>

                    @if($summary['belum'] > 0)

                        <form
                            method="POST"
                            action="{{ route('guru-bk.notifikasi.read-all') }}"
                            class="m-0"
                        >
                            @csrf
                            @method('PATCH')

                            <button
                                type="submit"
                                class="btn-read-all"
                            >
                                <i class="bi bi-check2-all me-1"></i>
                                Tandai Semua Dibaca
                            </button>
                        </form>

                    @endif

                </div>

                <section class="notification-list">

                    @forelse($notifikasi as $item)

                        <article
                            class="notification-item {{ is_null($item->read_at) ? 'unread' : '' }}"
                        >

                            <span class="notification-dot"></span>

                            <div>

                                <div class="notification-title">
                                    {{ $item->judul }}
                                </div>

                                <div class="notification-message">
                                    {{ $item->pesan }}
                                </div>

                                <div class="notification-time">
                                    {{ $item->created_at->locale('id')->diffForHumans() }}
                                    ·
                                    {{ $item->created_at->locale('id')->translatedFormat('d M Y, H:i') }}
                                </div>

                            </div>

                            <div class="notification-action d-flex align-items-center justify-content-end gap-2 flex-wrap">

                                @php
                                    $targetUrl = null;
                                    $targetLabel = null;
                                    $waNotifUrl = null;
                                    if ($item->referensi_tipe === 'laporan_kasus' && $item->referensi_id) {
                                        $targetUrl = route('guru-bk.laporan.show', $item->referensi_id);
                                        $targetLabel = 'Buka Kasus';

                                        if (!empty($laporanSiswaMap[$item->referensi_id])) {
                                            $infoWa = $laporanSiswaMap[$item->referensi_id];
                                            $waText = "Halo {$infoWa['nama_siswa']}, terkait laporan kamu ({$infoWa['kode_laporan']}) di layanan CurhatAman:\n\n"
                                                . "{$item->pesan}\n\n"
                                                . "Terima kasih — Guru BK ({$user->name})";
                                            $waNotifUrl = 'https://wa.me/' . $infoWa['phone'] . '?text=' . rawurlencode($waText);
                                        }
                                    } elseif ($item->referensi_tipe === 'permintaan_bantuan' && $item->referensi_id) {
                                        $targetUrl = route('guru-bk.bantuan.show', $item->referensi_id);
                                        $targetLabel = 'Buka Bantuan';
                                    } elseif ($item->referensi_tipe === 'catatan_konseling' && $item->referensi_id) {
                                        $targetUrl = route('guru-bk.catatan-konseling.show', $item->referensi_id);
                                        $targetLabel = 'Buka Sesi';
                                    }
                                @endphp

                                @if($waNotifUrl && $item->tipe === 'arsip_tindak_lanjut')
                                    <a href="{{ $waNotifUrl }}" target="_blank" rel="noopener noreferrer" class="btn-open">
                                        <i class="bi bi-whatsapp"></i>
                                        Hubungi Siswa
                                    </a>
                                @endif

                                @if($targetUrl)
                                    <a href="{{ $targetUrl }}" class="btn-open">
                                        <i class="bi bi-box-arrow-up-right"></i>
                                        {{ $targetLabel }}
                                    </a>
                                @endif

                                @if(is_null($item->read_at))

                                    <form
                                        method="POST"
                                        action="{{ route('guru-bk.notifikasi.read', $item) }}"
                                        class="m-0"
                                    >
                                        @csrf
                                        @method('PATCH')

                                        <button
                                            type="submit"
                                            class="btn-read"
                                        >
                                            Tandai dibaca
                                        </button>
                                    </form>

                                @else

                                    <span class="read-label">
                                        <i class="bi bi-check2 me-1"></i>
                                        Dibaca
                                    </span>

                                @endif

                            </div>

                        </article>

                    @empty

                        <div class="empty-state">
                            <i class="bi bi-bell-slash"></i>
                            Belum ada notifikasi.
                        </div>

                    @endforelse

                </section>

                @if($notifikasi->hasPages())
                    <div class="pagination-wrap">
                        {{ $notifikasi->links() }}
                    </div>
                @endif

                <footer class="page-footer">
                    <div class="d-flex flex-column flex-md-row justify-content-between gap-2">
                        <span>© {{ date('Y') }} CurhatAman</span>
                        <span>Portal Guru BK · Pemberitahuan aktivitas pendampingan</span>
                    </div>
                </footer>

            </div>

        </div>

    </main>

</div>

<div class="sidebar-overlay" id="sidebarOverlay"></div>

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
></script>

<script>
    const sidebar = document.getElementById('bkSidebar');
    const openSidebarButton = document.getElementById('openSidebarButton');
    const sidebarOverlay = document.getElementById('sidebarOverlay');

    function openSidebar() {
        sidebar?.classList.add('show');
        sidebarOverlay?.classList.add('show');
    }

    function closeSidebar() {
        sidebar?.classList.remove('show');
        sidebarOverlay?.classList.remove('show');
    }

    openSidebarButton?.addEventListener('click', openSidebar);
    sidebarOverlay?.addEventListener('click', closeSidebar);

    window.addEventListener('resize', function () {
        if (window.innerWidth >= 992) {
            closeSidebar();
        }
    });
</script>

</body>
</html>


