<?php

namespace Tests\Repositories;

use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\LiberacaoDocumento;
use App\Repositories\LiberacaoDocumentoRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LiberacaoDocumentoRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var LiberacaoDocumentoRepository
     */
    protected $liberacaoDocumentoRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->liberacaoDocumentoRepo = \App::make(LiberacaoDocumentoRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_liberacao_documento()
    {
        $liberacaoDocumento = factory(LiberacaoDocumento::class)->make()->toArray();

        $createdLiberacaoDocumento = $this->liberacaoDocumentoRepo->create($liberacaoDocumento);

        $createdLiberacaoDocumento = $createdLiberacaoDocumento->toArray();
        $this->assertArrayHasKey('id', $createdLiberacaoDocumento);
        $this->assertNotNull($createdLiberacaoDocumento['id'], 'Created LiberacaoDocumento must have id specified');
        $this->assertNotNull(LiberacaoDocumento::find($createdLiberacaoDocumento['id']), 'LiberacaoDocumento with given id must be in DB');
        $this->assertModelData($liberacaoDocumento, $createdLiberacaoDocumento);
    }

    /**
     * @test read
     */
    public function test_read_liberacao_documento()
    {
        $liberacaoDocumento = factory(LiberacaoDocumento::class)->create();

        $dbLiberacaoDocumento = $this->liberacaoDocumentoRepo->find($liberacaoDocumento->id);

        $dbLiberacaoDocumento = $dbLiberacaoDocumento->toArray();
        $this->assertModelData($liberacaoDocumento->toArray(), $dbLiberacaoDocumento);
    }

    /**
     * @test update
     */
    public function test_update_liberacao_documento()
    {
        $liberacaoDocumento = factory(LiberacaoDocumento::class)->create();
        $fakeLiberacaoDocumento = factory(LiberacaoDocumento::class)->make()->toArray();

        $updatedLiberacaoDocumento = $this->liberacaoDocumentoRepo->update($fakeLiberacaoDocumento, $liberacaoDocumento->id);

        $this->assertModelData($fakeLiberacaoDocumento, $updatedLiberacaoDocumento->toArray());
        $dbLiberacaoDocumento = $this->liberacaoDocumentoRepo->find($liberacaoDocumento->id);
        $this->assertModelData($fakeLiberacaoDocumento, $dbLiberacaoDocumento->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_liberacao_documento()
    {
        $liberacaoDocumento = factory(LiberacaoDocumento::class)->create();

        $resp = $this->liberacaoDocumentoRepo->delete($liberacaoDocumento->id);

        $this->assertTrue($resp);
        $this->assertNull(LiberacaoDocumento::find($liberacaoDocumento->id), 'LiberacaoDocumento should not exist in DB');
    }
}
