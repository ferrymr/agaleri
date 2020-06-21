<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkbDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skb_detail', function (Blueprint $table) {
          $table->string('skb_id',15);
          $table->string('so_id',15);
          $table->string('art_id',15);
          $table->integer('index');
          $table->string('name');
          $table->decimal('qty',15,2);
          $table->string('satuan_id',15);
          $table->string('cmt_id',15);
          $table->string('status_cmt',2);
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
        Schema::dropIfExists('skb_detail');
    }
}
