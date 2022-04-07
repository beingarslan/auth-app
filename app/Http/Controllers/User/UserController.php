<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('modules.users.index', [
            'users' => $users,
        ]);
    }

    public function create()
    {
        return view('modules.users.create');
    }
    
    public function store(Request $request)
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];

        $validated = Validator::make($request->all(), $rules);
        if($validated->fails()) {
            return redirect()->back()->withErrors($validated)->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Toastr::success('User created successfully.', 'Success');
        return redirect()->route('users.edit', $user->id);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('modules.users.edit', [
            'user' => $user,
        ]);
    }

    public function update(Request $request){
        $rules = [
            'id' => 'required',
            'name' => 'required|string|max:255|unique:users,name,'.$request->id,
            'email' => 'required|string|email|max:255|unique:users,email,'.$request->id,
        ];

        $validated = Validator::make($request->all(), $rules);
        if($validated->fails()) {
            return redirect()->back()->withErrors($validated)->withInput();
        }

        $user = User::findOrFail($request->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        Toastr::success('User updated successfully.', 'Success');
        return redirect()->back();
    }
}
