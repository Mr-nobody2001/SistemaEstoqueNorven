<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoteProduto extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero_lote',
        'preco_custo',
        'data_validade',
        'fornecedor_id'
    ];

    public function fornecedor()
    {
        return $this->belongsTo(FornecedorProduto::class);
    }
}
