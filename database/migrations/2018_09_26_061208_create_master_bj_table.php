<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasterBJTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_bj', function (Blueprint $table) {
          $table->string('id')->unique();
          $table->integer('index');
          $table->string('name');
          $table->string('id_bj',15);
          $table->string('id_so',15)->nullable();
          $table->string('id_art',15)->nullable();
          $table->string('id_brand',15)->nullable();
          $table->string('id_warna',15)->nullable();
          $table->string('id_supplier',15)->nullable();
          $table->string('id_target',15)->nullable();
          $table->decimal('stock',15,2)->nullable();
          $table->string('id_satuan',15)->nullable();
          $table->decimal('harga_default',15,2)->nullable();
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
        Schema::dropIfExists('master_bj');
    }
}
