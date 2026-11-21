<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Catatan Konseling - Guru BK - CurhatAman</title>
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

        .sidebar-brand {
            min-height: 50px;
            margin-bottom: 28px;
            padding: 0 8px;
            display: flex;
            align-items: center;
            gap: 11px;
        }

        .brand-symbol {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            background: linear-gradient(135deg, var(--ca-primary), var(--ca-primary-dark));
            font-size: 18px;
            box-shadow: 0 8px 18px rgba(15, 138, 131, .25);
        }

        .brand-copy {
            display: flex;
            flex-direction: column;
            line-height: 1.15;
        }

        .brand-name {
            font-size: 16px;
            font-weight: 700;
            letter-spacing: -.02em;
            color: var(--ca-text);
        }

        .brand-role {
            margin-top: 3px;
            font-size: 11px;
            font-weight: 500;
            color: var(--ca-muted);
        }

        .sidebar-section-label {
            margin: 0 10px 8px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: .08em;
            text-transform: uppercase;
            color: #8a94a6;
        }

        .sidebar-nav {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .sidebar-link {
            min-height: 42px;
            padding: 0 12px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            gap: 12px;
            color: #475467;
            font-size: 13.5px;
            font-weight: 500;
            transition: all .15s ease;
        }

        .sidebar-link i {
            font-size: 16px;
            color: #667085;
            transition: color .15s ease;
        }

        .sidebar-link:hover {
            color: var(--ca-primary-dark);
            background: var(--ca-primary-soft);
        }

        .sidebar-link:hover i {
            color: var(--ca-primary-dark);
        }

        .sidebar-link.active {
            color: var(--ca-primary-dark);
            background: var(--ca-primary-soft);
            font-weight: 600;
        }

        .sidebar-link.active i {
            color: var(--ca-primary-dark);
        }

        .sidebar-spacer {
            flex: 1;
        }

        .sidebar-account {
            padding-top: 14px;
            border-top: 1px solid var(--ca-border);
        }

        .logout-button {
            width: 100%;
            min-height: 40px;
            padding: 0 12px;
            border: 1px solid transparent;
            border-radius: 8px;
            display: flex;
            align-items: center;
            gap: 10px;
            color: #b42318;
            background: transparent;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            transition: background .15s ease;
        }

        .logout-button:hover {
            background: #fff1f0;
        }

        .topbar {
            grid-column: 2;
            min-height: var(--topbar-height);
            padding: 0 28px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            background: #ffffff;
            border-bottom: 1px solid var(--ca-border);
        }

        .topbar-left {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .mobile-sidebar-button {
            width: 38px;
            height: 38px;
            border: 1px solid var(--ca-border);
            border-radius: 8px;
            display: none;
            align-items: center;
            justify-content: center;
            background: #ffffff;
            color: #344054;
            cursor: pointer;
        }

        .topbar-title {
            margin: 0;
            font-size: 18px;
            font-weight: 700;
            letter-spacing: -.02em;
            color: var(--ca-text);
        }

        .topbar-subtitle {
            margin-top: 2px;
            font-size: 12px;
            color: var(--ca-muted);
        }

        .topbar-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .date-chip {
            padding: 6px 12px;
            border: 1px solid var(--ca-border);
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            gap: 7px;
            font-size: 12px;
            color: var(--ca-muted);
            background: #fafbfb;
        }

        .account-trigger {
            padding: 4px 10px 4px 6px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .topbar-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            background: var(--ca-primary);
            font-size: 12px;
            font-weight: 700;
        }

        .account-name {
            font-size: 12.5px;
            font-weight: 600;
            color: var(--ca-text);
        }

        .account-role {
            font-size: 11px;
            color: var(--ca-muted);
        }

        .main-content {
            grid-column: 2;
            padding: 24px 28px 40px;
        }

        .form-card {
            background: #ffffff;
            border: 1px solid var(--ca-border);
            border-radius: 14px;
            padding: 28px;
            max-width: 860px;
            margin: 0 auto;
            box-shadow: 0 4px 14px rgba(0, 0, 0, .03);
        }

        .form-header {
            margin-bottom: 24px;
            padding-bottom: 18px;
            border-bottom: 1px solid var(--ca-line);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .form-title {
            font-size: 17px;
            font-weight: 700;
            color: var(--ca-text);
            margin: 0;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-title i {
            color: var(--ca-primary);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #344054;
            margin-bottom: 6px;
        }

        .form-label .required {
            color: #b42318;
        }

        .form-control,
        .form-select {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid var(--ca-border);
            border-radius: 8px;
            font-size: 13.5px;
            background: #ffffff;
            color: var(--ca-text);
            transition: all .15s ease;
        }

        .form-control:focus,
        .form-select:focus {
            outline: none;
            border-color: var(--ca-primary);
            box-shadow: 0 0 0 3px rgba(15, 138, 131, .14);
        }

        .service-chips {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 6px;
        }

        .service-chip-input {
            display: none;
        }

        .service-chip-label {
            padding: 8px 14px;
            border-radius: 8px;
            border: 1px solid var(--ca-border);
            background: #f8fafc;
            color: #475467;
            font-size: 12.5px;
            font-weight: 500;
            cursor: pointer;
            transition: all .15s ease;
            user-select: none;
        }

        .service-chip-input:checked + .service-chip-label {
            background: var(--ca-primary-soft);
            border-color: var(--ca-primary);
            color: var(--ca-primary-dark);
            font-weight: 600;
        }

        .privacy-box {
            background: #fafbfb;
            border: 1px solid var(--ca-border);
            border-radius: 8px;
            padding: 14px 16px;
            margin-top: 24px;
        }

        .btn-submit {
            padding: 10px 22px;
            border-radius: 8px;
            background: var(--ca-primary);
            color: #ffffff;
            font-weight: 600;
            font-size: 14px;
            border: none;
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(15, 138, 131, .25);
            transition: all .15s ease;
        }

        .btn-submit:hover {
            background: var(--ca-primary-dark);
            transform: translateY(-1px);
        }

        .btn-cancel {
            padding: 10px 18px;
            border-radius: 8px;
            background: #ffffff;
            color: #475467;
            font-weight: 600;
            font-size: 14px;
            border: 1px solid var(--ca-border);
            cursor: pointer;
        }

        .btn-cancel:hover {
            background: #f8fafc;
        }
    </style>
    @include('guru-bk.partials.styles')
</head>

<body>
    @php
        $errors = $errors ?? new \Illuminate\Support\ViewErrorBag();
        $namaUser = ucwords($user->name);
        $inisial = strtoupper(substr($user->name, 0, 1));
    @endphp

    <div class="app-shell">
        @include('guru-bk.partials.sidebar')

        <header class="topbar">
            <div class="topbar-left">
                <button type="button" class="mobile-sidebar-button" id="openSidebarButton" aria-label="Buka menu">
                    <i class="bi bi-list"></i>
                </button>
                <div>
                    <h1 class="topbar-title">Perbarui Catatan Konseling</h1>
                    <div class="topbar-subtitle">Edit catatan konseling siswa.</div>
                </div>
            </div>

            <div class="topbar-actions">
                @include('guru-bk.partials.notification-bell')
            <div class="date-chip">
                    <i class="bi bi-calendar3"></i>
                    {{ now()->translatedFormat('d F Y') }}
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
            <div class="form-card">
                <div class="form-header">
                    <h2 class="form-title">
                        <i class="bi bi-pencil-square"></i>
                        Edit Catatan Bimbingan & Konseling
                    </h2>
                    <a href="{{ route('guru-bk.catatan-konseling.show', $catatan->id) }}" class="btn-cancel" style="padding: 6px 14px; font-size: 13px;">
                        <i class="bi bi-arrow-left"></i> Batal & Kembali
                    </a>
                </div>

                @if(isset($errors) && $errors->any())
                    <div class="alert alert-danger mb-4" style="border-radius: 8px;">
                        <div class="fw-bold mb-1">Periksa kembali formulir:</div>
                        <ul class="mb-0 ps-3">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('guru-bk.catatan-konseling.update', $catatan->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="row g-3 mb-3">
                        <div class="col-md-4">
                            <label class="form-label" for="filter_kelas">
                                <i class="bi bi-mortarboard-fill text-primary me-1"></i> 1. Pilih Kelas Terlebih Dahulu
                            </label>
                            <select id="filter_kelas" class="form-select">
                                <option value="">-- Semua Kelas --</option>
                                @foreach($kelasList as $kelas)
                                    <option value="{{ $kelas->id }}">{{ $kelas->nama_kelas }}</option>
                                @endforeach
                            </select>
                            <div class="form-text" style="font-size: 11.5px; color: var(--ca-muted);">
                                Saring nama siswa per kelas agar cepat & praktis.
                            </div>
                        </div>

                        <div class="col-md-5">
                            <label class="form-label" for="siswa_id">
                                <i class="bi bi-person-fill text-primary me-1"></i> 2. Nama Siswa <span class="required">*</span>
                            </label>
                            <select name="siswa_id" id="siswa_id" class="form-select @error('siswa_id') is-invalid @enderror" required>
                                <option value="">-- Pilih Siswa --</option>
                                @foreach($siswaList as $s)
                                    <option value="{{ $s->id }}" data-kelas-id="{{ $s->kelas_id ?? '' }}" data-kelas-nama="{{ $s->nama_kelas ?? 'Tanpa Kelas' }}" @selected(old('siswa_id', $catatan->siswa_id) == $s->id)>
                                        {{ $s->nama_siswa }} (NIS: {{ $s->nis ?? '-' }}) — {{ $s->nama_kelas ?? 'Tanpa Kelas' }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="form-text" id="siswa_hint" style="font-size: 11.5px; color: var(--ca-muted);">
                                Menampilkan seluruh siswa terdaftar.
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label" for="tanggal_pertemuan">
                                <i class="bi bi-calendar-event me-1"></i> Tanggal Sesi <span class="required">*</span>
                            </label>
                            <input type="date" name="tanggal_pertemuan" id="tanggal_pertemuan" class="form-control @error('tanggal_pertemuan') is-invalid @enderror" value="{{ old('tanggal_pertemuan', $catatan->tanggal_pertemuan ? $catatan->tanggal_pertemuan->toDateString() : '') }}" max="{{ now()->toDateString() }}" required>
                            <div class="form-text" style="font-size: 11.5px; color: var(--ca-muted);">
                                Tanggal pelaksanaan sesi.
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            Jenis Layanan Bimbingan Konseling <span class="required">*</span>
                        </label>
                        <div class="service-chips">
                            @foreach($jenisLayananList as $layanan)
                                <input type="radio" name="jenis_layanan" id="layanan_{{ Str::slug($layanan) }}" value="{{ $layanan }}" class="service-chip-input" @checked(old('jenis_layanan', $catatan->jenis_layanan) === $layanan) required>
                                <label for="layanan_{{ Str::slug($layanan) }}" class="service-chip-label">
                                    {{ $layanan }}
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="topik">
                            Topik / Masalah Yang Dibahas <span class="required">*</span>
                        </label>
                        <input type="text" name="topik" id="topik" autocomplete="off" class="form-control @error('topik') is-invalid @enderror" value="{{ old('topik', $catatan->topik) }}" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="isi_catatan">
                            Catatan Proses & Observasi Sesi <span class="required">*</span>
                        </label>
                        <textarea name="isi_catatan" id="isi_catatan" rows="5" class="form-control @error('isi_catatan') is-invalid @enderror" required>{{ old('isi_catatan', $catatan->isi_catatan) }}</textarea>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label" for="hasil_kesepakatan">
                                Hasil Kesepakatan / Solusi <small class="text-muted">(Opsional)</small>
                            </label>
                            <textarea name="hasil_kesepakatan" id="hasil_kesepakatan" rows="3" class="form-control">{{ old('hasil_kesepakatan', $catatan->hasil_kesepakatan) }}</textarea>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label" for="tindak_lanjut">
                                Rencana Tindak Lanjut <small class="text-muted">(Opsional)</small>
                            </label>
                            <textarea name="tindak_lanjut" id="tindak_lanjut" rows="3" class="form-control">{{ old('tindak_lanjut', $catatan->tindak_lanjut) }}</textarea>
                        </div>
                    </div>

                    <div class="privacy-box d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center gap-3">
                            <i class="bi bi-shield-lock-fill text-danger fs-3"></i>
                            <div>
                                <div style="font-weight: 600; color: #1e293b;">Sifat Kerahasiaan Sesi</div>
                                <div style="font-size: 12px; color: var(--ca-muted);">Tandai sebagai rahasia agar detail isi obrolan hanya dapat dibaca oleh Guru BK.</div>
                            </div>
                        </div>
                        <div class="form-check form-switch m-0">
                            <input class="form-check-input" type="checkbox" name="is_rahasia" id="is_rahasia" value="1" @checked(old('is_rahasia', $catatan->is_rahasia)) style="width: 44px; height: 22px; cursor: pointer;">
                        </div>
                    </div>

                    <div class="mt-3 p-3 border rounded-3 bg-white" id="box_wali_kelas" style="display: none; border-left: 4px solid var(--ca-primary) !important;">
                        <label class="form-label fw-bold" for="arahan_wali_kelas">
                            📌 Arahan & Batasan Tindakan untuk Wali Kelas
                        </label>
                        <textarea name="arahan_wali_kelas" id="arahan_wali_kelas" rows="3" class="form-control" placeholder="Contoh: Mohon pantau kehadiran Najwa saat jam pertama. Jangan ditegur di depan kelas, cukup pantau dan laporkan ke Guru BK jika terlambat lagi.">{{ old('arahan_wali_kelas', $catatan->arahan_wali_kelas) }}</textarea>
                        <div class="form-text" style="font-size: 11.5px; color: var(--ca-muted);">
                            Berikan arahan eksplisit agar Wali Kelas tahu persis apa yang boleh dan tidak boleh dilakukan di kelas.
                        </div>
                    </div>

                    <div class="d-flex align-items-center justify-content-end gap-3 mt-4 pt-3 border-top">
                        <a href="{{ route('guru-bk.catatan-konseling.show', $catatan->id) }}" class="btn-cancel">Batal</a>
                        <button type="submit" class="btn-submit">
                            <i class="bi bi-check-circle-fill me-1"></i>
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const isRahasiaInput = document.getElementById('is_rahasia');
            const boxWaliKelas = document.getElementById('box_wali_kelas');

            function toggleWaliKelasBox() {
                if (!isRahasiaInput.checked) {
                    boxWaliKelas.style.display = 'block';
                } else {
                    boxWaliKelas.style.display = 'none';
                }
            }

            if (isRahasiaInput) {
                isRahasiaInput.addEventListener('change', toggleWaliKelasBox);
            }

            toggleWaliKelasBox();
            const filterKelas = document.getElementById('filter_kelas');
            const selectSiswa = document.getElementById('siswa_id');
            const hintSiswa = document.getElementById('siswa_hint');

            if (!filterKelas || !selectSiswa) return;

            const allOptions = Array.from(selectSiswa.querySelectorAll('option')).slice(1);

            function updateSiswaOptions(selectedKelasId, preserveSelectedId = null) {
                const targetValue = preserveSelectedId !== null ? String(preserveSelectedId) : String(selectSiswa.value);
                
                selectSiswa.innerHTML = '<option value="">-- Pilih Siswa --</option>';

                let count = 0;
                let foundMatch = false;

                allOptions.forEach(opt => {
                    const optKelasId = opt.getAttribute('data-kelas-id');
                    if (!selectedKelasId || optKelasId === String(selectedKelasId)) {
                        const clone = opt.cloneNode(true);
                        if (clone.value === targetValue) {
                            clone.selected = true;
                            foundMatch = true;
                        }
                        selectSiswa.appendChild(clone);
                        count++;
                    }
                });

                if (count === 0 && selectedKelasId) {
                    const emptyOpt = document.createElement('option');
                    emptyOpt.value = "";
                    emptyOpt.textContent = "-- Tidak ada siswa di kelas ini --";
                    emptyOpt.disabled = true;
                    emptyOpt.selected = true;
                    selectSiswa.appendChild(emptyOpt);
                }

                if (!foundMatch && preserveSelectedId === null) {
                    selectSiswa.value = "";
                }

                if (hintSiswa) {
                    if (selectedKelasId) {
                        const namaKelas = filterKelas.options[filterKelas.selectedIndex]?.text || '';
                        hintSiswa.textContent = `Tersaring ${count} siswa di kelas ${namaKelas}.`;
                    } else {
                        hintSiswa.textContent = `Menampilkan seluruh ${count} siswa terdaftar.`;
                    }
                }
            }

            const initialSiswaId = "{{ old('siswa_id', $catatan->siswa_id ?? '') }}";
            if (initialSiswaId) {
                const targetOpt = allOptions.find(opt => opt.value === String(initialSiswaId));
                if (targetOpt) {
                    const studentKelasId = targetOpt.getAttribute('data-kelas-id');
                    if (studentKelasId) {
                        filterKelas.value = studentKelasId;
                    }
                    updateSiswaOptions(studentKelasId, initialSiswaId);
                } else {
                    updateSiswaOptions('');
                }
            }

            filterKelas.addEventListener('change', function () {
                updateSiswaOptions(this.value);
            });

            selectSiswa.addEventListener('change', function () {
                if (this.value) {
                    const chosen = selectSiswa.options[selectSiswa.selectedIndex];
                    const kId = chosen?.getAttribute('data-kelas-id');
                    if (kId && filterKelas.value !== kId) {
                        filterKelas.value = kId;
                        const namaKelas = filterKelas.options[filterKelas.selectedIndex]?.text || '';
                        if (hintSiswa) {
                            hintSiswa.textContent = `Siswa terdaftar di kelas ${namaKelas}.`;
                        }
                    }
                }
            });

            // Mencegah double submit saat form diedit & dikirim
            const formCatatan = document.querySelector('form[action*="catatan-konseling"]');
            if (formCatatan) {
                let submitted = false;
                formCatatan.addEventListener('submit', function (e) {
                    if (submitted) {
                        e.preventDefault();
                        return false;
                    }
                    submitted = true;
                    const btn = formCatatan.querySelector('button[type="submit"]');
                    if (btn) {
                        setTimeout(() => {
                            btn.disabled = true;
                            btn.innerHTML = '<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span> Menyimpan...';
                        }, 10);
                    }
                });
            }
        });
    </script>
</body>
</html>

