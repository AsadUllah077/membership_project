<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Dompdf\Dompdf;
use Dompdf\Options;
class UserController extends Controller
{
    public function index(Request $request){
        $query = User::query();

        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $users = $query->paginate(10);
        return view('admin/users',compact('users'));
    }

    public function create(){
        return view('admin/users_create');
    }


    public function login(Request $request) {
        // Validate the incoming request data
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        // Attempt to authenticate the user
        if (auth()->attempt(['email' => $request->email, 'password' => $request->password])) {
            // Authentication was successful; redirect to the admin dashboard
            return redirect()->route('admin.dashboard');
        }
        // dd($request->all());

        // Authentication failed; redirect back with an error message
        return redirect()->route('login');

    }


    public function store(Request $request){
        $validator = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8']
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' =>  Hash::make($request->password),
            'status' => $request->status
        ]);

        return redirect()->route('admin.users')->with('success', 'User created successfully.');
    }

    public function edit($id){
        $user = User::find($id);
        return view('admin/users_edit', compact('user'));
    }

    public function update(Request $request, $id){
        $validator = $request->validate([
            'name' => ['required','string','max:255'],
            'email' => ['required','string','email','max:255', 'unique:users,email,'.$id],
            'password' => ['nullable','string','min:8']
        ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;

        if($request->password){
            $user->password = Hash::make($request->password);
        }

        $user->status = $request->status;
        $user->save();

        return redirect()->route('admin.users')->with('success', 'User updated successfully.');
    }

    public function delete($id){
        User::destroy($id);
        return redirect()->route('admin.users')->with('success', 'User deleted successfully.');
    }

    public function exportCsv()
    {
        $filename = "users_list.csv";
        $users = User::all();

        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $columns = ['Name', 'Email', 'Status'];

        $callback = function () use ($users, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($users as $user) {
                fputcsv($file, [
                    $user->name,
                    $user->email,
                    $user->status,
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
            ->setCellValue('B1', 'Email')
            ->setCellValue('C1', 'Status');

        $users = User::all();
        $row = 2;

        foreach ($users as $user) {
            $sheet->setCellValue("A$row", $user->name)
                ->setCellValue("B$row", $user->email)
                ->setCellValue("C$row", $user->status);
            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        $filename = "users_list.xlsx";

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=\"$filename\"");

        $writer->save("php://output");
    }

    public function exportPdf()
    {
        $users = User::all();

        $pdf = new Dompdf();
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $pdf->setOptions($options);

        $html = view('admin.pdf', compact('users'))->render();
        $pdf->loadHtml($html);
        $pdf->setPaper('A4', 'landscape');
        $pdf->render();

        return $pdf->stream("users_list.pdf", ["Attachment" => true]);
    }

}
