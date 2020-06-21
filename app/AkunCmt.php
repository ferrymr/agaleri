<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AkunCmt extends Model
{
  protected $table = 'akun_cmt';
  protected $increments = 'false';
  protected $primaryKey = 'id_akun';
  protected $casts = ['id_akun' => 'string','id_cmt' => 'string'];
  protected $fillable = ['id_akun','id_cmt'];
}
