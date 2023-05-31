<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChiTietBangLuong extends Model
{
    protected $table = 'ChiTietBangLuong';
    protected $fillable = [
        'thang',
        'nam',
        'maNV',
        'maPB',
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

    public function account()
    {
        return $this->hasOne('App\HoSoNV', 'id', 'maNV');
    }

    public function department()
    {
        return $this->hasOne('App\PhongBan', 'id', 'maPB');
    }
}
