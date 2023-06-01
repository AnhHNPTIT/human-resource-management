<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HoSoNV;
use App\TaiKhoan;
use App\HopDongLD;
use Validator;
use Auth;

class FileController extends Controller
{
    public function filesIndex()
    {
        if(Auth::guard('admin')->user()->loaiTK == "NV"){
            $files = HoSoNV::where('id', Auth::guard('admin')->user()->maNV)->get();
        }
        else{
            $files = HoSoNV::all();
        }
        return view('file.files_list', ['files' => $files]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'hoTen' => 'required',
                'anhThe' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'ngaySinh' => 'required',
                'gioiTinh' => 'required',
                'diaChi' => 'required',
                'soDT' => 'required',
                'bangCap' => 'required',
                'soCMND' => 'required',
                'email' => 'required',
                'maHDLD' => 'required',
                'maBHXH' => 'required',
                'maBHYT' => 'required',
                'maBHTN' => 'required',
            ],
            [
                'hoTen.required' => 'Họ tên không được để trống',
                'anhThe.image' => 'Yêu cầu phải là ảnh có đuôi jpeg,png,jpg,gif',
                'anhThe.mimes' => 'Yêu cầu phải là ảnh có đuôi jpeg,png,jpg,gif',
                'anhThe.max' => 'Ảnh không vượt quá 2MB',
                'ngaySinh.required' => 'Ngày sinh không được để trống',
                'gioiTinh.required' => 'Giới tính không được để trống',
                'diaChi.required' => 'Địa chỉ không được để trống',
                'soDT.required' => 'Số điện thoại không được để trống',
                'bangCap.required' => 'Bằng cấp không được để trống',
                'soCMND.required' => 'Số CMND không được để trống',
                'email.required' => 'Email không được để trống',
                'maHDLD.required' => 'Mã HDLD không được để trống',
                'maBHXH.required' => 'Mã BHXH không được để trống',
                'maBHYT.required' => 'Mã BHYT không được để trống',
                'maBHTN.required' => 'Mã BHTN không được để trống',
            ]
        );
        if ($validator->fails()) {
            return response()->json(['is' => 'failed', 'error' => $validator->errors()->all()]);
        }
        $data = $request->all();
        unset($data['_token']);
        if ($files = $request->file('anhThe')) {
            $destinationPath = 'images/'; // upload path
            $time = time();
            $fileName = $time . "" . date('YmdHis') . "" . $files->hashName();
            $files->move($destinationPath, $fileName);
            $data['anhThe'] = $fileName;
        }
        $instance = HoSoNV::create($data);
        if (isset($instance)) {
            return response()->json(['is' => 'success', 'complete' => 'Tạo Hồ sơ thành công']);
        }
        return response()->json(['is' => 'unsuccess', 'uncomplete' => 'Hồ sơ chưa được tạo thành công']);
    }

    public function create()
    {
        $accounts = TaiKhoan::all();
        $contracts = HopDongLD::all();
        return view('file.new_file', ['accounts' => $accounts, 'contracts' => $contracts]);
    }

    public function show($id)
    {
        $file =  HoSoNV::find($id);
        $accounts = TaiKhoan::all();
        $contracts = HopDongLD::all();
        return view('file.file_detail', ['file' => $file, 'accounts' => $accounts, 'contracts' => $contracts]);
    }

    public function destroy($id)
    {
        $instance = HoSoNV::findOrFail($id)->delete();
        if ($instance) {
            return response()->json(['is' => 'success', 'complete' => 'Hồ sơ được xóa thành công']);
        }
        return response()->json(['is' => 'unsuccess', 'uncomplete' => 'Hồ sơ xóa chưa thành công']);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'hoTen' => 'required',
                'ngaySinh' => 'required',
                'gioiTinh' => 'required',
                'diaChi' => 'required',
                'soDT' => 'required',
                'bangCap' => 'required',
                'soCMND' => 'required',
                'email' => 'required',
                'maHDLD' => 'required',
                'maBHXH' => 'required',
                'maBHYT' => 'required',
                'maBHTN' => 'required',
            ],
            [
                'hoTen.required' => 'Họ tên không được để trống',
                'ngaySinh.required' => 'Ngày sinh không được để trống',
                'gioiTinh.required' => 'Giới tính không được để trống',
                'diaChi.required' => 'Địa chỉ không được để trống',
                'soDT.required' => 'Số điện thoại không được để trống',
                'bangCap.required' => 'Bằng cấp không được để trống',
                'soCMND.required' => 'Số CMND không được để trống',
                'email.required' => 'Email không được để trống',
                'maHDLD.required' => 'Mã HDLD không được để trống',
                'maBHXH.required' => 'Mã BHXH không được để trống',
                'maBHYT.required' => 'Mã BHYT không được để trống',
                'maBHTN.required' => 'Mã BHTN không được để trống',
            ]
        );
        if ($validator->fails()) {
            return response()->json(['is' => 'failed', 'error' => $validator->errors()->all()]);
        }

        $data = $request->all();
        unset($data['_token']);
        $files = $request->file('anhThe');
        if ($files) {
            $destinationPath = 'images/'; // upload path
            $time = time();
            $fileName = $time . "" . date('YmdHis') . "" . $files->hashName();
            $files->move($destinationPath, $fileName);
            $data['anhThe'] = $fileName;
        }

        $flag = HoSoNV::find($id)->update($data);
        if ($flag) {
            return response()->json(['is' => 'success', 'complete' => 'Hồ sơ cập nhật thành công']);
        }
        return response()->json(['is' => 'unsuccess', 'uncomplete' => 'Hồ sơ cập nhật chưa thành công']);
    }
}
