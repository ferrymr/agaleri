<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PembayaranDetailPiutang extends Model
{
  public $incrementing  = false;
  protected $table      = 'pembayaran_detail_piutang';
  protected $fillable   = ['id_pembayaran','index', 'no_invoice','jumlah_bayar','diskon','total_bayar',
  'keterangan','status'];
}
