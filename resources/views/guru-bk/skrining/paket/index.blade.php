<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Skrining - CurhatAman</title>

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
            --ca-bg: #f6f8f9;
            --ca-border: #e3e9e9;
            --ca-line: #edf1f1;
            --ca-success: #027a48;
            --ca-success-soft: #ecf8f2;
            --ca-warning: #9a650f;
            --ca-warning-soft: #fff7e8;
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

        .sidebar-link:hover,
        .sidebar-link.active {
            color: var(--ca-primary-dark);
            background: var(--ca-primary-soft);
        }

        .sidebar-link.active {
            font-weight: 680;
        }

        .sidebar-link:hover i,
        .sidebar-link.active i {
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
            background: #ffffff;
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
            max-width: 1180px;
            margin: 0 auto;
        }

        .page-header {
            margin-bottom: 20px;
            padding: 20px 21px;
            border-radius: 12px;
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 20px;
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
            max-width: 740px;
            margin: 0;
            color: rgba(255, 255, 255, .82);
            font-size: 12px;
            line-height: 1.6;
        }

        .header-action {
            min-height: 38px;
            padding: 0 13px;
            border: 1px solid rgba(255, 255, 255, .42);
            border-radius: 9px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            color: #ffffff;
            background: rgba(255, 255, 255, .12);
            font-size: 10.5px;
            font-weight: 680;
            white-space: nowrap;
        }

        .header-action:hover {
            color: #ffffff;
            background: rgba(255, 255, 255, .20);
        }

        .note-box {
            margin-bottom: 18px;
            padding: 13px 15px;
            border: 1px solid #d4e8e5;
            border-radius: 10px;
            display: flex;
            align-items: flex-start;
            gap: 10px;
            color: #506663;
            background: #f5faf9;
            font-size: 10.8px;
            line-height: 1.58;
        }

        .note-box i,
        .note-box strong {
            color: var(--ca-primary-dark);
        }


        .category-panel {
            margin-bottom: 18px;
            padding: 16px 18px;
            border: 1px solid var(--ca-border);
            border-radius: 12px;
            background: #ffffff;
        }

        .category-heading {
            margin-bottom: 13px;
        }

        .category-title {
            color: var(--ca-text);
            font-size: 12.5px;
            font-weight: 710;
        }

        .category-copy {
            margin-top: 3px;
            color: var(--ca-muted);
            font-size: 10.5px;
            line-height: 1.5;
        }

        .category-grid {
            display: grid;
            grid-template-columns: repeat(5, minmax(0, 1fr));
            gap: 10px;
        }

        .category-item {
            min-width: 0;
            padding: 11px 12px;
            border: 1px solid var(--ca-line);
            border-radius: 9px;
            background: #fbfcfc;
        }

        .category-code {
            width: 28px;
            height: 28px;
            margin-bottom: 8px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: var(--ca-primary-dark);
            background: var(--ca-primary-soft);
            font-size: 10.5px;
            font-weight: 760;
        }

        .category-name {
            color: var(--ca-text);
            font-size: 10.8px;
            font-weight: 680;
            line-height: 1.35;
        }

        .category-desc {
            margin-top: 4px;
            color: var(--ca-muted);
            font-size: 9.7px;
            line-height: 1.45;
        }

        .summary-grid {
            margin-bottom: 18px;
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 14px;
        }

        .summary-card {
            min-height: 112px;
            padding: 18px;
            border: 1px solid var(--ca-border);
            border-top: 3px solid var(--ca-primary);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            background: #ffffff;
        }

        .summary-card:nth-child(2) {
            border-top-color: #35a36f;
        }

        .summary-card:nth-child(3) {
            border-top-color: #d99a2b;
        }

        .summary-value {
            color: var(--ca-text);
            font-size: 26px;
            line-height: 1;
            font-weight: 760;
        }

        .summary-label {
            margin-top: 7px;
            color: var(--ca-muted);
            font-size: 10.5px;
            font-weight: 620;
        }

        .summary-icon {
            width: 38px;
            height: 38px;
            flex: 0 0 38px;
            border-radius: 9px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: var(--ca-primary-dark);
            background: var(--ca-primary-soft);
            font-size: 15px;
        }

        .summary-card:nth-child(2) .summary-icon {
            color: var(--ca-success);
            background: var(--ca-success-soft);
        }

        .summary-card:nth-child(3) .summary-icon {
            color: var(--ca-warning);
            background: var(--ca-warning-soft);
        }

        .panel {
            overflow: hidden;
            border: 1px solid var(--ca-border);
            border-top: 3px solid var(--ca-primary);
            border-radius: 12px;
            background: #ffffff;
        }

        .toolbar {
            padding: 15px 18px;
            border-bottom: 1px solid var(--ca-line);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            background: #ffffff;
        }

        .toolbar-title {
            color: var(--ca-text);
            font-size: 13px;
            font-weight: 710;
        }

        .toolbar-subtitle {
            margin-top: 2px;
            color: var(--ca-muted);
            font-size: 10.5px;
        }

        .search-wrap {
            position: relative;
            width: min(100%, 330px);
        }

        .search-wrap i {
            position: absolute;
            top: 50%;
            left: 12px;
            transform: translateY(-50%);
            color: #98a2b3;
        }

        .search-input {
            width: 100%;
            min-height: 40px;
            padding: 8px 12px 8px 36px;
            border: 1px solid #d9e1e1;
            border-radius: 9px;
            outline: none;
            color: var(--ca-text);
            background: #ffffff;
            font-size: 11.5px;
        }

        .search-input:focus {
            border-color: rgba(15, 138, 131, .58);
            box-shadow: 0 0 0 .2rem rgba(15, 138, 131, .08);
        }

        .table-wrap {
            overflow-x: auto;
        }

        .data-table {
            width: 100%;
            min-width: 920px;
            margin: 0;
            border-collapse: collapse;
        }

        .data-table th {
            padding: 11px 14px;
            border-bottom: 1px solid #dfeceb;
            color: #546665;
            background: #f4faf9;
            font-size: 9.5px;
            font-weight: 760;
            letter-spacing: .04em;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .data-table td {
            padding: 13px 14px;
            border-bottom: 1px solid var(--ca-line);
            color: #475467;
            background: #ffffff;
            font-size: 11px;
            vertical-align: middle;
        }

        .data-table tbody tr:hover td {
            background: #fbfdfd;
        }

        .data-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .package-name {
            margin-bottom: 3px;
            color: var(--ca-text);
            font-size: 11.5px;
            font-weight: 680;
        }

        .package-desc {
            max-width: 410px;
            color: var(--ca-muted);
            font-size: 10px;
            line-height: 1.45;
        }

        .badge-soft,
        .badge-draft {
            padding: 5px 9px;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 9.8px;
            font-weight: 700;
            white-space: nowrap;
        }

        .badge-soft {
            color: var(--ca-success);
            background: var(--ca-success-soft);
        }

        .badge-draft {
            color: var(--ca-warning);
            background: var(--ca-warning-soft);
        }

        .question-count {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: #475467;
            font-size: 10.5px;
            font-weight: 620;
        }

        .action-link {
            min-height: 34px;
            padding: 0 10px;
            border: 1px solid #cfe4e1;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            color: var(--ca-primary-dark);
            background: #ffffff;
            font-size: 10px;
            font-weight: 650;
            white-space: nowrap;
        }

        .action-link:hover {
            color: #ffffff;
            background: var(--ca-primary);
            border-color: var(--ca-primary);
        }

        .empty-state {
            padding: 48px 20px;
            color: var(--ca-muted);
            text-align: center;
        }

        .empty-icon {
            width: 42px;
            height: 42px;
            margin: 0 auto 11px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--ca-primary);
            background: var(--ca-primary-soft);
            font-size: 16px;
        }

        .empty-title {
            margin-bottom: 4px;
            color: #344054;
            font-size: 12px;
            font-weight: 680;
        }

        .empty-copy {
            margin-bottom: 15px;
            font-size: 10.5px;
        }

        .empty-action {
            min-height: 36px;
            padding: 0 11px;
            border: 1px solid var(--ca-primary);
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            color: #ffffff;
            background: var(--ca-primary);
            font-size: 10.5px;
            font-weight: 650;
        }

        .empty-action:hover {
            color: #ffffff;
            background: var(--ca-primary-dark);
            border-color: var(--ca-primary-dark);
        }

        .pagination-wrap {
            padding: 14px 18px;
            border-top: 1px solid var(--ca-line);
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


        @media (max-width: 1199.98px) {
            .category-grid {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }
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

            .page-body {
                padding: 22px 18px 30px;
            }
        }

        @media (max-width: 767.98px) {
            .page-header,
            .toolbar {
                align-items: stretch;
                flex-direction: column;
            }

            .header-action,
            .search-wrap {
                width: 100%;
            }

            .summary-grid {
                grid-template-columns: 1fr;
            }

            .category-grid {
                grid-template-columns: 1fr;
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
                <div class="topbar-title">Kelola Skrining</div>
                <div class="topbar-subtitle">Kelola paket skrining SDQ.</div>
            </div>
        </div>

        <div class="topbar-actions">
            @include('guru-bk.partials.notification-bell')
            <div class="date-chip">
                <i class="bi bi-calendar3"></i>
                {{ now()->locale('id')->translatedFormat('d F Y') }}
            </div>

            <a href="{{ route('guru-bk.profil.index') }}" class="account-trigger">
                <span class="topbar-avatar">{{ $inisial }}</span>

                <span class="account-copy">
                    <span class="account-name d-block">{{ $namaUser }}</span>
                    <span class="account-role d-block">Guru BK</span>
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
                        <div class="page-kicker">Manajemen Instrumen</div>

                        <h1 class="page-title">
                            Paket Skrining
                        </h1>

                        <p class="page-copy">
                            Kelola paket skrining SDQ.
                        </p>
                    </div>

                    @if (!$paketSdq)
                        <a
                            href="{{ route('guru-bk.skrining.paket.create') }}"
                            class="header-action"
                        >
                            <i class="bi bi-plus-lg"></i>
                            Buat Instrumen SDQ
                        </a>
                    @endif
                </section>

                @if (session('success'))
                    <div class="alert alert-success mb-3">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="note-box">
                    <i class="bi bi-info-circle"></i>

                    <div>
                        <strong>SDQ merupakan instrumen bersama.</strong>
                        Setelah 25 butir SDQ dimasukkan dan diaktifkan, seluruh Guru BK menggunakan instrumen yang sama.
                        Guru BK lain tidak perlu membuat atau memasukkan ulang pertanyaan.
                    </div>
                </div>

                <section class="category-panel">
                    <div class="category-heading">
                        <div class="category-title">Kategori Pertanyaan SDQ</div>
                        <div class="category-copy">
                            Kode kategori digunakan pada daftar pernyataan agar tabel tetap ringkas. Penjelasannya dapat dilihat di sini.
                        </div>
                    </div>

                    <div class="category-grid">
                        <div class="category-item">
                            <span class="category-code">E</span>
                            <div class="category-name">Emotional Symptoms</div>
                            <div class="category-desc">
                                Menggambarkan aspek gejala emosional seperti rasa khawatir, sedih, takut, atau keluhan emosional lainnya.
                            </div>
                        </div>

                        <div class="category-item">
                            <span class="category-code">C</span>
                            <div class="category-name">Conduct Problems</div>
                            <div class="category-desc">
                                Menggambarkan aspek perilaku atau masalah tingkah laku yang muncul dalam keseharian siswa.
                            </div>
                        </div>

                        <div class="category-item">
                            <span class="category-code">H</span>
                            <div class="category-name">Hyperactivity</div>
                            <div class="category-desc">
                                Menggambarkan aspek hiperaktivitas, perhatian, dan kemampuan mengendalikan aktivitas atau impuls.
                            </div>
                        </div>

                        <div class="category-item">
                            <span class="category-code">P</span>
                            <div class="category-name">Peer Problems</div>
                            <div class="category-desc">
                                Menggambarkan aspek hubungan siswa dengan teman sebaya dan kesulitan dalam interaksi sosial.
                            </div>
                        </div>

                        <div class="category-item">
                            <span class="category-code">Pro</span>
                            <div class="category-name">Prosocial</div>
                            <div class="category-desc">
                                Menggambarkan perilaku prososial seperti kepedulian, empati, membantu, dan mempertimbangkan orang lain.
                            </div>
                        </div>
                    </div>
                </section>

                <section class="summary-grid">
                    <div class="summary-card">
                        <div>
                            <div class="summary-value">
                                {{ $summary['total'] }}
                            </div>

                            <div class="summary-label">
                                Total Paket
                            </div>
                        </div>

                        <span class="summary-icon">
                            <i class="bi bi-collection"></i>
                        </span>
                    </div>

                    <div class="summary-card">
                        <div>
                            <div class="summary-value">
                                {{ $summary['aktif'] }}
                            </div>

                            <div class="summary-label">
                                Paket Aktif
                            </div>
                        </div>

                        <span class="summary-icon">
                            <i class="bi bi-check2-circle"></i>
                        </span>
                    </div>

                    <div class="summary-card">
                        <div>
                            <div class="summary-value">
                                {{ $summary['draft'] }}
                            </div>

                            <div class="summary-label">
                                Draft
                            </div>
                        </div>

                        <span class="summary-icon">
                            <i class="bi bi-pencil-square"></i>
                        </span>
                    </div>
                </section>

                <section class="panel">

                    <div class="toolbar">
                        <div>
                            <div class="toolbar-title">Daftar Paket Skrining</div>
                            <div class="toolbar-subtitle">Kelola instrumen skrining SDQ.</div>
                        </div>

                        <form
                            method="GET"
                            action="{{ route('guru-bk.skrining.paket.index') }}"
                            class="search-wrap"
                        >
                            <i class="bi bi-search"></i>

                            <input
                                type="search"
                                name="q"
                                value="{{ $q }}"
                                class="search-input"
                                placeholder="Cari nama paket atau instrumen..."
                            >
                        </form>
                    </div>

                    @if ($paket->count())

                        <div class="table-wrap">
                            <table class="data-table">
                                <thead>
                                    <tr>
                                        <th>Paket</th>
                                        <th>Instrumen</th>
                                        <th>Pertanyaan</th>
                                        <th>Status</th>
                                        <th>Dibuat Oleh</th>
                                        <th>Dibuat</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($paket as $item)
                                        <tr>
                                            <td>
                                                <div class="package-name">
                                                    {{ $item->nama_paket }}
                                                </div>

                                                <div class="package-desc">
                                                    {{ $item->deskripsi ?: 'Belum ada deskripsi.' }}
                                                </div>

                                                <div class="mt-2">
                                                    <a
                                                        href="{{ route(
                                                            'guru-bk.skrining.paket.pertanyaan.index',
                                                            $item->id
                                                        ) }}"
                                                        class="action-link"
                                                    >
                                                        <i class="bi bi-list-check"></i>
                                                        Kelola Pertanyaan
                                                    </a>
                                                </div>
                                            </td>

                                            <td>
                                                {{ $item->jenis_instrumen }}
                                            </td>

                                            <td>
                                                <span class="question-count">
                                                    <i class="bi bi-list-ol"></i>
                                                    {{ $item->jumlah_pertanyaan }}
                                                </span>
                                            </td>

                                            <td>
                                                @if ($item->is_active)
                                                    <span class="badge-soft">
                                                        <i class="bi bi-check-circle"></i>
                                                        Aktif
                                                    </span>
                                                @else
                                                    <span class="badge-draft">
                                                        <i class="bi bi-pencil"></i>
                                                        Draft
                                                    </span>
                                                @endif
                                            </td>

                                            <td>
                                                {{ $item->dibuat_oleh ?? '-' }}
                                            </td>

                                            <td>
                                                {{ \Carbon\Carbon::parse(
                                                    $item->created_at
                                                )->locale('id')->translatedFormat(
                                                    'd M Y'
                                                ) }}
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        @if ($paket->hasPages())
                            <div class="pagination-wrap">
                                {{ $paket->links() }}
                            </div>
                        @endif

                    @else

                        <div class="empty-state">
                            <div class="empty-icon">
                                <i class="bi bi-clipboard2-plus"></i>
                            </div>

                            <div class="empty-title">
                                Instrumen SDQ Belum Tersedia
                            </div>

                            <div class="empty-copy">
                                Buat instrumen SDQ satu kali untuk digunakan bersama oleh seluruh Guru BK.
                            </div>

                            <a
                                href="{{ route('guru-bk.skrining.paket.create') }}"
                                class="empty-action"
                            >
                                <i class="bi bi-plus-lg"></i>
                                Buat Instrumen SDQ
                            </a>
                        </div>

                    @endif

                </section>

                <footer class="page-footer">
                    <div class="d-flex flex-column flex-md-row justify-content-between gap-2">
                        <span>© {{ date('Y') }} CurhatAman</span>
                        <span>Portal Guru BK · Kelola skrining</span>
                    </div>
                </footer>

            </div>
        </div>
    </main>
</div>

<div class="sidebar-overlay" id="sidebarOverlay"></div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

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



