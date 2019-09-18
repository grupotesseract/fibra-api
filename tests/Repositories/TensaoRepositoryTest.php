<?php namespace Tests\Repositories;

use App\Models\Tensao;
use App\Repositories\TensaoRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class TensaoRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var TensaoRepository
     */
    protected $tensaoRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->tensaoRepo = \App::make(TensaoRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_tensao()
    {
        $tensao = factory(Tensao::class)->make()->toArray();

        $createdTensao = $this->tensaoRepo->create($tensao);

        $createdTensao = $createdTensao->toArray();
        $this->assertArrayHasKey('id', $createdTensao);
        $this->assertNotNull($createdTensao['id'], 'Created Tensao must have id specified');
        $this->assertNotNull(Tensao::find($createdTensao['id']), 'Tensao with given id must be in DB');
        $this->assertModelData($tensao, $createdTensao);
    }

    /**
     * @test read
     */
    public function test_read_tensao()
    {
        $tensao = factory(Tensao::class)->create();

        $dbTensao = $this->tensaoRepo->find($tensao->id);

        $dbTensao = $dbTensao->toArray();
        $this->assertModelData($tensao->toArray(), $dbTensao);
    }

    /**
     * @test update
     */
    public function test_update_tensao()
    {
        $tensao = factory(Tensao::class)->create();
        $fakeTensao = factory(Tensao::class)->make()->toArray();

        $updatedTensao = $this->tensaoRepo->update($fakeTensao, $tensao->id);

        $this->assertModelData($fakeTensao, $updatedTensao->toArray());
        $dbTensao = $this->tensaoRepo->find($tensao->id);
        $this->assertModelData($fakeTensao, $dbTensao->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_tensao()
    {
        $tensao = factory(Tensao::class)->create();

        $resp = $this->tensaoRepo->delete($tensao->id);

        $this->assertTrue($resp);
        $this->assertNull(Tensao::find($tensao->id), 'Tensao should not exist in DB');
    }
}
