<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KeluarAccDetail extends Model
{
  public $incrementing  = false;
  protected $table      = 'keluar_acc_detail';
  protected $fillable   = ['id_keluar','index','kode_acc','qty','id_satuan','ket','isactive','id_permintaan'];

}
