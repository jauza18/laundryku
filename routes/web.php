<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\DashboardController;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/customer/cetak-pdf', [CustomerController::class, 'cetakPdf'])->name('customer.cetak-pdf');
    Route::get('/service cetak-pdf', [serviceController::class, 'cetakPdf'])->name('service.cetak-pdf');
    Route::get('/member cetak-pdf', [memberController::class, 'cetakPdf'])->name('member.cetak-pdf');
    Route::get('/transaksi cetak-pdf', [transaksiController::class, 'cetakPdf'])->name('transaksi.cetak-pdf');
    Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');
    Route::resource('customer',CustomerController::class);
    Route::resource('service',ServiceController::class);
    Route::resource('member',MemberController::class);
    Route::resource('transaksi',TransaksiController::class,);
    Route::resource('customers', CustomerController::class);

    
});

require __DIR__.'/auth.php';
