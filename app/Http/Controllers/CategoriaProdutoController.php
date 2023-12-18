<?php

namespace App\Http\Controllers;

use App\services\CategoriaProdutoService;
use Illuminate\Http\Request;
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
        if ($request->nome_categoria) {
            $paginaCategoriaProduto = $this->categoriaProdutoService->encontrarCategoriaNome($request->nome_categoria);
        } else {
            $paginaCategoriaProduto = $this->categoriaProdutoService->listarTodasCategorias();
        }

        return view('categoriaProduto.index-categoria-produto', compact('paginaCategoriaProduto'));
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
    public function store(Request $request)
    {
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!$this->categoriaProdutoService->deletarcategoriaProduto($id)) {
            return redirect(route('categoria.index'))->with(['msg' => 'Não foi possível remover o registro.', 'tipo' => 'erro']);
        }

        return redirect(route('categoria.index'))->with(['msg' => 'categoria removida com sucesso', 'tipo' => 'sucesso']);
    }
}
