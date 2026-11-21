@php
    $errors = $errors ?? new \Illuminate\Support\ViewErrorBag();
@endphp
<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Pengaturan Sistem | CurhatAman
    </title>

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
            --ca-warning: #9a650f;
            --ca-warning-soft: #fff7e8;
            --ca-danger: #b42318;
            --ca-danger-soft: #fff1f0;
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
            max-width: 1100px;
            margin: 0 auto;
        }

        .page-header {
            margin-bottom: 22px;
            padding: 21px 22px;
            border-radius: 12px;
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
            max-width: 780px;
            margin: 7px 0 0;
            color: rgba(255, 255, 255, .82);
            font-size: 12.5px;
            line-height: 1.65;
        }

        .alert-success-ca {
            margin-bottom: 17px;
            padding: 12px 14px;
            border: 1px solid #cde8db;
            border-radius: 9px;
            display: flex;
            align-items: center;
            gap: 7px;
            color: var(--ca-success);
            background: var(--ca-success-soft);
            font-size: 11.5px;
            font-weight: 600;
        }

        .settings-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 18px;
        }

        .settings-card {
            border: 1px solid var(--ca-border);
            border-top: 3px solid var(--ca-primary);
            border-radius: 12px;
            background: #ffffff;
            overflow: hidden;
        }

        .settings-card.school {
            border-top-color: var(--ca-primary);
        }

        .settings-card.academic {
            border-top-color: #4f8fb8;
        }

        .settings-card.monitoring {
            border-top-color: #d99a2b;
        }

        .settings-card.notifications {
            border-top-color: #35a36f;
        }

        .settings-card.full {
            grid-column: 1 / -1;
        }

        .settings-card-header {
            padding: 17px 19px;
            border-bottom: 1px solid var(--ca-line);
            display: flex;
            align-items: flex-start;
            gap: 11px;
            background: #ffffff;
        }

        .settings-icon {
            width: 36px;
            height: 36px;
            flex: 0 0 36px;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--ca-primary-dark);
            background: var(--ca-primary-soft);
            font-size: 15px;
        }

        .settings-card.academic .settings-icon {
            color: var(--ca-info);
            background: var(--ca-info-soft);
        }

        .settings-card.monitoring .settings-icon {
            color: var(--ca-warning);
            background: var(--ca-warning-soft);
        }

        .settings-card.notifications .settings-icon {
            color: var(--ca-success);
            background: var(--ca-success-soft);
        }

        .settings-card-title {
            margin: 0;
            color: var(--ca-text);
            font-size: 13.5px;
            font-weight: 710;
        }

        .settings-card-copy {
            margin: 4px 0 0;
            color: var(--ca-muted);
            font-size: 10.5px;
            line-height: 1.5;
        }

        .settings-card-body {
            padding: 18px 19px;
        }

        .form-label {
            margin-bottom: 6px;
            color: #475467;
            font-size: 10.5px;
            font-weight: 650;
        }

        .form-control,
        .form-select {
            min-height: 42px;
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

        .input-group-text {
            border-color: #d9e1e1;
            color: var(--ca-muted);
            background: #f8fafb;
            font-size: 11px;
        }

        .form-help {
            margin-top: 6px;
            color: var(--ca-muted-light);
            font-size: 10px;
            line-height: 1.5;
        }

        .setting-toggle-row {
            padding: 13px 0;
            border-bottom: 1px solid var(--ca-line);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .setting-toggle-row:first-child {
            padding-top: 0;
        }

        .setting-toggle-row:last-child {
            padding-bottom: 0;
            border-bottom: 0;
        }

        .toggle-title {
            color: #344054;
            font-size: 11.5px;
            font-weight: 650;
        }

        .toggle-copy {
            margin-top: 3px;
            color: var(--ca-muted);
            font-size: 10px;
            line-height: 1.5;
        }

        .form-check-input {
            width: 2.4em;
            height: 1.25em;
            cursor: pointer;
            box-shadow: none;
        }

        .form-check-input:focus {
            border-color: rgba(15, 138, 131, .55);
            box-shadow: 0 0 0 .2rem rgba(15, 138, 131, .08);
        }

        .form-check-input:checked {
            background-color: var(--ca-primary);
            border-color: var(--ca-primary);
        }

        .settings-actions {
            margin-top: 18px;
            padding: 16px 19px;
            border: 1px solid var(--ca-border);
            border-top: 3px solid var(--ca-primary);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            background: #ffffff;
        }

        .save-copy-title {
            color: #344054;
            font-size: 11px;
            font-weight: 680;
        }

        .save-copy-text {
            margin-top: 3px;
            color: var(--ca-muted);
            font-size: 10px;
        }

        .btn-save {
            min-height: 40px;
            padding: 0 15px;
            border: 1px solid var(--ca-primary);
            border-radius: 9px;
            display: inline-flex;
            align-items: center;
            gap: 7px;
            color: #ffffff;
            background: var(--ca-primary);
            font-size: 11.5px;
            font-weight: 680;
        }

        .btn-save:hover,
        .btn-save:focus {
            color: #ffffff;
            background: var(--ca-primary-dark);
            border-color: var(--ca-primary-dark);
        }

        .page-footer {
            min-height: 64px;
            margin-top: 28px;
            padding: 0 18px;
            border-radius: 11px;
            display: flex;
            align-items: center;
            color: rgba(255, 255, 255, .78);
            background: var(--ca-primary-dark);
            font-size: 10.5px;
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

            .settings-grid {
                grid-template-columns: 1fr;
            }

            .settings-card.full {
                grid-column: auto;
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

            .settings-actions {
                align-items: flex-start;
                flex-direction: column;
            }

            .btn-save {
                width: 100%;
                justify-content: center;
            }

            .setting-toggle-row {
                align-items: flex-start;
            }
        }
    </style>

    @include('admin.partials.styles')
</head>

<body>

@php

    $namaUser =
        $user->name;

    $inisial =
        collect(
            explode(
                ' ',
                trim(
                    $namaUser
                )
            )
        )
        ->filter()
        ->take(2)
        ->map(
            fn ($bagian) =>
                mb_strtoupper(
                    mb_substr(
                        $bagian,
                        0,
                        1
                    )
                )
        )
        ->implode('');

@endphp

<div class="app-shell">

    @include(
        'admin.partials.sidebar'
    )

    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <header class="topbar">

        <div class="topbar-left">

            <button type="button" class="mobile-sidebar-button" id="openSidebarButton" aria-label="Buka menu">
                <i class="bi bi-list"></i>
            </button>

            <div>

                <div class="topbar-title">
                Pengaturan Sistem
            </div>

            <div class="topbar-subtitle">
                Konfigurasi umum CurhatAman
            </div>

            </div>

        </div>

        <div class="topbar-actions">

            @include(
                'admin.partials.notification-bell'
            )

            <div class="date-chip">

                <i class="bi bi-calendar3"></i>

                {{
                    now()
                        ->locale('id')
                        ->translatedFormat(
                            'd F Y'
                        )
                }}

            </div>

            <a
                href="{{
                    route(
                        'admin.profil.index'
                    )
                }}"

                class="account-trigger"

                title="Buka Profil Admin"
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

                <i
                    class="
                        bi
                        bi-chevron-right
                        account-chevron
                    "
                ></i>

            </a>

        </div>

    </header>

    <main class="main-content">

        <div class="page-body">

            <div class="content-shell">

                @if(
                    session(
                        'success'
                    )
                )

                    <div class="alert-success-ca">

                        <i
                            class="
                                bi
                                bi-check-circle
                                me-1
                            "
                        ></i>

                        {{
                            session(
                                'success'
                            )
                        }}

                    </div>

                @endif

                <section class="page-header">
                    <div>

                    <div class="page-kicker">
                        Konfigurasi Sistem
                    </div>

                    <h1 class="page-title">
                        Pengaturan Sistem
                    </h1>

                    <p class="page-copy">

                        Kelola pengaturan umum yang berlaku
                        pada CurhatAman. Perubahan pada halaman
                        ini memengaruhi perilaku sistem secara
                        global dan hanya dapat dilakukan oleh
                        Admin sekolah.

                    </p>

                    </div>

                    <div class="scope-badge">
                        <i class="bi bi-gear-wide-connected"></i>
                        Konfigurasi Global
                    </div>
                </section>

                <form
                    method="POST"
                    action="{{ route('admin.pengaturan-sistem.update') }}"
                    enctype="multipart/form-data"
                >
                    @csrf
                    @method('PUT')

                    <div class="settings-grid">

                        <section class="settings-card school full">
                            <div class="settings-card-header">
                                <span class="settings-icon">
                                    <i class="bi bi-building"></i>
                                </span>
                                <div>
                                    <h2 class="settings-card-title">
                                        Identitas Resmi Sekolah & Kop Dokumen
                                    </h2>
                                    <p class="settings-card-copy">
                                        Informasi profil dan logo ini otomatis dicetak pada Kop Surat Resmi seluruh dokumen PDF (Surat Rujukan, Rekap Konseling, Berkas Kasus, dan Laporan Kebijakan).
                                    </p>
                                </div>
                            </div>

                            <div class="settings-card-body">
                                <div class="row g-4">
                                    <!-- Logo Sekolah -->
                                    <div class="col-12 col-md-4">
                                        <label class="form-label d-block fw-semibold mb-2">
                                            Logo Resmi Sekolah
                                        </label>
                                        <div class="p-3 border rounded-3 bg-light text-center">
                                            @if($pengaturan->logo_url)
                                                <div class="mb-2 p-2 bg-white rounded border d-inline-block shadow-sm">
                                                    <img src="{{ $pengaturan->logo_url }}" alt="Logo Sekolah" style="max-height: 85px; max-width: 140px; object-fit: contain;" class="d-block mx-auto">
                                                </div>
                                                <div class="form-check form-check-inline d-block mt-1">
                                                    <input class="form-check-input" type="checkbox" name="hapus_logo" id="hapus_logo" value="1">
                                                    <label class="form-check-label text-danger small fw-semibold" for="hapus_logo">
                                                        <i class="bi bi-trash"></i> Hapus Logo Saat Ini
                                                    </label>
                                                </div>
                                            @else
                                                <div class="d-flex align-items-center justify-content-center mx-auto mb-2 text-muted" style="width: 72px; height: 72px; border-radius: 50%; background: #e2e8f0; font-size: 28px;">
                                                    <i class="bi bi-image"></i>
                                                </div>
                                                <span class="text-muted small d-block mb-2">Belum ada logo terunggah</span>
                                            @endif
                                            <input type="file" name="logo_sekolah" id="logo_sekolah" class="form-control form-control-sm mt-2 @error('logo_sekolah') is-invalid @enderror" accept="image/png,image/jpeg,image/jpg,image/svg+xml,image/webp">
                                            @error('logo_sekolah')
                                                <div class="invalid-feedback text-start">{{ $message }}</div>
                                            @enderror
                                            <div class="form-help text-start mt-2" style="font-size: 11px;">
                                                Format: PNG, JPG, WebP, SVG. Maks 2MB. Disarankan berlatar transparan.
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Data Lembaga Sekolah -->
                                    <div class="col-12 col-md-8">
                                        <div class="row g-3">
                                            <div class="col-12">
                                                <label for="nama_sekolah" class="form-label">Nama Resmi Sekolah</label>
                                                <input type="text" id="nama_sekolah" name="nama_sekolah" value="{{ old('nama_sekolah', $pengaturan->nama_sekolah) }}" class="form-control @error('nama_sekolah') is-invalid @enderror" placeholder="Contoh: SMA Negeri 1 CurhatAman">
                                                @error('nama_sekolah') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                            </div>
                                            <div class="col-12 col-sm-6">
                                                <label for="npsn" class="form-label">NPSN (Nomor Pokok Sekolah Nasional)</label>
                                                <input type="text" id="npsn" name="npsn" value="{{ old('npsn', $pengaturan->npsn) }}" class="form-control @error('npsn') is-invalid @enderror" placeholder="Contoh: 20101234">
                                                @error('npsn') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                            </div>
                                            <div class="col-12 col-sm-6">
                                                <label for="akreditasi" class="form-label">Status Akreditasi</label>
                                                <input type="text" id="akreditasi" name="akreditasi" value="{{ old('akreditasi', $pengaturan->akreditasi) }}" class="form-control @error('akreditasi') is-invalid @enderror" placeholder="Contoh: A (Unggul)">
                                                @error('akreditasi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                            </div>
                                            <div class="col-12">
                                                <label for="alamat_sekolah" class="form-label">Alamat Lengkap Sekolah & Kode Pos</label>
                                                <textarea id="alamat_sekolah" name="alamat_sekolah" rows="2" class="form-control @error('alamat_sekolah') is-invalid @enderror" placeholder="Contoh: Jl. Budi Utomo No. 7, Pasar Baru, Sawah Besar, Jakarta Pusat, DKI Jakarta 10710">{{ old('alamat_sekolah', $pengaturan->alamat_sekolah) }}</textarea>
                                                @error('alamat_sekolah') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Kontak & Kanal Komunikasi -->
                                    <div class="col-12 col-md-4">
                                        <label for="telepon_sekolah" class="form-label">Nomor Telepon / Fax</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                                            <input type="text" id="telepon_sekolah" name="telepon_sekolah" value="{{ old('telepon_sekolah', $pengaturan->telepon_sekolah) }}" class="form-control @error('telepon_sekolah') is-invalid @enderror" placeholder="(021) 3841234">
                                        </div>
                                        @error('telepon_sekolah') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label for="email_sekolah" class="form-label">Email Resmi Sekolah</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                            <input type="email" id="email_sekolah" name="email_sekolah" value="{{ old('email_sekolah', $pengaturan->email_sekolah) }}" class="form-control @error('email_sekolah') is-invalid @enderror" placeholder="info@sekolah.sch.id">
                                        </div>
                                        @error('email_sekolah') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label for="website_sekolah" class="form-label">Website Sekolah</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-globe"></i></span>
                                            <input type="text" id="website_sekolah" name="website_sekolah" value="{{ old('website_sekolah', $pengaturan->website_sekolah) }}" class="form-control @error('website_sekolah') is-invalid @enderror" placeholder="www.sekolah.sch.id">
                                        </div>
                                        @error('website_sekolah') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                                    </div>

                                    <!-- Pejabat Kepala Sekolah (Tanda Tangan Dokumen) -->
                                    <div class="col-12 col-md-6">
                                        <label for="kepala_sekolah_nama" class="form-label">Nama Kepala Sekolah (Beserta Gelar)</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-person-badge"></i></span>
                                            <input type="text" id="kepala_sekolah_nama" name="kepala_sekolah_nama" value="{{ old('kepala_sekolah_nama', $pengaturan->kepala_sekolah_nama) }}" class="form-control @error('kepala_sekolah_nama') is-invalid @enderror" placeholder="Contoh: Drs. H. Ahmad Fauzi, M.Pd.">
                                        </div>
                                        @error('kepala_sekolah_nama') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                                        <div class="form-help">Nama pejabat yang bertanda tangan pada Laporan Kebijakan dan dokumen resmi.</div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label for="kepala_sekolah_nip" class="form-label">NIP Kepala Sekolah</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-card-text"></i></span>
                                            <input type="text" id="kepala_sekolah_nip" name="kepala_sekolah_nip" value="{{ old('kepala_sekolah_nip', $pengaturan->kepala_sekolah_nip) }}" class="form-control @error('kepala_sekolah_nip') is-invalid @enderror" placeholder="Contoh: 19720514 199802 1 002">
                                        </div>
                                        @error('kepala_sekolah_nip') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                                        <div class="form-help">Nomor Induk Pegawai Kepala Sekolah. Kosongkan bila bukan ASN.</div>
                                    </div>
                                </div>
                            </div>
                        </section>

                        

                        <section class="settings-card academic">

                            <div class="settings-card-header">

                                <span class="settings-icon">
                                    <i class="bi bi-calendar3"></i>
                                </span>

                                <div>

                                    <h2 class="settings-card-title">
                                        Akademik
                                    </h2>

                                    <p class="settings-card-copy">
                                        Tentukan tahun ajaran dan semester aktif.
                                    </p>

                                </div>

                            </div>

                            <div class="settings-card-body">

                                <label
                                    for="tahun_ajaran_aktif"
                                    class="form-label"
                                >
                                    Tahun Ajaran Aktif
                                </label>

                                <input
                                    type="text"
                                    id="tahun_ajaran_aktif"
                                    name="tahun_ajaran_aktif"
                                    value="{{ old('tahun_ajaran_aktif', $pengaturan->tahun_ajaran_aktif) }}"
                                    class="form-control @error('tahun_ajaran_aktif') is-invalid @enderror"
                                    placeholder="2026/2027"
                                    maxlength="9"
                                    required
                                >

                                @error('tahun_ajaran_aktif')

                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>

                                @enderror

                                <div class="form-help">
                                    Digunakan sebagai tahun ajaran bawaan ketika Admin membuat kelas baru.
                                </div>

                                <div class="mt-3">

                                    <label
                                        for="semester_aktif"
                                        class="form-label"
                                    >
                                        Semester Aktif
                                    </label>

                                    <select
                                        id="semester_aktif"
                                        name="semester_aktif"
                                        class="form-select @error('semester_aktif') is-invalid @enderror"
                                        required
                                    >

                                        <option
                                            value="ganjil"
                                            @selected(old('semester_aktif', $pengaturan->semester_aktif) === 'ganjil')
                                        >
                                            Ganjil
                                        </option>

                                        <option
                                            value="genap"
                                            @selected(old('semester_aktif', $pengaturan->semester_aktif) === 'genap')
                                        >
                                            Genap
                                        </option>

                                    </select>

                                    @error('semester_aktif')

                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>

                                    @enderror

                                    <div class="form-help">
                                        Semester aktif digunakan sebagai konfigurasi akademik global CurhatAman.
                                    </div>

                                </div>

                            </div>

                        </section>

                        

                        <section class="settings-card monitoring">

                            <div class="settings-card-header">

                                <span class="settings-icon">
                                    <i class="bi bi-hourglass-split"></i>
                                </span>

                                <div>

                                    <h2 class="settings-card-title">
                                        Pengawasan Kasus
                                    </h2>

                                    <p class="settings-card-copy">
                                        Tentukan batas kasus
                                        dianggap mangkrak.
                                    </p>

                                </div>

                            </div>

                            <div class="settings-card-body">

                                <label
                                    for="batas_kasus_mangkrak"
                                    class="form-label"
                                >
                                    Batas Kasus Mangkrak
                                </label>

                                <div class="input-group">

                                    <input
                                        type="number"

                                        id="batas_kasus_mangkrak"
                                        name="batas_kasus_mangkrak"

                                        value="{{
                                            old(
                                                'batas_kasus_mangkrak',
                                                $pengaturan
                                                    ->batas_kasus_mangkrak
                                            )
                                        }}"

                                        min="1"
                                        max="365"

                                        class="
                                            form-control

                                            @error(
                                                'batas_kasus_mangkrak'
                                            )
                                                is-invalid
                                            @enderror
                                        "

                                        required
                                    >

                                    <span class="input-group-text">
                                        hari
                                    </span>

                                    @error(
                                        'batas_kasus_mangkrak'
                                    )

                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>

                                    @enderror

                                </div>

                                <div class="form-help">

                                    Kasus aktif yang tidak
                                    diperbarui selama batas waktu
                                    ini akan masuk ke pengawasan
                                    Kasus Mangkrak.

                                </div>

                            </div>

                        </section>

                        

                        <section class="settings-card notifications">

                            <div class="settings-card-header">

                                <span class="settings-icon">
                                    <i class="bi bi-bell"></i>
                                </span>

                                <div>

                                    <h2 class="settings-card-title">
                                        Notifikasi Admin
                                    </h2>

                                    <p class="settings-card-copy">
                                        Tentukan pemberitahuan yang
                                        diterima Kepala Sekolah.
                                    </p>

                                </div>

                            </div>

                            <div class="settings-card-body">

                                <div class="setting-toggle-row">

                                    <div>

                                        <div class="toggle-title">
                                            Kasus Dieskalasi
                                        </div>

                                        <div class="toggle-copy">

                                            Beri tahu Admin ketika
                                            terdapat kasus yang
                                            dieskalasi.

                                        </div>

                                    </div>

                                    <div
                                        class="
                                            form-check
                                            form-switch
                                        "
                                    >

                                        <input
                                            type="hidden"

                                            name="notifikasi_kasus_dieskalasi"

                                            value="0"
                                        >

                                        <input
                                            type="checkbox"

                                            class="
                                                form-check-input
                                            "

                                            name="notifikasi_kasus_dieskalasi"

                                            value="1"

                                            @checked(
                                                old(
                                                    'notifikasi_kasus_dieskalasi',
                                                    $pengaturan
                                                        ->notifikasi_kasus_dieskalasi
                                                )
                                            )
                                        >

                                    </div>

                                </div>

                                <div class="setting-toggle-row">

                                    <div>

                                        <div class="toggle-title">
                                            Kasus Mangkrak
                                        </div>

                                        <div class="toggle-copy">

                                            Beri tahu Admin ketika
                                            kasus melewati batas
                                            waktu pengawasan.

                                        </div>

                                    </div>

                                    <div
                                        class="
                                            form-check
                                            form-switch
                                        "
                                    >

                                        <input
                                            type="hidden"

                                            name="notifikasi_kasus_mangkrak"

                                            value="0"
                                        >

                                        <input
                                            type="checkbox"

                                            class="
                                                form-check-input
                                            "

                                            name="notifikasi_kasus_mangkrak"

                                            value="1"

                                            @checked(
                                                old(
                                                    'notifikasi_kasus_mangkrak',
                                                    $pengaturan
                                                        ->notifikasi_kasus_mangkrak
                                                )
                                            )
                                        >

                                    </div>

                                </div>

                            </div>

                        </section>

                    </div>

                    <section class="settings-actions">

                        <div>

                            <div class="save-copy-title">
                                Simpan perubahan sistem
                            </div>

                            <div class="save-copy-text">

                                Perubahan akan berlaku
                                setelah tombol Simpan
                                Pengaturan ditekan.

                            </div>

                        </div>

                        <button
                            type="submit"
                            class="btn-save"
                        >

                            <i class="bi bi-check2-circle"></i>

                            Simpan Pengaturan

                        </button>

                    </section>

                </form>

                <footer class="page-footer">
                    <div class="d-flex flex-column flex-md-row justify-content-between gap-2 w-100">
                        <span>© {{ date('Y') }} CurhatAman</span>
                        <span>Portal Admin Sekolah · Konfigurasi sistem</span>
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

</body>

</html>