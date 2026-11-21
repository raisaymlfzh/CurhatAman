<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pertanyaan - CurhatAman</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        :root {
            --ca-primary:#0f8a83;
            --ca-primary-dark:#0b6f69;
            --ca-primary-soft:#eaf6f4;
            --ca-text:#172033;
            --ca-muted:#667085;
            --ca-bg:#f6f8f9;
            --ca-border:#e3e9e9;
            --ca-line:#edf1f1;
            --sidebar-width:252px;
            --topbar-height:72px;
        }

        *{box-sizing:border-box}
        html,body{min-height:100%}

        body{
            min-height:100vh;
            margin:0;
            color:var(--ca-text);
            background:var(--ca-bg);
            font-family:system-ui,-apple-system,"Segoe UI",Roboto,Arial,sans-serif;
            font-size:.9rem;
        }

        a{text-decoration:none}

        .app-shell{
            min-height:100vh;
            display:grid;
            grid-template-columns:var(--sidebar-width) minmax(0,1fr);
            grid-template-rows:var(--topbar-height) minmax(0,1fr);
        }

        .sidebar{
            grid-row:1/3;
            min-height:100vh;
            display:flex;
            flex-direction:column;
            padding:20px 16px;
            background:#fff;
            border-right:1px solid var(--ca-border);
        }

        .sidebar-brand{
            display:flex;
            align-items:center;
            gap:10px;
            min-height:48px;
            margin-bottom:30px;
            padding:0 8px;
        }

        .brand-symbol{
            width:40px;
            height:40px;
            display:inline-flex;
            align-items:center;
            justify-content:center;
            border-radius:10px;
            color:#fff;
            background:var(--ca-primary);
        }

        .brand-name{
            display:block;
            color:var(--ca-primary);
            font-size:1.08rem;
            font-weight:750;
        }

        .brand-role{
            display:block;
            margin-top:1px;
            color:var(--ca-muted);
            font-size:.72rem;
            font-weight:600;
        }

        .sidebar-section-label{
            margin:0 10px 9px;
            color:#98a2b3;
            font-size:.72rem;
            font-weight:750;
            letter-spacing:.08em;
            text-transform:uppercase;
        }

        .sidebar-nav{
            display:flex;
            flex-direction:column;
            gap:4px;
        }

        .sidebar-link{
            display:flex;
            align-items:center;
            gap:11px;
            min-height:42px;
            padding:10px 11px;
            border-radius:9px;
            color:#475467;
            font-size:.86rem;
            font-weight:560;
        }

        .sidebar-link i{
            width:19px;
            color:#7b8795;
            text-align:center;
        }

        .sidebar-link.active{
            color:var(--ca-primary-dark);
            background:var(--ca-primary-soft);
            font-weight:680;
        }

        .sidebar-link.active i{color:var(--ca-primary)}

        .sidebar-spacer{flex:1}

        .sidebar-account{
            margin-top:24px;
            padding-top:18px;
            border-top:1px solid var(--ca-line);
        }

        .logout-button{
            width:100%;
            display:flex;
            align-items:center;
            gap:10px;
            min-height:40px;
            padding:9px 11px;
            border:0;
            border-radius:9px;
            color:#b42318;
            background:transparent;
            font-size:.82rem;
            font-weight:560;
            text-align:left;
        }

        .topbar{
            grid-column:2;
            display:flex;
            align-items:center;
            justify-content:space-between;
            gap:18px;
            padding:0 28px;
            background:#fff;
            border-bottom:1px solid var(--ca-border);
        }

        .topbar-title{
            font-size:.92rem;
            font-weight:680;
        }

        .topbar-subtitle{
            color:var(--ca-muted);
            font-size:.74rem;
        }

        .account-trigger{
            display:inline-flex;
            align-items:center;
            gap:9px;
            padding:6px 8px;
            border-radius:10px;
            color:var(--ca-text);
        }

        .topbar-avatar{
            width:36px;
            height:36px;
            display:inline-flex;
            align-items:center;
            justify-content:center;
            border-radius:50%;
            color:var(--ca-primary-dark);
            background:#dcefeb;
            font-size:.82rem;
            font-weight:750;
        }

        .account-name{
            font-size:.82rem;
            font-weight:680;
        }

        .account-role{
            color:var(--ca-muted);
            font-size:.72rem;
        }

        .main-content{grid-column:2;min-width:0}
        .page-body{padding:28px}
        .content-shell{max-width:1160px;margin:0 auto}

        .back-link{
            display:inline-flex;
            align-items:center;
            gap:6px;
            margin-bottom:15px;
            color:var(--ca-muted);
            font-size:.74rem;
            font-weight:600;
        }

        .page-kicker{
            margin-bottom:6px;
            color:var(--ca-primary);
            font-size:.73rem;
            font-weight:750;
            letter-spacing:.07em;
            text-transform:uppercase;
        }

        .page-title{
            margin-bottom:7px;
            font-size:1.65rem;
            font-weight:760;
        }

        .page-copy{
            margin:0;
            color:var(--ca-muted);
            font-size:.84rem;
            line-height:1.6;
        }

        .package-card{
            display:flex;
            align-items:flex-start;
            justify-content:space-between;
            gap:15px;
            margin:20px 0;
            padding:16px 18px;
            border:1px solid #cfe4e1;
            border-radius:11px;
            background:#f3f9f8;
        }

        .package-name{
            color:var(--ca-primary-dark);
            font-size:.9rem;
            font-weight:720;
        }

        .package-meta{
            margin-top:3px;
            color:#5d7774;
            font-size:.71rem;
        }

        .draft-badge{
            display:inline-flex;
            align-items:center;
            gap:5px;
            padding:5px 8px;
            border-radius:999px;
            color:#775e0a;
            background:#fff7dc;
            font-size:.67rem;
            font-weight:680;
        }

        .grid{
            display:grid;
            grid-template-columns:370px minmax(0,1fr);
            gap:18px;
        }

        .panel{
            border:1px solid var(--ca-border);
            border-radius:12px;
            background:#fff;
            overflow:hidden;
        }

        .panel-header{
            padding:16px 18px;
            border-bottom:1px solid var(--ca-line);
        }

        .panel-title{
            font-size:.88rem;
            font-weight:700;
        }

        .panel-subtitle{
            margin-top:2px;
            color:var(--ca-muted);
            font-size:.71rem;
        }

        .panel-body{padding:18px}

        .form-label{
            margin-bottom:6px;
            color:#344054;
            font-size:.73rem;
            font-weight:650;
        }

        .form-control{
            min-height:40px;
            border-color:#d7e0e0;
            border-radius:8px;
            font-size:.78rem;
        }

        textarea.form-control{
            min-height:100px;
            resize:vertical;
        }

        .form-check-label{
            color:#475467;
            font-size:.72rem;
        }

        .btn-primary-ca{
            display:inline-flex;
            align-items:center;
            justify-content:center;
            gap:6px;
            min-height:38px;
            padding:8px 12px;
            border:1px solid var(--ca-primary);
            border-radius:8px;
            color:#fff;
            background:var(--ca-primary);
            font-size:.75rem;
            font-weight:650;
        }

        .btn-primary-ca:hover{
            color:#fff;
            background:var(--ca-primary-dark);
        }

        .question-item{
            display:grid;
            grid-template-columns:42px minmax(0,1fr) auto;
            gap:12px;
            align-items:flex-start;
            padding:14px 0;
            border-bottom:1px solid var(--ca-line);
        }

        .question-item:first-child{padding-top:0}
        .question-item:last-child{
            padding-bottom:0;
            border-bottom:0;
        }

        .question-number{
            width:34px;
            height:34px;
            display:inline-flex;
            align-items:center;
            justify-content:center;
            border-radius:8px;
            color:var(--ca-primary-dark);
            background:var(--ca-primary-soft);
            font-size:.75rem;
            font-weight:720;
        }

        .question-aspect{
            margin-bottom:4px;
            color:var(--ca-primary-dark);
            font-size:.68rem;
            font-weight:700;
            text-transform:uppercase;
            letter-spacing:.04em;
        }

        .question-text{
            color:#344054;
            font-size:.78rem;
            line-height:1.55;
        }

        .reverse-note{
            margin-top:5px;
            color:var(--ca-muted);
            font-size:.67rem;
        }

        .delete-btn{
            width:32px;
            height:32px;
            display:inline-flex;
            align-items:center;
            justify-content:center;
            border:1px solid #f1d6d3;
            border-radius:7px;
            color:#b42318;
            background:#fff;
        }

        .empty{
            padding:38px 15px;
            color:var(--ca-muted);
            text-align:center;
            font-size:.73rem;
        }

        .empty i{
            display:block;
            margin-bottom:8px;
            color:#98a2b3;
            font-size:1.4rem;
        }

        .count-badge{
            display:inline-flex;
            align-items:center;
            gap:5px;
            padding:5px 8px;
            border-radius:999px;
            color:#475467;
            background:#f2f4f7;
            font-size:.68rem;
            font-weight:680;
        }

        .sdq-action{
            margin-bottom:18px;
            padding:16px 18px;
            border:1px solid #cfe4e1;
            border-radius:11px;
            display:flex;
            align-items:center;
            justify-content:space-between;
            gap:16px;
            background:#f8fcfb;
        }

        .sdq-action-title{
            color:var(--ca-primary-dark);
            font-size:.84rem;
            font-weight:720;
        }

        .sdq-action-copy{
            margin-top:3px;
            color:var(--ca-muted);
            font-size:.72rem;
            line-height:1.5;
        }

        .btn-sdq{
            flex-shrink:0;
            display:inline-flex;
            align-items:center;
            justify-content:center;
            gap:6px;
            min-height:38px;
            padding:8px 13px;
            border:1px solid var(--ca-primary);
            border-radius:8px;
            color:#fff;
            background:var(--ca-primary);
            font-size:.74rem;
            font-weight:680;
        }

        .btn-sdq:hover{
            color:#fff;
            background:var(--ca-primary-dark);
        }

        .active-note{
            padding:14px 15px;
            border:1px solid #dcebea;
            border-radius:9px;
            color:#5f6f6d;
            background:#fbfefe;
            font-size:.73rem;
            line-height:1.55;
        }

        @media(max-width:991.98px){
            .app-shell{display:block}
            .sidebar{display:none}
            .topbar{min-height:72px;padding:0 18px}
            .page-body{padding:22px 18px}
            .grid{grid-template-columns:1fr}
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
            <div class="topbar-title">Kelola Pertanyaan</div>
            <div class="topbar-subtitle">
                Kelola pertanyaan skrining.
            </div>
        </div>

        <a href="{{ route('guru-bk.profil.index') }}" class="account-trigger">
            <span class="topbar-avatar">{{ $inisial }}</span>

            <span>
                <span class="account-name d-block">{{ $namaUser }}</span>
                <span class="account-role d-block">Guru BK</span>
            </span>
        </a>
    </header>

    <main class="main-content">
        <div class="page-body">
            <div class="content-shell">

                <a
                    href="{{ route('guru-bk.skrining.paket.index') }}"
                    class="back-link"
                >
                    <i class="bi bi-arrow-left"></i>
                    Kembali ke Paket Skrining
                </a>

                <div class="page-kicker">Manajemen Instrumen</div>

                <h1 class="page-title">
                    Kelola Pertanyaan
                </h1>

                <p class="page-copy">Kelola butir pertanyaan paket skrining.</p>

                <div class="package-card">
                    <div>
                        <div class="package-name">
                            {{ $paketSkrining->nama_paket }}
                        </div>

                        <div class="package-meta">
                            {{ $paketSkrining->jenis_instrumen }}
                            · {{ $pertanyaan->count() }} pertanyaan
                        </div>
                    </div>

                    @if (! $paketSkrining->is_active)
                        <span class="draft-badge">
                            <i class="bi bi-pencil"></i>
                            Draft
                        </span>
                    @else
                        <span class="count-badge">
                            <i class="bi bi-check2-circle"></i>
                            Aktif
                        </span>
                    @endif
                </div>

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (! $paketSkrining->is_active && $pertanyaan->isEmpty())
                    <div class="sdq-action">
                        <div>
                            <div class="sdq-action-title">
                                Masukkan 25 Butir SDQ
                            </div>

                            <div class="sdq-action-copy">
                                Memasukkan seluruh pertanyaan SDQ usia 11–18 tahun beserta aspek dan reverse scoring, lalu mengaktifkan paket.
                            </div>
                        </div>

                        <form
                            method="POST"
                            action="{{ route(
                                'guru-bk.skrining.paket.sdq.store',
                                $paketSkrining->id
                            ) }}"
                            onsubmit="return confirm('Masukkan 25 butir SDQ dan aktifkan paket ini?')"
                        >
                            @csrf

                            <button
                                type="submit"
                                class="btn-sdq"
                            >
                                <i class="bi bi-magic"></i>
                                Masukkan SDQ
                            </button>
                        </form>
                    </div>
                @endif

                <div class="grid">

                    <section class="panel">
                        <div class="panel-header">
                            <div class="panel-title">
                                Tambah Pertanyaan
                            </div>

                            <div class="panel-subtitle">
                                Tambahkan manual jika tidak menggunakan import SDQ
                            </div>
                        </div>

                        <div class="panel-body">

                            @if ($paketSkrining->is_active)
                                <div class="active-note">
                                    Paket sudah aktif. Pertanyaan tidak dapat ditambah atau dihapus.
                                </div>
                            @else
                                <form
                                    method="POST"
                                    action="{{ route(
                                        'guru-bk.skrining.paket.pertanyaan.store',
                                        $paketSkrining->id
                                    ) }}"
                                >
                                    @csrf

                                <div class="mb-3">
                                    <label for="nomor" class="form-label">
                                        Nomor
                                    </label>

                                    <input
                                        type="number"
                                        name="nomor"
                                        id="nomor"
                                        class="form-control"
                                        min="1"
                                        max="255"
                                        value="{{ old(
                                            'nomor',
                                            $pertanyaan->count() + 1
                                        ) }}"
                                        required
                                    >
                                </div>

                                <div class="mb-3">
                                    <label for="aspek" class="form-label">
                                        Aspek
                                    </label>

                                    <input
                                        type="text"
                                        name="aspek"
                                        id="aspek"
                                        class="form-control"
                                        maxlength="100"
                                        value="{{ old('aspek') }}"
                                        placeholder="Masukkan aspek sesuai instrumen"
                                        required
                                    >
                                </div>

                                <div class="mb-3">
                                    <label
                                        for="pertanyaan"
                                        class="form-label"
                                    >
                                        Butir Pertanyaan
                                    </label>

                                    <textarea
                                        name="pertanyaan"
                                        id="pertanyaan"
                                        class="form-control"
                                        maxlength="1000"
                                        placeholder="Masukkan redaksi pertanyaan yang telah diverifikasi..."
                                        required
                                    >{{ old('pertanyaan') }}</textarea>
                                </div>

                                <div class="form-check mb-3">
                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                        name="reverse_score"
                                        value="1"
                                        id="reverse_score"
                                        @checked(old('reverse_score'))
                                    >

                                    <label
                                        class="form-check-label"
                                        for="reverse_score"
                                    >
                                        Reverse scoring
                                    </label>
                                </div>

                                <button
                                    type="submit"
                                    class="btn-primary-ca w-100"
                                >
                                    <i class="bi bi-plus-lg"></i>
                                    Tambah Pertanyaan
                                </button>
                                </form>
                            @endif

                        </div>
                    </section>

                    <section class="panel">
                        <div class="panel-header d-flex align-items-center justify-content-between gap-3">
                            <div>
                                <div class="panel-title">
                                    Daftar Pertanyaan
                                </div>

                                <div class="panel-subtitle">
                                    Butir yang sudah dimasukkan ke paket
                                </div>
                            </div>

                            <span class="count-badge">
                                <i class="bi bi-list-ol"></i>
                                {{ $pertanyaan->count() }}
                            </span>
                        </div>

                        <div class="panel-body">

                            @forelse ($pertanyaan as $item)

                                <div class="question-item">

                                    <div class="question-number">
                                        {{ $item->nomor }}
                                    </div>

                                    <div>
                                        <div class="question-aspect">
                                            {{ $item->aspek }}
                                        </div>

                                        <div class="question-text">
                                            {{ $item->pertanyaan }}
                                        </div>

                                        @if ($item->reverse_score)
                                            <div class="reverse-note">
                                                <i class="bi bi-arrow-repeat"></i>
                                                Reverse scoring
                                            </div>
                                        @endif
                                    </div>

                                    @if (! $paketSkrining->is_active)
                                        <form
                                            method="POST"
                                            action="{{ route(
                                                'guru-bk.skrining.paket.pertanyaan.destroy',
                                                [
                                                    $paketSkrining->id,
                                                    $item->id
                                                ]
                                            ) }}"
                                            onsubmit="return confirm('Hapus pertanyaan ini?')"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="delete-btn"
                                                title="Hapus"
                                            >
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    @endif

                                </div>

                            @empty

                                <div class="empty">
                                    <i class="bi bi-list-check"></i>
                                    Belum ada pertanyaan pada paket ini.
                                </div>

                            @endforelse

                        </div>
                    </section>

                </div>

            </div>
        </div>
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


