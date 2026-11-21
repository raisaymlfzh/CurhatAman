@php
    $errors = $errors ?? new \Illuminate\Support\ViewErrorBag();
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard Admin | CurhatAman</title>

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
            --ca-text-soft: #344054;
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

        .app-shell {
            min-height: 100vh;
        }

        .sidebar {
            position: fixed;
            inset: 0 auto 0 0;
            z-index: 1100;
            width: var(--sidebar-width);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background: var(--ca-surface);
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
            flex: 0 0 20px;
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
            cursor: default;
            pointer-events: none;
        }

        .sidebar-link.disabled i {
            color: #b6bdc7;
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
            background: #fff3f2;
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
            letter-spacing: -.01em;
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
            color: #667085;
            background: #ffffff;
            font-size: 12px;
            white-space: nowrap;
        }

        .date-chip i {
            color: var(--ca-primary-dark);
        }

        .account-trigger {
            min-width: 184px;
            height: 48px;
            padding: 5px 9px 5px 6px;
            border: 1px solid transparent;
            border-radius: 11px;
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--ca-text);
            background: transparent;
            transition: background .15s ease, border-color .15s ease, color .15s ease;
        }

        .account-trigger:hover,
        .account-trigger:focus {
            color: var(--ca-primary-dark);
            background: #f8fbfa;
            border-color: var(--ca-border);
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

        .account-copy {
            min-width: 0;
            flex: 1;
        }

        .account-name {
            max-width: 130px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            color: var(--ca-text);
            font-size: 12.5px;
            font-weight: 680;
        }

        .account-role {
            margin-top: 1px;
            color: var(--ca-muted-light);
            font-size: 10.5px;
        }

        .account-chevron {
            color: var(--ca-muted-light);
            font-size: 11px;
            transition: transform .15s ease;
        }

        .account-trigger:hover .account-chevron {
            transform: translateX(2px);
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
            gap: 24px;
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
            line-height: 1.25;
            font-weight: 760;
            letter-spacing: -.025em;
        }

        .page-copy {
            max-width: 790px;
            margin: 7px 0 0;
            color: rgba(255, 255, 255, .82);
            font-size: 12.5px;
            line-height: 1.65;
        }

        .scope-badge {
            padding: 9px 12px;
            border: 1px solid rgba(255, 255, 255, .38);
            border-radius: 9px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #ffffff;
            background: rgba(255, 255, 255, .10);
            font-size: 11px;
            font-weight: 680;
            white-space: nowrap;
        }

        .metric-card {
            position: relative;
            height: 100%;
            min-height: 126px;
            padding: 18px;
            border: 1px solid var(--ca-border);
            border-top: 3px solid #cfd8d8;
            border-radius: 12px;
            background: var(--ca-surface);
        }

        .metric-card.students {
            border-top-color: var(--ca-primary);
        }

        .metric-card.active-cases {
            border-top-color: #e6a33b;
        }

        .metric-card.escalated {
            border-top-color: #d85d55;
        }

        .metric-card.counselors {
            border-top-color: #35a36f;
        }

        .metric-top {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 12px;
        }

        .metric-label {
            color: var(--ca-muted);
            font-size: 11.5px;
            font-weight: 580;
        }

        .metric-value {
            margin-top: 11px;
            color: var(--ca-text);
            font-size: 27px;
            line-height: 1.05;
            font-weight: 760;
            letter-spacing: -.025em;
        }

        .metric-icon {
            width: 36px;
            height: 36px;
            flex: 0 0 36px;
            border-radius: 9px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
        }

        .metric-icon.primary {
            color: #ffffff;
            background: var(--ca-primary);
        }

        .metric-icon.warning {
            color: var(--ca-warning);
            background: var(--ca-warning-soft);
        }

        .metric-icon.danger {
            color: var(--ca-danger);
            background: var(--ca-danger-soft);
        }

        .metric-icon.success {
            color: var(--ca-success);
            background: var(--ca-success-soft);
        }

        .metric-note {
            margin-top: 13px;
            color: var(--ca-muted-light);
            font-size: 10.5px;
            line-height: 1.45;
        }

        .panel {
            border: 1px solid var(--ca-border);
            border-radius: 12px;
            background: var(--ca-surface);
            overflow: hidden;
        }

        .panel.teal-accent {
            border-top: 3px solid var(--ca-primary);
        }

        .panel.danger-accent {
            border-top: 3px solid #d85d55;
        }

        .panel-header {
            min-height: 66px;
            padding: 17px 20px;
            border-bottom: 1px solid var(--ca-line);
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 16px;
        }

        .panel-title {
            margin: 0;
            color: var(--ca-text);
            font-size: 14px;
            font-weight: 710;
        }

        .panel-copy {
            margin: 4px 0 0;
            color: var(--ca-muted);
            font-size: 11px;
            line-height: 1.5;
        }

        .chart-wrap {
            position: relative;
            height: 305px;
            padding: 18px 20px 20px;
        }

        .chart-wrap.status {
            height: 305px;
            padding: 18px 16px 16px;
        }

        .status-legend {
            padding: 0 18px 17px;
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 8px;
        }

        .legend-item {
            padding: 9px 10px;
            border: 1px solid var(--ca-line);
            border-radius: 8px;
            background: #fbfcfc;
        }

        .legend-label {
            color: var(--ca-muted);
            font-size: 9.5px;
        }

        .legend-value {
            margin-top: 2px;
            color: var(--ca-text-soft);
            font-size: 13px;
            font-weight: 700;
        }

        .escalation-list {
            padding: 3px 20px;
        }

        .escalation-item {
            min-height: 66px;
            padding: 13px 0;
            border-bottom: 1px solid var(--ca-line);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
        }

        .escalation-item:last-child {
            border-bottom: 0;
        }

        .escalation-code {
            color: var(--ca-text-soft);
            font-size: 12px;
            font-weight: 680;
        }

        .escalation-meta {
            margin-top: 4px;
            color: var(--ca-muted-light);
            font-size: 10px;
        }

        .escalation-badge {
            padding: 5px 8px;
            border-radius: 999px;
            color: var(--ca-danger);
            background: var(--ca-danger-soft);
            font-size: 9.5px;
            font-weight: 700;
        }

        .empty-state {
            padding: 34px 18px;
            color: var(--ca-muted);
            text-align: center;
            font-size: 11px;
        }

        .empty-icon {
            width: 42px;
            height: 42px;
            margin: 0 auto 10px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: var(--ca-success);
            background: var(--ca-success-soft);
            font-size: 17px;
        }

        .org-grid {
            padding: 17px 20px 20px;
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 10px;
        }

        .org-card {
            padding: 13px;
            border: 1px solid var(--ca-line);
            border-radius: 9px;
            background: #fafcfc;
        }

        .org-label {
            color: var(--ca-muted);
            font-size: 10px;
            line-height: 1.4;
        }

        .org-value {
            margin-top: 4px;
            color: var(--ca-text);
            font-size: 18px;
            font-weight: 730;
        }

        .access-note {
            margin: 0 20px 20px;
            padding: 13px 14px;
            border: 1px solid #d7e9e6;
            border-radius: 9px;
            display: flex;
            align-items: flex-start;
            gap: 10px;
            background: #f6fbfa;
        }

        .access-note-icon {
            margin-top: 1px;
            color: var(--ca-primary-dark);
            font-size: 14px;
        }

        .access-note-title {
            color: var(--ca-text-soft);
            font-size: 11px;
            font-weight: 690;
        }

        .access-note-copy {
            margin-top: 3px;
            color: var(--ca-muted);
            font-size: 10px;
            line-height: 1.55;
        }

        .page-footer {
            min-height: 64px;
            margin-top: 30px;
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

        .page-footer span:first-child {
            color: #ffffff;
            font-weight: 620;
        }

        .sidebar-overlay {
            display: none;
        }

        @media (max-width: 991.98px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform .2s ease;
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .sidebar-overlay {
                position: fixed;
                inset: 0;
                z-index: 1050;
                background: rgba(16, 24, 40, .32);
            }

            .sidebar-overlay.show {
                display: block;
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

            .date-chip {
                display: none;
            }
        }

        @media (max-width: 767.98px) {
            :root {
                --topbar-height: 74px;
            }

            .topbar-subtitle,
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

            .scope-badge {
                white-space: normal;
            }

            .org-grid,
            .status-legend {
                grid-template-columns: 1fr;
            }
        }
        /* Executive Alert Banner Styles */
        .executive-alert-banner {
            border-radius: 12px;
            padding: 18px 22px;
            transition: all .2s ease;
        }

        .executive-alert-banner.alert-critical {
            background: linear-gradient(135deg, #fffaf9 0%, #fff1f0 100%);
            border: 1px solid #fecdca;
            border-left: 5px solid var(--ca-danger);
            box-shadow: 0 2px 10px rgba(180, 35, 24, 0.06);
        }

        .executive-alert-banner.alert-normal {
            background: linear-gradient(135deg, #fbfdfc 0%, #f0fdf4 100%);
            border: 1px solid #bbf7d0;
            border-left: 5px solid var(--ca-success);
            box-shadow: 0 2px 10px rgba(2, 122, 72, 0.05);
        }

        .alert-banner-icon {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            flex-shrink: 0;
        }

        .alert-banner-icon.danger {
            background: var(--ca-danger-soft);
            color: var(--ca-danger);
        }

        .alert-banner-icon.success {
            background: var(--ca-success-soft);
            color: var(--ca-success);
        }

        .alert-banner-kicker {
            font-size: 10px;
            font-weight: 750;
            letter-spacing: .08em;
            text-transform: uppercase;
            color: var(--ca-danger);
        }

        .alert-badge-urgent {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 2px 9px;
            border-radius: 999px;
            background: var(--ca-danger);
            color: #ffffff;
            font-size: 10.5px;
            font-weight: 700;
        }

        .alert-banner-title {
            margin: 5px 0 3px;
            font-size: 15px;
            font-weight: 750;
            color: #172033;
            line-height: 1.3;
        }

        .alert-banner-text {
            margin: 0;
            font-size: 12.5px;
            color: #475467;
            line-height: 1.5;
        }

        .alert-case-chip {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 10px;
            border-radius: 7px;
            font-size: 11px;
            background: #ffffff;
            border: 1px solid #e3e9e9;
            color: #344054;
            text-decoration: none;
            transition: all .15s ease;
        }

        .alert-case-chip:hover {
            border-color: var(--ca-primary);
            transform: translateY(-1px);
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        .alert-case-chip.chip-escalated {
            border-color: #fecdca;
        }

        .alert-case-chip.chip-stale {
            border-color: #fedf89;
        }

        .btn-alert-action {
            height: 38px;
            padding: 0 14px;
            border-radius: 9px;
            display: inline-flex;
            align-items: center;
            gap: 7px;
            font-size: 12px;
            font-weight: 650;
            text-decoration: none;
            white-space: nowrap;
            transition: all .15s ease;
        }

        .btn-alert-action.btn-danger-action {
            background: var(--ca-danger);
            color: #ffffff;
            border: 1px solid var(--ca-danger);
            box-shadow: 0 1px 3px rgba(180, 35, 24, 0.2);
        }

        .btn-alert-action.btn-danger-action:hover {
            background: #912018;
            color: #ffffff;
            transform: translateY(-1px);
        }

        .btn-alert-action.btn-warning-action {
            background: #ffffff;
            color: #b54708;
            border: 1px solid #fedf89;
        }

        .btn-alert-action.btn-warning-action:hover {
            background: #fffaeb;
            color: #b54708;
            border-color: #fec84b;
            transform: translateY(-1px);
        }

        .btn-alert-normal {
            height: 36px;
            padding: 0 13px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            gap: 7px;
            font-size: 11.5px;
            font-weight: 650;
            color: var(--ca-primary-dark);
            background: #ffffff;
            border: 1px solid #bbf7d0;
            text-decoration: none;
            transition: all .15s ease;
        }

        .btn-alert-normal:hover {
            background: #f0fdf4;
            color: var(--ca-primary-dark);
        }

        .alert-normal-text {
            font-size: 12px;
            color: #344054;
            margin-top: 3px;
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

    $totalStatusKasus = array_sum($statusChartValues);

    $statusPairs = collect($statusChartLabels)
        ->mapWithKeys(
            fn ($label, $index) => [
                $label => $statusChartValues[$index] ?? 0
            ]
        );
@endphp

<div class="app-shell">

    @include('admin.partials.sidebar')

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
                    Dashboard Admin
                </div>

                <div class="topbar-subtitle">
                    Ringkasan pengawasan dan administrasi sekolah
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
                aria-label="Buka profil Wakil Kesiswaan / Admin"
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

                <section class="page-header">

                    <div>
                        <div class="page-kicker">
                            Pengawasan Sekolah
                        </div>

                        <h1 class="page-title">
                            Ringkasan Sistem
                        </h1>

                        <p class="page-copy">
                            Pantau aktivitas utama CurhatAman dalam bentuk
                            ringkasan sekolah. Informasi rinci kasus reguler
                            tetap dikelola oleh Guru BK, sedangkan Admin
                            berfokus pada pengawasan, administrasi, dan
                            kasus yang telah dieskalasi.
                        </p>
                    </div>

                    <div class="scope-badge">
                        <i class="bi bi-shield-check"></i>
                        Akses pengawasan & administrasi
                    </div>

                </section>

                {{-- EXECUTIVE ALERT BANNER --}}
                @if ($totalKasusKritis > 0)
                    <section class="executive-alert-banner alert-critical mb-4">
                        <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3">
                            <div class="d-flex align-items-start gap-3">
                                <div class="alert-banner-icon danger">
                                    <i class="bi bi-exclamation-octagon-fill"></i>
                                </div>
                                <div>
                                    <div class="d-flex align-items-center gap-2 flex-wrap mb-1">
                                        <h3 class="alert-banner-title mb-0">
                                            Peringatan Siaga Kepala Sekolah
                                        </h3>
                                        <span class="alert-badge-urgent">
                                            <i class="bi bi-bell-fill"></i> {{ $totalKasusKritis }} Kasus Butuh Tindakan
                                        </span>
                                    </div>
                                    <p class="alert-banner-text">
                                        Terdapat 
                                        @if($kasusDieskalasi > 0)
                                            <strong>{{ $kasusDieskalasi }} kasus eskalasi</strong> (butuh arahan kepala sekolah)
                                        @endif
                                        @if($kasusDieskalasi > 0 && $kasusMangkrakCount > 0)
                                            dan
                                        @endif
                                        @if($kasusMangkrakCount > 0)
                                            <strong>{{ $kasusMangkrakCount }} kasus mangkrak</strong> (&gt; {{ $staleDays }} hari tanpa pembaruan Guru BK).
                                        @endif
                                    </p>

                                    @if(isset($kasusKritisHighlights) && $kasusKritisHighlights->isNotEmpty())
                                        <div class="alert-case-chips d-flex align-items-center gap-2 flex-wrap mt-2">
                                            <span class="text-muted small fw-semibold" style="font-size: 11px;">Buka cepat:</span>
                                            @foreach($kasusKritisHighlights as $kritis)
                                                <a href="{{ $kritis->status_kasus === 'dieskalasi' ? route('admin.kasus-eskalasi.show', $kritis->id) : route('admin.kasus-mangkrak.show', $kritis->id) }}" class="alert-case-chip {{ $kritis->status_kasus === 'dieskalasi' ? 'chip-escalated' : 'chip-stale' }}" title="Buka detail kasus #{{ $kritis->kode_laporan }}">
                                                    <span class="fw-bold">#{{ $kritis->kode_laporan }}</span>
                                                    <span>({{ $kritis->nama_kategori }})</span>
                                                    <span class="badge {{ $kritis->status_kasus === 'dieskalasi' ? 'bg-danger text-white' : 'bg-warning-subtle text-dark border border-warning' }}" style="font-size: 9.5px;">
                                                        {{ $kritis->status_kasus === 'dieskalasi' ? 'Eskalasi' : 'Mangkrak' }}
                                                    </span>
                                                    <i class="bi bi-arrow-right-short text-muted" style="font-size: 13px;"></i>
                                                </a>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="alert-banner-actions d-flex align-items-center gap-2 flex-shrink-0">
                                @if($kasusDieskalasi > 0)
                                    <a href="{{ route('admin.kasus-eskalasi.index') }}" class="btn-alert-action btn-danger-action">
                                        <i class="bi bi-exclamation-diamond"></i>
                                        <span>Kasus Eskalasi ({{ $kasusDieskalasi }})</span>
                                    </a>
                                @endif
                                @if($kasusMangkrakCount > 0)
                                    <a href="{{ route('admin.kasus-mangkrak.index') }}" class="btn-alert-action btn-warning-action">
                                        <i class="bi bi-hourglass-split"></i>
                                        <span>Kasus Mangkrak ({{ $kasusMangkrakCount }})</span>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </section>
                @else
                    <section class="executive-alert-banner alert-normal mb-4">
                        <div class="d-flex align-items-center justify-content-between gap-3 flex-wrap">
                            <div class="d-flex align-items-center gap-3">
                                <div class="alert-banner-icon success">
                                    <i class="bi bi-shield-check"></i>
                                </div>
                                <div>
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="alert-banner-kicker text-success">STATUS PENGAWASAN SEKOLAH</span>
                                        <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-0.5" style="font-size: 10px; font-weight: 650;">Kondusif & Terkendali</span>
                                    </div>
                                    <div class="alert-normal-text">
                                        Tidak ada kasus eskalasi darurat maupun kasus mangkrak (&gt; {{ $staleDays }} hari). Seluruh alur penanganan siswa berjalan aktif dan terpantau lancar.
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.laporan-kebijakan.index') }}" class="btn-alert-normal">
                                    <i class="bi bi-file-earmark-bar-graph"></i>
                                    <span>Lihat Laporan Kebijakan</span>
                                </a>
                            </div>
                        </div>
                    </section>
                @endif

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

                                <span class="metric-icon primary">
                                    <i class="bi bi-mortarboard"></i>
                                </span>

                            </div>

                            <div class="metric-note">
                                Akun siswa aktif pada CurhatAman
                            </div>

                        </div>
                    </div>

                    <div class="col-sm-6 col-xl-3">
                        <div class="metric-card active-cases">

                            <div class="metric-top">

                                <div>
                                    <div class="metric-label">
                                        Kasus Aktif
                                    </div>

                                    <div class="metric-value">
                                        {{ $kasusAktif }}
                                    </div>
                                </div>

                                <span class="metric-icon warning">
                                    <i class="bi bi-hourglass-split"></i>
                                </span>

                            </div>

                            <div class="metric-note">
                                Status baru, diproses, dan dieskalasi
                            </div>

                        </div>
                    </div>

                    <div class="col-sm-6 col-xl-3">
                        <div class="metric-card escalated">

                            <div class="metric-top">

                                <div>
                                    <div class="metric-label">
                                        Kasus Dieskalasi
                                    </div>

                                    <div class="metric-value">
                                        {{ $kasusDieskalasi }}
                                    </div>
                                </div>

                                <span class="metric-icon danger">
                                    <i class="bi bi-exclamation-diamond"></i>
                                </span>

                            </div>

                            <div class="metric-note">
                                Kasus yang memerlukan perhatian tingkat sekolah
                            </div>

                        </div>
                    </div>

                    <div class="col-sm-6 col-xl-3">
                        <div class="metric-card counselors">

                            <div class="metric-top">

                                <div>
                                    <div class="metric-label">
                                        Guru BK Aktif
                                    </div>

                                    <div class="metric-value">
                                        {{ $guruBkAktif }}
                                    </div>
                                </div>

                                <span class="metric-icon success">
                                    <i class="bi bi-person-check"></i>
                                </span>

                            </div>

                            <div class="metric-note">
                                Akun Guru BK aktif pada sistem
                            </div>

                        </div>
                    </div>

                </section>

                <section class="row g-3 mb-4">

                    <div class="col-xl-8">

                        <div class="panel h-100 teal-accent">

                            <div class="panel-header">

                                <div>
                                    <h2 class="panel-title">
                                        Tren Laporan 6 Bulan
                                    </h2>

                                    <p class="panel-copy">
                                        Perkembangan jumlah laporan yang telah
                                        dikirim siswa setiap bulan.
                                    </p>
                                </div>

                            </div>

                            <div class="chart-wrap">
                                <canvas id="trendKasusChart"></canvas>
                            </div>

                        </div>

                    </div>

                    <div class="col-xl-4">

                        <div class="panel h-100 danger-accent">

                            <div class="panel-header">

                                <div>
                                    <h2 class="panel-title">
                                        Distribusi Status Kasus
                                    </h2>

                                    <p class="panel-copy">
                                        Ringkasan seluruh laporan non-draft
                                        berdasarkan status penanganan.
                                    </p>
                                </div>

                            </div>

                            <div class="chart-wrap status">
                                <canvas id="statusKasusChart"></canvas>
                            </div>

                            <div class="status-legend">

                                <div class="legend-item">
                                    <div class="legend-label">Baru</div>
                                    <div class="legend-value">
                                        {{ $statusPairs['Baru'] ?? 0 }}
                                    </div>
                                </div>

                                <div class="legend-item">
                                    <div class="legend-label">Diproses</div>
                                    <div class="legend-value">
                                        {{ $statusPairs['Diproses'] ?? 0 }}
                                    </div>
                                </div>

                                <div class="legend-item">
                                    <div class="legend-label">Selesai</div>
                                    <div class="legend-value">
                                        {{ $statusPairs['Selesai'] ?? 0 }}
                                    </div>
                                </div>

                                <div class="legend-item">
                                    <div class="legend-label">Dieskalasi</div>
                                    <div class="legend-value">
                                        {{ $statusPairs['Dieskalasi'] ?? 0 }}
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>

                </section>

                <section class="row g-3">

                    <div class="col-xl-7">

                        <div class="panel h-100">

                            <div class="panel-header">

                                <div>
                                    <h2 class="panel-title">
                                        Kasus Dieskalasi Terbaru
                                    </h2>

                                    <p class="panel-copy">
                                        Kasus yang telah dinaikkan ke tingkat
                                        pengawasan sekolah.
                                    </p>
                                </div>

                            </div>

                            @forelse ($kasusDieskalasiTerbaru as $item)

                                @if ($loop->first)
                                    <div class="escalation-list">
                                @endif

                                <div class="escalation-item">

                                    <div>
                                        <div class="escalation-code">
                                            {{ $item->kode_laporan }}
                                        </div>

                                        <div class="escalation-meta">
                                            Diperbarui
                                            {{ \Carbon\Carbon::parse($item->updated_at)
                                                ->locale('id')
                                                ->diffForHumans() }}
                                        </div>
                                    </div>

                                    <span class="escalation-badge">
                                        Dieskalasi
                                    </span>

                                </div>

                                @if ($loop->last)
                                    </div>
                                @endif

                            @empty

                                <div class="empty-state">

                                    <div class="empty-icon">
                                        <i class="bi bi-check2"></i>
                                    </div>

                                    <div class="fw-semibold mb-1">
                                        Tidak ada kasus dieskalasi
                                    </div>

                                    <div>
                                        Belum ada kasus yang membutuhkan
                                        pengawasan tingkat sekolah saat ini.
                                    </div>

                                </div>

                            @endforelse

                        </div>

                    </div>

                    <div class="col-xl-5">

                        <div class="panel h-100">

                            <div class="panel-header">

                                <div>
                                    <h2 class="panel-title">
                                        Ringkasan Organisasi
                                    </h2>

                                    <p class="panel-copy">
                                        Kondisi pengguna dan kelas aktif pada sistem.
                                    </p>
                                </div>

                            </div>

                            <div class="org-grid">

                                <div class="org-card">
                                    <div class="org-label">
                                        Kelas Aktif
                                    </div>

                                    <div class="org-value">
                                        {{ $totalKelas }}
                                    </div>
                                </div>

                                <div class="org-card">
                                    <div class="org-label">
                                        Wali Kelas Aktif
                                    </div>

                                    <div class="org-value">
                                        {{ $waliKelasAktif }}
                                    </div>
                                </div>

                                <div class="org-card">
                                    <div class="org-label">
                                        Selesai Bulan Ini
                                    </div>

                                    <div class="org-value">
                                        {{ $kasusSelesaiBulanIni }}
                                    </div>
                                </div>

                            </div>

                            <div class="access-note">

                                <span class="access-note-icon">
                                    <i class="bi bi-info-circle"></i>
                                </span>

                                <div>
                                    <div class="access-note-title">
                                        Batas akses Admin
                                    </div>

                                    <div class="access-note-copy">
                                        Dashboard rutin menampilkan data agregat.
                                        Detail laporan reguler tetap ditangani oleh
                                        Guru BK. Akses Admin terhadap detail kasus
                                        difokuskan pada kasus dieskalasi atau kasus
                                        yang memerlukan intervensi tingkat sekolah.
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>

                </section>

                <footer class="page-footer">

                    <div
                        class="d-flex flex-column flex-md-row justify-content-between gap-2"
                    >
                        <span>
                            © {{ date('Y') }} CurhatAman
                        </span>

                        <span>
                            Portal Admin Sekolah · Pengawasan sistem
                        </span>
                    </div>

                </footer>

            </div>

        </div>

    </main>

</div>

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
></script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const trendLabels = @json($trenLabels);
    const trendValues = @json($trenValues);

    const statusLabels = @json($statusChartLabels);
    const statusValues = @json($statusChartValues);

    const trendCanvas = document.getElementById('trendKasusChart');

    if (trendCanvas) {
        new Chart(trendCanvas, {
            type: 'line',
            data: {
                labels: trendLabels,
                datasets: [
                    {
                        label: 'Jumlah Laporan',
                        data: trendValues,
                        borderColor: '#0f8a83',
                        backgroundColor: 'rgba(15,138,131,.08)',
                        borderWidth: 2.5,
                        tension: .32,
                        fill: true,
                        pointRadius: 3.5,
                        pointHoverRadius: 5,
                        pointBackgroundColor: '#ffffff',
                        pointBorderColor: '#0f8a83',
                        pointBorderWidth: 2
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    mode: 'index',
                    intersect: false
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        padding: 10,
                        displayColors: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0,
                            color: '#667085',
                            font: {
                                size: 10
                            }
                        },
                        grid: {
                            color: '#eef2f2',
                            drawBorder: false
                        }
                    },
                    x: {
                        ticks: {
                            color: '#667085',
                            font: {
                                size: 10
                            }
                        },
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    }

    const statusCanvas = document.getElementById('statusKasusChart');

    if (statusCanvas) {
        new Chart(statusCanvas, {
            type: 'doughnut',
            data: {
                labels: statusLabels,
                datasets: [
                    {
                        data: statusValues,
                        backgroundColor: [
                            '#0f8a83',
                            '#6fa9a4',
                            '#8fbd9f',
                            '#d67b73'
                        ],
                        borderColor: '#ffffff',
                        borderWidth: 3,
                        hoverOffset: 3
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '70%',
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        padding: 10
                    }
                }
            }
        });
    }

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
