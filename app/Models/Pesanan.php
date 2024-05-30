<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;
    protected $table = 'pesanans';

    public function antrian(){
        return $this->belongsTo(AntrianUsaha::class);
    }

    public function pembeli(){
        return $this->belongsTo(Pembeli::class);
    }
}
