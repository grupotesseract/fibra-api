<?php namespace Tests\Repositories;

use App\Models\Item;
use App\Repositories\ItemRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class ItemRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var ItemRepository
     */
    protected $itemRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->itemRepo = \App::make(ItemRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_item()
    {
        $item = factory(Item::class)->make()->toArray();

        $createdItem = $this->itemRepo->create($item);

        $createdItem = $createdItem->toArray();
        $this->assertArrayHasKey('id', $createdItem);
        $this->assertNotNull($createdItem['id'], 'Created Item must have id specified');
        $this->assertNotNull(Item::find($createdItem['id']), 'Item with given id must be in DB');
        $this->assertModelData($item, $createdItem);
    }

    /**
     * @test read
     */
    public function test_read_item()
    {
        $item = factory(Item::class)->create();

        $dbItem = $this->itemRepo->find($item->id);

        $dbItem = $dbItem->toArray();
        $this->assertModelData($item->toArray(), $dbItem);
    }

    /**
     * @test update
     */
    public function test_update_item()
    {
        $item = factory(Item::class)->create();
        $fakeItem = factory(Item::class)->make()->toArray();

        $updatedItem = $this->itemRepo->update($fakeItem, $item->id);

        $this->assertModelData($fakeItem, $updatedItem->toArray());
        $dbItem = $this->itemRepo->find($item->id);
        $this->assertModelData($fakeItem, $dbItem->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_item()
    {
        $item = factory(Item::class)->create();

        $resp = $this->itemRepo->delete($item->id);

        $this->assertTrue($resp);
        $this->assertNull(Item::find($item->id), 'Item should not exist in DB');
    }
}
