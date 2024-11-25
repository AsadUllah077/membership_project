<?php

namespace App\Http\Controllers\admin;

use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\Membership;

use App\Models\Certificate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class CertificateController extends Controller
{
    public function index(Request $request)
{
    $query = Certificate::query();



    // Filter by certificate
    if ($request->has('certification') && $request->certification) {
        $query->where('certification', 'like', '%' . $request->certification . '%');
    }

    $certificates = $query->paginate(10);

    return view('admin.certificates.index', [
        'certificates' => $certificates,

        'certification' => $request->certificate,
        'search' => $request->search,
    ]);
}




    public function create()
    {
        $members = Membership::all();
        return view('admin/certificates/certificate_create', compact('members'));
    }

    public function store(Request $request)
    {
        // dd($request);

        $validator = $request->validate([
            'member_id' => ['required', 'integer'],
            'category' => ['required', 'string'],
            'certification' => [
                'required',
                'string',
                Rule::unique('certificates') // Ensure uniqueness
                    ->where(function ($query) use ($request) {
                        return $query->where('member_id', $request->member_id)
                                     ->where('certification', $request->certification);
                    }),
            ],
            'valid_till' => ['required', 'date'],
        ]);

        Certificate::create([
            'member_id' => $request->member_id,
            'category' =>  $request->category,
            'certification' => $request->certification,
            'valid_till' => $request->valid_till
        ]);

        return redirect()->route('admin.certification')->with('success', 'Certificate created successfully.');
    }

    public function edit($id)
    {
        $certificate = Certificate::find($id);
        $members = Membership::all();
        return view('admin/certificates/certificate_edit', compact('certificate', 'members'));
    }

    public function update(Request $request, $id)
    {
        $validator = $request->validate([
            'member_id' => ['required', 'integer'],
            'category' => ['required', 'string'],
            'certification' => [
                'required',
                'string',
                Rule::unique('certificates') // Ensure uniqueness
                    ->where(function ($query) use ($request) {
                        return $query->where('member_id', $request->member_id)
                                     ->where('certification', $request->certification);
                    }),
            ],
            'valid_till' => ['required', 'date'],
        ]);
        $certificate = Certificate::find($id);
        $certificate->member_id = $request->member_id;
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
                    $certification->member->ifmp_id,
                    $certification->member->cnic,
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
            $sheet->setCellValue("A$row", $certification->member->ifmp_id)
                ->setCellValue("B$row", $certification->member->cnic)
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
