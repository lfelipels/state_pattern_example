<?php

namespace App\Domains\Inscricao\Services;

use DateTime;
use App\Domains\Inscricao\Models\Inscricao;

class GeradorNumeroInscricao
{
    private Inscricao $inscricao;

    public function __construct(Inscricao $inscricao)
    {
        $this->inscricao = $inscricao;
    }

    public function __toString()
    {
        
        //Formato do numero de inscrição (12 digitos): yyssuuuuuuid
        //Os 2 primeiros digitos são ano de inscrição
        //Seguido dos segundos (2 digitos) e microsegundos (6 digitos) da hora de inscrição
        //e finalizado com os 2 digitos do id da inscrição
        
        $timestamp = new DateTime();
        //preenche com zero a esquerda caso o id da inscrição seja menor que dois digitos
        $id = trim(str_pad(substr($this->inscricao->getId(), 0, 2), 2, "0", STR_PAD_LEFT));
        $numero = trim($timestamp->format('ysu'));
        $numero.= $id;
        return trim($numero);
    }
}
