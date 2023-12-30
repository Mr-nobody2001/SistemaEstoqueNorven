<?php

namespace App\services;

use App\Http\Requests\registroEstoque\AtualizarRegistroEstoqueRequest;
use App\Http\Requests\registroEstoque\CriarRegistroEstoqueRequest;
use App\Models\RegistroEstoque;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;

class RegistroEstoqueService
{
    public function listarTodosRegistros(): LengthAwarePaginator
    {
        return RegistroEstoque::orderBy('id')->paginate(20);
    }

    public function encontrarRegistroEstoqueId(string $id): RegistroEstoque
    {
        return RegistroEstoque::where('id', $id)->first();
    }

    public function encontrarRegistroEstoqueDataRegistro(string $dataRegistro): Collection
    {
        return RegistroEstoque::where('data_registro', 'ilike', '%' . $dataRegistro . '%')->get();
    }

    public function criarRegistroEstoque(CriarRegistroEstoqueRequest $request): bool
    {
        try {
            $requestValidada = $request->validated();

            RegistroEstoque::create($requestValidada);
        } catch (Exception $e) {
            Log::error('Erro ao criar registro: ' . $e->getMessage());

            return false;
        }

        return true;
    }

    public function atualizarRegistroEstoque(AtualizarRegistroEstoqueRequest $request): bool
    {
        try {
            $id = $request->id;

            $requestValidada = $request->validated();

            RegistroEstoque::where('id', $id)
                ->update($requestValidada);

            return true;
        } catch (Exception $e) {
            Log::error('Erro ao atualizar registro: ' . $e->getMessage());

            return false;
        }
    }

    public function deletarRegistroEstoque(string $id): bool
    {
        try {
            RegistroEstoque::destroy($id);

            return true;
        } catch (Exception $e) {
            Log::error('Erro ao atualizar registro: ' . $e->getMessage());

            return false;
        }

    }
}
