<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\TaiKhoan;
use Validator;

class UserController extends Controller
{
    public function account()
    {
        $accounts = DB::table('TaiKhoan')->orderBy('created_at', 'desc');
        return view('user.accounts_list', ['accounts' => $accounts->paginate()]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'tenDN' => 'required',
                'loaiTK' => 'required',
                'matKhau' => 'required|min:8|max:32',
            ],
            [
                'tenDN.required' => 'Tên đăng nhập không được để trống',
                'loaiTK.required' => 'Yêu cầu chọn loại tài khoản',
                'matKhau.required' => 'Yêu cầu nhập mật khẩu',
                'matKhau.min' => 'Mật khẩu tối thiểu 8 kí tự',
                'matKhau.max' => 'Mật khẩu tối đa 32 kí tự',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['is' => 'failed', 'error' => $validator->errors()->all()]);
        }

        $data = $request->all();
        unset($data['_token']);

        // $data['birthday'] = \Carbon\Carbon::parse($data['birthday'])->format('Y-m-d H:i:s');

        $data['matKhau'] = bcrypt($data['matKhau']);

        $instance = TaiKhoan::create($data);

        if (isset($instance)) {
            return response()->json(['is' => 'success', 'complete' => 'Tạo tài khoản thành công']);
        }
        return response()->json(['is' => 'unsuccess', 'uncomplete' => 'Tài khoản chưa được tạo thành công']);
    }


    public function show($id)
    {
        $account =  TaiKhoan::find($id);
        return view('user.account_detail', ['account' => $account]);
    }

    public function destroy($id)
    {
        $instance = TaiKhoan::findOrFail($id)->delete();
        if ($instance) {
            return response()->json(['is' => 'success', 'complete' => 'Tài khoả được xóa thành công']);
        }
        return response()->json(['is' => 'unsuccess', 'uncomplete' => 'Tài khoản xóa chưa thành công']);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $flag = TaiKhoan::find($id)->update([
            'tenDN' => $data['tenDN'],
            'loaiTK' => $data['loaiTK']
        ]);
        if ($flag) {
            return response()->json(['is' => 'success', 'complete' => 'Tài khoản cập nhật thành công']);
        }
        return response()->json(['is' => 'unsuccess', 'uncomplete' => 'Tài khoản cập nhật chưa thành công']);
    }
}