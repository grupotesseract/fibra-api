<?php

namespace Tests\Repositories;

use App\Models\DataManutencao;
use App\Repositories\DataManutencaoRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\ApiTestTrait;
use Tests\TestCase;

class DataManutencaoRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var DataManutencaoRepository
     */
    protected $dataManutencaoRepo;

    public function setUp(): void
    {
        parent::setUp();
        $this->dataManutencaoRepo = \App::make(DataManutencaoRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_data_manutencao()
    {
        $dataManutencao = factory(DataManutencao::class)->make()->toArray();

        $createdDataManutencao = $this->dataManutencaoRepo->create($dataManutencao);

        $createdDataManutencao = $createdDataManutencao->toArray();
        $this->assertArrayHasKey('id', $createdDataManutencao);
        $this->assertNotNull($createdDataManutencao['id'], 'Created DataManutencao must have id specified');
        $this->assertNotNull(DataManutencao::find($createdDataManutencao['id']), 'DataManutencao with given id must be in DB');
        $this->assertModelData($dataManutencao, $createdDataManutencao);
    }

    /**
     * @test read
     */
    public function test_read_data_manutencao()
    {
        $dataManutencao = factory(DataManutencao::class)->create();

        $dbDataManutencao = $this->dataManutencaoRepo->find($dataManutencao->id);

        $dbDataManutencao = $dbDataManutencao->toArray();
        $this->assertModelData($dataManutencao->toArray(), $dbDataManutencao);
    }

    /**
     * @test update
     */
    public function test_update_data_manutencao()
    {
        $dataManutencao = factory(DataManutencao::class)->create();
        $fakeDataManutencao = factory(DataManutencao::class)->make()->toArray();

        $updatedDataManutencao = $this->dataManutencaoRepo->update($fakeDataManutencao, $dataManutencao->id);

        $this->assertModelData($fakeDataManutencao, $updatedDataManutencao->toArray());
        $dbDataManutencao = $this->dataManutencaoRepo->find($dataManutencao->id);
        $this->assertModelData($fakeDataManutencao, $dbDataManutencao->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_data_manutencao()
    {
        $dataManutencao = factory(DataManutencao::class)->create();

        $resp = $this->dataManutencaoRepo->delete($dataManutencao->id);

        $this->assertTrue($resp);
        $this->assertNull(DataManutencao::find($dataManutencao->id), 'DataManutencao should not exist in DB');
    }
}
