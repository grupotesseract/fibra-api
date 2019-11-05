<?php

namespace Tests\APIs;

use App\Models\TipoMaterial;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\ApiTestTrait;
use Tests\TestCase;

class TipoMaterialApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_tipo_material()
    {
        $tipoMaterial = factory(TipoMaterial::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/tipos_materiais', $tipoMaterial
        );

        $this->assertApiResponse($tipoMaterial);
    }

    /**
     * @test
     */
    public function test_read_tipo_material()
    {
        $tipoMaterial = factory(TipoMaterial::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/tipos_materiais/'.$tipoMaterial->id
        );

        $this->assertApiResponse($tipoMaterial->toArray());
    }

    /**
     * @test
     */
    public function test_update_tipo_material()
    {
        $tipoMaterial = factory(TipoMaterial::class)->create();
        $editedTipoMaterial = factory(TipoMaterial::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/tipos_materiais/'.$tipoMaterial->id,
            $editedTipoMaterial
        );

        $this->assertApiResponse($editedTipoMaterial);
    }

    /**
     * @test
     */
    public function test_delete_tipo_material()
    {
        $tipoMaterial = factory(TipoMaterial::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/tipos_materiais/'.$tipoMaterial->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/tipos_materiais/'.$tipoMaterial->id
        );

        $this->response->assertStatus(404);
    }
}
