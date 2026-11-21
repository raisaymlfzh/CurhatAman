<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function create()
    {
        $kelas = Kelas::where('is_active', true)
            ->orderBy('tingkat')
            ->orderBy('nama_kelas')
            ->get();

        return view('auth.register', compact('kelas'));
    }

    public function store(Request $request)
    {
        $request->merge([
            'whatsapp_number' => $this->normalizeWhatsappNumber(
                $request->input('whatsapp_number')
            ),
        ]);

        $validated = $request->validate(
            [
                'name' => [
                    'required',
                    'string',
                    'max:255',
                ],

                'email' => [
                    'required',
                    'email',
                    'max:255',
                    'unique:users,email',
                ],

                'nis' => [
                    'required',
                    'string',
                    'max:30',
                    'regex:/^[0-9]+$/',
                    'unique:siswa,nis',
                ],

                'kelas_id' => [
                    'required',
                    'exists:kelas,id',
                ],

                'tahun_masuk' => [
                    'required',
                    'integer',
                    'digits:4',
                    'min:2000',
                    'max:' . date('Y'),
                ],

                'whatsapp_number' => [
                    'required',
                    'string',
                    'regex:/^628[0-9]{7,12}$/',
                ],

                'password' => [
                    'required',
                    'string',
                    'min:8',
                    'confirmed',
                ],

                'terms' => [
                    'accepted',
                ],
            ],
            [
                'name.required' => 'Nama lengkap wajib diisi.',

                'email.required' => 'Email wajib diisi.',
                'email.email' => 'Format email tidak valid.',
                'email.unique' => 'Email sudah digunakan oleh akun lain.',

                'nis.required' => 'NIS wajib diisi.',
                'nis.regex' => 'NIS hanya boleh berisi angka.',
                'nis.max' => 'NIS maksimal 30 digit.',
                'nis.unique' => 'NIS sudah digunakan oleh siswa lain.',

                'kelas_id.required' => 'Kelas wajib dipilih.',
                'kelas_id.exists' => 'Kelas yang dipilih tidak valid.',

                'tahun_masuk.required' => 'Tahun masuk wajib diisi.',
                'tahun_masuk.integer' => 'Tahun masuk harus berupa angka.',
                'tahun_masuk.digits' => 'Tahun masuk harus terdiri dari 4 digit.',
                'tahun_masuk.min' => 'Tahun masuk tidak valid.',
                'tahun_masuk.max' => 'Tahun masuk tidak boleh melebihi tahun berjalan.',

                'whatsapp_number.required' => 'Nomor WhatsApp wajib diisi.',
                'whatsapp_number.regex' => 'Nomor WhatsApp tidak valid. Gunakan nomor Indonesia yang aktif.',

                'password.required' => 'Kata sandi wajib diisi.',
                'password.min' => 'Kata sandi minimal 8 karakter.',
                'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',

                'terms.accepted' => 'Kamu harus menyetujui ketentuan layanan.',
            ]
        );

        $whatsappConsent = true;

        DB::transaction(function () use (
            $validated,
            $whatsappConsent
        ) {
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role' => 'student',
                'is_active' => true,
            ]);

            $siswa = $user->siswa()->create([
                'kelas_id' => $validated['kelas_id'],
                'nis' => $validated['nis'],
                'tahun_masuk' => $validated['tahun_masuk'],
                'status_kondisi' => 'belum_dinilai',
                'status_kondisi_updated_at' => null,
            ]);

            DB::table('siswa')
                ->where('id', $siswa->id)
                ->update([
                    'whatsapp_number' =>
                        $validated['whatsapp_number']
                        ?? null,

                    'whatsapp_consent' =>
                        $whatsappConsent,

                    'whatsapp_consent_at' =>
                        $whatsappConsent
                            ? now()
                            : null,

                    'updated_at' => now(),
                ]);
        });

        return redirect()
            ->route('login')
            ->with(
                'success',
                'Akun berhasil dibuat. Silakan masuk menggunakan akunmu.'
            );
    }

    private function normalizeWhatsappNumber(
        mixed $value
    ): ?string {
        $number = preg_replace(
            '/\D+/',
            '',
            (string) $value
        );

        if ($number === '') {
            return null;
        }

        if (str_starts_with($number, '0')) {
            return '62' . substr($number, 1);
        }

        if (str_starts_with($number, '8')) {
            return '62' . $number;
        }

        return $number;
    }
}
