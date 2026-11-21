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

    <title>Kategori Kasus | CurhatAman</title>

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
            grid-template-columns: minmax(230px, 1fr) 180px auto;
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

        .kategori-name {
            color: var(--ca-text);
            font-weight: 680;
            font-size: 13px;
        }

        .slug-chip {
            display: inline-flex;
            align-items: center;
            padding: 2px 7px;
            border-radius: 5px;
            font-size: 10.5px;
            font-family: monospace;
            color: var(--ca-primary-dark);
            background: var(--ca-primary-soft);
            margin-top: 3px;
        }

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
                <div class="topbar-title">Kategori Kasus</div>
                <div class="topbar-subtitle">
                    Klasifikasi jenis perundungan dan masalah perilaku siswa
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

                        <h1 class="page-title">Master Kategori Kasus</h1>

                        <p class="page-copy">
                            Kelola kategori perundungan, pelanggaran, atau masalah siswa pada CurhatAman.
                            Kategori aktif otomatis tersedia saat siswa melapor dan saat Guru BK mengklasifikasikan kasus.
                        </p>
                    </div>

                    <button
                        type="button"
                        class="btn-primary-ca"
                        data-bs-toggle="modal"
                        data-bs-target="#tambahKategoriModal"
                    >
                        <i class="bi bi-plus-lg"></i>
                        Tambah Kategori
                    </button>
                </section>

                <section class="row g-3 mb-3">
                    <div class="col-6 col-md-3">
                        <div class="summary-card total">
                            <div class="summary-label">Total Kategori</div>
                            <div class="summary-value">{{ $ringkasan['total'] }}</div>
                        </div>
                    </div>

                    <div class="col-6 col-md-3">
                        <div class="summary-card active">
                            <div class="summary-label">Kategori Aktif</div>
                            <div class="summary-value">{{ $ringkasan['aktif'] }}</div>
                        </div>
                    </div>

                    <div class="col-6 col-md-3">
                        <div class="summary-card unassigned">
                            <div class="summary-label">Kategori Nonaktif</div>
                            <div class="summary-value">{{ $ringkasan['nonaktif'] }}</div>
                        </div>
                    </div>

                    <div class="col-6 col-md-3">
                        <div class="summary-card students">
                            <div class="summary-label">Total Laporan Terdata</div>
                            <div class="summary-value">{{ $ringkasan['total_laporan'] }}</div>
                        </div>
                    </div>
                </section>

                <section class="panel">
                    <form
                        method="GET"
                        action="{{ route('admin.kategori-kasus.index') }}"
                        class="filter-bar"
                    >
                        <div>
                            <label class="form-label">Cari Kategori</label>
                            <input
                                type="text"
                                name="q"
                                value="{{ $search }}"
                                class="form-control"
                                placeholder="Nama kategori, slug, deskripsi..."
                            >
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
                                href="{{ route('admin.kategori-kasus.index') }}"
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
                                    <th>Nama Kategori & Slug</th>
                                    <th>Deskripsi / Panduan</th>
                                    <th class="text-center">Laporan Kasus</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-end">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($kategoriList as $kategori)
                                    <tr>
                                        <td>
                                            <div class="kategori-name">{{ $kategori->nama_kategori }}</div>
                                            <span class="slug-chip">#{{ $kategori->slug }}</span>
                                        </td>

                                        <td>
                                            @if($kategori->deskripsi)
                                                <div style="max-width: 440px; color: #475467; font-size: 11.5px; line-height: 1.5;">
                                                    {{ $kategori->deskripsi }}
                                                </div>
                                            @else
                                                <span class="text-muted fst-italic">Belum ada deskripsi</span>
                                            @endif
                                        </td>

                                        <td class="text-center">
                                            <span class="badge bg-light text-dark border px-2 py-1" style="font-size: 11px; font-weight: 600;">
                                                {{ $kategori->total_laporan }} kasus
                                            </span>
                                        </td>

                                        <td class="text-center">
                                            @if($kategori->is_active)
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
                                                    data-bs-target="#editKategoriModal{{ $kategori->id }}"
                                                    title="Ubah Kategori"
                                                >
                                                    <i class="bi bi-pencil"></i>
                                                </button>

                                                {{-- Tombol Toggle Status --}}
                                                <form
                                                    method="POST"
                                                    action="{{ route('admin.kategori-kasus.toggle-status', $kategori->id) }}"
                                                    class="d-inline m-0"
                                                >
                                                    @csrf
                                                    @method('PATCH')
                                                    <button
                                                        type="submit"
                                                        class="btn-action"
                                                        title="{{ $kategori->is_active ? 'Nonaktifkan Kategori' : 'Aktifkan Kategori' }}"
                                                    >
                                                        <i class="bi {{ $kategori->is_active ? 'bi-toggle-on text-success fs-6' : 'bi-toggle-off text-muted fs-6' }}"></i>
                                                    </button>
                                                </form>

                                                {{-- Tombol Hapus --}}
                                                <form
                                                    method="POST"
                                                    action="{{ route('admin.kategori-kasus.destroy', $kategori->id) }}"
                                                    class="d-inline m-0"
                                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori {{ addslashes($kategori->nama_kategori) }}?');"
                                                >
                                                    @csrf
                                                    @method('DELETE')
                                                    <button
                                                        type="submit"
                                                        class="btn-action btn-danger-action"
                                                        title="Hapus Kategori"
                                                    >
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>

                                    {{-- Modal Edit Kategori --}}
                                    <div class="modal fade" id="editKategoriModal{{ $kategori->id }}" tabindex="-1" aria-labelledby="editKategoriModalLabel{{ $kategori->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content" style="border-radius: 12px; border: 1px solid var(--ca-border);">
                                                <form method="POST" action="{{ route('admin.kategori-kasus.update', $kategori->id) }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-header" style="border-bottom: 1px solid var(--ca-line); padding: 18px 22px;">
                                                        <h5 class="modal-title fw-bold" id="editKategoriModalLabel{{ $kategori->id }}" style="font-size: 15px; color: var(--ca-text);">
                                                            <i class="bi bi-pencil-square text-primary me-2"></i>Ubah Kategori Kasus
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body" style="padding: 20px 22px;">
                                                        <div class="mb-3">
                                                            <label class="form-label">Nama Kategori <span class="text-danger">*</span></label>
                                                            <input type="text" name="nama_kategori" class="form-control" value="{{ $kategori->nama_kategori }}" required>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label class="form-label">Slug Pengenal</label>
                                                            <input type="text" name="slug" class="form-control" value="{{ $kategori->slug }}" placeholder="Otomatis dari nama jika dikosongkan">
                                                            <div class="form-text text-muted" style="font-size: 11px;">Huruf kecil, angka, dan tanda hubung (-).</div>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label class="form-label">Deskripsi / Panduan Indikator</label>
                                                            <textarea name="deskripsi" class="form-control" rows="3" placeholder="Jelaskan ruang lingkup perilaku yang masuk ke kategori ini">{{ $kategori->deskripsi }}</textarea>
                                                        </div>

                                                        <div class="form-check form-switch mt-2">
                                                            <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active_cat_{{ $kategori->id }}" @checked($kategori->is_active)>
                                                            <label class="form-check-label" for="is_active_cat_{{ $kategori->id }}" style="font-size: 12px; font-weight: 600;">
                                                                Status Aktif (dapat dipilih pada formulir laporan)
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
                                        <td colspan="5" class="text-center py-5 text-muted">
                                            <i class="bi bi-inbox fs-2 d-block mb-2 text-secondary"></i>
                                            <div>Belum ada data kategori kasus yang sesuai kriteria pencarian.</div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($kategoriList->hasPages())
                        <div class="p-3 border-top d-flex justify-content-end">
                            {{ $kategoriList->links() }}
                        </div>
                    @endif
                </section>

            </div>
        </div>
    </main>

