<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\ChucVu;
use App\LoaiHDLD;
use View;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if (!\App::runningInConsole()) {
            View::share('positions', ChucVu::all());
            View::share('contract_types', LoaiHDLD::all());
        }
    }
}
