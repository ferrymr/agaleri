<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promo extends Model

{
    public $incrementing  = false;
    protected $table      = 'promo';
    protected $fillable   = ['id', 'title', 'name', 'start_date', 'end_date', 'id_barang', 'price', 'keterangan', 'status'];
}