<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Produto extends Model
{
    use HasFactory;

    public const CREATED_AT = 'data_cadastro';

    protected $fillable = [
        'codigo_produto',
        'nome_produto',
        'descricao_produto',
        'unidade_medida',
        'informacoes_nutricionais',
        'categoria_id',
        'marca_id',
        'caminho_imagem'
    ];

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(CategoriaProduto::class);
    }

    public function marca(): BelongsTo
    {
        return $this->belongsTo(MarcaProduto::class);
    }

    public function registros(): HasMany
    {
        return $this->hasMany(RegistroEstoque::class);
    }
}
