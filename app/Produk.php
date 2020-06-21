<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
  public $incrementing  = false;
  protected $table      = 'produk';
  protected $fillable   = ['id','index','name','id_category','qty','harga','thumb','photo','berat','spesifikasi','deskripsi','status','isactive'];
}
