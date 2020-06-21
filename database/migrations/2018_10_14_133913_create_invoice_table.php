<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice', function (Blueprint $table) {
          $table->string('id',15)->unique();
          $table->integer('index');
          $table->string('id_costumer',15);
          $table->date('tanggal')->nullable();
          $table->date('jatuh_tempo')->nullable();
          $table->string('top')->nullable();
          $table->integer('total_qty')->nullable();
          $table->decimal('sub_total',15,2)->nullable();
          $table->decimal('discount',15,2)->nullable();
          $table->decimal('grand_total',15,2)->nullable();
          $table->string('terbilang')->nullable();
          $table->string('isactive',2);
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
        Schema::dropIfExists('invoice');
    }
}
