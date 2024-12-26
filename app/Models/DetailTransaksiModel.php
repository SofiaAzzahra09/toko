<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaksiModel extends Model
{
    use HasFactory;

    protected $table = 'transaksi_detail';
    public $timestamps = false;
    
    protected $fillable = [
        'id_transaksi', 
        'id_produk', 
        'jumlah', 
        'harga_satuan', 
        'subtotal'
    ];

    public function transaksi()
    {
        return $this->belongsTo(TransaksiModel::class, 'id_transaksi', 'id');
    }

    public function produk()
    {
        return $this->belongsTo(ProdukModel::class, 'id_produk', 'id');
    }
}
