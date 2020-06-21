<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePembelianBJTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembelian_bj', function (Blueprint $table) {
          $table->string('id')->unique();
          $table->integer('index');
          $table->string('type');
          $table->date('tanggal');
          $table->string('id_so',15)->nullable();
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
        Schema::dropIfExists('pembelian_b_js');
    }
}
