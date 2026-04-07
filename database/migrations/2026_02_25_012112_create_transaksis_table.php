<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaksis', function (Blueprint $table) {

            $table->id();

            $table->string('nama_pembeli');
            $table->string('no_telepon');
            $table->string('alamat');

            $table->string('layanan'); // contoh: cuci kering, setrika, dll

            $table->integer('berat');
            $table->integer('diskon')->default(0);

            $table->bigInteger('total_harga');

            // 🔥 INI YANG DIPAKAI DASHBOARD
           $table->enum('status_pesanan', ['Proses','Selesai','Diambil'])->default('Proses');
            // isi: proses / selesai / diambil

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
