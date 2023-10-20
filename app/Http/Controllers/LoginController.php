<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{

    public function index()
    {
        return view('auth.login');
    }


    public function store(Request $request)
    {
        // Validate
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'El campo de correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe ser una dirección de correo válida.',
            'password.required' => 'El campo de contraseña es obligatorio.',
        ]);

        // Log In
        if (!auth()->attempt($request->only('email', 'password'), $request->remember)) {
            return back()->with('status', 'Datos incorrectos');
        }

        // Redirect
        return redirect()->route('dashboard', auth()->user()->username);
    }
}
