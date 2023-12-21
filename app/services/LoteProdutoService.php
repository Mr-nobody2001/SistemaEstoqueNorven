<?php

namespace App\services;

use App\Http\Requests\loteProduto\AtualizarLoteProdutoRequest;
use App\Http\Requests\loteProduto\CriarLoteProdutoRequest;
use App\Models\LoteProduto;
use App\repositorys\LoteProdutoRepository;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;

class LoteProdutoService
{
    public function __construct(private readonly LoteProdutoRepository $loteProdutoRepository)
    {
    }

    public function listarTodosLotes(): LengthAwarePaginator
    {
        return LoteProduto::orderBy('id')->paginate(20);
    }

    public function encontrarLoteId(string $id): LoteProduto
    {
        return LoteProduto::where('id', $id)->first();
    }

    public function encontrarLoteNumero(string $numeroLote): LengthAwarePaginator
    {
        return $this->loteProdutoRepository->encontrarLoteNumero($numeroLote);
    }

    public function criarLoteProduto(CriarLoteProdutoRequest $request)
    {
        try {
            $requestValidada = $request->validated();

            LoteProduto::create($requestValidada);
        } catch (Exception $e) {
            Log::error('Erro ao criar registro: ' . $e->getMessage());

            return false;
        }

        return true;
    }

    public function atualizarLoteProduto(AtualizarLoteProdutoRequest $request): bool
    {
        try {
            $id = $request->id;

            $requestValidada = $request->validated();

            LoteProduto::where('id', $id)
                ->update($requestValidada);

            return true;
        } catch (Exception $e) {
            Log::error('Erro ao atualizar registro: ' . $e->getMessage());

            return false;
        }
    }

    public function deletarLoteProduto(string $id): bool
    {
        try {
            LoteProduto::destroy($id);

            return true;
        } catch (Exception $e) {
            Log::error('Erro ao atualizar registro: ' . $e->getMessage());

            return false;
        }

    }
}
