<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarcaProduto extends Model
{
    use HasFactory;

    protected $table = "marca_produtos";

    protected $fillable = [
        'nome_marca',
    ];
}
