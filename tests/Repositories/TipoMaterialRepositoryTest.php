<?php

namespace Tests\Repositories;

use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\TipoMaterial;
use App\Repositories\TipoMaterialRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TipoMaterialRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var TipoMaterialRepository
     */
    protected $tipoMaterialRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->tipoMaterialRepo = \App::make(TipoMaterialRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_tipo_material()
    {
        $tipoMaterial = factory(TipoMaterial::class)->make()->toArray();

        $createdTipoMaterial = $this->tipoMaterialRepo->create($tipoMaterial);

        $createdTipoMaterial = $createdTipoMaterial->toArray();
        $this->assertArrayHasKey('id', $createdTipoMaterial);
        $this->assertNotNull($createdTipoMaterial['id'], 'Created TipoMaterial must have id specified');
        $this->assertNotNull(TipoMaterial::find($createdTipoMaterial['id']), 'TipoMaterial with given id must be in DB');
        $this->assertModelData($tipoMaterial, $createdTipoMaterial);
    }

    /**
     * @test read
     */
    public function test_read_tipo_material()
    {
        $tipoMaterial = factory(TipoMaterial::class)->create();

        $dbTipoMaterial = $this->tipoMaterialRepo->find($tipoMaterial->id);

        $dbTipoMaterial = $dbTipoMaterial->toArray();
        $this->assertModelData($tipoMaterial->toArray(), $dbTipoMaterial);
    }

    /**
     * @test update
     */
    public function test_update_tipo_material()
    {
        $tipoMaterial = factory(TipoMaterial::class)->create();
        $fakeTipoMaterial = factory(TipoMaterial::class)->make()->toArray();

        $updatedTipoMaterial = $this->tipoMaterialRepo->update($fakeTipoMaterial, $tipoMaterial->id);

        $this->assertModelData($fakeTipoMaterial, $updatedTipoMaterial->toArray());
        $dbTipoMaterial = $this->tipoMaterialRepo->find($tipoMaterial->id);
        $this->assertModelData($fakeTipoMaterial, $dbTipoMaterial->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_tipo_material()
    {
        $tipoMaterial = factory(TipoMaterial::class)->create();

        $resp = $this->tipoMaterialRepo->delete($tipoMaterial->id);

        $this->assertTrue($resp);
        $this->assertNull(TipoMaterial::find($tipoMaterial->id), 'TipoMaterial should not exist in DB');
    }
}
