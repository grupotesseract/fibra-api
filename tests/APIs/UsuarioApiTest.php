<?php

namespace Tests\APIs;

use Tests\TestCase;
use App\Models\Usuario;
use Tests\ApiTestTrait;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UsuarioApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

        /**
     * @test
     */
    public function test_read_usuario()
    {
        $usuario = factory(Usuario::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/usuarios/'.$usuario->id
        );

        $this->assertApiResponse($usuario->toArray());
    }

    /**
     * @test
     */
    public function test_update_usuario()
    {
        $usuario = factory(Usuario::class)->create();
        $editedUsuario = factory(Usuario::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/usuarios/'.$usuario->id,
            $editedUsuario
        );

        $this->assertApiResponse($editedUsuario);
    }
    
}
