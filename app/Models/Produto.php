<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    const CREATED_AT = 'data_cadastro';

    protected $fillable = [
        'codigo_produto',
        'descricao_produto',
        'unidade_medida',
        'informacoes_nutricionais',
        'categoria_id',
        'marca_id',
    ];
}
