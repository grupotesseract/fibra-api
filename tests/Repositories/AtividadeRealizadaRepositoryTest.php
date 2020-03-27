<?php

namespace Tests\Repositories;

use App\Models\AtividadeRealizada;
use App\Repositories\AtividadeRealizadaRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\ApiTestTrait;
use Tests\TestCase;

class AtividadeRealizadaRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var AtividadeRealizadaRepository
     */
    protected $atividadeRealizadaRepo;

    public function setUp(): void
    {
        parent::setUp();
        $this->atividadeRealizadaRepo = \App::make(AtividadeRealizadaRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_atividade_realizada()
    {
        $atividadeRealizada = factory(AtividadeRealizada::class)->make()->toArray();

        $createdAtividadeRealizada = $this->atividadeRealizadaRepo->create($atividadeRealizada);

        $createdAtividadeRealizada = $createdAtividadeRealizada->toArray();
        $this->assertArrayHasKey('id', $createdAtividadeRealizada);
        $this->assertNotNull($createdAtividadeRealizada['id'], 'Created AtividadeRealizada must have id specified');
        $this->assertNotNull(AtividadeRealizada::find($createdAtividadeRealizada['id']), 'AtividadeRealizada with given id must be in DB');
        $this->assertModelData($atividadeRealizada, $createdAtividadeRealizada);
    }

    /**
     * @test read
     */
    public function test_read_atividade_realizada()
    {
        $atividadeRealizada = factory(AtividadeRealizada::class)->create();

        $dbAtividadeRealizada = $this->atividadeRealizadaRepo->find($atividadeRealizada->id);

        $dbAtividadeRealizada = $dbAtividadeRealizada->toArray();
        $this->assertModelData($atividadeRealizada->toArray(), $dbAtividadeRealizada);
    }

    /**
     * @test update
     */
    public function test_update_atividade_realizada()
    {
        $atividadeRealizada = factory(AtividadeRealizada::class)->create();
        $fakeAtividadeRealizada = factory(AtividadeRealizada::class)->make()->toArray();

        $updatedAtividadeRealizada = $this->atividadeRealizadaRepo->update($fakeAtividadeRealizada, $atividadeRealizada->id);

        $this->assertModelData($fakeAtividadeRealizada, $updatedAtividadeRealizada->toArray());
        $dbAtividadeRealizada = $this->atividadeRealizadaRepo->find($atividadeRealizada->id);
        $this->assertModelData($fakeAtividadeRealizada, $dbAtividadeRealizada->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_atividade_realizada()
    {
        $atividadeRealizada = factory(AtividadeRealizada::class)->create();

        $resp = $this->atividadeRealizadaRepo->delete($atividadeRealizada->id);

        $this->assertTrue($resp);
        $this->assertNull(AtividadeRealizada::find($atividadeRealizada->id), 'AtividadeRealizada should not exist in DB');
    }
}
