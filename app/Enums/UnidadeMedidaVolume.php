<?php

namespace App\Enums;

use ReflectionClass;

class UnidadeMedidaVolume
{
    public const MILILITRO = 'mL';
    public const LITRO = 'L';
    public static function getConstants(): array
    {
        return (new ReflectionClass(__CLASS__))->getConstants();
    }
}
