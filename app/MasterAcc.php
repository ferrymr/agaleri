<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MasterAcc extends Model
{
  public $incrementing  = false;
  protected $primaryKey = 'id';
  protected $table = 'master_acc';
  protected $fillable = [
      'id','index','name','id_acc','id_brand','id_supplier','stock','id_satuan','harga_default','isactive'
  ];

  protected $casts = [
 'id' => 'string',
  ];
}
