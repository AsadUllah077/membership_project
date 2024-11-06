<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        $users = User::all();
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
}
