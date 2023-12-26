<?php

namespace App\services;

use App\Http\Requests\registroEstoque\CriarRegistroEstoqueRequest;
use App\Models\RegistroEstoque;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;

class RegistroEstoqueService
{
    public function listarTodosRegistros(): LengthAwarePaginator
    {
        return RegistroEstoque::orderBy('id')->paginate(20);
    }

    public function criarRegistro(CriarRegistroEstoqueRequest $request): bool
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
}
