<?php namespace Tests\Repositories;

use App\Models\ItemAlterado;
use App\Repositories\ItemAlteradoRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class ItemAlteradoRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var ItemAlteradoRepository
     */
    protected $itemAlteradoRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->itemAlteradoRepo = \App::make(ItemAlteradoRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_item_alterado()
    {
        $itemAlterado = factory(ItemAlterado::class)->make()->toArray();

        $createdItemAlterado = $this->itemAlteradoRepo->create($itemAlterado);

        $createdItemAlterado = $createdItemAlterado->toArray();
        $this->assertArrayHasKey('id', $createdItemAlterado);
        $this->assertNotNull($createdItemAlterado['id'], 'Created ItemAlterado must have id specified');
        $this->assertNotNull(ItemAlterado::find($createdItemAlterado['id']), 'ItemAlterado with given id must be in DB');
        $this->assertModelData($itemAlterado, $createdItemAlterado);
    }

    /**
     * @test read
     */
    public function test_read_item_alterado()
    {
        $itemAlterado = factory(ItemAlterado::class)->create();

        $dbItemAlterado = $this->itemAlteradoRepo->find($itemAlterado->id);

        $dbItemAlterado = $dbItemAlterado->toArray();
        $this->assertModelData($itemAlterado->toArray(), $dbItemAlterado);
    }

    /**
     * @test update
     */
    public function test_update_item_alterado()
    {
        $itemAlterado = factory(ItemAlterado::class)->create();
        $fakeItemAlterado = factory(ItemAlterado::class)->make()->toArray();

        $updatedItemAlterado = $this->itemAlteradoRepo->update($fakeItemAlterado, $itemAlterado->id);

        $this->assertModelData($fakeItemAlterado, $updatedItemAlterado->toArray());
        $dbItemAlterado = $this->itemAlteradoRepo->find($itemAlterado->id);
        $this->assertModelData($fakeItemAlterado, $dbItemAlterado->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_item_alterado()
    {
        $itemAlterado = factory(ItemAlterado::class)->create();

        $resp = $this->itemAlteradoRepo->delete($itemAlterado->id);

        $this->assertTrue($resp);
        $this->assertNull(ItemAlterado::find($itemAlterado->id), 'ItemAlterado should not exist in DB');
    }
}
