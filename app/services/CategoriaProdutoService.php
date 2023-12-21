<?php

namespace App\services;

use App\Http\Requests\categoriaProduto\AtualizarCategoriaProdutoRequest;
use App\Http\Requests\categoriaProduto\CriarCategoriaProdutoRequest;
use App\Models\CategoriaProduto;
use App\repositorys\CategoriaProdutoRepository;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class CategoriaProdutoService
{
    public function __construct(private readonly CategoriaProdutoRepository $categoriaProdutoRepository)
    {
    }

    public function listarTodasCategorias(): LengthAwarePaginator
    {
        return CategoriaProduto::orderBy('id')->paginate(20);
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

            $imagem = $request->file('imagem_categoria');

            // Salvando a imagem no diretório de armazenamento
            $caminhoImagem = Storage::disk('public')->put('imagens', $imagem);

           $requestValidada = $this->formatarRequestValidadaCategoria($requestValidada, $caminhoImagem);

            CategoriaProduto::create($requestValidada);
        } catch (Exception $e) {
            Log::error('Erro ao criar registro: ' . $e->getMessage());

            return false;
        }

        return true;
    }

    public function atualizarCategoriaProduto(AtualizarCategoriaProdutoRequest $request)
    {
        try {
            $id = $request->id;

            $requestValidada = $request->validated();

            if (array_key_exists('imagem_categoria', $requestValidada)) {
                $this->deletarImagemCategoria($id);

                // Salva a nova imagem
                $caminhoImagem = Storage::disk('public')->put('imagens', $requestValidada['imagem_categoria']);

                $requestValidada = $this->formatarRequestValidadaCategoria($requestValidada, $caminhoImagem);
            }

            CategoriaProduto::where('id', $id)
                ->update($requestValidada);

            return true;
        } catch (Exception $e) {
            Log::error('Erro ao atualizar registro: ' . $e->getMessage());

            return false;
        }
    }

    public function deletarCategoriaProduto(string $id): bool
    {
        try {
            $this->deletarImagemCategoria($id);

            CategoriaProduto::destroy($id);

            return true;
        } catch (Exception $e) {
            Log::error('Erro ao atualizar registro: ' . $e->getMessage());

            return false;
        }

    }

    private function deletarImagemCategoria($id): void
    {
        try {
            $categoriaProduto = $this->encontrarCategoriaId($id);

            // Apaga a imagem antiga
            Storage::disk('public')->delete($categoriaProduto->caminho_imagem);
        } catch (Exception $e) {
            Log::error('Erro ao excluir imagem da categoria: ' . $e->getMessage());
        }
    }

    private function formatarRequestValidadaCategoria($requestValidada, $caminhoImagem): array
    {
        // Retira a imagem
        unset($requestValidada['imagem_categoria']);

        // E substitui pelo endereço da imagem
        $requestValidada['caminho_imagem'] = $caminhoImagem;

        return $requestValidada;
    }
}
