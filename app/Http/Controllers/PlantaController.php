<?php

namespace App\Http\Controllers;

use Flash;
use Response;
use App\Http\Requests;
use App\DataTables\PlantaDataTable;
use App\Repositories\PlantaRepository;
use App\Http\Requests\CreatePlantaRequest;
use App\Http\Requests\UpdatePlantaRequest;
use App\Http\Controllers\AppBaseController;

class PlantaController extends AppBaseController
{
    /** @var PlantaRepository */
    private $plantaRepository;

    public function __construct(PlantaRepository $plantaRepo)
    {
        $this->plantaRepository = $plantaRepo;
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

        return redirect(route('plantas.index'));
    }

    /**
     * Display the specified Planta.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $planta = $this->plantaRepository->find($id);

        if (empty($planta)) {
            Flash::error('Planta não encontrada');

            return redirect(route('plantas.index'));
        }

        return view('plantas.show')->with('planta', $planta);
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

        return redirect(route('plantas.index'));
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

        return redirect(route('plantas.index'));
    }
}
