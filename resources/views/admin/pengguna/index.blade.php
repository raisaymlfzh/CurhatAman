@php
    $errors = $errors ?? new \Illuminate\Support\ViewErrorBag();
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Kelola Pengguna | CurhatAman</title>

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
            --ca-success: #027a48;
            --ca-success-soft: #ecf8f2;
            --ca-danger: #b42318;
            --ca-danger-soft: #fff1f0;
            --ca-warning: #9a650f;
            --ca-warning-soft: #fff7e8;
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
            background: #ffffff !important;
            border-bottom: 1px solid var(--ca-border);
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.03);
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
            color: #667085;
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

        .flash-success,
        .flash-error {
            margin-bottom: 16px;
            padding: 12px 14px;
            border-radius: 9px;
            display: flex;
            align-items: flex-start;
            gap: 8px;
            font-size: 11.5px;
        }

        .flash-success {
            color: var(--ca-success);
            background: var(--ca-success-soft);
            border: 1px solid #cde8db;
        }

        .flash-error {
            color: var(--ca-danger);
            background: var(--ca-danger-soft);
            border: 1px solid #f1c7c3;
        }

        .page-header {
            margin-bottom: 20px;
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

        .page-actions {
            flex: 0 0 auto;
            display: flex;
            align-items: center;
            justify-content: flex-end;
        }

        .btn-primary-ca {
            min-width: 154px;
            height: 42px;
            padding: 0 16px;
            border: 1px solid rgba(255, 255, 255, .74);
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            color: var(--ca-primary-dark);
            background: #ffffff;
            font-size: 12px;
            line-height: 1;
            font-weight: 680;
            white-space: nowrap;
            flex-shrink: 0;
            transition: background .15s ease, border-color .15s ease, transform .15s ease;
        }

        .btn-primary-ca i {
            font-size: 14px;
        }

        .btn-primary-ca:hover,
        .btn-primary-ca:focus {
            color: var(--ca-primary-dark);
            background: #f2faf8;
            border-color: #ffffff;
            transform: translateY(-1px);
        }

        .btn-secondary-ca {
            min-width: 140px;
            height: 42px;
            padding: 0 16px;
            border: 1px solid rgba(255, 255, 255, .45);
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            color: #ffffff;
            background: rgba(255, 255, 255, .15);
            font-size: 12px;
            line-height: 1;
            font-weight: 680;
            white-space: nowrap;
            flex-shrink: 0;
            backdrop-filter: blur(4px);
            transition: background .15s ease, border-color .15s ease, transform .15s ease;
        }

        .btn-secondary-ca i {
            font-size: 14px;
        }

        .btn-secondary-ca:hover,
        .btn-secondary-ca:focus {
            color: #ffffff;
            background: rgba(255, 255, 255, .25);
            border-color: rgba(255, 255, 255, .8);
            transform: translateY(-1px);
        }

        .role-tabs {
            margin-bottom: 16px;
            display: grid;
            grid-template-columns: repeat(5, minmax(0, 1fr));
            gap: 10px;
        }

        .role-tab {
            position: relative;
            min-height: 82px;
            padding: 13px 14px;
            border: 1px solid var(--ca-border);
            border-top: 3px solid #d7dfdf;
            border-radius: 11px;
            background: #ffffff;
            transition: border-color .15s ease, background .15s ease, transform .15s ease;
        }

        .role-tab:hover {
            border-color: #cfe4e1;
            background: #fbfdfd;
            transform: translateY(-1px);
        }

        .role-tab.active {
            border-top-color: var(--ca-primary);
            border-color: #b9deda;
            background: var(--ca-primary-soft);
        }

        .role-tab-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
        }

        .role-tab-icon {
            width: 30px;
            height: 30px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #667085;
            background: #f2f6f6;
            font-size: 13px;
        }

        .role-tab.active .role-tab-icon {
            color: var(--ca-primary-dark);
            background: #d8efec;
        }

        .role-tab-value {
            margin-top: 7px;
            color: var(--ca-text);
            font-size: 18px;
            font-weight: 740;
            line-height: 1;
        }

        .role-tab-label {
            margin-top: 4px;
            color: var(--ca-muted);
            font-size: 10px;
        }

        .panel {
            border: 1px solid var(--ca-border);
            border-top: 3px solid var(--ca-primary);
            border-radius: 12px;
            background: #ffffff;
            overflow: hidden;
        }

        .toolbar {
            padding: 15px 18px;
            border-bottom: 1px solid var(--ca-line);
            display: grid;
            grid-template-columns: minmax(260px, 1fr) 185px auto;
            gap: 10px;
            align-items: end;
            background: #ffffff;
        }

        .form-label {
            margin-bottom: 6px;
            color: #475467;
            font-size: 10.5px;
            font-weight: 650;
        }

        .form-control,
        .form-select {
            min-height: 40px;
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

        .toolbar-actions {
            display: flex;
            gap: 8px;
        }

        .btn-filter,
        .btn-reset {
            min-height: 40px;
            padding: 0 13px;
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
            background: var(--ca-primary-dark);
            border-color: var(--ca-primary-dark);
        }

        .btn-reset {
            border: 1px solid var(--ca-border);
            color: #667085;
            background: #ffffff;
        }

        .btn-reset:hover {
            color: var(--ca-primary-dark);
            background: var(--ca-primary-soft);
            border-color: #cfe4e1;
        }

        .table {
            margin-bottom: 0;
        }

        .table thead th {
            padding: 12px 16px;
            border-bottom: 1px solid #dfeceb;
            color: #546665;
            background: #f4faf9;
            font-size: 9.8px;
            font-weight: 720;
            text-transform: uppercase;
            letter-spacing: .04em;
            white-space: nowrap;
        }

        .table tbody td {
            padding: 14px 16px;
            border-color: var(--ca-line);
            color: #344054;
            background: #ffffff;
            font-size: 11.5px;
            vertical-align: middle;
        }

        .table tbody tr:hover td {
            background: #fbfdfd;
        }

        .user-cell {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-avatar {
            width: 34px;
            height: 34px;
            flex: 0 0 34px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: var(--ca-primary-dark);
            background: var(--ca-primary-soft);
            font-size: 10px;
            font-weight: 760;
        }

        .user-name {
            color: var(--ca-text);
            font-size: 11.5px;
            font-weight: 680;
        }

        .user-email {
            margin-top: 2px;
            color: var(--ca-muted-light);
            font-size: 10px;
        }

        .role-badge,
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 5px 8px;
            border-radius: 999px;
            font-size: 9.5px;
            font-weight: 690;
            white-space: nowrap;
        }

        .role-badge {
            color: #475467;
            background: #f2f5f5;
        }

        .status-badge.active {
            color: var(--ca-success);
            background: var(--ca-success-soft);
        }

        .status-badge.inactive {
            color: var(--ca-danger);
            background: var(--ca-danger-soft);
        }

        .meta-muted {
            color: var(--ca-muted-light);
            font-size: 10px;
        }

        .assignment-main {
            color: #344054;
            font-size: 11.5px;
            font-weight: 600;
        }

        .assignment-empty {
            color: var(--ca-warning);
            font-size: 10.5px;
            font-weight: 650;
        }

        .action-wrap {
            display: inline-flex;
            align-items: center;
            justify-content: flex-end;
            gap: 6px;
            flex-wrap: nowrap;
            white-space: nowrap;
        }

        /* Column Widths & Layout Tuning */
        .col-user {
            min-width: 200px;
        }

        .col-nis {
            min-width: 135px;
            white-space: nowrap !important;
        }

        .col-kelas {
            min-width: 145px;
            white-space: nowrap !important;
        }

        .col-status {
            min-width: 95px;
            white-space: nowrap !important;
        }

        .col-date {
            min-width: 110px;
            white-space: nowrap !important;
        }

        .col-action {
            min-width: 240px;
            white-space: nowrap !important;
            text-align: right;
        }

        .assignment-main {
            color: #1e293b;
            font-size: 12px;
            font-weight: 650;
            white-space: nowrap !important;
        }

        .assignment-empty {
            color: #b54708;
            background: #fffaeb;
            border: 1px solid #fedf89;
            padding: 2px 8px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 600;
            white-space: nowrap !important;
            display: inline-block;
        }

        /* Action Buttons: Unified, Compact & Crisp */
        .btn-detail-profile,
        .btn-reset-password,
        .btn-status {
            min-height: 29px !important;
            height: 29px !important;
            width: auto !important;
            padding: 0 10px !important;
            border-radius: 7px !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            gap: 4px !important;
            font-size: 11px !important;
            font-weight: 600 !important;
            white-space: nowrap !important;
            text-decoration: none !important;
            cursor: pointer !important;
            transition: all .15s ease !important;
            box-shadow: 0 1px 2px rgba(16, 24, 40, .05) !important;
            line-height: 1 !important;
        }

        /* Detail Profil Button - Modern Mint Accent */
        .btn-detail-profile {
            background: #ffffff !important;
            color: #0f8a83 !important;
            border: 1px solid #c2e2dd !important;
        }

        .btn-detail-profile:hover {
            background: #eaf6f4 !important;
            border-color: #0f8a83 !important;
            color: #0b6f69 !important;
            box-shadow: 0 2px 4px rgba(15, 138, 131, .15) !important;
            transform: translateY(-1px);
        }

        /* Reset Password Button - Modern Neutral Outline */
        .btn-reset-password {
            background: #ffffff !important;
            color: #344054 !important;
            border: 1px solid #d0d5dd !important;
        }

        .btn-reset-password:hover {
            background: #f8fafc !important;
            color: #101828 !important;
            border-color: #98a2b3 !important;
            box-shadow: 0 2px 4px rgba(0, 0, 0, .06) !important;
            transform: translateY(-1px);
        }

        /* Nonaktifkan Button - Muted Coral/Red Outline */
        .btn-status.deactivate {
            background: #ffffff !important;
            color: #b42318 !important;
            border: 1px solid #fecdca !important;
        }

        .btn-status.deactivate:hover {
            background: #fef3f2 !important;
            color: #912018 !important;
            border-color: #fda29b !important;
            box-shadow: 0 2px 4px rgba(217, 45, 32, .10) !important;
            transform: translateY(-1px);
        }

        /* Aktifkan Button - Soft Emerald Outline */
        .btn-status.activate {
            background: #ffffff !important;
            color: #027a48 !important;
            border: 1px solid #a6f4c5 !important;
        }

        .btn-status.activate:hover {
            background: #ecfdf3 !important;
            color: #05603a !important;
            border-color: #6ce9a6 !important;
            box-shadow: 0 2px 4px rgba(2, 122, 72, .10) !important;
            transform: translateY(-1px);
        }

        .btn-status:disabled {
            opacity: .6 !important;
            cursor: not-allowed !important;
            border-color: #e2e8f0 !important;
            background: #f8fafc !important;
            color: #94a3b8 !important;
            box-shadow: none !important;
            transform: none !important;
        }

        /* =====================================================
           PAGINATION STYLING (CLEAN, COMPACT & MODERN)
        ===================================================== */
        .pagination-wrap {
            padding: 13px 20px;
            border-top: 1px solid #edf1f1;
            background: #ffffff;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            flex-wrap: wrap;
            font-family: 'Inter', system-ui, -apple-system, sans-serif !important;
        }

        .pagination-info {
            color: #64748b;
            font-size: 12px;
            font-weight: 500;
            line-height: 1.4;
            font-family: 'Inter', system-ui, -apple-system, sans-serif !important;
        }

        .pagination-info .highlight {
            color: #1e293b;
            font-weight: 650;
        }

        .pagination-nav {
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .pagination-button,
        .pagination-page {
            min-width: 32px;
            height: 32px;
            padding: 0 10px;
            border: 1px solid #d0d5dd;
            border-radius: 7px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #344054;
            background: #ffffff;
            font-family: 'Inter', system-ui, -apple-system, sans-serif !important;
            font-size: 12px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            transition: all .15s ease;
            box-shadow: 0 1px 2px rgba(16, 24, 40, .05);
            line-height: 1;
            user-select: none;
        }

        .pagination-button:hover,
        .pagination-page:hover {
            color: var(--ca-primary, #0f8a83);
            border-color: #0f8a83;
            background: var(--ca-primary-soft, #eaf6f4);
            transform: translateY(-1px);
            box-shadow: 0 2px 4px rgba(15, 138, 131, .15);
        }

        .pagination-page.active {
            color: #ffffff !important;
            border-color: var(--ca-primary, #0f8a83) !important;
            background: var(--ca-primary, #0f8a83) !important;
            box-shadow: 0 2px 5px rgba(15, 138, 131, .25) !important;
            pointer-events: none;
            cursor: default;
        }

        .pagination-button.disabled {
            pointer-events: none;
            opacity: .4;
            cursor: not-allowed;
            border-color: #e4e7ec;
            background: #f8fafc;
            color: #98a2b3;
            box-shadow: none;
            transform: none;
        }

        .pagination-button i {
            font-size: 11px;
        }

        /* Profile Modal Styles */
        .profile-modal-dialog {
            max-width: 580px;
        }

        .profile-modal-content {
            border: none;
            border-radius: 16px;
            box-shadow: 0 20px 40px rgba(15, 138, 131, 0.12), 0 1px 3px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .profile-modal-header {
            padding: 20px 24px 16px;
            border-bottom: 1px solid var(--ca-line);
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #ffffff;
        }

        .profile-modal-title {
            font-size: 16px;
            font-weight: 750;
            color: var(--ca-text);
            display: flex;
            align-items: center;
            gap: 8px;
            margin: 0;
        }

        .profile-modal-body {
            padding: 22px 24px;
            background: #fafcfc;
        }

        .profile-hero-card {
            background: #ffffff;
            border: 1px solid var(--ca-border);
            border-radius: 12px;
            padding: 16px 18px;
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 18px;
        }

        .profile-hero-avatar {
            width: 54px;
            height: 54px;
            border-radius: 13px;
            background: var(--ca-primary);
            color: #ffffff;
            font-size: 19px;
            font-weight: 750;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .profile-hero-name {
            font-size: 16px;
            font-weight: 750;
            color: var(--ca-text);
            margin-bottom: 2px;
        }

        .profile-hero-email {
            font-size: 12px;
            color: var(--ca-muted);
            margin-bottom: 8px;
        }

        .profile-badges {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }

        .profile-info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
            margin-bottom: 18px;
        }

        .profile-info-box {
            background: #ffffff;
            border: 1px solid var(--ca-border);
            border-radius: 10px;
            padding: 12px 14px;
        }

        .profile-info-label {
            font-size: 10px;
            color: var(--ca-muted);
            font-weight: 650;
            text-transform: uppercase;
            letter-spacing: .04em;
            margin-bottom: 4px;
        }

        .profile-info-value {
            font-size: 13px;
            font-weight: 650;
            color: var(--ca-text);
            word-break: break-word;
        }

        .profile-note-box {
            background: #f6fbfa;
            border: 1px solid #d0ebe7;
            border-radius: 10px;
            padding: 12px 14px;
            font-size: 11.5px;
            color: #3b504d;
            display: flex;
            gap: 10px;
            align-items: flex-start;
            line-height: 1.5;
        }

        .profile-note-box i {
            color: var(--ca-primary);
            font-size: 16px;
            flex-shrink: 0;
            margin-top: 1px;
        }

        .profile-modal-footer {
            padding: 16px 24px;
            background: #ffffff;
            border-top: 1px solid var(--ca-line);
            display: flex;
            justify-content: space-between;
            align-items: center;
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
        }

        @media (max-width: 767.98px) {
            :root {
                --topbar-height: 74px;
            }

            .date-chip,
            .account-copy,
            .account-chevron {
                display: none;
            }

            .account-trigger {
                min-width: 0;
                width: 42px;
                height: 42px;
                padding: 3px;
            }

            .page-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .page-actions {
                width: 100%;
                justify-content: flex-start;
            }

            .btn-primary-ca {
                min-width: 0;
            }

            .role-tabs {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .toolbar {
                grid-template-columns: 1fr;
            }

            .toolbar-actions {
                grid-column: auto;
            }
        }

        @media (max-width: 575.98px) {
            .role-tabs {
                grid-template-columns: 1fr;
            }

            .btn-primary-ca {
                width: 100%;
            }

            .toolbar-actions {
                flex-direction: column;
            }

            .btn-filter,
            .btn-reset {
                width: 100%;
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

    $roleLabel = match ($role) {
        'student' => 'Siswa',
        'counselor' => 'Guru BK',
        'homeroom_teacher' => 'Wali Kelas',
        'admin' => 'Admin',
        default => 'Semua Pengguna',
    };

    $jumlahTotal = $ringkasan['total'] ?? 0;
    $jumlahSiswa = $ringkasan['student'] ?? $ringkasan['siswa'] ?? 0;
    $jumlahGuruBk = $ringkasan['counselor'] ?? $ringkasan['guru_bk'] ?? 0;
    $jumlahWaliKelas = $ringkasan['homeroom_teacher'] ?? $ringkasan['wali_kelas'] ?? 0;
    $jumlahAdmin = $ringkasan['admin'] ?? 0;
@endphp

<div class="app-shell">

    @include('admin.partials.sidebar')

    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <header class="topbar">

        <div class="topbar-left">

            <button type="button" class="mobile-sidebar-button" id="openSidebarButton" aria-label="Buka menu">
                <i class="bi bi-list"></i>
            </button>

            <div>
                <div class="topbar-title">
                Kelola Pengguna
            </div>

            <div class="topbar-subtitle">
                Administrasi akun dan hak akses CurhatAman
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
                title="Buka Profil Admin"
                aria-label="Buka Profil Admin"
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

                @if (session('success'))
                    <div class="flash-success">
                        <i class="bi bi-check-circle"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                @if (session('error'))
                    <div class="flash-error">
                        <i class="bi bi-exclamation-circle"></i>
                        <span>{{ session('error') }}</span>
                    </div>
                @endif

                <section class="page-header">

                    <div>

                        <div class="page-kicker">
                            Administrasi Akun
                        </div>

                        <h1 class="page-title">
                            {{ $roleLabel }}
                        </h1>

                        <p class="page-copy">
                            Pilih kategori pengguna untuk melihat informasi
                            yang relevan dengan masing-masing role.
                        </p>

                    </div>

                    <div class="page-actions" style="gap: 10px;">
                        <a
                            href="{{ route('admin.pengguna.import') }}"
                            class="btn-secondary-ca"
                        >
                            <i class="bi bi-file-earmark-spreadsheet"></i>
                            <span>Import Massal</span>
                        </a>

                        <a
                            href="{{ route('admin.pengguna.create') }}"
                            class="btn-primary-ca"
                        >
                            <i class="bi bi-person-plus"></i>
                            <span>Tambah Pengguna</span>
                        </a>
                    </div>

                </section>

                <section class="role-tabs">

                    <a
                        href="{{ route('admin.pengguna.index') }}"
                        class="role-tab {{ $role === '' ? 'active' : '' }}"
                    >
                        <div class="role-tab-top">
                            <span class="role-tab-icon">
                                <i class="bi bi-people"></i>
                            </span>
                        </div>

                        <div class="role-tab-value">
                            {{ $jumlahTotal }}
                        </div>

                        <div class="role-tab-label">
                            Semua Pengguna
                        </div>
                    </a>

                    <a
                        href="{{ route('admin.pengguna.index', ['role' => 'student']) }}"
                        class="role-tab {{ $role === 'student' ? 'active' : '' }}"
                    >
                        <div class="role-tab-top">
                            <span class="role-tab-icon">
                                <i class="bi bi-mortarboard"></i>
                            </span>
                        </div>

                        <div class="role-tab-value">
                            {{ $jumlahSiswa }}
                        </div>

                        <div class="role-tab-label">
                            Siswa
                        </div>
                    </a>

                    <a
                        href="{{ route('admin.pengguna.index', ['role' => 'counselor']) }}"
                        class="role-tab {{ $role === 'counselor' ? 'active' : '' }}"
                    >
                        <div class="role-tab-top">
                            <span class="role-tab-icon">
                                <i class="bi bi-person-heart"></i>
                            </span>
                        </div>

                        <div class="role-tab-value">
                            {{ $jumlahGuruBk }}
                        </div>

                        <div class="role-tab-label">
                            Guru BK
                        </div>
                    </a>

                    <a
                        href="{{ route('admin.pengguna.index', ['role' => 'homeroom_teacher']) }}"
                        class="role-tab {{ $role === 'homeroom_teacher' ? 'active' : '' }}"
                    >
                        <div class="role-tab-top">
                            <span class="role-tab-icon">
                                <i class="bi bi-person-workspace"></i>
                            </span>
                        </div>

                        <div class="role-tab-value">
                            {{ $jumlahWaliKelas }}
                        </div>

                        <div class="role-tab-label">
                            Wali Kelas
                        </div>
                    </a>

                    <a
                        href="{{ route('admin.pengguna.index', ['role' => 'admin']) }}"
                        class="role-tab {{ $role === 'admin' ? 'active' : '' }}"
                    >
                        <div class="role-tab-top">
                            <span class="role-tab-icon">
                                <i class="bi bi-shield-lock"></i>
                            </span>
                        </div>

                        <div class="role-tab-value">
                            {{ $jumlahAdmin }}
                        </div>

                        <div class="role-tab-label">
                            Admin
                        </div>
                    </a>

                </section>

                <section class="panel">

                    <form
                        method="GET"
                        action="{{ route('admin.pengguna.index') }}"
                        class="toolbar"
                    >

                        @if ($role !== '')
                            <input
                                type="hidden"
                                name="role"
                                value="{{ $role }}"
                            >
                        @endif

                        <div>

                            <label class="form-label">
                                Cari Pengguna
                            </label>

                            <input
                                type="text"
                                name="q"
                                value="{{ $q }}"
                                class="form-control"
                                placeholder="Nama, email, NISN, atau kelas"
                            >

                        </div>

                        <div>

                            <label class="form-label">
                                Status Akun
                            </label>

                            <select
                                name="status"
                                class="form-select"
                            >
                                <option value="">Semua Status</option>
                                <option value="aktif" @selected($status === 'aktif')>
                                    Aktif
                                </option>
                                <option value="nonaktif" @selected($status === 'nonaktif')>
                                    Nonaktif
                                </option>
                            </select>

                        </div>

                        <div class="toolbar-actions">

                            <button
                                type="submit"
                                class="btn-filter"
                            >
                                <i class="bi bi-search"></i>
                                Cari
                            </button>

                            <a
                                href="{{ route(
                                    'admin.pengguna.index',
                                    $role !== '' ? ['role' => $role] : []
                                ) }}"
                                class="btn-reset"
                            >
                                Reset
                            </a>

                        </div>

                    </form>

                    <div class="table-responsive">

                        <table class="table align-middle">

                            @if ($role === 'student')

                                <thead>
                                    <tr>
                                        <th class="col-user">Siswa</th>
                                        <th class="col-nis">NISN & Kontak</th>
                                        <th class="col-kelas">Kelas & Wali</th>
                                        <th class="col-status">Status</th>
                                        <th class="col-date">Terdaftar</th>
                                        <th class="col-action text-end pe-3">Aksi</th>
                                    </tr>
                                </thead>

                            @elseif ($role === 'counselor')

                                <thead>
                                    <tr>
                                        <th class="col-user">Guru BK</th>
                                        <th class="col-kelas">Kewenangan / Kasus</th>
                                        <th class="col-status">Status</th>
                                        <th class="col-date">Terdaftar</th>
                                        <th class="col-action text-end pe-3">Aksi</th>
                                    </tr>
                                </thead>

                            @elseif ($role === 'homeroom_teacher')

                                <thead>
                                    <tr>
                                        <th class="col-user">Wali Kelas</th>
                                        <th class="col-kelas">Kelas Diampu</th>
                                        <th class="col-nis">Tahun Ajaran</th>
                                        <th class="col-status">Status</th>
                                        <th class="col-date">Terdaftar</th>
                                        <th class="col-action text-end pe-3">Aksi</th>
                                    </tr>
                                </thead>

                            @elseif ($role === 'admin')

                                <thead>
                                    <tr>
                                        <th class="col-user">Admin</th>
                                        <th class="col-kelas">Hak Akses</th>
                                        <th class="col-status">Status</th>
                                        <th class="col-date">Terdaftar</th>
                                        <th class="col-action text-end pe-3">Aksi</th>
                                    </tr>
                                </thead>

                            @else

                                <thead>
                                    <tr>
                                        <th class="col-user">Pengguna</th>
                                        <th class="col-nis">Role</th>
                                        <th class="col-kelas">Identitas / Penugasan</th>
                                        <th class="col-status">Status</th>
                                        <th class="col-date">Terdaftar</th>
                                        <th class="col-action text-end pe-3">Aksi</th>
                                    </tr>
                                </thead>

                            @endif

                            <tbody>

                                @forelse ($pengguna as $item)

                                    @php
                                        $itemInitial = collect(
                                            explode(' ', trim($item->name))
                                        )
                                            ->filter()
                                            ->take(2)
                                            ->map(
                                                fn ($bagian) =>
                                                    mb_strtoupper(
                                                        mb_substr($bagian, 0, 1)
                                                    )
                                            )
                                            ->implode('');

                                        $itemRoleLabel = match ($item->role) {
                                            'student' => 'Siswa',
                                            'counselor' => 'Guru BK',
                                            'homeroom_teacher' => 'Wali Kelas',
                                            'admin' => 'Admin',
                                            default => ucfirst($item->role),
                                        };
                                    @endphp

                                    <tr>

                                        <td>

                                            <div class="user-cell">

                                                <span class="user-avatar">
                                                    {{ $itemInitial }}
                                                </span>

                                                <div>
                                                    <div class="user-name">
                                                        {{ $item->name }}
                                                    </div>

                                                    <div class="user-email">
                                                        @if ($item->role === 'student' && str_ends_with(strtolower((string) $item->email), '@siswa.curhataman.local'))
                                                            <span class="text-muted fst-italic">Email belum dilengkapi</span>
                                                        @else
                                                            {{ $item->email }}
                                                        @endif
                                                    </div>
                                                </div>

                                            </div>

                                        </td>

                                        @if ($role === 'student')

                                            <td class="col-nis text-nowrap">
                                                <div class="fw-semibold text-dark">{{ $item->nis ?? '-' }}</div>
                                                @if (!empty($item->whatsapp_number))
                                                    @php
                                                        $rawWaAdmin = preg_replace('/[^0-9]/', '', $item->whatsapp_number);
                                                        if (str_starts_with($rawWaAdmin, '0')) {
                                                            $waAdminNum = '62' . substr($rawWaAdmin, 1);
                                                        } else {
                                                            $waAdminNum = $rawWaAdmin;
                                                        }
                                                        $pesanWaAdmin = rawurlencode(
                                                            "Halo {$item->name}, ada pemberitahuan dari layanan Bimbingan & Konseling CurhatAman. Silakan cek akun CurhatAman kamu melalui tautan berikut:\n" . url('/') . "\n\natau hubungi Guru BK sekolah untuk informasi selengkapnya."
                                                        );
                                                    @endphp
                                                    <div class="mt-1 text-nowrap">
                                                        <a href="https://wa.me/{{ $waAdminNum }}?text={{ $pesanWaAdmin }}" target="_blank" rel="noopener" class="d-inline-flex align-items-center gap-1 text-decoration-none" style="color: #027a48; font-size: 11px; font-weight: 600;" title="Hubungi Siswa via WhatsApp">
                                                            <i class="bi bi-whatsapp"></i> {{ $item->whatsapp_number }}
                                                        </a>
                                                    </div>
                                                @endif
                                            </td>

                                            <td class="col-kelas text-nowrap">
                                                @if ($item->kelas_siswa)
                                                    <div class="assignment-main text-nowrap">
                                                        {{ $item->kelas_siswa }}
                                                    </div>
                                                    @if (!empty($item->nama_wali_kelas_siswa))
                                                        <div class="meta-muted text-nowrap mt-1" style="font-size: 11px; color: #64748b;">
                                                            <i class="bi bi-person-badge text-muted me-1"></i>Wali: <span class="fw-medium text-dark">{{ $item->nama_wali_kelas_siswa }}</span>
                                                        </div>
                                                    @endif
                                                @else
                                                    <span class="assignment-empty text-nowrap" style="font-size: 11px;">
                                                        Belum memiliki kelas
                                                    </span>
                                                @endif
                                            </td>

                                        @elseif ($role === 'counselor')

                                            <td>
                                                <span class="assignment-main">
                                                    {{ $item->total_kasus_aktif_bk ?? 0 }} Kasus Aktif
                                                </span>

                                                <div class="meta-muted">
                                                    Total {{ $item->total_kasus_bk ?? 0 }} kasus ditangani
                                                </div>
                                            </td>

                                        @elseif ($role === 'homeroom_teacher')

                                            <td>
                                                @if ($item->kelas_wali)
                                                    <span class="assignment-main">
                                                        {{ $item->kelas_wali }}
                                                    </span>
                                                    <div class="meta-muted">
                                                        {{ $item->total_siswa_wali ?? 0 }} Siswa Diampu
                                                    </div>
                                                @else
                                                    <span class="assignment-empty">
                                                        Belum ditugaskan
                                                    </span>
                                                @endif
                                            </td>

                                            <td>
                                                {{ $item->tahun_ajaran_wali ?? '-' }}
                                            </td>

                                        @elseif ($role === 'admin')

                                            <td>
                                                <span class="assignment-main">
                                                    Administrasi & pengawasan
                                                </span>

                                                <div class="meta-muted">
                                                    Portal Admin Sekolah
                                                </div>
                                            </td>

                                        @else

                                            <td>
                                                <span class="role-badge">
                                                    {{ $itemRoleLabel }}
                                                </span>
                                            </td>

                                            <td>

                                                @if ($item->role === 'student')

                                                    <div>
                                                        NISN: {{ $item->nis ?? '-' }}
                                                    </div>

                                                    <div class="meta-muted">
                                                        {{ $item->kelas_siswa ?? 'Belum memiliki kelas' }}
                                                    </div>

                                                @elseif ($item->role === 'homeroom_teacher')

                                                    <div>
                                                        {{ $item->kelas_wali ?? 'Belum ditugaskan' }}
                                                    </div>

                                                    <div class="meta-muted">
                                                        {{ $item->tahun_ajaran_wali ?? '-' }}
                                                    </div>

                                                @elseif ($item->role === 'counselor')

                                                    <div>
                                                        Guru BK
                                                    </div>

                                                    <div class="meta-muted">
                                                        Akses penanganan kasus
                                                    </div>

                                                @else

                                                    <div>
                                                        Administrator Sistem
                                                    </div>

                                                    <div class="meta-muted">
                                                        Akses administrasi
                                                    </div>

                                                @endif

                                            </td>

                                        @endif

                                        <td>

                                            @if ($item->is_active)

                                                <span class="status-badge active">
                                                    <i class="bi bi-check-circle"></i>
                                                    Aktif
                                                </span>

                                            @else

                                                <span class="status-badge inactive">
                                                    <i class="bi bi-x-circle"></i>
                                                    Nonaktif
                                                </span>

                                            @endif

                                        </td>

                                        <td>
                                            <span class="meta-muted">
                                                {{ \Carbon\Carbon::parse($item->created_at)
                                                    ->locale('id')
                                                    ->translatedFormat('d M Y') }}
                                            </span>
                                        </td>

                                        <td class="col-action text-end text-nowrap pe-3">
                                            <div class="action-wrap justify-content-end">

                                                <button
                                                    type="button"
                                                    class="btn-detail-profile"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#userProfileModal"
                                                    data-user-id="{{ $item->id }}"
                                                    data-name="{{ $item->name }}"
                                                    data-email="{{ ($item->role === 'student' && str_ends_with(strtolower((string) $item->email), '@siswa.curhataman.local')) ? 'Email belum dilengkapi oleh siswa' : $item->email }}"
                                                    data-role="{{ $item->role }}"
                                                    data-role-label="{{ $itemRoleLabel }}"
                                                    data-is-active="{{ $item->is_active ? '1' : '0' }}"
                                                    data-initial="{{ $itemInitial }}"
                                                    data-created-at="{{ \Carbon\Carbon::parse($item->created_at)->locale('id')->translatedFormat('d F Y, H:i') }}"
                                                    data-nis="{{ $item->nis ?? '-' }}"
                                                    data-tahun-masuk="{{ $item->tahun_masuk ?? '-' }}"
                                                    data-whatsapp="{{ $item->whatsapp_number ?? '' }}"
                                                    data-kelas="{{ $item->kelas_siswa ?? '' }}"
                                                    data-tingkat="{{ $item->tingkat_siswa ?? '' }}"
                                                    data-tahun-ajaran="{{ $item->tahun_ajaran_siswa ?? '' }}"
                                                    data-wali-kelas="{{ $item->nama_wali_kelas_siswa ?? '' }}"
                                                    data-kelas-wali="{{ $item->kelas_wali ?? '' }}"
                                                    data-tingkat-wali="{{ $item->tingkat_wali ?? '' }}"
                                                    data-tahun-ajaran-wali="{{ $item->tahun_ajaran_wali ?? '' }}"
                                                    data-total-siswa-wali="{{ $item->total_siswa_wali ?? '0' }}"
                                                    data-total-kasus-bk="{{ $item->total_kasus_bk ?? '0' }}"
                                                    data-total-kasus-aktif-bk="{{ $item->total_kasus_aktif_bk ?? '0' }}"
                                                    data-reset-url="{{ route('admin.pengguna.reset-password.form', $item->id) }}"
                                                    title="Lihat Detail Profil Lengkap"
                                                >
                                                    <i class="bi bi-person-lines-fill"></i> Detail
                                                </button>

                                                @if ($item->id === auth()->id())

                                                    <button
                                                        type="button"
                                                        class="btn-status"
                                                        disabled
                                                        title="Akun yang sedang digunakan"
                                                    >
                                                        <i class="bi bi-shield-lock"></i>
                                                        Akun Saya
                                                    </button>

                                                @else

                                                    @if ($item->role === 'student')
                                                        <button
                                                            type="button"
                                                            class="btn-reset-password"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#ubahKelasSiswaModal"
                                                            data-user-id="{{ $item->id }}"
                                                            data-user-name="{{ $item->name }}"
                                                            data-nis="{{ $item->nis ?? '-' }}"
                                                            data-current-kelas="{{ $item->kelas_siswa ? ($item->kelas_siswa . ($item->tahun_ajaran_siswa ? ' · ' . $item->tahun_ajaran_siswa : '')) : 'Belum ada kelas' }}"
                                                            data-current-kelas-id="{{ $item->kelas_siswa_id ?? '' }}"
                                                            data-action-url="{{ route('admin.pengguna.update-kelas', $item->id) }}"
                                                            title="Ubah / Naik Kelas Siswa"
                                                        >
                                                            <i class="bi bi-arrow-up-right-circle"></i> Naik / Ubah Kelas
                                                        </button>
                                                    @endif

                                                    @if (in_array($item->role, ['counselor', 'homeroom_teacher'], true))

                                                        <a
                                                            href="{{ route(
                                                                'admin.pengguna.reset-password.form',
                                                                $item->id
                                                            ) }}"
                                                            class="btn-reset-password"
                                                            title="Atur ulang password akun"
                                                        >
                                                            <i class="bi bi-key"></i> Reset
                                                        </a>

                                                    @endif

                                                    <form
                                                        method="POST"
                                                        action="{{ route(
                                                            'admin.pengguna.toggle-status',
                                                            $item->id
                                                        ) }}"
                                                        class="m-0"
                                                        onsubmit="return confirm('{{ $item->is_active ? 'Nonaktifkan akun ini?' : 'Aktifkan kembali akun ini?' }}')"
                                                    >
                                                        @csrf
                                                        @method('PATCH')

                                                        <input
                                                            type="hidden"
                                                            name="current_role"
                                                            value="{{ $role }}"
                                                        >

                                                        <button
                                                            type="submit"
                                                            class="btn-status {{ $item->is_active ? 'deactivate' : 'activate' }}"
                                                        >
                                                            <i class="bi {{ $item->is_active ? 'bi-pause-circle' : 'bi-play-circle' }}"></i>

                                                            {{ $item->is_active
                                                                ? 'Nonaktifkan'
                                                                : 'Aktifkan' }}
                                                        </button>

                                                    </form>

                                                @endif

                                            </div>

                                        </td>

                                    </tr>

                                @empty

                                    <tr>
                                        <td
                                            colspan="6"
                                            class="text-center"
                                        >
                                            <div class="empty-state">
                                                Tidak ada pengguna pada kategori ini.
                                            </div>
                                        </td>
                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                    @if ($pengguna->total() > 0)
                        @php
                            $currentPage = $pengguna->currentPage();
                            $lastPage = $pengguna->lastPage();
                            
                            // Tampilkan maksimal 2 nomor halaman sesuai permintaan user
                            if ($currentPage <= 2) {
                                $startPage = 1;
                                $endPage = min($lastPage, 2);
                            } else {
                                $startPage = $currentPage - 1;
                                $endPage = $currentPage;
                            }
                        @endphp
                        <div class="pagination-wrap">
                            <div class="pagination-info">
                                Menampilkan <span class="highlight">{{ $pengguna->firstItem() ?? 1 }}</span>–<span class="highlight">{{ $pengguna->lastItem() ?? $pengguna->count() }}</span> dari <span class="highlight">{{ $pengguna->total() }}</span> pengguna
                            </div>

                            @if ($pengguna->hasPages())
                                <div class="pagination-nav">
                                    {{-- Tombol Halaman Sebelumnya (<) --}}
                                    <a
                                        href="{{ $pengguna->previousPageUrl() ?: '#' }}"
                                        class="pagination-button {{ $pengguna->onFirstPage() ? 'disabled' : '' }}"
                                        aria-label="Halaman sebelumnya"
                                        title="Halaman sebelumnya"
                                        @if ($pengguna->onFirstPage()) aria-disabled="true" tabindex="-1" @endif
                                    >
                                        <i class="bi bi-chevron-left"></i>
                                    </a>

                                    {{-- Nomor Halaman (Hanya Maksimal 2 Angka Saja) --}}
                                    @for ($page = $startPage; $page <= $endPage; $page++)
                                        <a
                                            href="{{ $pengguna->url($page) }}"
                                            class="pagination-page {{ $page === $currentPage ? 'active' : '' }}"
                                            title="Halaman {{ $page }}"
                                        >
                                            {{ $page }}
                                        </a>
                                    @endfor

                                    {{-- Tombol Halaman Berikutnya (>) --}}
                                    <a
                                        href="{{ $pengguna->nextPageUrl() ?: '#' }}"
                                        class="pagination-button {{ $pengguna->hasMorePages() ? '' : 'disabled' }}"
                                        aria-label="Halaman berikutnya"
                                        title="Halaman berikutnya"
                                        @if (! $pengguna->hasMorePages()) aria-disabled="true" tabindex="-1" @endif
                                    >
                                        <i class="bi bi-chevron-right"></i>
                                    </a>
                                </div>
                            @endif
                        </div>
                    @endif

                </section>

                <footer class="page-footer">
                    <div class="d-flex flex-column flex-md-row justify-content-between gap-2 w-100">
                        <span>© {{ date('Y') }} CurhatAman</span>
                        <span>Portal Admin Sekolah · Manajemen pengguna</span>
                    </div>
                </footer>

            </div>

        </div>

    </main>

</div>

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


{{-- =====================================================
     MODAL DETAIL PROFIL PENGGUNA
===================================================== --}}
<div class="modal fade" id="userProfileModal" tabindex="-1" aria-labelledby="userProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered profile-modal-dialog">
        <div class="modal-content profile-modal-content">
            <div class="profile-modal-header">
                <h5 class="profile-modal-title" id="userProfileModalLabel">
                    <i class="bi bi-person-badge text-primary"></i>
                    <span>Detail Profil Pengguna</span>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="profile-modal-body">
                {{-- Hero Card: Avatar, Name, Email, Role, Status --}}
                <div class="profile-hero-card">
                    <div class="profile-hero-avatar" id="modalUserInitial">
                        AF
                    </div>
                    <div class="flex-grow-1 overflow-hidden">
                        <div class="profile-hero-name" id="modalUserName">Nama Pengguna</div>
                        <div class="profile-hero-email text-truncate" id="modalUserEmail">email@sekolah.sch.id</div>
                        <div class="profile-badges">
                            <span class="badge" id="modalUserRoleBadge" style="background: #eaf6f4; color: #0b6f69; font-weight: 650; font-size: 11px;">Siswa</span>
                            <span class="badge" id="modalUserStatusBadge" style="background: #ecf8f2; color: #027a48; font-weight: 650; font-size: 11px;">Aktif</span>
                        </div>
                    </div>
                </div>

                {{-- Dynamic Role Sections --}}
                {{-- 1. SISWA SECTION --}}
                <div id="modalSiswaSection" class="profile-dynamic-section d-none">
                    <div class="profile-info-grid">
                        <div class="profile-info-box">
                            <div class="profile-info-label">Nomor Induk Siswa Nasional (NISN)</div>
                            <div class="profile-info-value" id="modalSiswaNis">-</div>
                        </div>
                        <div class="profile-info-box">
                            <div class="profile-info-label">Kelas Saat Ini</div>
                            <div class="profile-info-value" id="modalSiswaKelas">-</div>
                        </div>
                        <div class="profile-info-box">
                            <div class="profile-info-label">Tahun Masuk / Angkatan</div>
                            <div class="profile-info-value" id="modalSiswaTahunMasuk">-</div>
                        </div>
                        <div class="profile-info-box">
                            <div class="profile-info-label">Wali Kelas Pendamping</div>
                            <div class="profile-info-value" id="modalSiswaWaliKelas">-</div>
                        </div>
                        <div class="profile-info-box" style="grid-column: span 2;">
                            <div class="profile-info-label">Nomor WhatsApp Resmi</div>
                            <div class="profile-info-value d-flex align-items-center justify-content-between flex-wrap gap-2">
                                <span id="modalSiswaWhatsapp">-</span>
                                <a href="#" id="modalSiswaWaLink" target="_blank" rel="noopener" class="btn btn-sm btn-outline-success py-1 px-2 d-none" style="font-size: 11px; font-weight: 600;">
                                    <i class="bi bi-whatsapp me-1"></i> Hubungi WhatsApp
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- 2. GURU BK SECTION --}}
                <div id="modalBkSection" class="profile-dynamic-section d-none">
                    <div class="profile-info-grid">
                        <div class="profile-info-box">
                            <div class="profile-info-label">Peran & Tanggung Jawab</div>
                            <div class="profile-info-value">Guru Bimbingan & Konseling</div>
                        </div>
                        <div class="profile-info-box">
                            <div class="profile-info-label">Akses Sistem</div>
                            <div class="profile-info-value text-success">Penanganan Kasus & Skrining</div>
                        </div>
                        <div class="profile-info-box">
                            <div class="profile-info-label">Kasus Aktif Berjalan</div>
                            <div class="profile-info-value" id="modalBkKasusAktif">0 Kasus</div>
                        </div>
                        <div class="profile-info-box">
                            <div class="profile-info-label">Total Riwayat Kasus</div>
                            <div class="profile-info-value" id="modalBkKasusTotal">0 Kasus</div>
                        </div>
                    </div>
                </div>

                {{-- 3. WALI KELAS SECTION --}}
                <div id="modalWaliSection" class="profile-dynamic-section d-none">
                    <div class="profile-info-grid">
                        <div class="profile-info-box">
                            <div class="profile-info-label">Kelas yang Diampu</div>
                            <div class="profile-info-value" id="modalWaliKelas">-</div>
                        </div>
                        <div class="profile-info-box">
                            <div class="profile-info-label">Tahun Ajaran</div>
                            <div class="profile-info-value" id="modalWaliTahunAjaran">-</div>
                        </div>
                        <div class="profile-info-box" style="grid-column: span 2;">
                            <div class="profile-info-label">Jumlah Siswa di Kelas</div>
                            <div class="profile-info-value" id="modalWaliTotalSiswa">0 Siswa</div>
                        </div>
                    </div>
                </div>

                {{-- 4. ADMIN SECTION --}}
                <div id="modalAdminSection" class="profile-dynamic-section d-none">
                    <div class="profile-info-grid">
                        <div class="profile-info-box">
                            <div class="profile-info-label">Tingkat Hak Akses</div>
                            <div class="profile-info-value">Wakil Kesiswaan / Administrator</div>
                        </div>
                        <div class="profile-info-box">
                            <div class="profile-info-label">Cakupan Pengawasan</div>
                            <div class="profile-info-value">Penuh (Seluruh Sivitas Sekolah)</div>
                        </div>
                    </div>
                </div>

                {{-- General Info: Tanggal Terdaftar --}}
                <div class="profile-info-box mb-3">
                    <div class="profile-info-label">Waktu Akun Dibuat / Terdaftar</div>
                    <div class="profile-info-value" id="modalUserCreatedAt" style="font-size: 12px; font-weight: 500; color: #475467;">-</div>
                </div>

                {{-- Security & Privacy Note Box --}}
                <div class="profile-note-box">
                    <i class="bi bi-shield-lock-fill"></i>
                    <div>
                        <strong>Privasi & Keamanan Kredensial:</strong>
                        Kata sandi akun dienkripsi satu arah dengan algoritma <em>Bcrypt</em> (tidak dapat dilihat oleh siapapun). Riwayat curhat dan konseling siswa dilindungi kode etik dan hanya diakses melalui kewenangan resmi.
                    </div>
                </div>
            </div>

            <div class="profile-modal-footer">
                <button type="button" class="btn btn-secondary px-3" data-bs-dismiss="modal" style="font-size: 12px; font-weight: 600; border-radius: 8px;">
                    Tutup
                </button>
                <a href="#" id="modalResetPasswordBtn" class="btn btn-primary px-3" style="font-size: 12px; font-weight: 600; border-radius: 8px;">
                    <i class="bi bi-key me-1"></i> Reset Password Akun
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    // Profile Modal Dynamic Population
    const userProfileModal = document.getElementById('userProfileModal');
    if (userProfileModal) {
        userProfileModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            if (!button) return;

            const name = button.getAttribute('data-name') || '-';
            const email = button.getAttribute('data-email') || '-';
            const role = button.getAttribute('data-role') || '';
            const roleLabel = button.getAttribute('data-role-label') || '';
            const isActive = button.getAttribute('data-is-active') === '1';
            const initial = button.getAttribute('data-initial') || '';
            const createdAt = button.getAttribute('data-created-at') || '-';
            const nis = button.getAttribute('data-nis') || '-';
            const tahunMasuk = button.getAttribute('data-tahun-masuk') || '-';
            const whatsapp = button.getAttribute('data-whatsapp') || '';
            const kelas = button.getAttribute('data-kelas') || '';
            const tahunAjaran = button.getAttribute('data-tahun-ajaran') || '';
            const waliKelas = button.getAttribute('data-wali-kelas') || '';
            const kelasWali = button.getAttribute('data-kelas-wali') || '';
            const tahunAjaranWali = button.getAttribute('data-tahun-ajaran-wali') || '';
            const totalSiswaWali = button.getAttribute('data-total-siswa-wali') || '0';
            const totalKasusBk = button.getAttribute('data-total-kasus-bk') || '0';
            const totalKasusAktifBk = button.getAttribute('data-total-kasus-aktif-bk') || '0';
            const resetUrl = button.getAttribute('data-reset-url') || '#';

            // Set Header
            document.getElementById('modalUserInitial').textContent = initial;
            document.getElementById('modalUserName').textContent = name;
            document.getElementById('modalUserEmail').textContent = email;
            document.getElementById('modalUserCreatedAt').textContent = createdAt;

            // Role Badge
            const roleBadge = document.getElementById('modalUserRoleBadge');
            roleBadge.textContent = roleLabel;

            // Status Badge
            const statusBadge = document.getElementById('modalUserStatusBadge');
            if (isActive) {
                statusBadge.textContent = 'Aktif';
                statusBadge.style.background = '#ecf8f2';
                statusBadge.style.color = '#027a48';
            } else {
                statusBadge.textContent = 'Nonaktif';
                statusBadge.style.background = '#fff1f0';
                statusBadge.style.color = '#b42318';
            }

            // Hide all dynamic sections first
            document.querySelectorAll('.profile-dynamic-section').forEach(el => el.classList.add('d-none'));

            // Show relevant section
            if (role === 'student') {
                document.getElementById('modalSiswaSection').classList.remove('d-none');
                document.getElementById('modalSiswaNis').textContent = nis;
                document.getElementById('modalSiswaKelas').textContent = kelas ? (kelas + (tahunAjaran ? ' (' + tahunAjaran + ')' : '')) : 'Belum Ditentukan';
                document.getElementById('modalSiswaTahunMasuk').textContent = tahunMasuk;
                document.getElementById('modalSiswaWaliKelas').textContent = waliKelas || 'Belum Ada';

                const waSpan = document.getElementById('modalSiswaWhatsapp');
                const waLink = document.getElementById('modalSiswaWaLink');
                if (whatsapp) {
                    waSpan.textContent = whatsapp;
                    let cleanWa = whatsapp.replace(/\D/g, '');
                    if (cleanWa.startsWith('0')) cleanWa = '62' + cleanWa.substring(1);
                    const waMsg = encodeURIComponent(
                        'Halo ' + (name || 'Siswa') + ', ada pemberitahuan dari layanan Bimbingan & Konseling CurhatAman. Silakan cek akun CurhatAman kamu melalui tautan berikut:\n' + window.location.origin + '\n\natau hubungi Guru BK sekolah untuk informasi selengkapnya.'
                    );
                    waLink.href = 'https://wa.me/' + cleanWa + '?text=' + waMsg;
                    waLink.classList.remove('d-none');
                } else {
                    waSpan.textContent = 'Belum dicantumkan';
                    waLink.classList.add('d-none');
                }
            } else if (role === 'counselor') {
                document.getElementById('modalBkSection').classList.remove('d-none');
                document.getElementById('modalBkKasusAktif').textContent = totalKasusAktifBk + ' Kasus Aktif';
                document.getElementById('modalBkKasusTotal').textContent = totalKasusBk + ' Total Kasus';
            } else if (role === 'homeroom_teacher') {
                document.getElementById('modalWaliSection').classList.remove('d-none');
                document.getElementById('modalWaliKelas').textContent = kelasWali || 'Belum Ditugaskan';
                document.getElementById('modalWaliTahunAjaran').textContent = tahunAjaranWali || '-';
                document.getElementById('modalWaliTotalSiswa').textContent = totalSiswaWali + ' Siswa Aktif';
            } else if (role === 'admin') {
                document.getElementById('modalAdminSection').classList.remove('d-none');
            }

            // Set Reset Password Button (Hanya untuk Guru BK & Wali Kelas)
            const resetBtn = document.getElementById('modalResetPasswordBtn');
            if (role === 'counselor' || role === 'homeroom_teacher') {
                resetBtn.href = resetUrl;
                resetBtn.classList.remove('d-none');
            } else {
                resetBtn.href = '#';
                resetBtn.classList.add('d-none');
            }
        });
    }
