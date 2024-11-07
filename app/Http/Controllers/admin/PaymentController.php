<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index(){

        $payments = Payment::paginate(10);
        return view('admin/payments/index',compact('payments'));
    }

    public function create(){
        return view('admin/payments/payment_create');
    }

    public function store(Request $request){
        $validator = $request->validate([
            'ifmp_id' => ['required', 'string', 'max:255'],
            'amount' => ['required', 'integer'],
            'bank_name' => ['required', 'string', 'max:255'],
            'cnic' => ['required', 'string', 'max:14'],
            'reciept_date' => ['required', 'date'],
            'reciept_number' => ['required', 'string'],

        ]);
        Payment::create([
            'ifmp_id' => $request->ifmp_id,
            'amount' => $request->amount,
            'bank_name' =>  $request->bank_name,
            'cnic' => $request->cnic,
            'reciept_date' => $request->reciept_date,
            'reciept_number' => $request->reciept_number
        ]);

        return redirect()->route('admin.payment')->with('success', 'Payment created successfully.');
    }

    public function edit($id){
        $payment = Payment::find($id);
        return view('admin/payments/payment_edit', compact('payment'));
    }

    public function update(Request $request, $id){
        $validator = $request->validate([
            'ifmp_id' => ['required', 'string', 'max:255'],
            'amount' => ['required', 'integer'],
            'bank_name' => ['required', 'string', 'max:255'],
            'cnic' => ['required', 'string', 'max:14'],
            'reciept_date' => ['required', 'date'],
            'reciept_number' => ['required', 'string'],
        ]);

        $payment = Payment::find($id);
        $payment->ifmp_id = $request->ifmp_id;
        $payment->amount = $request->amount;
        $payment->bank_name = $request->bank_name;
        $payment->cnic = $request->cnic;
        $payment->reciept_date = $request->reciept_date;
        $payment->reciept_number = $request->reciept_number;
        $payment->save();

        return redirect()->route('admin.payment')->with('success', 'Payment updated successfully.');
    }

    public function delete($id){
        Payment::destroy($id);
        return redirect()->route('admin.payment')->with('success', 'Payment deleted successfully.');
    }
}
