<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateQuantidadeSubstituidaAPIRequest;
use App\Http\Requests\API\UpdateQuantidadeSubstituidaAPIRequest;
use App\Models\QuantidadeSubstituida;
use App\Repositories\QuantidadeSubstituidaRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class QuantidadeSubstituidaController
 * @package App\Http\Controllers\API
 */

class QuantidadeSubstituidaAPIController extends AppBaseController
{
    /** @var  QuantidadeSubstituidaRepository */
    private $quantidadeSubstituidaRepository;

    public function __construct(QuantidadeSubstituidaRepository $quantidadeSubstituidaRepo)
    {
        $this->quantidadeSubstituidaRepository = $quantidadeSubstituidaRepo;
    }

    /**
     * Display a listing of the QuantidadeSubstituida.
     * GET|HEAD /quantidadesSubstituidas
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $quantidadesSubstituidas = $this->quantidadeSubstituidaRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($quantidadesSubstituidas->toArray(), 'Quantidades Substituidas listadas com sucesso');
    }

    /**
     * Store a newly created QuantidadeSubstituida in storage.
     * POST /quantidadesSubstituidas
     *
     * @param CreateQuantidadeSubstituidaAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateQuantidadeSubstituidaAPIRequest $request)
    {
        $input = $request->all();

        $quantidadeSubstituida = $this->quantidadeSubstituidaRepository->create($input);

        return $this->sendResponse($quantidadeSubstituida->toArray(), 'Quantidade Substituida salva com sucesso');
    }

    /**
     * Display the specified QuantidadeSubstituida.
     * GET|HEAD /quantidadesSubstituidas/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var QuantidadeSubstituida $quantidadeSubstituida */
        $quantidadeSubstituida = $this->quantidadeSubstituidaRepository->find($id);

        if (empty($quantidadeSubstituida)) {
            return $this->sendError('Quantidade Substituida não encontrada');
        }

        return $this->sendResponse($quantidadeSubstituida->toArray(), 'Quantidade Substituida listada com sucesso');
    }

    /**
     * Update the specified QuantidadeSubstituida in storage.
     * PUT/PATCH /quantidadesSubstituidas/{id}
     *
     * @param int $id
     * @param UpdateQuantidadeSubstituidaAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateQuantidadeSubstituidaAPIRequest $request)
    {
        $input = $request->all();

        /** @var QuantidadeSubstituida $quantidadeSubstituida */
        $quantidadeSubstituida = $this->quantidadeSubstituidaRepository->find($id);

        if (empty($quantidadeSubstituida)) {
            return $this->sendError('Quantidade Substituida não encontrada');
        }

        $quantidadeSubstituida = $this->quantidadeSubstituidaRepository->update($input, $id);

        return $this->sendResponse($quantidadeSubstituida->toArray(), 'Quantidade Substituida atualizada com sucesso');
    }

    /**
     * Remove the specified QuantidadeSubstituida from storage.
     * DELETE /quantidadesSubstituidas/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var QuantidadeSubstituida $quantidadeSubstituida */
        $quantidadeSubstituida = $this->quantidadeSubstituidaRepository->find($id);

        if (empty($quantidadeSubstituida)) {
            return $this->sendError('Quantidade Substituida não encontrada');
        }

        $quantidadeSubstituida->delete();

        return $this->sendResponse($id, 'Quantidade Substituida excluída com sucesso');
    }
}
