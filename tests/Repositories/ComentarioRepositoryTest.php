<?php namespace Tests\Repositories;

use App\Models\Comentario;
use App\Repositories\ComentarioRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class ComentarioRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var ComentarioRepository
     */
    protected $comentarioRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->comentarioRepo = \App::make(ComentarioRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_comentario()
    {
        $comentario = factory(Comentario::class)->make()->toArray();

        $createdComentario = $this->comentarioRepo->create($comentario);

        $createdComentario = $createdComentario->toArray();
        $this->assertArrayHasKey('id', $createdComentario);
        $this->assertNotNull($createdComentario['id'], 'Created Comentario must have id specified');
        $this->assertNotNull(Comentario::find($createdComentario['id']), 'Comentario with given id must be in DB');
        $this->assertModelData($comentario, $createdComentario);
    }

    /**
     * @test read
     */
    public function test_read_comentario()
    {
        $comentario = factory(Comentario::class)->create();

        $dbComentario = $this->comentarioRepo->find($comentario->id);

        $dbComentario = $dbComentario->toArray();
        $this->assertModelData($comentario->toArray(), $dbComentario);
    }

    /**
     * @test update
     */
    public function test_update_comentario()
    {
        $comentario = factory(Comentario::class)->create();
        $fakeComentario = factory(Comentario::class)->make()->toArray();

        $updatedComentario = $this->comentarioRepo->update($fakeComentario, $comentario->id);

        $this->assertModelData($fakeComentario, $updatedComentario->toArray());
        $dbComentario = $this->comentarioRepo->find($comentario->id);
        $this->assertModelData($fakeComentario, $dbComentario->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_comentario()
    {
        $comentario = factory(Comentario::class)->create();

        $resp = $this->comentarioRepo->delete($comentario->id);

        $this->assertTrue($resp);
        $this->assertNull(Comentario::find($comentario->id), 'Comentario should not exist in DB');
    }
}
