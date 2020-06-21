<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proses extends Model
{
    protected $table = 'proses';
    protected $fillable = [
        'id','index','name','detail','picture','isactive','created_at','updated_at'
    ];
}
