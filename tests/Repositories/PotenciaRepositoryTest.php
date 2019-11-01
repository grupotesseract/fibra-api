<?php

namespace Tests\Repositories;

use App\Models\Potencia;
use App\Repositories\PotenciaRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\ApiTestTrait;
use Tests\TestCase;

class PotenciaRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var PotenciaRepository
     */
    protected $potenciaRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->potenciaRepo = \App::make(PotenciaRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_potencia()
    {
        $potencia = factory(Potencia::class)->make()->toArray();

        $createdPotencia = $this->potenciaRepo->create($potencia);

        $createdPotencia = $createdPotencia->toArray();
        $this->assertArrayHasKey('id', $createdPotencia);
        $this->assertNotNull($createdPotencia['id'], 'Created Potencia must have id specified');
        $this->assertNotNull(Potencia::find($createdPotencia['id']), 'Potencia with given id must be in DB');
        $this->assertModelData($potencia, $createdPotencia);
    }

    /**
     * @test read
     */
    public function test_read_potencia()
    {
        $potencia = factory(Potencia::class)->create();

        $dbPotencia = $this->potenciaRepo->find($potencia->id);

        $dbPotencia = $dbPotencia->toArray();
        $this->assertModelData($potencia->toArray(), $dbPotencia);
    }

    /**
     * @test update
     */
    public function test_update_potencia()
    {
        $potencia = factory(Potencia::class)->create();
        $fakePotencia = factory(Potencia::class)->make()->toArray();

        $updatedPotencia = $this->potenciaRepo->update($fakePotencia, $potencia->id);

        $this->assertModelData($fakePotencia, $updatedPotencia->toArray());
        $dbPotencia = $this->potenciaRepo->find($potencia->id);
        $this->assertModelData($fakePotencia, $dbPotencia->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_potencia()
    {
        $potencia = factory(Potencia::class)->create();

        $resp = $this->potenciaRepo->delete($potencia->id);

        $this->assertTrue($resp);
        $this->assertNull(Potencia::find($potencia->id), 'Potencia should not exist in DB');
    }
}
