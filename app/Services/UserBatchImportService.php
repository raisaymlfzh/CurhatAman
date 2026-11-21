<?php

namespace App\Services;

use App\Models\Kelas;
use App\Models\PengaturanSistem;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use ZipArchive;

class UserBatchImportService
{
    /**
     * Membaca file spreadsheet (CSV atau XLSX) menjadi array baris.
     */
    public function readFile(UploadedFile $file): array
    {
        $ext = strtolower($file->getClientOriginalExtension());
        $realPath = $file->getRealPath();

        if ($ext === 'xlsx') {
            return $this->parseXlsx($realPath);
        }

        return $this->parseCsv($realPath);
    }

    /**
     * Parse file CSV dengan deteksi otomatis delimiter (koma, titik koma, tab) & UTF-8 BOM.
     */
    public function parseCsv(string $filePath): array
    {
        $content = file_get_contents($filePath);
        if ($content === false) {
            throw new \RuntimeException("Gagal membaca file CSV.");
        }

        // Hapus UTF-8 BOM jika ada
        if (str_starts_with($content, "\xEF\xBB\xBF")) {
            $content = substr($content, 3);
        }

        // Standarisasi line endings
        $content = str_replace(["\r\n", "\r"], "\n", $content);
        $lines = explode("\n", trim($content));
        if (empty($lines)) {
            return [];
        }

        // Deteksi delimiter
        $firstLine = $lines[0];
        $delimiter = ',';
        $semicolons = substr_count($firstLine, ';');
        $commas = substr_count($firstLine, ',');
        $tabs = substr_count($firstLine, "\t");

        if ($semicolons > $commas && $semicolons > $tabs) {
            $delimiter = ';';
        } elseif ($tabs > $commas && $tabs > $semicolons) {
            $delimiter = "\t";
        }

        $rows = [];
        foreach ($lines as $line) {
            $trimmed = trim($line);
            if ($trimmed === '') {
                continue;
            }
            $data = str_getcsv($trimmed, $delimiter);
            $rows[] = array_map(fn($v) => trim((string)$v), $data);
        }

        return $rows;
    }

    /**
     * Parse file XLSX menggunakan native PHP ZipArchive & SimpleXML (tanpa ketergantungan library luar).
     */
    public function parseXlsx(string $filePath): array
    {
        $zip = new ZipArchive();
        if ($zip->open($filePath) !== true) {
            throw new \RuntimeException("File Excel (.xlsx) tidak valid atau rusak.");
        }

        // 1. Ekstrak shared strings
        $sharedStrings = [];
        $sharedXml = $zip->getFromName('xl/sharedStrings.xml');
        if ($sharedXml !== false) {
            $xml = @simplexml_load_string($sharedXml);
            if ($xml) {
                foreach ($xml->si as $si) {
                    $text = '';
                    if (isset($si->t)) {
                        $text = (string) $si->t;
                    } elseif (isset($si->r)) {
                        foreach ($si->r as $r) {
                            $text .= (string) $r->t;
                        }
                    }
                    $sharedStrings[] = $text;
                }
            }
        }

        // 2. Ekstrak sheet1
        $sheetXml = $zip->getFromName('xl/worksheets/sheet1.xml');
        if ($sheetXml === false) {
            for ($i = 0; $i < $zip->numFiles; $i++) {
                $name = $zip->getNameIndex($i);
                if (str_starts_with($name, 'xl/worksheets/sheet') && str_ends_with($name, '.xml')) {
                    $sheetXml = $zip->getFromIndex($i);
                    break;
                }
            }
        }

        if ($sheetXml === false) {
            $zip->close();
            throw new \RuntimeException("Lembar kerja Excel tidak ditemukan.");
        }

        $xml = @simplexml_load_string($sheetXml);
        $rows = [];

        if ($xml && isset($xml->sheetData->row)) {
            foreach ($xml->sheetData->row as $row) {
                $rowData = [];
                foreach ($row->c as $c) {
                    $cellRef = (string) $c['r'];
                    preg_match('/^([A-Z]+)(\d+)$/', $cellRef, $matches);
                    $colLetters = $matches[1] ?? 'A';

                    $colIdx = 0;
                    for ($k = 0; $k < strlen($colLetters); $k++) {
                        $colIdx = $colIdx * 26 + (ord($colLetters[$k]) - 64);
                    }
                    $colIdx -= 1;

                    $val = '';
                    $type = (string) $c['t'];

                    if ($type === 's') {
                        $idx = (int) $c->v;
                        $val = $sharedStrings[$idx] ?? '';
                    } elseif ($type === 'inlineStr') {
                        $val = (string) $c->is->t;
                    } elseif (isset($c->v)) {
                        $val = (string) $c->v;
                    }

                    $rowData[$colIdx] = trim((string)$val);
                }

                if (!empty($rowData)) {
                    $maxKey = max(array_keys($rowData));
                    $filled = [];
                    for ($k = 0; $k <= $maxKey; $k++) {
                        $filled[$k] = $rowData[$k] ?? '';
                    }
                    $rows[] = $filled;
                }
            }
        }

        $zip->close();
        return $rows;
    }

