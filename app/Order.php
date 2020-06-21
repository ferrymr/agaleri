<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
  protected $table      = 'order';
  protected $primaryKey = 'id';
  protected $fillable   = [
      'user_id','type_order','kurir_id','jenis_pengiriman','total_berat','ongkos_kirim',
      'nama_penerima','telepon','alamat_tujuan','kota','provinsi',
      'catatan_order','catatan_terima','catatan_batal','catatan_retur',
      'tanggal_order','tanggal_terima','tanggal_batal','tanggal_retur',
      'total_transaksi','status_order','created_at','updated_at','no_resi','kode_pos',
      'email','potongan'
  ];
}
