<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Acc extends Model
{
    protected $table = 'acc';
    protected $fillable = [
        'id','index','name','detail','picture','isactive','created_at','updated_at'
    ];
    protected $casts = [
   'id' => 'string',
    ];
}
