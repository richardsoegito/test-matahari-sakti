<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Barang;
use App\Models\Transaksi;

class SaldoStok extends Model
{
    protected $table = 'saldo_stok';
    protected $fillable = [
        'kode_barang',
        'no_transaksi',
        'jenis',
        'qty'
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'kode_barang', 'kode_barang');
    }

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'no_transaksi', 'no_transaksi');
    }
}
