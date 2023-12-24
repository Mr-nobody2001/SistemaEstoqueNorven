<?php

namespace App\Enums;

use ReflectionClass;

class UnidadeMedidaMassaVolume
{
    public const MILIGRAMA = 'mg';
    public const GRAMA = 'g';
    public const QUILOGRAMA = 'kg';
    public const MILILITRO = 'mL';
    public const LITRO = 'L';
    public static function getConstants(): array
    {
        return (new ReflectionClass(__CLASS__))->getConstants();
    }
}
