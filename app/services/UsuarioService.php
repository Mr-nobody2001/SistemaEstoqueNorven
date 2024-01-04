<?php

namespace App\services;

use App\Http\Requests\usuario\AtualizarUsuarioRequest;
use App\Http\Requests\usuario\CriarUsuarioRequest;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Log;

class UsuarioService
{
    public function criarUsuario(CriarUsuarioRequest $request): bool
    {
        try {
            $requestValidada = $request->validated();

            $requestValidada['password'] = bcrypt($requestValidada['password']);

            User::create($requestValidada);
        } catch (Exception $e) {
            Log::error('Erro ao criar registro: ' . $e->getMessage());

            return false;
        }

        return true;
    }

    public function atualizarUsuario(AtualizarUsuarioRequest $request): bool
    {
        try {
            $id = $request->id;

            $requestValidada = $request->validated();

            $requestValidada['password'] = bcrypt($requestValidada['password']);

            User::where('id', $id)
                ->update($requestValidada);

            return true;
        } catch (Exception $e) {
            Log::error('Erro ao atualizar registro: ' . $e->getMessage());

            return false;
        }
    }

    public function deletarUsuario(string $id): bool
    {
        try {
            User::destroy($id);

            return true;
        } catch (Exception $e) {
            Log::error('Erro ao atualizar registro: ' . $e->getMessage());

            return false;
        }

    }
}
