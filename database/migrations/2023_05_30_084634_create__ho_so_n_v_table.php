<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHoSoNVTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('HoSoNV', function (Blueprint $table) {
            $table->increments('id');
            $table->string('hoTen');
            $table->string('anhThe');
            $table->enum('gioiTinh', [1, 2]); // 1 Nam, 2 Nu
            $table->date('ngaySinh');
            $table->string('diaChi');
            $table->string('soDT');
            $table->string('bangCap');
            $table->string('soCMND');
            $table->string('email');
            $table->unsignedInteger('maHDLD'); 
            $table->string('maBHXH');
            $table->string('maBHYT');
            $table->string('maBHTN');
            $table->timestamps();
            $table->foreign('maHDLD')->references('id')->on('HopDongLD');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('HoSoNV');
    }
}
