<?php

namespace App\Domains\Inscricao\States;

use App\Domains\Inscricao\States\StateInscricao;
use App\Domains\Inscricao\Enums\StatusInscricaoEnum;

class InscricaoAprovada extends StateInscricao
{
    public function getId(): int
    {
        return StatusInscricaoEnum::APROVADA();
    }
}
