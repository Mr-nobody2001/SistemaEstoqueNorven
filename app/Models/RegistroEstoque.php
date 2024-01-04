<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RegistroEstoque extends Model
{
    use HasFactory;

    public const CREATED_AT = 'data_registro';

    protected $fillable = [
        'tipo_transacao',
        'quantidade_transacao',
        'descricao_produto',
        'valor_transacao',
        'lote_id',
        'produto_id',
    ];

    public function lote(): BelongsTo
    {
        return $this->belongsTo(LoteProduto::class);
    }

    public function produto(): BelongsTo
    {
        return $this->belongsTo(Produto::class);
    }
}
