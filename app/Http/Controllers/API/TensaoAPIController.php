<?php

namespace App\Http\Controllers\API;

use Response;
use App\Models\Tensao;
use Illuminate\Http\Request;
use App\Repositories\TensaoRepository;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\CreateTensaoAPIRequest;
use App\Http\Requests\API\UpdateTensaoAPIRequest;

/**
 * Class TensaoController.
 */
class TensaoAPIController extends AppBaseController
{
    /** @var TensaoRepository */
    private $tensaoRepository;

    public function __construct(TensaoRepository $tensaoRepo)
    {
        $this->tensaoRepository = $tensaoRepo;
    }

    /**
     * Display a listing of the Tensao.
     * GET|HEAD /tensoes.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $tensoes = $this->tensaoRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($tensoes->toArray(), 'Tensões listadas com sucesso');
    }

    /**
     * Store a newly created Tensao in storage.
     * POST /tensoes.
     *
     * @param CreateTensaoAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateTensaoAPIRequest $request)
    {
        $input = $request->all();

        $tensao = $this->tensaoRepository->create($input);

        return $this->sendResponse($tensao->toArray(), 'Tensão salva com sucesso');
    }

    /**
     * Display the specified Tensao.
     * GET|HEAD /tensoes/{id}.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Tensao $tensao */
        $tensao = $this->tensaoRepository->find($id);

        if (empty($tensao)) {
            return $this->sendError('Tensão não encontrada');
        }

        return $this->sendResponse($tensao->toArray(), 'Tensão listada com sucesso');
    }

    /**
     * Update the specified Tensao in storage.
     * PUT/PATCH /tensoes/{id}.
     *
     * @param int $id
     * @param UpdateTensaoAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTensaoAPIRequest $request)
    {
        $input = $request->all();

        /** @var Tensao $tensao */
        $tensao = $this->tensaoRepository->find($id);

        if (empty($tensao)) {
            return $this->sendError('Tensão não encontrada');
        }

        $tensao = $this->tensaoRepository->update($input, $id);

        return $this->sendResponse($tensao->toArray(), 'Tensão atualizada com sucesso');
    }

    /**
     * Remove the specified Tensao from storage.
     * DELETE /tensoes/{id}.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Tensao $tensao */
        $tensao = $this->tensaoRepository->find($id);

        if (empty($tensao)) {
            return $this->sendError('Tensão não encontrada');
        }

        $tensao->delete();

        return $this->sendResponse($id, 'Tensão excluída com sucesso');
    }
}