</script>

{{-- =====================================================
     MODAL UBAH / NAIK KELAS SISWA
===================================================== --}}
<div class="modal fade" id="ubahKelasSiswaModal" tabindex="-1" aria-labelledby="ubahKelasSiswaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form method="POST" id="ubahKelasSiswaForm" action="#" class="modal-content profile-modal-content">
            @csrf
            @method('PATCH')
            <input type="hidden" name="current_role" value="{{ $role }}">

            <div class="profile-modal-header">
                <h5 class="profile-modal-title" id="ubahKelasSiswaModalLabel">
                    <i class="bi bi-arrow-up-right-circle text-primary"></i>
                    <span>Ubah / Naik Kelas Siswa</span>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="profile-modal-body">
                <div class="profile-info-grid mb-3">
                    <div class="profile-info-box">
                        <div class="profile-info-label">Nama Siswa</div>
                        <div class="profile-info-value" id="ubahKelasNamaSiswa">-</div>
                    </div>
                    <div class="profile-info-box">
                        <div class="profile-info-label">NISN</div>
                        <div class="profile-info-value" id="ubahKelasNisSiswa">-</div>
                    </div>
                    <div class="profile-info-box" style="grid-column: span 2;">
                        <div class="profile-info-label">Kelas Saat Ini</div>
                        <div class="profile-info-value" id="ubahKelasSaatIni">-</div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="kelas_baru_id" class="form-label fw-semibold" style="font-size: 13px;">Pilih Kelas Baru (Tahun Ajaran Aktif)</label>
                    <select name="kelas_baru_id" id="kelas_baru_id" class="form-select" required style="border-radius: 10px; font-size: 13px;">
                        <option value="">-- Pilih Kelas Tujuan --</option>
                        @foreach ($daftarKelasAktif ?? [] as $kls)
                            <option value="{{ $kls->id }}">
                                {{ $kls->nama_kelas }} · {{ $kls->tahun_ajaran }} (Tingkat {{ $kls->tingkat }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="profile-note-box">
                    <i class="bi bi-archive-fill"></i>
                    <div>
                        <strong>Arsip Tahun Ajaran Otomatis:</strong>
                        Saat kelas siswa diperbarui, kelas sebelumnya otomatis disimpan ke dalam <em>Riwayat Kelas Siswa</em>. Guru BK tetap dapat mencari arsip siswa ini pada tahun ajaran sebelumnya di menu Data Siswa.
                    </div>
                </div>
            </div>

            <div class="profile-modal-footer">
                <button type="button" class="btn btn-secondary px-3" data-bs-dismiss="modal" style="font-size: 12px; font-weight: 600; border-radius: 8px;">
                    Batal
                </button>
                <button type="submit" class="btn btn-primary px-3" style="font-size: 12px; font-weight: 600; border-radius: 8px; background: #0f8a83; border-color: #0f8a83;">
                    <i class="bi bi-check2-circle me-1"></i> Simpan Kelas Baru
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    const ubahKelasSiswaModal = document.getElementById('ubahKelasSiswaModal');
    if (ubahKelasSiswaModal) {
        ubahKelasSiswaModal.addEventListener('show.bs.modal', function (event) {
            const btn = event.relatedTarget;
            if (!btn) return;

            const actionUrl = btn.getAttribute('data-action-url') || '#';
            const userName = btn.getAttribute('data-user-name') || '-';
            const nis = btn.getAttribute('data-nis') || '-';
            const currentKelas = btn.getAttribute('data-current-kelas') || 'Belum ada kelas';
            const currentKelasId = btn.getAttribute('data-current-kelas-id') || '';

            document.getElementById('ubahKelasSiswaForm').setAttribute('action', actionUrl);
            document.getElementById('ubahKelasNamaSiswa').textContent = userName;
            document.getElementById('ubahKelasNisSiswa').textContent = nis;
            document.getElementById('ubahKelasSaatIni').textContent = currentKelas;

            const selectKelas = document.getElementById('kelas_baru_id');
            if (selectKelas) {
                selectKelas.value = currentKelasId;
            }
        });
    }
</script>
</body>
</html>
