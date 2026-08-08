<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EvaluasiController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\MukafaahController;
use App\Http\Controllers\PaketBelajarController;
use App\Http\Controllers\PengajarController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SantriController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// ─── Public Routes ────────────────────────────────────────────────────────────
Route::get('/', [LandingController::class, 'index'])->name('landing');
Route::view('/syarat-ketentuan', 'syarat-ketentuan')->name('syarat-ketentuan');
Route::view('/kebijakan-privasi', 'kebijakan-privasi')->name('kebijakan-privasi');
Route::get('/rapor/{kelas}', [EvaluasiController::class, 'publicRapor'])->name('evaluasi.public');

// ─── Authenticated Routes ─────────────────────────────────────────────────────
Route::middleware(['auth'])->group(function () {

    // Dashboard (all logged-in users)
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Rekap
    Route::get('rekap/pengajar', [\App\Http\Controllers\RekapController::class, 'pengajar'])->name('rekap.pengajar')->middleware('permission:mukafaahs:view');
    Route::get('rekap/santri', [\App\Http\Controllers\RekapController::class, 'santri'])->name('rekap.santri')->middleware('permission:presensis:view');

    // Presensi
    Route::get('kelas/{kelas}/presensi/create', [PresensiController::class, 'create'])->name('presensi.create');
    Route::post('kelas/{kelas}/presensi', [PresensiController::class, 'store'])->name('presensi.store');

    // Evaluasi
    Route::get('kelas/{kelas}/evaluasi/create', [EvaluasiController::class, 'create'])->name('evaluasi.create');
    Route::post('kelas/{kelas}/evaluasi', [EvaluasiController::class, 'store'])->name('evaluasi.store');
    Route::get('kelas/{kelas}/evaluasi', [EvaluasiController::class, 'show'])->name('evaluasi.show');

    // ─── Admin Only ──────────────────────────────────────────────────────────
    Route::resource('santris', SantriController::class);
    Route::resource('pengajars', PengajarController::class);
    Route::resource('paket_belajars', PaketBelajarController::class)->except(['show']);
    Route::resource('santri_fields', App\Http\Controllers\SantriFieldController::class)->except(['show']);
    Route::resource('pengajar_fields', App\Http\Controllers\PengajarFieldController::class)->except(['show']);

    Route::resource('kelas', KelasController::class)->parameters(['kelas' => 'kelas']);
    Route::get('mukafaah', [MukafaahController::class, 'index'])->name('mukafaah.index');
    Route::post('mukafaah/{kelas}/pay', [MukafaahController::class, 'pay'])->name('mukafaah.pay');

    // ─── Super-admin only: users & roles ──────────────────────────────────────
    Route::middleware(['permission:users:view|users:create|users:update|users:delete'])->group(function () {
        Route::resource('users', UserController::class)->except(['show']);
    });

    Route::middleware(['permission:roles:view|roles:create|roles:update|roles:delete'])->group(function () {
        Route::resource('roles', RoleController::class);
        Route::get('roles/{role}/permissions', [RoleController::class, 'permissions'])->name('roles.permissions');
        Route::put('roles/{role}/permissions', [RoleController::class, 'updatePermissions'])->name('roles.permissions.update');
    });

    // ─── Profile (all logged-in users) ────────────────────────────────────────
    Route::get('profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::post('profile/info', [ProfileController::class, 'updateInfo'])->name('profile.info');
    Route::post('profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
    Route::post('profile/photo', [ProfileController::class, 'updatePhoto'])->name('profile.photo');
    Route::delete('profile/photo', [ProfileController::class, 'removePhoto'])->name('profile.photo.remove');

});
