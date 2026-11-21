<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jurnal Catatan Konseling - Guru BK - CurhatAman</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        :root {
            --ca-primary: #0f8a83;
            --ca-primary-dark: #0b6f69;
            --ca-primary-soft: #eaf6f4;
            --ca-text: #172033;
            --ca-muted: #667085;
            --ca-muted-light: #98a2b3;
            --ca-bg: #f6f8f9;
            --ca-surface: #ffffff;
            --ca-border: #e3e9e9;
            --ca-line: #edf1f1;
            --sidebar-width: 252px;
            --topbar-height: 72px;
        }

        * {
            box-sizing: border-box;
        }

        html, body {
            min-height: 100%;
        }

        body {
            min-height: 100vh;
            margin: 0;
            color: var(--ca-text);
            background: var(--ca-bg);
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            font-size: 14px;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        .app-shell {
            min-height: 100vh;
            display: grid;
            grid-template-columns: var(--sidebar-width) minmax(0, 1fr);
            grid-template-rows: var(--topbar-height) minmax(0, 1fr);
        }

        .sidebar {
            grid-row: 1 / 3;
            min-height: 100vh;
            padding: 18px 14px;
            display: flex;
            flex-direction: column;
            background: #ffffff;
            border-right: 1px solid var(--ca-border);
        }

        .main-content {
            grid-column: 2;
            padding: 24px 28px 40px;
        }

        .content-shell {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Page Header Gradasi Hijau CurhatAman */
        .page-header {
            margin-bottom: 22px;
            padding: 22px 26px;
            border-radius: 14px;
            background: linear-gradient(135deg, var(--ca-primary) 0%, #0d7973 100%) !important;
            box-shadow: 0 4px 14px rgba(15, 138, 131, 0.16);
            color: #ffffff;
            display: flex !important;
            align-items: center !important;
            justify-content: space-between !important;
            flex-wrap: wrap !important;
            gap: 16px !important;
        }

        .header-left-content {
            flex: 1 1 450px !important;
            min-width: 280px !important;
        }

        .header-actions-group {
            margin-left: auto !important;
            display: flex !important;
            align-items: center !important;
            justify-content: flex-end !important;
            gap: 8px !important;
            flex-wrap: wrap !important;
            flex-shrink: 0 !important;
        }

        .page-kicker {
            margin-bottom: 6px;
            color: rgba(255, 255, 255, .82);
            font-size: 11px;
            font-weight: 760;
            letter-spacing: .08em;
            text-transform: uppercase;
            display: flex;
            align-items: center;
        }

        .page-title {
            margin: 0 0 6px;
            color: #ffffff;
            font-size: 24px;
            line-height: 1.25;
            font-weight: 760;
            letter-spacing: -.02em;
        }

        .page-copy {
            max-width: 600px;
            margin: 0;
            color: rgba(255, 255, 255, .88);
            font-size: 12.5px;
            line-height: 1.55;
        }

        .header-action-btn {
            height: 36px;
            padding: 0 15px;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 12px;
            font-weight: 650;
            letter-spacing: .01em;
            text-decoration: none;
            white-space: nowrap;
            transition: all .15s ease;
        }

        .header-action-white {
            color: var(--ca-primary-dark) !important;
            background: #ffffff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.08);
        }

        .header-action-white:hover {
            background: #f0fdfa;
            transform: translateY(-1px);
        }

        .header-action-glass {
            color: #ffffff !important;
            background: rgba(255, 255, 255, 0.16);
            border: 1px solid rgba(255, 255, 255, 0.38);
        }

        .header-action-glass:hover {
            background: rgba(255, 255, 255, 0.26);
            transform: translateY(-1px);
        }

        /* Metric Grid Ringkas */
        .metrics-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            margin-bottom: 22px;
        }

        .metric-box {
            background: #ffffff;
            border: 1px solid var(--ca-border);
            border-radius: 12px;
            padding: 14px 16px;
            display: flex;
            align-items: center;
            gap: 14px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02);
            transition: transform .15s ease, box-shadow .15s ease;
        }

        .metric-box:hover {
            transform: translateY(-1px);
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.04);
        }

        .metric-icon-wrap {
            width: 42px;
            height: 42px;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 19px;
            flex-shrink: 0;
        }

        .metric-icon-wrap.teal { background: #eaf6f4; color: #0f8a83; }
        .metric-icon-wrap.blue { background: #eff6ff; color: #2563eb; }
        .metric-icon-wrap.green { background: #ecfdf5; color: #059669; }
        .metric-icon-wrap.purple { background: #f5f3ff; color: #7c3aed; }

        .metric-label-clean {
            font-size: 11px;
            font-weight: 650;
            color: var(--ca-muted);
            text-transform: uppercase;
            letter-spacing: .03em;
            margin-bottom: 2px;
        }

        .metric-value-clean {
            font-size: 19px;
            font-weight: 750;
            color: var(--ca-text);
            line-height: 1.2;
        }

        /* Panel Utama */
        .main-panel {
            background: #ffffff;
            border: 1px solid var(--ca-border);
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02);
            overflow: hidden;
        }

        .panel-nav-bar {
            padding: 14px 20px;
            border-bottom: 1px solid var(--ca-border);
            background: #fafbfb;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            flex-wrap: wrap;
        }

        /* Switcher Tabs */
        .tab-switcher {
            display: inline-flex;
            background: #edf2f2;
            padding: 4px;
            border-radius: 9px;
            gap: 4px;
        }

        .tab-switch-btn {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 6px 14px;
            border-radius: 7px;
            font-size: 12.5px;
            font-weight: 650;
            color: #475467;
            background: transparent;
            text-decoration: none;
            transition: all .15s ease;
        }

        .tab-switch-btn.active {
            background: #ffffff;
            color: var(--ca-primary-dark);
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06);
        }

        .tab-switch-btn:hover:not(.active) {
            color: var(--ca-text);
        }

        /* Filter Strip */
        .filter-bar-container {
            padding: 16px 20px;
            background: #ffffff;
            border-bottom: 1px solid var(--ca-line);
        }

        .filter-flex {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .search-input-wrap {
            position: relative;
            flex: 1 1 240px;
            min-width: 200px;
        }

        .search-input-wrap i {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--ca-muted);
            font-size: 13px;
        }

        .filter-input-text {
            width: 100%;
            height: 38px;
            padding: 0 12px 0 34px;
            border-radius: 8px;
            border: 1px solid var(--ca-border);
            font-size: 12.5px;
            color: var(--ca-text);
            background: #ffffff;
            transition: border-color .15s ease;
        }

        .filter-input-text:focus,
        .filter-select-box:focus {
            outline: none;
            border-color: var(--ca-primary);
            box-shadow: 0 0 0 3px rgba(15, 138, 131, .1);
        }

        .filter-select-box {
            height: 38px;
            padding: 0 12px;
            border-radius: 8px;
            border: 1px solid var(--ca-border);
            font-size: 12.5px;
            color: var(--ca-text);
            background: #ffffff;
            min-width: 130px;
        }

        .btn-filter-apply {
            height: 38px;
            padding: 0 16px;
            border-radius: 8px;
            background: var(--ca-primary);
            border: 1px solid var(--ca-primary);
            color: #ffffff;
            font-weight: 650;
            font-size: 12.5px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            cursor: pointer;
            transition: all .15s ease;
        }

        .btn-filter-apply:hover {
            background: var(--ca-primary-dark);
        }

        .btn-filter-reset {
            height: 38px;
            padding: 0 12px;
            border-radius: 8px;
            background: #ffffff;
            border: 1px solid var(--ca-border);
            color: #64748b;
            font-weight: 600;
            font-size: 12px;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            text-decoration: none;
            transition: all .15s ease;
        }

        .btn-filter-reset:hover {
            background: #f8fafc;
            color: #1e293b;
        }

        /* Tabel */
        .table-custom {
            width: 100%;
            margin: 0;
            border-collapse: separate;
            border-spacing: 0;
            font-size: 13px;
        }

        .table-custom th {
            background: #f8fafc;
            padding: 12px 16px;
            font-size: 11px;
            font-weight: 720;
            color: #475467;
            text-transform: uppercase;
            letter-spacing: .04em;
            border-bottom: 1px solid var(--ca-border);
            white-space: nowrap;
        }

        .table-custom td {
            padding: 13px 16px;
            border-bottom: 1px solid var(--ca-line);
            vertical-align: middle;
            color: #334155;
        }

        .table-custom tr:hover td {
            background: #fbfdfd;
        }

        /* Avatar Siswa Kecil */
        .avatar-initial-sm {
            width: 34px;
            height: 34px;
            border-radius: 8px;
            background: var(--ca-primary-soft);
            color: var(--ca-primary-dark);
            font-weight: 750;
            font-size: 13px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        /* Action Buttons */
        .action-icon-group {
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .btn-action-icon {
            width: 32px;
            height: 32px;
            border-radius: 7px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 1px solid var(--ca-border);
            background: #ffffff;
            color: #475467;
            font-size: 13px;
            transition: all .15s ease;
        }

        .btn-action-icon:hover {
            color: var(--ca-primary-dark);
            border-color: var(--ca-primary);
            background: var(--ca-primary-soft);
        }

        .btn-action-icon.danger:hover {
            color: #b42318;
            border-color: #fecdca;
            background: #fff1f0;
        }

        .badge-nature-secret {
            background: #fef2f2;
            color: #b91c1c;
            border: 1px solid #fecaca;
            font-size: 10.5px;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 6px;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .badge-nature-open {
            background: #ecfdf5;
            color: #047857;
            border: 1px solid #a7f3d0;
            font-size: 10.5px;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 6px;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        @media (max-width: 991px) {
            .app-shell {
                grid-template-columns: 1fr;
            }

            .metrics-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 576px) {
            .metrics-grid {
                grid-template-columns: 1fr;
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

        @include('guru-bk.partials.topbar', [
            'topbarTitle' => 'Buku Jurnal Konseling',
            'topbarSubtitle' => 'Riwayat dan dokumentasi sesi bimbingan konseling siswa'
        ])

        <main class="main-content">
            <div class="content-shell">
                <!-- Header Halaman Gradasi Hijau CurhatAman -->
                <header class="page-header">
                    <div class="header-left-content">
                        <div class="page-kicker">
                            <i class="bi bi-journal-medical me-1"></i> Bimbingan & Konseling
                        </div>
                        <h1 class="page-title">Buku Jurnal & Catatan Konseling</h1>
                        <p class="page-copy">
                            Dokumentasi resmi pelaksanaan sesi bimbingan, observasi, dan rekam jejak pendampingan siswa.
                        </p>
                    </div>

                    <div class="header-actions-group">
                        <a href="{{ route('guru-bk.catatan-konseling.rekap-excel', request()->all()) }}" class="header-action-btn header-action-glass" title="Unduh rekap data dalam format Excel">
                            <i class="bi bi-file-earmark-spreadsheet"></i>
                            <span>Export Excel</span>
                        </a>

                        <a href="{{ route('guru-bk.catatan-konseling.rekap-pdf', request()->all()) }}" class="header-action-btn header-action-glass" title="Cetak format Rekapitulasi Catatan Konseling resmi">
                            <i class="bi bi-printer"></i>
                            <span>Cetak Rekap PDF</span>
                        </a>

                        <a href="{{ route('guru-bk.catatan-konseling.create', request()->only(['siswa_id'])) }}" class="header-action-btn header-action-white" title="Buat catatan sesi konseling baru">
                            <i class="bi bi-plus-circle-fill"></i>
                            <span>Catat Sesi Baru</span>
                        </a>
                    </div>
                </header>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2 mb-4" role="alert" style="border-radius: 10px;">
                        <i class="bi bi-check-circle-fill text-success fs-5"></i>
                        <div>{{ session('success') }}</div>
                        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if($filterSiswa)
                    <div class="alert alert-info d-flex align-items-center justify-content-between mb-4" style="border-radius: 10px; background: #eef6fb; border-color: #b9e6fe;">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-person-fill-check text-primary fs-5"></i>
                            <div>
                                Menampilkan riwayat catatan bimbingan konseling untuk <strong>{{ ucwords(strtolower($filterSiswa->nama_siswa)) }}</strong> (NIS: {{ $filterSiswa->nis ?? '-' }}).
                            </div>
                        </div>
                        <a href="{{ route('guru-bk.catatan-konseling.index') }}" class="btn btn-sm btn-outline-primary" style="font-size: 12px; font-weight: 600; border-radius: 7px;">
                            Tampilkan Semua Siswa
                        </a>
                    </div>
                @endif

                <!-- Ringkasan Metrik Ringkas & Proporsional -->
                <div class="metrics-grid">
                    <div class="metric-box">
                        <div class="metric-icon-wrap teal">
                            <i class="bi bi-journal-check"></i>
                        </div>
                        <div>
                            <div class="metric-label-clean">Total Sesi</div>
                            <div class="metric-value-clean">{{ number_format($totalSesi) }}</div>
                        </div>
                    </div>

                    <div class="metric-box">
                        <div class="metric-icon-wrap blue">
                            <i class="bi bi-calendar-event"></i>
                        </div>
                        <div>
                            <div class="metric-label-clean">Sesi Bulan Ini</div>
                            <div class="metric-value-clean">{{ number_format($sesiBulanIni) }}</div>
                        </div>
                    </div>

                    <div class="metric-box">
                        <div class="metric-icon-wrap green">
                            <i class="bi bi-people"></i>
                        </div>
                        <div>
                            <div class="metric-label-clean">Siswa Didampingi</div>
                            <div class="metric-value-clean">{{ number_format($siswaDidampingi) }}</div>
                        </div>
                    </div>

                    <div class="metric-box">
                        <div class="metric-icon-wrap purple">
                            <i class="bi bi-award"></i>
                        </div>
                        <div>
                            <div class="metric-label-clean">Layanan Terbanyak</div>
                            <div class="metric-value-clean" style="font-size: 14.5px;" title="{{ $layananPopuler }}">
                                {{ Str::limit($layananPopuler, 18) }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Panel Utama & Tabel Data -->
                <div class="main-panel">
                    <!-- Nav Bar Switcher & Informasi -->
                    <div class="panel-nav-bar">
                        <div class="tab-switcher">
                            <a href="{{ route('guru-bk.catatan-konseling.index', array_merge(request()->except(['page']), ['view' => 'sesi'])) }}" 
                               class="tab-switch-btn {{ $viewMode === 'sesi' ? 'active' : '' }}">
                                <i class="bi bi-clock-history"></i>
                                Log Semua Sesi
                            </a>
                            <a href="{{ route('guru-bk.catatan-konseling.index', array_merge(request()->except(['page']), ['view' => 'siswa'])) }}" 
                               class="tab-switch-btn {{ $viewMode === 'siswa' ? 'active' : '' }}">
                                <i class="bi bi-person-lines-fill"></i>
                                Rekap Per Siswa
                            </a>
                        </div>

                        <div class="text-muted" style="font-size: 12px;">
                            @if($viewMode === 'siswa')
                                Menampilkan daftar rekap sesi dikelompokkan per siswa.
                            @else
                                Menampilkan seluruh sesi konseling terurut dari yang terbaru.
                            @endif
                        </div>
                    </div>

                    <!-- Filter Strip Bersih & Sejajar -->
                    <div class="filter-bar-container">
                        <form method="GET" action="{{ route('guru-bk.catatan-konseling.index') }}">
                            <input type="hidden" name="view" value="{{ $viewMode }}">
                            @if($filters['siswa_id'])
                                <input type="hidden" name="siswa_id" value="{{ $filters['siswa_id'] }}">
                            @endif

                            <div class="filter-flex">
                                <div class="search-input-wrap">
                                    <i class="bi bi-search"></i>
                                    <input type="text" name="q" class="filter-input-text" 
                                           placeholder="{{ $viewMode === 'siswa' ? 'Cari nama siswa atau NIS...' : 'Cari nama siswa, NIS, atau topik...' }}" 
                                           value="{{ $filters['q'] }}">
                                </div>

                                @if($viewMode === 'sesi')
                                    <div>
                                        <select name="jenis_layanan" class="filter-select-box">
                                            <option value="">Semua Layanan</option>
                                            @foreach($jenisLayananList as $layanan)
                                                <option value="{{ $layanan }}" @selected($filters['jenis_layanan'] === $layanan)>{{ $layanan }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif

                                <div>
                                    <select name="kelas_id" class="filter-select-box">
                                        <option value="">Semua Kelas</option>
                                        @foreach($kelasList as $kelas)
                                            <option value="{{ $kelas->id }}" @selected($filters['kelas_id'] == $kelas->id)>{{ $kelas->nama_kelas }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                @if($viewMode === 'sesi')
                                    <div class="d-flex align-items-center gap-1">
                                        <input type="date" name="tanggal_dari" class="filter-select-box" style="width: 135px;" value="{{ $filters['tanggal_dari'] }}" title="Tanggal Mulai">
                                        <span class="text-muted" style="font-size: 12px;">-</span>
                                        <input type="date" name="tanggal_sampai" class="filter-select-box" style="width: 135px;" value="{{ $filters['tanggal_sampai'] }}" title="Tanggal Selesai">
                                    </div>
                                @endif

                                <div class="d-flex align-items-center gap-2">
                                    <button type="submit" class="btn-filter-apply">
                                        <i class="bi bi-funnel"></i> Filter
                                    </button>

                                    @if($filters['q'] || $filters['jenis_layanan'] || $filters['kelas_id'] || $filters['tanggal_dari'] || $filters['tanggal_sampai'])
                                        <a href="{{ route('guru-bk.catatan-konseling.index', ['view' => $viewMode]) }}" class="btn-filter-reset" title="Reset semua filter">
                                            <i class="bi bi-x-circle"></i> Reset
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>

                    @if($viewMode === 'siswa')
                        <!-- Mode: Rekap Per Siswa -->
                        @if($siswaGrouped && $siswaGrouped->count() > 0)
                            <div class="table-responsive">
                                <table class="table-custom">
                                    <thead>
                                        <tr>
                                            <th>Identitas Siswa</th>
                                            <th>Kelas</th>
                                            <th>Total Sesi</th>
                                            <th>Pertemuan Terakhir</th>
                                            <th style="text-align: right;">Aksi Cepat</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($siswaGrouped as $s)
                                            @php
                                                $namaSiswaFormat = ucwords(strtolower($s->nama_siswa));
                                                $inisialS = strtoupper(substr($s->nama_siswa ?? 'S', 0, 1));
                                            @endphp
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <span class="avatar-initial-sm">{{ $inisialS }}</span>
                                                        <div>
                                                            <div style="font-weight: 700; color: #0f172a;">
                                                                {{ $namaSiswaFormat }}
                                                            </div>
                                                            <div style="font-size: 11.5px; color: var(--ca-muted);">
                                                                NIS: {{ $s->nis ?? '-' }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge" style="background: var(--ca-primary-soft); color: var(--ca-primary-dark); font-weight: 650; font-size: 11.5px;">
                                                        {{ $s->nama_kelas ?? 'Tanpa Kelas' }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="badge bg-light text-dark border px-2 py-1 fw-bold" style="font-size: 11.5px;">
                                                        <i class="bi bi-journal-check text-primary me-1"></i> {{ $s->total_sesi }} Sesi
                                                    </span>
                                                </td>
                                                <td>
                                                    <div style="font-weight: 600; color: #1e293b; font-size: 12.5px;">
                                                        {{ \Carbon\Carbon::parse($s->sesi_terakhir)->locale('id')->translatedFormat('d M Y') }}
                                                    </div>
                                                    <div style="font-size: 11px; color: var(--ca-muted);">
                                                        {{ \Carbon\Carbon::parse($s->sesi_terakhir)->locale('id')->diffForHumans() }}
                                                    </div>
                                                </td>
                                                <td style="text-align: right;">
                                                    <div class="d-inline-flex gap-2">
                                                        <a href="{{ route('guru-bk.catatan-konseling.index', ['siswa_id' => $s->id, 'view' => 'sesi']) }}" 
                                                           class="btn btn-sm btn-outline-secondary d-inline-flex align-items-center gap-1" 
                                                           style="font-size: 11.5px; font-weight: 600; border-radius: 7px; border-color: var(--ca-border);">
                                                            <i class="bi bi-journals text-primary"></i> Buka Buku Sesi ({{ $s->total_sesi }})
                                                        </a>
                                                        <a href="{{ route('guru-bk.catatan-konseling.create', ['siswa_id' => $s->id]) }}" 
                                                           class="btn btn-sm btn-primary d-inline-flex align-items-center gap-1 text-white" 
                                                           style="background: var(--ca-primary); border-color: var(--ca-primary); font-size: 11.5px; font-weight: 600; border-radius: 7px;">
                                                            <i class="bi bi-plus-circle"></i> Catat Sesi
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="p-3 border-top">
                                {{ $siswaGrouped->links() }}
                            </div>
                        @else
                            <div class="text-center py-5">
                                <div class="text-muted mb-2" style="font-size: 32px;"><i class="bi bi-people"></i></div>
                                <h6 class="fw-bold mb-1">Tidak Ditemukan Siswa</h6>
                                <p class="text-muted small mb-0">Belum ada data siswa yang memiliki sesi konseling sesuai filter yang dipilih.</p>
                            </div>
                        @endif
                    @else
                        <!-- Mode: Log Semua Sesi -->
                        @if($catatanList->count() > 0)
                            <div class="table-responsive">
                                <table class="table-custom">
                                    <thead>
                                        <tr>
                                            <th>Tanggal & Sifat</th>
                                            <th>Siswa</th>
                                            <th>Layanan BK</th>
                                            <th>Topik Pembahasan</th>
                                            <th>Konselor</th>
                                            <th style="text-align: right;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($catatanList as $item)
                                            @php
                                                $namaSiswaItem = ucwords(strtolower($item->nama_siswa));
                                                $inisialItem = strtoupper(substr($item->nama_siswa ?? 'S', 0, 1));
                                                $namaKonselor = ucwords(strtolower($item->nama_guru_bk));
                                            @endphp
                                            <tr>
                                                <td style="white-space: nowrap;">
                                                    <div style="font-weight: 650; color: #0f172a;">
                                                        {{ \Carbon\Carbon::parse($item->tanggal_pertemuan)->locale('id')->translatedFormat('d M Y') }}
                                                    </div>
                                                    <div class="mt-1">
                                                        @if($item->is_rahasia)
                                                            <span class="badge-nature-secret" title="Catatan bersifat tertutup internal Guru BK">
                                                                <i class="bi bi-lock-fill"></i> Rahasia
                                                            </span>
                                                        @else
                                                            <span class="badge-nature-open" title="Catatan terbuka dikoordinasikan dengan Wali Kelas">
                                                                <i class="bi bi-people-fill"></i> Terkoordinasi
                                                            </span>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <span class="avatar-initial-sm">{{ $inisialItem }}</span>
                                                        <div>
                                                            <div style="font-weight: 700; color: #0f172a;">
                                                                {{ $namaSiswaItem }}
                                                            </div>
                                                            <div style="font-size: 11.5px; color: var(--ca-muted);">
                                                                NIS: {{ $item->nis ?? '-' }} &bull; {{ $item->nama_kelas ?? 'Tanpa Kelas' }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge bg-light text-dark border px-2 py-1" style="font-size: 11.5px; font-weight: 600;">
                                                        {{ $item->jenis_layanan }}
                                                    </span>
                                                    @if($item->kode_laporan)
                                                        <div style="font-size: 11px; margin-top: 3px;">
                                                            <a href="{{ route('guru-bk.laporan.show', $item->laporan_id) }}" class="text-primary text-decoration-none fw-semibold">
                                                                <i class="bi bi-link-45deg"></i> #{{ $item->kode_laporan }}
                                                            </a>
                                                        </div>
                                                    @endif
                                                </td>
                                                <td style="max-width: 340px;">
                                                    <div style="font-weight: 700; color: #0f172a; margin-bottom: 2px;">
                                                        <a href="{{ route('guru-bk.catatan-konseling.show', $item->id) }}" class="text-dark text-decoration-none">
                                                            {{ $item->topik }}
                                                        </a>
                                                    </div>
                                                    <div style="font-size: 12px; color: var(--ca-muted); line-height: 1.4; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                                        {{ Str::limit(strip_tags($item->isi_catatan), 110) }}
                                                    </div>
                                                </td>
                                                <td style="white-space: nowrap;">
                                                    <div style="font-weight: 600; color: #334155; font-size: 12.5px;">
                                                        {{ $namaKonselor }}
                                                    </div>
                                                </td>
                                                <td style="text-align: right; white-space: nowrap;">
                                                    <div class="action-icon-group">
                                                        <a href="{{ route('guru-bk.catatan-konseling.show', $item->id) }}" class="btn-action-icon" title="Lihat Rincian Sesi">
                                                            <i class="bi bi-eye"></i>
                                                        </a>
                                                        <a href="{{ route('guru-bk.catatan-konseling.pdf', $item->id) }}" class="btn-action-icon" target="_blank" title="Cetak PDF Sesi Ini">
                                                            <i class="bi bi-printer"></i>
                                                        </a>
                                                        @if ((int) $item->guru_bk_id === (int) auth()->id())
                                                            <a href="{{ route('guru-bk.catatan-konseling.edit', $item->id) }}" class="btn-action-icon" title="Ubah Catatan">
                                                                <i class="bi bi-pencil"></i>
                                                            </a>
                                                            <button type="button" class="btn-action-icon danger" title="Hapus Catatan" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $item->id }}">
                                                                <i class="bi bi-trash"></i>
                                                            </button>
                                                        @endif
                                                    </div>

                                                    <!-- Delete Modal -->
                                                    <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1" aria-hidden="true" style="text-align: left;">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content" style="border-radius: 12px; border: 1px solid var(--ca-border);">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title fw-bold" style="font-size: 15px;">Konfirmasi Hapus Catatan</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body" style="font-size: 13px; color: #475467;">
                                                                    Apakah Anda yakin ingin menghapus catatan konseling siswa <strong>{{ $namaSiswaItem }}</strong> dengan topik <strong>"{{ $item->topik }}"</strong>? Tindakan ini tidak dapat dibatalkan.
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-sm btn-light" data-bs-dismiss="modal">Batal</button>
                                                                    <form method="POST" action="{{ route('guru-bk.catatan-konseling.destroy', $item->id) }}" class="m-0">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="btn btn-sm btn-danger">Hapus Permanen</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="p-3 border-top">
                                {{ $catatanList->links() }}
                            </div>
                        @else
                            <div class="text-center py-5">
                                <div class="text-muted mb-2" style="font-size: 32px;"><i class="bi bi-journal-plus"></i></div>
                                <h6 class="fw-bold mb-1">Belum Ada Catatan Konseling</h6>
                                <p class="text-muted small mb-3">Belum ada riwayat catatan sesi bimbingan yang sesuai dengan filter pencarian Anda.</p>
                                <a href="{{ route('guru-bk.catatan-konseling.create') }}" class="btn btn-sm btn-primary text-white" style="background: var(--ca-primary); border-color: var(--ca-primary); border-radius: 8px; font-weight: 600;">
                                    <i class="bi bi-plus-circle me-1"></i> Buat Catatan Pertama
                                </a>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
