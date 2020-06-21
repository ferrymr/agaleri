<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Param extends Model
{
  public $incrementing  = false;
  protected $table      = 'param';
  protected $fillable   = ['id','name_aplikasi','name_perusahaan','alamat','telp','email','logo_aplikasi','background_front','logo_perusahaan','created_at','updated_at'];
}
