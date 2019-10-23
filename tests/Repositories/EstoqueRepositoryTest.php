<?php namespace Tests\Repositories;

use App\Models\Estoque;
use App\Repositories\EstoqueRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class EstoqueRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var EstoqueRepository
     */
    protected $estoqueRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->estoqueRepo = \App::make(EstoqueRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_estoque()
    {
        $estoque = factory(Estoque::class)->make()->toArray();

        $createdEstoque = $this->estoqueRepo->create($estoque);

        $createdEstoque = $createdEstoque->toArray();
        $this->assertArrayHasKey('id', $createdEstoque);
        $this->assertNotNull($createdEstoque['id'], 'Created Estoque must have id specified');
        $this->assertNotNull(Estoque::find($createdEstoque['id']), 'Estoque with given id must be in DB');
        $this->assertModelData($estoque, $createdEstoque);
    }

    /**
     * @test read
     */
    public function test_read_estoque()
    {
        $estoque = factory(Estoque::class)->create();

        $dbEstoque = $this->estoqueRepo->find($estoque->id);

        $dbEstoque = $dbEstoque->toArray();
        $this->assertModelData($estoque->toArray(), $dbEstoque);
    }

    /**
     * @test update
     */
    public function test_update_estoque()
    {
        $estoque = factory(Estoque::class)->create();
        $fakeEstoque = factory(Estoque::class)->make()->toArray();

        $updatedEstoque = $this->estoqueRepo->update($fakeEstoque, $estoque->id);

        $this->assertModelData($fakeEstoque, $updatedEstoque->toArray());
        $dbEstoque = $this->estoqueRepo->find($estoque->id);
        $this->assertModelData($fakeEstoque, $dbEstoque->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_estoque()
    {
        $estoque = factory(Estoque::class)->create();

        $resp = $this->estoqueRepo->delete($estoque->id);

        $this->assertTrue($resp);
        $this->assertNull(Estoque::find($estoque->id), 'Estoque should not exist in DB');
    }
}
