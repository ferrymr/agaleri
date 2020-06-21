<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PembelianBJDetail extends Model
{
  public $incrementing  = false;
  protected $table      = 'pembelian_bj_detail';
  protected $fillable   = ['id','index','tanggal','kode_bj','id_bj',
  'id_warna','id_supplier','qty','id_satuan','harga','jumlah','isactive'];
}
