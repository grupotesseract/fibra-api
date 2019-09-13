<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Programacao;

class ProgramacaoApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_programacao()
    {
        $programacao = factory(Programacao::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/programacoes', $programacao
        );

        $this->assertApiResponse($programacao);
    }

    /**
     * @test
     */
    public function test_read_programacao()
    {
        $programacao = factory(Programacao::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/programacoes/'.$programacao->id
        );

        $this->assertApiResponse($programacao->toArray());
    }

    /**
     * @test
     */
    public function test_update_programacao()
    {
        $programacao = factory(Programacao::class)->create();
        $editedProgramacao = factory(Programacao::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/programacoes/'.$programacao->id,
            $editedProgramacao
        );

        $this->assertApiResponse($editedProgramacao);
    }

    /**
     * @test
     */
    public function test_delete_programacao()
    {
        $programacao = factory(Programacao::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/programacoes/'.$programacao->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/programacoes/'.$programacao->id
        );

        $this->response->assertStatus(404);
    }
}
