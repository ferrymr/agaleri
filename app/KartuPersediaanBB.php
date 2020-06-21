<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KartuPersediaanBB extends Model
{
    public $incrementing = false;
    protected $table = 'kartu_persediaan_bb';
    protected $fillable = [
        'index', 'kode_bb', 'type_ref', 'id_ref', 'qty', 'harga',
        'jumlah', 'saldo_qty', 'saldo_harga', 'saldo_jumlah', 
        'keterangan', 'created_at', 'updated_at'
    ];

}
