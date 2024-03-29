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
            $table->string('company')->nullable();
            $table->string('id_detail_riwayat');
            $table->integer('is_active');
            $table->dateTime('waktu_payment')->nullable();
            $table->string('qr_code')->nullable();
            $table->text('note')->nullable();
            $table->integer('cost')->nullable();
            $table->integer('event')->nullable();
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
