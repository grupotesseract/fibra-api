<?php namespace Tests\Repositories;

use App\Models\UsuarioLiberacao;
use App\Repositories\UsuarioLiberacaoRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class UsuarioLiberacaoRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var UsuarioLiberacaoRepository
     */
    protected $usuarioLiberacaoRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->usuarioLiberacaoRepo = \App::make(UsuarioLiberacaoRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_usuario_liberacao()
    {
        $usuarioLiberacao = factory(UsuarioLiberacao::class)->make()->toArray();

        $createdUsuarioLiberacao = $this->usuarioLiberacaoRepo->create($usuarioLiberacao);

        $createdUsuarioLiberacao = $createdUsuarioLiberacao->toArray();
        $this->assertArrayHasKey('id', $createdUsuarioLiberacao);
        $this->assertNotNull($createdUsuarioLiberacao['id'], 'Created UsuarioLiberacao must have id specified');
        $this->assertNotNull(UsuarioLiberacao::find($createdUsuarioLiberacao['id']), 'UsuarioLiberacao with given id must be in DB');
        $this->assertModelData($usuarioLiberacao, $createdUsuarioLiberacao);
    }

    /**
     * @test read
     */
    public function test_read_usuario_liberacao()
    {
        $usuarioLiberacao = factory(UsuarioLiberacao::class)->create();

        $dbUsuarioLiberacao = $this->usuarioLiberacaoRepo->find($usuarioLiberacao->id);

        $dbUsuarioLiberacao = $dbUsuarioLiberacao->toArray();
        $this->assertModelData($usuarioLiberacao->toArray(), $dbUsuarioLiberacao);
    }

    /**
     * @test update
     */
    public function test_update_usuario_liberacao()
    {
        $usuarioLiberacao = factory(UsuarioLiberacao::class)->create();
        $fakeUsuarioLiberacao = factory(UsuarioLiberacao::class)->make()->toArray();

        $updatedUsuarioLiberacao = $this->usuarioLiberacaoRepo->update($fakeUsuarioLiberacao, $usuarioLiberacao->id);

        $this->assertModelData($fakeUsuarioLiberacao, $updatedUsuarioLiberacao->toArray());
        $dbUsuarioLiberacao = $this->usuarioLiberacaoRepo->find($usuarioLiberacao->id);
        $this->assertModelData($fakeUsuarioLiberacao, $dbUsuarioLiberacao->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_usuario_liberacao()
    {
        $usuarioLiberacao = factory(UsuarioLiberacao::class)->create();

        $resp = $this->usuarioLiberacaoRepo->delete($usuarioLiberacao->id);

        $this->assertTrue($resp);
        $this->assertNull(UsuarioLiberacao::find($usuarioLiberacao->id), 'UsuarioLiberacao should not exist in DB');
    }
}
