<?php

namespace App\Http\Controllers;

use App\Http\Requests\CriarMarcaProdutoRequest;
use App\services\MarcaProdutoService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class MarcaProdutoController extends Controller
{
    public function __construct(private readonly MarcaProdutoService $marcaProdutoService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        if ($request->nome_marca) {
            $paginaMarcaProduto = $this->marcaProdutoService->encontrarMarcaNome($request->nome_marca);
        } else {
            $paginaMarcaProduto = $this->marcaProdutoService->listarTodasMarcas();
        }

        return view('marcaProduto.index-marca-produto', compact('paginaMarcaProduto'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('marcaProduto.criacao-marca-produto');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CriarMarcaProdutoRequest $request): View|Application|RedirectResponse|Redirector
    {
        if (!$this->marcaProdutoService->criarMarcaProduto($request)) {
            return redirect(route('marca.index'))->with(['msg' => 'Não foi possível criar o registro.', 'tipo' => 'erro', 'nome_marca' => $request->nome_marca]);
        }

        return redirect(route('marca.index'))->with(['msg' => 'Marca criada com sucesso', 'tipo' => 'sucesso',]);
    }

    /**
     * Display the specified resource.
     */
    public function show(): void
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $marcaProduto = $this->marcaProdutoService->encontrarMarcaId($id);

        return view('marcaProduto.atualizacao-marca-produto', compact('marcaProduto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CriarMarcaProdutoRequest $request): Application|RedirectResponse|Redirector
    {
        if (!$this->marcaProdutoService->atualizarMarcaProduto($request)) {
            return redirect(route('marca.index'))->with(['msg' => 'Não foi possível atualizar o registro.', 'tipo' => 'erro']);
        }

        return redirect(route('marca.index'))->with(['msg' => 'Marca atualizada com sucesso', 'tipo' => 'sucesso']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): Application|RedirectResponse|Redirector
    {
        if (!$this->marcaProdutoService->deletarMarcaProduto($id)) {
            return redirect(route('marca.index'))->with(['msg' => 'Não foi possível remover o registro.', 'tipo' => 'erro']);
        }

        return redirect(route('marca.index'))->with(['msg' => 'Marca removida com sucesso', 'tipo' => 'sucesso']);
    }
}
