<?php

namespace App\Domains\Inscricao\States;

use App\Domains\Inscricao\Models\Inscricao;
use App\Domains\Inscricao\States\StateInscricao;
use App\Domains\Inscricao\Enums\StatusInscricaoEnum;
use App\Domains\Inscricao\Services\InscricaoService;

class InscricaoDeferida extends StateInscricao
{

    private $service;

    public function __construct(Inscricao $inscricao)
    {
        parent::__construct($inscricao);
        $this->service = new InscricaoService($inscricao);
    }

    public function getId(): int
    {
        return StatusInscricaoEnum::DEFERIDA();
    }

    public function indeferirInscricao(): void
    {
        $this->service->AlterarStatus(new InscricaoIndeferida($this->inscricao));
    }
    
    public function aprovarInscricao(): void
    {
        $this->service->AlterarStatus(new InscricaoAprovada($this->inscricao));
    }
}
