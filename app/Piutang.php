<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Piutang extends Model
{
  public $incrementing  = false;
  protected $table      = 'piutang';
  protected $fillable   = ['id','index','id_costumer','type','no_invoice',
  'tanggal_invoice','total_piutang','total_bayar','total_sisa','tempo','tanggal_jatuh_tempo','status'];

  protected $casts = [
  'id' => 'string',
  ];
}
