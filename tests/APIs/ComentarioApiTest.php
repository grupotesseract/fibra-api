<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Comentario;

class ComentarioApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_comentario()
    {
        $comentario = factory(Comentario::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/comentarios', $comentario
        );

        $this->assertApiResponse($comentario);
    }

    /**
     * @test
     */
    public function test_read_comentario()
    {
        $comentario = factory(Comentario::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/comentarios/'.$comentario->id
        );

        $this->assertApiResponse($comentario->toArray());
    }

    /**
     * @test
     */
    public function test_update_comentario()
    {
        $comentario = factory(Comentario::class)->create();
        $editedComentario = factory(Comentario::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/comentarios/'.$comentario->id,
            $editedComentario
        );

        $this->assertApiResponse($editedComentario);
    }

    /**
     * @test
     */
    public function test_delete_comentario()
    {
        $comentario = factory(Comentario::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/comentarios/'.$comentario->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/comentarios/'.$comentario->id
        );

        $this->response->assertStatus(404);
    }
}
