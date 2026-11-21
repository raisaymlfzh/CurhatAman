<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Support\AdminNotifier;
use App\Support\AuditLogger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProfilSiswaController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user()->load([
            'siswa.kelas',
        ]);

        abort_unless($user->role === 'student', 403);

        $siswa = $user->siswa;

        abort_if(
            ! $siswa,
            404,
            'Data siswa tidak ditemukan.'
        );

        $kelasList = Kelas::where('is_active', true)
            ->orderBy('tingkat')
            ->orderBy('nama_kelas')
            ->get();

        return view('siswa.profil.index', compact(
            'user',
            'siswa',
            'kelasList'
        ));
    }

    public function updatePhoto(Request $request)
    {
        $user = $request->user();

        abort_unless(
            $user && $user->role === 'student',
            403
        );

        $validated = $request->validate([
            'profile_photo' => [
                'required',
                'image',
                'mimes:jpg,jpeg,png',
                'max:2048',
            ],
        ], [
            'profile_photo.required' => 'Foto profil wajib dipilih.',
            'profile_photo.image' => 'File yang dipilih harus berupa gambar.',
            'profile_photo.mimes' => 'Foto profil harus berformat JPG, JPEG, atau PNG.',
            'profile_photo.max' => 'Ukuran foto profil maksimal 2 MB.',
        ]);

        if ($user->profile_photo_path) {
            Storage::disk('public')->delete($user->profile_photo_path);
        }

        $path = $validated['profile_photo']->store(
            'profile-photos',
            'public'
        );

        $user->update([
            'profile_photo_path' => $path,
        ]);

        if ($user->siswa) {
            AdminNotifier::notifyStudentProfileUpdated(
                $user,
                $user->siswa,
                'foto profil akun'
            );

            AuditLogger::record(
                $request,
                $user,
                'student_profile_updated',
                "Siswa {$user->name} (NISN: {$user->siswa->nis}) memperbarui foto profil akun.",
                'users',
                $user->id,
                'NISN-' . $user->siswa->nis
            );
        }

        return redirect()
            ->route('siswa.profil.index')
            ->with(
                'photo_success',
                'Foto profil berhasil diperbarui.'
            );
    }

    public function updateWhatsapp(Request $request)
    {
        $user = $request->user();

        abort_unless(
            $user && $user->role === 'student',
            403
        );

        $siswa = $user->siswa;

        abort_if(
            ! $siswa,
            404,
            'Data siswa tidak ditemukan.'
        );

        $request->merge([
            'whatsapp_number' => $this->normalizeWhatsappNumber(
                $request->input('whatsapp_number')
            ),
        ]);

        $validated = $request->validate(
            [
                'email' => [
                    'required',
                    'email',
                    'max:255',
                    Rule::unique('users', 'email')->ignore($user->id),
                ],

                'whatsapp_number' => [
                    'required',
                    'string',
                    'regex:/^628[0-9]{7,12}$/',
                ],

                'whatsapp_consent' => [
                    'nullable',
                    'accepted',
                ],
            ],
            [
                'email.required' =>
                    'Alamat email aktif wajib diisi.',
                'email.email' =>
                    'Format alamat email tidak valid.',
                'email.unique' =>
                    'Alamat email tersebut sudah digunakan oleh akun lain.',
                'whatsapp_number.required' =>
                    'Nomor WhatsApp wajib diisi.',
                'whatsapp_number.regex' =>
                    'Nomor WhatsApp tidak valid. Gunakan nomor Indonesia yang aktif.',
                'whatsapp_consent.accepted' =>
                    'Persetujuan WhatsApp tidak valid.',
            ]
        );

        $perubahanList = [];

        $newEmail = strtolower(trim($validated['email']));
        $oldEmail = strtolower((string) $user->email);

        if ($newEmail !== $oldEmail) {
            if (str_ends_with($oldEmail, '@siswa.curhataman.local')) {
                $perubahanList[] = "email aktif ({$newEmail})";
            } else {
                $perubahanList[] = "email ({$user->email} → {$newEmail})";
            }
        }

        if ($validated['whatsapp_number'] !== $siswa->whatsapp_number) {
            $perubahanList[] = 'nomor WhatsApp';
        }

        $whatsappConsent = $request->has('whatsapp_consent');
        if ((bool) $whatsappConsent !== (bool) $siswa->whatsapp_consent) {
            $perubahanList[] = 'preferensi notifikasi WhatsApp';
        }

        $user->update([
            'email' => $newEmail,
        ]);

        DB::table('siswa')
            ->where(
                'id',
                $siswa->id
            )
            ->update([
                'whatsapp_number' =>
                    $validated[
                        'whatsapp_number'
                    ],

                'whatsapp_consent' =>
                    $whatsappConsent,

                'whatsapp_consent_at' =>
                    $whatsappConsent
                        ? (
                            $siswa->whatsapp_consent_at
                            ?? now()
                        )
                        : null,

                'updated_at' => now(),
            ]);

        $ringkasanPerubahan = ! empty($perubahanList)
            ? implode(', ', $perubahanList)
            : 'kontak email & WhatsApp';

        AdminNotifier::notifyStudentProfileUpdated(
            $user,
            $siswa,
            $ringkasanPerubahan
        );

        AuditLogger::record(
            $request,
            $user,
            'student_profile_updated',
            "Siswa {$user->name} (NISN: {$siswa->nis}) memperbarui {$ringkasanPerubahan}.",
            'users',
            $user->id,
            'NISN-' . $siswa->nis,
            ['updated_fields' => $perubahanList]
        );

        return redirect()
            ->route(
                'siswa.profil.index'
            )
            ->with(
                'whatsapp_success',
                'Alamat email dan kontak WhatsApp berhasil diperbarui.'
            );
    }

    public function updatePassword(Request $request)
    {
        $user = $request->user();

        abort_unless(
            $user && $user->role === 'student',
            403
        );

        $validated = $request->validate([
            'current_password' => [
                'required',
                'current_password',
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
                'different:current_password',
            ],
        ], [
            'current_password.required' =>
                'Password saat ini wajib diisi.',
            'current_password.current_password' =>
                'Password saat ini tidak sesuai.',
            'password.required' =>
                'Password baru wajib diisi.',
            'password.min' =>
                'Password baru minimal 8 karakter.',
            'password.confirmed' =>
                'Konfirmasi password baru tidak sesuai.',
            'password.different' =>
                'Password baru harus berbeda dari password saat ini.',
        ]);

        $user->update([
            'password' => Hash::make($validated['password']),
        ]);

        if ($user->siswa) {
            AdminNotifier::notifyStudentProfileUpdated(
                $user,
                $user->siswa,
                'kata sandi (password) akun'
            );

            AuditLogger::record(
                $request,
                $user,
                'student_profile_updated',
                "Siswa {$user->name} (NISN: {$user->siswa->nis}) memperbarui kata sandi akun.",
                'users',
                $user->id,
                'NISN-' . $user->siswa->nis
            );
        }

        return redirect()
            ->route('siswa.profil.index')
            ->with(
                'password_success',
                'Password berhasil diperbarui.'
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

        if (
            str_starts_with(
                $number,
                '0'
            )
        ) {
            return '62'
                . substr(
                    $number,
                    1
                );
        }

        if (
            str_starts_with(
                $number,
                '8'
            )
        ) {
            return '62' . $number;
        }

        return $number;
    }

}
