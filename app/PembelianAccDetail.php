<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PembelianAccDetail extends Model
{
  public $incrementing  = false;
  protected $table      = 'pembelian_acc_detail';
  protected $fillable   = ['id_bp','index','tanggal','kode_acc','id_acc',
  'id_brand','id_supplier','qty','id_satuan','harga','jumlah','isactive'];
}
