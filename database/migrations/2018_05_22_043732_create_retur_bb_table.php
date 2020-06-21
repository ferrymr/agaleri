<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReturBBTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('retur_bb', function (Blueprint $table) {
          $table->string('id')->unique();
          $table->integer('index');
          $table->date('tanggal');
          $table->string('id_so');
          $table->string('id_jenis_bb');
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
        Schema::dropIfExists('retur_bb');
    }
}
