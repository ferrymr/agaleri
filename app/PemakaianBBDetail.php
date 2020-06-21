<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PemakaianBBDetail extends Model
{
  public $incrementing  = false;
  protected $table      = 'pemakaian_bb_detail';
  protected $fillable   = ['no_bukti_pemakaian','no_bukti_permintaan','index','tanggal','kode_bb','id_bb',
  'id_warna','id_supplier','qty', 'qty_retur','id_satuan','hasil_cutt','ket','isactive','jumlah'];
}