</div>

{{-- Modal Tambah Kategori Baru --}}
<div class="modal fade" id="tambahKategoriModal" tabindex="-1" aria-labelledby="tambahKategoriModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 12px; border: 1px solid var(--ca-border);">
            <form method="POST" action="{{ route('admin.kategori-kasus.store') }}">
                @csrf
                <div class="modal-header" style="border-bottom: 1px solid var(--ca-line); padding: 18px 22px;">
                    <h5 class="modal-title fw-bold" id="tambahKategoriModalLabel" style="font-size: 15px; color: var(--ca-text);">
                        <i class="bi bi-plus-circle text-primary me-2"></i>Tambah Kategori Kasus Baru
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="padding: 20px 22px;">
                    <div class="mb-3">
                        <label class="form-label">Nama Kategori Kasus <span class="text-danger">*</span></label>
                        <input type="text" name="nama_kategori" class="form-control" placeholder="Contoh: Pemalakan / Pemerasan, Kecanduan Game" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Slug Pengenal (Opsional)</label>
                        <input type="text" name="slug" class="form-control" placeholder="Contoh: pemalakan-pemerasan (otomatis jika dikosongkan)">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Deskripsi / Panduan Perilaku</label>
                        <textarea name="deskripsi" class="form-control" rows="3" placeholder="Penjelasan atau contoh perilaku yang tergolong dalam kategori ini"></textarea>
                    </div>

                    <div class="form-check form-switch mt-2">
                        <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active_cat_create" checked>
                        <label class="form-check-label" for="is_active_cat_create" style="font-size: 12px; font-weight: 600;">
                            Status Aktif Langsung
                        </label>
                    </div>
                </div>
                <div class="modal-footer" style="border-top: 1px solid var(--ca-line); padding: 14px 22px;">
                    <button type="button" class="btn-reset" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn-filter" style="min-width: 130px;">Simpan Kategori</button>
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
