<?php

namespace App\Domains\Inscricao\Enums;

class StatusInscricaoEnum
{
    /** @var int */
    private const PEDENTE = 1;
    /** @var int */
    private const CONFIRMADA = 2;
    /** @var int */
    private const DEFERIDA = 3;
    /** @var int */
    private const INDEFERIDA = 4;
    /** @var int */
    private const APROVADA = 5;

    public static function PEDENTE()
    {
        return self::PEDENTE;
    }
    
    public static function CONFIRMADA()
    {
        return self::CONFIRMADA;
    }
    
    public static function DEFERIDA()
    {
        return self::DEFERIDA;
    }

    public static function INDEFERIDA()
    {
        return self::INDEFERIDA;
    }
    
    public static function APROVADA()
    {
        return self::APROVADA;
    }
}
