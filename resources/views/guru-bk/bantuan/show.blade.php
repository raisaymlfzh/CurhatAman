<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Detail Permintaan Bantuan - Guru BK - CurhatAman</title>

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
            --ca-danger: #b42318;
            --ca-danger-soft: #fff1f0;
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
            max-width: 1040px;
            margin: 0 auto;
        }

        .breadcrumb-ca {
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 7px;
            color: var(--ca-muted);
            font-size: 11px;
        }

        .breadcrumb-ca a {
            color: var(--ca-primary-dark);
            font-weight: 650;
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
            max-width: 740px;
            margin: 0;
            color: rgba(255, 255, 255, .82);
            font-size: 12px;
            line-height: 1.6;
        }

        .prefill-card {
            margin-bottom: 18px;
            padding: 12px 14px;
            border: 1px solid #cfe4e1;
            border-left: 4px solid var(--ca-primary);
            border-radius: 9px;
            display: flex;
            align-items: flex-start;
            gap: 10px;
            color: #4f6663;
            background: #f4faf9;
            font-size: 10.5px;
            line-height: 1.55;
        }

        .prefill-card i {
            margin-top: 1px;
            color: var(--ca-primary);
            font-size: 14px;
        }

        .prefill-card strong {
            color: var(--ca-primary-dark);
        }

        .form-card {
            padding: 0;
            border: 1px solid var(--ca-border);
            border-top: 3px solid var(--ca-primary);
            border-radius: 12px;
            overflow: hidden;
            background: #ffffff;
        }

        .form-section {
            padding: 20px 22px;
        }

        .form-section + .form-section {
            border-top: 1px solid var(--ca-line);
        }

        .section-heading {
            margin-bottom: 17px;
            display: flex;
            align-items: flex-start;
            gap: 11px;
        }

        .section-icon {
            width: 34px;
            height: 34px;
            flex: 0 0 34px;
            border-radius: 9px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: var(--ca-primary-dark);
            background: var(--ca-primary-soft);
            font-size: 14px;
        }

        .section-title {
            margin-bottom: 3px;
            color: var(--ca-text);
            font-size: 13px;
            font-weight: 710;
        }

        .section-copy {
            margin: 0;
            color: var(--ca-muted);
            font-size: 10.5px;
            line-height: 1.55;
        }

        .locked-field {
            min-height: 44px;
            padding: 10px 12px;
            border: 1px solid #cfe4e1;
            border-radius: 9px;
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--ca-text);
            background: #f7fbfa;
        }

        .locked-field-icon {
            width: 30px;
            height: 30px;
            flex: 0 0 30px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: var(--ca-primary-dark);
            background: var(--ca-primary-soft);
            font-size: 12px;
        }

        .locked-field-copy {
            min-width: 0;
        }

        .locked-field-value {
            color: var(--ca-text);
            font-size: 11.5px;
            font-weight: 680;
            line-height: 1.35;
        }

        .locked-field-meta {
            margin-top: 2px;
            color: var(--ca-muted);
            font-size: 9.8px;
            line-height: 1.4;
        }

        .form-label {
            margin-bottom: 7px;
            color: #475467;
            font-size: 10.5px;
            font-weight: 650;
        }

        .required {
            color: var(--ca-danger);
        }

        .form-control,
        .form-select {
            min-height: 44px;
            border: 1px solid #d8e1e1;
            border-radius: 9px;
            color: var(--ca-text);
            background-color: #ffffff;
            font-size: 12px;
            box-shadow: none;
        }

        textarea.form-control {
            min-height: 130px;
            resize: vertical;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: rgba(15, 138, 131, .58);
            box-shadow: 0 0 0 .2rem rgba(15, 138, 131, .08);
        }

        .form-select:disabled {
            color: #8a94a3;
            background-color: #f7f8f9;
        }

        .form-text {
            margin-top: 6px;
            color: var(--ca-muted-light);
            font-size: 10px;
            line-height: 1.5;
        }

        .info-card {
            margin-bottom: 16px;
            padding: 12px 13px;
            border: 1px solid #d4e8e5;
            border-radius: 9px;
            display: flex;
            align-items: flex-start;
            gap: 10px;
            color: #506663;
            background: #f5faf9;
            font-size: 10.5px;
            line-height: 1.55;
        }

        .info-card i {
            margin-top: 1px;
            color: var(--ca-primary);
            font-size: 13px;
        }

        .form-actions {
            padding: 16px 22px;
            border-top: 1px solid var(--ca-line);
            display: flex;
            justify-content: flex-end;
            gap: 9px;
            background: #fbfcfc;
        }

        .btn-primary-ca,
        .btn-secondary-ca {
            min-height: 42px;
            padding: 0 14px;
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

        .btn-primary-ca:hover {
            color: #ffffff;
            background: var(--ca-primary-dark);
            border-color: var(--ca-primary-dark);
        }

        .btn-secondary-ca {
            border: 1px solid var(--ca-border);
            color: #475467;
            background: #ffffff;
        }

        .btn-secondary-ca:hover {
            color: var(--ca-primary-dark);
            background: var(--ca-primary-soft);
            border-color: #cfe4e1;
        }

        .alert {
            border-radius: 9px;
            font-size: 11.5px;
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

            .form-section {
                padding: 18px;
            }

            .form-actions {
                padding: 15px 18px;
                flex-direction: column-reverse;
            }

            .form-actions .btn-primary-ca,
            .form-actions .btn-secondary-ca {
                width: 100%;
            }
        }
    
        .header-actions-wrapper {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .current-status-chip {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 7px 14px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 700;
            color: #ffffff;
            background: rgba(255, 255, 255, .16);
            border: 1px solid rgba(255, 255, 255, .35);
        }

        .alert-custom {
            border: 0;
            border-radius: 10px;
            font-size: 13px;
            padding: 12px 16px;
        }
    </style>
    @include('guru-bk.partials.styles')
</head>

<body>



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
                    Detail Permintaan Bantuan
                </div>

                <div class="topbar-subtitle">
                    Detail permintaan konseling siswa.
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
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </span>

                <span class="account-copy">
                    <span class="account-name d-block">
                        {{ $user->name }}
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
                <nav class="breadcrumb-ca" aria-label="breadcrumb">
                    <a href="{{ route('guru-bk.bantuan.index') }}">
                        <i class="bi bi-arrow-left me-1"></i> Permintaan Bantuan
                    </a>
                    <i class="bi bi-chevron-right"></i>
                    <span>Detail Permintaan</span>
                </nav>

                @if (session('success'))
                    <div class="alert alert-success alert-custom mb-4 d-flex align-items-center gap-2" role="alert">
                        <i class="bi bi-check-circle-fill fs-5"></i>
                        <div>{{ session('success') }}</div>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger alert-custom mb-4 d-flex align-items-center gap-2" role="alert">
                        <i class="bi bi-exclamation-circle-fill fs-5"></i>
                        <div>{{ $errors->first() }}</div>
                    </div>
                @endif

                @php
                    $bisaKelolaBantuan = ! $dataPermintaan->assigned_bk_id || (int) $dataPermintaan->assigned_bk_id === (int) $user->id;
                    $statusBadgeClass = match($dataPermintaan->status) {
                        'baru' => 'badge-status-baru',
                        'diproses' => 'badge-status-diproses',
                        'selesai' => 'badge-status-selesai',
                        default => 'badge-status-baru',
                    };
                    $statusIcon = match($dataPermintaan->status) {
                        'baru' => 'bi-clock-history',
                        'diproses' => 'bi-hourglass-split',
                        'selesai' => 'bi-check-circle-fill',
                        default => 'bi-info-circle',
                    };
                    $statusLabel = match($dataPermintaan->status) {
                        'baru' => 'Baru',
                        'diproses' => 'Diproses',
                        'selesai' => 'Selesai',
                        default => ucfirst($dataPermintaan->status),
                    };
                @endphp

                <header class="page-header d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <div>
                        <div class="page-kicker">
                            <i class="bi bi-chat-heart me-1"></i> Permintaan Bantuan Siswa
                        </div>
                        <h1 class="page-title">Detail Permintaan Bantuan</h1>
                        <p class="page-copy">
                            Detail permintaan konseling siswa.
                        </p>
                    </div>

                                        <div class="header-actions-wrapper">
                        {{-- Status Saat Ini --}}
                        <div class="current-status-chip {{ $statusBadgeClass }}">
                            <i class="bi {{ $statusIcon }}"></i>
                            <span>{{ $statusLabel }}</span>
                        </div>
                    </div>
                </header>

                <div class="form-card">
                    <section class="form-section">
                        <div class="section-heading">
                            <span class="section-icon">
                                <i class="bi bi-person"></i>
                            </span>
                            <div>
                                <div class="section-title">Informasi Siswa</div>
                                <div class="section-copy">Identitas siswa pengirim permintaan bantuan.</div>
                            </div>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Nama Lengkap Siswa</label>
                                <div class="locked-field">
                                    <span class="locked-field-icon">
                                        <i class="bi bi-person-check"></i>
                                    </span>
                                    <span class="locked-field-copy">
                                        <span class="locked-field-value d-block">
                                            {{ $dataPermintaan->nama_siswa }}
                                        </span>
                                        <span class="locked-field-meta d-block">
                                            Pengirim permintaan bantuan
                                        </span>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Nomor Induk Siswa (NIS)</label>
                                <div class="locked-field">
                                    <span class="locked-field-icon">
                                        <i class="bi bi-card-heading"></i>
                                    </span>
                                    <span class="locked-field-copy">
                                        <span class="locked-field-value d-block">
                                            {{ $dataPermintaan->nis }}
                                        </span>
                                        <span class="locked-field-meta d-block">
                                            Identitas siswa
                                        </span>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Kelas / Rombel</label>
                                <div class="locked-field">
                                    <span class="locked-field-icon">
                                        <i class="bi bi-mortarboard"></i>
                                    </span>
                                    <span class="locked-field-copy">
                                        <span class="locked-field-value d-block">
                                            {{ $dataPermintaan->nama_kelas }}
                                        </span>
                                        <span class="locked-field-meta d-block">
                                            Kelas aktif
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="form-section">
                        <div class="section-heading">
                            <span class="section-icon">
                                <i class="bi bi-card-text"></i>
                            </span>
                            <div>
                                <div class="section-title">Isi Pesan / Keluhan</div>
                                <div class="section-copy">Pesan lengkap yang disampaikan oleh siswa.</div>
                            </div>
                        </div>

                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label">Kategori / Jenis Bantuan</label>
                                <div class="locked-field">
                                    <span class="locked-field-icon">
                                        <i class="bi bi-tag"></i>
                                    </span>
                                    <span class="locked-field-copy">
                                        <span class="locked-field-value d-block">
                                            {{ $jenisLabel[$dataPermintaan->jenis_bantuan] ?? 'Lainnya' }}
                                        </span>
                                    </span>
                                </div>
                            </div>
                            
                            <div class="col-12 mt-3">
                                <label class="form-label">Pesan yang Disampaikan</label>
                                <div class="p-3 rounded-3" style="background: #f8fafc; border: 1px solid var(--ca-border); border-left: 4px solid var(--ca-primary);">
                                    <div style="color: #1e293b; font-size: 13.5px; line-height: 1.7; white-space: pre-wrap; font-weight: 450;">{{ $dataPermintaan->pesan }}</div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="form-section">
                        <div class="section-heading">
                            <span class="section-icon">
                                <i class="bi bi-clock-history"></i>
                            </span>
                            <div>
                                <div class="section-title">Status & Riwayat Waktu</div>
                                <div class="section-copy">Informasi waktu pengiriman dan penanganan.</div>
                            </div>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label">Waktu Dikirim</label>
                                <div class="locked-field">
                                    <span class="locked-field-icon">
                                        <i class="bi bi-calendar-check"></i>
                                    </span>
                                    <span class="locked-field-copy">
                                        <span class="locked-field-value d-block">
                                            {{ \Carbon\Carbon::parse($dataPermintaan->submitted_at ?? $dataPermintaan->created_at)->locale('id')->translatedFormat('l, d M Y') }}
                                        </span>
                                        <span class="locked-field-meta d-block">
                                            Pukul {{ \Carbon\Carbon::parse($dataPermintaan->submitted_at ?? $dataPermintaan->created_at)->format('H:i') }} WIB
                                        </span>
                                    </span>
                                </div>
                            </div>

                                                        <div class="col-md-4">
                                <label class="form-label" for="status">Status Penanganan</label>
                                @if ($bisaKelolaBantuan)
                                    <form method="POST" action="{{ route('guru-bk.bantuan.status', $dataPermintaan->id) }}" class="locked-field d-flex align-items-center justify-content-between">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="return_to_show" value="1">
                                        <div class="d-flex align-items-center gap-2 flex-grow-1 min-w-0">
                                            <span class="locked-field-icon">
                                                <i class="bi {{ $statusIcon }}"></i>
                                            </span>
                                            <div class="locked-field-copy flex-grow-1">
                                                <select name="status" id="status" style="border: none; background: transparent; font-size: 11.5px; font-weight: 680; color: var(--ca-text); cursor: pointer; outline: none; padding: 0; box-shadow: none;" aria-label="Status Permintaan">
                                                    <option value="baru" @selected($dataPermintaan->status === 'baru')>Baru</option>
                                                    <option value="diproses" @selected($dataPermintaan->status === 'diproses')>Diproses</option>
                                                    <option value="selesai" @selected($dataPermintaan->status === 'selesai')>Selesai</option>
                                                </select>
                                                <span class="locked-field-meta d-block">
                                                    Pilih status
                                                </span>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-sm btn-primary d-inline-flex align-items-center gap-1 shadow-none" style="height: 28px; padding: 0 10px; border-radius: 6px; font-size: 11px; font-weight: 600; background-color: var(--ca-primary); border: none; white-space: nowrap;" title="Simpan Perubahan Status">
                                            <i class="bi bi-check2"></i> Simpan
                                        </button>
                                    </form>
                                @else
                                    <div class="locked-field">
                                        <span class="locked-field-icon">
                                            <i class="bi {{ $statusIcon }}"></i>
                                        </span>
                                        <span class="locked-field-copy">
                                            <span class="locked-field-value d-block text-capitalize">
                                                {{ $dataPermintaan->status }}
                                            </span>
                                            <span class="locked-field-meta d-block">
                                                Status saat ini
                                            </span>
                                        </span>
                                    </div>
                                @endif
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Penanggung Jawab</label>
                                <div class="locked-field">
                                    <span class="locked-field-icon">
                                        <i class="bi bi-person-badge"></i>
                                    </span>
                                    <span class="locked-field-copy">
                                        <span class="locked-field-value d-block text-truncate" style="max-width: 170px;" title="{{ $dataPermintaan->nama_bk_penanggung_jawab ?? 'Belum ada penanggung jawab' }}">
                                            {{ $dataPermintaan->nama_bk_penanggung_jawab ?? 'Belum ada' }}
                                        </span>
                                        <span class="locked-field-meta d-block">
                                            @if ($dataPermintaan->assigned_bk_id)
                                                {{ (int) $dataPermintaan->assigned_bk_id === (int) $user->id ? 'Anda bertanggung jawab' : 'Rekan Guru BK' }}
                                            @else
                                                Terbuka untuk semua Guru BK
                                            @endif
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="form-section">
                        <div class="section-heading mb-3">
                            <span class="section-icon" style="background: #e0f2fe; color: #0284c7;">
                                <i class="bi bi-journal-medical"></i>
                            </span>
                            <div>
                                <div class="section-title">Riwayat Sesi Konseling Terkait</div>
                                <div class="section-copy">Dokumentasi sesi konseling yang telah dilaksanakan untuk permintaan bantuan ini.</div>
                            </div>
                        </div>

                        @if(isset($riwayatKonseling) && count($riwayatKonseling) > 0)
                            <div class="table-responsive" style="border: 1px solid var(--ca-border); border-radius: 9px; overflow: hidden;">
                                <table class="table table-hover align-middle mb-0" style="font-size: 13px;">
                                    <thead style="background: #f8fafc; font-size: 12px; color: var(--ca-muted);">
                                        <tr>
                                            <th style="padding: 11px 16px;">TANGGAL</th>
                                            <th style="padding: 11px 16px;">JENIS LAYANAN</th>
                                            <th style="padding: 11px 16px;">TOPIK PEMBAHASAN</th>
                                            <th style="padding: 11px 16px;">GURU BK</th>
                                            <th style="padding: 11px 16px; text-align: right;">AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($riwayatKonseling as $sesi)
                                            <tr>
                                                <td style="padding: 12px 16px; font-weight: 600; white-space: nowrap;">
                                                    <i class="bi bi-calendar-check text-primary me-1"></i>
                                                    {{ \Carbon\Carbon::parse($sesi->tanggal_pertemuan)->locale('id')->translatedFormat('d M Y') }}
                                                </td>
                                                <td style="padding: 12px 16px;">
                                                    <span class="badge" style="background: var(--ca-primary-soft); color: var(--ca-primary-dark); font-weight: 600; font-size: 11.5px; padding: 5px 9px; border-radius: 6px;">
                                                        {{ $sesi->jenis_layanan }}
                                                    </span>
                                                </td>
                                                <td style="padding: 12px 16px; font-weight: 500; color: #1e293b;">
                                                    {{ $sesi->topik }}
                                                </td>
                                                <td style="padding: 12px 16px; color: var(--ca-muted);">
                                                    {{ $sesi->nama_guru_bk }}
                                                </td>
                                                <td style="padding: 12px 16px; text-align: right; white-space: nowrap;">
                                                    <a href="{{ route('guru-bk.catatan-konseling.show', $sesi->id) }}" class="btn btn-sm btn-outline-primary" style="font-size: 12px; border-radius: 6px; padding: 4px 10px;">
                                                        <i class="bi bi-eye"></i> Lihat Jurnal
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div style="background: #f8fafc; border: 1px dashed #cbd5e1; border-radius: 9px; padding: 14px 18px; color: #64748b; font-size: 12.5px; display: flex; align-items: center; gap: 9px;">
                                <i class="bi bi-info-circle text-primary fs-6"></i>
                                <span>
                                    @if ($bisaKelolaBantuan)
                                        Belum ada sesi konseling yang didokumentasikan untuk permintaan bantuan ini. Gunakan tombol di bawah jika ingin mencatat sesi konseling.
                                    @else
                                        Belum ada sesi konseling yang didokumentasikan untuk permintaan bantuan ini. Permintaan ini sedang ditangani oleh <strong>{{ $dataPermintaan->nama_bk_penanggung_jawab ?? 'Guru BK lain' }}</strong>.
                                    @endif
                                </span>
                            </div>
                        @endif
                    </section>

                    <div class="form-actions mt-4 d-flex align-items-center justify-content-between flex-wrap gap-2">
                        <a href="{{ route('guru-bk.bantuan.index') }}" class="btn-secondary-ca d-inline-flex align-items-center gap-2">
                            <i class="bi bi-arrow-left"></i> Kembali ke Daftar
                        </a>
                        <div class="d-flex align-items-center gap-2 flex-wrap">
                            @if ($bisaKelolaBantuan)
                                <a href="{{ route('guru-bk.catatan-konseling.create', ['bantuan_id' => $dataPermintaan->id, 'siswa_id' => $dataPermintaan->siswa_id]) }}" class="btn-primary-ca d-inline-flex align-items-center gap-2" style="background-color: var(--ca-primary); color: white;">
                                    <i class="bi bi-journal-plus"></i> + Buat Catatan Konseling
                                </a>
                            @else
                                <button type="button" class="btn-secondary-ca d-inline-flex align-items-center gap-2" disabled title="Permintaan bantuan ini sedang ditangani oleh {{ $dataPermintaan->nama_bk_penanggung_jawab ?? 'Guru BK lain' }}" style="opacity: 0.65; cursor: not-allowed;">
                                    <i class="bi bi-person-lock"></i> Ditangani {{ Str::limit($dataPermintaan->nama_bk_penanggung_jawab ?? 'Guru BK Lain', 18) }}
                                </button>
                            @endif
                            <a href="{{ route('guru-bk.bantuan.pdf.detail', $dataPermintaan->id) }}" class="btn-secondary-ca d-inline-flex align-items-center gap-2" target="_blank">
                                <i class="bi bi-file-earmark-pdf text-danger"></i> Cetak PDF
                            </a>
                        </div>
                    </div>
                </div>
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



</body>
</html>











