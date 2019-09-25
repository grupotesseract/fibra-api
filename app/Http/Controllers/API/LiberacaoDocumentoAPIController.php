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

        return $this->sendResponse($liberacoesDocumentos->toArray(), 'Liberações de Documentos listadas com sucesso');
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

        return $this->sendResponse($liberacaoDocumento->toArray(), 'Liberação de Documento salva com sucesso');
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
            return $this->sendError('Liberação de Documento não encontrada');
        }

        return $this->sendResponse($liberacaoDocumento->toArray(), 'Liberação de Documento listada com sucesso');
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
            return $this->sendError('Liberação de Documento não encontrada');
        }

        $liberacaoDocumento = $this->liberacaoDocumentoRepository->update($input, $id);

        return $this->sendResponse($liberacaoDocumento->toArray(), 'Liberação de Documento atualizada com sucesso');
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
            return $this->sendError('Liberação de Documento não encontrada');
        }

        $liberacaoDocumento->delete();

        return $this->sendResponse($id, 'Liberação de Documento excluída com sucesso');
    }
}
