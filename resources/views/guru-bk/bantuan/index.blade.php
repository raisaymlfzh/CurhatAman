<!DOCTYPE html>

<html lang="id">



<head>

    <meta charset="UTF-8">

    <meta

        name="viewport"

        content="width=device-width, initial-scale=1.0"

    >



    <title>Permintaan Bantuan - Guru BK - CurhatAman</title>



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

            --ca-bg: #f6f8f9;

            --ca-surface: #ffffff;

            --ca-border: #e3e9e9;

            --sidebar-width: 252px;

            --topbar-height: 72px;

        }



        \* { box-sizing: border-box; }



        html,

        body { min-height: 100%; }



        body {

            min-height: 100vh;

            margin: 0;

            color: var(--ca-text);

            background: var(--ca-bg);

            font-family:

                system-ui,

                -apple-system,

                "Segoe UI",

                Roboto,

                "Helvetica Neue",

                Arial,

                sans-serif;

            font-size: 14px;

        }



        a { text-decoration: none; }



        .app-shell {

            min-height: 100vh;

            display: grid;

            grid-template-columns: var(--sidebar-width) minmax(0, 1fr);

            grid-template-rows: var(--topbar-height) minmax(0, 1fr);

        }





        .sidebar {

            grid-row: 1 / 3;

            min-height: 100vh;

            display: flex;

            flex-direction: column;

            padding: 20px 16px;

            background: #fff;

            border-right: 1px solid var(--ca-border);

        }



        .sidebar-brand {

            display: flex;

            align-items: center;

            gap: 10px;

            min-height: 48px;

            margin-bottom: 30px;

            padding: 0 8px;

        }



        .brand-symbol {

            width: 40px;

            height: 40px;

            display: inline-flex;

            align-items: center;

            justify-content: center;

            flex-shrink: 0;

            border-radius: 10px;

            color: #fff;

            background: var(--ca-primary);

            box-shadow: 0 4px 12px rgba(15,138,131,.12);

            font-size: 1.08rem;

        }



        .brand-copy { min-width: 0; }



        .brand-name {

            display: block;

            color: var(--ca-primary);

            font-size: 1.08rem;

            font-weight: 750;

            letter-spacing: -.25px;

        }



        .brand-role {

            display: block;

            margin-top: 1px;

            color: var(--ca-muted);

            font-size: 11px;

            font-weight: 600;

        }



        .sidebar-section-label {

            margin: 0 10px 9px;

            color: #98a2b3;

            font-size: 11px;

            font-weight: 750;

            letter-spacing: .08em;

            text-transform: uppercase;

        }



        .sidebar-nav {

            display: flex;

            flex-direction: column;

            gap: 4px;

        }



        .sidebar-link {

            display: flex;

            align-items: center;

            gap: 11px;

            min-height: 42px;

            padding: 10px 11px;

            border-radius: 9px;

            color: #475467;

            font-size: 13px;

            font-weight: 560;

            transition: background .16s ease, color .16s ease;

        }



        .sidebar-link i {

            width: 19px;

            color: #7b8795;

            font-size: .93rem;

            text-align: center;

        }



        .sidebar-link:hover {

            color: var(--ca-primary-dark);

            background: #f4f9f8;

        }



        .sidebar-link:hover i { color: var(--ca-primary); }



        .sidebar-link.active {

            color: var(--ca-primary-dark);

            background: var(--ca-primary-soft);

            font-weight: 680;

        }



        .sidebar-link.active i { color: var(--ca-primary); }



        .sidebar-link.disabled {

            cursor: default;

            color: #667085;

        }



        .sidebar-link.disabled:hover {

            color: #667085;

            background: transparent;

        }



        .sidebar-link.disabled:hover i { color: #7b8795; }



        .sidebar-spacer { flex: 1; }



        .sidebar-account {

            margin-top: 24px;

            padding-top: 18px;

            border-top: 1px solid #edf1f1;

        }



        .sidebar-user {

            display: flex;

            align-items: center;

            gap: 10px;

            padding: 0 8px 12px;

        }



        .sidebar-avatar,

        .topbar-avatar {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            flex-shrink: 0;

            border-radius: 50%;

            color: var(--ca-primary-dark);

            background: #dcefeb;

            font-weight: 750;

        }



        .sidebar-avatar {

            width: 36px;

            height: 36px;

            font-size: 13px;

        }



        .sidebar-user-copy { min-width: 0; }



        .sidebar-user-name {

            overflow: hidden;

            text-overflow: ellipsis;

            white-space: nowrap;

            color: var(--ca-text);

            font-size: 13px;

            font-weight: 680;

        }



        .sidebar-user-role {

            margin-top: 1px;

            color: var(--ca-muted);

            font-size: 11px;

        }



        .logout-button {

            width: 100%;

            display: flex;

            align-items: center;

            gap: 10px;

            min-height: 40px;

            padding: 9px 11px;

            border: 0;

            border-radius: 9px;

            color: #b42318;

            background: transparent;

            font-size: 13px;

            font-weight: 560;

            text-align: left;

        }



        .logout-button:hover { background: #fff3f2; }





        .topbar {

            grid-column: 2;

            min-width: 0;

            height: var(--topbar-height);

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 18px;

            padding: 0 34px;

            background: #ffffff;

            border-bottom: 1px solid var(--ca-border);

        }



        .topbar-left {

            display: flex;

            align-items: center;

            gap: 10px;

        }



        .topbar-title {

            margin-bottom: 2px;

            color: var(--ca-text);

            font-size: .92rem;

            font-weight: 700;

        }



        .topbar-subtitle {

            color: var(--ca-muted);

            font-size: 11.5px;

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







        .main-content {

            grid-column: 2;

            min-width: 0;

            min-height: calc(100vh - var(--topbar-height));

            display: flex;

            flex-direction: column;

        }



        .page-body {

            flex: 1;

            display: flex;

            flex-direction: column;

            padding: 34px;

        }



        .content-shell {

            width: 100%;

            max-width: 1280px;

            min-height: 100%;

            margin: 0 auto;

            display: flex;

            flex-direction: column;

        }



        /* HERO: disamakan dengan halaman Skrining Siswa */
        .page-hero {
            min-height: 138px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
            padding: 26px 32px;
            border-radius: 16px;
            background: var(--ca-primary);
            color: #fff;
        }

        .page-hero-copy {
            min-width: 0;
        }

        .page-kicker {
            margin-bottom: 9px;
            color: rgba(255,255,255,.78);
            font-size: .74rem;
            font-weight: 750;
            letter-spacing: .07em;
            text-transform: uppercase;
        }

        .page-title {
            margin: 0 0 7px;
            color: #fff;
            font-size: 1.85rem;
            font-weight: 760;
            letter-spacing: -.45px;
            line-height: 1.15;
        }

        .page-copy {
            max-width: 760px;
            margin: 0;
            color: rgba(255,255,255,.92);
            font-size: .86rem;
            line-height: 1.55;
        }



        .metric-card {

            height: 100%;

            padding: 18px;

            border: 1px solid var(--ca-border);

            border-radius: 12px;

            background: #fff;

        }



        .metric-label {

            color: var(--ca-muted);

            font-size: .78rem;

            font-weight: 620;

        }



        .metric-number {

            margin-top: 9px;

            color: var(--ca-text);

            font-size: 1.45rem;

            font-weight: 760;

            line-height: 1;

        }



        .metric-icon {

            width: 35px;

            height: 35px;

            display: inline-flex;

            align-items: center;

            justify-content: center;

            flex-shrink: 0;

            border-radius: 9px;

            color: var(--ca-primary-dark);

            background: var(--ca-primary-soft);

            font-size: .88rem;

        }



        .filter-card {

            padding: 18px;

            margin-bottom: 18px;

            border: 1px solid var(--ca-border);

            border-radius: 12px;

            background: #fff;

        }



        .form-label {

            margin-bottom: 7px;

            color: #475467;

            font-size: .8rem;

            font-weight: 620;

        }



        .form-control,

        .form-select {

            min-height: 42px;

            border: 1px solid #d8e1e1;

            border-radius: 9px;

            color: var(--ca-text);

            background-color: #fff;

            font-size: .84rem;

        }



        .form-control:focus,

        .form-select:focus {

            border-color: var(--ca-primary);

            box-shadow: 0 0 0 .2rem rgba(15,138,131,.09);

        }



        .btn-filter,

        .btn-save {

            min-height: 42px;

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: 7px;

            padding: 8px 15px;

            border: 1px solid var(--ca-primary);

            border-radius: 9px;

            color: #fff;

            background: var(--ca-primary);

            font-size: .82rem;

            font-weight: 620;

        }



        .btn-filter:hover,

        .btn-save:hover {

            color: #fff;

            background: var(--ca-primary-dark);

            border-color: var(--ca-primary-dark);

        }



        .btn-reset {

            min-height: 42px;

            display: inline-flex;

            align-items: center;

            justify-content: center;

            padding: 8px 13px;

            border: 1px solid var(--ca-border);

            border-radius: 9px;

            color: #475467;

            background: #fff;

            font-size: .82rem;

        }



        .btn-reset:hover {

            color: var(--ca-primary-dark);

            background: var(--ca-primary-soft);

        }



        .period-context {

            min-height: 42px;

            display: flex;

            align-items: center;

            gap: 10px;

            padding: 9px 12px;

            border: 1px solid #cfe4e1;

            border-radius: 9px;

            color: #475467;

            background: #f7fbfa;

            font-size: .76rem;

            line-height: 1.45;

        }



        .period-context i {

            color: var(--ca-primary-dark);

        }



        .period-context strong {

            color: var(--ca-primary-dark);

        }



        .content-card {

            overflow: hidden;

            border: 1px solid var(--ca-border);

            border-radius: 12px;

            background: #fff;

        }



        .content-card-header {

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 14px;

            padding: 17px 18px;

            border-bottom: 1px solid #edf1f1;

        }



        .content-title {

            margin-bottom: 2px;

            color: var(--ca-text);

            font-size: .88rem;

            font-weight: 700;

        }



        .content-subtitle,

        .result-count {

            color: var(--ca-muted);

            font-size: .74rem;

        }



        .request-table { margin-bottom: 0; }



        .request-table thead th {

            padding: 12px 16px;

            border-bottom: 1px solid #edf1f1;

            color: #7b8795;

            background: #fbfcfc;

            font-size: .72rem;

            font-weight: 750;

            letter-spacing: .035em;

            text-transform: uppercase;

            white-space: nowrap;

        }



        .request-table tbody td {

            padding: 14px 16px;

            border-color: #edf1f1;

            color: #475467;

            font-size: .8rem;

            vertical-align: middle;

        }



        .student-name {

            color: var(--ca-text);

            font-size: .81rem;

            font-weight: 650;

        }



        .student-meta {

            margin-top: 2px;

            color: var(--ca-muted);

            font-size: .72rem;

        }



        .request-type {

            color: var(--ca-text);

            font-size: .8rem;

            font-weight: 620;

        }



        .message-preview {

            max-width: 320px;

            color: #475467;

            font-size: .78rem;

            line-height: 1.55;

        }



        .status-badge {

            display: inline-flex;

            align-items: center;

            padding: 5px 9px;

            border-radius: 999px;

            font-size: .72rem;

            font-weight: 680;

            white-space: nowrap;

        }



        .status-baru {

            color: #175cd3;

            background: #eff8ff;

        }



        .status-diproses {

            color: #b54708;

            background: #fffaeb;

        }



        .status-selesai {

            color: #027a48;

            background: #ecfdf3;

        }



        .status-form {

            min-width: 190px;

        }



        .status-form .form-select {

            min-height: 38px;

            font-size: .78rem;

        }



        .status-form .btn-save {

            min-height: 38px;

            padding: 7px 10px;

            font-size: .76rem;

        }



        .alert-custom {

            border: 0;

            border-radius: 9px;

            font-size: .8rem;

        }



        .empty-state {

            padding: 46px 20px;

            text-align: center;

            color: var(--ca-muted);

        }



        .empty-icon {

            width: 42px;

            height: 42px;

            display: inline-flex;

            align-items: center;

            justify-content: center;

            margin-bottom: 11px;

            border-radius: 10px;

            color: var(--ca-primary);

            background: var(--ca-primary-soft);

        }



        .pagination-wrap {

            padding: 15px 18px;

            border-top: 1px solid #edf1f1;

        }



        .pagination { margin-bottom: 0; }



        .page-link {

            color: var(--ca-primary);

            font-size: .78rem;

        }



        .page-item.active .page-link {

            border-color: var(--ca-primary);

            background: var(--ca-primary);

        }



        .page-footer {

            margin-top: 28px;

            padding: 24px 22px;

            border: none;

            border-radius: 12px;

            background: #107c76;

            color: #ffffff;

            font-size: .72rem;

        }



        .page-footer span {

            color: rgba(255,255,255,.92);

        }



        .mobile-sidebar-button {

            display: none;

            width: 38px;

            height: 38px;

            align-items: center;

            justify-content: center;

            border: 1px solid var(--ca-border);

            border-radius: 9px;

            color: var(--ca-text);

            background: #fff;

        }



        .sidebar-overlay {

            position: fixed;

            inset: 0;

            z-index: 1040;

            display: none;

            background: rgba(15,23,42,.28);

        }



        .sidebar-overlay.show { display: block; }



        @media (max-width: 991.98px) {

            .app-shell { display: block; }



            .sidebar {

                position: fixed;

                top: 0;

                bottom: 0;

                left: 0;

                z-index: 1050;

                width: var(--sidebar-width);

                transform: translateX(-100%);

                box-shadow: 14px 0 30px rgba(15,23,42,.10);

                transition: transform .2s ease;

            }



            .sidebar.show { transform: translateX(0); }



            .topbar {

                min-height: var(--topbar-height);

                padding: 0 18px;

            }



            .mobile-sidebar-button { display: inline-flex; }



            .main-content {

                min-height: calc(100vh - var(--topbar-height));

            }



            .page-body { padding: 22px 18px 30px; }

        }



        @media (max-width: 575.98px) {

            .page-footer {

                padding: 18px;

            }

            .date-chip { display: none; }



            .account-trigger {

                min-width: auto;

                padding: 5px;

            }



            .account-copy { display: none !important; }



            .page-hero {
                min-height: auto;
                padding: 22px 20px;
                border-radius: 14px;
            }

            .page-title { font-size: 1.55rem; }

            .page-copy { font-size: 13px; }

        }

    
        .btn-action {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            border-radius: 8px;
            text-decoration: none;
            transition: all 0.2s ease;
        }
        .btn-action-view {
            background-color: #f0f7ff;
            color: #0d6efd;
            border: 1px solid transparent;
        }
        .btn-action-view:hover {
            background-color: #0d6efd;
            color: white;
        }
</style>

    @include('guru-bk.partials.styles')
</head>



<body>



@php

    $namaUser = ucwords($user->name);

    $inisial = strtoupper(substr($user->name, 0, 1));



    $jenisLabel = [

        'pendampingan' => 'Pendampingan Guru BK',

        'perundungan' => 'Masalah Perundungan',

        'pribadi' => 'Masalah Pribadi / Emosional',

        'akademik' => 'Masalah Akademik',

        'lainnya' => 'Lainnya',

    ];

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

                    Permintaan Bantuan

                </div>



                <div class="topbar-subtitle">

                    Kelola permintaan konseling siswa

                </div>

            </div>



        </div>





        <div class="topbar-actions">@include('guru-bk.partials.notification-bell')



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



                <section class="page-header">
                    <div>
                        <div class="page-kicker">
                            PENDAMPINGAN SISWA
                        </div>
                        <h1 class="page-title">
                            Permintaan Bantuan
                        </h1>
                        <p class="page-copy">
                            Kelola permintaan konseling siswa.
                        </p>
                    </div>
                </section>





                @if (session('success'))

                    <div

                        class="alert alert-success alert-custom mb-4"

                        role="alert"

                    >

                        <i class="bi bi-check-circle-fill me-2"></i>

                        {{ session('success') }}

                    </div>

                @endif







                <section class="row g-3 mb-4">
                    @foreach ([
                        ['label' => 'Total Permintaan', 'value' => $ringkasan['total'], 'icon' => 'bi-chat-square-text', 'class' => 'total'],
                        ['label' => 'Baru', 'value' => $ringkasan['baru'], 'icon' => 'bi-inbox', 'class' => 'danger'],
                        ['label' => 'Diproses', 'value' => $ringkasan['diproses'], 'icon' => 'bi-arrow-repeat', 'class' => 'warning'],
                        ['label' => 'Selesai', 'value' => $ringkasan['selesai'], 'icon' => 'bi-check2-circle', 'class' => 'active'],
                    ] as $metric)
                        <div class="col-sm-6 col-xl-3">
                            <div class="summary-card {{ $metric['class'] }}">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <div class="summary-label">
                                            {{ $metric['label'] }}
                                        </div>
                                        <div class="summary-value">
                                            {{ $metric['value'] }}
                                        </div>
                                    </div>
                                    <span class="metric-icon">
                                        <i class="bi {{ $metric['icon'] }}"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </section>







                <form

                    method="GET"

                    action="{{ route('guru-bk.bantuan.index') }}"

                    class="filter-card"

                >





                    <div class="row g-3 align-items-end mb-3">



                        <div class="col-sm-6 col-lg-3">



                            <label

                                for="tahun_ajaran"

                                class="form-label"

                            >

                                Tahun Ajaran

                            </label>



                            <select

                                class="form-select"

                                id="tahun_ajaran"

                                name="tahun_ajaran"

                            >

                                @foreach ($tahunAjaranOptions as $option)

                                    <option

                                        value="{{ $option }}"

                                        @selected($tahunAjaran === $option)

                                    >

                                        {{ $option }}

                                    </option>

                                @endforeach

                            </select>



                        </div>





                        <div class="col-sm-6 col-lg-3">



                            <label

                                for="semester"

                                class="form-label"

                            >

                                Semester

                            </label>



                            <select

                                class="form-select"

                                id="semester"

                                name="semester"

                            >

                                <option

                                    value="ganjil"

                                    @selected($semester === 'ganjil')

                                >

                                    Ganjil

                                </option>



                                <option

                                    value="genap"

                                    @selected($semester === 'genap')

                                >

                                    Genap

                                </option>

                            </select>



                        </div>





                        <div class="col-lg-6">



                            <label class="form-label">

                                Arsip Periode

                            </label>



                            <div class="period-context">

                                <i class="bi bi-archive"></i>



                                <span>

                                    Menampilkan permintaan bantuan

                                    <strong>{{ $tahunAjaran }}</strong>

                                    semester

                                    <strong>{{ ucfirst($semester) }}</strong>,

                                    {{ $startDate->locale('id')->translatedFormat('d M Y') }}

                                    s.d.

                                    {{ $endDate->locale('id')->translatedFormat('d M Y') }}.

                                </span>

                            </div>



                        </div>



                    </div>







                    <div class="row g-3 align-items-end">



                        <div class="col-lg-5">



                            <label

                                for="q"

                                class="form-label"

                            >

                                Cari permintaan

                            </label>



                            <input

                                type="text"

                                class="form-control"

                                id="q"

                                name="q"

                                value="{{ $search }}"

                                placeholder="Nama siswa, NIS, atau isi pesan"

                            >



                        </div>





                        <div class="col-sm-6 col-lg-2">



                            <label

                                for="status"

                                class="form-label"

                            >

                                Status

                            </label>



                            <select

                                class="form-select"

                                id="status"

                                name="status"

                            >

                                <option value="">Semua Status</option>

                                <option value="baru" @selected($status === 'baru')>Baru</option>

                                <option value="diproses" @selected($status === 'diproses')>Diproses</option>

                                <option value="selesai" @selected($status === 'selesai')>Selesai</option>

                            </select>



                        </div>





                        <div class="col-sm-6 col-lg-3">



                            <label

                                for="jenis"

                                class="form-label"

                            >

                                Jenis Bantuan

                            </label>



                            <select

                                class="form-select"

                                id="jenis"

                                name="jenis"

                            >

                                <option value="">Semua Jenis</option>

                                <option value="pendampingan" @selected($jenis === 'pendampingan')>Pendampingan Guru BK</option>

                                <option value="perundungan" @selected($jenis === 'perundungan')>Masalah Perundungan</option>

                                <option value="pribadi" @selected($jenis === 'pribadi')>Masalah Pribadi / Emosional</option>

                                <option value="akademik" @selected($jenis === 'akademik')>Masalah Akademik</option>

                                <option value="lainnya" @selected($jenis === 'lainnya')>Lainnya</option>

                            </select>



                        </div>





                        <div class="col-lg-2">



                            <div class="d-flex gap-2">



                                <button

                                    type="submit"

                                    class="btn-filter flex-grow-1"

                                >

                                    <i class="bi bi-search"></i>

                                    Filter

                                </button>



                                <a

                                    href="{{ route('guru-bk.bantuan.index') }}"

                                    class="btn-reset"

                                    title="Kembali ke periode aktif"

                                >

                                    <i class="bi bi-arrow-counterclockwise"></i>

                                </a>



                            </div>



                        </div>



                    </div>



                </form>







                <section class="content-card">



                    <div class="content-card-header">



                        <div>

                            <div class="content-title">

                                Daftar Permintaan Bantuan

                            </div>



                            <div class="content-subtitle">

                                Permintaan yang dikirim siswa melalui Rujukan & Bantuan

                            </div>

                        </div>



                        <div class="result-count">

                            {{ $permintaan->total() }} permintaan

                        </div>



                    </div>





                    @if ($permintaan->isEmpty())



                        <div class="empty-state">



                            <div class="empty-icon">

                                <i class="bi bi-chat-square-text"></i>

                            </div>



                            <div class="fw-semibold mb-1">

                                Tidak Ada Permintaan

                            </div>



                            <div class="small">

                                Tidak ada permintaan bantuan pada

                                {{ $tahunAjaran }} semester

                                {{ ucfirst($semester) }} untuk filter yang dipilih.

                            </div>



                        </div>



                    @else



                        <div class="table-responsive">



                            <table class="table request-table align-middle">



                                <thead>

                                    <tr>

                                        <th>Siswa</th>

                                        <th>Jenis Bantuan</th>

                                        <th>Pesan</th>

                                        <th>Dikirim</th>

                                        <th>Status</th>

                                        <th>Aksi</th>

                                    </tr>

                                </thead>



                                <tbody>



                                    @foreach ($permintaan as $item)



                                        @php

                                            $statusClass = match($item->status) {

                                                'baru' => 'status-baru',

                                                'diproses' => 'status-diproses',

                                                'selesai' => 'status-selesai',

                                                default => 'status-baru',

                                            };



                                            $statusText = match($item->status) {

                                                'baru' => 'Baru',

                                                'diproses' => 'Diproses',

                                                'selesai' => 'Selesai',

                                                default => ucfirst($item->status),

                                            };

                                        @endphp



                                        <tr>



                                            <td>



                                                <div class="student-name">

                                                    {{ $item->nama_siswa }}

                                                </div>



                                                <div class="student-meta">

                                                    @if ($item->nis)

                                                        NIS {{ $item->nis }}

                                                    @else

                                                        NIS belum tersedia

                                                    @endif



                                                    @if ($item->nama_kelas)

                                                        · {{ $item->nama_kelas }}

                                                    @endif

                                                </div>



                                            </td>





                                            <td>

                                                <div class="request-type">

                                                    {{ $jenisLabel[$item->jenis_bantuan] ?? 'Lainnya' }}

                                                </div>

                                            </td>





                                            <td>

                                                <div

                                                    class="message-preview"

                                                    title="{{ $item->pesan }}"

                                                >

                                                    {{ \Illuminate\Support\Str::limit($item->pesan, 110) }}

                                                </div>

                                            </td>





                                            <td>

                                                {{ $item->submitted_at

                                                    ? \Carbon\Carbon::parse($item->submitted_at)->format('d M Y')

                                                    : '-' }}

                                            </td>





                                            <td>

                                                <span class="status-badge {{ $statusClass }}">

                                                    {{ $statusText }}

                                                </span>

                                            </td>





                                                                                        <td>
                                                <div class="d-flex align-items-center gap-2">
                                                <form
                                                    method="POST"
                                                    action="{{ route('guru-bk.bantuan.status', $item->id) }}"
                                                    class="status-form"
                                                >
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="return_tahun_ajaran" value="{{ $tahunAjaran }}">
                                                    <input type="hidden" name="return_semester" value="{{ $semester }}">
                                                    <input type="hidden" name="return_q" value="{{ $search }}">
                                                    <input type="hidden" name="return_status" value="{{ $status }}">
                                                    <input type="hidden" name="return_jenis" value="{{ $jenis }}">
                                                    <div class="d-flex gap-2">
                                                        <select name="status" class="form-select" aria-label="Ubah status">
                                                            <option value="baru" @selected($item->status === 'baru')>Baru</option>
                                                            <option value="diproses" @selected($item->status === 'diproses')>Diproses</option>
                                                            <option value="selesai" @selected($item->status === 'selesai')>Selesai</option>
                                                        </select>
                                                        <button type="submit" class="btn-save">Simpan</button>
                                                    </div>
                                                </form>
                                                <a href="{{ route('guru-bk.bantuan.show', $item->id) }}" class="btn-action btn-action-view" title="Lihat Detail">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                </div>
                                            </td>



                                        </tr>



                                    @endforeach



                                </tbody>



                            </table>



                        </div>





                        @if ($permintaan->hasPages())

                            <div class="pagination-wrap">

                                {{ $permintaan->links() }}

                            </div>

                        @endif



                    @endif



                </section>





                <footer class="page-footer">

                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2">

                        <span>

                            © {{ date('Y') }} CurhatAman

                        </span>

                        <span>

                            Portal Guru BK · Permintaan bantuan merupakan bagian dari layanan pendampingan siswa

                        </span>

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

</script>



</body>

</html>


