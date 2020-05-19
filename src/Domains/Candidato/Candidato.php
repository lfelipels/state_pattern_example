<?php

namespace App\Domains\Candidato;

class Candidato
{
    private string $nome;
    private ?Diploma $diploma;

    public function __construct(string $nome, ?Diploma $diploma = null)
    {
        $this->nome = $nome;
        $this->diploma = $diploma;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function possuiDisploma()
    {
        return !is_null($this->diploma);
    }
    
    public function adicionarDiploma(Diploma $diploma): Candidato
    {
        $this->diploma = $diploma;
        return $this;
    }
}
