<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PembelianBBDetail extends Model
{
  public $incrementing  = false;
  protected $table      = 'pembelian_bb_detail';
  protected $fillable   = ['id_bp','index','tanggal','kode_bb','id_bb',
  'id_warna','id_supplier','qty','id_satuan','harga','jumlah','isactive'];
}
