<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KonfirmasiPembayaran extends Model
{
  protected $table      = 'konfirmasi_pembayaran';
  protected $fillable   = [
      'order_id','nomor_rekening','nama_account','tanggal_transfer','jumlah_transfer','status'
      ,'created_at','updated_at'
  ];
}
