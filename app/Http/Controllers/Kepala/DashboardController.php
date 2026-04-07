<?php

namespace App\Http\Controllers\Kepala;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Petugas\Buku;
use App\Models\Petugas\PinjamBuku;

class DashboardController extends Controller
{
    public function index()
    {
        $totalAnggota = User::where('role', 'anggota')->count();
        $totalBuku = Buku::count();
        $totalPeminjaman = PinjamBuku::count();
$totalTerlambat = PinjamBuku::where('status', 'terlambat')->count();

        return view('pages.kepala.dashboard.index', compact(
            'totalAnggota',
            'totalBuku',
            'totalPeminjaman',
            'totalTerlambat'
        ));
    }
}
