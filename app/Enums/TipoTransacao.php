<?php

namespace App\Enums;

use ReflectionClass;

class TipoTransacao
{
    const VENDA = 'v';
    const COMPRA = 'c';
    const BAIXA = 'b';

    public static function getConstants(): array
    {
        return (new ReflectionClass(__CLASS__))->getConstants();
    }
}
