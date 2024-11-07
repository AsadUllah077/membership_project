<?php

namespace App\Http\Controllers\admin;

use App\Models\Fees;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoutsController extends Controller
{
    public function dashboard(){
        $active_users =User::where('status', 'active')->count();
        $users = User::count();
        $all_fees = Fees::count();
        $paid_fees = Fees::where('status', 'paid')->count();
        $unpaid_fees = Fees::where('status', 'unpaid')->count();
        return view('admin/index', compact('users','active_users','paid_fees','unpaid_fees','all_fees'));
    }

    public function membership(){
        return view('admin/membership');
    }

    public function companies(){
        return view('admin/companies');
    }
    public function fees(){
        return view('admin/fees');
    }

    public function users(){
        return view('admin/users');
    }
    public function payment(){
        return view('admin/payment');
    }

    public function certification(){
        return view('admin/certification');
    }

    public function add_user(){
        return view('admin/add_user');
    }
}
