<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skb extends Model
{
  protected $table = 'skb';
  protected $fillable = [
    'id','skk_id','index','tanggal','type','proses_id','ket','isactive','created_at','updated_at','no_surat_jalan'
  ];
  protected $casts = [
 'id' => 'string',
  ];
}
