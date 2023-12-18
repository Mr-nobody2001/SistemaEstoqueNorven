<?php

namespace App\services;

use App\Models\CategoriaProduto;
use App\repositorys\CategoriaProdutoRepository;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;

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

    public function deletarCategoriaProduto(string $id): bool
    {
        try {
            CategoriaProduto::destroy($id);

            return true;
        } catch (Exception $e) {
            Log::error('Erro ao atualizar registro: ' . $e->getMessage());

            return false;
        }

    }
}
