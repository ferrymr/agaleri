<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AkunSupplier extends Model
{
  protected $table = 'akun_supplier';
  protected $increments = 'false';
  protected $primaryKey = 'id_akun';
  protected $casts = ['id_akun' => 'string','id_supplier' => 'string'];
  protected $fillable = ['id_akun','id_supplier'];
}
