<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Muestra el formulario de login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Procesa el login
    public function login(Request $request)
    {
        // Valida los datos de login
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Intenta autenticar al usuario
        if (Auth::attempt($credentials)) {
            // Si es exitoso, redirige al home o la página deseada
            return redirect()->intended('Welcome');
        }

        // Si falla, redirige al formulario de login con un error
        return back()->withErrors([
            'email' => 'Credenciales incorrectas.',
        ])->onlyInput('email');
    }

    // Cierra la sesión
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login');
    }
}