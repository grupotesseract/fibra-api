<?php

namespace App\Http\Controllers;

use App\DataTables\DataManutencaoDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateDataManutencaoRequest;
use App\Http\Requests\UpdateDataManutencaoRequest;
use App\Repositories\DataManutencaoRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class DataManutencaoController extends AppBaseController
{
    /** @var  DataManutencaoRepository */
    private $dataManutencaoRepository;

    public function __construct(DataManutencaoRepository $dataManutencaoRepo)
    {
        $this->dataManutencaoRepository = $dataManutencaoRepo;
    }

    /**
     * Display a listing of the DataManutencao.
     *
     * @param DataManutencaoDataTable $dataManutencaoDataTable
     * @return Response
     */
    public function index(DataManutencaoDataTable $dataManutencaoDataTable)
    {
        return $dataManutencaoDataTable->render('datas_manutencoes.index');
    }

    /**
     * Show the form for creating a new DataManutencao.
     *
     * @return Response
     */
    public function create()
    {
        return view('datas_manutencoes.create');
    }

    /**
     * Store a newly created DataManutencao in storage.
     *
     * @param CreateDataManutencaoRequest $request
     *
     * @return Response
     */
    public function store(CreateDataManutencaoRequest $request)
    {
        $input = $request->all();

        $dataManutencao = $this->dataManutencaoRepository->create($input);

        Flash::success('Data Manutencao saved successfully.');

        return redirect(route('datasManutencoes.index'));
    }

    /**
     * Display the specified DataManutencao.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $dataManutencao = $this->dataManutencaoRepository->find($id);

        if (empty($dataManutencao)) {
            Flash::error('Data Manutencao not found');

            return redirect(route('datasManutencoes.index'));
        }

        return view('datas_manutencoes.show')->with('dataManutencao', $dataManutencao);
    }

    /**
     * Show the form for editing the specified DataManutencao.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $dataManutencao = $this->dataManutencaoRepository->find($id);

        if (empty($dataManutencao)) {
            Flash::error('Data Manutencao not found');

            return redirect(route('datasManutencoes.index'));
        }

        return view('datas_manutencoes.edit')->with('dataManutencao', $dataManutencao);
    }

    /**
     * Update the specified DataManutencao in storage.
     *
     * @param  int              $id
     * @param UpdateDataManutencaoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDataManutencaoRequest $request)
    {
        $dataManutencao = $this->dataManutencaoRepository->find($id);

        if (empty($dataManutencao)) {
            Flash::error('Data Manutencao not found');

            return redirect(route('datasManutencoes.index'));
        }

        $dataManutencao = $this->dataManutencaoRepository->update($request->all(), $id);

        Flash::success('Data Manutencao updated successfully.');

        return redirect(route('datasManutencoes.index'));
    }

    /**
     * Remove the specified DataManutencao from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $dataManutencao = $this->dataManutencaoRepository->find($id);

        if (empty($dataManutencao)) {
            Flash::error('Data Manutencao not found');

            return redirect(route('datasManutencoes.index'));
        }

        $this->dataManutencaoRepository->delete($id);

        Flash::success('Data Manutencao deleted successfully.');

        return redirect(route('datasManutencoes.index'));
    }
}
