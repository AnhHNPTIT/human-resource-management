<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHopDongLDTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('HopDongLD', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('maLHDLD');
            $table->unsignedInteger('maCV');
            $table->date('ngayKyHD');
            $table->date('ngayBD');
            $table->date('ngayKT');
            $table->timestamps();
            $table->foreign('maLHDLD')->references('id')->on('LoaiHDLD');
            $table->foreign('maCV')->references('id')->on('ChucVu');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('HopDongLD');
    }
}
