<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MarcaProduto extends Model
{
    use HasFactory;

    protected $table = 'marca_produtos';

    protected $fillable = [
        'nome_marca',
    ];

    public function produtos(): HasMany
    {
        return $this->hasMany(Produto::class);
    }
}
