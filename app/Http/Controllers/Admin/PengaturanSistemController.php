<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PengaturanSistem;
use App\Support\AuditLogger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PengaturanSistemController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        abort_unless(
            $user && $user->role === 'admin',
            403,
            'Kamu tidak memiliki akses ke halaman Admin.'
        );

        $pengaturan = PengaturanSistem::current();

        return view(
            'admin.pengaturan-sistem.index',
            compact(
                'user',
                'pengaturan'
            )
        );
    }

    public function update(Request $request)
    {
        $user = $request->user();

        abort_unless(
            $user && $user->role === 'admin',
            403,
            'Kamu tidak memiliki akses ke halaman Admin.'
        );

        /*
        |--------------------------------------------------------------------------
        | VALIDASI
        |--------------------------------------------------------------------------
        */

        $validator = Validator::make(
            $request->all(),
            [
                'nama_sekolah' => [
                    'nullable',
                    'string',
                    'max:150',
                ],

                'logo_sekolah' => [
                    'nullable',
                    'image',
                    'mimes:jpeg,png,jpg,svg,webp',
                    'max:2048',
                ],

                'hapus_logo' => [
                    'nullable',
                    'boolean',
                ],

                'npsn' => [
                    'nullable',
                    'string',
                    'max:20',
                ],

                'akreditasi' => [
                    'nullable',
                    'string',
                    'max:20',
                ],

                'alamat_sekolah' => [
                    'nullable',
                    'string',
                    'max:1000',
                ],

                'telepon_sekolah' => [
                    'nullable',
                    'string',
                    'max:50',
                ],

                'email_sekolah' => [
                    'nullable',
                    'email',
                    'max:100',
                ],

                'website_sekolah' => [
                    'nullable',
                    'string',
                    'max:150',
                ],

                'kepala_sekolah_nama' => [
                    'nullable',
                    'string',
                    'max:150',
                ],

                'kepala_sekolah_nip' => [
                    'nullable',
                    'string',
                    'max:50',
                ],

                'tahun_ajaran_aktif' => [
                    'required',
                    'regex:/^\d{4}\/\d{4}$/',
                ],

                'semester_aktif' => [
                    'required',
                    'in:ganjil,genap',
                ],

                'batas_kasus_mangkrak' => [
                    'required',
                    'integer',
                    'min:1',
                    'max:365',
                ],

                'notifikasi_kasus_dieskalasi' => [
                    'nullable',
                    'boolean',
                ],

                'notifikasi_kasus_mangkrak' => [
                    'nullable',
                    'boolean',
                ],
            ],
            [
                'tahun_ajaran_aktif.required' =>
                    'Tahun ajaran aktif wajib diisi.',

                'tahun_ajaran_aktif.regex' =>
                    'Format tahun ajaran harus seperti 2026/2027.',

                'semester_aktif.required' =>
                    'Semester aktif wajib dipilih.',

                'semester_aktif.in' =>
                    'Semester aktif hanya boleh Ganjil atau Genap.',

                'batas_kasus_mangkrak.required' =>
                    'Batas kasus mangkrak wajib diisi.',

                'batas_kasus_mangkrak.integer' =>
                    'Batas kasus mangkrak harus berupa angka.',

                'batas_kasus_mangkrak.min' =>
                    'Batas kasus mangkrak minimal 1 hari.',

                'batas_kasus_mangkrak.max' =>
                    'Batas kasus mangkrak maksimal 365 hari.',
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | VALIDASI TAHUN AJARAN
        |--------------------------------------------------------------------------
        */

        $validator->after(
            function ($validator) use ($request) {
                $tahunAjaran = $request->input(
                    'tahun_ajaran_aktif'
                );

                if (
                    $tahunAjaran &&
                    preg_match(
                        '/^(\d{4})\/(\d{4})$/',
                        $tahunAjaran,
                        $matches
                    )
                ) {
                    $tahunAwal = (int) $matches[1];
                    $tahunAkhir = (int) $matches[2];

                    if ($tahunAkhir !== $tahunAwal + 1) {
                        $validator
                            ->errors()
                            ->add(
                                'tahun_ajaran_aktif',
                                'Tahun ajaran harus berurutan, misalnya 2026/2027.'
                            );
                    }
                }
            }
        );

        $validated = $validator->validate();

        /*
        |--------------------------------------------------------------------------
        | PENGATURAN SAAT INI
        |--------------------------------------------------------------------------
        */

        $pengaturan = PengaturanSistem::current();

        /*
        |--------------------------------------------------------------------------
        | DATA SEBELUM DIUBAH
        |--------------------------------------------------------------------------
        */

        $before = [
            'nama_sekolah' =>
                $pengaturan->nama_sekolah,

            'tahun_ajaran_aktif' =>
                $pengaturan->tahun_ajaran_aktif,

            'semester_aktif' =>
                $pengaturan->semester_aktif,

            'batas_kasus_mangkrak' =>
                $pengaturan->batas_kasus_mangkrak,

            'notifikasi_kasus_dieskalasi' =>
                $pengaturan->notifikasi_kasus_dieskalasi,

            'notifikasi_kasus_mangkrak' =>
                $pengaturan->notifikasi_kasus_mangkrak,
        ];

        /*
        |--------------------------------------------------------------------------
        | UPDATE
        |--------------------------------------------------------------------------
        */

        $logoPath = $pengaturan->logo_sekolah;

        if ($request->boolean('hapus_logo')) {
            if ($logoPath && Storage::disk('public')->exists($logoPath)) {
                Storage::disk('public')->delete($logoPath);
            }
            $logoPath = null;
        }

        if ($request->hasFile('logo_sekolah')) {
            if ($logoPath && Storage::disk('public')->exists($logoPath)) {
                Storage::disk('public')->delete($logoPath);
            }
            $logoPath = $request->file('logo_sekolah')->store('branding', 'public');
        }

        $pengaturan->update([
            'nama_sekolah' => ! empty($validated['nama_sekolah']) ? trim($validated['nama_sekolah']) : null,
            'logo_sekolah' => $logoPath,
            'npsn' => ! empty($validated['npsn']) ? trim($validated['npsn']) : null,
            'akreditasi' => ! empty($validated['akreditasi']) ? trim($validated['akreditasi']) : null,
            'alamat_sekolah' => ! empty($validated['alamat_sekolah']) ? trim($validated['alamat_sekolah']) : null,
            'telepon_sekolah' => ! empty($validated['telepon_sekolah']) ? trim($validated['telepon_sekolah']) : null,
            'email_sekolah' => ! empty($validated['email_sekolah']) ? strtolower(trim($validated['email_sekolah'])) : null,
            'website_sekolah' => ! empty($validated['website_sekolah']) ? trim($validated['website_sekolah']) : null,
            'kepala_sekolah_nama' => ! empty($validated['kepala_sekolah_nama']) ? trim($validated['kepala_sekolah_nama']) : null,
            'kepala_sekolah_nip' => ! empty($validated['kepala_sekolah_nip']) ? trim($validated['kepala_sekolah_nip']) : null,

            'tahun_ajaran_aktif' =>
                $validated['tahun_ajaran_aktif'],

            'semester_aktif' =>
                $validated['semester_aktif'],

            'batas_kasus_mangkrak' =>
                $validated['batas_kasus_mangkrak'],

            'notifikasi_kasus_dieskalasi' =>
                $request->boolean('notifikasi_kasus_dieskalasi'),

            'notifikasi_kasus_mangkrak' =>
                $request->boolean('notifikasi_kasus_mangkrak'),

            'updated_by' =>
                $user->id,
        ]);

        $pengaturan->refresh();

        /*
        |--------------------------------------------------------------------------
        | DATA SETELAH DIUBAH
        |--------------------------------------------------------------------------
        */

        $after = [
            'nama_sekolah' =>
                $pengaturan->nama_sekolah,

            'tahun_ajaran_aktif' =>
                $pengaturan->tahun_ajaran_aktif,

            'semester_aktif' =>
                $pengaturan->semester_aktif,

            'batas_kasus_mangkrak' =>
                $pengaturan->batas_kasus_mangkrak,

            'notifikasi_kasus_dieskalasi' =>
                $pengaturan->notifikasi_kasus_dieskalasi,

            'notifikasi_kasus_mangkrak' =>
                $pengaturan->notifikasi_kasus_mangkrak,
        ];

        /*
        |--------------------------------------------------------------------------
        | AUDIT LOG
        |--------------------------------------------------------------------------
        */

        AuditLogger::record(
            $request,
            $user,
            'system_settings_updated',
            'Memperbarui pengaturan sistem CurhatAman.',
            'pengaturan_sistem',
            $pengaturan->id,
            null,
            [
                'sebelum' => $before,
                'sesudah' => $after,
            ]
        );

        return redirect()
            ->route(
                'admin.pengaturan-sistem.index'
            )
            ->with(
                'success',
                'Pengaturan sistem berhasil diperbarui.'
            );
    }
}