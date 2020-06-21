<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PermintaanBBDetail extends Model
{
  public $incrementing  = false;
  protected $table      = 'permintaan_bb_detail';
  protected $fillable   = ['no_bukti_permintaan','index','tanggal','kode_bb','id_bb',
  'id_warna','id_supplier','qty','id_satuan','ket','isactive'];
  public $timestamps = true;
}
