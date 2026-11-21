<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tindak Lanjut Skrining - CurhatAman</title>

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
        }

        *{box-sizing:border-box}

        body{
            margin:0;
            min-height:100vh;
            color:var(--ca-text);
            background:var(--ca-bg);
            font-family:system-ui,-apple-system,"Segoe UI",Roboto,Arial,sans-serif;
        }

        a{text-decoration:none}

        .page{
            max-width:1050px;
            margin:0 auto;
            padding:30px 22px 50px;
        }

        .back-link{
            display:inline-flex;
            align-items:center;
            gap:6px;
            margin-bottom:18px;
            color:var(--ca-muted);
            font-size:.78rem;
            font-weight:600;
        }

        .page-kicker{
            margin-bottom:6px;
            color:var(--ca-primary);
            font-size:.74rem;
            font-weight:750;
            letter-spacing:.07em;
            text-transform:uppercase;
        }

        .page-title{
            margin:0 0 7px;
            font-size:1.7rem;
            font-weight:760;
        }

        .page-copy{
            margin:0;
            color:var(--ca-muted);
            font-size:.85rem;
            line-height:1.6;
        }

        .student-card,
        .result-card,
        .follow-card{
            margin-top:20px;
            padding:20px;
            border:1px solid var(--ca-border);
            border-radius:12px;
            background:#fff;
        }

        .student-card{
            display:flex;
            align-items:flex-start;
            justify-content:space-between;
            gap:18px;
        }

        .student-name{
            font-size:1rem;
            font-weight:720;
        }

        .student-meta{
            margin-top:5px;
            color:var(--ca-muted);
            font-size:.78rem;
        }

        .result-badge{
            display:inline-flex;
            align-items:center;
            justify-content:center;
            padding:6px 10px;
            border-radius:999px;
            font-size:.74rem;
            font-weight:700;
        }

        .result-normal{
            color:#027a48;
            background:#ecfdf3;
        }

        .result-ambang{
            color:#b54708;
            background:#fffaeb;
        }

        .result-abnormal{
            color:#b42318;
            background:#fef3f2;
        }

        .result-grid{
            display:grid;
            grid-template-columns:repeat(6,minmax(0,1fr));
            gap:12px;
            margin-top:16px;
        }

        .score-box{
            padding:15px;
            border:1px solid var(--ca-border);
            border-radius:10px;
            background:#fbfcfc;
        }

        .score-label{
            color:var(--ca-muted);
            font-size:.7rem;
            font-weight:650;
        }

        .score-value{
            margin-top:5px;
            font-size:1.3rem;
            font-weight:760;
        }

        .follow-title{
            margin-bottom:10px;
            font-size:.95rem;
            font-weight:720;
        }

        .follow-copy{
            color:#475467;
            font-size:.82rem;
            line-height:1.7;
        }

        .follow-list{
            margin:14px 0 0;
            padding-left:20px;
            color:#475467;
            font-size:.82rem;
            line-height:1.75;
        }

        .notice{
            margin-top:18px;
            padding:13px 15px;
            border:1px solid #cfe4e1;
            border-radius:10px;
            color:#55706d;
            background:#f3f9f8;
            font-size:.76rem;
            line-height:1.6;
        }

        .actions{
            display:flex;
            align-items:center;
            gap:10px;
            flex-wrap:wrap;
            margin-top:18px;
        }

        .btn-primary-ca,
        .btn-light-ca{
            display:inline-flex;
            align-items:center;
            justify-content:center;
            gap:7px;
            min-height:39px;
            padding:8px 13px;
            border-radius:9px;
            font-size:.76rem;
            font-weight:650;
        }

        .btn-primary-ca{
            border:1px solid var(--ca-primary);
            color:#fff;
            background:var(--ca-primary);
        }

        .btn-primary-ca:hover{
            color:#fff;
            background:var(--ca-primary-dark);
        }

        .btn-light-ca{
            border:1px solid var(--ca-border);
            color:#475467;
            background:#fff;
        }

        .btn-light-ca:hover{
            color:var(--ca-primary-dark);
            background:var(--ca-primary-soft);
        }

        @media(max-width:800px){
            .result-grid{grid-template-columns:repeat(2,minmax(0,1fr))}
            .student-card{flex-direction:column}
        }

        .contact-card{
            margin-top:20px;
            padding:20px;
            border:1px solid var(--ca-border);
            border-radius:12px;
            background:#fff;
        }

        .contact-heading{
            display:flex;
            align-items:flex-start;
            gap:11px;
        }

        .contact-icon{
            width:38px;
            height:38px;
            display:inline-flex;
            align-items:center;
            justify-content:center;
            flex-shrink:0;
            border-radius:10px;
            color:var(--ca-primary-dark);
            background:var(--ca-primary-soft);
            font-size:1rem;
        }

        .contact-title{
            margin:0;
            font-size:.9rem;
            font-weight:720;
        }

        .contact-copy{
            margin:4px 0 0;
            color:var(--ca-muted);
            font-size:.76rem;
            line-height:1.55;
        }

        .contact-info{
            margin-top:14px;
            padding:13px 14px;
            border:1px solid var(--ca-border);
            border-radius:10px;
            display:flex;
            align-items:center;
            justify-content:space-between;
            gap:14px;
            background:#fbfcfc;
        }

        .contact-label{
            color:var(--ca-muted);
            font-size:.68rem;
            font-weight:650;
            text-transform:uppercase;
            letter-spacing:.04em;
        }

        .contact-number{
            margin-top:3px;
            font-size:.84rem;
            font-weight:680;
        }

        .contact-status{
            margin-top:4px;
            display:inline-flex;
            align-items:center;
            gap:5px;
            color:#667085;
            font-size:.7rem;
        }

        .contact-status.allowed{
            color:#087443;
        }

        .btn-whatsapp{
            min-height:39px;
            padding:8px 13px;
            border:1px solid #b9dfcb;
            border-radius:9px;
            display:inline-flex;
            align-items:center;
            justify-content:center;
            gap:7px;
            color:#0f6541;
            background:#f4fbf7;
            font-size:.75rem;
            font-weight:680;
            white-space:nowrap;
        }

        .btn-whatsapp:hover,
        .btn-whatsapp:focus{
            color:#0b5b3a;
            border-color:#86c8a5;
            background:#eaf7ef;
        }

        .contact-disabled{
            max-width:310px;
            color:var(--ca-muted);
            font-size:.72rem;
            line-height:1.5;
            text-align:right;
        }

        @media(max-width:650px){
            .contact-info{
                align-items:flex-start;
                flex-direction:column;
            }

            .contact-disabled{
                max-width:none;
                text-align:left;
            }

            .btn-whatsapp{
                width:100%;
            }
        }

    </style>
    @include('guru-bk.partials.styles')
