<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MasterBJ extends Model
{
  public $incrementing  = false;
  protected $primaryKey = 'id';
  protected $table = 'master_bj';
  protected $fillable = [
      'id','index','name','id_bj','id_so','id_art','id_brand','id_warna','id_supplier','stock','id_satuan','id_target','harga_default','isactive'
  ];

  protected $casts = [
 'id' => 'string',
  ];
}
