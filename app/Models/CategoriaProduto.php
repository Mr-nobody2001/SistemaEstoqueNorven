<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CategoriaProduto extends Model
{
    use HasFactory;

    protected $table = 'categoria_produtos';

    protected $fillable = [
        'nome_categoria',
        'descricao_categoria',
        'caminho_imagem',
    ];

    public function produtos(): HasMany
    {
        return $this->hasMany(Produto::class);
    }
}
