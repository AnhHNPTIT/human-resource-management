<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhongBan extends Model
{
    protected $table = 'PhongBan';
    protected $fillable = ['tenPB', 'soDT', 'diaChi'];
}
