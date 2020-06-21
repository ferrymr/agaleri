<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePiutangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('piutang', function (Blueprint $table) {
            $table->string('id')->unique();
            $table->integer('index')->nullable();
            $table->string('id_costumer',15)->nullable();
            $table->string('type',3)->nullable();
            $table->string('no_invoice',15)->nullable();
            $table->date('tanggal_invoice')->nullable();
            $table->decimal('total_piutang',30,2)->nullable();
            $table->decimal('total_bayar',30,2)->nullable();
            $table->decimal('total_sisa',30,2)->nullable();
            $table->integer('tempo')->nullable();
            $table->date('tanggal_jatuh_tempo')->nullable();
            $table->string('status',2);
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
        Schema::dropIfExists('piutang');
    }
}
