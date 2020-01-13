<?php

namespace Tests\Repositories;

use App\Models\Planta;
use App\Repositories\PlantaRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\ApiTestTrait;
use Tests\TestCase;

class PlantaRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var PlantaRepository
     */
    protected $plantaRepo;

    public function setUp(): void
    {
        parent::setUp();
        $this->plantaRepo = \App::make(PlantaRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_planta()
    {
        $planta = factory(Planta::class)->make()->toArray();

        $createdPlanta = $this->plantaRepo->create($planta);

        $createdPlanta = $createdPlanta->toArray();
        $this->assertArrayHasKey('id', $createdPlanta);
        $this->assertNotNull($createdPlanta['id'], 'Created Planta must have id specified');
        $this->assertNotNull(Planta::find($createdPlanta['id']), 'Planta with given id must be in DB');
        $this->assertModelData($planta, $createdPlanta);
    }

    /**
     * @test read
     */
    public function test_read_planta()
    {
        $planta = factory(Planta::class)->create();

        $dbPlanta = $this->plantaRepo->find($planta->id);

        $dbPlanta = $dbPlanta->toArray();
        $this->assertModelData($planta->toArray(), $dbPlanta);
    }

    /**
     * @test update
     */
    public function test_update_planta()
    {
        $planta = factory(Planta::class)->create();
        $fakePlanta = factory(Planta::class)->make()->toArray();

        $updatedPlanta = $this->plantaRepo->update($fakePlanta, $planta->id);

        $this->assertModelData($fakePlanta, $updatedPlanta->toArray());
        $dbPlanta = $this->plantaRepo->find($planta->id);
        $this->assertModelData($fakePlanta, $dbPlanta->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_planta()
    {
        $planta = factory(Planta::class)->create();

        $resp = $this->plantaRepo->delete($planta->id);

        $this->assertTrue($resp);
        $this->assertNull(Planta::find($planta->id), 'Planta should not exist in DB');
    }
}
