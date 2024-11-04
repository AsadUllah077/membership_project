<?php

namespace App\Http\Controllers\admin;

use App\Models\Certificate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CertificateController extends Controller
{
    public function index()
    {

        $certificates = Certificate::all();
        return view('admin/certificates/index', compact('certificates'));
    }

    public function create()
    {
        return view('admin/certificates/certificate_create');
    }

    public function store(Request $request)
    {
        // dd($request);

        $validator = $request->validate([
            'ifmp_id' => ['required', 'string', 'max:255'],
            'cnic' => ['required', 'string', 'max:14'],
            'category' => ['required', 'string'],
            'certification' => ['required', 'string'],
            'valid_till' => ['required'],

        ]);

        Certificate::create([
            'ifmp_id' => $request->ifmp_id,
            'cnic' => $request->cnic,
            'category' =>  $request->category,
            'certification' => $request->certification,
            'valid_till' => $request->valid_till
        ]);

        return redirect()->route('admin.certification')->with('success', 'Certificate created successfully.');
    }

    public function edit($id)
    {
        $certificate = Certificate::find($id);
        return view('admin/certificates/certificate_edit', compact('certificate'));
    }

    public function update(Request $request, $id)
    {
        $validator = $request->validate([
            'ifmp_id' => ['required', 'string', 'max:255'],
            'cnic' => ['required', 'string', 'max:14'],
            'category' => ['required', 'string'],
            'certification' => ['required', 'string'],
            'valid_till' => ['required'],
        ]);
        $certificate = Certificate::find($id);
        $certificate->ifmp_id = $request->ifmp_id;
        $certificate->cnic = $request->cnic;
        $certificate->category = $request->category;
        $certificate->certification = $request->certification;
        $certificate->valid_till = $request->valid_till;
        $certificate->save();

        return redirect()->route('admin.certification')->with('success', 'Certificate updated successfully.');
    }

    public function delete($id)
    {
        Certificate::destroy($id);
        return redirect()->route('admin.certification')->with('success', 'Certificate deleted successfully.');
    }
}
