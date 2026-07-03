<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/barang', [BarangController::class, 'index'])->name('barang.index');
Route::get('/barang/create', [BarangController::class, 'create'])->name('barang.create');
Route::post('/barang/create', [BarangController::class, 'store'])->name('barang.store');
Route::get('/barang/{kode_barang}/edit', [BarangController::class, 'edit'])->name('barang.edit');
Route::put('/barang/{kode_barang}', [BarangController::class, 'update'])->name('barang.update');
Route::delete('/barang/{kode_barang}', [BarangController::class, 'destroy'])->name('barang.destroy');

Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
Route::get('/transaksi/create', [TransaksiController::class, 'create'])->name('transaksi.create');

Route::post('/transaksi/create', [TransaksiController::class, 'store'])->name('transaksi.store');
Route::get('/transaksi/{no_transaksi}/edit', [TransaksiController::class, 'edit'])->name('transaksi.edit');
Route::put('/transaksi/{no_transaksi}', [TransaksiController::class, 'update'])->name('transaksi.update');
Route::delete('/transaksi/{no_transaksi}', [TransaksiController::class, 'destroy'])->name('transaksi.destroy');

Route::get('/transaksi/export-excel', [TransaksiController::class, 'exportExcel'])->name('transaksi.exportExcel');