<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BranchModel extends Model
{
    use HasFactory;

    protected $table = 'cabang';

    protected $primaryKey = 'id_cabang';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_cabang', 
        'nama_cabang', 
        'alias',
        'telepon', 
        'alamat'
    ];

    public $timestamps = false;

    public function usersStore()
    {
        return $this->hasMany(UserStore::class, 'id_cabang', 'id_cabang');
    }
}
