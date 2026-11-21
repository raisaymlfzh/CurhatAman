<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Paket Skrining - CurhatAman</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>

        :root {
            --ca-primary: #0f8a83;
            --ca-primary-dark: #0b6f69;
            --ca-primary-soft: #eaf6f4;
            --ca-text: #172033;
            --ca-muted: #667085;
            --ca-bg: #f6f8f9;
            --ca-border: #e3e9e9;
            --ca-line: #edf1f1;
            --sidebar-width: 252px;
            --topbar-height: 72px;
        }

        * { box-sizing: border-box; }
        html, body { min-height: 100%; }

        body {
            min-height: 100vh;
            margin: 0;
            color: var(--ca-text);
            background: var(--ca-bg);
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, Arial, sans-serif;
            font-size: .9rem;
        }

        a { text-decoration: none; }

        .app-shell {
            min-height: 100vh;
            display: grid;
            grid-template-columns: var(--sidebar-width) minmax(0,1fr);
            grid-template-rows: var(--topbar-height) minmax(0,1fr);
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
            border-radius: 10px;
            color: #fff;
            background: var(--ca-primary);
            font-size: 1.08rem;
        }

        .brand-name {
            display: block;
            color: var(--ca-primary);
            font-size: 1.08rem;
            font-weight: 750;
        }

        .brand-role {
            display: block;
            margin-top: 1px;
            color: var(--ca-muted);
            font-size: .72rem;
            font-weight: 600;
        }

        .sidebar-section-label {
            margin: 0 10px 9px;
            color: #98a2b3;
            font-size: .72rem;
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
            font-size: .86rem;
            font-weight: 560;
        }

        .sidebar-link i {
            width: 19px;
            color: #7b8795;
            text-align: center;
        }

        .sidebar-link:hover {
            color: var(--ca-primary-dark);
            background: #f4f9f8;
        }

        .sidebar-link.active {
            color: var(--ca-primary-dark);
            background: var(--ca-primary-soft);
            font-weight: 680;
        }

        .sidebar-link.active i,
        .sidebar-link:hover i { color: var(--ca-primary); }

        .sidebar-spacer { flex: 1; }

        .sidebar-account {
            margin-top: 24px;
            padding-top: 18px;
            border-top: 1px solid var(--ca-line);
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
            font-size: .82rem;
            font-weight: 560;
            text-align: left;
        }

        .logout-button:hover { background: #fff3f2; }

        .topbar {
            grid-column: 2;
            min-width: 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            padding: 0 28px;
            background: #fff;
            border-bottom: 1px solid var(--ca-border);
        }

        .topbar-title {
            margin-bottom: 1px;
            font-size: .92rem;
            font-weight: 680;
        }

        .topbar-subtitle {
            color: var(--ca-muted);
            font-size: .74rem;
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
        }

        .page-body { padding: 28px; }

        .content-shell {
            max-width: 1160px;
            margin: 0 auto;
        }

        .page-kicker {
            margin-bottom: 6px;
            color: var(--ca-primary);
            font-size: .73rem;
            font-weight: 750;
            letter-spacing: .07em;
            text-transform: uppercase;
        }

        .page-title {
            margin-bottom: 7px;
            font-size: 1.65rem;
            font-weight: 760;
            letter-spacing: -.4px;
        }

        .page-copy {
            max-width: 760px;
            margin: 0;
            color: var(--ca-muted);
            font-size: .84rem;
            line-height: 1.6;
        }

        .panel {
            border: 1px solid var(--ca-border);
            border-radius: 12px;
            background: #fff;
        }

        .page-footer {
            margin-top: 28px;
            padding-top: 15px;
            border-top: 1px solid var(--ca-border);
            color: #8a94a3;
            font-size: .7rem;
        }

        @media (max-width: 991.98px) {
            .app-shell { display: block; }
            .sidebar { display: none; }

            .topbar {
                min-height: var(--topbar-height);
                padding: 0 18px;
            }

            .page-body { padding: 22px 18px 30px; }
        }

        @media (max-width: 575.98px) {
            .date-chip,
            .account-copy,
            .account-chevron {
                display: none !important;
            }

            .account-trigger {
                min-width: auto;
                padding: 5px;
            }

            .page-title { font-size: 1.4rem; }
        }


        .form-shell {
            max-width: 820px;
        }

        .form-card {
            overflow: hidden;
        }

        .form-card-header {
            padding: 18px 20px;
            border-bottom: 1px solid var(--ca-line);
        }

        .form-card-title {
            margin-bottom: 2px;
            font-size: .92rem;
            font-weight: 700;
        }

        .form-card-subtitle {
            color: var(--ca-muted);
            font-size: .72rem;
        }

        .form-card-body {
            padding: 20px;
        }

        .form-label {
            margin-bottom: 6px;
            color: #344054;
            font-size: .75rem;
            font-weight: 650;
        }

        .required {
            color: #b42318;
        }

        .form-control {
            min-height: 42px;
            border-color: #d7e0e0;
            border-radius: 9px;
            font-size: .8rem;
        }

        textarea.form-control {
            min-height: 110px;
            resize: vertical;
        }

        .form-control:focus {
            border-color: var(--ca-primary);
            box-shadow: 0 0 0 3px rgba(15,138,131,.08);
        }

        .form-hint {
            margin-top: 5px;
            color: var(--ca-muted);
            font-size: .68rem;
            line-height: 1.5;
        }

        .info-box {
            display: flex;
            align-items: flex-start;
            gap: 9px;
            margin-bottom: 18px;
            padding: 12px 14px;
            border: 1px solid #cfe4e1;
            border-radius: 10px;
            color: #55706d;
            background: #f3f9f8;
            font-size: .72rem;
            line-height: 1.55;
        }

        .info-box i {
            margin-top: 1px;
            color: var(--ca-primary);
        }

        .form-actions {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 9px;
            margin-top: 22px;
            padding-top: 18px;
            border-top: 1px solid var(--ca-line);
        }

        .btn-primary-ca,
        .btn-secondary-ca {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            min-height: 40px;
            padding: 9px 14px;
            border-radius: 9px;
            font-size: .78rem;
            font-weight: 650;
        }

        .btn-primary-ca {
            border: 1px solid var(--ca-primary);
            color: #fff;
            background: var(--ca-primary);
        }

        .btn-primary-ca:hover {
            color: #fff;
            background: var(--ca-primary-dark);
        }

        .btn-secondary-ca {
            border: 1px solid #d7e0e0;
            color: #475467;
            background: #fff;
        }

        .btn-secondary-ca:hover {
            color: var(--ca-primary-dark);
            background: #f7faf9;
        }

        @media (max-width: 575.98px) {
            .form-actions {
                align-items: stretch;
                flex-direction: column-reverse;
            }

            .btn-primary-ca,
            .btn-secondary-ca {
                width: 100%;
            }
        }
    </style>
    @include('guru-bk.partials.styles')
</head>

<body>

@php
    $namaUser = ucwords($user->name);
    $inisial = strtoupper(substr($user->name, 0, 1));
@endphp

<div class="app-shell">

    @include('guru-bk.partials.sidebar')

    <header class="topbar">
        <div>
            <div class="topbar-title">Buat Paket Skrining</div>
            <div class="topbar-subtitle">Buat paket skrining baru.</div>
        </div>

        <div class="topbar-actions">
            <div class="date-chip">
                <i class="bi bi-calendar3"></i>
                {{ now()->locale('id')->translatedFormat('d F Y') }}
            </div>

            <a href="{{ route('guru-bk.profil.index') }}" class="account-trigger">
                <span class="topbar-avatar">{{ $inisial }}</span>

                <span class="account-copy">
                    <span class="account-name d-block">{{ $namaUser }}</span>
                    <span class="account-role d-block">Guru BK</span>
                </span>

                <i class="bi bi-chevron-right account-chevron"></i>
            </a>
        </div>
    </header>

    <main class="main-content">
        <div class="page-body">
            <div class="content-shell form-shell">

                <section class="mb-4">
                    <div class="page-kicker">Manajemen Instrumen</div>

                    <h1 class="page-title">
                        Buat Paket Skrining
                    </h1>

                    <p class="page-copy">Buat paket skrining baru.</p>
                </section>

                <div class="info-box">
                    <i class="bi bi-shield-check"></i>

                    <div>
                        Paket akan disimpan sebagai <strong>Draft</strong>
                        dan belum dapat dikerjakan siswa sampai pertanyaan
                        sudah diisi dan paket diaktifkan.
                    </div>
                </div>

                <section class="panel form-card">

                    <div class="form-card-header">
                        <div class="form-card-title">
                            Informasi Paket
                        </div>

                        <div class="form-card-subtitle">
                            Identitas instrumen skrining yang akan digunakan
                        </div>
                    </div>

                    <div class="form-card-body">

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0 ps-3">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form
                            method="POST"
                            action="{{ route('guru-bk.skrining.paket.store') }}"
                        >
                            @csrf

                            <div class="mb-3">
                                <label for="nama_paket" class="form-label">
                                    Nama Paket
                                    <span class="required">*</span>
                                </label>

                                <input
                                    type="text"
                                    name="nama_paket"
                                    id="nama_paket"
                                    class="form-control"
                                    value="{{ old('nama_paket') }}"
                                    maxlength="150"
                                    placeholder="Contoh: Skrining SDQ Semester Ganjil 2026"
                                    required
                                >

                                <div class="form-hint">
                                    Gunakan nama yang memudahkan Guru BK
                                    membedakan periode atau tujuan skrining.
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="jenis_instrumen" class="form-label">
                                    Jenis Instrumen
                                    <span class="required">*</span>
                                </label>

                                <input
                                    type="text"
                                    name="jenis_instrumen"
                                    id="jenis_instrumen"
                                    class="form-control"
                                    value="{{ old('jenis_instrumen', 'SDQ') }}"
                                    maxlength="100"
                                    required
                                >

                                <div class="form-hint">
                                    Contoh: SDQ. Nama instrumen tidak
                                    menggantikan kewajiban menggunakan versi
                                    pertanyaan yang telah diverifikasi.
                                </div>
                            </div>

                            <div class="mb-0">
                                <label for="deskripsi" class="form-label">
                                    Deskripsi
                                </label>

                                <textarea
                                    name="deskripsi"
                                    id="deskripsi"
                                    class="form-control"
                                    maxlength="2000"
                                    placeholder="Tuliskan keterangan singkat mengenai periode atau tujuan penggunaan paket..."
                                >{{ old('deskripsi') }}</textarea>
                            </div>

                            <div class="form-actions">
                                <a
                                    href="{{ route('guru-bk.skrining.paket.index') }}"
                                    class="btn-secondary-ca"
                                >
                                    Batal
                                </a>

                                <button type="submit" class="btn-primary-ca">
                                    <i class="bi bi-check2"></i>
                                    Simpan Paket
                                </button>
                            </div>

                        </form>

                    </div>
                </section>

                <footer class="page-footer">
                    <div class="d-flex flex-column flex-md-row justify-content-between gap-2">
                        <span>© {{ date('Y') }} CurhatAman</span>
                        <span>Portal Guru BK · Paket skrining</span>
                    </div>
                </footer>

            </div>
        </div>
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>



