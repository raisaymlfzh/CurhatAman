<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;760;800&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

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
        --ca-info: #0284c7;
        --ca-info-soft: #e0f2fe;
        --sidebar-width: 272px !important;
        --topbar-height: 82px;
    }

    * {
        box-sizing: border-box;
    }

    body {
        min-height: 100vh;
        margin: 0;
        color: var(--ca-text);
        background: var(--ca-bg);
        font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif !important;
        font-size: 14px !important;
        line-height: 1.5;
    }

    button, input, select, textarea {
        font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif !important;
    }

    /* Icon Standardization */
    i.bi {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        vertical-align: -0.125em;
    }

    /* Standardized Typography Across Admin */
    .topbar-title {
        font-size: 18px !important;
        font-weight: 760 !important;
        letter-spacing: -.015em !important;
        color: var(--ca-text) !important;
        line-height: 1.2 !important;
    }

    .topbar-subtitle {
        margin-top: 3px;
        color: var(--ca-muted) !important;
        font-size: 12px !important;
    }

    .page-kicker, .banner-kicker {
        font-size: 10.5px !important;
        font-weight: 760 !important;
        letter-spacing: .08em !important;
        text-transform: uppercase !important;
        margin-bottom: 5px;
    }

    .page-title {
        font-size: 26px !important;
        font-weight: 760 !important;
        letter-spacing: -.02em !important;
        line-height: 1.25 !important;
        color: var(--ca-text);
    }

    .page-copy, .page-subtitle {
        font-size: 12.5px !important;
        color: var(--ca-muted);
        line-height: 1.6 !important;
    }

    /* Standard Admin Signature Banner */
    .page-header {
        margin-bottom: 22px;
        padding: 21px 22px;
        border-radius: 12px;
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        gap: 20px;
        background: var(--ca-primary) !important;
    }

    .page-header .page-kicker {
        color: rgba(255, 255, 255, .72) !important;
        margin-bottom: 6px;
    }

    .page-header .page-title {
        color: #ffffff !important;
        margin: 0;
    }

    .page-header .page-copy {
        max-width: 760px;
        margin: 7px 0 0;
        color: rgba(255, 255, 255, .82) !important;
        font-size: 12.5px !important;
        line-height: 1.65 !important;
    }

    .page-header .btn-primary-ca {
        min-height: 36px !important;
        height: 36px !important;
        padding: 0 13px !important;
        border: 1px solid rgba(255, 255, 255, .85) !important;
        border-radius: 8px !important;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px !important;
        color: var(--ca-primary-dark) !important;
        background: #ffffff !important;
        font-size: 11.5px !important;
        font-weight: 660 !important;
        white-space: nowrap;
        box-shadow: 0 1px 2px rgba(0, 0, 0, .06);
        transition: background .15s ease, transform .15s ease;
    }

    .page-header .btn-primary-ca:hover {
        background: #f2faf8 !important;
        color: var(--ca-primary-dark) !important;
        transform: translateY(-1px);
    }

    .page-header .btn-secondary-ca {
        min-height: 36px !important;
        height: 36px !important;
        padding: 0 12px !important;
        border: 1px solid rgba(255, 255, 255, .45) !important;
        border-radius: 8px !important;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px !important;
        color: #ffffff !important;
        background: rgba(255, 255, 255, .14) !important;
        font-size: 11.5px !important;
        font-weight: 640 !important;
        white-space: nowrap;
        backdrop-filter: blur(4px);
        transition: background .15s ease, border-color .15s ease, transform .15s ease;
    }

    .page-header .btn-secondary-ca:hover {
        background: rgba(255, 255, 255, .24) !important;
        border-color: rgba(255, 255, 255, .8) !important;
        color: #ffffff !important;
        transform: translateY(-1px);
    }

    .page-header .scope-badge,
    .scope-badge,
    .privacy-badge {
        min-height: 36px;
        padding: 0 12px;
        border: 1px solid rgba(255, 255, 255, .42) !important;
        border-radius: 999px !important;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #ffffff !important;
        background: rgba(255, 255, 255, .12) !important;
        font-size: 10.5px !important;
        font-weight: 680 !important;
        white-space: nowrap;
        flex-shrink: 0;
    }

    .panel-title, .card-title {
        font-size: 15px !important;
        font-weight: 720 !important;
        color: var(--ca-text) !important;
        letter-spacing: -.01em !important;
    }

    .panel-subtitle, .card-subtitle {
        font-size: 12px !important;
        color: var(--ca-muted) !important;
    }

    /* Standard Summary Cards */
    .summary-card {
        position: relative;
        height: 100%;
        min-height: 94px;
        padding: 15px 16px;
        border: 1px solid var(--ca-border) !important;
        border-top: 3px solid #d5dddd !important;
        border-radius: 11px !important;
        background: #ffffff !important;
    }

    .summary-card.total { border-top-color: var(--ca-primary) !important; }
    .summary-card.active { border-top-color: #35a36f !important; }
    .summary-card.unassigned, .summary-card.warning { border-top-color: #e6a33b !important; }
    .summary-card.students, .summary-card.info { border-top-color: #4f8fb8 !important; }
    .summary-card.danger { border-top-color: var(--ca-danger) !important; }

    .summary-card .summary-label,
    .summary-label {
        color: var(--ca-muted) !important;
        font-size: 10.5px !important;
        font-weight: 650 !important;
        text-transform: uppercase !important;
        letter-spacing: .04em !important;
    }

    .summary-card .summary-value {
        margin-top: 5px !important;
        color: var(--ca-text) !important;
        font-size: 22px !important;
        font-weight: 740 !important;
        line-height: 1.2 !important;
    }

    .stat-value {
        font-size: 24px !important;
        font-weight: 760 !important;
        color: var(--ca-text) !important;
        line-height: 1.2 !important;
    }

    .stat-label {
        margin-top: 4px;
        font-size: 12px !important;
        font-weight: 550 !important;
        color: var(--ca-muted) !important;
    }

    .form-label {
        font-size: 11px !important;
        font-weight: 650 !important;
        color: #475467 !important;
        margin-bottom: 6px;
    }

    .form-control, .form-select {
        min-height: 40px;
        font-size: 12.5px !important;
        border-radius: 9px !important;
        border: 1px solid var(--ca-border) !important;
        color: var(--ca-text);
    }

    .form-control:focus, .form-select:focus {
        border-color: rgba(15, 138, 131, .6) !important;
        box-shadow: 0 0 0 3px rgba(15, 138, 131, .1) !important;
    }

    /* Standardized Tables */
    .table thead th, table thead th {
        font-size: 10px !important;
        font-weight: 720 !important;
        letter-spacing: .04em !important;
        text-transform: uppercase !important;
        color: #546665 !important;
        background: #f4faf9 !important;
        padding: 12px 16px !important;
        border-bottom: 1px solid #dfeceb !important;
        white-space: nowrap;
    }

    .table tbody td, table tbody td {
        font-size: 12px !important;
        vertical-align: middle;
        padding: 14px 16px !important;
        border-color: var(--ca-line);
        color: #344054;
    }

    .table tbody tr:hover td {
        background: #fbfdfd;
    }

    /* Standardized Buttons */
    .btn-add-primary {
        height: 40px;
        padding: 0 16px;
        border-radius: 9px !important;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        color: #ffffff !important;
        background: var(--ca-primary) !important;
        border: 1px solid var(--ca-primary) !important;
        font-size: 12.5px !important;
        font-weight: 650 !important;
        cursor: pointer;
        box-shadow: 0 1px 3px rgba(15, 138, 131, 0.22);
        transition: all .15s ease;
        text-decoration: none;
    }

    .btn-add-primary:hover {
        background: var(--ca-primary-dark) !important;
        border-color: var(--ca-primary-dark) !important;
        color: #ffffff !important;
        transform: translateY(-1px);
    }

    .btn-filter, .btn-reset {
        min-height: 40px;
        padding: 0 13px;
        border-radius: 9px !important;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        font-size: 11.5px !important;
        font-weight: 650 !important;
        text-decoration: none;
        transition: all .15s ease;
    }

    .btn-filter {
        border: 1px solid var(--ca-primary) !important;
        color: #ffffff !important;
        background: var(--ca-primary) !important;
    }

    .btn-filter:hover {
        background: var(--ca-primary-dark) !important;
        border-color: var(--ca-primary-dark) !important;
    }

    .btn-reset {
        border: 1px solid var(--ca-border) !important;
        color: #667085 !important;
        background: #ffffff !important;
    }

    .btn-reset:hover {
        color: var(--ca-primary-dark) !important;
        background: var(--ca-primary-soft) !important;
        border-color: #cfe4e1 !important;
    }

    .btn-secondary-ca, .btn-light-ca {
        height: 40px;
        padding: 0 16px;
        border-radius: 9px !important;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        background: #ffffff !important;
        color: #344054 !important;
        border: 1px solid var(--ca-border) !important;
        font-size: 13px !important;
        font-weight: 600 !important;
        cursor: pointer;
        transition: all .15s ease;
        text-decoration: none;
    }

    .btn-secondary-ca:hover, .btn-light-ca:hover {
        background: #f8fafb !important;
        color: var(--ca-primary) !important;
        border-color: #cfe4e1 !important;
    }

    /* Action Buttons (Edit/Toggle/Delete) */
    .btn-action {
        min-width: 32px;
        width: auto !important;
        height: 32px;
        padding: 0 14px;
        border-radius: 999px !important;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        border: 1px solid var(--ca-border);
        background: #ffffff;
        color: #475467;
        font-size: 12px !important;
        font-weight: 600;
        cursor: pointer;
        transition: all .15s ease;
        white-space: nowrap;
        text-decoration: none;
    }

    .btn-action:hover {
        color: var(--ca-primary);
        border-color: var(--ca-primary);
        background: var(--ca-primary-soft);
    }

    .btn-action.btn-action-danger:hover {
        color: var(--ca-danger);
        border-color: var(--ca-danger);
        background: var(--ca-danger-soft);
    }

    /* Standardized Badges */
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 4px 10px;
        border-radius: 999px !important;
        font-size: 11px !important;
        font-weight: 650 !important;
    }

    .status-badge.aktif {
        background: var(--ca-success-soft) !important;
        color: var(--ca-success) !important;
        border: 1px solid #c8edd8 !important;
    }

    .status-badge.nonaktif {
        background: #f3f4f6 !important;
        color: #6b7280 !important;
        border: 1px solid #e5e7eb !important;
    }

    /* Standardized Master Data Tabs */
    .master-tabs {
        margin-bottom: 24px;
        display: flex;
        gap: 8px;
        border-bottom: 2px solid var(--ca-border);
        padding-bottom: 2px;
    }

    .master-tab-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 18px;
        border-radius: 9px 9px 0 0 !important;
        font-size: 13px !important;
        font-weight: 650 !important;
        color: var(--ca-muted);
        background: transparent;
        border: none;
        border-bottom: 3px solid transparent;
        margin-bottom: -4px;
        transition: all .15s ease;
        text-decoration: none;
    }

    .master-tab-btn:hover {
        color: var(--ca-primary);
        background: rgba(15, 138, 131, 0.05);
    }

    .master-tab-btn.active {
        color: var(--ca-primary) !important;
        background: #ffffff !important;
        border-bottom: 3px solid var(--ca-primary) !important;
        box-shadow: 0 -2px 6px rgba(0,0,0,0.02);
    }

    /* Sidebar Standard & Compact Styling */
    .sidebar {
        height: 100vh !important;
        max-height: 100vh !important;
        display: flex !important;
        flex-direction: column !important;
        overflow: hidden !important;
    }

    .sidebar-brand {
        height: 72px !important;
        min-height: 72px !important;
        padding: 0 20px !important;
        display: flex;
        align-items: center;
        gap: 12px;
        border-bottom: 1px solid var(--ca-border);
        text-decoration: none;
        flex-shrink: 0 !important;
    }

    .brand-symbol {
        width: 38px !important;
        height: 38px !important;
        flex: 0 0 38px !important;
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        background: var(--ca-primary);
        font-size: 17px !important;
    }

    .brand-name {
        display: block;
        color: var(--ca-primary);
        font-size: 17px !important;
        line-height: 1.1;
        font-weight: 760 !important;
        letter-spacing: -.015em;
    }

    .brand-role {
        display: block;
        margin-top: 3px;
        color: var(--ca-muted);
        font-size: 11px !important;
        font-weight: 500;
    }

    .sidebar-section-label {
        padding: 12px 18px 4px !important;
        color: var(--ca-muted-light);
        font-size: 9.5px !important;
        font-weight: 750 !important;
        letter-spacing: .09em;
        text-transform: uppercase;
        flex-shrink: 0 !important;
    }

    .sidebar-dropdown {
        margin-top: 4px;
    }

    .sidebar-dropdown-toggle {
        width: 100%;
        min-height: 38px;
        height: 38px;
        padding: 0 12px;
        border: 0;
        border-radius: 9px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 8px;
        color: #344054;
        background: transparent;
        font-size: 12.8px;
        font-weight: 620;
        cursor: pointer;
        text-align: left;
        transition: background .15s ease, color .15s ease;
    }

    .sidebar-dropdown-toggle:hover {
        color: var(--ca-primary);
        background: #f8fafb;
    }

    .sidebar-dropdown.open .sidebar-dropdown-toggle {
        color: var(--ca-primary-dark);
        background: var(--ca-primary-soft);
        font-weight: 680;
    }

    .sidebar-dropdown-title {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        min-width: 0;
    }

    .sidebar-dropdown-title i {
        width: 18px;
        color: #667085;
        font-size: 15px;
        text-align: center;
    }

    .sidebar-dropdown-toggle:hover .sidebar-dropdown-title i,
    .sidebar-dropdown.open .sidebar-dropdown-toggle .sidebar-dropdown-title i {
        color: var(--ca-primary);
    }

    .sidebar-dropdown-arrow {
        font-size: 11px !important;
        color: #98a2b3;
        transition: transform .2s ease, color .15s ease;
    }

    .sidebar-dropdown.open .sidebar-dropdown-arrow {
        transform: rotate(180deg);
        color: var(--ca-primary);
    }

    .sidebar-dropdown-menu {
        display: none;
        padding: 3px 0 4px 12px;
        margin-left: 19px;
        border-left: 1.5px solid #e6efef;
    }

    .sidebar-dropdown.open .sidebar-dropdown-menu {
        display: block;
    }

    .sidebar-sublink {
        min-height: 34px !important;
        height: 34px !important;
        padding: 0 10px !important;
        font-size: 12.3px !important;
    }

    .sidebar-nav {
        flex: 1 1 auto !important;
        min-height: 0 !important;
        overflow-y: auto !important;
        overflow-x: hidden !important;
        padding: 0 10px !important;
        scrollbar-width: thin;
        scrollbar-color: rgba(0, 0, 0, 0.15) transparent;
    }

    .sidebar-nav::-webkit-scrollbar {
        width: 4px;
    }

    .sidebar-nav::-webkit-scrollbar-track {
        background: transparent;
    }

    .sidebar-nav::-webkit-scrollbar-thumb {
        background: rgba(0, 0, 0, 0.12);
        border-radius: 4px;
    }

    .sidebar-nav::-webkit-scrollbar-thumb:hover {
        background: rgba(0, 0, 0, 0.25);
    }

    .sidebar-link {
        min-height: 37px !important;
        height: 37px !important;
        margin-bottom: 2px !important;
        padding: 0 12px !important;
        border-radius: 9px !important;
        display: flex;
        align-items: center;
        gap: 10px !important;
        color: #475467 !important;
        font-size: 12.8px !important;
        font-weight: 560 !important;
        text-decoration: none;
        transition: background .15s ease, color .15s ease;
    }

    .sidebar-link i {
        width: 18px !important;
        color: #667085;
        font-size: 15px !important;
        text-align: center;
    }

    .sidebar-link:hover {
        color: var(--ca-primary) !important;
        background: #f8fafb !important;
    }

    .sidebar-link:hover i {
        color: var(--ca-primary);
    }

    .sidebar-link.active {
        color: var(--ca-primary) !important;
        background: var(--ca-primary-soft) !important;
        font-weight: 650 !important;
    }

    .sidebar-link.active i {
        color: var(--ca-primary) !important;
    }

    .sidebar-spacer {
        display: none !important;
        height: 0 !important;
        flex: 0 !important;
    }

    .sidebar-account {
        flex-shrink: 0 !important;
        margin-top: auto !important;
        padding: 10px 12px 14px !important;
        border-top: 1px solid var(--ca-border) !important;
        background: #ffffff !important;
    }

    .logout-button {
        width: 100% !important;
        min-height: 38px !important;
        height: 38px !important;
        padding: 0 12px !important;
        border: 0 !important;
        border-radius: 9px !important;
        display: flex !important;
        align-items: center !important;
        gap: 10px !important;
        color: var(--ca-danger) !important;
        background: transparent !important;
        font-size: 13px !important;
        font-weight: 600 !important;
        cursor: pointer !important;
        text-decoration: none !important;
        transition: background .15s ease, color .15s ease !important;
    }

    .logout-button:hover {
        background: var(--ca-danger-soft) !important;
        color: var(--ca-danger) !important;
    }
</style>
