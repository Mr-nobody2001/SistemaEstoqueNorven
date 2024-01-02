<?php

namespace App\Enums;

use ReflectionClass;

class UnidadeMedidaMassa
{
    public const MILIGRAMA = 'mg';
    public const GRAMA = 'g';
    public const QUILOGRAMA = 'kg';

    public static function getConstants(): array
    {
        return (new ReflectionClass(__CLASS__))->getConstants();
    }
}
