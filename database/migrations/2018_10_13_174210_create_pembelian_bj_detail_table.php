<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePembelianBJDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembelian_bj_detail', function (Blueprint $table) {
          $table->string('id',15);
          $table->integer('index');
          $table->date('tanggal');
          $table->string('kode_bj');
          $table->string('id_bj',35);
          $table->string('id_warna',15)->nullable();
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
        Schema::dropIfExists('pembelian_b_j_details');
    }
}
