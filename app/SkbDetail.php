<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SkbDetail extends Model
{
  public $incrementing  = false;
  protected $table = 'skb_detail';
  protected $fillable = [
    'skb_id','skk_id','so_id','art_id','index','name','qty','qty_sisa','satuan_id','cmt_id','status_cmt','ket','isactive','created_at','updated_at'
  ];
  protected $casts = [
 'skb_id' => 'string',
  ];
}
