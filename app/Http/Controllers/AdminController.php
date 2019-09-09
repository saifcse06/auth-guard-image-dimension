<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function home()
    {
        return view('admin');
    }

    public function getAll()
    {
        $data['title'] = "ALL Customer List";
        $data['customers'] = Customer::orderBy('id', 'desc')->paginate(5);
        return view('admin.customer_lists', $data);
    }

    public function getList()
    {
        $data['title'] = "ALL User List";

        if (Auth::user()->admin_type == Admin::TYPE_SYSTEM) {
            $userTye = Admin::TYPE_ADMIN;
        }
        if (Auth::user()->admin_type == Admin::TYPE_ADMIN) {
            $userTye = Admin::TYPE_MANAGER;
        }

        $data['userList'] = Admin::where('admin_type', $userTye)->orderBy('id', 'desc')->paginate(5);
        return view('admin.users_list', $data);
    }

    public function create()
    {
        $data['title'] = "Create New User";
        return view('admin.register');
    }

    public function registerAdmin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|unique:customers|email|max:255',
            'name' => 'required',
            'password' => 'required|min:6|confirmed'
        ]);

        if (Auth::user()->admin_type == Admin::TYPE_SYSTEM) {
            $userTye = Admin::TYPE_ADMIN;
        }
        if (Auth::user()->admin_type == Admin::TYPE_ADMIN) {
            $userTye = Admin::TYPE_MANAGER;
        }
        Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'email' => $request->email,
            'admin_type' => $userTye,
            'password' => bcrypt($request->password)
        ]);
        return redirect('/home/admin');
    }
}
