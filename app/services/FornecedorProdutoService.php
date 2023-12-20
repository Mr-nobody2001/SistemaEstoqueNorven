<?php

namespace App\services;

use App\Http\Requests\fornecedorProduto\CriarFornecedorProdutoRequest;
use App\Models\FornecedorProduto;
use App\repositorys\FornecedorProdutoRepository;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;

class FornecedorProdutoService
{
    public function __construct(public FornecedorProdutoRepository $fornecedorProdutoRepository)
    {
    }

    public function listarTodosFornecedores(): LengthAwarePaginator
    {
        return FornecedorProduto::paginate(20);
    }

    public function encontrarFornecedorId(string $id): FornecedorProduto
    {
        return FornecedorProduto::where('id', $id)->first();
    }

    public function encontrarFornecedorNome(string $nomeFornecedor): LengthAwarePaginator
    {
        return $this->fornecedorProdutoRepository->encontrarFornecedorNome($nomeFornecedor);
    }

    public function criarFornecedorProduto(CriarFornecedorProdutoRequest $request)
    {
        try {
            $requestValidada = $request->validated();

            $requestValidada['telefone'] = preg_replace("/[^0-9]/", "", $requestValidada['telefone']);

            if (!is_null($requestValidada['cpf'])) {
                $requestValidada['cpf'] = preg_replace("/[^0-9]/", "", $requestValidada['cpf']);
            } else {
                $requestValidada['cnpj'] = preg_replace("/[^0-9]/", "", $requestValidada['cnpj']);
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
