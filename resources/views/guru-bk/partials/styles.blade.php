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
        --topbar-height: 72px;
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

    /* Standardized Typography Across Guru BK */
    .topbar-title {
        font-size: 17px !important;
        font-weight: 760 !important;
        letter-spacing: -.015em !important;
        color: var(--ca-text) !important;
        line-height: 1.2 !important;
    }

    .topbar-subtitle {
        margin-top: 3px !important;
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
    }

    .page-copy, .page-subtitle {
        font-size: 12.5px !important;
        color: var(--ca-muted);
        line-height: 1.6 !important;
    }

    /* Standard Guru BK Signature Banner (Teal Background with Crisp White Text) */
    .page-header, .welcome-banner, .page-hero {
        margin-bottom: 22px !important;
        padding: 21px 22px !important;
        border-radius: 12px !important;
        display: flex !important;
        align-items: flex-end !important;
        justify-content: space-between !important;
        gap: 20px !important;
        background: var(--ca-primary) !important;
        box-shadow: 0 2px 6px rgba(15, 138, 131, 0.12) !important;
        color: #ffffff !important;
    }

    .page-header > div:first-child, .welcome-banner > div:first-child, .page-hero > div:first-child {
        min-width: 0;
        flex: 1 1 auto;
    }

    .page-header .page-kicker, .welcome-banner .banner-kicker, .page-hero .page-kicker,
    .page-hero-copy .page-kicker, .page-header .banner-kicker, .page-hero .banner-kicker {
        color: rgba(255, 255, 255, .75) !important;
        font-size: 10.5px !important;
        font-weight: 760 !important;
        letter-spacing: .08em !important;
        text-transform: uppercase !important;
        margin-bottom: 6px !important;
    }

    .page-header .page-title, .welcome-banner .banner-title, .page-hero .page-title,
    .page-hero-copy .page-title, .page-header h1, .welcome-banner h1, .page-hero h1,
    .page-header .banner-title, .page-hero .banner-title {
        color: #ffffff !important;
        font-size: 26px !important;
        font-weight: 760 !important;
        letter-spacing: -.02em !important;
        line-height: 1.25 !important;
        margin: 0 !important;
    }

    .page-header .page-copy, .welcome-banner .banner-copy, .page-hero .page-copy,
    .page-hero-copy .page-copy, .page-header p, .welcome-banner p, .page-hero p,
    .page-header .page-subtitle, .page-hero .page-subtitle {
        max-width: 760px !important;
        margin: 7px 0 0 !important;
        color: rgba(255, 255, 255, .82) !important;
        font-size: 12.5px !important;
        line-height: 1.65 !important;
    }

    .page-header .btn-primary-ca, .welcome-banner .btn-primary-ca, .page-hero .btn-primary-ca,
    .page-header .btn-manage-screening, .btn-manage-screening {
        min-height: 36px !important;
        height: 36px !important;
        padding: 0 13px !important;
        border: 1px solid rgba(255, 255, 255, .85) !important;
        border-radius: 8px !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 6px !important;
        color: var(--ca-primary-dark) !important;
        background: #ffffff !important;
        font-size: 11.5px !important;
        font-weight: 660 !important;
        white-space: nowrap !important;
        box-shadow: 0 1px 2px rgba(0, 0, 0, .06) !important;
        transition: background .15s ease, transform .15s ease !important;
        text-decoration: none !important;
        margin-left: auto !important;
        align-self: flex-end !important;
        flex-shrink: 0 !important;
    }

    .page-header .btn-primary-ca:hover, .welcome-banner .btn-primary-ca:hover, .page-hero .btn-primary-ca:hover,
    .page-header .btn-manage-screening:hover, .btn-manage-screening:hover {
        background: #f2faf8 !important;
        color: var(--ca-primary-dark) !important;
        transform: translateY(-1px) !important;
    }

    .banner-symbol {
        width: 48px !important;
        height: 48px !important;
        border-radius: 12px !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        color: #ffffff !important;
        background: rgba(255, 255, 255, .15) !important;
        font-size: 24px !important;
        flex-shrink: 0 !important;
    }

    .panel-title, .card-title, .table-card-title, .section-title, .content-title {
        font-size: 15px !important;
        font-weight: 720 !important;
        color: var(--ca-text) !important;
        letter-spacing: -.01em !important;
        margin: 0 !important;
    }

    .panel-subtitle, .card-subtitle, .table-card-copy, .section-copy {
        font-size: 12px !important;
        color: var(--ca-muted) !important;
        margin-top: 2px !important;
    }

    /* Standard Summary & Metric Cards Matching Admin */
    .summary-card, .metric-card {
        position: relative !important;
        height: 100% !important;
        min-height: 94px !important;
        padding: 15px 16px !important;
        border: 1px solid var(--ca-border) !important;
        border-top: 3px solid #d5dddd !important;
        border-radius: 11px !important;
        background: #ffffff !important;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02) !important;
    }

    .summary-card.total, .metric-card.total, .metric-card.students, .metric-card.priority, .metric-card.reports { border-top-color: var(--ca-primary) !important; }
    .summary-card.active, .metric-card.active, .summary-card.selesai, .metric-card.selesai, .metric-card.completed, .metric-card.screening { border-top-color: #35a36f !important; }
    .summary-card.unassigned, .summary-card.warning, .metric-card.warning, .summary-card.proses, .summary-card.diproses, .metric-card.diproses, .metric-card.processing, .metric-card.progress, .metric-card.assistance { border-top-color: #e6a33b !important; }
    .summary-card.students, .summary-card.info, .metric-card.info, .metric-card.legacy, .metric-card.pending, .metric-card.referrals { border-top-color: #4f8fb8 !important; }
    .summary-card.danger, .summary-card.baru, .metric-card.danger, .metric-card.new, .metric-card.baru, .metric-card.escalated { border-top-color: var(--ca-danger) !important; }

    .summary-label, .metric-label {
        color: var(--ca-muted) !important;
        font-size: 10.5px !important;
        font-weight: 650 !important;
        text-transform: uppercase !important;
        letter-spacing: .04em !important;
        margin: 0 !important;
    }

    .summary-value, .metric-value, .stat-value, .metric-number {
        margin-top: 5px !important;
        color: var(--ca-text) !important;
        font-size: 24px !important;
        font-weight: 760 !important;
        line-height: 1.2 !important;
    }

    .metric-icon {
        width: 36px !important;
        height: 36px !important;
        border-radius: 9px !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        background: var(--ca-primary-soft) !important;
        color: var(--ca-primary) !important;
        font-size: 16px !important;
        flex-shrink: 0 !important;
    }

    .metric-note, .summary-note, .stat-label {
        margin-top: 4px !important;
        font-size: 11.5px !important;
        font-weight: 550 !important;
        color: var(--ca-muted) !important;
    }

    .form-label, .filter-label {
        font-size: 11px !important;
        font-weight: 650 !important;
        color: #475467 !important;
        margin-bottom: 6px !important;
    }

    .form-control, .form-select {
        min-height: 40px !important;
        font-size: 12.5px !important;
        border-radius: 9px !important;
        border: 1px solid var(--ca-border) !important;
        color: var(--ca-text) !important;
        background-color: #ffffff !important;
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
        white-space: nowrap !important;
    }

    .table tbody td, table tbody td {
        font-size: 12px !important;
        vertical-align: middle !important;
        padding: 13px 16px !important;
        border-color: var(--ca-line) !important;
        color: #344054 !important;
    }

    .table tbody tr:hover td {
        background: #fbfdfd !important;
    }

    /* Standardized Buttons */
    .btn-add-primary {
        height: 40px !important;
        padding: 0 16px !important;
        border-radius: 9px !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 8px !important;
        color: #ffffff !important;
        background: var(--ca-primary) !important;
        border: 1px solid var(--ca-primary) !important;
        font-size: 12.5px !important;
        font-weight: 650 !important;
        cursor: pointer !important;
        box-shadow: 0 1px 3px rgba(15, 138, 131, 0.22) !important;
        transition: all .15s ease !important;
        text-decoration: none !important;
    }

    .btn-add-primary:hover {
        background: var(--ca-primary-dark) !important;
        border-color: var(--ca-primary-dark) !important;
        color: #ffffff !important;
        transform: translateY(-1px) !important;
    }

    .btn-filter, .btn-reset, .btn-apply {
        min-height: 40px !important;
        padding: 0 14px !important;
        border-radius: 9px !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 7px !important;
        font-size: 11.5px !important;
        font-weight: 650 !important;
        text-decoration: none !important;
        transition: all .15s ease !important;
        cursor: pointer !important;
    }

    .btn-filter, .btn-apply {
        border: 1px solid var(--ca-primary) !important;
        color: #ffffff !important;
        background: var(--ca-primary) !important;
    }

    .btn-filter:hover, .btn-apply:hover {
        background: var(--ca-primary-dark) !important;
        border-color: var(--ca-primary-dark) !important;
        color: #ffffff !important;
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
        height: 40px !important;
        padding: 0 16px !important;
        border-radius: 9px !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 8px !important;
        background: #ffffff !important;
        color: #344054 !important;
        border: 1px solid var(--ca-border) !important;
        font-size: 12.5px !important;
        font-weight: 600 !important;
        cursor: pointer !important;
        transition: all .15s ease !important;
        text-decoration: none !important;
    }

    .btn-secondary-ca:hover, .btn-light-ca:hover {
        background: #f8fafb !important;
        color: var(--ca-primary) !important;
        border-color: #cfe4e1 !important;
    }

    /* Action Buttons (Detail/Edit/Toggle/Delete) */
    .btn-action {
        width: 32px !important;
        height: 32px !important;
        border-radius: 8px !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        border: 1px solid var(--ca-border) !important;
        background: #ffffff !important;
        color: #475467 !important;
        font-size: 13px !important;
        cursor: pointer !important;
        transition: all .15s ease !important;
        text-decoration: none !important;
    }

    .btn-action:hover {
        color: var(--ca-primary) !important;
        border-color: var(--ca-primary) !important;
        background: var(--ca-primary-soft) !important;
    }

    .btn-action.btn-action-danger:hover {
        color: var(--ca-danger) !important;
        border-color: var(--ca-danger) !important;
        background: var(--ca-danger-soft) !important;
    }

    /* Standardized Badges */
    .status-badge {
        display: inline-flex !important;
        align-items: center !important;
        gap: 5px !important;
        padding: 3px 9px !important;
        border-radius: 999px !important;
        font-size: 11px !important;
        font-weight: 650 !important;
        line-height: 1.4 !important;
    }

    .status-badge.aktif, .status-badge.selesai, .status-badge.disetujui {
        background: var(--ca-success-soft) !important;
        color: var(--ca-success) !important;
        border: 1px solid #c8edd8 !important;
    }

    .status-badge.nonaktif, .status-badge.ditolak, .status-badge.dibatalkan {
        background: #f3f4f6 !important;
        color: #6b7280 !important;
        border: 1px solid #e5e7eb !important;
    }

    .status-badge.proses, .status-badge.menunggu, .status-badge.pending, .status-badge.warning {
        background: var(--ca-warning-soft) !important;
        color: var(--ca-warning) !important;
        border: 1px solid #fedf89 !important;
    }

    .status-badge.danger, .status-badge.darurat, .status-badge.kritis, .status-badge.tinggi {
        background: var(--ca-danger-soft) !important;
        color: var(--ca-danger) !important;
        border: 1px solid #fecdca !important;
    }

    .status-badge.info, .status-badge.rujukan {
        background: var(--ca-info-soft) !important;
        color: var(--ca-info) !important;
        border: 1px solid #b9e6fe !important;
    }

    /* Panels & Filter Bar Standardization */
    .panel, .table-card, .chart-card, .data-card, .content-card, .filter-card, .filter-panel {
        border: 1px solid var(--ca-border) !important;
        border-top: 3px solid var(--ca-primary) !important;
        border-radius: 12px !important;
        background: #ffffff !important;
        box-shadow: 0 1px 3px rgba(0, 0, 0, .04) !important;
        margin-bottom: 22px !important;
    }

    .panel-header, .table-card-header, .chart-card-header, .card-header-clean, .content-card-header {
        padding: 16px 20px !important;
        border-bottom: 1px solid var(--ca-border) !important;
        background: transparent !important;
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;
        gap: 16px !important;
    }

    .panel-body, .table-card-body, .chart-card-body {
        padding: 20px !important;
    }

    .filter-card, .filter-panel {
        padding: 20px 22px !important;
    }

    .filter-bar, .search-bar {
        padding: 18px 20px !important;
        border-bottom: 1px solid var(--ca-border) !important;
        background: #fbfdfd !important;
    }

    /* Master Tabs */
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

    /* Layout Shell, Topbar & Sidebar Standard Matching Admin */
    .app-shell {
        display: block !important;
        min-height: 100vh !important;
        background: var(--ca-bg) !important;
    }

    .topbar {
        position: fixed !important;
        top: 0 !important;
        right: 0 !important;
        left: var(--sidebar-width) !important;
        z-index: 1000 !important;
        height: var(--topbar-height) !important;
        padding: 0 34px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;
        gap: 20px !important;
        background: rgba(255, 255, 255, .98) !important;
        border-bottom: 1px solid var(--ca-border) !important;
    }

    .topbar-left {
        min-width: 0 !important;
        display: flex !important;
        align-items: center !important;
        gap: 12px !important;
    }

    .mobile-sidebar-button {
        display: none !important;
        width: 38px !important;
        height: 38px !important;
        border: 1px solid var(--ca-border) !important;
        border-radius: 9px !important;
        align-items: center !important;
        justify-content: center !important;
        color: var(--ca-text) !important;
        background: #ffffff !important;
    }

    .topbar-actions {
        display: flex !important;
        align-items: center !important;
        gap: 12px !important;
    }

    .date-chip {
        height: 38px !important;
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

    .account-copy {
        min-width: 0 !important;
    }

    .account-name {
        font-size: 12.5px !important;
        font-weight: 680 !important;
        color: var(--ca-text) !important;
        line-height: 1.2 !important;
    }

    .account-role {
        font-size: 10.5px !important;
        color: var(--ca-muted-light) !important;
        margin-top: 1px !important;
    }

    .account-chevron {
        color: var(--ca-muted-light) !important;
        font-size: 10px !important;
    }

    .main-content {
        min-height: 100vh !important;
        margin-left: var(--sidebar-width) !important;
        padding-top: var(--topbar-height) !important;
    }

    .page-body {
        padding: 28px 34px 38px !important;
    }

    .content-shell {
        max-width: 1240px !important;
        margin: 0 auto !important;
    }

    .main-content:not(:has(.page-body)) {
        padding: 28px 34px 38px !important;
        padding-top: calc(var(--topbar-height) + 28px) !important;
    }

    /* Compact, Pinned Sidebar Matching Admin */
    .sidebar {
        position: fixed !important;
        top: 0 !important;
        bottom: 0 !important;
        left: 0 !important;
        width: var(--sidebar-width) !important;
        min-width: var(--sidebar-width) !important;
        max-width: var(--sidebar-width) !important;
        height: 100vh !important;
        max-height: 100vh !important;
        z-index: 1100 !important;
        display: flex !important;
        flex-direction: column !important;
        background: #ffffff !important;
        border-right: 1px solid var(--ca-border) !important;
        overflow: hidden !important;
        padding: 0 !important;
        margin: 0 !important;
    }

    .sidebar-brand {
        height: var(--topbar-height) !important;
        min-height: var(--topbar-height) !important;
        padding: 0 20px !important;
        margin-bottom: 0 !important;
        display: flex !important;
        align-items: center !important;
        gap: 12px !important;
        border-bottom: 1px solid var(--ca-border) !important;
        text-decoration: none !important;
        flex-shrink: 0 !important;
    }

    .brand-symbol {
        width: 38px !important;
        height: 38px !important;
        flex: 0 0 38px !important;
        border-radius: 10px !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        color: #ffffff !important;
        background: var(--ca-primary) !important;
        font-size: 17px !important;
    }

    .brand-name {
        display: block !important;
        color: var(--ca-primary) !important;
        font-size: 17px !important;
        line-height: 1.1 !important;
        font-weight: 760 !important;
        letter-spacing: -.015em !important;
    }

    .brand-role {
        display: block !important;
        margin-top: 3px !important;
        color: var(--ca-muted) !important;
        font-size: 11px !important;
        font-weight: 500 !important;
    }

    .sidebar-section-label {
        padding: 12px 18px 4px !important;
        margin: 0 !important;
        color: var(--ca-muted-light) !important;
        font-size: 9.5px !important;
        font-weight: 750 !important;
        letter-spacing: .09em !important;
        text-transform: uppercase !important;
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
        padding: 8px 10px 6px !important;
        display: flex !important;
        flex-direction: column !important;
        gap: 2px !important;
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
        display: flex !important;
        align-items: center !important;
        gap: 10px !important;
        color: #475467 !important;
        font-size: 12.8px !important;
        font-weight: 560 !important;
        text-decoration: none !important;
        transition: background .15s ease, color .15s ease !important;
    }

    .sidebar-link i {
        width: 18px !important;
        color: #667085 !important;
        font-size: 15px !important;
        text-align: center !important;
    }

    .sidebar-link:hover {
        color: var(--ca-primary) !important;
        background: #f8fafb !important;
    }

    .sidebar-link:hover i {
        color: var(--ca-primary) !important;
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

    .sidebar-overlay {
        position: fixed !important;
        inset: 0 !important;
        z-index: 1040 !important;
        display: none;
        background: rgba(15, 23, 42, .28) !important;
    }

    .sidebar-overlay.show {
        display: block !important;
    }

    /* Responsive Mobile Overrides (< 992px) */
    @media (max-width: 991.98px) {
        .app-shell {
            display: block !important;
        }

        .sidebar {
            position: fixed !important;
            top: 0 !important;
            bottom: 0 !important;
            left: 0 !important;
            z-index: 1100 !important;
            transform: translateX(-100%) !important;
            transition: transform .2s ease !important;
        }

        .sidebar.show {
            transform: translateX(0) !important;
        }

        .topbar {
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            right: 0 !important;
            padding: 0 16px !important;
        }

        .main-content {
            margin-left: 0 !important;
            padding-top: var(--topbar-height) !important;
        }

        .page-body {
            padding: 18px 16px 28px !important;
        }

        .mobile-sidebar-button {
            display: inline-flex !important;
        }
    }
</style>
