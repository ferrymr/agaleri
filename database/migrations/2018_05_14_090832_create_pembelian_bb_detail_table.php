<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePembelianBBDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembelian_bb_detail', function (Blueprint $table) {
          $table->string('id_bp',15);
          $table->integer('index');
          $table->date('tanggal');
          $table->string('kode_bb');
          $table->string('id_bb',15);
          $table->string('id_warna',15);
          $table->string('id_supplier',15);
          $table->decimal('qty',15,2);
          $table->string('id_satuan',15);
          $table->decimal('harga',15,2);
          $table->decimal('jumlah',15,2);
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
        Schema::dropIfExists('pembelian_bb_detail');
    }
}
