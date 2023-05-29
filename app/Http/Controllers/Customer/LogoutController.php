<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Customer;

class LogoutController extends Controller
{
    public function logout()
    {
        Auth::logout();
        return redirect()->intended('/');
    }
}
