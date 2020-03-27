<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\UsuarioManutencao;

class UsuarioManutencaoApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_usuario_manutencao()
    {
        $usuarioManutencao = factory(UsuarioManutencao::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/usuarios_manutencoes', $usuarioManutencao
        );

        $this->assertApiResponse($usuarioManutencao);
    }

    /**
     * @test
     */
    public function test_read_usuario_manutencao()
    {
        $usuarioManutencao = factory(UsuarioManutencao::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/usuarios_manutencoes/'.$usuarioManutencao->id
        );

        $this->assertApiResponse($usuarioManutencao->toArray());
    }

    /**
     * @test
     */
    public function test_update_usuario_manutencao()
    {
        $usuarioManutencao = factory(UsuarioManutencao::class)->create();
        $editedUsuarioManutencao = factory(UsuarioManutencao::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/usuarios_manutencoes/'.$usuarioManutencao->id,
            $editedUsuarioManutencao
        );

        $this->assertApiResponse($editedUsuarioManutencao);
    }

    /**
     * @test
     */
    public function test_delete_usuario_manutencao()
    {
        $usuarioManutencao = factory(UsuarioManutencao::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/usuarios_manutencoes/'.$usuarioManutencao->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/usuarios_manutencoes/'.$usuarioManutencao->id
        );

        $this->response->assertStatus(404);
    }
}
