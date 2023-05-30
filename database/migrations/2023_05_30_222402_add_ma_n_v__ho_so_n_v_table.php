<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMaNVHoSoNVTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('HoSoNV', function (Blueprint $table) {
            $table->unsignedInteger('maNV')->after('id');
            $table->foreign('maNV')->references('id')->on('TaiKhoan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('HoSoNV', function (Blueprint $table) {
            // 1. Drop foreign key constraints
            $table->dropForeign(['maNV']);
            // 2. Drop the column
            $table->dropColumn('maNV');
        });
    }
}
