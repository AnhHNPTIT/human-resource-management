<?php

namespace App\Http\Controllers\Auth_Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Validator;
use Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/admin/account';

    public function __construct()
    {
        $this->middleware('guest:admin')->except('showLoginForm', 'logoutAdmin', 'postLoginAdmin', 'getChangePassword', 'changePassword');
    }

    public function showLoginForm()
    {
        return view('auth_admin.login');
    }

    public function postLoginAdmin(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'tenDN' => 'required',
                'matKhau' => 'required|min:8|max:32'
            ],
            [
                'tenDN.required' => 'Bạn cần nhập tên đăng nhập',
                'matKhau.required' => 'Mật khẩu là trường bắt buộc',
                'matKhau.min' => 'Mật khẩu phải chứa ít nhất 8 ký tự',
                'matKhau.max' => 'Mật khẩu tối đa 32 kí tự',
            ]
        );
        if ($validator->fails()) {
            return response()->json(['is' => 'login-failed', 'error' => $validator->errors()->all()]);
        }
        if (Auth::guard('admin')->attempt(['tenDN' => $request->tenDN, 'password' => $request->matKhau])) {
            return response()->json(['is' => 'login-success']);
        }
        return response()->json(['is' => 'incorrect', 'incorrect' => 'Sai tên đăng nhập hoặc mật khẩu!']);
    }

    public function logoutAdmin()
    {
        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }

    public function getChangePassword()
    {
        return view('admin.change_password');
    }

    public function changePassword(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'old_pass' => 'required',
                'new_pass' => 'required|min:8|max:32',
                're_new_pass' => 'required'
            ],
            [
                'old_pass.required' => 'Bạn chưa nhập mật khẩu cũ',
                'new_pass.required' => 'Bạn chưa nhập mật khẩu mới',
                're_new_pass.required' => 'Bạn cần nhập lại mật khẩu mới',
                'new_pass.min' => 'Mật khẩu tối thiểu 8 kí tự',
                'new_pass.max' => 'Mật khẩu tối đa 32 kí tự',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['is' => 'failed', 'error' => $validator->errors()->all()]);
        }
        $old_pass =  $request->old_pass;
        $new_pass = trim($request->new_pass);
        $re_new_pass = trim($request->re_new_pass);

        if ($new_pass !== $re_new_pass) {
            return response()->json(['is' => 'unsuccess', 'uncomplete' => 'Mật khẩu mới không khớp !!']);
        }

        if ($id = Auth::guard('admin')->user()->id) {
            $password = \DB::table('admins')->find($id)->password;
        } else {
            return redirect()->back();
        }

        if (Hash::check($old_pass, $password)) {
            \DB::table('admins')->where('id', $id)->update(['password' => bcrypt($new_pass)]);
            Auth::guard('admin')->logout();
            return response()->json(['is' => 'success', 'complete' => 'Đổi mật khẩu thành công']);
        } else {
            return response()->json(['is' => 'unsuccess', 'uncomplete' => 'Mật khẩu hiện tại không đúng']);
        }
    }
}
