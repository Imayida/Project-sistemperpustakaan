<?php

use App\Http\Controllers\Anggota\BukuController;
use App\Http\Controllers\Anggota\DashboardController;
use App\Http\Controllers\Anggota\PengembalianController;
use App\Http\Controllers\Anggota\PinjamBukuController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Kepala\BukuController as KepalaBukuController;
use App\Http\Controllers\Kepala\DashboardController as KepalaDashboardController;
use App\Http\Controllers\Kepala\LaporanController;
use App\Http\Controllers\Petugas\AnggotaController;
use App\Http\Controllers\Petugas\BukuController as PetugasBukuController;
use App\Http\Controllers\Petugas\DashboardController as PetugasDashboardController;
use App\Http\Controllers\Petugas\PengembalianController as PetugasPengembalianController;
use App\Http\Controllers\Petugas\PinjamBukuController as PetugasPinjamBukuController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

Route::get('/', [AuthController::class, 'login']);
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'prosesLogin']);

Route::get('/register', [AuthController::class, 'register']);
Route::post('/register', [AuthController::class, 'prosesRegister']);

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');


/*
|--------------------------------------------------------------------------
| ANGGOTA
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:anggota'])->prefix('anggota')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Buku
    Route::get('/buku', [BukuController::class, 'index'])->name('buku.index');
    Route::get('/buku/{id}', [BukuController::class, 'detail'])->name('buku.detail');

    // Peminjaman
    Route::get('/pinjambuku/{id}', [PinjamBukuController::class, 'create'])->name('pinjambuku.create');
    Route::post('/pinjambuku', [PinjamBukuController::class, 'store'])->name('pinjambuku.store');
    Route::get('/peminjaman', [PinjamBukuController::class, 'index'])->name('peminjaman.index');

    // Pengembalian
   Route::get('/pengembalian', [PengembalianController::class, 'index'])
    ->name('pengembalian.index');

Route::get('/pengembalian/create', [PengembalianController::class, 'create'])
    ->name('pengembalian.create');

Route::post('/pengembalian', [PengembalianController::class, 'store'])
    ->name('pengembalian.store');

Route::delete('/pengembalian/{id}', [PengembalianController::class, 'destroy'])
    ->name('pengembalian.delete');
});

Route::get('/anggota/pengembalian/create', [App\Http\Controllers\Anggota\PengembalianController::class, 'create'])
    ->name('pengembalian.create.simple');

/*
|--------------------------------------------------------------------------
| PETUGAS
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:petugas'])->prefix('petugas')->group(function () {

    Route::get('/dashboard', [PetugasDashboardController::class, 'index'])->name('petugas.dashboard');

    // Buku (CRUD)
    Route::resource('/buku', PetugasBukuController::class)->names('petugas.buku');

    // Peminjaman
    Route::resource('/peminjaman', PetugasPinjamBukuController::class)->names('petugas.peminjaman');

    Route::post('/peminjaman/{id}/kembalikan', [PetugasPinjamBukuController::class, 'kembalikan'])
        ->name('petugas.peminjaman.kembalikan');

    Route::post('/peminjaman/{id}/setujui', [PetugasPinjamBukuController::class, 'setujui'])
        ->name('petugas.peminjaman.setujui');

    Route::post('/peminjaman/{id}/tolak', [PetugasPinjamBukuController::class, 'tolak'])
        ->name('petugas.peminjaman.tolak');

    // Anggota
    Route::get('/anggota', [AnggotaController::class, 'index'])->name('petugas.anggota.index');
    Route::delete('/anggota/{id}', [AnggotaController::class, 'delete'])->name('petugas.anggota.delete');

    // Pengembalian
    Route::get('/pengembalian', [PetugasPengembalianController::class, 'index'])
        ->name('petugas.pengembalian.index');

    Route::post('/pengembalian/{id}/setujui', [PetugasPengembalianController::class, 'setujui'])
        ->name('petugas.pengembalian.setujui');

    Route::post('/pengembalian/{id}/tolak', [PetugasPengembalianController::class, 'tolak'])
        ->name('petugas.pengembalian.tolak');

    Route::post('/pengembalian/{id}/selesai', [PetugasPengembalianController::class, 'selesai'])
        ->name('petugas.pengembalian.selesai');

    Route::delete('/pengembalian/{id}', [PetugasPengembalianController::class, 'destroy'])
        ->name('petugas.pengembalian.delete');
});


/*
|--------------------------------------------------------------------------
| KEPALA
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:kepala'])->prefix('kepala')->group(function () {

    Route::get('/dashboard', [KepalaDashboardController::class, 'index'])->name('kepala.dashboard');

    Route::get('/buku', [KepalaBukuController::class, 'index'])->name('kepala.buku.index');

    Route::get('/buku/{id}', [KepalaBukuController::class, 'detail'])->name('kepala.buku.detail');

Route::get('/laporan', [LaporanController::class, 'index'])->name('kepala.laporan');

Route::get('/laporan/pdf', [LaporanController::class, 'exportPdf'])
    ->name('kepala.laporan.pdf');
});
