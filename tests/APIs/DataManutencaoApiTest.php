<?php

namespace Tests\APIs;

use App\Models\DataManutencao;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\ApiTestTrait;
use Tests\TestCase;

class DataManutencaoApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_data_manutencao()
    {
        $dataManutencao = factory(DataManutencao::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/datas_manutencoes', $dataManutencao
        );

        $this->assertApiResponse($dataManutencao);
    }

    /**
     * @test
     */
    public function test_read_data_manutencao()
    {
        $dataManutencao = factory(DataManutencao::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/datas_manutencoes/'.$dataManutencao->id
        );

        $this->assertApiResponse($dataManutencao->toArray());
    }

    /**
     * @test
     */
    public function test_update_data_manutencao()
    {
        $dataManutencao = factory(DataManutencao::class)->create();
        $editedDataManutencao = factory(DataManutencao::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/datas_manutencoes/'.$dataManutencao->id,
            $editedDataManutencao
        );

        $this->assertApiResponse($editedDataManutencao);
    }

    /**
     * @test
     */
    public function test_delete_data_manutencao()
    {
        $dataManutencao = factory(DataManutencao::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/datas_manutencoes/'.$dataManutencao->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/datas_manutencoes/'.$dataManutencao->id
        );

        $this->response->assertStatus(404);
    }
}
