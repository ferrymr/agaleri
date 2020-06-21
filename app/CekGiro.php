<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CekGiro extends Model
{
  public $incrementing  = false;
  protected $table      = 'cek_giro';
  protected $fillable   = ['id','index','tanggal_keluar','tanggal_jatuh_tempo','id_akun_debet','id_akun_kredit',
  'no_cek_giro_pelanggan','no_cek_giro_sendiri','nominal','uraian','type','status'];

  protected $casts = [
  'id' => 'string',
  ];
}
