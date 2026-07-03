<?php

namespace Database\Seeders;

use App\Models\Barang;
use Illuminate\Database\Seeder;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            [
                'kode_barang' => 'ITM-0001',
                'nama_barang' => 'Beras Premium',
                'satuan' => 'kg',
                'kategori' => 'Bahan Pokok',
                'stok_awal' => 120,
                'deskripsi' => 'Beras premium kualitas terbaik untuk kebutuhan rumah tangga.',
                'stok_akhir' => 120,
            ],
            [
                'kode_barang' => 'ITM-0002',
                'nama_barang' => 'Gula Pasir',
                'satuan' => 'kg',
                'kategori' => 'Bahan Pokok',
                'stok_awal' => 80,
                'deskripsi' => 'Gula pasir putih halus untuk kebutuhan sehari-hari.',
                'stok_akhir' => 80,
            ],
            [
                'kode_barang' => 'ITM-0003',
                'nama_barang' => 'Minyak Goreng',
                'satuan' => 'liter',
                'kategori' => 'Bahan Pokok',
                'stok_awal' => 60,
                'deskripsi' => 'Minyak goreng kemasan untuk memasak sehari-hari.',
                'stok_akhir' => 60,
            ],
            [
                'kode_barang' => 'ITM-0004',
                'nama_barang' => 'Indomie Goreng',
                'satuan' => 'pak',
                'kategori' => 'Makanan',
                'stok_awal' => 150,
                'deskripsi' => 'Mie instan rasa goreng favorit keluarga.',
                'stok_akhir' => 150,
            ],
            [
                'kode_barang' => 'ITM-0005',
                'nama_barang' => 'Sabun Cuci',
                'satuan' => 'pcs',
                'kategori' => 'Kebutuhan Rumah Tangga',
                'stok_awal' => 90,
                'deskripsi' => 'Sabun cuci serbaguna untuk kebutuhan kebersihan rumah.',
                'stok_akhir' => 90,
            ],
        ];

        foreach ($items as $item) {
            Barang::create($item);
        }
    }
}
