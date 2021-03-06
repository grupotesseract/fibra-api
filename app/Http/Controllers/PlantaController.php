<?php

namespace App\Http\Controllers;

use App\DataTables\ItensDaPlantaDataTable;
use App\DataTables\ManutencaoCivilEletricaDataTable;
use App\DataTables\PlantaDataTable;
use App\DataTables\ProgramacoesDaPlantaDataTable;
use App\DataTables\QuantidadeMinimaDataTable;
use App\DataTables\Scopes\PorIdPlantaScope;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests;
use App\Http\Requests\CreatePlantaRequest;
use App\Http\Requests\CreateQuantidadeMinimaRequest;
use App\Http\Requests\UpdatePlantaRequest;
use App\Repositories\PlantaRepository;
use App\Repositories\QuantidadeMinimaRepository;
use Flash;
use Response;

class PlantaController extends AppBaseController
{
    /** @var PlantaRepository */
    private $plantaRepository;

    /** @var QuantidadeMinimaRepository */
    private $qntMinimaRepository;

    public function __construct(PlantaRepository $plantaRepo, QuantidadeMinimaRepository $qntRepo)
    {
        $this->plantaRepository = $plantaRepo;
        $this->qntMinimaRepository = $qntRepo;
    }

    /**
     * Display a listing of the Planta.
     *
     * @param PlantaDataTable $plantaDataTable
     * @return Response
     */
    public function index(PlantaDataTable $plantaDataTable)
    {
        return $plantaDataTable->render('plantas.index');
    }

    /**
     * Show the form for creating a new Planta.
     *
     * @return Response
     */
    public function create()
    {
        return view('plantas.create');
    }

    /**
     * Store a newly created Planta in storage.
     *
     * @param CreatePlantaRequest $request
     *
     * @return Response
     */
    public function store(CreatePlantaRequest $request)
    {
        $input = $request->all();

        $planta = $this->plantaRepository->create($input);

        Flash::success('Planta salva com sucesso.');

        return redirect(route('empresas.show', $planta->empresa_id));
    }

    /**
     * Display the specified Planta.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show(ItensDaPlantaDataTable $datatable, $id)
    {
        $planta = $this->plantaRepository->find($id);

        if (empty($planta)) {
            Flash::error('Planta não encontrada');

            return redirect(route('plantas.index'));
        }

        return $datatable->addScope(new PorIdPlantaScope($id))
                         ->render('plantas.show', compact('planta'));
    }

    /**
     * Show the form for editing the specified Planta.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $planta = $this->plantaRepository->find($id);

        if (empty($planta)) {
            Flash::error('Planta não encontrada');

            return redirect(route('plantas.index'));
        }

        return view('plantas.edit')->with('planta', $planta);
    }

    /**
     * Update the specified Planta in storage.
     *
     * @param  int              $id
     * @param UpdatePlantaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePlantaRequest $request)
    {
        $planta = $this->plantaRepository->find($id);

        if (empty($planta)) {
            Flash::error('Planta não encontrada');

            return redirect(route('plantas.index'));
        }

        $planta = $this->plantaRepository->update($request->all(), $id);

        Flash::success('Planta atualizada com sucesso.');

        return redirect(route('empresas.show', $planta->empresa_id));
    }

    /**
     * Remove the specified Planta from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $planta = $this->plantaRepository->find($id);

        if (empty($planta)) {
            Flash::error('Planta não encontrada');

            return redirect(route('plantas.index'));
        }

        $this->plantaRepository->delete($id);

        Flash::success('Planta excluída com sucesso.');

        return redirect(route('empresas.show', $planta->empresa_id));
    }

    /**
     * Metodo para retornar as plantas de uma empresa.
     *
     * @return JSON
     */
    public function getPorEmpresa($empresaId)
    {
        $plantas = $this->plantaRepository->getArrayParaSelect($empresaId);

        return $this->sendResponse($plantas, 'Plantas por empresa');
    }

    /**
     * Metodo para servir a view com a datatable de itens de uma planta.
     *
     * @param ItensDaPlantaDataTable $datatable
     * @param mixed $id
     */
    public function getItensPlanta(ItensDaPlantaDataTable $datatable, $id)
    {
        $planta = $this->plantaRepository->find($id);

        if (empty($planta)) {
            Flash::error('Planta não encontrada');

            return redirect(route('plantas.index'));
        }

        return $datatable->addScope(new PorIdPlantaScope($id))
                         ->render('plantas.show_itens', compact('planta'));
    }

    /**
     * Metodo para servir a view com a datatable de programacoes de uma planta.
     *
     * @param ItensDaPlantaDataTable $datatable
     * @param mixed $id
     */
    public function getProgramacoesPlanta(ProgramacoesDaPlantaDataTable $datatable, $id)
    {
        $planta = $this->plantaRepository->find($id);

        if (empty($planta)) {
            Flash::error('Planta não encontrada');

            return redirect(route('plantas.index'));
        }

        return $datatable->addScope(new PorIdPlantaScope($id))
                         ->render('plantas.show_programacoes', compact('planta'));
    }

    /**
     * Metodo para servir a view com a datatable de QuantidadeMinima de uma planta.
     *
     * @param ItensDaPlantaDataTable $datatable
     * @param mixed $id
     */
    public function getQuantidadesMinimasPlanta(QuantidadeMinimaDataTable $datatable, $id)
    {
        $planta = $this->plantaRepository->find($id);

        if (empty($planta)) {
            Flash::error('Planta não encontrada');

            return redirect(route('plantas.index'));
        }

        return $datatable->addScope(new PorIdPlantaScope($id))
                         ->render('plantas.show_quantidades_minimas', compact('planta'));
    }

    /**
     * Metodo para recebe o POST para criar um novo registro de QuantidadeMinima
     * a partir de uma planta.
     *
     * @param CreateEntradaMaterialRequest $request
     *
     * @return Response
     */
    public function postQuantidadesMinimasPlanta(CreateQuantidadeMinimaRequest $request, $id)
    {
        $jaExisteQntMinima = $this->qntMinimaRepository
            ->checaEntradaExistente($request->planta_id, $request->material_id);

        if ($jaExisteQntMinima) {
            return \Response::json([
                'errors' => ['Já existe uma quantidade mínima para esse material'],
            ], 422);
        }

        $result = $this->qntMinimaRepository->create($request->all());

        return $this->sendResponse($result, 'Quantidade mínima adicionada com sucesso');
    }

    /**
     * Metodo para servir a view com a datatable de manutencoes civil eletrica de uma planta.
     *
     * @param ItensDaPlantaDataTable $datatable
     * @param mixed $id
     */
    public function getManCivilEletricaPlanta(ManutencaoCivilEletricaDataTable $datatable, $id)
    {
        $planta = $this->plantaRepository->find($id);

        if (empty($planta)) {
            Flash::error('Planta não encontrada');

            return redirect(route('plantas.index'));
        }

        return $datatable->addScope(new PorIdPlantaScope($id))
                         ->render('plantas.show_man_civil_eletrica', compact('planta'));
    }
}
