<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PembelianAcc extends Model
{
  public $incrementing  = false;
  protected $table = 'pembelian_acc';
  protected $fillable = [
      'id','index','tanggal','id_supplier','id_faktur','tgl_faktur','pembayaran',
      'tempo','isactive','total_trans'
  ];

  protected $casts = [
 'id' => 'string',
  ];
}
