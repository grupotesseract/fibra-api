<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\CreateMaterialAPIRequest;
use App\Http\Requests\API\UpdateMaterialAPIRequest;
use App\Models\Material;
use App\Repositories\MaterialRepository;
use Illuminate\Http\Request;
use Response;

/**
 * Class MaterialController.
 */
class MaterialAPIController extends AppBaseController
{
    /** @var MaterialRepository */
    private $materialRepository;

    public function __construct(MaterialRepository $materialRepo)
    {
        $this->materialRepository = $materialRepo;
    }

    /**
     * Display a listing of the Material.
     * GET|HEAD /materiais.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $materiais = $this->materialRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($materiais->toArray(), 'Materiais listados com sucesso');
    }

    /**
     * Store a newly created Material in storage.
     * POST /materiais.
     *
     * @param CreateMaterialAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateMaterialAPIRequest $request)
    {
        $input = $request->all();

        $material = $this->materialRepository->create($input);

        return $this->sendResponse($material->toArray(), 'Material salvo com sucesso');
    }

    /**
     * Display the specified Material.
     * GET|HEAD /materiais/{id}.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Material $material */
        $material = $this->materialRepository->find($id);

        if (empty($material)) {
            return $this->sendError('Material não encontrado');
        }

        return $this->sendResponse($material->toArray(), 'Material listado com sucesso');
    }

    /**
     * Update the specified Material in storage.
     * PUT/PATCH /materiais/{id}.
     *
     * @param int $id
     * @param UpdateMaterialAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMaterialAPIRequest $request)
    {
        $input = $request->all();

        /** @var Material $material */
        $material = $this->materialRepository->find($id);

        if (empty($material)) {
            return $this->sendError('Material não encontrado');
        }

        $material = $this->materialRepository->update($input, $id);

        return $this->sendResponse($material->toArray(), 'Material atualizado com sucesso');
    }

    /**
     * Remove the specified Material from storage.
     * DELETE /materiais/{id}.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Material $material */
        $material = $this->materialRepository->find($id);

        if (empty($material)) {
            return $this->sendError('Material não encontrado');
        }

        $material->delete();

        return $this->sendResponse($id, 'Material excluído com sucesso');
    }
}
