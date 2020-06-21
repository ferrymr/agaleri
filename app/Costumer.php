<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Costumer extends Model
{
    public $incrementing  = false;
    protected $table = 'costumer';
    protected $fillable = [
        'id','index','name','no_telepon','no_hp','no_fax','alamat','email','kota','kode_pos','bank_id','no_rek',
        'detail','picture','akun_id','isactive','created_at','updated_at','birth_date','favorite_food','hoby'
    ];
}
