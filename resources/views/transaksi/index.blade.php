@extends('adminlte::page')

@section('title', 'Data Transaksi')

@section('content_header')
<h1>Data Transaksi</h1>
@stop

@section('content')

<div class="card">
 <div class="card-header">
    <h3 class="card-title">Daftar Transaksi</h3>
    <div class="card-tools">

    <a href="{{ route('transaksi.cetak-pdf') }}" class="btn btn-danger btn-sm" target="_blank">
        <i class="fas fa-file-pdf"></i> Cetak PDF
    </a>

    <a href="{{ route('transaksi.create') }}" class="btn btn-primary btn-sm">
        <i class="fas fa-plus"></i> Tambah Transaksi
    </a>

</div>
</div>

<div class="card-body pb-0">

<form action="{{ route('transaksi.index') }}" method="GET" class="mb-3">
<div class="input-group">

<input type="text" name="search" class="form-control" placeholder="Cari nama pembeli atau no hp" value="{{ request('search') }}">

<div class="input-group-append">
<button class="btn btn-primary">
<i class="fas fa-search"></i> Cari
</button>
</div>

</div>
</form>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show">
{{ session('success') }}
</div>
@endif

</div>

<div class="card-body table-responsive p-0">

<table class="table table-hover text-nowrap">

<thead>
<tr>
<th>No</th>
<th>Nama Pembeli</th>
<th>No Telepon</th>
<th>Alamat</th>
<th>Layanan</th>
<th>Berat (kg)</th>
<th>Diskon (%)</th>
<th>Total Harga</th>
<th>Status Pesanan</th>
<th>Tanggal Masuk</th> <!-- PINDAH KE SINI -->
<th>Aksi</th>
</tr>
</thead>

<tbody>

@forelse ($transaksis as $key => $transaksi)
<tr>

<td>{{ $transaksis->firstItem() + $key }}</td>
<td>{{ $transaksi->nama_pembeli }}</td>
<td>{{ $transaksi->no_telepon }}</td>
<td>{{ $transaksi->alamat }}</td>
<td>{{ $transaksi->layanan }}</td>
<td>{{ $transaksi->berat }} Kg</td>
<td>{{ $transaksi->diskon }} %</td>

<td>
    <span style="color:#16a34a; font-weight:600;">
        Rp {{ number_format($transaksi->total_harga,0,',','.') }}
    </span>
</td>

<td>
@if($transaksi->status_pesanan == 'Proses')
<span class="badge badge-warning">Proses</span>
@elseif($transaksi->status_pesanan == 'Selesai')
<span class="badge badge-success">Selesai</span>
@else
<span class="badge badge-primary">Diambil</span>
@endif
</td>

<!-- TANGGAL MASUK (SUDAH PINDAH) -->
<td>
    <span style="color:#6b7280; font-weight:500;">
        <i class="fas fa-calendar-alt" style="margin-right:6px; color:#9ca3af;"></i>
        {{ \Carbon\Carbon::parse($transaksi->tanggal_masuk)->format('d-m-Y') }}
    </span>
</td>

<td>
<a href="{{ route('transaksi.edit',$transaksi->id) }}" class="btn btn-warning btn-sm">
<i class="fas fa-edit"></i>
</a>

<form action="{{ route('transaksi.destroy',$transaksi->id) }}" method="POST" style="display:inline;">
@csrf
@method('DELETE')
<button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">
<i class="fas fa-trash"></i>
</button>
</form>
</td>

</tr>

@empty
<tr>
<td colspan="11" class="text-center">Data transaksi belum ada</td>
</tr>
@endforelse

</tbody>

</table>

</div>

<div class="card-footer">
{{ $transaksis->links() }}
</div>

</div>

@stop