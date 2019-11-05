<?php

namespace Tests\APIs;

use App\Models\Estoque;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\ApiTestTrait;
use Tests\TestCase;

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
            '/api/estoques', $estoque
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
            '/api/estoques/'.$estoque->id
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
            '/api/estoques/'.$estoque->id,
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
             '/api/estoques/'.$estoque->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/estoques/'.$estoque->id
        );

        $this->response->assertStatus(404);
    }
}
