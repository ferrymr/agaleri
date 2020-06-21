<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hutang extends Model
{
  public $incrementing  = false;
  protected $table      = 'hutang';
  protected $fillable   = ['id','index','id_supplier','id_cmt','type','no_faktur','no_skb',
  'tanggal_faktur','total_hutang','total_bayar','total_sisa','tempo','tanggal_jatuh_tempo','status','kategori'];
 
  protected $casts = [
  'id' => 'string',
  ];

}
