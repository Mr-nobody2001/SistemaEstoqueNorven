<?php

namespace App\Http\Controllers;

use App\Http\Requests\CriarMarcaProdutoRequest;
use App\services\MarcaProdutoService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MarcaProdutoController extends Controller
{
    public function __construct(private readonly MarcaProdutoService $marcaProdutoService)
    {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $paginaMarcaProduto = $this->marcaProdutoService->listarTodasMarcas($request);

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
