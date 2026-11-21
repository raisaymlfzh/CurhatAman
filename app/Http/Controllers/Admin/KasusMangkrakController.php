<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PengaturanSistem;
use App\Support\AuditLogger;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class KasusMangkrakController extends Controller
{
    private function staleDays(): int
    {
        return max(
            1,
            (int) PengaturanSistem::current()->batas_kasus_mangkrak
        );
    }

    private function cutoff(): Carbon
    {
        return now()->subDays($this->staleDays());
    }

    public function index(Request $request)
    {
        $user = $request->user();

        abort_unless(
            $user && $user->role === 'admin',
            403,
            'Kamu tidak memiliki akses ke halaman Admin.'
        );

        $q = trim((string) $request->query('q', ''));
        $status = trim((string) $request->query('status', ''));
        $bk = trim((string) $request->query('bk', ''));

        $staleDays = $this->staleDays();
        $cutoff = $this->cutoff();

        $query = DB::table('laporan_kasus')
            ->join(
                'siswa',
                'laporan_kasus.siswa_id',
                '=',
                'siswa.id'
            )
            ->join(
                'users as pelapor',
                'siswa.user_id',
                '=',
                'pelapor.id'
            )
            ->leftJoin(
                'kelas',
                'siswa.kelas_id',
                '=',
                'kelas.id'
            )
            ->join(
                'kategori_kasus',
                'laporan_kasus.kategori_id',
                '=',
                'kategori_kasus.id'
            )
            ->leftJoin(
                'users as assigned_bk',
                'laporan_kasus.assigned_bk_id',
                '=',
                'assigned_bk.id'
            )
            ->whereIn(
                'laporan_kasus.status_kasus',
                ['baru', 'diproses']
            )
            ->where(
                'laporan_kasus.updated_at',
                '<=',
                $cutoff
            )
            ->select([
                'laporan_kasus.id',
                'laporan_kasus.kode_laporan',
                'laporan_kasus.status_kasus',
                'laporan_kasus.status_rahasia',
                'laporan_kasus.assigned_bk_id',
                'laporan_kasus.updated_at',
                'laporan_kasus.submitted_at',
                'kategori_kasus.nama_kategori',
                'kelas.nama_kelas',
                'assigned_bk.name as nama_bk',
            ]);

        if ($q !== '') {
            $query->where(function ($subQuery) use ($q) {
                $subQuery
                    ->where(
                        'laporan_kasus.kode_laporan',
                        'like',
                        '%' . $q . '%'
                    )
                    ->orWhere(
                        'kategori_kasus.nama_kategori',
                        'like',
                        '%' . $q . '%'
                    )
                    ->orWhere(
                        'kelas.nama_kelas',
                        'like',
                        '%' . $q . '%'
                    )
                    ->orWhere(
                        'assigned_bk.name',
                        'like',
                        '%' . $q . '%'
                    );
            });
        }

        $allowedStatus = [
            'baru',
            'diproses',
        ];

        if (
            $status !== ''
            && in_array($status, $allowedStatus, true)
        ) {
            $query->where(
                'laporan_kasus.status_kasus',
                $status
            );
        }

        if ($bk === 'assigned') {
            $query->whereNotNull(
                'laporan_kasus.assigned_bk_id'
            );
        } elseif ($bk === 'unassigned') {
            $query->whereNull(
                'laporan_kasus.assigned_bk_id'
            );
        }

        $laporan = $query
            ->orderBy('laporan_kasus.updated_at')
            ->paginate(10)
            ->withQueryString();

        $laporan->getCollection()->transform(
            function ($item) {
                $item->hari_tidak_diperbarui =
                    Carbon::parse($item->updated_at)
                        ->startOfDay()
                        ->diffInDays(now()->startOfDay());

                return $item;
            }
        );

        $baseRingkasan = DB::table('laporan_kasus')
            ->whereIn(
                'status_kasus',
                ['baru', 'diproses']
            )
            ->where('updated_at', '<=', $cutoff);

        $oldestUpdatedAt = (clone $baseRingkasan)
            ->min('updated_at');

        $ringkasan = [
            'total' => (clone $baseRingkasan)->count(),

            'dengan_bk' => (clone $baseRingkasan)
                ->whereNotNull('assigned_bk_id')
                ->count(),

            'tanpa_bk' => (clone $baseRingkasan)
                ->whereNull('assigned_bk_id')
                ->count(),

            'terlama_hari' => $oldestUpdatedAt
                ? Carbon::parse($oldestUpdatedAt)
                    ->startOfDay()
                    ->diffInDays(now()->startOfDay())
                : 0,
        ];

        return view(
            'admin.kasus-mangkrak.index',
            compact(
                'user',
                'laporan',
                'ringkasan',
                'q',
                'status',
                'bk',
                'staleDays'
            )
        );
    }

    public function show(
        Request $request,
        int $laporan
    ) {
        $user = $request->user();

        abort_unless(
            $user && $user->role === 'admin',
            403,
            'Kamu tidak memiliki akses ke halaman Admin.'
        );

        $staleDays = $this->staleDays();
        $cutoff = $this->cutoff();

        $detail = DB::table('laporan_kasus')
            ->join(
                'siswa',
                'laporan_kasus.siswa_id',
                '=',
                'siswa.id'
            )
            ->join(
                'users as pelapor',
                'siswa.user_id',
                '=',
                'pelapor.id'
            )
            ->leftJoin(
                'kelas',
                'siswa.kelas_id',
                '=',
                'kelas.id'
            )
            ->join(
                'kategori_kasus',
                'laporan_kasus.kategori_id',
                '=',
                'kategori_kasus.id'
            )
            ->leftJoin(
                'users as assigned_bk',
                'laporan_kasus.assigned_bk_id',
                '=',
                'assigned_bk.id'
            )
            ->where('laporan_kasus.id', $laporan)
            ->whereIn(
                'laporan_kasus.status_kasus',
                ['baru', 'diproses', 'dieskalasi']
            )
            ->where(
                'laporan_kasus.updated_at',
                '<=',
                $cutoff
            )
            ->select([
                'laporan_kasus.id',
                'laporan_kasus.kode_laporan',
                'laporan_kasus.tanggal_kejadian',
                'laporan_kasus.lokasi_kejadian',
                'laporan_kasus.deskripsi',
                'laporan_kasus.status_rahasia',
                'laporan_kasus.status_kasus',
                'laporan_kasus.assigned_bk_id',
                'laporan_kasus.submitted_at',
                'laporan_kasus.resolved_at',
                'laporan_kasus.created_at',
                'laporan_kasus.updated_at',
                'pelapor.name as nama_siswa',
                'pelapor.email as email_siswa',
                'siswa.nis',
                'siswa.tahun_masuk',
                'kelas.nama_kelas',
                'kelas.tahun_ajaran',
                'kategori_kasus.nama_kategori',
                'assigned_bk.name as nama_bk_penanggung_jawab',
            ])
            ->first();

        abort_unless(
            $detail,
            404,
            'Kasus mangkrak tidak ditemukan.'
        );

        $detail->hari_tidak_diperbarui =
            Carbon::parse($detail->updated_at)
                ->startOfDay()
                ->diffInDays(now()->startOfDay());

        $bukti = DB::table('bukti_laporan')
            ->where('laporan_id', $laporan)
            ->orderBy('created_at')
            ->get();

        $tindakLanjut = DB::table('tindak_lanjut')
            ->join(
                'users',
                'tindak_lanjut.user_id',
                '=',
                'users.id'
            )
            ->where(
                'tindak_lanjut.laporan_id',
                $laporan
            )
            ->select([
                'tindak_lanjut.id',
                'tindak_lanjut.status',
                'tindak_lanjut.catatan',
                'tindak_lanjut.tanggal',
                'tindak_lanjut.created_at',
                'users.name as nama_petugas',
            ])
            ->orderByDesc('tindak_lanjut.tanggal')
            ->orderByDesc('tindak_lanjut.id')
            ->get();

        $guruBkTersedia = DB::table('users')
            ->where('role', 'counselor')
            ->where('is_active', true)
            ->where(
                'id',
                '!=',
                (int) ($detail->assigned_bk_id ?? 0)
            )
            ->whereNotExists(
                function ($query) use ($laporan) {
                    $query
                        ->select(DB::raw(1))
                        ->from('konflik_kepentingan')
                        ->whereColumn(
                            'konflik_kepentingan.user_id',
                            'users.id'
                        )
                        ->where(
                            'konflik_kepentingan.laporan_id',
                            $laporan
                        )
                        ->where(
                            'konflik_kepentingan.ada_konflik',
                            true
                        );
                }
            )
            ->orderBy('name')
            ->get([
                'id',
                'name',
                'email',
            ]);

        return view(
            'admin.kasus-mangkrak.show',
            compact(
                'user',
                'detail',
                'bukti',
                'tindakLanjut',
                'guruBkTersedia',
                'staleDays'
            )
        );
    }

    public function reassign(
        Request $request,
        int $laporan
    ) {
        $user = $request->user();

        abort_unless(
            $user && $user->role === 'admin',
            403,
            'Kamu tidak memiliki akses ke halaman Admin.'
        );

        $validated = $request->validate([
            'assigned_bk_id' => [
                'required',
                'integer',
                Rule::exists('users', 'id')
                    ->where(
                        fn ($query) =>
                            $query
                                ->where('role', 'counselor')
                                ->where('is_active', true)
                    ),
            ],
        ], [
            'assigned_bk_id.required' =>
                'Pilih Guru BK yang akan menerima penanganan.',
            'assigned_bk_id.exists' =>
                'Guru BK yang dipilih tidak tersedia atau tidak aktif.',
        ]);

        $targetBkId = (int) $validated['assigned_bk_id'];
        $cutoff = $this->cutoff();

        $result = DB::transaction(
            function () use (
                $laporan,
                $targetBkId,
                $user,
                $cutoff
            ) {
                $kasus = DB::table('laporan_kasus')
                    ->where('id', $laporan)
                    ->whereIn(
                        'status_kasus',
                        ['baru', 'diproses', 'dieskalasi']
                    )
                    ->where('updated_at', '<=', $cutoff)
                    ->lockForUpdate()
                    ->first([
                        'id',
                        'kode_laporan',
                        'assigned_bk_id',
                        'status_kasus',
                    ]);

                abort_unless(
                    $kasus,
                    404,
                    'Kasus mangkrak tidak ditemukan.'
                );

                if (
                    (int) $kasus->assigned_bk_id
                    === $targetBkId
                ) {
                    return [
                        'status' => 'same',
                        'kode' => $kasus->kode_laporan,
                    ];
                }

                $targetBk = DB::table('users')
                    ->where('id', $targetBkId)
                    ->where('role', 'counselor')
                    ->where('is_active', true)
                    ->first([
                        'id',
                        'name',
                    ]);

                abort_unless(
                    $targetBk,
                    422,
                    'Guru BK yang dipilih tidak tersedia.'
                );

                $punyaKonflik = DB::table(
                    'konflik_kepentingan'
                )
                    ->where('laporan_id', $laporan)
                    ->where('user_id', $targetBkId)
                    ->where('ada_konflik', true)
                    ->exists();

                if ($punyaKonflik) {
                    return [
                        'status' => 'conflict',
                        'kode' => $kasus->kode_laporan,
                    ];
                }

                $oldBkId = $kasus->assigned_bk_id
                    ? (int) $kasus->assigned_bk_id
                    : null;

                DB::table('laporan_kasus')
                    ->where('id', $laporan)
                    ->update([
                        'assigned_bk_id' => $targetBkId,
                        'updated_at' => now(),
                    ]);

                DB::table('notifikasi')->insert([
                    'user_id' => $targetBkId,
                    'tipe' => 'penugasan_kasus_mangkrak',
                    'judul' => 'Penugasan Kasus Mangkrak',
                    'pesan' =>
                        'Admin menugaskan kamu menangani laporan '
                        . $kasus->kode_laporan
                        . ' yang memerlukan tindak lanjut.',
                    'referensi_tipe' => 'laporan_kasus',
                    'referensi_id' => $laporan,
                    'read_at' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                if (
                    $oldBkId
                    && $oldBkId !== $targetBkId
                ) {
                    DB::table('notifikasi')->insert([
                        'user_id' => $oldBkId,
                        'tipe' => 'pengalihan_kasus_mangkrak',
                        'judul' => 'Penanganan Kasus Dialihkan',
                        'pesan' =>
                            'Penanganan laporan '
                            . $kasus->kode_laporan
                            . ' telah dialihkan oleh Admin '
                            . 'ke Guru BK lain.',
                        'referensi_tipe' => 'laporan_kasus',
                        'referensi_id' => $laporan,
                        'read_at' => null,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }

                return [
                    'status' => 'reassigned',
                    'kode' => $kasus->kode_laporan,
                    'target_name' => $targetBk->name,
                    'old_bk_id' => $oldBkId,
                    'target_bk_id' => $targetBkId,
                    'old_status' => $kasus->status_kasus,
                ];
            }
        );

        if ($result['status'] === 'same') {
            return redirect()
                ->route(
                    'admin.kasus-mangkrak.show',
                    $laporan
                )
                ->withErrors([
                    'assigned_bk_id' =>
                        'Guru BK tersebut sudah menjadi '
                        . 'penanggung jawab kasus ini.',
                ]);
        }

        if ($result['status'] === 'conflict') {
            return redirect()
                ->route(
                    'admin.kasus-mangkrak.show',
                    $laporan
                )
                ->withErrors([
                    'assigned_bk_id' =>
                        'Guru BK tersebut pernah menyatakan '
                        . 'konflik kepentingan pada kasus ini.',
                ]);
        }

        AuditLogger::record(
            $request,
            $user,
            'case_reassigned',
            'Mengalihkan penanganan kasus mangkrak kepada Guru BK lain.',
            'laporan_kasus',
            $laporan,
            $result['kode'],
            [
                'reason' => 'kasus_mangkrak',
                'old_bk_id' => $result['old_bk_id'],
                'new_bk_id' => $result['target_bk_id'],
                'status_kasus' => $result['old_status'],
            ]
        );

        return redirect()
            ->route('admin.kasus-mangkrak.index')
            ->with(
                'success',
                'Penanganan '
                . $result['kode']
                . ' berhasil dialihkan kepada '
                . $result['target_name']
                . '. Perhitungan waktu mangkrak dimulai ulang '
                . 'karena kasus telah diperbarui.'
            );
    }
}
