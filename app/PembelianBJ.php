<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PembelianBJ extends Model
{
  public $incrementing  = false;
  protected $table = 'pembelian_bj';
  protected $fillable = [
      'id','index','type','id_so','tanggal','id_supplier','id_faktur','tgl_faktur','pembayaran',
      'tempo','isactive','total_trans'
  ];

  protected $casts = [
 'id' => 'string',
  ];
}
