<?php

namespace App\Http\Controllers;

use App\DataTables\ProgramacaoDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateProgramacaoRequest;
use App\Http\Requests\UpdateProgramacaoRequest;
use App\Repositories\ProgramacaoRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class ProgramacaoController extends AppBaseController
{
    /** @var  ProgramacaoRepository */
    private $programacaoRepository;

    public function __construct(ProgramacaoRepository $programacaoRepo)
    {
        $this->programacaoRepository = $programacaoRepo;
    }

    /**
     * Display a listing of the Programacao.
     *
     * @param ProgramacaoDataTable $programacaoDataTable
     * @return Response
     */
    public function index(ProgramacaoDataTable $programacaoDataTable)
    {
        return $programacaoDataTable->render('programacoes.index');
    }

    /**
     * Show the form for creating a new Programacao.
     *
     * @return Response
     */
    public function create()
    {
        return view('programacoes.create');
    }

    /**
     * Store a newly created Programacao in storage.
     *
     * @param CreateProgramacaoRequest $request
     *
     * @return Response
     */
    public function store(CreateProgramacaoRequest $request)
    {
        $input = $request->all();

        $programacao = $this->programacaoRepository->create($input);

        Flash::success('Programacao saved successfully.');

        return redirect(route('programacoes.index'));
    }

    /**
     * Display the specified Programacao.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $programacao = $this->programacaoRepository->find($id);

        if (empty($programacao)) {
            Flash::error('Programacao not found');

            return redirect(route('programacoes.index'));
        }

        return view('programacoes.show')->with('programacao', $programacao);
    }

    /**
     * Show the form for editing the specified Programacao.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $programacao = $this->programacaoRepository->find($id);

        if (empty($programacao)) {
            Flash::error('Programacao not found');

            return redirect(route('programacoes.index'));
        }

        return view('programacoes.edit')->with('programacao', $programacao);
    }

    /**
     * Update the specified Programacao in storage.
     *
     * @param  int              $id
     * @param UpdateProgramacaoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProgramacaoRequest $request)
    {
        $programacao = $this->programacaoRepository->find($id);

        if (empty($programacao)) {
            Flash::error('Programacao not found');

            return redirect(route('programacoes.index'));
        }

        $programacao = $this->programacaoRepository->update($request->all(), $id);

        Flash::success('Programacao updated successfully.');

        return redirect(route('programacoes.index'));
    }

    /**
     * Remove the specified Programacao from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $programacao = $this->programacaoRepository->find($id);

        if (empty($programacao)) {
            Flash::error('Programacao not found');

            return redirect(route('programacoes.index'));
        }

        $this->programacaoRepository->delete($id);

        Flash::success('Programacao deleted successfully.');

        return redirect(route('programacoes.index'));
    }
}
