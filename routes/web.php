<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\Siswa\LaporanController;
use App\Http\Controllers\Siswa\DashboardController;
use App\Http\Controllers\Siswa\SkriningController;
use App\Http\Controllers\Siswa\RujukanController;
use App\Http\Controllers\Siswa\BantuanController;
use App\Http\Controllers\Siswa\ProfilSiswaController;
use App\Http\Controllers\Siswa\NotifikasiController as SiswaNotifikasiController;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\GuruBK\DashboardGuruBKController;
use App\Http\Controllers\GuruBK\LaporanKasusController;
use App\Http\Controllers\GuruBK\PermintaanBantuanController;
use App\Http\Controllers\GuruBK\SkriningSiswaController;
use App\Http\Controllers\GuruBK\DataSiswaController;
use App\Http\Controllers\GuruBK\RujukanController as GuruBKRujukanController;
use App\Http\Controllers\GuruBK\StatistikGuruBKController;
use App\Http\Controllers\GuruBK\ProfilGuruBKController;
use App\Http\Controllers\GuruBK\PaketSkriningController;
use App\Http\Controllers\GuruBK\PertanyaanSkriningController;
use App\Http\Controllers\GuruBK\NotifikasiController;
use App\Http\Controllers\GuruBK\CatatanKonselingController;
use App\Http\Controllers\WaliKelas\DashboardWaliKelasController;
use App\Http\Controllers\WaliKelas\DaftarSiswaWaliKelasController;
use App\Http\Controllers\WaliKelas\RingkasanKelasController;
use App\Http\Controllers\WaliKelas\PartisipasiSkriningController;
use App\Http\Controllers\WaliKelas\ProfilController as WaliKelasProfilController;
use App\Http\Controllers\WaliKelas\NotifikasiController as WaliKelasNotifikasiController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\PenggunaController as AdminPenggunaController;
use App\Http\Controllers\Admin\KelasController as AdminKelasController;
use App\Http\Controllers\Admin\ProfilController as AdminProfilController;
use App\Http\Controllers\Admin\KasusEskalasiController as AdminKasusEskalasiController;
use App\Http\Controllers\Admin\AktivitasGuruBKController as AdminAktivitasGuruBKController;
use App\Http\Controllers\Admin\AuditLogController as AdminAuditLogController;
use App\Http\Controllers\Admin\KasusMangkrakController as AdminKasusMangkrakController;
use App\Http\Controllers\Admin\NotifikasiController as AdminNotifikasiController;
use App\Http\Controllers\Admin\LaporanKebijakanController as AdminLaporanKebijakanController;
use App\Http\Controllers\Admin\PengaturanSistemController as AdminPengaturanSistemController;
use App\Http\Controllers\Admin\MitraRujukanController as AdminMitraRujukanController;
use App\Http\Controllers\Admin\KategoriKasusController as AdminKategoriKasusController;
use App\Http\Middleware\SyncAdminNotifications;

Route::get('/', function () {
    return view('landing');
});

Route::get('/login', [LoginController::class, 'create'])
    ->name('login');

Route::post('/login', [LoginController::class, 'store'])
    ->name('login.store');

