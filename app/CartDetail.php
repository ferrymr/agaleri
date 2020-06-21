<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CartDetail extends Model
{
  public $incrementing  = false;
  protected $table      = 'cart_detail';
  protected $fillable   = [
      'cart_id','barang_id','index','qty','harga','potongan','created_at','updated_at','size_id'
  ];
}
