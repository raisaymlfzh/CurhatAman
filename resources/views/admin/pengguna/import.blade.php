@php
    $errors = $errors ?? new \Illuminate\Support\ViewErrorBag();
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Import Siswa & Guru Massal | CurhatAman</title>

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
            --ca-danger: #b42318;
            --ca-danger-soft: #fff1f0;
            --ca-success: #027a48;
            --ca-success-soft: #ecf8f2;
            --ca-warning: #b54708;
            --ca-warning-soft: #fffaeb;
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
            padding: 30px 34px 48px;
        }

        .content-shell {
            max-width: 1060px;
            margin: 0 auto;
        }

        .back-link {
            margin-bottom: 16px;
            display: inline-flex;
            align-items: center;
            gap: 7px;
            color: var(--ca-primary-dark);
            font-size: 11.5px;
            font-weight: 650;
        }

        .back-link:hover {
            color: var(--ca-primary);
        }

        .page-header {
            margin-bottom: 22px;
            padding: 24px 26px;
            border-radius: 12px;
            background: var(--ca-primary);
            color: #ffffff;
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 20px;
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
            font-size: 26px;
            font-weight: 760;
            letter-spacing: -.02em;
        }

        .page-copy {
            max-width: 720px;
            margin: 7px 0 0;
            color: rgba(255, 255, 255, .88);
            font-size: 12.5px;
            line-height: 1.65;
        }

        /* Import Tabs */
        .import-tabs-bar {
            margin-bottom: 20px;
            display: flex;
            gap: 8px;
            border-bottom: 2px solid var(--ca-border);
        }

        .import-tab-item {
            padding: 12px 20px;
            font-size: 13.5px;
            font-weight: 700;
            color: var(--ca-muted);
            border: none;
            background: none;
            border-bottom: 3px solid transparent;
            margin-bottom: -2px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            transition: all .15s ease;
        }

        .import-tab-item.active {
            color: var(--ca-primary-dark);
            border-bottom-color: var(--ca-primary);
        }

        .import-tab-item:hover:not(.active) {
            color: var(--ca-text);
        }

        /* Card Container */
        .panel {
            border: 1px solid var(--ca-border);
            border-top: 3px solid var(--ca-primary);
            border-radius: 12px;
            background: #ffffff;
            overflow: hidden;
            margin-bottom: 20px;
        }

        .panel-header {
            padding: 18px 22px;
            border-bottom: 1px solid var(--ca-line);
            background: #ffffff;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .panel-title {
            color: var(--ca-text);
            font-size: 14px;
            font-weight: 710;
        }

        .panel-body {
            padding: 22px;
        }

        .upload-dropzone {
            border: 2px dashed #a3cfca;
            background: #fbfdfd;
            border-radius: 12px;
            padding: 34px 20px;
            text-align: center;
            cursor: pointer;
            transition: all .2s ease;
        }

        .upload-dropzone:hover {
            border-color: var(--ca-primary);
            background: var(--ca-primary-soft);
        }

        .upload-icon {
            width: 56px;
            height: 56px;
            border-radius: 14px;
            background: var(--ca-primary-soft);
            color: var(--ca-primary-dark);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 26px;
            margin-bottom: 12px;
        }

        .table-guide {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }

        .table-guide th {
            background: #f5f9f8;
            color: var(--ca-text);
            padding: 9px 12px;
            border: 1px solid var(--ca-border);
            font-weight: 700;
        }

        .table-guide td {
            padding: 8px 12px;
            border: 1px solid var(--ca-border);
            color: #475467;
        }

        .badge-req {
            font-size: 9.5px;
            padding: 2px 6px;
            border-radius: 4px;
            font-weight: 700;
            background: #fee4e2;
            color: #b42318;
            margin-left: 4px;
        }

        .badge-opt {
            font-size: 9.5px;
            padding: 2px 6px;
            border-radius: 4px;
            font-weight: 700;
            background: #f2f4f7;
            color: #667085;
            margin-left: 4px;
        }

        .btn-download-tpl {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            height: 40px;
            padding: 0 16px;
            border-radius: 9px;
            font-size: 12px;
            font-weight: 700;
            border: 1px solid var(--ca-border);
            background: #ffffff;
            color: #344054;
            transition: all .15s ease;
        }

        .btn-download-tpl:hover {
            background: #f8fafc;
            border-color: #cbd5e1;
            color: var(--ca-primary-dark);
            transform: translateY(-1px);
        }

        .btn-submit-action {
            min-height: 42px;
            padding: 0 20px;
            border-radius: 9px;
            background: var(--ca-primary);
            color: #ffffff;
            border: none;
            font-size: 12.5px;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all .15s ease;
        }

        .btn-submit-action:hover {
            background: var(--ca-primary-dark);
            color: #ffffff;
            transform: translateY(-1px);
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

            .page-header {
                flex-direction: column;
                align-items: flex-start;
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
                <div class="topbar-title">Import Data Pengguna</div>
                <div class="topbar-subtitle">Pendaftaran akun siswa dan guru massal via spreadsheet</div>
            </div>
        </div>

        <div class="topbar-actions">
            @include('admin.partials.notification-bell')
            <div class="date-chip">
                <i class="bi bi-calendar3"></i>
                {{ now()->locale('id')->translatedFormat('d F Y') }}
            </div>
            <a href="{{ route('admin.profil.index') }}" class="account-trigger" title="Buka Profil Admin">
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

                <a href="{{ route('admin.pengguna.index') }}" class="back-link">
                    <i class="bi bi-arrow-left"></i>
                    Kembali ke Kelola Pengguna
                </a>

                @if (session('success'))
                    <div class="alert alert-success d-flex align-items-center gap-2 mb-4 border-0 shadow-sm" style="border-radius: 12px; background: #ecfdf3; color: #027a48;">
                        <i class="bi bi-check-circle-fill fs-5"></i>
                        <div>{{ session('success') }}</div>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger d-flex align-items-center gap-2 mb-4 border-0 shadow-sm" style="border-radius: 12px; background: #fef3f2; color: #b42318;">
                        <i class="bi bi-exclamation-triangle-fill fs-5"></i>
                        <div>{{ session('error') }}</div>
                    </div>
                @endif

                <!-- Report Summary if exists -->
                @if (session('import_result'))
                    @php $res = session('import_result'); @endphp
                    <div class="panel mb-4" style="border-top-color: {{ $res['failed'] > 0 ? '#b54708' : '#027a48' }};">
                        <div class="panel-header">
                            <div class="panel-title fw-bold">
                                <i class="bi bi-clipboard-data me-2"></i> Laporan Rincian Hasil Import
                            </div>
                            <span class="badge {{ $res['failed'] > 0 ? 'bg-warning text-dark' : 'bg-success' }} px-3 py-2 rounded-pill">
                                {{ $res['success'] }} Berhasil &middot; {{ $res['failed'] }} Gagal/Dilewati
                            </span>
                        </div>

                        <div class="panel-body">
                            <div class="row g-3 mb-3">
                                <div class="col-sm-4">
                                    <div class="p-3 rounded-3 bg-light border text-center">
                                        <div class="text-muted small">Total Baris Diproses</div>
                                        <div class="fs-4 fw-bold mt-1 text-dark">{{ $res['total'] }}</div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="p-3 rounded-3 bg-light border text-center" style="border-color: #a6f4c5 !important; background: #f6fef9 !important;">
                                        <div class="text-success small fw-semibold">Berhasil Dibuat</div>
                                        <div class="fs-4 fw-bold mt-1 text-success">{{ $res['success'] }}</div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="p-3 rounded-3 bg-light border text-center" style="border-color: #fedf89 !important; background: #fffaeb !important;">
                                        <div class="text-warning small fw-semibold">Dilewati / Gagal</div>
                                        <div class="fs-4 fw-bold mt-1 text-danger">{{ $res['failed'] }}</div>
                                    </div>
                                </div>
                            </div>

                            @if (!empty($res['errors']))
                                <div class="mt-3">
                                    <label class="fw-semibold text-danger small d-block mb-2">
                                        <i class="bi bi-info-circle me-1"></i> Catatan Peringatan / Baris yang Gagal:
                                    </label>
                                    <div class="p-3 rounded border bg-light" style="max-height: 200px; overflow-y: auto; font-size: 12.5px;">
                                        <ul class="mb-0 ps-3 text-danger">
                                            @foreach($res['errors'] as $err)
                                                <li class="mb-1">{{ $err }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

                <!-- Page Header Banner -->
                <section class="page-header">
                    <div>
                        <div class="page-kicker">Administrasi Pengguna & Pendaftaran Massal</div>
                        <h1 class="page-title">Import Data Pengguna</h1>
                        <p class="page-copy">
                            Daftarkan puluhan hingga ratusan akun siswa, guru bimbingan konseling, dan wali kelas secara instan melalui file Excel (.xlsx) atau CSV (.csv) tanpa perlu input satu per satu.
                        </p>
                    </div>
                </section>

                <!-- Navigation Tabs -->
                <div class="import-tabs-bar">
                    <button type="button" class="import-tab-item active" id="tabBtnSiswa" onclick="switchImportTab('siswa')">
                        <i class="bi bi-mortarboard fs-5"></i>
                        <span>Import Data Siswa</span>
                    </button>
                    <button type="button" class="import-tab-item" id="tabBtnGuru" onclick="switchImportTab('guru')">
                        <i class="bi bi-person-badge fs-5"></i>
                        <span>Import Guru BK & Wali Kelas</span>
                    </button>
                </div>

                <!-- SECTION 1: IMPORT SISWA -->
                <div id="sectionImportSiswa">
                    <div class="row g-4">
                        <!-- Form Upload Siswa -->
                        <div class="col-lg-7">
                            <div class="panel h-100">
                                <div class="panel-header">
                                    <div class="panel-title fw-bold">
                                        <i class="bi bi-file-earmark-arrow-up text-success me-2"></i> Unggah File Data Siswa
                                    </div>
                                    <span class="badge bg-light text-secondary border">Maks. 5 MB</span>
                                </div>

                                <div class="panel-body">
                                    <p class="text-muted small mb-4">
                                        Pilih atau seret file spreadsheet (.xlsx atau .csv) yang memuat daftar siswa. Akun pengguna dan profil siswa akan otomatis tersinkronisasi.
                                    </p>

                                    <form action="{{ route('admin.pengguna.import.siswa') }}" method="POST" enctype="multipart/form-data">
                                        @csrf

                                        <div class="mb-4">
                                            <label class="form-label fw-semibold small text-muted">BERKAS SPREADSHEET (EXCEL / CSV)</label>
                                            <div class="upload-dropzone" onclick="document.getElementById('file_siswa').click()">
                                                <div class="upload-icon">
                                                    <i class="bi bi-file-earmark-excel"></i>
                                                </div>
                                                <div class="fw-bold text-dark mb-1" id="file_siswa_label">Klik untuk memilih file Excel (.xlsx) atau CSV</div>
                                                <div class="text-muted small">Mendukung format .xlsx, .csv (pemisah koma / titik koma)</div>
                                                <input type="file" name="file_siswa" id="file_siswa" class="d-none" accept=".csv, .xlsx, .txt" required onchange="handleFileChange(this, 'file_siswa_label')">
                                            </div>
                                            @error('file_siswa')
                                                <div class="text-danger small mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-4">
                                            <label for="default_password_siswa" class="form-label fw-semibold small text-muted">
                                                PASSWORD BAWAAN (DEFAULT PASSWORD) <span class="badge-opt">Opsional</span>
                                            </label>
                                            <input type="text" name="default_password" id="default_password_siswa" class="form-control" value="12345678" placeholder="Kosongkan untuk menggunakan password bawaan 12345678">
                                            <div class="form-text small">Jika kolom password pada spreadsheet kosong, password bawaan (<code>12345678</code>) ini yang akan otomatis dipasang.</div>
                                        </div>

                                        <div class="d-flex align-items-center justify-content-between pt-3 border-top">
                                            <div class="text-muted small">
                                                <i class="bi bi-shield-check text-success"></i> Duplikasi NISN dicek otomatis
                                            </div>
                                            <button type="submit" class="btn-submit-action">
                                                <i class="bi bi-cloud-arrow-up"></i>
                                                <span>Mulai Proses Import</span>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Template & Panduan Siswa -->
                        <div class="col-lg-5">
                            <div class="panel mb-4">
                                <div class="panel-header">
                                    <div class="panel-title fw-bold">
                                        <i class="bi bi-download text-primary me-2"></i> Unduh Format Template
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <p class="text-muted small mb-3">
                                        Gunakan template resmi agar susunan kolom sesuai dengan sistem pembaca otomatis:
                                    </p>
                                    <div class="d-flex flex-column gap-2">
                                        <a href="{{ route('admin.pengguna.import.template', ['type' => 'siswa', 'format' => 'xlsx']) }}" class="btn-download-tpl">
                                            <i class="bi bi-file-earmark-spreadsheet-fill text-success fs-5"></i>
                                            <span>Download Template Excel (.xlsx)</span>
                                        </a>
                                        <a href="{{ route('admin.pengguna.import.template', ['type' => 'siswa', 'format' => 'csv']) }}" class="btn-download-tpl">
                                            <i class="bi bi-file-earmark-text text-secondary fs-5"></i>
                                            <span>Download Template CSV (.csv)</span>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="panel">
                                <div class="panel-header">
                                    <div class="panel-title fw-bold">
                                        <i class="bi bi-info-circle text-info me-2"></i> Ketentuan Kolom Siswa
                                    </div>
                                </div>
                                <div class="panel-body p-0">
                                    <div class="table-responsive">
                                        <table class="table-guide mb-0">
                                            <thead>
                                                <tr>
                                                    <th>Kolom</th>
                                                    <th>Keterangan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><strong>Nama Lengkap</strong> <span class="badge-req">Wajib</span></td>
                                                    <td>Nama lengkap siswa peserta didik.</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>NISN</strong> <span class="badge-req">Wajib</span></td>
                                                    <td>Nomor Induk Siswa Nasional unik (digunakan siswa untuk login).</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Kelas</strong> <span class="badge-opt">Opsional</span></td>
                                                    <td>Contoh: <code>X IPA 1</code> atau <code>X-1</code>. Jika kelas belum ada, sistem akan membuatnya otomatis.</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Tahun Masuk</strong> <span class="badge-opt">Opsional</span></td>
                                                    <td>Tahun angkatan (contoh: <code>2026</code>).</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Password</strong> <span class="badge-opt">Opsional</span></td>
                                                    <td>Jika dikosongkan, otomatis menggunakan password bawaan <code>12345678</code>.</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="p-3 border-top bg-light small text-muted">
                                        <i class="bi bi-info-circle text-primary me-1"></i>
                                        <strong>Catatan:</strong> Data <strong>Email</strong> dan <strong>No. WhatsApp</strong> tidak perlu diinput oleh Admin dan akan dilengkapi sendiri oleh masing-masing siswa pada menu Profil Siswa.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SECTION 2: IMPORT GURU -->
                <div id="sectionImportGuru" style="display: none;">
                    <div class="row g-4">
                        <!-- Form Upload Guru -->
                        <div class="col-lg-7">
                            <div class="panel h-100">
                                <div class="panel-header">
                                    <div class="panel-title fw-bold">
                                        <i class="bi bi-file-earmark-arrow-up text-primary me-2"></i> Unggah File Guru BK & Wali Kelas
                                    </div>
                                    <span class="badge bg-light text-secondary border">Maks. 5 MB</span>
                                </div>

                                <div class="panel-body">
                                    <p class="text-muted small mb-4">
                                        Daftarkan akun dewan guru secara massal. Sistem akan otomatis membedakan role Guru BK dan Wali Kelas berdasarkan kolom role.
                                    </p>

                                    <form action="{{ route('admin.pengguna.import.guru') }}" method="POST" enctype="multipart/form-data">
                                        @csrf

                                        <div class="mb-4">
                                            <label class="form-label fw-semibold small text-muted">BERKAS SPREADSHEET (EXCEL / CSV)</label>
                                            <div class="upload-dropzone" onclick="document.getElementById('file_guru').click()">
                                                <div class="upload-icon">
                                                    <i class="bi bi-file-earmark-person"></i>
                                                </div>
                                                <div class="fw-bold text-dark mb-1" id="file_guru_label">Klik untuk memilih file Excel (.xlsx) atau CSV</div>
                                                <div class="text-muted small">Mendukung format .xlsx, .csv (pemisah koma / titik koma)</div>
                                                <input type="file" name="file_guru" id="file_guru" class="d-none" accept=".csv, .xlsx, .txt" required onchange="handleFileChange(this, 'file_guru_label')">
                                            </div>
                                            @error('file_guru')
                                                <div class="text-danger small mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-4">
                                            <label for="default_password_guru" class="form-label fw-semibold small text-muted">
                                                PASSWORD BAWAAN (DEFAULT PASSWORD) <span class="badge-opt">Opsional</span>
                                            </label>
                                            <input type="text" name="default_password" id="default_password_guru" class="form-control" value="12345678" placeholder="Kosongkan untuk menggunakan password bawaan 12345678">
                                            <div class="form-text small">Jika kolom password pada spreadsheet kosong, password bawaan (<code>12345678</code>) ini yang akan otomatis dipasang.</div>
                                        </div>

                                        <div class="d-flex align-items-center justify-content-between pt-3 border-top">
                                            <div class="text-muted small">
                                                <i class="bi bi-shield-check text-success"></i> Keamanan hak akses terverifikasi
                                            </div>
                                            <button type="submit" class="btn-submit-action">
                                                <i class="bi bi-cloud-arrow-up"></i>
                                                <span>Mulai Proses Import</span>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Template & Panduan Guru -->
                        <div class="col-lg-5">
                            <div class="panel mb-4">
                                <div class="panel-header">
                                    <div class="panel-title fw-bold">
                                        <i class="bi bi-download text-primary me-2"></i> Unduh Format Template
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <p class="text-muted small mb-3">
                                        Unduh template isian akun Guru BK dan Wali Kelas untuk sekolah Anda:
                                    </p>
                                    <div class="d-flex flex-column gap-2">
                                        <a href="{{ route('admin.pengguna.import.template', ['type' => 'guru', 'format' => 'xlsx']) }}" class="btn-download-tpl">
                                            <i class="bi bi-file-earmark-spreadsheet-fill text-success fs-5"></i>
                                            <span>Download Template Excel (.xlsx)</span>
                                        </a>
                                        <a href="{{ route('admin.pengguna.import.template', ['type' => 'guru', 'format' => 'csv']) }}" class="btn-download-tpl">
                                            <i class="bi bi-file-earmark-text text-secondary fs-5"></i>
                                            <span>Download Template CSV (.csv)</span>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="panel">
                                <div class="panel-header">
                                    <div class="panel-title fw-bold">
                                        <i class="bi bi-info-circle text-info me-2"></i> Ketentuan Kolom Guru
                                    </div>
                                </div>
                                <div class="panel-body p-0">
                                    <div class="table-responsive">
                                        <table class="table-guide mb-0">
                                            <thead>
                                                <tr>
                                                    <th>Kolom</th>
                                                    <th>Keterangan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><strong>Nama Lengkap</strong> <span class="badge-req">Wajib</span></td>
                                                    <td>Nama lengkap beserta gelar jabatan.</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Email</strong> <span class="badge-req">Wajib</span></td>
                                                    <td>Email login dengan domain <code>@curhataman.com</code> (contoh: <code>bk3@curhataman.com</code>).</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Role</strong> <span class="badge-req">Wajib</span></td>
                                                    <td>Isi dengan <code>Guru BK</code> atau <code>Wali Kelas</code>.</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Kelas Diampu</strong> <span class="badge-opt">Khusus Wali</span></td>
                                                    <td>Wajib untuk Wali Kelas (contoh: <code>X IPA 1</code>). Otomatis menetapkan wali kelas pada kelas bersangkutan.</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Password</strong> <span class="badge-opt">Opsional</span></td>
                                                    <td>Jika dikosongkan, otomatis menggunakan password bawaan <code>12345678</code>.</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="page-footer">
                    CurhatAman · Portal Administrasi Sekolah · Modul Import Pengguna Massal
                </div>

            </div>
        </div>
    </main>

</div>

<script>
    function switchImportTab(type) {
        const btnSiswa = document.getElementById('tabBtnSiswa');
        const btnGuru = document.getElementById('tabBtnGuru');
        const secSiswa = document.getElementById('sectionImportSiswa');
        const secGuru = document.getElementById('sectionImportGuru');

        if (type === 'siswa') {
            btnSiswa.classList.add('active');
            btnGuru.classList.remove('active');
            secSiswa.style.display = 'block';
            secGuru.style.display = 'none';
        } else {
            btnGuru.classList.add('active');
            btnSiswa.classList.remove('active');
            secGuru.style.display = 'block';
            secSiswa.style.display = 'none';
        }
    }

    function handleFileChange(input, labelId) {
        if (input.files && input.files[0]) {
            const fileName = input.files[0].name;
            const fileSize = (input.files[0].size / 1024).toFixed(1) + ' KB';
            document.getElementById(labelId).innerHTML = '<span class="text-success"><i class="bi bi-check2-circle"></i> ' + fileName + ' (' + fileSize + ')</span>';
        }
    }

    // Sidebar Mobile Toggle
    const openSidebarButton = document.getElementById('openSidebarButton');
    const sidebar = document.getElementById('adminSidebar');
    const sidebarOverlay = document.getElementById('sidebarOverlay');

    if (openSidebarButton && sidebar && sidebarOverlay) {
        openSidebarButton.addEventListener('click', () => {
            sidebar.classList.add('show');
            sidebarOverlay.classList.add('show');
        });

        sidebarOverlay.addEventListener('click', () => {
            sidebar.classList.remove('show');
            sidebarOverlay.classList.remove('show');
        });
    }
</script>

</body>
</html>
