<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Kata Sandi - CurhatAman</title>

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

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
            margin: 0;
            padding: 0;
        }

        html, body {
            min-height: 100%;
        }

        body {
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            color: var(--text-dark);
            background: var(--background);
        }

        .reset-page {
            min-height: 100vh;
            display: grid;
            grid-template-columns: 1fr 1fr;
        }

        /* LEFT PANEL */
        .reset-left {
            position: relative;
            overflow: hidden;
            background: linear-gradient(150deg, #118e86 0%, #0b756f 100%);
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 60px 40px;
        }

        .reset-left::before {
            content: "";
            position: absolute;
            top: -150px;
            right: -150px;
            width: 390px;
            height: 390px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.045);
        }

        .reset-left::after {
            content: "";
            position: absolute;
            left: -130px;
            bottom: -170px;
            width: 340px;
            height: 340px;
            border-radius: 50%;
            border: 1px solid rgba(255, 255, 255, 0.07);
        }

        .left-content {
            position: relative;
            z-index: 2;
            max-width: 440px;
        }

        .left-icon-box {
            width: 72px;
            height: 72px;
            margin: 0 auto 24px;
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            color: #ffffff;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .left-content h1 {
            font-size: 2rem;
            font-weight: 700;
            letter-spacing: -0.5px;
            margin-bottom: 16px;
        }

        .left-content p {
            font-size: 14.5px;
            line-height: 1.65;
            color: rgba(255, 255, 255, 0.88);
        }

        /* RIGHT PANEL */
        .reset-right {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 60px 40px;
            background: var(--white);
        }

        .reset-box {
            width: 100%;
            max-width: 440px;
        }

        .brand-logo {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 36px;
            text-decoration: none;
            color: var(--text-dark);
        }

        .brand-symbol {
            width: 42px;
            height: 42px;
            flex-shrink: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 11px;
            color: #ffffff;
            background: var(--primary);
            box-shadow: 0 4px 12px rgba(15, 138, 131, 0.2);
            font-size: 1.2rem;
        }

        .brand-name {
            font-size: 1.3rem;
            font-weight: 700;
            letter-spacing: -0.3px;
            color: var(--primary);
        }

        h2 {
            font-size: 1.75rem;
            font-weight: 700;
            letter-spacing: -0.5px;
            color: var(--text-dark);
            margin-bottom: 8px;
        }

        .subtitle {
            font-size: 14px;
            color: var(--text-muted);
            line-height: 1.6;
            margin-bottom: 28px;
        }

        .form-label {
            font-size: 13.5px;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 8px;
        }

        .input-wrapper {
            position: relative;
        }

        .form-control-custom {
            width: 100%;
            height: 48px;
            border: 1px solid var(--border);
            border-radius: 9px;
            padding: 0 40px 0 14px;
            background: var(--background);
            font-size: 14px;
            color: var(--text-dark);
            outline: none;
            transition: all 0.15s ease;
        }

        .form-control-custom:focus {
            border-color: var(--primary);
            background: #ffffff;
            box-shadow: 0 0 0 3px rgba(15, 138, 131, 0.12);
        }

        .toggle-password {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            cursor: pointer;
            font-size: 16px;
            transition: color 0.15s ease;
        }

        .toggle-password:hover {
            color: var(--text-dark);
        }

        .btn-submit-custom {
            width: 100%;
            height: 48px;
            border: none;
            border-radius: 9px;
            background: var(--primary);
            color: #ffffff;
            font-size: 14.5px;
            font-weight: 700;
            cursor: pointer;
            transition: background 0.15s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-submit-custom:hover {
            background: var(--primary-dark);
        }

        .back-login {
            text-align: center;
            margin-top: 24px;
            font-size: 13.5px;
            color: var(--text-muted);
        }

        .back-login a {
            color: var(--primary);
            font-weight: 700;
            text-decoration: none;
        }

        .back-login a:hover {
            text-decoration: underline;
        }

        .help-alert {
            margin-top: 28px;
            padding: 14px;
            border-radius: 10px;
            background: #f8fafc;
            border: 1px solid var(--border);
            font-size: 12.5px;
            color: var(--text-muted);
            line-height: 1.5;
        }

        .help-alert i {
            color: var(--primary);
            font-size: 15px;
        }

        @media (max-width: 850px) {
            .reset-page {
                grid-template-columns: 1fr;
            }

            .reset-left {
                display: none;
            }

            .reset-right {
                min-height: 100vh;
                padding: 35px 24px;
            }
        }
    </style>
</head>

<body>

<div class="reset-page">

    <!-- PANEL KIRI -->
    <section class="reset-left">
        <div class="left-content">
            <div class="left-icon-box">
                <i class="bi bi-shield-lock-fill"></i>
            </div>

            <h1>Buat Kata Sandi Baru</h1>

            <p>
                Amankan kembali akun Anda dengan kata sandi yang kuat dan mudah Anda ingat.
            </p>
        </div>
    </section>

    <!-- PANEL KANAN -->
    <section class="reset-right">
        <div class="reset-box">

            <!-- LOGO BRAND (Identik dengan Halaman Login & Lupa Kata Sandi) -->
            <a href="{{ url('/') }}" class="brand-logo">
                <span class="brand-symbol">
                    <i class="bi bi-people-fill"></i>
                </span>
                <span class="brand-name">CurhatAman</span>
            </a>

            <h2>Setel Ulang Kata Sandi</h2>

            <p class="subtitle">
                Masukkan email terdaftar dan kata sandi baru Anda.
            </p>

            @if ($errors->any())
                <div class="alert alert-danger d-flex align-items-center gap-2 mb-3" role="alert" style="font-size: 13px; border-radius: 8px;">
                    <i class="bi bi-exclamation-triangle-fill fs-5 flex-shrink-0"></i>
                    <div>{{ $errors->first() }}</div>
                </div>
            @endif

            <form method="POST" action="{{ route('password.update') }}" autocomplete="off">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">
                        Alamat Email Terdaftar
                    </label>

                    <div class="input-wrapper">
                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="form-control-custom"
                            value="{{ old('email', $email) }}"
                            readonly
                            required
                            autocomplete="off"
                            placeholder="Contoh: nama@gmail.com"
                        >
                    </div>
                </div>

                <!-- Kata Sandi Baru -->
                <div class="mb-3">
                    <label for="password" class="form-label">
                        Kata Sandi Baru
                    </label>

                    <div class="input-wrapper">
                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="form-control-custom"
                            required
                            autocomplete="new-password"
                            value=""
                            autofocus
                            placeholder="Minimal 8 karakter"
                        >
                        <i class="bi bi-eye-slash toggle-password" onclick="toggleVisibility('password', this)"></i>
                    </div>
                </div>

                <!-- Konfirmasi Kata Sandi Baru -->
                <div class="mb-4">
                    <label for="password_confirmation" class="form-label">
                        Konfirmasi Kata Sandi Baru
                    </label>

                    <div class="input-wrapper">
                        <input
                            type="password"
                            id="password_confirmation"
                            name="password_confirmation"
                            class="form-control-custom"
                            required
                            autocomplete="new-password"
                            value=""
                            placeholder="Ulangi kata sandi baru"
                        >
                        <i class="bi bi-eye-slash toggle-password" onclick="toggleVisibility('password_confirmation', this)"></i>
                    </div>
                </div>

                <button type="submit" class="btn-submit-custom">
                    <i class="bi bi-check-circle-fill me-1"></i>
                    Simpan Kata Sandi Baru
                </button>
            </form>

            <div class="back-login">
                <a href="{{ route('login') }}">
                    ← Batal & Kembali ke Halaman Masuk
                </a>
            </div>

            <div class="help-alert d-flex align-items-start gap-2">
                <i class="bi bi-info-circle-fill flex-shrink-0 mt-1"></i>
                <div>
                    <strong>Penting:</strong><br>
                    Pastikan kata sandi baru mengandung minimal 8 karakter dan tidak mudah ditebak oleh orang lain.
                </div>
            </div>

        </div>
    </section>

</div>

<script>
    function toggleVisibility(inputId, icon) {
        const input = document.getElementById(inputId);
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('bi-eye-slash');
            icon.classList.add('bi-eye');
        } else {
            input.type = 'password';
            icon.classList.remove('bi-eye');
            icon.classList.add('bi-eye-slash');
        }
    }

    // Pastikan input kata sandi selalu kosong saat halaman dibuka (mencegah autofill browser)
    document.addEventListener('DOMContentLoaded', function () {
        const passwordInput = document.getElementById('password');
        const confirmationInput = document.getElementById('password_confirmation');

        function clearPasswords() {
            if (passwordInput && !passwordInput.matches(':focus')) {
                passwordInput.value = '';
            }
            if (confirmationInput && !confirmationInput.matches(':focus')) {
                confirmationInput.value = '';
            }
        }

        clearPasswords();
        window.addEventListener('load', clearPasswords);
        setTimeout(clearPasswords, 100);
        setTimeout(clearPasswords, 300);
        setTimeout(clearPasswords, 600);
    });
</script>

</body>
</html>

