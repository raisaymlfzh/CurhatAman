<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Laporan Kasus - Guru BK - CurhatAman</title>

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
            --ca-danger: #b42318;
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
            display: flex;
            flex-direction: column;
            padding: 18px 14px;
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
            color: var(--ca-danger);
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

        .metric-card {
            position: relative;
            height: 100%;
            padding: 17px;
            border: 1px solid var(--ca-border);
            border-top: 3px solid #cfd8d8;
            border-radius: 11px;
            background: var(--ca-surface);
        }

        .metric-card.total {
            border-top-color: var(--ca-primary);
        }

        .metric-card.new {
            border-top-color: #4f8fbf;
        }

        .metric-card.processing {
            border-top-color: #e6a33b;
        }

        .metric-card.escalated {
            border-top-color: #d85d55;
        }

        .metric-label {
            color: #596579;
            font-size: .73rem;
            font-weight: 610;
        }

        .metric-number {
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
            color: var(--ca-primary-dark);
            background: var(--ca-primary-soft);
            font-size: .82rem;
        }

        .metric-card.total .metric-icon {
            color: #ffffff;
            background: var(--ca-primary);
        }

        .metric-card.new .metric-icon {
            color: #2d6f9f;
            background: #eef6fb;
        }

        .metric-card.processing .metric-icon {
            color: #a85f00;
            background: #fff5e7;
        }

        .metric-card.escalated .metric-icon {
            color: #b42318;
            background: #fff0ee;
        }

        .filter-card,
        .export-bar,
        .content-card {
            border: 1px solid var(--ca-border);
            border-radius: 11px;
            background: #ffffff;
        }

        .filter-card {
            margin-bottom: 16px;
            padding: 17px;
        }

        .period-summary {
            min-height: 42px;
            padding: 9px 11px;
            border: 1px solid #cfe3e0;
            border-radius: 9px;
            display: flex;
            align-items: center;
            gap: 9px;
            color: #526c69;
            background: #f7fbfa;
            font-size: .7rem;
            line-height: 1.45;
        }

        .period-summary-icon {
            width: 28px;
            height: 28px;
            border-radius: 7px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            color: var(--ca-primary-dark);
            background: var(--ca-primary-soft);
            font-size: .74rem;
        }

        .period-summary strong {
            color: var(--ca-primary-dark);
            font-weight: 680;
        }

        .form-label {
            margin-bottom: 6px;
            color: #475467;
            font-size: .69rem;
            font-weight: 610;
        }

        .form-control,
        .form-select {
            min-height: 42px;
            border: 1px solid var(--ca-border);
            border-radius: 9px;
            color: var(--ca-text);
            background-color: #ffffff;
            font-size: .76rem;
            box-shadow: none;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: rgba(15, 138, 131, .55);
            box-shadow: 0 0 0 .2rem rgba(15, 138, 131, .08);
        }

        .btn-filter,
        .btn-reset,
        .btn-export {
            min-height: 42px;
            padding: 0 13px;
            border-radius: 9px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            font-size: .74rem;
            font-weight: 620;
        }

        .btn-filter {
            border: 1px solid var(--ca-primary);
            color: #ffffff;
            background: var(--ca-primary);
        }

        .btn-filter:hover,
        .btn-filter:focus {
            color: #ffffff;
            background: var(--ca-primary-dark);
            border-color: var(--ca-primary-dark);
        }

        .btn-reset {
            border: 1px solid var(--ca-border);
            color: #475467;
            background: #ffffff;
        }

        .btn-reset:hover,
        .btn-reset:focus {
            color: var(--ca-primary-dark);
            background: var(--ca-primary-soft);
            border-color: #cfe3e0;
        }

        .export-bar {
            margin-bottom: 16px;
            padding: 14px 16px;
            display: flex;
            align-items: end;
            justify-content: space-between;
            gap: 14px;
            flex-wrap: wrap;
            border-left: 3px solid var(--ca-primary);
        }

        .export-scope {
            min-width: 240px;
        }

        .export-scope-note {
            margin-top: 5px;
            color: var(--ca-muted);
            font-size: .66rem;
            line-height: 1.45;
        }

        .export-actions {
            display: flex;
            justify-content: flex-end;
            gap: 8px;
            flex-wrap: wrap;
            margin-bottom: 0;
        }

        .btn-export {
            background: #ffffff;
        }

        .btn-export.excel {
            border: 1px solid #b9dec9;
            color: #027a48;
            background: #f7fcf9;
        }

        .btn-export.excel:hover {
            color: #026b3f;
            background: #eef9f3;
        }

        .btn-export.pdf {
            border: 1px solid #ecc5c1;
            color: #b42318;
            background: #fff8f7;
        }

        .btn-export.pdf:hover {
            color: #912018;
            background: #fff1ef;
        }

        .content-card {
            overflow: hidden;
        }

        .content-card-header {
            min-height: 64px;
            padding: 14px 16px;
            border-bottom: 1px solid var(--ca-line);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
        }

        .content-title {
            margin-bottom: 2px;
            color: var(--ca-text);
            font-size: .82rem;
            font-weight: 680;
        }

        .content-subtitle,
        .result-count {
            color: var(--ca-muted);
            font-size: .69rem;
        }

        .result-count {
            padding: 5px 8px;
            border-radius: 999px;
            background: var(--ca-primary-soft);
            color: var(--ca-primary-dark);
            font-weight: 620;
            white-space: nowrap;
        }

        .report-table {
            margin-bottom: 0;
        }

        .report-table thead th {
            padding: 10px 14px;
            border-bottom: 1px solid var(--ca-line);
            color: #6c7a78;
            background: #f4faf9;
            font-size: .63rem;
            font-weight: 720;
            letter-spacing: .045em;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .report-table tbody td {
            padding: 12px 14px;
            border-color: var(--ca-line);
            color: #475467;
            font-size: .72rem;
            vertical-align: middle;
        }

        .report-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .report-table tbody tr:hover td {
            background: #fcfefe;
        }

        .month-group-row td {
            padding: 9px 14px !important;
            border-top: 1px solid #dce9e7;
            border-bottom: 1px solid #dce9e7 !important;
            color: var(--ca-primary-dark) !important;
            background: #f5faf9 !important;
            font-size: .68rem !important;
            font-weight: 700;
        }

        .month-group-row i {
            margin-right: 6px;
            color: var(--ca-primary);
        }

        .report-code {
            color: var(--ca-text);
            font-size: .72rem;
            font-weight: 680;
        }

        .student-name {
            color: var(--ca-text);
            font-size: .73rem;
            font-weight: 640;
        }

        .student-meta,
        .privacy-mark {
            color: var(--ca-muted);
            font-size: .64rem;
        }

        .student-meta {
            margin-top: 2px;
        }

        .privacy-mark {
            margin-top: 3px;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .status-badge {
            padding: 4px 7px;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            font-size: .65rem;
            font-weight: 660;
            white-space: nowrap;
        }

        .status-baru {
            color: #175cd3;
            background: #eff8ff;
        }

        .status-diproses {
            color: #b54708;
            background: #fffaeb;
        }

        .status-selesai {
            color: #027a48;
            background: #ecfdf3;
        }

        .status-dieskalasi {
            color: #b42318;
            background: #fef3f2;
        }

        .status-default {
            color: #475467;
            background: #f2f4f7;
        }

        .detail-link {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            color: var(--ca-primary-dark);
            font-size: .68rem;
            font-weight: 620;
        }

        .detail-link:hover {
            color: var(--ca-primary);
        }

        .empty-state {
            padding: 42px 18px;
            color: var(--ca-muted);
            text-align: center;
        }

        .empty-icon {
            width: 38px;
            height: 38px;
            margin-bottom: 10px;
            border-radius: 9px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: var(--ca-primary);
            background: var(--ca-primary-soft);
        }

        .pagination-wrap {
            padding: 14px 16px;
            border-top: 1px solid var(--ca-line);
        }

        .pagination {
            margin-bottom: 0;
        }

        .page-link {
            color: var(--ca-primary);
            font-size: .72rem;
        }

        .page-item.active .page-link {
            border-color: var(--ca-primary);
            background: var(--ca-primary);
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
        }

        @media (max-width: 767.98px) {
            .page-header {
                flex-direction: column;
                align-items: flex-start;
            }
        }

        @media (max-width: 575.98px) {
            .export-bar {
                align-items: stretch;
            }

            .export-scope,
            .export-actions {
                width: 100%;
                min-width: 0;
            }

            .export-actions {
                justify-content: flex-start;
            }

            .date-chip {
                display: none;
            }

            .account-trigger {
                min-width: auto;
                padding: 5px;
            }

            .account-copy,
            .account-chevron {
                display: none;
            }
        }
    </style>
    @include('guru-bk.partials.styles')
</head>

<body>

@php
    $namaUser = ucwords($user->name);
    $inisial = strtoupper(substr($user->name, 0, 1));

    $cakupanExport = request('cakupan', 'kasus_saya');

    if (! in_array($cakupanExport, ['kasus_saya', 'semua_kasus'], true)) {
        $cakupanExport = 'kasus_saya';
    }
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
                    Laporan Kasus
                </div>

                <div class="topbar-subtitle">
                    Kelola laporan kasus siswa.
                </div>

            </div>

        </div>

        <div class="topbar-actions">

            @include('guru-bk.partials.notification-bell')
            <div class="date-chip">
                <i class="bi bi-calendar3"></i>
                {{ now()->translatedFormat('d F Y') }}
            </div>

                        <a
                href="{{ route('guru-bk.profil.index') }}"
                class="account-trigger"
                aria-label="Buka profil Guru BK"
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
                            Manajemen Kasus
                        </div>

                        <h1 class="page-title">
                            Laporan Kasus
                        </h1>

                        <p class="page-copy">Kelola laporan kasus siswa.</p>

                    </div>

                </section>

                
                <section class="row g-3 mb-4">

                    <div class="col-sm-6 col-xl-3">

                        <div class="metric-card total">

                            <div class="d-flex justify-content-between align-items-start">

                                <div>

                                    <div class="metric-label">
                                        Total Laporan
                                    </div>

                                    <div class="metric-number">
                                        {{ $ringkasan['total'] }}
                                    </div>

                                </div>

                                <span class="metric-icon">
                                    <i class="bi bi-file-earmark-text"></i>
                                </span>

                            </div>

                        </div>

                    </div>

                    <div class="col-sm-6 col-xl-3">

                        <div class="metric-card new">

                            <div class="d-flex justify-content-between align-items-start">

                                <div>

                                    <div class="metric-label">
                                        Baru
                                    </div>

                                    <div class="metric-number">
                                        {{ $ringkasan['baru'] }}
                                    </div>

                                </div>

                                <span class="metric-icon">
                                    <i class="bi bi-inbox"></i>
                                </span>

                            </div>

                        </div>

                    </div>

                    <div class="col-sm-6 col-xl-3">

                        <div class="metric-card processing">

                            <div class="d-flex justify-content-between align-items-start">

                                <div>

                                    <div class="metric-label">
                                        Diproses
                                    </div>

                                    <div class="metric-number">
                                        {{ $ringkasan['diproses'] }}
                                    </div>

                                </div>

                                <span class="metric-icon">
                                    <i class="bi bi-arrow-repeat"></i>
                                </span>

                            </div>

                        </div>

                    </div>

                    <div class="col-sm-6 col-xl-3">

                        <div class="metric-card escalated">

                            <div class="d-flex justify-content-between align-items-start">

                                <div>

                                    <div class="metric-label">
                                        Dieskalasi
                                    </div>

                                    <div class="metric-number">
                                        {{ $ringkasan['dieskalasi'] }}
                                    </div>

                                </div>

                                <span class="metric-icon">
                                    <i class="bi bi-exclamation-triangle"></i>
                                </span>

                            </div>

                        </div>

                    </div>

                </section>

                
                <form
                    method="GET"
                    action="{{ route('guru-bk.laporan.index') }}"
                    class="filter-card"
                >
                    <input
                        type="hidden"
                        name="cakupan"
                        id="cakupanFilterHidden"
                        value="{{ $cakupanExport }}"
                    >

                    <div class="row g-3 align-items-end mb-3">
                        <div class="col-sm-6 col-xl-3">
                            <label
                                for="tahun_ajaran"
                                class="form-label"
                            >
                                Tahun Ajaran
                            </label>

                            <select
                                class="form-select"
                                id="tahun_ajaran"
                                name="tahun_ajaran"
                            >
                                @foreach ($tahunAjaranOptions as $option)
                                    <option
                                        value="{{ $option }}"
                                        @selected($tahunAjaran === $option)
                                    >
                                        {{ $option }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-sm-6 col-xl-3">
                            <label
                                for="semester"
                                class="form-label"
                            >
                                Semester
                            </label>

                            <select
                                class="form-select"
                                id="semester"
                                name="semester"
                            >
                                <option
                                    value="ganjil"
                                    @selected($semester === 'ganjil')
                                >
                                    Ganjil
                                </option>

                                <option
                                    value="genap"
                                    @selected($semester === 'genap')
                                >
                                    Genap
                                </option>
                            </select>
                        </div>

                        <div class="col-sm-6 col-xl-3">
                            <label
                                for="bulan"
                                class="form-label"
                            >
                                Bulan
                            </label>

                            <select
                                class="form-select"
                                id="bulan"
                                name="bulan"
                            >
                                <option value="">
                                    Semua Bulan
                                </option>

                                @foreach ($bulanOptions as $nomorBulan => $namaBulan)
                                    <option
                                        value="{{ $nomorBulan }}"
                                        @selected(
                                            (string) $bulan
                                            === (string) $nomorBulan
                                        )
                                    >
                                        {{ $namaBulan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-sm-6 col-xl-3">
                            <label
                                for="kelas_id"
                                class="form-label"
                            >
                                Kelas
                            </label>

                            <select
                                class="form-select"
                                id="kelas_id"
                                name="kelas_id"
                            >
                                <option value="">
                                    Semua Kelas
                                </option>

                                @foreach ($kelasOptions as $kelas)
                                    <option
                                        value="{{ $kelas->id }}"
                                        @selected(
                                            (string) $kelasId
                                            === (string) $kelas->id
                                        )
                                    >
                                        {{ $kelas->nama_kelas }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row g-3 align-items-end">
                        <div class="col-lg-4">
                            <label
                                for="q"
                                class="form-label"
                            >
                                Cari laporan
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                id="q"
                                name="q"
                                value="{{ $search }}"
                                placeholder="Kode laporan, nama siswa, atau NIS"
                            >
                        </div>

                        <div class="col-sm-6 col-lg-2">
                            <label
                                for="status"
                                class="form-label"
                            >
                                Status
                            </label>

                            <select
                                class="form-select"
                                id="status"
                                name="status"
                            >
                                <option value="">
                                    Semua Status
                                </option>

                                <option value="baru" @selected($status === 'baru')>
                                    Baru
                                </option>

                                <option value="diproses" @selected($status === 'diproses')>
                                    Diproses
                                </option>

                                <option value="selesai" @selected($status === 'selesai')>
                                    Selesai
                                </option>

                                <option value="dieskalasi" @selected($status === 'dieskalasi')>
                                    Dieskalasi
                                </option>
                            </select>
                        </div>

                        <div class="col-sm-6 col-lg-3">
                            <label
                                for="kategori"
                                class="form-label"
                            >
                                Kategori
                            </label>

                            <select
                                class="form-select"
                                id="kategori"
                                name="kategori"
                            >
                                <option value="">
                                    Semua Kategori
                                </option>

                                @foreach ($kategori as $item)
                                    <option
                                        value="{{ $item->id }}"
                                        @selected(
                                            (string) $kategoriId
                                            === (string) $item->id
                                        )
                                    >
                                        {{ $item->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-lg-3">
                            <div class="d-flex gap-2">
                                <button
                                    type="submit"
                                    class="btn-filter flex-grow-1"
                                >
                                    <i class="bi bi-search"></i>
                                    Terapkan
                                </button>

                                <a
                                    href="{{ route('guru-bk.laporan.index') }}"
                                    class="btn-reset"
                                    title="Kembali ke periode aktif"
                                >
                                    <i class="bi bi-arrow-counterclockwise"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="period-summary mt-3">
                        <span class="period-summary-icon">
                            <i class="bi bi-archive"></i>
                        </span>

                        <span>
                            Arsip
                            <strong>{{ $tahunAjaran }}</strong>
                            semester
                            <strong>{{ ucfirst($semester) }}</strong>

                            @if ($bulan !== '')
                                ·
                                <strong>
                                    {{ $bulanOptions[(int) $bulan] ?? '' }}
                                </strong>
                            @endif

                            @if ($kelasTerpilih)
                                · kelas
                                <strong>
                                    {{ $kelasTerpilih->nama_kelas }}
                                </strong>
                            @endif

                            . Data periode lama tetap tersimpan dan dapat dicari kembali.
                        </span>
                    </div>
                </form>

                <div class="export-bar">

                    <div class="export-scope">

                        <label
                            for="cakupanExport"
                            class="form-label"
                        >
                            Cakupan Ekspor
                        </label>

                        <select
                            id="cakupanExport"
                            class="form-select"
                        >
                            <option
                                value="kasus_saya"
                                @selected($cakupanExport === 'kasus_saya')
                            >
                                Kasus Saya
                            </option>

                            <option
                                value="semua_kasus"
                                @selected($cakupanExport === 'semua_kasus')
                            >
                                Semua Data Laporan
                            </option>
                        </select>

                        <div class="export-scope-note">
                            Kasus Saya hanya berisi laporan yang ditangani Guru BK
                            yang sedang login dan dapat memuat identitas siswa.
                            Semua Data Laporan dapat diekspor seluruh Guru BK,
                            termasuk kasus yang sudah diambil Guru BK lain, dalam
                            bentuk monitoring tanpa nama dan NIS siswa.
                        </div>

                    </div>

                    <div class="export-actions">

                        <a
                            id="exportExcelLink"
                            href="{{ route(
                                'guru-bk.laporan.excel',
                                [
                                    'tahun_ajaran' => $tahunAjaran,
                                    'semester' => $semester,
                                    'bulan' => $bulan,
                                    'kelas_id' => $kelasId,
                                    'q' => $search,
                                    'status' => $status,
                                    'kategori' => $kategoriId,
                                    'cakupan' => $cakupanExport,
                                ]
                            ) }}"
                            class="btn-export excel"
                        >
                            <i class="bi bi-file-earmark-spreadsheet"></i>
                            Export Excel
                        </a>

                        <a
                            id="exportPdfLink"
                            href="{{ route(
                                'guru-bk.laporan.pdf',
                                [
                                    'tahun_ajaran' => $tahunAjaran,
                                    'semester' => $semester,
                                    'bulan' => $bulan,
                                    'kelas_id' => $kelasId,
                                    'q' => $search,
                                    'status' => $status,
                                    'kategori' => $kategoriId,
                                    'cakupan' => $cakupanExport,
                                ]
                            ) }}"
                            class="btn-export pdf"
                        >
                            <i class="bi bi-file-earmark-pdf"></i>
                            Export PDF
                        </a>

                    </div>

                </div>

                
                <section class="content-card">

                    <div class="content-card-header">

                        <div>

                            <div class="content-title">
                                Daftar Laporan
                            </div>

                            <div class="content-subtitle">
                                @if ($cakupanExport === 'kasus_saya')
                                    Menampilkan laporan yang menjadi tanggung jawab Guru BK ini
                                @else
                                    Menampilkan seluruh laporan masuk beserta status penanggung jawabnya
                                @endif
                            </div>

                        </div>

                        <div class="result-count">
                            {{ $laporan->total() }} laporan
                        </div>

                    </div>

                    @if ($laporan->isEmpty())

                        <div class="empty-state">

                            <div class="empty-icon">
                                <i class="bi bi-search"></i>
                            </div>

                            <div class="fw-semibold mb-1">
                                Laporan Tidak Ditemukan
                            </div>

                            <div class="small">
                                Tidak ada laporan yang sesuai dengan periode,
                                bulan, kelas, atau filter yang dipilih.
                                Coba ubah filter untuk melihat arsip lainnya.
                            </div>

                        </div>

                    @else

                        <div class="table-responsive">

                            <table class="table report-table align-middle">

                                <thead>
                                    <tr>
                                        <th>Laporan</th>
                                        <th>Pelapor</th>
                                        <th>Kategori</th>
                                        <th>Kejadian</th>
                                        <th>Status</th>
                                        <th>Masuk</th>
                                        <th>Penanggung Jawab</th>
                                        <th></th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @php
                                        $bulanDaftarAktif = null;
                                    @endphp

                                    @foreach ($laporan as $item)

                                        @php
                                            $tanggalMasukItem = \Carbon\Carbon::parse(
                                                $item->submitted_at
                                                ?? $item->created_at
                                            );

                                            $bulanDaftarKey = $tanggalMasukItem->format('Y-m');

                                            $bulanDaftarLabel = $tanggalMasukItem
                                                ->locale('id')
                                                ->translatedFormat('F Y');

                                            $statusClass = match($item->status_kasus) {
                                                'baru' => 'status-baru',
                                                'diproses' => 'status-diproses',
                                                'selesai' => 'status-selesai',
                                                'dieskalasi' => 'status-dieskalasi',
                                                default => 'status-default',
                                            };

                                            $statusLabel = match($item->status_kasus) {
                                                'baru' => 'Baru',
                                                'diproses' => 'Diproses',
                                                'selesai' => 'Selesai',
                                                'dieskalasi' => 'Dieskalasi',
                                                default => ucfirst($item->status_kasus),
                                            };
                                        @endphp

                                        @if ($bulanDaftarAktif !== $bulanDaftarKey)
                                            <tr class="month-group-row">
                                                <td colspan="8">
                                                    <i class="bi bi-calendar3"></i>
                                                    {{ $bulanDaftarLabel }}
                                                </td>
                                            </tr>

                                            @php
                                                $bulanDaftarAktif = $bulanDaftarKey;
                                            @endphp
                                        @endif

                                        <tr>

                                            <td>
                                                <div class="report-code">
                                                    {{ $item->kode_laporan }}
                                                </div>

                                                <div class="student-meta">
                                                    {{ $item->tahun_ajaran }}
                                                    ·
                                                    {{ ucfirst($item->semester) }}
                                                </div>
                                            </td>

                                            <td>

                                                <div class="student-name">
                                                    {{ $item->nama_siswa }}
                                                </div>

                                                <div class="student-meta">

                                                    @if ($item->nis)
                                                        NIS {{ $item->nis }}
                                                    @else
                                                        NIS belum tersedia
                                                    @endif

                                                    @if ($item->nama_kelas)
                                                        · {{ $item->nama_kelas }}
                                                    @endif

                                                </div>

                                                <div class="privacy-mark">

                                                    @if ($item->status_rahasia)

                                                        <i class="bi bi-shield-lock"></i>
                                                        Laporan rahasia

                                                    @else

                                                        <i class="bi bi-person"></i>
                                                        Identitas asli

                                                    @endif

                                                </div>

                                            </td>

                                            <td>
                                                {{ $item->nama_kategori }}
                                            </td>

                                            <td>
                                                {{ \Carbon\Carbon::parse($item->tanggal_kejadian)->format('d M Y') }}
                                            </td>

                                            <td>
                                                <span class="status-badge {{ $statusClass }}">
                                                    {{ $statusLabel }}
                                                </span>
                                            </td>

                                            <td>
                                                {{
                                                    \Carbon\Carbon::parse(
                                                        $item->submitted_at
                                                        ?? $item->created_at
                                                    )->format('d M Y')
                                                }}
                                            </td>

                                            <td>
                                                <div class="student-meta">
                                                    {{
                                                        $item->nama_bk_penanggung_jawab
                                                            ?: 'Belum ditangani'
                                                    }}
                                                </div>
                                            </td>

                                            <td class="text-end">

                                                <a
                                                    href="{{ route('guru-bk.laporan.show', $item->id) }}"
                                                    class="detail-link"
                                                >
                                                    Detail
                                                    <i class="bi bi-chevron-right"></i>
                                                </a>

                                            </td>

                                        </tr>

                                    @endforeach

                                </tbody>

                            </table>

                        </div>

                        @if ($laporan->hasPages())

                            <div class="pagination-wrap d-flex flex-column flex-sm-row align-items-center justify-content-between gap-3">
                                <div class="pagination-info text-muted" style="font-size: 12px;">
                                    Menampilkan <strong>{{ $laporan->firstItem() }}</strong> - <strong>{{ $laporan->lastItem() }}</strong> dari <strong>{{ $laporan->total() }}</strong> laporan
                                </div>

                                <ul class="pagination pagination-sm m-0">
                                    {{-- Tombol Sebelumnya (<) --}}
                                    @if ($laporan->onFirstPage())
                                        <li class="page-item disabled" aria-disabled="true">
                                            <span class="page-link" aria-label="Sebelumnya">
                                                <i class="bi bi-chevron-left"></i>
                                            </span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $laporan->previousPageUrl() }}" rel="prev" aria-label="Sebelumnya">
                                                <i class="bi bi-chevron-left"></i>
                                            </a>
                                        </li>
                                    @endif

                                    {{-- Nomor Halaman --}}
                                    @foreach ($laporan->getUrlRange(1, $laporan->lastPage()) as $page => $url)
                                        @if ($page == $laporan->currentPage())
                                            <li class="page-item active" aria-current="page">
                                                <span class="page-link">{{ $page }}</span>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                            </li>
                                        @endif
                                    @endforeach

                                    {{-- Tombol Selanjutnya (>) --}}
                                    @if ($laporan->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $laporan->nextPageUrl() }}" rel="next" aria-label="Berikutnya">
                                                <i class="bi bi-chevron-right"></i>
                                            </a>
                                        </li>
                                    @else
                                        <li class="page-item disabled" aria-disabled="true">
                                            <span class="page-link" aria-label="Berikutnya">
                                                <i class="bi bi-chevron-right"></i>
                                            </span>
                                        </li>
                                    @endif
                                </ul>
                            </div>

                        @endif

                    @endif

                </section>

                <footer class="page-footer">

                    <div
                        class="d-flex flex-column flex-md-row
                               justify-content-between gap-2"
                    >

                        <span>
                            © {{ date('Y') }} CurhatAman
                        </span>

                        <span>
                            Portal Guru BK · Data hanya digunakan sesuai kewenangan
                        </span>

                    </div>

                </footer>

            </div>

        </div>

    </main>