    /**
     * Memproses import data siswa massal.
     */
    public function importSiswa(array $rows, ?User $actor = null, array $options = []): array
    {
        if (empty($rows)) {
            return [
                'total' => 0,
                'success' => 0,
                'failed' => 0,
                'errors' => ['File spreadsheet kosong atau tidak berisi data.'],
                'created_users' => [],
            ];
        }

        // Peta header
        $headerMap = $this->resolveStudentHeaders($rows[0]);
        $hasHeader = $headerMap !== null;
        $startIndex = $hasHeader ? 1 : 0;

        $totalRows = count($rows) - $startIndex;
        if ($totalRows <= 0) {
            return [
                'total' => 0,
                'success' => 0,
                'failed' => 0,
                'errors' => ['File hanya memuat baris judul/header tanpa ada data siswa.'],
                'created_users' => [],
            ];
        }

        $defaultPassword = !empty($options['default_password']) ? $options['default_password'] : '12345678';
        $pengaturan = PengaturanSistem::current();
        $defaultTahunMasuk = (int) ($pengaturan->tahun_ajaran_aktif ? substr($pengaturan->tahun_ajaran_aktif, 0, 4) : date('Y'));

        // Cache kelas yang ada
        $allKelas = Kelas::where('is_active', true)->get();
        $kelasMap = [];
        foreach ($allKelas as $k) {
            $kelasMap[strtolower(trim($k->nama_kelas))] = $k->id;
        }

        $successCount = 0;
        $failedCount = 0;
        $errors = [];
        $createdUsers = [];

        $seenEmails = [];
        $seenNis = [];

        for ($i = $startIndex; $i < count($rows); $i++) {
            $rowNum = $i + 1;
            $row = $rows[$i];

            // Abaikan jika seluruh kolom baris kosong
            if (empty(array_filter($row, fn($c) => trim((string)$c) !== ''))) {
                continue;
            }

            // Ambil nilai berdasarkan mapping atau posisi (Nama Lengkap, NISN, Kelas, Tahun Masuk, Password)
            $name = trim($this->getVal($row, $headerMap['nama'] ?? 0));
            $nis = trim($this->getVal($row, $headerMap['nis'] ?? 1));
            $kelasName = trim($this->getVal($row, $headerMap['kelas'] ?? 2));
            $tahunMasuk = trim($this->getVal($row, $headerMap['tahun_masuk'] ?? 3));
            $password = isset($headerMap['password']) && $headerMap['password'] !== null
                ? trim($this->getVal($row, $headerMap['password']))
                : trim($this->getVal($row, 4));
            $email = isset($headerMap['email']) && $headerMap['email'] !== null
                ? trim($this->getVal($row, $headerMap['email']))
                : '';
            $whatsapp = isset($headerMap['whatsapp']) && $headerMap['whatsapp'] !== null
                ? trim($this->getVal($row, $headerMap['whatsapp']))
                : '';

            // Validasi nama
            if ($name === '') {
                $failedCount++;
                $errors[] = "Baris {$rowNum}: Nama siswa tidak boleh kosong.";
                continue;
            }

            // Validasi NIS
            if ($nis === '') {
                $failedCount++;
                $errors[] = "Baris {$rowNum} ({$name}): NIS wajib diisi.";
                continue;
            }

            if (isset($seenNis[$nis])) {
                $failedCount++;
                $errors[] = "Baris {$rowNum} ({$name}): NIS '{$nis}' duplikat dengan baris sebelumnya dalam file.";
                continue;
            }
            $seenNis[$nis] = true;

            // Cek NIS di database
            if (Siswa::where('nis', $nis)->exists()) {
                $failedCount++;
                $errors[] = "Baris {$rowNum} ({$name}): NIS '{$nis}' sudah terdaftar di sistem.";
                continue;
            }

            // Validasi Email (jika kosong, auto-generate dari NIS)
            if ($email === '') {
                $email = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $nis)) . '@siswa.curhataman.local';
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $failedCount++;
                $errors[] = "Baris {$rowNum} ({$name}): Format email '{$email}' tidak valid.";
                continue;
            }

