<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasukBarangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('masuk_barang', function (Blueprint $table) {
            $table->integer('index');
            $table->string('id_barang');
            $table->string('id_size')->nullable();
            $table->string('type')->nullable();
            $table->decimal('qty',15,2)->nullable(); 
            $table->decimal('saldo',15,2)->nullable(); 
            $table->string('keterangan')->nullable();
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
        Schema::dropIfExists('masuk_barang');
    }
}
