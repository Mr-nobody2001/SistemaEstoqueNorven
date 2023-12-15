<?php

namespace App\Http\Controllers;

use App\Http\Requests\CriarMarcaProdutoRequest;
use App\services\MarcaProdutoService;
use Illuminate\Http\Request;
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

        /*if (!$paginaMarcaProduto) {

        }*/

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
    public function store(CriarMarcaProdutoRequest $request): View
    {
        if ($this->marcaProdutoService->criarMarcaProduto($request)) {
            return view('marcaProduto.criacao-marca-produto');
        }

        return view('marcaProduto.criacao-marca-produto');
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

        /*if (is_null($marcaProduto)) {

        }*/

        return view('marcaProduto.atualizacao-marca-produto', compact('marcaProduto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CriarMarcaProdutoRequest $request): View
    {
        if ($this->marcaProdutoService->atualizarMarcaProduto($request)) {

        }

        return view();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if ($this->marcaProdutoService->deletarMarcaProduto($id)) {

        }
    }
}
