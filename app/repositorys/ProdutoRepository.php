<?php

namespace App\repositorys;

use App\Models\Produto;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

class ProdutoRepository
{
    public function encontrarProdutoNome(string $nomeProduto): LengthAwarePaginator
    {
        return Produto::query()->when($nomeProduto, function (Builder $builder) use ($nomeProduto) {
            $builder->where('nome_produto', 'ilike', "%$nomeProduto%")->orderBy('id');
        })->paginate(20);
    }
}
