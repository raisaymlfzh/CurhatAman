@php
    $errors = $errors ?? new \Illuminate\Support\ViewErrorBag();
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Kebijakan | CurhatAman</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
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
            --ca-danger-soft: #fff1f0;
            --ca-warning: #9a650f;
            --ca-warning-soft: #fff7e8;
            --ca-success: #027a48;
            --ca-success-soft: #ecf8f2;
            --ca-info: #2d6f9f;
            --ca-info-soft: #eef6fb;
            --sidebar-width: 272px;
            --topbar-height: 82px;
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

        .sidebar {
            position: fixed;
            inset: 0 auto 0 0;
            z-index: 1100;
            width: var(--sidebar-width);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background: #ffffff;
            border-right: 1px solid var(--ca-border);
        }

        .sidebar-brand {
            height: var(--topbar-height);
            padding: 0 24px;
            display: flex;
            align-items: center;
            gap: 12px;
            border-bottom: 1px solid var(--ca-border);
        }

        .brand-symbol {
            width: 42px;
            height: 42px;
            flex: 0 0 42px;
            border-radius: 11px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            background: var(--ca-primary);
            font-size: 18px;
        }

        .brand-name {
            display: block;
            color: var(--ca-primary);
            font-size: 18px;
            line-height: 1.1;
            font-weight: 760;
            letter-spacing: -.015em;
        }

        .brand-role {
            display: block;
            margin-top: 4px;
            color: var(--ca-muted);
            font-size: 12px;
        }

        .sidebar-section-label {
            padding: 25px 24px 10px;
            color: var(--ca-muted-light);
            font-size: 10px;
            font-weight: 750;
            letter-spacing: .10em;
            text-transform: uppercase;
        }

        .sidebar-nav {
            padding: 0 14px;
        }

        .sidebar-link {
            min-height: 46px;
            margin-bottom: 4px;
            padding: 0 14px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            gap: 12px;
            color: #475467;
            font-size: 13.5px;
            font-weight: 560;
            transition: background .15s ease, color .15s ease;
        }

        .sidebar-link i {
            width: 20px;
            color: #667085;
            font-size: 16px;
            text-align: center;
        }

        .sidebar-link:hover {
            color: var(--ca-primary-dark);
            background: #f5f8f8;
        }

        .sidebar-link:hover i {
            color: var(--ca-primary);
        }

        .sidebar-link.active {
            color: var(--ca-primary-dark);
            background: var(--ca-primary-soft);
            font-weight: 680;
        }

        .sidebar-link.active i {
            color: var(--ca-primary-dark);
        }

        .sidebar-spacer {
            flex: 1;
        }

        .sidebar-account {
            padding: 16px;
            border-top: 1px solid var(--ca-border);
        }

        .logout-button {
            width: 100%;
            min-height: 42px;
            padding: 0 13px;
            border: 0;
            border-radius: 9px;
            display: flex;
            align-items: center;
            gap: 11px;
            color: var(--ca-danger);
            background: transparent;
            font-size: 13px;
            font-weight: 560;
            text-align: left;
        }

        .logout-button:hover {
            background: var(--ca-danger-soft);
        }

        .topbar {
            position: fixed;
            top: 0;
            right: 0;
            left: var(--sidebar-width);
            z-index: 1000;
            height: var(--topbar-height);
            padding: 0 34px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
            background: rgba(255, 255, 255, .98);
            border-bottom: 1px solid var(--ca-border);
        }

        .topbar-left {
            min-width: 0;
            display: flex;
            align-items: center;
            gap: 12px;
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

        .topbar-title {
            color: var(--ca-text);
            font-size: 17px;
            line-height: 1.2;
            font-weight: 720;
        }

        .topbar-subtitle {
            margin-top: 4px;
            color: var(--ca-muted);
            font-size: 12px;
        }

        .topbar-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .date-chip {
            height: 38px;
            padding: 0 13px;
            border: 1px solid var(--ca-border);
            border-radius: 9px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--ca-muted);
            background: #ffffff;
            font-size: 12px;
            white-space: nowrap;
        }

        .date-chip i {
            color: var(--ca-primary-dark);
        }

        .account-trigger {
            min-width: 205px;
            height: 50px;
            padding: 5px 10px 5px 6px;
            border: 1px solid transparent;
            border-radius: 11px;
            display: flex;
            align-items: center;
            gap: 10px;
            color: inherit;
            background: transparent;
            cursor: pointer;
            transition: background .15s ease, border-color .15s ease, box-shadow .15s ease, color .15s ease;
        }

        .account-trigger:hover,
        .account-trigger:focus-visible {
            color: var(--ca-primary-dark);
            background: #f2faf8;
            border-color: #cfe6e2;
            outline: none;
        }

        .account-trigger:focus-visible {
            box-shadow: 0 0 0 3px rgba(15, 138, 131, .10);
        }

        .account-copy {
            min-width: 0;
            flex: 1;
        }

        .account-name {
            max-width: 135px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            color: var(--ca-text);
            font-size: 12.5px;
            font-weight: 680;
        }

        .account-role {
            color: var(--ca-muted-light);
            font-size: 10.5px;
        }

        .account-chevron {
            margin-left: auto;
            color: var(--ca-muted-light);
            font-size: 11px;
            transition: color .15s ease, transform .15s ease;
        }

        .account-trigger:hover .account-chevron,
        .account-trigger:focus-visible .account-chevron {
            color: var(--ca-primary);
            transform: translateX(2px);
        }

        .topbar-avatar {
            width: 36px;
            height: 36px;
            flex: 0 0 36px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: var(--ca-primary-dark);
            background: #dcefeb;
            font-size: 11.5px;
            font-weight: 760;
        }

        .main-content {
            min-height: 100vh;
            margin-left: var(--sidebar-width);
            padding-top: var(--topbar-height);
        }

        .page-body {
            padding: 30px 34px 38px;
        }

        .content-shell {
            width: 100%;
            max-width: 1240px;
            margin: 0 auto;
        }

        .page-header {
            margin-bottom: 22px;
            padding: 21px 22px;
            border-radius: 12px;
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 20px;
            background: var(--ca-primary);
        }

        .page-kicker {
            margin-bottom: 6px;
            color: rgba(255, 255, 255, .72);
            font-size: 10.5px;
            font-weight: 760;
            letter-spacing: .09em;
            text-transform: uppercase;
        }

        .page-title {
            margin: 0;
            color: #ffffff;
            font-size: 27px;
            font-weight: 760;
            letter-spacing: -.02em;
        }

        .page-copy {
            max-width: 780px;
            margin: 7px 0 0;
            color: rgba(255, 255, 255, .82);
            font-size: 12.5px;
            line-height: 1.65;
        }

        .privacy-badge {
            min-height: 36px;
            padding: 0 12px;
            border: 1px solid rgba(255, 255, 255, .42);
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            gap: 7px;
            color: #ffffff;
            background: rgba(255, 255, 255, .12);
            font-size: 10.5px;
            font-weight: 650;
            white-space: nowrap;
        }

        .alert-danger-ca {
            margin-bottom: 16px;
            padding: 12px 14px;
            border: 1px solid #f0c8c4;
            border-radius: 9px;
            color: var(--ca-danger);
            background: var(--ca-danger-soft);
            font-size: 11.5px;
        }

        .filter-card {
            margin-bottom: 16px;
            padding: 18px;
            border: 1px solid var(--ca-border);
            border-top: 3px solid var(--ca-primary);
            border-radius: 12px;
            display: grid;
            grid-template-columns: minmax(0, 1.15fr) minmax(0, .9fr) minmax(0, 1fr) minmax(0, 1fr) 200px;
            gap: 12px;
            align-items: start;
            background: #ffffff;
        }

        .filter-card > div:not(.filter-actions) {
            min-width: 0;
            display: flex;
            flex-direction: column;
        }

        .form-label {
            min-height: 18px;
            margin-bottom: 7px;
            display: flex;
            align-items: center;
            color: #475467;
            font-size: 10.5px;
            font-weight: 650;
            line-height: 1.2;
        }

        .form-control,
        .form-select {
            width: 100%;
            height: 42px;
            min-height: 42px;
            border: 1px solid #d9e1e1;
            border-radius: 9px;
            color: var(--ca-text);
            background-color: #ffffff;
            font-size: 12px;
            box-shadow: none;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: rgba(15, 138, 131, .55);
            box-shadow: 0 0 0 .2rem rgba(15, 138, 131, .08);
        }

        .filter-help {
            min-height: 30px;
            margin-top: 7px;
            color: var(--ca-muted-light);
            font-size: 9.8px;
            line-height: 1.45;
        }

        .filter-actions {
            width: 100%;
            min-width: 0;
            align-self: start;
            padding-top: 25px;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 8px;
            flex-wrap: nowrap;
        }

        .btn-primary-ca,
        .btn-outline-ca,
        .btn-export {
            min-height: 42px;
            padding: 0 14px;
            border-radius: 9px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            font-size: 11.5px;
            font-weight: 680;
            white-space: nowrap;
        }

        .btn-primary-ca {
            border: 1px solid var(--ca-primary);
            color: #ffffff;
            background: var(--ca-primary);
        }

        .btn-primary-ca:hover {
            color: #ffffff;
            background: var(--ca-primary-dark);
            border-color: var(--ca-primary-dark);
        }

        .btn-outline-ca {
            border: 1px solid var(--ca-border);
            color: #667085;
            background: #ffffff;
        }

        .btn-outline-ca:hover {
            color: var(--ca-primary-dark);
            background: var(--ca-primary-soft);
            border-color: #cfe4e1;
        }

        .period-summary {
            margin-bottom: 14px;
            padding: 11px 14px;
            border: 1px solid #d7e9e6;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            background: #f7fbfa;
        }

        .period-summary-copy {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #475467;
            font-size: 10.8px;
        }

        .period-summary-copy i {
            color: var(--ca-primary);
        }

        .period-chip {
            padding: 5px 9px;
            border-radius: 999px;
            color: var(--ca-primary-dark);
            background: var(--ca-primary-soft);
            font-size: 10px;
            font-weight: 700;
            white-space: nowrap;
        }

        .export-wrap {
            margin-bottom: 20px;
            display: flex;
            justify-content: flex-end;
            gap: 9px;
            flex-wrap: wrap;
        }

        .btn-export.pdf {
            border: 1px solid #f0c8c4;
            color: var(--ca-danger);
            background: #ffffff;
        }

        .btn-export.pdf:hover {
            background: var(--ca-danger-soft);
        }

        .btn-export.excel {
            border: 1px solid #cde8db;
            color: var(--ca-success);
            background: #ffffff;
        }

        .btn-export.excel:hover {
            background: var(--ca-success-soft);
        }

        .metric-card {
            height: 100%;
            min-height: 96px;
            padding: 17px 18px;
            border: 1px solid var(--ca-border);
            border-top: 3px solid #d6dddd;
            border-radius: 12px;
            background: #ffffff;
        }

        .metric-card.total {
            border-top-color: var(--ca-primary);
        }

        .metric-card.active {
            border-top-color: #d99a2b;
        }

        .metric-card.done {
            border-top-color: #35a36f;
        }

        .metric-card.escalated {
            border-top-color: var(--ca-danger);
        }

        .metric-card.stale {
            border-top-color: #c77720;
        }

        .metric-label {
            color: var(--ca-muted);
            font-size: 10.5px;
        }

        .metric-value {
            margin-top: 5px;
            color: var(--ca-text);
            font-size: 24px;
            font-weight: 760;
        }

        .screening-panel {
            margin-bottom: 20px;
            border: 1px solid var(--ca-border);
            border-top: 3px solid var(--ca-primary);
            border-radius: 12px;
            overflow: hidden;
            background: #ffffff;
        }

        .screening-panel-header {
            padding: 16px 18px;
            border-bottom: 1px solid var(--ca-line);
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 16px;
        }

        .screening-panel-title {
            margin: 0;
            color: var(--ca-text);
            font-size: 13.5px;
            font-weight: 720;
        }

        .screening-panel-copy {
            margin: 4px 0 0;
            color: var(--ca-muted);
            font-size: 10.5px;
            line-height: 1.5;
        }

        .screening-total {
            min-height: 32px;
            padding: 0 10px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: var(--ca-primary-dark);
            background: var(--ca-primary-soft);
            font-size: 10px;
            font-weight: 700;
            white-space: nowrap;
        }

        .screening-distribution {
            padding: 16px 18px;
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 12px;
        }

        .screening-result {
            min-width: 0;
            padding: 15px 16px;
            border: 1px solid var(--ca-border);
            border-top: 3px solid #d6dddd;
            border-radius: 10px;
            background: #ffffff;
        }

        .screening-result.normal {
            border-top-color: #35a36f;
        }

        .screening-result.ambang {
            border-top-color: #d99a2b;
        }

        .screening-result.abnormal {
            border-top-color: var(--ca-danger);
        }

        .screening-result-head {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 12px;
        }

        .screening-result-label {
            color: #475467;
            font-size: 10.5px;
            font-weight: 680;
        }

        .screening-result-value {
            margin-top: 6px;
            color: var(--ca-text);
            font-size: 24px;
            line-height: 1;
            font-weight: 760;
        }

        .screening-result-percent {
            min-width: 48px;
            padding: 5px 7px;
            border-radius: 7px;
            color: var(--ca-muted);
            background: #f3f5f5;
            font-size: 9.8px;
            font-weight: 700;
            text-align: center;
        }

        .screening-result.normal .screening-result-percent {
            color: var(--ca-success);
            background: var(--ca-success-soft);
        }

        .screening-result.ambang .screening-result-percent {
            color: var(--ca-warning);
            background: var(--ca-warning-soft);
        }

        .screening-result.abnormal .screening-result-percent {
            color: var(--ca-danger);
            background: var(--ca-danger-soft);
        }

        .screening-result-note {
            margin-top: 8px;
            color: var(--ca-muted-light);
            font-size: 9.8px;
            line-height: 1.45;
        }

        .screening-privacy {
            margin: 0 18px 16px;
            padding: 11px 12px;
            border: 1px solid #d9e8e6;
            border-radius: 9px;
            display: flex;
            align-items: flex-start;
            gap: 8px;
            color: var(--ca-muted);
            background: #f8fbfa;
            font-size: 10px;
            line-height: 1.55;
        }

        .screening-privacy i {
            margin-top: 1px;
            color: var(--ca-primary);
        }

        .panel {
            height: 100%;
            border: 1px solid var(--ca-border);
            border-top: 3px solid var(--ca-primary);
            border-radius: 12px;
            background: #ffffff;
            overflow: hidden;
        }

        .panel-header {
            padding: 16px 18px;
            border-bottom: 1px solid var(--ca-line);
            background: #ffffff;
        }

        .panel-title {
            margin: 0;
            color: var(--ca-text);
            font-size: 13.5px;
            font-weight: 720;
        }

        .panel-copy {
            margin: 4px 0 0;
            color: var(--ca-muted);
            font-size: 10.5px;
        }

        .data-table {
            width: 100%;
            margin: 0;
            border-collapse: collapse;
        }

        .data-table th {
            padding: 11px 14px;
            border-bottom: 1px solid #dfeceb;
            color: #546665;
            background: #f4faf9;
            font-size: 9.5px;
            font-weight: 720;
            text-transform: uppercase;
            letter-spacing: .04em;
            white-space: nowrap;
        }

        .data-table td {
            padding: 12px 14px;
            border-bottom: 1px solid var(--ca-line);
            color: #344054;
            background: #ffffff;
            font-size: 11px;
        }

        .data-table tbody tr:hover td {
            background: #fbfdfd;
        }

        .data-table tr:last-child td {
            border-bottom: 0;
        }

        .number {
            text-align: right;
            font-weight: 680;
        }

        .note-box {
            margin-top: 18px;
            padding: 13px 15px;
            border: 1px solid #d9e8e6;
            border-radius: 10px;
            display: flex;
            align-items: flex-start;
            gap: 9px;
            color: var(--ca-muted);
            background: #f8fbfa;
            font-size: 10.5px;
            line-height: 1.55;
        }

        .note-box i {
            margin-top: 1px;
            color: var(--ca-primary);
        }

        .page-footer {
            min-height: 64px;
            margin-top: 28px;
            padding: 0 18px;
            border-radius: 11px;
            display: flex;
            align-items: center;
            color: rgba(255, 255, 255, .78);
            background: var(--ca-primary-dark);
            font-size: 10.5px;
        }

        .sidebar-overlay {
            position: fixed;
            inset: 0;
            z-index: 1050;
            display: none;
            background: rgba(16, 24, 40, .32);
        }

        .sidebar-overlay.show {
            display: block;
        }

        @media (max-width: 1199.98px) {
            .filter-card {
                grid-template-columns: 1fr 1fr 1fr 1fr;
            }

            .filter-actions {
                grid-column: 1 / -1;
                padding-top: 0;
                justify-content: flex-end;
            }
        }

        @media (max-width: 991.98px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform .2s ease;
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .topbar {
                left: 0;
                padding: 0 20px;
            }

            .mobile-sidebar-button {
                display: inline-flex;
            }

            .main-content {
                margin-left: 0;
            }

            .page-body {
                padding: 24px 20px 32px;
            }

            .page-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .filter-card {
                grid-template-columns: 1fr 1fr;
            }

            .filter-actions {
                grid-column: 1 / -1;
                padding-top: 0;
                justify-content: flex-end;
            }
        }

        @media (max-width: 767.98px) {
            :root {
                --topbar-height: 74px;
            }

            .date-chip,
            .account-copy,
            .account-chevron {
                display: none !important;
            }

            .account-trigger {
                min-width: 0;
                width: 42px;
                height: 42px;
                padding: 3px;
            }

            .filter-card {
                grid-template-columns: 1fr;
            }

            .screening-panel-header {
                flex-direction: column;
            }

            .screening-distribution {
                grid-template-columns: 1fr;
            }

            .filter-actions {
                grid-column: auto;
                padding-top: 0;
                justify-content: flex-start;
            }

            .export-wrap {
                justify-content: flex-start;
            }

            .period-summary {
                align-items: flex-start;
                flex-direction: column;
            }

            .privacy-badge {
                white-space: normal;
            }
        }
    </style>
    @include('admin.partials.styles')
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

