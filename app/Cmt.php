<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cmt extends Model
{
    public $incrementing = false;
    protected $table = 'cmt';
    protected $fillable = [
        'id','index','name','no_telepon','no_hp','no_fax','alamat','email','kota','kode_pos','proses_id','bank_id','no_rek',
        'detail','picture','akun_id','isactive','created_at','updated_at'
    ];
}
