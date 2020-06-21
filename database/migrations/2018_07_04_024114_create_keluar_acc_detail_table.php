<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKeluarAccDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keluar_acc_detail', function (Blueprint $table) {
          $table->string('id_keluar',15);
          $table->string('id_permintaan',15);
          $table->integer('index');
          $table->string('kode_acc');
          $table->decimal('qty',15,2);
          $table->string('id_satuan',15);
          $table->string('ket')->nullable();
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
        Schema::dropIfExists('keluar_acc_detail');
    }
}
