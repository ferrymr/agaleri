<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_detail', function (Blueprint $table) {
          $table->integer('order_id');
          $table->string('barang_id',15)->nullable();
          $table->string('so_id',15)->nullable(); // Jika Costume Order
          $table->string('art_id',15)->nullable(); // Jika Costume Order
          $table->integer('index');
          $table->string('warna_id',15)->nullable();
          $table->string('ukuran_id',15)->nullable();
          $table->integer('qty'); // Satuan PCS
          $table->decimal('harga',20,2);
          $table->decimal('potongan',20,2);
          $table->decimal('berat',5,2); // Satuan KG
          $table->decimal('total',30,2);
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
        Schema::dropIfExists('order_detail');
    }
}
