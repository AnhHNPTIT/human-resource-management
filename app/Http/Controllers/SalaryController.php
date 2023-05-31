<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ChiTietBangLuong;
use App\HoSoNV;
use App\QTCongTac;
use App\BangLuong;
use Validator;

class SalaryController extends Controller
{
    public function reportSalary(Request $request)
    {
        $reports = BangLuong::where('thang', '>=', $request->from_month)
            ->where('nam', '>=', $request->from_year)
            ->where('thang', '<=', $request->to_month)
            ->where('nam', '<=', $request->to_year)->get();
        return view('admin.report_salary', [
            'from_month' => $request->from_month < 10 ? '0' . $request->from_month : $request->from_month,
            'from_year' => $request->from_year,
            'to_month' => $request->to_month < 10 ? '0' . $request->to_month : $request->to_month,
            'to_year' => $request->to_year,
            'reports' => $reports
        ]);
    }
}
