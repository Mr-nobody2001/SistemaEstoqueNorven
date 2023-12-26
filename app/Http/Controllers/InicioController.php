<?php

namespace App\Http\Controllers;

use App\services\CategoriaProdutoService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InicioController extends Controller
{
    public function __construct(private CategoriaProdutoService $categoriaProdutoService)
    {
    }

    public function mostrarCategorias(Request $request): View
    {
        $valorPesquisa = null;

        if ($request->nome_categoria) {
            $valorPesquisa = $request->nome_categoria;
            $paginaCategoriaProduto = $this->categoriaProdutoService->encontrarCategoriaNome($valorPesquisa);
        } else {
            $paginaCategoriaProduto = $this->categoriaProdutoService->listarTodasCategorias();
        }

        return view('inicio', compact('paginaCategoriaProduto', 'valorPesquisa'));
    }
}
