<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use App\Models\Anggota\PinjamBuku;
use App\Models\Petugas\Buku;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // 🔹 ambil user login
        $user = Auth::user();

        // 🔹 data tabel (hanya milik user login)
        $peminjaman = PinjamBuku::where('nama', $user->name)
            ->latest()
            ->take(5)
            ->get();

        // 🔹 TOTAL DATA
        $totalPinjam = PinjamBuku::where('nama', $user->name)->count();

        $totalKembali = PinjamBuku::where('nama', $user->name)
            ->where('status', 'dikembalikan')
            ->count();

        $totalBuku = Buku::count();

        // 🔹 hanya hitung anggota
        $totalAnggota = User::where('role', 'anggota')->count();

        return view('pages.anggota.dashboard.index', compact(
            'peminjaman',
            'totalPinjam',
            'totalKembali',
            'totalBuku',
            
        ));
    }
}
