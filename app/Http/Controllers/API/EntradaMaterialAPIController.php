<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateEntradaMaterialAPIRequest;
use App\Http\Requests\API\UpdateEntradaMaterialAPIRequest;
use App\Models\EntradaMaterial;
use App\Repositories\EntradaMaterialRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class EntradaMaterialController
 * @package App\Http\Controllers\API
 */

class EntradaMaterialAPIController extends AppBaseController
{
    /** @var  EntradaMaterialRepository */
    private $entradaMaterialRepository;

    public function __construct(EntradaMaterialRepository $entradaMaterialRepo)
    {
        $this->entradaMaterialRepository = $entradaMaterialRepo;
    }

    /**
     * Display a listing of the EntradaMaterial.
     * GET|HEAD /entradasMateriais
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $entradasMateriais = $this->entradaMaterialRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($entradasMateriais->toArray(), 'Entradas de materiais obtidas com sucesso');
    }

    /**
     * Store a newly created EntradaMaterial in storage.
     * POST /entradasMateriais
     *
     * @param CreateEntradaMaterialAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateEntradaMaterialAPIRequest $request)
    {
        $input = $request->all();

        $entradaMaterial = $this->entradaMaterialRepository->create($input);

        return $this->sendResponse($entradaMaterial->toArray(), 'Entrada de material salvo com sucesso');
    }

    /**
     * Display the specified EntradaMaterial.
     * GET|HEAD /entradasMateriais/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var EntradaMaterial $entradaMaterial */
        $entradaMaterial = $this->entradaMaterialRepository->find($id);

        if (empty($entradaMaterial)) {
            return $this->sendError('Entrada de material não encontrada');
        }

        return $this->sendResponse($entradaMaterial->toArray(), 'Entrada de material obtida com sucesso');
    }

    /**
     * Update the specified EntradaMaterial in storage.
     * PUT/PATCH /entradasMateriais/{id}
     *
     * @param int $id
     * @param UpdateEntradaMaterialAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateEntradaMaterialAPIRequest $request)
    {
        $input = $request->all();

        /** @var EntradaMaterial $entradaMaterial */
        $entradaMaterial = $this->entradaMaterialRepository->find($id);

        if (empty($entradaMaterial)) {
            return $this->sendError('Entrada de material não encontrada');
        }

        $entradaMaterial = $this->entradaMaterialRepository->update($input, $id);

        return $this->sendResponse($entradaMaterial->toArray(), 'Entrada de material atualizada com sucesso');
    }

    /**
     * Remove the specified EntradaMaterial from storage.
     * DELETE /entradasMateriais/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var EntradaMaterial $entradaMaterial */
        $entradaMaterial = $this->entradaMaterialRepository->find($id);

        if (empty($entradaMaterial)) {
            return $this->sendError('Entrada de material não encontrada');
        }

        $entradaMaterial->delete();

        return $this->sendResponse($id, 'Entrada de material removida com sucesso');
    }
}
