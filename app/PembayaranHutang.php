<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PembayaranHutang extends Model
{
  public $incrementing  = false;
  protected $table      = 'pembayaran_hutang';
  protected $fillable   = ['id','index','tanggal_bayar','id_supplier','id_cmt','id_payment','total_hutang',
  'total_bayar','total_sisa','akun_id','status'];

  protected $casts = [
  'id' => 'string',
  ];
}
