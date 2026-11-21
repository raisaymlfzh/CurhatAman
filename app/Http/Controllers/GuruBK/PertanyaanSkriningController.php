<?php

namespace App\Http\Controllers\GuruBK;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class PertanyaanSkriningController extends Controller
{
    public function index(Request $request, int $paket)
    {
        $user = $request->user();

        abort_unless(
            $user && $user->role === 'counselor',
            403,
            'Kamu tidak memiliki akses ke halaman Guru BK.'
        );

        $paketSkrining = DB::table('paket_skrining')
            ->where('id', $paket)
            ->first();

        abort_unless(
            $paketSkrining,
            404,
            'Paket skrining tidak ditemukan.'
        );

        $pertanyaan = DB::table('pertanyaan_skrining')
            ->where('paket_skrining_id', $paket)
            ->orderBy('nomor')
            ->get();

        return view(
            'guru-bk.skrining.paket.pertanyaan',
            compact(
                'user',
                'paketSkrining',
                'pertanyaan'
            )
        );
    }

    public function store(Request $request, int $paket)
    {
        $user = $request->user();

        abort_unless(
            $user && $user->role === 'counselor',
            403,
            'Kamu tidak memiliki akses ke halaman Guru BK.'
        );

        $paketSkrining = DB::table('paket_skrining')
            ->where('id', $paket)
            ->first();

        abort_unless(
            $paketSkrining,
            404,
            'Paket skrining tidak ditemukan.'
        );

        abort_if(
            (bool) $paketSkrining->is_active,
            422,
            'Pertanyaan pada paket aktif tidak dapat ditambah.'
        );

        $validated = $request->validate([
            'nomor' => [
                'required',
                'integer',
                'min:1',
                'max:255',
                Rule::unique('pertanyaan_skrining', 'nomor')
                    ->where(
                        fn ($query) =>
                            $query->where(
                                'paket_skrining_id',
                                $paket
                            )
                    ),
            ],
            'aspek' => [
                'required',
                'string',
                'max:100',
            ],
            'pertanyaan' => [
                'required',
                'string',
                'max:1000',
            ],
            'reverse_score' => [
                'nullable',
                'boolean',
            ],
        ], [
            'nomor.required' =>
                'Nomor pertanyaan wajib diisi.',
            'nomor.unique' =>
                'Nomor pertanyaan sudah digunakan pada paket ini.',
            'aspek.required' =>
                'Aspek pertanyaan wajib diisi.',
            'pertanyaan.required' =>
                'Butir pertanyaan wajib diisi.',
        ]);

        DB::table('pertanyaan_skrining')
            ->insert([
                'paket_skrining_id' => $paket,
                'nomor' => $validated['nomor'],
                'aspek' => trim($validated['aspek']),
                'pertanyaan' => trim($validated['pertanyaan']),
                'reverse_score' =>
                    (bool) ($validated['reverse_score'] ?? false),
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

        return redirect()
            ->route(
                'guru-bk.skrining.paket.pertanyaan.index',
                $paket
            )
            ->with(
                'success',
                'Pertanyaan berhasil ditambahkan.'
            );
    }

    public function storeSdq(Request $request, int $paket)
    {
        $user = $request->user();

        abort_unless(
            $user && $user->role === 'counselor',
            403,
            'Kamu tidak memiliki akses ke halaman Guru BK.'
        );

        $paketSkrining = DB::table('paket_skrining')
            ->where('id', $paket)
            ->first();

        abort_unless(
            $paketSkrining,
            404,
            'Paket skrining tidak ditemukan.'
        );

        abort_unless(
            strtoupper(trim($paketSkrining->jenis_instrumen)) === 'SDQ',
            422,
            'Import otomatis hanya tersedia untuk instrumen SDQ.'
        );

        abort_if(
            (bool) $paketSkrining->is_active,
            422,
            'Paket aktif tidak dapat diisi ulang.'
        );

        $sdqLain = DB::table('paket_skrining')
            ->where('id', '!=', $paket)
            ->whereRaw(
                'UPPER(TRIM(jenis_instrumen)) = ?',
                ['SDQ']
            )
            ->exists();

        if ($sdqLain) {
            return redirect()
                ->route('guru-bk.skrining.paket.index')
                ->withErrors([
                    'sdq' =>
                        'Instrumen SDQ sudah tersedia. Gunakan satu instrumen SDQ bersama untuk seluruh Guru BK.',
                ]);
        }

        $jumlahPertanyaan = DB::table('pertanyaan_skrining')
            ->where('paket_skrining_id', $paket)
            ->count();

        if ($jumlahPertanyaan > 0) {
            return redirect()
                ->route(
                    'guru-bk.skrining.paket.pertanyaan.index',
                    $paket
                )
                ->withErrors([
                    'sdq' =>
                        'Import otomatis hanya dapat dilakukan pada paket yang belum memiliki pertanyaan.',
                ]);
        }

        $butir = [
            [1, 'Pro', 'Saya berusaha baik kepada orang lain. Saya peduli dengan perasaan mereka.', false],
            [2, 'H', 'Saya gelisah. Saya tidak dapat diam untuk waktu lama.', false],
            [3, 'E', 'Saya sering sakit kepala, sakit perut atau macam-macam sakit lainnya.', false],
            [4, 'Pro', 'Kalau saya memiliki mainan, CD, atau makanan, saya biasanya berbagi dengan orang lain.', false],
            [5, 'C', 'Saya menjadi sangat marah dan sering tidak dapat mengendalikan kemarahan saya.', false],
            [6, 'P', 'Saya lebih suka sendiri daripada bersama dengan orang yang seusia saya.', false],
            [7, 'C', 'Saya biasanya melakukan apa yang diperintahkan oleh orang lain.', true],
            [8, 'E', 'Saya banyak merasa cemas atau khawatir terhadap apapun.', false],
            [9, 'Pro', 'Saya selalu siap menolong jika seseorang terluka, kecewa atau merasa sakit.', false],
            [10, 'H', 'Bila sedang gelisah atau cemas badan saya sering bergerak-gerak tanpa saya sadari.', false],
            [11, 'P', 'Saya mempunyai satu orang teman baik atau lebih.', true],
            [12, 'C', 'Saya sering bertengkar dengan orang lain. Saya dapat memaksa orang lain melakukan apa yang saya inginkan.', false],
            [13, 'E', 'Saya sering merasa tidak bahagia, sedih atau menangis.', false],
            [14, 'P', 'Orang lain seusia saya umumnya menyukai saya.', true],
            [15, 'H', 'Perhatian saya mudah teralih, saya sulit untuk memusatkan perhatian pada apapun.', false],
            [16, 'E', 'Saya merasa gugup dalam situasi baru, saya mudah kehilangan rasa percaya diri.', false],
            [17, 'Pro', 'Saya bersikap baik terhadap anak-anak yang lebih muda dari saya.', false],
            [18, 'C', 'Saya sering dituduh berbohong atau berbuat curang.', false],
            [19, 'P', 'Saya sering diganggu atau dipermainkan oleh anak-anak atau remaja lainnya.', false],
            [20, 'Pro', 'Saya sering menawarkan diri untuk membantu orang lain (orang tua, guru, anak-anak).', false],
            [21, 'H', 'Saya berpikir terlebih dahulu akibat yang akan terjadi, sebelum berbuat atau melakukan sesuatu.', true],
            [22, 'C', 'Saya mengambil barang yang bukan milik saya dari rumah, sekolah atau dari mana saja.', false],
            [23, 'P', 'Saya lebih mudah berteman dengan orang dewasa daripada dengan orang seusia saya.', false],
            [24, 'E', 'Banyak yang saya takuti, saya mudah menjadi takut.', false],
            [25, 'H', 'Saya menyelesaikan pekerjaan yang sedang saya lakukan. Saya mempunyai perhatian yang baik terhadap apapun.', true],
        ];

        $now = now();

        $rows = collect($butir)
            ->map(
                fn ($item) => [
                    'paket_skrining_id' => $paket,
                    'nomor' => $item[0],
                    'aspek' => $item[1],
                    'pertanyaan' => $item[2],
                    'reverse_score' => $item[3],
                    'is_active' => true,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]
            )
            ->all();

        DB::transaction(function () use (
            $paket,
            $rows
        ) {
            DB::table('paket_skrining')
                ->where('id', '!=', $paket)
                ->where('is_active', true)
                ->update([
                    'is_active' => false,
                    'updated_at' => now(),
                ]);

            DB::table('pertanyaan_skrining')
                ->insert($rows);

            DB::table('paket_skrining')
                ->where('id', $paket)
                ->update([
                    'nama_paket' =>
                        'Strengths and Difficulties Questionnaire (SDQ)',
                    'jenis_instrumen' => 'SDQ',
                    'is_active' => true,
                    'updated_at' => now(),
                ]);
        });

        return redirect()
            ->route(
                'guru-bk.skrining.paket.pertanyaan.index',
                $paket
            )
            ->with(
                'success',
                '25 pertanyaan SDQ berhasil dimasukkan. Instrumen ini sekarang digunakan bersama oleh seluruh Guru BK.'
            );
    }

    public function destroy(
        Request $request,
        int $paket,
        int $pertanyaan
    ) {
        $user = $request->user();

        abort_unless(
            $user && $user->role === 'counselor',
            403,
            'Kamu tidak memiliki akses ke halaman Guru BK.'
        );

        $paketSkrining = DB::table('paket_skrining')
            ->where('id', $paket)
            ->first();

        abort_unless(
            $paketSkrining,
            404,
            'Paket skrining tidak ditemukan.'
        );

        abort_if(
            (bool) $paketSkrining->is_active,
            422,
            'Pertanyaan pada paket aktif tidak dapat dihapus.'
        );

        $deleted = DB::table('pertanyaan_skrining')
            ->where('id', $pertanyaan)
            ->where('paket_skrining_id', $paket)
            ->delete();

        abort_unless(
            $deleted,
            404,
            'Pertanyaan tidak ditemukan.'
        );

        return redirect()
            ->route(
                'guru-bk.skrining.paket.pertanyaan.index',
                $paket
            )
            ->with(
                'success',
                'Pertanyaan berhasil dihapus.'
            );
    }
}
