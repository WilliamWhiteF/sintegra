<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $usuario = $request->usuario;
        $senha = $request->senha;

        $user = Usuario::where('usuario', $usuario)
            ->first();

        if ($user && Hash::check($senha, $user->senha)) {
            Auth::login($user);
            return redirect()->intended('/consulta');
        }

        return redirect()->back()->with('error_message', 'Dados Incorrectos')->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
