<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use Barryvdh\DomPDF\Facade\Pdf;

class TransaksiController extends Controller
{
    public function index(Request $request)
    {
        $transaksis = Transaksi::query()
            ->when($request->search, function ($query, $search) {
                $query->where('nama_pembeli', 'like', "%{$search}%")
                      ->orWhere('no_telepon', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10);

        return view('transaksi.index', compact('transaksis'));
    }

    public function create()
    {
        return view('transaksi.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_pembeli' => 'required|string|max:255',
            'no_telepon' => 'required|string|max:20',
            'alamat' => 'required|string|max:255',
            'layanan' => 'required|string|max:255',
            'berat' => 'required|numeric',
            'diskon' => 'nullable|numeric',
            'total_harga' => 'required|numeric',

            // PERBAIKAN: pakai enum sesuai database
            'status_pesanan' => 'required|in:Proses,Selesai,Diambil'
        ]);

        // default diskon kalau kosong
        $data['diskon'] = $data['diskon'] ?? 0;

        Transaksi::create($data);

        return redirect()->route('transaksi.index')
            ->with('success', 'Data transaksi berhasil ditambahkan');
    }

    public function edit(Transaksi $transaksi)
    {
        return view('transaksi.edit', compact('transaksi'));
    }

    public function update(Request $request, Transaksi $transaksi)
    {
        $data = $request->validate([
            'nama_pembeli' => 'required|string|max:255',
            'no_telepon' => 'required|string|max:20',
            'alamat' => 'required|string|max:255',
            'layanan' => 'required|string|max:255',
            'berat' => 'required|numeric',
            'diskon' => 'nullable|numeric',
            'total_harga' => 'required|numeric',

            // PERBAIKAN DI SINI JUGA
            'status_pesanan' => 'required|in:Proses,Selesai,Diambil'
        ]);

        $data['diskon'] = $data['diskon'] ?? 0;

        $transaksi->update($data);

        return redirect()->route('transaksi.index')
            ->with('success', 'Data transaksi berhasil diperbarui');
    }

    public function destroy(Transaksi $transaksi)
    {
        $transaksi->delete();

        return redirect()->route('transaksi.index')
            ->with('success', 'Data transaksi berhasil dihapus');
    }

    public function cetakPdf()
    {
        $transaksis = Transaksi::latest()->get();

        $pdf = Pdf::loadView('transaksi.pdf', compact('transaksis'))
                  ->setPaper('a4', 'landscape');

        return $pdf->stream('laporan-data-transaksi.pdf');
    }
}