<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BarangJadi extends Model
{
    protected $table = 'barang_jadi';
    protected $fillable = [
        'id','index','name','detail','picture','isactive','created_at','updated_at'
    ];
    protected $casts = [
      'id' => 'string',
    ];
}
