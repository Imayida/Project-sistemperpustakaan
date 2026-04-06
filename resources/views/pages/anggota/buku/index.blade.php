@extends('layouts.app')

@section('content')

<style>
    .search-box {
        width: 280px;
    }

    .col-custom {
        width: 20%;
    }

    @media (max-width: 992px) {
        .col-custom { width: 33.33%; }
    }

    @media (max-width: 576px) {
        .col-custom { width: 50%; }
    }

    .buku-card {
        height: 100%;
        max-width: 180px;
        margin: auto;
        border-radius: 12px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

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
    <h4 class="fw-bold" style="color:#60a5fa;">Koleksi Buku</h4>

    <div class="mx-auto" style="width:280px;">
        <input type="text"
               id="search"
               class="form-control"
               placeholder="Search..."
               style="border-radius:10px;">
    </div>
</div>

<div class="row g-4">

    @forelse($buku as $b)
        <div class="buku-item col-custom" data-judul="{{ strtolower($b->judul) }}">
            <div class="card shadow-sm border-0 text-center p-3 buku-card">

                <!-- GAMBAR -->
                <div class="img-wrapper">
                    <img src="{{ $b->gambar ? asset('storage/'.$b->gambar) : asset('images/no-image.png') }}"
                         class="buku-img">
                </div>

                <!-- JUDUL -->
                <h6 class="mb-2" style="font-size:14px; font-weight:500;">
                    {{ $b->judul }}
                </h6>

                <!-- BUTTON -->
                <a href="{{ route('buku.detail', $b->id) }}"
                   class="btn btn-primary btn-sm">
                    Detail
                </a>

            </div>
        </div>
    @empty
        <div class="text-center">
            <p>Tidak ada buku tersedia</p>
        </div>
    @endforelse

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
