@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <!-- HEADER -->
    <div class="mb-4">
        <h4 class="fw-semibold">Form Pinjam Buku</h4>
    </div>

    <!-- FORM CARD -->
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">

            <form action="{{ route('pinjambuku.store') }}" method="POST">
                @csrf

                <!-- Nama -->
                <div class="mb-3">
                    <label class="form-label small text-muted">Nama</label>
                    <input type="text"
                           name="nama"
                           class="form-control"
                           placeholder="Masukan Nama Lengkap">
                </div>

                <!-- Judul Buku (AUTO DARI DETAIL) -->
                <div class="mb-3">
                    <label class="form-label small text-muted">Judul Buku</label>
                    <input type="text"
                           name="judul"
                           class="form-control"
                           value="{{ $buku->judul ?? '' }}"
                           readonly>
                </div>

                <!-- Tanggal Pinjam -->
                <div class="mb-3">
                    <label class="form-label small text-muted">Tanggal Pinjam</label>
                    <input type="date"
                           id="tanggal_pinjam"
                           name="tanggal_pinjam"
                           class="form-control">
                </div>

                <!-- Tanggal Jatuh Tempo (AUTO) -->
                <div class="mb-4">
                    <label class="form-label small text-muted">Tanggal Jatuh Tempo</label>
                    <input type="date"
                           id="tanggal_jatuh_tempo"
                           name="tanggal_jatuh_tempo"
                           class="form-control"
                           readonly>
                </div>

                <!-- BUTTON -->
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary px-4">
                        Meminjam
                    </button>

                    <a href="{{ route('buku.detail', $buku->id) }}" class="btn btn-secondary btn-sm">
    Kembali
</a>
                </div>

            </form>

        </div>
    </div>

</div>

<!-- SCRIPT AUTO JATUH TEMPO -->
<script>
document.getElementById('tanggal_pinjam').addEventListener('change', function() {
    let tgl = new Date(this.value);

    if (!isNaN(tgl)) {
        tgl.setDate(tgl.getDate() + 7);

        let yyyy = tgl.getFullYear();
        let mm = String(tgl.getMonth() + 1).padStart(2, '0');
        let dd = String(tgl.getDate()).padStart(2, '0');

        document.getElementById('tanggal_jatuh_tempo').value = `${yyyy}-${mm}-${dd}`;
    }
});
</script>

@endsection
