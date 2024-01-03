<?php

namespace App\services;

use App\Http\Requests\fornecedorProduto\AtualizarFornecedorProdutoRequest;
use App\Http\Requests\fornecedorProduto\CriarFornecedorProdutoRequest;
use App\Models\FornecedorProduto;
use App\repositorys\FornecedorProdutoRepository;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Collection;
use RuntimeException;

class FornecedorProdutoService
{
    public function __construct(private FornecedorProdutoRepository $fornecedorProdutoRepository)
    {
    }

    public function listarTodosFornecedores(): LengthAwarePaginator
    {
        return FornecedorProduto::orderBy('id')->paginate(20);
    }

    public function listarTodosFornecedoresSemPaginacao(): Collection
    {
        return FornecedorProduto::orderBy('id')->get();
    }

    public function encontrarFornecedorId(string $id): FornecedorProduto
    {
        return FornecedorProduto::where('id', $id)->first();
    }

    public function encontrarFornecedorNome(string $nomeFornecedor): LengthAwarePaginator
    {
        return $this->fornecedorProdutoRepository->encontrarFornecedorNome($nomeFornecedor);
    }

    public function criarFornecedorProduto(CriarFornecedorProdutoRequest $request): bool
    {
        try {
            $requestValidada = $request->validated();

            if ($requestValidada['cnpj'] && $requestValidada['cpf']) {
                throw new RuntimeException('Os dados enviados apresentam inconsistências.');
            }

            FornecedorProduto::create($requestValidada);
        } catch (Exception $e) {
            Log::error('Erro ao criar registro: ' . $e->getMessage());

            return false;
        }

        return true;
    }

    public function atualizarFornecedorProduto(AtualizarFornecedorProdutoRequest $request): bool
    {
        try {
            $id = $request->id;

            $requestValidada = $request->validated();

            if ($requestValidada['cnpj'] && $requestValidada['cpf']) {
                throw new RuntimeException('Os dados enviados apresentam inconsistências.');
            }

            FornecedorProduto::where('id', $id)
                ->update($requestValidada);

            return true;
        } catch (Exception $e) {
            Log::error('Erro ao atualizar registro: ' . $e->getMessage());

            return false;
        }
    }


    public function deletarFornecedorProduto(string $id): bool
    {
        try {
            FornecedorProduto::destroy($id);

            return true;
        } catch (Exception $e) {
            Log::error('Erro ao atualizar registro: ' . $e->getMessage());

            return false;
        }

    }
}
