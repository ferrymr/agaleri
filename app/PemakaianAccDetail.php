<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PemakaianAccDetail extends Model
{
  public $incrementing  = false;
  protected $table      = 'pemakaian_acc_detail';
  protected $fillable   = ['no_bukti_pemakaian','no_bukti_permintaan','index','tanggal','kode_acc','id_acc',
  'id_acc','id_brand','id_supplier','qty','id_satuan','ket','isactive','jumlah','qty_retur'];

}
