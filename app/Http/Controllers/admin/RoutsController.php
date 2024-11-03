<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RoutsController extends Controller
{
    public function dashboard(){
        return view('admin/index');
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
}
