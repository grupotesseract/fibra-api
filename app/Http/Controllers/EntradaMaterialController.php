<?php

namespace App\Http\Controllers;

use Flash;
use Response;
use App\Http\Requests;
use App\Http\Controllers\AppBaseController;
use App\DataTables\EntradaMaterialDataTable;
use App\Repositories\EntradaMaterialRepository;
use App\Http\Requests\CreateEntradaMaterialRequest;
use App\Http\Requests\UpdateEntradaMaterialRequest;

class EntradaMaterialController extends AppBaseController
{
    /** @var EntradaMaterialRepository */
    private $entradaMaterialRepository;

    public function __construct(EntradaMaterialRepository $entradaMaterialRepo)
    {
        $this->entradaMaterialRepository = $entradaMaterialRepo;
    }

    /**
     * Display a listing of the EntradaMaterial.
     *
     * @param EntradaMaterialDataTable $entradaMaterialDataTable
     * @return Response
     */
    public function index(EntradaMaterialDataTable $entradaMaterialDataTable)
    {
        return $entradaMaterialDataTable->render('entradas_materiais.index');
    }

    /**
     * Show the form for creating a new EntradaMaterial.
     *
     * @return Response
     */
    public function create()
    {
        return view('entradas_materiais.create');
    }

    /**
     * Store a newly created EntradaMaterial in storage.
     *
     * @param CreateEntradaMaterialRequest $request
     *
     * @return Response
     */
    public function store(CreateEntradaMaterialRequest $request)
    {
        $input = $request->all();

        $entradaMaterial = $this->entradaMaterialRepository->create($input);

        Flash::success('Entrada de material adicionada com sucesso.');

        return redirect(route('entradasMateriais.index'));
    }

    /**
     * Display the specified EntradaMaterial.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $entradaMaterial = $this->entradaMaterialRepository->find($id);

        if (empty($entradaMaterial)) {
            Flash::error('Entrada de material não encontrada');

            return redirect(route('entradasMateriais.index'));
        }

        return view('entradas_materiais.show')->with('entradaMaterial', $entradaMaterial);
    }

    /**
     * Show the form for editing the specified EntradaMaterial.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $entradaMaterial = $this->entradaMaterialRepository->find($id);

        if (empty($entradaMaterial)) {
            Flash::error('Entrada de material não encontrada');

            return redirect(route('entradasMateriais.index'));
        }

        return view('entradas_materiais.edit')->with('entradaMaterial', $entradaMaterial);
    }

    /**
     * Update the specified EntradaMaterial in storage.
     *
     * @param  int              $id
     * @param UpdateEntradaMaterialRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateEntradaMaterialRequest $request)
    {
        $entradaMaterial = $this->entradaMaterialRepository->find($id);

        if (empty($entradaMaterial)) {
            Flash::error('Entrada de material não encontrada');

            return redirect(route('entradasMateriais.index'));
        }

        $entradaMaterial = $this->entradaMaterialRepository->update($request->all(), $id);

        Flash::success('Entrada de material atualizada com sucesso');

        return redirect(route('programacoes.entradasMateriais', $entradaMaterial->programacao->id));
    }

    /**
     * Remove the specified EntradaMaterial from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $entradaMaterial = $this->entradaMaterialRepository->find($id);

        if (empty($entradaMaterial)) {
            Flash::error('Entrada de material não encontrada');

            return redirect(route('entradasMateriais.index'));
        }

        $this->entradaMaterialRepository->delete($id);

        Flash::success('Entrada de material removida com suceso.');

        return redirect()->back();
    }
}
