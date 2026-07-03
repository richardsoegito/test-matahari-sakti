<?php

namespace Database\Seeders;

use App\Models\Barang;
use App\Models\Transaksi;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $transactions = [
            ['no_transaksi' => 'TRX-0001', 'tanggal' => '2026-07-01', 'kode_barang' => 'ITM-0001', 'jumlah' => 10, 'jenis' => 'masuk', 'deskripsi' => 'Pembelian stok awal'],
            ['no_transaksi' => 'TRX-0002', 'tanggal' => '2026-07-02', 'kode_barang' => 'ITM-0002', 'jumlah' => 5, 'jenis' => 'keluar', 'deskripsi' => 'Penjualan pelanggan lokal'],
            ['no_transaksi' => 'TRX-0003', 'tanggal' => '2026-07-02', 'kode_barang' => 'ITM-0003', 'jumlah' => 12, 'jenis' => 'masuk', 'deskripsi' => 'Restok pemasok'],
            ['no_transaksi' => 'TRX-0004', 'tanggal' => '2026-07-03', 'kode_barang' => 'ITM-0004', 'jumlah' => 8, 'jenis' => 'keluar', 'deskripsi' => 'Pengiriman pesanan grosir'],
            ['no_transaksi' => 'TRX-0005', 'tanggal' => '2026-07-03', 'kode_barang' => 'ITM-0005', 'jumlah' => 7, 'jenis' => 'masuk', 'deskripsi' => 'Pengembalian barang'],
            ['no_transaksi' => 'TRX-0006', 'tanggal' => '2026-07-04', 'kode_barang' => 'ITM-0002', 'jumlah' => 15, 'jenis' => 'masuk', 'deskripsi' => 'Pengisian persediaan gudang'],
            ['no_transaksi' => 'TRX-0007', 'tanggal' => '2026-07-05', 'kode_barang' => 'ITM-0003', 'jumlah' => 6, 'jenis' => 'keluar', 'deskripsi' => 'Penggunaan operasional'],
            ['no_transaksi' => 'TRX-0008', 'tanggal' => '2026-07-05', 'kode_barang' => 'ITM-0004', 'jumlah' => 3, 'jenis' => 'keluar', 'deskripsi' => 'Penjualan ke retail'],
            ['no_transaksi' => 'TRX-0009', 'tanggal' => '2026-07-06', 'kode_barang' => 'ITM-0005', 'jumlah' => 9, 'jenis' => 'masuk', 'deskripsi' => 'Restok stok akhir pekan'],
            ['no_transaksi' => 'TRX-0010', 'tanggal' => '2026-07-06', 'kode_barang' => 'ITM-0001', 'jumlah' => 4, 'jenis' => 'keluar', 'deskripsi' => 'Pengiriman pesanan online'],
        ];

        foreach ($transactions as $transaction) {
            Transaksi::create($transaction);
        }
    }
}
