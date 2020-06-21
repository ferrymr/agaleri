<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('param', function (Blueprint $table) {
          $table->string('id',15)->unique();
          $table->integer('index');
          $table->string('name_aplikasi');
          $table->string('name_perusahaan');
          $table->string('versi');
          $table->string('alamat');
          $table->string('telepon');
          $table->string('no_wa');
          $table->string('email');
          $table->string('logo_aplikasi')->nullable();
          $table->string('background_front')->nullable();
          $table->string('logo_perusahaan')->nullable();
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
        Schema::dropIfExists('param');
    }
}
