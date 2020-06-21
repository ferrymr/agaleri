<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    public $incrementing  = false;
    protected $table      = 'size';
    protected $fillable   = ['id', 'index', 'name', 'isactive'];
}
