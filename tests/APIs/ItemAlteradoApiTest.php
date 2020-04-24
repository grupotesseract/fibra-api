<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\ItemAlterado;

class ItemAlteradoApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_item_alterado()
    {
        $itemAlterado = factory(ItemAlterado::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/itens_alterados', $itemAlterado
        );

        $this->assertApiResponse($itemAlterado);
    }

    /**
     * @test
     */
    public function test_read_item_alterado()
    {
        $itemAlterado = factory(ItemAlterado::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/itens_alterados/'.$itemAlterado->id
        );

        $this->assertApiResponse($itemAlterado->toArray());
    }

    /**
     * @test
     */
    public function test_update_item_alterado()
    {
        $itemAlterado = factory(ItemAlterado::class)->create();
        $editedItemAlterado = factory(ItemAlterado::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/itens_alterados/'.$itemAlterado->id,
            $editedItemAlterado
        );

        $this->assertApiResponse($editedItemAlterado);
    }

    /**
     * @test
     */
    public function test_delete_item_alterado()
    {
        $itemAlterado = factory(ItemAlterado::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/itens_alterados/'.$itemAlterado->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/itens_alterados/'.$itemAlterado->id
        );

        $this->response->assertStatus(404);
    }
}
