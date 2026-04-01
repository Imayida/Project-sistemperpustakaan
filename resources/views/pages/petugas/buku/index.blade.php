@extends('layouts.app')

@section('content')

<style>
    .search-box {
        width: 280px;
    }

    /* 5 kolom */
    .col-custom {
        width: 20%;
    }

    @media (max-width: 992px) {
        .col-custom { width: 33.33%; }
    }

    @media (max-width: 576px) {
        .col-custom { width: 50%; }
    }

    /* CARD BIAR SAMA SEMUA */
    .buku-card {
        height: 100%;
        max-width: 180px;
        margin: auto;
        border-radius: 12px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    /* WRAPPER GAMBAR BIAR SAMA */
    .img-wrapper {
        height: 150px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .buku-img {
        max-height: 100%;
        max-width: 100%;
        object-fit: contain;
    }
</style>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold">Koleksi Buku</h4>

    <div class="mx-auto" style="width:280px;">
<input type="text"
       id="search"
       class="form-control"
       placeholder="Search..."
       style="border-radius:10px;">
</div>
</div>



<div class="row g-4">

    <!-- Buku 1 -->
    <div class="buku-item col-custom" data-judul="hujan">
        <div class="card shadow-sm border-0 text-center p-3 buku-card">
            <div class="img-wrapper">
                <img src="{{ asset('storage/hujan.jpg') }}" class="buku-img">
            </div>
            <h6 class="mb-2" style="font-size:14px; font-weight:500;">Hujan</h6>
            <a href="/anggota/buku/1" class="btn btn-primary btn-sm">Detail</a>
        </div>
    </div>

    <!-- Buku 2 -->
    <div class="buku-item col-custom" data-judul="sejarah indonesia">
        <div class="card shadow-sm border-0 text-center p-3 buku-card">
            <div class="img-wrapper">
                <img src="{{ asset('storage/Sejarah-Indonesia-Masa-Kemerdekaan.jpg') }}" class="buku-img">
            </div>
            <h6 class="mb-2" style="font-size:14px; font-weight:500;">Sejarah Indonesia</h6>
            <a href="/anggota/buku/2" class="btn btn-primary btn-sm">Detail</a>
        </div>
    </div>

    <!-- Buku 3 -->
    <div class="buku-item col-custom" data-judul="sang kancil digigit buaya">
        <div class="card shadow-sm border-0 text-center p-3 buku-card">
            <div class="img-wrapper">
                <img src="{{ asset('storage/sang kancil.jpg') }}" class="buku-img">
            </div>
            <h6 class="mb-2" style="font-size:14px; font-weight:500;">Sang Kancil Digigit Buaya</h6>
            <a href="/anggota/buku/3" class="btn btn-primary btn-sm">Detail</a>
        </div>
    </div>

    <!-- Buku 4 -->
    <div class="buku-item col-custom" data-judul="kamus inggris indonesia">
        <div class="card shadow-sm border-0 text-center p-3 buku-card">
            <div class="img-wrapper">
                <img src="{{ asset('storage/kamus.jpg') }}" class="buku-img">
            </div>
            <h6 class="mb-2" style="font-size:14px; font-weight:500;">Kamus Inggris Indonesia</h6>
            <a href="/anggota/buku/4" class="btn btn-primary btn-sm">Detail</a>
        </div>
    </div>

    <!-- Buku 5 -->
    <div class="buku-item col-custom" data-judul="bandung after rain">
        <div class="card shadow-sm border-0 text-center p-3 buku-card">
            <div class="img-wrapper">
                <img src="{{ asset('storage/bandung after rain.jpg') }}" class="buku-img">
            </div>
            <h6 class="mb-2" style="font-size:14px; font-weight:500;">Bandung After Rain</h6>
            <a href="/anggota/buku/5" class="btn btn-primary btn-sm">Detail</a>
        </div>
    </div>

    <!-- Buku 6 (FIX GAMBAR) -->
    <div class="buku-item col-custom" data-judul="ensiklopedia sains">
        <div class="card shadow-sm border-0 text-center p-3 buku-card">
            <div class="img-wrapper">
                <img src="{{ asset('storage/Ensiklopedia_Sains.jpg.jpg') }}" class="buku-img">
            </div>
            <h6 class="mb-2" style="font-size:14px; font-weight:500;">Ensiklopedia Sains</h6>
            <a href="/anggota/buku/6" class="btn btn-primary btn-sm">Detail</a>
        </div>
    </div>

    <!-- Buku 7 -->
    <div class="buku-item col-custom" data-judul="ayo kita kejar bintang itu">
        <div class="card shadow-sm border-0 text-center p-3 buku-card">
            <div class="img-wrapper">
                <img src="{{ asset('storage/ayo kita kejar bintang itu.jpg') }}" class="buku-img">
            </div>
            <h6 class="mb-2" style="font-size:14px; font-weight:500;">Ayo Kita Kejar Bintang Itu</h6>
            <a href="/anggota/buku/8" class="btn btn-primary btn-sm">Detail</a>
        </div>
    </div>

    <!-- Buku 8 -->
    <div class="buku-item col-custom" data-judul="lila and the magic seed">
        <div class="card shadow-sm border-0 text-center p-3 buku-card">
            <div class="img-wrapper">
                <img src="{{ asset('storage/lila and the magic seed.jpg') }}" class="buku-img">
            </div>
            <h6 class="mb-2" style="font-size:14px; font-weight:500;">Lila And The Magic Seed</h6>
            <a href="/anggota/buku/9" class="btn btn-primary btn-sm">Detail</a>
        </div>
    </div>

    <!-- Buku 9 -->
    <div class="buku-item col-custom" data-judul="seni budaya">
        <div class="card shadow-sm border-0 text-center p-3 buku-card">
            <div class="img-wrapper">
                <img src="{{ asset('storage/seni budaya.jpg') }}" class="buku-img">
            </div>
            <h6 class="mb-2" style="font-size:14px; font-weight:500;">Seni Budaya</h6>
            <a href="/anggota/buku/10" class="btn btn-primary btn-sm">Detail</a>
        </div>
    </div>

    <!-- Buku 10 -->
    <div class="buku-item col-custom" data-judul="hukum perdata">
        <div class="card shadow-sm border-0 text-center p-3 buku-card">
            <div class="img-wrapper">
                <img src="{{ asset('storage/hukum perdata.jpeg') }}" class="buku-img">
            </div>
            <h6 class="mb-2" style="font-size:14px; font-weight:500;">Hukum Perdata</h6>
            <a href="/anggota/buku/11" class="btn btn-primary btn-sm">Detail</a>
        </div>
    </div>

</div>

@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {

    const search = document.getElementById('search');
    const items = document.querySelectorAll('.buku-item');

    search.addEventListener('keyup', function() {
        let keyword = this.value.toLowerCase();

        items.forEach(function(item) {
            let judul = item.getAttribute('data-judul');

            if (judul.includes(keyword)) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    });

});
</script>
@endsection

