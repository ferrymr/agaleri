<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
  public $incrementing  = false;
  protected $table      = 'invoice';
  protected $fillable   = ['id','index','id_costumer','top',
  'tanggal','jatuh_tempo','total_qty','sub_total','discount','grand_total','dp','pph',
  'terbilang','isactive'];
}
