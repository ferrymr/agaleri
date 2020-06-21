<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_detail', function (Blueprint $table) {
          $table->string('id_invoice',15);
          $table->integer('index');
          $table->string('kode_bj');
          $table->string('name')->nullable();
          $table->integer('qty');
          $table->decimal('unit_price', 15, 2);
          $table->decimal('discount', 15, 2);
          $table->decimal('total_price', 20, 2);
          $table->string('isactive',1);
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
        Schema::dropIfExists('invoice_detail');
    }
}
