<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChiTietBangLuong extends Model
{
    protected $table = 'ChiTietBangLuong';
    protected $fillable = [
        'maNV',
        'maBL',
        'LCB',
        'LTC',
        'BHXH',
        'BHYT',
        'BHTN',
        'PC',
        'TTNCN',
        'LTT',
        'ghiChu',
    ];
}
