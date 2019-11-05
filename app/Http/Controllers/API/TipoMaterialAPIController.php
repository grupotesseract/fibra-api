<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\CreateTipoMaterialAPIRequest;
use App\Http\Requests\API\UpdateTipoMaterialAPIRequest;
use App\Models\TipoMaterial;
use App\Repositories\TipoMaterialRepository;
use Illuminate\Http\Request;
use Response;

/**
 * Class TipoMaterialController.
 */
class TipoMaterialAPIController extends AppBaseController
{
    /** @var TipoMaterialRepository */
    private $tipoMaterialRepository;

    public function __construct(TipoMaterialRepository $tipoMaterialRepo)
    {
        $this->tipoMaterialRepository = $tipoMaterialRepo;
    }

    /**
     * Display a listing of the TipoMaterial.
     * GET|HEAD /tiposMateriais.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $tiposMateriais = $this->tipoMaterialRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($tiposMateriais->toArray(), 'Tipos Materiais listados com sucesso');
    }

    /**
     * Store a newly created TipoMaterial in storage.
     * POST /tiposMateriais.
     *
     * @param CreateTipoMaterialAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateTipoMaterialAPIRequest $request)
    {
        $input = $request->all();

        $tipoMaterial = $this->tipoMaterialRepository->create($input);

        return $this->sendResponse($tipoMaterial->toArray(), 'Tipo Material salvo com sucesso');
    }

    /**
     * Display the specified TipoMaterial.
     * GET|HEAD /tiposMateriais/{id}.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var TipoMaterial $tipoMaterial */
        $tipoMaterial = $this->tipoMaterialRepository->find($id);

        if (empty($tipoMaterial)) {
            return $this->sendError('Tipo Material not found');
        }

        return $this->sendResponse($tipoMaterial->toArray(), 'Tipo Material listado com sucesso');
    }

    /**
     * Update the specified TipoMaterial in storage.
     * PUT/PATCH /tiposMateriais/{id}.
     *
     * @param int $id
     * @param UpdateTipoMaterialAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTipoMaterialAPIRequest $request)
    {
        $input = $request->all();

        /** @var TipoMaterial $tipoMaterial */
        $tipoMaterial = $this->tipoMaterialRepository->find($id);

        if (empty($tipoMaterial)) {
            return $this->sendError('Tipo Material not found');
        }

        $tipoMaterial = $this->tipoMaterialRepository->update($input, $id);

        return $this->sendResponse($tipoMaterial->toArray(), 'Tipo Material atualizado com sucesso');
    }

    /**
     * Remove the specified TipoMaterial from storage.
     * DELETE /tiposMateriais/{id}.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var TipoMaterial $tipoMaterial */
        $tipoMaterial = $this->tipoMaterialRepository->find($id);

        if (empty($tipoMaterial)) {
            return $this->sendError('Tipo Material not found');
        }

        $tipoMaterial->delete();

        return $this->sendResponse($id, 'Tipo Material excluído com sucesso');
    }
}
