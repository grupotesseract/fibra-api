<?php

namespace App\Http\Controllers;

use Flash;
use Response;
use App\Http\Requests;
use App\Http\Controllers\AppBaseController;
use App\DataTables\AtividadeRealizadaDataTable;
use App\DataTables\ManutencaoCivilEletricaDataTable;
use App\DataTables\Scopes\PorIdManCivilEletricaScope;
use App\Repositories\ManutencaoCivilEletricaRepository;
use App\Http\Requests\CreateManutencaoCivilEletricaRequest;
use App\Http\Requests\UpdateManutencaoCivilEletricaRequest;

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

        return redirect(route('plantas.manutencoesCivilEletrica', $manutencaoCivilEletrica->planta_id));
    }

    /**
     * Display the specified ManutencaoCivilEletrica.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show(AtividadeRealizadaDataTable $dataTable, $id)
    {
        $manutencaoCivilEletrica = $this->manutencaoCivilEletricaRepository->find($id);

        if (empty($manutencaoCivilEletrica)) {
            Flash::error('Manutencao Civil Eletrica não encontrada');

            return redirect(route('manutencoesCivilEletrica.index'));
        }

        return $dataTable->addScope(new PorIdManCivilEletricaScope($id))
            ->render('manutencoes_civil_eletrica.show', compact('manutencaoCivilEletrica'));
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

            return redirect()->back();
        }

        $manutencaoCivilEletrica = $this->manutencaoCivilEletricaRepository->update($request->all(), $id);

        Flash::success('Manutencao Civil Eletrica atualizada com sucesso.');

        return redirect(route('plantas.manutencoesCivilEletrica', $manutencaoCivilEletrica->planta_id));
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

            return redirect()->back();
        }

        $this->manutencaoCivilEletricaRepository->delete($id);

        Flash::success('Manutencao Civil Eletrica excluída com sucesso.');

        return redirect(route('plantas.manutencoesCivilEletrica', $manutencaoCivilEletrica->planta_id));
    }

    /**
     * Metodo para fazer o download do relatório de manutencao civil eletrica
     *
     * @param mixed $id
     */
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
