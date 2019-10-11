<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\UsuarioLiberacao;

class UsuarioLiberacaoApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_usuario_liberacao()
    {
        $usuarioLiberacao = factory(UsuarioLiberacao::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/usuarios_liberacoes', $usuarioLiberacao
        );

        $this->assertApiResponse($usuarioLiberacao);
    }

    /**
     * @test
     */
    public function test_read_usuario_liberacao()
    {
        $usuarioLiberacao = factory(UsuarioLiberacao::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/usuarios_liberacoes/'.$usuarioLiberacao->id
        );

        $this->assertApiResponse($usuarioLiberacao->toArray());
    }

    /**
     * @test
     */
    public function test_update_usuario_liberacao()
    {
        $usuarioLiberacao = factory(UsuarioLiberacao::class)->create();
        $editedUsuarioLiberacao = factory(UsuarioLiberacao::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/usuarios_liberacoes/'.$usuarioLiberacao->id,
            $editedUsuarioLiberacao
        );

        $this->assertApiResponse($editedUsuarioLiberacao);
    }

    /**
     * @test
     */
    public function test_delete_usuario_liberacao()
    {
        $usuarioLiberacao = factory(UsuarioLiberacao::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/usuarios_liberacoes/'.$usuarioLiberacao->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/usuarios_liberacoes/'.$usuarioLiberacao->id
        );

        $this->response->assertStatus(404);
    }
}
