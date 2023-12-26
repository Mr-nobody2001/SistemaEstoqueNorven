<?php

namespace App\Enums;

use ReflectionClass;

class TipoTransacao
{
    const VENDA = 'venda';
    const COMPRA = 'compra';
    const BAIXA = 'baixa';

    public static function getConstants(): array
    {
        return (new ReflectionClass(__CLASS__))->getConstants();
    }
}
