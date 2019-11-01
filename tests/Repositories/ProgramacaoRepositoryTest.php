<?php

namespace Tests\Repositories;

use App\Models\Programacao;
use App\Repositories\ProgramacaoRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\ApiTestTrait;
use Tests\TestCase;

class ProgramacaoRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var ProgramacaoRepository
     */
    protected $programacaoRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->programacaoRepo = \App::make(ProgramacaoRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_programacao()
    {
        $programacao = factory(Programacao::class)->make()->toArray();

        $createdProgramacao = $this->programacaoRepo->create($programacao);

        $createdProgramacao = $createdProgramacao->toArray();
        $this->assertArrayHasKey('id', $createdProgramacao);
        $this->assertNotNull($createdProgramacao['id'], 'Created Programacao must have id specified');
        $this->assertNotNull(Programacao::find($createdProgramacao['id']), 'Programacao with given id must be in DB');
        $this->assertModelData($programacao, $createdProgramacao);
    }

    /**
     * @test read
     */
    public function test_read_programacao()
    {
        $programacao = factory(Programacao::class)->create();

        $dbProgramacao = $this->programacaoRepo->find($programacao->id);

        $dbProgramacao = $dbProgramacao->toArray();
        $this->assertModelData($programacao->toArray(), $dbProgramacao);
    }

    /**
     * @test update
     */
    public function test_update_programacao()
    {
        $programacao = factory(Programacao::class)->create();
        $fakeProgramacao = factory(Programacao::class)->make()->toArray();

        $updatedProgramacao = $this->programacaoRepo->update($fakeProgramacao, $programacao->id);

        $this->assertModelData($fakeProgramacao, $updatedProgramacao->toArray());
        $dbProgramacao = $this->programacaoRepo->find($programacao->id);
        $this->assertModelData($fakeProgramacao, $dbProgramacao->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_programacao()
    {
        $programacao = factory(Programacao::class)->create();

        $resp = $this->programacaoRepo->delete($programacao->id);

        $this->assertTrue($resp);
        $this->assertNull(Programacao::find($programacao->id), 'Programacao should not exist in DB');
    }
}
