<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaiKhoan extends Model
{
    protected $table = 'TaiKhoan';
    protected $fillable = ['maNV', 'tenDN', 'matKhau', 'loaiTK'];
}
