<?php namespace Tests\Repositories;

use App\Models\ComentarioGeral;
use App\Repositories\ComentarioGeralRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class ComentarioGeralRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var ComentarioGeralRepository
     */
    protected $comentarioGeralRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->comentarioGeralRepo = \App::make(ComentarioGeralRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_comentario_geral()
    {
        $comentarioGeral = factory(ComentarioGeral::class)->make()->toArray();

        $createdComentarioGeral = $this->comentarioGeralRepo->create($comentarioGeral);

        $createdComentarioGeral = $createdComentarioGeral->toArray();
        $this->assertArrayHasKey('id', $createdComentarioGeral);
        $this->assertNotNull($createdComentarioGeral['id'], 'Created ComentarioGeral must have id specified');
        $this->assertNotNull(ComentarioGeral::find($createdComentarioGeral['id']), 'ComentarioGeral with given id must be in DB');
        $this->assertModelData($comentarioGeral, $createdComentarioGeral);
    }

    /**
     * @test read
     */
    public function test_read_comentario_geral()
    {
        $comentarioGeral = factory(ComentarioGeral::class)->create();

        $dbComentarioGeral = $this->comentarioGeralRepo->find($comentarioGeral->id);

        $dbComentarioGeral = $dbComentarioGeral->toArray();
        $this->assertModelData($comentarioGeral->toArray(), $dbComentarioGeral);
    }

    /**
     * @test update
     */
    public function test_update_comentario_geral()
    {
        $comentarioGeral = factory(ComentarioGeral::class)->create();
        $fakeComentarioGeral = factory(ComentarioGeral::class)->make()->toArray();

        $updatedComentarioGeral = $this->comentarioGeralRepo->update($fakeComentarioGeral, $comentarioGeral->id);

        $this->assertModelData($fakeComentarioGeral, $updatedComentarioGeral->toArray());
        $dbComentarioGeral = $this->comentarioGeralRepo->find($comentarioGeral->id);
        $this->assertModelData($fakeComentarioGeral, $dbComentarioGeral->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_comentario_geral()
    {
        $comentarioGeral = factory(ComentarioGeral::class)->create();

        $resp = $this->comentarioGeralRepo->delete($comentarioGeral->id);

        $this->assertTrue($resp);
        $this->assertNull(ComentarioGeral::find($comentarioGeral->id), 'ComentarioGeral should not exist in DB');
    }
}
