<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Card Dashboard
        $totalTransaksi = Transaksi::count();

        $totalPendapatan = Transaksi::sum('total_harga');

        // 🔥 FIX DI SINI (pakai status_pesanan)
        $totalProses = Transaksi::where('status_pesanan', 'Proses')->count();

        $totalSelesai = Transaksi::where('status_pesanan', 'Selesai')->count();


        // Tabel Transaksi (ambil 5 terbaru)
        $transaksis = Transaksi::latest()->take(5)->get();


        return view('dashboard', compact(
            'totalTransaksi',
            'totalPendapatan',
            'totalProses',
            'totalSelesai',
            'transaksis'
        ));
    }
}