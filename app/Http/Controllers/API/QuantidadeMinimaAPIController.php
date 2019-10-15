<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateQuantidadeMinimaAPIRequest;
use App\Http\Requests\API\UpdateQuantidadeMinimaAPIRequest;
use App\Models\QuantidadeMinima;
use App\Repositories\QuantidadeMinimaRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class QuantidadeMinimaController
 * @package App\Http\Controllers\API
 */

class QuantidadeMinimaAPIController extends AppBaseController
{
    /** @var  QuantidadeMinimaRepository */
    private $quantidadeMinimaRepository;

    public function __construct(QuantidadeMinimaRepository $quantidadeMinimaRepo)
    {
        $this->quantidadeMinimaRepository = $quantidadeMinimaRepo;
    }

    /**
     * Display a listing of the QuantidadeMinima.
     * GET|HEAD /quantidadesMinimas
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $quantidadesMinimas = $this->quantidadeMinimaRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($quantidadesMinimas->toArray(), 'Quantidades Minimas retrieved successfully');
    }

    /**
     * Store a newly created QuantidadeMinima in storage.
     * POST /quantidadesMinimas
     *
     * @param CreateQuantidadeMinimaAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateQuantidadeMinimaAPIRequest $request)
    {
        $input = $request->all();

        $quantidadeMinima = $this->quantidadeMinimaRepository->create($input);

        return $this->sendResponse($quantidadeMinima->toArray(), 'Quantidade Minima saved successfully');
    }

    /**
     * Display the specified QuantidadeMinima.
     * GET|HEAD /quantidadesMinimas/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var QuantidadeMinima $quantidadeMinima */
        $quantidadeMinima = $this->quantidadeMinimaRepository->find($id);

        if (empty($quantidadeMinima)) {
            return $this->sendError('Quantidade Minima not found');
        }

        return $this->sendResponse($quantidadeMinima->toArray(), 'Quantidade Minima retrieved successfully');
    }

    /**
     * Update the specified QuantidadeMinima in storage.
     * PUT/PATCH /quantidadesMinimas/{id}
     *
     * @param int $id
     * @param UpdateQuantidadeMinimaAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateQuantidadeMinimaAPIRequest $request)
    {
        $input = $request->all();

        /** @var QuantidadeMinima $quantidadeMinima */
        $quantidadeMinima = $this->quantidadeMinimaRepository->find($id);

        if (empty($quantidadeMinima)) {
            return $this->sendError('Quantidade Minima not found');
        }

        $quantidadeMinima = $this->quantidadeMinimaRepository->update($input, $id);

        return $this->sendResponse($quantidadeMinima->toArray(), 'QuantidadeMinima updated successfully');
    }

    /**
     * Remove the specified QuantidadeMinima from storage.
     * DELETE /quantidadesMinimas/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var QuantidadeMinima $quantidadeMinima */
        $quantidadeMinima = $this->quantidadeMinimaRepository->find($id);

        if (empty($quantidadeMinima)) {
            return $this->sendError('Quantidade Minima not found');
        }

        $quantidadeMinima->delete();

        return $this->sendResponse($id, 'Quantidade Minima deleted successfully');
    }
}
