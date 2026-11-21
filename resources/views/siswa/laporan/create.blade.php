<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Laporan - CurhatAman</title>

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

        .page-main {
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

        .page-subtitle {
            margin: 8px 0 0;
            color: var(--ca-muted);
            font-size: .9rem;
            line-height: 1.55;
        }

        .form-card,
        .info-card {
            border: 1px solid var(--ca-border);
            border-radius: var(--ca-radius);
            background: var(--ca-surface);
        }

        .form-card {
            padding: 24px;
        }

        .info-card {
            position: sticky;
            top: 92px;
            padding: 20px;
        }

        .form-section {
            padding-bottom: 24px;
            margin-bottom: 24px;
            border-bottom: 1px solid var(--ca-line);
        }

        .form-section:last-of-type {
            padding-bottom: 0;
            margin-bottom: 22px;
            border-bottom: 0;
        }

        .section-title {
            display: flex;
            align-items: center;
            gap: 9px;
            margin-bottom: 15px;
            color: var(--ca-text);
            font-size: .92rem;
            font-weight: 680;
        }

        .section-number {
            width: 26px;
            height: 26px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            border-radius: 8px;
            color: var(--ca-primary-dark);
            background: var(--ca-primary-soft);
            font-size: .72rem;
            font-weight: 720;
        }

        .form-label {
            margin-bottom: 6px;
            color: #344054;
            font-size: .8rem;
            font-weight: 620;
        }

        .form-control {
            min-height: 42px;
            border: 1px solid #d9e1e1;
            border-radius: 9px;
            color: var(--ca-text);
            background: #ffffff;
            font-size: .82rem;
        }

        .form-control::placeholder {
            color: var(--ca-muted-light);
        }

        .form-control:focus {
            border-color: var(--ca-primary);
            box-shadow: 0 0 0 .18rem rgba(15, 138, 131, .08);
        }

        textarea.form-control {
            min-height: 130px;
            resize: vertical;
        }

        .field-error {
            margin-top: 6px;
            color: var(--ca-danger);
            font-size: .73rem;
        }

        .category-card,
        .privacy-card {
            height: 100%;
            display: block;
            padding: 14px;
            border: 1px solid var(--ca-border);
            border-radius: 10px;
            background: #ffffff;
            cursor: pointer;
            transition: border-color .15s ease, background .15s ease;
        }

        .category-card:hover,
        .privacy-card:hover {
            border-color: #b8d7d3;
            background: #fcfefe;
        }

        .category-card:has(input:checked),
        .privacy-card:has(input:checked) {
            border-color: var(--ca-primary);
            background: #f3faf9;
        }

        .category-card input,
        .privacy-card input {
            accent-color: var(--ca-primary);
        }

        .category-name,
        .privacy-title {
            display: block;
            margin-top: 10px;
            margin-bottom: 4px;
            color: var(--ca-text);
            font-size: .81rem;
            font-weight: 650;
        }

        .category-copy,
        .privacy-copy {
            margin: 0;
            color: var(--ca-muted);
            font-size: .73rem;
            line-height: 1.48;
        }

        .upload-area {
            width: 100%;
            padding: 24px;
            border: 1px dashed #a8cbc8;
            border-radius: 10px;
            background: #fbfdfd;
        }

        .upload-area:hover {
            border-color: var(--ca-primary);
            background: #f8fbfa;
        }

        .upload-icon {
            width: 42px;
            height: 42px;
            margin-bottom: 11px;
            border-radius: 9px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: var(--ca-primary);
            background: var(--ca-primary-soft);
            font-size: 1rem;
        }

        .upload-title {
            margin-bottom: 4px;
            font-size: .87rem;
            font-weight: 650;
        }

        .upload-copy {
            margin-bottom: 12px;
            color: var(--ca-muted);
            font-size: .75rem;
        }

        .selected-files {
            display: grid;
            gap: 9px;
        }

        .file-item {
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 10px;
            border: 1px solid var(--ca-border);
            border-radius: 9px;
            background: #ffffff;
        }

        .file-preview {
            width: 56px;
            height: 56px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            overflow: hidden;
            border: 1px solid var(--ca-border);
            border-radius: 8px;
            background: #f8faf9;
        }

        .file-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .pdf-preview {
            color: var(--ca-danger);
            text-align: center;
            font-size: .62rem;
            font-weight: 700;
        }

        .pdf-preview i {
            display: block;
            margin-bottom: 2px;
            font-size: 1.45rem;
        }

        .file-meta {
            min-width: 0;
            flex: 1;
        }

        .file-name {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            color: var(--ca-text);
            font-size: .78rem;
            font-weight: 600;
        }

        .file-size {
            margin-top: 2px;
            color: var(--ca-muted);
            font-size: .69rem;
        }

        .remove-file {
            width: 32px;
            height: 32px;
            border: 0;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            color: var(--ca-danger);
            background: #fff4f3;
        }

        .remove-file:hover {
            background: #fee8e6;
        }

        .upload-actions {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding-top: 12px;
            margin-top: 12px;
            border-top: 1px solid var(--ca-line);
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
            font-size: .82rem;
            font-weight: 650;
        }

        .btn-ca-primary {
            color: #ffffff;
            background: var(--ca-primary);
            border: 1px solid var(--ca-primary);
        }

        .btn-ca-primary:hover,
        .btn-ca-primary:focus {
            color: #ffffff;
            background: var(--ca-primary-dark);
            border-color: var(--ca-primary-dark);
        }

        .btn-ca-outline {
            color: #475467;
            background: #ffffff;
            border: 1px solid #a7b5b4;
        }

        .btn-ca-outline:hover,
        .btn-ca-outline:focus {
            color: var(--ca-primary-dark);
            background: #f8fbfa;
            border-color: #8ec9c4;
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 8px;
        }

        .info-heading {
            display: flex;
            align-items: center;
            gap: 10px;
            padding-bottom: 14px;
            margin-bottom: 16px;
            border-bottom: 1px solid var(--ca-line);
            font-size: .92rem;
            font-weight: 680;
        }

        .info-heading-icon {
            width: 36px;
            height: 36px;
            border-radius: 9px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            color: var(--ca-primary);
            background: var(--ca-primary-soft);
            font-size: .9rem;
        }

        .info-item {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 16px;
        }

        .info-item:last-child {
            margin-bottom: 0;
        }

        .info-item-icon {
            margin-top: 2px;
            color: var(--ca-primary);
            font-size: .88rem;
        }

        .info-item strong {
            display: block;
            margin-bottom: 3px;
            font-size: .78rem;
            font-weight: 650;
        }

        .info-item p {
            margin: 0;
            color: var(--ca-muted);
            font-size: .72rem;
            line-height: 1.5;
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

            .info-card {
                position: static;
            }

            .page-main {
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

            .form-card,
            .info-card {
                padding: 18px;
            }

            .form-actions {
                flex-direction: column-reverse;
            }

            .form-actions .btn-ca-primary,
            .form-actions .btn-ca-outline {
                width: 100%;
            }

            .upload-actions {
                align-items: flex-start;
                flex-direction: column;
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
                    <a href="{{ route('siswa.laporan.index') }}" class="nav-link active">
                        Laporan Saya
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('siswa.skrining.riwayat') }}" class="nav-link">
                        Skrining
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('siswa.bantuan.index') }}" class="nav-link">
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

