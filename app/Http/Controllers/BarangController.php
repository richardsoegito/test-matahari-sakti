<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\SaldoStok;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{
    public function index()
    {
        $barangs = Barang::all();
        return view('barang.index', compact('barangs'));
    }

    public function create()
    {
        $barang = null;
        return view('barang.create', compact('barang'));
    }

    public function edit($kode_barang)
    {
        $barang = Barang::findOrFail($kode_barang);
        return view('barang.create', compact('barang'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_barang' => 'required|string|max:255|unique:barang,nama_barang',
            'satuan' => 'required|string|max:50',
            'kategori' => 'required|string|max:100',
            'stok_awal' => 'required|integer',
            'deskripsi' => 'nullable|string',
        ]);

        DB::transaction(function () use ($validatedData) {
            $barang = Barang::create($validatedData);

            // Create initial saldo_stok entry
            SaldoStok::create([
                'kode_barang' => $barang->kode_barang,
                'no_transaksi' => null, // No transaction for initial stock
                'jenis' => 'Stok Awal',
                'qty' => $validatedData['stok_awal'],
            ]);

            $barang->update(['stok_akhir' => $validatedData['stok_awal']]);
        });

        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan.');
    }

    public function update(Request $request, $kode_barang)
    {
        $barang = Barang::findOrFail($kode_barang);

        $validatedData = $request->validate([
            'nama_barang' => 'required|string|max:255|unique:barang,nama_barang,' . $barang->kode_barang . ',kode_barang',
            'satuan' => 'required|string|max:50',
            'kategori' => 'required|string|max:100',
            'stok_awal' => 'required|integer',
            'deskripsi' => 'nullable|string',
        ]);

        DB::transaction(function () use ($barang, $validatedData) {
            // Update the barang
            $barang->update($validatedData);

            // Update the initial saldo_stok entry
            $saldoStok = SaldoStok::where('kode_barang', $barang->kode_barang)
                ->whereNull('no_transaksi')
                ->where('jenis', 'Stok Awal')
                ->first();

            if ($saldoStok) {
                $saldoStok->update([
                    'qty' => $validatedData['stok_awal'],
                ]);
            } else {
                // If no initial saldo_stok entry exists, create one
                SaldoStok::create([
                    'kode_barang' => $barang->kode_barang,
                    'no_transaksi' => null,
                    'jenis' => 'Stok Awal',
                    'qty' => $validatedData['stok_awal'],
                ]);
            }

            $barang->update(['stok_akhir' => $validatedData['stok_awal']]);
        });

        return redirect()->route('barang.index')->with('success', 'Barang berhasil diperbarui.');
    }

    public function destroy($kode_barang)
    {
        $barang = Barang::findOrFail($kode_barang);

        if ($barang->transaksi()->exists()) {
            return redirect()->route('barang.index')->with('error', 'Barang tidak dapat dihapus karena memiliki transaksi terkait.');
        }
        
        $barang->delete();

        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus.');
    }
}
