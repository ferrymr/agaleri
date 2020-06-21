<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReturAcc extends Model
{
  protected $table = 'retur_acc';
  protected $fillable = [
      'id','index','tanggal','id_so','id_jenis_acc','isactive'
  ];

  protected $casts = [
 'id' => 'string',
  ];
}
