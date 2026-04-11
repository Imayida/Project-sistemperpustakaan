<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Anggota\Buku;

class BukuController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $showAll = $request->show_all;

        $query = Buku::query();

        // SEARCH
        if ($keyword) {
            $query->where(function($q) use ($keyword) {
                $q->where('judul', 'like', "%{$keyword}%")
                  ->orWhere('pengarang', 'like', "%{$keyword}%")
                  ->orWhere('penerbit', 'like', "%{$keyword}%");
            });
        }

        // 5 DATA
        if (!$showAll) {
            $query->limit(5);
        }

        $buku = $query->get();

        return view('pages.anggota.buku.index', compact('buku', 'showAll'));
    }

    public function detail($id)
    {
        $buku = Buku::findOrFail($id);
        return view('pages.anggota.buku.detail', compact('buku'));
    }
}
