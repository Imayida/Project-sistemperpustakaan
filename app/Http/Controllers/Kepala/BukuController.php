<?php

namespace App\Http\Controllers\Kepala;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kepala\Buku;

class BukuController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $showAll = $request->show_all;

        $query = Buku::query();

        // SEARCH
        if ($keyword) {
            $query->where('judul', 'like', "%{$keyword}%");
        }

        // LIMIT 5 kalau belum klik "lihat semua"
        if (!$showAll) {
            $query->limit(5);
        }

        $buku = $query->get();

        return view('pages.kepala.buku.index', compact('buku', 'showAll'));
    }

    public function detail($id)
    {
        $buku = Buku::findOrFail($id);
        return view('pages.kepala.buku.detail', compact('buku'));
    }
}
