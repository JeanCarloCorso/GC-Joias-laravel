<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Attempting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        if(Auth()->check())
        {
            return redirect()->route('ar.produtos');
        }
        else
        {
            return view('login');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8'
        ], [
            'email.required' => 'O campo e-mail é obrigatório!',
            'email.email' => 'Informe um email válido!',
            'password.required' => 'O campo senha é obrigatório!',
            'password.min' => 'A senha deve conter no mínimo :min caracteres!'
        ]);

        $credenciais = $request->only('email', 'password');
        $autenticate = Auth::attempt($credenciais);

        if(!$autenticate){
            return redirect()->route('login.index')->withErrors(['erroLogin' => 'Email ou senha incorretos']);
        }

        return redirect()->route('ar.produtos')->with('logado', 'Logado');
    }

    public function destroy()
    {
        Auth::logout();

        return view('login');
    }
}
