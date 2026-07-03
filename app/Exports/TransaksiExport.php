<?php

namespace App\Exports;

use App\Models\Transaksi;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize; // Tambahan agar lebar kolom Excel otomatis menyesuaikan isi

class TransaksiExport implements FromView, ShouldAutoSize
{
    public function view(): View
    {
        // Ambil data transaksi beserta relasi barangnya
        $transaksi = Transaksi::with('barang')->get();

        // Lempar data ke view 'transaksi.excel'
        return view('transaksi.excel', compact('transaksi'));
    }
}
