<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePlantaAPIRequest;
use App\Http\Requests\API\UpdatePlantaAPIRequest;
use App\Models\Planta;
use App\Repositories\PlantaRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class PlantaController
 * @package App\Http\Controllers\API
 */

class PlantaAPIController extends AppBaseController
{
    /** @var  PlantaRepository */
    private $plantaRepository;

    public function __construct(PlantaRepository $plantaRepo)
    {
        $this->plantaRepository = $plantaRepo;
    }

    /**
     * Display a listing of the Planta.
     * GET|HEAD /plantas
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $plantas = $this->plantaRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($plantas->toArray(), 'Plantas retrieved successfully');
    }

    /**
     * Store a newly created Planta in storage.
     * POST /plantas
     *
     * @param CreatePlantaAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatePlantaAPIRequest $request)
    {
        $input = $request->all();

        $planta = $this->plantaRepository->create($input);

        return $this->sendResponse($planta->toArray(), 'Planta saved successfully');
    }

    /**
     * Display the specified Planta.
     * GET|HEAD /plantas/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Planta $planta */
        $planta = $this->plantaRepository->find($id);

        if (empty($planta)) {
            return $this->sendError('Planta not found');
        }

        return $this->sendResponse($planta->toArray(), 'Planta retrieved successfully');
    }

    /**
     * Update the specified Planta in storage.
     * PUT/PATCH /plantas/{id}
     *
     * @param int $id
     * @param UpdatePlantaAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePlantaAPIRequest $request)
    {
        $input = $request->all();

        /** @var Planta $planta */
        $planta = $this->plantaRepository->find($id);

        if (empty($planta)) {
            return $this->sendError('Planta not found');
        }

        $planta = $this->plantaRepository->update($input, $id);

        return $this->sendResponse($planta->toArray(), 'Planta updated successfully');
    }

    /**
     * Remove the specified Planta from storage.
     * DELETE /plantas/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Planta $planta */
        $planta = $this->plantaRepository->find($id);

        if (empty($planta)) {
            return $this->sendError('Planta not found');
        }

        $planta->delete();

        return $this->sendResponse($id, 'Planta deleted successfully');
    }
}
