<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Kata Sandi - CurhatAman</title>

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

        .forgot-page {
            min-height: 100vh;
            display: grid;
            grid-template-columns: 1fr 1fr;
        }

        /* LEFT PANEL */
        .forgot-left {
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

        .forgot-left::before {
            content: "";
            position: absolute;
            top: -150px;
            right: -150px;
            width: 390px;
            height: 390px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.045);
        }

        .forgot-left::after {
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
        .forgot-right {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 60px 40px;
            background: var(--white);
        }

        .forgot-box {
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

        .form-control-custom {
            width: 100%;
            height: 48px;
            border: 1px solid var(--border);
            border-radius: 9px;
            padding: 0 14px;
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
            .forgot-page {
                grid-template-columns: 1fr;
            }

            .forgot-left {
                display: none;
            }

            .forgot-right {
                min-height: 100vh;
                padding: 35px 24px;
            }
        }
    </style>
</head>

<body>

<div class="forgot-page">

    <!-- PANEL KIRI -->
    <section class="forgot-left">
        <div class="left-content">
            <div class="left-icon-box">
                <i class="bi bi-key-fill"></i>
            </div>

            <h1>Akunmu Tetap Aman</h1>

            <p>
                Jangan khawatir jika lupa kata sandi. Masukkan email sekolah yang terdaftar dan kami akan membantu proses pemulihan akunmu.
            </p>
        </div>
    </section>

    <!-- PANEL KANAN -->
    <section class="forgot-right">
        <div class="forgot-box">

            <!-- LOGO BRAND (Persis dengan Halaman Login & Sidebar) -->
            <a href="{{ url('/') }}" class="brand-logo">
                <span class="brand-symbol">
                    <i class="bi bi-people-fill"></i>
                </span>
                <span class="brand-name">CurhatAman</span>
            </a>

            <h2>Lupa Kata Sandi?</h2>

            <p class="subtitle">
                Masukkan alamat email yang terdaftar pada akun CurhatAman Anda.
            </p>

            @if (session('status'))
                <div class="alert alert-success d-flex align-items-center gap-2 mb-3" role="alert" style="font-size: 13px; border-radius: 8px;">
                    <i class="bi bi-check-circle-fill fs-5"></i>
                    <div>{{ session('status') }}</div>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger d-flex align-items-center gap-2 mb-3" role="alert" style="font-size: 13px; border-radius: 8px;">
                    <i class="bi bi-exclamation-triangle-fill fs-5"></i>
                    <div>{{ $errors->first() }}</div>
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">
                        Alamat Email Terdaftar
                    </label>

                    <div class="position-relative">
                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="form-control-custom"
                            placeholder="Contoh: nama@gmail.com atau nama@sma.belajar.id"
                            value="{{ old('email') }}"
                            required
                            autofocus
                        >
                    </div>
                </div>

                <button type="submit" class="btn-submit-custom">
                    <i class="bi bi-envelope-check-fill me-1"></i>
                    Kirim Tautan Reset
                </button>
            </form>

            <div class="back-login">
                Sudah ingat kata sandi?
                <a href="{{ route('login') }}">
                    Kembali ke Masuk
                </a>
            </div>

            <!-- Catatan Bantuan Khusus Lingkungan Sekolah -->
            <div class="help-alert d-flex align-items-start gap-2">
                <i class="bi bi-info-circle-fill flex-shrink-0 mt-1"></i>
                <div>
                    <strong>Lupa Email / Akun Terkunci?</strong><br>
                    Jika tidak memiliki akses email terdaftar, Anda dapat meminta bantuan reset kata sandi akun secara langsung ke <strong>Guru BK</strong> atau <strong>Admin Sekolah</strong>.
                </div>
            </div>

        </div>
    </section>

</div>

</body>
</html>
