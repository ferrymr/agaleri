<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Art extends Model
{
    protected $table = 'art';
    protected $fillable = [
      'id','index','so_id','art_id','costumer_id','target_id','produksi_id','qty','isactive','created_at','updated_at','ispost','iscomplete',
      'stock_printing','stock_embro','stock_sewing','stock_washing','stock_lain2','stock_finishing'
    ];
    protected $casts = [
   'id' => 'string',
   'so_id' => 'string',
   'art_id' => 'string',
    ];
}
