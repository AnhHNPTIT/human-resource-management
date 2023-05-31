<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ChiTietBangLuong;
use App\TaiKhoan;
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
                'maLHDLD' => 'required',
                'maCV' => 'required',
                'ngayKyHD' => 'required',
                'ngayBD' => 'required',
                'ngayKT' => 'required',
            ],
            [
                'maLHDLD.required' => 'Loại Chi tiết bảng lương không được để trống',
                'maCV.required' => 'Chức vụ không được để trống',
                'ngayKyHD.required' => 'Ngày ký Chi tiết bảng lương không được để trống',
                'ngayBD.required' => 'Ngày bắt đầu không được để trống',
                'ngayKT.required' => 'Ngày kết thúc không được để trống',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['is' => 'failed', 'error' => $validator->errors()->all()]);
        }

        $data = $request->all();
        unset($data['_token']);

        $instance = ChiTietBangLuong::create($data);

        if (isset($instance)) {
            return response()->json(['is' => 'success', 'complete' => 'Tạo Chi tiết bảng lương thành công']);
        }
        return response()->json(['is' => 'unsuccess', 'uncomplete' => 'Chi tiết bảng lương chưa được tạo thành công']);
    }


    public function show($id)
    {
        $contract =  ChiTietBangLuong::find($id);
        return view('contract.contract_detail', ['contract' => $contract]);
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
        $data = $request->all();
        $flag = ChiTietBangLuong::find($id)->update([
            'maLHDLD' => $data['maLHDLD'],
            'maCV' => $data['maCV'],
            'ngayKyHD' => $data['ngayKyHD'],
            'ngayBD' => $data['ngayBD'],
            'ngayKT' => $data['ngayKT']
        ]);
        if ($flag) {
            return response()->json(['is' => 'success', 'complete' => 'Chi tiết bảng lương cập nhật thành công']);
        }
        return response()->json(['is' => 'unsuccess', 'uncomplete' => 'Chi tiết bảng lương cập nhật chưa thành công']);
    }

    public function create()
    {
        $accounts = TaiKhoan::all();
        return view('salary_detail.new_salary', ['accounts' => $accounts]);
    }
}
