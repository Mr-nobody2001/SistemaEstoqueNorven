<?php

namespace App\Http\Controllers;

use App\Http\Requests\usuario\AtualizarUsuarioRequest;
use App\Http\Requests\usuario\CriarUsuarioRequest;
use App\services\UsuarioService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UsuarioController extends Controller
{
    public function __construct(private readonly UsuarioService $usuarioService)
    {
    }

    public function index(): void
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): void
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CriarUsuarioRequest $request): RedirectResponse
    {
        if ($this->usuarioService->criarUsuario($request)) {
            return redirect()->back()->with(['msg' => 'Usuário cadastrado com sucesso.', 'tipo' => 'sucesso']);
        }

        return redirect()->back()->with(['msg' => 'Não foi possível cadastrar esse usuário.', 'tipo' => 'erro']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): void
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(): View
    {
        return view('usuario.atualizacao-usuario');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AtualizarUsuarioRequest $request)
    {
        if (!$this->usuarioService->atualizarUsuario($request)) {
            return redirect(route('inicio'))->with(['msg' => 'Não foi possível atualizar o registro.', 'tipo' => 'erro']);
        }

        return redirect(route('inicio'))->with(['msg' => 'Usuário atualizado com sucesso', 'tipo' => 'sucesso']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        if (!$this->usuarioService->deletarUsuario($id)) {
            return redirect(route('inicio'))->with(['msg' => 'Não foi possível remover o registro.', 'tipo' => 'erro']);
        }

        return redirect('/')->with(['msg' => 'Usuário removido com sucesso', 'tipo' => 'sucesso']);
    }
}
