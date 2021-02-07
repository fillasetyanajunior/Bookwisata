<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiwayatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('riwayat', function (Blueprint $table) {
            $table->id();
            $table->string('user_nama_customer');
            $table->string('user_id_owner');
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
            $table->integer('is_active');
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
        Schema::dropIfExists('riwayat');
    }
}