Route::post('/logout', [LoginController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

Route::get('/register', function () {
    return redirect()->route('login');
})->name('register');

Route::get('/forgot-password', [PasswordResetController::class, 'showLinkRequestForm'])
    ->name('password.request');

Route::post('/forgot-password', [PasswordResetController::class, 'sendResetLinkEmail'])
    ->name('password.email');

Route::get('/reset-password/{token}', [PasswordResetController::class, 'showResetForm'])
    ->name('password.reset');

Route::post('/reset-password', [PasswordResetController::class, 'reset'])
    ->name('password.update');

Route::middleware([
    'auth',
    RoleMiddleware::class . ':student',
])->group(function () {
    Route::get('/siswa/dashboard', [DashboardController::class, 'index'])
        ->name('siswa.dashboard');

    Route::put(
        '/siswa/profil/whatsapp',
        [ProfilSiswaController::class, 'updateWhatsapp']
    )->name('siswa.profil.whatsapp.update');

    Route::get('/siswa/laporan/buat', [LaporanController::class, 'create'])
        ->name('siswa.laporan.create');

    Route::post('/siswa/laporan', [LaporanController::class, 'store'])
        ->name('siswa.laporan.store');

    Route::get('/siswa/laporan', [LaporanController::class, 'index'])
        ->name('siswa.laporan.index');

    Route::get('/siswa/laporan/{laporan}', [LaporanController::class, 'show'])
        ->name('siswa.laporan.show');

    Route::get('/siswa/laporan/{laporan}/edit', [LaporanController::class, 'edit'])
        ->name('siswa.laporan.edit');

    Route::put('/siswa/laporan/{laporan}', [LaporanController::class, 'update'])
        ->name('siswa.laporan.update');

    Route::delete('/siswa/laporan/bukti/{bukti}', [LaporanController::class, 'destroyBukti'])
        ->name('siswa.laporan.bukti.destroy');

    Route::patch(
        '/siswa/laporan/{laporan}/kirim',
        [LaporanController::class, 'submit']
    )->name('siswa.laporan.submit');

    Route::get('/siswa/skrining', [SkriningController::class, 'index'])
        ->name('siswa.skrining.index');

    Route::get(
        '/siswa/skrining/riwayat',
        [SkriningController::class, 'history']
    )->name('siswa.skrining.riwayat');

    Route::post(
        '/siswa/skrining/jawaban',
        [SkriningController::class, 'storeAnswer']
    )->name('siswa.skrining.answer');

    Route::get('/siswa/rujukan', [RujukanController::class, 'index'])
        ->name('siswa.rujukan');

    Route::get('/siswa/bantuan', [BantuanController::class, 'index'])
        ->name('siswa.bantuan.index');

    Route::get('/siswa/bantuan/ajukan', [BantuanController::class, 'create'])
        ->name('siswa.bantuan.create');

    Route::post('/siswa/bantuan', [BantuanController::class, 'store'])
        ->name('siswa.bantuan.store');

    Route::get('/siswa/profil', [ProfilSiswaController::class, 'index'])
        ->name('siswa.profil.index');

    Route::patch(
        '/siswa/profil/foto',
        [ProfilSiswaController::class, 'updatePhoto']
    )->name('siswa.profil.photo.update');

    Route::put(
        '/siswa/profil/password',
        [ProfilSiswaController::class, 'updatePassword']
    )->name('siswa.profil.password.update');

    Route::get(
        '/siswa/notifikasi',
        [SiswaNotifikasiController::class, 'index']
    )->name('siswa.notifikasi.index');

    Route::patch(
        '/siswa/notifikasi/baca-semua',
        [SiswaNotifikasiController::class, 'readAll']
    )->name('siswa.notifikasi.read-all');

    Route::patch(
        '/siswa/notifikasi/{notifikasi}/baca',
        [SiswaNotifikasiController::class, 'read']
    )->name('siswa.notifikasi.read');
});

Route::middleware([
    'auth',
    RoleMiddleware::class . ':counselor',
])->group(function () {
    Route::get(
        '/guru-bk/dashboard',
        [DashboardGuruBKController::class, 'index']
    )->name('guru-bk.dashboard');

    Route::get(
        '/guru-bk/laporan',
        [LaporanKasusController::class, 'index']
    )->name('guru-bk.laporan.index');

    Route::get(
        '/guru-bk/laporan/export/excel',
        [LaporanKasusController::class, 'exportExcel']
    )->name('guru-bk.laporan.excel');

    Route::get(
        '/guru-bk/laporan/export/pdf',
        [LaporanKasusController::class, 'exportPdf']
    )->name('guru-bk.laporan.pdf');

    Route::get(
        '/guru-bk/data-siswa',
        [DataSiswaController::class, 'index']
    )->name('guru-bk.data-siswa.index');

    Route::get(
        '/guru-bk/data-siswa/{siswa}',
        [DataSiswaController::class, 'show']
    )->name('guru-bk.data-siswa.show');

    Route::get(
        '/guru-bk/laporan/{laporan}',
        [LaporanKasusController::class, 'show']
    )->name('guru-bk.laporan.show');

    Route::get(
        '/guru-bk/laporan/{laporan}/pdf',
        [App\Http\Controllers\GuruBK\LaporanKasusController::class, 'exportDetailPdf']
    )->name('guru-bk.laporan.pdf.detail');

    Route::post(
        '/guru-bk/laporan/{laporan}/konflik',
        [LaporanKasusController::class, 'storeConflict']
    )->name('guru-bk.laporan.konflik.store');

    Route::patch(
        '/guru-bk/laporan/{laporan}/claim',
        [LaporanKasusController::class, 'claim']
    )->name('guru-bk.laporan.claim');

    Route::patch(
        '/guru-bk/laporan/{laporan}/status',
        [LaporanKasusController::class, 'updateStatus']
    )->name('guru-bk.laporan.status');

    Route::post(
        '/guru-bk/laporan/{laporan}/tindak-lanjut',
        [LaporanKasusController::class, 'storeTindakLanjut']
    )->name('guru-bk.laporan.tindak-lanjut.store');

    Route::get(
        '/guru-bk/bantuan',
        [PermintaanBantuanController::class, 'index']
    )->name('guru-bk.bantuan.index');

    Route::patch(
        '/guru-bk/bantuan/{permintaan}/status',
        [PermintaanBantuanController::class, 'updateStatus']
    )->name('guru-bk.bantuan.status');

    Route::get(
        '/guru-bk/bantuan/{permintaan}',
        [PermintaanBantuanController::class, 'show']
    )->name('guru-bk.bantuan.show');

    Route::get(
        '/guru-bk/bantuan/{permintaan}/pdf',
        [App\Http\Controllers\GuruBK\PermintaanBantuanController::class, 'exportDetailPdf']
    )->name('guru-bk.bantuan.pdf.detail');

    Route::get(
        '/guru-bk/skrining',
        [SkriningSiswaController::class, 'index']
    )->name('guru-bk.skrining.index');

    Route::get(
        '/guru-bk/skrining/hasil/{skrining}',
        [SkriningSiswaController::class, 'show']
    )->name('guru-bk.skrining.show');

    Route::get(
        '/guru-bk/skrining/hasil/{skrining}/pdf',
        [App\Http\Controllers\GuruBK\SkriningSiswaController::class, 'exportDetailPdf']
    )->name('guru-bk.skrining.pdf.detail');

    Route::post(
        '/guru-bk/skrining/{skrining}/take',
        [App\Http\Controllers\GuruBK\SkriningSiswaController::class, 'takeAssignment']
    )->name('guru-bk.skrining.take');

    Route::get(
        '/guru-bk/skrining/export/excel',
        [SkriningSiswaController::class, 'exportExcel']
    )->name('guru-bk.skrining.export.excel');

    Route::get(
        '/guru-bk/skrining/export/pdf',
        [SkriningSiswaController::class, 'exportPdf']
    )->name('guru-bk.skrining.export.pdf');

    Route::get(
        '/guru-bk/rujukan',
        [GuruBKRujukanController::class, 'index']
    )->name('guru-bk.rujukan.index');

    Route::get(
        '/guru-bk/rujukan/buat',
        [GuruBKRujukanController::class, 'create']
    )->name('guru-bk.rujukan.create');

    Route::post(
        '/guru-bk/rujukan',
        [GuruBKRujukanController::class, 'store']
    )->name('guru-bk.rujukan.store');

    Route::get(
        '/guru-bk/rujukan/{rujukan}',
        [GuruBKRujukanController::class, 'show']
    )->name('guru-bk.rujukan.show');

    Route::get(
        '/guru-bk/rujukan/{rujukan}/edit',
        [GuruBKRujukanController::class, 'edit']
    )->name('guru-bk.rujukan.edit');

    Route::put(
        '/guru-bk/rujukan/{rujukan}',
        [GuruBKRujukanController::class, 'update']
    )->name('guru-bk.rujukan.update');

    Route::delete(
        '/guru-bk/rujukan/{rujukan}',
        [GuruBKRujukanController::class, 'destroy']
    )->name('guru-bk.rujukan.destroy');

    Route::get(
        '/guru-bk/rujukan/{rujukan}/pdf',
        [App\Http\Controllers\GuruBK\RujukanController::class, 'exportPdf']
    )->name('guru-bk.rujukan.pdf');

    Route::patch(
        '/guru-bk/rujukan/{rujukan}/status',
        [GuruBKRujukanController::class, 'updateStatus']
    )->name('guru-bk.rujukan.status');

    Route::get(
        '/guru-bk/catatan-konseling',
        [CatatanKonselingController::class, 'index']
    )->name('guru-bk.catatan-konseling.index');

    Route::get(
        '/guru-bk/catatan-konseling/buat',
        [CatatanKonselingController::class, 'create']
    )->name('guru-bk.catatan-konseling.create');

    Route::post(
        '/guru-bk/catatan-konseling',
        [CatatanKonselingController::class, 'store']
    )->name('guru-bk.catatan-konseling.store');

    Route::get(
        '/guru-bk/catatan-konseling/export/excel',
        [CatatanKonselingController::class, 'exportRekapExcel']
    )->name('guru-bk.catatan-konseling.rekap-excel');

    Route::get(
        '/guru-bk/catatan-konseling/export/pdf',
        [CatatanKonselingController::class, 'exportRekapPdf']
    )->name('guru-bk.catatan-konseling.rekap-pdf');

    Route::get(
        '/guru-bk/catatan-konseling/{catatan}',
        [CatatanKonselingController::class, 'show']
    )->name('guru-bk.catatan-konseling.show');

    Route::get(
        '/guru-bk/catatan-konseling/{catatan}/edit',
        [CatatanKonselingController::class, 'edit']
    )->name('guru-bk.catatan-konseling.edit');

    Route::put(
        '/guru-bk/catatan-konseling/{catatan}',
        [CatatanKonselingController::class, 'update']
    )->name('guru-bk.catatan-konseling.update');

    Route::delete(
        '/guru-bk/catatan-konseling/{catatan}',
        [CatatanKonselingController::class, 'destroy']
    )->name('guru-bk.catatan-konseling.destroy');

    Route::get(
        '/guru-bk/catatan-konseling/{catatan}/pdf',
        [CatatanKonselingController::class, 'exportPdf']
    )->name('guru-bk.catatan-konseling.pdf');

    Route::get(
        '/guru-bk/statistik',
        [StatistikGuruBKController::class, 'index']
    )->name('guru-bk.statistik.index');

    Route::get(
        '/guru-bk/profil',
        [ProfilGuruBKController::class, 'index']
    )->name('guru-bk.profil.index');

    Route::put(
        '/guru-bk/profil/password',
        [ProfilGuruBKController::class, 'updatePassword']
    )->name('guru-bk.profil.password.update');

    Route::get(
        '/guru-bk/skrining/paket',
        [PaketSkriningController::class, 'index']
    )->name('guru-bk.skrining.paket.index');

    Route::get(
        '/guru-bk/skrining/paket/buat',
        [PaketSkriningController::class, 'create']
    )->name('guru-bk.skrining.paket.create');

    Route::post(
        '/guru-bk/skrining/paket',
        [PaketSkriningController::class, 'store']
    )->name('guru-bk.skrining.paket.store');

    Route::get(
        '/guru-bk/skrining/paket/{paket}/pertanyaan',
        [PertanyaanSkriningController::class, 'index']
    )->name('guru-bk.skrining.paket.pertanyaan.index');

    Route::post(
        '/guru-bk/skrining/paket/{paket}/pertanyaan',
        [PertanyaanSkriningController::class, 'store']
    )->name('guru-bk.skrining.paket.pertanyaan.store');

    Route::post(
        '/guru-bk/skrining/paket/{paket}/sdq',
        [PertanyaanSkriningController::class, 'storeSdq']
    )->name('guru-bk.skrining.paket.sdq.store');

    Route::delete(
        '/guru-bk/skrining/paket/{paket}/pertanyaan/{pertanyaan}',
        [PertanyaanSkriningController::class, 'destroy']
    )->name('guru-bk.skrining.paket.pertanyaan.destroy');

    Route::get(
        '/guru-bk/notifikasi',
        [NotifikasiController::class, 'index']
    )->name('guru-bk.notifikasi.index');

    Route::patch(
        '/guru-bk/notifikasi/baca-semua',
        [NotifikasiController::class, 'readAll']
    )->name('guru-bk.notifikasi.read-all');

    Route::patch(
        '/guru-bk/notifikasi/{notifikasi}/baca',
        [NotifikasiController::class, 'read']
    )->name('guru-bk.notifikasi.read');
});

Route::middleware([
    'auth',
    RoleMiddleware::class . ':homeroom_teacher',
])->group(function () {
    Route::get(
        '/wali-kelas/dashboard',
        [DashboardWaliKelasController::class, 'index']
    )->name('wali-kelas.dashboard');

    Route::get(
        '/wali-kelas/daftar-siswa',
        [DaftarSiswaWaliKelasController::class, 'index']
    )->name('wali-kelas.siswa.index');

    Route::get(
        '/wali-kelas/ringkasan-kelas',
        [RingkasanKelasController::class, 'index']
    )->name('wali-kelas.ringkasan.index');

    Route::post(
        '/wali-kelas/ringkasan-kelas/feedback/{catatan}',
        [RingkasanKelasController::class, 'updateFeedbackWaliKelas']
    )->name('wali-kelas.ringkasan.feedback');

    Route::get(
        '/wali-kelas/skrining',
        [PartisipasiSkriningController::class, 'index']
    )->name('wali-kelas.skrining.index');

    Route::get(
        '/wali-kelas/profil',
        [WaliKelasProfilController::class, 'index']
    )->name('wali-kelas.profil.index');

    Route::put(
        '/wali-kelas/profil/password',
        [WaliKelasProfilController::class, 'updatePassword']
    )->name('wali-kelas.profil.password.update');

    Route::patch(
        '/wali-kelas/notifikasi/baca-semua',
        [WaliKelasNotifikasiController::class, 'readAll']
    )->name('wali-kelas.notifikasi.read-all');

    Route::patch(
        '/wali-kelas/notifikasi/{notifikasi}/baca',
        [WaliKelasNotifikasiController::class, 'read']
    )->name('wali-kelas.notifikasi.read');
});

Route::middleware([
    'auth',
    RoleMiddleware::class . ':admin',
    SyncAdminNotifications::class,
])->group(function () {
    Route::get(
        '/admin/dashboard',
        [AdminDashboardController::class, 'index']
    )->name('admin.dashboard');

    Route::get(
        '/admin/pengguna',
        [AdminPenggunaController::class, 'index']
    )->name('admin.pengguna.index');

    Route::get(
        '/admin/pengguna/tambah',
        [AdminPenggunaController::class, 'create']
    )->name('admin.pengguna.create');

    Route::post(
        '/admin/pengguna',
        [AdminPenggunaController::class, 'store']
    )->name('admin.pengguna.store');

    Route::get(
        '/admin/pengguna/import',
        [AdminPenggunaController::class, 'importView']
    )->name('admin.pengguna.import');

    Route::post(
        '/admin/pengguna/import/siswa',
        [AdminPenggunaController::class, 'importSiswa']
    )->name('admin.pengguna.import.siswa');

    Route::post(
        '/admin/pengguna/import/guru',
        [AdminPenggunaController::class, 'importGuru']
    )->name('admin.pengguna.import.guru');

    Route::get(
        '/admin/pengguna/import/template/{type}/{format}',
        [AdminPenggunaController::class, 'downloadTemplate']
    )->name('admin.pengguna.import.template');

    Route::patch(
        '/admin/pengguna/{pengguna}/status',
        [AdminPenggunaController::class, 'toggleStatus']
    )->name('admin.pengguna.toggle-status');

    Route::patch(
        '/admin/pengguna/{pengguna}/kelas',
        [AdminPenggunaController::class, 'updateKelasSiswa']
    )->name('admin.pengguna.update-kelas');

    Route::get(
        '/admin/pengguna/{pengguna}/reset-password',
        [AdminPenggunaController::class, 'resetPasswordForm']
    )->name('admin.pengguna.reset-password.form');

    Route::put(
        '/admin/pengguna/{pengguna}/reset-password',
        [AdminPenggunaController::class, 'resetPassword']
    )->name('admin.pengguna.reset-password.update');

    Route::get(
        '/admin/kelas',
        [AdminKelasController::class, 'index']
    )->name('admin.kelas.index');

    Route::get(
        '/admin/kelas/tambah',
        [AdminKelasController::class, 'create']
    )->name('admin.kelas.create');

    Route::post(
        '/admin/kelas',
        [AdminKelasController::class, 'store']
    )->name('admin.kelas.store');

    Route::get(
        '/admin/kelas/{kelas}/edit',
        [AdminKelasController::class, 'edit']
    )->name('admin.kelas.edit');

    Route::put(
        '/admin/kelas/{kelas}',
        [AdminKelasController::class, 'update']
    )->name('admin.kelas.update');

    Route::patch(
        '/admin/kelas/{kelas}/status',
        [AdminKelasController::class, 'toggleStatus']
    )->name('admin.kelas.toggle-status');

    Route::post(
        '/admin/kelas/promosi-massal',
        [AdminKelasController::class, 'promosiMassal']
    )->name('admin.kelas.promosi-massal');

    // Master Data Mitra Rujukan
    Route::get('/admin/mitra-rujukan', [AdminMitraRujukanController::class, 'index'])->name('admin.mitra-rujukan.index');
    Route::post('/admin/mitra-rujukan', [AdminMitraRujukanController::class, 'store'])->name('admin.mitra-rujukan.store');
    Route::put('/admin/mitra-rujukan/{id}', [AdminMitraRujukanController::class, 'update'])->name('admin.mitra-rujukan.update');
    Route::patch('/admin/mitra-rujukan/{id}/status', [AdminMitraRujukanController::class, 'toggleStatus'])->name('admin.mitra-rujukan.toggle-status');
    Route::delete('/admin/mitra-rujukan/{id}', [AdminMitraRujukanController::class, 'destroy'])->name('admin.mitra-rujukan.destroy');

    // Master Data Kategori Kasus
    Route::get('/admin/kategori-kasus', [AdminKategoriKasusController::class, 'index'])->name('admin.kategori-kasus.index');
    Route::post('/admin/kategori-kasus', [AdminKategoriKasusController::class, 'store'])->name('admin.kategori-kasus.store');
    Route::put('/admin/kategori-kasus/{id}', [AdminKategoriKasusController::class, 'update'])->name('admin.kategori-kasus.update');
    Route::patch('/admin/kategori-kasus/{id}/status', [AdminKategoriKasusController::class, 'toggleStatus'])->name('admin.kategori-kasus.toggle-status');
    Route::delete('/admin/kategori-kasus/{id}', [AdminKategoriKasusController::class, 'destroy'])->name('admin.kategori-kasus.destroy');

    Route::get(
        '/admin/profil',
        [AdminProfilController::class, 'index']
    )->name('admin.profil.index');

    Route::put(
        '/admin/profil/password',
        [AdminProfilController::class, 'updatePassword']
    )->name('admin.profil.password.update');

    Route::get(
        '/admin/kasus-eskalasi',
        [AdminKasusEskalasiController::class, 'index']
    )->name('admin.kasus-eskalasi.index');

    Route::get(
        '/admin/kasus-eskalasi/{laporan}',
        [AdminKasusEskalasiController::class, 'show']
    )->name('admin.kasus-eskalasi.show');

    Route::patch(
        '/admin/kasus-eskalasi/{laporan}/alih-penanganan',
        [AdminKasusEskalasiController::class, 'reassign']
    )->name('admin.kasus-eskalasi.reassign');

    Route::get(
        '/admin/aktivitas-guru-bk',
        [AdminAktivitasGuruBKController::class, 'index']
    )->name('admin.aktivitas-guru-bk.index');

    Route::get(
        '/admin/audit-log',
        [AdminAuditLogController::class, 'index']
    )->name('admin.audit-log.index');

    Route::get(
        '/admin/kasus-mangkrak',
        [AdminKasusMangkrakController::class, 'index']
    )->name('admin.kasus-mangkrak.index');

    Route::get(
        '/admin/kasus-mangkrak/{laporan}',
        [AdminKasusMangkrakController::class, 'show']
    )->name('admin.kasus-mangkrak.show');

    Route::patch(
        '/admin/kasus-mangkrak/{laporan}/alih-penanganan',
        [AdminKasusMangkrakController::class, 'reassign']
    )->name('admin.kasus-mangkrak.reassign');

    Route::get(
        '/admin/notifikasi',
        [AdminNotifikasiController::class, 'index']
    )->name('admin.notifikasi.index');

    Route::patch(
        '/admin/notifikasi/baca-semua',
        [AdminNotifikasiController::class, 'readAll']
    )->name('admin.notifikasi.read-all');

    Route::patch(
        '/admin/notifikasi/{notifikasi}/baca',
        [AdminNotifikasiController::class, 'read']
    )->name('admin.notifikasi.read');

    Route::get(
        '/admin/laporan-kebijakan',
        [AdminLaporanKebijakanController::class, 'index']
    )->name('admin.laporan-kebijakan.index');

    Route::get(
        '/admin/laporan-kebijakan/export/excel',
        [AdminLaporanKebijakanController::class, 'exportExcel']
    )->name('admin.laporan-kebijakan.excel');

    Route::get(
        '/admin/laporan-kebijakan/export/pdf',
        [AdminLaporanKebijakanController::class, 'exportPdf']
    )->name('admin.laporan-kebijakan.pdf');

    Route::get(
        '/admin/pengaturan-sistem',
        [AdminPengaturanSistemController::class, 'index']
    )->name('admin.pengaturan-sistem.index');

    Route::put(
        '/admin/pengaturan-sistem',
        [AdminPengaturanSistemController::class, 'update']
    )->name('admin.pengaturan-sistem.update');
});





