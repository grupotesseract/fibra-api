<?php namespace Tests\Repositories;

use App\Models\Empresa;
use App\Repositories\EmpresaRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class EmpresaRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var EmpresaRepository
     */
    protected $empresaRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->empresaRepo = \App::make(EmpresaRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_empresa()
    {
        $empresa = factory(Empresa::class)->make()->toArray();

        $createdEmpresa = $this->empresaRepo->create($empresa);

        $createdEmpresa = $createdEmpresa->toArray();
        $this->assertArrayHasKey('id', $createdEmpresa);
        $this->assertNotNull($createdEmpresa['id'], 'Created Empresa must have id specified');
        $this->assertNotNull(Empresa::find($createdEmpresa['id']), 'Empresa with given id must be in DB');
        $this->assertModelData($empresa, $createdEmpresa);
    }

    /**
     * @test read
     */
    public function test_read_empresa()
    {
        $empresa = factory(Empresa::class)->create();

        $dbEmpresa = $this->empresaRepo->find($empresa->id);

        $dbEmpresa = $dbEmpresa->toArray();
        $this->assertModelData($empresa->toArray(), $dbEmpresa);
    }

    /**
     * @test update
     */
    public function test_update_empresa()
    {
        $empresa = factory(Empresa::class)->create();
        $fakeEmpresa = factory(Empresa::class)->make()->toArray();

        $updatedEmpresa = $this->empresaRepo->update($fakeEmpresa, $empresa->id);

        $this->assertModelData($fakeEmpresa, $updatedEmpresa->toArray());
        $dbEmpresa = $this->empresaRepo->find($empresa->id);
        $this->assertModelData($fakeEmpresa, $dbEmpresa->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_empresa()
    {
        $empresa = factory(Empresa::class)->create();

        $resp = $this->empresaRepo->delete($empresa->id);

        $this->assertTrue($resp);
        $this->assertNull(Empresa::find($empresa->id), 'Empresa should not exist in DB');
    }
}
