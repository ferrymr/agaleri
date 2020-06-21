<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Money\Money;
use Money\Currency;
use Carbon\Carbon;

class Journal extends Model
{

	protected $table = 'accounting_journals';
	protected $fillable = ['id','ledger_id','balance','currency','akun_id','created_at'];

}
