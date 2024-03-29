<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\CreateItemAlteradoAPIRequest;
use App\Http\Requests\API\UpdateItemAlteradoAPIRequest;
use App\Models\ItemAlterado;
use App\Repositories\ItemAlteradoRepository;
use Illuminate\Http\Request;
use Response;

/**
 * Class ItemAlteradoController.
 */
class ItemAlteradoAPIController extends AppBaseController
{
    /** @var ItemAlteradoRepository */
    private $itemAlteradoRepository;

    public function __construct(ItemAlteradoRepository $itemAlteradoRepo)
    {
        $this->itemAlteradoRepository = $itemAlteradoRepo;
    }

    /**
     * Display a listing of the ItemAlterado.
     * GET|HEAD /itensAlterados.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $itensAlterados = $this->itemAlteradoRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($itensAlterados->toArray(), 'Itens Alterados listados com sucesso');
    }

    /**
     * Store a newly created ItemAlterado in storage.
     * POST /itensAlterados.
     *
     * @param CreateItemAlteradoAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateItemAlteradoAPIRequest $request)
    {
        $input = $request->all();

        $itemAlterado = $this->itemAlteradoRepository->create($input);

        return $this->sendResponse($itemAlterado->toArray(), 'Item Alterado salvo com sucesso');
    }

    /**
     * Display the specified ItemAlterado.
     * GET|HEAD /itensAlterados/{id}.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var ItemAlterado $itemAlterado */
        $itemAlterado = $this->itemAlteradoRepository->find($id);

        if (empty($itemAlterado)) {
            return $this->sendError('Item Alterado não encontrado');
        }

        return $this->sendResponse($itemAlterado->toArray(), 'Item Alterado listado com sucesso');
    }

    /**
     * Update the specified ItemAlterado in storage.
     * PUT/PATCH /itensAlterados/{id}.
     *
     * @param int $id
     * @param UpdateItemAlteradoAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateItemAlteradoAPIRequest $request)
    {
        $input = $request->all();

        /** @var ItemAlterado $itemAlterado */
        $itemAlterado = $this->itemAlteradoRepository->find($id);

        if (empty($itemAlterado)) {
            return $this->sendError('Item Alterado não encontrado');
        }

        $itemAlterado = $this->itemAlteradoRepository->update($input, $id);

        return $this->sendResponse($itemAlterado->toArray(), 'Item Alterado atualizado com sucesso');
    }

    /**
     * Remove the specified ItemAlterado from storage.
     * DELETE /itensAlterados/{id}.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var ItemAlterado $itemAlterado */
        $itemAlterado = $this->itemAlteradoRepository->find($id);

        if (empty($itemAlterado)) {
            return $this->sendError('Item Alterado não encontrado');
        }

        $itemAlterado->delete();

        return $this->sendSuccess('Item Alterado excluído com sucesso');
    }
}
