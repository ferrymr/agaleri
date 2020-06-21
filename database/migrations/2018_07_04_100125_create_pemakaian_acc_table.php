<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePemakaianAccTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemakaian_acc', function (Blueprint $table) {
          $table->string('id')->unique();
          $table->string('id_bukti_permintaan');
          $table->increments('index');
          $table->date('tanggal');
          $table->string('id_so');
          $table->decimal('jumlah',15,2);          
          $table->string('isactive');
          $table->string('status_retur');
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
        Schema::dropIfExists('pemakaian_acc');
    }
}
