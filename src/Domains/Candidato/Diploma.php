<?php

namespace App\Domains\Candidato;

class Diploma
{
    private string $instituicao;

    public function __construct(string $instituicao)
    {
        $this->instituicao = $instituicao;
    }

    public function getInstituicao()
    {
        return $this->instituicao;
    }
}
