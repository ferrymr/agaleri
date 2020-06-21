<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
* Class CreateUsersTable
*/
class CreateAccountingJournalsTable extends Migration
{
	/**
	* @var array
	*/
	protected $guarded = ['id'];

	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function up()
	{
		Schema::create('accounting_journals', function (Blueprint $table) {
			$table->increments('id');
			$table->unsignedInteger('ledger_id')->nullable();
			$table->bigInteger('balance');
			$table->char('currency',5)->nullable();
			$table->integer('akun_id')->nullable();
			$table->timestamps();
		});
	}
	/**
	* Reverse the migrations.
	*
	* @return void
	*/
	public function down()
	{
		Schema::dropIfExists('accounting_journals');
	}
}
