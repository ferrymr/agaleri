<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKonfirmasiPembayaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('konfirmasi_pembayaran', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('order_id');
          $table->string('nomor_rekening');
          $table->string('nama_account');
          $table->dateTime('tanggal_transfer');
          $table->decimal('jumlah_transfer',30,2);
          $table->string('status',2); // A Approved S Suspended
          $table->integer('admin_id_approved')->nullable();
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
        Schema::dropIfExists('konfirmasi_pembayaran');
    }
}
