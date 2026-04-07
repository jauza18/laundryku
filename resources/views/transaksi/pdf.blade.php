<!DOCTYPE html>
<html>
<head>
<title>Laporan Data Transaksi</title>

<style>

body{
font-family: Arial, sans-serif;
font-size:12px;
}

.header{
text-align:center;
margin-bottom:20px;
}

table{
width:100%;
border-collapse:collapse;
}

table,th,td{
border:1px solid black;
}

th,td{
padding:8px;
}

th{
background:#f2f2f2;
text-align:center;
}

</style>

</head>

<body>

<div class="header">
<h2>Laporan Data Transaksi Laundry</h2>
<p>Aplikasi Kasir Laundry</p>
</div>

<table>

<thead>

<tr>
<th>No</th>
<th>Nama Pembeli</th>
<th>No Telepon</th>
<th>Alamat</th>
<th>Layanan</th>
<th>Berat (Kg)</th>
<th>Diskon (%)</th>
<th>Total Harga</th>
<th>Status</th>
</tr>

</thead>

<tbody>

@foreach($transaksis as $index => $transaksi)

<tr>

<td style="text-align:center">{{ $index+1 }}</td>

<td>{{ $transaksi->nama_pembeli }}</td>

<td>{{ $transaksi->no_telepon }}</td>

<td>{{ $transaksi->alamat }}</td>

<td>{{ $transaksi->layanan }}</td>

<td style="text-align:center">{{ $transaksi->berat }} Kg</td>

<td style="text-align:center">{{ $transaksi->diskon }} %</td>

<td>Rp {{ number_format($transaksi->total_harga,0,',','.') }}</td>

<td>{{ $transaksi->status_pesanan }}</td>

</tr>

@endforeach

</tbody>

</table>

</body>
</html>