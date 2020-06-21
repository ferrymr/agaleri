<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKeluarAccTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keluar_acc', function (Blueprint $table) {
          $table->string('id',15)->unique();
          $table->integer('index');
          $table->decimal('total',15,2);
          $table->string('id_satuan',15);
          $table->date('tanggal');
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
        Schema::dropIfExists('keluar_acc');
    }
}
