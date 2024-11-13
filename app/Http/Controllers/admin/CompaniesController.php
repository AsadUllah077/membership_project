<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Dompdf\Dompdf;
use Dompdf\Options;

class CompaniesController extends Controller
{
    public function index(Request $request)
    {

        $query = Company::query();

        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $companies = $query->paginate(10);
        // $companies = Company::paginate(10);
        return view('admin/companies/index', compact('companies'));
    }

    public function create()
    {
        return view('admin/companies/companies_create');
    }

    public function store(Request $request)
    {
        $validator = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string'],
            'phone' => ['required', 'string'],
            'sba' => ['required', 'string'],


        ]);
        Company::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' =>  $request->phone,
            'sba' => $request->sba
        ]);

        return redirect()->route('admin.companies')->with('success', 'Company created successfully.');
    }

    public function edit($id)
    {
        $company = Company::find($id);
        return view('admin/companies/company_edit', compact('company'));
    }

    public function update(Request $request, $id)
    {
        $validator = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string'],
            'phone' => ['required', 'string'],
            'sba' => ['required', 'string'],
        ]);

        $company = Company::find($id);
        $company->name = $request->name;
        $company->email = $request->email;
        $company->phone = $request->phone;
        $company->sba = $request->sba;
        $company->save();

        return redirect()->route('admin.companies')->with('success', 'Company updated successfully.');
    }

    public function delete($id)
    {
        Company::destroy($id);
        return redirect()->route('admin.companies')->with('success', 'Company deleted successfully.');
    }


    public function exportCsv()
    {
        $filename = "user_data.csv";
        $users = Company::all();

        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $columns = ['Name', 'Total Active', 'Total Inactive', 'Total Dues', 'Total Paid'];

        $callback = function () use ($users, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($users as $user) {
                fputcsv($file, [
                    $user->name,
                    $user->t_active,
                    $user->t_inactive,
                    $user->total_dues,
                    $user->total_paid,
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

        $sheet->setCellValue('A1', 'Name')
            ->setCellValue('B1', 'Total Active')
            ->setCellValue('C1', 'Total Inactive')
            ->setCellValue('D1', 'Total Dues')
            ->setCellValue('E1', 'Total Paid');

        $users = Company::all();
        $row = 2;

        foreach ($users as $user) {
            $sheet->setCellValue("A$row", $user->name)
                ->setCellValue("B$row", $user->t_active)
                ->setCellValue("C$row", $user->t_inactive)
                ->setCellValue("D$row", $user->total_dues)
                ->setCellValue("E$row", $user->total_paid);
            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        $filename = "company_data.xlsx";

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=\"$filename\"");

        $writer->save("php://output");
    }


    public function exportPdf()
    {
        $users = Company::all();

        $pdf = new Dompdf();
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $pdf->setOptions($options);

        $html = view('admin.companies.pdf', compact('users'))->render();
        $pdf->loadHtml($html);
        $pdf->setPaper('A4', 'landscape');
        $pdf->render();

        return $pdf->stream("user_data.pdf", ["Attachment" => true]);
    }
}
