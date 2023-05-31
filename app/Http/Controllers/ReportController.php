<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\QTCongTac;
use App\BangLuong;

class ReportController extends Controller
{
    public function reportSalary(Request $request)
    {
        $reports = BangLuong::all();
        if ($request->from_month) {
            $reports = $reports->where('thang', '>=', $request->from_month);
        }
        if ($request->from_year) {
            $reports = $reports->where('nam', '>=', $request->from_year);
        }
        if ($request->to_month) {
            $reports = $reports->where('thang', '<=', $request->to_month);
        }
        if ($request->to_year) {
            $reports = $reports->where('nam', '<=', $request->to_year);
        }
        return view('admin.report_salary', [
            'from_month' => $request->from_month < 10 ? '0' . $request->from_month : $request->from_month,
            'from_year' => $request->from_year,
            'to_month' => $request->to_month < 10 ? '0' . $request->to_month : $request->to_month,
            'to_year' => $request->to_year,
            'reports' => $reports
        ]);
    }

    public function reportAccount()
    {
        $records = QTCongTac::where('ngayDenCT', '<=', \Carbon\Carbon::today())
            ->where('ngayChuyenCT', '>=', \Carbon\Carbon::today())->get();
        $reports = [];
        foreach ($records as $value) {
            if (array_key_exists($value->maPB, $reports)) {
                $reports[$value->maPB]['soLuongNv'] += 1;
                continue;
            }
            $reports[$value->maPB]['soLuongNv'] = 1;
            $reports[$value->maPB]['tenPB'] = $value->department->tenPB;
            $reports[$value->maPB]['soDT'] = $value->department->soDT;
            $reports[$value->maPB]['diaChi'] = $value->department->diaChi;
        }
        return view('admin.report_account', [
            'reports' => $reports,
        ]);
    }
}
