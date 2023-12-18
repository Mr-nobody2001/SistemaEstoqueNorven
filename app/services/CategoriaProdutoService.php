<?php

namespace App\services;

use App\Http\Requests\CriarCategoriaProdutoRequest;
use App\Models\CategoriaProduto;
use App\repositorys\CategoriaProdutoRepository;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

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

    public function criarCategoriaProduto(CriarCategoriaProdutoRequest $request): bool
    {
        try {
            $requestValidada = $request->validated();

            // Salvando a imagem no diretório de armazenamento
            $imagem = $request->file('imagem_categoria');

            $caminhoImagem = Storage::disk('public')->put('imagens', $imagem);

            CategoriaProduto::create(array_merge($requestValidada, ['caminho_imagem' => $caminhoImagem]));
        } catch (Exception $e) {
            Log::error('Erro ao criar registro: ' . $e->getMessage());

            return false;
        }

        return true;
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
