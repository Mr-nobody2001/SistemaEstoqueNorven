<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FornecedorProduto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome_fornecedor',
        'email',
        'telefone',
        'cnpj',
        'cpf',
        'fornecedor_ativo',
    ];

    public function lotes(): HasMany
    {
        return $this->hasMany(LoteProduto::class);
    }
}
