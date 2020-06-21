<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    protected $table = 'bank';
    protected $fillable = [
        'id','index','name','detail','picture','isactive','created_at','updated_at'
    ];
}
