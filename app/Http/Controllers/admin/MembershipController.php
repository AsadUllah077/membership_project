<?php

namespace App\Http\Controllers\admin;

use App\Models\Membership;
use App\Models\Certificate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use PHPUnit\Framework\Attributes\Medium;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Dompdf\Dompdf;
use Dompdf\Options;

class MembershipController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search'); // Get the search input

        // Filter memberships based on search query
        $membership = Membership::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%"); // Replace 'name' with the column you want to search by
            // Add more conditions as needed
        })->paginate(10);

        $certificates = Certificate::all();
        $active_users = User::where('status', 'active')->count();
        $users = User::count();

        return view('admin/membership/index', compact('certificates', 'membership', 'active_users', 'users', 'search'));
    }



    public function create()
    {
        $certificates = Certificate::all();
        return view('admin/membership/membership_create', compact('certificates'));
    }

    public function store(Request $request)
    {
        $validator = $request->validate([
            'ifmp_id' => ['required', 'string', 'max:255'],
            'balance' => ['required', 'integer'],

            'dues' => ['required', 'integer'],
            'name' => ['required', 'string', 'max:255'],
            'cnic' => ['required', 'string', 'max:15'],
            'm_date' => ['required', 'date'],
            'valid_till' => ['required', 'date'],
            'status' => ['required', 'string'],

        ]);
        Membership::create([
            'ifmp_id' => $request->ifmp_id,
            'balance' => $request->balance,

            'dues' => $request->dues,
            'name' => $request->name,
            'cnic' => $request->cnic,
            'm_date' => $request->m_date,
            'valid_till' => $request->valid_till,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.membership')->with('success', 'membership created successfully.');
    }

    public function edit($id)
    {
        $membership = Membership::find($id);
        $certificates = Certificate::all();
        return view('admin/membership/membership_edit', compact('certificates', 'membership'));
    }

    public function update(Request $request, $id)
    {
        $validator = $request->validate([
            'ifmp_id' => ['required', 'string', 'max:255'],
            'balance' => ['required', 'integer'],

            'dues' => ['required', 'integer'],
            'name' => ['required', 'string', 'max:255'],
            'cnic' => ['required', 'string', 'max:15'],
            'm_date' => ['required', 'date'],
            'valid_till' => ['required', 'date'],
            'status' => ['required', 'string'],
        ]);

        $membership = Membership::find($id);
        $membership->ifmp_id = $request->ifmp_id;
        $membership->balance = $request->balance;

        $membership->cnic = $request->cnic;
        $membership->dues = $request->dues;
        $membership->name = $request->name;
        $membership->m_date = $request->m_date;
        $membership->valid_till = $request->valid_till;
        $membership->status = $request->status;
        $membership->save();

        return redirect()->route('admin.membership')->with('success', 'membership updated successfully.');
    }

    public function delete($id)
    {
        Membership::destroy($id);
        return redirect()->route('admin.membership')->with('success', 'membership deleted successfully.');
    }

    public function exportCsv()
    {
        $filename = "membership_list.csv";
        $memberships = Membership::all();

        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $columns = ['IFMP-ID', 'Name', 'CNIC', 'Certification', 'Status', 'Dues', 'Balance', 'M-Date', 'Valid Till'];

        $callback = function () use ($memberships, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($memberships as $member) {
                fputcsv($file, [
                    $member->ifmp_id,
                    $member->name,
                    $member->cnic,
                    $member->certificate ? $member->certificate->certification : 'N/A',
                    $member->status,
                    $member->dues,
                    $member->balance,
                    $member->m_date,
                    $member->valid_till,
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
            ->setCellValue('B1', 'Name')
            ->setCellValue('C1', 'CNIC')
            ->setCellValue('D1', 'Certification')
            ->setCellValue('E1', 'Status')
            ->setCellValue('F1', 'Dues')
            ->setCellValue('G1', 'Balance')
            ->setCellValue('H1', 'M-Date')
            ->setCellValue('I1', 'Valid Till');

        $memberships = Membership::all();
        $row = 2;

        foreach ($memberships as $member) {
            $sheet->setCellValue("A$row", $member->ifmp_id)
                ->setCellValue("B$row", $member->name)
                ->setCellValue("C$row", $member->cnic)
                ->setCellValue("D$row", $member->certificate ? $member->certificate->certification : 'N/A')
                ->setCellValue("E$row", $member->status)
                ->setCellValue("F$row", $member->dues)
                ->setCellValue("G$row", $member->balance)
                ->setCellValue("H$row", $member->m_date)
                ->setCellValue("I$row", $member->valid_till);
            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        $filename = "membership_list.xlsx";

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=\"$filename\"");

        $writer->save("php://output");
    }
    public function exportPdf()
    {
        $memberships = Membership::all();

        $pdf = new Dompdf();
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $pdf->setOptions($options);

        $html = view('admin.membership.pdf', compact('memberships'))->render();
        $pdf->loadHtml($html);
        $pdf->setPaper('A4', 'landscape');
        $pdf->render();

        return $pdf->stream("membership_list.pdf", ["Attachment" => true]);
    }
}
