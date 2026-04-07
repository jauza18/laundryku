@extends('adminlte::page')

@section('title', 'Tambah Transaksi')

@section('content_header')
<h1>Tambah Transaksi</h1>
@stop

@section('content')

<div class="card">
<div class="card-body">

<!-- 🔴 TAMPILKAN ERROR -->
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('transaksi.store') }}" method="POST">
@csrf

<div class="form-group">
<label>Nama Pembeli</label>
<input type="text" name="nama_pembeli" class="form-control" value="{{ old('nama_pembeli') }}">
</div>

<div class="form-group">
<label>No Telepon</label>
<input type="text" name="no_telepon" class="form-control" value="{{ old('no_telepon') }}">
</div>

<div class="form-group">
<label>Alamat</label>
<input type="text" name="alamat" class="form-control" value="{{ old('alamat') }}">
</div>

<div class="form-group">
<label>Layanan</label>
<select name="layanan" id="layanan" class="form-control">
<option value="">-- Pilih Layanan --</option>
<option value="Cuci Kering">Cuci Kering</option>
<option value="Cuci Setrika">Cuci Setrika</option>
<option value="Setrika">Setrika</option>
</select>
</div>

<div class="form-group">
<label>Berat (Kg)</label>
<input type="number" id="berat" name="berat" class="form-control">
</div>

<div class="form-group">
<label>Diskon (%)</label>
<input type="number" id="diskon" name="diskon" class="form-control">
</div>

<!-- 🔥 FIELD ASLI (UNTUK DB) -->
<input type="hidden" id="total_harga" name="total_harga">

<div class="form-group">
<label>Total Harga</label>
<input type="text" id="total_harga_view" class="form-control" readonly>
</div>

<!-- TANGGAL MASUK -->
<div class="form-group">
<label>Tanggal Masuk</label>
<input type="date" name="tanggal_masuk" class="form-control">
</div>

<div class="form-group">
<label>Status Pesanan</label>
<select name="status_pesanan" class="form-control">
<option value="Proses">Proses</option>
<option value="Selesai">Selesai</option>
<option value="Diambil">Diambil</option>
</select>
</div>

<button type="submit" class="btn btn-primary">Simpan</button>
<a href="{{ route('transaksi.index') }}" class="btn btn-secondary">Batal</a>

</form>

</div>
</div>

<!-- 🔥 SCRIPT OTOMATIS -->
<script>
function hitungTotal() {

    let layanan = document.getElementById('layanan').value;
    let berat = parseFloat(document.getElementById('berat').value) || 0;
    let diskon = parseFloat(document.getElementById('diskon').value) || 0;

    let hargaPerKg = 0;

    if (layanan === "Cuci Kering") hargaPerKg = 5000;
    if (layanan === "Cuci Setrika") hargaPerKg = 7000;
    if (layanan === "Setrika") hargaPerKg = 4000;

    let total = berat * hargaPerKg;

    // diskon
    total = total - (total * diskon / 100);

    if (total < 0) total = 0;

    // 🔥 SIMPAN ANGKA ASLI
    document.getElementById('total_harga').value = total;

    // 🔥 TAMPILKAN FORMAT RP
    document.getElementById('total_harga_view').value =
        "Rp " + total.toLocaleString('id-ID');
}

// realtime
document.getElementById('layanan').addEventListener('change', hitungTotal);
document.getElementById('berat').addEventListener('input', hitungTotal);
document.getElementById('diskon').addEventListener('input', hitungTotal);
</script>

@stop