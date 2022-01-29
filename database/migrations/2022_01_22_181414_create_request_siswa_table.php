<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestSiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_siswa', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('user_id');
            $table->longText('deskripsi');
            $table->integer('jumlah');
            $table->string('status')->default('REQUESTED');
            $table->softDeletes();
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
        Schema::dropIfExists('request_siswa');
    }
}
