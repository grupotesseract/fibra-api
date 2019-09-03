<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Empresa;

class EmpresaApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_empresa()
    {
        $empresa = factory(Empresa::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/empresas', $empresa
        );

        $this->assertApiResponse($empresa);
    }

    /**
     * @test
     */
    public function test_read_empresa()
    {
        $empresa = factory(Empresa::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/empresas/'.$empresa->id
        );

        $this->assertApiResponse($empresa->toArray());
    }

    /**
     * @test
     */
    public function test_update_empresa()
    {
        $empresa = factory(Empresa::class)->create();
        $editedEmpresa = factory(Empresa::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/empresas/'.$empresa->id,
            $editedEmpresa
        );

        $this->assertApiResponse($editedEmpresa);
    }

    /**
     * @test
     */
    public function test_delete_empresa()
    {
        $empresa = factory(Empresa::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/empresas/'.$empresa->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/empresas/'.$empresa->id
        );

        $this->response->assertStatus(404);
    }
}
