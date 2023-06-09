<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BangLuong extends Model
{
    protected $table = 'BangLuong';
    protected $fillable = [
        'maPB',
        'thang',
        'nam',
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

    public function department()
    {
        return $this->hasOne('App\PhongBan', 'id', 'maPB');
    }
}
