<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Buat Rujukan - Guru BK - CurhatAman</title>

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
    </style>
    @include('guru-bk.partials.styles')
</head>

<body>

@php
    $namaUser = ucwords($user->name);
    $inisial = strtoupper(substr($user->name, 0, 1));

    $presetSumberType = old('sumber_type', request('sumber_type', ''));
    $presetSumberId = (string) old('sumber_id', request('sumber_id', ''));
    $presetSiswaId = (string) old('siswa_id', request('siswa_id', ''));

    if ($presetSiswaId === '' && $presetSumberId !== '') {
        if ($presetSumberType === 'skrining') {
            $presetSumber = $skrining->first(
                fn ($item) => (string) $item->id === $presetSumberId
            );

            $presetSiswaId = $presetSumber
                ? (string) $presetSumber->siswa_id
                : '';
        }

        if ($presetSumberType === 'laporan') {
            $presetSumber = $laporan->first(
                fn ($item) => (string) $item->id === $presetSumberId
            );

            $presetSiswaId = $presetSumber
                ? (string) $presetSumber->siswa_id
                : '';
        }
    }

    $prefillDariSkrining = $presetSumberType === 'skrining'
        && $presetSumberId !== ''
        && $presetSiswaId !== '';

    $presetSiswa = $prefillDariSkrining
        ? $siswa->first(fn ($item) => (string) $item->id === $presetSiswaId)
        : null;

    $presetSkrining = $prefillDariSkrining
        ? $skrining->first(fn ($item) => (string) $item->id === $presetSumberId)
        : null;

    $kelasOptions = $siswa
        ->filter(fn ($item) => $item->kelas_id && $item->nama_kelas)
        ->unique('kelas_id')
        ->sortBy([
            ['tingkat', 'asc'],
            ['nama_kelas', 'asc'],
        ])
        ->values();

    $presetKelasId = (string) old('kelas_id', '');

    if ($presetKelasId === '' && $presetSiswaId !== '') {
        $presetSiswaUntukKelas = $siswa->first(
            fn ($item) => (string) $item->id === $presetSiswaId
        );

        $presetKelasId = $presetSiswaUntukKelas
            ? (string) $presetSiswaUntukKelas->kelas_id
            : '';
    }
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
                    Buat Rujukan
                </div>

                <div class="topbar-subtitle">
                    Buat rujukan eksternal.
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

                <div class="breadcrumb-ca">
                    <a href="{{ route('guru-bk.rujukan.index') }}">
                        Rujukan
                    </a>

                    <i class="bi bi-chevron-right"></i>

                    <span>Buat Rujukan</span>
                </div>

                <section class="page-header">
                    <div>
                        <div class="page-kicker">Pendampingan Lanjutan</div>
                        <h1 class="page-title">Buat Rujukan Siswa</h1>
                        <p class="page-copy">
                        Buat rujukan siswa ke layanan eksternal.
                    </p>
                    </div>
                </section>

                @if ($errors->any())
                    <div
                        class="alert alert-danger"
                        role="alert"
                    >
                        <div class="fw-semibold mb-1">
                            Data belum dapat disimpan.
                        </div>

                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if ($prefillDariSkrining)
                    <div class="prefill-card">
                        <i class="bi bi-clipboard2-check"></i>

                        <div>
                            <strong>Rujukan dari hasil skrining.</strong>
                            Siswa dan sumber skrining telah dipilih otomatis. Guru BK dapat melanjutkan dengan memilih layanan tujuan dan menuliskan alasan rujukan.
                        </div>
                    </div>
                @endif

                <form
                    method="POST"
                    action="{{ route('guru-bk.rujukan.store') }}"
                    class="form-card"
                >
                    @csrf

                    <section class="form-section">
                        <div class="section-heading">
                            <span class="section-icon">
                                <i class="bi bi-person-plus"></i>
                            </span>

                            <div>
                                <div class="section-title">Informasi Rujukan</div>
                                <div class="section-copy">
                                    Tentukan siswa yang dirujuk dan layanan tujuan pendampingan.
                                </div>
                            </div>
                        </div>

                    <div class="row g-3">

                        @if ($prefillDariSkrining && $presetSiswa)
                            <div class="col-md-6">
                                <label
                                    for="siswa_id"
                                    class="form-label"
                                >
                                    Siswa
                                    <span class="required">*</span>
                                </label>

                                <input
                                    type="hidden"
                                    id="siswa_id"
                                    name="siswa_id"
                                    value="{{ $presetSiswaId }}"
                                >

                                <div class="locked-field">
                                    <span class="locked-field-icon">
                                        <i class="bi bi-person-check"></i>
                                    </span>

                                    <span class="locked-field-copy">
                                        <span class="locked-field-value d-block">
                                            {{ $presetSiswa->name }}
                                        </span>

                                        <span class="locked-field-meta d-block">
                                            @if ($presetSiswa->nis)
                                                NIS {{ $presetSiswa->nis }}
                                            @endif

                                            @if ($presetSiswa->nis && $presetSiswa->nama_kelas)
                                                ·
                                            @endif

                                            @if ($presetSiswa->nama_kelas)
                                                {{ $presetSiswa->nama_kelas }}
                                            @endif
                                        </span>
                                    </span>
                                </div>
                            </div>
                        @else
                            <div class="col-md-4">
                                <label
                                    for="kelas_id"
                                    class="form-label"
                                >
                                    Kelas
                                    <span class="required">*</span>
                                </label>

                                <select
                                    class="form-select"
                                    id="kelas_id"
                                    name="kelas_id"
                                    required
                                >
                                    <option value="">
                                        Pilih kelas
                                    </option>

                                    @foreach ($kelasOptions as $kelasItem)
                                        <option
                                            value="{{ $kelasItem->kelas_id }}"
                                            @selected(
                                                $presetKelasId ===
                                                (string) $kelasItem->kelas_id
                                            )
                                        >
                                            {{ $kelasItem->nama_kelas }}
                                            @if ($kelasItem->tahun_ajaran)
                                                · {{ $kelasItem->tahun_ajaran }}
                                            @endif
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label
                                    for="siswa_id"
                                    class="form-label"
                                >
                                    Siswa
                                    <span class="required">*</span>
                                </label>

                                <select
                                    class="form-select"
                                    id="siswa_id"
                                    name="siswa_id"
                                    required
                                    disabled
                                >
                                    <option value="">
                                        Pilih kelas terlebih dahulu
                                    </option>
                                </select>

                                <div class="form-text">
                                    Daftar siswa otomatis menyesuaikan kelas yang dipilih.
                                </div>
                            </div>
                        @endif

                        <div class="{{ $prefillDariSkrining ? 'col-md-6' : 'col-md-4' }}">
                            <label
                                for="layanan_id"
                                class="form-label"
                            >
                                Layanan Tujuan
                                <span class="required">*</span>
                            </label>

                            <select
                                class="form-select"
                                id="layanan_id"
                                name="layanan_id"
                                required
                            >
                                <option value="">
                                    Pilih layanan rujukan
                                </option>

                                @foreach ($layanan as $item)
                                    <option
                                        value="{{ $item->id }}"
                                        @selected(
                                            (string) old('layanan_id') ===
                                            (string) $item->id
                                        )
                                    >
                                        {{ $item->nama_layanan }}
                                        ·
                                        {{ ucwords(
                                            str_replace(
                                                '_',
                                                ' ',
                                                $item->jenis_layanan
                                            )
                                        ) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                    </section>

                    <section class="form-section">
                        <div class="section-heading">
                            <span class="section-icon">
                                <i class="bi bi-link-45deg"></i>
                            </span>

                            <div>
                                <div class="section-title">Sumber Rujukan</div>
                                <div class="section-copy">
                                    Opsional. Gunakan apabila rujukan dibuat sebagai tindak lanjut dari laporan kasus atau skrining.
                                </div>
                            </div>
                        </div>

                    <div class="info-card mb-3">
                        <i class="bi bi-info-circle"></i>

                        <div>
                            Rujukan dari skrining hanya dapat dikaitkan pada
                            sesi yang berstatus selesai. Pengaitan ini tidak
                            berarti sistem memberikan diagnosis.
                        </div>
                    </div>

                    <div class="row g-3">

                        <div class="col-md-5">

                            <label
                                for="sumber_type"
                                class="form-label"
                            >
                                Jenis Sumber
                            </label>

                            @if ($prefillDariSkrining)
                                <input
                                    type="hidden"
                                    id="sumber_type"
                                    name="sumber_type"
                                    value="skrining"
                                >

                                <div class="locked-field">
                                    <span class="locked-field-icon">
                                        <i class="bi bi-clipboard2-pulse"></i>
                                    </span>

                                    <span class="locked-field-copy">
                                        <span class="locked-field-value d-block">
                                            Skrining Siswa
                                        </span>

                                        <span class="locked-field-meta d-block">
                                            Sumber ditentukan dari hasil skrining yang dibuka
                                        </span>
                                    </span>
                                </div>
                            @else
                                <select
                                    class="form-select"
                                    id="sumber_type"
                                    name="sumber_type"
                                >
                                    <option value="">
                                        Tanpa sumber khusus
                                    </option>

                                    <option
                                        value="laporan"
                                        @selected($presetSumberType === 'laporan')
                                    >
                                        Laporan Kasus
                                    </option>

                                    <option
                                        value="skrining"
                                        @selected($presetSumberType === 'skrining')
                                    >
                                        Skrining Siswa
                                    </option>
                                </select>
                            @endif

                        </div>

                        <div class="col-md-7">

                            <label
                                for="sumber_id"
                                class="form-label"
                            >
                                Data Sumber
                            </label>

                            @if ($prefillDariSkrining && $presetSkrining)
                                <input
                                    type="hidden"
                                    id="sumber_id"
                                    name="sumber_id"
                                    value="{{ $presetSumberId }}"
                                >

                                <div class="locked-field">
                                    <span class="locked-field-icon">
                                        <i class="bi bi-clipboard2-check"></i>
                                    </span>

                                    <span class="locked-field-copy">
                                        <span class="locked-field-value d-block">
                                            Skrining #{{ $presetSkrining->id }}
                                        </span>

                                        <span class="locked-field-meta d-block">
                                            @if ($presetSkrining->completed_at)
                                                Selesai {{ \Carbon\Carbon::parse($presetSkrining->completed_at)->locale('id')->translatedFormat('d M Y, H:i') }}
                                            @else
                                                Data skrining terpilih
                                            @endif
                                        </span>
                                    </span>
                                </div>
                            @else
                                <select
                                    class="form-select"
                                    id="sumber_id"
                                    name="sumber_id"
                                    disabled
                                >
                                    <option value="">
                                        Pilih siswa dan jenis sumber terlebih dahulu
                                    </option>
                                </select>

                                <div class="form-text">
                                    Daftar sumber otomatis menyesuaikan siswa yang dipilih.
                                </div>
                            @endif

                        </div>

                    </div>

                    </section>

                    <section class="form-section">
                        <div class="section-heading">
                            <span class="section-icon">
                                <i class="bi bi-journal-text"></i>
                            </span>

                            <div>
                                <div class="section-title">Alasan Rujukan</div>
                                <div class="section-copy">
                                    Jelaskan kebutuhan pendampingan lanjutan secara singkat, relevan, dan profesional.
                                </div>
                            </div>
                        </div>

                    <div>
                        <label
                            for="alasan_rujukan"
                            class="form-label"
                        >
                            Alasan
                            <span class="required">*</span>
                        </label>

                        <textarea
                            class="form-control"
                            id="alasan_rujukan"
                            name="alasan_rujukan"
                            maxlength="3000"
                            required
                            placeholder="Contoh: Siswa memerlukan pendampingan lanjutan yang berada di luar penanganan internal sekolah."
                        >{{ old('alasan_rujukan') }}</textarea>

                        <div class="form-text">
                            Minimal 10 karakter. Hindari menuliskan diagnosis
                            apabila tidak berasal dari tenaga profesional yang berwenang.
                        </div>
                    </div>

                    </section>

                    <div class="form-actions">
                        <a
                            href="{{ route('guru-bk.rujukan.index') }}"
                            class="btn-secondary-ca"
                        >
                            Batal
                        </a>

                        <button
                            type="submit"
                            class="btn-primary-ca"
                        >
                            <i class="bi bi-check2-circle"></i>
                            Simpan Rujukan
                        </button>
                    </div>
                </form>

                <footer class="page-footer">
                    <div
                        class="d-flex flex-column flex-md-row
                               justify-content-between gap-2"
                    >
                        <span>© {{ date('Y') }} CurhatAman</span>
                        <span>Portal Guru BK · Pendampingan dan rujukan siswa</span>
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

    const kelasSelect = document.getElementById('kelas_id');
    const siswaSelect = document.getElementById('siswa_id');
    const sumberTypeSelect = document.getElementById('sumber_type');
    const sumberIdSelect = document.getElementById('sumber_id');
    const isPresetSkrining = @json($prefillDariSkrining);

    @php
        $laporanData = $laporan->map(function ($item) {
            return [
                'id' => (string) $item->id,
                'siswa_id' => (string) $item->siswa_id,
                'label' => $item->kode_laporan
                    . ' · '
                    . ucfirst($item->status_kasus),
            ];
        })->values()->all();

        $skriningData = $skrining->map(function ($item) {
            return [
                'id' => (string) $item->id,
                'siswa_id' => (string) $item->siswa_id,
                'label' => 'Skrining #'
                    . $item->id
                    . (
                        $item->completed_at
                            ? ' · '
                                . \Carbon\Carbon::parse(
                                    $item->completed_at
                                )->format('d M Y')
                            : ''
                    ),
            ];
        })->values()->all();
    @endphp

    @php
        $siswaData = $siswa->map(function ($item) {
            return [
                'id' => (string) $item->id,
                'kelas_id' => (string) $item->kelas_id,
                'name' => $item->name,
                'nis' => $item->nis,
            ];
        })->values()->all();
    @endphp

    const oldSumberId = @json($presetSumberId);
    const oldSiswaId = @json($presetSiswaId);
    const siswaData = @json($siswaData);
    const laporanData = @json($laporanData);
    const skriningData = @json($skriningData);

    function renderSiswaOptions() {
        if (isPresetSkrining || !kelasSelect || !siswaSelect) {
            return;
        }

        const kelasId = kelasSelect.value;

        siswaSelect.innerHTML = '';

        if (!kelasId) {
            siswaSelect.disabled = true;

            const option = document.createElement('option');
            option.value = '';
            option.textContent = 'Pilih kelas terlebih dahulu';
            siswaSelect.appendChild(option);

            renderSumberOptions();
            return;
        }

        const filtered = siswaData.filter(
            item => item.kelas_id === kelasId
        );

        const placeholder = document.createElement('option');
        placeholder.value = '';
        placeholder.textContent = filtered.length
            ? 'Pilih siswa'
            : 'Tidak ada siswa aktif pada kelas ini';

        siswaSelect.appendChild(placeholder);

        filtered.forEach(function (item) {
            const option = document.createElement('option');
            option.value = item.id;
            option.textContent = item.name
                + (item.nis ? ' · NIS ' + item.nis : '');

            if (item.id === oldSiswaId) {
                option.selected = true;
            }

            siswaSelect.appendChild(option);
        });

        siswaSelect.disabled = filtered.length === 0;

        renderSumberOptions();
    }

    function renderSumberOptions() {
        if (isPresetSkrining) {
            return;
        }

        if (!siswaSelect || !sumberTypeSelect || !sumberIdSelect) {
            return;
        }

        const siswaId = siswaSelect.value;
        const sumberType = sumberTypeSelect.value;

        sumberIdSelect.innerHTML = '';

        if (!siswaId || !sumberType) {
            sumberIdSelect.disabled = true;

            const option = document.createElement('option');
            option.value = '';
            option.textContent =
                'Pilih siswa dan jenis sumber terlebih dahulu';

            sumberIdSelect.appendChild(option);
            return;
        }

        const data = sumberType === 'laporan'
            ? laporanData
            : skriningData;

        const filtered = data.filter(
            item => item.siswa_id === siswaId
        );

        const placeholder = document.createElement('option');
        placeholder.value = '';
        placeholder.textContent = filtered.length
            ? 'Pilih data sumber'
            : 'Tidak ada data sumber untuk siswa ini';

        sumberIdSelect.appendChild(placeholder);

        filtered.forEach(function (item) {
            const option = document.createElement('option');
            option.value = item.id;
            option.textContent = item.label;

            if (item.id === oldSumberId) {
                option.selected = true;
            }

            sumberIdSelect.appendChild(option);
        });

        sumberIdSelect.disabled = filtered.length === 0;
    }

    if (!isPresetSkrining) {
        kelasSelect?.addEventListener(
            'change',
            renderSiswaOptions
        );

        siswaSelect?.addEventListener(
            'change',
            renderSumberOptions
        );

        sumberTypeSelect?.addEventListener(
            'change',
            renderSumberOptions
        );

        renderSiswaOptions();
    }
</script>

</body>
</html>


