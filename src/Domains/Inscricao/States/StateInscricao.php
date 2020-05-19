<?php

namespace App\Domains\Inscricao\States;

use App\Domains\Inscricao\Models\Inscricao;
use App\Domains\Inscricao\States\StateIncricaoInterface;

abstract class StateInscricao implements StateIncricaoInterface
{
    protected Inscricao $inscricao;

    public function __construct(Inscricao $inscricao = null)
    {
        $this->inscricao = $inscricao;
    }

    abstract public function getId(): int;

    public function confirmarInscricao(): void
    {
        throw new \DomainException('Estado invalido');
    }
    
    public function deferirInscricao(): void
    {
        throw new \DomainException('Estado invalido');
    }
    
    public function indeferirInscricao(): void
    {
        throw new \DomainException('Estado invalido');
    }
    
    public function aprovarInscricao(): void
    {
        throw new \DomainException('Estado invalido');
    }
}
