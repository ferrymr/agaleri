<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProdukStok extends Model
{
    public $incrementing  = false;
    protected $table = 'produk_stok';
    protected $fillable = [
        'index', 'id_barang', 'id_size', 'stok', 'price', 'status'
    ];
}
