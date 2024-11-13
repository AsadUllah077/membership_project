<?php

namespace App\Http\Controllers\admin;

use App\Models\Certificate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Dompdf\Dompdf;
use Dompdf\Options;

class CertificateController extends Controller
{
    public function index(Request $request)
    {
        $query = Certificate::query();

        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        $certificates = $query->paginate(10);
        // $certificates = Certificate::paginate(10);
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
            'cnic' => ['required', 'string', 'max:15'],
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
            'cnic' => ['required', 'string', 'max:15'],
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

    public function exportCsv()
    {
        $filename = "certifications_list.csv";
        $certifications = Certificate::all();

        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $columns = ['IFMP-ID', 'CNIC', 'Category', 'Certification', 'Valid Till'];

        $callback = function () use ($certifications, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($certifications as $certification) {
                fputcsv($file, [
                    $certification->ifmp_id,
                    $certification->cnic,
                    $certification->category,
                    $certification->certification,
                    $certification->valid_till,
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
            ->setCellValue('B1', 'CNIC')
            ->setCellValue('C1', 'Category')
            ->setCellValue('D1', 'Certification')
            ->setCellValue('E1', 'Valid Till');

        $certifications = Certificate::all();
        $row = 2;

        foreach ($certifications as $certification) {
            $sheet->setCellValue("A$row", $certification->ifmp_id)
                ->setCellValue("B$row", $certification->cnic)
                ->setCellValue("C$row", $certification->category)
                ->setCellValue("D$row", $certification->certification)
                ->setCellValue("E$row", $certification->valid_till);
            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        $filename = "certifications_list.xlsx";

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=\"$filename\"");

        $writer->save("php://output");
    }


    public function exportPdf()
    {
        $certifications = Certificate::all();

        $pdf = new Dompdf();
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $pdf->setOptions($options);

        $html = view('admin.certificates.pdf', compact('certifications'))->render();
        $pdf->loadHtml($html);
        $pdf->setPaper('A4', 'landscape');
        $pdf->render();

        return $pdf->stream("certifications_list.pdf", ["Attachment" => true]);
    }
}
