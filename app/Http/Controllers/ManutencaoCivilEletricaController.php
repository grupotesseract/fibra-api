<?php

namespace App\Http\Controllers;

use App\DataTables\ManutencaoCivilEletricaDataTable;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests;
use App\Http\Requests\CreateManutencaoCivilEletricaRequest;
use App\Http\Requests\UpdateManutencaoCivilEletricaRequest;
use App\Repositories\ManutencaoCivilEletricaRepository;
use Flash;
use Response;

class ManutencaoCivilEletricaController extends AppBaseController
{
    /** @var ManutencaoCivilEletricaRepository */
    private $manutencaoCivilEletricaRepository;

    public function __construct(ManutencaoCivilEletricaRepository $manutencaoCivilEletricaRepo)
    {
        $this->manutencaoCivilEletricaRepository = $manutencaoCivilEletricaRepo;
    }

    /**
     * Display a listing of the ManutencaoCivilEletrica.
     *
     * @param ManutencaoCivilEletricaDataTable $manutencaoCivilEletricaDataTable
     * @return Response
     */
    public function index(ManutencaoCivilEletricaDataTable $manutencaoCivilEletricaDataTable)
    {
        return $manutencaoCivilEletricaDataTable->render('manutencoes_civil_eletrica.index');
    }

    /**
     * Show the form for creating a new ManutencaoCivilEletrica.
     *
     * @return Response
     */
    public function create()
    {
        return view('manutencoes_civil_eletrica.create');
    }

    /**
     * Store a newly created ManutencaoCivilEletrica in storage.
     *
     * @param CreateManutencaoCivilEletricaRequest $request
     *
     * @return Response
     */
    public function store(CreateManutencaoCivilEletricaRequest $request)
    {
        $input = $request->all();

        $manutencaoCivilEletrica = $this->manutencaoCivilEletricaRepository->create($input);

        Flash::success('Manutencao Civil Eletrica salva com sucesso.');

        return redirect(route('manutencoesCivilEletrica.index'));
    }

    /**
     * Display the specified ManutencaoCivilEletrica.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $manutencaoCivilEletrica = $this->manutencaoCivilEletricaRepository->find($id);

        if (empty($manutencaoCivilEletrica)) {
            Flash::error('Manutencao Civil Eletrica não encontrada');

            return redirect(route('manutencoesCivilEletrica.index'));
        }

        return view('manutencoes_civil_eletrica.show')->with('manutencaoCivilEletrica', $manutencaoCivilEletrica);
    }

    /**
     * Show the form for editing the specified ManutencaoCivilEletrica.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $manutencaoCivilEletrica = $this->manutencaoCivilEletricaRepository->find($id);

        if (empty($manutencaoCivilEletrica)) {
            Flash::error('Manutencao Civil Eletrica não encontrada');

            return redirect(route('manutencoesCivilEletrica.index'));
        }

        return view('manutencoes_civil_eletrica.edit')->with('manutencaoCivilEletrica', $manutencaoCivilEletrica);
    }

    /**
     * Update the specified ManutencaoCivilEletrica in storage.
     *
     * @param  int              $id
     * @param UpdateManutencaoCivilEletricaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateManutencaoCivilEletricaRequest $request)
    {
        $manutencaoCivilEletrica = $this->manutencaoCivilEletricaRepository->find($id);

        if (empty($manutencaoCivilEletrica)) {
            Flash::error('Manutencao Civil Eletrica não encontrada');

            return redirect(route('manutencoesCivilEletrica.index'));
        }

        $manutencaoCivilEletrica = $this->manutencaoCivilEletricaRepository->update($request->all(), $id);

        Flash::success('Manutencao Civil Eletrica atualizada com sucesso.');

        return redirect(route('manutencoesCivilEletrica.index'));
    }

    /**
     * Remove the specified ManutencaoCivilEletrica from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $manutencaoCivilEletrica = $this->manutencaoCivilEletricaRepository->find($id);

        if (empty($manutencaoCivilEletrica)) {
            Flash::error('Manutencao Civil Eletrica não encontrada');

            return redirect(route('manutencoesCivilEletrica.index'));
        }

        $this->manutencaoCivilEletricaRepository->delete($id);

        Flash::success('Manutencao Civil Eletrica excluída com sucesso.');

        return redirect(route('manutencoesCivilEletrica.index'));
    }

    public function downloadRelatorio($id) 
    {
        $manutencaoCivilEletrica = $this->manutencaoCivilEletricaRepository->find($id);

        if (empty($manutencaoCivilEletrica)) {
            Flash::error('Manutencao Civil Eletrica não encontrada');

            return redirect(route('manutencoesCivilEletrica.index'));
        }

        $rdo = $this->manutencaoCivilEletricaRepository->relatorioRDO($manutencaoCivilEletrica);
        
        return \Response::download($rdo);
    }
}
