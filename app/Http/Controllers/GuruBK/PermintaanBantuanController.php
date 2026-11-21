<?php

namespace App\Http\Controllers\GuruBK;

use App\Http\Controllers\Controller;
use App\Models\PengaturanSistem;
use App\Models\PermintaanBantuan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class PermintaanBantuanController extends Controller
{
    /**
     * Daftar permintaan bantuan dari siswa.
     */
    public function index(Request $request)
    {
        $user = $request->user();

        abort_unless(
            $user && $user->role === 'counselor',
            403,
            'Kamu tidak memiliki akses ke halaman Guru BK.'
        );

        /*
        |--------------------------------------------------------------------------
        | Periode Akademik
        |--------------------------------------------------------------------------
        |
        | Permintaan bantuan belum memiliki kolom snapshot tahun ajaran
        | dan semester. Karena itu periode historis ditentukan dari waktu
        | permintaan benar-benar dikirim.
        */

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

        /*
         * Tahun ajaran lama tetap tersedia selama pernah ada
         * permintaan bantuan pada periode tersebut.
         */
        $tahunAjaranOptions = DB::table('permintaan_bantuan')
            ->selectRaw(
                'COALESCE(submitted_at, created_at) as tanggal_permintaan'
            )
            ->whereNotNull(
                DB::raw(
                    'COALESCE(submitted_at, created_at)'
                )
            )
            ->pluck('tanggal_permintaan')
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

        /*
        |--------------------------------------------------------------------------
        | Filter Lain
        |--------------------------------------------------------------------------
        */

        $search = trim((string) $request->query('q', ''));
        $status = (string) $request->query('status', '');
        $jenis = (string) $request->query('jenis', '');

        $tanggalSql =
            'COALESCE('
            . 'permintaan_bantuan.submitted_at, '
            . 'permintaan_bantuan.created_at'
            . ')';

        $query = DB::table('permintaan_bantuan')
            ->join(
                'siswa',
                'permintaan_bantuan.siswa_id',
                '=',
                'siswa.id'
            )
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
            ->whereBetween(
                DB::raw($tanggalSql),
                [
                    $startDate,
                    $endDate,
                ]
            )
            ->select([
                'permintaan_bantuan.id',
                'permintaan_bantuan.jenis_bantuan',
                'permintaan_bantuan.pesan',
                'permintaan_bantuan.status',
                'permintaan_bantuan.submitted_at',
                'permintaan_bantuan.created_at',
                'users.name as nama_siswa',
                'users.email as email_siswa',
                'siswa.nis',
                'kelas.nama_kelas',
            ]);

        if ($search !== '') {
            $query->where(function ($subQuery) use ($search) {
                $subQuery
                    ->where(
                        'users.name',
                        'like',
                        '%' . $search . '%'
                    )
                    ->orWhere(
                        'siswa.nis',
                        'like',
                        '%' . $search . '%'
                    )
                    ->orWhere(
                        'permintaan_bantuan.pesan',
                        'like',
                        '%' . $search . '%'
                    );
            });
        }

        $statusDiperbolehkan = [
            'baru',
            'diproses',
            'selesai',
        ];

        if (in_array($status, $statusDiperbolehkan, true)) {
            $query->where(
                'permintaan_bantuan.status',
                $status
            );
        }

        $jenisDiperbolehkan = [
            'pendampingan',
            'perundungan',
            'pribadi',
            'akademik',
            'lainnya',
        ];

        if (in_array($jenis, $jenisDiperbolehkan, true)) {
            $query->where(
                'permintaan_bantuan.jenis_bantuan',
                $jenis
            );
        }

        $permintaan = $query
            ->orderByDesc(
                DB::raw($tanggalSql)
            )
            ->orderByDesc(
                'permintaan_bantuan.id'
            )
            ->paginate(10)
            ->withQueryString();

        /*
        |--------------------------------------------------------------------------
        | Ringkasan Periode
        |--------------------------------------------------------------------------
        */

        $ringkasanBase = DB::table('permintaan_bantuan')
            ->whereBetween(
                DB::raw(
                    'COALESCE(submitted_at, created_at)'
                ),
                [
                    $startDate,
                    $endDate,
                ]
            );

        $ringkasan = [
            'total' =>
                (clone $ringkasanBase)->count(),

            'baru' =>
                (clone $ringkasanBase)
                    ->where('status', 'baru')
                    ->count(),

            'diproses' =>
                (clone $ringkasanBase)
                    ->where('status', 'diproses')
                    ->count(),

            'selesai' =>
                (clone $ringkasanBase)
                    ->where('status', 'selesai')
                    ->count(),
        ];

        return view(
            'guru-bk.bantuan.index',
            compact(
                'user',
                'permintaan',
                'ringkasan',
                'search',
                'status',
                'jenis',
                'tahunAjaran',
                'semester',
                'tahunAjaranOptions',
                'startDate',
                'endDate'
            )
        );
    }

    /**
     * Menampilkan detail permintaan bantuan.
     */
    public function show(Request $request, int $permintaan)
    {
        $user = $request->user();

        abort_unless(
            $user && $user->role === 'counselor',
            403,
            'Kamu tidak memiliki akses ke halaman Guru BK.'
        );

        $dataPermintaan = DB::table('permintaan_bantuan')
            ->join('siswa', 'permintaan_bantuan.siswa_id', '=', 'siswa.id')
            ->join('users', 'siswa.user_id', '=', 'users.id')
            ->leftJoin('kelas', 'siswa.kelas_id', '=', 'kelas.id')
            ->leftJoin('users as assigned_bk', 'permintaan_bantuan.assigned_bk_id', '=', 'assigned_bk.id')
            ->where('permintaan_bantuan.id', $permintaan)
            ->select([
                'permintaan_bantuan.*',
                'users.name as nama_siswa',
                'siswa.nis',
                'kelas.nama_kelas',
                'assigned_bk.name as nama_bk_penanggung_jawab',
            ])
            ->first();

        abort_unless($dataPermintaan, 404, 'Permintaan bantuan tidak ditemukan.');

        $jenisLabel = [
            'pendampingan' => 'Pendampingan Terjadwal',
            'perundungan' => 'Masalah Perundungan',
            'pribadi' => 'Masalah Pribadi',
            'akademik' => 'Kesulitan Akademik',
            'lainnya' => 'Lainnya',
        ];

        $riwayatKonseling = DB::table('catatan_konseling')
            ->join('users', 'catatan_konseling.guru_bk_id', '=', 'users.id')
            ->where('catatan_konseling.bantuan_id', $permintaan)
            ->select([
                'catatan_konseling.*',
                'users.name as nama_guru_bk',
            ])
            ->orderByDesc('catatan_konseling.tanggal_pertemuan')
            ->orderByDesc('catatan_konseling.id')
            ->get();

        return view('guru-bk.bantuan.show', compact('user', 'dataPermintaan', 'jenisLabel', 'riwayatKonseling'));
    }

    public function exportDetailPdf(Request $request, int $permintaan)
    {
        $user = $request->user();

        abort_unless(
            $user && $user->role === 'counselor',
            403,
            'Kamu tidak memiliki akses ke halaman Guru BK.'
        );

        $dataPermintaan = DB::table('permintaan_bantuan')
            ->join('siswa', 'permintaan_bantuan.siswa_id', '=', 'siswa.id')
            ->join('users', 'siswa.user_id', '=', 'users.id')
            ->leftJoin('kelas', 'siswa.kelas_id', '=', 'kelas.id')
            ->where('permintaan_bantuan.id', $permintaan)
            ->select([
                'permintaan_bantuan.*',
                'users.name as nama_siswa',
                'siswa.nis',
                'kelas.nama_kelas',
            ])
            ->first();

        abort_unless($dataPermintaan, 404, 'Permintaan bantuan tidak ditemukan.');

        $jenisLabel = [
            'pendampingan' => 'Pendampingan Terjadwal',
            'perundungan' => 'Masalah Perundungan',
            'pribadi' => 'Masalah Pribadi',
            'akademik' => 'Kesulitan Akademik',
            'lainnya' => 'Lainnya'
        ];

        // HTML string for PDF using basic inline styles because it's MPDF / DomPDF
        $html = '<h2 style="text-align: center; margin-bottom: 20px;">Detail Permintaan Bantuan Siswa</h2>';
        $html .= '<hr style="margin-bottom: 20px;">';
        
        $html .= '<h3>Informasi Siswa</h3>';
        $html .= '<table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">';
        $html .= '<tr><td style="width: 30%; padding: 5px;">Nama Lengkap</td><td>: ' . htmlspecialchars($dataPermintaan->nama_siswa) . '</td></tr>';
        $html .= '<tr><td style="padding: 5px;">NIS</td><td>: ' . htmlspecialchars($dataPermintaan->nis ?? '-') . '</td></tr>';
        $html .= '<tr><td style="padding: 5px;">Kelas</td><td>: ' . htmlspecialchars($dataPermintaan->nama_kelas ?? '-') . '</td></tr>';
        $html .= '</table>';

        $html .= '<h3>Isi Keluhan</h3>';
        $html .= '<table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">';
        $html .= '<tr><td style="width: 30%; padding: 5px;">Kategori</td><td>: ' . htmlspecialchars($jenisLabel[$dataPermintaan->jenis_bantuan] ?? 'Lainnya') . '</td></tr>';
        $html .= '<tr><td style="padding: 5px;">Status Penanganan</td><td>: ' . ucfirst($dataPermintaan->status) . '</td></tr>';
        $html .= '<tr><td style="padding: 5px; vertical-align: top;">Pesan</td><td>: ' . nl2br(htmlspecialchars($dataPermintaan->pesan)) . '</td></tr>';
        $html .= '</table>';

        $html .= '<div style="margin-top: 50px; text-align: right;">';
        $html .= '<p>Dikirim pada: ' . \Carbon\Carbon::parse($dataPermintaan->submitted_at ?? $dataPermintaan->created_at)->format('d M Y H:i') . '</p>';
        $html .= '<br><br><br>';
        $html .= '<p><strong>' . htmlspecialchars($user->name) . '</strong><br>Guru Bimbingan Konseling</p>';
        $html .= '</div>';

        $fileName = 'Permintaan_Bantuan_' . str_replace(' ', '_', $dataPermintaan->nama_siswa) . '.pdf';

        return \Barryvdh\DomPDF\Facade\Pdf::loadHTML($html)
            ->setPaper('a4', 'portrait')
            ->download($fileName);
    }


    /**
     * Memperbarui status permintaan bantuan.
     */
    public function updateStatus(
        Request $request,
        int $permintaan
    ) {
        $user = $request->user();

        abort_unless(
            $user && $user->role === 'counselor',
            403,
            'Kamu tidak memiliki akses ke halaman Guru BK.'
        );

        $validated = $request->validate([
            'status' => [
                'required',
                Rule::in([
                    'baru',
                    'diproses',
                    'selesai',
                ]),
            ],

            'return_tahun_ajaran' => [
                'nullable',
                'regex:/^\d{4}\/\d{4}$/',
            ],

            'return_semester' => [
                'nullable',
                Rule::in([
                    'ganjil',
                    'genap',
                ]),
            ],

            'return_q' => [
                'nullable',
                'string',
                'max:255',
            ],

            'return_status' => [
                'nullable',
                Rule::in([
                    'baru',
                    'diproses',
                    'selesai',
                ]),
            ],

            'return_jenis' => [
                'nullable',
                Rule::in([
                    'pendampingan',
                    'perundungan',
                    'pribadi',
                    'akademik',
                    'lainnya',
                ]),
            ],
        ]);

        $bantuan = DB::table('permintaan_bantuan')
            ->where('id', $permintaan)
            ->first();

        abort_unless(
            $bantuan,
            404,
            'Permintaan bantuan tidak ditemukan.'
        );

        if (! is_null($bantuan->assigned_bk_id) && (int) $bantuan->assigned_bk_id !== (int) $user->id) {
            return back()->withErrors(['status' => 'Permintaan bantuan ini ditangani oleh Guru BK lain.']);
        }

        $updatePayload = [
            'status' => $validated['status'],
            'updated_at' => now(),
        ];

        if (is_null($bantuan->assigned_bk_id) && in_array($validated['status'], ['diproses', 'selesai'])) {
            $updatePayload['assigned_bk_id'] = $user->id;
        }

        $bantuanModel = PermintaanBantuan::find($permintaan);
        if ($bantuanModel) {
            $bantuanModel->update($updatePayload);
        } else {
            DB::table('permintaan_bantuan')
                ->where('id', $permintaan)
                ->update($updatePayload);
        }

        /*
         * Kembalikan Guru BK ke periode dan filter yang sama
         * setelah status diperbarui.
         */
        $returnQuery = array_filter(
            [
                'tahun_ajaran' =>
                    $validated['return_tahun_ajaran']
                    ?? null,

                'semester' =>
                    $validated['return_semester']
                    ?? null,

                'q' =>
                    $validated['return_q']
                    ?? null,

                'status' =>
                    $validated['return_status']
                    ?? null,

                'jenis' =>
                    $validated['return_jenis']
                    ?? null,
            ],
            fn ($value) =>
                $value !== null
                && $value !== ''
        );

        if ($request->boolean('return_to_show')) {
            return redirect()
                ->route('guru-bk.bantuan.show', $permintaan)
                ->with(
                    'success',
                    'Status permintaan bantuan berhasil diperbarui.'
                );
        }

        return redirect()
            ->route(
                'guru-bk.bantuan.index',
                $returnQuery
            )
            ->with(
                'success',
                'Status permintaan bantuan berhasil diperbarui.'
            );
    }


    /**
     * Mengubah tahun ajaran + semester menjadi rentang tanggal.
     */
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


    /**
     * Menentukan tahun ajaran dari satu tanggal aktivitas.
     *
     * Juli-Desember masuk tahun ajaran Y/Y+1.
     * Januari-Juni masuk tahun ajaran Y-1/Y.
     */
    private function academicYearFromDate(Carbon $tanggal): string
    {
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

