<?php

namespace Tests\Repositories;

use App\Models\QuantidadeMinima;
use App\Repositories\QuantidadeMinimaRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\ApiTestTrait;
use Tests\TestCase;

class QuantidadeMinimaRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var QuantidadeMinimaRepository
     */
    protected $quantidadeMinimaRepo;

    public function setUp(): void
    {
        parent::setUp();
        $this->quantidadeMinimaRepo = \App::make(QuantidadeMinimaRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_quantidade_minima()
    {
        $quantidadeMinima = factory(QuantidadeMinima::class)->make()->toArray();

        $createdQuantidadeMinima = $this->quantidadeMinimaRepo->create($quantidadeMinima);

        $createdQuantidadeMinima = $createdQuantidadeMinima->toArray();
        $this->assertArrayHasKey('id', $createdQuantidadeMinima);
        $this->assertNotNull($createdQuantidadeMinima['id'], 'Created QuantidadeMinima must have id specified');
        $this->assertNotNull(QuantidadeMinima::find($createdQuantidadeMinima['id']), 'QuantidadeMinima with given id must be in DB');
        $this->assertModelData($quantidadeMinima, $createdQuantidadeMinima);
    }

    /**
     * @test read
     */
    public function test_read_quantidade_minima()
    {
        $quantidadeMinima = factory(QuantidadeMinima::class)->create();

        $dbQuantidadeMinima = $this->quantidadeMinimaRepo->find($quantidadeMinima->id);

        $dbQuantidadeMinima = $dbQuantidadeMinima->toArray();
        $this->assertModelData($quantidadeMinima->toArray(), $dbQuantidadeMinima);
    }

    /**
     * @test update
     */
    public function test_update_quantidade_minima()
    {
        $quantidadeMinima = factory(QuantidadeMinima::class)->create();
        $fakeQuantidadeMinima = factory(QuantidadeMinima::class)->make()->toArray();

        $updatedQuantidadeMinima = $this->quantidadeMinimaRepo->update($fakeQuantidadeMinima, $quantidadeMinima->id);

        $this->assertModelData($fakeQuantidadeMinima, $updatedQuantidadeMinima->toArray());
        $dbQuantidadeMinima = $this->quantidadeMinimaRepo->find($quantidadeMinima->id);
        $this->assertModelData($fakeQuantidadeMinima, $dbQuantidadeMinima->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_quantidade_minima()
    {
        $quantidadeMinima = factory(QuantidadeMinima::class)->create();

        $resp = $this->quantidadeMinimaRepo->delete($quantidadeMinima->id);

        $this->assertTrue($resp);
        $this->assertNull(QuantidadeMinima::find($quantidadeMinima->id), 'QuantidadeMinima should not exist in DB');
    }
}
