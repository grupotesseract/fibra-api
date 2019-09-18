<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Tensao;

class TensaoApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_tensao()
    {
        $tensao = factory(Tensao::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/tensoes', $tensao
        );

        $this->assertApiResponse($tensao);
    }

    /**
     * @test
     */
    public function test_read_tensao()
    {
        $tensao = factory(Tensao::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/tensoes/'.$tensao->id
        );

        $this->assertApiResponse($tensao->toArray());
    }

    /**
     * @test
     */
    public function test_update_tensao()
    {
        $tensao = factory(Tensao::class)->create();
        $editedTensao = factory(Tensao::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/tensoes/'.$tensao->id,
            $editedTensao
        );

        $this->assertApiResponse($editedTensao);
    }

    /**
     * @test
     */
    public function test_delete_tensao()
    {
        $tensao = factory(Tensao::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/tensoes/'.$tensao->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/tensoes/'.$tensao->id
        );

        $this->response->assertStatus(404);
    }
}
