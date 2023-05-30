<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HopDongLD extends Model
{
  protected $table = 'HopDongLD';
  protected $fillable = [
    'maLHDLD',
    'maCV',
    'ngayKyHD',
    'ngayBD',
    'ngayKT',
  ];

  public function contractType()
  {
    return $this->hasOne('App\LoaiHDLD', 'id', 'maLHDLD');
  }

  public function position()
  {
    return $this->hasOne('App\ChucVu', 'id', 'maCV');
  }
}
