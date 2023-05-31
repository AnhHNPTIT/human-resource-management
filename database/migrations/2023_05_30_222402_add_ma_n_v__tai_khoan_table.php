<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMaNVTaiKhoanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('TaiKhoan', function (Blueprint $table) {
            $table->unsignedInteger('maNV')->nullable()->after('id');
            $table->foreign('maNV')->references('id')->on('HoSoNV');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('TaiKhoan', function (Blueprint $table) {
            // 1. Drop foreign key constraints
            $table->dropForeign(['maNV']);
            // 2. Drop the column
            $table->dropColumn('maNV');
        });
    }
}
