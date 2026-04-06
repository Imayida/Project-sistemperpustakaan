@extends('layouts.petugas.app')

@section('title', 'Tambah Buku')

@section('content')
<div class="container-fluid">

    <h4 class="fw-bold" style="color:#60a5fa;">Tambah Buku</h4>

    <div class="card shadow-sm border-0 rounded-4 p-4">
        <form action="{{ route('petugas.buku.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Gambar -->
            <div class="mb-3">
                <label class="form-label">Gambar</label>
                <input type="file" name="gambar" class="form-control">
            </div>

            <!-- Judul -->
            <div class="mb-3">
                <label class="form-label">Judul Buku</label>
                <input type="text" name="judul" class="form-control" placeholder="Masukan Judul Buku" required>
            </div>

            <!-- Pengarang -->
            <div class="mb-3">
                <label class="form-label">Pengarang</label>
                <input type="text" name="pengarang" class="form-control" placeholder="Masukan Pengarang" required>
            </div>

            <!-- Penerbit -->
            <div class="mb-3">
                <label class="form-label">Penerbit</label>
                <input type="text" name="penerbit" class="form-control" placeholder="Masukan Penerbit" required>
            </div>

            <!-- Tahun -->
            <div class="mb-3">
                <label class="form-label">Tahun Terbit</label>
                <input type="number" name="tahun" class="form-control" placeholder="Masukan Tahun Terbit" required>
            </div>

            <!-- Stok -->
            <div class="mb-3">
                <label class="form-label">Stok</label>
                <input type="number" name="stok" class="form-control" placeholder="Masukan Stok" required>
            </div>

            <!-- Deskripsi -->
            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="3" placeholder="Masukan Deskripsi"></textarea>
            </div>

            <!-- Button -->
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('petugas.buku.index') }}" class="btn btn-light">Cancel</a>
            </div>

        </form>
    </div>
</div>
@endsection
