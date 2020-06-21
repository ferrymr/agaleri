<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkbTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skb', function (Blueprint $table) {
          $table->string('id')->unique();
          $table->integer('index');
          $table->date('tanggal');
          $table->string('type',2);
          $table->string('proses_id',15);
          $table->string('ket')->nullable();
          $table->string('isactive',2);
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
        Schema::dropIfExists('skb');
    }
}
