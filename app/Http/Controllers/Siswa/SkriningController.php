<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\JawabanSkrining;
use App\Models\PengaturanSistem;
use App\Models\PertanyaanSkrining;
use App\Models\Siswa;
use App\Models\SkriningSiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class SkriningController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        abort_unless(
            $user && $user->role === 'student',
            403,
            'Kamu tidak memiliki akses ke halaman siswa.'
        );

        $siswa = $user->siswa;

        abort_unless(
            $siswa,
            403,
            'Data siswa tidak ditemukan.'
        );

        $sudahSelesaiBulanIni = SkriningSiswa::where(
                'siswa_id',
                $siswa->id
            )
            ->where(
                'status',
                'selesai'
            )
            ->whereYear(
                'completed_at',
                now()->year
            )
            ->whereMonth(
                'completed_at',
                now()->month
            )
            ->exists();

        if ($sudahSelesaiBulanIni) {
            return redirect()
                ->route('siswa.dashboard')
                ->with(
                    'info',
                    'Kamu sudah menyelesaikan skrining bulan ini.'
                );
        }

        $paketAktif = DB::table('paket_skrining')
            ->where('is_active', true)
            ->orderByDesc('updated_at')
            ->orderByDesc('id')
            ->first();

        abort_unless(
            $paketAktif,
            404,
            'Paket skrining aktif belum tersedia.'
        );

        $snapshotAkademik = $this->getSnapshotAkademik(
            $siswa
        );

        $skrining = SkriningSiswa::firstOrCreate(
            [
                'siswa_id' => $siswa->id,
                'status' => 'berlangsung',
            ],
            [
                'started_at' => now(),
                'kelas_id_saat_skrining' =>
                    $snapshotAkademik[
                        'kelas_id_saat_skrining'
                    ],
                'nama_kelas_saat_skrining' =>
                    $snapshotAkademik[
                        'nama_kelas_saat_skrining'
                    ],
                'tingkat_saat_skrining' =>
                    $snapshotAkademik[
                        'tingkat_saat_skrining'
                    ],
                'tahun_ajaran' =>
                    $snapshotAkademik[
                        'tahun_ajaran'
                    ],
                'semester' =>
                    $snapshotAkademik[
                        'semester'
                    ],
            ]
        );

        $this->ensureSnapshotAkademik(
            $skrining,
            $siswa
        );

        $pertanyaanAktif = PertanyaanSkrining::where(
                'paket_skrining_id',
                $paketAktif->id
            )
            ->where('is_active', true)
            ->orderBy('nomor')
            ->get();

        $totalPertanyaan = $pertanyaanAktif->count();

        abort_if(
            $totalPertanyaan === 0,
            404,
            'Pertanyaan skrining belum tersedia.'
        );

        $nomor = (int) $request->query(
            'nomor',
            1
        );

        if ($nomor < 1) {
            $nomor = 1;
        }

        if ($nomor > $totalPertanyaan) {
            $nomor = $totalPertanyaan;
        }

        $pertanyaan = $pertanyaanAktif
            ->firstWhere(
                'nomor',
                $nomor
            );

        abort_unless(
            $pertanyaan,
            404,
            'Pertanyaan skrining tidak ditemukan.'
        );

        $jawabanTersimpan = JawabanSkrining::where(
                'skrining_id',
                $skrining->id
            )
            ->where(
                'pertanyaan_id',
                $pertanyaan->id
            )
            ->value('jawaban');

        $aspekLabels = [
            'E' => 'Gejala Emosional',
            'C' => 'Masalah Perilaku',
            'H' => 'Hiperaktivitas',
            'P' => 'Masalah Teman Sebaya',
            'Pro' => 'Perilaku Prososial',
            'gejala_emosional' => 'Gejala Emosional',
            'masalah_perilaku' => 'Masalah Perilaku',
            'hiperaktivitas' => 'Hiperaktivitas',
            'teman_sebaya' => 'Masalah Teman Sebaya',
            'prososial' => 'Perilaku Prososial',
        ];

        $progress = (
            $nomor
            / $totalPertanyaan
        ) * 100;

        $sebelumnya = $nomor > 1
            ? $nomor - 1
            : null;

        $selanjutnya = $nomor < $totalPertanyaan
            ? $nomor + 1
            : null;

        return view(
            'siswa.skrining.index',
            compact(
                'pertanyaan',
                'totalPertanyaan',
                'nomor',
                'progress',
                'sebelumnya',
                'selanjutnya',
                'aspekLabels',
                'jawabanTersimpan',
                'skrining',
                'paketAktif'
            )
        );
    }

    public function history(Request $request)
    {
        $user = $request->user();

        abort_unless(
            $user && $user->role === 'student',
            403,
            'Kamu tidak memiliki akses ke halaman siswa.'
        );

        $siswa = $user->siswa;

        abort_unless(
            $siswa,
            403,
            'Data siswa tidak ditemukan.'
        );

        $riwayatSkrining = SkriningSiswa::where(
                'siswa_id',
                $siswa->id
            )
            ->where(
                'status',
                'selesai'
            )
            ->whereNotNull(
                'completed_at'
            )
            ->orderByDesc(
                'completed_at'
            )
            ->paginate(12);

        return view(
            'siswa.skrining.riwayat',
            compact(
                'riwayatSkrining'
            )
        );
    }

    public function storeAnswer(Request $request)
    {
        $user = $request->user();

        abort_unless(
            $user && $user->role === 'student',
            403,
            'Kamu tidak memiliki akses ke halaman siswa.'
        );

        $siswa = $user->siswa;

        abort_unless(
            $siswa,
            403,
            'Data siswa tidak ditemukan.'
        );

        $paketAktif = DB::table('paket_skrining')
            ->where('is_active', true)
            ->orderByDesc('updated_at')
            ->orderByDesc('id')
            ->first();

        abort_unless(
            $paketAktif,
            404,
            'Paket skrining aktif belum tersedia.'
        );

        $validated = $request->validate([
            'pertanyaan_id' => [
                'required',
                Rule::exists(
                    'pertanyaan_skrining',
                    'id'
                )->where(
                    fn ($query) => $query
                        ->where(
                            'paket_skrining_id',
                            $paketAktif->id
                        )
                        ->where(
                            'is_active',
                            true
                        )
                ),
            ],
            'jawaban' => [
                'required',
                'integer',
                'in:0,1,2',
            ],
            'nomor' => [
                'required',
                'integer',
                'min:1',
            ],
        ]);

        $snapshotAkademik = $this->getSnapshotAkademik(
            $siswa
        );

        $skrining = SkriningSiswa::firstOrCreate(
            [
                'siswa_id' => $siswa->id,
                'status' => 'berlangsung',
            ],
            [
                'started_at' => now(),
                'kelas_id_saat_skrining' =>
                    $snapshotAkademik[
                        'kelas_id_saat_skrining'
                    ],
                'nama_kelas_saat_skrining' =>
                    $snapshotAkademik[
                        'nama_kelas_saat_skrining'
                    ],
                'tingkat_saat_skrining' =>
                    $snapshotAkademik[
                        'tingkat_saat_skrining'
                    ],
                'tahun_ajaran' =>
                    $snapshotAkademik[
                        'tahun_ajaran'
                    ],
                'semester' =>
                    $snapshotAkademik[
                        'semester'
                    ],
            ]
        );

        $this->ensureSnapshotAkademik(
            $skrining,
            $siswa
        );

        JawabanSkrining::updateOrCreate(
            [
                'skrining_id' => $skrining->id,
                'pertanyaan_id' =>
                    $validated['pertanyaan_id'],
            ],
            [
                'jawaban' =>
                    $validated['jawaban'],
            ]
        );

        $totalPertanyaan = PertanyaanSkrining::where(
                'paket_skrining_id',
                $paketAktif->id
            )
            ->where('is_active', true)
            ->count();

        if (
            $validated['nomor']
            >= $totalPertanyaan
        ) {
            $jumlahJawaban = DB::table(
                    'jawaban_skrining'
                )
                ->join(
                    'pertanyaan_skrining',
                    'jawaban_skrining.pertanyaan_id',
                    '=',
                    'pertanyaan_skrining.id'
                )
                ->where(
                    'jawaban_skrining.skrining_id',
                    $skrining->id
                )
                ->where(
                    'pertanyaan_skrining.paket_skrining_id',
                    $paketAktif->id
                )
                ->where(
                    'pertanyaan_skrining.is_active',
                    true
                )
                ->distinct(
                    'jawaban_skrining.pertanyaan_id'
                )
                ->count(
                    'jawaban_skrining.pertanyaan_id'
                );

            if (
                $jumlahJawaban
                < $totalPertanyaan
            ) {
                return redirect()
                    ->route(
                        'siswa.skrining.index'
                    )
                    ->withErrors([
                        'jawaban' =>
                            'Masih ada pertanyaan yang belum dijawab.',
                    ]);
            }

            $this->ensureSnapshotAkademik(
                $skrining,
                $siswa
            );

            $skrining->update([
                'status' => 'selesai',
                'completed_at' => now(),
            ]);

            return redirect()
                ->route('siswa.dashboard')
                ->with(
                    'success',
                    'Skrining berhasil diselesaikan.'
                );
        }

        return redirect()->route(
            'siswa.skrining.index',
            [
                'nomor' =>
                    $validated['nomor'] + 1,
            ]
        );
    }

    private function getSnapshotAkademik(
        Siswa $siswa
    ): array {
        $siswa->loadMissing('kelas');

        $pengaturan = PengaturanSistem::current();

        return [
            'kelas_id_saat_skrining' =>
                $siswa->kelas_id,

            'nama_kelas_saat_skrining' =>
                $siswa->kelas?->nama_kelas,

            'tingkat_saat_skrining' =>
                $siswa->kelas?->tingkat,

            'tahun_ajaran' =>
                $pengaturan->tahun_ajaran_aktif,

            'semester' =>
                $pengaturan->semester_aktif,
        ];
    }

    private function ensureSnapshotAkademik(
        SkriningSiswa $skrining,
        Siswa $siswa
    ): void {
        if (
            $skrining->kelas_id_saat_skrining
            && $skrining->tahun_ajaran
            && $skrining->semester
        ) {
            return;
        }

        $snapshotAkademik = $this->getSnapshotAkademik(
            $siswa
        );

        $skrining->fill([
            'kelas_id_saat_skrining' =>
                $skrining->kelas_id_saat_skrining
                ?? $snapshotAkademik[
                    'kelas_id_saat_skrining'
                ],

            'nama_kelas_saat_skrining' =>
                $skrining->nama_kelas_saat_skrining
                ?? $snapshotAkademik[
                    'nama_kelas_saat_skrining'
                ],

            'tingkat_saat_skrining' =>
                $skrining->tingkat_saat_skrining
                ?? $snapshotAkademik[
                    'tingkat_saat_skrining'
                ],

            'tahun_ajaran' =>
                $skrining->tahun_ajaran
                ?? $snapshotAkademik[
                    'tahun_ajaran'
                ],

            'semester' =>
                $skrining->semester
                ?? $snapshotAkademik[
                    'semester'
                ],
        ]);

        if ($skrining->isDirty()) {
            $skrining->save();
        }
    }
}
