@php
    $errors = $errors ?? new \Illuminate\Support\ViewErrorBag();
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Detail Kasus Eskalasi | CurhatAman</title>

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
            --ca-warning: #b54708;
            --ca-warning-soft: #fff7ed;
            --ca-success: #027a48;
            --ca-success-soft: #ecf8f2;
            --ca-purple: #6941c6;
            --ca-purple-soft: #faf8ff;
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

        .sidebar-link.disabled {
            color: #a4acb8;
            pointer-events: none;
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
            max-width: 1180px;
            margin: 0 auto;
        }

        .back-link {
            margin-bottom: 16px;
            display: inline-flex;
            align-items: center;
            gap: 7px;
            color: var(--ca-primary-dark);
            font-size: 11.5px;
            font-weight: 650;
        }

        .back-link:hover {
            color: var(--ca-primary);
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
            max-width: 760px;
            margin: 7px 0 0;
            color: rgba(255, 255, 255, .82);
            font-size: 12.5px;
            line-height: 1.65;
        }

        .header-badges {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            justify-content: flex-end;
            gap: 8px;
        }

        .status-badge,
        .readonly-badge {
            min-height: 34px;
            padding: 0 11px;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            gap: 7px;
            font-size: 10.5px;
            font-weight: 680;
            white-space: nowrap;
        }

        .status-badge {
            color: #ffffff;
            background: rgba(180, 35, 24, .34);
            border: 1px solid rgba(255, 255, 255, .40);
        }

        .readonly-badge {
            color: #ffffff;
            background: rgba(255, 255, 255, .12);
            border: 1px solid rgba(255, 255, 255, .40);
        }

        .action-alert {
            margin-bottom: 18px;
            padding: 12px 14px;
            border: 1px solid #cde8db;
            border-radius: 9px;
            display: flex;
            align-items: flex-start;
            gap: 8px;
            color: var(--ca-success);
            background: var(--ca-success-soft);
            font-size: 11px;
            font-weight: 600;
            line-height: 1.5;
        }

        .content-grid {
            display: grid;
            grid-template-columns: minmax(0, 1.65fr) minmax(280px, .75fr);
            gap: 18px;
            align-items: start;
        }

        .panel {
            border: 1px solid var(--ca-border);
            border-top: 3px solid var(--ca-primary);
            border-radius: 12px;
            overflow: hidden;
            background: #ffffff;
        }

        .panel + .panel {
            margin-top: 18px;
        }

        .panel-header {
            padding: 17px 19px;
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 16px;
            border-bottom: 1px solid var(--ca-line);
            background: #ffffff;
        }

        .panel-title {
            margin: 0;
            color: var(--ca-text);
            font-size: 13.5px;
            font-weight: 700;
        }

        .panel-subtitle {
            margin-top: 4px;
            color: var(--ca-muted);
            font-size: 10.5px;
        }

        .panel-body {
            padding: 19px;
        }

        .summary-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            border-top: 1px solid var(--ca-line);
            border-left: 1px solid var(--ca-line);
        }

        .summary-item {
            min-height: auto;
            padding: 13px 18px;
            border-right: 1px solid var(--ca-line);
            border-bottom: 1px solid var(--ca-line);
            background: #ffffff;
        }

        .summary-grid .summary-label,
        .summary-item .summary-label {
            margin-bottom: 5px !important;
            color: var(--ca-muted) !important;
            font-size: 10.5px !important;
            font-weight: 650 !important;
            text-transform: uppercase !important;
            letter-spacing: .04em !important;
        }

        .summary-grid .summary-value,
        .summary-item .summary-value {
            margin-top: 0 !important;
            color: #1f2937 !important;
            font-size: 13.5px !important;
            font-weight: 600 !important;
            line-height: 1.5 !important;
            overflow-wrap: anywhere;
        }

        .section-label {
            margin-bottom: 9px;
            color: #344054;
            font-size: 11.5px;
            font-weight: 700;
        }

        .chronology {
            padding: 15px 16px;
            border: 1px solid var(--ca-line);
            border-radius: 9px;
            color: #344054;
            background: #fbfcfc;
            font-size: 11.5px;
            line-height: 1.75;
            white-space: pre-line;
            overflow-wrap: anywhere;
        }

        .privacy-note {
            margin-bottom: 16px;
            padding: 12px 14px;
            border: 1px solid #e5dcff;
            border-radius: 9px;
            display: flex;
            align-items: flex-start;
            gap: 9px;
            color: #5d48aa;
            background: var(--ca-purple-soft);
            font-size: 10.5px;
            line-height: 1.55;
        }

        .privacy-note i {
            margin-top: 1px;
            color: var(--ca-purple);
        }

        .side-detail {
            padding: 4px 19px;
        }

        .side-row {
            padding: 13px 0;
            border-bottom: 1px solid var(--ca-line);
        }

        .side-row:last-child {
            border-bottom: 0;
        }

        .side-label {
            margin-bottom: 5px;
            color: var(--ca-muted);
            font-size: 10px;
        }

        .side-value {
            color: #344054;
            font-size: 11.5px;
            font-weight: 650;
            line-height: 1.5;
            overflow-wrap: anywhere;
        }

        .side-meta {
            margin-top: 3px;
            color: var(--ca-muted);
            font-size: 10px;
            font-weight: 400;
        }

        .evidence-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .evidence-item {
            padding: 12px 13px;
            border: 1px solid var(--ca-line);
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            background: #fbfcfc;
        }

        .evidence-copy {
            min-width: 0;
        }

        .evidence-name {
            color: #344054;
            font-size: 11.5px;
            font-weight: 650;
            overflow-wrap: anywhere;
        }

        .evidence-meta {
            margin-top: 3px;
            color: var(--ca-muted);
            font-size: 9.5px;
        }

        .btn-evidence {
            min-height: 31px;
            padding: 0 10px;
            border: 1px solid #cfe3e1;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            flex-shrink: 0;
            color: var(--ca-primary-dark);
            background: #f6fbfa;
            font-size: 10px;
            font-weight: 650;
        }

        .btn-evidence:hover {
            color: var(--ca-primary-dark);
            background: var(--ca-primary-soft);
        }

        .timeline {
            position: relative;
            padding-left: 22px;
        }

        .timeline::before {
            content: "";
            position: absolute;
            top: 8px;
            bottom: 8px;
            left: 5px;
            width: 1px;
            background: #dce5e5;
        }

        .timeline-item {
            position: relative;
            padding-bottom: 18px;
        }

        .timeline-item:last-child {
            padding-bottom: 0;
        }

        .timeline-dot {
            position: absolute;
            top: 5px;
            left: -22px;
            width: 11px;
            height: 11px;
            border: 2px solid #ffffff;
            border-radius: 50%;
            background: var(--ca-primary);
            box-shadow: 0 0 0 1px #bee0dc;
        }

        .timeline-head {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 12px;
        }

        .timeline-status {
            color: #344054;
            font-size: 11.5px;
            font-weight: 700;
        }

        .timeline-date {
            color: var(--ca-muted);
            font-size: 9.5px;
            white-space: nowrap;
        }

        .timeline-officer {
            margin-top: 3px;
            color: var(--ca-muted);
            font-size: 10px;
        }

        .timeline-note {
            margin-top: 8px;
            color: #475467;
            font-size: 11px;
            line-height: 1.65;
            white-space: pre-line;
            overflow-wrap: anywhere;
        }

        .empty-state {
            padding: 22px;
            border: 1px dashed #dce5e5;
            border-radius: 9px;
            color: var(--ca-muted);
            background: #fbfcfc;
            text-align: center;
            font-size: 10.5px;
        }

        .reassign-card {
            margin-top: 18px;
            border: 1px solid #d7e7e5;
            border-top: 3px solid var(--ca-primary);
            border-radius: 12px;
            overflow: hidden;
            background: #ffffff;
        }

        .reassign-head {
            padding: 16px 18px;
            display: flex;
            align-items: flex-start;
            gap: 10px;
            border-bottom: 1px solid var(--ca-line);
            background: #ffffff;
        }

        .reassign-icon {
            width: 34px;
            height: 34px;
            flex: 0 0 34px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--ca-primary-dark);
            background: var(--ca-primary-soft);
        }

        .reassign-title {
            color: #344054;
            font-size: 12px;
            font-weight: 700;
        }

        .reassign-copy {
            margin-top: 3px;
            color: var(--ca-muted);
            font-size: 10px;
            line-height: 1.5;
        }

        .reassign-body {
            padding: 16px 18px 18px;
        }

        .reassign-label {
            margin-bottom: 6px;
            color: #475467;
            font-size: 10.5px;
            font-weight: 650;
        }

        .reassign-select {
            min-height: 41px;
            border: 1px solid var(--ca-border);
            border-radius: 9px;
            color: var(--ca-text);
            background: #ffffff;
            font-size: 11px;
            box-shadow: none;
        }

        .reassign-select:focus {
            border-color: rgba(15, 138, 131, .55);
            box-shadow: 0 0 0 .2rem rgba(15, 138, 131, .08);
        }

        .reassign-help {
            margin-top: 7px;
            color: var(--ca-muted);
            font-size: 9.8px;
            line-height: 1.5;
        }

        .reassign-error {
            margin-top: 6px;
            color: var(--ca-danger);
            font-size: 10px;
        }

        .btn-reassign {
            width: 100%;
            min-height: 39px;
            margin-top: 13px;
            padding: 0 12px;
            border: 1px solid var(--ca-primary);
            border-radius: 9px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            color: #ffffff;
            background: var(--ca-primary);
            font-size: 10.5px;
            font-weight: 680;
        }

        .btn-reassign:hover {
            color: #ffffff;
            background: var(--ca-primary-dark);
            border-color: var(--ca-primary-dark);
        }

        .reassign-empty {
            padding: 12px 13px;
            border: 1px dashed #dce5e5;
            border-radius: 9px;
            color: var(--ca-muted);
            background: #fbfcfc;
            font-size: 10px;
            line-height: 1.55;
        }

        .access-note {
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

        .access-note i {
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

            .header-badges {
                justify-content: flex-start;
            }

            .content-grid {
                grid-template-columns: 1fr;
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

            .summary-grid {
                grid-template-columns: 1fr;
            }

            .evidence-item {
                align-items: flex-start;
                flex-direction: column;
            }

            .timeline-head {
                flex-direction: column;
                gap: 3px;
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
        ->map(
            fn ($bagian) =>
                mb_strtoupper(
                    mb_substr($bagian, 0, 1)
                )
        )
        ->implode('');

    $tanggalKejadian = $detail->tanggal_kejadian
        ? \Carbon\Carbon::parse($detail->tanggal_kejadian)
            ->locale('id')
            ->translatedFormat('d F Y')
        : '-';

    $tanggalDikirim = $detail->submitted_at
        ? \Carbon\Carbon::parse($detail->submitted_at)
            ->locale('id')
            ->translatedFormat('d F Y, H:i')
        : '-';

    $terakhirDiperbarui = $detail->updated_at
        ? \Carbon\Carbon::parse($detail->updated_at)
            ->locale('id')
            ->translatedFormat('d F Y, H:i')
        : '-';
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
            Detail Kasus Eskalasi
        </div>

        <div class="topbar-subtitle">
            Pengawasan kasus pada tingkat sekolah
        </div>
    </div>

    </div>

    <div class="topbar-actions">

            @include('admin.partials.notification-bell')

        <div class="date-chip">
            <i class="bi bi-calendar3"></i>

            {{ now()
                ->locale('id')
                ->translatedFormat('d F Y') }}
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

            <i
                class="bi bi-chevron-right account-chevron"
            ></i>
        </a>

    </div>

</header>

<main class="main-content">

    <div class="page-body">
        <div class="content-shell">

            <a
                href="{{ route('admin.kasus-eskalasi.index') }}"
                class="back-link"
            >
                <i class="bi bi-arrow-left"></i>
                Kembali ke Kasus Eskalasi
            </a>

            <section class="page-header">

                <div>

                    <div class="page-kicker">
                        Pengawasan Penanganan
                    </div>

                    <h1 class="page-title">
                        {{ $detail->kode_laporan }}
                    </h1>

                    <p class="page-copy">
                        Detail ini tersedia karena laporan telah
                        berstatus dieskalasi. Admin dapat melakukan
                        pengawasan, tetapi tidak dapat mengubah isi
                        laporan maupun catatan tindak lanjut Guru BK.
                    </p>

                </div>

                <div class="header-badges">

                    <span class="status-badge">
                        <i class="bi bi-exclamation-diamond"></i>
                        Dieskalasi
                    </span>

                    <span class="readonly-badge">
                        <i class="bi bi-eye"></i>
                        Akses Read-only
                    </span>

                </div>

            </section>

            @if(session('success'))

                <div class="action-alert">
                    <i class="bi bi-check-circle-fill"></i>
                    <div>{{ session('success') }}</div>
                </div>

            @endif

            <div class="content-grid">

                

                <div>

                    <section class="panel">

                        <div class="panel-header">

                            <div>
                                <h2 class="panel-title">
                                    Ringkasan Laporan
                                </h2>

                                <div class="panel-subtitle">
                                    Informasi utama laporan yang
                                    telah dieskalasi
                                </div>
                            </div>

                        </div>

                        <div class="summary-grid">

                            <div class="summary-item">

                                <div class="summary-label">
                                    Kategori
                                </div>

                                <div class="summary-value">
                                    {{ $detail->nama_kategori }}
                                </div>

                            </div>

                            <div class="summary-item">

                                <div class="summary-label">
                                    Tanggal Kejadian
                                </div>

                                <div class="summary-value">
                                    {{ $tanggalKejadian }}
                                </div>

                            </div>

                            <div class="summary-item">

                                <div class="summary-label">
                                    Lokasi Kejadian
                                </div>

                                <div class="summary-value">
                                    {{ $detail->lokasi_kejadian ?? '-' }}
                                </div>

                            </div>

                            <div class="summary-item">

                                <div class="summary-label">
                                    Kelas
                                </div>

                                <div class="summary-value">
                                    {{ $detail->nama_kelas
                                        ?? 'Belum ditentukan' }}
                                </div>

                            </div>

                            <div class="summary-item">

                                <div class="summary-label">
                                    Dikirim
                                </div>

                                <div class="summary-value">
                                    {{ $tanggalDikirim }}
                                </div>

                            </div>

                            <div class="summary-item">

                                <div class="summary-label">
                                    Terakhir Diperbarui
                                </div>

                                <div class="summary-value">
                                    {{ $terakhirDiperbarui }}
                                </div>

                            </div>

                        </div>

                    </section>

                    <section class="panel">

                        <div class="panel-header">

                            <div>
                                <h2 class="panel-title">
                                    Kronologi Kejadian
                                </h2>

                                <div class="panel-subtitle">
                                    Isi laporan asli dari siswa
                                </div>
                            </div>

                        </div>

                        <div class="panel-body">

                            @if($detail->status_rahasia)

                                <div class="privacy-note">

                                    <i class="bi bi-shield-lock"></i>

                                    <div>
                                        Laporan ini ditandai
                                        <strong>rahasia</strong>.
                                        Identitas dan isi kasus dapat
                                        dilihat Admin hanya karena kasus
                                        telah dieskalasi ke tingkat sekolah.
                                    </div>

                                </div>

                            @endif

                            <div class="chronology">
                                {{ $detail->deskripsi }}
                            </div>

                        </div>

                    </section>

                    <section class="panel">

                        <div class="panel-header">

                            <div>
                                <h2 class="panel-title">
                                    Bukti Pendukung
                                </h2>

                                <div class="panel-subtitle">
                                    Lampiran yang dikirim bersama laporan
                                </div>
                            </div>

                        </div>

                        <div class="panel-body">

                            @if($bukti->isEmpty())

                                <div class="empty-state">
                                    Tidak ada bukti pendukung
                                    yang dilampirkan pada laporan ini.
                                </div>

                            @else

                                <div class="evidence-list">

                                    @foreach($bukti as $item)

                                        <div class="evidence-item">

                                            <div class="evidence-copy">

                                                <div class="evidence-name">
                                                    {{ $item->original_name
                                                        ?? 'Bukti pendukung' }}
                                                </div>

                                                <div class="evidence-meta">
                                                    Lampiran laporan
                                                </div>

                                            </div>

                                            @if(!empty($item->file_path))

                                                <a
                                                    href="{{ asset(
                                                        'storage/' .
                                                        $item->file_path
                                                    ) }}"
                                                    target="_blank"
                                                    rel="noopener"
                                                    class="btn-evidence"
                                                >
                                                    <i class="bi bi-box-arrow-up-right"></i>
                                                    Lihat Bukti
                                                </a>

                                            @endif

                                        </div>

                                    @endforeach

                                </div>

                            @endif

                        </div>

                    </section>

                    <section class="panel">

                        <div class="panel-header">

                            <div>
                                <h2 class="panel-title">
                                    Riwayat Tindak Lanjut
                                </h2>

                                <div class="panel-subtitle">
                                    Catatan Guru BK ditampilkan
                                    sebagai informasi read-only
                                </div>
                            </div>

                        </div>

                        <div class="panel-body">

                            @if($tindakLanjut->isEmpty())

                                <div class="empty-state">
                                    Belum ada catatan tindak lanjut
                                    pada kasus ini.
                                </div>

                            @else

                                <div class="timeline">

                                    @foreach($tindakLanjut as $item)

                                        @php
                                            $tanggalTl =
                                                $item->tanggal
                                                    ? \Carbon\Carbon::parse(
                                                        $item->tanggal
                                                    )
                                                        ->locale('id')
                                                        ->translatedFormat(
                                                            'd M Y, H:i'
                                                        )
                                                    : '-';
                                        @endphp

                                        <div class="timeline-item">

                                            <span class="timeline-dot"></span>

                                            <div class="timeline-head">

                                                <div>

                                                    <div class="timeline-status">
                                                        {{ ucwords(
                                                            str_replace(
                                                                '_',
                                                                ' ',
                                                                $item->status
                                                            )
                                                        ) }}
                                                    </div>

                                                    <div class="timeline-officer">
                                                        Dicatat oleh
                                                        {{ $item->nama_petugas }}
                                                    </div>

                                                </div>

                                                <div class="timeline-date">
                                                    {{ $tanggalTl }}
                                                </div>

                                            </div>

                                            <div class="timeline-note">
                                                {{ $item->catatan }}
                                            </div>

                                        </div>

                                    @endforeach

                                </div>

                            @endif

                        </div>

                    </section>

                </div>

                

                <div>

                    <section class="panel">

                        <div class="panel-header">

                            <div>
                                <h2 class="panel-title">
                                    Identitas Pelapor
                                </h2>

                                <div class="panel-subtitle">
                                    Akses khusus kasus dieskalasi
                                </div>
                            </div>

                        </div>

                        <div class="side-detail">

                            <div class="side-row">

                                <div class="side-label">
                                    Nama Siswa
                                </div>

                                <div class="side-value">
                                    {{ $detail->nama_siswa }}
                                </div>

                            </div>

                            <div class="side-row">

                                <div class="side-label">
                                    NIS
                                </div>

                                <div class="side-value">
                                    {{ $detail->nis ?? '-' }}
                                </div>

                            </div>

                            <div class="side-row">

                                <div class="side-label">
                                    Email
                                </div>

                                <div class="side-value">
                                    {{ $detail->email_siswa }}
                                </div>

                            </div>

                            <div class="side-row">

                                <div class="side-label">
                                    Kelas
                                </div>

                                <div class="side-value">
                                    {{ $detail->nama_kelas
                                        ?? 'Belum ditentukan' }}

                                    @if($detail->tahun_ajaran)

                                        <div class="side-meta">
                                            {{ $detail->tahun_ajaran }}
                                        </div>

                                    @endif
                                </div>

                            </div>

                            <div class="side-row">

                                <div class="side-label">
                                    Tahun Masuk
                                </div>

                                <div class="side-value">
                                    {{ $detail->tahun_masuk ?? '-' }}
                                </div>

                            </div>

                        </div>

                    </section>

                    <section class="panel">

                        <div class="panel-header">

                            <div>
                                <h2 class="panel-title">
                                    Penanganan Kasus
                                </h2>

                                <div class="panel-subtitle">
                                    Penanggung jawab saat ini
                                </div>
                            </div>

                        </div>

                        <div class="side-detail">

                            <div class="side-row">

                                <div class="side-label">
                                    Guru BK
                                </div>

                                <div class="side-value">

                                    @if($detail->nama_bk)

                                        {{ $detail->nama_bk }}

                                        @if($detail->email_bk)
                                            <div class="side-meta">
                                                {{ $detail->email_bk }}
                                            </div>
                                        @endif

                                    @else

                                        Belum ditugaskan

                                    @endif

                                </div>

                            </div>

                            <div class="side-row">

                                <div class="side-label">
                                    Status Kasus
                                </div>

                                <div class="side-value">
                                    Dieskalasi
                                </div>

                            </div>

                            <div class="side-row">

                                <div class="side-label">
                                    Kerahasiaan
                                </div>

                                <div class="side-value">
                                    {{ $detail->status_rahasia
                                        ? 'Rahasia'
                                        : 'Tidak Rahasia' }}
                                </div>

                            </div>

                        </div>

                    </section>

                    <section class="reassign-card">

                        <div class="reassign-head">

                            <span class="reassign-icon">
                                <i class="bi bi-arrow-left-right"></i>
                            </span>

                            <div>

                                <div class="reassign-title">
                                    Alihkan Penanganan
                                </div>

                                <div class="reassign-copy">
                                    Tetapkan Guru BK aktif lain sebagai
                                    penanggung jawab kasus ini.
                                </div>

                            </div>

                        </div>

                        <div class="reassign-body">

                            @if($guruBkTersedia->isEmpty())

                                <div class="reassign-empty">

                                    Tidak ada Guru BK aktif lain
                                    yang tersedia untuk menerima
                                    penanganan saat ini.

                                </div>

                            @else

                                <form
                                    method="POST"
                                    action="{{ route(
                                        'admin.kasus-eskalasi.reassign',
                                        $detail->id
                                    ) }}"
                                    onsubmit="return confirm(
                                        'Alihkan penanganan kasus ini ke Guru BK yang dipilih?'
                                    )"
                                >
                                    @csrf
                                    @method('PATCH')

                                    <label
                                        for="assigned_bk_id"
                                        class="reassign-label"
                                    >
                                        Guru BK Baru
                                    </label>

                                    <select
                                        name="assigned_bk_id"
                                        id="assigned_bk_id"
                                        class="form-select reassign-select
                                               @error('assigned_bk_id')
                                                   is-invalid
                                               @enderror"
                                        required
                                    >

                                        <option value="">
                                            Pilih Guru BK
                                        </option>

                                        @foreach(
                                            $guruBkTersedia
                                            as $guruBk
                                        )

                                            <option
                                                value="{{ $guruBk->id }}"
                                                @selected(
                                                    old(
                                                        'assigned_bk_id'
                                                    ) == $guruBk->id
                                                )
                                            >
                                                {{ $guruBk->name }}
                                                — {{ $guruBk->email }}
                                            </option>

                                        @endforeach

                                    </select>

                                    @error('assigned_bk_id')

                                        <div class="reassign-error">
                                            {{ $message }}
                                        </div>

                                    @enderror

                                    <div class="reassign-help">

                                        Guru BK yang sudah menyatakan
                                        konflik kepentingan pada kasus ini
                                        tidak ditampilkan. Status kasus tetap
                                        <strong>Dieskalasi</strong> setelah
                                        dialihkan.

                                    </div>

                                    <button
                                        type="submit"
                                        class="btn-reassign"
                                    >
                                        <i class="bi bi-person-gear"></i>
                                        Alihkan Penanganan
                                    </button>

                                </form>

                            @endif

                        </div>

                    </section>

                    <section class="panel">

                        <div class="panel-header">

                            <div>
                                <h2 class="panel-title">
                                    Akses Admin
                                </h2>

                                <div class="panel-subtitle">
                                    Batas kewenangan pada halaman ini
                                </div>
                            </div>

                        </div>

                        <div class="panel-body">

                            <div class="access-note m-0">

                                <i class="bi bi-info-circle"></i>

                                <div>
                                    Admin dapat membaca detail
                                    kasus yang dieskalasi dan mengalihkan
                                    penanggung jawab apabila diperlukan.
                                    Isi laporan serta catatan tindak lanjut
                                    Guru BK tetap bersifat read-only.
                                </div>

                            </div>

                        </div>

                    </section>

                </div>

            </div>

            <footer class="page-footer">
                <div class="d-flex flex-column flex-md-row justify-content-between gap-2 w-100">
                    <span>© {{ date('Y') }} CurhatAman</span>
                    <span>Portal Admin Sekolah · Detail kasus eskalasi</span>
                </div>
            </footer>

        </div>
    </div>

</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

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
</script>

</body>
</html>
