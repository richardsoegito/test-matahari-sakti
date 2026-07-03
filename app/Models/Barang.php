<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Transaksi;

class Barang extends Model
{
    use SoftDeletes;

    protected $table = 'barang';
    protected $primaryKey = 'kode_barang';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'satuan',
        'kategori',
        'stok_awal',
        'deskripsi',
        'stok_akhir',
    ];

    public static function booted()
    {
        static::creating(function ($barang) {
            if (empty($barang->kode_barang)) {
                $barang->kode_barang = self::generateKodeBarang();
            }
        });
    }

    public static function generateKodeBarang()
    {
        $lastBarang = self::withTrashed()->orderBy('kode_barang', 'desc')->first();
        $lastKode = $lastBarang ? (int) substr($lastBarang->kode_barang, 4) : 0;
        $newKode = str_pad($lastKode + 1, 4, '0', STR_PAD_LEFT);
        return 'ITM-' . $newKode;
    }

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'kode_barang', 'kode_barang');
    }
}
