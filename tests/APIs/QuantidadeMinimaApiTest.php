<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\QuantidadeMinima;

class QuantidadeMinimaApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_quantidade_minima()
    {
        $quantidadeMinima = factory(QuantidadeMinima::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/quantidades_minimas', $quantidadeMinima
        );

        $this->assertApiResponse($quantidadeMinima);
    }

    /**
     * @test
     */
    public function test_read_quantidade_minima()
    {
        $quantidadeMinima = factory(QuantidadeMinima::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/quantidades_minimas/'.$quantidadeMinima->id
        );

        $this->assertApiResponse($quantidadeMinima->toArray());
    }

    /**
     * @test
     */
    public function test_update_quantidade_minima()
    {
        $quantidadeMinima = factory(QuantidadeMinima::class)->create();
        $editedQuantidadeMinima = factory(QuantidadeMinima::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/quantidades_minimas/'.$quantidadeMinima->id,
            $editedQuantidadeMinima
        );

        $this->assertApiResponse($editedQuantidadeMinima);
    }

    /**
     * @test
     */
    public function test_delete_quantidade_minima()
    {
        $quantidadeMinima = factory(QuantidadeMinima::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/quantidades_minimas/'.$quantidadeMinima->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/quantidades_minimas/'.$quantidadeMinima->id
        );

        $this->response->assertStatus(404);
    }
}
