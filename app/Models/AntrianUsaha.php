<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AntrianUsaha extends Model
{
    use HasFactory;

    protected $table = 'antrian_usahas';

    public function user(){
        return $this->hasMany(User::class);
    }

    public function pesanan(){
        return $this->belongsToMany(Pesanan::class);
    }

}
