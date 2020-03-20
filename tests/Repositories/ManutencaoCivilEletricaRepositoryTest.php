<?php

namespace Tests\Repositories;

use App\Models\ManutencaoCivilEletrica;
use App\Repositories\ManutencaoCivilEletricaRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\ApiTestTrait;
use Tests\TestCase;

class ManutencaoCivilEletricaRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var ManutencaoCivilEletricaRepository
     */
    protected $manutencaoCivilEletricaRepo;

    public function setUp(): void
    {
        parent::setUp();
        $this->manutencaoCivilEletricaRepo = \App::make(ManutencaoCivilEletricaRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_manutencao_civil_eletrica()
    {
        $manutencaoCivilEletrica = factory(ManutencaoCivilEletrica::class)->make()->toArray();

        $createdManutencaoCivilEletrica = $this->manutencaoCivilEletricaRepo->create($manutencaoCivilEletrica);

        $createdManutencaoCivilEletrica = $createdManutencaoCivilEletrica->toArray();
        $this->assertArrayHasKey('id', $createdManutencaoCivilEletrica);
        $this->assertNotNull($createdManutencaoCivilEletrica['id'], 'Created ManutencaoCivilEletrica must have id specified');
        $this->assertNotNull(ManutencaoCivilEletrica::find($createdManutencaoCivilEletrica['id']), 'ManutencaoCivilEletrica with given id must be in DB');
        $this->assertModelData($manutencaoCivilEletrica, $createdManutencaoCivilEletrica);
    }

    /**
     * @test read
     */
    public function test_read_manutencao_civil_eletrica()
    {
        $manutencaoCivilEletrica = factory(ManutencaoCivilEletrica::class)->create();

        $dbManutencaoCivilEletrica = $this->manutencaoCivilEletricaRepo->find($manutencaoCivilEletrica->id);

        $dbManutencaoCivilEletrica = $dbManutencaoCivilEletrica->toArray();
        $this->assertModelData($manutencaoCivilEletrica->toArray(), $dbManutencaoCivilEletrica);
    }

    /**
     * @test update
     */
    public function test_update_manutencao_civil_eletrica()
    {
        $manutencaoCivilEletrica = factory(ManutencaoCivilEletrica::class)->create();
        $fakeManutencaoCivilEletrica = factory(ManutencaoCivilEletrica::class)->make()->toArray();

        $updatedManutencaoCivilEletrica = $this->manutencaoCivilEletricaRepo->update($fakeManutencaoCivilEletrica, $manutencaoCivilEletrica->id);

        $this->assertModelData($fakeManutencaoCivilEletrica, $updatedManutencaoCivilEletrica->toArray());
        $dbManutencaoCivilEletrica = $this->manutencaoCivilEletricaRepo->find($manutencaoCivilEletrica->id);
        $this->assertModelData($fakeManutencaoCivilEletrica, $dbManutencaoCivilEletrica->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_manutencao_civil_eletrica()
    {
        $manutencaoCivilEletrica = factory(ManutencaoCivilEletrica::class)->create();

        $resp = $this->manutencaoCivilEletricaRepo->delete($manutencaoCivilEletrica->id);

        $this->assertTrue($resp);
        $this->assertNull(ManutencaoCivilEletrica::find($manutencaoCivilEletrica->id), 'ManutencaoCivilEletrica should not exist in DB');
    }
}
