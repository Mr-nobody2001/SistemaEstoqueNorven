<?php

namespace App\Http\Controllers;

use App\Http\Requests\categoriaProduto\AtualizarCategoriaProdutoRequest;
use App\Http\Requests\categoriaProduto\CriarCategoriaProdutoRequest;
use App\services\CategoriaProdutoService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class CategoriaProdutoController extends Controller
{
    public function __construct(private readonly CategoriaProdutoService $categoriaProdutoService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $valorPesquisa = null;

        if ($request->nome_categoria) {
            $valorPesquisa = $request->nome_categoria;
            $paginaCategoriaProduto = $this->categoriaProdutoService->encontrarCategoriaNome($valorPesquisa);
        } else {
            $paginaCategoriaProduto = $this->categoriaProdutoService->listarTodasCategorias();
        }

        return view('categoriaProduto.index-categoria-produto', compact('paginaCategoriaProduto',
            'valorPesquisa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('categoriaProduto.criacao-categoria-produto');
    }

    /**
     * Store a newly created resource in storage.
     */
//    public function store(CriarCategoriaProdutoRequest $request)
    public function store(CriarCategoriaProdutoRequest $request): View|Application|RedirectResponse|Redirector
    {
        if (!$this->categoriaProdutoService->criarCategoriaProduto($request)) {
            return redirect(route('categoria.index'))->with(['msg' => 'Não foi possível criar o registro.', 'tipo' => 'erro']);
        }

        return redirect(route('categoria.index'))->with(['msg' => 'Categoria criada com sucesso', 'tipo' => 'sucesso']);
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
    public function edit(string $id): View
    {
        $categoriaProduto = $this->categoriaProdutoService->encontrarCategoriaId($id);

        return view('categoriaProduto.atualizacao-categoria-produto', compact('categoriaProduto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AtualizarCategoriaProdutoRequest $request): Application|RedirectResponse|Redirector
    {
        if (!$this->categoriaProdutoService->atualizarCategoriaProduto($request)) {
            return redirect(route('categoria.index'))->with(['msg' => 'Não foi possível atualizar o registro.', 'tipo' => 'erro']);
        }

        return redirect(route('categoria.index'))->with(['msg' => 'Categoria atualizada com sucesso', 'tipo' => 'sucesso']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): Application|RedirectResponse|Redirector
    {
        if (!$this->categoriaProdutoService->deletarCategoriaProduto($id)) {
            return redirect(route('categoria.index'))->with(['msg' => 'Não foi possível remover o registro.', 'tipo' => 'erro']);
        }

        return redirect(route('categoria.index'))->with(['msg' => 'categoria removida com sucesso', 'tipo' => 'sucesso']);
    }
}
