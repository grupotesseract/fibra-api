<?php

namespace Tests\APIs;

use App\Models\Usuario;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\ApiTestTrait;
use Tests\TestCase;

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
}
