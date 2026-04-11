<?php

namespace App\Http\Controllers\Kepala;

use App\Http\Controllers\Controller;
use App\Models\Petugas\Buku;
use App\Models\Petugas\PinjamBuku;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        // TOTAL ANGGOTA
        $totalAnggota = User::where('role', 'anggota')->count();

        // TOTAL BUKU
        $totalBuku = Buku::count();

        // TOTAL PEMINJAMAN
        $totalPeminjaman = PinjamBuku::count();

        // TOTAL DIKEMBALIKAN
        $totalDikembalikan = PinjamBuku::where('status', 'dikembalikan')->count();

        return view('pages.kepala.dashboard.index', compact(
            'totalAnggota',
            'totalBuku',
            'totalPeminjaman',
            'totalDikembalikan'
        ));
    }
}
