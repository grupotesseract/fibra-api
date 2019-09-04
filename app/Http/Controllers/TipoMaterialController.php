<?php

namespace App\Http\Controllers;

use App\DataTables\TipoMaterialDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateTipoMaterialRequest;
use App\Http\Requests\UpdateTipoMaterialRequest;
use App\Repositories\TipoMaterialRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class TipoMaterialController extends AppBaseController
{
    /** @var  TipoMaterialRepository */
    private $tipoMaterialRepository;

    public function __construct(TipoMaterialRepository $tipoMaterialRepo)
    {
        $this->tipoMaterialRepository = $tipoMaterialRepo;
    }

    /**
     * Display a listing of the TipoMaterial.
     *
     * @param TipoMaterialDataTable $tipoMaterialDataTable
     * @return Response
     */
    public function index(TipoMaterialDataTable $tipoMaterialDataTable)
    {
        return $tipoMaterialDataTable->render('tipos_materiais.index');
    }

    /**
     * Show the form for creating a new TipoMaterial.
     *
     * @return Response
     */
    public function create()
    {
        return view('tipos_materiais.create');
    }

    /**
     * Store a newly created TipoMaterial in storage.
     *
     * @param CreateTipoMaterialRequest $request
     *
     * @return Response
     */
    public function store(CreateTipoMaterialRequest $request)
    {
        $input = $request->all();

        $tipoMaterial = $this->tipoMaterialRepository->create($input);

        Flash::success('Tipo Material salvo com sucesso.');

        return redirect(route('tiposMateriais.index'));
    }

    /**
     * Display the specified TipoMaterial.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $tipoMaterial = $this->tipoMaterialRepository->find($id);

        if (empty($tipoMaterial)) {
            Flash::error('Tipo Material não encontrado');

            return redirect(route('tiposMateriais.index'));
        }

        return view('tipos_materiais.show')->with('tipoMaterial', $tipoMaterial);
    }

    /**
     * Show the form for editing the specified TipoMaterial.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $tipoMaterial = $this->tipoMaterialRepository->find($id);

        if (empty($tipoMaterial)) {
            Flash::error('Tipo Material não encontrado');

            return redirect(route('tiposMateriais.index'));
        }

        return view('tipos_materiais.edit')->with('tipoMaterial', $tipoMaterial);
    }

    /**
     * Update the specified TipoMaterial in storage.
     *
     * @param  int              $id
     * @param UpdateTipoMaterialRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTipoMaterialRequest $request)
    {
        $tipoMaterial = $this->tipoMaterialRepository->find($id);

        if (empty($tipoMaterial)) {
            Flash::error('Tipo Material não encontrado');

            return redirect(route('tiposMateriais.index'));
        }

        $tipoMaterial = $this->tipoMaterialRepository->update($request->all(), $id);

        Flash::success('Tipo Material atualizado com sucesso.');

        return redirect(route('tiposMateriais.index'));
    }

    /**
     * Remove the specified TipoMaterial from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $tipoMaterial = $this->tipoMaterialRepository->find($id);

        if (empty($tipoMaterial)) {
            Flash::error('Tipo Material não encontrado');

            return redirect(route('tiposMateriais.index'));
        }

        $this->tipoMaterialRepository->delete($id);

        Flash::success('Tipo Material excluído com sucesso.');

        return redirect(route('tiposMateriais.index'));
    }
}
