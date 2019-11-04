<?php

namespace Tests\APIs;

use Tests\TestCase;
use App\Models\Item;
use Tests\ApiTestTrait;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ItemApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_item()
    {
        $item = factory(Item::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/itens', $item
        );

        $this->assertApiResponse($item);
    }

    /**
     * @test
     */
    public function test_read_item()
    {
        $item = factory(Item::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/itens/'.$item->id
        );

        $this->assertApiResponse($item->toArray());
    }

    /**
     * @test
     */
    public function test_update_item()
    {
        $item = factory(Item::class)->create();
        $editedItem = factory(Item::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/itens/'.$item->id,
            $editedItem
        );

        $this->assertApiResponse($editedItem);
    }

    /**
     * @test
     */
    public function test_delete_item()
    {
        $item = factory(Item::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/itens/'.$item->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/itens/'.$item->id
        );

        $this->response->assertStatus(404);
    }
}
