<?php

namespace App\Http\Controllers\admin;

use App\Models\Membership;
use App\Models\Certificate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use PHPUnit\Framework\Attributes\Medium;

class MembershipController extends Controller
{
    public function index(){

        $certificates = Certificate::all();
        $membership = Membership::all();
        $active_users =User::where('status', 'active')->count();
        $users = User::count();
        return view('admin/membership/index',compact('certificates','membership','active_users','users'));
    }

    public function create(){
        $certificates = Certificate::all();
        return view('admin/membership/membership_create',compact('certificates'));
    }

    public function store(Request $request){
        $validator = $request->validate([
            'ifmp_id' => ['required', 'string', 'max:255'],
            'balance' => ['required', 'integer'],
            'certificate_id' => ['required', 'integer'],
            'dues' => ['required', 'integer'],
            'name' => ['required', 'string', 'max:255'],
            'cnic' => ['required', 'string', 'max:14'],
            'm_date' => ['required', 'date'],
            'valid_till' => ['required', 'date'],
            'status' => ['required', 'string'],

        ]);
        Membership::create([
            'ifmp_id' => $request->ifmp_id,
            'balance' => $request->balance,
            'certificate_id' =>  $request->certificate_id,
            'dues' => $request->dues,
            'name' => $request->name,
            'cnic' => $request->cnic,
            'm_date' => $request->m_date,
            'valid_till' => $request->valid_till,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.membership')->with('success', 'membership created successfully.');
    }

    public function edit($id){
        $membership = Membership::find($id);
        $certificates = Certificate::all();
        return view('admin/membership/membership_edit', compact('certificates','membership'));
    }

    public function update(Request $request, $id){
        $validator = $request->validate([
          'ifmp_id' => ['required', 'string', 'max:255'],
            'balance' => ['required', 'integer'],
            'certificate_id' => ['required', 'integer'],
            'dues' => ['required', 'integer'],
            'name' => ['required', 'string', 'max:255'],
            'cnic' => ['required', 'string', 'max:14'],
            'm_date' => ['required', 'date'],
            'valid_till' => ['required', 'date'],
            'status' => ['required', 'string'],
        ]);

        $membership = Membership::find($id);
        $membership->ifmp_id = $request->ifmp_id;
        $membership->balance = $request->balance;
        $membership->certificate_id = $request->certificate_id;
        $membership->cnic = $request->cnic;
        $membership->dues = $request->dues;
        $membership->name = $request->name;
        $membership->m_date = $request->m_date;
        $membership->valid_till = $request->valid_till;
        $membership->status = $request->status;
        $membership->save();

        return redirect()->route('admin.membership')->with('success', 'membership updated successfully.');
    }

    public function delete($id){
        Membership::destroy($id);
        return redirect()->route('admin.membership')->with('success', 'membership deleted successfully.');
    }
}
