<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AkunCostumer extends Model
{
  protected $table = 'akun_costumer';
  protected $increments = 'false';
  protected $primaryKey = 'id_akun';
  protected $casts = ['id_akun' => 'string','id_costumer' => 'string'];
  protected $fillable = ['id_akun','id_costumer'];
}
