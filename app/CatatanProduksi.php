<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CatatanProduksi extends Model
{
    protected $table = 'catatan_produksi';
    protected $fillable = [
      'id','produksi_id','index','warna_a','warna_b','s','m','l','xl','created_at','updated_at'
    ];
}
