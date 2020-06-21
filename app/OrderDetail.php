<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
  protected $table      = 'order_detail';
  public $incrementing = false;
  protected $fillable   = [
      'order_id','barang_id','index','size_id',
      'qty','harga','potongan','berat','total','created_at','updated_at'
  ];
}
