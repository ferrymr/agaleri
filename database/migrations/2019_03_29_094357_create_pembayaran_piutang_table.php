<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePembayaranPiutangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembayaran_piutang', function (Blueprint $table) {
            $table->string('id')->unique();
            $table->integer('index')->nullable();
            $table->date('tanggal_bayar')->nullable();
            $table->string('id_costumer',15)->nullable();
            $table->string('id_payment',15)->nullable();
            $table->decimal('total_hutang',30,2)->nullable();
            $table->decimal('total_bayar',30,2)->nullable();
            $table->decimal('total_sisa',30,2)->nullable();
            $table->integer('akun_id')->nullable();
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
        Schema::dropIfExists('pembayaran_piutang');
    }
}