<main class="page-main">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('siswa.laporan.index') }}">
                        Laporan Saya
                    </a>
                </li>

                <li class="breadcrumb-item active" aria-current="page">
                    Buat Laporan
                </li>
            </ol>
        </nav>

        <section class="mb-4">
            <div class="page-kicker">
                Pelaporan
            </div>

            <h1 class="page-title">
                Buat Laporan
            </h1>

            <p class="page-subtitle">
                Isi informasi sesuai kejadian yang kamu alami atau ketahui. Data akan diteruskan kepada Guru BK yang berwenang.
            </p>
        </section>

        <div class="row g-3 align-items-start">
            <div class="col-lg-8">
                <section class="form-card">
                    @if ($errors->any())
                        <div class="alert alert-danger d-flex align-items-start gap-2 mb-4">
                            <i class="bi bi-exclamation-circle-fill mt-1"></i>

                            <div>
                                <strong>
                                    Periksa kembali formulir.
                                </strong>

                                <ul class="mb-0 mt-1 ps-3 small">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    <form
                        method="POST"
                        action="{{ route('siswa.laporan.store') }}"
                        enctype="multipart/form-data"
                        id="reportForm"
                    >
                        @csrf

                        <div class="form-section">
                            <div class="section-title">
                                <span class="section-number">
                                    1
                                </span>

                                <span>
                                    Pilih Kategori Bullying
                                </span>
                            </div>

                            <div class="row g-3">
                                @foreach ($kategori as $item)
                                    <div class="col-sm-6 col-xl-3">
                                        <label class="category-card">
                                            <input
                                                type="radio"
                                                name="kategori_id"
                                                value="{{ $item->id }}"
                                                {{ old('kategori_id') == $item->id ? 'checked' : '' }}
                                                required
                                            >

                                            <strong class="category-name">
                                                {{ $item->nama_kategori }}
                                            </strong>

                                            <p class="category-copy">
                                                {{ $item->deskripsi }}
                                            </p>
                                        </label>
                                    </div>
                                @endforeach
                            </div>

                            @error('kategori_id')
                                <div class="field-error">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-section">
                            <div class="section-title">
                                <span class="section-number">
                                    2
                                </span>

                                <span>
                                    Detail Kronologi Kejadian
                                </span>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-5">
                                    <label
                                        for="tanggal_kejadian"
                                        class="form-label"
                                    >
                                        Tanggal Kejadian
                                    </label>

                                    <input
                                        type="date"
                                        id="tanggal_kejadian"
                                        name="tanggal_kejadian"
                                        class="form-control @error('tanggal_kejadian') is-invalid @enderror"
                                        value="{{ old('tanggal_kejadian') }}"
                                        required
                                    >

                                    @error('tanggal_kejadian')
                                        <div class="field-error">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-7">
                                    <label
                                        for="lokasi_kejadian"
                                        class="form-label"
                                    >
                                        Lokasi Kejadian
                                    </label>

                                    <input
                                        type="text"
                                        id="lokasi_kejadian"
                                        name="lokasi_kejadian"
                                        class="form-control @error('lokasi_kejadian') is-invalid @enderror"
                                        placeholder="Contoh: Kantin belakang sekolah"
                                        value="{{ old('lokasi_kejadian') }}"
                                    >

                                    @error('lokasi_kejadian')
                                        <div class="field-error">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label
                                        for="deskripsi"
                                        class="form-label"
                                    >
                                        Ceritakan Kejadian
                                    </label>

                                    <textarea
                                        id="deskripsi"
                                        name="deskripsi"
                                        class="form-control @error('deskripsi') is-invalid @enderror"
                                        placeholder="Ceritakan kronologi kejadian secara jelas..."
                                        required
                                    >{{ old('deskripsi') }}</textarea>

                                    @error('deskripsi')
                                        <div class="field-error">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-section">
                            <div class="section-title">
                                <span class="section-number">
                                    3
                                </span>

                                <span>
                                    Bukti Pendukung
                                    <span class="text-secondary fw-normal">
                                        (Opsional)
                                    </span>
                                </span>
                            </div>

                            <div class="upload-area" id="uploadArea">
                                <input
                                    type="file"
                                    id="bukti"
                                    name="bukti[]"
                                    class="d-none"
                                    accept=".jpg,.jpeg,.png,.pdf"
                                    multiple
                                >

                                <div id="uploadPlaceholder" class="text-center">
                                    <span class="upload-icon">
                                        <i class="bi bi-cloud-arrow-up"></i>
                                    </span>

                                    <div class="upload-title">
                                        Pilih Foto, Screenshot, atau PDF
                                    </div>

                                    <div class="upload-copy">
                                        JPG, PNG, atau PDF • maksimal 5 MB per file
                                    </div>

                                    <button
                                        type="button"
                                        class="btn-ca-outline"
                                        id="chooseFileButton"
                                    >
                                        <i class="bi bi-folder2-open"></i>
                                        Pilih File
                                    </button>
                                </div>

                                <div id="filePreviewArea" class="d-none">
                                    <div
                                        id="selectedFiles"
                                        class="selected-files"
                                    ></div>

                                    <div class="upload-actions">
                                        <div
                                            id="fileCount"
                                            class="small text-secondary"
                                        ></div>

                                        <button
                                            type="button"
                                            class="btn-ca-outline"
                                            id="addMoreFilesButton"
                                        >
                                            <i class="bi bi-plus-lg"></i>
                                            Tambah / Ganti File
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div
                                id="uploadError"
                                class="field-error d-none"
                            ></div>

                            @error('bukti')
                                <div class="field-error">
                                    {{ $message }}
                                </div>
                            @enderror

                            @error('bukti.*')
                                <div class="field-error">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-section">
                            <div class="section-title">
                                <span class="section-number">
                                    4
                                </span>

                                <span>
                                    Atur Kerahasiaan Identitas
                                </span>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="privacy-card">
                                        <input
                                            type="radio"
                                            name="status_rahasia"
                                            value="1"
                                            {{ old('status_rahasia', '1') == '1' ? 'checked' : '' }}
                                        >

                                        <strong class="privacy-title">
                                            Kirim Sebagai Rahasia
                                        </strong>

                                        <p class="privacy-copy">
                                            Identitasmu tetap dapat dilihat Guru BK yang berwenang, tetapi tidak ditampilkan kepada pihak yang tidak memiliki kewenangan penanganan.
                                        </p>
                                    </label>
                                </div>

                                <div class="col-md-6">
                                    <label class="privacy-card">
                                        <input
                                            type="radio"
                                            name="status_rahasia"
                                            value="0"
                                            {{ old('status_rahasia') == '0' ? 'checked' : '' }}
                                        >

                                        <strong class="privacy-title">
                                            Gunakan Identitas Asli
                                        </strong>

                                        <p class="privacy-copy">
                                            Identitas digunakan secara terbuka dalam proses internal sesuai kebutuhan penanganan dan kewenangan pihak sekolah.
                                        </p>
                                    </label>
                                </div>
                            </div>

                            @error('status_rahasia')
                                <div class="field-error">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-actions">
                            <button
                                type="submit"
                                name="action"
                                value="draft"
                                class="btn-ca-outline"
                            >
                                <i class="bi bi-save"></i>
                                Simpan Draft
                            </button>

                            <button
                                type="submit"
                                name="action"
                                value="submit"
                                class="btn-ca-primary"
                            >
                                Kirim Laporan
                                <i class="bi bi-arrow-right"></i>
                            </button>
                        </div>
                    </form>
                </section>
            </div>

            <div class="col-lg-4">
                <aside class="info-card">
                    <div class="info-heading">
                        <span class="info-heading-icon">
                            <i class="bi bi-shield-check"></i>
                        </span>

                        <span>
                            Perlindungan Data
                        </span>
                    </div>

                    <div class="info-item">
                        <i class="bi bi-lock info-item-icon"></i>

                        <div>
                            <strong>
                                Akses Terbatas
                            </strong>

                            <p>
                                Informasi laporan hanya dapat diakses sesuai kewenangan dan kebutuhan penanganan.
                            </p>
                        </div>
                    </div>

                    <div class="info-item">
                        <i class="bi bi-person-check info-item-icon"></i>

                        <div>
                            <strong>
                                Ditangani Guru BK
                            </strong>

                            <p>
                                Guru BK yang berwenang dapat melihat laporan untuk memberikan tindak lanjut.
                            </p>
                        </div>
                    </div>

                    <div class="info-item">
                        <i class="bi bi-eye-slash info-item-icon"></i>

                        <div>
                            <strong>
                                Bukti Dilindungi
                            </strong>

                            <p>
                                Foto, screenshot, atau PDF yang diunggah merupakan bagian dari informasi laporan dan tidak ditampilkan sembarangan.
                            </p>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
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
<script>
document.addEventListener('DOMContentLoaded', function () {

        const fileInput =
            document.getElementById('bukti');

        const chooseFileButton =
            document.getElementById('chooseFileButton');

        const addMoreFilesButton =
            document.getElementById('addMoreFilesButton');

        const uploadPlaceholder =
            document.getElementById('uploadPlaceholder');

        const filePreviewArea =
            document.getElementById('filePreviewArea');

        const selectedFiles =
            document.getElementById('selectedFiles');

        const fileCount =
            document.getElementById('fileCount');

        const uploadError =
            document.getElementById('uploadError');

        const allowedTypes = [
            'image/jpeg',
            'image/png',
            'application/pdf'
        ];

        const maxFileSize =
            5 * 1024 * 1024;

        
        const transfer =
            new DataTransfer();

        chooseFileButton.addEventListener(
            'click',
            function () {
                fileInput.click();
            }
        );

        addMoreFilesButton.addEventListener(
            'click',
            function () {
                fileInput.click();
            }
        );

        fileInput.addEventListener(
            'change',
            function () {

                clearUploadError();

                const incomingFiles =
                    Array.from(this.files);

                incomingFiles.forEach(
                    function (file) {

                        if (!allowedTypes.includes(file.type)) {

                            showUploadError(
                                'Format file harus JPG, PNG, atau PDF.'
                            );

                            return;
                        }

                        if (file.size > maxFileSize) {

                            showUploadError(
                                `File "${file.name}" melebihi ukuran maksimal 5 MB.`
                            );

                            return;
                        }

                        
                        const duplicate =
                            Array.from(transfer.files)
                                .some(function (existingFile) {

                                    return (
                                        existingFile.name === file.name &&
                                        existingFile.size === file.size &&
                                        existingFile.lastModified === file.lastModified
                                    );

                                });

                        if (!duplicate) {
                            transfer.items.add(file);
                        }

                    }
                );

                fileInput.files =
                    transfer.files;

                renderFiles();

            }
        );

        function renderFiles() {

            selectedFiles.innerHTML = '';

            if (transfer.files.length === 0) {

                uploadPlaceholder.classList.remove('d-none');

                filePreviewArea.classList.add('d-none');

                fileCount.textContent = '';

                return;
            }

            uploadPlaceholder.classList.add('d-none');

            filePreviewArea.classList.remove('d-none');

            Array
                .from(transfer.files)
                .forEach(function (file, index) {

                    const item =
                        document.createElement('div');

                    item.className =
                        'file-item';

                    const preview =
                        document.createElement('div');

                    preview.className =
                        'file-preview';

                    if (file.type.startsWith('image/')) {

                        const image =
                            document.createElement('img');

                        image.alt =
                            'Preview ' + file.name;

                        const reader =
                            new FileReader();

                        reader.onload =
                            function (event) {

                                image.src =
                                    event.target.result;

                            };

                        reader.readAsDataURL(file);

                        preview.appendChild(image);

                    } else {

                        preview.innerHTML = `
                            <div class="pdf-preview">
                                <i class="bi bi-file-earmark-pdf"></i>
                                PDF
                            </div>
                        `;

                    }

                    const meta =
                        document.createElement('div');

                    meta.className =
                        'file-meta';

                    const name =
                        document.createElement('div');

                    name.className =
                        'file-name';

                    name.textContent =
                        file.name;

                    const size =
                        document.createElement('div');

                    size.className =
                        'file-size';

                    size.textContent =
                        formatFileSize(file.size);

                    meta.appendChild(name);
                    meta.appendChild(size);

                    const removeButton =
                        document.createElement('button');

                    removeButton.type =
                        'button';

                    removeButton.className =
                        'remove-file';

                    removeButton.setAttribute(
                        'aria-label',
                        'Hapus ' + file.name
                    );

                    removeButton.innerHTML =
                        '<i class="bi bi-trash"></i>';

                    removeButton.addEventListener(
                        'click',
                        function () {
                            removeFile(index);
                        }
                    );

                    item.appendChild(preview);
                    item.appendChild(meta);
                    item.appendChild(removeButton);

                    selectedFiles.appendChild(item);

                });

            fileCount.textContent =
                transfer.files.length
                + ' file dipilih';

        }

        function removeFile(indexToRemove) {

            const nextTransfer =
                new DataTransfer();

            Array
                .from(transfer.files)
                .forEach(function (file, index) {

                    if (index !== indexToRemove) {
                        nextTransfer.items.add(file);
                    }

                });

            
            while (transfer.items.length > 0) {
                transfer.items.remove(0);
            }

            Array
                .from(nextTransfer.files)
                .forEach(function (file) {
                    transfer.items.add(file);
                });

            fileInput.files =
                transfer.files;

            renderFiles();

        }

        function formatFileSize(bytes) {

            if (bytes < 1024) {
                return bytes + ' B';
            }

            const kb =
                bytes / 1024;

            if (kb < 1024) {
                return kb.toFixed(1) + ' KB';
            }

            const mb =
                kb / 1024;

            return mb.toFixed(2) + ' MB';

        }

        function showUploadError(message) {

            uploadError.textContent =
                message;

            uploadError.classList.remove(
                'd-none'
            );

        }

        function clearUploadError() {

            uploadError.textContent =
                '';

            uploadError.classList.add(
                'd-none'
            );

        }

    });
</script>
</body>
</html>
