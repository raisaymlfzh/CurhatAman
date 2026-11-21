<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\PermintaanBantuan;
use App\Models\Siswa;
use Illuminate\Http\Request;

class BantuanController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $siswa = $user->siswa;

        $permintaanBantuan = collect();

        if ($siswa) {
            $permintaanBantuan = PermintaanBantuan::where('siswa_id', $siswa->id)
                ->latest('submitted_at')
                ->get();
        }

        return view('siswa.bantuan.index', compact('permintaanBantuan'));
    }

    public function create()
    {
        $siswa = auth()->user()?->siswa;

        if ($siswa && $this->hasReachedUnprocessedLimit($siswa)) {
            return redirect()
                ->route('siswa.bantuan.index')
                ->with(
                    'error',
                    'Kamu sudah memiliki 2 permintaan bantuan yang sedang menunggu diproses oleh Guru BK. Kamu baru dapat mengajukan bantuan baru setelah permintaan sebelumnya mulai ditindaklanjuti.'
                );
        }

        return view('siswa.bantuan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_bantuan' => [
                'required',
                'in:pendampingan,perundungan,pribadi,akademik,lainnya'
            ],

            'pesan' => [
                'required',
                'string',
                'max:1000'
            ],
        ], [
            'jenis_bantuan.required' =>
                'Silakan pilih jenis bantuan.',

            'jenis_bantuan.in' =>
                'Jenis bantuan tidak valid.',

            'pesan.required' =>
                'Silakan ceritakan bantuan yang kamu butuhkan.',

            'pesan.max' =>
                'Pesan maksimal 1000 karakter.',
        ]);

        $user = auth()->user();

        $siswa = $user->siswa;

        if (!$siswa) {
            return back()->withErrors([
                'siswa' => 'Data siswa tidak ditemukan.'
            ]);
        }

        if ($this->hasReachedUnprocessedLimit($siswa)) {
            return redirect()
                ->route('siswa.bantuan.index')
                ->with(
                    'error',
                    'Kamu sudah memiliki 2 permintaan bantuan yang sedang menunggu diproses oleh Guru BK. Kamu baru dapat mengajukan bantuan baru setelah salah satu permintaan sebelumnya mulai diproses.'
                );
        }

        PermintaanBantuan::create([
            'siswa_id' => $siswa->id,

            'assigned_bk_id' => null,

            'jenis_bantuan' => $request->jenis_bantuan,

            'pesan' => $request->pesan,

            'status' => 'baru',

            'submitted_at' => now(),
        ]);

        return redirect()
            ->route('siswa.bantuan.index')
            ->with(
                'success',
                'Permintaan bantuan berhasil dikirim kepada Guru BK.'
            );
    }

    private function hasReachedUnprocessedLimit(Siswa $siswa): bool
    {
        return PermintaanBantuan::where('siswa_id', $siswa->id)
            ->where('status', 'baru')
            ->count() >= 2;
    }
}