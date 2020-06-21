<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReturAccDetail extends Model
{
  public $incrementing  = false;
  protected $table      = 'retur_acc_detail';
  protected $fillable   = ['no_bukti_retur','no_bukti_pemakaian','index','tanggal','kode_acc','id_acc',
  'id_brand','id_supplier','qty','id_satuan','qty_retur','qty_retur_terima','qty_retur_sisa','ket','isactive'];
}
 