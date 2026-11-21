<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>CurhatAman - Ruang Aman untuk Siswa</title>

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
            --primary-soft: #e8f5f3;

            --text-dark: #172033;
            --text-secondary: #64748b;

            --background: #f7f9f9;
            --border: #e3e9e9;

            --white: #ffffff;
        }


        html {
            scroll-behavior: smooth;
        }


        body {
            position: relative;

            font-family:
                -apple-system,
                BlinkMacSystemFont,
                "Segoe UI",
                Roboto,
                Helvetica,
                Arial,
                sans-serif;

            color: var(--text-dark);
            background: var(--white);
        }

        section[id] {
            scroll-margin-top: 90px;
        }


        /* ==========================
           BOOTSTRAP PRIMARY OVERRIDE
        ========================== */

        .text-primary {
            color: var(--primary) !important;
        }

        .bg-primary {
            background-color: var(--primary) !important;
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

        .btn-outline-primary {
            color: var(--primary);
            border-color: var(--primary);
        }

        .btn-outline-primary:hover {
            background-color: var(--primary);
            border-color: var(--primary);
            color: white;
        }


        /* ==========================
           NAVBAR
        ========================== */

        .navbar {
            min-height: 78px;
        }

        .navbar-brand {
            color: var(--primary);
            font-size: 1.45rem;
        }

        
.brand-symbol {
    width: 46px;
    height: 46px;

    flex-shrink: 0;

    display: inline-flex;
    align-items: center;
    justify-content: center;

    border-radius: 12px;

    background: var(--primary);
    color: #ffffff;

    box-shadow: 0 5px 14px rgba(15, 138, 131, 0.14);

    font-size: 1.3rem;
}

.brand-symbol i {
    display: block;
    line-height: 1;
}


        .brand-name {
            color: var(--primary);
            font-size: 1.45rem;
            font-weight: 700;
            letter-spacing: -0.4px;
        }

        .navbar-brand:hover .brand-name {
            color: var(--primary-dark);
        }



        .navbar .nav-link {
            position: relative;

            color: #475569;

            font-size: 0.95rem;
            font-weight: 500;

            padding-left: 1rem !important;
            padding-right: 1rem !important;

            transition: color 0.2s ease;
        }

        .navbar .nav-link:hover,
        .navbar .nav-link.active {
            color: var(--primary);
        }

        .navbar .nav-link.active {
            font-weight: 600;
        }

        .navbar .nav-link.active::after {
            content: "";

            position: absolute;
            left: 1rem;
            right: 1rem;
            bottom: -8px;

            height: 2px;

            border-radius: 999px;

            background: var(--primary);
        }


        /* ==========================
           HERO
        ========================== */

        .hero {
            min-height: 630px;

            display: flex;
            align-items: center;

            background: #ffffff;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;

            padding: 8px 14px;

            background: var(--primary-soft);
            color: var(--primary-dark);

            border-radius: 50px;

            font-size: 0.88rem;
            font-weight: 600;
        }

        .hero-title {
            max-width: 650px;

            font-size: clamp(2.6rem, 5vw, 4.5rem);
            line-height: 1.05;
            letter-spacing: -2px;

            font-weight: 700;
        }

        .hero-description {
            max-width: 650px;

            color: var(--text-secondary);

            font-size: 1.08rem;
            line-height: 1.8;
        }

        .hero .btn {
            min-height: 50px;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            font-weight: 600;

            padding-left: 24px;
            padding-right: 24px;
        }


        /* ==========================
           HERO PREVIEW
        ========================== */

        .platform-preview {
            background: #ffffff;

            border: 1px solid var(--border);
            border-radius: 18px;

            box-shadow: 0 15px 45px rgba(15, 23, 42, 0.07);

            overflow: hidden;
        }

        .preview-header {
            padding: 18px 22px;

            background: #f8faf9;
            border-bottom: 1px solid var(--border);

            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .preview-body {
            padding: 28px;
        }

        .preview-item {
            padding: 20px 0;

            display: flex;
            align-items: flex-start;
            gap: 16px;

            border-bottom: 1px solid var(--border);
        }

        .preview-item:last-child {
            border-bottom: none;
        }

        .preview-icon {
            width: 47px;
            height: 47px;

            flex-shrink: 0;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 12px;

            background: var(--primary-soft);
            color: var(--primary);

            font-size: 1.25rem;
        }

        .preview-item h6 {
            margin-bottom: 5px;

            font-size: 1rem;
            font-weight: 600;
        }

        .preview-item p {
            margin-bottom: 0;

            color: var(--text-secondary);

            font-size: 0.9rem;
            line-height: 1.6;
        }


        /* ==========================
           SECTION
        ========================== */

        .section-padding {
            padding-top: 90px;
            padding-bottom: 90px;
        }

        .section-label {
            color: var(--primary);

            font-size: 0.83rem;
            font-weight: 700;

            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .section-title {
            font-weight: 700;

            letter-spacing: -0.5px;
        }

        .section-description {
            color: var(--text-secondary);

            line-height: 1.75;
        }


        /* ==========================
           FEATURE CARDS
        ========================== */

        .feature-card {
            height: 100%;

            background: white;

            border: 1px solid var(--border);
            border-radius: 14px;

            padding: 30px;

            transition:
                transform 0.2s ease,
                box-shadow 0.2s ease,
                border-color 0.2s ease;
        }

        .feature-card:hover {
            transform: translateY(-3px);

            border-color: #c8dddd;

            box-shadow: 0 12px 28px rgba(15, 23, 42, 0.06);
        }

        .feature-icon {
            width: 50px;
            height: 50px;

            display: flex;
            align-items: center;
            justify-content: center;

            margin-bottom: 22px;

            background: var(--primary-soft);
            color: var(--primary);

            border-radius: 12px;

            font-size: 1.35rem;
        }

        .feature-card h5 {
            margin-bottom: 12px;

            font-weight: 650;
        }

        .feature-card p {
            color: var(--text-secondary);

            line-height: 1.7;

            margin-bottom: 0;
        }


        /* ==========================
           HOW IT WORKS
        ========================== */

        .how-section {
            background: var(--background);
        }

        .step-number {
            width: 42px;
            height: 42px;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            background: var(--primary);
            color: white;

            border-radius: 50%;

            font-weight: 700;

            margin-bottom: 18px;
        }

        .step-card {
            height: 100%;

            padding: 25px 10px;
        }

        .step-card h5 {
            font-size: 1.05rem;
            font-weight: 650;
        }

        .step-card p {
            color: var(--text-secondary);

            font-size: 0.92rem;
            line-height: 1.7;
        }


        /* ==========================
           TRUST SECTION
        ========================== */

        .trust-box {
            border-top: 1px solid var(--border);
            border-bottom: 1px solid var(--border);

            background: #fbfcfc;
        }

        .trust-item {
            text-align: center;

            padding: 20px;
        }

        .trust-icon {
            font-size: 1.4rem;
            color: var(--primary);

            margin-bottom: 10px;
        }

        .trust-item h6 {
            font-weight: 650;
        }

        .trust-item p {
            margin-bottom: 0;

            color: var(--text-secondary);

            font-size: 0.88rem;
        }


        /* ==========================
           CTA
        ========================== */

        .cta-box {
            background: linear-gradient(135deg, #0f8a83 0%, #0b6f69 100%);
            color: white;
            border-radius: 16px;
            padding: 32px 40px;
            box-shadow: 0 10px 30px rgba(15, 138, 131, 0.12);
        }

        .cta-box h2 {
            font-size: 1.6rem;
            font-weight: 700;
            margin-bottom: 6px;
            letter-spacing: -0.3px;
        }

        .cta-box p {
            color: rgba(255, 255, 255, 0.9);
            font-size: 0.95rem;
            line-height: 1.5;
        }

        .cta-box .btn-light {
            color: var(--primary-dark);
            font-weight: 700;
            padding: 10px 22px;
            border-radius: 10px;
            font-size: 0.92rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            transition: all 0.2s ease;
        }

        .cta-box .btn-light:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.12);
        }


        /* ==========================
           FOOTER
        ========================== */

        footer {
            border-top: 1px solid var(--border);

            background: #ffffff;
        }

        footer p,
        footer a {
            color: var(--text-secondary);

            font-size: 0.9rem;
        }

        footer a:hover {
            color: var(--primary);
        }


        /* ==========================
           RESPONSIVE
        ========================== */

        @media (max-width: 991.98px) {

            .hero {
                padding-top: 60px;
                padding-bottom: 60px;
            }

            .hero-title {
                font-size: 3rem;
            }

            .platform-preview {
                margin-top: 30px;
            }

            .navbar-collapse {
                padding-top: 20px;
            }

            .navbar .nav-link.active::after {
                display: none;
            }

        }


        @media (max-width: 576px) {

            .hero-title {
                font-size: 2.6rem;
            }

            .hero-description {
                font-size: 1rem;
            }

            .cta-box {
                padding: 35px 25px;
            }

            .section-padding {
                padding-top: 65px;
                padding-bottom: 65px;
            }

        }

        /* =========================================
        WHEN TO USE CURHATAMAN
        ========================================= */

        .when-section {
            padding: 90px 0;
            background: #f7f9f9;
        }

        .when-label {
            color: #0f8a83;
            font-size: .8rem;
            font-weight: 700;
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        .when-title {
            color: #172033;
            font-weight: 700;
            letter-spacing: -.5px;
        }

        .when-description {
            max-width: 650px;
            margin: 0 auto;
            color: #64748b;
            line-height: 1.7;
        }

        .when-card {
            height: 100%;
            background: #ffffff;
            border: 1px solid #e2e8e8;
            border-radius: 14px;

            transition:
                transform .2s ease,
                box-shadow .2s ease,
                border-color .2s ease;
        }

        .when-card:hover {
            transform: translateY(-4px);
            border-color: #b9d9d6;
            box-shadow: 0 12px 28px rgba(15, 23, 42, .06);
        }

        .when-icon {
            width: 56px;
            height: 56px;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            border-radius: 12px;

            background: #e9f5f3;
            color: #0f8a83;

            font-size: 1.4rem;
        }

        .when-number {
            font-size: .75rem;
            font-weight: 700;
            color: #98a2b3;
        }

        .when-card h3 {
            color: #172033;
            font-size: 1.05rem;
            font-weight: 700;
        }

        .when-card p {
            color: #64748b;
            font-size: .9rem;
            line-height: 1.65;
        }

        .when-link {
            color: #0f8a83;
            font-size: .87rem;
            font-weight: 600;
        }

        .when-link:hover {
            color: #0b6f69;
        }

        .when-note {
            margin-top: 40px;

            background: #ffffff;
            border: 1px solid #dce7e6;
            border-radius: 12px;

            padding: 22px 24px;
        }

        .when-note-icon {
            width: 42px;
            height: 42px;

            flex-shrink: 0;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 10px;

            background: #e9f5f3;
            color: #0f8a83;
        }

    
        .footer .brand-symbol,
        footer .brand-symbol {
            background: rgba(255, 255, 255, 0.14);
            color: #ffffff;
            box-shadow: none;
        }

    </style>
</head>


<body
    data-bs-spy="scroll"
    data-bs-target="#mainNavbar"
    data-bs-root-margin="-90px 0px -45%"
    data-bs-smooth-scroll="true"
    tabindex="0"
>


{{-- =====================================================
     NAVBAR
===================================================== --}}

<nav class="navbar navbar-expand-lg bg-white border-bottom sticky-top">

    <div class="container">

        <a
            class="navbar-brand d-flex align-items-center gap-2"
            href="{{ url('/') }}"
            aria-label="CurhatAman"
        >
            <span class="brand-symbol" aria-hidden="true">
                <i class="bi bi-people-fill"></i>
            </span>

            <span class="brand-name">
                CurhatAman
            </span>
        </a>


        <button
            class="navbar-toggler border-0"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#mainNavbar"
        >
            <span class="navbar-toggler-icon"></span>
        </button>


        <div
            class="collapse navbar-collapse"
            id="mainNavbar"
        >

            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">

                <li class="nav-item">
                    <a
                        class="nav-link"
                        href="#beranda"
                    >
                        Beranda
                    </a>
                </li>

                <li class="nav-item">
                    <a
                        class="nav-link"
                        href="#fitur"
                    >
                        Fitur
                    </a>
                </li>

                <li class="nav-item">
                    <a
                        class="nav-link"
                        href="#cara-kerja"
                    >
                        Cara Kerja
                    </a>
                </li>

                <li class="nav-item">
                    <a
                        class="nav-link"
                        href="#tentang"
                    >
                        Tentang
                    </a>
                </li>

            </ul>


            <div class="d-flex gap-2">

                <a
                    href="{{ route('login') }}"
                    class="btn btn-primary px-4"
                >
                    Masuk
                </a>

            </div>

        </div>

    </div>

</nav>



{{-- =====================================================
     HERO
===================================================== --}}

<section
    class="hero"
    id="beranda"
>

    <div class="container">

        <div class="row align-items-center g-5">


            {{-- LEFT --}}

            <div class="col-lg-6">

                <div class="hero-badge mb-4">

                    <i class="bi bi-shield-lock"></i>

                    Privasi siswa menjadi prioritas

                </div>


                <h1 class="hero-title mb-4">

                    Ruang Aman untuk

                    <span class="text-primary d-block">
                        Bercerita
                    </span>

                </h1>


                <p class="hero-description mb-4">

                    CurhatAman membantu siswa menyampaikan laporan
                    perundungan secara aman, mengikuti skrining
                    kesehatan mental berkala, dan mendapatkan
                    pendampingan dari Guru BK.

                </p>


                <div class="d-flex flex-wrap gap-3 mb-5">

                    <a
                        href="{{ route('login') }}"
                        class="btn btn-primary btn-lg"
                    >

                        <i class="bi bi-file-earmark-text me-2"></i>

                        Buat Laporan

                    </a>


                    <a
                        href="{{ route('login') }}"
                        class="btn btn-outline-primary btn-lg"
                    >

                        <i class="bi bi-clipboard2-pulse me-2"></i>

                        Mulai Skrining

                    </a>

                </div>


                <div class="row g-3">

                    <div class="col-sm-auto">

                        <div class="d-flex align-items-center gap-2 text-secondary small">

                            <i class="bi bi-lock text-primary"></i>

                            Informasi Terjaga

                        </div>

                    </div>


                    <div class="col-sm-auto">

                        <div class="d-flex align-items-center gap-2 text-secondary small">

                            <i class="bi bi-person-check text-primary"></i>

                            Pendampingan Guru BK

                        </div>

                    </div>


                    <div class="col-sm-auto">

                        <div class="d-flex align-items-center gap-2 text-secondary small">

                            <i class="bi bi-clock-history text-primary"></i>

                            Progres Terpantau

                        </div>

                    </div>

                </div>

            </div>



            {{-- RIGHT --}}

            <div class="col-lg-6">

                <div class="platform-preview">

                    <div class="preview-header">

                        <div>

                            <div class="fw-semibold">
                                Dukungan untuk Siswa
                            </div>

                            <small class="text-secondary">
                                CurhatAman
                            </small>

                        </div>


                        <span class="badge bg-success-subtle text-success px-3 py-2">

                            <i class="bi bi-shield-check me-1"></i>

                            Aman

                        </span>

                    </div>


                    <div class="preview-body">


                        <div class="preview-item">

                            <div class="preview-icon">

                                <i class="bi bi-file-earmark-text"></i>

                            </div>


                            <div>

                                <h6>
                                    Laporkan Kejadian
                                </h6>

                                <p>
                                    Sampaikan kejadian yang kamu alami
                                    dengan informasi yang diperlukan.
                                </p>

                            </div>

                        </div>


                        <div class="preview-item">

                            <div class="preview-icon">

                                <i class="bi bi-clipboard2-heart"></i>

                            </div>


                            <div>

                                <h6>
                                    Skrining Berkala
                                </h6>

                                <p>
                                    Ikuti skrining awal secara berkala
                                    untuk membantu mengenali kondisi diri.
                                </p>

                            </div>

                        </div>


                        <div class="preview-item">

                            <div class="preview-icon">

                                <i class="bi bi-people"></i>

                            </div>


                            <div>

                                <h6>
                                    Pendampingan Guru BK
                                </h6>

                                <p>
                                    Guru BK dapat memberikan tindak lanjut
                                    dan pendampingan sesuai kebutuhan siswa.
                                </p>

                            </div>

                        </div>


                        <div class="preview-item">

                            <div class="preview-icon">

                                <i class="bi bi-arrow-repeat"></i>

                            </div>


                            <div>

                                <h6>
                                    Pantau Perkembangan
                                </h6>

                                <p>
                                    Siswa dapat melihat status laporan
                                    dan progres penanganannya.
                                </p>

                            </div>

                        </div>


                    </div>

                </div>

            </div>


        </div>

    </div>

</section>



{{-- =====================================================
     TRUST
===================================================== --}}

<section class="trust-box py-4">

    <div class="container">

        <div class="row g-4 justify-content-center">


            <div class="col-6 col-md-3">

                <div class="trust-item">

                    <div class="trust-icon">
                        <i class="bi bi-shield-lock"></i>
                    </div>

                    <h6>
                        Privasi
                    </h6>

                    <p>
                        Akses data dibatasi sesuai kewenangan.
                    </p>

                </div>

            </div>


            <div class="col-6 col-md-3">

                <div class="trust-item">

                    <div class="trust-icon">
                        <i class="bi bi-person-badge"></i>
                    </div>

                    <h6>
                        Guru BK
                    </h6>

                    <p>
                        Pendampingan dilakukan oleh pihak sekolah.
                    </p>

                </div>

            </div>


            <div class="col-6 col-md-3">

                <div class="trust-item">

                    <div class="trust-icon">
                        <i class="bi bi-file-earmark-lock"></i>
                    </div>

                    <h6>
                        Terstruktur
                    </h6>

                    <p>
                        Laporan tersimpan dan dapat dipantau.
                    </p>

                </div>

            </div>


            <div class="col-6 col-md-3">

                <div class="trust-item">

                    <div class="trust-icon">
                        <i class="bi bi-heart"></i>
                    </div>

                    <h6>
                        Dukungan
                    </h6>

                    <p>
                        Membantu siswa mendapatkan bantuan.
                    </p>

                </div>

            </div>


        </div>

    </div>

</section>



{{-- =====================================================
     FITUR
===================================================== --}}

<section
    class="section-padding"
    id="fitur"
>

    <div class="container">


        <div class="row justify-content-center text-center mb-5">

            <div class="col-lg-7">

                <div class="section-label mb-2">
                    Fitur Utama
                </div>

                <h2 class="section-title mb-3">
                    Dukungan dalam Satu Sistem
                </h2>

                <p class="section-description mb-0">
                    CurhatAman dirancang untuk membantu proses
                    pelaporan, skrining awal, dan pendampingan siswa
                    menjadi lebih terstruktur.
                </p>

            </div>

        </div>



        <div class="row g-4">


            <div class="col-md-6 col-lg-4">

                <div class="feature-card">

                    <div class="feature-icon">
                        <i class="bi bi-file-earmark-text"></i>
                    </div>

                    <h5>
                        Pelaporan Kasus
                    </h5>

                    <p>
                        Siswa dapat membuat laporan perundungan,
                        menambahkan kronologi, kategori kejadian,
                        serta bukti pendukung apabila tersedia.
                    </p>

                </div>

            </div>


            <div class="col-md-6 col-lg-4">

                <div class="feature-card">

                    <div class="feature-icon">
                        <i class="bi bi-shield-lock"></i>
                    </div>

                    <h5>
                        Kerahasiaan Data
                    </h5>

                    <p>
                        Informasi laporan hanya dapat diakses oleh
                        pihak yang memiliki kewenangan dalam proses
                        penanganan kasus.
                    </p>

                </div>

            </div>


            <div class="col-md-6 col-lg-4">

                <div class="feature-card">

                    <div class="feature-icon">
                        <i class="bi bi-clipboard2-pulse"></i>
                    </div>

                    <h5>
                        Skrining Berkala
                    </h5>

                    <p>
                        Siswa dapat mengikuti skrining awal secara
                        berkala sebagai salah satu sarana pemantauan
                        kondisi kesehatan mental.
                    </p>

                </div>

            </div>


            <div class="col-md-6 col-lg-4">

                <div class="feature-card">

                    <div class="feature-icon">
                        <i class="bi bi-person-check"></i>
                    </div>

                    <h5>
                        Tindak Lanjut Guru BK
                    </h5>

                    <p>
                        Guru BK dapat meninjau laporan, memperbarui
                        status kasus, dan mencatat tindak lanjut
                        yang telah dilakukan.
                    </p>

                </div>

            </div>


            <div class="col-md-6 col-lg-4">

                <div class="feature-card">

                    <div class="feature-icon">
                        <i class="bi bi-clock-history"></i>
                    </div>

                    <h5>
                        Riwayat & Status
                    </h5>

                    <p>
                        Siswa dapat memantau perkembangan laporan
                        melalui status penanganan tanpa harus
                        menanyakan secara langsung.
                    </p>

                </div>

            </div>


            <div class="col-md-6 col-lg-4">

                <div class="feature-card">

                    <div class="feature-icon">
                        <i class="bi bi-life-preserver"></i>
                    </div>

                    <h5>
                        Rujukan & Bantuan
                    </h5>

                    <p>
                        Informasi bantuan dan layanan pendukung
                        tersedia apabila siswa membutuhkan
                        pendampingan lebih lanjut.
                    </p>

                </div>

            </div>


        </div>

    </div>

</section>




{{-- =====================================================
     KAPAN MENGGUNAKAN CURHATAMAN
===================================================== --}}

<section class="when-section" id="kapan-menggunakan">

    <div class="container">

        <div class="row justify-content-center text-center mb-5">
            <div class="col-lg-7">

                <div class="when-label mb-2">
                    Dukungan untuk Siswa
                </div>

                <h2 class="when-title mb-3">
                    Kapan Kamu Perlu Menggunakan CurhatAman?
                </h2>

                <p class="when-description">
                    Kamu tidak harus menunggu masalah menjadi besar.
                    CurhatAman dapat digunakan ketika kamu mengalami,
                    melihat, atau membutuhkan bantuan terkait situasi
                    yang membuatmu merasa tidak nyaman di sekolah.
                </p>

            </div>
        </div>

        <div class="row g-4">

            <div class="col-md-6 col-lg-4">
                <div class="when-card">
                    <div class="card-body p-4 p-lg-5">

                        <div class="d-flex justify-content-between align-items-start mb-4">
                            <div class="when-icon">
                                <i class="bi bi-shield-exclamation"></i>
                            </div>

                            <span class="when-number">01</span>
                        </div>

                        <h3 class="mb-3">
                            Mengalami Perundungan
                        </h3>

                        <p class="mb-4">
                            Gunakan CurhatAman jika kamu mengalami tindakan
                            fisik, verbal, sosial, atau perundungan melalui
                            media digital yang membuatmu merasa tidak aman
                            atau tidak nyaman.
                        </p>

                        <a
                            href="{{ route('login') }}"
                            class="when-link d-inline-flex align-items-center gap-2"
                        >
                            Buat laporan
                            <i class="bi bi-arrow-right"></i>
                        </a>

                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="when-card">
                    <div class="card-body p-4 p-lg-5">

                        <div class="d-flex justify-content-between align-items-start mb-4">
                            <div class="when-icon">
                                <i class="bi bi-eye"></i>
                            </div>

                            <span class="when-number">02</span>
                        </div>

                        <h3 class="mb-3">
                            Melihat atau Mengetahui Kejadian
                        </h3>

                        <p class="mb-4">
                            Jika kamu melihat teman mengalami perundungan
                            atau mengetahui kejadian yang perlu mendapatkan
                            perhatian, kamu dapat menyampaikannya melalui
                            sistem.
                        </p>

                        <a
                            href="{{ route('login') }}"
                            class="when-link d-inline-flex align-items-center gap-2"
                        >
                            Sampaikan informasi
                            <i class="bi bi-arrow-right"></i>
                        </a>

                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="when-card">
                    <div class="card-body p-4 p-lg-5">

                        <div class="d-flex justify-content-between align-items-start mb-4">
                            <div class="when-icon">
                                <i class="bi bi-chat-heart"></i>
                            </div>

                            <span class="when-number">03</span>
                        </div>

                        <h3 class="mb-3">
                            Membutuhkan Dukungan
                        </h3>

                        <p class="mb-4">
                            Kamu juga dapat menggunakan CurhatAman ketika
                            ingin meminta pendampingan atau berbicara dengan
                            Guru BK tanpa harus membuat laporan kasus terlebih
                            dahulu.
                        </p>

                        <a
                            href="{{ route('login') }}"
                            class="when-link d-inline-flex align-items-center gap-2"
                        >
                            Akses bantuan
                            <i class="bi bi-arrow-right"></i>
                        </a>

                    </div>
                </div>
            </div>

        </div>

        <div class="when-note">

            <div class="d-flex flex-column flex-md-row align-items-md-center gap-3">

                <div class="when-note-icon">
                    <i class="bi bi-info-circle"></i>
                </div>

                <div class="flex-grow-1">

                    <h6 class="fw-semibold mb-1">
                        Tidak yakin harus mulai dari mana?
                    </h6>

                    <p class="text-secondary small mb-0">
                        Masuk ke CurhatAman untuk melihat pilihan bantuan
                        yang tersedia. Kamu dapat membuat laporan,
                        mengikuti skrining, atau meminta pendampingan Guru BK.
                    </p>

                </div>

                <a
                    href="{{ route('login') }}"
                    class="btn btn-outline-primary flex-shrink-0"
                >
                    Masuk ke CurhatAman
                </a>

            </div>

        </div>

    </div>

</section>


{{-- =====================================================
     CARA KERJA
===================================================== --}}

<section
    class="section-padding how-section"
    id="cara-kerja"
>

    <div class="container">


        <div class="row justify-content-center text-center mb-5">

            <div class="col-lg-7">

                <div class="section-label mb-2">
                    Cara Kerja
                </div>

                <h2 class="section-title mb-3">
                    Proses yang Sederhana
                </h2>

                <p class="section-description mb-0">
                    Siswa dapat menggunakan CurhatAman melalui
                    beberapa langkah sederhana.
                </p>

            </div>

        </div>



        <div class="row g-4 text-center">


            <div class="col-md-6 col-lg-3">

                <div class="step-card">

                    <div class="step-number">
                        1
                    </div>

                    <h5>
                        Masuk ke Akun
                    </h5>

                    <p>
                        Login menggunakan akun yang telah terdaftar
                        untuk mengakses layanan CurhatAman.
                    </p>

                </div>

            </div>


            <div class="col-md-6 col-lg-3">

                <div class="step-card">

                    <div class="step-number">
                        2
                    </div>

                    <h5>
                        Pilih Layanan
                    </h5>

                    <p>
                        Buat laporan, ikuti skrining berkala,
                        atau akses informasi bantuan.
                    </p>

                </div>

            </div>


            <div class="col-md-6 col-lg-3">

                <div class="step-card">

                    <div class="step-number">
                        3
                    </div>

                    <h5>
                        Data Diproses
                    </h5>

                    <p>
                        Sistem menyimpan informasi dan meneruskannya
                        kepada pihak yang berwenang bila diperlukan.
                    </p>

                </div>

            </div>


            <div class="col-md-6 col-lg-3">

                <div class="step-card">

                    <div class="step-number">
                        4
                    </div>

                    <h5>
                        Pantau Tindak Lanjut
                    </h5>

                    <p>
                        Periksa status laporan dan perkembangan
                        penanganan melalui dashboard siswa.
                    </p>

                </div>

            </div>


        </div>

    </div>

</section>



{{-- =====================================================
     TENTANG
===================================================== --}}

<section
    class="section-padding"
    id="tentang"
>

    <div class="container">

        <div class="row align-items-center g-5">


            <div class="col-lg-6">

                <div class="section-label mb-2">
                    Tentang CurhatAman
                </div>

                <h2 class="section-title mb-4">
                    Membantu Sekolah Memberikan Dukungan yang Lebih Terstruktur
                </h2>

                <p class="section-description">
                    CurhatAman merupakan sistem informasi berbasis web
                    yang dirancang untuk mendukung proses pelaporan
                    perundungan dan skrining awal kesehatan mental siswa.
                </p>

                <p class="section-description mb-0">
                    Sistem membantu siswa menyampaikan laporan,
                    Guru BK melakukan tindak lanjut, serta pihak sekolah
                    memantau informasi sesuai hak akses masing-masing.
                </p>

            </div>


            <div class="col-lg-6">

                <div class="card border-0 bg-light rounded-4">

                    <div class="card-body p-4 p-lg-5">

                        <div class="d-flex gap-3 mb-4">

                            <div class="feature-icon mb-0">
                                <i class="bi bi-shield-check"></i>
                            </div>

                            <div>

                                <h5 class="fw-semibold">
                                    Bukan Diagnosis Klinis
                                </h5>

                                <p class="text-secondary mb-0">
                                    Skrining berfungsi sebagai alat bantu
                                    skrining awal dan tetap memerlukan
                                    tindak lanjut dari pihak yang kompeten.
                                </p>

                            </div>

                        </div>


                        <div class="d-flex gap-3">

                            <div class="feature-icon mb-0">
                                <i class="bi bi-people"></i>
                            </div>

                            <div>

                                <h5 class="fw-semibold">
                                    Akses Sesuai Peran
                                </h5>

                                <p class="text-secondary mb-0">
                                    Setiap pengguna memiliki hak akses
                                    yang berbeda sesuai peran dan
                                    kewenangannya di sekolah.
                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


        </div>

    </div>

</section>



{{-- =====================================================
     CTA
===================================================== --}}

<section class="pb-5">

    <div class="container">

        <div class="cta-box">
            <div class="row align-items-center g-3">
                <div class="col-lg-8">
                    <h2>
                        Butuh ruang untuk bercerita?
                    </h2>
                    <p class="mb-0">
                        Gunakan CurhatAman untuk menyampaikan hal yang kamu alami dan mendapatkan dukungan yang sesuai.
                    </p>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <a href="{{ route('login') }}" class="btn btn-light">
                        Masuk Sekarang
                    </a>
                </div>
            </div>
        </div>

    </div>

</section>



{{-- =====================================================
     FOOTER
===================================================== --}}

<footer class="py-5">

    <div class="container">

        <div class="row g-4 justify-content-between">
            <div class="col-lg-5">
                <a class="navbar-brand d-inline-flex align-items-center gap-2 mb-3" href="{{ url('/') }}" aria-label="CurhatAman">
                    <span class="brand-symbol" aria-hidden="true">
                        <i class="bi bi-people-fill brand-people"></i>
                        <i class="bi bi-book-half brand-book"></i>
                        <i class="bi bi-stars brand-star"></i>
                    </span>
                    <span class="brand-name">CurhatAman</span>
                </a>
                <p class="mb-0 text-secondary" style="font-size: 0.9rem; line-height: 1.6; max-width: 400px;">
                    Sistem pelaporan dan skrining awal untuk membantu menciptakan lingkungan sekolah yang lebih aman dan mendukung siswa.
                </p>
            </div>

            <div class="col-lg-6 col-xl-5">
                <div class="row g-4 justify-content-lg-end">
                    <div class="col-6 col-sm-5 col-md-4">
                        <h6 class="fw-bold mb-3 text-dark" style="font-size: 0.95rem;">Navigasi</h6>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2"><a href="#beranda" class="text-decoration-none">Beranda</a></li>
                            <li class="mb-2"><a href="#fitur" class="text-decoration-none">Fitur</a></li>
                            <li class="mb-2"><a href="#cara-kerja" class="text-decoration-none">Cara Kerja</a></li>
                        </ul>
                    </div>

                    <div class="col-6 col-sm-5 col-md-4">
                        <h6 class="fw-bold mb-3 text-dark" style="font-size: 0.95rem;">Akun</h6>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2"><a href="{{ route('login') }}" class="text-decoration-none">Masuk</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>


        <hr class="my-4">


        <div
            class="d-flex flex-column flex-md-row
                   justify-content-between gap-2"
        >

            <p class="mb-0">
                © {{ date('Y') }} CurhatAman.
            </p>

            <p class="mb-0">
                Platform dukungan siswa berbasis sekolah.
            </p>

        </div>

    </div>

</footer>



{{-- Bootstrap JS --}}
<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const scrollSpy = bootstrap.ScrollSpy.getOrCreateInstance(document.body, {
            target: '#mainNavbar',
            rootMargin: '-90px 0px -45%',
            smoothScroll: true
        });

        scrollSpy.refresh();
    });
</script>


</body>

</html>