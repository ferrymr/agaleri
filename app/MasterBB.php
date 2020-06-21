<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MasterBB extends Model
{
  public $incrementing  = false;
  protected $primaryKey = 'id';
  protected $table = 'master_bb';
  protected $fillable = [
      'id','index','name','id_bb','id_warna','id_supplier','stock','id_satuan','harga_default','isactive'
  ];
 
  protected $casts = [
 'id' => 'string',
  ];
}
