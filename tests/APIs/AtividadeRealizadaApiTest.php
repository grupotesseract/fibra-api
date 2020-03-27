<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\AtividadeRealizada;

class AtividadeRealizadaApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_atividade_realizada()
    {
        $atividadeRealizada = factory(AtividadeRealizada::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/atividades_realizadas', $atividadeRealizada
        );

        $this->assertApiResponse($atividadeRealizada);
    }

    /**
     * @test
     */
    public function test_read_atividade_realizada()
    {
        $atividadeRealizada = factory(AtividadeRealizada::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/atividades_realizadas/'.$atividadeRealizada->id
        );

        $this->assertApiResponse($atividadeRealizada->toArray());
    }

    /**
     * @test
     */
    public function test_update_atividade_realizada()
    {
        $atividadeRealizada = factory(AtividadeRealizada::class)->create();
        $editedAtividadeRealizada = factory(AtividadeRealizada::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/atividades_realizadas/'.$atividadeRealizada->id,
            $editedAtividadeRealizada
        );

        $this->assertApiResponse($editedAtividadeRealizada);
    }

    /**
     * @test
     */
    public function test_delete_atividade_realizada()
    {
        $atividadeRealizada = factory(AtividadeRealizada::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/atividades_realizadas/'.$atividadeRealizada->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/atividades_realizadas/'.$atividadeRealizada->id
        );

        $this->response->assertStatus(404);
    }
}
