<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Skrining | CurhatAman</title>

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
            --ca-bg: #f7f9f9;
            --ca-border: #e3e9e9;
            --ca-line: #edf1f1;
            --ca-surface: #ffffff;
            --ca-success: #238653;
            --ca-success-soft: #edf8f2;
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

        .history-main {
            flex: 1;
            padding: 34px 0 42px;
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
            max-width: 720px;
            margin: 8px 0 0;
            color: var(--ca-muted);
            font-size: .9rem;
            line-height: 1.6;
        }

        .history-card {
            margin-top: 22px;
            border: 1px solid var(--ca-border);
            border-radius: 12px;
            overflow: hidden;
            background: var(--ca-surface);
        }

        .history-card-header {
            padding: 16px 18px;
            border-bottom: 1px solid var(--ca-line);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        .history-card-title {
            margin: 0;
            font-size: .95rem;
            font-weight: 690;
        }

        .history-total {
            padding: 5px 9px;
            border-radius: 999px;
            color: var(--ca-primary-dark);
            background: var(--ca-primary-soft);
            font-size: .69rem;
            font-weight: 700;
        }

        .month-section + .month-section {
            border-top: 1px solid var(--ca-line);
        }

        .month-heading {
            padding: 11px 18px;
            color: var(--ca-primary-dark);
            background: #f5faf9;
            font-size: .76rem;
            font-weight: 720;
        }

        .history-row {
            padding: 15px 18px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            border-top: 1px solid var(--ca-line);
        }

        .history-row:first-child {
            border-top: 0;
        }

        .history-date {
            margin-bottom: 4px;
            font-size: .84rem;
            font-weight: 650;
        }

        .history-meta {
            color: var(--ca-muted);
            font-size: .73rem;
            line-height: 1.5;
        }

        .status-complete {
            padding: 6px 9px;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            color: var(--ca-success);
            background: var(--ca-success-soft);
            font-size: .67rem;
            font-weight: 700;
            white-space: nowrap;
        }

        .privacy-note {
            margin-top: 16px;
            padding: 12px 14px;
            border: 1px solid var(--ca-border);
            border-radius: 10px;
            display: flex;
            align-items: flex-start;
            gap: 9px;
            color: var(--ca-muted);
            background: #ffffff;
            font-size: .76rem;
            line-height: 1.55;
        }

        .empty-state {
            padding: 44px 22px;
            text-align: center;
        }

        .empty-icon {
            width: 44px;
            height: 44px;
            margin: 0 auto 12px;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: var(--ca-primary);
            background: var(--ca-primary-soft);
        }

        .empty-title {
            margin-bottom: 5px;
            font-size: .92rem;
            font-weight: 680;
        }

        .empty-copy {
            margin: 0;
            color: var(--ca-muted);
            font-size: .78rem;
        }

        .pagination-wrap {
            padding: 14px 18px;
            border-top: 1px solid var(--ca-line);
        }

        .simple-footer {
            margin-top: auto;
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
        }

        @media (max-width: 991.98px) {
            .student-navbar .nav-link {
                padding: .55rem 0 !important;
            }

            .student-navbar .nav-link.active::after {
                display: none;
            }
        }

        @media (max-width: 575.98px) {
            .account-copy {
                display: none !important;
            }

            .history-row {
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

    $kelompokBulan = $riwayatSkrining
        ->getCollection()
        ->groupBy(
            fn ($item) => $item->completed_at->format('Y-m')
        );
@endphp

<nav class="navbar navbar-expand-lg student-navbar sticky-top">
    <div class="container">
        <a
            href="{{ route('siswa.dashboard') }}"
            class="navbar-brand d-flex align-items-center gap-2"
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

<main class="history-main">
    <div class="container">
        <section>
            <div class="page-kicker">
                Skrining
            </div>

            <h1 class="page-title">
                Riwayat Skrining
            </h1>

            <p class="page-copy">
                Riwayat ini hanya menunjukkan waktu penyelesaian dan konteks akademik saat skrining dilakukan. Hasil skor dan interpretasi tidak ditampilkan di akun siswa.
            </p>
        </section>

        <section class="history-card">
            <div class="history-card-header">
                <h2 class="history-card-title">
                    Skrining yang Sudah Diselesaikan
                </h2>

                <span class="history-total">
                    {{ $riwayatSkrining->total() }} riwayat
                </span>
            </div>

            @if ($riwayatSkrining->count())
                @foreach ($kelompokBulan as $bulanKey => $items)
                    <div class="month-section">
                        <div class="month-heading">
                            {{ \Carbon\Carbon::createFromFormat('Y-m', $bulanKey)->locale('id')->translatedFormat('F Y') }}
                        </div>

                        @foreach ($items as $item)
                            <div class="history-row">
                                <div>
                                    <div class="history-date">
                                        {{ $item->completed_at->locale('id')->translatedFormat('d F Y, H:i') }}
                                    </div>

                                    <div class="history-meta">
                                        @if ($item->tahun_ajaran && $item->semester)
                                            {{ $item->tahun_ajaran }}
                                            · {{ ucfirst($item->semester) }}
                                            @if ($item->nama_kelas_saat_skrining)
                                                · {{ $item->nama_kelas_saat_skrining }}
                                            @endif
                                        @else
                                            Data akademik periode lama belum memiliki snapshot
                                        @endif
                                    </div>
                                </div>

                                <span class="status-complete">
                                    <i class="bi bi-check-circle"></i>
                                    Selesai
                                </span>
                            </div>
                        @endforeach
                    </div>
                @endforeach

                @if ($riwayatSkrining->hasPages())
                    <div class="pagination-wrap">
                        {{ $riwayatSkrining->links() }}
                    </div>
                @endif
            @else
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="bi bi-clipboard2-check"></i>
                    </div>

                    <div class="empty-title">
                        Belum ada riwayat skrining
                    </div>

                    <p class="empty-copy">
                        Skrining yang sudah selesai akan tersimpan dan muncul di halaman ini.
                    </p>
                </div>
            @endif
        </section>

        <div class="privacy-note">
            <i class="bi bi-shield-lock"></i>

            <span>
                Riwayat siswa tidak menampilkan skor SDQ, kategori Normal/Ambang/Abnormal, jawaban per pertanyaan, maupun catatan internal Guru BK.
            </span>
        </div>
    </div>
</main>

<footer class="simple-footer">
    <div class="container">
        <span>
            © {{ date('Y') }} <strong>CurhatAman</strong>
        </span>

        <span>
            Riwayat skrining tersimpan sesuai periode pelaksanaan.
        </span>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
