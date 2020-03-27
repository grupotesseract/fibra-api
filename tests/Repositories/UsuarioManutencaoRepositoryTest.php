<?php namespace Tests\Repositories;

use App\Models\UsuarioManutencao;
use App\Repositories\UsuarioManutencaoRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class UsuarioManutencaoRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var UsuarioManutencaoRepository
     */
    protected $usuarioManutencaoRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->usuarioManutencaoRepo = \App::make(UsuarioManutencaoRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_usuario_manutencao()
    {
        $usuarioManutencao = factory(UsuarioManutencao::class)->make()->toArray();

        $createdUsuarioManutencao = $this->usuarioManutencaoRepo->create($usuarioManutencao);

        $createdUsuarioManutencao = $createdUsuarioManutencao->toArray();
        $this->assertArrayHasKey('id', $createdUsuarioManutencao);
        $this->assertNotNull($createdUsuarioManutencao['id'], 'Created UsuarioManutencao must have id specified');
        $this->assertNotNull(UsuarioManutencao::find($createdUsuarioManutencao['id']), 'UsuarioManutencao with given id must be in DB');
        $this->assertModelData($usuarioManutencao, $createdUsuarioManutencao);
    }

    /**
     * @test read
     */
    public function test_read_usuario_manutencao()
    {
        $usuarioManutencao = factory(UsuarioManutencao::class)->create();

        $dbUsuarioManutencao = $this->usuarioManutencaoRepo->find($usuarioManutencao->id);

        $dbUsuarioManutencao = $dbUsuarioManutencao->toArray();
        $this->assertModelData($usuarioManutencao->toArray(), $dbUsuarioManutencao);
    }

    /**
     * @test update
     */
    public function test_update_usuario_manutencao()
    {
        $usuarioManutencao = factory(UsuarioManutencao::class)->create();
        $fakeUsuarioManutencao = factory(UsuarioManutencao::class)->make()->toArray();

        $updatedUsuarioManutencao = $this->usuarioManutencaoRepo->update($fakeUsuarioManutencao, $usuarioManutencao->id);

        $this->assertModelData($fakeUsuarioManutencao, $updatedUsuarioManutencao->toArray());
        $dbUsuarioManutencao = $this->usuarioManutencaoRepo->find($usuarioManutencao->id);
        $this->assertModelData($fakeUsuarioManutencao, $dbUsuarioManutencao->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_usuario_manutencao()
    {
        $usuarioManutencao = factory(UsuarioManutencao::class)->create();

        $resp = $this->usuarioManutencaoRepo->delete($usuarioManutencao->id);

        $this->assertTrue($resp);
        $this->assertNull(UsuarioManutencao::find($usuarioManutencao->id), 'UsuarioManutencao should not exist in DB');
    }
}
