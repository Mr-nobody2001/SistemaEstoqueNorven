<?php

namespace App\services;

use App\Http\Requests\produto\AtualizarProdutoRequest;
use App\Http\Requests\produto\CriarProdutoRequest;
use App\Models\Produto;
use App\repositorys\ProdutoRepository;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProdutoService
{
    public function __construct(private readonly ProdutoRepository $produtoRepository)
    {
    }

    public function listarTodosProdutos(): LengthAwarePaginator
    {
        return Produto::orderBy('id')->paginate(20);
    }

    public function listarTodosProdutosSemPaginacao(): Collection
    {
        return Produto::orderBy('id')->get();
    }

    public function encontrarProdutoId(string $id): Produto
    {
        return Produto::where('id', $id)->first();
    }

    public function encontrarProdutoCategoria(string $categoriaId): Collection
    {
        return Produto::where('categoria_id', $categoriaId)->get();
    }

    public function encontrarProdutoCategoriaNome(string $categoriaId, string $nomeProduto): Collection
    {
        return Produto::where('categoria_id', $categoriaId)
            ->where('nome_produto', 'ilike', '%' . $nomeProduto . '%')->get();
    }


    public function encontrarProdutoNome(string $nomeProduto): LengthAwarePaginator
    {
        return $this->produtoRepository->encontrarProdutoNome($nomeProduto);
    }

    public function criarProduto(CriarProdutoRequest $request): bool
    {
        try {
            $requestValidada = $request->validated();

            $imagem = $request->file('imagem_produto');

            // Salvando a imagem no diretório de armazenamento
            $caminhoImagem = Storage::disk('public')->put('imagens/produto', $imagem);

            $requestValidada = $this->formatarRequestValidada($requestValidada, $caminhoImagem);

            Produto::create($requestValidada);
        } catch (Exception $e) {
            Log::error('Erro ao criar registro: ' . $e->getMessage());

            $this->deletarImagemProduto($caminhoImagem);

            return false;
        }

        return true;
    }

    public function atualizarProduto(AtualizarProdutoRequest $request): bool
    {
        $caminhoImagem = null;

        try {
            $id = $request->id;

            $requestValidada = $request->validated();

            if (array_key_exists('imagem_produto', $requestValidada)) {
                $caminhoImagem = $this->encontrarProdutoId($id)->caminho_imagem;

                $this->deletarImagemProduto($caminhoImagem);

                // Salva a nova imagem
                $caminhoImagem = Storage::disk('public')->put('imagens/produto', $requestValidada['imagem_produto']);
            }

            $requestValidada = $this->formatarRequestValidada($requestValidada, $caminhoImagem);

            Produto::where('id', $id)
                ->update($requestValidada);

            return true;
        } catch (Exception $e) {
            Log::error('Erro ao atualizar registro: ' . $e->getMessage());

            if (isset($caminhoImagem)) {
                $this->deletarImagemProduto($caminhoImagem);
            }

            return false;
        }
    }

    public function deletarProduto(string $id): bool
    {
        try {
            $caminhoImagem = $this->encontrarProdutoId($id)->caminho_imagem;

            Produto::destroy($id);

            $this->deletarImagemProduto($caminhoImagem);

            return true;
        } catch (Exception $e) {
            Log::error('Erro ao atualizar registro: ' . $e->getMessage());

            return false;
        }

    }

    private function formatarRequestValidada(array $requestValidada, string $caminhoImagem = null): array
    {
        if ($caminhoImagem) {
            $informacoesNutricionais = array_splice($requestValidada, 7);

            // Retira a imagem
            unset($requestValidada['imagem_produto']);

            // E substitui pelo endereço da imagem
            $requestValidada['caminho_imagem'] = $caminhoImagem;
        } else {
            $informacoesNutricionais = array_splice($requestValidada, 6);
        }

        $informacoesNutricionais['alergenos'] = array_splice($informacoesNutricionais, 12);

        $informacoesNutricionais = json_encode($informacoesNutricionais, JSON_THROW_ON_ERROR);

        $requestValidada['informacoes_nutricionais'] = $informacoesNutricionais;

        return $requestValidada;
    }

    private function deletarImagemProduto(string $caminhoImagem): void
    {
        try {
            // Apaga a imagem antiga
            Storage::disk('public')->delete($caminhoImagem);
        } catch (Exception $e) {
            Log::error('Erro ao excluir imagem da categoria: ' . $e->getMessage());
        }
    }
}
