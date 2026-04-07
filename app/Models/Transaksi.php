<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_pembeli',
        'no_telepon',
        'alamat',
        'layanan',
        'berat',
        'diskon',
        'total_harga',
        'status_pesanan'
    ];

    /*
    |--------------------------------------------------------------------------
    | FORMAT RUPIAH (AUTO)
    |--------------------------------------------------------------------------
    */
    public function getTotalHargaFormatAttribute()
    {
        return 'Rp ' . number_format($this->total_harga ?? 0, 0, ',', '.');
    }

    /*
    |--------------------------------------------------------------------------
    | BADGE STATUS (BIAR RAPI DI BLADE)
    |--------------------------------------------------------------------------
    */
    public function getStatusBadgeAttribute()
    {
        if ($this->status_pesanan == 'Proses') {
            return '<span class="badge badge-warning">Proses</span>';
        } elseif ($this->status_pesanan == 'Selesai') {
            return '<span class="badge badge-success">Selesai</span>';
        } elseif ($this->status_pesanan == 'Diambil') {
            return '<span class="badge badge-primary">Diambil</span>';
        }

        return '<span class="badge badge-secondary">Tidak diketahui</span>';
    }

    /*
    |--------------------------------------------------------------------------
    | FORMAT KODE TRANSAKSI
    |--------------------------------------------------------------------------
    */
    public function getKodeAttribute()
    {
        return 'TRX-' . str_pad($this->id, 4, '0', STR_PAD_LEFT);
    }

    /*
    |--------------------------------------------------------------------------
    | FORMAT TANGGAL
    |--------------------------------------------------------------------------
    */
    public function getTanggalAttribute()
    {
        return $this->created_at
            ? $this->created_at->format('d-m-Y')
            : '-';
    }
}