@include('admin.partials.sidebar')

<div class="sidebar-overlay" id="sidebarOverlay"></div>

<header class="topbar">

    <div class="topbar-left">

        <button type="button" class="mobile-sidebar-button" id="openSidebarButton" aria-label="Buka menu">
            <i class="bi bi-list"></i>
        </button>

        <div>
            <div class="topbar-title">
            Laporan Kebijakan
        </div>

        <div class="topbar-subtitle">
            Ringkasan agregat untuk evaluasi kebijakan sekolah
        </div>
    </div>

    </div>

    <div class="topbar-actions">

        @include('admin.partials.notification-bell')

        <div class="date-chip">
            <i class="bi bi-calendar3"></i>
            {{ now()->locale('id')->translatedFormat('d F Y') }}
        </div>

        <a
            href="{{ route('admin.profil.index') }}"
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
                    Wakil Kesiswaan / Admin
                </span>
            </span>

            <i class="bi bi-chevron-right account-chevron"></i>
        </a>

    </div>

</header>

<main class="main-content">

    <div class="page-body">
        <div class="content-shell">

            @if($errors->any())
                <div class="alert-danger-ca">
                    {{ $errors->first() }}
                </div>
            @endif

            <section class="page-header">

                <div>
                    <div class="page-kicker">
                        Evaluasi Sekolah
                    </div>

                    <h1 class="page-title">
                        Laporan Kebijakan
                    </h1>

                    <p class="page-copy">
                        Laporan ini menyajikan data agregat kasus, aktivitas
                        penanganan, dan distribusi hasil skrining untuk mendukung
                        evaluasi kebijakan sekolah. Identitas siswa, kronologi,
                        bukti, jawaban skrining, skor individual, dan isi catatan
                        tindak lanjut tidak disertakan.
                    </p>
                </div>

                <div class="privacy-badge">
                    <i class="bi bi-shield-check"></i>
                    Data agregat tanpa identitas siswa
                </div>

            </section>

            <form
                method="GET"
                action="{{ route('admin.laporan-kebijakan.index') }}"
                class="filter-card"
            >

                <div>
                    <label for="tahun_ajaran" class="form-label">
                        Tahun Ajaran
                    </label>

                    <select
                        name="tahun_ajaran"
                        id="tahun_ajaran"
                        class="form-select"
                    >
                        @foreach($tahunAjaranOptions as $tahunAjaranOption)
                            <option
                                value="{{ $tahunAjaranOption }}"
                                @selected($tahunAjaranInput === $tahunAjaranOption)
                            >
                                {{ $tahunAjaranOption }}
                            </option>
                        @endforeach
                    </select>

                    <div class="filter-help">
                        Periode lama tetap tersedia selama memiliki data laporan.
                    </div>
                </div>

                <div>
                    <label for="semester" class="form-label">
                        Semester
                    </label>

                    <select
                        name="semester"
                        id="semester"
                        class="form-select"
                    >
                        <option
                            value="ganjil"
                            @selected($semesterInput === 'ganjil')
                        >
                            Ganjil
                        </option>

                        <option
                            value="genap"
                            @selected($semesterInput === 'genap')
                        >
                            Genap
                        </option>
                    </select>

                    <div class="filter-help">
                        Pilih semester laporan yang ingin ditinjau.
                    </div>
                </div>

                <div>
                    <label for="dari" class="form-label">
                        Dari Tanggal
                    </label>

                    <input
                        type="date"
                        name="dari"
                        id="dari"
                        value="{{ $dariInput }}"
                        class="form-control"
                    >

                    <div class="filter-help">
                        Otomatis mengikuti awal semester.
                    </div>
                </div>

                <div>
                    <label for="sampai" class="form-label">
                        Sampai Tanggal
                    </label>

                    <input
                        type="date"
                        name="sampai"
                        id="sampai"
                        value="{{ $sampaiInput }}"
                        class="form-control"
                    >

                    <div class="filter-help">
                        Otomatis mengikuti akhir semester.
                    </div>
                </div>

                <div class="filter-actions">

                    <button
                        type="submit"
                        class="btn-primary-ca"
                    >
                        <i class="bi bi-funnel"></i>
                        Terapkan
                    </button>

                    <a
                        href="{{ route('admin.laporan-kebijakan.index') }}"
                        class="btn-outline-ca"
                    >
                        Reset
                    </a>

                </div>

            </form>

            <div class="period-summary">

                <div class="period-summary-copy">
                    <i class="bi bi-calendar-range"></i>

                    <span>
                        Menampilkan laporan agregat
                        <strong>{{ $tahunAjaranInput }}</strong>
                        semester
                        <strong>{{ ucfirst($semesterInput) }}</strong>
                        dari
                        {{ \Carbon\Carbon::parse($dariInput)->locale('id')->translatedFormat('d M Y') }}
                        sampai
                        {{ \Carbon\Carbon::parse($sampaiInput)->locale('id')->translatedFormat('d M Y') }}.
                    </span>
                </div>

                <span class="period-chip">
                    Arsip Semester
                </span>

            </div>

            <div class="export-wrap">

                <a
                    href="{{ route(
                        'admin.laporan-kebijakan.excel',
                        [
                            'tahun_ajaran' => $tahunAjaranInput,
                            'semester' => $semesterInput,
                            'dari' => $dariInput,
                            'sampai' => $sampaiInput
                        ]
                    ) }}"
                    class="btn-export excel"
                >
                    <i class="bi bi-file-earmark-spreadsheet"></i>
                    Export Excel
                </a>

                <a
                    href="{{ route(
                        'admin.laporan-kebijakan.pdf',
                        [
                            'tahun_ajaran' => $tahunAjaranInput,
                            'semester' => $semesterInput,
                            'dari' => $dariInput,
                            'sampai' => $sampaiInput
                        ]
                    ) }}"
                    class="btn-export pdf"
                >
                    <i class="bi bi-file-earmark-pdf"></i>
                    Export PDF
                </a>

            </div>

            <section class="row g-3 mb-4">

                <div class="col-6 col-xl">
                    <div class="metric-card total">
                        <div class="metric-label">Total Laporan</div>
                        <div class="metric-value">{{ $ringkasan['total'] }}</div>
                    </div>
                </div>

                <div class="col-6 col-xl">
                    <div class="metric-card active">
                        <div class="metric-label">Kasus Aktif</div>
                        <div class="metric-value">{{ $ringkasan['aktif'] }}</div>
                    </div>
                </div>

                <div class="col-6 col-xl">
                    <div class="metric-card done">
                        <div class="metric-label">Selesai</div>
                        <div class="metric-value">{{ $ringkasan['selesai'] }}</div>
                    </div>
                </div>

                <div class="col-6 col-xl">
                    <div class="metric-card escalated">
                        <div class="metric-label">Dieskalasi</div>
                        <div class="metric-value">{{ $ringkasan['dieskalasi'] }}</div>
                    </div>
                </div>

                <div class="col-6 col-xl">
                    <div class="metric-card stale">
                        <div class="metric-label">Mangkrak</div>
                        <div class="metric-value">{{ $ringkasan['mangkrak'] }}</div>
                    </div>
                </div>

            </section>

            <section class="screening-panel">
                <div class="screening-panel-header">
                    <div>
                        <h2 class="screening-panel-title">
                            Distribusi Hasil Skrining
                        </h2>

                        <p class="screening-panel-copy">
                            Ringkasan agregat hasil skrining selesai terbaru setiap siswa pada periode tanggal yang dipilih
                        </p>
                    </div>

                    <span class="screening-total">
                        <i class="bi bi-people"></i>
                        {{ $distribusiSkrining['total'] }} siswa
                    </span>
                </div>

                @if($distribusiSkrining['total'] > 0)
                    <div class="screening-distribution">
                        <div class="screening-result normal">
                            <div class="screening-result-head">
                                <div>
                                    <div class="screening-result-label">
                                        Normal
                                    </div>

                                    <div class="screening-result-value">
                                        {{ $distribusiSkrining['normal']['total'] }}
                                    </div>
                                </div>

                                <span class="screening-result-percent">
                                    {{ $distribusiSkrining['normal']['persentase'] }}%
                                </span>
                            </div>

                            <div class="screening-result-note">
                                Siswa dengan hasil skrining terbaru pada kategori Normal
                            </div>
                        </div>

                        <div class="screening-result ambang">
                            <div class="screening-result-head">
                                <div>
                                    <div class="screening-result-label">
                                        Ambang
                                    </div>

                                    <div class="screening-result-value">
                                        {{ $distribusiSkrining['ambang']['total'] }}
                                    </div>
                                </div>

                                <span class="screening-result-percent">
                                    {{ $distribusiSkrining['ambang']['persentase'] }}%
                                </span>
                            </div>

                            <div class="screening-result-note">
                                Siswa dengan hasil skrining terbaru pada kategori Ambang
                            </div>
                        </div>

                        <div class="screening-result abnormal">
                            <div class="screening-result-head">
                                <div>
                                    <div class="screening-result-label">
                                        Abnormal
                                    </div>

                                    <div class="screening-result-value">
                                        {{ $distribusiSkrining['abnormal']['total'] }}
                                    </div>
                                </div>

                                <span class="screening-result-percent">
                                    {{ $distribusiSkrining['abnormal']['persentase'] }}%
                                </span>
                            </div>

                            <div class="screening-result-note">
                                Siswa dengan hasil skrining terbaru pada kategori Abnormal
                            </div>
                        </div>
                    </div>
                @else
                    <div class="px-3 py-4 text-center text-secondary small">
                        Belum ada hasil skrining lengkap pada periode yang dipilih.
                    </div>
                @endif

                <div class="screening-privacy">
                    <i class="bi bi-shield-check"></i>

                    <div>
                        Data ditampilkan dalam bentuk agregat tanpa nama siswa, NIS, jawaban, atau skor individual. Kategori Normal, Ambang, dan Abnormal merupakan interpretasi skrining awal dan bukan diagnosis klinis.
                    </div>
                </div>
            </section>

            <section class="row g-3 mb-3">

                <div class="col-lg-4">
                    <div class="panel">
                        <div class="panel-header">
                            <h2 class="panel-title">
                                Distribusi Status
                            </h2>
                            <p class="panel-copy">
                                Status kasus dalam periode terpilih
                            </p>
                        </div>

                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Status</th>
                                    <th class="text-end">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($status as $item)
                                    <tr>
                                        <td>{{ $item->label }}</td>
                                        <td class="number">{{ $item->total }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2">Tidak ada data.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="panel">
                        <div class="panel-header">
                            <h2 class="panel-title">
                                Distribusi Kategori
                            </h2>
                            <p class="panel-copy">
                                Kategori laporan dalam periode
                            </p>
                        </div>

                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Kategori</th>
                                    <th class="text-end">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($kategori as $item)
                                    <tr>
                                        <td>{{ $item->nama_kategori }}</td>
                                        <td class="number">{{ $item->total }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2">Tidak ada data.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="panel">
                        <div class="panel-header">
                            <h2 class="panel-title">
                                Distribusi Tingkat
                            </h2>
                            <p class="panel-copy">
                                Agregat berdasarkan tingkat kelas
                            </p>
                        </div>

                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Tingkat</th>
                                    <th class="text-end">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($tingkat as $item)
                                    <tr>
                                        <td>{{ $item->tingkat }}</td>
                                        <td class="number">{{ $item->total }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2">Tidak ada data.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </section>

            <section class="row g-3">

                <div class="col-lg-6">
                    <div class="panel">
                        <div class="panel-header">
                            <h2 class="panel-title">
                                Tren Bulanan
                            </h2>
                            <p class="panel-copy">
                                Jumlah laporan yang dikirim setiap bulan
                            </p>
                        </div>

                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Bulan</th>
                                    <th class="text-end">Total Laporan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tren as $item)
                                    <tr>
                                        <td>{{ $item->label }}</td>
                                        <td class="number">{{ $item->total }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="panel">
                        <div class="panel-header">
                            <h2 class="panel-title">
                                Aktivitas Guru BK
                            </h2>
                            <p class="panel-copy">
                                Ringkasan operasional tanpa membuka isi kasus
                            </p>
                        </div>

                        <div class="table-responsive">
                            <table class="data-table">
                                <thead>
                                    <tr>
                                        <th>Guru BK</th>
                                        <th class="text-end">Aktif Saat Ini</th>
                                        <th class="text-end">Selesai</th>
                                        <th class="text-end">Tindak Lanjut</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($aktivitasBk as $bk)
                                        <tr>
                                            <td>{{ $bk->name }}</td>
                                            <td class="number">
                                                {{ $bk->kasus_saat_ini }}
                                            </td>
                                            <td class="number">
                                                {{ $bk->selesai_periode }}
                                            </td>
                                            <td class="number">
                                                {{ $bk->tindak_lanjut_periode }}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4">
                                                Belum ada Guru BK aktif.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </section>

            <div class="note-box">
                <i class="bi bi-info-circle"></i>
                <div>
                    Angka "Kasus Aktif Saat Ini" pada bagian Guru BK menunjukkan
                    kasus yang saat ini masih ditugaskan kepada masing-masing
                    Guru BK, bukan seluruh riwayat penanganan. Kasus mangkrak
                    menggunakan batas {{ $staleDays }} hari sesuai konfigurasi sistem.
                </div>
            </div>

            <footer class="page-footer">
                <div class="d-flex flex-column flex-md-row justify-content-between gap-2 w-100">
                    <span>© {{ date('Y') }} CurhatAman</span>
                    <span>Portal Admin Sekolah · Laporan kebijakan agregat</span>
                </div>
            </footer>

        </div>
    </div>

</main>

<script>

    const sidebar = document.getElementById('adminSidebar');
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

    document.addEventListener('DOMContentLoaded', function () {
        const tahunAjaran = document.getElementById('tahun_ajaran');
        const semester = document.getElementById('semester');
        const dari = document.getElementById('dari');
        const sampai = document.getElementById('sampai');

        function updateTanggalSemester() {
            if (!tahunAjaran || !semester || !dari || !sampai) {
                return;
            }

            const bagianTahun = tahunAjaran.value.split('/');

            if (bagianTahun.length !== 2) {
                return;
            }

            const tahunAwal = parseInt(bagianTahun[0], 10);
            const tahunAkhir = parseInt(bagianTahun[1], 10);

            if (
                Number.isNaN(tahunAwal) ||
                Number.isNaN(tahunAkhir)
            ) {
                return;
            }

            if (semester.value === 'ganjil') {
                dari.value = `${tahunAwal}-07-01`;
                sampai.value = `${tahunAwal}-12-31`;
            } else {
                dari.value = `${tahunAkhir}-01-01`;
                sampai.value = `${tahunAkhir}-06-30`;
            }
        }

        tahunAjaran?.addEventListener(
            'change',
            updateTanggalSemester
        );

        semester?.addEventListener(
            'change',
            updateTanggalSemester
        );
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
