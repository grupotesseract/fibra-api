<?php

namespace Tests\APIs;

use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Potencia;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PotenciaApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_potencia()
    {
        $potencia = factory(Potencia::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/potencias', $potencia
        );

        $this->assertApiResponse($potencia);
    }

    /**
     * @test
     */
    public function test_read_potencia()
    {
        $potencia = factory(Potencia::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/potencias/'.$potencia->id
        );

        $this->assertApiResponse($potencia->toArray());
    }

    /**
     * @test
     */
    public function test_update_potencia()
    {
        $potencia = factory(Potencia::class)->create();
        $editedPotencia = factory(Potencia::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/potencias/'.$potencia->id,
            $editedPotencia
        );

        $this->assertApiResponse($editedPotencia);
    }

    /**
     * @test
     */
    public function test_delete_potencia()
    {
        $potencia = factory(Potencia::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/potencias/'.$potencia->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/potencias/'.$potencia->id
        );

        $this->response->assertStatus(404);
    }
}
