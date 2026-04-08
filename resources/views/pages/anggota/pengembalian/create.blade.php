@extends('layouts.app')

@section('content')

<h4 class="fw-bold" style="color:#60a5fa;">Form Pengembalian</h4>

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body">

        <form action="{{ route('pengembalian.store') }}" method="POST">
            @csrf

            <!-- Nama -->
            <div class="mb-3">
                <label class="form-label small text-muted">Nama</label>
                <input type="text" id="nama" class="form-control" readonly>
            </div>

            <!-- PILIH PEMINJAMAN (dipindah ke bawah nama) -->
            <div class="mb-3">
                <label>Judul Buku</label>
                <select id="pinjamSelect" name="pinjam_buku_id" class="form-control">
                    @foreach($peminjaman as $item)
                        <option value="{{ $item->id }}"
                            data-nama="{{ $item->nama }}"
                            data-judul="{{ $item->judul }}"
                            data-tanggal="{{ $item->tanggal_pinjam }}"
                            data-tempo="{{ $item->tanggal_jatuh_tempo }}">

                            {{ $item->judul }} - {{ $item->tanggal_pinjam }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Tanggal Pinjam -->
            <div class="mb-3">
                <label class="form-label small text-muted">Tanggal Pinjam</label>
                <input type="date" id="tanggal_pinjam" class="form-control" readonly>
            </div>

            <!-- Tanggal Kembali -->
            <div class="mb-3">
                <label class="form-label small text-muted">Tanggal Kembali</label>
                <input type="date" id="tanggal_kembali" name="tanggal_kembali" class="form-control">
            </div>

            <!-- Jatuh Tempo -->
            <div class="mb-3">
                <label class="form-label small text-muted">Tanggal Jatuh Tempo</label>
                <input type="date" id="jatuh_tempo" class="form-control" readonly>
            </div>

            <!-- Denda -->
            <div class="mb-3">
                <label class="form-label small text-muted">Denda</label>
                <input type="number" id="denda" class="form-control" readonly>
            </div>

            <button type="submit" class="btn btn-primary btn-sm">
                Mengembalikan
            </button>

            <a href="{{ route('pengembalian.index') }}" class="btn btn-secondary btn-sm">
                Kembali
            </a>

        </form>

    </div>
</div>

@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function(){

    let select = document.getElementById('pinjamSelect');
    let nama = document.getElementById('nama');
    let tanggalPinjam = document.getElementById('tanggal_pinjam');
    let tempo = document.getElementById('jatuh_tempo');
    let kembali = document.getElementById('tanggal_kembali');
    let denda = document.getElementById('denda');

    function isiData(){
        let selected = select.options[select.selectedIndex];

        nama.value = selected.dataset.nama;
        tanggalPinjam.value = selected.dataset.tanggal;
        tempo.value = selected.dataset.tempo;

        denda.value = 0;
        kembali.value = "";
    }

    // pertama load
    isiData();

    // saat pilih berubah
    select.addEventListener('change', isiData);

    // hitung denda
    kembali.addEventListener('change', function(){

        let tglKembali = new Date(this.value);
        let tglTempo = new Date(tempo.value);

        if (tglKembali > tglTempo) {
            let selisih = Math.ceil((tglKembali - tglTempo) / (1000*60*60*24));
            denda.value = selisih * 1000;
        } else {
            denda.value = 0;
        }

    });

});
</script>
@endsection
