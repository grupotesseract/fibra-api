<?php

namespace Tests\APIs;

use App\Models\QuantidadeSubstituida;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\ApiTestTrait;
use Tests\TestCase;

class QuantidadeSubstituidaApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_quantidade_substituida()
    {
        $quantidadeSubstituida = factory(QuantidadeSubstituida::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/quantidades_substituidas', $quantidadeSubstituida
        );

        $this->assertApiResponse($quantidadeSubstituida);
    }

    /**
     * @test
     */
    public function test_read_quantidade_substituida()
    {
        $quantidadeSubstituida = factory(QuantidadeSubstituida::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/quantidades_substituidas/'.$quantidadeSubstituida->id
        );

        $this->assertApiResponse($quantidadeSubstituida->toArray());
    }

    /**
     * @test
     */
    public function test_update_quantidade_substituida()
    {
        $quantidadeSubstituida = factory(QuantidadeSubstituida::class)->create();
        $editedQuantidadeSubstituida = factory(QuantidadeSubstituida::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/quantidades_substituidas/'.$quantidadeSubstituida->id,
            $editedQuantidadeSubstituida
        );

        $this->assertApiResponse($editedQuantidadeSubstituida);
    }

    /**
     * @test
     */
    public function test_delete_quantidade_substituida()
    {
        $quantidadeSubstituida = factory(QuantidadeSubstituida::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/quantidades_substituidas/'.$quantidadeSubstituida->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/quantidades_substituidas/'.$quantidadeSubstituida->id
        );

        $this->response->assertStatus(404);
    }
}
