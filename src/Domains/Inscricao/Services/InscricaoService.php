<?php

namespace App\Domains\Inscricao\Services;

use App\Domains\Inscricao\Models\Inscricao;
use App\Domains\Inscricao\States\StateIncricaoInterface;

class InscricaoService
{
    private Inscricao $inscricao;

    public function __construct(Inscricao $inscricao = null)
    {
        $this->inscricao = $inscricao;
    }

    public function AlterarStatus(StateIncricaoInterface $state): InscricaoService
    {
        //salva o novo status no banco
        $this->inscricao->alterarState($state);
        return $this;
    }
}
