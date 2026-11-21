@php
    $errors = $errors ?? new \Illuminate\Support\ViewErrorBag();
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tambah Pengguna | CurhatAman</title>

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
            --ca-success: #027a48;
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
            max-width: 980px;
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
            margin-bottom: 20px;
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
            max-width: 720px;
            margin: 7px 0 0;
            color: rgba(255, 255, 255, .82);
            font-size: 12.5px;
            line-height: 1.65;
        }

        .panel {
            border: 1px solid var(--ca-border);
            border-top: 3px solid var(--ca-primary);
            border-radius: 12px;
            background: #ffffff;
            overflow: hidden;
        }

        .panel-header {
            padding: 18px 20px;
            border-bottom: 1px solid var(--ca-line);
            background: #ffffff;
        }

        .panel-title {
            color: var(--ca-text);
            font-size: 14px;
            font-weight: 710;
        }

        .panel-copy {
            margin-top: 4px;
            color: var(--ca-muted);
            font-size: 11px;
        }

        .form-body {
            padding: 20px;
        }

        .form-label {
            margin-bottom: 6px;
            color: #475467;
            font-size: 11px;
            font-weight: 650;
        }

        .form-control,
        .form-select {
            min-height: 43px;
            border: 1px solid #d8e1e1;
            border-radius: 9px;
            color: var(--ca-text);
            background-color: #ffffff;
            font-size: 12.5px;
            box-shadow: none;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: rgba(15, 138, 131, .55);
            box-shadow: 0 0 0 .2rem rgba(15, 138, 131, .08);
        }

        .form-help {
            margin-top: 6px;
            color: var(--ca-muted-light);
            font-size: 10.5px;
            line-height: 1.45;
        }

        .class-section {
            display: none;
            padding: 14px;
            border: 1px solid #d7e9e6;
            border-radius: 9px;
            background: #f7fbfa;
        }

        .class-section.show {
            display: block;
        }

        .password-wrap {
            position: relative;
        }

        .password-wrap input {
            padding-right: 44px;
        }

        .password-toggle {
            position: absolute;
            top: 50%;
            right: 7px;
            width: 32px;
            height: 32px;
            padding: 0;
            border: 0;
            border-radius: 7px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transform: translateY(-50%);
            color: var(--ca-muted);
            background: transparent;
        }

        .password-toggle:hover {
            color: var(--ca-primary-dark);
            background: var(--ca-primary-soft);
        }

        .info-box {
            margin-top: 18px;
            padding: 13px 14px;
            border: 1px solid #d7e9e6;
            border-radius: 9px;
            display: flex;
            gap: 10px;
            color: #55706d;
            background: #f7fbfa;
            font-size: 10.5px;
            line-height: 1.55;
        }

        .info-box i {
            margin-top: 1px;
            color: var(--ca-primary-dark);
            font-size: 14px;
        }

        .form-actions {
            padding: 16px 20px;
            border-top: 1px solid var(--ca-line);
            display: flex;
            justify-content: flex-end;
            gap: 9px;
            background: #fafcfc;
        }

        .btn-cancel,
        .btn-save {
            min-height: 40px;
            padding: 0 14px;
            border-radius: 9px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            font-size: 11.5px;
            font-weight: 670;
        }

        .btn-cancel {
            border: 1px solid var(--ca-border);
            color: var(--ca-muted);
            background: #ffffff;
        }

        .btn-cancel:hover {
            color: var(--ca-primary-dark);
            background: var(--ca-primary-soft);
            border-color: #cfe4e1;
        }

        .btn-save {
            border: 1px solid var(--ca-primary);
            color: #ffffff;
            background: var(--ca-primary);
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

            .form-actions {
                flex-direction: column-reverse;
            }

            .btn-cancel,
            .btn-save {
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
                Tambah Pengguna
            </div>

            <div class="topbar-subtitle">
                Buat akun internal sekolah
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
            </a>

        </div>

    </header>

    <main class="main-content">

        <div class="page-body">
            <div class="content-shell">

                <a
                    href="{{ route('admin.pengguna.index') }}"
                    class="back-link"
                >
                    <i class="bi bi-arrow-left"></i>
                    Kembali ke Daftar Pengguna
                </a>

                <section class="page-header">
                    <div>
                    <div class="page-kicker">
                        Administrasi Akun
                    </div>

                    <h1 class="page-title">
                        Tambah Pengguna
                    </h1>

                    <p class="page-copy">
                        Buat akun internal sekolah (Admin, Guru BK, Wali Kelas, atau Siswa).
                    </p>
                </div>
            </section>

                <div class="alert d-flex align-items-center justify-content-between mb-4 p-3 border-0 shadow-sm" style="border-radius: 12px; background: #eaf6f4; color: #0b6f69;">
                    <div class="d-flex align-items-center gap-3">
                        <div class="fs-4"><i class="bi bi-file-earmark-spreadsheet-fill text-success"></i></div>
                        <div>
                            <strong class="d-block" style="font-size: 13px;">Ingin mendaftarkan siswa atau guru dalam jumlah banyak sekaligus?</strong>
                            <span class="small text-muted">Gunakan fitur <strong>Import Massal via Excel / CSV</strong> untuk mendaftarkan ratusan akun otomatis dalam hitungan detik.</span>
                        </div>
                    </div>
                    <a href="{{ route('admin.pengguna.import') }}" class="btn btn-sm text-white fw-bold px-3 py-2 text-nowrap" style="background: var(--ca-primary); border-radius: 8px;">
                        Buka Import Massal <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>

                <form
                    method="POST"
                    action="{{ route('admin.pengguna.store') }}"
                    class="panel"
                >
                    @csrf

                    <div class="panel-header">
                        <div class="panel-title">
                            Informasi Akun
                        </div>

                        <div class="panel-copy">
                            Isi data pengguna dengan benar.
                        </div>
                    </div>

                    <div class="form-body">

                        <div class="row g-3">

                            <div class="col-md-6">
                                <label class="form-label">
                                    Nama Lengkap
                                </label>

                                <input
                                    type="text"
                                    name="name"
                                    value="{{ old('name') }}"
                                    class="form-control @error('name') is-invalid @enderror"
                                    required
                                >

                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">
                                    Role Pengguna
                                </label>

                                <select
                                    name="role"
                                    id="roleSelect"
                                    class="form-select @error('role') is-invalid @enderror"
                                    required
                                >
                                    <option value="">
                                        Pilih Role
                                    </option>

                                    <option
                                        value="student"
                                        @selected(old('role') === 'student')
                                    >
                                        Siswa (Murid Baru / Pindahan)
                                    </option>

                                    <option
                                        value="counselor"
                                        @selected(old('role') === 'counselor')
                                    >
                                        Guru BK
                                    </option>

                                    <option
                                        value="homeroom_teacher"
                                        @selected(old('role') === 'homeroom_teacher')
                                    >
                                        Wali Kelas
                                    </option>
                                </select>

                                @error('role')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6" id="emailSection">
                                <label class="form-label">
                                    Email (@curhataman.com)
                                </label>

                                <input
                                    type="text"
                                    id="emailInput"
                                    name="email"
                                    value="{{ old('email') }}"
                                    placeholder="contoh: bk3@curhataman.com"
                                    class="form-control @error('email') is-invalid @enderror"
                                >

                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 d-none" id="studentNisSection">
                                <label class="form-label">
                                    NISN Siswa
                                </label>

                                <input
                                    type="text"
                                    id="nisInput"
                                    name="nis"
                                    value="{{ old('nis') }}"
                                    placeholder="Contoh: 0081234567"
                                    class="form-control @error('nis') is-invalid @enderror"
                                >

                                @error('nis')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                                <div class="form-help">
                                    Digunakan siswa untuk login (Email & No. WA dilengkapi sendiri oleh siswa).
                                </div>
                            </div>

                            <div class="col-md-6 d-none" id="studentKelasSection">
                                <label class="form-label">
                                    Kelas Siswa
                                </label>

                                <select
                                    name="kelas_siswa_id"
                                    id="kelasSiswaInput"
                                    class="form-select @error('kelas_siswa_id') is-invalid @enderror"
                                >
                                    <option value="">
                                        Pilih Kelas Siswa
                                    </option>

                                    @foreach($semuaKelasAktif ?? [] as $kelas)
                                        <option
                                            value="{{ $kelas->id }}"
                                            @selected((string) old('kelas_siswa_id') === (string) $kelas->id)
                                        >
                                            {{ $kelas->nama_kelas }} · Tingkat {{ $kelas->tingkat }} · {{ $kelas->tahun_ajaran }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('kelas_siswa_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 d-none" id="studentTahunMasukSection">
                                <label class="form-label">
                                    Tahun Masuk
                                </label>

                                <input
                                    type="number"
                                    id="tahunMasukInput"
                                    name="tahun_masuk"
                                    value="{{ old('tahun_masuk', date('Y')) }}"
                                    min="2000"
                                    max="{{ date('Y') + 1 }}"
                                    class="form-control @error('tahun_masuk') is-invalid @enderror"
                                >

                                @error('tahun_masuk')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6" id="homeroomClassWrapper">

                                <div
                                    id="classSection"
                                    class="class-section
                                    {{ old('role') === 'homeroom_teacher'
                                        ? 'show'
                                        : '' }}"
                                >
                                    <label class="form-label">
                                        Kelas yang Diampu
                                    </label>

                                    <select
                                        name="kelas_id"
                                        class="form-select
                                        @error('kelas_id')
                                            is-invalid
                                        @enderror"
                                    >
                                        <option value="">
                                            Pilih Kelas
                                        </option>

                                        @foreach($kelasTersedia as $kelas)
                                            <option
                                                value="{{ $kelas->id }}"
                                                @selected(
                                                    (string) old('kelas_id')
                                                    ===
                                                    (string) $kelas->id
                                                )
                                            >
                                                {{ $kelas->nama_kelas }}
                                                · Tingkat
                                                {{ $kelas->tingkat }}
                                                ·
                                                {{ $kelas->tahun_ajaran }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('kelas_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                    <div class="form-help">
                                        Hanya kelas aktif yang belum memiliki
                                        Wali Kelas yang dapat dipilih.
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-6">
                                <label class="form-label">
                                    Password Awal
                                </label>

                                <div class="password-wrap">

                                    <input
                                        type="password"
                                        id="password"
                                        name="password"
                                        value="12345678"
                                        class="form-control
                                        @error('password')
                                            is-invalid
                                        @enderror"
                                        required
                                    >

                                    <button
                                        type="button"
                                        class="password-toggle"
                                        data-target="password"
                                    >
                                        <i class="bi bi-eye"></i>
                                    </button>

                                </div>

                                @error('password')
                                    <div class="text-danger small mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">
                                    Konfirmasi Password
                                </label>

                                <div class="password-wrap">

                                    <input
                                        type="password"
                                        id="password_confirmation"
                                        name="password_confirmation"
                                        value="12345678"
                                        class="form-control"
                                        required
                                    >

                                    <button
                                        type="button"
                                        class="password-toggle"
                                        data-target="password_confirmation"
                                    >
                                        <i class="bi bi-eye"></i>
                                    </button>

                                </div>
                            </div>

                        </div>

                        <div class="info-box">
                            <i class="bi bi-shield-check"></i>

                            <div>
                                Akun akan langsung aktif setelah disimpan.
                                Wali Kelas hanya dapat mengakses data kelas
                                yang ditugaskan kepadanya.
                            </div>
                        </div>

                    </div>

                    <div class="form-actions">

                        <a
                            href="{{ route('admin.pengguna.index') }}"
                            class="btn-cancel"
                        >
                            Batal
                        </a>

                        <button
                            type="submit"
                            class="btn-save"
                        >
                            <i class="bi bi-person-plus"></i>
                            Buat Akun
                        </button>

                    </div>

                </form>

                <footer class="page-footer">
                    <div class="d-flex flex-column flex-md-row justify-content-between gap-2 w-100">
                        <span>© {{ date('Y') }} CurhatAman</span>
                        <span>Portal Admin Sekolah · Tambah pengguna</span>
                    </div>
                </footer>

            </div>
        </div>

    </main>

</div>

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

    const roleSelect = document.getElementById('roleSelect');
    const classSection = document.getElementById('classSection');
    const homeroomClassWrapper = document.getElementById('homeroomClassWrapper');
    const emailSection = document.getElementById('emailSection');
    const emailInput = document.getElementById('emailInput');
    const studentNisSection = document.getElementById('studentNisSection');
    const studentKelasSection = document.getElementById('studentKelasSection');
    const studentTahunMasukSection = document.getElementById('studentTahunMasukSection');
    const nisInput = document.getElementById('nisInput');
    const kelasSiswaInput = document.getElementById('kelasSiswaInput');
    const tahunMasukInput = document.getElementById('tahunMasukInput');

    function syncClassSection() {
        const isStudent = roleSelect.value === 'student';
        const isHomeroom = roleSelect.value === 'homeroom_teacher';

        if (isStudent) {
            emailSection?.classList.add('d-none');
            if (emailInput) emailInput.required = false;

            studentNisSection?.classList.remove('d-none');
            studentKelasSection?.classList.remove('d-none');
            studentTahunMasukSection?.classList.remove('d-none');
            if (nisInput) nisInput.required = true;
            if (kelasSiswaInput) kelasSiswaInput.required = true;
            if (tahunMasukInput) tahunMasukInput.required = true;

            classSection?.classList.remove('show');
            homeroomClassWrapper?.classList.add('d-none');
        } else {
            emailSection?.classList.remove('d-none');
            if (emailInput) emailInput.required = true;

            studentNisSection?.classList.add('d-none');
            studentKelasSection?.classList.add('d-none');
            studentTahunMasukSection?.classList.add('d-none');
            if (nisInput) nisInput.required = false;
            if (kelasSiswaInput) kelasSiswaInput.required = false;
            if (tahunMasukInput) tahunMasukInput.required = false;

            homeroomClassWrapper?.classList.remove('d-none');
            if (isHomeroom) {
                classSection?.classList.add('show');
            } else {
                classSection?.classList.remove('show');
            }
        }
    }

    roleSelect.addEventListener('change', syncClassSection);
    syncClassSection();

    document
        .querySelectorAll('[data-target]')
        .forEach(function (button) {

            button.addEventListener('click', function () {

                const input = document.getElementById(
                    button.getAttribute('data-target')
                );

                const icon = button.querySelector('i');

                const hidden = input.type === 'password';

                input.type = hidden
                    ? 'text'
                    : 'password';

                icon.classList.toggle('bi-eye', !hidden);
                icon.classList.toggle(
                    'bi-eye-slash',
                    hidden
                );
            });

        });
</script>

</body>
</html>