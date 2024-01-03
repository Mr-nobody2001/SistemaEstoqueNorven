<?php

namespace App\Http\Controllers;

use App\Http\Requests\login\AutenticarUsuarioRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function mostrarFormularioLogin()
    {
        return view('login.login');
    }

    public function autenticarUsuario(AutenticarUsuarioRequest $request): RedirectResponse
    {
        if (Auth::attempt($request->validated())) {
            return redirect()->intended('/inicio');
        }

        return redirect()->back()->with(['msg' => 'Credenciais inválidas.', 'tipo' => 'erro']);
    }
}
