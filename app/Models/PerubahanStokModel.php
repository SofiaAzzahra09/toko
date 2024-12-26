<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerubahanStokModel extends Model
{
    use HasFactory;

    protected $table = 'stok_changes';

    protected $fillable = [
        'id_cabang',
        'id_produk',
        'user_id',
        'jumlah',
        'deskripsi',
        'tanggal_perubahan',
    ];

    public $timestamps = true;

    public function cabang()
    {
        return $this->belongsTo(BranchModel::class, 'id_cabang');
    }

    public function produk()
    {
        return $this->belongsTo(ProdukModel::class, 'id_produk');
    }

    public function user()
    {
        return $this->belongsTo(UserStore::class, 'user_id');
    }
}
