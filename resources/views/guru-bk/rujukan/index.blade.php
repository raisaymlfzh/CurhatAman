<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Rujukan - Guru BK - CurhatAman</title>

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
            --ca-warning: #9a650f;
            --ca-warning-soft: #fff7e8;
            --ca-danger: #b42318;
            --ca-danger-soft: #fff1f0;
            --ca-info: #2d6f9f;
            --ca-info-soft: #eef6fb;
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

        .brand-copy {
            min-width: 0;
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

        .sidebar-link.active {
            color: var(--ca-primary-dark);
            background: var(--ca-primary-soft);
            font-weight: 680;
        }

        .sidebar-link.active i {
            color: var(--ca-primary);
        }

        .sidebar-link.disabled {
            color: #667085;
            cursor: default;
        }

        .sidebar-link.disabled:hover {
            color: #667085;
            background: transparent;
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
            max-width: 1240px;
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
            max-width: 760px;
            margin: 0;
            color: rgba(255, 255, 255, .82);
            font-size: 12px;
            line-height: 1.6;
        }

        .btn-primary-ca {
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

        .btn-primary-ca:hover,
        .btn-primary-ca:focus {
            color: #ffffff;
            background: rgba(255, 255, 255, .20);
            border-color: rgba(255, 255, 255, .52);
        }

        .empty-state .btn-primary-ca {
            border-color: var(--ca-primary);
            color: #ffffff;
            background: var(--ca-primary);
        }

        .empty-state .btn-primary-ca:hover {
            background: var(--ca-primary-dark);
            border-color: var(--ca-primary-dark);
        }

        .metric-card {
            height: 100%;
            min-height: 122px;
            padding: 17px 18px;
            border: 1px solid var(--ca-border);
            border-top: 3px solid #d6dddd;
            border-radius: 12px;
            background: #ffffff;
        }

        .metric-card.total {
            border-top-color: var(--ca-primary);
        }

        .metric-card.new {
            border-top-color: #4f8fb8;
        }

        .metric-card.progress {
            border-top-color: #d99a2b;
        }

        .metric-card.done {
            border-top-color: #35a36f;
        }

        .metric-label {
            color: var(--ca-muted);
            font-size: 10.5px;
            font-weight: 620;
        }

        .metric-number {
            margin-top: 7px;
            color: var(--ca-text);
            font-size: 25px;
            line-height: 1;
            font-weight: 760;
        }

        .metric-note {
            margin-top: 8px;
            color: var(--ca-muted-light);
            font-size: 10px;
        }

        .metric-icon {
            width: 36px;
            height: 36px;
            flex: 0 0 36px;
            border-radius: 9px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: var(--ca-primary-dark);
            background: var(--ca-primary-soft);
            font-size: 15px;
        }

        .metric-card.new .metric-icon {
            color: var(--ca-info);
            background: var(--ca-info-soft);
        }

        .metric-card.progress .metric-icon {
            color: var(--ca-warning);
            background: var(--ca-warning-soft);
        }

        .metric-card.done .metric-icon {
            color: var(--ca-success);
            background: var(--ca-success-soft);
        }

        .filter-card {
            margin-bottom: 18px;
            padding: 18px;
            border: 1px solid var(--ca-border);
            border-top: 3px solid var(--ca-primary);
            border-radius: 12px;
            background: #ffffff;
        }

        .form-label {
            margin-bottom: 7px;
            color: #475467;
            font-size: 10.5px;
            font-weight: 650;
        }

        .form-control,
        .form-select {
            min-height: 42px;
            border: 1px solid #d8e1e1;
            border-radius: 9px;
            color: var(--ca-text);
            background-color: #ffffff;
            font-size: 12px;
            box-shadow: none;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: rgba(15, 138, 131, .58);
            box-shadow: 0 0 0 .2rem rgba(15, 138, 131, .08);
        }

        .btn-filter,
        .btn-reset,
        .btn-save-status {
            min-height: 42px;
            padding: 0 14px;
            border-radius: 9px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            font-size: 11.5px;
            font-weight: 650;
        }

        .btn-filter {
            border: 1px solid var(--ca-primary);
            color: #ffffff;
            background: var(--ca-primary);
        }

        .btn-filter:hover {
            color: #ffffff;
            background: var(--ca-primary-dark);
            border-color: var(--ca-primary-dark);
        }

        .btn-reset,
        .btn-save-status {
            border: 1px solid var(--ca-border);
            color: #475467;
            background: #ffffff;
        }

        .btn-save-status {
            min-height: 36px;
            padding: 0 10px;
        }

        .btn-reset:hover,
        .btn-save-status:hover {
            color: var(--ca-primary-dark);
            background: var(--ca-primary-soft);
            border-color: #cfe4e1;
        }

        .period-context {
            min-height: 42px;
            padding: 9px 12px;
            border: 1px solid #d4e8e5;
            border-radius: 9px;
            display: flex;
            align-items: center;
            gap: 10px;
            color: #526663;
            background: #f5faf9;
            font-size: 10.5px;
            line-height: 1.5;
        }

        .period-context i,
        .period-context strong {
            color: var(--ca-primary-dark);
        }

        .content-card {
            overflow: hidden;
            border: 1px solid var(--ca-border);
            border-top: 3px solid var(--ca-primary);
            border-radius: 12px;
            background: #ffffff;
        }

        .content-card-header {
            padding: 16px 18px;
            border-bottom: 1px solid var(--ca-line);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            background: #ffffff;
        }

        .content-title {
            margin-bottom: 2px;
            color: var(--ca-text);
            font-size: 13px;
            font-weight: 710;
        }

        .content-subtitle,
        .result-count {
            color: var(--ca-muted);
            font-size: 10.5px;
        }

        .data-table {
            min-width: 1180px;
            margin-bottom: 0;
        }

        .data-table thead th {
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

        .data-table tbody td {
            padding: 13px 14px;
            border-color: var(--ca-line);
            color: #475467;
            background: #ffffff;
            font-size: 11px;
            vertical-align: middle;
        }

        .data-table tbody tr:hover td {
            background: #fbfdfd;
        }

        .student-name {
            color: var(--ca-text);
            font-size: 11.5px;
            font-weight: 670;
        }

        .meta {
            margin-top: 2px;
            color: var(--ca-muted);
            font-size: 10px;
        }

        .service-contact {
            margin-top: 5px;
            display: flex;
            flex-direction: column;
            gap: 3px;
            color: var(--ca-muted);
            font-size: 10px;
            line-height: 1.45;
        }

        .service-contact a {
            color: var(--ca-primary-dark);
            font-weight: 650;
        }

        .service-contact a:hover {
            color: var(--ca-primary);
        }

        .service-contact .unavailable {
            color: var(--ca-muted-light);
        }

        .reason {
            max-width: 250px;
            color: #475467;
            font-size: 10.8px;
            line-height: 1.5;
        }

        .source-chip {
            padding: 5px 8px;
            border-radius: 7px;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            color: #475467;
            background: #f3f5f5;
            font-size: 9.8px;
            font-weight: 650;
            white-space: nowrap;
        }

        .status-readonly {
            padding: 5px 9px;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 9.8px;
            font-weight: 700;
            white-space: nowrap;
        }

        .status-readonly-baru {
            color: var(--ca-info);
            background: var(--ca-info-soft);
        }

        .status-readonly-diproses {
            color: var(--ca-warning);
            background: var(--ca-warning-soft);
        }

        .status-readonly-selesai {
            color: var(--ca-success);
            background: var(--ca-success-soft);
        }

        .owner-badge {
            margin-top: 5px;
            padding: 4px 8px;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            color: var(--ca-primary-dark);
            background: var(--ca-primary-soft);
            font-size: 9.5px;
            font-weight: 680;
        }

        .limited-text {
            color: var(--ca-muted-light);
            font-size: 10px;
            line-height: 1.45;
        }

        .status-select {
            min-width: 110px;
            min-height: 36px;
            padding-top: 5px;
            padding-bottom: 5px;
            font-size: 10.5px;
        }

        .alert {
            border-radius: 9px;
            font-size: 11.5px;
        }

        .empty-state {
            padding: 46px 20px;
            color: var(--ca-muted);
            text-align: center;
        }

        .empty-icon {
            width: 42px;
            height: 42px;
            margin-bottom: 11px;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: var(--ca-primary);
            background: var(--ca-primary-soft);
        }

        .pagination-wrap {
            padding: 14px 18px;
            border-top: 1px solid var(--ca-line);
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

            .page-body {
                padding: 22px 18px 30px;
            }
        }

        @media (max-width: 767.98px) {
            .page-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .page-header .btn-primary-ca {
                width: 100%;
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

        .student-contact{
            display:flex;
            flex-direction:column;
            gap:6px;
            min-width:150px;
        }

        .student-contact-number{
            color:var(--ca-text);
            font-size:.76rem;
            font-weight:650;
        }

        .student-contact-status{
            display:inline-flex;
            align-items:center;
            gap:5px;
            color:var(--ca-muted);
            font-size:.68rem;
            line-height:1.35;
        }

        .student-contact-status.allowed{
            color:#087443;
        }

        .btn-whatsapp-student{
            width:fit-content;
            min-height:34px;
            padding:6px 10px;
            border:1px solid #b9dfcb;
            border-radius:8px;
            display:inline-flex;
            align-items:center;
            justify-content:center;
            gap:6px;
            color:#0f6541;
            background:#f4fbf7;
            font-size:.7rem;
            font-weight:650;
            white-space:nowrap;
        }

        .btn-whatsapp-student:hover,
        .btn-whatsapp-student:focus{
            color:#0b5b3a;
            border-color:#86c8a5;
            background:#eaf7ef;
        }

        .btn-action {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 1px solid transparent;
            font-size: 13px;
            transition: all .15s ease;
        }

        .btn-action-view {
            color: var(--ca-primary-dark);
            background: var(--ca-primary-soft);
            border-color: #cfe4e1;
        }

        .btn-action-view:hover {
            background: #d4ebe8;
            color: var(--ca-primary);
        }

        .btn-action-edit {
            color: #475467;
            background: #f2f4f7;
            border-color: #eaecf0;
        }

        .btn-action-edit:hover {
            background: #e4e7ec;
            color: #344054;
        }

        .btn-action-delete {
            color: var(--ca-danger);
            background: #fef3f2;
            border-color: #fee4e2;
        }

        .btn-action-delete:hover {
            background: #fee4e2;
            color: #b42318;
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
                    Rujukan
                </div>

                <div class="topbar-subtitle">
                    Kelola tindak lanjut ke layanan eksternal.
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
                            Pendampingan Lanjutan
                        </div>

                        <h1 class="page-title">
                            Rujukan Siswa
                        </h1>

                        <p class="page-copy">Kelola tindak lanjut ke layanan eksternal.</p>
                    </div>

                    <a
                        href="{{ route('guru-bk.rujukan.create') }}"
                        class="btn-primary-ca"
                    >
                        <i class="bi bi-plus-lg"></i>
                        Buat Rujukan
                    </a>
                </section>

                @if (session('success'))
                    <div
                        class="alert alert-success"
                        role="alert"
                    >
                        <i class="bi bi-check-circle me-1"></i>
                        {{ session('success') }}
                    </div>
                @endif

                <section class="row g-3 mb-4">

                    <div class="col-sm-6 col-xl-3">
                        <div class="metric-card total">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="metric-label">Total Rujukan</div>
                                    <div class="metric-number">{{ $summary['total'] }}</div>
                                    <div class="metric-note">Pada periode terpilih</div>
                                </div>

                                <span class="metric-icon">
                                    <i class="bi bi-life-preserver"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xl-3">
                        <div class="metric-card new">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="metric-label">Baru</div>
                                    <div class="metric-number">{{ $summary['baru'] }}</div>
                                    <div class="metric-note">Belum diproses</div>
                                </div>

                                <span class="metric-icon">
                                    <i class="bi bi-inbox"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xl-3">
                        <div class="metric-card progress">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="metric-label">Diproses</div>
                                    <div class="metric-number">{{ $summary['diproses'] }}</div>
                                    <div class="metric-note">Sedang ditindaklanjuti</div>
                                </div>

                                <span class="metric-icon">
                                    <i class="bi bi-arrow-repeat"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xl-3">
                        <div class="metric-card done">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="metric-label">Selesai</div>
                                    <div class="metric-number">{{ $summary['selesai'] }}</div>
                                    <div class="metric-note">Rujukan selesai</div>
                                </div>

                                <span class="metric-icon">
                                    <i class="bi bi-check2-circle"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                </section>

                <form
                    method="GET"
                    action="{{ route('guru-bk.rujukan.index') }}"
                    class="filter-card"
                >

                    <div class="row g-3 align-items-end mb-3">

                        <div class="col-sm-6 col-lg-3">
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

                        <div class="col-sm-6 col-lg-3">
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

                        <div class="col-lg-6">
                            <label class="form-label">
                                Arsip Periode
                            </label>

                            <div class="period-context">
                                <i class="bi bi-archive"></i>

                                <span>
                                    Menampilkan rujukan
                                    <strong>{{ $tahunAjaran }}</strong>
                                    semester
                                    <strong>{{ ucfirst($semester) }}</strong>,
                                    {{ $startDate->locale('id')->translatedFormat('d M Y') }}
                                    s.d.
                                    {{ $endDate->locale('id')->translatedFormat('d M Y') }}.
                                </span>
                            </div>
                        </div>

                    </div>

                    <div class="row g-3 align-items-end">

                        <div class="col-lg-5">
                            <label
                                for="q"
                                class="form-label"
                            >
                                Cari
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                id="q"
                                name="q"
                                value="{{ $search }}"
                                placeholder="Nama siswa, NIS, layanan, atau alasan"
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
                                <option value="">Semua Status</option>
                                <option value="baru" @selected($status === 'baru')>Baru</option>
                                <option value="diproses" @selected($status === 'diproses')>Diproses</option>
                                <option value="selesai" @selected($status === 'selesai')>Selesai</option>
                            </select>
                        </div>

                        <div class="col-sm-6 col-lg-3">
                            <label
                                for="jenis"
                                class="form-label"
                            >
                                Jenis Layanan
                            </label>

                            <select
                                class="form-select"
                                id="jenis"
                                name="jenis"
                            >
                                <option value="">Semua Jenis</option>

                                @foreach ($jenisLayanan as $itemJenis)
                                    <option
                                        value="{{ $itemJenis }}"
                                        @selected($jenis === $itemJenis)
                                    >
                                        {{ ucwords(str_replace('_', ' ', $itemJenis)) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-lg-2">
                            <div class="d-flex gap-2">
                                <button
                                    type="submit"
                                    class="btn-filter flex-grow-1"
                                >
                                    <i class="bi bi-search"></i>
                                    Filter
                                </button>

                                <a
                                    href="{{ route('guru-bk.rujukan.index') }}"
                                    class="btn-reset"
                                    title="Kembali ke periode aktif"
                                >
                                    <i class="bi bi-arrow-counterclockwise"></i>
                                </a>
                            </div>
                        </div>

                    </div>

                </form>

                <section class="content-card">

                    <div class="content-card-header">
                        <div>
                            <div class="content-title">
                                Daftar Rujukan
                            </div>

                            <div class="content-subtitle">
                                Rujukan yang telah dibuat oleh Guru BK
                            </div>
                        </div>

                        <div class="result-count">
                            {{ $rujukan->total() }} data
                        </div>
                    </div>

                    @if ($rujukan->isEmpty())

                        <div class="empty-state">
                            <div class="empty-icon">
                                <i class="bi bi-life-preserver"></i>
                            </div>

                            <div class="fw-semibold mb-1">
                                Belum Ada Rujukan
                            </div>

                            <div class="small mb-3">
                                Tidak ada rujukan pada
                                {{ $tahunAjaran }} semester
                                {{ ucfirst($semester) }}
                                untuk filter yang dipilih.
                            </div>

                            <a
                                href="{{ route('guru-bk.rujukan.create') }}"
                                class="btn-primary-ca"
                            >
                                <i class="bi bi-plus-lg"></i>
                                Buat Rujukan
                            </a>
                        </div>

                    @else

                        <div class="table-responsive">

                            <table class="table data-table align-middle">

                                <thead>
                                    <tr>
                                        <th>Siswa</th>
                                        <th>Tujuan</th>
                                        <th>Sumber</th>
                                        <th>Penanggung Jawab</th>
                                        <th>Kontak Siswa</th>
                                        <th>Alasan</th>
                                        <th>Dibuat</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @foreach ($rujukan as $item)

                                        <tr>

                                            @php
                                                $isOwner = (int) $item->created_by_user_id
                                                    === (int) $user->id;
                                            @endphp

                                            <td>
                                                <div class="student-name">
                                                    {{ $item->nama_siswa }}
                                                </div>

                                                @if ($isOwner)
                                                    <div class="meta">
                                                        {{ $item->nis
                                                            ? 'NIS ' . $item->nis
                                                            : 'NIS belum tersedia' }}
                                                    </div>
                                                @endif

                                                @if ($item->nama_kelas)
                                                    <div class="meta">
                                                        {{ $item->nama_kelas }}
                                                    </div>
                                                @endif
                                            </td>

                                            <td>
                                                <div class="student-name">
                                                    {{ $item->nama_layanan }}
                                                </div>

                                                <div class="meta">
                                                    {{ ucwords(
                                                        str_replace(
                                                            '_',
                                                            ' ',
                                                            $item->jenis_layanan
                                                        )
                                                    ) }}
                                                </div>

                                                <div class="service-contact">
                                                    @if ($item->kontak)
                                                        <span>
                                                            <i class="bi bi-telephone"></i>
                                                            {{ $item->kontak }}
                                                        </span>
                                                    @else
                                                        <span class="unavailable">
                                                            Kontak belum dikonfigurasi
                                                        </span>
                                                    @endif

                                                    @if ($item->alamat_url)
                                                        <a
                                                            href="{{ $item->alamat_url }}"
                                                            target="_blank"
                                                            rel="noopener noreferrer"
                                                        >
                                                            <i class="bi bi-box-arrow-up-right"></i>
                                                            Buka alamat layanan
                                                        </a>
                                                    @endif
                                                </div>
                                            </td>

                                            <td>
                                                @if ($isOwner)
                                                    @if ($item->laporan_id)
                                                        <span class="source-chip">
                                                            <i class="bi bi-file-earmark-text"></i>
                                                            {{ $item->kode_laporan ?? 'Laporan' }}
                                                        </span>
                                                    @elseif ($item->skrining_id)
                                                        <span class="source-chip">
                                                            <i class="bi bi-clipboard2-pulse"></i>
                                                            Skrining #{{ $item->skrining_id }}
                                                        </span>
                                                    @else
                                                        <span class="source-chip">
                                                            <i class="bi bi-person-check"></i>
                                                            Pendampingan langsung
                                                        </span>
                                                    @endif
                                                @else
                                                    <span class="limited-text">
                                                        Detail sumber dibatasi
                                                    </span>
                                                @endif
                                            </td>

                                            <td>
                                                <div class="student-name">
                                                    {{ $item->dibuat_oleh }}
                                                </div>

                                                @if ($isOwner)
                                                    <span class="owner-badge">
                                                        <i class="bi bi-person-check"></i>
                                                        Penanggung jawab
                                                    </span>
                                                @else
                                                    <div class="meta">
                                                        Guru BK penanggung jawab
                                                    </div>
                                                @endif
                                            </td>

                                            <td>
                                                @if ($isOwner)
                                                    @php
                                                        $nomorWhatsapp = $item->whatsapp_number;

                                                        $nomorWhatsappDisplay = $nomorWhatsapp
                                                            ? (
                                                                str_starts_with($nomorWhatsapp, '62')
                                                                    ? '0' . substr($nomorWhatsapp, 2)
                                                                    : $nomorWhatsapp
                                                            )
                                                            : null;

                                                        $pesanWhatsapp = rawurlencode(
                                                            "Halo {$item->nama_siswa}, ada pemberitahuan dari layanan Bimbingan & Konseling CurhatAman. Silakan cek akun CurhatAman kamu melalui tautan berikut:\n" . url('/') . "\n\natau hubungi Guru BK sekolah untuk informasi selengkapnya."
                                                        );

                                                        $whatsappUrl = $nomorWhatsapp
                                                            ? 'https://wa.me/' . $nomorWhatsapp . '?text=' . $pesanWhatsapp
                                                            : null;
                                                    @endphp

                                                    <div class="student-contact">
                                                        <div class="student-contact-number">
                                                            {{ $nomorWhatsappDisplay ?: 'Belum tersedia' }}
                                                        </div>

                                                        @if ($nomorWhatsapp)
                                                            <div class="student-contact-status allowed">
                                                                <i class="bi bi-check-circle"></i>
                                                                Izin WhatsApp aktif
                                                            </div>

                                                            <a
                                                                href="{{ $whatsappUrl }}"
                                                                target="_blank"
                                                                rel="noopener noreferrer"
                                                                class="btn-whatsapp-student"
                                                            >
                                                                <i class="bi bi-whatsapp"></i>
                                                                Hubungi
                                                            </a>
                                                        @else
                                                            <div class="student-contact-status">
                                                                <i class="bi bi-dash-circle"></i>
                                                                Nomor belum tersedia
                                                            </div>
                                                        @endif
                                                    </div>
                                                @else
                                                    <span class="limited-text">
                                                        Kontak dibatasi untuk Guru BK penanggung jawab.
                                                    </span>
                                                @endif
                                            </td>

                                            <td>
                                                @if ($isOwner)
                                                    <div class="reason">
                                                        {{ \Illuminate\Support\Str::limit(
                                                            $item->alasan_rujukan,
                                                            95
                                                        ) }}
                                                    </div>
                                                @else
                                                    <span class="limited-text">
                                                        Hanya dapat dilihat oleh Guru BK penanggung jawab.
                                                    </span>
                                                @endif
                                            </td>

                                            <td>
                                                {{ $item->referred_at
                                                    ? \Carbon\Carbon::parse(
                                                        $item->referred_at
                                                    )->format('d M Y, H:i')
                                                    : '-' }}
                                            </td>

                                            <td>
                                                @if ($isOwner)
                                                    <form
                                                        method="POST"
                                                        action="{{ route(
                                                            'guru-bk.rujukan.status',
                                                            $item->id
                                                        ) }}"
                                                        class="d-flex gap-2 align-items-center mb-2"
                                                    >
                                                        @csrf
                                                        @method('PATCH')

                                                        <select
                                                            name="status"
                                                            class="form-select status-select"
                                                        >
                                                            <option
                                                                value="baru"
                                                                @selected($item->status === 'baru')
                                                            >
                                                                Baru
                                                            </option>

                                                            <option
                                                                value="diproses"
                                                                @selected($item->status === 'diproses')
                                                            >
                                                                Diproses
                                                            </option>

                                                            <option
                                                                value="selesai"
                                                                @selected($item->status === 'selesai')
                                                            >
                                                                Selesai
                                                            </option>
                                                        </select>

                                                        <button
                                                            type="submit"
                                                            class="btn-save-status"
                                                            title="Simpan status"
                                                        >
                                                            <i class="bi bi-check-lg"></i>
                                                        </button>
                                                    </form>
                                                @else
                                                    @php
                                                        $statusClass = match ($item->status) {
                                                            'baru' => 'status-readonly-baru',
                                                            'diproses' => 'status-readonly-diproses',
                                                            'selesai' => 'status-readonly-selesai',
                                                            default => '',
                                                        };
                                                    @endphp

                                                    <span class="status-readonly {{ $statusClass }} mb-2 d-inline-block">
                                                        {{ ucfirst($item->status) }}
                                                    </span>
                                                @endif
                                            </td>

                                            <td>
                                                <div class="d-flex gap-2">
                                                    <a href="{{ route('guru-bk.rujukan.show', $item->id) }}" class="btn-action btn-action-view" title="Lihat Detail">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                    @if ($isOwner)
                                                        <a href="{{ route('guru-bk.rujukan.edit', $item->id) }}" class="btn-action btn-action-edit" title="Edit">
                                                            <i class="bi bi-pencil"></i>
                                                        </a>
                                                        <form method="POST" action="{{ route('guru-bk.rujukan.destroy', $item->id) }}" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus rujukan ini?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn-action btn-action-delete" title="Hapus">
                                                                <i class="bi bi-trash"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </td>

                                        </tr>

                                    @endforeach

                                </tbody>

                            </table>

                        </div>

                        @if ($rujukan->hasPages())
                            <div class="pagination-wrap">
                                {{ $rujukan->links() }}
                            </div>
                        @endif

                    @endif

                </section>

                <footer class="page-footer">
                    <div
                        class="d-flex flex-column flex-md-row
                               justify-content-between gap-2"
                    >
                        <span>© {{ date('Y') }} CurhatAman</span>
                        <span>Portal Guru BK · Pendampingan dan rujukan siswa</span>
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

