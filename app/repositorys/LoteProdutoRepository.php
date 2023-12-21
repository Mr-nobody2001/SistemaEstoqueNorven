<?php

namespace App\repositorys;

use App\Models\LoteProduto;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

class LoteProdutoRepository
{
    public function encontrarLoteNumero(string $numeroLote): LengthAwarePaginator
    {
        return LoteProduto::query()->when($numeroLote, function (Builder $builder) use ($numeroLote) {
            $builder->where('numero_lote', 'ilike', "%$numeroLote%")->orderBy('id');
        })->paginate(20);
    }
}

