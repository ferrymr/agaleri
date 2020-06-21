<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KeluarBBDetail extends Model
{
  public $incrementing  = false;
  protected $table      = 'keluar_bb_detail';
  protected $fillable   = ['id_keluar','index','kode_bb','qty','id_satuan','ket','isactive','id_permintaan'];

}
