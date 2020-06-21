<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'brand';
    protected $fillable = [
        'id','index','name','detail','picture','isactive','created_at','updated_at'
    ];
    protected $casts = [
      'id' => 'string',
    ];
}
