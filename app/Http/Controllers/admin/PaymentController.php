<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Dompdf\Dompdf;
use Dompdf\Options;
class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');

        if ($query) {
            $payments = Payment::where('name', 'like', '%' . $query . '%')
                ->orWhere('status', 'like', '%' . $query . '%')
                ->orWhere('amount', 'like', '%' . $query . '%')
                ->paginate(10);
        } else {
            $payments = Payment::paginate(10);
        }

        return view('admin/payments/index', compact('payments', 'query'));
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

    $columns = ['IFMP-ID', 'Amount', 'Bank Name', 'CNIC', 'Receipt Date', 'Receipt Number'];

    $callback = function () use ($payments, $columns) {
        $file = fopen('php://output', 'w');
        fputcsv($file, $columns);

        foreach ($payments as $payment) {
            fputcsv($file, [
                $payment->ifmp_id,
                $payment->amount,
                $payment->bank_name,
                $payment->cnic,
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
        ->setCellValue('B1', 'Amount')
        ->setCellValue('C1', 'Bank Name')
        ->setCellValue('D1', 'CNIC')
        ->setCellValue('E1', 'Receipt Date')
        ->setCellValue('F1', 'Receipt Number');

    $payments = Payment::all();
    $row = 2;

    foreach ($payments as $payment) {
        $sheet->setCellValue("A$row", $payment->ifmp_id)
            ->setCellValue("B$row", $payment->amount)
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
