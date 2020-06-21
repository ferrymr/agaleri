<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PemakaianBB extends Model
{
  protected $table = 'pemakaian_bb';
  protected $fillable = [
      'id','id_bukti_permintaan','index','tanggal','id_so','id_cmt','isactive','jumlah','status_retur'
  ];

  protected $casts = [
 'id' => 'string',
  ];
}
