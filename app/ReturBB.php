<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReturBB extends Model
{
  protected $table = 'retur_bb';
  protected $fillable = [
      'id','index','tanggal','id_so','id_jenis_bb','isactive'
  ];

  protected $casts = [
 'id' => 'string',
  ];
}
