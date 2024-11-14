<?php

namespace App\Http\Controllers\admin;

use App\Models\Fees;
use App\Models\User;
use App\Models\Membership;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Certificate;

class RoutsController extends Controller
{
    public function dashboard()
    {
        $active_users = User::where('status', 'active')->count();
        $users = User::count();
        $all_fees = Fees::count();
        $paid_fees = Fees::where('status', 'paid')->count();
        $unpaid_fees = Fees::where('status', 'unpaid')->count();
        return view('admin/index', compact('users', 'active_users', 'paid_fees', 'unpaid_fees', 'all_fees'));
    }

    public function search1(Request $request)
    {
        // Validate CNIC format on the server side
        $request->validate([
            'cnic' => 'required|regex:/^\d{5}-\d{7}-\d{1}$/',
        ]);

        // Search for certificate by CNIC
        $membership = Membership::where('cnic', $request->cnic)->first();
        $member = Membership::where('cnic', $request->cnic)->first();
        $certificateCount = 0;
        $totalAmount = 0;
        $multipliedAmount = 0;

        if ($member) {
            // Count the number of certificates
            $certificateCount = Certificate::where('member_id', $member->id)->count();

            // Sum the amount of all fees for this member
            $totalAmount = Fees::where('member_id', $member->id)->sum('amount');
            // dd($totalAmount);
            // Multiply the total amount by a factor, e.g., 2
            $multipliedAmount = $totalAmount * 2;
        }

        // Check if membership exists
        if ($membership) {
            return response()->json([
                'ifmp_id' => $membership->ifmp_id,
                'name' => $membership->name,
                'totalAmount' => $totalAmount,
                'status' => $membership->status,
                'payment' => 'Pay Online',
                'certification' => $membership->certification
            ]);
        } else {
            return response()->json(['error' => 'membership not found'], 404);
        }
    }

    public function membership()
    {
        return view('admin/membership');
    }

    public function companies()
    {
        return view('admin/companies');
    }
    public function fees()
    {
        return view('admin/fees');
    }

    public function users()
    {
        return view('admin/users');
    }
    public function payment()
    {
        return view('admin/payment');
    }

    public function certification()
    {
        return view('admin/certification');
    }

    public function add_user()
    {
        return view('admin/add_user');
    }
}
