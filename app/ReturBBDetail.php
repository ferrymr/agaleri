<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReturBBDetail extends Model
{
  public $incrementing  = false;
  protected $table      = 'retur_bb_detail';
  protected $fillable   = ['no_bukti_retur','no_bukti_pemakaian','index','tanggal','kode_bb','id_bb',
  'id_warna','id_supplier','id_satuan','qty_retur','qty_retur_terima','qty_retur_sisa','ket','isactive'];
}
 