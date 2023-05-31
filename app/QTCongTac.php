<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QTCongTac extends Model
{
  protected $table = 'QTCongTac';
  protected $fillable = [
    'maNV',
    'maCV',
    'maPB',
    'ngayDenCT',
    'ngayChuyenCT',
  ];

  public function account()
  {
    return $this->hasOne('App\HoSoNV', 'id', 'maNV');
  }

  public function department()
  {
    return $this->hasOne('App\PhongBan', 'id', 'maPB');
  }

  public function position()
  {
    return $this->hasOne('App\ChucVu', 'id', 'maCV');
  }
}
