<?php

namespace App\Domains\Inscricao\States;

interface StateIncricaoInterface
{
    public function getId(): int;
    public function confirmarInscricao(): void;
    public function deferirInscricao(): void;
    public function indeferirInscricao(): void;
    public function aprovarInscricao(): void;
}
