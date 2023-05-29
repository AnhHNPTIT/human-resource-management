<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Customer;
use Auth;
use Validator;

class AccountController extends Controller
{
    public function myAccount($customer_id)
    {
        if (Auth::check()) {
            if ($customer_id == Auth::user()->id) {
                $customer = Customer::where('id', $customer_id)->first();
                if ($customer) {
                    return view('my_account', compact('customer'));
                }
            }
        }
        return view('404');
    }

    public function updateMyAccount(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'address' => 'required'
            ],
            [
                'name.required' => 'Bạn chưa nhập họ tên!!',
                'address.required' => 'Bạn chưa nhập địa chỉ!!',
            ]
        );
        if ($validator->fails()) {
            return response()->json(['is' => 'failed', 'error' => $validator->errors()->all()]);
        }
        $data['customer_id'] = $request->customer_id;
        $data['name'] = $request->name;
        $data['birthday'] = $request->birthday;
        $data['birthday'] = \Carbon\Carbon::parse($data['birthday'])->format('Y-m-d');
        $data['gender'] = $request->gender;
        $data['address'] = $request->address;
        if (Auth::check()) {
            if (Auth::user()->id == $data['customer_id']) {
                $user = Customer::where('id', $data['customer_id'])
                    ->update(['name' => $data['name'], 'birthday' => $data['birthday'], 'gender' => $data['gender'], 'address' => $data['address']]);
                if ($user) {
                    return response()->json(['is' => 'success', 'complete' => 'Thông tin tài khoản đã được cập nhật']);
                }
                return response()->json(['is' => 'unsuccess', 'uncomplete' => 'Việc cập nhật thông tin tài khoản đã gặp sự cố!']);
            }
        }
        return view('404');
    }
}