</head>

<body>
@php
    $kelasInterpretasi = match ($hasil['interpretasi']) {
        'Normal' => 'result-normal',
        'Ambang' => 'result-ambang',
        'Abnormal' => 'result-abnormal',
        default => '',
    };
@endphp

<div class="app-shell">
    @include('guru-bk.partials.sidebar')

    @include('guru-bk.partials.topbar', [
        'topbarTitle' => 'Tindak Lanjut Skrining',
        'topbarSubtitle' => 'Detail evaluasi dan tindak lanjut hasil skrining SDQ siswa'
    ])

    <main class="main-content">
        <div class="page-body" style="padding: 28px;">
            <div class="content-shell" style="max-width: 1040px; margin: 0 auto;">
    <a
        href="{{ route('guru-bk.skrining.index') }}"
        class="back-link"
    >
        <i class="bi bi-arrow-left"></i>
        Kembali ke Skrining Siswa
    </a>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3 mb-3 d-flex align-items-center" role="alert">
            <i class="bi bi-check-circle-fill me-2 fs-5"></i>
            <div>{{ session('success') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show mt-3 mb-3 d-flex align-items-center" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2 fs-5"></i>
            <div>{{ session('error') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="page-kicker">Tindak Lanjut Skrining</div>

    <h1 class="page-title">Hasil Skrining SDQ</h1>

    <p class="page-copy">
        Hasil skrining merupakan asesmen awal, bukan diagnosis.
    </p>

    <section class="student-card">
        <div>
            <div class="student-name">
                {{ $sesi->nama_siswa }}
            </div>

            <div class="student-meta">
                {{ $sesi->nis ? 'NIS ' . $sesi->nis : 'NIS belum tersedia' }}
                Â· {{ $sesi->nama_kelas ?? 'Kelas belum tersedia' }}
                @if ($sesi->tahun_ajaran)
                    Â· {{ $sesi->tahun_ajaran }}
                @endif
            </div>

            <div class="student-meta">
                Selesai:
                {{ $sesi->completed_at
                    ? \Carbon\Carbon::parse($sesi->completed_at)->format('d M Y, H:i')
                    : '-' }}
            </div>
        </div>

        <span class="result-badge {{ $kelasInterpretasi }}">
            {{ $hasil['interpretasi'] }}
        </span>
    </section>

    <section class="student-card mt-4">
        <div class="d-flex justify-content-between align-items-center w-100">
            <div>
                <div class="student-meta mb-1">Status Penanganan</div>
                @if ($sesi->assigned_bk_id)
                    <div class="student-name text-primary-ca">
                        <i class="bi bi-person-check-fill me-1"></i> Ditangani oleh: {{ $sesi->nama_bk }}
                    </div>
                @else
                    <div class="student-name" style="color: #64748b;">
                        <i class="bi bi-info-circle me-1"></i> Belum ditangani
                    </div>
                @endif
            </div>
            
            @if (!$sesi->assigned_bk_id)
                <form action="{{ route('guru-bk.skrining.take', $sesi->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-primary-ca" style="padding: 0.5rem 1rem; font-size: 0.9rem;">
                        Ambil Penanganan
                    </button>
                </form>
            @endif
        </div>
    </section>

    @php
        $nomorWhatsapp = $sesi->whatsapp_number ?? null;

        $nomorWhatsappDisplay = $nomorWhatsapp
            ? (
                str_starts_with($nomorWhatsapp, '62')
                    ? '0' . substr($nomorWhatsapp, 2)
                    : $nomorWhatsapp
            )
            : null;

        $pesanWhatsapp = rawurlencode(
            "Halo {$sesi->nama_siswa}, ada pemberitahuan dari layanan Bimbingan & Konseling CurhatAman. Silakan cek akun CurhatAman kamu melalui tautan berikut:\n" . url('/') . "\n\natau hubungi Guru BK sekolah untuk informasi selengkapnya."
        );

        $whatsappUrl = $nomorWhatsapp
            ? 'https://wa.me/' . $nomorWhatsapp . '?text=' . $pesanWhatsapp
            : null;
    @endphp

    <section class="contact-card">
        <div class="contact-heading">
            <span class="contact-icon">
                <i class="bi bi-whatsapp"></i>
            </span>

            <div>
                <h2 class="contact-title">
                    Kontak Siswa
                </h2>

                <p class="contact-copy">
                    WhatsApp digunakan untuk koordinasi tindak lanjut.
                </p>
            </div>
        </div>

        <div class="contact-info">
            <div>
                <div class="contact-label">
                    Nomor WhatsApp
                </div>

                <div class="contact-number">
                    {{ $nomorWhatsappDisplay ?: 'Belum tersedia' }}
                </div>

                @if ($sesi->whatsapp_consent)
                    <div class="contact-status allowed">
                        <i class="bi bi-check-circle"></i>
                        Siswa mengizinkan pemberitahuan WhatsApp
                    </div>
                @else
                    <div class="contact-status">
                        <i class="bi bi-info-circle"></i>
                        Siswa belum mengizinkan pemberitahuan WhatsApp
                    </div>
                @endif
            </div>

            @if ($nomorWhatsapp)
                <a
                    href="{{ $whatsappUrl }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="btn-whatsapp"
                >
                    <i class="bi bi-whatsapp"></i>
                    Hubungi via WhatsApp
                </a>
            @else
                <div class="contact-disabled">
                    Nomor WhatsApp siswa belum tersedia.
                </div>
            @endif
        </div>
    </section>

    <section class="result-card">
        <div class="follow-title">Ringkasan Skor</div>

        <div class="result-grid">
            <div class="score-box">
                <div class="score-label">E</div>
                <div class="score-value">{{ $hasil['E'] }}</div>
            </div>

            <div class="score-box">
                <div class="score-label">C</div>
                <div class="score-value">{{ $hasil['C'] }}</div>
            </div>

            <div class="score-box">
                <div class="score-label">H</div>
                <div class="score-value">{{ $hasil['H'] }}</div>
            </div>

            <div class="score-box">
                <div class="score-label">P</div>
                <div class="score-value">{{ $hasil['P'] }}</div>
            </div>

            <div class="score-box">
                <div class="score-label">Pro</div>
                <div class="score-value">{{ $hasil['Pro'] }}</div>
            </div>

            <div class="score-box">
                <div class="score-label">Total Kesulitan</div>
                <div class="score-value">{{ $hasil['total_kesulitan'] }}</div>
            </div>
        </div>
    </section>

    <section class="follow-card">
        <div class="follow-title">Arah Tindak Lanjut Guru BK</div>

        @if ($hasil['interpretasi'] === 'Normal')
            <div class="follow-copy">
                Hasil berada pada kategori Normal. Guru BK dapat melanjutkan pemantauan rutin dan layanan BK umum tanpa penanganan khusus berdasarkan hasil skrining ini saja.
            </div>
        @elseif ($hasil['interpretasi'] === 'Ambang')
            <div class="follow-copy">
                Hasil berada pada kategori Ambang. Guru BK disarankan melakukan pemantauan lebih dekat dan asesmen awal melalui percakapan atau konseling individual.
            </div>

            <ul class="follow-list">
                <li>Tinjau aspek yang memiliki skor lebih tinggi.</li>
                <li>Lakukan percakapan awal dengan siswa.</li>
                <li>Pantau perkembangan dan pertimbangkan asesmen lanjutan.</li>
                <li>Rujuk jika setelah asesmen diperlukan bantuan di luar kapasitas sekolah.</li>
            </ul>
        @else
            <div class="follow-copy">
                Hasil berada pada kategori Abnormal. Siswa diprioritaskan untuk asesmen lanjutan oleh Guru BK melalui wawancara atau konseling individual.
            </div>

            <ul class="follow-list">
                <li>Tinjau aspek yang memiliki skor lebih tinggi.</li>
                <li>Lakukan asesmen atau konseling individual sesegera mungkin.</li>
                <li>Catat hasil pemantauan dan kebutuhan tindak lanjut.</li>
                <li>Gunakan layanan rujukan bila bantuan profesional di luar sekolah diperlukan.</li>
            </ul>
        @endif

        <div class="notice">
            Hasil SDQ merupakan skrining awal. Keputusan tindak lanjut tetap ditentukan Guru BK berdasarkan asesmen langsung dan konteks siswa.
        </div>

        @if (in_array($hasil['interpretasi'], ['Ambang', 'Abnormal'], true) && !$sesi->assigned_bk_id)
            <div class="alert alert-warning d-flex align-items-center mb-3 mt-3" style="font-size: 0.85rem; border-radius: 8px;">
                <i class="bi bi-info-circle-fill me-2 fs-5 text-warning"></i>
                <div>
                    <strong>Perhatian:</strong> Sesi skrining ini belum diambil penanganannya. Silakan klik tombol <strong>Ambil Penanganan</strong> di atas terlebih dahulu sebelum membuat rujukan eksternal.
                </div>
            </div>
        @endif

        <div class="actions">
            @if (in_array(
                $hasil['interpretasi'],
                ['Ambang', 'Abnormal'],
                true
            ))
                @if ($sesi->assigned_bk_id && (int) $sesi->assigned_bk_id === (int) auth()->id())
                    <a
                        href="{{ route('guru-bk.rujukan.create', [
                            'sumber_type' => 'skrining',
                            'sumber_id' => $sesi->id,
                            'siswa_id' => $sesi->siswa_id,
                        ]) }}"
                        class="btn-primary-ca"
                    >
                        <i class="bi bi-life-preserver"></i>
                        Buka Form Rujukan
                    </a>
                @elseif (!$sesi->assigned_bk_id)
                    <button
                        type="button"
                        class="btn-primary-ca"
                        style="background-color: #94a3b8; border-color: #94a3b8; cursor: not-allowed; opacity: 0.75;"
                        title="Ambil penanganan di atas terlebih dahulu untuk membuat rujukan"
                        disabled
                    >
                        <i class="bi bi-lock-fill"></i>
                        Buka Form Rujukan (Ambil Penanganan Dahulu)
                    </button>
                @else
                    <button
                        type="button"
                        class="btn-light-ca"
                        style="cursor: not-allowed; opacity: 0.8;"
                        title="Sedang ditangani oleh {{ $sesi->nama_bk }}"
                        disabled
                    >
                        <i class="bi bi-person-check"></i>
                        Ditangani oleh {{ $sesi->nama_bk }}
                    </button>
                @endif
            @endif

            <a
                href="{{ route('guru-bk.skrining.index') }}"
                class="btn-light-ca"
            >
                <i class="bi bi-arrow-left"></i>
                Kembali
            </a>

                        <a
                href="{{ route('guru-bk.skrining.pdf.detail', $sesi->id) }}"
                class="btn-primary-ca ms-auto"
                style="background-color: #dc3545; color: white; border-color: #dc3545; display: inline-flex; align-items: center; justify-content: center; gap: 8px;"
            >
                <i class="bi bi-file-pdf"></i>
                Cetak PDF
            </a>
        </div>
        </section>
            </div>
        </div>
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>





