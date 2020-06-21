<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
  protected $table      = 'cart';
  protected $primaryKey = 'id';
  protected $fillable   = [
      'user_id','status','keterangan','created_at','updated_at','qty'
  ];
  protected $casts = [
    'id' => 'string',
  ];
}
