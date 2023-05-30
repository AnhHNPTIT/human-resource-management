<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChiTietBangLuongTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ChiTietBangLuong', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('maNV');
            $table->unsignedInteger('maBL');
            $table->float('LCB');
            $table->float('LTC');
            $table->float('BHXH');
            $table->float('BHYT');
            $table->float('BHTN');
            $table->float('PC');
            $table->float('TTNCN');
            $table->float('LTT');
            $table->string('ghiChu')->nullable();
            $table->timestamps();
            $table->foreign('maNV')->references('id')->on('TaiKhoan');
            $table->foreign('maBL')->references('id')->on('BangLuong');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ChiTietBangLuong');
    }
}
