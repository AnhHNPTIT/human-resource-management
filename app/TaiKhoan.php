<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class TaiKhoan extends Authenticatable
{
    use Notifiable;

    protected $guard = 'admin';
    protected $table = 'TaiKhoan';

    public function getAuthPassword()
    {
        return $this->matKhau;
    }

    protected $fillable = ['maNV', 'tenDN', 'matKhau', 'loaiTK'];
}
