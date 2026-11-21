<?php

namespace App\Http\Controllers\GuruBK;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaketSkriningController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        abort_unless(
            $user && $user->role === 'counselor',
            403,
            'Kamu tidak memiliki akses ke halaman Guru BK.'
        );

        $q = trim((string) $request->query('q', ''));

        $paket = DB::table('paket_skrining')
            ->leftJoin(
                'pertanyaan_skrining',
                'pertanyaan_skrining.paket_skrining_id',
                '=',
                'paket_skrining.id'
            )
            ->leftJoin(
                'users',
                'users.id',
                '=',
                'paket_skrining.created_by_user_id'
            )
            ->when(
                $q !== '',
                function ($query) use ($q) {
                    $query->where(function ($sub) use ($q) {
                        $sub->where(
                            'paket_skrining.nama_paket',
                            'like',
                            '%' . $q . '%'
                        )
                        ->orWhere(
                            'paket_skrining.jenis_instrumen',
                            'like',
                            '%' . $q . '%'
                        );
                    });
                }
            )
            ->select([
                'paket_skrining.id',
                'paket_skrining.nama_paket',
                'paket_skrining.jenis_instrumen',
                'paket_skrining.deskripsi',
                'paket_skrining.is_active',
                'paket_skrining.created_at',
                'users.name as dibuat_oleh',
                DB::raw(
                    'COUNT(pertanyaan_skrining.id) as jumlah_pertanyaan'
                ),
            ])
            ->groupBy([
                'paket_skrining.id',
                'paket_skrining.nama_paket',
                'paket_skrining.jenis_instrumen',
                'paket_skrining.deskripsi',
                'paket_skrining.is_active',
                'paket_skrining.created_at',
                'users.name',
            ])
            ->orderByDesc('paket_skrining.is_active')
            ->orderByDesc('paket_skrining.created_at')
            ->paginate(10)
            ->withQueryString();

        $summary = [
            'total' => DB::table('paket_skrining')->count(),
            'aktif' => DB::table('paket_skrining')
                ->where('is_active', true)
                ->count(),
            'draft' => DB::table('paket_skrining')
                ->where('is_active', false)
                ->count(),
        ];

        $paketSdq = DB::table('paket_skrining')
            ->whereRaw('UPPER(TRIM(jenis_instrumen)) = ?', ['SDQ'])
            ->orderByDesc('is_active')
            ->orderBy('id')
            ->first();

        return view(
            'guru-bk.skrining.paket.index',
            compact(
                'user',
                'paket',
                'summary',
                'q',
                'paketSdq'
            )
        );
    }

    public function create(Request $request)
    {
        $user = $request->user();

        abort_unless(
            $user && $user->role === 'counselor',
            403,
            'Kamu tidak memiliki akses ke halaman Guru BK.'
        );

        $paketSdq = DB::table('paket_skrining')
            ->whereRaw('UPPER(TRIM(jenis_instrumen)) = ?', ['SDQ'])
            ->first();

        if ($paketSdq) {
            return redirect()
                ->route(
                    'guru-bk.skrining.paket.pertanyaan.index',
                    $paketSdq->id
                )
                ->with(
                    'info',
                    'Instrumen SDQ sudah tersedia dan digunakan bersama oleh seluruh Guru BK.'
                );
        }

        return view(
            'guru-bk.skrining.paket.create',
            compact('user')
        );
    }

    public function store(Request $request)
    {
        $user = $request->user();

        abort_unless(
            $user && $user->role === 'counselor',
            403,
            'Kamu tidak memiliki akses ke halaman Guru BK.'
        );

        $validated = $request->validate([
            'nama_paket' => [
                'required',
                'string',
                'max:150',
            ],
            'jenis_instrumen' => [
                'required',
                'string',
                'max:100',
            ],
            'deskripsi' => [
                'nullable',
                'string',
                'max:2000',
            ],
        ], [
            'nama_paket.required' =>
                'Nama paket skrining wajib diisi.',
            'jenis_instrumen.required' =>
                'Jenis instrumen wajib diisi.',
        ]);

        $jenisInstrumen = strtoupper(
            trim($validated['jenis_instrumen'])
        );

        if ($jenisInstrumen === 'SDQ') {
            $paketSdq = DB::table('paket_skrining')
                ->whereRaw(
                    'UPPER(TRIM(jenis_instrumen)) = ?',
                    ['SDQ']
                )
                ->first();

            if ($paketSdq) {
                return redirect()
                    ->route(
                        'guru-bk.skrining.paket.pertanyaan.index',
                        $paketSdq->id
                    )
                    ->with(
                        'info',
                        'Instrumen SDQ sudah tersedia. Gunakan instrumen yang sama untuk seluruh Guru BK.'
                    );
            }
        }

        $paketId = DB::table('paket_skrining')
            ->insertGetId([
                'nama_paket' =>
                    trim($validated['nama_paket']),
                'jenis_instrumen' =>
                    $jenisInstrumen,
                'deskripsi' =>
                    filled($validated['deskripsi'] ?? null)
                        ? trim($validated['deskripsi'])
                        : null,
                'created_by_user_id' => $user->id,
                'is_active' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

        return redirect()
            ->route(
                'guru-bk.skrining.paket.pertanyaan.index',
                $paketId
            )
            ->with(
                'success',
                'Paket skrining berhasil dibuat. Selanjutnya masukkan pertanyaan skrining.'
            );
    }
}
