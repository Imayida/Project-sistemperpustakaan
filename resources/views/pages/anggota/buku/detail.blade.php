@extends('layouts.app')

@section('content')

<h4 class="fw-bold">Detail Buku</h4>

<div class="card shadow-sm p-4">

    <div class="row">

        <!-- Cover Buku -->
        <div class="col-md-4 text-center">
            <img src="{{ asset('storage/' . $buku->gambar) }}"
                 class="img-fluid"
                 style="height:220px; object-fit:cover;">
        </div>

        <!-- Detail Buku -->
        <div class="col-md-8">

            <p><b>Judul Buku :</b> {{ $buku->judul }}</p>
            <p><b>Pengarang :</b> {{ $buku->pengarang }}</p>
            <p><b>Penerbit :</b> {{ $buku->penerbit }}</p>
            <p><b>Tahun Terbit :</b> {{ $buku->tahun_terbit }}</p>
            <p><b>Stok :</b> {{ $buku->stok }}</p>

            <p><b>Deskripsi</b></p>

            <p>
                {{ $buku->deskripsi }}
            </p>

            <div class="mt-3">
                <a href="{{ route('pinjambuku.create', $buku->id) }}" class="btn btn-primary">
                    Pinjam Buku
                </a>
                <a href="{{ route('buku.index') }}" class="btn btn-secondary">Kembali</a>
            </div>


        </div>

    </div>

</div>

@endsection
