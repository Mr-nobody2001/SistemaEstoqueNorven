<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
