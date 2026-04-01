<?php

use App\Http\Controllers\Anggota\DashboardController;
use App\Http\Controllers\Anggota\BukuController;
use App\Http\Controllers\Anggota\PinjamBukuController;
use App\Http\Controllers\Anggota\PengembalianController;
use App\Http\Controllers\Petugas\DashboardController as PetugasDashboardController;

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;


// HALAMAN AWAL LANGSUNG KE LOGIN
Route::get('/', [AuthController::class, 'login']);

// LOGIN
Route::get('/login', [AuthController::class, 'login']);
Route::post('/login', [AuthController::class, 'prosesLogin']);

// REGISTER
Route::get('/register', [AuthController::class, 'register']);
Route::post('/register', [AuthController::class, 'prosesRegister']);

// DASBOARD
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// BUKU
Route::get('/anggota/buku', [BukuController::class,'index'])->name('buku.index');
Route::get('/anggota/buku/{id}', [BukuController::class,'detail'])->name('buku.detail');


//  FORM PINJAM (dari detail buku)
Route::get('/anggota/pinjambuku/{id}', [PinjamBukuController::class, 'create'])->name('pinjambuku.create');
//  SIMPAN DATA
Route::post('/anggota/pinjambuku', [PinjamBukuController::class, 'store'])->name('pinjambuku.store');
//  TABEL PEMINJAMAN
Route::get('/anggota/peminjaman', [PinjamBukuController::class, 'index'])->name('peminjaman.index');

//  PENGEMBALIAN
Route::get('/anggota/pengembalian', [PengembalianController::class, 'index'])->name('pengembalian.index');
Route::delete('/anggota/pengembalian/{id}', [PengembalianController::class, 'destroy'])->name('pengembalian.delete');
Route::get('/anggota/pengembalian/create', [PengembalianController::class, 'create'])->name('pengembalian.create');
Route::post('/anggota/pengembalian', [PengembalianController::class, 'store'])->name('pengembalian.store');



Route::get('/petugas/dashboard', [PetugasDashboardController::class, 'index'])
    ->name('petugas.dashboard');
