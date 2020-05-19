<?php

namespace App\Domains\Inscricao\States;

use App\Domains\Inscricao\Models\Inscricao;
use App\Domains\Inscricao\States\StateInscricao;
use App\Domains\Inscricao\Enums\StatusInscricaoEnum;
use App\Domains\Inscricao\Services\InscricaoService;

class InscricaoConfirmada extends StateInscricao
{
    private $service;

    public function __construct(Inscricao $inscricao)
    {
        parent::__construct($inscricao);
        $this->service = new InscricaoService($inscricao);
    }

    public function getId(): int
    {
        return StatusInscricaoEnum::CONFIRMADA();
    }

    public function deferirInscricao(): void
    {
        $this->service->AlterarStatus(new InscricaoDeferida($this->inscricao));
    }
    
    public function indeferirInscricao(): void
    {
        $this->service->AlterarStatus(new InscricaoIndeferida($this->inscricao));
    }
}
