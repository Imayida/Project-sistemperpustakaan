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
        $query = Buku::query();

        if ($request->keyword) {
            $query->where(function($q) use ($request) {
                $q->where('judul', 'like', '%' . $request->keyword . '%')
                  ->orWhere('pengarang', 'like', '%' . $request->keyword . '%');
            });
        }

        $buku = $query->get();

        return view('pages.petugas.buku.index', compact('buku'));
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
            'stok' => 'required|numeric',
            'deskripsi' => 'nullable',
            'gambar' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // ✅ CEK DUPLIKAT
        $cek = Buku::where('judul', $request->judul)
                   ->where('pengarang', $request->pengarang)
                   ->first();

        if ($cek) {
            return back()
                ->withInput()
                ->with('error', 'Buku sudah ada di database!');
        }

        // upload gambar
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
            'stok' => 'required|numeric',
            'deskripsi' => 'nullable',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // ✅ CEK DUPLIKAT (kecuali data ini sendiri)
        $cek = Buku::where('judul', $request->judul)
                   ->where('pengarang', $request->pengarang)
                   ->where('id', '!=', $id)
                   ->first();

        if ($cek) {
            return back()
                ->withInput()
                ->with('error', 'Buku dengan judul & pengarang ini sudah ada!');
        }

        // update gambar jika ada
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
