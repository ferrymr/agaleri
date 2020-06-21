<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProdukStokTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produk_stok', function (Blueprint $table) {
            $table->integer('index');
            $table->string('id_barang');
            $table->string('id_size');
            $table->integer('stok')->nullable();
            $table->decimal('price', 15, 2)->nullable();
            $table->string('status', 1);
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
        Schema::dropIfExists('produk_stok');
    }
}
