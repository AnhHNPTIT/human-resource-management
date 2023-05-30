<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaiKhoanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TaiKhoan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tenDN');
            $table->string('matKhau');
            $table->enum('loaiTK', ['NV_NHANSU', 'NV', 'NV_KETOAN', 'GIAMDOC']); // Loại tài khoản
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
        Schema::dropIfExists('TaiKhoan');
    }
}
