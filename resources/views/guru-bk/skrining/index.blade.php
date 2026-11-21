<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Skrining Siswa - Guru BK - CurhatAman</title>

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
            background: var(--ca-primary);
        }

        .page-heading-row {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 20px;
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

        .btn-manage-screening {
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

        .btn-manage-screening:hover,
        .btn-manage-screening:focus {
            color: #ffffff;
            background: rgba(255, 255, 255, .20);
            border-color: rgba(255, 255, 255, .52);
        }

        .notice-card {
            margin-bottom: 20px;
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

        .notice-card i {
            margin-top: 1px;
            color: var(--ca-primary);
            font-size: 14px;
        }

        .notice-card strong {
            color: var(--ca-primary-dark);
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

        .metric-card.students {
            border-top-color: var(--ca-primary);
        }

        .metric-card.completed {
            border-top-color: #35a36f;
        }

        .metric-card.progress {
            border-top-color: #d99a2b;
        }

        .metric-card.pending {
            border-top-color: #4f8fb8;
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

        .metric-card.completed .metric-icon {
            color: var(--ca-success);
            background: var(--ca-success-soft);
        }

        .metric-card.progress .metric-icon {
            color: var(--ca-warning);
            background: var(--ca-warning-soft);
        }

        .metric-card.pending .metric-icon {
            color: var(--ca-info);
            background: var(--ca-info-soft);
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
        .btn-reset {
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

        .btn-reset {
            border: 1px solid var(--ca-border);
            color: #475467;
            background: #ffffff;
        }

        .btn-reset:hover {
            color: var(--ca-primary-dark);
            background: var(--ca-primary-soft);
            border-color: #cfe4e1;
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

        .screening-table {
            min-width: 1180px;
            margin-bottom: 0;
        }

        .screening-table thead th {
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

        .screening-table tbody td {
            padding: 13px 14px;
            border-color: var(--ca-line);
            color: #475467;
            background: #ffffff;
            font-size: 11px;
            vertical-align: middle;
        }

        .screening-table tbody tr:hover td {
            background: #fbfdfd;
        }

        .student-name {
            color: var(--ca-text);
            font-size: 11.5px;
            font-weight: 670;
        }

        .student-meta {
            margin-top: 2px;
            color: var(--ca-muted);
            font-size: 10px;
        }

        .status-badge {
            padding: 5px 9px;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            font-size: 9.8px;
            font-weight: 700;
            white-space: nowrap;
        }

        .status-berlangsung {
            color: var(--ca-warning);
            background: var(--ca-warning-soft);
        }

        .status-selesai {
            color: var(--ca-success);
            background: var(--ca-success-soft);
        }

        .no-score {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            color: var(--ca-muted-light);
            font-size: 10.5px;
        }

        .score-value {
            min-width: 30px;
            padding: 5px 7px;
            border-radius: 7px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #344054;
            background: #f2f4f7;
            font-size: 10px;
            font-weight: 700;
        }

        .score-total {
            min-width: 36px;
            color: var(--ca-primary-dark);
            background: var(--ca-primary-soft);
        }

        .result-badge {
            padding: 5px 9px;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 9.8px;
            font-weight: 700;
            white-space: nowrap;
        }

        .result-normal {
            color: var(--ca-success);
            background: var(--ca-success-soft);
        }

        .result-ambang {
            color: var(--ca-warning);
            background: var(--ca-warning-soft);
        }

        .result-abnormal {
            color: var(--ca-danger);
            background: var(--ca-danger-soft);
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

            .main-content {
                min-height: calc(100vh - var(--topbar-height));
            }

            .page-body {
                padding: 22px 18px 30px;
            }
        }

        @media (max-width: 767.98px) {
            .page-heading-row {
                align-items: flex-start;
                flex-direction: column;
            }

            .btn-manage-screening {
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

        .month-group-row td {
            padding: 11px 14px !important;
            color: var(--ca-primary-dark);
            background: #edf8f6 !important;
            border-top: 1px solid #d4e8e5;
            border-bottom: 1px solid #d4e8e5;
            font-size: 11px;
            font-weight: 750;
        }

        .class-group-row td {
            padding: 9px 14px !important;
            color: #344054;
            background: #f8fafb !important;
            border-bottom: 1px solid var(--ca-line);
            font-size: 10.5px;
            font-weight: 700;
        }


        .export-card {
            margin-bottom: 20px;
            padding: 16px 18px;
            border: 1px solid var(--ca-border);
            border-left: 3px solid var(--ca-primary);
            border-radius: 11px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            background: #ffffff;
        }

        .export-title {
            margin-bottom: 3px;
            color: var(--ca-text);
            font-size: .84rem;
            font-weight: 700;
        }

        .export-copy {
            margin: 0;
            color: var(--ca-muted);
            font-size: .72rem;
            line-height: 1.5;
        }

        .export-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            flex-shrink: 0;
        }

        .btn-export {
            min-height: 40px;
            padding: 0 13px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            font-size: .75rem;
            font-weight: 650;
        }

        .btn-export-excel {
            color: #147a50;
            border: 1px solid #b9dfcb;
            background: #f4fbf7;
        }

        .btn-export-excel:hover,
        .btn-export-excel:focus {
            color: #0f6541;
            border-color: #86c8a5;
            background: #eaf7ef;
        }

        .btn-export-pdf {
            color: #b42318;
            border: 1px solid #f0c5c1;
            background: #fff7f6;
        }

        .btn-export-pdf:hover,
        .btn-export-pdf:focus {
            color: #8f1c14;
            border-color: #e4a6a0;
            background: #fff0ee;
        }

        @media (max-width: 767.98px) {
            .export-card {
                align-items: flex-start;
                flex-direction: column;
            }

            .export-actions {
                width: 100%;
            }

            .btn-export {
                flex: 1;
            }
        }


        .interpretation-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 30px;
            padding: 5px 9px;
            border: 1px solid transparent;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 700;
            white-space: nowrap;
        }

        .interpretasi-normal {
            color: #344054;
            border-color: #d0d5dd;
            background: #ffffff;
        }

        .interpretasi-ambang {
            color: #b54708;
            border-color: #fedf89;
            background: #fffaeb;
        }

        .interpretasi-abnormal {
            color: #b42318;
            border-color: #fecdca;
            background: #fef3f2;
        }

        .detail-link {
            min-height: 34px;
            padding: 6px 10px;
            border: 1px solid transparent;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            font-size: 11px;
            font-weight: 700;
            line-height: 1.2;
            white-space: nowrap;
            transition: background .15s ease, border-color .15s ease, color .15s ease;
        }

        .detail-link.action-abnormal {
            color: #b42318;
            border-color: #fecdca;
            background: #fef3f2;
        }

        .detail-link.action-abnormal:hover {
            color: #912018;
            border-color: #fda29b;
            background: #fee4e2;
        }

        .detail-link.action-ambang {
            color: #b54708;
            border-color: #fedf89;
            background: #fffaeb;
        }

        .detail-link.action-ambang:hover {
            color: #93370d;
            border-color: #fec84b;
            background: #fef0c7;
        }

        .detail-link.action-normal {
            color: #475467;
            border-color: #d0d5dd;
            background: #ffffff;
        }

        .detail-link.action-normal:hover {
            color: var(--ca-primary-dark);
            border-color: #9fcac6;
            background: var(--ca-primary-soft);
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
                    Skrining Siswa
                </div>

                <div class="topbar-subtitle">
                    Evaluasi hasil skrining siswa.
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
                            Pemantauan Skrining
                        </div>

                        <h1 class="page-title">
                            Skrining Siswa
                        </h1>

                        <p class="page-copy">
                            Evaluasi hasil skrining siswa.
                        </p>
                    </div>

                    <a
                        href="{{ route('guru-bk.skrining.paket.index') }}"
                        class="btn-primary-ca btn-manage-screening"
                    >
                        <i class="bi bi-clipboard2-plus"></i>
                        Kelola Paket & Pertanyaan
                    </a>
                </section>

                <div class="notice-card">

                    <i class="bi bi-info-circle"></i>

                    <div>
                        <strong>Skor dihitung otomatis.</strong>
                        Sistem menghitung skor E, C, H, P, Pro, dan Total Kesulitan dari jawaban siswa.
                        Interpretasi yang ditampilkan pada halaman ini adalah interpretasi Total Kesulitan.
                        Skrining merupakan deteksi awal dan bukan diagnosis klinis.
                    </div>

                </div>

                <section class="row g-3 mb-4">

                    <div class="col-sm-6 col-xl-3">
                        <div class="metric-card students">

                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="metric-label">
                                        Total Sesi
                                    </div>

                                    <div class="metric-number">
                                        {{ $totalSesiPeriode }}
                                    </div>

                                    <div class="metric-note">
                                        {{ $periodeLabel }}
                                    </div>
                                </div>

                                <span class="metric-icon">
                                    <i class="bi bi-people"></i>
                                </span>
                            </div>

                        </div>
                    </div>

                    <div class="col-sm-6 col-xl-3">
                        <div class="metric-card completed">

                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="metric-label">
                                        Selesai
                                    </div>

                                    <div class="metric-number">
                                        {{ $selesaiPeriode }}
                                    </div>

                                    <div class="metric-note">
                                        Sesi selesai pada periode terpilih
                                    </div>
                                </div>

                                <span class="metric-icon">
                                    <i class="bi bi-check2-circle"></i>
                                </span>
                            </div>

                        </div>
                    </div>

                    <div class="col-sm-6 col-xl-3">
                        <div class="metric-card progress">

                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="metric-label">
                                        Sedang Berlangsung
                                    </div>

                                    <div class="metric-number">
                                        {{ $sedangBerlangsung }}
                                    </div>

                                    <div class="metric-note">
                                        Sesi berlangsung pada periode terpilih
                                    </div>
                                </div>

                                <span class="metric-icon">
                                    <i class="bi bi-hourglass-split"></i>
                                </span>
                            </div>

                        </div>
                    </div>

                    <div class="col-sm-6 col-xl-3">
                        <div class="metric-card pending">

                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="metric-label">
                                        Data Lama
                                    </div>

                                    <div class="metric-number">
                                        {{ $dataLamaTanpaSnapshot }}
                                    </div>

                                    <div class="metric-note">
                                        @if ($kelasId)
                                            Tidak dimasukkan saat filter kelas dipilih
                                        @else
                                            Termasuk dalam Total Sesi pada periode terpilih
                                        @endif
                                    </div>
                                </div>

                                <span class="metric-icon">
                                    <i class="bi bi-clock-history"></i>
                                </span>
                            </div>

                        </div>
                    </div>

                </section>

                <form
                    method="GET"
                    action="{{ route('guru-bk.skrining.index') }}"
                    class="filter-card"
                >
                    <div class="row g-3 align-items-end">
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
                                <option
                                    value="semua"
                                    @selected($tahunAjaran === 'semua')
                                >
                                    Semua Tahun Ajaran
                                </option>

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

                        <div class="col-sm-6 col-lg-2">
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
                                    value="semua"
                                    @selected($semester === 'semua')
                                >
                                    Semua
                                </option>

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

                        <div class="col-sm-6 col-lg-2">
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
                                @disabled($semester === 'semua')
                            >
                                <option value="">
                                    Semua Bulan
                                </option>

                                @foreach ($bulanOptions as $nomorBulan => $namaBulan)
                                    <option
                                        value="{{ $nomorBulan }}"
                                        @selected((int) ($bulan ?? 0) === (int) $nomorBulan)
                                    >
                                        {{ $namaBulan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-sm-6 col-lg-3">
                            <label
                                for="kelas_id"
                                class="form-label"
                            >
                                Kelas Saat Skrining
                            </label>

                            <select
                                class="form-select"
                                id="kelas_id"
                                name="kelas_id"
                            >
                                <option value="">
                                    Semua Kelas
                                </option>

                                @foreach ($kelasOptions as $itemKelas)
                                    <option
                                        value="{{ $itemKelas->id }}"
                                        @selected((int) ($kelasId ?? 0) === (int) $itemKelas->id)
                                    >
                                        {{ $itemKelas->nama_kelas }}
                                    </option>
                                @endforeach
                            </select>
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

                                <option
                                    value="berlangsung"
                                    @selected($status === 'berlangsung')
                                >
                                    Berlangsung
                                </option>

                                <option
                                    value="selesai"
                                    @selected($status === 'selesai')
                                >
                                    Selesai
                                </option>
                            </select>
                        </div>

                        <div class="col-lg-9">
                            <label
                                for="q"
                                class="form-label"
                            >
                                Cari Siswa
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                id="q"
                                name="q"
                                value="{{ $search }}"
                                placeholder="Nama siswa, NIS, atau nama kelas saat skrining"
                            >
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
                                    href="{{ route('guru-bk.skrining.index') }}"
                                    class="btn-reset"
                                    title="Reset filter"
                                >
                                    <i class="bi bi-arrow-counterclockwise"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="export-card">
                    <div>
                        <div class="export-title">
                            Export Riwayat Skrining
                        </div>

                        <p class="export-copy">
                            Export mengikuti filter yang sudah diterapkan. Data disusun per bulan lalu per kelas dan dapat memuat identitas siswa, skor SDQ, total kesulitan, serta interpretasi untuk kebutuhan Guru BK.
                        </p>
                    </div>

                    <div class="export-actions">
                        <a
                            href="{{ route('guru-bk.skrining.export.excel', request()->query()) }}"
                            class="btn-export btn-export-excel"
                        >
                            <i class="bi bi-file-earmark-spreadsheet"></i>
                            Export Excel
                        </a>

                        <a
                            href="{{ route('guru-bk.skrining.export.pdf', request()->query()) }}"
                            class="btn-export btn-export-pdf"
                        >
                            <i class="bi bi-file-earmark-pdf"></i>
                            Export PDF
                        </a>
                    </div>
                </div>

                @if ($dataLamaDikecualikan > 0)
                    <div class="notice-card">
                        <i class="bi bi-clock-history"></i>

                        <div>
                            <strong>{{ $dataLamaDikecualikan }} sesi lama tidak disertakan pada filter kelas.</strong>
                            Data tersebut tetap tersimpan dan masih dapat dilihat melalui Semua Kelas, tetapi kelas historisnya tidak dapat dipastikan karena sesi dibuat sebelum snapshot kelas tersedia.
                        </div>
                    </div>
                @endif

                <section class="content-card">

                    <div class="content-card-header">

                        <div>
                            <div class="content-title">
                                Riwayat Skrining per Kelas
                            </div>

                            <div class="content-subtitle">
                                Data baru menggunakan snapshot akademik. Data lama tetap masuk berdasarkan tanggal penyelesaian selama filter kelas tidak dipilih.
                            </div>
                        </div>

                        <div class="result-count">
                            {{ $skrining->total() }} sesi
                        </div>

                    </div>

                    @if ($skrining->isEmpty())

                        <div class="empty-state">

                            <div class="empty-icon">
                                <i class="bi bi-clipboard2-pulse"></i>
                            </div>

                            <div class="fw-semibold mb-1">
                                Belum Ada Sesi Skrining
                            </div>

                            <div class="small">
                                Aktivitas skrining siswa akan muncul di sini.
                            </div>

                        </div>

                    @else

                        <div class="table-responsive">

                            <table class="table screening-table align-middle">

                                <thead>
                                    <tr>
                                        <th>Siswa</th>
                                        <th>Kelas</th>
                                        <th>Mulai</th>
                                        <th>Selesai</th>
                                        <th>Status</th>
                                        <th>E</th>
                                        <th>C</th>
                                        <th>H</th>
                                        <th>P</th>
                                        <th>Pro</th>
                                        <th>Total</th>
                                        <th>Interpretasi</th>
                                        <th>Ditangani Oleh</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @php
                                        $kelompokBulan = $skrining
                                            ->getCollection()
                                            ->groupBy(
                                                fn ($item) =>
                                                    \Carbon\Carbon::parse(
                                                        $item->completed_at
                                                        ?? $item->started_at
                                                        ?? $item->created_at
                                                    )->format('Y-m')
                                            );
                                    @endphp

                                    @foreach ($kelompokBulan as $bulanKey => $itemsBulan)
                                        <tr class="month-group-row">
                                            <td colspan="14">
                                                <i class="bi bi-calendar3 me-1"></i>
                                                {{ \Carbon\Carbon::createFromFormat('Y-m', $bulanKey)->locale('id')->translatedFormat('F Y') }}
                                                <span class="ms-2 text-muted">
                                                    {{ $itemsBulan->count() }} sesi
                                                </span>
                                            </td>
                                        </tr>

                                        @php
                                            $kelompokKelas = $itemsBulan
                                                ->groupBy(
                                                    fn ($item) =>
                                                        $item->nama_kelas
                                                        ?: 'Data lama tanpa snapshot kelas'
                                                );
                                        @endphp

                                        @foreach ($kelompokKelas as $namaKelas => $itemsKelas)
                                            <tr class="class-group-row">
                                                <td colspan="14">
                                                    <i class="bi bi-people me-1"></i>
                                                    {{ $namaKelas }}

                                                    @php
                                                        $contohPeriode = $itemsKelas->first();
                                                    @endphp

                                                    @if (
                                                        $contohPeriode
                                                        && $contohPeriode->tahun_ajaran
                                                    )
                                                        <span class="ms-2 text-muted">
                                                            {{ $contohPeriode->tahun_ajaran }}
                                                            @if ($contohPeriode->semester)
                                                                · {{ ucfirst($contohPeriode->semester) }}
                                                            @endif
                                                        </span>
                                                    @endif
                                                </td>
                                            </tr>

                                            @foreach ($itemsKelas as $item)
                                                <tr>
                                                    <td>
                                                        <div class="student-name">
                                                            {{ $item->nama_siswa }}
                                                        </div>

                                                        <div class="student-meta">
                                                            {{ $item->nis
                                                                ? 'NIS ' . $item->nis
                                                                : 'NIS belum tersedia' }}
                                                        </div>
                                                    </td>

                                                    <td>
                                                        {{ $item->nama_kelas ?? 'Data lama' }}

                                                        @if ($item->tahun_ajaran)
                                                            <div class="student-meta">
                                                                {{ $item->tahun_ajaran }}
                                                                @if ($item->semester)
                                                                    · {{ ucfirst($item->semester) }}
                                                                @endif
                                                            </div>
                                                        @else
                                                            <div class="student-meta">
                                                                Snapshot akademik belum tersedia
                                                            </div>
                                                        @endif
                                                    </td>

                                                    <td>
                                                        {{ $item->started_at
                                                            ? \Carbon\Carbon::parse($item->started_at)->format('d M Y, H:i')
                                                            : '-' }}
                                                    </td>

                                                    <td>
                                                        {{ $item->completed_at
                                                            ? \Carbon\Carbon::parse($item->completed_at)->format('d M Y, H:i')
                                                            : '-' }}
                                                    </td>

                                                    <td>
                                                        @if ($item->status === 'selesai')
                                                            <span class="status-badge status-selesai">
                                                                Selesai
                                                            </span>
                                                        @else
                                                            <span class="status-badge status-berlangsung">
                                                                Berlangsung
                                                            </span>
                                                        @endif
                                                    </td>

                                                    @if ($item->status === 'selesai')
                                                        <td><span class="score-value">{{ $item->skor_e }}</span></td>
                                                        <td><span class="score-value">{{ $item->skor_c }}</span></td>
                                                        <td><span class="score-value">{{ $item->skor_h }}</span></td>
                                                        <td><span class="score-value">{{ $item->skor_p }}</span></td>
                                                        <td><span class="score-value">{{ $item->skor_pro }}</span></td>
                                                        <td><span class="score-value total">{{ $item->total_kesulitan }}</span></td>

                                                        <td>
                                                            @php
                                                                $interpretasiClass = match ($item->interpretasi) {
                                                                    'Normal' => 'interpretasi-normal',
                                                                    'Ambang' => 'interpretasi-ambang',
                                                                    'Abnormal' => 'interpretasi-abnormal',
                                                                    default => '',
                                                                };
                                                            @endphp

                                                            <span class="interpretation-badge {{ $interpretasiClass }}">
                                                                {{ $item->interpretasi }}
                                                            </span>
                                                        </td>

                                                        <td>
                                                            @if ($item->nama_bk)
                                                                <span class="badge bg-light text-dark border">
                                                                    <i class="bi bi-person"></i> {{ $item->nama_bk }}
                                                                </span>
                                                            @else
                                                                <span class="text-muted small">-</span>
                                                            @endif
                                                        </td>

                                                        <td>
                                                            @php
                                                                $actionClass = match ($item->interpretasi) {
                                                                    'Abnormal' => 'action-abnormal',
                                                                    'Ambang' => 'action-ambang',
                                                                    'Normal' => 'action-normal',
                                                                    default => 'action-normal',
                                                                };

                                                                $actionIcon = in_array(
                                                                    $item->interpretasi,
                                                                    ['Ambang', 'Abnormal'],
                                                                    true
                                                                )
                                                                    ? 'bi-arrow-up-right-circle'
                                                                    : 'bi-eye';
                                                            @endphp

                                                            <a
                                                                href="{{ route('guru-bk.skrining.show', $item->id) }}"
                                                                class="detail-link {{ $actionClass }}"
                                                            >
                                                                <i class="bi {{ $actionIcon }}"></i>

                                                                {{ in_array(
                                                                    $item->interpretasi,
                                                                    ['Ambang', 'Abnormal'],
                                                                    true
                                                                ) ? 'Tindak Lanjuti' : 'Lihat Hasil' }}
                                                            </a>
                                                        </td>
                                                    @else
                                                        <td colspan="9">
                                                            <span class="no-score">
                                                                <i class="bi bi-hourglass-split"></i>
                                                                Hasil tersedia setelah skrining selesai
                                                            </span>
                                                        </td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                        @endforeach
                                    @endforeach
                                </tbody>

                            </table>

                        </div>

                        @if ($skrining->hasPages())
                            <div class="pagination-wrap">
                                {{ $skrining->links() }}
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
                            Portal Guru BK · Skrining merupakan pemantauan awal, bukan diagnosis
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

        bulanSelect.innerHTML = '';

        const semuaBulan = document.createElement('option');
        semuaBulan.value = '';
        semuaBulan.textContent = 'Semua Bulan';
        bulanSelect.appendChild(semuaBulan);

        if (semester === 'semua') {
            bulanSelect.disabled = true;
            return;
        }

        bulanSelect.disabled = false;

        const daftarBulan = bulanSemester[semester] ?? [];

        daftarBulan.forEach(function (item) {
            const option = document.createElement('option');
            option.value = item[0];
            option.textContent = item[1];
            option.selected = item[0] === selectedValue;
            bulanSelect.appendChild(option);
        });
    }

    if (semesterSelect && bulanSelect) {
        const selectedBulan = bulanSelect.value;

        renderBulanSemester(
            semesterSelect.value,
            selectedBulan
        );

        semesterSelect.addEventListener('change', function () {
            renderBulanSemester(
                this.value,
                ''
            );
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



