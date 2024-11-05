<?php

namespace App\Http\Controllers\admin;

use App\Models\Fees;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class FeesController extends Controller
{
    public function index()
    {

        $fees = Fees::all();
        return view('admin/fees/index', compact('fees'));
    }

    public function create()
    {
        return view('admin/fees/fees_create');
    }

    public function store(Request $request)
    {
        $validator = $request->validate([
            'status' => ['required', 'string', 'max:255'],
            'amount' => ['required', 'integer'],
            'fees_year' => ['required', 'date'],
            'cnic' => ['required', 'string', 'max:14'],
            'ifmp_id' => ['required', 'string'],

        ]);
        $year = Carbon::parse($request->input('fees_year'))->year;
        Fees::create([
            'status' => $request->status,
            'amount' => $request->amount,
            'fees_year' =>  $year,
            'cnic' => $request->cnic,
            'ifmp_id' => $request->ifmp_id
        ]);

        return redirect()->route('admin.fees')->with('success', 'Fees created successfully.');
    }

    public function edit($id)
    {
        $fees = Fees::find($id);
        return view('admin/fees/fees_edit', compact('fees'));
    }

    public function update(Request $request, $id)
    {
        $validator = $request->validate([
            'status' => ['required', 'string', 'max:255'],
            'amount' => ['required', 'integer'],
            'fees_year' => ['required', 'date'],
            'cnic' => ['required', 'string', 'max:14'],
            'ifmp_id' => ['required', 'string'],
        ]);

        $fees = Fees::find($id);

        $fees->status = $request->status;
        $fees->amount = $request->amount;
        $fees->fees_year = Carbon::parse($request->fees_year)->year;
        $fees->cnic = $request->cnic;
        $fees->ifmp_id = $request->ifmp_id;
        $fees->save();

        return redirect()->route('admin.fees')->with('success', 'Fees updated successfully.');
    }

    public function delete($id)
    {
        Fees::destroy($id);
        return redirect()->route('admin.fees')->with('success', 'Fees deleted successfully.');
    }
}
