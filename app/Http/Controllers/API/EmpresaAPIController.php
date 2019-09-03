<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateEmpresaAPIRequest;
use App\Http\Requests\API\UpdateEmpresaAPIRequest;
use App\Models\Empresa;
use App\Repositories\EmpresaRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class EmpresaController
 * @package App\Http\Controllers\API
 */

class EmpresaAPIController extends AppBaseController
{
    /** @var  EmpresaRepository */
    private $empresaRepository;

    public function __construct(EmpresaRepository $empresaRepo)
    {
        $this->empresaRepository = $empresaRepo;
    }

    /**
     * Display a listing of the Empresa.
     * GET|HEAD /empresas
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $empresas = $this->empresaRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($empresas->toArray(), 'Empresas retrieved successfully');
    }

    /**
     * Store a newly created Empresa in storage.
     * POST /empresas
     *
     * @param CreateEmpresaAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateEmpresaAPIRequest $request)
    {
        $input = $request->all();

        $empresa = $this->empresaRepository->create($input);

        return $this->sendResponse($empresa->toArray(), 'Empresa saved successfully');
    }

    /**
     * Display the specified Empresa.
     * GET|HEAD /empresas/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Empresa $empresa */
        $empresa = $this->empresaRepository->find($id);

        if (empty($empresa)) {
            return $this->sendError('Empresa not found');
        }

        return $this->sendResponse($empresa->toArray(), 'Empresa retrieved successfully');
    }

    /**
     * Update the specified Empresa in storage.
     * PUT/PATCH /empresas/{id}
     *
     * @param int $id
     * @param UpdateEmpresaAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateEmpresaAPIRequest $request)
    {
        $input = $request->all();

        /** @var Empresa $empresa */
        $empresa = $this->empresaRepository->find($id);

        if (empty($empresa)) {
            return $this->sendError('Empresa not found');
        }

        $empresa = $this->empresaRepository->update($input, $id);

        return $this->sendResponse($empresa->toArray(), 'Empresa updated successfully');
    }

    /**
     * Remove the specified Empresa from storage.
     * DELETE /empresas/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Empresa $empresa */
        $empresa = $this->empresaRepository->find($id);

        if (empty($empresa)) {
            return $this->sendError('Empresa not found');
        }

        $empresa->delete();

        return $this->sendResponse($id, 'Empresa deleted successfully');
    }
}
