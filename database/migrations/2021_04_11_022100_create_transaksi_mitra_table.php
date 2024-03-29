<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiMitraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_mitra', function (Blueprint $table) {
            $table->id();
            $table->string('kode_transaksi');
            $table->string('nama');
            $table->string('email');
            $table->string('nomer');
            $table->string('alamat');
            $table->string('paket_mitra');
            $table->dateTime('waktu_payment');
            $table->string('harga');
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
        Schema::dropIfExists('transaksi_mitra');
    }
}
