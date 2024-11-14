<?php

namespace App\Http\Controllers\admin;

use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\Fees;
use App\Models\Membership;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class FeesController extends Controller
{
    public function index(Request $request)
    {
        // Search functionality
        $query = Fees::query();

        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('status', 'like', '%' . $request->search . '%');
        }

        $fees = $query->paginate(10);
        $all_fees = Fees::count();
        // $all_fees = Fees::with('member')->get();
        // dd($all_fees);
        $paid_fees = Fees::where('status', 'paid')->count();
        $unpaid_fees = Fees::where('status', 'unpaid')->count();

        return view('admin.fees.index', compact('fees', 'all_fees', 'paid_fees', 'unpaid_fees'));
    }

    public function create() : View
    {
        $members = Membership::all();
        return view('admin/fees/fees_create', compact('members'));
    }

    public function store(Request $request) : RedirectResponse
    {
        // dd($request->all());

        $validator = $request->validate([

            'amount' => ['required', 'integer'],
            'fees_year' => ['required', 'date'],
            'fees_date' => ['required', 'date'],
            'member_id' => ['required', 'integer'],
            'fees' => ['required', 'string'],

        ]);
        $year = Carbon::parse($request->input('fees_year'))->year;
        Fees::create([
            'fees_date' => $request->fees_date,
            'amount' => $request->amount,
            'fees_year' =>  $year,
            'member_id' => $request->member_id,
            'fees' => $request->fees
        ]);

        return redirect()->route('admin.fees')->with('success', 'Fees created successfully.');
    }

    public function edit($id)
    {
        $fees = Fees::find($id);
        $members = Membership::all();
        return view('admin/fees/fees_edit', compact('fees', 'members'));


    }

    public function update(Request $request, $id)
    {
        $validator = $request->validate([

            'amount' => ['required', 'integer'],
            'fees_year' => ['required', 'date'],
            'fees_date' => ['required', 'date'],
            'member_id' => ['required', 'integer'],
            'fees' => ['required', 'string'],
        ]);

        $fees = Fees::find($id);

        $fees->fees_date = $request->fees_date;
        $fees->amount = $request->amount;
        $fees->fees_year = Carbon::parse($request->fees_year)->year;
        $fees->member_id = $request->member_id;
        $fees->fees = $request->fees;
        $fees->save();

        return redirect()->route('admin.fees')->with('success', 'Fees updated successfully.');
    }

    public function delete($id)
    {
        Fees::destroy($id);
        return redirect()->route('admin.fees')->with('success', 'Fees deleted successfully.');
    }
    public function exportCsv()
    {
        $filename = "fees_list.csv";
        $fees = Fees::all();

        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $columns = ['ID', 'Name', 'Status', 'Amount', 'Due Date', 'Paid Date'];

        $callback = function () use ($fees, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($fees as $fee) {
                fputcsv($file, [
                    $fee->id,
                    $fee->cnic,
                    $fee->status,
                    $fee->amount,
                    $fee->due_date,
                    $fee->paid_date,
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

        // Set header columns
        $sheet->setCellValue('A1', 'ID')
            ->setCellValue('B1', 'CNIC')
            ->setCellValue('C1', 'Status')
            ->setCellValue('D1', 'Amount')
            ->setCellValue('E1', 'Due Date')
            ->setCellValue('F1', 'Paid Date');

        $fees = Fees::all();
        $row = 2;

        // Fill in data
        foreach ($fees as $fee) {
            $sheet->setCellValue("A$row", $fee->id)
                ->setCellValue("B$row", $fee->cnic)
                ->setCellValue("C$row", $fee->status)
                ->setCellValue("D$row", $fee->amount)
                ->setCellValue("E$row", $fee->due_date)
                ->setCellValue("F$row", $fee->paid_date);
            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        $filename = "fees_list.xlsx";

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=\"$filename\"");

        $writer->save("php://output");
    }

    public function exportPdf()
    {
        $fees = Fees::all();

        $pdf = new Dompdf();
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $pdf->setOptions($options);

        $html = view('admin.fees.pdf', compact('fees'))->render();
        $pdf->loadHtml($html);
        $pdf->setPaper('A4', 'landscape');
        $pdf->render();

        return $pdf->stream("fees_list.pdf", ["Attachment" => true]);
    }
}
