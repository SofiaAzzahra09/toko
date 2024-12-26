<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StokModel extends Model
{
    protected $table = 'stok_produk';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'id_cabang',
        'id_produk',
        'nama_produk',
        'jumlah_stok',
        'last_updated',
    ];

    public function produk()
    {
        return $this->belongsTo(ProdukModel::class, 'id_produk', 'id');
    }
}
