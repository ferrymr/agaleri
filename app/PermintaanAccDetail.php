<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PermintaanAccDetail extends Model
{
  public $incrementing  = false;
  protected $table      = 'permintaan_acc_detail';
  protected $fillable   = ['no_bukti_permintaan','index','tanggal','kode_acc','id_acc',
  'id_brand','id_supplier','qty','id_satuan','ket','isactive'];
  public $timestamps = true;
}
