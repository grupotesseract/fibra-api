<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateMaterialAPIRequest;
use App\Http\Requests\API\UpdateMaterialAPIRequest;
use App\Models\Material;
use App\Repositories\MaterialRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class MaterialController
 * @package App\Http\Controllers\API
 */

class MaterialAPIController extends AppBaseController
{
    /** @var  MaterialRepository */
    private $materialRepository;

    public function __construct(MaterialRepository $materialRepo)
    {
        $this->materialRepository = $materialRepo;
    }

    /**
     * Display a listing of the Material.
     * GET|HEAD /materiais
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

        return $this->sendResponse($materiais->toArray(), 'Materiais retrieved successfully');
    }

    /**
     * Store a newly created Material in storage.
     * POST /materiais
     *
     * @param CreateMaterialAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateMaterialAPIRequest $request)
    {
        $input = $request->all();

        $material = $this->materialRepository->create($input);

        return $this->sendResponse($material->toArray(), 'Material saved successfully');
    }

    /**
     * Display the specified Material.
     * GET|HEAD /materiais/{id}
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
            return $this->sendError('Material not found');
        }

        return $this->sendResponse($material->toArray(), 'Material retrieved successfully');
    }

    /**
     * Update the specified Material in storage.
     * PUT/PATCH /materiais/{id}
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
            return $this->sendError('Material not found');
        }

        $material = $this->materialRepository->update($input, $id);

        return $this->sendResponse($material->toArray(), 'Material updated successfully');
    }

    /**
     * Remove the specified Material from storage.
     * DELETE /materiais/{id}
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
            return $this->sendError('Material not found');
        }

        $material->delete();

        return $this->sendResponse($id, 'Material deleted successfully');
    }
}
