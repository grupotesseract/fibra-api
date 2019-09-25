<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateLiberacaoDocumentoAPIRequest;
use App\Http\Requests\API\UpdateLiberacaoDocumentoAPIRequest;
use App\Models\LiberacaoDocumento;
use App\Repositories\LiberacaoDocumentoRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class LiberacaoDocumentoController
 * @package App\Http\Controllers\API
 */

class LiberacaoDocumentoAPIController extends AppBaseController
{
    /** @var  LiberacaoDocumentoRepository */
    private $liberacaoDocumentoRepository;

    public function __construct(LiberacaoDocumentoRepository $liberacaoDocumentoRepo)
    {
        $this->liberacaoDocumentoRepository = $liberacaoDocumentoRepo;
    }

    /**
     * Display a listing of the LiberacaoDocumento.
     * GET|HEAD /liberacoesDocumentos
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $liberacoesDocumentos = $this->liberacaoDocumentoRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($liberacoesDocumentos->toArray(), 'Liberacoes Documentos retrieved successfully');
    }

    /**
     * Store a newly created LiberacaoDocumento in storage.
     * POST /liberacoesDocumentos
     *
     * @param CreateLiberacaoDocumentoAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateLiberacaoDocumentoAPIRequest $request)
    {
        $input = $request->all();

        $liberacaoDocumento = $this->liberacaoDocumentoRepository->create($input);

        return $this->sendResponse($liberacaoDocumento->toArray(), 'Liberacao Documento saved successfully');
    }

    /**
     * Display the specified LiberacaoDocumento.
     * GET|HEAD /liberacoesDocumentos/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var LiberacaoDocumento $liberacaoDocumento */
        $liberacaoDocumento = $this->liberacaoDocumentoRepository->find($id);

        if (empty($liberacaoDocumento)) {
            return $this->sendError('Liberacao Documento not found');
        }

        return $this->sendResponse($liberacaoDocumento->toArray(), 'Liberacao Documento retrieved successfully');
    }

    /**
     * Update the specified LiberacaoDocumento in storage.
     * PUT/PATCH /liberacoesDocumentos/{id}
     *
     * @param int $id
     * @param UpdateLiberacaoDocumentoAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateLiberacaoDocumentoAPIRequest $request)
    {
        $input = $request->all();

        /** @var LiberacaoDocumento $liberacaoDocumento */
        $liberacaoDocumento = $this->liberacaoDocumentoRepository->find($id);

        if (empty($liberacaoDocumento)) {
            return $this->sendError('Liberacao Documento not found');
        }

        $liberacaoDocumento = $this->liberacaoDocumentoRepository->update($input, $id);

        return $this->sendResponse($liberacaoDocumento->toArray(), 'LiberacaoDocumento updated successfully');
    }

    /**
     * Remove the specified LiberacaoDocumento from storage.
     * DELETE /liberacoesDocumentos/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var LiberacaoDocumento $liberacaoDocumento */
        $liberacaoDocumento = $this->liberacaoDocumentoRepository->find($id);

        if (empty($liberacaoDocumento)) {
            return $this->sendError('Liberacao Documento not found');
        }

        $liberacaoDocumento->delete();

        return $this->sendResponse($id, 'Liberacao Documento deleted successfully');
    }
}
