<?php

namespace App\Http\Controllers\API;

use Response;
use App\Models\Planta;
use Illuminate\Http\Request;
use App\Repositories\PlantaRepository;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\CreatePlantaAPIRequest;
use App\Http\Requests\API\UpdatePlantaAPIRequest;

/**
 * Class PlantaController.
 */
class PlantaAPIController extends AppBaseController
{
    /** @var PlantaRepository */
    private $plantaRepository;

    public function __construct(PlantaRepository $plantaRepo)
    {
        $this->plantaRepository = $plantaRepo;
    }

    /**
     * Display a listing of the Planta.
     * GET|HEAD /plantas.
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

        return $this->sendResponse($plantas->toArray(), 'Plantas listadas com sucesso');
    }

    /**
     * Store a newly created Planta in storage.
     * POST /plantas.
     *
     * @param CreatePlantaAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatePlantaAPIRequest $request)
    {
        $input = $request->all();

        $planta = $this->plantaRepository->create($input);

        return $this->sendResponse($planta->toArray(), 'Planta salva com sucesso');
    }

    /**
     * Display the specified Planta.
     * GET|HEAD /plantas/{id}.
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

        return $this->sendResponse($planta->toArray(), 'Planta listada com sucesso');
    }

    /**
     * Update the specified Planta in storage.
     * PUT/PATCH /plantas/{id}.
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
            return $this->sendError('Planta não encontrada');
        }

        $planta = $this->plantaRepository->update($input, $id);

        return $this->sendResponse($planta->toArray(), 'Planta atualizada com sucesso');
    }

    /**
     * Remove the specified Planta from storage.
     * DELETE /plantas/{id}.
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
            return $this->sendError('Planta não encontrada');
        }

        $planta->delete();

        return $this->sendResponse($id, 'Planta excluída com sucesso');
    }

    public function syncPlantas()
    {
        $plantas = Planta::with('programacaoMaisRecente')->get();
        
        return $this->sendResponse($plantas->toArray(), 'Plantas listadas com sucesso');
    }
}
