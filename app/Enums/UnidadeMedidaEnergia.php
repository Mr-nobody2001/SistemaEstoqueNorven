<?php

namespace App\Enums;

use ReflectionClass;

class UnidadeMedidaEnergia
{
    public const JOULE = 'J';
    public const QUILOCALORIA = 'kcal';

    public static function getConstants(): array
    {
        return (new ReflectionClass(__CLASS__))->getConstants();
    }
}
