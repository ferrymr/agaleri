<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EKategori extends Model
{
  public $incrementing  = false;
  protected $table      = 'e_kategori';
  protected $fillable   = ['id','index','name','isactive'];
}
