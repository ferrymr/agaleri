<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermintaanBBTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permintaan_bb', function (Blueprint $table) {
              $table->string('id')->unique();
              $table->integer('index');
              $table->date('tanggal');
              $table->string('id_so');
              $table->decimal('total',15,2);
              $table->string('id_satuan',15)->nullable();
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
        Schema::dropIfExists('permintaan_bb');
    }
}
