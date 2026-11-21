<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Masuk - CurhatAman</title>

    {{-- Bootstrap 5 --}}
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    {{-- Bootstrap Icons --}}
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    >

    <style>
        :root {
            --primary: #0f8a83;
            --primary-dark: #0b6f69;
            --primary-soft: #eaf6f4;

            --text-dark: #172033;
            --text-muted: #667085;

            --background: #f7f9f9;
            --border: #dfe7e6;

            --white: #ffffff;
        }

        * {
            box-sizing: border-box;
        }

        html,
        body {
            min-height: 100%;
        }

        body {
            margin: 0;

            font-family:
                system-ui,
                -apple-system,
                "Segoe UI",
                Roboto,
                "Helvetica Neue",
                Arial,
                sans-serif;

            color: var(--text-dark);
            background: var(--background);
        }

        /* =====================================================
           BOOTSTRAP COLOR
        ===================================================== */

        .text-primary {
            color: var(--primary) !important;
        }

        .btn-primary {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        .btn-primary:hover,
        .btn-primary:focus {
            background-color: var(--primary-dark);
            border-color: var(--primary-dark);
        }

        /* =====================================================
           PAGE
        ===================================================== */

        .auth-page {
            min-height: 100vh;
        }

        /* =====================================================
           LEFT PANEL
        ===================================================== */

        .auth-info {
            min-height: 100vh;

            display: flex;
            flex-direction: column;

            padding: 40px 54px;

            position: relative;
            overflow: hidden;

            background:
                linear-gradient(
                    150deg,
                    #118e86 0%,
                    #0b756f 100%
                );

            color: #ffffff;
        }

        .auth-info::before {
            content: "";

            position: absolute;
            top: -150px;
            right: -150px;

            width: 390px;
            height: 390px;

            border-radius: 50%;

            background: rgba(255, 255, 255, 0.045);
        }

        .auth-info::after {
            content: "";

            position: absolute;
            left: -130px;
            bottom: -170px;

            width: 340px;
            height: 340px;

            border-radius: 50%;

            border: 1px solid rgba(255, 255, 255, 0.07);
        }

        /* =====================================================
           BRAND
        ===================================================== */

        .brand-link {
            position: relative;
            z-index: 2;

            display: inline-flex;
            align-items: center;
            gap: 10px;

            width: fit-content;

            color: #ffffff;
            text-decoration: none;
        }

        
.brand-symbol {
    width: 46px;
    height: 46px;

    flex-shrink: 0;

    display: inline-flex;
    align-items: center;
    justify-content: center;

    border-radius: 12px;

    color: #ffffff;
    background: var(--primary);

    box-shadow: 0 5px 14px rgba(15, 138, 131, .14);

    font-size: 1.3rem;
}

.brand-symbol i {
    display: block;
    line-height: 1;
}


        .brand-name {
            font-size: 1.35rem;
            font-weight: 700;
            letter-spacing: -.3px;
        }

        /* =====================================================
           LEFT CONTENT
        ===================================================== */

        .info-content {
            position: relative;
            z-index: 2;

            width: 100%;
            max-width: 470px;

            margin: auto 0;
        }

        

        .info-title {
            max-width: 450px;

            margin-bottom: 18px;

            font-size: clamp(2rem, 3.5vw, 2.8rem);
            line-height: 1.15;

            font-weight: 700;
            letter-spacing: -1px;
        }

        .info-description {
            max-width: 450px;

            margin-bottom: 30px;

            color: rgba(255, 255, 255, 0.82);

            font-size: .98rem;
            line-height: 1.7;
        }

        .info-simple-list {
            display: flex;
            flex-direction: column;

            gap: 14px;
        }

        .info-simple-item {
            display: flex;
            align-items: center;

            gap: 11px;

            color: rgba(255, 255, 255, 0.9);

            font-size: .9rem;
        }

        .info-simple-item i {
            width: 26px;
            height: 26px;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            flex-shrink: 0;

            border-radius: 7px;

            background: rgba(255, 255, 255, 0.10);

            color: #ffffff;

            font-size: .84rem;
        }

        .info-footer {
            position: relative;
            z-index: 2;

            color: rgba(255, 255, 255, 0.62);

            font-size: .78rem;
        }

        /* =====================================================
           RIGHT PANEL
        ===================================================== */

        .auth-form-section {
            min-height: 100vh;

            display: flex;
            align-items: center;
            justify-content: center;

            padding: 48px 32px;

            background: #ffffff;
        }

        .login-wrapper {
            width: 100%;
            max-width: 460px;
        }

        .mobile-brand {
            display: none;
        }

        .back-link {
            display: inline-flex;
            align-items: center;

            gap: 7px;

            margin-bottom: 34px;

            color: var(--text-muted);

            font-size: .86rem;
            text-decoration: none;
        }

        .back-link:hover {
            color: var(--primary);
        }

        .login-title {
            margin-bottom: 8px;

            font-size: 1.9rem;
            font-weight: 700;

            letter-spacing: -.5px;
        }

        .login-subtitle {
            margin-bottom: 30px;

            color: var(--text-muted);

            font-size: .95rem;
            line-height: 1.65;
        }

        /* =====================================================
           FORM
        ===================================================== */

        .form-label {
            margin-bottom: 8px;

            font-size: .88rem;
            font-weight: 600;
        }

        .form-control {
            width: 100%;
            min-height: 50px;

            padding:
                .75rem
                .95rem;

            border: 1px solid #d8e1e1;
            border-radius: 9px;

            background: #ffffff;
            color: var(--text-dark);

            font-size: .92rem;
        }

        .form-control::placeholder {
            color: #98a2b3;
        }

        .form-control:focus {
            border-color: var(--primary);

            box-shadow:
                0 0 0
                .2rem
                rgba(15, 138, 131, .09);
        }

        /* Email input: icon di DALAM satu border */
        .input-with-icon {
            position: relative;
        }

        .input-with-icon .form-control {
            padding-left: 45px;
        }

        .input-with-icon .input-icon {
            position: absolute;

            top: 50%;
            left: 16px;

            transform: translateY(-50%);

            z-index: 3;

            color: #667085;
            font-size: .95rem;

            pointer-events: none;
        }

        /* Password input */
        .password-wrapper {
            position: relative;
        }

        .password-wrapper .form-control {
            padding-right: 48px;
        }

        .password-toggle {
            position: absolute;

            top: 50%;
            right: 12px;

            transform: translateY(-50%);

            width: 34px;
            height: 34px;

            display: flex;
            align-items: center;
            justify-content: center;

            border: 0;
            border-radius: 7px;

            background: transparent;
            color: #667085;

            cursor: pointer;
        }

        .password-toggle:hover {
            background: #f3f7f6;
            color: var(--primary);
        }

        .form-check-input {
            width: 17px;
            height: 17px;

            margin-top: .15rem;
        }

        .form-check-input:checked {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        .form-check-input:focus {
            border-color: var(--primary);

            box-shadow:
                0 0 0
                .2rem
                rgba(15, 138, 131, .1);
        }

        .form-check-label {
            color: var(--text-muted);

            font-size: .86rem;
        }

        .forgot-link {
            color: var(--primary);

            font-size: .86rem;
            font-weight: 600;

            text-decoration: none;
        }

        .forgot-link:hover {
            color: var(--primary-dark);
        }

        .login-button {
            min-height: 50px;

            border-radius: 9px;

            font-weight: 600;
        }

        /* =====================================================
           ALERT
        ===================================================== */

        .auth-alert {
            display: flex;
            align-items: flex-start;

            gap: 10px;

            padding: 13px 15px;

            margin-bottom: 22px;

            border-radius: 9px;

            font-size: .87rem;
        }

        .auth-alert-error {
            color: #b42318;
            background: #fff4f3;
            border: 1px solid #f3c7c3;
        }

        .auth-alert-success {
            color: #067647;
            background: #ecfdf3;
            border: 1px solid #b7e7cd;
        }

        /* =====================================================
           REGISTER
        ===================================================== */

        .register-area {
            margin-top: 26px;
            padding-top: 23px;

            border-top: 1px solid var(--border);

            text-align: center;

            color: var(--text-muted);

            font-size: .87rem;
        }

        .register-area a {
            color: var(--primary);

            font-weight: 600;

            text-decoration: none;
        }

        .register-area a:hover {
            color: var(--primary-dark);
        }

        /* =====================================================
           RESPONSIVE
        ===================================================== */

        @media (max-width: 991.98px) {

            .auth-info {
                display: none;
            }

            .auth-form-section {
                padding: 32px 22px;
            }

            .mobile-brand {
                display: inline-flex;
                align-items: center;

                gap: 10px;

                margin-bottom: 34px;

                color: var(--primary);

                text-decoration: none;
            }

            .mobile-brand .brand-symbol {
                background: var(--primary);
            }

        }

        @media (max-width: 575.98px) {

            .auth-form-section {
                align-items: flex-start;

                padding-top: 24px;
            }

            .login-title {
                font-size: 1.65rem;
            }

            .form-options {
                flex-direction: column;

                align-items: flex-start !important;

                gap: 12px;
            }

        }

    
        .auth-info .brand-symbol {
            background: rgba(255, 255, 255, .14);
            box-shadow: none;
        }

        .mobile-brand .brand-symbol {
            background: var(--primary);
        }

    </style>
</head>


<body>

<div class="container-fluid p-0">

    <div class="row g-0 auth-page">


        {{-- =====================================================
             PANEL KIRI
        ===================================================== --}}

        <div class="col-lg-5">

            <section class="auth-info">


                {{-- BRAND --}}
                <a
                    href="{{ url('/') }}"
                    class="brand-link"
                >

                    <span
                        class="brand-symbol"
                        aria-hidden="true"
                    >
                        <i class="bi bi-people-fill"></i>
                    </span>


                    <span class="brand-name">
                        CurhatAman
                    </span>

                </a>



                {{-- CONTENT --}}
                <div class="info-content">

                    <h1 class="info-title">
                        Ruang aman untuk bercerita.
                    </h1>


                    <p class="info-description">
                        Sampaikan laporan, ikuti skrining berkala,
                        dan dapatkan dukungan Guru BK melalui CurhatAman.
                    </p>


                    <div class="info-simple-list">

                        <div class="info-simple-item">

                            <i class="bi bi-shield-check"></i>

                            <span>
                                Informasi diakses sesuai kewenangan
                            </span>

                        </div>


                        <div class="info-simple-item">

                            <i class="bi bi-person-check"></i>

                            <span>
                                Pendampingan dari Guru BK
                            </span>

                        </div>

                    </div>

                </div>



                <div class="info-footer">
                    © {{ date('Y') }} CurhatAman
                </div>


            </section>

        </div>



        {{-- =====================================================
             FORM LOGIN
        ===================================================== --}}

        <div class="col-lg-7">

            <section class="auth-form-section">

                <div class="login-wrapper">


                    {{-- MOBILE BRAND --}}
                    <a
                        href="{{ url('/') }}"
                        class="mobile-brand"
                    >

                        <span
                            class="brand-symbol"
                            aria-hidden="true"
                        >
                            <i class="bi bi-people-fill"></i>
                        </span>


                        <span class="brand-name">
                            CurhatAman
                        </span>

                    </a>



                    {{-- BACK --}}
                    <a
                        href="{{ url('/') }}"
                        class="back-link"
                    >

                        <i class="bi bi-arrow-left"></i>

                        Kembali ke beranda

                    </a>



                    {{-- HEADER --}}
                    <h2 class="login-title">
                        Selamat Datang Kembali
                    </h2>


                    <p class="login-subtitle">
                        Masuk menggunakan akun CurhatAman
                        yang telah terdaftar.
                    </p>



                    {{-- ERROR --}}
                    @if ($errors->any())

                        <div class="auth-alert auth-alert-error">

                            <i
                                class="bi bi-exclamation-circle-fill mt-1"
                            ></i>

                            <div>
                                {{ $errors->first() }}
                            </div>

                        </div>

                    @endif



                    {{-- SUCCESS --}}
                    @if (session('success'))

                        <div class="auth-alert auth-alert-success">

                            <i
                                class="bi bi-check-circle-fill mt-1"
                            ></i>

                            <div>
                                {{ session('success') }}
                            </div>

                        </div>

                    @endif



                    {{-- FORM --}}
                    <form
                        id="loginForm"
                        method="POST"
                        action="{{ route('login.store') }}"
                        autocomplete="on"
                    >

                        @csrf


                        {{-- EMAIL / NISN --}}
                        <div class="mb-4">

                            <label
                                for="email"
                                class="form-label"
                            >
                                Email / NISN
                            </label>


                            <div class="input-with-icon">

                                <i
                                    class="bi bi-person input-icon"
                                ></i>


                                <input
                                    type="text"
                                    id="email"
                                    name="email"
                                    class="form-control
                                           @error('email') is-invalid @enderror"
                                    placeholder="Masukkan email atau NISN"
                                    value="{{ old('email') }}"
                                    autocomplete="username"
                                    required
                                    autofocus
                                >

                            </div>


                            @error('email')

                                <div class="text-danger small mt-2">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>



                        {{-- PASSWORD --}}
                        <div class="mb-3">

                            <label
                                for="password"
                                class="form-label"
                            >
                                Kata Sandi
                            </label>


                            <div class="password-wrapper">

                                <input
                                    type="password"
                                    id="password"
                                    name="password"
                                    class="form-control
                                           @error('password') is-invalid @enderror"
                                    placeholder="Masukkan kata sandi"
                                    autocomplete="current-password"
                                    required
                                >


                                <button
                                    type="button"
                                    class="password-toggle"
                                    id="passwordToggle"
                                    aria-label="Tampilkan kata sandi"
                                >

                                    <i
                                        class="bi bi-eye"
                                        id="passwordIcon"
                                    ></i>

                                </button>

                            </div>


                            @error('password')

                                <div class="text-danger small mt-2">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>



                        {{-- OPTIONS --}}
                        <div
                            class="form-options
                                   d-flex
                                   justify-content-between
                                   align-items-center
                                   mb-4"
                        >

                            <div class="form-check">

                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    name="remember"
                                    id="remember"
                                    value="1"
                                    {{ old('remember') ? 'checked' : '' }}
                                >

                                <label
                                    class="form-check-label"
                                    for="remember"
                                >
                                    Ingat saya
                                </label>

                            </div>


                            <a
                                href="{{ route('password.request') }}"
                                class="forgot-link"
                            >
                                Lupa kata sandi?
                            </a>

                        </div>



                        {{-- LOGIN --}}
                        <button
                            type="submit"
                            class="btn
                                   btn-primary
                                   login-button
                                   w-100"
                        >

                            Masuk

                            <i class="bi bi-arrow-right ms-2"></i>

                        </button>

                    </form>

                </div>

            </section>

        </div>


    </div>

</div>


{{-- Bootstrap JS --}}
<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
></script>


{{-- LOGIN BEHAVIOUR --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {

        const loginForm =
            document.getElementById('loginForm');

        const emailInput =
            document.getElementById('email');

        const rememberCheckbox =
            document.getElementById('remember');

        const passwordInput =
            document.getElementById('password');

        const passwordToggle =
            document.getElementById('passwordToggle');

        const passwordIcon =
            document.getElementById('passwordIcon');

        /*
         * "Ingat saya" di sisi tampilan hanya menyimpan EMAIL.
         * Password tidak pernah disimpan oleh JavaScript CurhatAman.
         * Penyimpanan password, bila pengguna memilihnya, ditangani
         * oleh password manager browser.
         */
        const rememberEmailKey =
            'curhataman_remember_email';

        const savedEmail =
            localStorage.getItem(rememberEmailKey);

        const hasValidationErrors =
            @json($errors->any());

        /*
         * Jika sebelumnya pengguna memilih "Ingat saya",
         * tampilkan kembali email dan centang checkbox.
         */
        if (savedEmail) {

            if (!hasValidationErrors || !emailInput.value) {
                emailInput.value = savedEmail;
            }

            rememberCheckbox.checked = true;

        } else {

            /*
             * Setelah logout / membuka halaman login baru tanpa
             * pilihan "Ingat saya", jangan isi email dari aplikasi.
             * old('email') tetap dipertahankan bila login gagal
             * agar pengguna tidak perlu mengetik ulang.
             */
            if (!hasValidationErrors) {
                emailInput.value = '';
            }

            rememberCheckbox.checked = false;
        }


        /*
         * Simpan atau hapus email sesuai pilihan saat form dikirim.
         */
        loginForm.addEventListener('submit', function () {

            if (rememberCheckbox.checked) {

                localStorage.setItem(
                    rememberEmailKey,
                    emailInput.value.trim()
                );

            } else {

                localStorage.removeItem(
                    rememberEmailKey
                );

            }

        });


        /*
         * Jika pengguna membatalkan centang sebelum submit,
         * hapus preferensi yang pernah tersimpan.
         */
        rememberCheckbox.addEventListener('change', function () {

            if (!this.checked) {
                localStorage.removeItem(rememberEmailKey);
            }

        });


        /*
         * Tampilkan / sembunyikan kata sandi.
         */
        passwordToggle.addEventListener(
            'click',
            function () {

                const passwordVisible =
                    passwordInput.type === 'text';

                passwordInput.type =
                    passwordVisible
                        ? 'password'
                        : 'text';

                passwordIcon.classList.toggle(
                    'bi-eye',
                    passwordVisible
                );

                passwordIcon.classList.toggle(
                    'bi-eye-slash',
                    !passwordVisible
                );

                passwordToggle.setAttribute(
                    'aria-label',
                    passwordVisible
                        ? 'Tampilkan kata sandi'
                        : 'Sembunyikan kata sandi'
                );

            }
        );

    });
</script>

</body>
</html>
