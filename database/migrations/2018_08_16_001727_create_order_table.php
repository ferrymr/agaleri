<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('user_id');
          $table->string('type_order',1); // N Normal C Costume
          $table->string('kurir_id',15)->nullable();
          $table->string('jenis_pengiriman',15)->nullable(); // R Reguler E Express
          $table->decimal('total_berat',5,2)->nullable(); // Satuan KG
          $table->decimal('ongkos_kirim',15,2)->nullable();
          $table->string('nama_penerima')->nullable();
          $table->string('telepon')->nullable();
          $table->mediumText('alamat_tujuan')->nullable();
          $table->string('kota')->nullable();
          $table->string('provinsi')->nullable();
          $table->longText('catatan_order')->nullable();
          $table->longText('catatan_terima')->nullable();
          $table->longText('catatan_batal')->nullable();
          $table->longText('catatan_retur')->nullable();
          $table->dateTime('tanggal_order')->nullable();
          $table->dateTime('tanggal_terima')->nullable();
          $table->dateTime('tanggal_batal')->nullable();
          $table->dateTime('tanggal_retur')->nullable();
          $table->decimal('total_transaksi',30,2);
          $table->string('status_order',2); // OA Order Telah Di Approved, OF Order Not Approved (Failded), OP Order sedang di Packing, OD Order dalam proses delivery, OF Pengiriman bermasalah (Failed), OR Order Retur, OS Order Success
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
        Schema::dropIfExists('order');
    }
}
