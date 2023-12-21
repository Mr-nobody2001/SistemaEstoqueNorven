<?php

namespace App\repositorys;

use App\Models\MarcaProduto;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

class MarcaProdutoRepository
{
    public function encontrarMarcasNome(string $nomeMarca): LengthAwarePaginator
    {
        return MarcaProduto::query()->when($nomeMarca, function (Builder $builder) use ($nomeMarca) {
            $builder->where('nome_marca', 'ilike', "%$nomeMarca%")->orderBy('id');
        })->paginate(20);
    }
}
