<?php

namespace App\repositorys;

use App\Models\CategoriaProduto;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

class CategoriaProdutoRepository
{
    public function encontrarCategoriasNome(string $nomeCategoria): LengthAwarePaginator
    {
        return CategoriaProduto::query()->when($nomeCategoria, function (Builder $builder) use ($nomeCategoria) {
            $builder->where('nome_categoria', 'ilike', "%$nomeCategoria%");
        })->paginate(20);
    }
}
