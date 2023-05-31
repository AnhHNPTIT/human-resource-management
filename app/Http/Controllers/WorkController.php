<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\QTCongTac;
use App\PhongBan;
use App\ChucVu;
use App\HoSoNV;
use Validator;
use Auth;

class WorkController extends Controller
{
    public function worksIndex()
    {
        if (Auth::guard('admin')->user()->loaiTK == "NV") {
            $works = QTCongTac::where('maNV', Auth::guard('admin')->user()->maNV)->get();
        } else {
            $works = QTCongTac::all();
        }
        return view('work.works_list', ['works' => $works]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'maPB' => 'required',
                'maNV' => 'required',
                'maCV' => 'required',
                'ngayDenCT' => 'required',
                'ngayChuyenCT' => 'required',
            ],
            [
                'maPB.required' => 'Phòng ban không được để trống',
                'maNV.required' => 'Nhân viên không được để trống',
                'maCV.required' => 'Chức vụ không được để trống',
                'ngayDenCT.required' => 'Ngày đến công tác không được để trống',
                'ngayChuyenCT.required' => 'Ngày chuyển công tác không được để trống',
            ]
        );
        if ($validator->fails()) {
            return response()->json(['is' => 'failed', 'error' => $validator->errors()->all()]);
        }
        $data = $request->all();
        $instance = QTCongTac::create($data);
        if (isset($instance)) {
            return response()->json(['is' => 'success', 'complete' => 'Tạo lịch trình công tác thành công']);
        }
        return response()->json(['is' => 'unsuccess', 'uncomplete' => 'Lịch trình công tác chưa được tạo thành công']);
    }

    public function create()
    {
        $departments = PhongBan::all();
        $positions = ChucVu::all();
        $files = HoSoNV::all();
        return view('work.new_work', ['departments' => $departments, 'positions' => $positions, 'files' => $files]);
    }

    public function show($id)
    {
        $work =  QTCongTac::find($id);
        $departments = PhongBan::all();
        $positions = ChucVu::all();
        $files = HoSoNV::all();
        return view('work.work_detail', ['work' => $work, 'departments' => $departments, 'positions' => $positions, 'files' => $files]);
    }

    public function destroy($id)
    {
        $instance = QTCongTac::findOrFail($id)->delete();
        if ($instance) {
            return response()->json(['is' => 'success', 'complete' => 'Lịch trình công tác được xóa thành công']);
        }
        return response()->json(['is' => 'unsuccess', 'uncomplete' => 'Lịch trình công tác xóa chưa thành công']);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'maPB' => 'required',
                'maNV' => 'required',
                'maCV' => 'required',
                'ngayDenCT' => 'required',
                'ngayChuyenCT' => 'required',
            ],
            [
                'maPB.required' => 'Phòng ban không được để trống',
                'maNV.required' => 'Nhân viên không được để trống',
                'maCV.required' => 'Chức vụ không được để trống',
                'ngayDenCT.required' => 'Ngày đến công tác không được để trống',
                'ngayChuyenCT.required' => 'Ngày chuyển công tác không được để trống',
            ]
        );
        if ($validator->fails()) {
            return response()->json(['is' => 'failed', 'error' => $validator->errors()->all()]);
        }
        $data = $request->all();
        $flag = QTCongTac::find($id)->update($data);
        if ($flag) {
            return response()->json(['is' => 'success', 'complete' => 'Lịch trình công tác cập nhật thành công']);
        }
        return response()->json(['is' => 'unsuccess', 'uncomplete' => 'Lịch trình công tác cập nhật chưa thành công']);
    }
}
