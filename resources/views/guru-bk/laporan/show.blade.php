<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Detail Laporan - Guru BK - CurhatAman</title>

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
            --ca-info: #175cd3;
            --ca-info-soft: #eff8ff;
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

        .breadcrumb {
            margin-bottom: 16px;
            font-size: 11.5px;
        }

        .breadcrumb-item a {
            color: var(--ca-primary-dark);
            font-weight: 650;
        }

        .breadcrumb-item.active {
            color: var(--ca-muted);
        }

        .page-header {
            margin-bottom: 20px;
            padding: 20px 21px;
            border-radius: 12px;
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 18px;
            background: var(--ca-primary);
        }

        .page-kicker {
            margin-bottom: 5px;
            color: rgba(255, 255, 255, .70);
            font-size: 10px;
            font-weight: 760;
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        .page-title {
            margin: 0 0 5px;
            color: #ffffff;
            font-size: 25px;
            line-height: 1.2;
            font-weight: 760;
            letter-spacing: -.02em;
        }

        .report-code {
            color: rgba(255, 255, 255, .80);
            font-size: 11.5px;
            font-weight: 620;
        }

        .status-badge {
            min-height: 32px;
            padding: 0 11px;
            border: 1px solid rgba(255, 255, 255, .40);
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            color: #ffffff;
            background: rgba(255, 255, 255, .13);
            font-size: 10.5px;
            font-weight: 700;
            white-space: nowrap;
        }

        .page-header .status-baru,
        .page-header .status-diproses,
        .page-header .status-selesai,
        
        .header-action-btn {
            height: 32px;
            padding: 0 12px;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 11px;
            font-weight: 650;
            letter-spacing: .01em;
            text-decoration: none;
            white-space: nowrap;
            transition: all .15s ease;
        }

        .header-action-btn i {
            font-size: 12px;
            display: inline-flex;
            align-items: center;
        }

        .header-action-primary {
            color: var(--ca-primary-dark) !important;
            background: #ffffff;
            border: 1px solid rgba(255, 255, 255, .8);
            box-shadow: 0 1px 2px rgba(0, 0, 0, .06);
        }

        .header-action-primary:hover {
            color: var(--ca-primary-dark) !important;
            background: #f4f9f8;
            border-color: #ffffff;
            transform: translateY(-1px);
        }

        .header-action-outline {
            color: #ffffff !important;
            background: rgba(255, 255, 255, .14);
            border: 1px solid rgba(255, 255, 255, .40);
        }

        .header-action-outline:hover {
            color: #ffffff !important;
            background: rgba(255, 255, 255, .25);
            border-color: rgba(255, 255, 255, .65);
            transform: translateY(-1px);
        }

        .header-action-disabled {
            color: rgba(255, 255, 255, .75) !important;
            background: rgba(255, 255, 255, .12);
            border: 1px dashed rgba(255, 255, 255, .35);
            cursor: not-allowed;
            pointer-events: auto;
        }

        .page-header .status-dieskalasi {
            color: #fff3cd;
            background: rgba(217, 119, 6, .45);
            border: 1px solid rgba(251, 191, 36, .7);
        }

        .content-card {
            overflow: hidden;
            border: 1px solid var(--ca-border);
            border-top: 3px solid var(--ca-primary);
            border-radius: 12px;
            background: #ffffff;
        }

        .card-heading {
            padding: 16px 18px;
            border-bottom: 1px solid var(--ca-line);
            background: #ffffff;
        }

        .card-title-small {
            margin: 0;
            color: var(--ca-text);
            font-size: 13px;
            font-weight: 710;
        }

        .card-subtitle-small {
            margin-top: 3px;
            color: var(--ca-muted);
            font-size: 10.5px;
            line-height: 1.45;
        }

        .card-body-custom {
            padding: 18px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
        }

        .info-item {
            padding: 12px 13px;
            border: 1px solid var(--ca-line);
            border-radius: 9px;
            background: #fbfcfc;
        }

        .info-label {
            display: block;
            margin-bottom: 5px;
            color: #8592a3;
            font-size: 9.5px;
            font-weight: 720;
            letter-spacing: .04em;
            text-transform: uppercase;
        }

        .info-value {
            color: var(--ca-text);
            font-size: 12px;
            font-weight: 620;
            line-height: 1.5;
            overflow-wrap: anywhere;
        }

        .privacy-box {
            margin-top: 15px;
            padding: 13px 14px;
            border: 1px solid #cfe4e1;
            border-radius: 9px;
            display: flex;
            align-items: flex-start;
            gap: 10px;
            color: #46625f;
            background: #f0f8f7;
            font-size: 11px;
            line-height: 1.6;
        }

        .privacy-box i {
            margin-top: 2px;
            color: var(--ca-primary);
            font-size: 14px;
        }

        .chronology {
            color: #475467;
            font-size: 12px;
            line-height: 1.75;
            white-space: pre-line;
        }

        .evidence-item {
            padding: 12px 13px;
            border: 1px solid var(--ca-line);
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            background: #ffffff;
        }

        .evidence-item + .evidence-item {
            margin-top: 9px;
        }

        .evidence-name {
            min-width: 0;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            color: var(--ca-text);
            font-size: 11.5px;
            font-weight: 620;
        }

        .evidence-link {
            flex-shrink: 0;
            color: var(--ca-primary-dark);
            font-size: 11px;
            font-weight: 650;
        }

        .evidence-link:hover {
            color: var(--ca-primary);
        }

        .empty-note {
            padding: 13px 14px;
            border: 1px dashed #ced8da;
            border-radius: 9px;
            color: var(--ca-muted);
            background: #fbfcfc;
            font-size: 11px;
            line-height: 1.5;
        }

        .form-label {
            margin-bottom: 7px;
            color: #475467;
            font-size: 11px;
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

        .form-control:disabled,
        .form-select:disabled {
            color: #8b95a4;
            background: #f7f8f9;
        }

        textarea.form-control {
            min-height: 112px;
            resize: vertical;
        }

        .btn-primary-ca,
        .btn-secondary-ca {
            min-height: 42px;
            padding: 8px 14px;
            border-radius: 9px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            font-size: 11.5px;
            font-weight: 680;
        }

        .btn-primary-ca {
            border: 1px solid var(--ca-primary);
            color: #ffffff;
            background: var(--ca-primary);
        }

        .btn-primary-ca:hover,
        .btn-primary-ca:focus {
            color: #ffffff;
            background: var(--ca-primary-dark);
            border-color: var(--ca-primary-dark);
        }

        .btn-secondary-ca {
            border: 1px solid #cfe4e1;
            color: var(--ca-primary-dark);
            background: #ffffff;
        }

        .btn-secondary-ca:hover,
        .btn-secondary-ca:focus {
            color: var(--ca-primary-dark);
            background: var(--ca-primary-soft);
            border-color: #b9dbd6;
        }

        .btn-primary-ca:disabled,
        .btn-secondary-ca:disabled {
            opacity: .58;
            cursor: not-allowed;
        }

        .timeline {
            position: relative;
        }

        .timeline-item {
            position: relative;
            padding-left: 27px;
        }

        .timeline-item + .timeline-item {
            margin-top: 18px;
        }

        .timeline-item::before {
            content: "";
            position: absolute;
            top: 6px;
            left: 6px;
            width: 9px;
            height: 9px;
            border-radius: 50%;
            background: var(--ca-primary);
        }

        .timeline-item::after {
            content: "";
            position: absolute;
            top: 18px;
            bottom: -20px;
            left: 10px;
            width: 1px;
            background: #d9e4e4;
        }

        .timeline-item:last-child::after {
            display: none;
        }

        .timeline-meta {
            margin-bottom: 4px;
            color: var(--ca-muted);
            font-size: 10px;
        }

        .timeline-status {
            margin-bottom: 4px;
            color: var(--ca-text);
            font-size: 11.5px;
            font-weight: 680;
        }

        .timeline-note {
            color: #475467;
            font-size: 11.5px;
            line-height: 1.6;
            white-space: pre-line;
        }

        .alert-custom,
        .alert {
            border-radius: 9px;
            font-size: 11.5px;
        }

        .conflict-choice {
            margin-bottom: 12px;
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 9px;
        }

        .conflict-option {
            position: relative;
        }

        .conflict-option input {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }

        .conflict-option label {
            width: 100%;
            min-height: 68px;
            padding: 11px;
            border: 1px solid #dce4e4;
            border-radius: 9px;
            display: flex;
            align-items: flex-start;
            gap: 9px;
            color: #475467;
            background: #ffffff;
            cursor: pointer;
            font-size: 10.5px;
            line-height: 1.45;
        }

        .conflict-option label i {
            margin-top: 1px;
            color: #7b8795;
        }

        .conflict-option input:checked + label {
            color: var(--ca-primary-dark);
            background: var(--ca-primary-soft);
            border-color: var(--ca-primary);
        }

        .conflict-option input:checked + label i {
            color: var(--ca-primary);
        }

        .declaration-status {
            padding: 11px 12px;
            border-radius: 9px;
            display: flex;
            align-items: flex-start;
            gap: 9px;
            font-size: 10.5px;
            line-height: 1.55;
        }

        .declaration-safe {
            border: 1px solid #cfe4e1;
            color: #496965;
            background: #f0f8f7;
        }

        .declaration-conflict {
            border: 1px solid #f6d7d3;
            color: #8f2f25;
            background: #fff7f6;
        }

        .conflict-detail {
            margin-top: 9px;
            padding: 10px 11px;
            border-radius: 8px;
            color: #667085;
            background: #f7f9f9;
            font-size: 10.5px;
            line-height: 1.55;
            white-space: pre-line;
        }

        .conflict-note {
            margin-top: 9px;
            color: var(--ca-muted);
            font-size: 10px;
            line-height: 1.5;
        }

        .assignment-person {
            padding: 12px;
            border: 1px solid var(--ca-line);
            border-radius: 9px;
            display: flex;
            align-items: center;
            gap: 11px;
            background: #fbfcfc;
        }

        .assignment-avatar {
            width: 38px;
            height: 38px;
            flex: 0 0 38px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: var(--ca-primary-dark);
            background: var(--ca-primary-soft);
            font-size: 11.5px;
            font-weight: 750;
        }

        .assignment-name {
            color: var(--ca-text);
            font-size: 11.5px;
            font-weight: 680;
        }

        .assignment-role {
            margin-top: 1px;
            color: var(--ca-muted);
            font-size: 10px;
        }

        .assignment-note {
            margin-top: 11px;
            color: var(--ca-muted);
            font-size: 10.5px;
            line-height: 1.55;
        }

        .assignment-empty {
            padding: 12px;
            border: 1px dashed #d6dfdf;
            border-radius: 9px;
            color: var(--ca-muted);
            background: #fbfcfc;
            font-size: 10.5px;
            line-height: 1.55;
        }

        .assignment-badge {
            margin-top: 6px;
            padding: 4px 7px;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            color: var(--ca-primary-dark);
            background: var(--ca-primary-soft);
            font-size: 9.5px;
            font-weight: 680;
        }

        .locked-note {
            padding: 11px 12px;
            border: 1px solid #fde2df;
            border-radius: 8px;
            display: flex;
            align-items: flex-start;
            gap: 8px;
            color: #8f2f25;
            background: #fff7f6;
            font-size: 10.5px;
            line-height: 1.5;
        }

        .locked-note i {
            margin-top: 1px;
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
            .page-body {
                padding: 24px;
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

            .page-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .page-title {
                font-size: 22px;
            }

            .info-grid,
            .conflict-choice {
                grid-template-columns: 1fr;
            }

            .evidence-item {
                align-items: flex-start;
                flex-direction: column;
            }
        }
    </style>
    @include('guru-bk.partials.styles')
</head>

<body>

@php
    $errors = $errors ?? new \Illuminate\Support\ViewErrorBag();
    $namaUser = ucwords($user->name);
    $inisial = strtoupper(substr($user->name, 0, 1));

    $statusClass = match($detail->status_kasus) {
        'baru' => 'status-baru',
        'diproses' => 'status-diproses',
        'selesai' => 'status-selesai',
        'dieskalasi' => 'status-dieskalasi',
        default => 'status-baru',
    };

    $statusLabel = match($detail->status_kasus) {
        'baru' => 'Baru',
        'diproses' => 'Diproses',
        'selesai' => 'Selesai',
        'dieskalasi' => 'Dieskalasi',
        default => ucfirst($detail->status_kasus),
    };

    $dapatMenangani =
        (int) $detail->assigned_bk_id === (int) $user->id
        && $konflikDeklarasi
        && ! (bool) $konflikDeklarasi->ada_konflik;
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
                    Detail Laporan
                </div>

                <div class="topbar-subtitle">
                    Detail laporan kasus siswa.
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

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">

                        <li class="breadcrumb-item">
                            <a href="{{ route('guru-bk.laporan.index') }}">
                                Laporan Kasus
                            </a>
                        </li>

                        <li
                            class="breadcrumb-item active"
                            aria-current="page"
                        >
                            Detail Laporan
                        </li>

                    </ol>
                </nav>

                @php
                    $waDigitsSiswa = '';
                    if (! empty($detail->whatsapp_number)) {
                        $waDigitsSiswa = preg_replace('/\D+/', '', (string) $detail->whatsapp_number);
                        if (str_starts_with($waDigitsSiswa, '0')) {
                            $waDigitsSiswa = '62' . substr($waDigitsSiswa, 1);
                        } elseif (str_starts_with($waDigitsSiswa, '8')) {
                            $waDigitsSiswa = '62' . $waDigitsSiswa;
                        }
                    }
                @endphp

                @if (session('success'))
                    <div
                        class="alert alert-success alert-custom mb-4 d-flex flex-wrap align-items-center justify-content-between gap-2"
                        role="alert"
                    >
                        <div>
                            <i class="bi bi-check-circle-fill me-2"></i>
                            {{ session('success') }}
                        </div>

                        @if (session('wa_followup_url'))
                            <a
                                href="{{ session('wa_followup_url') }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="btn-secondary-ca text-decoration-none"
                                style="min-height: 32px; padding: 5px 12px; font-size: 11px;"
                            >
                                <i class="bi bi-whatsapp"></i>
                                Hubungi via WhatsApp
                            </a>
                        @endif
                    </div>
                @endif

                @if ($errors->any())
                    <div
                        class="alert alert-danger alert-custom mb-4"
                        role="alert"
                    >
                        <i class="bi bi-exclamation-circle-fill me-2"></i>
                        {{ $errors->first() }}
                    </div>
                @endif

                <section class="page-header">

                    <div>

                        <div class="page-kicker">
                            Manajemen Kasus
                        </div>

                        <h1 class="page-title">
                            Detail Laporan
                        </h1>

                        <div class="report-code">
                            {{ $detail->kode_laporan }}
                        </div>

                    </div>

                    <div class="d-flex align-items-center gap-2 flex-wrap">
                        <span class="status-badge {{ $statusClass }}">
                            {{ $statusLabel }}
                        </span>

                        @if ($dapatMenangani)
                            <a href="{{ route('guru-bk.catatan-konseling.create', ['laporan_id' => $detail->id, 'siswa_id' => $detail->siswa_id]) }}" class="header-action-btn header-action-primary">
                                <i class="bi bi-journal-plus"></i>
                                <span>Buat Catatan Konseling</span>
                            </a>
                        @elseif ($konflikDeklarasi && (bool) $konflikDeklarasi->ada_konflik)
                            <button type="button" class="header-action-btn header-action-disabled" disabled title="Terkunci: Anda memiliki konflik kepentingan pada kasus ini">
                                <i class="bi bi-lock-fill"></i>
                                <span>Buat Catatan Konseling</span>
                            </button>
                        @elseif (! $detail->assigned_bk_id)
                            <button type="button" class="header-action-btn header-action-disabled" disabled title="Ambil penanganan kasus terlebih dahulu di panel kanan untuk membuat catatan konseling">
                                <i class="bi bi-lock-fill"></i>
                                <span>Buat Catatan Konseling</span>
                            </button>
                        @elseif ((int) $detail->assigned_bk_id !== (int) $user->id)
                            <span class="header-action-btn header-action-disabled" title="Kasus sedang ditangani oleh {{ $detail->nama_bk_penanggung_jawab ?? 'Guru BK lain' }}">
                                <i class="bi bi-person-lock"></i>
                                <span>Ditangani {{ Str::limit($detail->nama_bk_penanggung_jawab ?? 'Guru BK Lain', 15) }}</span>
                            </span>
                        @else
                            <button type="button" class="header-action-btn header-action-disabled" disabled title="Selesaikan deklarasi bebas konflik di panel kanan terlebih dahulu">
                                <i class="bi bi-shield-exclamation"></i>
                                <span>Buat Catatan Konseling</span>
                            </button>
                        @endif

                        <a href="{{ route('guru-bk.laporan.pdf.detail', $detail->id) }}" class="header-action-btn header-action-outline">
                            <i class="bi bi-file-pdf"></i>
                            <span>Cetak PDF</span>
                        </a>
                    </div>

                </section>

                @if ($errors->has('assignment'))
                    <div class="alert alert-danger mb-4" role="alert">
                        <i class="bi bi-exclamation-circle me-1"></i>
                        {{ $errors->first('assignment') }}
                    </div>
                @endif

                <div class="row g-4">

                    <div class="col-xl-8">

                        <section class="content-card mb-4">

                            <div class="card-heading">
                                <h2 class="card-title-small">
                                    Informasi Pelapor
                                </h2>

                                <div class="card-subtitle-small">
                                    Identitas asli tersedia untuk kebutuhan penanganan Guru BK
                                </div>
                            </div>

                            <div class="card-body-custom">

                                <div class="info-grid">

                                    <div class="info-item">
                                        <span class="info-label">Nama Siswa</span>
                                        <div class="info-value">
                                            {{ $detail->nama_siswa }}
                                        </div>
                                    </div>

                                    <div class="info-item">
                                        <span class="info-label">NIS</span>
                                        <div class="info-value">
                                            {{ $detail->nis ?? 'Belum tersedia' }}
                                        </div>
                                    </div>

                                    <div class="info-item">
                                        <span class="info-label">Kelas</span>
                                        <div class="info-value">
                                            {{ $detail->nama_kelas ?? 'Belum tersedia' }}
                                            @if ($detail->tahun_ajaran)
                                                · {{ $detail->tahun_ajaran }}
                                            @endif
                                        </div>
                                    </div>

                                    <div class="info-item">
                                        <span class="info-label">Email</span>
                                        <div class="info-value">
                                            {{ $detail->email_siswa }}
                                        </div>
                                    </div>

                                    <div class="info-item">
                                        <span class="info-label">Nomor WhatsApp</span>
                                        <div class="info-value d-flex align-items-center gap-2 flex-wrap">
                                            <span>{{ $detail->whatsapp_number ?: 'Belum dilengkapi siswa' }}</span>
                                            @if ($waDigitsSiswa !== '')
                                                <a
                                                    href="https://wa.me/{{ $waDigitsSiswa }}"
                                                    target="_blank"
                                                    rel="noopener noreferrer"
                                                    class="evidence-link"
                                                    style="padding: 3px 9px; font-size: 10.5px;"
                                                >
                                                    <i class="bi bi-whatsapp me-1"></i> WhatsApp
                                                </a>
                                            @endif
                                        </div>
                                    </div>

                                </div>

                                <div class="privacy-box">

                                    <i class="bi bi-shield-lock"></i>

                                    <div>
                                        @if ($detail->status_rahasia)
                                            Laporan ini ditandai <strong>rahasia</strong>.
                                            Identitas pelapor tetap dapat dilihat oleh Guru BK
                                            yang berwenang untuk kebutuhan penanganan, tetapi
                                            harus dilindungi dari pengguna lain yang tidak memiliki
                                            kewenangan.
                                        @else
                                            Laporan menggunakan identitas asli. Data pelapor
                                            digunakan sesuai kebutuhan penanganan dan pendampingan.
                                        @endif
                                    </div>

                                </div>

                            </div>

                        </section>

                        <section class="content-card mb-4">

                            <div class="card-heading">
                                <h2 class="card-title-small">
                                    Informasi Kejadian
                                </h2>
                            </div>

                            <div class="card-body-custom">

                                <div class="info-grid mb-3">

                                    <div class="info-item">
                                        <span class="info-label">Kategori</span>
                                        <div class="info-value">
                                            {{ $detail->nama_kategori }}
                                        </div>
                                    </div>

                                    <div class="info-item">
                                        <span class="info-label">Tanggal Kejadian</span>
                                        <div class="info-value">
                                            {{ \Carbon\Carbon::parse($detail->tanggal_kejadian)->format('d M Y') }}
                                        </div>
                                    </div>

                                    <div class="info-item">
                                        <span class="info-label">Lokasi</span>
                                        <div class="info-value">
                                            {{ $detail->lokasi_kejadian ?? '-' }}
                                        </div>
                                    </div>

                                    <div class="info-item">
                                        <span class="info-label">Laporan Masuk</span>
                                        <div class="info-value">
                                            {{ \Carbon\Carbon::parse($detail->created_at)->format('d M Y, H:i') }}
                                        </div>
                                    </div>

                                </div>

                                <span class="info-label">
                                    Kronologi
                                </span>

                                <div class="chronology">{{ $detail->deskripsi }}</div>

                            </div>

                        </section>

                        <section class="content-card mb-4">

                            <div class="card-heading">
                                <h2 class="card-title-small">
                                    Bukti Pendukung
                                </h2>
                            </div>

                            <div class="card-body-custom">

                                @forelse ($bukti as $item)

                                    <div class="evidence-item">

                                        <div class="d-flex align-items-center gap-2 min-w-0">

                                            <i class="bi bi-paperclip text-secondary"></i>

                                            <span class="evidence-name">
                                                {{ $item->original_name }}
                                            </span>

                                        </div>

                                        <a
                                            href="{{ asset('storage/' . $item->file_path) }}"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            class="evidence-link"
                                        >
                                            Lihat Bukti
                                            <i class="bi bi-box-arrow-up-right ms-1"></i>
                                        </a>

                                    </div>

                                @empty

                                    <div class="empty-note">
                                        Tidak ada bukti pendukung pada laporan ini.
                                    </div>

                                @endforelse

                            </div>

                        </section>

                        <section class="content-card">

                            <div class="card-heading">
                                <h2 class="card-title-small">
                                    Riwayat Tindak Lanjut
                                </h2>

                                <div class="card-subtitle-small">
                                    Catatan penanganan yang telah dilakukan oleh Guru BK
                                </div>
                            </div>

                            <div class="card-body-custom">

                                @if ($tindakLanjut->isEmpty())

                                    <div class="empty-note">
                                        Belum ada tindak lanjut yang dicatat.
                                    </div>

                                @else

                                    <div class="timeline">

                                        @foreach ($tindakLanjut as $item)

                                            <div class="timeline-item">

                                                <div class="timeline-meta">
                                                    {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y, H:i') }}
                                                    · {{ $item->nama_petugas }}
                                                </div>

                                                <div class="timeline-status">
                                                    {{ $item->status }}
                                                </div>

                                                <div class="timeline-note">{{ $item->catatan }}</div>

                                                @if ($waDigitsSiswa !== '')
                                                    @php
                                                        $waItemText = "Halo {$detail->nama_siswa}, terkait laporan kamu ({$detail->kode_laporan}) di layanan CurhatAman:\n\n"
                                                            . "*Status Tindak Lanjut:* {$item->status}\n"
                                                            . "*Catatan / Pemanggilan:* {$item->catatan}\n\n"
                                                            . "Terima kasih — Guru BK ({$item->nama_petugas})";
                                                        $waItemUrl = 'https://wa.me/' . $waDigitsSiswa . '?text=' . rawurlencode($waItemText);
                                                    @endphp
                                                    <div class="mt-2">
                                                        <a
                                                            href="{{ $waItemUrl }}"
                                                            target="_blank"
                                                            rel="noopener noreferrer"
                                                            class="evidence-link d-inline-flex align-items-center gap-1"
                                                            style="padding: 4px 10px; font-size: 10.5px;"
                                                        >
                                                            <i class="bi bi-whatsapp"></i>
                                                            Hubungi via WhatsApp
                                                        </a>
                                                    </div>
                                                @endif

                                            </div>

                                        @endforeach

                                    </div>

                                @endif

                            </div>

                        
                        <section class="content-card mb-4">

                            <div class="card-heading">
                                <h2 class="card-title-small">
                                    <i class="bi bi-journal-medical text-primary me-1"></i> Sesi Bimbingan & Konseling Terkait
                                </h2>
                                <div class="card-subtitle-small">
                                    Dokumentasi sesi konseling individual / mediasi atas kasus laporan ini
                                </div>
                            </div>

                            <div class="card-body-custom">

                                @if(isset($riwayatKonseling) && count($riwayatKonseling) > 0)
                                    <div class="table-responsive">
                                        <table class="table table-hover align-middle mb-0" style="font-size: 13px;">
                                            <thead style="background: #f8fafc; font-size: 11.5px; color: var(--ca-muted);">
                                                <tr>
                                                    <th style="padding: 10px 14px;">TANGGAL</th>
                                                    <th style="padding: 10px 14px;">LAYANAN</th>
                                                    <th style="padding: 10px 14px;">TOPIK</th>
                                                    <th style="padding: 10px 14px;">GURU BK</th>
                                                    <th style="padding: 10px 14px; text-align: right;">AKSI</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($riwayatKonseling as $sesi)
                                                    <tr>
                                                        <td style="padding: 11px 14px; font-weight: 600; white-space: nowrap;">
                                                            <i class="bi bi-calendar-event text-primary me-1"></i>
                                                            {{ \Carbon\Carbon::parse($sesi->tanggal_pertemuan)->locale('id')->translatedFormat('d M Y') }}
                                                        </td>
                                                        <td style="padding: 11px 14px;">
                                                            <span class="badge" style="background: var(--ca-primary-soft); color: var(--ca-primary-dark); font-weight: 600; font-size: 11px; padding: 4px 8px; border-radius: 6px;">
                                                                {{ $sesi->jenis_layanan }}
                                                            </span>
                                                        </td>
                                                        <td style="padding: 11px 14px; font-weight: 500; color: #1e293b;">
                                                            {{ $sesi->topik }}
                                                        </td>
                                                        <td style="padding: 11px 14px; color: var(--ca-muted);">
                                                            {{ $sesi->nama_guru_bk }}
                                                        </td>
                                                        <td style="padding: 11px 14px; text-align: right; white-space: nowrap;">
                                                            <a href="{{ route('guru-bk.catatan-konseling.show', $sesi->id) }}" class="btn btn-sm btn-outline-primary" style="font-size: 11.5px; border-radius: 6px; padding: 3px 8px;">
                                                                <i class="bi bi-eye"></i> Detail
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <div class="empty-note">
                                        @if ($dapatMenangani)
                                            Belum ada sesi konseling yang dicatat untuk kasus ini. Gunakan tombol <strong>+ Buat Catatan Konseling</strong> di atas untuk memulai sesi.
                                        @elseif (! $detail->assigned_bk_id)
                                            Belum ada sesi konseling yang dicatat untuk kasus ini. Ambil penanganan kasus pada panel kanan terlebih dahulu untuk mendokumentasikan konseling.
                                        @elseif ((int) $detail->assigned_bk_id !== (int) $user->id)
                                            Belum ada sesi konseling yang dicatat untuk kasus ini. Kasus ini berada dalam penanganan <strong>{{ $detail->nama_bk_penanggung_jawab ?? 'Guru BK lain' }}</strong>.
                                        @else
                                            Belum ada sesi konseling yang dicatat untuk kasus ini. Selesaikan deklarasi konflik kepentingan pada panel kanan terlebih dahulu.
                                        @endif
                                    </div>
                                @endif

                            </div>

                        </section>
                    </div>

                    <div class="col-xl-4">

                        <section class="content-card mb-4">

                            <div class="card-heading">
                                <h2 class="card-title-small">
                                    Konflik Kepentingan
                                </h2>

                                <div class="card-subtitle-small">
                                    Deklarasi sebelum mengambil penanganan laporan
                                </div>
                            </div>

                            <div class="card-body-custom">

                                @if ($konflikDeklarasi && (bool) $konflikDeklarasi->ada_konflik)

                                    <div class="declaration-status declaration-conflict">
                                        <i class="bi bi-shield-x"></i>
                                        <div>
                                            <strong>Konflik Kepentingan Tercatat</strong>
                                            <div>
                                                Deklarasi:
                                                {{ \Carbon\Carbon::parse(
                                                    $konflikDeklarasi->declared_at
                                                )->locale('id')->translatedFormat('d F Y, H:i') }}
                                            </div>
                                        </div>
                                    </div>

                                    @if ($konflikDeklarasi->keterangan)
                                        <div class="conflict-detail">
                                            <strong>Keterangan Konflik:</strong><br>
                                            {{ $konflikDeklarasi->keterangan }}
                                        </div>
                                    @endif

                                    <div class="locked-note mt-3">
                                        <i class="bi bi-lock-fill text-danger"></i>
                                        <div>
                                            <strong>Penanganan Terkunci Permanen:</strong><br>
                                            Anda telah menyatakan memiliki konflik kepentingan pada laporan ini. Laporan telah berstatus <strong>Dieskalasi</strong> dan seluruh hak penanganan dikunci permanen untuk akun Anda demi menjunjung kode etik konseling. Laporan ini dapat diambil oleh Guru BK lain yang netral atau didisposisikan oleh Kepala Sekolah.
                                        </div>
                                    </div>

                                @elseif (
                                    $detail->assigned_bk_id
                                    && (int) $detail->assigned_bk_id !==
                                        (int) $user->id
                                )

                                    <div class="assignment-empty">
                                        Laporan sudah ditangani Guru BK lain.
                                        Deklarasi konflik untuk akun ini tidak
                                        diperlukan.
                                    </div>

                                @elseif (
                                    $detail->assigned_bk_id
                                    && (int) $detail->assigned_bk_id ===
                                        (int) $user->id
                                    && $konflikDeklarasi
                                )

                                    <div class="declaration-status declaration-safe">
                                        <i class="bi bi-shield-check"></i>
                                        <div>
                                            <strong>Tidak ada konflik kepentingan</strong>
                                            <div>
                                                Deklarasi:
                                                {{ \Carbon\Carbon::parse(
                                                    $konflikDeklarasi->declared_at
                                                )->locale('id')->translatedFormat('d F Y, H:i') }}
                                            </div>
                                        </div>
                                    </div>

                                @else

                                    @if ($konflikDeklarasi)

                                        <div class="declaration-status declaration-safe">
                                            <i class="bi bi-shield-check"></i>
                                            <div>
                                                <strong>Tidak ada konflik kepentingan</strong>
                                                <div>
                                                    Deklarasi:
                                                    {{ \Carbon\Carbon::parse(
                                                        $konflikDeklarasi->declared_at
                                                    )->locale('id')->translatedFormat('d F Y, H:i') }}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="conflict-note">
                                            Deklarasi masih dapat diubah menjadi "Ada Konflik" sebelum penanganan laporan diambil.
                                        </div>

                                    @endif

                                    <form
                                        method="POST"
                                        action="{{ route(
                                            'guru-bk.laporan.konflik.store',
                                            $detail->id
                                        ) }}"
                                        class="mt-3"
                                    >
                                        @csrf

                                        <div class="conflict-choice">

                                            <div class="conflict-option">
                                                <input
                                                    type="radio"
                                                    name="ada_konflik"
                                                    id="konflik_tidak"
                                                    value="0"
                                                    @checked(
                                                        old(
                                                            'ada_konflik',
                                                            $konflikDeklarasi
                                                                ? (string) (int) $konflikDeklarasi->ada_konflik
                                                                : ''
                                                        ) === '0'
                                                    )
                                                    required
                                                >

                                                <label for="konflik_tidak">
                                                    <i class="bi bi-shield-check"></i>

                                                    <span>
                                                        <strong>Tidak ada</strong><br>
                                                        Saya dapat menangani laporan ini.
                                                    </span>
                                                </label>
                                            </div>

                                            <div class="conflict-option">
                                                <input
                                                    type="radio"
                                                    name="ada_konflik"
                                                    id="konflik_ada"
                                                    value="1"
                                                    @checked(
                                                        old(
                                                            'ada_konflik',
                                                            $konflikDeklarasi
                                                                ? (string) (int) $konflikDeklarasi->ada_konflik
                                                                : ''
                                                        ) === '1'
                                                    )
                                                    required
                                                >

                                                <label for="konflik_ada">
                                                    <i class="bi bi-exclamation-triangle"></i>

                                                    <span>
                                                        <strong>Ada konflik</strong><br>
                                                        Saya tidak seharusnya menangani laporan.
                                                    </span>
                                                </label>
                                            </div>

                                        </div>

                                        <div
                                            id="conflictDescriptionWrap"
                                            class="mb-3"
                                            style="display:none;"
                                        >
                                            <label
                                                for="keterangan_konflik"
                                                class="form-label"
                                            >
                                                Keterangan Konflik
                                            </label>

                                            <textarea
                                                name="keterangan"
                                                id="keterangan_konflik"
                                                class="form-control"
                                                maxlength="1500"
                                                placeholder="Jelaskan secara singkat konflik kepentingan yang ada..."
                                            >{{ old(
                                                'keterangan',
                                                $konflikDeklarasi->keterangan ?? ''
                                            ) }}</textarea>
                                        </div>

                                        <button
                                            type="submit"
                                            class="btn-secondary-ca w-100"
                                        >
                                            <i class="bi bi-save"></i>
                                            Simpan Deklarasi
                                        </button>
                                    </form>

                                @endif

                            </div>

                        </section>

                        <section class="content-card mb-4">

                            <div class="card-heading">
                                <h2 class="card-title-small">
                                    Penanggung Jawab
                                </h2>

                                <div class="card-subtitle-small">
                                    Guru BK yang menangani laporan ini
                                </div>
                            </div>

                            <div class="card-body-custom">

                                @if ($detail->assigned_bk_id)

                                    <div class="assignment-person">

                                        <span class="assignment-avatar">
                                            {{ strtoupper(
                                                substr(
                                                    $detail->nama_bk_penanggung_jawab ?? 'G',
                                                    0,
                                                    1
                                                )
                                            ) }}
                                        </span>

                                        <div>
                                            <div class="assignment-name">
                                                {{ $detail->nama_bk_penanggung_jawab }}
                                            </div>

                                            <div class="assignment-role">
                                                Guru BK
                                            </div>

                                            @if (
                                                (int) $detail->assigned_bk_id ===
                                                (int) $user->id
                                            )
                                                <span class="assignment-badge">
                                                    <i class="bi bi-check-circle"></i>
                                                    Anda penanggung jawab
                                                </span>
                                            @endif
                                        </div>

                                    </div>

                                    @if (
                                        (int) $detail->assigned_bk_id !==
                                        (int) $user->id
                                    )
                                        <div class="locked-note mt-3">
                                            <i class="bi bi-lock"></i>

                                            <div>
                                                Laporan ini sedang ditangani
                                                Guru BK lain. Status dan tindak
                                                lanjut hanya dapat diperbarui
                                                oleh penanggung jawab.
                                            </div>
                                        </div>
                                    @endif

                                @else

                                    <div class="assignment-empty">
                                        Belum ada Guru BK yang menjadi
                                        penanggung jawab laporan ini.
                                    </div>

                                    @if (
                                        $konflikDeklarasi
                                        && $konflikDeklarasi->ada_konflik
                                    )

                                        <div class="locked-note mt-3">
                                            <i class="bi bi-lock"></i>

                                            <div>
                                                Kamu menyatakan memiliki konflik
                                                kepentingan sehingga laporan ini
                                                tidak dapat diambil.
                                            </div>
                                        </div>

                                    @else

                                        <div class="assignment-note">
                                            Pilih <strong>"Tidak ada"</strong> pada deklarasi Konflik Kepentingan di atas untuk otomatis menjadi Penanggung Jawab laporan ini.
                                        </div>

                                    @endif

                                @endif

                            </div>

                        </section>

                        <section class="content-card mb-4">

                            <div class="card-heading">
                                <h2 class="card-title-small">
                                    Status Kasus
                                </h2>

                                <div class="card-subtitle-small">
                                    Perbarui status sesuai perkembangan penanganan
                                </div>
                            </div>

                            <div class="card-body-custom">

                                @if ($konflikDeklarasi && (bool) $konflikDeklarasi->ada_konflik)
                                    <div class="locked-note mb-3">
                                        <i class="bi bi-lock-fill text-danger"></i>
                                        <div>
                                            Status kasus tidak dapat diubah karena Anda memiliki konflik kepentingan pada laporan ini.
                                        </div>
                                    </div>
                                @elseif (
                                    (int) $detail->assigned_bk_id ===
                                        (int) $user->id
                                    && ! $dapatMenangani
                                )
                                    <div class="locked-note mb-3">
                                        <i class="bi bi-shield-exclamation"></i>

                                        <div>
                                            Simpan deklarasi bahwa tidak ada
                                            konflik kepentingan sebelum
                                            memperbarui penanganan.
                                        </div>
                                    </div>
                                @endif

                                <form
                                    method="POST"
                                    action="{{ route('guru-bk.laporan.status', $detail->id) }}"
                                >
                                    @csrf
                                    @method('PATCH')

                                    <label
                                        for="status_kasus"
                                        class="form-label"
                                    >
                                        Status
                                    </label>

                                    <select
                                        name="status_kasus"
                                        id="status_kasus"
                                        class="form-select mb-3"
                                        required
                                        @disabled(! $dapatMenangani)
                                    >
                                        <option
                                            value="baru"
                                            @selected($detail->status_kasus === 'baru')
                                        >
                                            Baru
                                        </option>

                                        <option
                                            value="diproses"
                                            @selected($detail->status_kasus === 'diproses')
                                        >
                                            Diproses
                                        </option>

                                        <option
                                            value="selesai"
                                            @selected($detail->status_kasus === 'selesai')
                                        >
                                            Selesai
                                        </option>

                                        <option
                                            value="dieskalasi"
                                            @selected($detail->status_kasus === 'dieskalasi')
                                        >
                                            Dieskalasi
                                        </option>
                                    </select>

                                    <button
                                        type="submit"
                                        class="btn-primary-ca w-100"
                                        @disabled(! $dapatMenangani)
                                    >
                                        <i class="bi bi-check2-circle"></i>
                                        Simpan Status
                                    </button>

                                </form>

                            </div>

                        </section>

                        <section class="content-card">

                            <div class="card-heading">
                                <h2 class="card-title-small">
                                    Catat Tindak Lanjut
                                </h2>

                                <div class="card-subtitle-small">
                                    Tambahkan aktivitas penanganan kasus
                                </div>
                            </div>

                            <div class="card-body-custom">

                                @if ($konflikDeklarasi && (bool) $konflikDeklarasi->ada_konflik)
                                    <div class="locked-note mb-3">
                                        <i class="bi bi-lock-fill text-danger"></i>
                                        <div>
                                            Pencatatan tindak lanjut dikunci karena Anda memiliki konflik kepentingan pada laporan ini.
                                        </div>
                                    </div>
                                @endif

                                <form
                                    method="POST"
                                    action="{{ route('guru-bk.laporan.tindak-lanjut.store', $detail->id) }}"
                                >
                                    @csrf

                                    <div class="mb-3">

                                        <label
                                            for="status"
                                            class="form-label"
                                        >
                                            Jenis / Status Tindak Lanjut
                                        </label>

                                        <input
                                            type="text"
                                            name="status"
                                            id="status"
                                            class="form-control"
                                            value="{{ old('status') }}"
                                            placeholder="Contoh: Konseling awal"
                                            maxlength="50"
                                            required
                                            @disabled(! $dapatMenangani)
                                        >

                                    </div>

                                    <div class="mb-3">

                                        <label
                                            for="catatan"
                                            class="form-label"
                                        >
                                            Catatan
                                        </label>

                                        <textarea
                                            name="catatan"
                                            id="catatan"
                                            class="form-control"
                                            maxlength="3000"
                                            placeholder="Tuliskan tindak lanjut yang telah dilakukan..."
                                            required
                                            @disabled(! $dapatMenangani)
                                        >{{ old('catatan') }}</textarea>

                                    </div>

                                    <button
                                        type="submit"
                                        class="btn-primary-ca w-100"
                                        @disabled(! $dapatMenangani)
                                    >
                                        <i class="bi bi-journal-plus"></i>
                                        Simpan Tindak Lanjut
                                    </button>

                                </form>

                            </div>

                        </section>

                    </div>

                </div>

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

    const conflictYes =
        document.getElementById('konflik_ada');

    const conflictNo =
        document.getElementById('konflik_tidak');

    const conflictDescriptionWrap =
        document.getElementById('conflictDescriptionWrap');

    const conflictDescription =
        document.getElementById('keterangan_konflik');

    function updateConflictDescription() {
        if (! conflictDescriptionWrap) {
            return;
        }

        const hasConflict =
            conflictYes && conflictYes.checked;

        conflictDescriptionWrap.style.display =
            hasConflict ? 'block' : 'none';

        if (conflictDescription) {
            conflictDescription.required = hasConflict;
        }
    }

    if (conflictYes) {
        conflictYes.addEventListener(
            'change',
            updateConflictDescription
        );
    }

    if (conflictNo) {
        conflictNo.addEventListener(
            'change',
            updateConflictDescription
        );
    }

    updateConflictDescription();
</script>

</body>
</html>




