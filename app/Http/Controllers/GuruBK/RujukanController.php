<?php

namespace App\Http\Controllers\GuruBK;

use App\Http\Controllers\Controller;
use App\Models\PengaturanSistem;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class RujukanController extends Controller
{
    private function authorizeCounselor(Request $request): void
    {
        abort_unless(
            $request->user()
                && $request->user()->role === 'counselor',
            403,
            'Kamu tidak memiliki akses ke halaman Guru BK.'
        );
    }

    public function index(Request $request)
    {
        $this->authorizeCounselor($request);

        $user = $request->user();

        $pengaturan = PengaturanSistem::current();

        $tahunAjaran = trim((string) $request->query(
            'tahun_ajaran',
            $pengaturan->tahun_ajaran_aktif
        ));

        if (! preg_match('/^\d{4}\/\d{4}$/', $tahunAjaran)) {
            $tahunAjaran = $pengaturan->tahun_ajaran_aktif;
        }

        $semester = strtolower(trim((string) $request->query(
            'semester',
            $pengaturan->semester_aktif
        )));

        if (! in_array($semester, ['ganjil', 'genap'], true)) {
            $semester = $pengaturan->semester_aktif;
        }

        [$startDate, $endDate] = $this->resolveAcademicPeriod(
            $tahunAjaran,
            $semester
        );

        $tahunAjaranOptions = DB::table('rujukan')
            ->whereNotNull('referred_at')
            ->pluck('referred_at')
            ->map(function ($tanggal) {
                return $this->academicYearFromDate(
                    Carbon::parse($tanggal)
                );
            })
            ->prepend($pengaturan->tahun_ajaran_aktif)
            ->filter()
            ->unique()
            ->sortDesc()
            ->values();

        $search = trim((string) $request->query('q', ''));
        $status = (string) $request->query('status', '');
        $jenis = (string) $request->query('jenis', '');

        $query = DB::table('rujukan')
            ->join(
                'siswa',
                'rujukan.siswa_id',
                '=',
                'siswa.id'
            )
            ->join(
                'users as siswa_user',
                'siswa.user_id',
                '=',
                'siswa_user.id'
            )
            ->leftJoin(
                'kelas',
                'siswa.kelas_id',
                '=',
                'kelas.id'
            )
            ->join(
                'layanan_rujukan',
                'rujukan.layanan_id',
                '=',
                'layanan_rujukan.id'
            )
            ->join(
                'users as creator',
                'rujukan.created_by_user_id',
                '=',
                'creator.id'
            )
            ->leftJoin(
                'laporan_kasus',
                'rujukan.laporan_id',
                '=',
                'laporan_kasus.id'
            )
            ->whereBetween(
                'rujukan.referred_at',
                [
                    $startDate,
                    $endDate,
                ]
            )
            ->select([
                'rujukan.id',
                'rujukan.created_by_user_id',
                'rujukan.status',
                'rujukan.alasan_rujukan',
                'rujukan.referred_at',
                'rujukan.laporan_id',
                'rujukan.skrining_id',
                'siswa_user.name as nama_siswa',
                'siswa.nis',
                'siswa.whatsapp_number',
                'siswa.whatsapp_consent',

                DB::raw(
                    'COALESCE('
                    . 'laporan_kasus.nama_kelas_saat_laporan, '
                    . 'kelas.nama_kelas'
                    . ') as nama_kelas'
                ),

                'layanan_rujukan.nama_layanan',
                'layanan_rujukan.jenis_layanan',
                'layanan_rujukan.kontak',
                'layanan_rujukan.alamat_url',
                'creator.name as dibuat_oleh',
                'laporan_kasus.kode_laporan',
            ]);

        if ($search !== '') {
            $query->where(function ($subQuery) use (
                $search,
                $user
            ) {
                $subQuery
                    ->where(
                        'siswa_user.name',
                        'like',
                        '%' . $search . '%'
                    )
                    ->orWhere(
                        'siswa.nis',
                        'like',
                        '%' . $search . '%'
                    )
                    ->orWhere(
                        'layanan_rujukan.nama_layanan',
                        'like',
                        '%' . $search . '%'
                    )
                    ->orWhere(function ($reasonQuery) use (
                        $search,
                        $user
                    ) {
                        $reasonQuery
                            ->where(
                                'rujukan.created_by_user_id',
                                $user->id
                            )
                            ->where(
                                'rujukan.alasan_rujukan',
                                'like',
                                '%' . $search . '%'
                            );
                    });
            });
        }

        if (
            in_array(
                $status,
                [
                    'baru',
                    'diproses',
                    'selesai',
                ],
                true
            )
        ) {
            $query->where(
                'rujukan.status',
                $status
            );
        }

        if ($jenis !== '') {
            $query->where(
                'layanan_rujukan.jenis_layanan',
                $jenis
            );
        }

        $rujukan = $query
            ->orderByDesc('rujukan.referred_at')
            ->paginate(10)
            ->withQueryString();

        $summaryBase = DB::table('rujukan')
            ->join('siswa', 'rujukan.siswa_id', '=', 'siswa.id')
            ->whereBetween(
                'rujukan.referred_at',
                [
                    $startDate,
                    $endDate,
                ]
            );

        $summary = [
            'total' =>
                (clone $summaryBase)->count(),

            'baru' =>
                (clone $summaryBase)
                    ->where('status', 'baru')
                    ->count(),

            'diproses' =>
                (clone $summaryBase)
                    ->where('status', 'diproses')
                    ->count(),

            'selesai' =>
                (clone $summaryBase)
                    ->where('status', 'selesai')
                    ->count(),
        ];

        $jenisLayanan = DB::table('layanan_rujukan')
            ->where('is_active', true)
            ->select('jenis_layanan')
            ->distinct()
            ->orderBy('jenis_layanan')
            ->pluck('jenis_layanan');

        return view(
            'guru-bk.rujukan.index',
            compact(
                'user',
                'rujukan',
                'summary',
                'search',
                'status',
                'jenis',
                'jenisLayanan',
                'tahunAjaran',
                'semester',
                'tahunAjaranOptions',
                'startDate',
                'endDate'
            )
        );
    }

    public function create(Request $request)
    {
        $this->authorizeCounselor($request);

        $user = $request->user();

        $sumberType = $request->query('sumber_type');
        $sumberId = $request->query('sumber_id');
        if ($sumberType === 'skrining' && $sumberId) {
            $skriningItem = DB::table('skrining_siswa')->where('id', $sumberId)->first();
            if ($skriningItem) {
                if (is_null($skriningItem->assigned_bk_id)) {
                    return redirect()->route('guru-bk.skrining.show', $sumberId)
                        ->with('error', 'Sesi skrining ini belum diambil penanganannya. Silakan klik "Ambil Penanganan" terlebih dahulu.');
                }
                if ((int) $skriningItem->assigned_bk_id !== (int) $user->id) {
                    return redirect()->route('guru-bk.skrining.show', $sumberId)
                        ->with('error', 'Hanya Guru BK yang menangani skrining ini yang dapat membuat rujukan.');
                }
            }
        }

        $siswa = DB::table('siswa')
            ->join(
                'users',
                'siswa.user_id',
                '=',
                'users.id'
            )
            ->leftJoin(
                'kelas',
                'siswa.kelas_id',
                '=',
                'kelas.id'
            )
            ->where('users.role', 'student')
            ->where('users.is_active', true)
            ->select([
                'siswa.id',
                'users.name',
                'siswa.nis',
                'kelas.id as kelas_id',
                'kelas.nama_kelas',
                'kelas.tingkat',
                'kelas.tahun_ajaran',
            ])
            ->orderBy('kelas.tingkat')
            ->orderBy('kelas.nama_kelas')
            ->orderBy('users.name')
            ->get();

        $layanan = DB::table('layanan_rujukan')
            ->where('is_active', true)
            ->orderBy('nama_layanan')
            ->get();

        $laporan = DB::table('laporan_kasus')
            ->where('status_kasus', '!=', 'draft')
            ->select([
                'id',
                'siswa_id',
                'kode_laporan',
                'status_kasus',
                'submitted_at',
            ])
            ->orderByDesc('submitted_at')
            ->get();

        $skrining = DB::table('skrining_siswa')
            ->where('status', 'selesai')
            ->where('assigned_bk_id', $user->id)
            ->select([
                'id',
                'siswa_id',
                'completed_at',
            ])
            ->orderByDesc('completed_at')
            ->get();

        return view(
            'guru-bk.rujukan.create',
            compact(
                'user',
                'siswa',
                'layanan',
                'laporan',
                'skrining'
            )
        );
    }

    public function store(Request $request)
    {
        $this->authorizeCounselor($request);

        $validated = $request->validate([
            'siswa_id' => [
                'required',
                'integer',
                'exists:siswa,id',
            ],

            'layanan_id' => [
                'required',
                'integer',
                'exists:layanan_rujukan,id',
            ],

            'sumber_type' => [
                'nullable',
                Rule::in([
                    'laporan',
                    'skrining',
                ]),
            ],

            'sumber_id' => [
                'nullable',
                'integer',
            ],

            'alasan_rujukan' => [
                'required',
                'string',
                'min:10',
                'max:3000',
            ],
        ]);

        $layananAktif = DB::table('layanan_rujukan')
            ->where('id', $validated['layanan_id'])
            ->where('is_active', true)
            ->exists();

        if (! $layananAktif) {
            return back()
                ->withInput()
                ->withErrors([
                    'layanan_id' =>
                        'Layanan rujukan yang dipilih sedang tidak aktif.',
                ]);
        }

        $laporanId = null;
        $skriningId = null;

        $sumberType =
            $validated['sumber_type']
            ?? null;

        $sumberId =
            $validated['sumber_id']
            ?? null;

        if ($sumberType && ! $sumberId) {
            return back()
                ->withInput()
                ->withErrors([
                    'sumber_id' =>
                        'Pilih sumber rujukan yang sesuai.',
                ]);
        }

        if ($sumberType === 'laporan') {
            $laporanValid = DB::table('laporan_kasus')
                ->where('id', $sumberId)
                ->where(
                    'siswa_id',
                    $validated['siswa_id']
                )
                ->where(
                    'status_kasus',
                    '!=',
                    'draft'
                )
                ->exists();

            if (! $laporanValid) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'sumber_id' =>
                            'Laporan yang dipilih tidak sesuai dengan siswa.',
                    ]);
            }

            $laporanId = $sumberId;
        }

        if ($sumberType === 'skrining') {
            $skriningValid = DB::table('skrining_siswa')
                ->where('id', $sumberId)
                ->where(
                    'siswa_id',
                    $validated['siswa_id']
                )
                ->where(
                    'status',
                    'selesai'
                )
                ->first();

            if (! $skriningValid) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'sumber_id' =>
                            'Sesi skrining yang dipilih tidak sesuai dengan siswa.',
                    ]);
            }

            if (is_null($skriningValid->assigned_bk_id)) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'sumber_id' =>
                            'Sesi skrining ini belum diambil penanganannya. Silakan ambil penanganan terlebih dahulu.',
                    ]);
            }

            if ((int) $skriningValid->assigned_bk_id !== (int) $request->user()->id) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'sumber_id' =>
                            'Hanya Guru BK yang menangani skrining ini yang dapat membuat rujukan.',
                    ]);
            }

            $skriningId = $sumberId;
        }

        $rujukanId = DB::table('rujukan')
            ->insertGetId([
                'siswa_id' =>
                    $validated['siswa_id'],

                'layanan_id' =>
                    $validated['layanan_id'],

                'created_by_user_id' =>
                    $request->user()->id,

                'laporan_id' =>
                    $laporanId,

                'skrining_id' =>
                    $skriningId,

                'alasan_rujukan' =>
                    $validated['alasan_rujukan'],

                'status' =>
                    'baru',

                'referred_at' =>
                    now(),

                'created_at' =>
                    now(),

                'updated_at' =>
                    now(),
            ]);

        $this->notifyStudentReferral(
            $rujukanId,
            'rujukan_baru',
            'Rujukan Layanan Baru',
            'Ada rujukan layanan baru dari Guru BK. Silakan buka menu Rujukan & Bantuan untuk melihat informasi layanan dan statusnya.'
        );

        return redirect()
            ->route('guru-bk.rujukan.index')
            ->with(
                'success',
                'Rujukan siswa berhasil dibuat.'
            );
    }

    public function show(Request $request, int $rujukan)
    {
        $this->authorizeCounselor($request);

        $dataRujukan = DB::table('rujukan')
            ->join('siswa', 'rujukan.siswa_id', '=', 'siswa.id')
            ->join('users as siswa_user', 'siswa.user_id', '=', 'siswa_user.id')
            ->leftJoin('kelas', 'siswa.kelas_id', '=', 'kelas.id')
            ->join('layanan_rujukan', 'rujukan.layanan_id', '=', 'layanan_rujukan.id')
            ->join('users as creator', 'rujukan.created_by_user_id', '=', 'creator.id')
            ->leftJoin('laporan_kasus', 'rujukan.laporan_id', '=', 'laporan_kasus.id')
            ->where('rujukan.id', $rujukan)
            ->select([
                'rujukan.*',
                'siswa_user.name as nama_siswa',
                'siswa.nis',
                'siswa.whatsapp_number',
                'siswa.whatsapp_consent',
                DB::raw('COALESCE(laporan_kasus.nama_kelas_saat_laporan, kelas.nama_kelas) as nama_kelas'),
                'layanan_rujukan.nama_layanan',
                'layanan_rujukan.jenis_layanan',
                'layanan_rujukan.kontak',
                'layanan_rujukan.alamat_url',
                'creator.name as dibuat_oleh',
                'laporan_kasus.kode_laporan',
            ])
            ->first();

        abort_unless($dataRujukan, 404, 'Data rujukan tidak ditemukan.');

        $user = $request->user();

        return view('guru-bk.rujukan.show', compact('user', 'dataRujukan'));
    }

    public function edit(Request $request, int $rujukan)
    {
        $this->authorizeCounselor($request);

        $user = $request->user();

        $dataRujukan = DB::table('rujukan')
            ->where('id', $rujukan)
            ->first();

        abort_unless($dataRujukan, 404, 'Data rujukan tidak ditemukan.');
        abort_unless(
            (int) $dataRujukan->created_by_user_id === (int) $user->id,
            403,
            'Hanya Guru BK penanggung jawab yang dapat mengedit rujukan.'
        );

        $siswa = DB::table('siswa')
            ->join('users', 'siswa.user_id', '=', 'users.id')
            ->leftJoin('kelas', 'siswa.kelas_id', '=', 'kelas.id')
            ->where('users.role', 'student')
            ->where('users.is_active', true)
            ->select([
                'siswa.id',
                'users.name',
                'siswa.nis',
                'kelas.id as kelas_id',
                'kelas.nama_kelas',
                'kelas.tingkat',
                'kelas.tahun_ajaran',
            ])
            ->orderBy('kelas.tingkat')
            ->orderBy('kelas.nama_kelas')
            ->orderBy('users.name')
            ->get();

        $layanan = DB::table('layanan_rujukan')
            ->where('is_active', true)
            ->orderBy('nama_layanan')
            ->get();

        $laporan = DB::table('laporan_kasus')
            ->where('status_kasus', '!=', 'draft')
            ->select([
                'id',
                'siswa_id',
                'kode_laporan',
                'status_kasus',
                'submitted_at',
            ])
            ->orderByDesc('submitted_at')
            ->get();

        $skrining = DB::table('skrining_siswa')
            ->where('status', 'selesai')
            ->select([
                'id',
                'siswa_id',
                'completed_at',
            ])
            ->orderByDesc('completed_at')
            ->get();

        return view('guru-bk.rujukan.edit', compact(
            'user',
            'dataRujukan',
            'siswa',
            'layanan',
            'laporan',
            'skrining'
        ));
    }

    public function update(Request $request, int $rujukan)
    {
        $this->authorizeCounselor($request);

        $dataRujukan = DB::table('rujukan')
            ->where('id', $rujukan)
            ->first();

        abort_unless($dataRujukan, 404, 'Data rujukan tidak ditemukan.');
        abort_unless(
            (int) $dataRujukan->created_by_user_id === (int) $request->user()->id,
            403,
            'Hanya Guru BK penanggung jawab yang dapat mengedit rujukan.'
        );

        $validated = $request->validate([
            'siswa_id' => [
                'required',
                'integer',
                'exists:siswa,id',
            ],
            'layanan_id' => [
                'required',
                'integer',
                'exists:layanan_rujukan,id',
            ],
            'sumber_type' => [
                'nullable',
                Rule::in([
                    'laporan',
                    'skrining',
                ]),
            ],
            'sumber_id' => [
                'nullable',
                'integer',
            ],
            'alasan_rujukan' => [
                'required',
                'string',
                'min:10',
                'max:3000',
            ],
        ]);

        $layananAktif = DB::table('layanan_rujukan')
            ->where('id', $validated['layanan_id'])
            ->where('is_active', true)
            ->exists();

        if (! $layananAktif) {
            return back()
                ->withInput()
                ->withErrors([
                    'layanan_id' =>
                        'Layanan rujukan yang dipilih sedang tidak aktif.',
                ]);
        }

        $laporanId = null;
        $skriningId = null;

        $sumberType =
            $validated['sumber_type']
            ?? null;

        $sumberId =
            $validated['sumber_id']
            ?? null;

        if ($sumberType && ! $sumberId) {
            return back()
                ->withInput()
                ->withErrors([
                    'sumber_id' =>
                        'Pilih sumber rujukan yang sesuai.',
                ]);
        }

        if ($sumberType === 'laporan') {
            $laporanValid = DB::table('laporan_kasus')
                ->where('id', $sumberId)
                ->where(
                    'siswa_id',
                    $validated['siswa_id']
                )
                ->where(
                    'status_kasus',
                    '!=',
                    'draft'
                )
                ->exists();

            if (! $laporanValid) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'sumber_id' =>
                            'Laporan yang dipilih tidak sesuai dengan siswa.',
                    ]);
            }

            $laporanId = $sumberId;
        }

        if ($sumberType === 'skrining') {
            $skriningValid = DB::table('skrining_siswa')
                ->where('id', $sumberId)
                ->where(
                    'siswa_id',
                    $validated['siswa_id']
                )
                ->where(
                    'status',
                    'selesai'
                )
                ->exists();

            if (! $skriningValid) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'sumber_id' =>
                            'Sesi skrining yang dipilih tidak sesuai dengan siswa.',
                    ]);
            }

            $skriningId = $sumberId;
        }

        DB::table('rujukan')
            ->where('id', $rujukan)
            ->update([
                'siswa_id' =>
                    $validated['siswa_id'],
                'layanan_id' =>
                    $validated['layanan_id'],
                'laporan_id' =>
                    $laporanId,
                'skrining_id' =>
                    $skriningId,
                'alasan_rujukan' =>
                    $validated['alasan_rujukan'],
                'updated_at' =>
                    now(),
            ]);

        return redirect()
            ->route('guru-bk.rujukan.index')
            ->with(
                'success',
                'Rujukan siswa berhasil diperbarui.'
            );
    }

    public function destroy(Request $request, int $rujukan)
    {
        $this->authorizeCounselor($request);

        $dataRujukan = DB::table('rujukan')
            ->where('id', $rujukan)
            ->first();

        abort_unless($dataRujukan, 404, 'Data rujukan tidak ditemukan.');
        abort_unless(
            (int) $dataRujukan->created_by_user_id === (int) $request->user()->id,
            403,
            'Hanya Guru BK penanggung jawab yang dapat menghapus rujukan.'
        );

        DB::table('rujukan')->where('id', $rujukan)->delete();
        DB::table('notifikasi')
            ->where('referensi_tipe', 'rujukan')
            ->where('referensi_id', $rujukan)
            ->delete();

        return redirect()
            ->route('guru-bk.rujukan.index')
            ->with('success', 'Rujukan berhasil dihapus.');
    }

    public function exportPdf(Request $request, int $rujukan)
    {
        $this->authorizeCounselor($request);

        $dataRujukan = DB::table('rujukan')
            ->join('siswa', 'rujukan.siswa_id', '=', 'siswa.id')
            ->join('users as siswa_user', 'siswa.user_id', '=', 'siswa_user.id')
            ->leftJoin('kelas', 'siswa.kelas_id', '=', 'kelas.id')
            ->join('layanan_rujukan', 'rujukan.layanan_id', '=', 'layanan_rujukan.id')
            ->join('users as creator', 'rujukan.created_by_user_id', '=', 'creator.id')
            ->leftJoin('laporan_kasus', 'rujukan.laporan_id', '=', 'laporan_kasus.id')
            ->leftJoin('skrining_siswa', 'rujukan.skrining_id', '=', 'skrining_siswa.id')
            ->where('rujukan.id', $rujukan)
            ->select([
                'rujukan.*',
                'siswa_user.name as nama_siswa',
                'siswa.nis',
                'kelas.nama_kelas',
                'layanan_rujukan.nama_layanan',
                'layanan_rujukan.jenis_layanan',
                'layanan_rujukan.kontak',
                'creator.name as dibuat_oleh',
                'laporan_kasus.kode_laporan',
            ])
            ->first();

        abort_unless($dataRujukan, 404, 'Rujukan tidak ditemukan.');

        $pengaturan = \App\Models\PengaturanSistem::current();
        $nomorSurat = '421.3/' . str_pad($dataRujukan->id, 3, '0', STR_PAD_LEFT) . '/BK/' . date('Y');

        $html = '<!DOCTYPE html><html><head><meta charset="UTF-8"><title>Surat Rujukan Bimbingan Konseling</title>';
        $html .= '<style>
            @page { margin: 28px 32px; }
            body { font-family: DejaVu Sans, Arial, Helvetica, sans-serif; font-size: 11px; color: #172033; line-height: 1.5; margin: 0; }
            table.meta-table { width: 100%; border-collapse: collapse; margin-bottom: 16px; font-size: 11px; }
            table.meta-table td { padding: 3px 0; vertical-align: top; }
            .section-title { font-size: 11px; font-weight: bold; color: #0b6f69; margin: 12px 0 6px; text-transform: uppercase; border-bottom: 1px solid #dfe6e6; padding-bottom: 3px; }
            table.data-table { width: 100%; border-collapse: collapse; margin-bottom: 14px; font-size: 10.5px; }
            table.data-table td { padding: 5px 8px; border: 1px solid #dfe6e6; }
            table.data-table td.label-col { width: 28%; background-color: #f8fafc; font-weight: bold; color: #475467; }
        </style></head><body>';

        // Official Kop Surat
        $html .= $pengaturan->getKopSuratHtml();

        // Nomor & Perihal
        $html .= '<table class="meta-table">';
        $html .= '<tr><td style="width: 15%;">Nomor</td><td style="width: 45%;">: ' . $nomorSurat . '</td><td style="width: 40%; text-align: right;">' . ($pengaturan->alamat_sekolah ? \Illuminate\Support\Str::before($pengaturan->alamat_sekolah, ',') : 'Tempat') . ', ' . \Carbon\Carbon::parse($dataRujukan->created_at)->locale('id')->translatedFormat('d F Y') . '</td></tr>';
        $html .= '<tr><td>Lampiran</td><td>: 1 (Satu) Berkas Lembar Kasus</td><td></td></tr>';
        $html .= '<tr><td>Perihal</td><td>: <strong>Rujukan Penanganan Khusus Siswa (Alih Tangan Kasus)</strong></td><td></td></tr>';
        $html .= '</table>';

        // Penerima Rujukan
        $html .= '<div style="margin-bottom: 16px; font-size: 11px;">';
        $html .= 'Kepada Yth.<br>';
        $html .= '<strong>Pimpinan / Konselor ' . htmlspecialchars($dataRujukan->nama_layanan) . '</strong><br>';
        $html .= 'Bidang Layanan: ' . htmlspecialchars(ucwords(str_replace('_', ' ', $dataRujukan->jenis_layanan))) . '<br>';
        if ($dataRujukan->kontak) {
            $html .= 'Kontak: ' . htmlspecialchars($dataRujukan->kontak) . '<br>';
        }
        $html .= 'di Tempat</div>';

        // Pengantar
        $html .= '<p style="text-align: justify; margin-bottom: 12px; font-size: 11px;">Dengan hormat,<br>Sehubungan dengan kebutuhan penanganan komprehensif peserta didik yang memerlukan keahlian atau intervensi spesialis lebih lanjut, bersama surat ini kami menghadapkan / merujuk peserta didik satuan pendidikan kami dengan data sebagai berikut:</p>';

        // Data Siswa
        $html .= '<div class="section-title">A. IDENTITAS PESERTA DIDIK</div>';
        $html .= '<table class="data-table">';
        $html .= '<tr><td class="label-col">Nama Lengkap</td><td><strong>' . htmlspecialchars($dataRujukan->nama_siswa) . '</strong></td></tr>';
        $html .= '<tr><td class="label-col">Nomor Induk Siswa (NIS)</td><td>' . htmlspecialchars($dataRujukan->nis ?? '-') . '</td></tr>';
        $html .= '<tr><td class="label-col">Kelas / Rombel</td><td>' . htmlspecialchars($dataRujukan->nama_kelas ?? '-') . '</td></tr>';
        $html .= '<tr><td class="label-col">Satuan Pendidikan Asal</td><td>' . htmlspecialchars($pengaturan->nama_sekolah ?: 'Sekolah') . '</td></tr>';
        $html .= '</table>';

        // Deskripsi Kasus & Alasan
        $sumberLabel = $dataRujukan->laporan_id ? 'Laporan Kasus (' . $dataRujukan->kode_laporan . ')' : ($dataRujukan->skrining_id ? 'Skrining Kebutuhan Khusus (#' . $dataRujukan->skrining_id . ')' : 'Konseling Mandiri');
        $html .= '<div class="section-title">B. LATAR BELAKANG & ALASAN RUJUKAN</div>';
        $html .= '<table class="data-table">';
        $html .= '<tr><td class="label-col">Sumber Identifikasi</td><td>' . htmlspecialchars($sumberLabel) . '</td></tr>';
        $html .= '<tr><td class="label-col">Status Penanganan Awal</td><td>' . ucfirst($dataRujukan->status) . '</td></tr>';
        $html .= '<tr><td class="label-col" style="vertical-align: top;">Uraian Masalah & Rekomendasi Rujukan</td><td style="text-align: justify; line-height: 1.6;">' . nl2br(htmlspecialchars($dataRujukan->alasan_rujukan)) . '</td></tr>';
        $html .= '</table>';

        $html .= '<p style="text-align: justify; margin-bottom: 16px; font-size: 11px;">Demikian surat rujukan ini dibuat dengan penuh tanggung jawab demi kepentingan terbaik peserta didik. Atas perhatian, kerja sama, dan bantuan yang diberikan, kami sampaikan terima kasih.</p>';

        // Lembar Pengesahan (Kepala Sekolah & Guru BK)
        $html .= $pengaturan->getPengesahanHtml($dataRujukan->dibuat_oleh, 'Guru Bimbingan Konseling');

        $html .= '</body></html>';

        $fileName = 'Surat_Rujukan_' . str_replace(' ', '_', $dataRujukan->nama_siswa) . '.pdf';

        return \Barryvdh\DomPDF\Facade\Pdf::loadHTML($html)
            ->setPaper('a4', 'portrait')
            ->download($fileName);
    }

    public function updateStatus(
        Request $request,
        int $rujukan
    ) {
        $this->authorizeCounselor($request);

        $validated = $request->validate([
            'status' => [
                'required',
                Rule::in([
                    'baru',
                    'diproses',
                    'selesai',
                ]),
            ],
        ]);

        $dataRujukan = DB::table('rujukan')
            ->where('id', $rujukan)
            ->first([
                'id',
                'created_by_user_id',
                'status',
            ]);

        abort_unless(
            $dataRujukan,
            404,
            'Data rujukan tidak ditemukan.'
        );

        abort_unless(
            (int) $dataRujukan->created_by_user_id
                === (int) $request->user()->id,
            403,
            'Hanya Guru BK penanggung jawab yang dapat mengubah status rujukan.'
        );

        if (
            $dataRujukan->status
            !== $validated['status']
        ) {
            DB::table('rujukan')
                ->where('id', $rujukan)
                ->where(
                    'created_by_user_id',
                    $request->user()->id
                )
                ->update([
                    'status' =>
                        $validated['status'],

                    'updated_at' =>
                        now(),
                ]);

            $statusLabel = match (
                $validated['status']
            ) {
                'baru' => 'Baru',
                'diproses' => 'Diproses',
                'selesai' => 'Selesai',
                default => ucfirst(
                    $validated['status']
                ),
            };

            $this->notifyStudentReferral(
                $rujukan,
                'rujukan_status',
                'Status Rujukan Diperbarui',
                'Status rujukan layananmu sekarang '
                . $statusLabel
                . '. Silakan buka menu Rujukan & Bantuan untuk melihat informasi terbaru.'
            );
        }

        return back()->with(
            'success',
            'Status rujukan berhasil diperbarui.'
        );
    }

    private function notifyStudentReferral(
        int $rujukanId,
        string $tipe,
        string $judul,
        string $pesan
    ): void {
        $siswa = DB::table('rujukan')
            ->join(
                'siswa',
                'rujukan.siswa_id',
                '=',
                'siswa.id'
            )
            ->join(
                'users',
                'siswa.user_id',
                '=',
                'users.id'
            )
            ->where(
                'rujukan.id',
                $rujukanId
            )
            ->first([
                'users.id as user_id',
            ]);

        if (! $siswa) {
            return;
        }

        DB::table('notifikasi')->insert([
            'user_id' =>
                $siswa->user_id,

            'tipe' =>
                $tipe,

            'judul' =>
                $judul,

            'pesan' =>
                $pesan,

            'referensi_tipe' =>
                'rujukan',

            'referensi_id' =>
                $rujukanId,

            'read_at' =>
                null,

            'created_at' =>
                now(),

            'updated_at' =>
                now(),
        ]);
    }

    private function resolveAcademicPeriod(
        string $tahunAjaran,
        string $semester
    ): array {
        [$tahunAwal, $tahunAkhir] = array_map(
            'intval',
            explode('/', $tahunAjaran)
        );

        if ($semester === 'ganjil') {
            return [
                Carbon::create(
                    $tahunAwal,
                    7,
                    1
                )->startOfDay(),

                Carbon::create(
                    $tahunAwal,
                    12,
                    31
                )->endOfDay(),
            ];
        }

        return [
            Carbon::create(
                $tahunAkhir,
                1,
                1
            )->startOfDay(),

            Carbon::create(
                $tahunAkhir,
                6,
                30
            )->endOfDay(),
        ];
    }

    private function academicYearFromDate(
        Carbon $tanggal
    ): string {
        if ($tanggal->month >= 7) {
            return sprintf(
                '%d/%d',
                $tanggal->year,
                $tanggal->year + 1
            );
        }

        return sprintf(
            '%d/%d',
            $tanggal->year - 1,
            $tanggal->year
        );
    }
}