            if (isset($seenEmails[strtolower($email)])) {
                $failedCount++;
                $errors[] = "Baris {$rowNum} ({$name}): Email '{$email}' duplikat dengan baris sebelumnya dalam file.";
                continue;
            }
            $seenEmails[strtolower($email)] = true;

            // Cek email di database
            if (User::where('email', strtolower($email))->exists()) {
                $failedCount++;
                $errors[] = "Baris {$rowNum} ({$name}): Email '{$email}' sudah digunakan oleh pengguna lain.";
                continue;
            }

            // Resolusi kelas
            $kelasId = null;
            if ($kelasName !== '') {
                $cleanKelasKey = strtolower($kelasName);
                if (isset($kelasMap[$cleanKelasKey])) {
                    $kelasId = $kelasMap[$cleanKelasKey];
                } else {
                    // Cari kelas fuzzy atau buat baru jika tidak ditemukan
                    $existingKelas = Kelas::whereRaw('LOWER(nama_kelas) = ?', [$cleanKelasKey])->first();
                    if ($existingKelas) {
                        $kelasId = $existingKelas->id;
                        $kelasMap[$cleanKelasKey] = $existingKelas->id;
                    } else {
                        // Otomatis buat kelas baru agar proses import tetap lancar
                        $tingkat = '10';
                        if (preg_match('/(11|XI)/i', $kelasName)) {
                            $tingkat = '11';
                        } elseif (preg_match('/(12|XII)/i', $kelasName)) {
                            $tingkat = '12';
                        }

                        $newKelas = Kelas::create([
                            'nama_kelas' => $kelasName,
                            'tingkat' => $tingkat,
                            'tahun_ajaran' => $pengaturan->tahun_ajaran_aktif ?: '2026/2027',
                            'is_active' => true,
                        ]);
                        $kelasId = $newKelas->id;
                        $kelasMap[$cleanKelasKey] = $newKelas->id;
                    }
                }
            }

            // Password
            $passFinal = $password !== '' ? $password : $defaultPassword;

            // Tahun masuk
            $tahunFinal = (int) $tahunMasuk;
            if ($tahunFinal < 2000 || $tahunFinal > 2100) {
                $tahunFinal = $defaultTahunMasuk;
            }

