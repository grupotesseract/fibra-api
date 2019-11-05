<?php

namespace Tests\APIs;

use App\Models\LiberacaoDocumento;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\ApiTestTrait;
use Tests\TestCase;

class LiberacaoDocumentoApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_liberacao_documento()
    {
        $liberacaoDocumento = factory(LiberacaoDocumento::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/liberacoes_documentos', $liberacaoDocumento
        );

        $this->assertApiResponse($liberacaoDocumento);
    }

    /**
     * @test
     */
    public function test_read_liberacao_documento()
    {
        $liberacaoDocumento = factory(LiberacaoDocumento::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/liberacoes_documentos/'.$liberacaoDocumento->id
        );

        $this->assertApiResponse($liberacaoDocumento->toArray());
    }

    /**
     * @test
     */
    public function test_update_liberacao_documento()
    {
        $liberacaoDocumento = factory(LiberacaoDocumento::class)->create();
        $editedLiberacaoDocumento = factory(LiberacaoDocumento::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/liberacoes_documentos/'.$liberacaoDocumento->id,
            $editedLiberacaoDocumento
        );

        $this->assertApiResponse($editedLiberacaoDocumento);
    }

    /**
     * @test
     */
    public function test_delete_liberacao_documento()
    {
        $liberacaoDocumento = factory(LiberacaoDocumento::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/liberacoes_documentos/'.$liberacaoDocumento->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/liberacoes_documentos/'.$liberacaoDocumento->id
        );

        $this->response->assertStatus(404);
    }
}
