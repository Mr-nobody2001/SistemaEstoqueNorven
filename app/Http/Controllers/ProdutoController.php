<?php

namespace App\Http\Controllers;

use App\Http\Requests\produto\CriarProdutoRequest;
use App\services\CategoriaProdutoService;
use App\services\MarcaProdutoService;
use App\services\ProdutoService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class ProdutoController extends Controller
{
    public function __construct(
        private readonly CategoriaProdutoService $categoriaProdutoService,
        private readonly MarcaProdutoService     $marcaProdutoService,
        private readonly ProdutoService          $produtoService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $valorPesquisa = null;

        if ($request->nome_produto) {
            $valorPesquisa = $request->nome_produto;
            $paginaProduto = $this->produtoService->encontrarProdutoNome($valorPesquisa);
        } else {
            $paginaProduto = $this->produtoService->listarTodosProdutos();
        }

        return view('produto.index-produto', compact('paginaProduto','valorPesquisa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $listaTodasCategorias = $this->categoriaProdutoService->listarTodosCategoriaesSemPaginacao();

        $listaTodasMarcas = $this->marcaProdutoService->listarTodosMarcasSemPaginacao();

        return view('produto.criacao-produto', compact('listaTodasCategorias', 'listaTodasMarcas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CriarProdutoRequest $request): Application|RedirectResponse|Redirector
    {
        if (!$this->produtoService->criarProduto($request)) {
            return redirect(route('produto.index'))->with(['msg' => 'Não foi possível criar o registro.', 'tipo' => 'erro']);
        }

        return redirect(route('produto.index'))->with(['msg' => 'Produto criado com sucesso', 'tipo' => 'sucesso',]);
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
        $produto = $this->produtoService->encontrarProdutoId($id);

        $listaTodasCategorias = $this->categoriaProdutoService->listarTodosCategoriaesSemPaginacao();

        $listaTodasMarcas = $this->marcaProdutoService->listarTodosMarcasSemPaginacao();

        return view('produto.atualizar-produto', compact('produto' ,'listaTodasCategorias', 'listaTodasMarcas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
