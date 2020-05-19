<?php

namespace App\Domains\Inscricao\States;

use App\Domains\Inscricao\States\StateInscricao;
use App\Domains\Inscricao\States\InscricaoDeferida;
use App\Domains\Inscricao\Enums\StatusInscricaoEnum;
use App\Domains\Inscricao\Services\InscricaoService;

class InscricaoIndeferida extends StateInscricao
{
    public function getId(): int
    {
        return StatusInscricaoEnum::INDEFERIDA();
    }

    public function deferirInscricao(): void
    {
        $service = new InscricaoService($this->inscricao);
        $service->AlterarStatus(new InscricaoDeferida($this->inscricao));
    }
}
