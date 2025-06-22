<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\RekapAbsensiController;
use App\Http\Controllers\RaporController;

// LOGIN (pakai root "/")
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/', [AuthController::class, 'login'])->name('login');

// LOGOUT
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// DASHBOARD (pakai middleware auth)
Route::get('/dashboard', [AuthController::class, 'showDashboard'])->name('dashboard')->middleware('auth');
Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

// ABSENSI
Route::get('/absensi', [AbsensiController::class, 'index'])->name('absensi')->middleware('auth');
Route::post('/absensi', [AbsensiController::class, 'store'])->middleware('auth');

// EDIT & HAPUS ABSENSI (tambahan)
Route::put('/absensi/{id}', [AbsensiController::class, 'update'])->name('absensi.update')->middleware('auth');
Route::delete('/absensi/{id}', [AbsensiController::class, 'destroy'])->name('absensi.destroy')->middleware('auth');

// REKAP ABSEN
Route::get('/rekapabsen', [AbsensiController::class, 'rekap'])->name('rekapabsen')->middleware('auth');

//Rekap harian dan bulanan (via web.php saja)
Route::get('/rekap-harian', [RekapAbsensiController::class, 'rekapHarian'])->middleware('auth');
Route::get('/rekap-bulanan', [RekapAbsensiController::class, 'rekapBulanan'])->middleware('auth');

// CETAK REKAP (export PDF/Excel misalnya)
Route::get('/rekapabsen/cetak', [RekapAbsensiController::class, 'cetak'])->name('rekapabsen.cetak')->middleware('auth');

// DATA GURU
Route::get('/dataguru', [GuruController::class, 'index'])->name('dataguru')->middleware('auth');
Route::post('/guru', [GuruController::class, 'store'])->middleware('auth');
Route::get('/guru/{id}', [GuruController::class, 'show'])->middleware('auth');
Route::put('/guru/{id}', [GuruController::class, 'update'])->middleware('auth');
Route::delete('/guru/{id}', [GuruController::class, 'destroy'])->middleware('auth');

// DATA SISWA
Route::get('/datasiswa', [SiswaController::class, 'index'])->name('datasiswa')->middleware('auth');
Route::post('/siswa', [SiswaController::class, 'store'])->middleware('auth');
Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa.index')->middleware('auth');
Route::get('/siswa/{id}', [SiswaController::class, 'show'])->middleware('auth');
Route::put('/siswa/{id}', [SiswaController::class, 'update'])->middleware('auth');
Route::delete('/siswa/{id}', [SiswaController::class, 'destroy'])->middleware('auth');

// RAPOR
Route::middleware('auth')->group(function () {
    Route::get('/rapor', [RaporController::class, 'index'])->name('dbrapor');
    Route::get('/rapor/create/{username}', [RaporController::class, 'create'])->name('rapor.create');
    Route::post('/rapor', [RaporController::class, 'store'])
        ->name('rapor.store')
        ->middleware(['auth'])
        ->defaults('expectsJson', true);
    Route::get('/rapor/{id}/edit', [RaporController::class, 'edit'])->name('rapor.edit');
    Route::put('/rapor/{id}', [RaporController::class, 'update'])->name('rapor.update');
    Route::get('/rapor/{id}', [RaporController::class, 'show'])->name('rapor.show');
});
