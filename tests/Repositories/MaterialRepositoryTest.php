<?php

namespace Tests\Repositories;

use App\Models\Material;
use App\Repositories\MaterialRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\ApiTestTrait;
use Tests\TestCase;

class MaterialRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var MaterialRepository
     */
    protected $materialRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->materialRepo = \App::make(MaterialRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_material()
    {
        $material = factory(Material::class)->make()->toArray();

        $createdMaterial = $this->materialRepo->create($material);

        $createdMaterial = $createdMaterial->toArray();
        $this->assertArrayHasKey('id', $createdMaterial);
        $this->assertNotNull($createdMaterial['id'], 'Created Material must have id specified');
        $this->assertNotNull(Material::find($createdMaterial['id']), 'Material with given id must be in DB');
        $this->assertModelData($material, $createdMaterial);
    }

    /**
     * @test read
     */
    public function test_read_material()
    {
        $material = factory(Material::class)->create();

        $dbMaterial = $this->materialRepo->find($material->id);

        $dbMaterial = $dbMaterial->toArray();
        $this->assertModelData($material->toArray(), $dbMaterial);
    }

    /**
     * @test update
     */
    public function test_update_material()
    {
        $material = factory(Material::class)->create();
        $fakeMaterial = factory(Material::class)->make()->toArray();

        $updatedMaterial = $this->materialRepo->update($fakeMaterial, $material->id);

        $this->assertModelData($fakeMaterial, $updatedMaterial->toArray());
        $dbMaterial = $this->materialRepo->find($material->id);
        $this->assertModelData($fakeMaterial, $dbMaterial->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_material()
    {
        $material = factory(Material::class)->create();

        $resp = $this->materialRepo->delete($material->id);

        $this->assertTrue($resp);
        $this->assertNull(Material::find($material->id), 'Material should not exist in DB');
    }
}
