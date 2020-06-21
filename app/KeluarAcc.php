<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KeluarAcc extends Model
{
  protected $table = 'keluar_acc';
  protected $fillable = [
      'id','index','tanggal','isactive','total','id_satuan'
  ];

  protected $casts = [
 'id' => 'string',
  ];
}
