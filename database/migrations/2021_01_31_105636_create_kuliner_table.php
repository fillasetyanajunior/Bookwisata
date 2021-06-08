<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKulinerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kuliner', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('nama');
            $table->string('provinsi');
            $table->string('kabupaten');
            $table->string('alamat');
            $table->string('rating');
            $table->text('review');
            $table->string('harga');
            $table->string('kota_search');
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
        Schema::dropIfExists('kuliner');
    }
}
