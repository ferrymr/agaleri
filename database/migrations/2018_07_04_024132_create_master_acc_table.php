<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasterAccTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_acc', function (Blueprint $table) {
          $table->string('id')->unique();
          $table->integer('index');
          $table->string('name');
          $table->string('id_acc',15);
          $table->string('id_brand',15);
          $table->string('id_supplier',15);
          $table->decimal('stock',15,2);
          $table->string('id_satuan',15);
          $table->decimal('harga_default',15,2);
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
        Schema::dropIfExists('master_acc');
    }
}
