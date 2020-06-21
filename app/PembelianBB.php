<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PembelianBB extends Model
{
  public $incrementing  = false;
  protected $table = 'pembelian_bb';
  protected $fillable = [
      'id','index','tanggal','id_supplier','id_faktur','tgl_faktur','pembayaran',
      'tempo','isactive','total_trans'
  ];

  protected $casts = [
 'id' => 'string',
  ];
}
