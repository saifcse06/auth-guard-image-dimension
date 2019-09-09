<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SystemLoginController extends Controller
{
    public function loginSystem()
    {
        return view('auth.login');
    }

    public function loginAuth(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $email = $request->email;
        $password = $request->password;
        $remember = $request->remember;

        if (Auth::guard('customer')->attempt(['email' => $email, 'password' => $password], $remember)) {

            return redirect('/home/customer');
        }
        if (Auth::guard('admin')->attempt(['email' => $email, 'password' => $password], $remember)) {
          return redirect('/home/admin');
        }
        else {
            return redirect()->back()->with('warning', 'Invalid Email or Password');
        }
    }

    public function logout()
    {
        if (Auth::guard('admin')) {
            Auth::guard('admin')->logout();
        }
        if (Auth::guard('customer')) {
            Auth::guard('customer')->logout();
        }
        return redirect('/login/system');
    }
}
