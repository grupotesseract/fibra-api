<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\ManutencaoCivilEletrica;

class ManutencaoCivilEletricaApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_manutencao_civil_eletrica()
    {
        $manutencaoCivilEletrica = factory(ManutencaoCivilEletrica::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/manutencoes_civil_eletrica', $manutencaoCivilEletrica
        );

        $this->assertApiResponse($manutencaoCivilEletrica);
    }

    /**
     * @test
     */
    public function test_read_manutencao_civil_eletrica()
    {
        $manutencaoCivilEletrica = factory(ManutencaoCivilEletrica::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/manutencoes_civil_eletrica/'.$manutencaoCivilEletrica->id
        );

        $this->assertApiResponse($manutencaoCivilEletrica->toArray());
    }

    /**
     * @test
     */
    public function test_update_manutencao_civil_eletrica()
    {
        $manutencaoCivilEletrica = factory(ManutencaoCivilEletrica::class)->create();
        $editedManutencaoCivilEletrica = factory(ManutencaoCivilEletrica::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/manutencoes_civil_eletrica/'.$manutencaoCivilEletrica->id,
            $editedManutencaoCivilEletrica
        );

        $this->assertApiResponse($editedManutencaoCivilEletrica);
    }

    /**
     * @test
     */
    public function test_delete_manutencao_civil_eletrica()
    {
        $manutencaoCivilEletrica = factory(ManutencaoCivilEletrica::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/manutencoes_civil_eletrica/'.$manutencaoCivilEletrica->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/manutencoes_civil_eletrica/'.$manutencaoCivilEletrica->id
        );

        $this->response->assertStatus(404);
    }
}
