<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQTCongTacTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('QTCongTac', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('maNV');
            $table->unsignedInteger('maCV');
            $table->unsignedInteger('maPB');
            $table->date('ngayDenCT')->nullable();
            $table->date('ngayChuyenCT')->nullable();
            $table->timestamps();
            $table->foreign('maNV')->references('id')->on('HoSoNV');
            $table->foreign('maCV')->references('id')->on('ChucVu');
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
        Schema::dropIfExists('QTCongTac');
    }
}
