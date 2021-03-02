<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailRiwayatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_riwayat', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('email');
            $table->string('nomerhp', 12);
            $table->string('nama_pilihan');
            $table->string('tipe');
            $table->string('jumlah_sit');
            $table->string('harga');
            $table->string('jumlahpesanan');
            $table->string('durasi');
            $table->string('potongan');
            $table->string('hari');
            $table->string('date');
            $table->string('total');
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
        Schema::dropIfExists('detail_riwayat');
    }
}
