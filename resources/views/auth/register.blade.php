<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - CurhatAman</title>

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
            --border: #dfe7e6;
            --surface: #ffffff;
            --page-bg: #f7f9f9;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html, body {
            min-height: 100%;
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            color: var(--text-dark);
            background: var(--page-bg);
        }

        .auth-page {
            min-height: 100vh;
        }

        /* FIXED LEFT PANEL (EXACTLY LIKE LOGIN) */
        .auth-info {
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 40px 54px;
            position: relative;
            overflow: hidden;
            background: linear-gradient(150deg, #118e86 0%, #0b756f 100%);
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
            background: rgba(255, 255, 255, .045);
            pointer-events: none;
        }

        .auth-info::after {
            content: "";
            position: absolute;
            left: -140px;
            bottom: -175px;
            width: 350px;
            height: 350px;
            border-radius: 50%;
            border: 1px solid rgba(255, 255, 255, .07);
            pointer-events: none;
        }

        .brand-link {
            position: relative;
            z-index: 2;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            color: #ffffff;
            text-decoration: none;
            width: fit-content;
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

        .auth-info .brand-symbol {
            background: rgba(255, 255, 255, .14);
            box-shadow: none;
        }

        .brand-name {
            font-size: 1.35rem;
            font-weight: 700;
            letter-spacing: -.3px;
        }

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
            color: rgba(255, 255, 255, .82);
            font-size: .98rem;
            line-height: 1.7;
        }

        .info-list {
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .info-item {
            display: flex;
            align-items: center;
            gap: 11px;
            color: rgba(255, 255, 255, .9);
            font-size: .9rem;
        }

        .info-item i {
            width: 26px;
            height: 26px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            border-radius: 7px;
            background: rgba(255, 255, 255, .10);
            color: #ffffff;
            font-size: .84rem;
        }

        .info-footer {
            position: relative;
            z-index: 2;
            color: rgba(255, 255, 255, .62);
            font-size: .78rem;
        }

        /* RIGHT PANEL FORM */
        .register-panel {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 48px 42px;
            background: var(--surface);
        }

        .register-wrapper {
            width: 100%;
            max-width: 610px;
        }

        .mobile-brand {
            display: none;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            margin-bottom: 24px;
            color: var(--text-muted);
            font-size: .85rem;
            text-decoration: none;
            transition: color 0.15s ease;
        }

        .back-link:hover {
            color: var(--primary);
        }

        .register-title {
            margin-bottom: 7px;
            font-size: 1.9rem;
            font-weight: 700;
            letter-spacing: -.5px;
            color: var(--text-dark);
        }

        .register-subtitle {
            margin-bottom: 26px;
            color: var(--text-muted);
            font-size: .93rem;
            line-height: 1.6;
        }

        .form-label {
            margin-bottom: 7px;
            font-size: .86rem;
            font-weight: 600;
            color: var(--text-dark);
        }

        .form-control,
        .form-select {
            min-height: 48px;
            border: 1px solid #d8e1e1;
            border-radius: 9px;
            background-color: #ffffff;
            color: var(--text-dark);
            font-size: .9rem;
            transition: all 0.15s ease;
        }

        .form-control {
            padding: .7rem .9rem;
        }

        .form-select {
            padding-top: .7rem;
            padding-bottom: .7rem;
        }

        .form-control::placeholder {
            color: #98a2b3;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 .2rem rgba(15, 138, 131, .09);
        }

        .input-with-icon,
        .password-wrapper {
            position: relative;
        }

        .input-with-icon .form-control {
            padding-left: 44px;
        }

        .input-icon {
            position: absolute;
            top: 50%;
            left: 15px;
            transform: translateY(-50%);
            z-index: 3;
            color: #667085;
            font-size: .94rem;
            pointer-events: none;
        }

        .password-wrapper .form-control {
            padding-right: 46px;
        }

        .password-toggle {
            position: absolute;
            top: 50%;
            right: 10px;
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
            transition: all 0.15s ease;
        }

        .password-toggle:hover {
            background: #f3f7f6;
            color: var(--primary);
        }

        .field-help {
            margin-top: 6px;
            color: var(--text-muted);
            font-size: .76rem;
            line-height: 1.5;
        }

        /* CHECKBOXES & CONSENT BOX */
        .whatsapp-consent {
            margin: 2px 0 20px;
            padding: 13px 14px;
            border: 1px solid #d7e7e4;
            border-radius: 9px;
            background: #f7fbfa;
        }

        .whatsapp-consent .form-check {
            margin: 0;
        }

        .whatsapp-consent-note {
            margin: 7px 0 0 25px;
            color: var(--text-muted);
            font-size: .75rem;
            line-height: 1.55;
        }

        .form-check-input {
            width: 17px;
            height: 17px;
            margin-top: .17rem;
            border: 1.5px solid #94a3b8;
            border-radius: 4px;
            cursor: pointer;
        }

        .form-check-input:checked {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        .form-check-input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 .2rem rgba(15, 138, 131, .10);
        }

        .form-check-label {
            color: var(--text-muted);
            font-size: .82rem;
            line-height: 1.5;
            cursor: pointer;
        }

        .submit-button {
            min-height: 49px;
            border-radius: 9px;
            font-weight: 600;
            background-color: var(--primary);
            border-color: var(--primary);
        }

        .submit-button:hover,
        .submit-button:focus {
            background-color: var(--primary-dark);
            border-color: var(--primary-dark);
        }

        .validation-summary {
            display: flex;
            gap: 10px;
            padding: 13px 15px;
            margin-bottom: 20px;
            border: 1px solid #f3c7c3;
            border-radius: 9px;
            color: #b42318;
            background: #fff4f3;
            font-size: .84rem;
        }

        .validation-summary ul {
            margin: 5px 0 0;
            padding-left: 18px;
        }

        .field-error {
            margin-top: 6px;
            color: #b42318;
            font-size: .78rem;
        }

        .login-area {
            margin-top: 22px;
            padding-top: 20px;
            border-top: 1px solid var(--border);
            text-align: center;
            color: var(--text-muted);
            font-size: .85rem;
        }

        .login-area a {
            color: var(--primary);
            font-weight: 600;
            text-decoration: none;
        }

        .login-area a:hover {
            color: var(--primary-dark);
        }

        @media (max-width: 991.98px) {
            .auth-info {
                display: none;
            }

            .register-panel {
                min-height: 100vh;
                padding: 30px 22px;
            }

            .mobile-brand {
                display: inline-flex;
                align-items: center;
                gap: 10px;
                margin-bottom: 28px;
                color: var(--primary);
                text-decoration: none;
            }

            .mobile-brand .brand-symbol {
                background: var(--primary);
                color: #ffffff;
            }
        }
    </style>
</head>
<body>

<div class="container-fluid p-0">
    <div class="row g-0 auth-page">

        <!-- LEFT PANEL (FIXED SIDEBAR - EXACTLY LIKE LOGIN PAGE) -->
        <div class="col-lg-5 position-fixed h-100 start-0 top-0 d-none d-lg-block">
            <section class="auth-info h-100">
                <a href="{{ url('/') }}" class="brand-link" aria-label="CurhatAman">
                    <span class="brand-symbol" aria-hidden="true">
                        <i class="bi bi-people-fill"></i>
                    </span>
                    <span class="brand-name">CurhatAman</span>
                </a>

                <div class="info-content">
                    <h1 class="info-title">Mulai dengan akun siswa.</h1>
                    <p class="info-description">
                        Buat akun untuk mengakses layanan pelaporan, skrining berkala, serta bantuan dan pendampingan melalui CurhatAman.
                    </p>

                    <div class="info-list">
                        <div class="info-item">
                            <i class="bi bi-shield-check"></i>
                            <span>Informasi siswa dikelola sesuai kewenangan</span>
                        </div>
                        <div class="info-item">
                            <i class="bi bi-person-badge"></i>
                            <span>Terhubung dengan layanan Guru BK sekolah</span>
                        </div>
                    </div>
                </div>

                <div class="info-footer">
                    &copy; {{ date('Y') }} CurhatAman. All rights reserved.
                </div>
            </section>
        </div>

        <!-- RIGHT PANEL (FORM - OFFSET LG 5 TO SCROLL SMOOTHLY) -->
        <div class="col-lg-7 offset-lg-5 col-12">
            <main class="register-panel">
                <div class="register-wrapper">

                    <!-- Mobile Brand Logo -->
                    <a href="{{ url('/') }}" class="mobile-brand" aria-label="CurhatAman">
                        <span class="brand-symbol" aria-hidden="true">
                            <i class="bi bi-people-fill"></i>
                        </span>
                        <span class="brand-name">CurhatAman</span>
                    </a>

                    <a href="{{ url('/') }}" class="back-link">
                        <i class="bi bi-arrow-left"></i>
                        Kembali ke beranda
                    </a>

                    <h1 class="register-title">Buat Akun Siswa</h1>
                    <p class="register-subtitle">
                        Lengkapi data berikut sesuai informasi siswa yang benar.
                    </p>

                    @if ($errors->any())
                        <div class="validation-summary">
                            <i class="bi bi-exclamation-circle-fill mt-1 flex-shrink-0"></i>
                            <div>
                                <strong>Periksa kembali data yang kamu masukkan.</strong>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register.store') }}" autocomplete="on">
                        @csrf

                        <!-- Nama Lengkap -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <div class="input-with-icon">
                                <i class="bi bi-person input-icon"></i>
                                <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Masukkan nama lengkap" value="{{ old('name') }}" autocomplete="name" required autofocus>
                            </div>
                            @error('name')
                                <div class="field-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Alamat Email Siswa</label>
                            <div class="input-with-icon">
                                <i class="bi bi-envelope input-icon"></i>
                                <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="nama@email.com" value="{{ old('email') }}" autocomplete="email" required>
                            </div>
                            @error('email')
                                <div class="field-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- WhatsApp -->
                        <div class="mb-3">
                            <label for="whatsapp_number" class="form-label">Nomor WhatsApp</label>
                            <div class="input-with-icon">
                                <i class="bi bi-whatsapp input-icon"></i>
                                <input type="tel" id="whatsapp_number" name="whatsapp_number" class="form-control @error('whatsapp_number') is-invalid @enderror" placeholder="Contoh: 081234567890" value="{{ old('whatsapp_number') }}" inputmode="tel" autocomplete="tel" required>
                            </div>
                            <div class="field-help">
                                Wajib diisi dengan nomor WhatsApp aktif agar Guru BK sekolah dapat langsung menghubungi kamu untuk pendampingan dan bimbingan konseling.
                            </div>
                            @error('whatsapp_number')
                                <div class="field-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- NIS -->
                        <div class="mb-3">
                            <label for="nis" class="form-label">NIS</label>
                            <div class="input-with-icon">
                                <i class="bi bi-person-vcard input-icon"></i>
                                <input type="text" id="nis" name="nis" class="form-control @error('nis') is-invalid @enderror" placeholder="Masukkan NIS" value="{{ old('nis') }}" inputmode="numeric" required>
                            </div>
                            @error('nis')
                                <div class="field-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Kelas & Tahun Masuk -->
                        <div class="row g-3">
                            <div class="col-md-7">
                                <div class="mb-3">
                                    <label for="kelas_id" class="form-label">Kelas</label>
                                    <select id="kelas_id" name="kelas_id" class="form-select @error('kelas_id') is-invalid @enderror" required>
                                        <option value="" disabled {{ old('kelas_id') ? '' : 'selected' }}>Pilih kelas</option>
                                        @foreach ($kelas as $item)
                                            <option value="{{ $item->id }}" {{ (string) old('kelas_id') === (string) $item->id ? 'selected' : '' }}>
                                                {{ $item->nama_kelas }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('kelas_id')
                                        <div class="field-error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-5">
                                <div class="mb-3">
                                    <label for="tahun_masuk" class="form-label">Tahun Masuk</label>
                                    <input type="number" id="tahun_masuk" name="tahun_masuk" class="form-control @error('tahun_masuk') is-invalid @enderror" placeholder="{{ date('Y') }}" value="{{ old('tahun_masuk', date('Y')) }}" min="2000" max="{{ date('Y') }}" inputmode="numeric" required>
                                    @error('tahun_masuk')
                                        <div class="field-error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Password & Confirmation -->
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="password" class="form-label">Kata Sandi</label>
                                    <div class="password-wrapper">
                                        <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Buat kata sandi" autocomplete="new-password" required>
                                        <button type="button" class="password-toggle" data-password-toggle="password" aria-label="Tampilkan kata sandi">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </div>
                                    @error('password')
                                        <div class="field-error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi</label>
                                    <div class="password-wrapper">
                                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Ulangi kata sandi" autocomplete="new-password" required>
                                        <button type="button" class="password-toggle" data-password-toggle="password_confirmation" aria-label="Tampilkan konfirmasi kata sandi">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Terms Consent -->
                        <div class="form-check mb-4">
                            <input class="form-check-input @error('terms') is-invalid @enderror" type="checkbox" name="terms" id="terms" value="1" {{ old('terms') ? 'checked' : '' }} required>
                            <label class="form-check-label" for="terms">
                                Saya menyetujui Ketentuan Layanan dan Kebijakan Kerahasiaan CurhatAman.
                            </label>
                            @error('terms')
                                <div class="field-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary submit-button w-100">
                            Daftar
                            <i class="bi bi-arrow-right ms-2"></i>
                        </button>
                    </form>

                    <!-- Login Link -->
                    <div class="login-area">
                        Sudah memiliki akun?
                        <a href="{{ route('login') }}">Masuk</a>
                    </div>
                </div>
            </main>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.querySelectorAll('[data-password-toggle]').forEach(function (button) {
        button.addEventListener('click', function () {
            const inputId = button.getAttribute('data-password-toggle');
            const input = document.getElementById(inputId);
            const icon = button.querySelector('i');
            const visible = input.type === 'text';

            input.type = visible ? 'password' : 'text';
            icon.classList.toggle('bi-eye', visible);
            icon.classList.toggle('bi-eye-slash', !visible);
            button.setAttribute('aria-label', visible ? 'Tampilkan kata sandi' : 'Sembunyikan kata sandi');
        });
    });
</script>

</body>
</html>

