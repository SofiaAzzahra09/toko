<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukModel extends Model
{
    use HasFactory;

    protected $table = 'produk'; 
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'nama_produk',
        'id_kategori',
        'harga_produk',
    ];

    public function kategori()
    {
        return $this->belongsTo(CategoryModel::class, 'id_kategori', 'id_kategori'); 
    }

    public function stokProduk()
    {
        return $this->hasMany(StokModel::class, 'id_produk', 'id');
    }

}
