<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryModel extends Model
{
    use HasFactory;

    protected $table = 'kategori'; 
    protected $primaryKey = 'id_kategori'; 
    public $timestamps = false;

    protected $fillable = [
        'id_kategori',
        'nama_kategori',
    ];

    public function produk()
{
    return $this->hasMany(ProdukModel::class, 'id_kategori', 'id_kategori');
}
}
