<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
  public $incrementing  = false;
  protected $table      = 'payment';
  protected $fillable   = ['id','index','name','isactive'];
}
