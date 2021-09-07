<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePusatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pusat', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('id_pusat');
            $table->string('nama');
            $table->string('provinsi');
            $table->string('kabupaten');
            $table->string('alamat');
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
        Schema::dropIfExists('pusat');
    }
}