</div>

<div
    class="sidebar-overlay"
    id="sidebarOverlay"
></div>

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
></script>

<script>
    const sidebar = document.getElementById('bkSidebar');
    const openSidebarButton = document.getElementById('openSidebarButton');
    const sidebarOverlay = document.getElementById('sidebarOverlay');

    const cakupanExport = document.getElementById('cakupanExport');
    const cakupanFilterHidden = document.getElementById('cakupanFilterHidden');
    const exportExcelLink = document.getElementById('exportExcelLink');
    const exportPdfLink = document.getElementById('exportPdfLink');
    const semesterSelect = document.getElementById('semester');
    const bulanSelect = document.getElementById('bulan');

    const bulanSemester = {
        ganjil: [
            ['7', 'Juli'],
            ['8', 'Agustus'],
            ['9', 'September'],
            ['10', 'Oktober'],
            ['11', 'November'],
            ['12', 'Desember']
        ],
        genap: [
            ['1', 'Januari'],
            ['2', 'Februari'],
            ['3', 'Maret'],
            ['4', 'April'],
            ['5', 'Mei'],
            ['6', 'Juni']
        ]
    };

    function renderBulanSemester(semester, selectedValue = '') {
        if (! bulanSelect) {
            return;
        }

        const daftarBulan = bulanSemester[semester] ?? [];

        bulanSelect.innerHTML = '';

        const semuaBulan = document.createElement('option');
        semuaBulan.value = '';
        semuaBulan.textContent = 'Semua Bulan';
        bulanSelect.appendChild(semuaBulan);

        daftarBulan.forEach(function (item) {
            const option = document.createElement('option');
            option.value = item[0];
            option.textContent = item[1];
            option.selected = item[0] === selectedValue;
            bulanSelect.appendChild(option);
        });

        if (! daftarBulan.some(function (item) {
            return item[0] === selectedValue;
        })) {
            bulanSelect.value = '';
        }
    }

    if (semesterSelect && bulanSelect) {
        renderBulanSemester(
            semesterSelect.value,
            bulanSelect.value
        );

        semesterSelect.addEventListener('change', function () {
            renderBulanSemester(
                this.value,
                ''
            );
        });
    }

    function updateExportScope(value) {
        if (cakupanFilterHidden) {
            cakupanFilterHidden.value = value;
        }

        [exportExcelLink, exportPdfLink].forEach(function (link) {
            if (! link) {
                return;
            }

            const url = new URL(link.href);
            url.searchParams.set('cakupan', value);
            link.href = url.toString();
        });
    }

    if (cakupanExport) {
        cakupanExport.addEventListener('change', function () {
            updateExportScope(this.value);
            document.querySelector('form.filter-card').submit();
        });
    }

    function openSidebar() {
        sidebar.classList.add('show');
        sidebarOverlay.classList.add('show');
    }

    function closeSidebar() {
        sidebar.classList.remove('show');
        sidebarOverlay.classList.remove('show');
    }

    if (openSidebarButton) {
        openSidebarButton.addEventListener('click', openSidebar);
    }

    sidebarOverlay.addEventListener('click', closeSidebar);

    window.addEventListener('resize', function () {
        if (window.innerWidth >= 992) {
            closeSidebar();
        }
    });
</script>

</body>
</html>


