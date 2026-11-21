@php
    $errors = $errors ?? new \Illuminate\Support\ViewErrorBag();
    $namaUser = $user->name;
    $inisial = collect(explode(' ', trim($namaUser)))
        ->filter()
        ->take(2)
        ->map(fn ($bagian) => mb_strtoupper(mb_substr($bagian, 0, 1)))
        ->implode('');
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Mitra Rujukan | CurhatAman</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
            line-height: 1.3;
        }

        .account-role {
            margin-top: 2px;
            color: var(--ca-muted-light);
            font-size: 10.5px;
            line-height: 1.3;
        }

        .account-chevron {
            margin-left: auto;
            color: var(--ca-muted-light);
            font-size: 11px;
            transition: color .15s ease, transform .15s ease;
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
            max-width: 1240px;
            margin: 0 auto;
        }

        .alert-success-ca {
            margin-bottom: 16px;
            padding: 12px 14px;
            border: 1px solid #cde8db;
            border-radius: 9px;
            color: var(--ca-success);
            background: var(--ca-success-soft);
            font-size: 11.5px;
        }

        .alert-danger-ca {
            margin-bottom: 16px;
            padding: 12px 14px;
            border: 1px solid #fecdca;
            border-radius: 9px;
            color: var(--ca-danger);
            background: var(--ca-danger-soft);
            font-size: 11.5px;
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

        .btn-primary-ca {
            min-height: 42px;
            padding: 0 16px;
            border: 1px solid rgba(255, 255, 255, .76);
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--ca-primary-dark);
            background: #ffffff;
            font-size: 12px;
            font-weight: 680;
            white-space: nowrap;
            cursor: pointer;
            transition: background .15s ease, transform .15s ease;
        }

        .btn-primary-ca:hover,
        .btn-primary-ca:focus {
            color: var(--ca-primary-dark);
            background: #f2faf8;
            transform: translateY(-1px);
        }

        .summary-card {
            position: relative;
            height: 100%;
            min-height: 94px;
            padding: 15px 16px;
            border: 1px solid var(--ca-border);
            border-top: 3px solid #d5dddd;
            border-radius: 11px;
            background: #ffffff;
        }

        .summary-card.total {
            border-top-color: var(--ca-primary);
        }

        .summary-card.active {
            border-top-color: #35a36f;
        }

        .summary-card.unassigned {
            border-top-color: #e6a33b;
        }

        .summary-card.students {
            border-top-color: #4f8fb8;
        }

        .summary-label {
            color: var(--ca-muted);
            font-size: 10.5px;
            font-weight: 650;
            text-transform: uppercase;
            letter-spacing: .04em;
        }

        .summary-value {
            margin-top: 5px;
            color: var(--ca-text);
            font-size: 22px;
            font-weight: 740;
        }

        .panel {
            border: 1px solid var(--ca-border);
            border-top: 3px solid var(--ca-primary);
            border-radius: 12px;
            background: #ffffff;
            overflow: hidden;
        }

        .filter-bar {
            padding: 16px 18px;
            border-bottom: 1px solid var(--ca-line);
            display: grid;
            grid-template-columns: minmax(230px, 1fr) 180px 160px auto;
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

        .filter-actions {
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
            text-decoration: none;
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
            font-size: 10px;
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

        .mitra-name {
            color: var(--ca-text);
            font-weight: 680;
            font-size: 13px;
        }

        .mitra-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 3px 8px;
            border-radius: 6px;
            font-size: 10.5px;
            font-weight: 600;
            margin-top: 3px;
        }

        .badge-psikolog { background: #f5f3ff; color: #7c3aed; }
        .badge-puskesmas { background: #ecfeff; color: #0891b2; }
        .badge-rumah_sakit { background: #eff6ff; color: #2563eb; }
        .badge-perlindungan_anak { background: #fffbeb; color: #d97706; }
        .badge-kepolisian { background: #f8fafc; color: #475569; border: 1px solid #e2e8f0; }
        .badge-hotline { background: #f0fdf4; color: #16a34a; }
        .badge-lainnya { background: #f3f4f6; color: #4b5563; }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 9px;
            border-radius: 999px;
            font-size: 10.5px;
            font-weight: 650;
            white-space: nowrap;
        }

        .status-badge.active {
            color: var(--ca-success);
            background: var(--ca-success-soft);
            border: 1px solid #cde8db;
        }

        .status-badge.inactive {
            color: #667085;
            background: #f2f4f7;
            border: 1px solid #e4e7ec;
        }

        .action-wrap {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 6px;
        }

        .btn-action {
            min-height: 32px;
            padding: 0 9px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            font-size: 11px;
            font-weight: 650;
            white-space: nowrap;
            cursor: pointer;
            border: 1px solid var(--ca-border);
            background: #ffffff;
            color: #475467;
            transition: all .15s ease;
        }

        .btn-action:hover {
            color: var(--ca-primary-dark);
            background: var(--ca-primary-soft);
            border-color: #cfe4e1;
        }

        .btn-action.btn-danger-action:hover {
            color: var(--ca-danger);
            background: var(--ca-danger-soft);
            border-color: #fecdca;
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

        @media (max-width: 1100px) {
            .filter-bar {
                grid-template-columns: 1fr 1fr;
            }

            .filter-actions {
                grid-column: 1 / -1;
            }
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

            .filter-bar {
                grid-template-columns: 1fr;
            }

            .filter-actions {
                grid-column: auto;
            }
        }

        @media (max-width: 575.98px) {
            .btn-primary-ca {
                width: 100%;
                justify-content: center;
            }

            .filter-actions {
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

<div class="app-shell">

    @include('admin.partials.sidebar')

    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <header class="topbar">
        <div class="topbar-left">
            <button type="button" class="mobile-sidebar-button" id="openSidebarButton" aria-label="Buka menu">
                <i class="bi bi-list"></i>
            </button>

            <div>
                <div class="topbar-title">Mitra Rujukan</div>
                <div class="topbar-subtitle">
                    Kelola data lembaga, faskes, dan psikolog rekanan rujukan BK
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
                <span class="topbar-avatar">{{ $inisial }}</span>

                <span class="account-copy">
                    <span class="account-name d-block">{{ $namaUser }}</span>
                    <span class="account-role d-block">Wakil Kesiswaan / Admin</span>
                </span>

                <i class="bi bi-chevron-right account-chevron"></i>
            </a>
        </div>
    </header>

    <main class="main-content">
        <div class="page-body">
            <div class="content-shell">

                @if (session('success'))
                    <div class="alert-success-ca">
                        <i class="bi bi-check-circle me-1"></i>
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert-danger-ca">
                        <i class="bi bi-exclamation-triangle me-1"></i>
                        {{ session('error') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert-danger-ca">
                        <i class="bi bi-exclamation-circle me-1"></i>
                        {{ $errors->first() }}
                    </div>
                @endif

                <section class="page-header">
                    <div>
                        <div class="page-kicker">Administrasi Sekolah</div>

                        <h1 class="page-title">Mitra Rujukan Eksternal</h1>

                        <p class="page-copy">
                            Kelola lembaga kesehatan, psikolog, rumah sakit, dan mitra rujukan eksternal resmi.
                            Mitra yang aktif akan otomatis muncul sebagai opsi rekomendasi rujukan pada formulir penanganan kasus Guru BK.
                        </p>
                    </div>

                    <button
                        type="button"
                        class="btn-primary-ca"
                        data-bs-toggle="modal"
                        data-bs-target="#tambahMitraModal"
                    >
                        <i class="bi bi-plus-lg"></i>
                        Tambah Mitra
                    </button>
                </section>

                <section class="row g-3 mb-3">
                    <div class="col-6 col-md-3">
                        <div class="summary-card total">
                            <div class="summary-label">Total Mitra</div>
                            <div class="summary-value">{{ $ringkasan['total'] }}</div>
                        </div>
                    </div>

                    <div class="col-6 col-md-3">
                        <div class="summary-card active">
                            <div class="summary-label">Mitra Aktif</div>
                            <div class="summary-value">{{ $ringkasan['aktif'] }}</div>
                        </div>
                    </div>

                    <div class="col-6 col-md-3">
                        <div class="summary-card unassigned">
                            <div class="summary-label">Mitra Nonaktif</div>
                            <div class="summary-value">{{ $ringkasan['nonaktif'] }}</div>
                        </div>
                    </div>

                    <div class="col-6 col-md-3">
                        <div class="summary-card students">
                            <div class="summary-label">Kasus Dirujuk</div>
                            <div class="summary-value">{{ $ringkasan['total_rujukan'] }}</div>
                        </div>
                    </div>
                </section>

                <section class="panel">
                    <form
                        method="GET"
                        action="{{ route('admin.mitra-rujukan.index') }}"
                        class="filter-bar"
                    >
                        <div>
                            <label class="form-label">Cari Mitra</label>
                            <input
                                type="text"
                                name="q"
                                value="{{ $search }}"
                                class="form-control"
                                placeholder="Nama mitra, nomor kontak, alamat..."
                            >
                        </div>

                        <div>
                            <label class="form-label">Jenis Layanan</label>
                            <select name="jenis" class="form-select">
                                <option value="">Semua Jenis Layanan</option>
                                @foreach($jenisLabels as $key => $label)
                                    <option value="{{ $key }}" @selected($selectedJenis === $key)>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select">
                                <option value="">Semua Status</option>
                                <option value="aktif" @selected($selectedStatus === 'aktif')>Aktif</option>
                                <option value="nonaktif" @selected($selectedStatus === 'nonaktif')>Nonaktif</option>
                            </select>
                        </div>

                        <div class="filter-actions">
                            <button type="submit" class="btn-filter">
                                <i class="bi bi-funnel"></i>
                                Terapkan
                            </button>

                            <a
                                href="{{ route('admin.mitra-rujukan.index') }}"
                                class="btn-reset"
                            >
                                Reset
                            </a>
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th>Instansi & Layanan</th>
                                    <th>Kontak</th>
                                    <th>Alamat / Website</th>
                                    <th class="text-center">Rujukan Siswa</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-end">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($mitraList as $mitra)
                                    @php
                                        $badgeClass = match($mitra->jenis_layanan) {
                                            'psikolog' => 'badge-psikolog',
                                            'puskesmas' => 'badge-puskesmas',
                                            'rumah_sakit' => 'badge-rumah_sakit',
                                            'perlindungan_anak' => 'badge-perlindungan_anak',
                                            'kepolisian' => 'badge-kepolisian',
                                            'hotline' => 'badge-hotline',
                                            default => 'badge-lainnya',
                                        };
                                        $iconClass = match($mitra->jenis_layanan) {
                                            'psikolog' => 'bi-person-heart',
                                            'puskesmas' => 'bi-hospital',
                                            'rumah_sakit' => 'bi-hospital-fill',
                                            'perlindungan_anak' => 'bi-shield-check',
                                            'kepolisian' => 'bi-shield-fill',
                                            'hotline' => 'bi-telephone-fill',
                                            default => 'bi-building',
                                        };
                                    @endphp
                                    <tr>
                                        <td>
                                            <div class="mitra-name">{{ $mitra->nama_layanan }}</div>
                                            <span class="mitra-badge {{ $badgeClass }}">
                                                <i class="bi {{ $iconClass }}"></i>
                                                {{ $jenisLabels[$mitra->jenis_layanan] ?? ucfirst($mitra->jenis_layanan) }}
                                            </span>
                                        </td>

                                        <td>
                                            @if($mitra->kontak)
                                                <div class="d-flex align-items-center gap-1 text-dark">
                                                    <i class="bi bi-telephone text-muted"></i>
                                                    <span>{{ $mitra->kontak }}</span>
                                                </div>
                                            @else
                                                <span class="text-muted fst-italic">Belum diisi</span>
                                            @endif
                                        </td>

                                        <td>
                                            @if($mitra->alamat_url)
                                                <div class="text-truncate" style="max-width: 250px;" title="{{ $mitra->alamat_url }}">
                                                    <i class="bi bi-geo-alt text-muted me-1"></i>
                                                    {{ $mitra->alamat_url }}
                                                </div>
                                            @else
                                                <span class="text-muted fst-italic">Belum diisi</span>
                                            @endif
                                        </td>

                                        <td class="text-center">
                                            <span class="badge bg-light text-dark border px-2 py-1" style="font-size: 11px; font-weight: 600;">
                                                {{ $mitra->total_rujukan }} rujukan
                                            </span>
                                        </td>

                                        <td class="text-center">
                                            @if($mitra->is_active)
                                                <span class="status-badge active">
                                                    <i class="bi bi-check-circle-fill"></i>
                                                    Aktif
                                                </span>
                                            @else
                                                <span class="status-badge inactive">
                                                    <i class="bi bi-dash-circle"></i>
                                                    Nonaktif
                                                </span>
                                            @endif
                                        </td>

                                        <td class="text-end">
                                            <div class="action-wrap">
                                                {{-- Tombol Edit --}}
                                                <button
                                                    type="button"
                                                    class="btn-action"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editMitraModal{{ $mitra->id }}"
                                                    title="Ubah Data Mitra"
                                                >
                                                    <i class="bi bi-pencil"></i>
                                                </button>

                                                {{-- Tombol Toggle Status --}}
                                                <form
                                                    method="POST"
                                                    action="{{ route('admin.mitra-rujukan.toggle-status', $mitra->id) }}"
                                                    class="d-inline m-0"
                                                >
                                                    @csrf
                                                    @method('PATCH')
                                                    <button
                                                        type="submit"
                                                        class="btn-action"
                                                        title="{{ $mitra->is_active ? 'Nonaktifkan Mitra' : 'Aktifkan Mitra' }}"
                                                    >
                                                        <i class="bi {{ $mitra->is_active ? 'bi-toggle-on text-success fs-6' : 'bi-toggle-off text-muted fs-6' }}"></i>
                                                    </button>
                                                </form>

                                                {{-- Tombol Hapus --}}
                                                <form
                                                    method="POST"
                                                    action="{{ route('admin.mitra-rujukan.destroy', $mitra->id) }}"
                                                    class="d-inline m-0"
                                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus mitra {{ addslashes($mitra->nama_layanan) }}?');"
                                                >
                                                    @csrf
                                                    @method('DELETE')
                                                    <button
                                                        type="submit"
                                                        class="btn-action btn-danger-action"
                                                        title="Hapus Mitra"
                                                    >
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>

                                    {{-- Modal Edit Mitra --}}
                                    <div class="modal fade" id="editMitraModal{{ $mitra->id }}" tabindex="-1" aria-labelledby="editMitraModalLabel{{ $mitra->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content" style="border-radius: 12px; border: 1px solid var(--ca-border);">
                                                <form method="POST" action="{{ route('admin.mitra-rujukan.update', $mitra->id) }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-header" style="border-bottom: 1px solid var(--ca-line); padding: 18px 22px;">
                                                        <h5 class="modal-title fw-bold" id="editMitraModalLabel{{ $mitra->id }}" style="font-size: 15px; color: var(--ca-text);">
                                                            <i class="bi bi-pencil-square text-primary me-2"></i>Ubah Mitra Rujukan
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body" style="padding: 20px 22px;">
                                                        <div class="mb-3">
                                                            <label class="form-label">Nama Lembaga / Mitra <span class="text-danger">*</span></label>
                                                            <input type="text" name="nama_layanan" class="form-control" value="{{ $mitra->nama_layanan }}" required>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label class="form-label">Jenis Layanan <span class="text-danger">*</span></label>
                                                            <select name="jenis_layanan" class="form-select" required>
                                                                @foreach($jenisLabels as $key => $label)
                                                                    <option value="{{ $key }}" @selected($mitra->jenis_layanan === $key)>{{ $label }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label class="form-label">No. Telepon / Hotline Kontak</label>
                                                            <input type="text" name="kontak" class="form-control" value="{{ $mitra->kontak }}" placeholder="Contoh: 0812-3456-7890 / (021) 123456">
                                                        </div>

                                                        <div class="mb-3">
                                                            <label class="form-label">Alamat / Website / Tautan URL</label>
                                                            <textarea name="alamat_url" class="form-control" rows="3" placeholder="Alamat fisik instansi atau tautan portal rujukan">{{ $mitra->alamat_url }}</textarea>
                                                        </div>

                                                        <div class="form-check form-switch mt-2">
                                                            <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active_edit_{{ $mitra->id }}" @checked($mitra->is_active)>
                                                            <label class="form-check-label" for="is_active_edit_{{ $mitra->id }}" style="font-size: 12px; font-weight: 600;">
                                                                Status Aktif (dapat dipilih Guru BK)
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer" style="border-top: 1px solid var(--ca-line); padding: 14px 22px;">
                                                        <button type="button" class="btn-reset" data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn-filter" style="min-width: 130px;">Simpan Perubahan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-5 text-muted">
                                            <i class="bi bi-inbox fs-2 d-block mb-2 text-secondary"></i>
                                            <div>Belum ada data mitra rujukan yang sesuai kriteria pencarian.</div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($mitraList->hasPages())
                        <div class="p-3 border-top d-flex justify-content-end">
                            {{ $mitraList->links() }}
                        </div>
                    @endif
                </section>

            </div>
        </div>
    </main>

</div>

{{-- Modal Tambah Mitra Baru --}}
<div class="modal fade" id="tambahMitraModal" tabindex="-1" aria-labelledby="tambahMitraModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 12px; border: 1px solid var(--ca-border);">
            <form method="POST" action="{{ route('admin.mitra-rujukan.store') }}">
                @csrf
                <div class="modal-header" style="border-bottom: 1px solid var(--ca-line); padding: 18px 22px;">
                    <h5 class="modal-title fw-bold" id="tambahMitraModalLabel" style="font-size: 15px; color: var(--ca-text);">
                        <i class="bi bi-plus-circle text-primary me-2"></i>Tambah Mitra Rujukan Baru
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="padding: 20px 22px;">
                    <div class="mb-3">
                        <label class="form-label">Nama Lembaga / Mitra Rekanan <span class="text-danger">*</span></label>
                        <input type="text" name="nama_layanan" class="form-control" placeholder="Contoh: Puskesmas Kebayoran Baru, RSJ Bina Sehat" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Jenis Layanan <span class="text-danger">*</span></label>
                        <select name="jenis_layanan" class="form-select" required>
                            <option value="">-- Pilih Jenis Layanan --</option>
                            @foreach($jenisLabels as $key => $label)
                                <option value="{{ $key }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">No. Telepon / Hotline Kontak</label>
                        <input type="text" name="kontak" class="form-control" placeholder="Contoh: 0812-3456-7890 / 119 ext 8">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Alamat Fisik / Website / URL Tautan</label>
                        <textarea name="alamat_url" class="form-control" rows="3" placeholder="Masukkan alamat lengkap atau link website rujukan"></textarea>
                    </div>

                    <div class="form-check form-switch mt-2">
                        <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active_create" checked>
                        <label class="form-check-label" for="is_active_create" style="font-size: 12px; font-weight: 600;">
                            Status Aktif Langsung
                        </label>
                    </div>
                </div>
                <div class="modal-footer" style="border-top: 1px solid var(--ca-line); padding: 14px 22px;">
                    <button type="button" class="btn-reset" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn-filter" style="min-width: 130px;">Simpan Mitra</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const openSidebarButton = document.getElementById('openSidebarButton');
    const adminSidebar = document.getElementById('adminSidebar');
    const sidebarOverlay = document.getElementById('sidebarOverlay');

    if (openSidebarButton && adminSidebar && sidebarOverlay) {
        openSidebarButton.addEventListener('click', () => {
            adminSidebar.classList.add('show');
            sidebarOverlay.classList.add('show');
        });

        sidebarOverlay.addEventListener('click', () => {
            adminSidebar.classList.remove('show');
            sidebarOverlay.classList.remove('show');
        });
    }
</script>
</body>
</html>
