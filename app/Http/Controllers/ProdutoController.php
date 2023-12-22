<?php

namespace App\Http\Controllers;

use App\services\CategoriaProdutoService;
use App\services\MarcaProdutoService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProdutoController extends Controller
{
    public function __construct(
        private readonly CategoriaProdutoService $categoriaProdutoService,
        private readonly MarcaProdutoService     $marcaProdutoService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('produto.index-produto');
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
        //
    }
}
