<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
	    //Filter search
        $members = Member::query()
            ->when($request->search, function ($query, $search) {
                $query->where('nama_member', 'like', "%{$search}%")
                      ->orWhere('no_telepon', 'like', "%{$search}%");
            })
            ->paginate(10); 

        return view('member.index', compact('members'));
    }
    
     public function create()
    {
        return view('member.create');
    }
    
    public function store(Request $request)
    {
        // Validasi sekaligus simpan hasilnya ke variabel $data
        $data = $request->validate([
            'nama_member' => 'required|string|max:255',
            'no_telepon'        => 'required|string|unique:members|max:20',
        ]);

        // Simpan data langsung (tanpa perlu definisikan satu-satu)
        Member::create($data);
          if($request->hasFile('foto')){
            $data['foto'] = $request->file('foto')->store('foto-member', 'public');
          }
        return redirect()->route('member.index')->with('success', 'Data member berhasil ditambahkan.');
    }
    
    public function edit(Member $member)
    {
        return view('member.edit',compact('member'));
    }
    
    public function update(Request $request, Member $member)
    {
        // Validasi data
        $data = $request->validate([
            'nama_member' => 'required|string|max:255',
           'no_telepon' => 'required|string|max:20|unique:members,no_telepon,' . $member->id,
        ]);

       // Update data langsung
         if ($request->hasFile('foto')) {
            
            // Hapus foto LAMA jika ada
            if ($member->foto && Storage::disk('public')->exists($member->foto)) {
                Storage::disk('public')->delete($member->foto);
            }

            $data['foto'] = $request->file('foto')->store('foto-member', 'public');
        }
        $member->update($data);

        return redirect()->route('member.index')->with('success', 'Data member berhasil diperbarui.');
    }
    
    public function show(Member $member)
    {
        return view('member.show', compact('member'));
    }
    
   public function destroy(Member $member)
    {
        if ($member->foto && Storage::disk('public')->exists($member->foto)) {
            Storage::disk('public')->delete($member->foto);
        }

        $member->delete();

        return redirect()->route('member.index')->with('success', 'Data member berhasil dihapus.');
    }
    public function cetakPdf()
    {
        // 1. Ambil semua data siswa
        $members = Member::all();

        // 2. Load view khusus untuk PDF dan kirim datanya
        // Kita set ukuran kertas A4 dan orientasi landscape agar tabel muat
        $pdf = Pdf::loadView('member.pdf', compact('members'))
                  ->setPaper('a4', 'landscape');

        // 3. Stream pdf ke browser (agar bisa dipreview dulu sebelum download)
        return $pdf->stream('laporan-data-member.pdf');
    }
    
}
