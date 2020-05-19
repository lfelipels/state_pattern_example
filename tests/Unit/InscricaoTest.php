<?php

namespace Test\Unit;

use PHPUnit\Framework\TestCase;
use App\Domains\Candidato\Candidato;
use App\Domains\Candidato\Diploma;
use App\Domains\Inscricao\Models\Inscricao;

class InscricaoTest extends TestCase
{

    private $inscricao;

    public function setUp(): void
    {
        $candidato = new Candidato('Felipe', new Diploma('UNILAB'));
        $this->inscricao = new Inscricao($candidato);
        $this->inscricao->salvar();
    }

    public function testConfirmarInscricao()
    {
        $this->inscricao->confirmar();
        $this->assertTrue($this->inscricao->estarConfirmada());
    }

    public function testNaoConfirmarInscricaoNaoFinalizada()
    {
        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage('Finalize o processo de inscrição');
        $inscricao = new Inscricao(new Candidato('Felipe'));
        $inscricao->salvar();
        $inscricao->confirmar();
    }

    public function testDeferirInscricao()
    {
        $this->inscricao->confirmar();
        $this->inscricao->deferir();
        $this->assertTrue($this->inscricao->estarDeferida());
    }

    public function testNaoDeferirInscricaoNaoConfirmada()
    {
        $this->expectException(\DomainException::class);
        // $this->expectExceptionMessage('Finalize o processo de inscrição');
        $this->inscricao->deferir();
    }

    public function testNaoIndeferirInscricaoNaoConfirmada()
    {
        $this->expectException(\DomainException::class);
        // $this->expectExceptionMessage('Finalize o processo de inscrição');
        $this->inscricao->indeferir();
    }

    public function testIndeferirInscricao()
    {
        $this->inscricao->confirmar();
        $this->inscricao->indeferir();
        $this->assertTrue($this->inscricao->estarIndeferida());
    }

    public function testDeferirUmaInscricaoindeferida()
    {
        $this->inscricao->confirmar();
        $this->inscricao->indeferir();
        $this->inscricao->deferir();
        $this->assertTrue($this->inscricao->estarDeferida());
    }

    public function testIndeferirUmaInscricaoDeferida()
    {
        $this->inscricao->confirmar();
        $this->inscricao->deferir();
        $this->inscricao->indeferir();
        $this->assertTrue($this->inscricao->estarIndeferida());
    }

    public function testAprovarInscricaoDeferida()
    {
        $this->inscricao->confirmar();
        $this->inscricao->deferir();
        $this->inscricao->aprovar();
        $this->assertTrue($this->inscricao->estarAprovada());
    }

    /** @dataProvider inscricoesNaoDeferidas */
    public function testNaoAprovarInscricoesNaoDeferidas(array $inscricoes)
    {
        foreach ($inscricoes as $inscricao) {
            $this->expectException(\DomainException::class);
            // $this->expectExceptionMessage('Finalize o processo de inscrição');
            $inscricao->aprovar();
        }
    }

    public function inscricoesNaoDeferidas()
    {
        $candidato = new Candidato('Felipe', new Diploma('UNILAB'));
        $pendente = new Inscricao($candidato);
        $pendente->salvar();

        $confirmada = (new Inscricao($candidato))
            ->salvar()
            ->confirmar();

        $indeferida = (new Inscricao($candidato))
            ->salvar()
            ->confirmar()
            ->indeferir();
        return [
            [
                "naodeferidas" => [
                    $pendente, $confirmada, $indeferida
                ]
            ]
        ];
    }
}
