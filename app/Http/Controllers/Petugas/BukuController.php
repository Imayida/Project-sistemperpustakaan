<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Petugas\Buku;
use Illuminate\Support\Facades\Storage;

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

        // BATASI 5 DATA
        if (!$showAll) {
            $query->limit(5);
        }

        $buku = $query->get();

        return view('pages.petugas.buku.index', compact('buku', 'showAll'));
    }

    public function create()
    {
        return view('pages.petugas.buku.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'pengarang' => 'required',
            'penerbit' => 'required',
            'tahun' => 'required|numeric',
            'stok' => 'required|integer|min:0',
            'deskripsi' => 'nullable',
            'gambar' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $cek = Buku::where('judul', $request->judul)
                   ->where('pengarang', $request->pengarang)
                   ->exists();

        if ($cek) {
            return back()->withInput()->with('error', 'Buku sudah ada!');
        }

        $gambar = $request->file('gambar')->store('buku', 'public');

        Buku::create([
            'judul' => $request->judul,
            'pengarang' => $request->pengarang,
            'penerbit' => $request->penerbit,
            'tahun_terbit' => $request->tahun,
            'stok' => $request->stok,
            'deskripsi' => $request->deskripsi,
            'gambar' => $gambar,
        ]);

        return redirect()->route('petugas.buku.index')
            ->with('success', 'Buku berhasil ditambahkan');
    }

    public function show($id)
    {
        $buku = Buku::findOrFail($id);
        return view('pages.petugas.buku.detail', compact('buku'));
    }

    public function edit($id)
    {
        $buku = Buku::findOrFail($id);
        return view('pages.petugas.buku.edit', compact('buku'));
    }

    public function update(Request $request, $id)
    {
        $buku = Buku::findOrFail($id);

        $request->validate([
            'judul' => 'required',
            'pengarang' => 'required',
            'penerbit' => 'required',
            'tahun' => 'required|numeric',
            'stok' => 'required|integer|min:0',
            'deskripsi' => 'nullable',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $cek = Buku::where('judul', $request->judul)
                   ->where('pengarang', $request->pengarang)
                   ->where('id', '!=', $id)
                   ->exists();

        if ($cek) {
            return back()->withInput()->with('error', 'Buku sudah ada!');
        }

        if ($request->hasFile('gambar')) {
            if ($buku->gambar) {
                Storage::disk('public')->delete($buku->gambar);
            }
            $gambar = $request->file('gambar')->store('buku', 'public');
        } else {
            $gambar = $buku->gambar;
        }

        $buku->update([
            'judul' => $request->judul,
            'pengarang' => $request->pengarang,
            'penerbit' => $request->penerbit,
            'tahun_terbit' => $request->tahun,
            'stok' => $request->stok,
            'deskripsi' => $request->deskripsi,
            'gambar' => $gambar,
        ]);

        return redirect()->route('petugas.buku.index')
            ->with('success', 'Buku berhasil diupdate');
    }

    public function destroy($id)
    {
        $buku = Buku::findOrFail($id);

        if ($buku->gambar) {
            Storage::disk('public')->delete($buku->gambar);
        }

        $buku->delete();

        return redirect()->route('petugas.buku.index')
            ->with('success', 'Buku berhasil dihapus');
    }
}
