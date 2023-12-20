<?php

namespace App\repositorys;

use App\Models\FornecedorProduto;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

class FornecedorProdutoRepository
{
    public function encontrarFornecedorNome(string $nomeFornecedor): LengthAwarePaginator
    {
        return FornecedorProduto::query()->when($nomeFornecedor, function (Builder $builder) use ($nomeFornecedor) {
            $builder->where('nome_fornecedor', 'ilike', "%$nomeFornecedor%");
        })->paginate(20);
    }
}
