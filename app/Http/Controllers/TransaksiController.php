<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Transaksi;
use App\Models\SaldoStok;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TransaksiExport;

class TransaksiController extends Controller
{
    public function create()
    {
        $barangs = Barang::all();
        $transaksi = null; // Initialize $transaksi as null for the create view
        return view('transaksi.create', compact('barangs', 'transaksi'));
    }

    public function index()
    {
        $transaksis = Transaksi::all();
        return view('transaksi.index', compact('transaksis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'kode_barang' => 'required|exists:barang,kode_barang',
            'jumlah' => 'required|integer|min:1',
            'jenis' => 'required|in:masuk,keluar',
            'deskripsi' => 'nullable|string',
        ]);

        DB::transaction(function () use ($request) {
            $transaksi = new Transaksi();
            $transaksi->tanggal = $request->tanggal;
            $transaksi->kode_barang = $request->kode_barang;
            $transaksi->jumlah = $request->jumlah;
            $transaksi->jenis = $request->jenis;
            $transaksi->deskripsi = $request->deskripsi;
            $transaksi->save();

            SaldoStok::create([
                'kode_barang' => $request->kode_barang,
                'no_transaksi' => $transaksi->no_transaksi,
                'jenis' => $request->jenis,
                'qty' => $request->jumlah,
            ]);

            // Update stok_akhir in Barang model
            $barang = Barang::findOrFail($request->kode_barang);
            if ($request->jenis === 'masuk') {
                $barang->stok_akhir += $request->jumlah;
            } else {
                $barang->stok_akhir -= $request->jumlah;
            }
            $barang->save();
        });

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil disimpan.');
    }

    public function edit($no_transaksi)
    {
        $transaksi = Transaksi::where('no_transaksi', $no_transaksi)->firstOrFail();
        $barangs = Barang::all();
        return view('transaksi.create', compact('transaksi', 'barangs'));
    }

    public function update(Request $request, $no_transaksi)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'kode_barang' => 'required|exists:barang,kode_barang',
            'jumlah' => 'required|integer|min:1',
            'jenis' => 'required|in:masuk,keluar',
            'deskripsi' => 'nullable|string',
        ]);

        DB::transaction(function () use ($request, $no_transaksi) {
            $transaksi = Transaksi::where('no_transaksi', $no_transaksi)->firstOrFail();
            $transaksi->tanggal = $request->tanggal;
            $transaksi->kode_barang = $request->kode_barang;
            $transaksi->jumlah = $request->jumlah;
            $transaksi->jenis = $request->jenis;
            $transaksi->deskripsi = $request->deskripsi;
            $transaksi->save();

            // Update saldo_stok
            SaldoStok::where('no_transaksi', $no_transaksi)->update([
                'kode_barang' => $request->kode_barang,
                'jenis' => $request->jenis,
                'qty' => $request->jumlah,
            ]);

            // Update stok_akhir in Barang model
            $barang = Barang::findOrFail($request->kode_barang);
            if ($request->jenis === 'masuk') {
                $barang->stok_akhir += $request->jumlah;
            } else {
                $barang->stok_akhir -= $request->jumlah;
            }
            $barang->save();
        });

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil diperbarui.');
    }

    public function exportExcel()
    {
        return Excel::download(new TransaksiExport, 'Transaksi.xlsx');
    }
}
