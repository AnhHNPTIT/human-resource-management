<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBangLuongTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('BangLuong', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('maBP');
            $table->string('thoiGian');
            $table->float('tongLCB', 8, 2);
            $table->float('tongLTC', 8, 2);
            $table->float('tongBHXH', 8, 2);
            $table->float('tongBHYT', 8, 2);
            $table->float('tongBHTN', 8, 2);
            $table->float('tongPC', 8, 2);
            $table->float('tongTTNCN', 8, 2);
            $table->float('tongLTT', 8, 2);
            $table->string('ghiChu')->nullable();
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
        Schema::dropIfExists('BangLuong');
    }
}
