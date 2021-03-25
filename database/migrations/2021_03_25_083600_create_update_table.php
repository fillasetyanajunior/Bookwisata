<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUpdateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bus', function (Blueprint $table) {
            $table->string('kota_search');
        });
        Schema::table('mobil', function (Blueprint $table) {
            $table->string('kota_search');
        });
        Schema::table('kapal', function (Blueprint $table) {
            $table->string('kota_search');
        });
        Schema::table('pusat', function (Blueprint $table) {
            $table->string('kota_search');
        });
        Schema::table('destinasi', function (Blueprint $table) {
            $table->string('kota_search');
        });
        Schema::table('hotel', function (Blueprint $table) {
            $table->string('kota_search');
        });
        Schema::table('paket', function (Blueprint $table) {
            $table->string('kota_search');
        });
        Schema::table('guide', function (Blueprint $table) {
            $table->string('kota_search');
        });
        Schema::table('kuliner', function (Blueprint $table) {
            $table->string('kota_search');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('update');
    }
}
