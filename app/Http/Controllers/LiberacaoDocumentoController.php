<?php

namespace App\Http\Controllers;

use App\DataTables\LiberacaoDocumentoDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateLiberacaoDocumentoRequest;
use App\Http\Requests\UpdateLiberacaoDocumentoRequest;
use App\Repositories\LiberacaoDocumentoRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class LiberacaoDocumentoController extends AppBaseController
{
    /** @var  LiberacaoDocumentoRepository */
    private $liberacaoDocumentoRepository;

    public function __construct(LiberacaoDocumentoRepository $liberacaoDocumentoRepo)
    {
        $this->liberacaoDocumentoRepository = $liberacaoDocumentoRepo;
    }

    /**
     * Display a listing of the LiberacaoDocumento.
     *
     * @param LiberacaoDocumentoDataTable $liberacaoDocumentoDataTable
     * @return Response
     */
    public function index(LiberacaoDocumentoDataTable $liberacaoDocumentoDataTable)
    {
        return $liberacaoDocumentoDataTable->render('liberacoes_documentos.index');
    }

    /**
     * Show the form for creating a new LiberacaoDocumento.
     *
     * @return Response
     */
    public function create()
    {
        return view('liberacoes_documentos.create');
    }

    /**
     * Store a newly created LiberacaoDocumento in storage.
     *
     * @param CreateLiberacaoDocumentoRequest $request
     *
     * @return Response
     */
    public function store(CreateLiberacaoDocumentoRequest $request)
    {
        $input = $request->all();

        $liberacaoDocumento = $this->liberacaoDocumentoRepository->create($input);

        Flash::success('Liberação de Documento salva com sucesso');

        return redirect(route('liberacoesDocumentos.index'));
    }

    /**
     * Display the specified LiberacaoDocumento.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $liberacaoDocumento = $this->liberacaoDocumentoRepository->find($id);

        if (empty($liberacaoDocumento)) {
            Flash::error('Liberação de Documento não encontrada');

            return redirect(route('liberacoesDocumentos.index'));
        }

        return view('liberacoes_documentos.show')->with('liberacaoDocumento', $liberacaoDocumento);
    }

    /**
     * Show the form for editing the specified LiberacaoDocumento.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $liberacaoDocumento = $this->liberacaoDocumentoRepository->find($id);

        if (empty($liberacaoDocumento)) {
            Flash::error('Liberação de Documento não encontrada');

            return redirect(route('liberacoesDocumentos.index'));
        }

        return view('liberacoes_documentos.edit')->with('liberacaoDocumento', $liberacaoDocumento);
    }

    /**
     * Update the specified LiberacaoDocumento in storage.
     *
     * @param  int              $id
     * @param UpdateLiberacaoDocumentoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateLiberacaoDocumentoRequest $request)
    {
        $liberacaoDocumento = $this->liberacaoDocumentoRepository->find($id);

        if (empty($liberacaoDocumento)) {
            Flash::error('Liberação de Documento não encontrada');

            return redirect(route('liberacoesDocumentos.index'));
        }

        $liberacaoDocumento = $this->liberacaoDocumentoRepository->update($request->all(), $id);

        Flash::success('Liberação de Documento atualizada com sucesso');

        return redirect(route('liberacoesDocumentos.index'));
    }

    /**
     * Remove the specified LiberacaoDocumento from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $liberacaoDocumento = $this->liberacaoDocumentoRepository->find($id);

        if (empty($liberacaoDocumento)) {
            Flash::error('Liberação de Documento não encontrada');

            return redirect(route('liberacoesDocumentos.index'));
        }

        $this->liberacaoDocumentoRepository->delete($id);

        Flash::success('Liberação de Documento excluída com sucesso');

        return redirect(route('liberacoesDocumentos.index'));
    }
}
