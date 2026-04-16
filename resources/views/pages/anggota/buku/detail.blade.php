@extends('layouts.app')

@section('content')

<h4 class="fw-bold" style="color:#60a5fa;">Detail Buku</h4>

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

            <!-- Buton Pinjam Buku -->
            <div class="mt-3">
                <form action="{{ route('pinjambuku.store') }}" method="POST" class="d-inline">
                    @csrf
                    <input type="hidden" name="judul" value="{{ $buku->judul }}">
                    <input type="hidden" name="tanggal_pinjam" value="{{ date('Y-m-d') }}">
                    <input type="hidden" name="tanggal_jatuh_tempo" value="{{ date('Y-m-d', strtotime('+7 days')) }}">
                    <button type="submit" class="btn btn-primary">
                        Pinjam Buku
                    </button>
                </form>

               

                <!-- Buton Kembali -->
                <a href="{{ route('buku.index') }}" class="btn btn-secondary">Kembali</a>
            </div>


        </div>

    </div>

</div>

@endsection
