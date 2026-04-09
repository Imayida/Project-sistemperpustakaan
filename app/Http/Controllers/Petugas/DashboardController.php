<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Petugas\PinjamBuku;
use App\Models\Anggota\Buku;
use App\Models\Petugas\Pengembalian;

class DashboardController extends Controller
{
    public function index()
    {
        // 📊 total anggota
        $totalAnggota = User::where('role', 'anggota')->count();

        // 📚 total buku
        $totalBuku = Buku::count();

        // 💰 total denda (sementara)
        $totalDenda = Pengembalian::sum('denda');

        // 🔥 AMBIL DATA PEMINJAMAN PETUGAS (BUKAN ANGGOTA)
        $peminjaman = PinjamBuku::latest()->take(5)->get();

        return view('pages.petugas.dashboard.index', compact(
            'totalAnggota',
            'totalBuku',
            'totalDenda',
            'peminjaman'
        ));
    }
}
