<?php

namespace App\Domains\Inscricao\Models;

use DateTimeImmutable;
use App\Domains\Candidato\Candidato;
use App\Domains\Inscricao\States\InscricaoPendente;
use App\Domains\Inscricao\Enums\StatusInscricaoEnum;
use App\Domains\Inscricao\Services\GeradorNumeroInscricao;
use App\Domains\Inscricao\States\StateIncricaoInterface as State;

class Inscricao
{
    private string $numero;
    private Candidato $candidato;
    private DateTimeImmutable $data;
    private ?State $state;
    private ?int $id;

    public function __construct(
        Candidato $candidato,
        ?State $state = null,
        ?int $id = null,
        ?DateTimeImmutable $data = null
    ) {
        $this->candidato = $candidato;
        $this->data = $data ?? new DateTimeImmutable();
        $this->state = $state ?? new InscricaoPendente($this);
        $this->id = $id;
    }

    public function deferir(): Inscricao
    {
        $this->state->deferirInscricao();
        return $this;
    }

    public function indeferir(): Inscricao
    {
        $this->state->indeferirInscricao();
        return $this;
    }

    public function aprovar(): Inscricao
    {
        $this->state->aprovarInscricao();
        return $this;
    }

    public function confirmar(): Inscricao
    {
        $this->state->confirmarInscricao();
        return $this;
    }

    public function salvar(): Inscricao
    {
        if (!$this->id) {
            $this->id = rand(1, 10000);
        }

        return $this;
    }

    public function estarFinalizada(): bool
    {
        return $this->candidato->possuiDisploma();
    }

    public function estarPendente(): bool
    {
        return $this->state->getId() === StatusInscricaoEnum::PEDENTE();
    }

    public function estarConfirmada(): bool
    {
        return $this->state->getId() === StatusInscricaoEnum::CONFIRMADA();
    }

    public function estarDeferida(): bool
    {
        return $this->state->getId() === StatusInscricaoEnum::DEFERIDA();
    }

    public function estarIndeferida(): bool
    {
        return $this->state->getId() === StatusInscricaoEnum::INDEFERIDA();
    }

    public function estarAprovada(): bool
    {
        return $this->state->getId() === StatusInscricaoEnum::APROVADA();
    }

    public function alterarState(State $novoState): void
    {
        $this->state = $novoState;
    }

    public function gerarNumero(): void
    {
        if (!empty($this->numero)) {
            throw new \DomainException('Número de inscrição do candidato já foi gerado.');
        }
        $this->numero = new GeradorNumeroInscricao($this);
    }

    public function getCandidato(): Candidato
    {
        return $this->candidato;
    }

    public function getData(): DateTimeImmutable
    {
        return $this->data;
    }

    public function getState(): State
    {
        return $this->state;
    }

    public function getNumero(): string
    {
        return $this->numero;
    }

    public function getId(): int
    {
        return $this->id;
    }
}
