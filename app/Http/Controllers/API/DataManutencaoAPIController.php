<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateDataManutencaoAPIRequest;
use App\Http\Requests\API\UpdateDataManutencaoAPIRequest;
use App\Models\DataManutencao;
use App\Repositories\DataManutencaoRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class DataManutencaoController
 * @package App\Http\Controllers\API
 */

class DataManutencaoAPIController extends AppBaseController
{
    /** @var  DataManutencaoRepository */
    private $dataManutencaoRepository;

    public function __construct(DataManutencaoRepository $dataManutencaoRepo)
    {
        $this->dataManutencaoRepository = $dataManutencaoRepo;
    }

    /**
     * Display a listing of the DataManutencao.
     * GET|HEAD /datasManutencoes
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $datasManutencoes = $this->dataManutencaoRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($datasManutencoes->toArray(), 'Datas Manutencoes retrieved successfully');
    }

    /**
     * Store a newly created DataManutencao in storage.
     * POST /datasManutencoes
     *
     * @param CreateDataManutencaoAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateDataManutencaoAPIRequest $request)
    {
        $input = $request->all();

        $dataManutencao = $this->dataManutencaoRepository->create($input);

        return $this->sendResponse($dataManutencao->toArray(), 'Data Manutencao saved successfully');
    }

    /**
     * Display the specified DataManutencao.
     * GET|HEAD /datasManutencoes/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var DataManutencao $dataManutencao */
        $dataManutencao = $this->dataManutencaoRepository->find($id);

        if (empty($dataManutencao)) {
            return $this->sendError('Data Manutencao not found');
        }

        return $this->sendResponse($dataManutencao->toArray(), 'Data Manutencao retrieved successfully');
    }

    /**
     * Update the specified DataManutencao in storage.
     * PUT/PATCH /datasManutencoes/{id}
     *
     * @param int $id
     * @param UpdateDataManutencaoAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDataManutencaoAPIRequest $request)
    {
        $input = $request->all();

        /** @var DataManutencao $dataManutencao */
        $dataManutencao = $this->dataManutencaoRepository->find($id);

        if (empty($dataManutencao)) {
            return $this->sendError('Data Manutencao not found');
        }

        $dataManutencao = $this->dataManutencaoRepository->update($input, $id);

        return $this->sendResponse($dataManutencao->toArray(), 'DataManutencao updated successfully');
    }

    /**
     * Remove the specified DataManutencao from storage.
     * DELETE /datasManutencoes/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var DataManutencao $dataManutencao */
        $dataManutencao = $this->dataManutencaoRepository->find($id);

        if (empty($dataManutencao)) {
            return $this->sendError('Data Manutencao not found');
        }

        $dataManutencao->delete();

        return $this->sendSuccess('Data Manutencao deleted successfully');
    }
}
