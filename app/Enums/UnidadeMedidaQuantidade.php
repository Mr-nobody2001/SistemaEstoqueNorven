<?php

namespace App\Enums;

use ReflectionClass;

class UnidadeMedidaQuantidade
{
    public const PACOTE = 'pacote';
    public const DUZIA = 'duzia';
    public const UNIDADE = 'unidade';
    public const FATIA = 'fatia';

    public static function getConstants(): array
    {
        return (new ReflectionClass(__CLASS__))->getConstants();
    }
}
