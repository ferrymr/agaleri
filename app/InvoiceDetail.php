<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceDetail extends Model
{
  public $incrementing  = false;
  protected $table      = 'invoice_detail';
  protected $fillable   = ['id_invoice','index','kode_bj','name',
  'qty','unit_price','discount','total_price','isactive'];
}
