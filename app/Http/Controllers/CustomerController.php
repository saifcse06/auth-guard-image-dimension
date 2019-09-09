<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use Auth;

class CustomerController extends Controller
{
    public function create()
    {
        return view('customer.register');
    }

    public function registerCustomer(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|unique:customers|email|max:255',
            'name' => 'required',
            'password' => 'required|min:6|confirmed'
        ]);
        Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        return redirect()->intended('/home/customer');
    }
    public function home()
    {
        return view('customer');
    }
}
