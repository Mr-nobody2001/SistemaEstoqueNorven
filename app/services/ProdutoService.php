<?php

namespace App\services;

use App\Http\Requests\produto\CriarProdutoRequest;
use App\Models\Produto;
use App\repositorys\ProdutoRepository;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;

class ProdutoService
{
    public function __construct(private readonly ProdutoRepository $produtoRepository)
    {
    }

    public function listarTodosProdutos(): LengthAwarePaginator
    {
        return Produto::orderBy('id')->paginate(20);
    }

    public function encontrarProdutoId(string $id): Produto
    {
        return Produto::where('id', $id)->first();
    }

    public function encontrarProdutoNome(string $nomeProduto): LengthAwarePaginator
    {
        return $this->produtoRepository->encontrarProdutoNome($nomeProduto);
    }

    public function criarProduto(CriarProdutoRequest $request): bool
    {
        try {
            $requestValidada = $request->validated();

            $requestValidada = $this->formatarRequestValidada($requestValidada);

            Produto::create($requestValidada);
        } catch (Exception $e) {
            Log::error('Erro ao criar registro: ' . $e->getMessage());

            return false;
        }

        return true;
    }

    private function formatarRequestValidada(array $requestValidada)
    {
        $informacoesNutricionais = array_splice($requestValidada, 6);

        $informacoesNutricionais['alergenos'] = array_splice($informacoesNutricionais, 12);

        $informacoesNutricionais = json_encode($informacoesNutricionais, JSON_THROW_ON_ERROR);

        $requestValidada['informacoes_nutricionais'] = $informacoesNutricionais;

        return $requestValidada;
    }
}
