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
        // Total anggota
        $totalAnggota = User::where('role', 'anggota')->count();

        // Total buku
        $totalBuku = Buku::count();

        // Total peminjaman
        $totalPeminjaman = PinjamBuku::count();

        // Total dikembalikan
        $totalDikembalikan = PinjamBuku::where('status', 'dikembalikan')->count();

        return view('pages.kepala.dashboard.index', compact(
            'totalAnggota',
            'totalBuku',
            'totalPeminjaman',
            'totalDikembalikan'
        ));
    }
}
