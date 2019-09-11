<?php

namespace Tests\APIs;

use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Material;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MaterialApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_material()
    {
        $material = factory(Material::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/materiais', $material
        );

        $this->assertApiResponse($material);
    }

    /**
     * @test
     */
    public function test_read_material()
    {
        $material = factory(Material::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/materiais/'.$material->id
        );

        $this->assertApiResponse($material->toArray());
    }

    /**
     * @test
     */
    public function test_update_material()
    {
        $material = factory(Material::class)->create();
        $editedMaterial = factory(Material::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/materiais/'.$material->id,
            $editedMaterial
        );

        $this->assertApiResponse($editedMaterial);
    }

    /**
     * @test
     */
    public function test_delete_material()
    {
        $material = factory(Material::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/materiais/'.$material->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/materiais/'.$material->id
        );

        $this->response->assertStatus(404);
    }
}
