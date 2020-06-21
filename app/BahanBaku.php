<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BahanBaku extends Model
{
    protected $table = 'bahan_baku';
    protected $fillable = [
        'id','index','name','detail','picture','isactive','created_at','updated_at'
    ];
    protected $casts = [
   'id' => 'string',
    ];
}
