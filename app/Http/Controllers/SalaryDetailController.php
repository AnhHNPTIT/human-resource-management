<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ChiTietBangLuong;
use App\HoSoNV;
use App\QTCongTac;
use App\BangLuong;
use Validator;

class SalaryDetailController extends Controller
{
    public function indexSalaryDetail()
    {
        $salaryDetails = ChiTietBangLuong::all();
        return view('salary_detail.salary_list', ['salaryDetails' => $salaryDetails]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'maNV' => 'required',
                'thang' => 'required',
                'nam' => 'required',
                'LCB' => 'required',
                'LTC' => 'required',
                'BHXH' => 'required',
                'BHYT' => 'required',
                'BHTN' => 'required',
                'PC' => 'required',
                'TTNCN' => 'required',
            ],
            [
                'maNV.required' => 'Nhân viên không được để trống',
                'thang.required' => 'Tháng không được để trống',
                'nam.required' => 'Năm không được để trống',
                'LCB.required' => 'Lương cơ bản không được để trống',
                'LTC.required' => 'Lương tăng ca không được để trống',
                'BHXH.required' => 'BHXH không được để trống',
                'BHYT.required' => 'BHYT không được để trống',
                'BHTN.required' => 'BHTN không được để trống',
                'PC.required' => 'Phụ cấp không được để trống',
                'TTNCN.required' => 'Thuế thu nhập cá nhân không được để trống',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['is' => 'failed', 'error' => $validator->errors()->all()]);
        }
        $data = $request->all();
        unset($data['_token']);
        $data['LTT'] = $data['LCB'] + $data['LTC'] + $data['PC'] - $data['BHXH'] - $data['BHYT'] - $data['BHTN'] - $data['TTNCN'];

        $work = QTCongTac::where('maNV', $data['maNV'])
            ->where('ngayDenCT', '<=', \Carbon\Carbon::today())
            ->where('ngayChuyenCT', '>=', \Carbon\Carbon::today())->first();
        
        if ($work) {
            $data['maPB'] = $work['maPB'];
            // update report
            $checkExist = BangLuong::where('maPB', $data['maPB'])->where('nam', $data['nam'])->where('thang', $data['thang'])->first();
            if ($checkExist) {
                BangLuong::find($checkExist->id)->update([
                    'tongLCB' => $data['maPB'] + $checkExist['tongLCB'],
                    'tongLTC' => $data['LTC'] + $checkExist['tongLTC'],
                    'tongBHXH' => $data['BHXH'] + $checkExist['tongBHXH'],
                    'tongBHYT' => $data['BHYT'] + $checkExist['tongBHYT'],
                    'tongBHTN' => $data['BHTN'] + $checkExist['tongBHTN'],
                    'tongPC' => $data['PC'] + $checkExist['tongPC'],
                    'tongTTNCN' => $data['TTNCN'] + $checkExist['tongTTNCN'],
                    'tongLTT' => $data['LTT'] + $checkExist['tongLTT']
                ]);
            } else {
                BangLuong::create([
                    'maPB' => $data['maPB'],
                    'tongLCB' => $data['LCB'],
                    'tongLTC' => $data['LTC'],
                    'tongBHXH' => $data['BHXH'],
                    'tongBHYT' => $data['BHYT'],
                    'tongBHTN' => $data['BHTN'],
                    'tongPC' => $data['PC'],
                    'tongTTNCN' => $data['TTNCN'],
                    'tongLTT' => $data['LTT'],
                    'thang' => $data['thang'],
                    'nam' => $data['nam'],
                ]);
            }
        }

        $instance = ChiTietBangLuong::create($data);
        if (isset($instance)) {
            return response()->json(['is' => 'success', 'complete' => 'Tạo chi tiết bảng lương thành công']);
        }
        return response()->json(['is' => 'unsuccess', 'uncomplete' => 'Chi tiết bảng lương chưa được tạo thành công']);
    }


    public function show($id)
    {
        $files = HoSoNV::all();
        $salaryDetail = ChiTietBangLuong::find($id);
        return view('salary_detail.salary_detail', ['files' => $files, 'salaryDetail' => $salaryDetail]);
    }

    public function destroy($id)
    {
        $instance = ChiTietBangLuong::findOrFail($id)->delete();
        if ($instance) {
            return response()->json(['is' => 'success', 'complete' => 'Chi tiết bảng lương được xóa thành công']);
        }
        return response()->json(['is' => 'unsuccess', 'uncomplete' => 'Chi tiết bảng lương xóa chưa thành công']);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'maNV' => 'required',
                'thang' => 'required',
                'nam' => 'required',
                'LCB' => 'required',
                'LTC' => 'required',
                'BHXH' => 'required',
                'BHYT' => 'required',
                'BHTN' => 'required',
                'PC' => 'required',
                'TTNCN' => 'required',
            ],
            [
                'maNV.required' => 'Nhân viên không được để trống',
                'thang.required' => 'Tháng không được để trống',
                'nam.required' => 'Năm không được để trống',
                'LCB.required' => 'Lương cơ bản không được để trống',
                'LTC.required' => 'Lương tăng ca không được để trống',
                'BHXH.required' => 'BHXH không được để trống',
                'BHYT.required' => 'BHYT không được để trống',
                'BHTN.required' => 'BHTN không được để trống',
                'PC.required' => 'Phụ cấp không được để trống',
                'TTNCN.required' => 'Thuế thu nhập cá nhân không được để trống',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['is' => 'failed', 'error' => $validator->errors()->all()]);
        }
        $data = $request->all();
        unset($data['_token']);
        $data['LTT'] = $data['LCB'] + $data['LTC'] + $data['PC'] - $data['BHXH'] - $data['BHYT'] - $data['BHTN'] - $data['TTNCN'];
        $flag = ChiTietBangLuong::find($id)->update($data);
        if ($flag) {
            return response()->json(['is' => 'success', 'complete' => 'Chi tiết bảng lương cập nhật thành công']);
        }
        return response()->json(['is' => 'unsuccess', 'uncomplete' => 'Chi tiết bảng lương cập nhật chưa thành công']);
    }

    public function create()
    {
        $files = HoSoNV::all();
        return view('salary_detail.new_salary', ['files' => $files]);
    }
}
