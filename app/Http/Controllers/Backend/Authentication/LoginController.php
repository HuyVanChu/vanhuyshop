<?php

namespace App\Http\Controllers\Backend\Authentication;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Login\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class LoginController extends Controller
{
    function SignUp()
    {
        return view('backend.authentication.authentication-signup');
    }
    function SignIn()
    {
        return view('backend.authentication.authentication-signin');
    }
    function SignInPost(LoginRequest $request)
    {
        $remember = ($request->remember) ? true : false;
        if ($remember) {
            $auth = Auth::attempt(
                [
                    'email'  => strtolower($request->name),
                    'password'  => $request->password
                ],
                $remember
            );
            if ($auth) {
                return redirect()->route('admin.index');
            } else {
                return redirect()->back()->withInput()->with('thongbao', 'Tài khoản khoặc mật khẩu không chính xác!');
            }

        }else{
            $auth = Auth::attempt(
                [
                    'email'  => strtolower($request->name),
                    'password'  => $request->password
                ],
            );
            if ($auth) {
                Auth::once(['email' => $request->name, 'password' => $request->password]);
                return redirect()->route('admin.index');
            } else {
                return redirect()->back()->withInput()->with('thongbao', 'Tài khoản khoặc mật khẩu không chính xác!');
            }
        }
        // $auth = Auth::attempt(
        //     [
        //         'email'  => strtolower($request->name),
        //         'password'  => $request->password
        //     ],
        //     $remember
        // );
        // if ($auth) {
        //     return redirect()->route('admin.index');
        // } else {
        //     return redirect()->back()->withInput()->with('thongbao', 'Tài khoản khoặc mật khẩu không chính xác!');
        // }

























        // if (Auth::attempt(['email' => $request->name, 'password' => $request->password])) {
        //     return redirect()->route('admin.index');
        // } else {
        //     return redirect()->back()->withInput()->with('thongbao', 'Tài khoản khoặc mật khẩu không chính xác!');
        // }
    }
    public function Logout()
    {
        Auth::logout();
        return redirect()->route('admin_get_sigin');
    }
}
