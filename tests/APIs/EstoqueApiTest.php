<?php

namespace Tests\APIs;

use Tests\TestCase;
use App\Models\Estoque;
use Tests\ApiTestTrait;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EstoqueApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_estoque()
    {
        $estoque = factory(Estoque::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/estoque', $estoque
        );

        $this->assertApiResponse($estoque);
    }

    /**
     * @test
     */
    public function test_read_estoque()
    {
        $estoque = factory(Estoque::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/estoque/'.$estoque->id
        );

        $this->assertApiResponse($estoque->toArray());
    }

    /**
     * @test
     */
    public function test_update_estoque()
    {
        $estoque = factory(Estoque::class)->create();
        $editedEstoque = factory(Estoque::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/estoque/'.$estoque->id,
            $editedEstoque
        );

        $this->assertApiResponse($editedEstoque);
    }

    /**
     * @test
     */
    public function test_delete_estoque()
    {
        $estoque = factory(Estoque::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/estoque/'.$estoque->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/estoque/'.$estoque->id
        );

        $this->response->assertStatus(404);
    }
}
