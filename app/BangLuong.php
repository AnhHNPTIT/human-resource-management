<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BangLuong extends Model
{   
    protected $table = 'BangLuong';
    protected $fillable = [
        'maBP',
        'thoiGian',
        'tongLCB',
        'tongLTC',
        'tongBHXH',
        'tongBHYT',
        'tongBHTN',
        'tongPC',
        'tongTTNCN',
        'tongLTT',
        'ghiChu',
    ];
}
