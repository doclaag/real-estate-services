<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{

    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request){
        // dd($request);

        // Validate
        $this->validate($request, [
            'name' => 'required|max:30',
            'username' => 'required|unique:users|min:3|max:20',
            'email' => 'required|email|unique:users,email', // unique:table,column
            'password' => 'required|min:8|confirmed',
        ]);


        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        // Authenticate User
        auth()->attempt([
            'email'=>$request->email,
            'password'=>$request->password,
        ]);


        // Redirect
        return redirect()->route('dashboard', auth()->user()->username);
    }



}
