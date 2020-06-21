<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MasukBarang extends Model
{
    public $incrementing  = false;
    protected $primaryKey = 'index';
    protected $table = 'masuk_barang';
    protected $fillable = [
        'index', 'id_barang', 'id_size', 'type', 'qty', 'balance', 'keterangan', 'saldo'
    ];

    protected $casts = [
        'id_barang' => 'string',
    ];
}
