<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiModel extends Model
{
    use HasFactory;

    protected $table = 'transaksi';
    public $timestamps = false;
    
    protected $fillable = [
        'id_cabang', 
        'id_kasir', 
        'total_harga', 
        'total_produk', 
        'tanggal_transaksi'
    ];

    protected $casts = [
        'tanggal_transaksi' => 'datetime', 
    ];

    public function cabang()
    {
        return $this->belongsTo(BranchModel::class, 'id_cabang', 'id_cabang');
    }

    public function kasir()
    {
        return $this->belongsTo(UserStore::class, 'id_kasir', 'id');
    }

    public function transaksiDetail()
    {
        return $this->hasMany(DetailTransaksiModel::class, 'id_transaksi');
    }
}
