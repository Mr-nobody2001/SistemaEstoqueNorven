<?php

namespace App\Http\Controllers;

use App\Http\Requests\login\AutenticarUsuarioRequest;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
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
            $nomeUsuario = Auth::user()->name;
            return redirect()->intended(route('inicio'))
                ->with(['msg' => "Seja bem vindo $nomeUsuario.", 'tipo' => 'sucesso']);
        }

        return redirect()->back()->with(['msg' => 'Credenciais inválidas.', 'tipo' => 'erro']);
    }

    public function deslogarUsuario(): Application|Redirector|RedirectResponse
    {
        Auth::logout();

        return redirect(route('login'))
            ->with(['msg' => 'Usuário deslogado com sucesso.', 'tipo' => 'sucesso']);
    }
}
