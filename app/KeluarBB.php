<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KeluarBB extends Model
{
  protected $table = 'keluar_bb';
  protected $fillable = [
      'id','index','tanggal','isactive','total','id_satuan'
  ];

  protected $casts = [
 'id' => 'string',
  ];
}
