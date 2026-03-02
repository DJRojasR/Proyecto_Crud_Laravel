<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
   // Mostrar formulario de login
    public function showLogin() {
        return view('auth.login');
    }

    // Procesar el login
    public function login(Request $request) {
        $credenciales = $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        // Regenera la seccion por seguridad
        if (Auth::attempt($credenciales)) {
            $request->session()->regenerate();
            return redirect('/pacientes');
        }

        //  Si hay errores, muestra credenciales incorrectas
        return back()->withErrors([
            'email' => 'Credenciales incorrectas, intenta de nuevo'
        ]);
    }

    // Cerrar sesión
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    // Mostrar formulario de registro
    public function showRegister() {
        return view('auth.register');
    }

    // Procesar el registro
    public function register(Request $request) {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed'
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password)
        ]);

        return redirect('/login')->with('success', 'Usuario creado correctamente');
    }

}
