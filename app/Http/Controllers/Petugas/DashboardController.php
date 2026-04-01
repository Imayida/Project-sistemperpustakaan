<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Anggota\Pinjambuku;
use App\Models\Anggota\Buku;

class DashboardController extends Controller
{
    public function index()
    {
        // 📊 total anggota
        $totalAnggota = User::where('role', 'anggota')->count();

        // 📚 total buku
        $totalBuku = Buku::count();

        // 💰 total denda (sementara / bisa kamu ubah nanti)
        $totalDenda = 0;

        // 📋 data peminjaman terbaru + relasi
        $peminjaman = Pinjambuku::with(['user', 'buku'])
                            ->latest()
                            ->take(5)
                            ->get();

        // kirim ke view
        return view('pages.petugas.dashboard.index', compact(
            'totalAnggota',
            'totalBuku',
            'totalDenda',
            'peminjaman'
        ));
    }
}
