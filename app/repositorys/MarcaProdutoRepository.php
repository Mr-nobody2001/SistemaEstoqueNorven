<?php

namespace App\repositorys;

use App\Models\MarcaProduto;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

class MarcaProdutoRepository
{
    public function listarTodasMarcas(Request $request): LengthAwarePaginator
    {
        return MarcaProduto::query()->when($request->marca, function (Builder $builder) use ($request) {
            $builder->where('nome_marca', 'ilike', "%$request->marca%");
        })->paginate(20);
    }

    public function criarMarcaProduto(array $requestValidada): bool
    {
        try {
            MarcaProduto::create($requestValidada);
        } catch (Exception $e) {
            return false;
        }

        return true;
    }
}
