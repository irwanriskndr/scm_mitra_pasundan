<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswa', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('jurusan_id');
            $table->string('nisn');
            $table->string('nama');
            $table->date('tgl_lahir');
            $table->longText('alamat')->nullable();
            $table->string('gender');
            $table->string('phone_number');
            $table->string('status')->default('TERSEDIA');
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
        Schema::dropIfExists('siswa');
    }
}
