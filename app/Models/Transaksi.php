<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Barang;

class Transaksi extends Model
{
    use SoftDeletes;

    protected $table = 'transaksi';
    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    public static function booted()
    {
        static::creating(function ($transaksi) {
            if (empty($transaksi->no_transaksi)) {
                $transaksi->no_transaksi = self::generateNoTransaksi();
            }
        });
    }

    public static function generateNoTransaksi()
    {
        $lastTransaksi = self::withTrashed()->orderBy('no_transaksi', 'desc')->first();
        $lastNo = $lastTransaksi ? (int) substr($lastTransaksi->no_transaksi, 4) : 0;
        $newNo = str_pad($lastNo + 1, 4, '0', STR_PAD_LEFT);
        return 'TRX-' . $newNo;
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'kode_barang', 'kode_barang');
    }
}
