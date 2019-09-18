<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePotenciaAPIRequest;
use App\Http\Requests\API\UpdatePotenciaAPIRequest;
use App\Models\Potencia;
use App\Repositories\PotenciaRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class PotenciaController
 * @package App\Http\Controllers\API
 */

class PotenciaAPIController extends AppBaseController
{
    /** @var  PotenciaRepository */
    private $potenciaRepository;

    public function __construct(PotenciaRepository $potenciaRepo)
    {
        $this->potenciaRepository = $potenciaRepo;
    }

    /**
     * Display a listing of the Potencia.
     * GET|HEAD /potencias
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $potencias = $this->potenciaRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($potencias->toArray(), 'Potências listadas com sucesso');
    }

    /**
     * Store a newly created Potencia in storage.
     * POST /potencias
     *
     * @param CreatePotenciaAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatePotenciaAPIRequest $request)
    {
        $input = $request->all();

        $potencia = $this->potenciaRepository->create($input);

        return $this->sendResponse($potencia->toArray(), 'Potência salva com sucesso');
    }

    /**
     * Display the specified Potencia.
     * GET|HEAD /potencias/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Potencia $potencia */
        $potencia = $this->potenciaRepository->find($id);

        if (empty($potencia)) {
            return $this->sendError('Potência não encontrada');
        }

        return $this->sendResponse($potencia->toArray(), 'Potência listada com sucesso');
    }

    /**
     * Update the specified Potencia in storage.
     * PUT/PATCH /potencias/{id}
     *
     * @param int $id
     * @param UpdatePotenciaAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePotenciaAPIRequest $request)
    {
        $input = $request->all();

        /** @var Potencia $potencia */
        $potencia = $this->potenciaRepository->find($id);

        if (empty($potencia)) {
            return $this->sendError('Potência não encontrada');
        }

        $potencia = $this->potenciaRepository->update($input, $id);

        return $this->sendResponse($potencia->toArray(), 'Potência atualizada com sucesso');
    }

    /**
     * Remove the specified Potencia from storage.
     * DELETE /potencias/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Potencia $potencia */
        $potencia = $this->potenciaRepository->find($id);

        if (empty($potencia)) {
            return $this->sendError('Potência não encontrada');
        }

        $potencia->delete();

        return $this->sendResponse($id, 'Potencia deleted successfully');
    }
}
