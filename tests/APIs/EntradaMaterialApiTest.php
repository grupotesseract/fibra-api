<?php

namespace Tests\APIs;

use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\EntradaMaterial;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EntradaMaterialApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_entrada_material()
    {
        $entradaMaterial = factory(EntradaMaterial::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/entradas_materiais', $entradaMaterial
        );

        $this->assertApiResponse($entradaMaterial);
    }

    /**
     * @test
     */
    public function test_read_entrada_material()
    {
        $entradaMaterial = factory(EntradaMaterial::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/entradas_materiais/'.$entradaMaterial->id
        );

        $this->assertApiResponse($entradaMaterial->toArray());
    }

    /**
     * @test
     */
    public function test_update_entrada_material()
    {
        $entradaMaterial = factory(EntradaMaterial::class)->create();
        $editedEntradaMaterial = factory(EntradaMaterial::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/entradas_materiais/'.$entradaMaterial->id,
            $editedEntradaMaterial
        );

        $this->assertApiResponse($editedEntradaMaterial);
    }

    /**
     * @test
     */
    public function test_delete_entrada_material()
    {
        $entradaMaterial = factory(EntradaMaterial::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/entradas_materiais/'.$entradaMaterial->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/entradas_materiais/'.$entradaMaterial->id
        );

        $this->response->assertStatus(404);
    }
}
