<?php

namespace App\services;

use App\Models\CategoriaProduto;
use App\repositorys\CategoriaProdutoRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class CategoriaProdutoService
{
    public function __construct(public readonly CategoriaProdutoRepository $categoriaProdutoRepository)
    {
    }

    public function listarTodasCategorias(): LengthAwarePaginator
    {
        return CategoriaProduto::paginate(20);
    }

    public function encontrarCategoriaId(string $id): CategoriaProduto
    {
        return CategoriaProduto::where('id', $id)->first();
    }

    public function encontrarCategoriaNome(string $nomeCategoria): LengthAwarePaginator
    {
        return $this->categoriaProdutoRepository->encontrarCategoriasNome($nomeCategoria);
    }
}
