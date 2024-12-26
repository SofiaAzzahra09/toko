<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class UserStore extends Authenticatable
{
    use HasRoles, HasFactory, Notifiable;

    protected $table = 'users_store'; 
    // protected $primaryKey = 'user_id'; 
    public $timestamps = false;
    // public $incrementing = false;
    
    protected $fillable = [
        // 'user_id',
        'nama_user',
        'peran',
        'email',
        'password',
        'id_cabang',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $rememberTokenName = 'remember_token';

    public function branch()
    {
        return $this->belongsTo(BranchModel::class, 'id_cabang', 'id_cabang'); 
    }

    public function stokChanges()
    {
        return $this->hasMany(StokChange::class, 'user_id', 'id');
    }

    public function transaksi()
    {
        return $this->hasMany(TransaksiModel::class, 'id_kasir', 'id');
    }
}