            // Simpan ke database
            try {
                DB::transaction(function () use ($name, $email, $passFinal, $nis, $kelasId, $tahunFinal, $whatsapp, &$createdUsers) {
                    $newUser = User::create([
                        'name' => $name,
                        'email' => strtolower($email),
                        'password' => Hash::make($passFinal),
                        'role' => 'student',
                        'is_active' => true,
                    ]);

                    Siswa::create([
                        'user_id' => $newUser->id,
                        'kelas_id' => $kelasId,
                        'nis' => $nis,
                        'tahun_masuk' => $tahunFinal,
                        'whatsapp_number' => $whatsapp ?: null,
                        'whatsapp_consent' => false,
                        'status_kondisi' => 'aman',
                    ]);

                    $createdUsers[] = [
                        'name' => $name,
                        'email' => $email,
                        'nis' => $nis,
                        'kelas_id' => $kelasId,
                    ];
                });

                $successCount++;
            } catch (\Throwable $e) {
                $failedCount++;
                $errors[] = "Baris {$rowNum} ({$name}): Gagal menyimpan ke database ({$e->getMessage()}).";
            }
        }

        // Kirim notifikasi ke Wali Kelas untuk kelas yang mendapatkan siswa baru
        if (! empty($createdUsers)) {
            $groupedByKelas = collect($createdUsers)->whereNotNull('kelas_id')->groupBy('kelas_id');
            foreach ($groupedByKelas as $kId => $studentsInClass) {
                $kelasRow = Kelas::find($kId);
                if ($kelasRow && ! empty($kelasRow->wali_kelas_user_id)) {
                    $jumlahBaru = $studentsInClass->count();
                    $contohNama = $studentsInClass->take(3)->pluck('name')->implode(', ');
                    $sisa = $jumlahBaru > 3 ? ' dan ' . ($jumlahBaru - 3) . ' siswa lainnya' : '';
                    \Illuminate\Support\Facades\DB::table('notifikasi')->insert([
                        'user_id' => $kelasRow->wali_kelas_user_id,
                        'tipe' => 'info_kelas',
                        'judul' => "{$jumlahBaru} Siswa Baru Ditambahkan ke Kelas {$kelasRow->nama_kelas}",
                        'pesan' => "Admin telah mengimpor {$jumlahBaru} data siswa ({$contohNama}{$sisa}) ke kelas {$kelasRow->nama_kelas}. Daftar lengkap dapat dilihat di menu Ringkasan Kelas.",
                        'referensi_tipe' => 'kelas',
                        'referensi_id' => $kelasRow->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }

        // Catat Audit Log
        if ($actor && $successCount > 0) {
            $this->logAudit(
                $actor,
                'batch_import_students',
                "Mengimpor {$successCount} data siswa baru secara massal.",
                [
                    'success_count' => $successCount,
                    'failed_count' => $failedCount,
                    'total_rows' => $totalRows,
                ]
            );
        }

        return [
            'total' => $successCount + $failedCount,
            'success' => $successCount,
            'failed' => $failedCount,
            'errors' => $errors,
            'created_users' => $createdUsers,
        ];
    }

    /**
     * Memproses import data Guru BK & Wali Kelas massal.
     */
    public function importGuru(array $rows, ?User $actor = null, array $options = []): array
    {
        if (empty($rows)) {
            return [
                'total' => 0,
                'success' => 0,
                'failed' => 0,
                'errors' => ['File spreadsheet kosong atau tidak berisi data.'],
                'created_users' => [],
            ];
        }

        $headerMap = $this->resolveTeacherHeaders($rows[0]);
        $hasHeader = $headerMap !== null;
        $startIndex = $hasHeader ? 1 : 0;

        $totalRows = count($rows) - $startIndex;
        if ($totalRows <= 0) {
            return [
                'total' => 0,
                'success' => 0,
                'failed' => 0,
                'errors' => ['File hanya memuat baris judul/header tanpa ada data guru.'],
                'created_users' => [],
            ];
        }

        $defaultPassword = !empty($options['default_password']) ? $options['default_password'] : '12345678';
        $pengaturan = PengaturanSistem::current();

        $allKelas = Kelas::where('is_active', true)->get();
        $kelasMap = [];
        foreach ($allKelas as $k) {
            $kelasMap[strtolower(trim($k->nama_kelas))] = $k;
        }

        $successCount = 0;
        $failedCount = 0;
        $errors = [];
        $createdUsers = [];
        $seenEmails = [];

        for ($i = $startIndex; $i < count($rows); $i++) {
            $rowNum = $i + 1;
            $row = $rows[$i];

            if (empty(array_filter($row, fn($c) => trim((string)$c) !== ''))) {
                continue;
            }

            $name = trim($this->getVal($row, $headerMap['nama'] ?? 0));
            $email = trim($this->getVal($row, $headerMap['email'] ?? 1));
            $rawRole = trim($this->getVal($row, $headerMap['role'] ?? 2));
            $kelasName = trim($this->getVal($row, $headerMap['kelas'] ?? 3));
            $password = trim($this->getVal($row, $headerMap['password'] ?? 4));

            if ($name === '') {
                $failedCount++;
                $errors[] = "Baris {$rowNum}: Nama guru tidak boleh kosong.";
                continue;
            }

            if ($email === '') {
                $slugName = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $name));
                $email = ($slugName ?: 'guru' . $rowNum) . '@curhataman.com';
            } elseif (!str_contains($email, '@')) {
                $email = strtolower($email) . '@curhataman.com';
            } else {
                // Pastikan menggunakan domain @curhataman.com
                $localPart = explode('@', $email)[0];
                $email = strtolower(trim($localPart)) . '@curhataman.com';
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $failedCount++;
                $errors[] = "Baris {$rowNum} ({$name}): Format email '{$email}' tidak valid.";
                continue;
            }

            if (isset($seenEmails[strtolower($email)])) {
                $failedCount++;
                $errors[] = "Baris {$rowNum} ({$name}): Email '{$email}' duplikat dengan baris sebelumnya dalam file.";
                continue;
            }
            $seenEmails[strtolower($email)] = true;

            if (User::where('email', strtolower($email))->exists()) {
                $failedCount++;
                $errors[] = "Baris {$rowNum} ({$name}): Email '{$email}' sudah terdaftar di sistem.";
                continue;
            }

            // Normalisasi role
            $roleLower = strtolower($rawRole);
            $role = 'counselor'; // default jika tidak spesifik
            if (str_contains($roleLower, 'wali') || str_contains($roleLower, 'homeroom')) {
                $role = 'homeroom_teacher';
            } elseif (str_contains($roleLower, 'bk') || str_contains($roleLower, 'konsel') || str_contains($roleLower, 'counselor')) {
                $role = 'counselor';
            } elseif (str_contains($roleLower, 'admin')) {
                $role = 'admin';
            }

            // Validasi kelas untuk wali kelas
            $targetKelas = null;
            if ($role === 'homeroom_teacher' && $kelasName !== '') {
                $cleanKelasKey = strtolower($kelasName);
                if (isset($kelasMap[$cleanKelasKey])) {
                    $targetKelas = $kelasMap[$cleanKelasKey];
                } else {
                    $targetKelas = Kelas::whereRaw('LOWER(nama_kelas) = ?', [$cleanKelasKey])->first();
                }

                if ($targetKelas && $targetKelas->wali_kelas_user_id) {
                    $failedCount++;
                    $errors[] = "Baris {$rowNum} ({$name}): Kelas '{$kelasName}' sudah memiliki wali kelas aktif.";
                    continue;
                }
            }

            $passFinal = $password !== '' ? $password : $defaultPassword;

            try {
                DB::transaction(function () use ($name, $email, $passFinal, $role, $targetKelas, &$createdUsers) {
                    $newUser = User::create([
                        'name' => $name,
                        'email' => strtolower($email),
                        'password' => Hash::make($passFinal),
                        'role' => $role,
                        'is_active' => true,
                    ]);

                    if ($role === 'homeroom_teacher' && $targetKelas) {
                        $targetKelas->update([
                            'wali_kelas_user_id' => $newUser->id,
                        ]);
                    }

                    $createdUsers[] = [
                        'name' => $name,
                        'email' => $email,
                        'role' => $role,
                    ];
                });

                $successCount++;
            } catch (\Throwable $e) {
                $failedCount++;
                $errors[] = "Baris {$rowNum} ({$name}): Gagal menyimpan ke database ({$e->getMessage()}).";
            }
        }

        // Catat Audit Log
        if ($actor && $successCount > 0) {
            $this->logAudit(
                $actor,
                'batch_import_teachers',
                "Mengimpor {$successCount} data Guru BK / Wali Kelas baru secara massal.",
                [
                    'success_count' => $successCount,
                    'failed_count' => $failedCount,
                    'total_rows' => $totalRows,
                ]
            );
        }

        return [
            'total' => $successCount + $failedCount,
            'success' => $successCount,
            'failed' => $failedCount,
            'errors' => $errors,
            'created_users' => $createdUsers,
        ];
    }

    /**
     * Menghasilkan file template CSV untuk import siswa.
     */
    public function generateTemplateSiswaCsv(): string
    {
        $headers = ['Nama Lengkap', 'NISN', 'Kelas', 'Tahun Masuk', 'Password'];
        $sampleRows = [
            ['Ahmad Fauzan', '0082026101', 'X IPA 1', '2026', '12345678'],
            ['Siti Nurhaliza', '0082026102', 'X IPA 1', '2026', '12345678'],
            ['Budi Pratama', '0082026103', 'X IPA 2', '2026', '12345678'],
        ];

        return $this->buildCsvString($headers, $sampleRows);
    }

    /**
     * Menghasilkan file template XLSX untuk import siswa.
     */
    public function generateTemplateSiswaXlsx(): string
    {
        $headers = ['Nama Lengkap', 'NISN', 'Kelas', 'Tahun Masuk', 'Password'];
        $sampleRows = [
            ['Ahmad Fauzan', '0082026101', 'X IPA 1', '2026', '12345678'],
            ['Siti Nurhaliza', '0082026102', 'X IPA 1', '2026', '12345678'],
            ['Budi Pratama', '0082026103', 'X IPA 2', '2026', '12345678'],
        ];

        return $this->buildXlsxString($headers, $sampleRows);
    }

    /**
     * Menghasilkan file template CSV untuk import Guru BK & Wali Kelas.
     */
    public function generateTemplateGuruCsv(): string
    {
        $headers = ['Nama Lengkap', 'Email', 'Role (Guru BK / Wali Kelas)', 'Kelas Yang Diampu (Khusus Wali Kelas)', 'Password'];
        $sampleRows = [
            ['bk3', 'bk3@curhataman.com', 'Guru BK', '', '12345678'],
            ['bk4', 'bk4@curhataman.com', 'Guru BK', '', '12345678'],
            ['wali3', 'wali3@curhataman.com', 'Wali Kelas', 'X IPA 1', '12345678'],
        ];

        return $this->buildCsvString($headers, $sampleRows);
    }

    /**
     * Menghasilkan file template XLSX untuk import Guru BK & Wali Kelas.
     */
    public function generateTemplateGuruXlsx(): string
    {
        $headers = ['Nama Lengkap', 'Email', 'Role (Guru BK / Wali Kelas)', 'Kelas Yang Diampu (Khusus Wali Kelas)', 'Password'];
        $sampleRows = [
            ['bk3', 'bk3@curhataman.com', 'Guru BK', '', '12345678'],
            ['bk4', 'bk4@curhataman.com', 'Guru BK', '', '12345678'],
            ['wali3', 'wali3@curhataman.com', 'Wali Kelas', 'X IPA 1', '12345678'],
        ];

        return $this->buildXlsxString($headers, $sampleRows);
    }

    private function buildCsvString(array $headers, array $rows): string
    {
        $f = fopen('php://memory', 'r+');
        // Tulis UTF-8 BOM agar Microsoft Excel di Windows langsung membaca karakter dengan tepat
        fwrite($f, "\xEF\xBB\xBF");
        fputcsv($f, $headers);
        foreach ($rows as $row) {
            fputcsv($f, $row);
        }
        rewind($f);
        $csv = stream_get_contents($f);
        fclose($f);

        return $csv;
    }

    private function buildXlsxString(array $headers, array $rows): string
    {
        $tempFile = tempnam(sys_get_temp_dir(), 'ca_xlsx_');
        $zip = new ZipArchive();
        if ($zip->open($tempFile, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
            throw new \RuntimeException("Gagal membuat temporary file XLSX.");
        }

        $zip->addFromString('[Content_Types].xml', '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<Types xmlns="http://schemas.openxmlformats.org/package/2006/content-types">
  <Default Extension="rels" ContentType="application/vnd.openxmlformats-package.relationships+xml"/>
  <Default Extension="xml" ContentType="application/xml"/>
  <Override PartName="/xl/workbook.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet.main+xml"/>
  <Override PartName="/xl/worksheets/sheet1.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.worksheet+xml"/>
</Types>');

        $zip->addFromString('_rels/.rels', '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships">
  <Relationship Id="rId1" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/officeDocument" Target="xl/workbook.xml"/>
</Relationships>');

        $zip->addFromString('xl/_rels/workbook.xml.rels', '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships">
  <Relationship Id="rId1" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/worksheet" Target="worksheets/sheet1.xml"/>
</Relationships>');

        $zip->addFromString('xl/workbook.xml', '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<workbook xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main" xmlns:r="http://schemas.openxmlformats.org/officeDocument/2006/relationships">
  <sheets>
    <sheet name="Template" sheetId="1" r:id="rId1"/>
  </sheets>
</workbook>');

        $allRows = array_merge([$headers], $rows);
        $sheetXml = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<worksheet xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main">
  <sheetData>';

        $rowNum = 1;
        foreach ($allRows as $r) {
            $sheetXml .= '<row r="' . $rowNum . '">';
            $colIdx = 0;
            foreach ($r as $cellVal) {
                $colLetter = '';
                $temp = $colIdx;
                while ($temp >= 0) {
                    $colLetter = chr(($temp % 26) + 65) . $colLetter;
                    $temp = intdiv($temp, 26) - 1;
                }
                $cellRef = $colLetter . $rowNum;
                $safeVal = htmlspecialchars((string)$cellVal, ENT_XML1, 'UTF-8');
                $sheetXml .= '<c r="' . $cellRef . '" t="inlineStr"><is><t>' . $safeVal . '</t></is></c>';
                $colIdx++;
            }
            $sheetXml .= '</row>';
            $rowNum++;
        }
        $sheetXml .= '</sheetData></worksheet>';

        $zip->addFromString('xl/worksheets/sheet1.xml', $sheetXml);
        $zip->close();

        $content = file_get_contents($tempFile);
        @unlink($tempFile);

        return $content;
    }

    private function resolveStudentHeaders(array $firstRow): ?array
    {
        $normalized = array_map(fn($v) => strtolower(trim((string)$v)), $firstRow);

        $namaIdx = $this->findHeaderIndex($normalized, ['nama', 'nama lengkap', 'nama_lengkap', 'nama siswa', 'name']);
        $nisIdx = $this->findHeaderIndex($normalized, ['nis', 'nomor induk', 'nisn', 'no induk']);
        $emailIdx = $this->findHeaderIndex($normalized, ['email', 'surel', 'e-mail']);
        $kelasIdx = $this->findHeaderIndex($normalized, ['kelas', 'nama kelas', 'rombel']);
        $tahunIdx = $this->findHeaderIndex($normalized, ['tahun masuk', 'tahun_masuk', 'angkatan', 'tahun']);
        $waIdx = $this->findHeaderIndex($normalized, ['no whatsapp', 'whatsapp', 'no wa', 'no hp', 'telepon', 'telp']);
        $passIdx = $this->findHeaderIndex($normalized, ['password', 'kata sandi']);

        if ($namaIdx !== null || $nisIdx !== null || $kelasIdx !== null) {
            return [
                'nama' => $namaIdx ?? 0,
                'nis' => $nisIdx ?? 1,
                'kelas' => $kelasIdx ?? 2,
                'tahun_masuk' => $tahunIdx ?? 3,
                'password' => $passIdx,
                'email' => $emailIdx,
                'whatsapp' => $waIdx,
            ];
        }

        return null;
    }

    private function resolveTeacherHeaders(array $firstRow): ?array
    {
        $normalized = array_map(fn($v) => strtolower(trim((string)$v)), $firstRow);

        $namaIdx = $this->findHeaderIndex($normalized, ['nama', 'nama lengkap', 'nama_lengkap', 'nama guru', 'name']);
        $emailIdx = $this->findHeaderIndex($normalized, ['email', 'surel', 'e-mail']);
        $roleIdx = $this->findHeaderIndex($normalized, ['role', 'peran', 'jabatan', 'posisi']);
        $kelasIdx = $this->findHeaderIndex($normalized, ['kelas', 'nama kelas', 'kelas yang diampu']);
        $passIdx = $this->findHeaderIndex($normalized, ['password', 'kata sandi']);

        if ($namaIdx !== null || $emailIdx !== null || $roleIdx !== null) {
            return [
                'nama' => $namaIdx ?? 0,
                'email' => $emailIdx ?? 1,
                'role' => $roleIdx ?? 2,
                'kelas' => $kelasIdx ?? 3,
                'password' => $passIdx ?? 4,
            ];
        }

        return null;
    }

    private function findHeaderIndex(array $row, array $candidates): ?int
    {
        foreach ($row as $idx => $cell) {
            foreach ($candidates as $cand) {
                if ($cell === $cand || str_contains($cell, $cand)) {
                    return $idx;
                }
            }
        }
        return null;
    }

    private function getVal(array $row, int $idx): string
    {
        return $row[$idx] ?? '';
    }

    private function logAudit(User $actor, string $action, string $description, array $metadata = []): void
    {
        try {
            DB::table('audit_logs')->insert([
                'actor_id' => $actor->id,
                'actor_name' => $actor->name,
                'actor_role' => $actor->role,
                'action' => $action,
                'reference_code' => 'BATCH-' . date('YmdHis'),
                'description' => $description,
                'metadata' => json_encode($metadata),
                'created_at' => now(),
            ]);
        } catch (\Throwable $e) {
            // Abaikan jika audit_logs memiliki format berbeda
        }
    }
}
