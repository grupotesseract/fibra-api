<?php

namespace Tests\Repositories;

use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\QuantidadeSubstituida;
use App\Repositories\QuantidadeSubstituidaRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class QuantidadeSubstituidaRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var QuantidadeSubstituidaRepository
     */
    protected $quantidadeSubstituidaRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->quantidadeSubstituidaRepo = \App::make(QuantidadeSubstituidaRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_quantidade_substituida()
    {
        $quantidadeSubstituida = factory(QuantidadeSubstituida::class)->make()->toArray();

        $createdQuantidadeSubstituida = $this->quantidadeSubstituidaRepo->create($quantidadeSubstituida);

        $createdQuantidadeSubstituida = $createdQuantidadeSubstituida->toArray();
        $this->assertArrayHasKey('id', $createdQuantidadeSubstituida);
        $this->assertNotNull($createdQuantidadeSubstituida['id'], 'Created QuantidadeSubstituida must have id specified');
        $this->assertNotNull(QuantidadeSubstituida::find($createdQuantidadeSubstituida['id']), 'QuantidadeSubstituida with given id must be in DB');
        $this->assertModelData($quantidadeSubstituida, $createdQuantidadeSubstituida);
    }

    /**
     * @test read
     */
    public function test_read_quantidade_substituida()
    {
        $quantidadeSubstituida = factory(QuantidadeSubstituida::class)->create();

        $dbQuantidadeSubstituida = $this->quantidadeSubstituidaRepo->find($quantidadeSubstituida->id);

        $dbQuantidadeSubstituida = $dbQuantidadeSubstituida->toArray();
        $this->assertModelData($quantidadeSubstituida->toArray(), $dbQuantidadeSubstituida);
    }

    /**
     * @test update
     */
    public function test_update_quantidade_substituida()
    {
        $quantidadeSubstituida = factory(QuantidadeSubstituida::class)->create();
        $fakeQuantidadeSubstituida = factory(QuantidadeSubstituida::class)->make()->toArray();

        $updatedQuantidadeSubstituida = $this->quantidadeSubstituidaRepo->update($fakeQuantidadeSubstituida, $quantidadeSubstituida->id);

        $this->assertModelData($fakeQuantidadeSubstituida, $updatedQuantidadeSubstituida->toArray());
        $dbQuantidadeSubstituida = $this->quantidadeSubstituidaRepo->find($quantidadeSubstituida->id);
        $this->assertModelData($fakeQuantidadeSubstituida, $dbQuantidadeSubstituida->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_quantidade_substituida()
    {
        $quantidadeSubstituida = factory(QuantidadeSubstituida::class)->create();

        $resp = $this->quantidadeSubstituidaRepo->delete($quantidadeSubstituida->id);

        $this->assertTrue($resp);
        $this->assertNull(QuantidadeSubstituida::find($quantidadeSubstituida->id), 'QuantidadeSubstituida should not exist in DB');
    }
}
