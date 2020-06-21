<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAkunTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('akun', function (Blueprint $table) {
            $table->string('id',15);
            $table->integer('index');
            $table->string('name');
            $table->string('deskripsi')->nullable();
            $table->string('id_kategori',15)->nullable();
            $table->decimal('saldo_awal',20,2)->nullable();
            $table->decimal('saldo',20,2)->nullable();
            $table->string('k1')->nullable();
            $table->string('k2')->nullable();
            $table->string('k3')->nullable();
            $table->string('level');
            $table->string('kategori_laporan',2)->nullable();
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
        Schema::dropIfExists('akun');
    }
}
