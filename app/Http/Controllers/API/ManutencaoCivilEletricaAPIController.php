<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateManutencaoCivilEletricaAPIRequest;
use App\Http\Requests\API\UpdateManutencaoCivilEletricaAPIRequest;
use App\Models\ManutencaoCivilEletrica;
use App\Repositories\ManutencaoCivilEletricaRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ManutencaoCivilEletricaController
 * @package App\Http\Controllers\API
 */

class ManutencaoCivilEletricaAPIController extends AppBaseController
{
    /** @var  ManutencaoCivilEletricaRepository */
    private $manutencaoCivilEletricaRepository;

    public function __construct(ManutencaoCivilEletricaRepository $manutencaoCivilEletricaRepo)
    {
        $this->manutencaoCivilEletricaRepository = $manutencaoCivilEletricaRepo;
    }

    /**
     * Display a listing of the ManutencaoCivilEletrica.
     * GET|HEAD /manutencoesCivilEletrica
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $manutencoesCivilEletrica = $this->manutencaoCivilEletricaRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($manutencoesCivilEletrica->toArray(), 'Manutencoes Civil Eletrica retrieved successfully');
    }

    /**
     * Store a newly created ManutencaoCivilEletrica in storage.
     * POST /manutencoesCivilEletrica
     *
     * @param CreateManutencaoCivilEletricaAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateManutencaoCivilEletricaAPIRequest $request)
    {
        $input = $request->all();

        $manutencaoCivilEletrica = $this->manutencaoCivilEletricaRepository->create($input);

        return $this->sendResponse($manutencaoCivilEletrica->toArray(), 'Manutencao Civil Eletrica saved successfully');
    }

    /**
     * Display the specified ManutencaoCivilEletrica.
     * GET|HEAD /manutencoesCivilEletrica/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var ManutencaoCivilEletrica $manutencaoCivilEletrica */
        $manutencaoCivilEletrica = $this->manutencaoCivilEletricaRepository->find($id);

        if (empty($manutencaoCivilEletrica)) {
            return $this->sendError('Manutencao Civil Eletrica not found');
        }

        return $this->sendResponse($manutencaoCivilEletrica->toArray(), 'Manutencao Civil Eletrica retrieved successfully');
    }

    /**
     * Update the specified ManutencaoCivilEletrica in storage.
     * PUT/PATCH /manutencoesCivilEletrica/{id}
     *
     * @param int $id
     * @param UpdateManutencaoCivilEletricaAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateManutencaoCivilEletricaAPIRequest $request)
    {
        $input = $request->all();

        /** @var ManutencaoCivilEletrica $manutencaoCivilEletrica */
        $manutencaoCivilEletrica = $this->manutencaoCivilEletricaRepository->find($id);

        if (empty($manutencaoCivilEletrica)) {
            return $this->sendError('Manutencao Civil Eletrica not found');
        }

        $manutencaoCivilEletrica = $this->manutencaoCivilEletricaRepository->update($input, $id);

        return $this->sendResponse($manutencaoCivilEletrica->toArray(), 'ManutencaoCivilEletrica updated successfully');
    }

    /**
     * Remove the specified ManutencaoCivilEletrica from storage.
     * DELETE /manutencoesCivilEletrica/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var ManutencaoCivilEletrica $manutencaoCivilEletrica */
        $manutencaoCivilEletrica = $this->manutencaoCivilEletricaRepository->find($id);

        if (empty($manutencaoCivilEletrica)) {
            return $this->sendError('Manutencao Civil Eletrica not found');
        }

        $manutencaoCivilEletrica->delete();

        return $this->sendSuccess('Manutencao Civil Eletrica deleted successfully');
    }
}
