<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LoteProduto extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero_lote',
        'data_validade',
        'fornecedor_id'
    ];

    public function fornecedor(): BelongsTo
    {
        return $this->belongsTo(FornecedorProduto::class);
    }

    public function registros(): HasMany
    {
        return $this->hasMany(RegistroEstoque::class);
    }
}
