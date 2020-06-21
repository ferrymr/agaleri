<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PemakaianAcc extends Model
{
  protected $table = 'pemakaian_acc';
  protected $fillable = [
      'id','id_bukti_permintaan','index','tanggal','id_so','isactive','jumlah','status_retur'
  ];

  protected $casts = [
 'id' => 'string',
  ];
}
