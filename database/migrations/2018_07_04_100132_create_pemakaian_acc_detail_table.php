<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePemakaianAccDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemakaian_acc_detail', function (Blueprint $table) {
          $table->string('no_bukti_pemakaian',15);
          $table->string('no_bukti_permintaan',15);
          $table->integer('index');
          $table->date('tanggal');
          $table->string('kode_acc');
          $table->string('id_acc',15);
          $table->string('id_brand',15);
          $table->string('id_supplier',15);
          $table->decimal('qty',15,2);
          $table->string('id_satuan',15)->nullable();
          $table->string('ket')->nullable();
          $table->string('isactive',1);
          $table->decimal('jumlah',15,2);
          $table->decimal('qty_retur',15,2);
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
        Schema::dropIfExists('pemakaian_acc_detail');
    }
}
