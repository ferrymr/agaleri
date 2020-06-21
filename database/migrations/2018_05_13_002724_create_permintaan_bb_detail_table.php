<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermintaanBBDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permintaan_bb_detail', function (Blueprint $table) {
          $table->string('no_bukti_permintaan',15);
          $table->integer('index');
          $table->date('tanggal');
          $table->string('kode_bb');
          $table->string('id_bb',15);
          $table->string('id_warna',15);
          $table->string('id_supplier',15);
          $table->decimal('qty',15,2);
          $table->string('id_satuan',15)->nullable();
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
        Schema::dropIfExists('permintaan_bb_detail');
    }
}
