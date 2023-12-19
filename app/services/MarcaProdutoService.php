<?php

namespace App\services;

use App\Http\Requests\AtualizarMarcaProdutoRequest;
use App\Http\Requests\CriarMarcaProdutoRequest;
use App\Models\MarcaProduto;
use App\repositorys\MarcaProdutoRepository;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;

class MarcaProdutoService
{
    public function __construct(private readonly MarcaProdutoRepository $marcaProdutoRepository)
    {
    }

    public function listarTodasMarcas(): LengthAwarePaginator
    {
        return MarcaProduto::paginate(20);
    }

    public function encontrarMarcaId(string $id): MarcaProduto
    {
        return MarcaProduto::where('id', $id)->first();
    }

    public function encontrarMarcaNome(string $nomeMarca): LengthAwarePaginator
    {
        return $this->marcaProdutoRepository->encontrarMarcasNome($nomeMarca);
    }

    public function criarMarcaProduto(CriarMarcaProdutoRequest $request): bool
    {
        try {
            $requestValidada = $request->validated();

            MarcaProduto::create($requestValidada);
        } catch (Exception $e) {
            Log::error('Erro ao criar registro: ' . $e->getMessage());

            return false;
        }

        return true;
    }

    public function atualizarMarcaProduto(AtualizarMarcaProdutoRequest $request): bool
    {
        try {
            $id = $request->id;

            $requestValidada = $request->validated();

            MarcaProduto::where('id', $id)
                ->update(['nome_marca' => $requestValidada['nome_marca']]);

            return true;
        } catch (Exception $e) {
            Log::error('Erro ao atualizar registro: ' . $e->getMessage());

            return false;
        }
    }

    public function deletarMarcaProduto(string $id): bool
    {
        try {
            MarcaProduto::destroy($id);

            return true;
        } catch (Exception $e) {
            Log::error('Erro ao atualizar registro: ' . $e->getMessage());

            return false;
        }

    }
}
