<?php

namespace App\Http\Controllers\admin;

use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\Payment;
use App\Models\Membership;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class PaymentController extends Controller
{
    public function index(Request $request)
{
    // Initialize the query for payments
    $query = Payment::query();

    // Join with memberships table to access CNIC and IFMP-ID
    $query->join('memberships', 'payments.membership_id', '=', 'memberships.id')
          ->select('payments.*', 'memberships.cnic', 'memberships.ifmp_id'); // Select additional fields if needed

    // Filter by bank name
    if ($request->filled('bank_name')) {
        $query->where('payments.bank_name', 'like', '%' . $request->bank_name . '%');
    }

    // Filter by CNIC
    if ($request->filled('cnic')) {
        $query->where('memberships.cnic', 'like', '%' . $request->cnic . '%');
    }

    // Filter by IFMP-ID
    if ($request->filled('ifmp_id')) {
        $query->where('memberships.ifmp_id', 'like', '%' . $request->ifmp_id . '%');
    }

    // Paginate results
    $payments = $query->paginate(10);

    // Return the view with filters and data
    return view('admin.payments.index', [
        'payments' => $payments,
        'bank_name' => $request->bank_name,
        'cnic' => $request->cnic,
        'ifmp_id' => $request->ifmp_id,
    ]);
}



    public function create(){
        $members = Membership::all();
        return view('admin/payments/payment_create',compact('members'));
    }

    public function store(Request $request){
        // dd($request);
        $validator = $request->validate([
            'membership_id' => ['required', 'integer'],
            'amount' => ['required', 'integer'],
            'bank_name' => ['required', 'string', 'max:255'],
            'reciept_date' => ['required', 'date'],
            'reciept_number' => ['required', 'string'],

        ]);
        Payment::create([
            'membership_id' => $request->membership_id,
            'amount' => $request->amount,
            'bank_name' =>  $request->bank_name,
            'reciept_date' => $request->reciept_date,
            'reciept_number' => $request->reciept_number
        ]);

        return redirect()->route('admin.payment')->with('success', 'Payment created successfully.');
    }

    public function edit($id){
        $payment = Payment::find($id);
        $members = Membership::all();
        return view('admin/payments/payment_edit', compact('payment', 'members'));
    }

    public function update(Request $request, $id){
        $validator = $request->validate([
            'membership_id' => ['required', 'integer'],
            'amount' => ['required', 'integer'],
            'bank_name' => ['required', 'string', 'max:255'],
            'reciept_date' => ['required', 'date'],
            'reciept_number' => ['required', 'string'],
        ]);

        $payment = Payment::find($id);
        $payment->membership_id = $request->membership_id;
        $payment->amount = $request->amount;
        $payment->bank_name = $request->bank_name;
        $payment->reciept_date = $request->reciept_date;
        $payment->reciept_number = $request->reciept_number;
        $payment->save();

        return redirect()->route('admin.payment')->with('success', 'Payment updated successfully.');
    }

    public function delete($id){
        Payment::destroy($id);
        return redirect()->route('admin.payment')->with('success', 'Payment deleted successfully.');
    }

    public function exportCsv()
{
    $filename = "payments_list.csv";
    $payments = Payment::all();

    $headers = [
        "Content-type" => "text/csv",
        "Content-Disposition" => "attachment; filename=$filename",
        "Pragma" => "no-cache",
        "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
        "Expires" => "0"
    ];

    $columns = ['IFMP-ID', 'Bank Name', 'CNIC', 'Receipt Date', 'Receipt Number'];

    $callback = function () use ($payments, $columns) {
        $file = fopen('php://output', 'w');
        fputcsv($file, $columns);

        foreach ($payments as $payment) {
            fputcsv($file, [
                $payment->ifmp_id,

                $payment->bank_name,
                $payment->member->cnics,
                $payment->receipt_date,
                $payment->receipt_number,
            ]);
        }

        fclose($file);
    };

    return response()->stream($callback, 200, $headers);
}

public function exportExcel()
{
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    $sheet->setCellValue('A1', 'IFMP-ID')
        ->setCellValue('C1', 'Bank Name')
        ->setCellValue('D1', 'CNIC')
        ->setCellValue('E1', 'Receipt Date')
        ->setCellValue('F1', 'Receipt Number');

    $payments = Payment::all();
    $row = 2;

    foreach ($payments as $payment) {
        $sheet->setCellValue("A$row", $payment->ifmp_id)
            ->setCellValue("C$row", $payment->bank_name)
            ->setCellValue("D$row", $payment->cnic)
            ->setCellValue("E$row", $payment->receipt_date)
            ->setCellValue("F$row", $payment->receipt_number);
        $row++;
    }

    $writer = new Xlsx($spreadsheet);
    $filename = "payments_list.xlsx";

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header("Content-Disposition: attachment; filename=\"$filename\"");

    $writer->save("php://output");
}

public function exportPdf()
{
    $payments = Payment::all();

    $pdf = new Dompdf();
    $options = new Options();
    $options->set('isHtml5ParserEnabled', true);
    $pdf->setOptions($options);

    $html = view('admin.payments.pdf', compact('payments'))->render();
    $pdf->loadHtml($html);
    $pdf->setPaper('A4', 'landscape');
    $pdf->render();

    return $pdf->stream("payments_list.pdf", ["Attachment" => true]);
}

}
