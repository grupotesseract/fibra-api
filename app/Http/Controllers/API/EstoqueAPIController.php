<?php

namespace App\Http\Controllers\API;

use Response;
use App\Models\Estoque;
use Illuminate\Http\Request;
use App\Repositories\EstoqueRepository;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\CreateEstoqueAPIRequest;
use App\Http\Requests\API\UpdateEstoqueAPIRequest;

/**
 * Class EstoqueController.
 */
class EstoqueAPIController extends AppBaseController
{
    /** @var EstoqueRepository */
    private $estoqueRepository;

    public function __construct(EstoqueRepository $estoqueRepo)
    {
        $this->estoqueRepository = $estoqueRepo;
    }

    /**
     * Display a listing of the Estoque.
     * GET|HEAD /estoque.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $estoque = $this->estoqueRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($estoque->toArray(), 'Estoque retrieved successfully');
    }

    /**
     * Store a newly created Estoque in storage.
     * POST /estoque.
     *
     * @param CreateEstoqueAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateEstoqueAPIRequest $request)
    {
        $input = $request->all();

        $estoque = $this->estoqueRepository->create($input);

        return $this->sendResponse($estoque->toArray(), 'Estoque saved successfully');
    }

    /**
     * Display the specified Estoque.
     * GET|HEAD /estoque/{id}.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Estoque $estoque */
        $estoque = $this->estoqueRepository->find($id);

        if (empty($estoque)) {
            return $this->sendError('Estoque not found');
        }

        return $this->sendResponse($estoque->toArray(), 'Estoque retrieved successfully');
    }

    /**
     * Update the specified Estoque in storage.
     * PUT/PATCH /estoque/{id}.
     *
     * @param int $id
     * @param UpdateEstoqueAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateEstoqueAPIRequest $request)
    {
        $input = $request->all();

        /** @var Estoque $estoque */
        $estoque = $this->estoqueRepository->find($id);

        if (empty($estoque)) {
            return $this->sendError('Estoque not found');
        }

        $estoque = $this->estoqueRepository->update($input, $id);

        return $this->sendResponse($estoque->toArray(), 'Estoque updated successfully');
    }

    /**
     * Remove the specified Estoque from storage.
     * DELETE /estoque/{id}.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Estoque $estoque */
        $estoque = $this->estoqueRepository->find($id);

        if (empty($estoque)) {
            return $this->sendError('Estoque not found');
        }

        $estoque->delete();

        return $this->sendResponse($id, 'Estoque deleted successfully');
    }
}
