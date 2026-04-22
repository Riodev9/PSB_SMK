<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware(['auth','role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::view('/dashboard', 'admin.dashboard')->name('dashboard');
});

Route::middleware(['auth','role:pelajar'])->prefix('pelajar')->name('pelajar.')->group(function () {
    Route::view('/dashboard', 'pelajar.dashboard')->name('dashboard');
    Route::get('/pelajar/profile', [ProfileController::class, 'edit'])
        ->name('pelajar.profile'); // <-- ini wajib ada
});

use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\InformasiController;
use App\Http\Controllers\Admin\PendaftaranController as PendaftaranAdmin;
use App\Http\Controllers\Admin\TahunAjaranController;
use App\Http\Controllers\Admin\BerkasController;

use App\Http\Controllers\Pelajar\DashboardController as PelajarDashboard;
use App\Http\Controllers\Pelajar\DataDiriController;
use App\Http\Controllers\Pelajar\InformasiController as PelajarInformasi;
use App\Http\Controllers\Pelajar\PendaftaranController as PendaftaranPelajar;

// Admin Routes
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function() {

    //dashboard
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('admin.dashboard');

    //informasi
    Route::get('/informasi', [InformasiController::class, 'index'])
        ->name('admin.informasi');
    Route::post('/informasi', [InformasiController::class, 'store'])
        ->name('admin.informasi.store');
    Route::delete('/informasi/{id}', [InformasiController::class, 'destroy'])
        ->name('admin.informasi.destroy');

    //pendaftaran
    Route::get('/pendaftaran', [PendaftaranAdmin::class, 'index'])
        ->name('admin.pendaftaran');
    Route::post('/pendaftaran/{id}/verifikasi', [PendaftaranAdmin::class, 'verifikasi'])
        ->name('admin.pendaftaran.verifikasi');
    Route::post('/pendaftaran/{id}/tolak', [PendaftaranAdmin::class, 'tolak'])
        ->name('admin.pendaftaran.tolak');

    //berkas    
    Route::get('/berkas', [BerkasController::class, 'index'])->name('admin.berkas');
    Route::post('/berkas/catatan/{id_pendaftar}', [BerkasController::class, 'updateCatatan'])
        ->name('admin.berkas.catatan');

    //tahun ajaran
    Route::get('/tahun-ajaran', [TahunAjaranController::class, 'index'])->name('admin.tahun_ajaran');
    Route::post('/tahun_ajaran', [TahunAjaranController::class, 'store'])->name('admin.tahun_ajaran.store');
    Route::put('/tahun-ajaran/{id}', [TahunAjaranController::class, 'update'])->name('tahun_ajaran.update');
    Route::delete('/tahun-ajaran/{id}', [TahunAjaranController::class, 'destroy'])->name('tahun_ajaran.destroy');

});

// Pelajar Routes
Route::prefix('pelajar')->middleware(['auth', 'role:pelajar'])->group(function() {
    Route::get('/dashboard', [PelajarDashboard::class, 'index'])->name('pelajar.dashboard');
    Route::get('/informasi', [PelajarInformasi::class, 'index'])->name('pelajar.informasi');
    // Data Diri
    Route::get('/data-diri', [DataDiriController::class, 'index'])->name('pelajar.data_diri');
    Route::post('/data-diri', [DataDiriController::class, 'store'])->name('pelajar.data_diri.store');
    //pendaftaran
    Route::get('/pendaftaran', [PendaftaranPelajar::class, 'index'])->name('pelajar.pendaftaran_pelajar');
    Route::post('/pendaftaran/daftar', [PendaftaranPelajar::class, 'daftar'])->name('pelajar.pendaftaran_pelajar.daftar');
});