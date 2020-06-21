<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePembelianAccTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembelian_acc', function (Blueprint $table) {
          $table->string('id')->unique();
          $table->integer('index');
          $table->date('tanggal');
          $table->string('id_supplier',15);
          $table->string('id_faktur');
          $table->date('tgl_faktur');
          $table->string('pembayaran',2);
          $table->integer('tempo');
          $table->decimal('total_trans',15,2);
          $table->string('isactive');
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
        Schema::dropIfExists('pembelian_acc');
    }
}
