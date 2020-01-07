<?php

namespace Tests\Repositories;

use App\Models\EntradaMaterial;
use App\Repositories\EntradaMaterialRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\ApiTestTrait;
use Tests\TestCase;

class EntradaMaterialRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var EntradaMaterialRepository
     */
    protected $entradaMaterialRepo;

    public function setUp(): void
    {
        parent::setUp();
        $this->entradaMaterialRepo = \App::make(EntradaMaterialRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_entrada_material()
    {
        $entradaMaterial = factory(EntradaMaterial::class)->make()->toArray();

        $createdEntradaMaterial = $this->entradaMaterialRepo->create($entradaMaterial);

        $createdEntradaMaterial = $createdEntradaMaterial->toArray();
        $this->assertArrayHasKey('id', $createdEntradaMaterial);
        $this->assertNotNull($createdEntradaMaterial['id'], 'Created EntradaMaterial must have id specified');
        $this->assertNotNull(EntradaMaterial::find($createdEntradaMaterial['id']), 'EntradaMaterial with given id must be in DB');
        $this->assertModelData($entradaMaterial, $createdEntradaMaterial);
    }

    /**
     * @test read
     */
    public function test_read_entrada_material()
    {
        $entradaMaterial = factory(EntradaMaterial::class)->create();

        $dbEntradaMaterial = $this->entradaMaterialRepo->find($entradaMaterial->id);

        $dbEntradaMaterial = $dbEntradaMaterial->toArray();
        $this->assertModelData($entradaMaterial->toArray(), $dbEntradaMaterial);
    }

    /**
     * @test update
     */
    public function test_update_entrada_material()
    {
        $entradaMaterial = factory(EntradaMaterial::class)->create();
        $fakeEntradaMaterial = factory(EntradaMaterial::class)->make()->toArray();

        $updatedEntradaMaterial = $this->entradaMaterialRepo->update($fakeEntradaMaterial, $entradaMaterial->id);

        $this->assertModelData($fakeEntradaMaterial, $updatedEntradaMaterial->toArray());
        $dbEntradaMaterial = $this->entradaMaterialRepo->find($entradaMaterial->id);
        $this->assertModelData($fakeEntradaMaterial, $dbEntradaMaterial->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_entrada_material()
    {
        $entradaMaterial = factory(EntradaMaterial::class)->create();

        $resp = $this->entradaMaterialRepo->delete($entradaMaterial->id);

        $this->assertTrue($resp);
        $this->assertNull(EntradaMaterial::find($entradaMaterial->id), 'EntradaMaterial should not exist in DB');
    }
}
