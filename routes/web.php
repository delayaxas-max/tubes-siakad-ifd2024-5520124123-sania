<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MatakuliahController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\KrsController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect('/login');
});

// ============================================================
// ROUTE YANG MEMBUTUHKAN AUTHENTICATION
// ============================================================
Route::middleware(['auth'])->group(function () {
    
    // Dashboard (Semua Role)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile (Semua Role)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ============================================================
    // ROUTE ADMIN (Hanya untuk role: admin)
    // ============================================================
    Route::middleware('role:admin')->group(function () {
        
        // ===== DOSEN =====
        Route::get('/dosen', [DosenController::class, 'index'])->name('dosen.index');
        Route::post('/dosen', [DosenController::class, 'store'])->name('dosen.store');
        Route::put('/dosen/{nidn}', [DosenController::class, 'update'])->name('dosen.update');
        Route::delete('/dosen/{nidn}', [DosenController::class, 'destroy'])->name('dosen.destroy');

        // ===== MAHASISWA =====
        Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa.index');
        Route::post('/mahasiswa', [MahasiswaController::class, 'store'])->name('mahasiswa.store');
        Route::put('/mahasiswa/{npm}', [MahasiswaController::class, 'update'])->name('mahasiswa.update');
        Route::delete('/mahasiswa/{npm}', [MahasiswaController::class, 'destroy'])->name('mahasiswa.destroy');

        // ===== MATA KULIAH =====
        Route::get('/matakuliah', [MatakuliahController::class, 'index'])->name('matakuliah.index');
        Route::post('/matakuliah', [MatakuliahController::class, 'store'])->name('matakuliah.store');
        Route::put('/matakuliah/{kode_matakuliah}', [MatakuliahController::class, 'update'])->name('matakuliah.update');
        Route::delete('/matakuliah/{kode_matakuliah}', [MatakuliahController::class, 'destroy'])->name('matakuliah.destroy');

        // ===== JADWAL =====
        Route::get('/jadwal', [JadwalController::class, 'index'])->name('jadwal.index');
        Route::post('/jadwal', [JadwalController::class, 'store'])->name('jadwal.store');
        Route::put('/jadwal/{id}', [JadwalController::class, 'update'])->name('jadwal.update');
        Route::delete('/jadwal/{id}', [JadwalController::class, 'destroy'])->name('jadwal.destroy');

        // ===== KRS (Admin) =====
        Route::get('/krs', [KrsController::class, 'index'])->name('krs.index');
        Route::post('/krs', [KrsController::class, 'store'])->name('krs.store');
        Route::put('/krs/{id}', [KrsController::class, 'update'])->name('krs.update');
        Route::delete('/krs/{id}', [KrsController::class, 'destroy'])->name('krs.destroy');
    });

    // ============================================================
    // ROUTE MAHASISWA (Hanya untuk role: mahasiswa)
    // ============================================================
    Route::middleware('role:mahasiswa')->group(function () {
        
        // ===== KRS Mahasiswa =====
        Route::get('/krs-saya', [KrsController::class, 'indexMahasiswa'])->name('krs.saya');
        Route::get('/ambil-krs', [KrsController::class, 'create'])->name('krs.create');
        Route::post('/ambil-krs', [KrsController::class, 'storeMahasiswa'])->name('krs.store.mahasiswa');
        Route::delete('/hapus-krs/{id}', [KrsController::class, 'destroyMahasiswa'])->name('krs.destroy.mahasiswa');
        
        // ===== BONUS: Export KRS ke PDF =====
        Route::get('/krs-export-pdf', [KrsController::class, 'exportPdf'])->name('krs.export.pdf');

        // ===== JADWAL Mahasiswa =====
        Route::get('/jadwal-semua', [JadwalController::class, 'indexMahasiswa'])->name('jadwal.semua');
        Route::get('/jadwal-saya', [JadwalController::class, 'jadwalSaya'])->name('jadwal.saya');
    });
});

// ============================================================
// ROUTE AUTHENTICATION (Laravel Breeze/Jetstream)
// ============================================================
require __DIR__.'/auth.php';