<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajukan Bantuan - CurhatAman</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        :root {
            --ca-primary: #0f8a83;
            --ca-primary-dark: #0b6f69;
            --ca-primary-soft: #eaf6f4;
            --ca-text: #172033;
            --ca-muted: #667085;
            --ca-muted-light: #98a2b3;
            --ca-bg: #f7f9f9;
            --ca-surface: #ffffff;
            --ca-border: #e3e9e9;
            --ca-line: #edf1f1;
            --ca-danger: #b42318;
            --ca-radius: 12px;
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
            display: flex;
            flex-direction: column;
            color: var(--ca-text);
            background: var(--ca-bg);
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Arial, sans-serif;
            font-size: 14px;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        .student-navbar {
            min-height: 72px;
            background: rgba(255, 255, 255, .98);
            border-bottom: 1px solid var(--ca-border);
        }

        .student-navbar .container {
            min-height: 72px;
        }

        .navbar-brand {
            margin-right: 2rem;
        }

        .brand-symbol {
            width: 42px;
            height: 42px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            border-radius: 10px;
            color: #ffffff;
            background: var(--ca-primary);
            font-size: 1.15rem;
        }

        .brand-text {
            color: var(--ca-primary);
            font-size: 1.18rem;
            font-weight: 720;
            letter-spacing: -.3px;
        }

        .student-navbar .nav-link {
            position: relative;
            padding: 1.48rem .9rem 1.28rem !important;
            color: #475467;
            font-size: .88rem;
            font-weight: 520;
        }

        .student-navbar .nav-link:hover {
            color: var(--ca-primary-dark);
        }

        .student-navbar .nav-link.active {
            color: var(--ca-primary-dark);
            font-weight: 680;
        }

        .student-navbar .nav-link.active::after {
            content: "";
            position: absolute;
            left: .9rem;
            right: .9rem;
            bottom: 10px;
            height: 2px;
            border-radius: 999px;
            background: var(--ca-primary);
        }

        .notification-link {
            position: relative;
            width: 40px;
            height: 40px;
            margin-right: 10px;
            border: 1px solid var(--ca-border);
            border-radius: 9px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #667085;
            background: #ffffff;
            font-size: .98rem;
        }

        .notification-link:hover,
        .notification-link:focus {
            color: var(--ca-primary-dark);
            background: #f7fbfa;
            border-color: #cfe3e0;
        }

        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            min-width: 18px;
            height: 18px;
            padding: 0 5px;
            border: 2px solid #ffffff;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            background: #c64747;
            font-size: .61rem;
            font-weight: 700;
        }

        .account-dropdown .dropdown-toggle::after {
            display: none;
        }

        .account-trigger {
            min-width: 180px;
            padding: 5px 7px;
            border: 1px solid transparent;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            gap: 9px;
            color: var(--ca-text);
            background: transparent;
            text-align: left;
        }

        .account-trigger:hover,
        .account-trigger:focus,
        .account-trigger[aria-expanded="true"] {
            background: #f7fbfa;
            border-color: var(--ca-border);
        }

        .student-avatar,
        .student-avatar-image {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .student-avatar {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: var(--ca-primary-dark);
            background: #dcefeb;
            font-size: .86rem;
            font-weight: 700;
        }

        .student-avatar-image {
            display: block;
            object-fit: cover;
            border: 1px solid var(--ca-border);
        }

        .account-copy {
            min-width: 0;
            flex: 1;
        }

        .user-name {
            max-width: 132px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            color: var(--ca-text);
            font-size: .82rem;
            font-weight: 650;
        }

        .account-label {
            margin-top: 1px;
            color: var(--ca-muted);
            font-size: .68rem;
        }

        .account-chevron {
            color: var(--ca-muted-light);
            font-size: .7rem;
            transition: transform .18s ease;
        }

        .account-trigger[aria-expanded="true"] .account-chevron {
            transform: rotate(180deg);
        }

        .account-menu {
            width: 220px;
            margin-top: 8px !important;
            padding: 8px;
            border: 1px solid var(--ca-border);
            border-radius: 11px;
            background: #ffffff;
            box-shadow: 0 12px 30px rgba(15, 23, 42, .10);
        }

        .account-menu-header {
            padding: 8px 10px 10px;
            margin-bottom: 6px;
            border-bottom: 1px solid var(--ca-line);
        }

        .account-menu-name {
            margin-bottom: 2px;
            font-size: .8rem;
            font-weight: 650;
        }

        .account-menu-email {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            color: var(--ca-muted);
            font-size: .69rem;
        }

        .account-menu .dropdown-item {
            display: flex;
            align-items: center;
            gap: 9px;
            padding: 9px 10px;
            border-radius: 8px;
            color: #344054;
            font-size: .77rem;
            font-weight: 500;
        }

        .account-menu .dropdown-item:hover,
        .account-menu .dropdown-item:focus {
            color: var(--ca-primary-dark);
            background: var(--ca-primary-soft);
        }

        .account-menu .dropdown-item i {
            width: 18px;
            color: var(--ca-primary);
            font-size: .88rem;
        }

        .account-menu .dropdown-divider {
            margin: 6px 0;
            border-color: var(--ca-line);
        }

        .account-logout {
            width: 100%;
            border: 0;
            background: transparent;
            text-align: left;
        }

        .account-logout i {
            color: var(--ca-danger) !important;
        }

        .account-logout:hover,
        .account-logout:focus {
            color: var(--ca-danger) !important;
            background: #fff3f2 !important;
        }

        .help-create-main {
            flex: 1;
            padding: 34px 0 38px;
        }

        .breadcrumb {
            --bs-breadcrumb-divider-color: #b0b8c1;
            --bs-breadcrumb-item-active-color: var(--ca-muted);
            margin-bottom: 18px;
            font-size: .76rem;
        }

        .breadcrumb a {
            color: var(--ca-primary-dark);
            font-weight: 600;
        }

        .page-kicker {
            margin-bottom: 6px;
            color: var(--ca-primary);
            font-size: .69rem;
            font-weight: 740;
            letter-spacing: .065em;
            text-transform: uppercase;
        }

        .page-title {
            margin: 0;
            font-size: clamp(1.7rem, 3vw, 2.15rem);
            font-weight: 720;
            letter-spacing: -.55px;
        }

        .page-copy {
            max-width: 700px;
            margin: 8px 0 0;
            color: var(--ca-muted);
            font-size: .9rem;
            line-height: 1.55;
        }

        .privacy-box {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 14px 16px;
            border: 1px solid #cfe3e0;
            border-radius: 10px;
            background: #f3faf9;
        }

        .privacy-icon {
            width: 36px;
            height: 36px;
            border-radius: 9px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            color: var(--ca-primary);
            background: #ffffff;
            font-size: .9rem;
        }

        .privacy-title {
            margin-bottom: 3px;
            color: var(--ca-text);
            font-size: .79rem;
            font-weight: 650;
        }

        .privacy-copy {
            margin: 0;
            color: #55706d;
            font-size: .72rem;
            line-height: 1.5;
        }

        .form-card {
            padding: 20px;
            border: 1px solid var(--ca-border);
            border-radius: var(--ca-radius);
            background: #ffffff;
        }

        .form-section-title {
            margin: 0 0 4px;
            font-size: .94rem;
            font-weight: 680;
        }

        .form-section-copy {
            margin: 0 0 18px;
            color: var(--ca-muted);
            font-size: .76rem;
            line-height: 1.5;
        }

        .form-label {
            margin-bottom: 6px;
            color: #475467;
            font-size: .73rem;
            font-weight: 620;
        }

        .required-mark {
            color: var(--ca-danger);
        }

        .form-control,
        .form-select {
            min-height: 42px;
            border: 1px solid var(--ca-border);
            border-radius: 9px;
            color: var(--ca-text);
            background: #ffffff;
            font-size: .8rem;
            box-shadow: none;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: rgba(15, 138, 131, .55);
            box-shadow: 0 0 0 .2rem rgba(15, 138, 131, .08);
        }

        textarea.form-control {
            min-height: 150px;
            padding-top: 12px;
            resize: vertical;
        }

        .form-text {
            margin-top: 6px;
            color: var(--ca-muted);
            font-size: .68rem;
            line-height: 1.45;
        }

        .invalid-feedback {
            font-size: .7rem;
        }

        .btn-ca-primary,
        .btn-ca-outline {
            min-height: 42px;
            padding: 0 15px;
            border-radius: 9px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            font-size: .8rem;
            font-weight: 650;
        }

        .btn-ca-primary {
            border: 1px solid var(--ca-primary);
            color: #ffffff;
            background: var(--ca-primary);
        }

        .btn-ca-primary:hover,
        .btn-ca-primary:focus {
            color: #ffffff;
            background: var(--ca-primary-dark);
            border-color: var(--ca-primary-dark);
        }

        .btn-ca-outline {
            border: 1px solid #a7b5b4;
            color: #475467;
            background: #ffffff;
        }

        .btn-ca-outline:hover,
        .btn-ca-outline:focus {
            color: var(--ca-primary-dark);
            border-color: #8ec9c4;
            background: #f8fbfa;
        }

        .form-note {
            max-width: 430px;
            margin: 0;
            color: var(--ca-muted);
            font-size: .7rem;
            line-height: 1.5;
        }

        .error-alert {
            padding: 12px 14px;
            margin-bottom: 16px;
            border: 1px solid #f0c7c4;
            border-radius: 10px;
            display: flex;
            align-items: flex-start;
            gap: 9px;
            color: #9e2a22;
            background: #fff5f4;
            font-size: .75rem;
        }

        .error-alert-title {
            margin-bottom: 2px;
            font-weight: 650;
        }

        .simple-footer {
            margin-top: 24px;
            border-top: 1px solid var(--ca-primary-dark);
            background: var(--ca-primary);
        }

        .simple-footer .container {
            min-height: 64px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            color: rgba(255, 255, 255, .78);
            font-size: .72rem;
        }

        .simple-footer strong {
            color: #ffffff;
            font-weight: 650;
        }

        .footer-links {
            display: flex;
            align-items: center;
            gap: 14px;
            flex-wrap: wrap;
        }

        .footer-link {
            color: rgba(255, 255, 255, .9);
            font-weight: 560;
        }

        .footer-link:hover {
            color: #ffffff;
        }

        .footer-separator {
            color: rgba(255, 255, 255, .42);
        }

        @media (max-width: 991.98px) {
            .student-navbar .nav-link {
                padding: .55rem 0 !important;
            }

            .student-navbar .nav-link.active::after {
                display: none;
            }

            .navbar-brand {
                margin-right: 0;
            }

            .help-create-main {
                padding-top: 28px;
            }
        }

        @media (max-width: 575.98px) {
            .account-trigger {
                min-width: auto;
                padding: 5px;
            }

            .account-menu {
                width: min(220px, calc(100vw - 32px));
            }

            .form-card {
                padding: 18px;
            }

            .form-actions {
                width: 100%;
            }

            .form-actions .btn-ca-primary,
            .form-actions .btn-ca-outline {
                width: 100%;
            }

            .simple-footer .container {
                padding-top: 16px;
                padding-bottom: 16px;
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
</head>

<body>
@php
    $user = auth()->user();
    $namaUser = ucwords($user->name);
    $inisial = strtoupper(substr($user->name, 0, 1));

    $fotoProfil = $user->profile_photo_path
        ? asset('storage/' . $user->profile_photo_path)
        : null;

    $jumlahNotifikasiBelum = \App\Models\Notifikasi::where('user_id', $user->id)
        ->whereNull('read_at')
        ->count();
@endphp

<nav class="navbar navbar-expand-lg student-navbar sticky-top">
    <div class="container">
        <a
            href="{{ route('siswa.dashboard') }}"
            class="navbar-brand d-flex align-items-center gap-2"
            aria-label="CurhatAman"
        >
            <span class="brand-symbol">
                <i class="bi bi-people-fill"></i>
            </span>

            <span class="brand-text">
                CurhatAman
            </span>
        </a>

        <button
            class="navbar-toggler border-0 shadow-none"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#studentNavbar"
            aria-controls="studentNavbar"
            aria-expanded="false"
            aria-label="Buka navigasi"
        >
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="studentNavbar">
            <ul class="navbar-nav mx-auto mb-3 mb-lg-0">
                <li class="nav-item">
                    <a href="{{ route('siswa.dashboard') }}" class="nav-link">
                        Dashboard
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('siswa.laporan.index') }}" class="nav-link">
                        Laporan Saya
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('siswa.skrining.riwayat') }}" class="nav-link">
                        Skrining
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('siswa.bantuan.index') }}" class="nav-link active">
                        Rujukan & Bantuan
                    </a>
                </li>
            </ul>

            <div class="d-flex align-items-center ms-lg-3">
                <a
                    href="{{ route('siswa.notifikasi.index') }}"
                    class="notification-link"
                    aria-label="Buka notifikasi"
                    title="Notifikasi"
                >
                    <i class="bi bi-bell"></i>

                    @if ($jumlahNotifikasiBelum > 0)
                        <span class="notification-badge">
                            {{ $jumlahNotifikasiBelum > 99 ? '99+' : $jumlahNotifikasiBelum }}
                        </span>
                    @endif
                </a>

                <div class="dropdown account-dropdown">
                    <button
                        class="account-trigger dropdown-toggle"
                        type="button"
                        data-bs-toggle="dropdown"
                        aria-expanded="false"
                        aria-label="Buka menu akun siswa"
                    >
                        @if ($fotoProfil)
                            <img
                                src="{{ $fotoProfil }}"
                                alt="Foto profil {{ $namaUser }}"
                                class="student-avatar-image"
                            >
                        @else
                            <span class="student-avatar">
                                {{ $inisial }}
                            </span>
                        @endif

                        <span class="account-copy d-none d-sm-block">
                            <span class="user-name d-block">
                                {{ $namaUser }}
                            </span>

                            <span class="account-label d-block">
                                Akun siswa
                            </span>
                        </span>

                        <i class="bi bi-chevron-down account-chevron d-none d-sm-inline"></i>
                    </button>

                    <div class="dropdown-menu dropdown-menu-end account-menu">
                        <div class="account-menu-header">
                            <div class="account-menu-name">
                                {{ $namaUser }}
                            </div>

                            <div class="account-menu-email">
                                {{ $user->email }}
                            </div>
                        </div>

                        <a
                            href="{{ route('siswa.profil.index') }}"
                            class="dropdown-item"
                        >
                            <i class="bi bi-person"></i>
                            Profil Saya
                        </a>

                        <div class="dropdown-divider"></div>

                        <form method="POST" action="{{ route('logout') }}" class="m-0">
                            @csrf

                            <button
                                type="submit"
                                class="dropdown-item account-logout"
                            >
                                <i class="bi bi-box-arrow-right"></i>
                                Keluar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

