@extends('layouts.petugas.app')

@section('title', 'Edit Buku')

@section('content')
<div class="container-fluid">

    <h4 class="fw-bold">Edit Buku</h4>

    <div class="card shadow-sm border-0 rounded-4 p-4">
        <form action="{{ route('petugas.buku.update', $buku->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Gambar -->
            <div class="mb-3">
                <label class="form-label">Gambar</label><br>

                <img src="{{ $buku->gambar ? asset('storage/'.$buku->gambar) : asset('images/no-image.png') }}"
                     width="120" class="mb-2">

                <input type="file" name="gambar" class="form-control">
            </div>

            <!-- Judul -->
            <div class="mb-3">
                <label class="form-label">Judul Buku</label>
                <input type="text" name="judul" class="form-control"
                       value="{{ $buku->judul }}" required>
            </div>

            <!-- Pengarang -->
            <div class="mb-3">
                <label class="form-label">Pengarang</label>
                <input type="text" name="pengarang" class="form-control"
                       value="{{ $buku->pengarang }}" required>
            </div>

            <!-- Penerbit -->
            <div class="mb-3">
                <label class="form-label">Penerbit</label>
                <input type="text" name="penerbit" class="form-control"
                       value="{{ $buku->penerbit }}" required>
            </div>

            <!-- Tahun -->
            <div class="mb-3">
                <label class="form-label">Tahun Terbit</label>
                <input type="number" name="tahun" class="form-control"
                       value="{{ $buku->tahun_terbit }}" required>
            </div>

            <!-- Stok -->
            <div class="mb-3">
                <label class="form-label">Stok</label>
                <input type="number" name="stok" class="form-control"
                       value="{{ $buku->stok }}" required>
            </div>

            <!-- Deskripsi -->
            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="3">{{ $buku->deskripsi }}</textarea>
            </div>

            <!-- Button -->
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('petugas.buku.index') }}" class="btn btn-light">Cancel</a>
            </div>

        </form>
    </div>
</div>
@endsection
