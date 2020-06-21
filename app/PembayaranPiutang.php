<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PembayaranPiutang extends Model
{
  public $incrementing  = false;
  protected $table      = 'pembayaran_piutang';
  protected $fillable   = ['id','index','tanggal_bayar','id_costumer','id_payment','total_piutang',
  'total_bayar','total_sisa','akun_id','status'];

  protected $casts = [
  'id' => 'string',
  ];
}
