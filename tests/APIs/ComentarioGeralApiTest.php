<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\ComentarioGeral;

class ComentarioGeralApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_comentario_geral()
    {
        $comentarioGeral = factory(ComentarioGeral::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/comentarios_gerais', $comentarioGeral
        );

        $this->assertApiResponse($comentarioGeral);
    }

    /**
     * @test
     */
    public function test_read_comentario_geral()
    {
        $comentarioGeral = factory(ComentarioGeral::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/comentarios_gerais/'.$comentarioGeral->id
        );

        $this->assertApiResponse($comentarioGeral->toArray());
    }

    /**
     * @test
     */
    public function test_update_comentario_geral()
    {
        $comentarioGeral = factory(ComentarioGeral::class)->create();
        $editedComentarioGeral = factory(ComentarioGeral::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/comentarios_gerais/'.$comentarioGeral->id,
            $editedComentarioGeral
        );

        $this->assertApiResponse($editedComentarioGeral);
    }

    /**
     * @test
     */
    public function test_delete_comentario_geral()
    {
        $comentarioGeral = factory(ComentarioGeral::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/comentarios_gerais/'.$comentarioGeral->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/comentarios_gerais/'.$comentarioGeral->id
        );

        $this->response->assertStatus(404);
    }
}
