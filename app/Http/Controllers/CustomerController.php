<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
	    //Filter search
        $customers = Customer::query()
            ->when($request->search, function ($query, $search) {
                $query->where('nama_customer', 'like', "%{$search}%")
                      ->orWhere('no_hp', 'like', "%{$search}%");
            })
            ->paginate(10); 

        return view('customer.index', compact('customers'));
    }
    
     public function create()
    {
        return view('customer.create');
    }
    
    public function store(Request $request)
    {
        // Validasi sekaligus simpan hasilnya ke variabel $data
        $data = $request->validate([
            'nama_customer' => 'required|string|max:255',
            'no_hp'        => 'required|string|unique:customers|max:20',
            'alamat'    => 'required|string|max:100',
        ]);

        // Simpan data langsung (tanpa perlu definisikan satu-satu)
        Customer::create($data);
          if($request->hasFile('foto')){
            $data['foto'] = $request->file('foto')->store('foto-customer', 'public');
          }
        return redirect()->route('customer.index')->with('success', 'Data customer berhasil ditambahkan.');
    }
    
    public function edit(Customer $customer)
    {
        return view('customer.edit',compact('customer'));
    }
    
    public function update(Request $request, Customer $customer)
    {
        // Validasi data
        $data = $request->validate([
            'nama_customer' => 'required|string|max:255',
           'no_hp' => 'required|string|max:20|unique:customers,no_hp,' . $customer->id,
            'alamat'        => 'required|string|max:100',
        ]);

       // Update data langsung
         if ($request->hasFile('foto')) {
            
            // Hapus foto LAMA jika ada
            if ($customer->foto && Storage::disk('public')->exists($customer->foto)) {
                Storage::disk('public')->delete($customer->foto);
            }

            $data['foto'] = $request->file('foto')->store('foto-customer', 'public');
        }
        $customer->update($data);

        return redirect()->route('customer.index')->with('success', 'Data customer berhasil diperbarui.');
    }
    
    public function show(Customer $customer)
    {
        return view('customer.show', compact('customer'));
    }
    
   public function destroy(Customer $customer)
    {
        if ($customer->foto && Storage::disk('public')->exists($customer->foto)) {
            Storage::disk('public')->delete($customer->foto);
        }

        $customer->delete();

        return redirect()->route('customer.index')->with('success', 'Data customer berhasil dihapus.');
    }
    public function cetakPdf()
    {
        // 1. Ambil semua data siswa
        $customers = Customer::all();

        // 2. Load view khusus untuk PDF dan kirim datanya
        // Kita set ukuran kertas A4 dan orientasi landscape agar tabel muat
        $pdf = Pdf::loadView('customer.pdf', compact('customers'))
                  ->setPaper('a4', 'landscape');

        // 3. Stream pdf ke browser (agar bisa dipreview dulu sebelum download)
        return $pdf->stream('laporan-data-customer.pdf');
    }
    
}
