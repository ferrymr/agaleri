<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Money\Money;
use Money\Currency;
use Carbon\Carbon;

class Ledger extends Model
{

	protected $table = 'accounting_ledgers';
	public $currency = 'Rp';
	protected $fillable   = ['id','name','type','created_at'];

}
