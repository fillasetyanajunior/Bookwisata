<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaketTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paket', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('id_paket');
            $table->string('nama');
            $table->string('company');
            $table->string('provinsi');
            $table->string('kabupaten');
            $table->string('rating')->default(0);
            $table->text('review');
            $table->string('sale')->nullable();
            $table->string('harga');
            $table->string('kota_search');
            $table->string('foto');
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
        Schema::dropIfExists('paket');
    }
}
