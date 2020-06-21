<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCekGiroTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cek_giro', function (Blueprint $table) {
            $table->string('id')->unique();
            $table->integer('index')->nullable();
            $table->date('tanggal_keluar')->nullable();
            $table->string('no_cek_giro_pelanggan')->nullable();
            $table->string('no_cek_giro_sendiri')->nullable();
            $table->string('id_akun_debet')->nullable();
            $table->string('id_akun_kredit')->nullable();
            $table->date('tanggal_jatuh_tempo')->nullable();
            $table->decimal('nominal',30,2)->nullable();
            $table->string('uraian')->nullable();
            $table->string('type',2); 
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
        Schema::dropIfExists('cek_giro');
    }
}
