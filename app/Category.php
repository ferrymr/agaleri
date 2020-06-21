<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  public $incrementing  = false;
  protected $table      = 'category';
  protected $fillable   = ['id','index','name','type','isactive'];
}
