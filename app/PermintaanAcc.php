<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PermintaanAcc extends Model
{
  public $incrementing  = false;
  protected $table = 'permintaan_acc';
  protected $fillable = [
      'id','index','tanggal','id_so','total','isactive','id_satuan'
  ];

  protected $casts = [
 'id' => 'string',
  ];
  public $timestamps = true;
}
