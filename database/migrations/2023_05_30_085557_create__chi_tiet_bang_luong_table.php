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
            $table->unsignedInteger('maPB')->nullable();
            $table->float('LCB');
            $table->float('LTC');
            $table->float('BHXH');
            $table->float('BHYT');
            $table->float('BHTN');
            $table->float('PC');
            $table->float('TTNCN');
            $table->float('LTT');
            $table->unsignedInteger('thang'); // Đợt trả lương vào tháng 
            $table->unsignedInteger('nam'); // Đợt trả lương vào năm
            $table->string('ghiChu')->nullable();
            $table->timestamps();
            $table->foreign('maNV')->references('id')->on('HoSoNV');
            $table->foreign('maPB')->references('id')->on('PhongBan');
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