<main class="help-create-main">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('siswa.bantuan.index') }}">
                        Rujukan & Bantuan
                    </a>
                </li>

                <li class="breadcrumb-item active" aria-current="page">
                    Ajukan Bantuan
                </li>
            </ol>
        </nav>

        <section class="mb-4">
            <div class="page-kicker">
                Dukungan Siswa
            </div>

            <h1 class="page-title">
                Ajukan Bantuan
            </h1>

            <p class="page-copy">
                Ceritakan secara singkat bantuan yang kamu butuhkan. Permintaan ini akan diteruskan kepada Guru BK untuk ditindaklanjuti.
            </p>
        </section>

        <section class="privacy-box mb-3">
            <span class="privacy-icon">
                <i class="bi bi-shield-check"></i>
            </span>

            <div>
                <div class="privacy-title">
                    Informasi kamu akan dijaga
                </div>

                <p class="privacy-copy">
                    Permintaan bantuan hanya dapat diakses oleh pihak sekolah yang memiliki kewenangan untuk memberikan pendampingan.
                </p>
            </div>
        </section>

        @if ($errors->any())
            <div class="error-alert">
                <i class="bi bi-exclamation-circle-fill mt-1"></i>

                <div>
                    <div class="error-alert-title">
                        Periksa kembali data yang kamu masukkan.
                    </div>

                    <div>
                        Pastikan jenis bantuan dan cerita bantuan sudah diisi dengan benar.
                    </div>
                </div>
            </div>
        @endif

        <section class="form-card">
            <h2 class="form-section-title">
                Detail Permintaan
            </h2>

            <p class="form-section-copy">
                Pilih jenis bantuan yang paling sesuai lalu jelaskan bantuan yang sedang kamu perlukan.
            </p>

            <form
                method="POST"
                action="{{ route('siswa.bantuan.store') }}"
            >
                @csrf

                <div class="mb-4">
                    <label
                        for="jenis_bantuan"
                        class="form-label"
                    >
                        Jenis Bantuan
                        <span class="required-mark">*</span>
                    </label>

                    <select
                        id="jenis_bantuan"
                        name="jenis_bantuan"
                        class="form-select @error('jenis_bantuan') is-invalid @enderror"
                        required
                    >
                        <option value="">
                            Pilih jenis bantuan
                        </option>

                        <option
                            value="pendampingan"
                            {{ old('jenis_bantuan') === 'pendampingan' ? 'selected' : '' }}
                        >
                            Pendampingan Guru BK
                        </option>

                        <option
                            value="perundungan"
                            {{ old('jenis_bantuan') === 'perundungan' ? 'selected' : '' }}
                        >
                            Masalah Perundungan
                        </option>

                        <option
                            value="pribadi"
                            {{ old('jenis_bantuan') === 'pribadi' ? 'selected' : '' }}
                        >
                            Masalah Pribadi / Emosional
                        </option>

                        <option
                            value="akademik"
                            {{ old('jenis_bantuan') === 'akademik' ? 'selected' : '' }}
                        >
                            Masalah Akademik
                        </option>

                        <option
                            value="lainnya"
                            {{ old('jenis_bantuan') === 'lainnya' ? 'selected' : '' }}
                        >
                            Lainnya
                        </option>
                    </select>

                    @error('jenis_bantuan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                    <div class="form-text">
                        Pilih kategori yang paling sesuai dengan bantuan yang kamu butuhkan.
                    </div>
                </div>

                <div class="mb-4">
                    <label
                        for="pesan"
                        class="form-label"
                    >
                        Ceritakan yang Kamu Butuhkan
                        <span class="required-mark">*</span>
                    </label>

                    <textarea
                        id="pesan"
                        name="pesan"
                        class="form-control @error('pesan') is-invalid @enderror"
                        placeholder="Tuliskan secara singkat apa yang sedang kamu alami atau bantuan seperti apa yang kamu butuhkan..."
                        required
                    >{{ old('pesan') }}</textarea>

                    @error('pesan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                    <div class="form-text">
                        Kamu tidak perlu menuliskan informasi yang tidak ingin kamu sampaikan. Fokus pada bantuan yang sedang kamu butuhkan.
                    </div>
                </div>

                <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3 pt-2">
                    <p class="form-note">
                        Permintaan akan tercatat dan dapat dipantau melalui halaman Rujukan & Bantuan.
                    </p>

                    <div class="form-actions d-flex flex-column flex-sm-row gap-2">
                        <a
                            href="{{ route('siswa.bantuan.index') }}"
                            class="btn-ca-outline"
                        >
                            <i class="bi bi-arrow-left"></i>
                            Batal
                        </a>

                        <button
                            type="submit"
                            class="btn-ca-primary"
                        >
                            <i class="bi bi-send"></i>
                            Kirim Permintaan
                        </button>
                    </div>
                </div>
            </form>
        </section>
    </div>
</main>

<footer class="simple-footer">
    <div class="container">
        <span>
            © {{ date('Y') }} <strong>CurhatAman</strong>
        </span>

        <div class="footer-links">
            <a
                href="{{ route('siswa.bantuan.index') }}"
                class="footer-link"
            >
                Bantuan
            </a>

            <span class="footer-separator">
                •
            </span>

            <span>
                Privasi data dijaga sesuai hak akses.
            </span>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
