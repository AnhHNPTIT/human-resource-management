<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HoSoNV extends Model
{
    protected $table = 'HoSoNV';
    protected $fillable = [
        'maNV',
        'hoTen',
        'anhThe',
        'gioiTinh',
        'ngaySinh',
        'diaChi',
        'soDT',
        'bangCap',
        'soCMND',
        'email',
        'maHDLD',
        'maBHXH',
        'maBHYT',
        'maBHTN',
    ];

    public function account()
    {
        return $this->hasOne('App\TaiKhoan', 'id', 'maNV');
    }

    public function contract()
    {
        return $this->hasOne('App\HopDongLD', 'id', 'maHDLD');
    }
}
