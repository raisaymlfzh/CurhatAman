<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skrining - CurhatAman</title>

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

        .screening-main {
            flex: 1;
            padding: 34px 0 38px;
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
            max-width: 760px;
            margin: 8px 0 0;
            color: var(--ca-muted);
            font-size: .9rem;
            line-height: 1.55;
        }

        .screening-notice {
            display: flex;
            align-items: flex-start;
            gap: 11px;
            padding: 15px 16px;
            margin-top: 18px;
            border: 1px solid #cfe3e0;
            border-radius: 10px;
            color: #315d59;
            background: #f3faf9;
            font-size: .77rem;
            line-height: 1.55;
        }

        .screening-notice-icon {
            width: 34px;
            height: 34px;
            border-radius: 9px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            color: var(--ca-primary);
            background: #ffffff;
        }


        .after-screening-card {
            margin-top: 12px;
            padding: 13px 14px;
            border: 1px solid var(--ca-border);
            border-radius: 10px;
            display: flex;
            align-items: flex-start;
            gap: 10px;
            background: #ffffff;
        }

        .after-screening-icon {
            width: 34px;
            height: 34px;
            flex: 0 0 34px;
            border-radius: 9px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: var(--ca-primary-dark);
            background: var(--ca-primary-soft);
            font-size: .9rem;
        }

        .after-screening-title {
            margin-bottom: 3px;
            color: var(--ca-text);
            font-size: .78rem;
            font-weight: 680;
        }

        .after-screening-copy {
            margin: 0;
            color: var(--ca-muted);
            font-size: .72rem;
            line-height: 1.55;
        }

        .privacy-note {
            margin-top: 6px;
            color: #56706d;
            font-size: .69rem;
            line-height: 1.5;
        }

        .aspect-card,
        .question-card {
            border: 1px solid var(--ca-border);
            border-radius: var(--ca-radius);
            background: var(--ca-surface);
        }

        .aspect-card {
            position: sticky;
            top: 92px;
            padding: 20px;
        }

        .aspect-heading {
            display: flex;
            align-items: center;
            gap: 10px;
            padding-bottom: 14px;
            margin-bottom: 14px;
            border-bottom: 1px solid var(--ca-line);
        }

        .aspect-heading-icon {
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

        .aspect-title {
            margin: 0;
            font-size: .92rem;
            font-weight: 680;
        }

        .aspect-subtitle {
            margin: 4px 0 0;
            color: var(--ca-muted);
            font-size: .72rem;
            line-height: 1.45;
        }

        .aspect-list {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .aspect-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            padding: 10px 11px;
            border: 1px solid transparent;
            border-radius: 9px;
            color: #475467;
            background: transparent;
        }

        .aspect-item:hover {
            color: var(--ca-primary-dark);
            background: #f8fbfa;
            border-color: var(--ca-border);
        }

        .aspect-item.active {
            color: var(--ca-primary-dark);
            background: var(--ca-primary-soft);
            border-color: #cfe3e0;
        }

        .aspect-name {
            font-size: .78rem;
            font-weight: 620;
        }

        .aspect-count {
            flex-shrink: 0;
            color: var(--ca-muted-light);
            font-size: .67rem;
        }

        .question-card {
            padding: 22px;
        }

        .question-top {
            display: flex;
            flex-wrap: wrap;
            align-items: flex-end;
            justify-content: space-between;
            gap: 14px;
        }

        .section-label {
            margin-bottom: 5px;
            color: var(--ca-primary);
            font-size: .69rem;
            font-weight: 740;
            letter-spacing: .055em;
            text-transform: uppercase;
        }

        .question-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 5px 8px;
            border-radius: 999px;
            color: var(--ca-primary-dark);
            background: var(--ca-primary-soft);
            font-size: .68rem;
            font-weight: 650;
        }

        .progress-copy {
            color: var(--ca-muted);
            font-size: .73rem;
        }

        .progress {
            height: 6px;
            margin: 13px 0 20px;
            border-radius: 999px;
            background: #e7efef;
        }

        .progress-bar {
            border-radius: 999px;
            background: var(--ca-primary);
        }

        .question-title {
            margin-bottom: 18px;
            color: var(--ca-text);
            font-size: 1.08rem;
            line-height: 1.5;
            font-weight: 680;
            letter-spacing: -.15px;
        }

        .answer-list {
            display: grid;
            gap: 9px;
        }

        .answer-input {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }

        .answer-card {
            width: 100%;
            display: flex;
            align-items: flex-start;
            gap: 11px;
            padding: 13px 14px;
            border: 1px solid var(--ca-border);
            border-radius: 10px;
            background: #ffffff;
            cursor: pointer;
            transition: border-color .15s ease, background .15s ease;
        }

        .answer-card:hover {
            border-color: #b8d7d3;
            background: #fcfefe;
        }

        .answer-input:checked + .answer-card {
            border-color: var(--ca-primary);
            background: #f3faf9;
        }

        .answer-radio {
            width: 17px;
            height: 17px;
            position: relative;
            flex-shrink: 0;
            margin-top: 2px;
            border: 1.5px solid #a8b6b5;
            border-radius: 50%;
            background: #ffffff;
        }

        .answer-input:checked + .answer-card .answer-radio {
            border-color: var(--ca-primary);
        }

        .answer-input:checked + .answer-card .answer-radio::after {
            content: "";
            width: 7px;
            height: 7px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            border-radius: 50%;
            background: var(--ca-primary);
        }

        .answer-title {
            margin-bottom: 2px;
            color: var(--ca-text);
            font-size: .81rem;
            font-weight: 650;
        }

        .answer-description {
            margin: 0;
            color: var(--ca-muted);
            font-size: .72rem;
            line-height: 1.45;
        }

        .screening-note {
            display: flex;
            align-items: flex-start;
            gap: 8px;
            padding: 11px 12px;
            margin-top: 17px;
            border: 1px solid var(--ca-border);
            border-radius: 9px;
            color: var(--ca-muted);
            background: #fbfcfc;
            font-size: .72rem;
            line-height: 1.5;
        }

        .screening-note i {
            margin-top: 1px;
            color: var(--ca-primary);
        }

        .question-actions {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            padding-top: 18px;
            margin-top: 18px;
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

            .aspect-card {
                position: static;
            }

            .screening-main {
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

            .aspect-card,
            .question-card {
                padding: 18px;
            }

            .question-title {
                font-size: 1rem;
            }

            .question-actions {
                align-items: stretch;
                flex-direction: column-reverse;
            }

            .question-actions .btn-ca-primary,
            .question-actions .btn-ca-outline {
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

    $total = $totalPertanyaan ?? 25;
    $nomorAktif = $nomor ?? 1;

    $progressValue = isset($progress)
        ? $progress
        : (($nomorAktif / max($total, 1)) * 100);

    $jawabanTersimpanValue = is_object($jawabanTersimpan)
        ? ($jawabanTersimpan->jawaban ?? null)
        : $jawabanTersimpan;

    $jawabanAktif = old(
        'jawaban',
        $jawabanTersimpanValue
    );

    $aspekKey = strtolower(
        str_replace(
            [' ', '-'],
            '_',
            $pertanyaan->aspek ?? ''
        )
    );

    $aspekMap = [
        'gejala_emosional' => [
            'label' => 'Gejala Emosional',
            'start' => 1,
        ],
        'masalah_perilaku' => [
            'label' => 'Masalah Perilaku',
            'start' => 6,
        ],
        'hiperaktivitas' => [
            'label' => 'Hiperaktivitas',
            'start' => 11,
        ],
        'masalah_teman_sebaya' => [
            'label' => 'Masalah Teman Sebaya',
            'start' => 16,
        ],
        'teman_sebaya' => [
            'label' => 'Masalah Teman Sebaya',
            'start' => 16,
        ],
        'perilaku_prososial' => [
            'label' => 'Perilaku Prososial',
            'start' => 21,
        ],
        'prososial' => [
            'label' => 'Perilaku Prososial',
            'start' => 21,
        ],
    ];

    $aspekLabel = $aspekMap[$aspekKey]['label']
        ?? ucwords(str_replace('_', ' ', $aspekKey));

    $sidebarAspek = [
        [
            'key' => 'gejala_emosional',
            'label' => 'Gejala Emosional',
            'start' => 1,
        ],
        [
            'key' => 'masalah_perilaku',
            'label' => 'Masalah Perilaku',
            'start' => 6,
        ],
        [
            'key' => 'hiperaktivitas',
            'label' => 'Hiperaktivitas',
            'start' => 11,
        ],
        [
            'key' => 'teman_sebaya',
            'label' => 'Masalah Teman Sebaya',
            'start' => 16,
        ],
        [
            'key' => 'prososial',
            'label' => 'Perilaku Prososial',
            'start' => 21,
        ],
    ];

    $opsiJawaban = [
        [
            'value' => 0,
            'title' => 'Tidak Benar',
            'description' => 'Sama sekali tidak mencerminkan diri saya',
        ],
        [
            'value' => 1,
            'title' => 'Agak Benar',
            'description' => 'Terkadang mencerminkan diri saya',
        ],
        [
            'value' => 2,
            'title' => 'Benar',
            'description' => 'Sangat mencerminkan diri saya',
        ],
    ];
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
                    <a href="{{ route('siswa.skrining.riwayat') }}" class="nav-link active">
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

<main class="screening-main">
    <div class="container">
        <section class="mb-4">
            <div class="page-kicker">
                Skrining
            </div>

            <h1 class="page-title">
                Skrining Kesehatan Mental Berkala
            </h1>

            <p class="page-subtitle">
                Isi pertanyaan SDQ secara bertahap sesuai keadaan atau pengalamanmu saat ini.
            </p>

            <div class="screening-notice">
                <span class="screening-notice-icon">
                    <i class="bi bi-heart-pulse"></i>
                </span>

                <div>
                    Strengths and Difficulties Questionnaire (SDQ) digunakan sebagai skrining awal untuk membantu proses pemantauan dan pendampingan siswa. Skrining ini bukan diagnosis klinis.
                </div>
            </div>

            <div class="after-screening-card">
                <span class="after-screening-icon">
                    <i class="bi bi-shield-check"></i>
                </span>

                <div>
                    <div class="after-screening-title">
                        Setelah skrining selesai
                    </div>

                    <p class="after-screening-copy">
                        Jawabanmu akan tersimpan dan digunakan sebagai bagian dari pemantauan serta pendampingan di sekolah. Guru BK dapat menghubungimu apabila diperlukan tindak lanjut.
                    </p>

                    <div class="privacy-note">
                        Kamu tidak perlu menilai atau menafsirkan hasil skrining sendiri. Jika dibutuhkan, Guru BK akan membantu menjelaskan langkah pendampingan yang sesuai.
                    </div>
                </div>
            </div>
        </section>

        <div class="row g-3 align-items-start">
            <div class="col-lg-4 col-xl-3">
                <aside class="aspect-card">
                    <div class="aspect-heading">
                        <span class="aspect-heading-icon">
                            <i class="bi bi-list-check"></i>
                        </span>

                        <div>
                            <h2 class="aspect-title">
                                Aspek Pengukuran SDQ
                            </h2>

                            <p class="aspect-subtitle">
                                Setiap aspek terdiri dari 5 pertanyaan.
                            </p>
                        </div>
                    </div>

                    <div class="aspect-list">
                        @foreach ($sidebarAspek as $aspek)
                            @php
                                $isActive =
                                    (
                                        $aspek['key'] === $aspekKey
                                        ||
                                        (
                                            $aspek['key'] === 'teman_sebaya'
                                            && $aspekKey === 'masalah_teman_sebaya'
                                        )
                                        ||
                                        (
                                            $aspek['key'] === 'prososial'
                                            && $aspekKey === 'perilaku_prososial'
                                        )
                                    );
                            @endphp

                            <a
                                href="{{ route('siswa.skrining.index', ['nomor' => $aspek['start']]) }}"
                                class="aspect-item {{ $isActive ? 'active' : '' }}"
                            >
                                <span class="aspect-name">
                                    {{ $aspek['label'] }}
                                </span>

                                <span class="aspect-count">
                                    5 soal
                                </span>
                            </a>
                        @endforeach
                    </div>
                </aside>
            </div>

            <div class="col-lg-8 col-xl-9">
                <section class="question-card">
                    <div class="question-top">
                        <div>
                            <div class="section-label">
                                {{ $aspekLabel }}
                            </div>

                            <div class="question-badge">
                                <i class="bi bi-list-check"></i>
                                Pertanyaan {{ $nomorAktif }} dari {{ $total }}
                            </div>
                        </div>

                        <div class="progress-copy">
                            Progres {{ round($progressValue) }}%
                        </div>
                    </div>

                    <div
                        class="progress"
                        role="progressbar"
                        aria-label="Progres skrining"
                        aria-valuenow="{{ round($progressValue) }}"
                        aria-valuemin="0"
                        aria-valuemax="100"
                    >
                        <div
                            class="progress-bar"
                            style="width: {{ min(100, $progressValue) }}%"
                        ></div>
                    </div>

                    <h2 class="question-title">
                        {{ $pertanyaan->pertanyaan }}
                    </h2>

                    @if ($errors->any())
                        <div
                            class="alert alert-danger d-flex align-items-center gap-2 small mb-3"
                            role="alert"
                        >
                            <i class="bi bi-exclamation-circle-fill"></i>

                            <span>
                                {{ $errors->first() }}
                            </span>
                        </div>
                    @endif

                    <form
                        method="POST"
                        action="{{ route('siswa.skrining.answer') }}"
                    >
                        @csrf

                        <input
                            type="hidden"
                            name="pertanyaan_id"
                            value="{{ $pertanyaan->id }}"
                        >

                        <input
                            type="hidden"
                            name="nomor"
                            value="{{ $nomorAktif }}"
                        >

                        <div class="answer-list">
                            @foreach ($opsiJawaban as $opsi)
                                <div>
                                    <input
                                        type="radio"
                                        class="answer-input"
                                        name="jawaban"
                                        id="jawaban_{{ $opsi['value'] }}"
                                        value="{{ $opsi['value'] }}"
                                        {{ (string) $jawabanAktif === (string) $opsi['value'] ? 'checked' : '' }}
                                        required
                                    >

                                    <label
                                        for="jawaban_{{ $opsi['value'] }}"
                                        class="answer-card"
                                    >
                                        <span class="answer-radio"></span>

                                        <span>
                                            <span class="answer-title d-block">
                                                {{ $opsi['title'] }}
                                            </span>

                                            <span class="answer-description d-block">
                                                {{ $opsi['description'] }}
                                            </span>
                                        </span>
                                    </label>
                                </div>
                            @endforeach
                        </div>

                        <div class="screening-note">
                            <i class="bi bi-info-circle"></i>

                            <span>
                                Pilih jawaban yang paling sesuai dengan keadaan atau pengalamanmu saat ini.
                            </span>
                        </div>

                        <div class="question-actions">
                            <div>
                                @if ($nomorAktif > 1)
                                    <a
                                        href="{{ route('siswa.skrining.index', ['nomor' => $nomorAktif - 1]) }}"
                                        class="btn-ca-outline"
                                    >
                                        <i class="bi bi-arrow-left"></i>
                                        Sebelumnya
                                    </a>
                                @endif
                            </div>

                            <button
                                type="submit"
                                class="btn-ca-primary"
                            >
                                @if ($nomorAktif < $total)
                                    Selanjutnya
                                    <i class="bi bi-arrow-right"></i>
                                @else
                                    Selesaikan Skrining
                                    <i class="bi bi-check-circle"></i>
                                @endif
                            </button>
                        </div>
                    </form>
                </section>
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
                Hasil skrining digunakan untuk pemantauan dan pendampingan. Guru BK dapat menghubungimu jika tindak lanjut diperlukan.
            </span>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
