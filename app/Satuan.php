<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Satuan extends Model
{
    protected $table = 'satuan';
    protected $fillable = [
        'id','index','name','detail','picture','isactive','created_at','updated_at'
    ];
    protected $casts = [
    'id' => 'string'
    ];
}
