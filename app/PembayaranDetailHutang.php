<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PembayaranDetailHutang extends Model
{
  public $incrementing  = false;
  protected $table      = 'pembayaran_detail_hutang';
  protected $fillable   = ['id_pembayaran','index', 'no_faktur','jumlah_bayar','diskon','total_bayar',
  'keterangan','status'];
}
