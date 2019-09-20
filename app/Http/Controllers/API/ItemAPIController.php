<?php

namespace App\Http\Controllers\API;

use Response;
use App\Models\Item;
use Illuminate\Http\Request;
use App\Repositories\ItemRepository;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\CreateItemAPIRequest;
use App\Http\Requests\API\UpdateItemAPIRequest;

/**
 * Class ItemController.
 */
class ItemAPIController extends AppBaseController
{
    /** @var ItemRepository */
    private $itemRepository;

    public function __construct(ItemRepository $itemRepo)
    {
        $this->itemRepository = $itemRepo;
    }

    /**
     * Display a listing of the Item.
     * GET|HEAD /itens.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $itens = $this->itemRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($itens->toArray(), 'Itens listados com sucesso');
    }

    /**
     * Store a newly created Item in storage.
     * POST /itens.
     *
     * @param CreateItemAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateItemAPIRequest $request)
    {
        $input = $request->all();

        $item = $this->itemRepository->create($input);

        return $this->sendResponse($item->toArray(), 'Item salvo com sucesso');
    }

    /**
     * Display the specified Item.
     * GET|HEAD /itens/{id}.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Item $item */
        $item = $this->itemRepository->find($id);

        if (empty($item)) {
            return $this->sendError('Item não encontrado');
        }

        return $this->sendResponse($item->toArray(), 'Item listado com sucesso');
    }

    /**
     * Update the specified Item in storage.
     * PUT/PATCH /itens/{id}.
     *
     * @param int $id
     * @param UpdateItemAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateItemAPIRequest $request)
    {
        $input = $request->all();

        /** @var Item $item */
        $item = $this->itemRepository->find($id);

        if (empty($item)) {
            return $this->sendError('Item não encontrado');
        }

        $item = $this->itemRepository->update($input, $id);

        return $this->sendResponse($item->toArray(), 'Item atualizado com sucesso');
    }

    /**
     * Remove the specified Item from storage.
     * DELETE /itens/{id}.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Item $item */
        $item = $this->itemRepository->find($id);

        if (empty($item)) {
            return $this->sendError('Item não encontrado');
        }

        $item->delete();

        return $this->sendResponse($id, 'Item excluído com sucesso');
    }
}
