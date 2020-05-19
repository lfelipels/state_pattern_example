<?php

namespace App\Domains\Inscricao\States;

use App\Domains\Inscricao\States\StateInscricao;
use App\Domains\Inscricao\Enums\StatusInscricaoEnum;

class InscricaoPendente extends StateInscricao
{
    public function getId(): int
    {
        return StatusInscricaoEnum::PEDENTE();
    }
    
    public function confirmarInscricao(): void
    {
        if(!$this->inscricao->estarFinalizada()){
            throw new \DomainException('Finalize o processo de inscrição');
        }
        
        $this->inscricao->gerarNumero();
        $this->inscricao->salvar();
        $this->inscricao->alterarState(new InscricaoConfirmada($this->inscricao));
    }
}
