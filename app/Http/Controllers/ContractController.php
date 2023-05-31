<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HopDongLD;
use App\HoSoNV;
use Validator;
use Auth;

class ContractController extends Controller
{
    public function contract()
    {
        if(Auth::guard('admin')->user()->loaiTK == "NV"){
            $account = HoSoNV::find(Auth::guard('admin')->user()->maNV);
            $contracts = [];
            if($account){
                $contracts = HopDongLD::where('id', $account->maHDLD)->get();
            }
        }
        else{
            $contracts = HopDongLD::all();
        }
        return view('contract.contracts_list', ['contracts' => $contracts]);
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
                'maLHDLD.required' => 'Loại hợp đồng không được để trống',
                'maCV.required' => 'Chức vụ không được để trống',
                'ngayKyHD.required' => 'Ngày ký hợp đồng không được để trống',
                'ngayBD.required' => 'Ngày bắt đầu không được để trống',
                'ngayKT.required' => 'Ngày kết thúc không được để trống',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['is' => 'failed', 'error' => $validator->errors()->all()]);
        }

        $data = $request->all();
        unset($data['_token']);

        $instance = HopDongLD::create($data);

        if (isset($instance)) {
            return response()->json(['is' => 'success', 'complete' => 'Tạo hợp đồng thành công']);
        }
        return response()->json(['is' => 'unsuccess', 'uncomplete' => 'Hợp đồng chưa được tạo thành công']);
    }


    public function show($id)
    {
        $contract =  HopDongLD::find($id);
        return view('contract.contract_detail', ['contract' => $contract]);
    }

    public function destroy($id)
    {
        $instance = HopDongLD::findOrFail($id)->delete();
        if ($instance) {
            return response()->json(['is' => 'success', 'complete' => 'Hợp đồng được xóa thành công']);
        }
        return response()->json(['is' => 'unsuccess', 'uncomplete' => 'Hợp đồng xóa chưa thành công']);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $flag = HopDongLD::find($id)->update([
            'maLHDLD' => $data['maLHDLD'],
            'maCV' => $data['maCV'],
            'ngayKyHD' => $data['ngayKyHD'],
            'ngayBD' => $data['ngayBD'],
            'ngayKT' => $data['ngayKT']
        ]);
        if ($flag) {
            return response()->json(['is' => 'success', 'complete' => 'Hợp đồng cập nhật thành công']);
        }
        return response()->json(['is' => 'unsuccess', 'uncomplete' => 'Hợp đồng cập nhật chưa thành công']);
    }
}
