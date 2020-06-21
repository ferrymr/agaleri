<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JournalTransaction extends Model
{

    protected $table = 'accounting_journal_transactions';
    protected $fillable = ['id','transaction_group','journal_id','debit','credit','currency','memo'
    ,'type','akun_id','created_at','updated_at','post_date','deleted_at','index','ref_type','ref_id','so_id'];
    public $incrementing = false;
    // protected $guarded = ['id'];
    protected $casts = [
        'post_date' => 'datetime',
        'tags' => 'array',
    ];
}
