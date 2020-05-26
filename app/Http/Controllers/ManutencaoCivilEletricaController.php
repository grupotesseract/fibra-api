<?php

namespace App\Http\Controllers;

use App\DataTables\AtividadeRealizadaDataTable;
use App\DataTables\FotosRDODatatable;
use App\DataTables\ManutencaoCivilEletricaDataTable;
use App\DataTables\Scopes\PorIdManCivilEletricaScope;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateManutencaoCivilEletricaRequest;
use App\Http\Requests\UpdateManutencaoCivilEletricaRequest;
use App\Repositories\ManutencaoCivilEletricaRepository;
use App\Repositories\FotoRdoRepository;
use Flash;
use Response;

class ManutencaoCivilEletricaController extends AppBaseController
{
    /** @var ManutencaoCivilEletricaRepository */
    private $manutencaoCivilEletricaRepository;
    private $fotoRdoRepository;

    public function __construct(ManutencaoCivilEletricaRepository $manutencaoCivilEletricaRepo, FotoRdoRepository $fotoRdoRepo)
    {
        $this->manutencaoCivilEletricaRepository = $manutencaoCivilEletricaRepo;
        $this->fotoRdoRepository = $fotoRdoRepo;
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
     * Display a listing of photos of the ManutencaoCivilEletrica.
     *
     * @param ManutencaoCivilEletricaDataTable $manutencaoCivilEletricaDataTable
     * @return Response
     */
    public function indexFotos(FotosRDODatatable $fotosRDODatatable, $idManutencaoRdo)
    {
        return $fotosRDODatatable->addScope(new PorIdManCivilEletricaScope($idManutencaoRdo))->render('fotosRdo.index');
    }

    /**
     * Método para excluir foto de um RDO
     *
     * @param int $idFotoRdo
     * @return void
     */
    public function destroyFoto($idFotoRdo)
    {
        $fotoRdo = $this->fotoRdoRepository->find($idFotoRdo);

        if (empty($fotoRdo)) {
            Flash::error('Foto RDO não encontrada');
            return redirect()->back();
        }

        $this->fotoRdoRepository->delete($idFotoRdo);

        Flash::success('Foto excluída com sucesso.');

        return redirect(route('manutencoesCivilEletrica.fotos', $fotoRdo->manutencao_id));
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
     * Metodo para fazer o download do relatório de manutencao civil eletrica.
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
