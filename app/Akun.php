<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Akun extends Model
{
    protected $table = 'akun';
    protected $increments = 'false';
    protected $casts = ['id' => 'string'];
    protected $fillable = ['id','index','name','id_kategori','deskripsi',
    'saldo_awal','saldo','k1','k2','k3','level','kategori_laporan','isactive'];
}
