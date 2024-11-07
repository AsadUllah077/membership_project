<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class CompaniesController extends Controller
{
    public function index(){

        $companies = Company::paginate(10);
        return view('admin/companies/index',compact('companies'));
    }

    public function create(){
        return view('admin/companies/companies_create');
    }

    public function store(Request $request){
        $validator = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            't_active' => ['required', 'integer'],
            't_inactive' => ['required', 'integer'],
            'total_dues' => ['required', 'integer'],
            'total_paid' => ['required', 'integer'],

        ]);
        Company::create([
            'name' => $request->name,
            't_active' => $request->t_active,
            't_inactive' =>  $request->t_inactive,
            'total_dues' => $request->total_dues,
            'total_paid' => $request->total_paid
        ]);

        return redirect()->route('admin.companies')->with('success', 'Company created successfully.');
    }

    public function edit($id){
        $company = Company::find($id);
        return view('admin/companies/company_edit', compact('company'));
    }

    public function update(Request $request, $id){
        $validator = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            't_active' => ['required', 'integer'],
            't_inactive' => ['required', 'integer'],
            'total_dues' => ['required', 'integer'],
            'total_paid' => ['required', 'integer'],
        ]);

        $company = Company::find($id);
        $company->name = $request->name;
        $company->total_dues = $request->total_dues;
        $company->total_paid = $request->total_paid;
        $company->t_active = $request->t_active;
        $company->t_inactive = $request->t_inactive;
        $company->save();

        return redirect()->route('admin.companies')->with('success', 'Company updated successfully.');
    }

    public function delete($id){
        Company::destroy($id);
        return redirect()->route('admin.companies')->with('success', 'Company deleted successfully.');
    }
}
