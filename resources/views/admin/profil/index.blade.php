@php
    $errors = $errors ?? new \Illuminate\Support\ViewErrorBag();
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Profil Admin | CurhatAman</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
        rel="stylesheet"
    >

    <style>
        :root{
            --primary:#0f8a83;
            --primary-dark:#0b6f69;
            --primary-soft:#eaf6f4;
            --bg:#f6f8f9;
            --surface:#fff;
            --text:#172033;
            --muted:#667085;
            --muted-light:#98a2b3;
            --border:#e3e9e9;
            --line:#edf1f1;
            --success:#027a48;
            --success-soft:#ecf8f2;
            --sidebar-width:272px;
            --topbar-height:82px;
        }

        *{box-sizing:border-box}

        body{
            margin:0;
            background:var(--bg);
            color:var(--text);
            font-family:system-ui,-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Arial,sans-serif;
            font-size:14px;
        }

        a{color:inherit;text-decoration:none}

        .sidebar{
            position:fixed;
            inset:0 auto 0 0;
            width:var(--sidebar-width);
            min-height:100vh;
            display:flex;
            flex-direction:column;
            background:#fff;
            border-right:1px solid var(--border);
            z-index:1100;
        }

        .sidebar-brand{
            height:var(--topbar-height);
            padding:0 24px;
            display:flex;
            align-items:center;
            gap:12px;
            border-bottom:1px solid var(--border);
        }

        .brand-symbol{
            width:42px;
            height:42px;
            border-radius:11px;
            display:inline-flex;
            align-items:center;
            justify-content:center;
            background:var(--primary);
            color:#fff;
            font-size:18px;
        }

        .brand-name{
            display:block;
            font-size:18px;
            font-weight:760;
            line-height:1.1;
        }

        .brand-role{
            display:block;
            margin-top:4px;
            color:var(--muted);
            font-size:12px;
        }

        .sidebar-section-label{
            padding:25px 24px 10px;
            color:var(--muted-light);
            font-size:10px;
            font-weight:750;
            letter-spacing:.10em;
            text-transform:uppercase;
        }

        .sidebar-nav{padding:0 14px}

        .sidebar-link{
            min-height:46px;
            margin-bottom:4px;
            padding:0 14px;
            border-radius:10px;
            display:flex;
            align-items:center;
            gap:12px;
            color:#475467;
            font-size:13.5px;
            font-weight:560;
        }

        .sidebar-link i{
            width:20px;
            color:#667085;
            text-align:center;
            font-size:16px;
        }

        .sidebar-link:hover{
            background:#f5f8f8;
            color:var(--primary-dark);
        }

        .sidebar-link.disabled{
            color:#a4acb8;
            pointer-events:none;
        }

        .sidebar-spacer{flex:1}

        .sidebar-account{
            padding:16px;
            border-top:1px solid var(--border);
        }

        .logout-button{
            width:100%;
            min-height:42px;
            padding:0 13px;
            border:0;
            border-radius:9px;
            display:flex;
            align-items:center;
            gap:11px;
            background:transparent;
            color:#667085;
            font-size:13px;
        }

        .logout-button:hover{
            background:#f8f9fa;
            color:#b42318;
        }

        .topbar{
            position:fixed;
            top:0;
            right:0;
            left:var(--sidebar-width);
            height:var(--topbar-height);
            padding:0 34px;
            background:rgba(255,255,255,.98);
            border-bottom:1px solid var(--border);
            display:flex;
            align-items:center;
            justify-content:space-between;
            z-index:1000;
        }

        .topbar-title{
            font-size:17px;
            font-weight:720;
        }

        .topbar-subtitle{
            margin-top:4px;
            color:var(--muted);
            font-size:12px;
        }

        .topbar-actions{
            display:flex;
            align-items:center;
            gap:12px;
        }

        .date-chip{
            height:38px;
            padding:0 13px;
            border:1px solid var(--border);
            border-radius:9px;
            display:flex;
            align-items:center;
            gap:8px;
            color:#667085;
            font-size:12px;
            background:#fff;
        }

        .account-trigger{
            min-width:184px;
            height:48px;
            padding:5px 9px 5px 6px;
            border:1px solid #d8e7e5;
            border-radius:11px;
            display:flex;
            align-items:center;
            gap:10px;
            background:var(--primary-soft);
            color:var(--text);
        }

        .topbar-avatar{
            width:36px;
            height:36px;
            flex:0 0 36px;
            border-radius:50%;
            display:inline-flex;
            align-items:center;
            justify-content:center;
            background:#d8efec;
            color:var(--primary-dark);
            font-size:11.5px;
            font-weight:760;
        }

        .account-copy{
            min-width:0;
            flex:1;
        }

        .account-name{
            max-width:120px;
            overflow:hidden;
            text-overflow:ellipsis;
            white-space:nowrap;
            font-size:12px;
            font-weight:680;
        }

        .account-role{
            margin-top:1px;
            color:var(--muted);
            font-size:10.5px;
        }

        .account-chevron{
            color:var(--primary-dark);
            font-size:11px;
        }

        .main-content{
            min-height:100vh;
            margin-left:var(--sidebar-width);
            padding-top:var(--topbar-height);
        }

        .page-body{
            padding:30px 34px 38px;
        }

        .content-shell{
            width:100%;
            max-width:1050px;
            margin:0 auto;
        }

        .page-header{
            margin-bottom:20px;
        }

        .page-kicker{
            margin-bottom:6px;
            color:var(--primary);
            font-size:10.5px;
            font-weight:760;
            letter-spacing:.09em;
            text-transform:uppercase;
        }

        .page-title{
            margin:0;
            font-size:25px;
            font-weight:760;
        }

        .page-copy{
            max-width:720px;
            margin:7px 0 0;
            color:var(--muted);
            font-size:12.5px;
            line-height:1.65;
        }

        .success-alert{
            margin-bottom:18px;
            padding:12px 14px;
            border:1px solid #cde8db;
            border-radius:9px;
            display:flex;
            align-items:center;
            gap:8px;
            background:var(--success-soft);
            color:var(--success);
            font-size:11.5px;
            font-weight:600;
        }

        .profile-layout{
            display:grid;
            grid-template-columns:290px minmax(0,1fr);
            gap:18px;
            align-items:start;
        }

        .panel{
            border:1px solid var(--border);
            border-radius:12px;
            background:#fff;
            overflow:hidden;
        }

        .profile-card{
            padding:24px 20px;
            text-align:center;
        }

        .profile-avatar{
            width:72px;
            height:72px;
            margin:0 auto 14px;
            border-radius:50%;
            display:flex;
            align-items:center;
            justify-content:center;
            background:var(--primary);
            color:#fff;
            font-size:20px;
            font-weight:760;
        }

        .profile-name{
            font-size:16px;
            font-weight:720;
        }

        .profile-email{
            margin-top:4px;
            color:var(--muted);
            font-size:11.5px;
            overflow-wrap:anywhere;
        }

        .role-badge{
            margin-top:13px;
            padding:6px 10px;
            border-radius:999px;
            display:inline-flex;
            align-items:center;
            gap:6px;
            background:var(--primary-soft);
            color:var(--primary-dark);
            font-size:10.5px;
            font-weight:680;
        }

        .profile-note{
            margin-top:17px;
            padding-top:15px;
            border-top:1px solid var(--line);
            color:var(--muted);
            font-size:10.5px;
            line-height:1.55;
            text-align:left;
        }

        .profile-note i{
            margin-right:5px;
            color:var(--primary);
        }

        .panel-header{
            padding:17px 19px;
            border-bottom:1px solid var(--line);
        }

        .panel-title{
            font-size:13px;
            font-weight:700;
        }

        .panel-subtitle{
            margin-top:3px;
            color:var(--muted);
            font-size:10.5px;
        }

        .detail-list{
            padding:5px 19px;
        }

        .detail-row{
            padding:13px 0;
            border-bottom:1px solid var(--line);
            display:grid;
            grid-template-columns:180px minmax(0,1fr);
            gap:16px;
        }

        .detail-row:last-child{
            border-bottom:0;
        }

        .detail-label{
            color:var(--muted);
            font-size:11px;
        }

        .detail-value{
            color:#344054;
            font-size:11.5px;
            font-weight:620;
            overflow-wrap:anywhere;
        }

        .status-active{
            display:inline-flex;
            align-items:center;
            gap:5px;
            color:var(--success);
        }

        .scope-panel{
            margin-top:18px;
            padding:15px 17px;
            border:1px solid #d4e8e5;
            border-radius:11px;
            background:#f5faf9;
        }

        .scope-title{
            margin-bottom:5px;
            color:var(--primary-dark);
            font-size:11.5px;
            font-weight:680;
        }

        .scope-copy{
            color:var(--muted);
            font-size:10.5px;
            line-height:1.6;
        }

        .security-panel{
            margin-top:18px;
        }

        .security-heading{
            display:flex;
            align-items:flex-start;
            gap:10px;
        }

        .security-icon{
            width:34px;
            height:34px;
            flex:0 0 34px;
            border-radius:8px;
            display:flex;
            align-items:center;
            justify-content:center;
            background:var(--primary-soft);
            color:var(--primary-dark);
        }

        .password-form{
            padding:18px 19px 20px;
        }

        .password-label{
            margin-bottom:6px;
            color:#475467;
            font-size:11px;
            font-weight:650;
        }

        .password-wrap{
            position:relative;
        }

        .password-input{
            min-height:42px;
            padding-right:43px;
            border:1px solid var(--border);
            border-radius:9px;
            font-size:12px;
        }

        .password-input:focus{
            border-color:rgba(15,138,131,.55);
            box-shadow:0 0 0 .2rem rgba(15,138,131,.08);
        }

        .password-toggle{
            position:absolute;
            top:50%;
            right:7px;
            width:31px;
            height:31px;
            padding:0;
            border:0;
            border-radius:7px;
            display:flex;
            align-items:center;
            justify-content:center;
            transform:translateY(-50%);
            background:transparent;
            color:var(--muted);
        }

        .password-toggle:hover{
            background:var(--primary-soft);
            color:var(--primary-dark);
        }

        .password-error{
            margin-top:5px;
            color:#b42318;
            font-size:10.5px;
        }

        .password-help{
            margin-top:6px;
            color:var(--muted);
            font-size:10.5px;
        }

        .security-actions{
            margin-top:18px;
            display:flex;
            justify-content:flex-end;
        }

        .btn-save-password{
            min-height:40px;
            padding:0 14px;
            border:0;
            border-radius:9px;
            display:inline-flex;
            align-items:center;
            justify-content:center;
            gap:7px;
            background:var(--primary);
            color:#fff;
            font-size:11.5px;
            font-weight:680;
        }

        .btn-save-password:hover{
            background:var(--primary-dark);
            color:#fff;
        }

        .page-footer{
            margin-top:30px;
            padding-top:15px;
            border-top:1px solid var(--border);
            color:#8a94a3;
            font-size:11px;
        }

        @media(max-width:991.98px){
            .sidebar{display:none}
            .topbar{left:0;padding:0 20px}
            .main-content{margin-left:0}
            .page-body{padding:24px 20px 32px}
            .profile-layout{grid-template-columns:1fr}
        }

        @media(max-width:767.98px){
            .date-chip,
            .account-copy,
            .account-chevron{display:none!important}

            .account-trigger{
                min-width:0;
                width:42px;
                padding:3px;
                background:transparent;
                border-color:transparent;
            }

            .detail-row{
                grid-template-columns:1fr;
                gap:5px;
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

@include('admin.partials.sidebar')

<header class="topbar">

    <div>
        <div class="topbar-title">
            Profil Admin
        </div>

        <div class="topbar-subtitle">
            Informasi akun dan keamanan akses
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
            aria-current="page"
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
                    Akun Pengguna
                </div>

                <h1 class="page-title">
                    Profil Saya
                </h1>

                <p class="page-copy">
                    Informasi akun Wakil Kesiswaan / Admin yang digunakan
                    untuk mengelola administrasi dan pengawasan CurhatAman.
                </p>
                </div>

                <div class="scope-badge">
                    <i class="bi bi-shield-check"></i>
                    Profil Admin
                </div>
            </section>

            @if(session('password_success'))
                <div class="success-alert">
                    <i class="bi bi-check-circle-fill"></i>
                    <span>{{ session('password_success') }}</span>
                </div>
            @endif

            <section class="profile-layout">

                <div>
                    <div class="panel profile-card">

                        <div class="profile-avatar">
                            {{ $inisial }}
                        </div>

                        <div class="profile-name">
                            {{ $namaUser }}
                        </div>

                        <div class="profile-email">
                            {{ $user->email }}
                        </div>

                        <div class="role-badge">
                            <i class="bi bi-shield-lock"></i>
                            Wakil Kesiswaan / Admin
                        </div>

                        <div class="profile-note">
                            <i class="bi bi-info-circle"></i>
                            Akun ini memiliki kewenangan administrasi dan
                            pengawasan sesuai hak akses Admin sekolah.
                        </div>

                    </div>
                </div>

                <div>

                    <div class="panel">

                        <div class="panel-header">
                            <div class="panel-title">
                                Informasi Akun
                            </div>

                            <div class="panel-subtitle">
                                Data utama akun administrator
                            </div>
                        </div>

                        <div class="detail-list">

                            <div class="detail-row">
                                <div class="detail-label">
                                    Nama Lengkap
                                </div>

                                <div class="detail-value">
                                    {{ $namaUser }}
                                </div>
                            </div>

                            <div class="detail-row">
                                <div class="detail-label">
                                    Email
                                </div>

                                <div class="detail-value">
                                    {{ $user->email }}
                                </div>
                            </div>

                            <div class="detail-row">
                                <div class="detail-label">
                                    Peran
                                </div>

                                <div class="detail-value">
                                    Wakil Kesiswaan / Admin
                                </div>
                            </div>

                            <div class="detail-row">
                                <div class="detail-label">
                                    Status Akun
                                </div>

                                <div class="detail-value">
                                    @if($user->is_active)
                                        <span class="status-active">
                                            <i class="bi bi-check-circle"></i>
                                            Aktif
                                        </span>
                                    @else
                                        Tidak Aktif
                                    @endif
                                </div>
                            </div>

                            <div class="detail-row">
                                <div class="detail-label">
                                    Terdaftar Sejak
                                </div>

                                <div class="detail-value">
                                    {{ $user->created_at
                                        ? $user->created_at->locale('id')->translatedFormat('d F Y')
                                        : '-' }}
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="scope-panel">

                        <div class="scope-title">
                            <i class="bi bi-shield-check me-1"></i>
                            Lingkup Akses Admin
                        </div>

                        <div class="scope-copy">
                            Admin mengelola akun dan kelas serta melakukan
                            pengawasan sistem. Detail kasus reguler tetap
                            dikelola Guru BK, sedangkan Admin berfokus pada
                            kasus yang dieskalasi dan kebutuhan intervensi
                            tingkat sekolah.
                        </div>

                    </div>

                    <div class="panel security-panel">

                        <div class="panel-header">

                            <div class="security-heading">

                                <span class="security-icon">
                                    <i class="bi bi-key"></i>
                                </span>

                                <div>
                                    <div class="panel-title">
                                        Keamanan Akun
                                    </div>

                                    <div class="panel-subtitle">
                                        Ganti password akun Admin secara mandiri
                                    </div>
                                </div>

                            </div>

                        </div>

                        <form
                            method="POST"
                            action="{{ route('admin.profil.password.update') }}"
                            class="password-form"
                            autocomplete="off"
                        >
                            @csrf
                            @method('PUT')

                            <div class="mb-3">

                                <label
                                    for="current_password"
                                    class="password-label"
                                >
                                    Password Saat Ini
                                </label>

                                <div class="password-wrap">

                                    <input
                                        type="password"
                                        id="current_password"
                                        name="current_password"
                                        class="form-control password-input
                                               @error('current_password') is-invalid @enderror"
                                        placeholder="Masukkan password saat ini"
                                        autocomplete="current-password"
                                        required
                                    >

                                    <button
                                        type="button"
                                        class="password-toggle"
                                        data-password-target="current_password"
                                        aria-label="Tampilkan password saat ini"
                                    >
                                        <i class="bi bi-eye"></i>
                                    </button>

                                </div>

                                @error('current_password')
                                    <div class="password-error">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            <div class="row g-3">

                                <div class="col-md-6">

                                    <label
                                        for="password"
                                        class="password-label"
                                    >
                                        Password Baru
                                    </label>

                                    <div class="password-wrap">

                                        <input
                                            type="password"
                                            id="password"
                                            name="password"
                                            class="form-control password-input
                                                   @error('password') is-invalid @enderror"
                                            placeholder="Minimal 8 karakter"
                                            autocomplete="new-password"
                                            required
                                        >

                                        <button
                                            type="button"
                                            class="password-toggle"
                                            data-password-target="password"
                                            aria-label="Tampilkan password baru"
                                        >
                                            <i class="bi bi-eye"></i>
                                        </button>

                                    </div>

                                    @error('password')
                                        <div class="password-error">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                    <div class="password-help">
                                        Minimal 8 karakter dan harus berbeda
                                        dari password saat ini.
                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <label
                                        for="password_confirmation"
                                        class="password-label"
                                    >
                                        Konfirmasi Password Baru
                                    </label>

                                    <div class="password-wrap">

                                        <input
                                            type="password"
                                            id="password_confirmation"
                                            name="password_confirmation"
                                            class="form-control password-input"
                                            placeholder="Ulangi password baru"
                                            autocomplete="new-password"
                                            required
                                        >

                                        <button
                                            type="button"
                                            class="password-toggle"
                                            data-password-target="password_confirmation"
                                            aria-label="Tampilkan konfirmasi password"
                                        >
                                            <i class="bi bi-eye"></i>
                                        </button>

                                    </div>

                                </div>

                            </div>

                            <div class="security-actions">

                                <button
                                    type="submit"
                                    class="btn-save-password"
                                >
                                    <i class="bi bi-shield-check"></i>
                                    Ganti Password
                                </button>

                            </div>

                        </form>

                    </div>

                </div>

            </section>

            <footer class="page-footer">
                © {{ date('Y') }} CurhatAman · Portal Admin Sekolah
            </footer>

        </div>
    </div>

</main>

<script>
    document
        .querySelectorAll('[data-password-target]')
        .forEach(function (button) {

            button.addEventListener('click', function () {

                const targetId = button.getAttribute(
                    'data-password-target'
                );

                const input = document.getElementById(targetId);
                const icon = button.querySelector('i');

                if (!input) {
                    return;
                }

                const isHidden = input.type === 'password';

                input.type = isHidden ? 'text' : 'password';

                icon.classList.toggle('bi-eye', !isHidden);
                icon.classList.toggle('bi-eye-slash', isHidden);
            });

        });
</script>

</body>
</html>
