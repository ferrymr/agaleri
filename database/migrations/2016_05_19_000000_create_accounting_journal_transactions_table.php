<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
* Class CreateUsersTable
*/
class CreateAccountingJournalTransactionsTable extends Migration
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
		Schema::create('accounting_journal_transactions', function (Blueprint $table) {
			$table->string('id',36)->unique();
			$table->integer('index');
			$table->integer('journal_id');
			$table->string('transaction_group',36)->nullable();
			$table->bigInteger('debit')->nullable();
			$table->bigInteger('credit')->nullable();
			$table->char('currency',5);
			$table->text('memo')->nullable();
			$table->text('tags')->nullable();
			$table->string('type',32)->nullable();
			$table->string('akun_id')->nullable();
			$table->timestamps();
			$table->dateTime('post_date');
			$table->softDeletes();
		});
	}
	/**
	* Reverse the migrations.
	*
	* @return void
	*/
	public function down()
	{
		Schema::dropIfExists('accounting_journal_transactions');
	}
}
