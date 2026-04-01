@extends('layouts.app')

@section('content')

<h4 class="fw-semibold mb-4">Form Pengembalian</h4>

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body">

        <form action="{{ route('pengembalian.store') }}" method="POST">
            @csrf

            <!-- Nama -->
            <div class="mb-3">
                <label class="form-label small text-muted">Nama</label>
                <input type="text" name="nama" class="form-control" placeholder="Masukkan nama lengkap">
            </div>

            <!-- Judul Buku -->
            <div class="mb-3">
                <label class="form-label small text-muted">Judul Buku</label>
                <input type="text" name="judul" class="form-control" placeholder="Masukkan judul buku">
            </div>

            <!-- Tanggal Pinjam -->
            <div class="mb-3">
                <label class="form-label small text-muted">Tanggal Pinjam</label>
                <input type="date" id="tanggal_pinjam" name="tanggal_pinjam" class="form-control" readonly>
            </div>

            <!-- Tanggal Kembali -->
            <div class="mb-3">
                <label class="form-label small text-muted">Tanggal Kembali</label>
                <input type="date" id="tanggal_kembali" name="tanggal_kembali" class="form-control">
            </div>

            <!-- Tanggal Jatuh Tempo -->
            <div class="mb-3">
                <label class="form-label small text-muted">Tanggal Jatuh Tempo</label>
                <input type="date" id="jatuh_tempo" name="tanggal_jatuh_tempo" class="form-control" readonly>
            </div>

            <!-- Denda -->
            <div class="mb-3">
                <label class="form-label small text-muted">Jumlah Denda</label>
                <input type="number" id="denda" name="denda" class="form-control" readonly>
            </div>

            <!-- Tombol -->
            <div class="mt-4">
                <button class="btn btn-primary btn-sm">
                    Mengembalikan
                </button>

                <a href="{{ route('pengembalian.index') }}" class="btn btn-secondary btn-sm">
                    Cancel
                </a>
            </div>

        </form>

    </div>
</div>

@endsection


{{-- 🔥 SCRIPT AUTO --}}
@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {

    let tanggalPinjam = document.getElementById('tanggal_pinjam');
    let tanggalKembali = document.getElementById('tanggal_kembali');
    let jatuhTempo = document.getElementById('jatuh_tempo');
    let denda = document.getElementById('denda');

    // 🔹 otomatis isi tanggal pinjam hari ini
    let today = new Date().toISOString().split('T')[0];
    tanggalPinjam.value = today;

    // 🔹 otomatis jatuh tempo +7 hari
    let tempo = new Date();
    tempo.setDate(tempo.getDate() + 7);
    jatuhTempo.value = tempo.toISOString().split('T')[0];

    // 🔹 hitung denda saat tanggal kembali dipilih
    tanggalKembali.addEventListener('change', function() {

        let kembali = new Date(this.value);
        let tempoDate = new Date(jatuhTempo.value);

        if (kembali > tempoDate) {
            let selisih = Math.ceil((kembali - tempoDate) / (1000 * 60 * 60 * 24));
            denda.value = selisih * 1000; // 1000 per hari
        } else {
            denda.value = 0;
        }

    });

});
</script>
@endsection
