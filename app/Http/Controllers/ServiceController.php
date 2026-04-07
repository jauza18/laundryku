<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
	    //Filter search
        $services = Service::query()
            ->when($request->search, function ($query, $search) {
                $query->where('nama_layanan', 'like', "%{$search}%")
                      ->orWhere('harga', 'like', "%{$search}%");
            })
            ->paginate(10); 

        return view('service.index', compact('services'));
    }
    
     public function create()
    {
        return view('service.create');
    }
    
    public function store(Request $request)
    {
        // Validasi sekaligus simpan hasilnya ke variabel $data
        $data = $request->validate([
            'nama_layanan' => 'required|string|max:255',
            'harga'        => 'required|string|unique:services|max:20',
            'satuan'    => 'required|string|max:100',
        ]);

        // Simpan data langsung (tanpa perlu definisikan satu-satu)
        Service::create($data);
          if($request->hasFile('foto')){
            $data['foto'] = $request->file('foto')->store('foto-service', 'public');
          }
        return redirect()->route('service.index')->with('success', 'Data service berhasil ditambahkan.');
    }
    
    public function edit(Service $service)
    {
        return view('service.edit',compact('service'));
    }
    
    public function update(Request $request, Service $service)
    {
        // Validasi data
        $data = $request->validate([
            'nama_layanan' => 'required|string|max:255',
            'harga' => 'required|string|max:20|unique:services,harga,' . $service->id,
            'satuan'        => 'required|string|max:100',
        ]);

       // Update data langsung
         if ($request->hasFile('foto')) {
            
            // Hapus foto LAMA jika ada
            if ($service->foto && Storage::disk('public')->exists($service->foto)) {
                Storage::disk('public')->delete($service->foto);
            }

            $data['foto'] = $request->file('foto')->store('foto-service', 'public');
        }
        $service->update($data);

        return redirect()->route('service.index')->with('success', 'Data service berhasil diperbarui.');
    }
    
    public function show(Service $service)
    {
        return view('service.show', compact('service'));
    }
    
   public function destroy(Service $service)
    {
        if ($service->foto && Storage::disk('public')->exists($service->foto)) {
            Storage::disk('public')->delete($service->foto);
        }

        $service->delete();

        return redirect()->route('service.index')->with('success', 'Data service berhasil dihapus.');
    }
    public function cetakPdf()
    {
        // 1. Ambil semua data siswa
        $services = Service::all();

        // 2. Load view khusus untuk PDF dan kirim datanya
        // Kita set ukuran kertas A4 dan orientasi landscape agar tabel muat
        $pdf = Pdf::loadView('service.pdf', compact('services'))
                  ->setPaper('a4', 'landscape');

        // 3. Stream pdf ke browser (agar bisa dipreview dulu sebelum download)
        return $pdf->stream('laporan-data-service.pdf');
    }
    
}
