<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\CreateQuantidadeMinimaAPIRequest;
use App\Http\Requests\API\UpdateQuantidadeMinimaAPIRequest;
use App\Models\QuantidadeMinima;
use App\Repositories\QuantidadeMinimaRepository;
use Illuminate\Http\Request;
use Response;

/**
 * Class QuantidadeMinimaController.
 */
class QuantidadeMinimaAPIController extends AppBaseController
{
    /** @var QuantidadeMinimaRepository */
    private $quantidadeMinimaRepository;

    public function __construct(QuantidadeMinimaRepository $quantidadeMinimaRepo)
    {
        $this->quantidadeMinimaRepository = $quantidadeMinimaRepo;
    }

    /**
     * Display a listing of the QuantidadeMinima.
     * GET|HEAD /quantidadesMinimas.
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

        return $this->sendResponse($quantidadesMinimas->toArray(), 'Quantidades Minimas listadas com sucesso');
    }

    /**
     * Store a newly created QuantidadeMinima in storage.
     * POST /quantidadesMinimas.
     *
     * @param CreateQuantidadeMinimaAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateQuantidadeMinimaAPIRequest $request)
    {
        $input = $request->all();

        $quantidadeMinima = $this->quantidadeMinimaRepository->create($input);

        return $this->sendResponse($quantidadeMinima->toArray(), 'Quantidade Minima salva com sucesso');
    }

    /**
     * Display the specified QuantidadeMinima.
     * GET|HEAD /quantidadesMinimas/{id}.
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
            return $this->sendError('Quantidade Minima não encontrada');
        }

        return $this->sendResponse($quantidadeMinima->toArray(), 'Quantidade Minima listada com sucesso');
    }

    /**
     * Update the specified QuantidadeMinima in storage.
     * PUT/PATCH /quantidadesMinimas/{id}.
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
            return $this->sendError('Quantidade Minima não encontrada');
        }

        $quantidadeMinima = $this->quantidadeMinimaRepository->update($input, $id);

        return $this->sendResponse($quantidadeMinima->toArray(), 'Quantidade Minima atualizada com sucesso');
    }

    /**
     * Remove the specified QuantidadeMinima from storage.
     * DELETE /quantidadesMinimas/{id}.
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
            return $this->sendError('Quantidade Minima não encontrada');
        }

        $quantidadeMinima->delete();

        return $this->sendResponse($id, 'Quantidade Minima excluída com sucesso');
    }
}
