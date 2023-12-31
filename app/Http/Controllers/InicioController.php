<?php

namespace App\Http\Controllers;

use App\services\CategoriaProdutoService;
use App\services\LoteProdutoService;
use App\services\ProdutoService;
use App\services\RegistroEstoqueService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InicioController extends Controller
{
    public function __construct(private readonly CategoriaProdutoService $categoriaProdutoService,
                                private readonly ProdutoService          $produtoService,
                                private readonly RegistroEstoqueService  $registroEstoqueService)
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

        return view('inicio.index-inicio', compact('paginaCategoriaProduto', 'valorPesquisa'));
    }

    public function mostrarProdutosCategoria(Request $request, string $categoriaId): View
    {
        $valorPesquisa = null;

        if ($request->nome_produto) {
            $valorPesquisa = $request->nome_produto;
            $paginaProduto = $this->produtoService->encontrarProdutoCategoriaNome($categoriaId, $valorPesquisa);
        } else {
            $paginaProduto = $this->produtoService->encontrarProdutoCategoria($categoriaId);
        }

        return view('inicio.inicio-pesquisa-produto', compact('paginaProduto', 'valorPesquisa', 'categoriaId'));
    }

    public function mostrarDetalhesProduto(string $produtoId): View
    {
        $produto = $this->produtoService->encontrarProdutoId($produtoId);

        $listaRegistroEstoqueCompra = $this->registroEstoqueService->encontrarRegistroEstoqueIdProdutoCompra($produtoId);

        $listaRegistroEstoqueVenda = $this->registroEstoqueService->encontrarRegistroEstoqueIdProdutoVenda($produtoId);

        $ticketMedio = $this->registroEstoqueService->calcularTicketMedio($produtoId);

        $quantidadeEstoque = $this->registroEstoqueService->calcularQuantidadeEstoqueProduto($produtoId);

        $volumeVendas = $this->registroEstoqueService->calcularVolumeVendas($produtoId);

        return view('inicio.inicio-detalhe-produto', compact('produto', 'listaRegistroEstoqueCompra',
            'listaRegistroEstoqueVenda', 'ticketMedio', 'quantidadeEstoque', 'volumeVendas'));
    }
}
