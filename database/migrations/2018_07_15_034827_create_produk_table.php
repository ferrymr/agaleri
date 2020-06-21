<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProdukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produk', function (Blueprint $table) {
          $table->string('id')->unique();
          $table->integer('index');
          $table->string('name');
          $table->string('id_category',15)->nullable();
          $table->string('qty')->nullable();
          $table->decimal('harga',15,2)->nullable();
          $table->string('thumb')->nullable();
          $table->string('photo')->nullable();
          $table->decimal('berat',15,2)->nullable();
          $table->string('spesifikasi',1000)->nullable();
          $table->string('deskripsi',1000)->nullable();
          $table->string('status',1)->nullable();
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
        Schema::dropIfExists('produk');
    }
}
