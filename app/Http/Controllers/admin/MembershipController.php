<?php

namespace App\Http\Controllers\admin;

use App\Models\Membership;
use App\Models\Certificate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Fees;
use App\Models\Payment;
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
        $membership = Membership::with('certificates', 'fees', 'payments')->when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%"); // Replace 'name' with the column you want to search by
            // Add more conditions as needed
        })->paginate(10);
        // dd($membership);


        $certificates = Certificate::all();
        $payments = Payment::all();
        // dd($payments);
        $active_users = User::where('status', 'active')->count();
        $users = User::count();
        $fees = Fees::all();
        // dd($fees);

        return view('admin/membership/index', compact('certificates', 'membership', 'active_users', 'users', 'search', 'fees', 'payments'));
    }



    public function create()
    {
        $companies = Membership::all();
        return view('admin/membership/membership_create', compact('companies'));
    }

    public function store(Request $request)
    {
        $validator = $request->validate([
            'ifmp_id' => [
    'required',
    'string',
    'max:255',
    'unique:memberships,ifmp_id',
    'regex:/^IFMP-\d{4}$/',  // Updated to match the format IFMP-0000
],
            'email' => ['required', 'string', 'email', 'unique:memberships,email'],
            'mobile' => ['required', 'string'],
            'name' => ['required', 'string', 'max:255'],
            'cnic' => ['required', 'string', 'max:15', 'regex:/^\d{5}-\d{7}-\d{1}$/',],
            'm_date' => ['required', 'date'],
            'company_id' => ['required', 'integer'],
            'phone' => ['required', 'string'],
            'sba' => ['required', 'string'],
        ]);
        Membership::create([
            'ifmp_id' => $request->ifmp_id,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'name' => $request->name,
            'cnic' => $request->cnic,
            'm_date' => $request->m_date,
            'company_id' => $request->company_id,
            'phone' => $request->phone,
            'sba' => $request->sba
        ]);

        return redirect()->route('admin.membership')->with('success', 'membership created successfully.');
    }

    public function edit($id)
    {
        $membership = Membership::find($id);
        $certificates = Certificate::all();
        $companies = Company::all();
        return view('admin/membership/membership_edit', compact('certificates', 'membership','companies'));
    }

    public function update(Request $request, $id)
    {
        $validator = $request->validate([
           'ifmp_id' => [
    'required',
    'string',
    'max:255',
    'unique:memberships,ifmp_id',
    'regex:/^IFMP-\d{4}$/',  // Updated to match the format IFMP-0000
],
            'email' => ['required', 'string', 'email'],
            'mobile' => ['required', 'string'],
            'name' => ['required', 'string', 'max:255'],
            'cnic' => ['required', 'string', 'max:15', 'regex:/^\d{5}-\d{7}-\d{1}$/',],
            'm_date' => ['required', 'date'],
            'company_id' => ['required', 'integer'],
            'phone' => ['required', 'string'],
            'sba' => ['required', 'string'],
        ]);

        $membership = Membership::find($id);
        $membership->ifmp_id = $request->ifmp_id;
        $membership->email = $request->email;
        $membership->mobile = $request->mobile;
        $membership->cnic = $request->cnic;
        $membership->company_id = $request->company_id;
        $membership->name = $request->name;
        $membership->m_date = $request->m_date;
        $membership->phone = $request->phone;
        $membership->sba = $request->sba;
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
                    $member->certificates ? $member->certificates[0]->certification : 'N/A',
                    $member->status,
                    $member->dues,
                    $member->$member->fees ? $member->fees->amount : 'N/A',
                    $member->m_date,
                    $member->certificates ? $member->certificates[0]->valid_till : 'N/A',
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

        $memberships = Membership::with('fees')->get();
        $row = 2;

        foreach ($memberships as $member) {
            $sheet->setCellValue("A$row", $member->ifmp_id)
                ->setCellValue("B$row", $member->name)
                ->setCellValue("C$row", $member->cnic)
                ->setCellValue("D$row", $member->certificates ? $member->certificates[0]->certification : 'N/A')
                ->setCellValue("E$row", $member->status)
                ->setCellValue("F$row", $member->dues)
                ->setCellValue("G$row", $member->fees ? $member->fees->amount : 'N/A')
                ->setCellValue("H$row", $member->m_date)
                ->setCellValue("I$row", $member->certificates ? $member->certificates[0]->valid_till : 'N/A');
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
