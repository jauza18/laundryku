@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1 class="mb-3 animate__animated animate__fadeInDown">
    <i class="fas fa-chart-line text-primary"></i> Dashboard
</h1>
@stop

@section('content')

<!-- FONT + ANIMASI -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<style>

/* ================= BACKGROUND ANIMASI ================= */
body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(-45deg, #4f46e5, #9333ea, #22c55e, #06b6d4);
    background-size: 400% 400%;
    animation: gradientMove 12s ease infinite;
}

@keyframes gradientMove {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

/* BUNGKUS KONTEN BIAR PUTIH */
.content-wrapper {
    background: rgba(255,255,255,0.92);
    border-radius: 20px;
    margin: 10px;
    padding: 10px;
}

/* ================= SIDEBAR ================= */
.main-sidebar {
    background: linear-gradient(180deg, #1e293b, #0f172a);
}

.nav-sidebar .nav-link {
    border-radius: 10px;
    margin: 5px 10px;
    transition: 0.3s;
    color: #cbd5f5;
}

.nav-sidebar .nav-link:hover {
    background: linear-gradient(90deg, #3b82f6, #6366f1);
    color: #fff;
    transform: translateX(5px);
}

.nav-sidebar .nav-link.active {
    background: linear-gradient(90deg, #06b6d4, #3b82f6);
    color: #fff;
}

/* BOX HIJAU */
.sidebar-footer {
    position: absolute;
    bottom: 20px;
    left: 10px;
    right: 10px;
    background: linear-gradient(135deg, #22c55e, #16a34a);
    border-radius: 12px;
    padding: 12px;
    text-align: center;
    color: white;
    font-size: 13px;
}

/* ================= CARD ================= */
.small-box {
    border-radius: 16px;
    transition: all 0.25s ease;
}
.small-box:hover {
    transform: translateY(-6px);
    box-shadow: 0 12px 25px rgba(0,0,0,0.15);
}

/* ================= TABLE ================= */

/* HEADER WARNA */
.table thead {
    background: linear-gradient(90deg, #4f46e5, #9333ea);
    color: white;
}

.table thead th {
    border: none;
    text-align: center;
}

/* ISI */
.table tbody td {
    text-align: center;
}

/* HOVER */
.table tbody tr:hover {
    background: #f3f4f6;
    transform: scale(1.01);
    transition: 0.2s;
}

/* CARD HEADER */
.card-header {
    background: linear-gradient(90deg, #22c55e, #16a34a);
    color: white;
    border-radius: 16px 16px 0 0 !important;
}

</style>

<div class="row">

    <div class="col-lg-3 col-6 animate__animated animate__fadeInUp">
        <div class="small-box bg-info shadow">
            <div class="inner">
                <h3>{{ $totalTransaksi }}</h3>
                <p>Total Transaksi</p>
            </div>
            <div class="icon">
                <i class="fas fa-shopping-cart"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-6 animate__animated animate__fadeInUp">
        <div class="small-box bg-success shadow">
            <div class="inner">
                <h3>Rp {{ number_format($totalPendapatan,0,',','.') }}</h3>
                <p>Pendapatan</p>
            </div>
            <div class="icon">
                <i class="fas fa-coins"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-6 animate__animated animate__fadeInUp">
        <div class="small-box bg-warning shadow">
            <div class="inner">
                <h3>{{ $totalProses }}</h3>
                <p>Diproses</p>
            </div>
            <div class="icon">
                <i class="fas fa-hourglass-half"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-6 animate__animated animate__fadeInUp">
        <div class="small-box bg-danger shadow">
            <div class="inner">
                <h3>{{ $totalSelesai }}</h3>
                <p>Selesai</p>
            </div>
            <div class="icon">
                <i class="fas fa-check-circle"></i>
            </div>
        </div>
    </div>

</div>

<!-- TABLE -->
<div class="card shadow mt-4 animate__animated animate__fadeInUp">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-receipt"></i> 
            <b>Orderan Terbaru</b>
        </h3>
    </div>

    <div class="card-body table-responsive p-0">
        <table class="table table-hover table-striped text-nowrap mb-0">

            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Customer</th>
                    <th>Layanan</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                </tr>
            </thead>

            <tbody>

                @forelse($transaksis as $t)
                <tr>

                    <td><b class="text-primary">TRX-{{ str_pad($t->id, 4, '0', STR_PAD_LEFT) }}</b></td>

                    <td>{{ $t->nama_pembeli }}</td>

                    <td><span class="badge badge-info">{{ $t->layanan }}</span></td>

                    <td><b class="text-success">Rp {{ number_format($t->total_harga ?? 0,0,',','.') }}</b></td>

                    <td>
                        @if($t->status_pesanan == 'Proses')
                            <span class="badge badge-warning">Proses</span>
                        @elseif($t->status_pesanan == 'Selesai')
                            <span class="badge badge-success">Selesai</span>
                        @elseif($t->status_pesanan == 'Diambil')
                            <span class="badge badge-primary">Diambil</span>
                        @endif
                    </td>

                    <td>{{ $t->created_at ? $t->created_at->format('d-m-Y') : '-' }}</td>

                </tr>

                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">
                        Data belum ada
                    </td>
                </tr>
                @endforelse

            </tbody>

        </table>
    </div>
</div>

<!-- SIDEBAR FOOTER -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    let sidebar = document.querySelector('.main-sidebar');
    if(sidebar){
        let box = document.createElement('div');
        box.className = 'sidebar-footer';
        box.innerHTML = `
            <i class="fas fa-soap"></i><br>
            <b>Laundry App</b><br>
            <small>Bersih • Cepat • Wangi</small>
        `;
        sidebar.appendChild(box);
    }
});
</script>

@stop 