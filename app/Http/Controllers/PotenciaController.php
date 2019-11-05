<?php

namespace App\Http\Controllers;

use App\DataTables\PotenciaDataTable;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests;
use App\Http\Requests\CreatePotenciaRequest;
use App\Http\Requests\UpdatePotenciaRequest;
use App\Repositories\PotenciaRepository;
use Flash;
use Response;

class PotenciaController extends AppBaseController
{
    /** @var PotenciaRepository */
    private $potenciaRepository;

    public function __construct(PotenciaRepository $potenciaRepo)
    {
        $this->potenciaRepository = $potenciaRepo;
    }

    /**
     * Display a listing of the Potencia.
     *
     * @param PotenciaDataTable $potenciaDataTable
     * @return Response
     */
    public function index(PotenciaDataTable $potenciaDataTable)
    {
        return $potenciaDataTable->render('potencias.index');
    }

    /**
     * Show the form for creating a new Potencia.
     *
     * @return Response
     */
    public function create()
    {
        return view('potencias.create');
    }

    /**
     * Store a newly created Potencia in storage.
     *
     * @param CreatePotenciaRequest $request
     *
     * @return Response
     */
    public function store(CreatePotenciaRequest $request)
    {
        $input = $request->all();

        $potencia = $this->potenciaRepository->create($input);

        Flash::success('Potencia salva com sucesso.');

        return redirect(route('potencias.index'));
    }

    /**
     * Display the specified Potencia.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $potencia = $this->potenciaRepository->find($id);

        if (empty($potencia)) {
            Flash::error('Potência não encontrada');

            return redirect(route('potencias.index'));
        }

        return view('potencias.show')->with('potencia', $potencia);
    }

    /**
     * Show the form for editing the specified Potencia.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $potencia = $this->potenciaRepository->find($id);

        if (empty($potencia)) {
            Flash::error('Potência não encontrada');

            return redirect(route('potencias.index'));
        }

        return view('potencias.edit')->with('potencia', $potencia);
    }

    /**
     * Update the specified Potencia in storage.
     *
     * @param  int              $id
     * @param UpdatePotenciaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePotenciaRequest $request)
    {
        $potencia = $this->potenciaRepository->find($id);

        if (empty($potencia)) {
            Flash::error('Potência não encontrada');

            return redirect(route('potencias.index'));
        }

        $potencia = $this->potenciaRepository->update($request->all(), $id);

        Flash::success('Potência atualizada com sucesso');

        return redirect(route('potencias.index'));
    }

    /**
     * Remove the specified Potencia from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $potencia = $this->potenciaRepository->find($id);

        if (empty($potencia)) {
            Flash::error('Potência não encontrada');

            return redirect(route('potencias.index'));
        }

        $this->potenciaRepository->delete($id);

        Flash::success('Potência excluída com sucesso');

        return redirect(route('potencias.index'));
    }
}
