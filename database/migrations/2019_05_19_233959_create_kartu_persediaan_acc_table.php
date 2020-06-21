<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKartuPersediaanAccTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kartu_persediaan_acc', function (Blueprint $table) {
            $table->integer('index');
            $table->string('kode_acc');
            $table->string('type_ref')->nullable();
            $table->string('id_ref')->nullable();
            $table->decimal('qty',15,2)->nullable(); 
            $table->integer('harga')->nullable();
            $table->decimal('jumlah',20,2)->nullable();
            $table->decimal('saldo_qty',10,2)->nullable();
            $table->integer('saldo_harga')->nullable();
            $table->decimal('saldo_jumlah',20,2)->nullable();
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
        Schema::dropIfExists('kartu_persediaan_acc');
    }
}
