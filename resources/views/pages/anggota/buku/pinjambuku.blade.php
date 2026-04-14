@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <!-- HEADER -->
    <div class="mb-4">
        <h4 class="fw-bold" style="color:#60a5fa;">Form Pinjam Buku</h4>
    </div>

    <!-- ALERT ERROR -->
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- ALERT SUCCESS -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- INFO JUMLAH PINJAMAN -->
    @if(isset($jumlahPinjam))
        <div class="alert alert-info">
            Buku yang sedang dipinjam: <b>{{ $jumlahPinjam }} / 3</b>
        </div>
    @endif

    <!-- FORM CARD -->
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">

            <form action="{{ route('pinjambuku.store') }}" method="POST">
                @csrf

                <!-- NAMA -->
                <div class="mb-3">
                    <label class="form-label small text-muted">Nama</label>
                    <input type="text"
                           class="form-control"
                           value="{{ auth()->user()->name }}"
                           readonly>
                </div>

                <!-- JUDUL BUKU -->
                <div class="mb-3">
                    <label class="form-label small text-muted">Judul Buku</label>
                    <input type="text"
                           name="judul"
                           class="form-control"
                           value="{{ $buku->judul ?? '' }}"
                           readonly>
                </div>

                <!-- TANGGAL PINJAM -->
                <div class="mb-3">
                    <label class="form-label small text-muted">Tanggal Pinjam</label>
                    <input type="date"
                           id="tanggal_pinjam"
                           name="tanggal_pinjam"
                           class="form-control"
                           value="{{ date('Y-m-d') }}"
                           readonly>
                </div>

                <!-- TANGGAL JATUH TEMPO -->
                <div class="mb-4">
                    <label class="form-label small text-muted">Tanggal Jatuh Tempo</label>
                    <input type="date"
                           id="tanggal_jatuh_tempo"
                           name="tanggal_jatuh_tempo"
                           class="form-control"
                           readonly
                           required>
                </div>

                <!-- BUTTON -->
                <div class="d-flex gap-2">

                    @if(isset($jumlahPinjam) && $jumlahPinjam >= 3)
                        <button class="btn btn-secondary px-4" disabled>
                            Maksimal 3 Buku
                        </button>
                    @else
                        <button type="submit" class="btn btn-primary px-4">
                            Meminjam
                        </button>
                    @endif

                    <a href="{{ route('buku.detail', $buku->id) }}" class="btn btn-secondary btn-sm">
                        Kembali
                    </a>

                </div>

            </form>

        </div>
    </div>

</div>

<!-- SCRIPT AUTO TANGGAL -->
<script>
window.addEventListener('load', function() {
    let inputPinjam = document.getElementById('tanggal_pinjam');
    let inputTempo = document.getElementById('tanggal_jatuh_tempo');

    let tgl = new Date(inputPinjam.value);

    if (!isNaN(tgl)) {
        tgl.setDate(tgl.getDate() + 7);

        let yyyy = tgl.getFullYear();
        let mm = String(tgl.getMonth() + 1).padStart(2, '0');
        let dd = String(tgl.getDate()).padStart(2, '0');

        inputTempo.value = `${yyyy}-${mm}-${dd}`;
    }
});
</script>

@endsection
