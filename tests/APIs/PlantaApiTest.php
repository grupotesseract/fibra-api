<?php

namespace Tests\APIs;

use App\Models\Planta;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\ApiTestTrait;
use Tests\TestCase;

class PlantaApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_planta()
    {
        $planta = factory(Planta::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/plantas', $planta
        );

        $this->assertApiResponse($planta);
    }

    /**
     * @test
     */
    public function test_read_planta()
    {
        $planta = factory(Planta::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/plantas/'.$planta->id
        );

        $this->assertApiResponse($planta->toArray());
    }

    /**
     * @test
     */
    public function test_update_planta()
    {
        $planta = factory(Planta::class)->create();
        $editedPlanta = factory(Planta::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/plantas/'.$planta->id,
            $editedPlanta
        );

        $this->assertApiResponse($editedPlanta);
    }

    /**
     * @test
     */
    public function test_delete_planta()
    {
        $planta = factory(Planta::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/plantas/'.$planta->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/plantas/'.$planta->id
        );

        $this->response->assertStatus(404);
    }
}
