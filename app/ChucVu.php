<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChucVu extends Model
{   
    protected $table = 'ChucVu';
    protected $fillable = ['chucVu', 'ghiChu'];
}
