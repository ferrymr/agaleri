<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePembayaranDetailHutangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembayaran_detail_hutang', function (Blueprint $table) {
            $table->string('id_pembayaran');
            $table->integer('index')->nullable();
            $table->string('no_faktur',15)->nullable();
            $table->decimal('jumlah_bayar',30,2)->nullable();
            $table->decimal('diskon',30,2)->nullable();
            $table->decimal('total_bayar',30,2)->nullable();
            $table->string('keterangan')->nullable();
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
        Schema::dropIfExists('pembayaran_detail_hutang');
    }
}
