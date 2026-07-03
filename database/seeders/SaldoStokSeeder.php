<?php

namespace Database\Seeders;

use App\Models\Barang;
use App\Models\SaldoStok;
use App\Models\Transaksi;
use Illuminate\Database\Seeder;

class SaldoStokSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $transactions = Transaksi::orderBy('tanggal')->orderBy('id')->get();

        foreach ($transactions as $transaction) {
            SaldoStok::create([
                'kode_barang' => $transaction->kode_barang,
                'no_transaksi' => $transaction->no_transaksi,
                'jenis' => $transaction->jenis,
                'qty' => $transaction->jumlah,
            ]);

            $barang = Barang::where('kode_barang', $transaction->kode_barang)->first();
            if (! $barang) {
                continue;
            }

            if ($transaction->jenis === 'masuk') {
                $barang->stok_akhir = $barang->stok_akhir + $transaction->jumlah;
            } elseif ($transaction->jenis === 'keluar') {
                $barang->stok_akhir = $barang->stok_akhir - $transaction->jumlah;
            }

            $barang->save();
        }
    }
}
