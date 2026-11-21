<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Statistik & Analisis - Guru BK - CurhatAman</title>

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
            max-width: 790px;
            margin: 0;
            color: rgba(255, 255, 255, .82);
            font-size: 12px;
            line-height: 1.6;
        }

        .filter-panel {
            margin-bottom: 20px;
            padding: 17px 18px;
            border: 1px solid var(--ca-border);
            border-top: 3px solid var(--ca-primary);
            border-radius: 12px;
            display: flex;
            align-items: end;
            justify-content: space-between;
            gap: 18px;
            background: #ffffff;
        }

        .filter-fields {
            display: flex;
            align-items: end;
            gap: 12px;
            flex-wrap: wrap;
        }

        .filter-group {
            min-width: 190px;
        }

        .filter-label {
            display: block;
            margin-bottom: 6px;
            color: #475467;
            font-size: 10.5px;
            font-weight: 650;
        }

        .form-select {
            min-height: 40px;
            border: 1px solid #d8e1e1;
            border-radius: 8px;
            color: var(--ca-text);
            background: #ffffff;
            font-size: 11.5px;
            box-shadow: none;
        }

        .form-select:focus {
            border-color: rgba(15, 138, 131, .58);
            box-shadow: 0 0 0 .2rem rgba(15, 138, 131, .08);
        }

        .btn-apply,
        .btn-reset {
            min-height: 40px;
            padding: 0 13px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            font-size: 11px;
            font-weight: 650;
        }

        .btn-apply {
            border: 1px solid var(--ca-primary);
            color: #ffffff;
            background: var(--ca-primary);
        }

        .btn-apply:hover {
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

        .filter-context {
            min-width: 235px;
            padding-left: 18px;
            border-left: 1px solid var(--ca-line);
            color: var(--ca-muted);
            font-size: 10px;
            line-height: 1.5;
            text-align: right;
        }

        .filter-context strong {
            display: block;
            margin-top: 2px;
            color: #344054;
            font-size: 11px;
            font-weight: 680;
        }

        .metric-card {
            height: 100%;
            min-height: 120px;
            padding: 17px 18px;
            border: 1px solid var(--ca-border);
            border-top: 3px solid #d6dddd;
            border-radius: 12px;
            background: #ffffff;
        }

        .metric-card.reports {
            border-top-color: var(--ca-primary);
        }

        .metric-card.screening {
            border-top-color: #35a36f;
        }

        .metric-card.help {
            border-top-color: #4f8fb8;
        }

        .metric-card.referral {
            border-top-color: #8b72a8;
        }

        .metric-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
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

        .metric-card.screening .metric-icon {
            color: var(--ca-success);
            background: var(--ca-success-soft);
        }

        .metric-card.help .metric-icon {
            color: var(--ca-info);
            background: var(--ca-info-soft);
        }

        .metric-card.referral .metric-icon {
            color: #6f568d;
            background: #f4f0f8;
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

        .attention-strip {
            margin-bottom: 20px;
            overflow: hidden;
            border: 1px solid var(--ca-border);
            border-radius: 12px;
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            background: #ffffff;
        }

        .attention-item {
            padding: 14px 16px;
            border-right: 1px solid var(--ca-line);
            display: flex;
            align-items: center;
            gap: 11px;
        }

        .attention-item:last-child {
            border-right: 0;
        }

        .attention-icon {
            width: 32px;
            height: 32px;
            flex: 0 0 32px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: var(--ca-warning);
            background: var(--ca-warning-soft);
            font-size: 13px;
        }

        .attention-value {
            color: var(--ca-text);
            font-size: 14px;
            line-height: 1.1;
            font-weight: 730;
        }

        .attention-label {
            margin-top: 2px;
            color: var(--ca-muted);
            font-size: 10px;
        }

        .panel {
            height: 100%;
            overflow: hidden;
            border: 1px solid var(--ca-border);
            border-top: 3px solid var(--ca-primary);
            border-radius: 12px;
            background: #ffffff;
        }

        .panel-header {
            padding: 16px 18px;
            border-bottom: 1px solid var(--ca-line);
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 15px;
            background: #ffffff;
        }

        .panel-title {
            margin-bottom: 2px;
            color: var(--ca-text);
            font-size: 13px;
            font-weight: 710;
        }

        .panel-subtitle {
            color: var(--ca-muted);
            font-size: 10.5px;
            line-height: 1.5;
        }

        .panel-body {
            padding: 18px;
        }

        .chart-wrap {
            position: relative;
            height: 310px;
        }

        .legend-note {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: var(--ca-muted);
            font-size: 10px;
        }

        .legend-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            display: inline-block;
            background: var(--ca-primary);
        }

        .status-row {
            padding: 11px 0;
            border-bottom: 1px solid var(--ca-line);
            display: grid;
            grid-template-columns: 1fr auto;
            align-items: center;
            gap: 12px;
        }

        .status-row:first-child {
            padding-top: 0;
        }

        .status-row:last-child {
            padding-bottom: 0;
            border-bottom: 0;
        }

        .status-name {
            display: flex;
            align-items: center;
            gap: 9px;
            color: #475467;
            font-size: 11px;
            font-weight: 620;
        }

        .status-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
        }

        .dot-baru {
            background: #d99a2b;
        }

        .dot-diproses {
            background: var(--ca-primary);
        }

        .dot-selesai {
            background: #667085;
        }

        .dot-eskalasi {
            background: var(--ca-danger);
        }

        .status-count {
            min-width: 30px;
            padding: 4px 8px;
            border-radius: 7px;
            color: #344054;
            background: #f3f5f5;
            font-size: 10.5px;
            font-weight: 700;
            text-align: center;
        }

        .bar-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .bar-head {
            margin-bottom: 6px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        .bar-name {
            color: #475467;
            font-size: 10.8px;
            font-weight: 620;
        }

        .bar-value {
            color: var(--ca-muted);
            font-size: 10px;
            white-space: nowrap;
        }

        .bar-track {
            width: 100%;
            height: 7px;
            overflow: hidden;
            border-radius: 999px;
            background: #edf2f2;
        }

        .bar-fill {
            height: 100%;
            border-radius: inherit;
            background: var(--ca-primary);
        }

        .screening-main {
            margin-bottom: 12px;
            display: flex;
            align-items: end;
            justify-content: space-between;
            gap: 12px;
        }

        .screening-number {
            color: var(--ca-text);
            font-size: 28px;
            line-height: 1;
            font-weight: 760;
        }

        .screening-number span {
            margin-left: 3px;
            color: var(--ca-muted);
            font-size: 12px;
            font-weight: 600;
        }

        .screening-caption {
            margin-top: 5px;
            color: var(--ca-muted);
            font-size: 10.5px;
        }

        .screening-main > i {
            color: var(--ca-primary) !important;
            font-size: 22px !important;
        }

        .progress-ca {
            height: 9px;
            overflow: hidden;
            border-radius: 999px;
            background: #e8efef;
        }

        .progress-fill {
            height: 100%;
            border-radius: inherit;
            background: var(--ca-primary);
        }

        .screening-meta {
            margin-top: 16px;
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 10px;
        }

        .result-distribution {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 12px;
        }

        .result-stat {
            min-width: 0;
            padding: 15px 16px;
            border: 1px solid var(--ca-border);
            border-top: 3px solid #d6dddd;
            border-radius: 10px;
            background: #ffffff;
        }

        .result-stat.normal {
            border-top-color: #35a36f;
        }

        .result-stat.ambang {
            border-top-color: #d99a2b;
        }

        .result-stat.abnormal {
            border-top-color: #d05a4f;
        }

        .result-stat-head {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 12px;
        }

        .result-stat-label {
            color: #475467;
            font-size: 10.5px;
            font-weight: 680;
        }

        .result-stat-value {
            margin-top: 6px;
            color: var(--ca-text);
            font-size: 24px;
            line-height: 1;
            font-weight: 760;
        }

        .result-stat-percent {
            min-width: 46px;
            padding: 5px 7px;
            border-radius: 7px;
            color: var(--ca-muted);
            background: #f3f5f5;
            font-size: 9.8px;
            font-weight: 700;
            text-align: center;
        }

        .result-stat.normal .result-stat-percent {
            color: var(--ca-success);
            background: var(--ca-success-soft);
        }

        .result-stat.ambang .result-stat-percent {
            color: var(--ca-warning);
            background: var(--ca-warning-soft);
        }

        .result-stat.abnormal .result-stat-percent {
            color: var(--ca-danger);
            background: var(--ca-danger-soft);
        }

        .result-stat-note {
            margin-top: 8px;
            color: var(--ca-muted-light);
            font-size: 9.8px;
            line-height: 1.45;
        }

        .small-stat {
            padding: 11px 12px;
            border: 1px solid var(--ca-line);
            border-radius: 8px;
            background: #fbfcfc;
        }

        .small-stat-label {
            color: var(--ca-muted);
            font-size: 9.5px;
        }

        .small-stat-value {
            margin-top: 4px;
            color: var(--ca-text);
            font-size: 13px;
            font-weight: 700;
        }

        .notice {
            margin-top: 14px;
            padding: 10px 11px;
            border: 1px solid #d4e8e5;
            border-radius: 8px;
            display: flex;
            align-items: flex-start;
            gap: 8px;
            color: #55706d;
            background: #f5faf9;
            font-size: 9.8px;
            line-height: 1.5;
        }

        .notice i {
            margin-top: 1px;
            color: var(--ca-primary);
        }

        .compact-table {
            width: 100%;
            margin: 0;
            border-collapse: collapse;
        }

        .compact-table th {
            padding: 10px 12px;
            border-bottom: 1px solid #dfeceb;
            color: #546665;
            background: #f4faf9;
            font-size: 9.5px;
            font-weight: 760;
            letter-spacing: .03em;
            text-transform: uppercase;
        }

        .compact-table td {
            padding: 11px 12px;
            border-bottom: 1px solid var(--ca-line);
            color: #475467;
            font-size: 10.5px;
        }

        .compact-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .table-number {
            color: #344054;
            font-weight: 700;
        }

        .empty-text {
            padding: 22px 4px;
            color: var(--ca-muted);
            font-size: 10.5px;
            text-align: center;
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
            .attention-strip {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .attention-item:nth-child(2) {
                border-right: 0;
            }

            .attention-item:nth-child(-n+2) {
                border-bottom: 1px solid var(--ca-line);
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

            .filter-panel {
                align-items: stretch;
                flex-direction: column;
            }

            .filter-context {
                padding-top: 12px;
                padding-left: 0;
                border-top: 1px solid var(--ca-line);
                border-left: 0;
                text-align: left;
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

            .attention-strip {
                grid-template-columns: 1fr;
            }

            .attention-item {
                border-right: 0;
                border-bottom: 1px solid var(--ca-line);
            }

            .attention-item:last-child {
                border-bottom: 0;
            }

            .filter-group {
                width: 100%;
                min-width: 0;
            }

            .filter-fields {
                align-items: stretch;
                flex-direction: column;
            }

            .chart-wrap {
                height: 270px;
            }

            .screening-meta,
            .result-distribution {
                grid-template-columns: 1fr;
            }
        }
    </style>
    @include('guru-bk.partials.styles')
</head>

<body>

@php
    $namaUser = ucwords($user->name);
    $inisial = strtoupper(substr($user->name, 0, 1));

    $kelasTerpilih = $kelasId
        ? $kelasList->first(
            fn ($kelas) => (int) $kelas->id === (int) $kelasId
        )
        : null;
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
                    Statistik & Analisis
                </div>

                <div class="topbar-subtitle">
                    Ringkasan layanan BK.
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
                            Pemantauan Data
                        </div>

                        <h1 class="page-title">
                            Statistik & Analisis
                        </h1>

                        <p class="page-copy">
                            Ringkasan layanan BK.
                        </p>
                    </div>
                </section>

                <form
                    method="GET"
                    action="{{ route('guru-bk.statistik.index') }}"
                    class="filter-panel"
                >

                    <div class="filter-fields">

                        <div class="filter-group">
                            <label
                                for="tahun_ajaran"
                                class="filter-label"
                            >
                                Tahun Ajaran
                            </label>

                            <select
                                name="tahun_ajaran"
                                id="tahun_ajaran"
                                class="form-select"
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

                        <div class="filter-group">
                            <label
                                for="semester"
                                class="filter-label"
                            >
                                Semester
                            </label>

                            <select
                                name="semester"
                                id="semester"
                                class="form-select"
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

                        <div class="filter-group">
                            <label
                                for="kelas_id"
                                class="filter-label"
                            >
                                Kelas
                            </label>

                            <select
                                name="kelas_id"
                                id="kelas_id"
                                class="form-select"
                            >
                                <option value="">
                                    Semua Kelas
                                </option>

                                @foreach ($kelasList as $kelas)
                                    <option
                                        value="{{ $kelas->id }}"
                                        @selected((int) $kelasId === (int) $kelas->id)
                                    >
                                        {{ $kelas->nama_kelas }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <button
                            type="submit"
                            class="btn-apply"
                        >
                            <i class="bi bi-funnel"></i>
                            Terapkan
                        </button>

                        <a
                            href="{{ route('guru-bk.statistik.index') }}"
                            class="btn-reset"
                            title="Kembali ke periode aktif"
                        >
                            <i class="bi bi-arrow-counterclockwise"></i>
                            Reset
                        </a>

                    </div>

                    <div class="filter-context">
                        Data yang ditampilkan
                        <strong>
                            {{ $tahunAjaran }}
                            · Semester {{ ucfirst($semester) }}
                            ·
                            {{ $kelasTerpilih
                                ? $kelasTerpilih->nama_kelas
                                : 'Semua Kelas' }}
                        </strong>

                        <span class="d-block mt-1">
                            {{ $startDate->locale('id')->translatedFormat('d M Y') }}
                            s.d.
                            {{ $endDate->locale('id')->translatedFormat('d M Y') }}
                        </span>
                    </div>

                </form>

                <section class="row g-3 mb-3">

                    <div class="col-sm-6 col-xl-3">
                        <div class="metric-card reports">
                            <div class="metric-top">
                                <div>
                                    <div class="metric-label">
                                        Laporan Kasus
                                    </div>

                                    <div class="metric-number">
                                        {{ $summary['laporan'] }}
                                    </div>
                                </div>

                                <span class="metric-icon">
                                    <i class="bi bi-file-earmark-text"></i>
                                </span>
                            </div>

                            <div class="metric-note">
                                Laporan terkirim pada periode terpilih
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xl-3">
                        <div class="metric-card screening">
                            <div class="metric-top">
                                <div>
                                    <div class="metric-label">
                                        Skrining Selesai
                                    </div>

                                    <div class="metric-number">
                                        {{ $summary['skrining_selesai'] }}
                                    </div>
                                </div>

                                <span class="metric-icon">
                                    <i class="bi bi-clipboard2-check"></i>
                                </span>
                            </div>

                            <div class="metric-note">
                                Sesi selesai pada periode terpilih
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xl-3">
                        <div class="metric-card help">
                            <div class="metric-top">
                                <div>
                                    <div class="metric-label">
                                        Permintaan Bantuan
                                    </div>

                                    <div class="metric-number">
                                        {{ $summary['bantuan'] }}
                                    </div>
                                </div>

                                <span class="metric-icon">
                                    <i class="bi bi-chat-square-text"></i>
                                </span>
                            </div>

                            <div class="metric-note">
                                Permintaan masuk pada periode terpilih
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xl-3">
                        <div class="metric-card referral">
                            <div class="metric-top">
                                <div>
                                    <div class="metric-label">
                                        Rujukan
                                    </div>

                                    <div class="metric-number">
                                        {{ $summary['rujukan'] }}
                                    </div>
                                </div>

                                <span class="metric-icon">
                                    <i class="bi bi-life-preserver"></i>
                                </span>
                            </div>

                            <div class="metric-note">
                                Rujukan dibuat pada periode terpilih
                            </div>
                        </div>
                    </div>

                </section>

                <section class="attention-strip">

                    <div class="attention-item">
                        <span class="attention-icon">
                            <i class="bi bi-file-earmark-exclamation"></i>
                        </span>

                        <div>
                            <div class="attention-value">
                                {{ $attention['laporan'] }}
                            </div>

                            <div class="attention-label">
                                Laporan belum selesai
                            </div>
                        </div>
                    </div>

                    <div class="attention-item">
                        <span class="attention-icon">
                            <i class="bi bi-chat-left-dots"></i>
                        </span>

                        <div>
                            <div class="attention-value">
                                {{ $attention['bantuan'] }}
                            </div>

                            <div class="attention-label">
                                Bantuan belum selesai
                            </div>
                        </div>
                    </div>

                    <div class="attention-item">
                        <span class="attention-icon">
                            <i class="bi bi-arrow-up-right-square"></i>
                        </span>

                        <div>
                            <div class="attention-value">
                                {{ $attention['rujukan'] }}
                            </div>

                            <div class="attention-label">
                                Rujukan belum selesai
                            </div>
                        </div>
                    </div>

                    <div class="attention-item">
                        <span class="attention-icon">
                            <i class="bi bi-hourglass-split"></i>
                        </span>

                        <div>
                            <div class="attention-value">
                                {{ $attention['skrining'] }}
                            </div>

                            <div class="attention-label">
                                Skrining masih berjalan
                            </div>
                        </div>
                    </div>

                </section>

                <section class="row g-3 mb-3">

                    <div class="col-xl-8">
                        <div class="panel">

                            <div class="panel-header">
                                <div>
                                    <div class="panel-title">
                                        Tren Aktivitas · {{ $periodeLabel }}
                                    </div>

                                    <div class="panel-subtitle">
                                        Perbandingan aktivitas laporan, skrining,
                                        bantuan, dan rujukan sesuai periode terpilih
                                    </div>
                                </div>

                                <div class="legend-note">
                                    <span class="legend-dot"></span>
                                    Data sistem
                                </div>
                            </div>

                            <div class="panel-body">
                                <div class="chart-wrap">
                                    <canvas id="activityChart"></canvas>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-xl-4">
                        <div class="panel">

                            <div class="panel-header">
                                <div>
                                    <div class="panel-title">
                                        Status Penanganan Laporan
                                    </div>

                                    <div class="panel-subtitle">
                                        Kondisi laporan pada periode terpilih
                                    </div>
                                </div>
                            </div>

                            <div class="panel-body">

                                <div class="status-row">
                                    <div class="status-name">
                                        <span class="status-dot dot-baru"></span>
                                        Baru
                                    </div>

                                    <span class="status-count">
                                        {{ $statusLaporan['baru'] }}
                                    </span>
                                </div>

                                <div class="status-row">
                                    <div class="status-name">
                                        <span class="status-dot dot-diproses"></span>
                                        Diproses
                                    </div>

                                    <span class="status-count">
                                        {{ $statusLaporan['diproses'] }}
                                    </span>
                                </div>

                                <div class="status-row">
                                    <div class="status-name">
                                        <span class="status-dot dot-selesai"></span>
                                        Selesai
                                    </div>

                                    <span class="status-count">
                                        {{ $statusLaporan['selesai'] }}
                                    </span>
                                </div>

                                <div class="status-row">
                                    <div class="status-name">
                                        <span class="status-dot dot-eskalasi"></span>
                                        Dieskalasi
                                    </div>

                                    <span class="status-count">
                                        {{ $statusLaporan['dieskalasi'] }}
                                    </span>
                                </div>

                            </div>

                        </div>
                    </div>

                </section>

                <section class="row g-3 mb-3">

                    <div class="col-lg-7">
                        <div class="panel">

                            <div class="panel-header">
                                <div>
                                    <div class="panel-title">
                                        Distribusi Kategori Kasus
                                    </div>

                                    <div class="panel-subtitle">
                                        Proporsi jenis laporan pada periode terpilih
                                    </div>
                                </div>
                            </div>

                            <div class="panel-body">

                                @if ($kategoriKasus->isEmpty())

                                    <div class="empty-text">
                                        Belum ada data kategori kasus untuk filter ini.
                                    </div>

                                @else

                                    <div class="bar-list">

                                        @foreach ($kategoriKasus as $item)

                                            <div>
                                                <div class="bar-head">
                                                    <span class="bar-name">
                                                        {{ $item->nama_kategori }}
                                                    </span>

                                                    <span class="bar-value">
                                                        {{ $item->total }}
                                                        laporan ·
                                                        {{ $item->persentase }}%
                                                    </span>
                                                </div>

                                                <div class="bar-track">
                                                    <div
                                                        class="bar-fill"
                                                        style="width: {{ min($item->persentase, 100) }}%;"
                                                    ></div>
                                                </div>
                                            </div>

                                        @endforeach

                                    </div>

                                @endif

                            </div>

                        </div>
                    </div>

                    <div class="col-lg-5">
                        <div class="panel">

                            <div class="panel-header">
                                <div>
                                    <div class="panel-title">
                                        Partisipasi Skrining
                                    </div>

                                    <div class="panel-subtitle">
                                        Siswa yang menyelesaikan skrining pada periode terpilih
                                    </div>
                                </div>
                            </div>

                            <div class="panel-body">

                                <div class="screening-main">
                                    <div>
                                        <div class="screening-number">
                                            {{ $skrining['persentase'] }}<span>%</span>
                                        </div>

                                        <div class="screening-caption">
                                            {{ $skrining['selesai_periode'] }}
                                            dari
                                            {{ $skrining['total_siswa'] }}
                                            siswa aktif
                                        </div>
                                    </div>

                                    <i
                                        class="bi bi-clipboard2-pulse"
                                        style="font-size:1.4rem;color:#0f8a83;"
                                    ></i>
                                </div>

                                <div class="progress-ca">
                                    <div
                                        class="progress-fill"
                                        style="width: {{ min($skrining['persentase'], 100) }}%;"
                                    ></div>
                                </div>

                                <div class="screening-meta">

                                    <div class="small-stat">
                                        <div class="small-stat-label">
                                            Selesai
                                        </div>

                                        <div class="small-stat-value">
                                            {{ $skrining['selesai_periode'] }}
                                        </div>
                                    </div>

                                    <div class="small-stat">
                                        <div class="small-stat-label">
                                            Sedang berlangsung
                                        </div>

                                        <div class="small-stat-value">
                                            {{ $skrining['berlangsung'] }}
                                        </div>
                                    </div>

                                </div>

                                <div class="notice">
                                    <i class="bi bi-info-circle"></i>

                                    <div>
                                        Partisipasi menunjukkan jumlah siswa yang
                                        menyelesaikan skrining pada periode terpilih.
                                        Interpretasi hasil ditampilkan terpisah sebagai
                                        informasi skrining awal, bukan diagnosis.
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>

                </section>

                <section class="panel mb-3">
                    <div class="panel-header">
                        <div>
                            <div class="panel-title">
                                Distribusi Hasil Skrining
                            </div>

                            <div class="panel-subtitle">
                                Interpretasi hasil skrining selesai terbaru setiap siswa pada periode terpilih
                            </div>
                        </div>

                        <div class="legend-note">
                            <span class="legend-dot"></span>
                            {{ $distribusiSkrining['total_siswa'] }} siswa
                        </div>
                    </div>

                    <div class="panel-body">
                        @if ($distribusiSkrining['total_siswa'] > 0)
                            <div class="result-distribution">
                                <div class="result-stat normal">
                                    <div class="result-stat-head">
                                        <div>
                                            <div class="result-stat-label">
                                                Normal
                                            </div>

                                            <div class="result-stat-value">
                                                {{ $distribusiSkrining['normal']['total'] }}
                                            </div>
                                        </div>

                                        <span class="result-stat-percent">
                                            {{ $distribusiSkrining['normal']['persentase'] }}%
                                        </span>
                                    </div>

                                    <div class="result-stat-note">
                                        Siswa dengan hasil skrining terbaru pada kategori Normal
                                    </div>
                                </div>

                                <div class="result-stat ambang">
                                    <div class="result-stat-head">
                                        <div>
                                            <div class="result-stat-label">
                                                Ambang
                                            </div>

                                            <div class="result-stat-value">
                                                {{ $distribusiSkrining['ambang']['total'] }}
                                            </div>
                                        </div>

                                        <span class="result-stat-percent">
                                            {{ $distribusiSkrining['ambang']['persentase'] }}%
                                        </span>
                                    </div>

                                    <div class="result-stat-note">
                                        Siswa dengan hasil skrining terbaru pada kategori Ambang
                                    </div>
                                </div>

                                <div class="result-stat abnormal">
                                    <div class="result-stat-head">
                                        <div>
                                            <div class="result-stat-label">
                                                Abnormal
                                            </div>

                                            <div class="result-stat-value">
                                                {{ $distribusiSkrining['abnormal']['total'] }}
                                            </div>
                                        </div>

                                        <span class="result-stat-percent">
                                            {{ $distribusiSkrining['abnormal']['persentase'] }}%
                                        </span>
                                    </div>

                                    <div class="result-stat-note">
                                        Siswa dengan hasil skrining terbaru pada kategori Abnormal
                                    </div>
                                </div>
                            </div>

                            <div class="notice">
                                <i class="bi bi-shield-check"></i>

                                <div>
                                    Distribusi menggunakan hasil skrining selesai terbaru
                                    dari setiap siswa dalam filter periode dan kelas yang dipilih.
                                    Kategori Normal, Ambang, dan Abnormal merupakan interpretasi
                                    skrining awal dan bukan diagnosis klinis.
                                </div>
                            </div>
                        @else
                            <div class="empty-text">
                                Belum ada hasil skrining lengkap untuk periode dan kelas yang dipilih.
                            </div>
                        @endif
                    </div>
                </section>

                <section class="row g-3">

                    <div class="col-lg-6">
                        <div class="panel">

                            <div class="panel-header">
                                <div>
                                    <div class="panel-title">
                                        Tindak Lanjut Pendampingan
                                    </div>

                                    <div class="panel-subtitle">
                                        Status permintaan bantuan, rujukan, dan tindak lanjut skrining
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="compact-table">
                                    <thead>
                                        <tr>
                                            <th>Jenis</th>
                                            <th>Baru</th>
                                            <th>Diproses</th>
                                            <th>Selesai</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr>
                                            <td class="fw-semibold">
                                                Permintaan Bantuan
                                            </td>

                                            <td class="table-number">
                                                {{ $statusBantuan['baru'] }}
                                            </td>

                                            <td class="table-number">
                                                {{ $statusBantuan['diproses'] }}
                                            </td>

                                            <td class="table-number">
                                                {{ $statusBantuan['selesai'] }}
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="fw-semibold">
                                                Rujukan
                                            </td>

                                            <td class="table-number">
                                                {{ $statusRujukan['baru'] }}
                                            </td>

                                            <td class="table-number">
                                                {{ $statusRujukan['diproses'] }}
                                            </td>

                                            <td class="table-number">
                                                {{ $statusRujukan['selesai'] }}
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="fw-semibold">
                                                Skrining Ambang
                                            </td>

                                            <td class="table-number">
                                                {{ $statusSkriningAmbang['baru'] }}
                                            </td>

                                            <td class="table-number">
                                                {{ $statusSkriningAmbang['diproses'] }}
                                            </td>

                                            <td class="table-number">
                                                {{ $statusSkriningAmbang['selesai'] }}
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="fw-semibold">
                                                Skrining Abnormal
                                            </td>

                                            <td class="table-number">
                                                {{ $statusSkriningAbnormal['baru'] }}
                                            </td>

                                            <td class="table-number">
                                                {{ $statusSkriningAbnormal['diproses'] }}
                                            </td>

                                            <td class="table-number">
                                                {{ $statusSkriningAbnormal['selesai'] }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="panel">

                            @if ($kelasTerpilih)

                                <div class="panel-header">
                                    <div>
                                        <div class="panel-title">
                                            Ringkasan {{ $kelasTerpilih->nama_kelas }}
                                        </div>

                                        <div class="panel-subtitle">
                                            Aktivitas siswa pada kelas dan periode yang dipilih
                                        </div>
                                    </div>
                                </div>

                                <div class="panel-body">

                                    <div class="status-row">
                                        <div class="status-name">
                                            <i class="bi bi-file-earmark-text text-secondary"></i>
                                            Laporan kasus
                                        </div>

                                        <span class="status-count">
                                            {{ $summary['laporan'] }}
                                        </span>
                                    </div>

                                    <div class="status-row">
                                        <div class="status-name">
                                            <i class="bi bi-clipboard2-check text-secondary"></i>
                                            Skrining selesai
                                        </div>

                                        <span class="status-count">
                                            {{ $summary['skrining_selesai'] }}
                                        </span>
                                    </div>

                                    <div class="status-row">
                                        <div class="status-name">
                                            <i class="bi bi-chat-square-text text-secondary"></i>
                                            Permintaan bantuan
                                        </div>

                                        <span class="status-count">
                                            {{ $summary['bantuan'] }}
                                        </span>
                                    </div>

                                    <div class="status-row">
                                        <div class="status-name">
                                            <i class="bi bi-life-preserver text-secondary"></i>
                                            Rujukan
                                        </div>

                                        <span class="status-count">
                                            {{ $summary['rujukan'] }}
                                        </span>
                                    </div>

                                </div>

                            @else

                                <div class="panel-header">
                                    <div>
                                        <div class="panel-title">
                                            Laporan per Kelas
                                        </div>

                                        <div class="panel-subtitle">
                                            Kelas dengan jumlah laporan terbanyak
                                        </div>
                                    </div>
                                </div>

                                <div class="panel-body">

                                    @if ($laporanPerKelas->isEmpty())

                                        <div class="empty-text">
                                            Belum ada data laporan per kelas untuk filter ini.
                                        </div>

                                    @else

                                        <div class="bar-list">

                                            @foreach ($laporanPerKelas as $item)

                                                @php
                                                    $kelasWidth =
                                                        ($item->total / $maksKelas) * 100;
                                                @endphp

                                                <div>
                                                    <div class="bar-head">
                                                        <span class="bar-name">
                                                            {{ $item->nama_kelas }}
                                                        </span>

                                                        <span class="bar-value">
                                                            {{ $item->total }} laporan
                                                        </span>
                                                    </div>

                                                    <div class="bar-track">
                                                        <div
                                                            class="bar-fill"
                                                            style="width: {{ min($kelasWidth, 100) }}%;"
                                                        ></div>
                                                    </div>
                                                </div>

                                            @endforeach

                                        </div>

                                    @endif

                                </div>

                            @endif

                        </div>
                    </div>

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
                            Portal Guru BK · Statistik menggunakan data agregat sistem
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

<script
    src="https://cdn.jsdelivr.net/npm/chart.js@4.4.7/dist/chart.umd.min.js"
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

    @php
        $trendChartData = $trenBulanan->map(function ($item) {
            return [
                'label' => $item->label,
                'laporan' => (int) $item->laporan,
                'skrining' => (int) $item->skrining,
                'bantuan' => (int) $item->bantuan,
                'rujukan' => (int) $item->rujukan,
            ];
        })->values()->all();
    @endphp

    const trendData = @json($trendChartData);

    const chartCanvas = document.getElementById('activityChart');

    if (chartCanvas && typeof Chart !== 'undefined') {
        new Chart(chartCanvas, {
            type: 'line',

            data: {
                labels: trendData.map(item => item.label),

                datasets: [
                    {
                        label: 'Laporan',
                        data: trendData.map(item => item.laporan),
                        borderColor: '#0f8a83',
                        backgroundColor: '#0f8a83',
                        borderWidth: 2,
                        tension: .3,
                        pointRadius: 3,
                        pointHoverRadius: 4
                    },
                    {
                        label: 'Skrining',
                        data: trendData.map(item => item.skrining),
                        borderColor: '#547a9b',
                        backgroundColor: '#547a9b',
                        borderWidth: 2,
                        tension: .3,
                        pointRadius: 3,
                        pointHoverRadius: 4
                    },
                    {
                        label: 'Bantuan',
                        data: trendData.map(item => item.bantuan),
                        borderColor: '#b57b35',
                        backgroundColor: '#b57b35',
                        borderWidth: 2,
                        tension: .3,
                        pointRadius: 3,
                        pointHoverRadius: 4
                    },
                    {
                        label: 'Rujukan',
                        data: trendData.map(item => item.rujukan),
                        borderColor: '#7a6b8c',
                        backgroundColor: '#7a6b8c',
                        borderWidth: 2,
                        tension: .3,
                        pointRadius: 3,
                        pointHoverRadius: 4
                    }
                ]
            },

            options: {
                responsive: true,
                maintainAspectRatio: false,

                interaction: {
                    intersect: false,
                    mode: 'index'
                },

                plugins: {
                    legend: {
                        position: 'bottom',

                        labels: {
                            usePointStyle: true,
                            pointStyle: 'circle',
                            boxWidth: 6,
                            boxHeight: 6,
                            padding: 18,
                            color: '#667085',
                            font: {
                                size: 11
                            }
                        }
                    },

                    tooltip: {
                        backgroundColor: '#172033',
                        padding: 10,
                        titleFont: {
                            size: 11
                        },
                        bodyFont: {
                            size: 11
                        }
                    }
                },

                scales: {
                    x: {
                        grid: {
                            display: false
                        },

                        border: {
                            display: false
                        },

                        ticks: {
                            color: '#7b8795',
                            font: {
                                size: 10
                            }
                        }
                    },

                    y: {
                        beginAtZero: true,

                        ticks: {
                            precision: 0,
                            stepSize: 1,
                            color: '#7b8795',
                            font: {
                                size: 10
                            }
                        },

                        grid: {
                            color: '#edf1f1'
                        },

                        border: {
                            display: false
                        }
                    }
                }
            }
        });
    }
</script>

</body>
</html>

