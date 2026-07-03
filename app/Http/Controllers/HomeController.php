<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\SaldoStok;
use App\Models\Transaksi;

class HomeController extends Controller
{
    public function index()
    {
        $barang = Barang::all();

        $totalMasuk = SaldoStok::whereDate('created_at', today())->where('jenis', 'masuk')->sum('qty');
        $totalKeluar = SaldoStok::whereDate('created_at', today())->where('jenis', 'keluar')->sum('qty');

        $transaksi = Transaksi::all();

        return view('home', compact('barang', 'totalMasuk', 'totalKeluar', 'transaksi'));
    }
}
