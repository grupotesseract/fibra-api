<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateAtividadeRealizadaAPIRequest;
use App\Http\Requests\API\UpdateAtividadeRealizadaAPIRequest;
use App\Models\AtividadeRealizada;
use App\Repositories\AtividadeRealizadaRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class AtividadeRealizadaController
 * @package App\Http\Controllers\API
 */

class AtividadeRealizadaAPIController extends AppBaseController
{
    /** @var  AtividadeRealizadaRepository */
    private $atividadeRealizadaRepository;

    public function __construct(AtividadeRealizadaRepository $atividadeRealizadaRepo)
    {
        $this->atividadeRealizadaRepository = $atividadeRealizadaRepo;
    }

    /**
     * Display a listing of the AtividadeRealizada.
     * GET|HEAD /atividadesRealizadas
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $atividadesRealizadas = $this->atividadeRealizadaRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($atividadesRealizadas->toArray(), 'Atividades Realizadas retrieved successfully');
    }

    /**
     * Store a newly created AtividadeRealizada in storage.
     * POST /atividadesRealizadas
     *
     * @param CreateAtividadeRealizadaAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateAtividadeRealizadaAPIRequest $request)
    {
        $input = $request->all();

        $atividadeRealizada = $this->atividadeRealizadaRepository->create($input);

        return $this->sendResponse($atividadeRealizada->toArray(), 'Atividade Realizada saved successfully');
    }

    /**
     * Display the specified AtividadeRealizada.
     * GET|HEAD /atividadesRealizadas/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var AtividadeRealizada $atividadeRealizada */
        $atividadeRealizada = $this->atividadeRealizadaRepository->find($id);

        if (empty($atividadeRealizada)) {
            return $this->sendError('Atividade Realizada not found');
        }

        return $this->sendResponse($atividadeRealizada->toArray(), 'Atividade Realizada retrieved successfully');
    }

    /**
     * Update the specified AtividadeRealizada in storage.
     * PUT/PATCH /atividadesRealizadas/{id}
     *
     * @param int $id
     * @param UpdateAtividadeRealizadaAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAtividadeRealizadaAPIRequest $request)
    {
        $input = $request->all();

        /** @var AtividadeRealizada $atividadeRealizada */
        $atividadeRealizada = $this->atividadeRealizadaRepository->find($id);

        if (empty($atividadeRealizada)) {
            return $this->sendError('Atividade Realizada not found');
        }

        $atividadeRealizada = $this->atividadeRealizadaRepository->update($input, $id);

        return $this->sendResponse($atividadeRealizada->toArray(), 'AtividadeRealizada updated successfully');
    }

    /**
     * Remove the specified AtividadeRealizada from storage.
     * DELETE /atividadesRealizadas/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var AtividadeRealizada $atividadeRealizada */
        $atividadeRealizada = $this->atividadeRealizadaRepository->find($id);

        if (empty($atividadeRealizada)) {
            return $this->sendError('Atividade Realizada not found');
        }

        $atividadeRealizada->delete();

        return $this->sendSuccess('Atividade Realizada deleted successfully');
    }
}
