<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login() {
        if(auth()->check()) {
            return redirect()->route('admin.categories.index');
        }
        return view('login.login');
    }

    public function login_handling(Request $request) {
        $remember = $request->has('remember');
        if(auth()->attempt(
            [
                'email' => $request->email ?? '',
                'password' => $request->password ?? ''
            ], $remember
        )) {
            toastr()->success('Đăng nhập thành công');
            return redirect()->route('admin.categories.index');
        }
        toastr()->error('Tài khoản hoặc mật khẩu không chính xác');
        return redirect()->route('login');
    }
}
